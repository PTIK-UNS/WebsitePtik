<?php
if (!defined('ABSPATH')) {
	exit;//Exit if accessed directly
}

class AIOWPSecurity_Process_Renamed_Login_Page {

	public function __construct() {
		add_action('login_init', array($this, 'aiowps_login_init'));
		add_filter('site_url', array($this, 'aiowps_site_url'), 10, 2);
		add_filter('network_site_url', array($this, 'aiowps_site_url'), 10, 2);
		add_filter('wp_redirect', array($this, 'aiowps_wp_redirect'), 10, 2);
		add_filter('register', array($this, 'register_link'));
		add_filter('user_request_action_email_content', array($this, 'aiowps_user_request_email_content'), 10, 2);
		remove_action('template_redirect', 'wp_redirect_admin_locations', 1000); //To prevent redirect to login page when people type "login" at end of home URL

	}

	public function aiowps_login_init() {
		$parsed_request = parse_url($_SERVER['REQUEST_URI']);
		if ($parsed_request && preg_match('/wp-login\.php$/', $parsed_request['path'])) {
			AIOWPSecurity_Process_Renamed_Login_Page::aiowps_set_404();
		}
	}

	public function aiowps_site_url($url) {
		return $this->aiowps_filter_wp_login_file($url);
	}

	public function aiowps_wp_redirect($location) {
		return $this->aiowps_filter_wp_login_file($location);
	}

	/**
	 * Filter register link on the login page
	 *
	 * @param string $registration_url
	 * @return string
	 */
	public function register_link($registration_url) {
		return $this->aiowps_filter_wp_login_file($registration_url);
	}

	/**
	 * Filter confirm link so we hide the secret login slug in the export_personal_data email
	 *
	 * @param string $email_text
	 * @param string $email_data
	 * @return string
	 */
	public function aiowps_user_request_email_content($email_text, $email_data) {
		global $aio_wp_security;
		if (isset($email_data['request']) && isset($email_data['request']->action_name)) {
			if ('export_personal_data' == $email_data['request']->action_name) {
				$confirm_url = $email_data['confirm_url'];
				$login_slug = $aio_wp_security->configs->get_value('aiowps_login_page_slug');
				if (get_option('permalink_structure')) {
					$new_confirm_url = str_replace($login_slug, 'wp-login.php', $confirm_url);
				} else {
					$search_pattern = '?'.$login_slug.'&action';
					$new_confirm_url = str_replace($search_pattern, '/wp-login.php/?action', $confirm_url);
				}

				$email_text_modified = str_replace('###CONFIRM_URL###', esc_url_raw($new_confirm_url), $email_text);
				return $email_text_modified;
			}
		}
		return $email_text;
	}

	/**
	 * Filter all login url strings on the login page
	 *
	 * @param string $url
	 * @return string
	 */
	public function aiowps_filter_wp_login_file($url) {
		if (strpos($url, 'wp-login.php') !== false) {
			$args = explode('?', $url);
			if (isset($args[1])) {
				if (strpos($args[1], 'action=postpass') !== false) {
					return $url; //Don't reveal the secret URL in the post password action url
				}
				parse_str($args[1], $args);
				$url = esc_url(add_query_arg($args, AIOWPSecurity_Process_Renamed_Login_Page::new_login_url()));
				$url = html_entity_decode($url);
			} elseif (isset($_SERVER['REQUEST_URI']) && stripos(urldecode($_SERVER['REQUEST_URI']), 'wp-admin/install.php')) {
				return $url;
			} else {
				$url = AIOWPSecurity_Process_Renamed_Login_Page::new_login_url();
			}
		}
		return $url;
	}

