<?php
/**
 * The core plugin class.
 *
 * @link       http://bootstrapped.ventures
 * @since      1.0.0
 *
 * @package    Visual_Link_Preview
 * @subpackage Visual_Link_Preview/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Visual_Link_Preview
 * @subpackage Visual_Link_Preview/includes
 * @author     Brecht Vandersmissen <brecht@bootstrapped.ventures>
 */
class Visual_Link_Preview {

	/**
	 * Define any constants to be used in the plugin.
	 *
	 * @since    1.0.0
	 */
	private function define_constants() {
		define( 'VLP_VERSION', '2.2.7' );
		define( 'VLP_DIR', plugin_dir_path( dirname( __FILE__ ) ) );
		define( 'VLP_URL', plugin_dir_url( dirname( __FILE__ ) ) );
	}

	/**
	 * Make sure all is set up for the plugin to load.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->define_constants();
		$this->load_dependencies();
		do_action( 'vlp_init' );
	}

	/**
	 * Load all plugin dependencies.
	 *
	 * @since    1.0.0
	 */
	private function load_dependencies() {
		// General.
		require_once( VLP_DIR . 'includes/class-vlp-i18n.php' );

		// Priority.
		require_once( VLP_DIR . 'includes/public/class-vlp-settings.php' );

		// Public.
		require_once( VLP_DIR . 'includes/public/class-vlp-dynamic-template-block.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-dynamic-template-layout.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-dynamic-template.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-link.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-shortcode.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-template-editor.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-template-manager.php' );
		require_once( VLP_DIR . 'includes/public/class-vlp-template-style.php' );

		// API.
		require_once( VLP_DIR . 'includes/public/api/class-vlp-api-block.php' );
		require_once( VLP_DIR . 'includes/public/api/class-vlp-api-template.php' );

		// Dynamic Template Blocks.
		require_once( VLP_DIR . 'includes/public/dynamic-template/blocks/class-vlp-block-button.php' );
		require_once( VLP_DIR . 'includes/public/dynamic-template/blocks/class-vlp-block-image.php' );
		require_once( VLP_DIR . 'includes/public/dynamic-template/blocks/class-vlp-block-summary.php' );
		require_once( VLP_DIR . 'includes/public/dynamic-template/blocks/class-vlp-block-title.php' );
		require_once( VLP_DIR . 'includes/public/dynamic-template/blocks/class-vlp-block-url.php' );

		// Dynamic Template Layouts.
		require_once( VLP_DIR . 'includes/public/dynamic-template/layouts/class-vlp-layout-2-columns.php' );

		// Admin.
		if ( is_admin() ) {
			require_once( VLP_DIR . 'includes/admin/class-vlp-assets.php' );

			// Modal.
			require_once( VLP_DIR . 'includes/admin/modal/class-vlp-button.php' );
			require_once( VLP_DIR . 'includes/admin/modal/class-vlp-modal.php' );
			require_once( VLP_DIR . 'includes/admin/modal/class-vlp-shortcode-preview.php' );
		}
	}
}
