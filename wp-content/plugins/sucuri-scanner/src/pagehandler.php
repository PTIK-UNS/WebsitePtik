<?php

/**
 * Code related to the pagehandler.php interface.
 *
 * PHP version 5
 *
 * @category   Library
 * @package    Sucuri
 * @subpackage SucuriScanner
 * @author     Daniel Cid <dcid@sucuri.net>
 * @copyright  2010-2018 Sucuri Inc.
 * @license    https://www.gnu.org/licenses/gpl-2.0.txt GPL2
 * @link       https://wordpress.org/plugins/sucuri-scanner
 */

if (!defined('SUCURISCAN_INIT') || SUCURISCAN_INIT !== true) {
    if (!headers_sent()) {
        /* Report invalid access if possible. */
        header('HTTP/1.1 403 Forbidden');
    }
    exit(1);
}

/**
 * Returns the html of the plugin/theme list.
 */
function sucuriscan_resource_list($resource = array())
{
	$html = '';


    foreach ($resource as $key => $value) {
        $slug = $key;

        if (strpos($key, '/') !== false) {
            $slug = explode('/', $key)[0];
        }

        if (strpos($key, '.php') !== false) {
            $slug = str_replace('.php', '', $slug);
        }

        $params = array(
            "slug"    => $slug,
            "version" => $value['Version'],
            "name"    => $value['Name'],
        );

        $html .= SucuriScanTemplate::getSection('dashboard-theme-plugin', $params);
    }

	return $html;
}

function sucuriscan_theme_toggle() {
    $response = '';

    if (!current_user_can( 'manage_options')) {
        wp_send_json(array('ok' => false, 'error' => 'Non-admin user'), 200);
    }

    $user_id = get_current_user_id();

    if (!$user_id) {
        wp_send_json(array('ok' => false, 'error' => 'Invalid user'), 200);
    }

    $option_name = 'sucuriscan_preferred_theme';
    $currentTheme = get_user_meta($user_id, 'sucuriscan_preferred_theme', true);
    $newPreferencedTheme = ($currentTheme === 'light') ? 'dark' : 'light';

    if ($newPreferencedTheme === 'dark' && !SucuriScanInterface::isPremium()) {
        $response = '<div class="sucuriscan-inline-alert-error"><p>To activate dark mode, please enter a valid WAF key.</p></div>';

        wp_send_json(array('ok' => false, 'error' => $response), 200);
    }

    update_user_meta($user_id, $option_name, $newPreferencedTheme);

    $response = sprintf(
        '<div class="sucuriscan-inline-alert-success"><p>Theme changed to %s mode.</p></div>',
        $newPreferencedTheme
    );

    wp_send_json($response, 200);
}

/**
 * Renders the content of the plugin's dashboard page.
 *
 * @return void
 */
