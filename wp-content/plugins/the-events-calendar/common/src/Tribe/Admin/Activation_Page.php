<?php
/**
 * Shows a welcome or update message after the plugin is installed/updated.
 */
class Tribe__Admin__Activation_Page {
	protected $args = [];
	public $update_slug = 'update-message-';
	public $welcome_slug = 'welcome-message-';
	protected $current_context = '';

	/**
	 * Handles the update/welcome splash screen.
	 *
	 * @param array $args {
	 *     Plugin specific slugs and option names used to manage when the splash screen displays.
	 *
	 *     @type string $slug
	 *     @type string $version
	 *     @type string $plugin_path
	 *     @type string $version_history_slug
	 *     @type string $update_page_title
	 *     @type string $update_page_template
	 *     @type string $welcome_page_title
	 *     @type string $welcome_page_template
	 * }
	 */
	public function __construct( array $args = [] ) {
		$this->args = wp_parse_args( $args, [
			'slug'                  => '',
			'admin_page'            => '',
			'admin_url'             => '',
			'activation_transient'  => '',
			'version'               => '',
			'plugin_path'           => '',
			'version_history_slug'  => '',
			'update_page_title'     => '',
			'update_page_template'  => '',
			'welcome_page_title'    => '',
			'welcome_page_template' => '',
		] );

		$this->update_slug  .= $this->args['slug'];
		$this->welcome_slug .= $this->args['slug'];

		$this->hooks();
	}

	/**
	 * Determines if we are currently on the Welcome page.
	 *
	 * @since 4.12.11
	 *
	 * @return bool
	 */
	public function is_welcome_page() {
		return isset( $_GET[ $this->welcome_slug ] );
	}

	/**
	 * Determines if we are currently on the update page.
	 *
	 * @since 4.12.11
	 *
	 * @return bool
	 */
	public function is_update_page() {
		return isset( $_GET[ $this->update_slug ] );
	}

	/**
	 * Listen for opportunities to show update and welcome splash pages.
	 */
	public function hooks() {
		// Never show this on the front-end.
		if ( ! is_admin() ) {
			return;
		}

		if (
			tribe_is_truthy( get_option( 'tribe_skip_welcome', false ) )
			|| tribe_is_truthy( tribe_get_option( 'skip_welcome', false ) )
		) {
			return;
		}

		add_action( 'admin_init', [ $this, 'maybe_redirect' ], 10, 0 );
		add_action( 'admin_menu', [ $this, 'register_page' ], 100, 0 ); // Come in after the default page is registered.

		add_action( 'update_plugin_complete_actions', [ $this, 'update_complete_actions' ], 15, 2 );
		add_action( 'update_bulk_plugins_complete_actions', [ $this, 'update_complete_actions' ], 15, 2 );
	}

	/**
	 * Filter the Default WordPress actions when updating the plugin to prevent users to be redirected if they have an
	 * specific intention of going back to the plugins page.
	 *
	 * @param array  $actions The Array of links (html).
	 * @param string $plugin  Which plugins are been updated.
	 *
	 * @return array The filtered Links.
	 */
	public function update_complete_actions( $actions, $plugin ) {
		$plugins = [];

		if ( ! empty( $_GET['plugins'] ) ) {
			$plugins = explode( ',', esc_attr( $_GET['plugins'] ) );
		}

		if ( ! in_array( $this->args['plugin_path'], $plugins ) ) {
			return $actions;
		}

		if ( isset( $actions['plugins_page'] ) ) {
			$actions['plugins_page'] = '<a href="' . esc_url( self_admin_url( 'plugins.php?tribe-skip-welcome' ) ) . '" title="' . esc_attr__( 'Go to plugins page', 'tribe-common' ) . '" target="_parent">' . esc_html__( 'Return to Plugins page' ) . '</a>';

			if ( ! current_user_can( 'activate_plugins' ) ) {
				unset( $actions['plugins_page'] );
			}
		}

		if ( isset( $actions['updates_page'] ) ) {
			$actions['updates_page'] = '<a href="' . esc_url( self_admin_url( 'update-core.php?tribe-skip-welcome' ) ) . '" title="' . esc_attr__( 'Go to WordPress Updates page', 'tribe-common' ) . '" target="_parent">' . esc_html__( 'Return to WordPress Updates' ) . '</a>';
		}

		return $actions;
	}