	/**
	 * Login page renamed related tasks, do not allow access if not logged with rename login page.
	 *
	 * @return void
	 */
	public static function renamed_login_init_tasks() {
		// Bail if the host cron job is running by running the command "php wp-cron.php"
		// The $_SERVER['REQUEST_URI'] is undefined when running a PHP file from the command line.
		// for `wp plugin list` it will be empty so showing Not available instead plugin list.
		if (empty($_SERVER['REQUEST_URI']) || defined('WP_CLI') || 'cli' == PHP_SAPI || wp_doing_cron() || wp_doing_ajax()) {
			return;
		}

		global $aio_wp_security;

		//The following will process the native wordpress post password protection form
		//Normally this is done by wp-login.php file but we cannot use that since the login page has been renamed
		$action = isset($_GET['action']) ? strip_tags($_GET['action']) : '';
		if (isset($_POST['post_password']) && 'postpass' == $action) {

			// Check if the captcha is enabled for the password protected pages and process validation if the login page was renamed
			if ('1' == $aio_wp_security->configs->get_value('aiowps_enable_password_protected_captcha')) {
				$aio_wp_security->captcha_obj->validate_password_protected_password_form_with_captcha();
			}

			require_once ABSPATH . 'wp-includes/class-phpass.php';
			$hasher = new PasswordHash(8, true);

			/**
			 * Filter the life span of the post password cookie.
			 *
			 * By default, the cookie expires 10 days from creation. To turn this
			 * into a session cookie, return 0.
			 *
			 * @since 3.7.0
			 *
			 * @param int $expires The expiry time, as passed to setcookie().
			 */
			$expire = apply_filters('post_password_expires', time() + 10 * DAY_IN_SECONDS);
			setcookie('wp-postpass_' . COOKIEHASH, $hasher->HashPassword(wp_unslash($_POST['post_password'])), $expire, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true);

			wp_safe_redirect(wp_get_referer());
			exit();
		}

		//case where someone attempting to reach wp-admin
		if (is_admin() && !is_user_logged_in() && basename($_SERVER["SCRIPT_FILENAME"]) !== 'admin-post.php') {
			//Fix to prevent fatal error caused by some themes and Yoast SEO
			do_action('aiowps_before_wp_die_renamed_login');
			wp_die(__('You do not have permission to access this page.', 'all-in-one-wp-security-and-firewall') .  ' ' . __('Please log in and try again.', 'all-in-one-wp-security-and-firewall'), 403);
		}

		//case where someone attempting to reach wp-login
		if (isset($_SERVER['REQUEST_URI']) && stripos(urldecode($_SERVER['REQUEST_URI']), 'wp-login.php') && !is_user_logged_in()) {

			// Handle export personal data request for rename login case
			if (isset($_GET['request_id'])) {
				$request_id = (int) $_GET['request_id'];
				$result = '';
				if (isset($_GET['confirm_key'])) {
					$key = sanitize_text_field(wp_unslash($_GET['confirm_key']));
					$result = wp_validate_user_request_key($request_id, $key);
				} else {
					$result = new WP_Error('invalid_key', __('Invalid key', 'all-in-one-wp-security-and-firewall'));
				}

				if (is_wp_error($result)) {
						wp_die($result);
				} elseif (!empty($result)) {
					_wp_privacy_account_request_confirmed($request_id);
					$message = _wp_privacy_account_request_confirmed_message($request_id);
					login_header(__('User action confirmed.', 'all-in-one-wp-security-and-firewall'), $message);
					login_footer();
					exit;
				}
			}

			//Check if the maintenance (lockout) mode is active - if so prevent access to site by not displaying 404 page!
			if ($aio_wp_security->configs->get_value('aiowps_site_lockout') == '1') {
				AIOWPSecurity_WP_Loaded_Tasks::site_lockout_tasks();
			} else {
				AIOWPSecurity_Process_Renamed_Login_Page::aiowps_set_404();
			}
		}

		//case where someone attempting to reach the standard register pages
		if (isset($_SERVER['REQUEST_URI']) && stripos(urldecode($_SERVER['REQUEST_URI']), 'wp-register.php')) {
			//Check if the maintenance (lockout) mode is active - if so prevent access to site by not displaying 404 page!
			if ('1' == $aio_wp_security->configs->get_value('aiowps_site_lockout')) {
				AIOWPSecurity_WP_Loaded_Tasks::site_lockout_tasks();
			} else {
				AIOWPSecurity_Process_Renamed_Login_Page::aiowps_set_404();
			}
		}

		$login_slug = $aio_wp_security->configs->get_value('aiowps_login_page_slug');

		if (self::is_renamed_login_page_requested($login_slug)) {
			if (empty($action) && is_user_logged_in()) {
				//if user is already logged in but tries to access the renamed login page, send them to the dashboard
				// or to requested redirect-page, filtered in 'login_redirect'.
				if (isset($_REQUEST['redirect_to'])) {
					$redirect_to = wp_sanitize_redirect($_REQUEST['redirect_to']);
					$redirect_to = wp_validate_redirect($redirect_to, apply_filters('wp_safe_redirect_fallback', admin_url(), 302));
					$requested_redirect_to = $redirect_to;
				} else {
					$redirect_to = admin_url();
					$requested_redirect_to = '';
				}
				$redirect_to = apply_filters('login_redirect', $redirect_to, $requested_redirect_to, wp_get_current_user());
				AIOWPSecurity_Utility::redirect_to_url($redirect_to);
			} else {
				global $wp_version;
				do_action('aiowps_rename_login_load');
				// logout action called by WooCommerce does not apply the login whitelist which shows a 403 error for the customer
				if (!(isset($_GET['action']) && 'logout' == $_GET['action'])) {
					AIOWPSecurity_Utility_IP::check_login_whitelist_and_forbid();
				}

				status_header(200);
				if (version_compare($wp_version, '6.6', '>=')) {
					require_once(AIO_WP_SECURITY_PATH . '/other-includes/wp-security-rename-login-feature.php');
				} elseif (version_compare($wp_version, '5.7', '>=')) {
					require_once(AIO_WP_SECURITY_PATH . '/other-includes/wp-security-rename-login-feature-pre-6-6.php');
				} elseif (version_compare($wp_version, '5.2', '>=')) {
					require_once(AIO_WP_SECURITY_PATH . '/other-includes/wp-security-rename-login-feature-pre-5-7.php');
				} else {
					require_once(AIO_WP_SECURITY_PATH . '/other-includes/wp-security-rename-login-feature-pre-5-2.php');
				}

				die;
			}
		}
	}