function sucuriscan_page()
{
    $params = array();

    SucuriScanInterface::startupChecks();

    /* load data for the Integrity section */
    $params['Integrity'] = SucuriScanIntegrity::pageIntegrity();

    /* load data for the SiteCheck section */
    $params['SiteCheck.Refresh'] = 'false';
    $params['SiteCheck.iFramesTitle'] = __('iFrames', 'sucuri-scanner');
    $params['SiteCheck.LinksTitle'] = __('Links', 'sucuri-scanner');
    $params['SiteCheck.ScriptsTitle'] = __('Scripts', 'sucuri-scanner');
    $params['SiteCheck.iFramesContent'] = __('Loading...', 'sucuri-scanner');
    $params['SiteCheck.LinksContent'] = __('Loading...', 'sucuri-scanner');
    $params['SiteCheck.ScriptsContent'] = __('Loading...', 'sucuri-scanner');
    $params['SiteCheck.Malware'] = '<div class="sucuriscan-panel" id="sucuriscan-malware">Loading...</div>';
    $params['SiteCheck.Blocklist'] = '<div class="sucuriscan-panel" id="sucuriscan-blocklist">Loading...</div>';
    $params['SiteCheck.Recommendations'] = '<div class="sucuriscan-panel" id="sucuriscan-recommendations">Loading...</div>';

    /* load data for the WordPress best practices section */
    $params['WordPress.Recommendations'] = SucuriWordPressRecommendations::pageWordPressRecommendations();

	// Inject the list of plugins and themes
    $params['Plugins'] = sucuriscan_resource_list(get_plugins());
	$params['Themes'] = sucuriscan_resource_list(wp_get_themes());
	$params['PluginsCount'] = count(get_plugins());
	$params['ThemesCount'] = count(wp_get_themes());
	$params['PremiumVisibility'] = SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden';
	$params['FreemiumVisibility'] = SucuriScanInterface::isPremium() ? 'sucuriscan-hidden' : '';
    $params['Theme'] = SucuriScanInterface::getPreferredTheme();

    if (!SucuriScanInterface::isPremium()) {
        $params['Plugins'] = '';
        $params['Themes'] = '';
    }

    if (SucuriScanRequest::get(':sitecheck_refresh') !== false) {
        $params['SiteCheck.Refresh'] = 'true';
    }

    echo SucuriScanTemplate::getTemplate('dashboard', $params);
}

/**
 * Renders the content of the plugin's firewall page.
 *
 * @return void
 */
function sucuriscan_firewall_page()
{
    SucuriScanInterface::startupChecks();

    $params = array(
        'Firewall.Settings' => SucuriScanFirewall::settingsPage(),
        'Firewall.AuditLogs' => SucuriScanFirewall::auditlogsPage(),
        'Firewall.IPAccess' => SucuriScanFirewall::ipAccessPage(),
        'Firewall.ClearCache' => SucuriScanFirewall::clearCachePage(),
        'PremiumVisibility' => SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden',
        'Theme' => SucuriScanInterface::getPreferredTheme()
    );

    echo SucuriScanTemplate::getTemplate('firewall', $params);
}

function sucuriscan_events_reporting_page() {

	$params = array();

	SucuriScanInterface::startupChecks();

	$params['AuditLogs'] = SucuriScanAuditLogs::pageAuditLogs();
    $params['PremiumVisibility'] = SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden';
    $params['Theme'] = SucuriScanInterface::getPreferredTheme();

	echo SucuriScanTemplate::getTemplate('events-reporting', $params);
}

function sucuriscan_headers_management_page() {
	$params = array();

	$nonce = SucuriScanInterface::checkNonce();

	SucuriScanInterface::startupChecks();

	$params['Settings.Headers.Cache'] = sucuriscan_settings_cache_options($nonce);
	$params['Settings.Headers.CORS'] = sucuriscan_settings_cors_options($nonce);
	$params['Settings.Headers.CSP'] = sucuriscan_settings_csp_options($nonce);
    $params['PremiumVisibility'] = SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden';
    $params['Theme'] = SucuriScanInterface::getPreferredTheme();

    echo SucuriScanTemplate::getTemplate('headers-management', $params);
}

function sucuriscan_hardening_prevention_page() {
	$params = array();

	SucuriScanInterface::startupChecks();

	/* settings - hardening */
	$params['Settings.Hardening.Firewall'] = SucuriScanHardeningPage::firewall();
	$params['Settings.Hardening.WPVersion'] = SucuriScanHardeningPage::wpversion();
	$params['Settings.Hardening.RemoveGenerator'] = SucuriScanHardeningPage::wpgenerator();
	$params['Settings.Hardening.NginxPHPFPM'] = SucuriScanHardeningPage::nginxphp();
	$params['Settings.Hardening.WPUploads'] = SucuriScanHardeningPage::wpuploads();
	$params['Settings.Hardening.WPContent'] = SucuriScanHardeningPage::wpcontent();
	$params['Settings.Hardening.WPIncludes'] = SucuriScanHardeningPage::wpincludes();
	$params['Settings.Hardening.Readme'] = SucuriScanHardeningPage::readme();
	$params['Settings.Hardening.AdminUser'] = SucuriScanHardeningPage::adminuser();
	$params['Settings.Hardening.FileEditor'] = SucuriScanHardeningPage::fileeditor();
	$params['Settings.Hardening.SecKeyUpdater'] = SucuriScanHardeningPage::autoSecretKeyUpdater();
	$params['Settings.Hardening.AllowlistPHPFiles'] = SucuriScanHardeningPage::AllowPHPFiles();
    $params['PremiumVisibility'] = SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden';
    $params['Theme'] = SucuriScanInterface::getPreferredTheme();

    echo SucuriScanTemplate::getTemplate('hardening-and-prevention', $params);
}