	/**
	 * Maybe redirect to the welcome page (or to the update page - though this is
	 * currently disabled).
	 */
	public function maybe_redirect() {
		if ( ! empty( $_POST ) ) {
			return; // Don't interrupt anything the user's trying to do.
		}

		if ( ! is_admin() || defined( 'DOING_AJAX' ) ) {
			return;
		}

		if ( defined( 'IFRAME_REQUEST' ) && IFRAME_REQUEST ) {
			return; // Probably the plugin update/install iframe.
		}

		if ( isset( $_GET[ $this->welcome_slug ] ) || isset( $_GET[ $this->update_slug ] ) ) {
			return; // No infinite redirects.
		}

		if ( isset( $_GET['tribe-skip-welcome'] ) ) {
			return; // A way to skip these checks and.
		}

		if (
			! $this->showed_update_message_for_current_version()
			&& ! $this->is_new_install()
		) {
			$page = tribe_get_request_var( 'page' );
			if ( empty( $page ) ) {
				return;
			}

			$match_page = str_replace( 'tribe_events_page_', '', $this->args['admin_page'] );

			if ( $page !== $match_page ) {
				return;
			}

			/**
			 * Filters whether we should disable the update page redirect.
			 *
			 * @since 5.0.0
			 *
			 * @param bool $bypass Whether to bypass the update page redirect.
			 */
			$bypass_update_page = apply_filters( 'tec_admin_update_page_bypass', false, $this );

			if ( $bypass_update_page ) {
				return;
			}

			$this->redirect_to_update_page();
		}

		// Bail if we aren't activating a plugin.
		if ( ! get_transient( $this->args['activation_transient'] ) ) {
			return;
		}

		delete_transient( $this->args['activation_transient'] );

		if ( ! current_user_can( tribe( 'settings' )->required_cap ) ) {
			return;
		}

		// the redirect might be intercepted by another plugin, but
		// we'll go ahead and mark it as viewed right now, just in case
		// we end up in a redirect loop
		// see #31088
		$this->log_display_of_message_page();

		if ( $this->is_new_install() ) {
			$this->redirect_to_welcome_page();
		}
	}