	public static function new_login_url() {
		global $aio_wp_security;
		$login_slug = $aio_wp_security->configs->get_value('aiowps_login_page_slug');
		if (get_option('permalink_structure')) {
			return trailingslashit(trailingslashit(home_url()) . $login_slug);
		} else {
			return trailingslashit(site_url()) . '?' . $login_slug;
		}
	}

	public static function aiowps_set_404() {
		global $wp_query;
		do_action('aiowps_before_set_404'); // This hook is for themes which produce a fatal error when the rename login feature is enabled and someone visits "wp-admin" slug directly

		status_header(404);
		$wp_query->set_404();
		$template = get_404_template();
		if (empty($template)) $template = get_index_template();
		$template = apply_filters('template_include', $template);
		if ($template) include($template);
		die;
	}
	
	/**
	 * Check renamed login page is requested
	 *
	 * @param string $login_slug Renamed loginpage slug
	 *
	 * @return boolean
	 */
	public static function is_renamed_login_page_requested($login_slug) {
		
		if (empty($_SERVER['REQUEST_URI'])) return false;
	
		$parsed_url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$home_url_with_slug = home_url($login_slug, 'relative');

		/*
		 * Compatibility fix for WPML, TranslatePress plugin
		 */
		if (function_exists('wpml_object_id') || function_exists('trp_enable_translatepress')) {
			$home_url_with_slug = home_url($login_slug);
			$parsed_home_url_with_slug = parse_url($home_url_with_slug);
			$home_url_with_slug = $parsed_home_url_with_slug['path']; //this will return just the path minus the protocol and host
		}
		
		if (untrailingslashit($parsed_url_path) === $home_url_with_slug || (!get_option('permalink_structure') && isset($_GET[$login_slug]))) {
			return true;
		}
		
		return false;
	}

}