function sucuriscan_post_hack_actions_page() {
	$params = array();

	SucuriScanInterface::startupChecks();

	/* settings - posthack */
	$params['Settings.Posthack.SecurityKeys'] = SucuriScanSettingsPosthack::securityKeys();
	$params['Settings.Posthack.ResetPassword'] = SucuriScanSettingsPosthack::resetPassword();
	$params['Settings.Posthack.ResetPlugins'] = SucuriScanSettingsPosthack::resetPlugins();
	$params['Settings.Posthack.AvailableUpdates'] = SucuriScanSettingsPosthack::availableUpdates();
    $params['PremiumVisibility'] = SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden';
    $params['Theme'] = SucuriScanInterface::getPreferredTheme();

    echo SucuriScanTemplate::getTemplate('post-hack', $params);
}

/**
 * Renders the content of the plugin's last logins page.
 *
 * @return void
 */
function sucuriscan_lastlogins_page()
{
    SucuriScanInterface::startupChecks();

    // Reset the file with the last-logins logs.
    if (SucuriScanInterface::checkNonce()
        && SucuriScanRequest::post(':reset_lastlogins') !== false
    ) {
        $file_path = sucuriscan_lastlogins_datastore_filepath();

        if (@unlink($file_path)) {
            sucuriscan_lastlogins_datastore_exists();
            SucuriScanInterface::info(__('Last-Logins logs were successfully reset.', 'sucuri-scanner'));
        } else {
            SucuriScanInterface::error(__('Could not reset the last-logins data file.', 'sucuri-scanner'));
        }
    }

    // Page pseudo-variables initialization.
    $params = array(
        'LastLogins.AllUsers' => sucuriscan_lastlogins_all(),
        'LastLogins.Admins' => sucuriscan_lastlogins_admins(),
        'LoggedInUsers' => sucuriscan_loggedin_users_panel(),
        'FailedLogins' => sucuriscan_failed_logins_panel(),
        'PremiumVisibility' => SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden',
        'Theme' => SucuriScanInterface::getPreferredTheme()
    );

    echo SucuriScanTemplate::getTemplate('lastlogins', $params);
}

/**
 * Renders the content of the plugin's settings page.
 *
 * @return void
 */
