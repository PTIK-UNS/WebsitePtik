<?php
/*
 * Plugin Name: ThemetechMount Acadevo Demo Content Setup
 * Plugin URI: https://www.themetechmount.com
 * Description: Acadevo Demo Content Setup Plugin By ThemetechMount
 * Version: 1.0
 * Author: ThemetechMount
 * Author URI: https://www.themetechmount.com
 * Text Domain: acadevo-demosetup
 * Domain Path: /languages
 */
 
 
 
/**
 *  Version and directory
 */
define( 'ACADEVO_TMDC_VERSION', '1.0' );
define( 'ACADEVO_TMDC_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACADEVO_TMDC_URI', plugins_url( '', __FILE__ ) );



/**
 *  Demo Content setup
 */
require_once ACADEVO_TMDC_DIR . 'one-click-demo/demo-content.php';



/**
 *  Translation
 */
function acadevo_demosetup_load_plugin_textdomain() {
	$domain = 'acadevo-demo-content-setup';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	if ( $loaded = load_textdomain( 'acadevo-demosetup', trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' ) ) {
		return $loaded;
	} else {
		load_plugin_textdomain( 'acadevo-demosetup', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'init', 'acadevo_demosetup_load_plugin_textdomain' );



/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function acadevo_demosetup_load_textdomain() {
	load_plugin_textdomain( 'acadevo-demosetup', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'acadevo_demosetup_load_textdomain' );







function acadevo_demo_content_scripts_styles(){

	wp_enqueue_style(
		'tm-one-click-demo-style',
		plugin_dir_url( __FILE__ ) . 'style.css',
		time(),
		true
	);
	wp_enqueue_script(
		'tm-one-click-demo-set-js',
		plugin_dir_url( __FILE__ ) . 'functions.js',
		array( 'jquery' ),
		time(),
		true
	);
	


}
add_action( 'admin_enqueue_scripts', 'acadevo_demo_content_scripts_styles', 20 );



/**
 * HTML Output for the one click demo setup
 *
 * @since 1.0.0
 */
if( !function_exists('themetechmount_acadevo_one_click_html') ){
function themetechmount_acadevo_one_click_html() {
	?>
	
	<div id="import-demo-data-results">
				
		<div class="import-demo-data-text-w">
		
			<div class="import-demo-data-layout">
				<!-- <h3>Select demo data type  <small>(select below)</small>: </h3> -->
				
				<div class="tm-import-demo-left">
					<div class="tm-import-demo-left-inner">
						
						<select id="import-layout-type" name="import-layout-type">
							<option value="Classic">Classic Site</option>
							<option value="Infostack">Infostack Site</option>
							<option value="OverlayInfostack">Overlay Infostack</option>		
							<option value="RTL">RTL Site</option>								
						</select>
						
						<br><br><hr>
						
						<div class="import-demo-data-text">
						
							<strong><?php esc_attr_e('NOTE:', 'acadevo'); ?></strong>
							<?php esc_attr_e('This process may overwrite your existing content or settings. So please do this on fresh WordPress setup only.', 'acadevo'); ?>
							<br /><br />
							<?php esc_attr_e('Also if you already included demo data than this will add multiple menu links and you need to remove the repeated menu items by going to "Admin > Appearance > menus" section.', 'acadevo'); ?>
							
						</div>

						
					</div>
				</div>
				
				<div class="tm-import-demo-right">
				
					<!-- classic -->
					<span class="import-demo-thumb-w import-demo-thumb-classic">
						<div class="tm-import-demo-preview-text">Preview:</div>
						<a href="http://acadevo.themetechmount.net/" target="_blank">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/layout-classic.png" alt="Classic">
							<span class="tm-import-demo-link-text">View demo online</span>
						</a>
					</span>
					
					<!-- Infostack -->
					<span class="import-demo-thumb-w import-demo-thumb-infostack" style="display:none;">
						<div class="tm-import-demo-preview-text">Preview:</div>
						<a href="http://acadevo.themetechmount.net/infostack-header-style/" target="_blank">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/layout-infostack.png" alt="Infostack">
							<span class="tm-import-demo-link-text">View demo online</span>
						</a>
					</span>
					

					<!-- Overlay Infostack -->
					<span class="import-demo-thumb-w import-demo-thumb-overlayinfostack" style="display:none;">
						<div class="tm-import-demo-preview-text">Preview:</div>
						<a href="http://acadevo.themetechmount.net/overlay-infostack-header/" target="_blank">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/layout-overlayinfostack.png" alt="Overlay Infostack">
							<span class="tm-import-demo-link-text">View demo online</span>
						</a>
					</span>

					<!-- rtl -->
					<span class="import-demo-thumb-w import-demo-thumb-rtl" style="display:none;">
						<div class="tm-import-demo-preview-text">Preview:</div>
						<a href="http://acadevo.themetechmount.net/acadevo-rtl/" target="_blank">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>images/layout-rtl.png" alt="RTL">
							<span class="tm-import-demo-link-text">View demo online</span>
						</a>
					</span>
					
				</div>
				
				<div class="clear clr"></div>
				
			</div>
		
			
			<br /><br />
			<input type="button" class="button button-primary" id="themetechmount_one_click_demo_content" value="<?php esc_attr_e('I agree, continue demo content setup', 'acadevo'); ?>" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			<a href="#" class="tm-one-click-error-close"><?php esc_attr_e('Cancel', 'acadevo' ); ?></a>
		</div>
	
	</div>
	
	<div class="clear"></div>
	
	<?php
}
}