	/**
	 * Have we shown the welcome/update message for the current version?
	 *
	 * @since 5.0.0 Turned this method public.
	 *
	 * @return bool
	 */
	public function showed_update_message_for_current_version() {
		$message_version_displayed = Tribe__Settings_Manager::get_option( 'last-update-message-' . $this->args['slug'] );

		if ( empty( $message_version_displayed ) ) {
			return false;
		}

		$current_version = explode( '.', $this->args['version'] );
		$current_version = array_splice( $current_version, 0, 2 );
		$current_version = array_pad( $current_version, 3, 0 );
		$current_version = implode( '.', $current_version );

		$message_version_displayed = explode( '.', $message_version_displayed );
		$message_version_displayed = array_splice( $message_version_displayed, 0, 2 );
		$message_version_displayed = array_pad( $message_version_displayed, 3, 0 );
		$message_version_displayed = implode( '.', $message_version_displayed );

		if ( version_compare( $message_version_displayed, $current_version, '<' ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Records the fact that we displayed the update message in relation to a specific
	 * version of the plugin (so we don't show it again until/unless they update to
	 * a higher version).
	 */
	protected function log_display_of_message_page() {
		Tribe__Settings_Manager::set_option( 'last-update-message-' . $this->args['slug'], $this->args['version'] );
	}

	/**
	 * The previous_ecp_versions option will be empty or set to 0
	 * if the current version is the first version to be installed.
	 *
	 * @return bool
	 * @see Tribe__Events__Main::maybeSetTECVersion()
	 */
	protected function is_new_install() {
		$previous_versions = Tribe__Settings_Manager::get_option( $this->args['version_history_slug'] );
		return empty( $previous_versions ) || ( end( $previous_versions ) == '0' );
	}

	/**
	 * Handles taking a user to a post-installation welcome page.
	 */
	protected function redirect_to_welcome_page() {
		$url = $this->get_message_page_url( $this->welcome_slug );
		wp_safe_redirect( $url );
		exit();
	}

	/**
	 * Handles taking the user to a post-update splash screen.
	 *
	 * Disused since TEC PR 88 (targeting Tribe__Events__Activation_Page,
	 * which this class was derived from).
	 *
	 * @see https://github.com/the-events-calendar/the-events-calendar/pull/88
	 *
	 * @todo decide whether to reinstate or remove
	 */
	protected function redirect_to_update_page() {
		$url = $this->get_message_page_url( $this->update_slug );
		wp_safe_redirect( $url );
		exit();
	}

	/**
	 * Return the URL of the splash page.
	 *
	 * @param string $slug
	 *
	 * @return string
	 */
	protected function get_message_page_url( $slug ) {
		$settings = tribe( 'settings' );

		$url = ! empty( $this->args['admin_url'] ) ? $this->args['admin_url'] : $settings->get_url();

		$url = esc_url_raw( add_query_arg( $slug, 1, $url ) );

		return $url;
	}

	/**
	 * Dynamically registers the splash page when required.
	 */
	public function register_page() {
		if ( isset( $_GET[ $this->welcome_slug ] ) ) {
			$this->current_context = 'welcome';
		} elseif ( isset( $_GET[ $this->update_slug ] ) ) {
			$this->current_context = 'update';
		} else {
			return;
		}

		$this->disable_default_settings_page();
		add_filter( 'admin_body_class', [ $this, 'admin_body_class' ] );
		add_action( $this->args['admin_page'], [ $this, 'display_page' ] );
	}

	/**
	 * Hooked to admin_body_class to add a class for the update or welcome page
	 *
	 * @param string $classes a space separated string of classes to be added to body
	 *
	 * @return string
	 */
	public function admin_body_class( $classes ) {
		$classes .= ' tribe-' . $this->current_context;
		return $classes;
	}

	/**
	 * Deactivates the regular settings screen (the splash screen will display
	 * in the Events > Settings slot instead, for this request only).
	 */
	protected function disable_default_settings_page() {
		remove_action( $this->args['admin_page'], [ tribe( 'settings' ), 'generate_page' ] );
		remove_action( $this->args['admin_page'], [ tribe( 'settings' ), 'generatePage' ] );
	}

	/**
	 * Prints the splash screen.
	 *
	 * @param string $context
	 *
	 * @return string|null
	 */
	public function display_page() {
		if ( empty( $this->args[ $this->current_context . '_page_title' ] ) || empty( $this->args[ $this->current_context . '_page_template'] ) ) {
			return null;
		}

		do_action( 'tribe_settings_top' );

		$context = isset( $_GET[ $this->welcome_slug ] ) ? 'welcome': 'update';
		$title   = esc_html( $this->args[ $context . '_page_title'] );
		$html    = $this->get_view( $this->args[ $context . '_page_template'] );

		echo "
			<div class='tribe_settings tribe_{$context}_page wrap'>
				<h1> {$title} </h1>
				{$html}
			</div>
		";

		do_action( 'tribe_settings_bottom' );
		$this->log_display_of_message_page();
	}

	/**
	 * Returns the output of the specified template.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	protected function get_view( $path ) {
		if ( ! file_exists( $path ) ) {
			return '';
		}

		ob_start();
		include $path;
		return ob_get_clean();
	}
}