function sucuriscan_settings_page()
{
    SucuriScanInterface::startupChecks();

    $params = array();
    $nonce = SucuriScanInterface::checkNonce();

    // Keep the reset options panel and form submission processor before anything else.
    $params['Settings.General.ResetOptions'] = sucuriscan_settings_general_resetoptions($nonce);

    /* settings - general */
    $params['Settings.General.DataStorage'] = sucuriscan_settings_general_datastorage($nonce);
    $params['Settings.General.SelfHosting'] = sucuriscan_settings_general_selfhosting($nonce);
    $params['Settings.General.ReverseProxy'] = sucuriscan_settings_general_reverseproxy($nonce);
    $params['Settings.General.ImportExport'] = sucuriscan_settings_general_importexport($nonce);
    $params['Settings.General.Timezone'] = sucuriscan_settings_general_timezone($nonce);
    $params['Settings.General.IPDiscoverer'] = sucuriscan_settings_general_ipdiscoverer($nonce);

    /* settings - scanner */
    $params['Settings.Scanner.Cronjobs'] = SucuriScanSettingsScanner::cronjobs($nonce);
    $params['Settings.Scanner.IntegrityDiffUtility'] = SucuriScanSettingsIntegrity::diffUtility($nonce);
    $params['Settings.Scanner.IntegrityCache'] = SucuriScanSettingsIntegrity::cache($nonce);
    $params['Settings.Scanner.IgnoreFolders'] = SucuriScanSettingsScanner::ignoreFolders($nonce);

    /* settings - alerts */
    $params['Settings.Alerts.Recipients'] = sucuriscan_settings_alerts_recipients($nonce);
    $params['Settings.Alerts.Subject'] = sucuriscan_settings_alerts_subject($nonce);
    $params['Settings.Alerts.PerHour'] = sucuriscan_settings_alerts_perhour($nonce);
    $params['Settings.Alerts.BruteForce'] = sucuriscan_settings_alerts_bruteforce($nonce);
    $params['Settings.Alerts.Events'] = sucuriscan_settings_alerts_events($nonce);
    $params['Settings.Alerts.IgnorePosts'] = sucuriscan_settings_alerts_ignore_posts();
    $params['Settings.Alerts.TrustedIPs'] = sucuriscan_settings_alerts_trustedips();

    /* settings - api service */
    $params['Settings.APIService.Status'] = sucuriscan_settings_apiservice_status($nonce);
    $params['Settings.APIService.Proxy'] = sucuriscan_settings_apiservice_proxy();
    $params['Settings.SiteCheck.Target'] = SucuriScanSiteCheck::targetURLOption();
    $params['Settings.APIService.Checksums'] = sucuriscan_settings_apiservice_checksums($nonce);

    /* settings - website info */
    $params['Settings.Webinfo.Details'] = sucuriscan_settings_webinfo_details();
    $params['Settings.Webinfo.HTAccess'] = sucuriscan_settings_webinfo_htaccess();

    $params['PremiumVisibility'] = SucuriScanInterface::isPremium() ? '' : 'sucuriscan-hidden';
    $params['Theme'] = SucuriScanInterface::getPreferredTheme();

    echo SucuriScanTemplate::getTemplate('settings', $params);
}

/**
 * Handles all the AJAX plugin's requests.
 *
 * @return void
 */
function sucuriscan_ajax()
{
    SucuriScanInterface::checkPageVisibility();

    if (SucuriScanInterface::checkNonce()) {
        SucuriScanAuditLogs::ajaxAuditLogs();
        SucuriScanAuditLogs::ajaxAuditLogsSendLogs();
        SucuriScanSiteCheck::ajaxMalwareScan();
        SucuriScanIntegrity::ajaxIntegrity();
        SucuriScanIntegrity::ajaxIntegrityDiffUtility();
        SucuriScanFirewall::auditlogsAjax();
        SucuriScanFirewall::ipAccessAjax();
        SucuriScanFirewall::blocklistAjax();
        SucuriScanFirewall::deblocklistAjax();
        SucuriScanFirewall::getSettingsAjax();
        SucuriScanFirewall::clearCacheAjax();
        SucuriScanFirewall::clearAutoCacheAjax();
        SucuriScanSettingsScanner::cronjobsAjax();
        SucuriScanSettingsPosthack::availableUpdatesAjax();
        SucuriScanSettingsPosthack::getPluginsAjax();
        SucuriScanSettingsPosthack::resetPasswordAjax();
        SucuriScanSettingsPosthack::resetPluginAjax();
	    SucuriScanVulnerability::renderVulnerabilitiesPanelAjax();
		SucuriScanVulnerability::vulnerabilitiesPluginAjax();
		SucuriScanVulnerability::vulnerabilitiesThemeAjax();
        sucuriscan_theme_toggle();
    }

    wp_send_json(array('ok' => false, 'error' => 'invalid ajax action'), 200);
}
