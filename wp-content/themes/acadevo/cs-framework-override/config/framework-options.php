<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.


// Get current theme name and vesion
$tm_theme = wp_get_theme();
$tm_theme_name = $tm_theme->get( 'Name' );
$tm_theme_ver  = $tm_theme->get( 'Version' );


// Getting all theme options again if variable is not defined
global $acadevo_theme_options;
if( empty($acadevo_theme_options) || !is_array($acadevo_theme_options) ){
	if( function_exists('themetechmount_load_default_theme_options') ){
		themetechmount_load_default_theme_options();
	} else {
		$acadevo_theme_options = get_option('acadevo_theme_options');
	}
}

$pf_title               = ( !empty($acadevo_theme_options['pf_type_title']) ) ? esc_attr($acadevo_theme_options['pf_type_title']) : esc_attr__('Portfolio', 'acadevo') ;
$pf_title_singular      = ( !empty($acadevo_theme_options['pf_type_title_singular']) ) ? esc_attr($acadevo_theme_options['pf_type_title_singular']) : esc_attr__('Portfolio', 'acadevo') ;
$pf_cat_title           = ( !empty($acadevo_theme_options['pf_cat_title']) ) ? esc_attr($acadevo_theme_options['pf_cat_title']) : esc_attr__('Portfolio Categories', 'acadevo') ;
$pf_cat_title_singular  = ( !empty($acadevo_theme_options['pf_cat_title_singular']) ) ? esc_attr($acadevo_theme_options['pf_cat_title_singular']) : esc_attr__('Portfolio Category', 'acadevo') ;




/**
 *  FRAMEWORK SETTINGS
 */
$tm_framework_settings = array(
	'menu_title' 	  => esc_attr__('Acadevo Options', 'acadevo'),
	'menu_type'  	  => 'menu',
	'menu_slug'  	  => 'themetechmount-theme-options',
	'ajax_save'  	  => true,
	'show_reset_all'  => false,
	'framework_title' => esc_attr($tm_theme_name).'  <small>'.esc_attr($tm_theme_ver).'</small>',
	'menu_position'   => 2, // See below comment for proper number
	/*
	Default: bottom of menu structure #Default: bottom of menu structure
	2 – Dashboard
	4 – Separator
	5 – Posts
	10 – Media
	15 – Links
	20 – Pages
	25 – Comments
	59 – Separator
	60 – Appearance
	65 – Plugins
	70 – Users
	75 – Tools
	80 – Settings
	99 – Separator
	For the Network Admin menu, the values are different: #For the Network Admin menu, the values are different:
	2 – Dashboard
	4 – Separator
	5 – Sites
	10 – Users
	15 – Themes
	20 – Plugins
	25 – Settings
	30 – Updates
	99 – Separator
	*/
);



/**
 *  FRAMEWORK OPTIONS
 */
$tm_framework_options = array();


// Layout Settings
$tm_framework_options[] = array(
	'name'   => 'layout_settings', // like ID
	'title'  => esc_attr__('Layout Settings', 'acadevo'),
	'icon'   => 'fa fa-square-o',
	'fields' => array( // begin: fields
		
		array(
			'type'    	=> 'heading',
			'content'		=> esc_attr__('Specify theme pages layout, the skin coloring and background', 	'acadevo'),
        ),
		array(
			'id'      => 'skincolor',
			'type'    => 'themetechmount_skin_color',
			'title'   => esc_attr__( 'Select Skin Color', 'acadevo' ),
			'default' => '#fe541d',
			'options' => array(
				'Orange'			=> '#fe541d', /* Default skin color */
				'Lima'				=> '#129ce7', /* Default skin color */
				'Science Blue'		=> '#18ccdc',
				'Red Orange'		=> '#e13e20',
				'Vivid Violet'		=> '#af33bb',
				'Tan Hide'			=> '#f9a861',
				'Selective Yellow'	=> '#ffb901',
				'Red'				=> '#ae1010',
				'Azure Radiance'	=> '#0095eb',
				'Mountain Meadow'	=> '#18c47c',
				
			),
			'rgba'    => false,
        ),
		array(
			'id'     	=> 'tm_one_click_demo_setup', //themetechmount_one_click_demo_content
			'type'    	=> 'themetechmount_one_click_demo_content',//themetechmount_one_click_demo_content
			'title'  	=> esc_attr__('Demo Content Setup', 'acadevo'),
        ),
		array(
			'id'        => 'layout',
			'type'      => 'radio',
			'title'     => esc_attr__('Pages Layout', 'acadevo'), 
			'options'  	=> array(
							'wide'     => esc_attr__('Wide', 'acadevo'),
							'boxed'    => esc_attr__('Boxed', 'acadevo'),
							'framed'   => esc_attr__('Framed', 'acadevo'),
							'rounded'  => esc_attr__('Rounded', 'acadevo'),
							'fullwide' => esc_attr__('Full Wide', 'acadevo'),
						),
			'default'   => 'wide',
			'after'   	=> '<small>'.esc_attr__('Specify the layout for the pages', 'acadevo').'</small>',
        ),
		array(
			'id'        => 'full_wide_elements',
			'type'      => 'checkbox',
			'title'     => esc_attr__('Select Elements for Full Wide View (in above option)', 'acadevo'),
			'options'   => array(
					'floatingbar' => esc_attr__('Floating Bar', 'acadevo'),
					'topbar'      => esc_attr__('Topbar', 'acadevo'),
					'header'      => esc_attr__('Header', 'acadevo'),
					'content'     => esc_attr__('Content Area', 'acadevo'),
					'footer'      => esc_attr__('Footer', 'acadevo'),
					),
			'default'    => array( 'header' ),
			'after'    	 => '<small>'.esc_attr__('Select elements that you want to show in full-wide view', 'acadevo').'</small>',
			'dependency' => array( 'layout_fullwide', '==', 'true' ),
		),
		
		array(
			'type'      	=> 'heading',
			'content'     	=> esc_attr__('Background Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Set below background options. Background settings will be applied to Boxed layout only', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'global_background',
			'type'   		=> 'themetechmount_background',
			'title' 		=> esc_attr__('Body Background Properties', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background for main body. This is for main outer body background. For "Boxed" layout only.', 'acadevo').'</div>',
			'default'		=> array(
			'color'			=> '#ffffff',
			),
			'output'        => 'body',
        ),
		array(
			'id'     		=> 'inner_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Content Area Background Properties', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background for content area', 'acadevo').'</div>',
			'default' 		=> array(
				'color' 	=> '#ffffff',
			),
			'output'        => 'body #main',
        ),
		
		array(
			'type'        => 'heading',
			'content'     => esc_attr__('Pre-loader Image', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Select pre-loader image for the site. This will work on desktop, mobile and tablet devices', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'preloader_show',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Pre-loader animation', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted cs-text-desc">' . esc_attr__('Show or hide pre-loader animation.', 'acadevo') . '</div>',
		),
		array(
			'id'          => 'loaderimg',
			'type'        => 'image_select',
			'title'       => esc_attr__('Page-loader Image', 'acadevo'), 
			'options'     => array(
					''   	=> get_template_directory_uri() . '/images/loader-none.gif',
					'1'   	=> get_template_directory_uri() . '/images/loader1.gif',
					'2'   	=> get_template_directory_uri() . '/images/loader2.gif',
					'3'   	=> get_template_directory_uri() . '/images/loader3.gif',
					'4'   	=> get_template_directory_uri() . '/images/loader4.gif',
					'5'   	=> get_template_directory_uri() . '/images/loader5.gif',
					'6'   	=> get_template_directory_uri() . '/images/loader6.gif',
					'7'   	=> get_template_directory_uri() . '/images/loader7.gif',
					'8'   	=> get_template_directory_uri() . '/images/loader8.gif',
					'9'   	=> get_template_directory_uri() . '/images/loader9.gif',
					'10'   	=> get_template_directory_uri() . '/images/loader10.gif',
					'11'   	=> get_template_directory_uri() . '/images/loader11.gif',
					'12'   	=> get_template_directory_uri() . '/images/loader12.gif',
					'13'   	=> get_template_directory_uri() . '/images/loader13.gif',
					'14'   	=> get_template_directory_uri() . '/images/loader14.gif',
					'15'   	=> get_template_directory_uri() . '/images/loader15.gif',
					'16'   	=> get_template_directory_uri() . '/images/loader16.gif',
					'17'   	=> get_template_directory_uri() . '/images/loader17.gif',
					'18'   	=> get_template_directory_uri() . '/images/loader18.gif',
					'custom'=> get_template_directory_uri() . '/images/loader-custom.gif',
				),
			'radio'       => true,
			'default'     => '',
			'after'   	  => '<div class="cs-text-muted">' . esc_attr__('Please select site pre-loader image.', 'acadevo') . '<br/><br/><em><strong>' . esc_attr__( 'NOTE:', 'acadevo' ) . '</strong> ' . esc_attr__( 'Please note that if you uploaded pre-loader image (in below option) than this pre-defined loader image will be ignored.', 'acadevo' ) . '</em></div>',
			'dependency' => array( 'preloader_show', '==', 'true' ),
        ),
		array(
			'id'       		=> 'loaderimage_custom',
			'type'      	=> 'image',
			'title'    		=> esc_attr__('Upload Page-loader Image', 'acadevo'),
			'add_title' 	=> 'Select/Upload Page-loader image',
			'after'  		=> '<div class="cs-text-muted">' . esc_attr__('Custom page-loader image that you want to show. You can create animated GIF image from your logo from Animizer website.', 'acadevo') . ' <a href="'. esc_url('http://animizer.net/en/animate-static-image') .'" target="_blank">' . esc_attr__('Click here to go to Anmizer website.', 'acadevo') . '</a><br/><br/><em><strong>' . esc_attr__('NOTE:', 'acadevo') . '</strong>' . esc_attr__('Please note that if you selected image here than the pre-defined loader image (in above option) will be ignored.', 'acadevo') . '</em></div>',
			'dependency'    => array( 'loaderimg_custom', '==', 'true' ),
        ),
		array(
			'type'      => 'heading',
			'content'   => esc_attr__('One Page Website', 'acadevo'),
			'after'  	=> '<small>'.esc_attr__('Options for One Page website', 'acadevo').'</small>',
		),
		array(
			'id'      	=> 'one_page_site',
			'type'    	=> 'switcher',
			'title'   	=> esc_attr__('One Page Site', 'acadevo'),
			'default' 	=> false,
			'label'   	=> '<br><div class="cs-text-muted">'.esc_attr__('Set this option "ON" if your site is one page website', 'acadevo').' <a target="_blank" href="#">'.esc_attr__('Click here to know more about how to setup one-page site.', 'acadevo').'</a></div>',
        ),
		
	),
	
);


// hide_demo_content_option
$hide_demo_content_option = false;
if( isset($acadevo_theme_options['hide_demo_content_option']) ){
	$hide_demo_content_option = $acadevo_theme_options['hide_demo_content_option'];
}

if( $hide_demo_content_option == true ){
	// Removing one click demo setup option
	$tm_framework_options_inner = $tm_framework_options[0];
	foreach( $tm_framework_options_inner['fields'] as $index => $option ){
		if( !empty($option['type']) && $option['type'] == 'themetechmount_one_click_demo_content' ){
			unset($tm_framework_options[0]['fields'][$index]);
		}
	}
}










// Font Settings
$tm_framework_options[] = array(
	'name'   => 'font_settings', // like ID
	'title'  => esc_attr__('Font Settings', 'acadevo'),
	'icon'   => 'fa fa-text-height',
	'fields' => array( // begin: fields
		array(
			'type'    	=> 'heading',
			'content'	=> esc_attr__('Font Settings', 'acadevo'),
			'after'  	=> '<small>'.esc_attr__('General Element Fonts', 'acadevo').'</small>',
        ),
		array(
			'id'             => 'general_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('General Font', 'acadevo'),
			'chosen'         => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'backup-family'  => true, // Select a backup non-google font in addition to a google font
			'font-size'      => true,
			'color'          => true,
			'variant'        => true, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-align'     => false,  // This is still not available
			'text-transform' => true,
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => true,
			'output'         => 'body', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px - Currently not working
			'subtitle'       => esc_attr__('Select font family, size etc. for H2 heading tag.', 'acadevo'),
			'default'        => array (
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Tahoma, Geneva, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '16',
				'line-height'		=> '26',
				'letter-spacing'	=> '0',
				'color'				=> '#666d81',
				'all-varients'		=> 'on',
				'font'				=> 'google',
			),
		),
		
		
		array(
			'id'        => 'link-color',
			'type'      => 'radio',
			'title'     => esc_attr__('Select Link Color', 'acadevo'), 
			'options'  	=> array(
				'default'   => esc_attr__('Dark color as normal color and Skin color as hover color', 'acadevo'),
				'darkhover' => esc_attr__('Skin color as normal color and Dark color as hover color', 'acadevo'),
				'custom'    => esc_attr__('Custom color (select below)', 'acadevo'),
				
			),
			'default'   => 'default',
			'std'       => 'default',
			'after'   	=> '<div class="cs-text-muted">' . esc_attr__('Select normal link color effect. This will change normal text link color and hover color', 'acadevo') . '</div>',
        ),
		array(
			'id'         => 'link-color-regular',
			'type'       => 'color_picker',
			'title'      => esc_attr__( 'Links Color Option (Regular)', 'acadevo' ),
			'default'    => '#000',
			'dependency' => array( 'link-color_custom', '==', 'true' ),
        ),
		array(
			'id'         => 'link-color-hover',
			'type'       => 'color_picker',
			'title'      => esc_attr__( 'Links Color Option (Hover)', 'acadevo' ),
			'default'    => '#7eba03',
			'dependency' => array( 'link-color_custom', '==', 'true' ),
        ),
		
		
		
		array(
			'id'             => 'h1_heading_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('H1 Heading Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'         => 'h1', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '40',
				'line-height'		=> '45',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for H1 heading tag.', 'acadevo').'</div>',
		),
		array(
			'id'          => 'h2_heading_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('H2 Heading Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'      => 'h2', // An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px', // Defaults to px
			'default'     => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '35',
				'line-height'		=> '40',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for H2 heading tag.', 'acadevo').'</div>',
		),
		array(
			'id'          => 'h3_heading_font',
			'type'        => 'themetechmount_typography',
			'chosen'      => false,
			'title'       => esc_attr__('H3 Heading Font', 'acadevo'),
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'         => 'h3', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '30',
				'line-height'		=> '35',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for H3 heading tag.', 'acadevo').'</div>',
		),
		array(
			'id'          => 'h4_heading_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('H4 Heading Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'      => 'h4', // An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px', // Defaults to px
			'default'     => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '25',
				'line-height'		=> '30',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for H4 heading tag.', 'acadevo').'</div>',
		),
		array(
			'id'          => 'h5_heading_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('H5 Heading Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'      => 'h5', // An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px', // Defaults to px
			'default'     => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '20',
				'line-height'		=> '30',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for H5 heading tag.', 'acadevo').'</div>',
		),
		
		array(
			'id'          => 'h6_heading_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('H6 Heading Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'      => 'h6', // An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px', // Defaults to px
			'default'     => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '17',
				'line-height'		=> '22',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for H6 heading tag.', 'acadevo').'</div>',
		),
		
		
		
		array(
			'type'        => 'heading',
			'content'     => esc_attr__('Heading and Subheading Font Settings', 'acadevo'),
			'after'  	  => '<small>'.esc_attr__('Select font settings for Heading and subheading of different title elements like Blog Box, Portfolio Box etc', 'acadevo').'</small>',
		),
		
		array(
			'id'          => 'heading_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('Heading Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'         => '.tm-element-heading-wrapper .tm-vc_general .tm-vc_cta3_content-container .tm-vc_cta3-content .tm-vc_cta3-content-header h2', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '50',
				'line-height'		=> '60',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'text-transform'	=> 'capitalize',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for heading title', 'acadevo').'</div>',
		),
		array(
			'id'          => 'subheading_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('Subheading Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,							
			'output'         => '.tm-element-heading-wrapper .tm-vc_general .tm-vc_cta3_content-container .tm-vc_cta3-content .tm-vc_cta3-content-header h4, .tm-vc_general.tm-vc_cta3.tm-vc_cta3-color-transparent.tm-cta3-only .tm-vc_cta3-content .tm-vc_cta3-headers h4', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '16',
				'line-height'		=> '20',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1',
				'color'				=> '#ff4f01',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for heading title', 'acadevo').'</div>',
		),
		array(
			'id'          => 'content_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('Content Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'         => '.tm-element-heading-wrapper .tm-vc_general.tm-vc_cta3 .tm-vc_cta3-content p', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '16',
				'line-height'		=> '26',
				'letter-spacing'	=> '0',
				'color'				=> '#666d81',
				'font'				=> 'google',
			),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for content', 'acadevo').'</div>',
		),
		array(
			'type'        => 'heading',
			'content'     => esc_attr__('Specific Element Fonts', 'acadevo'),
			'after'  	  => '<small>'.esc_attr__('Select Font for specific elements', 'acadevo').'</small>',
		),
		array(
			'id'          => 'widget_font',
			'type'        => 'themetechmount_typography', 
			'title'       => esc_attr__('Widget Title Font', 'acadevo'),
			'chosen'      => false,
			'text-align'  => false,
			'google'      => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup' => true, // Select a backup non-google font in addition to a google font
			'subsets'     => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'         => 'body .widget .widget-title, body .widget .widgettitle, #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item > h4.mega-block-title, .portfolio-description h2, .themetechmount-portfolio-details h2, .themetechmount-portfolio-related h2', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '24',
				'line-height'		=> '32',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for widget title', 'acadevo').'</div>',
		),
		
		
		array(
			'id'             => 'button_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Button Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'font-size'      => false,
			'line-height'    => false,
			'text-transform' => true,
			'color'          => false,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'all-varients'   => false,
			'output'         => '.main-holder .site-content ul.products li.product .add_to_wishlist, .main-holder .site-content ul.products li.product .yith-wcwl-wishlistexistsbrowse a[rel="nofollow"], .woocommerce button.button, .woocommerce-page button.button, input, .tm-vc_btn, .tm-vc_btn3, .woocommerce-page a.button, .button, .wpb_button, button, .woocommerce input.button, .woocommerce-page input.button, .tp-button.big, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .themetechmount-post-readmore a', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'letter-spacing'	=> '0',
				'text-transform'	=> 'capitalize',
				'font'				=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('This fonts will be applied to all buttons in this site', 'acadevo').'</div>',
		),
		array(
			'id'             => 'element_title',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Element Title Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => false,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => false, // Defaults to false
			'color'          => false,
			'all-varients'   => false,
			'output'         => '.wpb_tabs_nav a.ui-tabs-anchor, body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a, .vc_progress_bar .vc_label, .vc_tta.vc_general .vc_tta-tab > a, .vc_toggle_title > h4', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'		=> 'Roboto Condensed',
				'backup-family'	=> 'Arial, Helvetica, sans-serif',
				'variant'		=> 'regular',
				'font-size'		=> '18',
				'font'			=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('This fonts will be applied to Tab title, Accordion Title and Progress Bar title text', 'acadevo').'</div>',
		),	
	)
);


// Floating Bar Settings
$tm_framework_options[] = array(
	'name'   => 'floatingbar_settings', // like ID
	'title'  => esc_attr__('Floating Bar Settings', 'acadevo'),
	'icon'   => 'fa fa-arrow-circle-o-up',
	'fields' => array( // begin: fields
		array(
			'type'    		=> 'heading',
			'content'		=> esc_attr__('Floating Bar Settings', 'acadevo'),
        ),
		array(
			'id'     		=> 'fbar_show',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Floating Bar', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Show or hide Floating Bar', 'acadevo').'</div>',
        ),
		array(
			'id'      => 'fbar-position',
			'type'    => 'radio',
			'title'   => esc_attr__('Floating bar position', 'acadevo'),
			'options' => array(
				'default' => esc_attr__('Top','acadevo'),
				'right'   => esc_attr__('Right', 'acadevo'),
			),
			'default'    => 'default',
			'after'      => '<div class="cs-text-muted"><br>'.esc_attr__('Position for Floating bar', 'acadevo').'</div>',
			'dependency' => array( 'fbar_show', '==', 'true' ),
        ),
		array(
			'id'            => 'fbar_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Floating Bar Background Color', 'acadevo'),
			'options'  		=> array(
				'darkgrey'    => esc_attr__('Dark grey', 'acadevo'),
				'grey'        => esc_attr__('Grey', 'acadevo'),
				'white'       => esc_attr__('White', 'acadevo'),
				'skincolor'   => esc_attr__('Skincolor', 'acadevo'),
				'custom'      => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'custom',
			'dependency' 	=> array( 'fbar_show', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Floating Bar background color', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'fbar_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Floating Bar Background Properties', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background for Floating bar. You can set color or image and also set other background related properties', 'acadevo').'</div>',
			'color'			=> true,
			'dependency' 	=> array( 'fbar_show', '==', 'true' ),
			'default'		=> array(
				'image'			=> get_template_directory_uri() . '/images/floatingbar-bg.jpg',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center center',
				'attachment'	=> 'scroll',
				'color'			=> 'rgba(255,255,255,0.01)',
				'size'		  	=> 'cover',
			),
			'output' 	        => '.themetechmount-fbar-box-w',
			'output_bglayer'    => true,  // apply color to bglayer class div inside this , default: true
			'color_dropdown_id' => 'fbar_bg_color',   // color dropdown to decide which color
			
        ),
		array(
			'id'            => 'fbar_text_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Floating Bar Text Color', 'acadevo'),
			'options' 		=> array(
				'white'			=> esc_attr__('White', 'acadevo'),
				'darkgrey'		=> esc_attr__('Dark', 'acadevo'),
				'custom'		=> esc_attr__('Custom color', 'acadevo'),
							),
			'default'		=> 'darkgrey',
			'dependency' 	=> array( 'fbar_show', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'fbar_text_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Floating Bar Custom Color for text', 'acadevo' ),
			'default'		 => '#dd3333',
			'dependency'  	 => array( 'fbar_show|fbar_text_color', '==|==', 'true|custom' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Floating Bar', 'acadevo').'</div>',
        ),
		
		array(
			'type'    	=> 'heading',
			'content'	=> esc_attr__('Floating Bar Open/Close Button Settings', 'acadevo'),
			'after'		=> '<small>' . esc_attr__('Settings for Floating Bar Open/Close Button', 'acadevo') . '</small>',
			
        ),
		array(
			'id'      => 'fbar_handler_icon',
			'type'    => 'themetechmount_iconpicker',
			'title'   => esc_attr__('Open Link Icon', 'acadevo' ),
			'default' => array(
				'library'				=> 'themify',
				'library_fontawesome'	=> 'fa fa-arrow-down',
				'library_linecons'		=> 'vc_li vc_li-bubble',
				'library_themify'		=> 'themifyicon ti-menu',
			),
			'dependency' => array( 'fbar_show', '==', 'true' ),
        ),
		array(
			'id'      => 'fbar_handler_icon_close',
			'type'    => 'themetechmount_iconpicker',
			'title'   => esc_attr__('Close Link Icon', 'acadevo' ),
			'default' => array(
				'library'				=> 'themify',
				'library_fontawesome'	=> 'fa fa-arrow-up',
				'library_linecons'		=> 'vc_li vc_li-bubble',
				'library_themify'		=> 'themifyicon ti-close',
			),
			'dependency' => array( 'fbar_show', '==', 'true' ),
        ),
		
		array(
			'id'            => 'fbar_icon_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Floating Bar Open/Close Icon Color', 'acadevo'),
			'options' 		=> array(
					'dark'       => esc_attr__('Dark grey', 'acadevo'),
					'grey'       => esc_attr__('Grey', 'acadevo'),
					'white'      => esc_attr__('White', 'acadevo'),
					'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
			),
			'default'		=> 'white',
			'dependency' 	=> array( 'fbar_show', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option.', 'acadevo').'</div>',
        ),
		
		array(
			'id'            => 'fbar_btn_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Floating Bar Open/Close Button Background Color', 'acadevo'),
			'options' 		=> array(
					'dark'       => esc_attr__('Dark grey', 'acadevo'),
					'grey'       => esc_attr__('Grey', 'acadevo'),
					'white'      => esc_attr__('White', 'acadevo'),
					'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
					'custom'	 => esc_attr__('Custom color', 'acadevo'),
			),
			'default'		=> 'skincolor',
			'dependency' 	=> array( 'fbar_show', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option.', 'acadevo').'</div>',
        ),
		
		array(
			'id'     		 => 'fbar_btn_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Floating Bar Open/Close Button Custom Background Color', 'acadevo' ),
			'default'		 => '#1e73be',
			'output' 	        => '.themetechmount-fbar-btn-link',
			'dependency'  	 => array( 'fbar_show|fbar_btn_bg_color', '==|==', 'true|custom' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Floating Bar Button', 'acadevo').'</div>',
        ),

		array(
			'type'    	 => 'heading',
			'content'	 => esc_attr__('Floating Bar Widget Settings', 'acadevo'),
			'after'		 => '<small>' . esc_attr__('Settings for Floating Bar Widgets', 'acadevo') . '</small>',
			'dependency' => array( 'fbar_show|fbar-position_default', '==|==', 'true|true' ),
        ),
		array(
			'id'			=> 'fbar_widget_column_layout',
			'type' 			=> 'image_select',//themetechmount_pre_color_packages
			'title'			=> esc_attr__('Floating Bar Widget Columns', 'acadevo'),
			'options'      	=> array(
					'12'      => get_template_directory_uri() . '/inc/images/footer_col_12.png',
					'6_6'     => get_template_directory_uri() . '/inc/images/footer_col_6_6.png',
					'4_4_4'   => get_template_directory_uri() . '/inc/images/footer_col_4_4_4.png',
					'3_3_3_3' => get_template_directory_uri() . '/inc/images/footer_col_3_3_3_3.png',
					'8_4'     => get_template_directory_uri() . '/inc/images/footer_col_8_4.png',
					'4_8'     => get_template_directory_uri() . '/inc/images/footer_col_4_8.png',
					'6_3_3'   => get_template_directory_uri() . '/inc/images/footer_col_6_3_3.png',
					'3_3_6'   => get_template_directory_uri() . '/inc/images/footer_col_3_3_6.png',
					'8_2_2'   => get_template_directory_uri() . '/inc/images/footer_col_8_2_2.png',
					'2_2_8'   => get_template_directory_uri() . '/inc/images/footer_col_2_2_8.png',
					'6_2_2_2' => get_template_directory_uri() . '/inc/images/footer_col_6_2_2_2.png',
					'2_2_2_6' => get_template_directory_uri() . '/inc/images/footer_col_2_2_2_6.png',
			),
			'default'		=> '4_4_4',
			'dependency' 	=> array( 'fbar_show|fbar-position_default', '==|==', 'true|true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select Floating Bar Column layout View for widgets.', 'acadevo').'</div>',
        ),
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Hide Floating Bar in Small Devices', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Hide Floating Bar in small devices like mobile, tablet etc.', 'acadevo').'</small>',
			'dependency'     => array('fbar_show','==','true'),
		),
		array(
			'id'       => 'floatingbar-breakpoint',
			'type'     => 'radio',
			'title'    => esc_attr__('Show/Hide Floating Bar in Responsive Mode', 'acadevo'), 
			'subtitle' => esc_attr__('Change options for responsive behaviour of Floating Bar.', 'acadevo'),
			'options'  => array(
				'all'      => esc_attr__('Show in all devices','acadevo'),
				'1200'     => esc_attr__('Show only on large devices','acadevo').' <small>'.esc_attr__('show only on desktops (>1200px)', 'acadevo').'</small>',
				'992'      => esc_attr__('Show only on medium and large devices','acadevo').' <small>'.esc_attr__('show only on desktops and Tablets (>992px)', 'acadevo').'</small>',
				'768'      => esc_attr__('Show on some small, medium and large devices','acadevo').' <small>'.esc_attr__('show only on mobile and Tablets (>768px)', 'acadevo').'</small>',
				'custom'   => esc_attr__('Custom (select pixel below)', 'acadevo'),
			),
			'dependency' => array('fbar_show','==','true'),
			'default'    => '1200'
		),
		array(
			'id'            => 'floatingbar-breakpoint-custom',
			'type'          => 'number',
			'title'         => esc_attr__( 'Custom screen size to hide Floating Bar (in pixel)', 'acadevo' ),
			'subtitle'      => esc_attr__( 'Select after how many pixels the Floating Bar will be hidden.', 'acadevo' ),
			'after'         => esc_attr(' px'),
			'default'       => '1200',
			'dependency' 	=> array( 'fbar_show|floatingbar-breakpoint_custom', '==|==', 'true|true' ),
		),
		
		
	)
);


// Topbar Settings
$tm_framework_options[] = array(
	'name'   => 'topbar_settings', // like ID
	'title'  => esc_attr__('Topbar Settings', 'acadevo'),
	'icon'   => 'fa fa-tasks',
	'fields' => array( // begin: fields
		array(
			'type'    		=> 'heading',
			'content'		=> esc_attr__('Topbar settings', 'acadevo'),
        ),
		array(
			'id'     		=> 'show_topbar',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Topbar', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Show or hide Topbar', 'acadevo').'</div>',
        ),
		array(
			'id'            => 'topbar_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Topbar Background Color', 'acadevo'),
			'options'  		=> array(
								'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
								'grey'       => esc_attr__('Grey', 'acadevo'),
								'white'      => esc_attr__('White', 'acadevo'),
								'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
								'custom'     => esc_attr__('Custom Color', 'acadevo'),
							),
			'default'       => 'darkgrey',
			'dependency' 	=> array( 'show_topbar', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Topbar background color', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'topbar_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Topbar Custom Background Color', 'acadevo' ),
			'default'		 => 'rgba(0,234,35,0.98)',
			'dependency'  	 => array( 'show_topbar|topbar_bg_color', '==|==', 'true|custom' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Topbar', 'acadevo').'</div>',
        ),
		array(
			'id'            => 'topbar_text_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Topbar Text Color', 'acadevo'),
			'options'  => array(
							'white'     => esc_attr__('White', 'acadevo'),
							'dark'      => esc_attr__('Dark', 'acadevo'),
							'skincolor' => esc_attr__('Skin Color', 'acadevo'),
							'custom'    => esc_attr__('Custom color', 'acadevo'),
						),
			'default'       => 'white',
			'dependency' 	=> array( 'show_topbar', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'topbar_text_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Topbar Custom Color for text', 'acadevo' ),
			'default'		 => 'rgba(0, 0, 255, 0.25)',
			'dependency'  	 => array( 'show_topbar|topbar_text_color', '==|==', 'true|custom' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom color for Topbar Text', 'acadevo').'</div>',
        ),
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Topbar Content Options', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Content for Topbar', 'acadevo').'</small>',
			'dependency' 	 => array( 'show_topbar', '==', 'true' ),
		),
		array(
			'id'       		 => 'topbar_left_text',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('Topbar Left Content', 'acadevo'),
			'shortcode'		 => true,
			'dependency' 	 => array( 'show_topbar', '==', 'true' ),
			'desc'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear on Left side of Topbar area', 'acadevo').'</div>',
			'default'        => '<ul class="top-contact"><li><i class="fa fa-envelope-o"></i><a href="mailto:info@yourdomainname.com">info@yourdomainname.com</a></li><li><i class="fa fa-phone"></i> +1-2345-6789-101</li></ul>',
        ),
		array(
			'id'       		 => 'topbar_right_text',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('Topbar Right Content', 'acadevo'),
			'shortcode'		 => true,
			'dependency' 	 => array( 'show_topbar', '==', 'true' ),
			'desc'  	 	 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear on Right side of Topbar area', 'acadevo').'</div>',
			'after'  	 	 => '<div class="cs-text-muted"><br>'.esc_attr__('HTML tags and shortcodes are allowed', 'acadevo') . sprintf( esc_attr__('%1$s Click here to know more %2$s about shortcode description','acadevo') , '<a href="'. esc_url('http://acadevo.themetechmountthemes.com/documentation/shortcodes.html') .'" target="_blank">' , '</a>'  ).'</div>',
			'default'  => '[tm-social-links tooltip="no"]',
        ),
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Hide Topbar Bar in Small Devices', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Hide Topbar Bar in small devices like mobile, tablet etc.', 'acadevo').'</small>',
			'dependency'     => array('show_topbar','==','true'),
		),
		array(
			'id'       => 'topbar-breakpoint',
			'type'     => 'radio',
			'title'    => esc_attr__('Show/Hide Topbar Bar in Responsive Mode', 'acadevo'), 
			'subtitle' => esc_attr__('Change options for responsive behaviour of Topbar Bar.', 'acadevo'),
			'options'  => array(
				'all'      => esc_attr__('Show in all devices','acadevo'),
				'1200'     => esc_attr__('Show only on large devices','acadevo').' <small>'.esc_attr__('show only on desktops (>1200px)', 'acadevo').'</small>',
				'992'      => esc_attr__('Show only on medium and large devices','acadevo').' <small>'.esc_attr__('show only on desktops and Tablets (>992px)', 'acadevo').'</small>',
				'768'      => esc_attr__('Show on some small, medium and large devices','acadevo').' <small>'.esc_attr__('show only on mobile and Tablets (>768px)', 'acadevo').'</small>',
				'custom'   => esc_attr__('Custom (select pixel below)', 'acadevo'),
			),
			'dependency' => array('show_topbar','==','true'),
			'default'    => '1200'
		),
		array(
			'id'            => 'topbar-breakpoint-custom',
			'type'          => 'number',
			'title'         => esc_attr__( 'Custom screen size to hide Topbar (in pixel)', 'acadevo' ),
			'subtitle'      => esc_attr__( 'Select after how many pixels the Topbar will be hidden.', 'acadevo' ),
			'after'         => esc_attr(' px'),
			'default'       => '1200',
			'dependency' 	=> array( 'show_topbar|topbar-breakpoint_custom', '==|==', 'true|true' ),
		),
		
		
	)
);


// Titlebar Settings
$tm_framework_options[] = array(
	'name'   => 'titlebar_settings', // like ID
	'title'  => esc_attr__('Titlebar Settings', 'acadevo'),
	'icon'   => 'fa fa-align-justify',
	'fields' => array( // begin: fields
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Titlebar Background Options', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Background options for Titlebar area', 'acadevo').'</small>',
		),
		array(
			'id'            => 'titlebar_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Titlebar Background Color', 'acadevo'),
			'options'  => array(
							'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
							'grey'       => esc_attr__('Grey', 'acadevo'),
							'white'      => esc_attr__('White', 'acadevo'),
							'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
							'custom'     => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'custom',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Titlebar background color', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'titlebar_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Titlebar Background Image', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background for Title bar. You can set color or image and also set other background related properties', 'acadevo').'</div>',
			'color'			=> true,
			'default'		=> array(
				'image'			=> get_template_directory_uri() . '/images/titlebar-bg.jpg',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center center',
				'attachment'	=> 'scroll',
				'size'			=> 'cover',
				'color'			=> 'rgba(0,0,0,0.01)',
			),
			'output' 	    => 'div.tm-titlebar-wrapper',
			'output_bglayer'    => true,  // apply color to bglayer class div inside this , default: true
			'color_dropdown_id' => 'titlebar_bg_color',   // color dropdown to decide which color
        ),
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Titlebar Font Settings', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Font Settings for different elements in Titlebar area', 'acadevo').'</small>',
		),
		array(
			'id'            => 'titlebar_text_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Titlebar Text Color', 'acadevo'),
			'options'  => array(
							'white'  => esc_attr__('White', 'acadevo'),
							'dark'   => esc_attr__('Dark', 'acadevo'),
							'custom' => esc_attr__('Custom Color', 'acadevo'),
						),
			'default'       => 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
        ),
		array(
			'id'             => 'titlebar_heading_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Heading Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => '.tm-titlebar h1.entry-title, .tm-titlebar-textcolor-custom .tm-titlebar-main .entry-title', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> '700',
				'font-size'			=> '50',
				'line-height'		=> '55',
				'letter-spacing'	=> '0',
				'text-transform'	=> 'capitalize',
				'color'				=> '#033b4a',
				'font'				=> 'google',
			),
			'after'			=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for heading in Titlebar', 'acadevo').'</div>',
		),
		array(
			'id'             => 'titlebar_subheading_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Sub-heading Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => '.tm-titlebar .entry-subtitle, .tm-titlebar-textcolor-custom .tm-titlebar-main .entry-subtitle', // An array of CSS selectors to apply this font style to dynamically
			'units'			 => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '16',
				'line-height'		=> '27',
				'letter-spacing'	=> '0',
				'text-transform'	=> 'none',
				'color'				=> '#9dabaf',
				'font'				=> 'google',
			),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for sub-heading in Titlebar', 'acadevo').'</div>',
		),
		array(
			'id'             => 'titlebar_breadcrumb_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Breadcrumb Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => '.tm-titlebar .breadcrumb-wrapper, .tm-titlebar .breadcrumb-wrapper a', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'text-transform'	=> 'capitalize',
				'font-size'			=> '18',
				'line-height'		=> '30',
				'letter-spacing'	=> '0',
				'color'				=> '#9dabaf',
				'font'				=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select font family, size etc. for breadcrumbs in Titlebar', 'acadevo').'</div>',
		),
		
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Titlebar Content Options', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Content options for Titlebar area', 'acadevo').'</small>',
		),
		array(
			'id'            => 'titlebar_view',
			'type'          => 'select',
			'title'         =>  esc_attr__('Titlebar Text Align', 'acadevo'),
			'options'       => array(
							'default'  => esc_attr__('All Center (default)', 'acadevo'),
							'left'     => esc_attr__('Title Left / Breadcrumb Right', 'acadevo'),
							'right'    => esc_attr__('Title Right / Breadcrumb Left', 'acadevo'),
							'allleft'  => esc_attr__('All Left', 'acadevo'),
							'allright' => esc_attr__('All Right', 'acadevo'),
			),
			'default'       => 'default',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select text align in Titlebar', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'titlebar_height',
			'type'   		 => 'number',
			'title'          => esc_attr__( 'Titlebar Height', 'acadevo' ),
			'after'  	  	 => ' px<br><div class="cs-text-muted">'.esc_attr__('Set height of the Titlebar. In pixel only', 'acadevo').'</div>',
			'default'		 => '273',
        ),
		array(
			'id'        	=> 'breadcrumb_on_bottom',
			'type'      	=> 'checkbox',
			'title'     	=> esc_attr__('Show Breadcrumb on bottom of Titlebar area', 'acadevo'),
			'label'     	=> esc_attr__('YES', 'acadevo'),
			'default'   	=> false,
			'dependency'  	=> array( 'titlebar_view', 'any', 'default,allleft,allright' ),//Multiple dependency
			'after'    		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select this option if you like to show breadcrumbs on bottom of Titlebar area. This option will only work when Titlebar Text Align option above is set to (All Center, All Left or All Right)', 'acadevo').'</div>',
		),
		array(
			'id'            => 'breadcum_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Breadcrumb Background Color', 'acadevo'),
			'options'  => array(
							'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
							'grey'       => esc_attr__('Grey', 'acadevo'),
							'white'      => esc_attr__('White', 'acadevo'),
							'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
							'custom'     => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'custom',
			'dependency' 	=> array( 'breadcrumb_on_bottom', '==|==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for breadcrumb background color', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'breadcrumb_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Breadcrumb Custom Background Color', 'acadevo' ),
			'default'		 => 'rgba(0,0,0,0.50)',
			'dependency'  	 => array( 'breadcrumb_on_bottom|breadcum_bg_color', '==|==', 'true|custom' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Breadcrumb', 'acadevo').'</div>',
        ),
		array(
			'id'            => 'titlebar_hide_breadcrumb',
			'type'          => 'select',
			'title'         =>  esc_attr__('Hide Breadcrumb', 'acadevo'),
			'options'  => array(
							'no'   => esc_attr__('NO, show the breadcrumb', 'acadevo'),
							'yes'  => esc_attr__('YES, Hide the Breadcrumb', 'acadevo'),
			),
			'default'       => 'no',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('You can show or hide the breadcrumb', 'acadevo').'</div>',
		),
		
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Titlebar Extra Options', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Change settings for some extra options in Titlebar', 'acadevo').'</small>',
		),
		array(
			'id'      => 'adv_tbar_catarc',
			'type'    => 'text',
			'title'   => esc_attr__('Post Category "Category Archives:" Label Text', 'acadevo'),
			'default' => esc_attr__('Category Archives: ', 'acadevo'),
		),
		array(
			'id'      => 'adv_tbar_tagarc',
			'type'    => 'text',
			'title'   => esc_attr__('Post Tag "Tag Archives:" Label Text', 'acadevo'),
			'default' => esc_attr__('Tag Archives: ', 'acadevo'),
		),
		array(
			'id'      => 'adv_tbar_postclassified',
			'type'    => 'text',
			'title'   => esc_attr__('Post Taxonomy "Posts classified under:" Label Text', 'acadevo'),
			'default' => esc_attr__('Posts classified under: ', 'acadevo'),
		),
		array(
			'id'      => 'adv_tbar_authorarc',
			'type'    => 'text',
			'title'   => esc_attr__('Post Author "Author Archives:" Label Text', 'acadevo'),
			'default' => esc_attr__('Author Archives: ', 'acadevo'),
		),

	)
);


// Header Settings
$tm_framework_options[] = array(
	'name'   => 'header_settings', // like ID
	'title'  => esc_attr__('Header Settings', 'acadevo'),
	'icon'   => 'fa fa-arrow-up',
	'fields' => array( // begin: fields
	
		array(
			'type'    		=> 'heading',
			'content'		=> esc_attr__('Header Settings', 'acadevo'),
        ),
		array(
			'id'     		 => 'header_height',
			'type'   		 => 'number',
			'title'          => esc_attr__('Header Height (in pixel)', 'acadevo' ),
			'after'  	  	 => '<div class="cs-text-muted"><br>'.esc_attr__('You can set height of header area from here', 'acadevo').'</div>',
			'default'		 => '100',
        ),
		array(
			'id'            => 'header_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Header Background Color', 'acadevo'),
			'options'  => array(
							'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
							'grey'       => esc_attr__('Grey', 'acadevo'),
							'white'      => esc_attr__('White', 'acadevo'),
							'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
							'custom'     => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Header background color', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'header_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Header Custom Background Color', 'acadevo' ),
			'default'		 => 'rgba(18, 29, 48, 0.5)',
			'dependency'  	 => array( 'header_bg_color', '==', 'custom' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Header', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'vertical_header_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Header Background Properties', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background for Header. You can set color or image and also set other background related properties', 'acadevo').'</div>',
			'dependency'  	=> array( 'header_style', 'any', 'classic-vertical' ),
			'default'		=> array(
				'image'			=> '',
				'size'			=> 'cover',
				'color'			=> 'rgba(0,0,0,0.01)',
			),
			'output' 	    => '.tm-header-style-classic-vertical .site-header',
        ),
		array(
			'id'     		 => 'responsive_header_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Responsive Header Custom Background Color', 'acadevo' ),
			'default'		 => '#121d30',
			'dependency'  	 => array( 'header_bg_color|header_style', '==|any', 'custom|classic-overlay,centerlogo-overlay,toplogo-overlay,classic-box-overlay,classic-box-overlay-rtl,classic-overlay-rtl,infostack-overlay,infostack-overlay-rtl' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Header in responsive mode only. Like Mobile, tablet etc small screen devices.', 'acadevo').'</div>',
        ),
		array(
			'id'            => 'header_responsive_icon_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Header Responsive Icon Color', 'acadevo'),
			'options'  => array(
							'dark'   => esc_attr__('Dark', 'acadevo'),
							'white'  => esc_attr__('White', 'acadevo'),
			),
			'default'       => 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select color for responsive menu icon, cart icon, search icon. This is becuase PHP code cannot understand if you selected dark or light color as background. Will work in responsive only.', 'acadevo').'</div>',
			'dependency'    => array( 'header_bg_color', '==', 'custom' ),//Multiple dependency
        ),
		array(
          'id'      	 	 => 'logotype',
          'type'     		 => 'radio',
          'title'    		 => esc_attr__('Logo type', 'acadevo'), 
          'options' 		 => array( 
								'text' => esc_attr__('Logo as Text', 'acadevo'), 
								'image' => esc_attr__('Logo as Image', 'acadevo') 
							),
          'default'  		 => 'image',
          'after'  			 => '<div class="cs-text-muted"><br>'.esc_attr__('Specify the type of logo. It can Text or Image', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'logotext',
			'type'    		 => 'text',
			'title'   		 => esc_attr__('Logo Text', 'acadevo'),
			'default' 		 => 'Acadevo',
			'dependency'  	 => array( 'logotype_text', '==', 'true' ),
			'after'  			 => '<div class="cs-text-muted"><br>'.esc_attr__('Enter the text to be used instead of the logo image', 'acadevo').'</div>',
		),
		array(
			'id'             => 'logo_font',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Logo Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => '.headerlogo a.home-link', // An array of CSS selectors to apply this font style to dynamically
			'default'        => array(
				'family'		 => 'Arimo',
				'backup-family'	 => 'Arial, Helvetica, sans-serif',
				'variant'		 => 'regular',
				'font-size'		 => '26',
				'line-height'	 => '27',
				'letter-spacing' => '0',
				'color'			 => '#202020',
				'font'			 => 'google',
			),
			'dependency'  	=> array( 'logotype_text', '==', 'true' ),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('This will be applied to logo text only. Select Logo font-style and size', 'acadevo').'</div>',
		),
		
		array(
			'id'       		 => 'logoimg',
			'type'     		 => 'themetechmount_image',
			'title'    		 => esc_attr__('Logo Image', 'acadevo'),
			'dependency'  	 => array( 'logotype_image', '==', 'true' ),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Upload image that will be used as logo for the site ', 'acadevo') . sprintf(__('%1$sNOTE:%2$s Upload image that will be used as logo for the site', 'acadevo'),'<strong>', '</strong>').'</div>',
			'add_title'		 => esc_attr__('Upload Site Logo','acadevo'),
			'default'		 => array(
					'thumb-url'	=> get_template_directory_uri() . '/images/logo.png',
					'full-url'	=> get_template_directory_uri() . '/images/logo.png',
			),
        ),
		array(
			'id'     		 => 'logo_max_height',
			'type'   		 => 'number',
			'title'          => esc_attr__('Logo Max Height', 'acadevo' ),
			'after'  	  	 => '<div class="cs-text-muted"><br>'.esc_attr__('If you feel your logo looks small than increase this and adjust it', 'acadevo').'</div>',
			'default'		 => '46',
			'dependency'  	 => array( 'logotype_image', '==', 'true' ),
        ),
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Sticky Header', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options for sticky header', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'sticky_header',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Enable Sticky Header', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Select ON if you want the sticky header on page scroll', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'header_height_sticky',
			'type'   		 => 'number',
			'title'          => esc_attr__('Sticky Header Height (in pixel)', 'acadevo' ),
			'after'  	  	 => '<div class="cs-text-muted"><br>'.esc_attr__('You can set height of header area when it becomes sticky', 'acadevo').'</div>',
			'default'		 => '70',
			'dependency'     => array( 'sticky_header', '==', 'true' ),
        ),
		array(
			'id'            => 'sticky_header_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Sticky Header Background Color', 'acadevo'),
			'options'  => array(
							'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
							'grey'       => esc_attr__('Grey', 'acadevo'),
							'white'      => esc_attr__('White', 'acadevo'),
							'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
							'custom'     => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'white',
			'dependency'    => array( 'sticky_header', '==', 'true' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Sticky Header background color', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'sticky_header_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Sticky Header Custom Background Color', 'acadevo' ),
			'default'		 => 'rgba(21,21,21,0.96)',
			'dependency'  	 => array( 'sticky_header_bg_color|sticky_header', '==|==', 'custom|true' ),//Multiple dependency
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Sticky Header', 'acadevo').'</div>',
        ),
		array(
			'id'       		 => 'logoimg_sticky',
			'type'     		 => 'themetechmount_image',
			'title'    		 => esc_attr__('Logo Image for Sticky Header', 'acadevo'),
			'dependency'  	 => array( 'sticky_header|logotype_image', '==|==', 'true|true' ),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Upload image that will be used as logo for sticky header', 'acadevo').'</div>',
			'add_title'		 => esc_attr__('Upload Sticky Logo','acadevo'),
		),
		array(
			'id'     		 => 'logo_max_height_sticky',
			'type'   		 => 'number',
			'title'          => esc_attr__('Logo Max Height when Sticky Header', 'acadevo' ),
			'after'  	  	 => '<div class="cs-text-muted"><br>'.esc_attr__('Set logo when the header is sticky', 'acadevo').'</div>',
			'default'		 => '35',
			'dependency'     => array( 'sticky_header', '==', 'true' ),
        ),
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Search Button in Header', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Option to show or hide search button in header area', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'header_search',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Search Button', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Set this option "ON" to show search button in header. The icon will be at the right side (after menu)', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'search_input',
			'type'    		 => 'text',
			'title'   		 => esc_attr__('Search Form Input Word', 'acadevo'),
			'default' 		 => esc_attr__('Type Word Then Enter..', 'acadevo'),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Write the search form input word here. Default: "Type Word Then Enter.."', 'acadevo').'</div>',
			'dependency'     => array( 'header_search', '==', 'true' ),
		),
		array(
			'id'     		 => 'searchform_title',
			'type'    		 => 'text',
			'title'   		 => esc_attr__('Search Form Title', 'acadevo'),
			'default' 		 => esc_attr__('Hi, How Can We Help You?', 'acadevo'),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Write the title for search form. Default: "Hi, How Can We Help You?"', 'acadevo').'</div>',
			'dependency'     => array( 'header_search', '==', 'true' ),
		),
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Header Style', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options to change header style', 'acadevo').'</small>',
		),
		array(
			'id'			=> 'headerstyle',
			'type' 			=> 'image_select',//themetechmount_pre_color_packages
			'title'			=> esc_attr__('Select Header Style', 'acadevo'),
			'desc'     		=> esc_attr__('Please select header style', 'acadevo'),
			'wrap_class'    => 'tm-header-style',
			'options'      	=> array(
				'classic-highlight'       => get_template_directory_uri() . '/inc/images/header-classic.png',	
				'classic-overlay'         => get_template_directory_uri() . '/inc/images/header-classic-overlay.png',
				'infostack'               => get_template_directory_uri() . '/inc/images/header-infostack.png',	
				'infostack-overlay'       => get_template_directory_uri() . '/inc/images/header-infostack-overlay.png',				
			),
			'default'		=> 'classic-highlight',
			'attributes' 	=> array(
			'data-depend-id' => 'header_style'
			),
			'radio' 		=> true,//This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
        ),
		array(
			'type'    		=> 'heading',
			'content'		=> esc_attr__('Special options for selected header', 'acadevo'),
			'dependency'  	 => array( 'header_style', 'any', 'classic,classic2,classic-overlay,classic-box-overlay,classic-rtl,classic-overlay-rtl,toplogo,toplogo-overlay,centerlogo,centerlogo-overlay,infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl,classic-vertical,classic-highlight' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
			'after'  	  	 => '<small>'.esc_attr__('These options will appear for selected header style only.', 'acadevo').'</small>',
        ),
		array(
			'id'       		 => 'header_text',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('Header Text Area', 'acadevo'),
			'shortcode'		 => true,
			'dependency'  	 => array( 'header_style', 'any', 'classic,classic2,classic-overlay,classic-rtl,classic-overlay-rtl,classic-highlight' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear before Search/Cart icon in header area. This option will work for currently selected header style only', 'acadevo').'</div>',
			'default'        => '',
        ),
		array(
			'id'            => 'header_menu_position',
			'type'          => 'select',
			'title'         =>  esc_attr__('Header Menu Position', 'acadevo'),
			'options'  		=> array(
								'left'		=> esc_attr__('Left Align', 'acadevo'),
								'right'		=> esc_attr__('Right Align', 'acadevo'),
								'center'	=> esc_attr__('Center Align', 'acadevo'),
							),
			'default'       => 'right',
			'dependency'  	=> array( 'header_style', 'any', 'classic,classic-overlay,classic-highlight,classicinfo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select Menu Position. This option will work for currently selected header style only ', 'acadevo').'</div>',
        ),
		
		array(
			'id'       		 => 'infostack_column_one',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('InfoStack First Column Content', 'acadevo'),
			'shortcode'		 => true,
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear on first column', 'acadevo').'</div>',
			'default'        => '<div class="header-icon"> <div class="icon"><i class="fa fa-user-md"></i></div></div><div class="header-content"><h3>Personal Cabinet</h3><h5>Qualified Staff</h5></div>',
			'dependency'  	 => array( 'header_style', 'any', 'infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl,classicinfo' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
		),
		array(
			'id'       		 => 'infostack_column_two',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('InfoStack Second Column Content', 'acadevo'),
			'shortcode'		 => true,
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear on second column', 'acadevo').'</div>',
			'default'        => '<div class="header-icon"> <div class="icon"><i class="fa fa-thumbs-o-up"></i></div></div><div class="header-content"><h3>Get Result Online</h3><h5>Satisfied Patients</h5></div>',
			'dependency'  	 => array( 'header_style', 'any', 'infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl,classicinfo' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
		),
		array(
			'id'       		 => 'infostack_column_three',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('InfoStack Third Column Content', 'acadevo'),
			'shortcode'		 => true,
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear on third column', 'acadevo').'</div>',
			'default'        => '[tm-btn title="GET APPOINTMENT!" style="flat" shape="square" color="skincolor" link="url:%23|||"]',
			'dependency'  	 => array( 'header_style', 'any', 'infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl,classicinfo' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
		),
		array(
			'id'       		 => 'infostack_phone_text',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('InfoStack Right Content', 'acadevo'),
			'shortcode'		 => true,
			'desc'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('This content will appear after menu', 'acadevo').'</div>',
			'default'        => '',
			'dependency'  	 => array( 'header_style', 'any', 'infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl,classicinfo' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
		),
		
		
		array(
			'type'    		=> 'notice',
			'class'   		=> 'info',
			'content'		=> '<p><strong>' . esc_attr__('Change widget content of the header', 'acadevo') . '</strong> <br> ' . esc_attr__('You can change widgets content in the header area from Widgets section. Just go to "Appearance > Widgets" and modify widgets under "InfoStack header widgets" position.', 'acadevo') . '</p>',
			'dependency'  	 => array( 'header_style', 'any', 'infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl' ), // This dependency was not working normally so had to define radio to it with attributes id more on this link https://github.com/Codestar/codestar-framework/issues/52
        ),
		array(
			'id'            => 'header_widget_text_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Header Widget Text Color', 'acadevo'),
			'options'  => array(
							'dark'   => esc_attr__('Dark', 'acadevo'),
							'white'  => esc_attr__('White', 'acadevo'),
			),
			'default'       => 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select color for Widgets text for Overlay header style. This is because the background is transparent so you should set it.', 'acadevo').'</div>',
			'dependency'    => array( 'header_bg_color|header_style', '==|any', 'custom|infostack-overlay,infostack-overlay-rtl' ),//Multiple dependency
        ),
		array(
			'id'     		 => 'header_menuarea_height',
			'type'    		 => 'number',
			'title'   		 => esc_attr__('Menu area height', 'acadevo'),
			'default' 		 => '60',
			'after'          => esc_attr(' px'),
			'attributes'     => array(
			'min'       	 => 40,
			),
			'subtitle'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Height for menu area only', 'acadevo').'</div>',
			'dependency'     => array( 'header_style', 'any', 'toplogo,toplogo-overlay,infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl' ),
		),		
		array(
			'id'            => 'header_menu_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Header Menu Background Color', 'acadevo'),
			'options'  		=> array(
								'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
								'grey'       => esc_attr__('Grey', 'acadevo'),
								'white'      => esc_attr__('White', 'acadevo'),
								'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
								'custom'     => esc_attr__('Custom Color', 'acadevo'),
							),
			'default'       => 'darkgrey',
			'dependency'	=> array( 'header_style', 'any', 'toplogo,toplogo-overlay,infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined background color for Menu area in header', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'header_menu_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Header Menu Background Custom Background Color', 'acadevo' ),
			'default'		 => 'rgba(0,0,0,0.31)',
			'dependency'  	 => array( 'header_menu_bg_color|header_style', '==|any', 'custom|toplogo,toplogo-overlay,infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl' ),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Header Menu area', 'acadevo').'</div>',
        ),
        array(
			'id'            => 'sticky_header_menu_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Sticky Header Menu Background Color', 'acadevo'),
			'options'  		=> array(
								'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
								'grey'       => esc_attr__('Grey', 'acadevo'),
								'white'      => esc_attr__('White', 'acadevo'),
								'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
								'custom'     => esc_attr__('Custom Color', 'acadevo'),
							),
			'default'       => 'darkgrey',
			'dependency'	=> array( 'header_style', 'any', 'toplogo,toplogo-overlay,infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined background color for Menu area in header when header is sticky', 'acadevo').'</div>',
        ),
		array(
			'id'     		 => 'sticky_header_menu_bg_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Sticky Header Menu Background Custom Background Color', 'acadevo' ),
			'default'		 => 'rgba(129,215,66,0.7)',
			'dependency'  	 => array( 'sticky_header_menu_bg_color|header_style', '==|any', 'custom|toplogo,toplogo-overlay,infostack,infostack-rtl,infostack-overlay,infostack-overlay-rtl' ),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Header Menu area when header is sticky', 'acadevo').'</div>',
        ),
			
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Logo SEO', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options for Logo SEO', 'acadevo').'</small>',
		),
		array(
			'id'      		=> 'logoseo',
			'type'   		=> 'radio',
			'title'   		=> esc_attr__('Logo Tag for SEO', 'acadevo'),
			'options' 		=> array(
								'h1homeonly' => esc_attr__('H1 for home, SPAN on other pages', 'acadevo'),
								'allh1'      => esc_attr__('H1 tag everywhere', 'acadevo'),
							),
			'default'		=> 'h1homeonly',
			'after'  	  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select logo tag for SEO purpose', 'acadevo').'</div>',
        ),
	
		
	)
);


// Menu Settings
$tm_framework_options[] = array(
	'name'   => 'menu_settings', // like ID
	'title'  => esc_attr__('Menu Settings', 'acadevo'),
	'icon'   => 'fa fa-bars',
	'fields' => array( // begin: fields
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Menu Settings', 'acadevo'),
			'after'  	  	=> '<small>'.esc_attr__('Responsive Menu Breakpoint: Change Options for responsive menu.', 'acadevo').'</small>',
		),
		array(
			'id'      		=> 'menu_breakpoint',
			'type'   		=> 'radio',
			'title'   		=> esc_attr__('Responsive Menu Breakpoint', 'acadevo'),
			'options'  		=> array(
								'1200'   => esc_attr__('Large devices','acadevo').' <small>'.esc_attr__('Desktops (>1200px)', 'acadevo').'</small>',
								'992'    => esc_attr__('Medium devices','acadevo').' <small>'.esc_attr__('Desktops and Tablets (>992px)', 'acadevo').'</small>',
								'768'    => esc_attr__('Small devices','acadevo').' <small>'.esc_attr__('Mobile and Tablets (>768px)', 'acadevo').'</small>',
								'custom' => esc_attr__('Custom (select pixel below)', 'acadevo'),
						),
			'default'		=> '1200',
			'after'  	  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Change options for responsive menu breakpoint', 'acadevo').'</div>',
        ),
		
		array(
			'id'     		=> 'megamenu-override',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Override Max Mega Menu Style', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('We need to override some of the Max mega Menu plugin\'s settings to match with our theme. If you like to use the default vanilla look of Max Mega Menu than turn this option off.', 'acadevo').'</div>',
        ),
		
		array(
			'id'     		 => 'menu_breakpoint-custom',
			'type'   		 => 'number',
			'title'          => esc_attr__('Custom Breakpoint for Menu (in pixel)', 'acadevo' ),
			'dependency'  	 => array( 'menu_breakpoint_custom', '==', 'true' ),
			'default'		 => '1200',
			'after'  	  	 => '<div class="cs-text-muted"><br>'.esc_attr__('Select after how many pixels the menu will become responsive', 'acadevo').'</div>',
        ),
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Main Menu Options', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options for main menu in header', 'acadevo').'</small>',
		),
		array(
			'id'             => 'mainmenufont',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Main Menu Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => '#site-header-menu #site-navigation div.nav-menu > ul > li > a, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal > li.mega-menu-item > a', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'text-transform'	=> 'capitalize',
				'font-size'			=> '17',
				'line-height'		=> '21',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select main menu font, color and size', 'acadevo').'</div>',
		),
		
		
		
		array(
			'id'     		 => 'stickymainmenufontcolor',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Main Menu Font Color for Sticky Header', 'acadevo' ),
			'default'		 => '#131d3b',
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Main menu font color when the header becomes sticky', 'acadevo').'</div>',
        ),
		array(
			'id'           	=> 'mainmenu_active_link_color',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Main Menu Active Link Color', 'acadevo'),
			'options'  		=> array(
				'skin'			=> esc_attr__('Skin color (default)', 'acadevo'),
				'custom'		=> esc_attr__('Custom color (select below)', 'acadevo'),
			),
			'default'      	=> 'skin',
			'after'  		=> '<div class="cs-text-muted"><br>
									<strong>' . esc_attr__('Tips:', 'acadevo') . '</strong>
									<ul>
										<li>' . esc_attr__('"Skin color (default):" Skin color for active link color.', 'acadevo') . '</li>
										<li>' . esc_attr__('"Custom color:" Custom color for active link color. Useful if you like to use any color for active link color.', 'acadevo') . '</li>
									</ul>
								</div>',
        ),
		array(
			'id'     		 => 'mainmenu_active_link_custom_color',
			'type'   		 => 'color_picker',
			'title'  		 => esc_attr__('Main Menu Active Link Custom Color', 'acadevo' ),
			'default'		 => '#ffffff',
			'dependency'  	 => array( 'mainmenu_active_link_color', '==', 'custom' ),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom color for main menu active active link', 'acadevo').'</div>',
        ),
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Drop Down Menu Options', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options for drop down menu in header', 'acadevo').'</small>',
		),
		array(
			'id'             => 'dropdownmenufont',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('Dropdown Menu Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => 'ul.nav-menu li ul li a, div.nav-menu > ul li ul li a, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a:hover, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a:focus, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link:hover, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu a.mega-menu-link:focus, .tm-mmmenu-override-yes #site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item-type-widget', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '15',
				'line-height'		=> '18',
				'letter-spacing'	=> '0',
				'color'				=> '#666d81',
				'font'				=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select dropdown menu font, color and size', 'acadevo').'</div>',
		),
		
		
		array(
			'id'           	=> 'dropmenu_active_link_color',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Dropdown Menu Active Link Color', 'acadevo'),
			'options'  		=> array(
				'skin'			=> esc_attr__('Skin color (default)', 'acadevo'),
				'custom'		=> esc_attr__('Custom color (select below)', 'acadevo'),
			),
			'default'      	=> 'custom',
			'after'  		=> '<div class="cs-text-muted"><br>' . '<strong>' . esc_attr__('Tips:', 'acadevo') . '</strong>' . '<ul><li>' . esc_attr__('"Skin color (default):" Skin color for active link color.', 'acadevo') . '</li><li>' . esc_attr__('"Custom color:" Custom color for active link color. Useful if you like to use any color for active link color.', 'acadevo') . '</li></ul></div>',
        ),
		array(
			'id'     		=> 'dropmenu_active_link_custom_color',
			'type'   		=> 'color_picker',
			'title'  		=> esc_attr__('Dropdown Menu Active Link Custom Color', 'acadevo' ),
			'default'		=> '#ffffff',
			'dependency'  	=> array( 'dropmenu_active_link_color', '==', 'custom' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Custom color for dropdown menu active menu text', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'dropmenu_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Dropdown Menu Background Properties (for all dropdown menus)', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background for dropdown menu. This will be applied to all dropdown menus. You can set common style here.', 'acadevo').'</div>',
			'default'		=> array(
				'image'			=> '',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center top',
				'size'			=> 'cover',
				'color'			=> '#ffffff',
			),
			'output' 	    => '.tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item ul.mega-sub-menu, #site-header-menu #site-navigation div.nav-menu > ul > li ul',
        ),
		array(
			'id'      		=> 'dropdown_menu_separator',
			'type'   		=> 'radio',
			'title'   		=> esc_attr__('Separator line between dropdown menu links', 'acadevo'),
			'options'  		=> array(
								'grey'  => esc_attr__('Grey color as border color (default)', 'acadevo'),
								'white' => esc_attr__('White color as border color (for dark background color)', 'acadevo'),
								'no'    => esc_attr__('No separator border', 'acadevo'),
							),
			'default'		=> 'grey',
			'after'  	  	=> '<div class="cs-text-muted"><br> <strong>' . esc_attr__('Tips:', 'acadevo') . '</strong>
								<ul>
									<li>' . esc_attr__('"Grey color as border color (default):" This is default border view.', 'acadevo') . '</li>
									<li>' . esc_attr__('"White color:" Select this option if you are going to select dark background color (for dropdown menu)', 'acadevo') . '</li>
									<li>' . esc_attr__('"No separator border:" Completely remove border. This will make your menu totally flat', 'acadevo') . '</li>
								</ul></div>',
        ),
		array(
			'id'             => 'megamenu_widget_title',
			'type'           => 'themetechmount_typography', 
			'title'          => esc_attr__('MegaMenu Widget Title Font', 'acadevo'),
			'chosen'         => false,
			'text-align'     => false,
			'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'    => true, // Select a backup non-google font in addition to a google font
			'subsets'        => false, // Only appears if google is true and subsets not set to false
			'line-height'    => true,
			'text-transform' => true,
			'word-spacing'   => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'color'          => true,
			'all-varients'   => false,
			'output'         => '#site-header-menu #site-navigation .mega-menu-wrap .mega-menu.mega-menu-horizontal .mega-sub-menu > li.mega-menu-item > h4.mega-block-title', // An array of CSS selectors to apply this font style to dynamically
			'units'          => 'px', // Defaults to px
			'default'        => array(
				'family'			=> 'Roboto Condensed',
				'backup-family'		=> 'Arial, Helvetica, sans-serif',
				'variant'			=> 'regular',
				'font-size'			=> '18',
				'line-height'		=> '22',
				'letter-spacing'	=> '0',
				'color'				=> '#131d3b',
				'font'				=> 'google',
			),
			'after'  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Font settings for mega menu widget title. NOTE: This will work only if you installed "Max Mega Menu" plugin and also activated in the main (primary) menu', 'acadevo').'</div>',
		),
		
		array(
			'type'       	 => 'heading',
			'content'    	 => '',
			'after'  	  	 => '<strong>'.esc_attr__('Individual Drop Down Menu Options', 'acadevo').'</strong>',
		),
		array(
			'id'      		=> 'dropmenu_background_1',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('First dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for first dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(1) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(1) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(1) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(1) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_2',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Second dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for second dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(2) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(2) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(2) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(2) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_3',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Third dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for third dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(3) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(3) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(3) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(3) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_4',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Fourth dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for fourth dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(4) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(4) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(4) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(4) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_5',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Fifth dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for fifth dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(5) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(5) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(5) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(5) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_6',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Sixth dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for sixth dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(6) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(6) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(6) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(6) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_7',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Seventh dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for seventh dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(7) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(7) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(7) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(7) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_8',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Eighth dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for eighth dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(8) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(8) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(8) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(8) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_9',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Ninth dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for ninth dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(9) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(9) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(9) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(9) ul.mega-sub-menu:before',
        ),
		array(
			'id'      		=> 'dropmenu_background_10',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Tenth dropdown menu background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>' . esc_attr__('Set background for tenth dropdown menu.', 'acadevo') . '</div>',
			'output' 	    => '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(10) ul, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(10) ul.mega-sub-menu',
			'bg_layer_class'	=> '#site-header-menu #site-navigation div.nav-menu > ul > li:nth-child(10) ul:before, .tm-mmmenu-override-yes #site-header-menu #site-navigation div.mega-menu-wrap ul.mega-menu.mega-menu-horizontal li.mega-menu-item:nth-child(10) ul.mega-sub-menu:before',
        ),
		
	)
);





// Footer Settings
$tm_framework_options[] = array(
	'name'   => 'footer_settings', // like ID
	'title'  => esc_attr__('Footer Settings', 'acadevo'),
	'icon'   => 'fa fa-arrow-down',
	'fields' => array( // begin: fields
		array(
			'type'			=> 'heading',
			'content'    	=> esc_attr__('Sticky Footer', 'acadevo'),
			'after'  	  	=> '<small>'.esc_attr__('Make footer sticky and visible on scrolling at bottom', 'acadevo').'</small>',
        ),
		array(
			'id'     		=> 'stickyfooter',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Sticky Footer', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Set this option "ON" to enable sticky footer on scrolling at bottom', 'acadevo').'</div>',
        ),
		
		// Footer Call To Action Box 
				array(
					'type'       	 => 'heading',
					'content'    	 => esc_attr__('Footer Call To Action Box', 'acadevo'),
					'after'  	  	 => '<small>'.esc_attr__('Modify Title, SUb Title, icon, button link, button title etc in footer Call To Action Box here.', 'acadevo').'</small>',
				),
				array(
					'id'     		=> 'footer_cta_box',
					'type'   		=> 'switcher',
					'title'   		=> esc_attr__('Show Footer Call To Action', 'acadevo'),
					'default' 		=> false,
					'label'  		=> '<div class="cs-text-muted cs-text-desc">'.esc_attr__('Set this option "ON" to enable call to action box in footer', 'acadevo').'</div>',
				),
				array(
					'id'			=> 'footer_cta_column_layout',
					'type' 			=> 'image_select',//themetechmount_pre_color_packages
					'title'			=> esc_attr__('Footer CTA Columns', 'acadevo'),
					'options'      	=> array(
							'12'      => get_template_directory_uri() . '/inc/images/footer_col_12.png',
							'6_6'     => get_template_directory_uri() . '/inc/images/footer_col_6_6.png',
							'4_4_4'   => get_template_directory_uri() . '/inc/images/footer_col_4_4_4.png',
					),
					'default'		=> '6_6',
					'dependency' 	=> array( 'footer_cta_box', '==', 'true' ),
					'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select Footer CTA Column layout.', 'acadevo').'</div>',
				),
				array(
					'id'     		=> 'footer_cta_box_column1',
					'type'    		=> 'textarea',
					'shortcode'		 => true,
					'title'   		=> esc_attr__('CTA First Column Content', 'acadevo'),
					'after'  		=> '<div class="cs-text-muted cs-text-desc">' . esc_attr__('This content will appear on first column', 'acadevo') . '</div>',
					'dependency' 	=> array( 'footer_cta_box', '==', 'true' ),
				),
				array(
					'id'     		=> 'footer_cta_box_column2',
					'type'    		=> 'textarea',
					'shortcode'		 => true,
					'title'   		=> esc_attr__('CTA Second Column Content', 'acadevo'),
					'after'  		=> '<div class="cs-text-muted cs-text-desc">' . esc_attr__('This content will appear on second column', 'acadevo') . '</div>',
					'dependency' 	=> array( 'footer_cta_box', '==', 'true' ),
				),
				array(
					'id'     		=> 'footer_cta_box_column3',
					'type'    		=> 'textarea',
					'shortcode'		 => true,
					'title'   		=> esc_attr__('CTA Third Column Content', 'acadevo'),
					'after'  		=> '<div class="cs-text-muted cs-text-desc">' . esc_attr__('This content will appear on third column', 'acadevo') . '</div>',
					'dependency' 	=> array( 'footer_cta_box', '==', 'true' ),
				),
				array(
					'id'            => 'footer_cta_bg_color',
					'type'          => 'select',
					'title'         =>  esc_attr__('Footer CTA Background Color', 'acadevo'),
					'options'  		=> array(
										'darkgrey'   => esc_attr__('Dark grey', 'acadevo'),
										'grey'       => esc_attr__('Grey', 'acadevo'),
										'white'      => esc_attr__('White', 'acadevo'),
										'skincolor'  => esc_attr__('Skincolor', 'acadevo'),
										'custom'     => esc_attr__('Custom Color', 'acadevo'),
									),
					'default'       => 'white',
					'dependency' 	=> array( 'footer_cta_box', '==', 'true' ),
					'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Footer CTA background color', 'acadevo').'</div>',
				),
				array(
					'id'     		 => 'footer_cta_bg_custom_color',
					'type'   		 => 'color_picker',
					'title'  		 => esc_attr__('Footer CTA Custom Background Color', 'acadevo' ),
					'default'		 => 'grey',
					'dependency'  	 => array( 'footer_cta_box|footer_cta_bg_color', '==|==', 'true|custom' ),//Multiple dependency
					'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Custom background color for Footer CTA', 'acadevo').'</div>',
				),
				array(
					'id'            => 'footer_cta_text_color',
					'type'          => 'select',
					'title'         =>  esc_attr__('Footer CTA Text Color', 'acadevo'),
					'options'  => array(
									'white'     => esc_attr__('White', 'acadevo'),
									'dark'      => esc_attr__('Dark', 'acadevo'),
									'skincolor' => esc_attr__('Skin Color', 'acadevo'),
								),
					'default'       => 'dark',
					'dependency' 	=> array( 'footer_cta_box', '==', 'true' ),
					'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
				),
				
		// Footer common background
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Footer Background (full footer elements)', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('This background property will apply to full footer area. You can add', 'acadevo').'</small>',
		),
		array(
			'id'            => 'full_footer_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Footer Background Color (all area)', 'acadevo'),
			'options'		=> array(
				'transparent' => esc_attr__('Transparent', 'acadevo'),
				'darkgrey'    => esc_attr__('Dark grey', 'acadevo'),
				'grey'        => esc_attr__('Grey', 'acadevo'),
				'white'       => esc_attr__('White', 'acadevo'),
				'skincolor'   => esc_attr__('Skincolor', 'acadevo'),
				'custom'      => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'darkgrey',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Footer background color', 'acadevo').'</div>',
        ),
		array(
			'id'      		 => 'full_footer_bg_all',
			'type'    		 => 'themetechmount_background',
			'title'  		 => esc_attr__('Footer Background (all area)', 'acadevo' ),
			'after'  		 => '<div class="cs-text-muted"><br>'.esc_attr__('Footer background image', 'acadevo').'</div>',
			'default'		 => array(
				'image'			=> get_template_directory_uri() . '/images/footer-bg.jpg',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center center',
				'attachment'	=> 'scroll',
				'size'			=> 'cover',
			),
			'output' 	     => '.footer',
			'output_bglayer' => true,  // apply color to bglayer class div inside this , default: true
			'color_dropdown_id' => 'full_footer_bg_color',   // color dropdown to decide which color
        ),
		
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('First Footer Widget Area', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options to change settings for footer widget area', 'acadevo').'</small>',
		),
		array(
			'id'			=> 'first_footer_column_layout',
			'type' 			=> 'image_select',//themetechmount_pre_color_packages
			'title'			=> esc_attr__('Footer Widget Columns', 'acadevo'),
			'options'      	=> array(
					'12'      => get_template_directory_uri() . '/inc/images/footer_col_12.png',
					'6_6'     => get_template_directory_uri() . '/inc/images/footer_col_6_6.png',
					'4_4_4'   => get_template_directory_uri() . '/inc/images/footer_col_4_4_4.png',
					'3_3_3_3' => get_template_directory_uri() . '/inc/images/footer_col_3_3_3_3.png',
					'8_4'     => get_template_directory_uri() . '/inc/images/footer_col_8_4.png',
					'4_8'     => get_template_directory_uri() . '/inc/images/footer_col_4_8.png',
					'6_3_3'   => get_template_directory_uri() . '/inc/images/footer_col_6_3_3.png',
					'3_3_6'   => get_template_directory_uri() . '/inc/images/footer_col_3_3_6.png',
					'8_2_2'   => get_template_directory_uri() . '/inc/images/footer_col_8_2_2.png',
					'2_2_8'   => get_template_directory_uri() . '/inc/images/footer_col_2_2_8.png',
					'6_2_2_2' => get_template_directory_uri() . '/inc/images/footer_col_6_2_2_2.png',
					'2_2_2_6' => get_template_directory_uri() . '/inc/images/footer_col_2_2_2_6.png',
			),
			'default'		=> '3_3_3_3',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select Footer Column layout View for widgets.', 'acadevo').'</div>',
        ),
		
		array(
			'id'            => 'first_footer_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Footer Background Color', 'acadevo'),
			'options'  => array(
				'transparent' => esc_attr__('Transparent', 'acadevo'),
				'darkgrey'    => esc_attr__('Dark grey', 'acadevo'),
				'grey'        => esc_attr__('Grey', 'acadevo'),
				'white'       => esc_attr__('White', 'acadevo'),
				'skincolor'   => esc_attr__('Skincolor', 'acadevo'),
				'custom'      => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'skincolor',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Footer background color', 'acadevo').'</div>',
        ),
		array(
			'id'      			=> 'first_footer_bg_all',
			'type'    			=> 'themetechmount_background',
			'title'  			=> esc_attr__('Footer Background', 'acadevo' ),
			'after'  			=> '<div class="cs-text-muted"><br>'.esc_attr__('Footer background image', 'acadevo').'</div>',
			'default'			=> array(
				'repeat'			=> 'no-repeat',
				'position'			=> 'center bottom',
				'attachment'		=> 'scroll',
				'size'				=> 'cover',
			),
			'output'			=> '.first-footer',
			'output_bglayer'    => true,  // apply color to bglayer class div inside this , default: true
			'color_dropdown_id' => 'first_footer_bg_color',   // color dropdown to decide which color
        ),
		array(
			'id'           	=> 'first_footer_text_color',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Text Color', 'acadevo'),
			'options'  		=> array(
								'white'  => esc_attr__('White', 'acadevo'),
								'dark'   => esc_attr__('Dark', 'acadevo'),
							),
			'default'      	=> 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
        ),

		// Second Footer Widget Area
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Second Footer Widget Area', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options to change settings for second footer widget area', 'acadevo').'</small>',
		),
		array(
			'id'			=> 'second_footer_column_layout',
			'type' 			=> 'image_select',//themetechmount_pre_color_packages
			'title'			=> esc_attr__('Footer Widget Columns', 'acadevo'),
			'options'      	=> array(
					'12'      => get_template_directory_uri() . '/inc/images/footer_col_12.png',
					'6_6'     => get_template_directory_uri() . '/inc/images/footer_col_6_6.png',
					'4_4_4'   => get_template_directory_uri() . '/inc/images/footer_col_4_4_4.png',
					'3_3_3_3' => get_template_directory_uri() . '/inc/images/footer_col_3_3_3_3.png',
					'8_4'     => get_template_directory_uri() . '/inc/images/footer_col_8_4.png',
					'4_8'     => get_template_directory_uri() . '/inc/images/footer_col_4_8.png',
					'6_3_3'   => get_template_directory_uri() . '/inc/images/footer_col_6_3_3.png',
					'3_3_6'   => get_template_directory_uri() . '/inc/images/footer_col_3_3_6.png',
					'8_2_2'   => get_template_directory_uri() . '/inc/images/footer_col_8_2_2.png',
					'2_2_8'   => get_template_directory_uri() . '/inc/images/footer_col_2_2_8.png',
					'6_2_2_2' => get_template_directory_uri() . '/inc/images/footer_col_6_2_2_2.png',
					'2_2_2_6' => get_template_directory_uri() . '/inc/images/footer_col_2_2_2_6.png',
			),
			'default'		=> '3_3_3_3',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select Footer Column layout View for widgets.', 'acadevo').'</div>',
        ),
		array(
			'id'            => 'second_footer_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Footer Background Color', 'acadevo'),
			'options'  => array(
							'transparent' => esc_attr__('Transparent', 'acadevo'),
							'darkgrey'    => esc_attr__('Dark grey', 'acadevo'),
							'grey'        => esc_attr__('Grey', 'acadevo'),
							'white'       => esc_attr__('White', 'acadevo'),
							'skincolor'   => esc_attr__('Skincolor', 'acadevo'),
							'custom'      => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'transparent',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Footer background color', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'second_footer_bg_all',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Footer Background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Footer background image', 'acadevo').'</div>',
			'default'		=> array(
				'repeat'		=> 'no-repeat',
				'position'		=> 'center center',
				'attachment'	=> 'scroll',
				'size'			=> 'cover',
				'color'			=> '#f5f8fa',
			),
			'output' 	    => '.second-footer',
			'output_bglayer'    => true,  // apply color to bglayer class div inside this , default: true
			'color_dropdown_id' => 'second_footer_bg_color',   // color dropdown to decide which color
        ),
		array(
			'id'           	=> 'second_footer_text_color',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Text Color', 'acadevo'),
			'options'  		=> array(
				'white'  		=> esc_attr__('White', 'acadevo'),
				'dark'   		=> esc_attr__('Dark', 'acadevo'),
			),
			'default'      	=> 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
        ),

		// Footer Text Area
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Footer Text Area', 'acadevo'),
			'after'  	  	 => '<small>'.esc_attr__('Options to change settings for footer text area. This contains copyright info', 'acadevo').'</small>',
		),
		array(
			'id'            => 'bottom_footer_bg_color',
			'type'          => 'select',
			'title'         =>  esc_attr__('Footer Background Color', 'acadevo'),
			'options'  => array(
							'transparent' => esc_attr__('Transparent', 'acadevo'),
							'darkgrey'    => esc_attr__('Dark grey', 'acadevo'),
							'grey'        => esc_attr__('Grey', 'acadevo'),
							'white'       => esc_attr__('White', 'acadevo'),
							'skincolor'   => esc_attr__('Skincolor', 'acadevo'),
							'custom'      => esc_attr__('Custom Color', 'acadevo'),
			),
			'default'       => 'darkgrey',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select predefined color for Footer background color', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'bottom_footer_bg_all',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Footer Background', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Footer background image', 'acadevo').'</div>',
			'default'		=> array(
				'repeat'		=> 'no-repeat',
				'position'		=> 'center center',
				'attachment'	=> 'fixed',
				'color'			=> '#013340',
			),
			'output' 	    => '.site-footer .bottom-footer-text',
			'output_bglayer'    => true,  // apply color to bglayer class div inside this , default: true
			'color_dropdown_id' => 'bottom_footer_bg_color',   // color dropdown to decide which color
        ),
		array(
			'id'           	=> 'bottom_footer_text_color',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Text Color', 'acadevo'),
			'options'  		=> array(
				'white'			=> esc_attr__('White', 'acadevo'),
				'dark'			=> esc_attr__('Dark', 'acadevo'),
			),
			'default'      	=> 'white',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select "Dark" color if you are going to select light color in above option', 'acadevo').'</div>',
        ),
		array(
          'id'      		=> 'footer_copyright_left',
          'type'    		=> 'wysiwyg',
          'title'  			=>  esc_attr__('Footer Text Left', 'acadevo'),
		  'after'  			=> '<div class="cs-text-muted"><br>'. esc_attr__('You can use the following shortcodes in your footer text:', 'acadevo')
		  . '<br>   <code>[tm-site-url]</code> <code>[tm-site-title]</code> <code>[tm-site-tagline]</code> <code>[tm-current-year]</code> <code>[tm-footermenu]</code> <br><br> '
		  . sprintf( esc_attr__('%1$s Click here to know more%2$s  about details for each shortcode.','acadevo') , '<a href="'. esc_url('http://acadevo.themetechmountthemes.com/documentation/shortcodes.html') .'" target="_blank">' , '</a>'  ) .'</div>',
		  'default'         => themetechmount_wp_kses('Copyright &copy; 2019 <a href="' . site_url() . '">' . get_bloginfo('name') . '</a>. All rights reserved.'),
        ),
		array(
          'id'       		=> 'footer_copyright_right',
          'type'     		=> 'wysiwyg',
          'title'   		=>  esc_attr__('Footer Text Right', 'acadevo'),
		  'after'  			=> '<div class="cs-text-muted"><br>'. esc_attr__('You can use the following shortcodes in your footer text:', 'acadevo')
		  . '<br>   <code>[tm-site-url]</code> <code>[tm-site-title]</code> <code>[tm-site-tagline]</code> <code>[tm-current-year]</code> <code>[tm-footermenu]</code> <br><br> '
		  . sprintf( esc_attr__('%1$s Click here to know more%2$s about details for each shortcode.','acadevo') , '<a href="'. esc_url('http://acadevo.themetechmountthemes.com/documentation/shortcodes.html') .'" target="_blank">' , '</a>'  ) .'</div>',
        ),
		
	)
);


// Login Page Settings
$tm_framework_options[] = array(
	'name'   => 'login_page_settings', // like ID
	'title'  => esc_attr__('Login Page Settings', 'acadevo'),
	'icon'   => 'fa fa-lock',
	'fields' => array( // begin: fields
		array(
			'type'       	 => 'heading',
			'content'    	 => esc_attr__('Login Page Settings', 'acadevo'),
		),
		array(
			'id'      		=> 'login_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Background Properties', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Specify the type of background object', 'acadevo').'</div>',
			'default'		=> array(
				'image'			=> get_template_directory_uri() . '/images/login-bg.jpg',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center top',
				'attachment'	=> 'fix',
				'size'			=> 'cover',
				'color'			=> '#ffffff',
			),
			'output'   		=> '.loginpage',
        ),
	)
);


// Blog Settings
$tm_framework_options[] = array(
	'name'   => 'blog_settings', // like ID
	'title'  => esc_attr__('Blog Settings', 'acadevo'),
	'icon'   => 'fa fa-pencil',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Blog Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Settings for Blog section', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'blog_text_limit',
			'type'   		=> 'number',
			'title'         => esc_attr__('Blog Excerpt Limit (in words)', 'acadevo' ),
			'default'		=> '0',
			'after'  	  	=> '<div class="cs-text-muted"><br>' . esc_attr__('Set limit for small description. Select how many words you like to show.', 'acadevo') . '<br><strong>' . esc_attr__('TIP:', 'acadevo') . '</strong> ' . esc_attr__('Select "0" (zero) to show excerpt or content before READ MORE break.', 'acadevo') . '</div>',
        ),
		array(
			'id'     		=> 'blogclassic_show_comment_number',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show "Total Comment" with icon', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Show or hide Total Comment with icon. You can hide it if you don\'t want to show it.', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'blog_readmore_text',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('"Read More" Link Text', 'acadevo'),
			'default' 		=> esc_attr__('Read More', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Text for the Read More link on the Blog page', 'acadevo').'</div>',
		),
		
		array(
			'id'           	=> 'blog_view',
			'type'         	=> 'image_select',
			'title'        	=>  esc_attr__('Blog view', 'acadevo'),
			'options'  		=> array(
				'classic'			=> get_template_directory_uri() . '/inc/images/blog-view-style1.png',
				'box'				=> get_template_directory_uri() . '/inc/images/blog-view-style4.png',
			),
			'default'      	=> 'classic',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select blog view. The default view is classic list view. Also we have total three differnt look for classic view. Select them in this option and see your BLOG page. For "Box view", you can select two, three or four columns box view too.', 'acadevo').'</div>',
			
        ),
		
		
		
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Blogbox Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Blog box style view settings. This is because you selected "BOX VIEW" in above option.', 'acadevo').'</small>',
		),
		array(
			'id'           	=> 'blogbox_column',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Blog box column', 'acadevo'),
			'options'  		=> array(
				'one'			=> esc_attr__('One Column View', 'acadevo'),
				'two'			=> esc_attr__('Two Column view', 'acadevo'),
				'three'			=> esc_attr__('Three Column view (default)', 'acadevo'),
				'four'			=> esc_attr__('Four Column view', 'acadevo'),
			),
			'default'      	=> 'one',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select blog view. The default view is classic list view. You can select two, three or four column blog view from here', 'acadevo').'</div>',
			'dependency'    => array( 'blog_view_box', '==', 'true' ),
        ),
		array(
			'id'           	=> 'blogbox_view',
			'type'         	=> 'image_select',
			'title'        	=>  esc_attr__('Blog box template', 'acadevo'),
			'options'  		=> array(
				'top-image'			=> get_template_directory_uri() . '/inc/images/blogbox-style-one.png',
				'top-image-style2'			=> get_template_directory_uri() . '/inc/images/blogbox-style-three.png',
				'left-image'		=> get_template_directory_uri() . '/inc/images/blogbox-style-two.png',
			),
			'default'      	=> 'left-image',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select blog view. The default view is classic list view. You can select two, three or four column blog view from here', 'acadevo').'</div>',
			'dependency'    => array( 'blog_view_box', '==', 'true' ),
        ),
		array(
			'id'     		=> 'blogbox_text_limit',
			'type'   		=> 'number',
			'title'         => esc_attr__('Blogbox Excerpt Limit (in words)', 'acadevo' ),
			'default'		=> '120',
			'after'  	  	=> '<div class="cs-text-muted"><br>' . esc_attr__('Set limit for small description. Select how many words you like to show.', 'acadevo') . '<br><strong>' . esc_attr__('TIP:', 'acadevo') . '</strong> ' . esc_attr__('Select "0" (zero) to show excerpt or content before READ MORE break.', 'acadevo') . '</div>',
        ),
		
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Blog Single Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Settings for single view of blog post.', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'post_social_share_title',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Social Share Title', 'acadevo'),
			'default' 		=> esc_attr__('Share Post', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('This text will appear in the social share box as title', 'acadevo').'</div>',
			'dependency'    => array( 'portfolio_show_social_share', '==', 'true' ),
		),
		array(
			'id'        => 'post_social_share_services',
			'type'      => 'checkbox',
			'title'     => esc_attr__('Select Social Share Service', 'acadevo'),
			'options'   => array(
					'facebook'    => esc_attr__('Facebook', 'acadevo'),
					'twitter'     => esc_attr__('Twitter', 'acadevo'),
					'gplus'       => esc_attr__('Google Plus', 'acadevo'),
					'pinterest'   => esc_attr__('Pinterest', 'acadevo'),
					'linkedin'    => esc_attr__('LinkedIn', 'acadevo'),
					'stumbleupon' => esc_attr__('Stumbleupon', 'acadevo'),
					'tumblr'      => esc_attr__('Tumblr', 'acadevo'),
					'reddit'      => esc_attr__('Reddit', 'acadevo'),
					'digg'        => esc_attr__('Digg', 'acadevo'),
			),
			'after'    	 => '<div class="cs-text-muted"><br>'.esc_attr__('The selected social service icon will be visible on single Post so user can share on social sites.', 'acadevo').'</div>',
		),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Blog Classic Meta Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Settings for meta data for Blog classic view.', 'acadevo').'</small>',
		),
		array(
			'id'      => 'blogclassic_meta_list',
			'type'    => 'sorter',
			'title'   => esc_attr__('Classic Blog - Meta Details','acadevo'),
			'after'   => '<div class="cs-text-muted"><br>'.esc_attr__('Select which data you like to show in post meta details', 'acadevo').'</div>',
			'default' => array(
				'enabled' => array(
					'author'	=> esc_attr__('Author', 'acadevo'),
					'cat'    	=> esc_attr__('Categories', 'acadevo'),
				),
				'disabled' => array(
					'date'		=> esc_attr__('Date', 'acadevo'),
					'tag'		=> esc_attr__('Tags', 'acadevo'),	
					'comment'	=> esc_attr__('Comments', 'acadevo'),
				),
			),
			'enabled_title'  => esc_attr__('Active Meta Details', 'acadevo'),
			'disabled_title' => esc_attr__('Hidden Meta Details', 'acadevo'),
		),
		array(
			'id'     		=> 'blogclassic_meta_dateformat',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Date Meta - format', 'acadevo'),
			'default' 		=> '',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set date format.', 'acadevo'). ' <a href="' . esc_url('https://codex.wordpress.org/Formatting_Date_and_Time') . '" target="_blank">' . esc_attr__('Documentation on date and time formatting.', 'acadevo') . '</a></div>',
		),
		array(
			'id'     		=> 'blogclassic_meta_taglink',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Tag list - Add link?', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Add link in tags', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'blogclassic_meta_catlink',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Category list - Add link?', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Add link in categories', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'blogclassic_meta_authorlink',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Author Name - Add link?', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Add link in author name', 'acadevo').'</div>',
        ),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Blogbox Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Settings for Blogbox (Visual Composer element)', 'acadevo').'</small>',
		),
		array(
			'id'      => 'blogbox_meta_list',
			'type'    => 'sorter',
			'title'   => esc_attr__('Classic Blog - Meta Details','acadevo'),
			'after'   => '<div class="cs-text-muted"><br>'.esc_attr__('Select which data you like to show in post meta details', 'acadevo').'</div>',
			'default' => array(
				'enabled' => array(
					'cat'    	=> esc_attr__('Categories', 'acadevo'),
					'author'	=> esc_attr__('Author', 'acadevo'),
				),
				'disabled' => array(					
					'comment' 	=> esc_attr__('Comments', 'acadevo'),
					'tag'  		=> esc_attr__('Tags', 'acadevo'),
					'date'    	=> esc_attr__('Date', 'acadevo'),
				),
			),
			'enabled_title'  => esc_attr__('Active Meta Details', 'acadevo'),
			'disabled_title' => esc_attr__('Hidden Meta Details', 'acadevo'),
		),
		array(
			'id'     		=> 'blogbox_meta_dateformat',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Date Meta - format', 'acadevo'),
			'default' 		=> '',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set date format.', 'acadevo'). ' <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">' . esc_attr__('Documentation on date and time formatting.', 'acadevo') . '</a></div>',
		),
		array(
			'id'     		=> 'blogbox_meta_taglink',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Tag list - Add link?', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Add link in tags', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'blogbox_meta_catlink',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Category list - Add link?', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Add link in categories', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'blogbox_meta_authorlink',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Author Name - Add link?', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Add link in author name', 'acadevo').'</div>',
        ),
		
	)
);



// Portfolio Settings
$tm_framework_options[] = array(
	'name'   => 'portfolio_settings', // like ID
	'title'  => sprintf( esc_attr__('%s Settings', 'acadevo'), $pf_title_singular ),
	'icon'   => 'fa fa-th-large',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> sprintf( esc_attr__('Single %s Settings', 'acadevo'), $pf_title_singular ),
			'after'  		=> '<small>' . sprintf( esc_attr__('Options to change settings for single %s', 'acadevo'), $pf_title_singular ) . '</small>',
		),
		array(
			'id'     		=> 'portfolio_project_details',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('%s Details Box Title', 'acadevo'), $pf_title_singular ),
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Title for the list styled "%1$s Details" area. (For single %1$s only)', 'acadevo'), $pf_title_singular ) . '</div>',
		),
		array(
			'id'      		=> 'portfolio_viewstyle',
			'type'   		=> 'radio',
			'title'   		=> sprintf( esc_attr__('Single %s View Style', 'acadevo'), $pf_title_singular ),
			'options' 		=> array( 
				'left'			=> esc_attr__('Left image and right content (default)', 'acadevo'),
				'top'			=> esc_attr__('Top image and bottom content', 'acadevo'),
				'full'			=> esc_attr__('No image and full-width content (without details box)', 'acadevo'),
				'full-withimg'  => esc_attr__('Top image and full-width content (without details box)', 'acadevo'),
			),
			'default'		=> 'left',
			'after'  	  	=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select view for single %s', 'acadevo'), $pf_title_singular ) . '</div>',
        ),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> sprintf( esc_attr__('Related %1$s (on single %2$s) Settings', 'acadevo'), $pf_title, $pf_title_singular ),
			'after'  		=> '<small>' . sprintf( esc_attr__('Options to change settings for related %1$s section on single %2$s page.', 'acadevo'), $pf_title, $pf_title_singular ) . '</small>',
		),
		array(
			'id'     		=> 'portfolio_show_related',
			'type'   		=> 'switcher',
			'title'   		=> sprintf( esc_attr__('Show Related %s', 'acadevo'), $pf_title ),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted">' . sprintf( esc_attr__('Select ON to show related %1$s on single %2$s page', 'acadevo'), $pf_title, $pf_title_singular ) . '</div>',
        ),
		array(
			'id'     		=> 'portfolio_related_title',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('Related %s Title', 'acadevo'), $pf_title ),
			'default' 		=> esc_attr__('Related Projects', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Title for the Releated %1$s area. (For single %2$s only)', 'acadevo'), $pf_title, $pf_title_singular ) . '</div>',
			'dependency'    => array( 'portfolio_show_related', '==', 'true' ),
		),
		array(
			'id'           	=> 'portfolio_related_view',
			'type'         	=> 'select',
			'title'        	=> sprintf( esc_attr__('Related %s Boxes template', 'acadevo'), $pf_title ),
			'options'       => themetechmount_global_portfolio_template_list(),
			'default'      	=> 'top-image',
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select column to show in Related %s area.', 'acadevo'), $pf_title ) . '</div>',
			'dependency'    => array( 'portfolio_show_related', '==', 'true' ),
        ),
		array(
			'id'           	=> 'portfolio_related_column',
			'type'         	=> 'select',
			'title'        	=> esc_attr__('Select column', 'acadevo'),
			'options'  => array(
					'two'     => esc_attr__('Two column', 'acadevo'),
					'three'   => esc_attr__('Three column', 'acadevo'),
					'four'    => esc_attr__('Four column', 'acadevo'),
					'five'    => esc_attr__('Five column', 'acadevo'),
					'six'     => esc_attr__('Six column', 'acadevo'),
				),
			//'class'        	=> 'chosen',
			'default'      	=> 'three',
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select column to show in Related %s area.', 'acadevo'), $pf_title ) . '</div>',
			'dependency'    => array( 'portfolio_show_related', '==', 'true' ),
        ),
		array(
			'id'     		=> 'portfolio_related_show',
			'type'   		=> 'number',
			'title'         => sprintf( esc_attr__('Show %s', 'acadevo'), $pf_title ),
			'default'		=> '3',
			'after'  	  	=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('How many %2$s Boxes you like to show in Related %1$s area.', 'acadevo'), $pf_title, $pf_title_singular ) . '</div>',
			'dependency'    => array( 'portfolio_show_related', '==', 'true' ),
        ),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> sprintf( esc_attr__('Single %s List Details Settings', 'acadevo'), $pf_title_singular ),
			'after'  		=> '<small>' . sprintf( esc_attr__('Options to change each line of list details for single %1$s. Here you can select how many lines will be appear in the details of a single %1$s', 'acadevo'), $pf_title_singular ) . '</small>',
		),
		array(
			'id'              => 'pf_details_line',
			'type'            => 'group',
			'title'           => esc_attr__('Line Details', 'acadevo'),
			'info'            => sprintf( esc_attr__('This will be added a new line in DETAILS box on single %s view.', 'acadevo'), $pf_title_singular ),
			'button_title'    => esc_attr__('Add New Line', 'acadevo'),
			'accordion_title' => esc_attr__('Details for the line', 'acadevo'),
			
			'default'		 =>  array (
				array (
					'pf_details_line_title' => 'Date',
					'pf_details_line_icon'  => array (
						'library'             => 'fontawesome',
						'library_fontawesome' => 'fa fa-calendar',
						'library_linecons'    => 'vc_li-calendar',
						'library_themify'     => 'ti-calendar',
					),
					'data' => 'custom',
				),				
			),



			'fields'          => array(
				array(
					'id'     		=> 'pf_details_line_title',
					'type'    		=> 'text',
					'title'   		=> esc_attr__('Line Title', 'acadevo'),
					'default' 		=> esc_attr__('Location', 'acadevo'),
					'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Title for the first line of the details in single %s', 'acadevo'), $pf_title_singular ) . '<br> ' . esc_attr__('Leave this field empty to remove the line.', 'acadevo').'</div>',
				),
				array(
					'id'      => 'pf_details_line_icon',
					'type'    => 'themetechmount_iconpicker',
					'title'  		=> esc_attr__('Line Icon', 'acadevo' ),
					'default' => array(
						'library'             => 'fontawesome',
						'library_fontawesome' => 'fa fa-map-marker',
					),
					'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select icon for the first Line of the details in single %s', 'acadevo'), $pf_title_singular ) . '</div>',
				),
				
				array(
					'id'      		=> 'data',
					'type'   		=> 'select',
					'title'   		=> esc_attr__('Line Input Type', 'acadevo'),
					'options' 		=> array(
							'custom'        => esc_attr__('Custom text (single line)', 'acadevo'),
							'multiline'     => esc_attr__('Custom text with multiline', 'acadevo'),
							'date'          => sprintf( esc_attr__('Show date of the %s', 'acadevo'), $pf_title_singular ),
							'category'      => sprintf( esc_attr__('Show Category (without link) of the %s', 'acadevo'), $pf_title_singular ),
							'category_link' => sprintf( esc_attr__('Show Category (with link) of the %s', 'acadevo'), $pf_title_singular ),
							'tag'           => sprintf( esc_attr__('Show Tags (without link) of the %s', 'acadevo'), $pf_title_singular ),
							'tag_link'      => sprintf( esc_attr__('Show Tags (with link) of the %s', 'acadevo'), $pf_title_singular ),
					),
					'default'		=> 'custom',
					'after'  	  	=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select view for single %s', 'acadevo'), $pf_title_singular ) . '</div>',
				),
			)
        ),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> sprintf( esc_attr__('Select social sharing service for single %s', 'acadevo'), $pf_title_singular ),
			'after'  		=> '<small>' . sprintf( esc_attr__('Select social service so site visitors can share the single %s on different social services', 'acadevo'), $pf_title_singular ) . '</small>',
		),
		array(
			'id'     		=> 'portfolio_show_social_share',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Social Share box', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Show or hide social share box.', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'portfolio_social_share_title',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Social Share Title', 'acadevo'),
			'default' 		=> esc_attr__('Share', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('This text will appear in the social share box as title', 'acadevo').'</div>',
			'dependency'    => array( 'portfolio_show_social_share', '==', 'true' ),
		),
		array(
			'id'        => 'portfolio_social_share_services',
			'type'      => 'checkbox',
			'title'     => esc_attr__('Select Social Share Service', 'acadevo'),
			'options'   => array(
					'facebook'    => esc_attr__('Facebook', 'acadevo'),
					'twitter'     => esc_attr__('Twitter', 'acadevo'),
					'gplus'       => esc_attr__('Google Plus', 'acadevo'),
					'pinterest'   => esc_attr__('Pinterest', 'acadevo'),
					'linkedin'    => esc_attr__('LinkedIn', 'acadevo'),
					'stumbleupon' => esc_attr__('Stumbleupon', 'acadevo'),
					'tumblr'      => esc_attr__('Tumblr', 'acadevo'),
					'reddit'      => esc_attr__('Reddit', 'acadevo'),
					'digg'        => esc_attr__('Digg', 'acadevo'),
			),
			'after'    	 => '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('The selected social service icon will be visible on single %s so user can share on social sites.', 'acadevo'), $pf_title_singular ) . '</div>',
			'dependency' => array( 'portfolio_show_social_share', '==', 'true' ),
		),
		array(
			'id'     		=> 'portfolio_single_top_btn_title',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Button Title', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('This button will appear after the social share links.', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'portfolio_single_top_btn_link',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Button Link', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('This button will appear after the social share links.', 'acadevo').'</div>',
		),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> sprintf( esc_attr__('%s Settings', 'acadevo'), $pf_cat_title ),
			'after'  		=> '<small>' . sprintf( esc_attr__('Settings for %s', 'acadevo'), $pf_cat_title ) . '</small>',
		),
		array(
			'id'           	=> 'pfcat_view',
			'type'         	=> 'select',
			'title'        	=> sprintf( esc_attr__('%s Boxes template', 'acadevo'), $pf_title_singular ),
			'options'       => themetechmount_global_portfolio_template_list(),
			'default'      	=> 'top-image',
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select %1$s Box view on single %2$s page.', 'acadevo'), $pf_title_singular, $pf_cat_title_singular ) . '</div>',
        ),
		array(
			'id'           	=> 'pfcat_column',
			'type'         	=> 'select',
			'title'        	=>  esc_attr__('Select column', 'acadevo'),
			'options'  => array(
					'two'     => esc_attr__('Two column', 'acadevo'),
					'three'   => esc_attr__('Three column', 'acadevo'),
					'four'    => esc_attr__('Four column', 'acadevo'),
					'five'    => esc_attr__('Five column', 'acadevo'),
					'six'     => esc_attr__('Six column', 'acadevo'),
				),
			'default'      	=> 'three',
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select column to show on %s page.', 'acadevo'), $pf_cat_title_singular ) . '</div>',
        ),
		array(
			'id'     		=> 'pfcat_show',
			'type'   		=> 'number',
			'title'         => sprintf( esc_attr__('%s to show', 'acadevo' ), $pf_title_singular ),
			'default'		=> '9',
			'after'  	  	=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('How many %1$s you like to show on %2$s page', 'acadevo'), $pf_title_singular, $pf_cat_title_singular ) . '</div>',
        ),
	)
);



// Creating Client Groups array 
$client_groups = array();
if( isset($acadevo_theme_options['client_groups']) && is_array($acadevo_theme_options['client_groups']) ){

foreach( $acadevo_theme_options['client_groups'] as $key => $val ){

	$name = $val['client_group_name'];
	$slug = str_replace(' ', '_', strtolower($name));
	$client_groups[$slug] = $name;
}

}




// Error 404 Page Settings
$tm_framework_options[] = array(
	'name'   => 'error404_page_settings', // like ID
	'title'  => esc_attr__('Error 404 Page Settings', 'acadevo'),
	'icon'   => 'fa fa-exclamation-triangle',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Error 404 Page Settings', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Settings that determine how the error page will be looking', 'acadevo').'</small>',
		),
		array(
			'id'      => 'error404_big_icon',
			'type'    => 'themetechmount_iconpicker',
			'title'  		=> esc_attr__('Big icon', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select icon that appear in top with big size', 'acadevo').'</div>',
			'default' =>  array (
				'library'			  => 'fontawesome',
				'library_fontawesome' => 'fa fa-thumbs-o-down',
				'library_linecons'	  => '',
				'library_themify'	  => 'ti-location-pin',
			),
		),
		array(
			'id'     		=> 'error404_big_text',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Big heading text', 'acadevo'),
			'default' 		=> esc_attr__('404 ERROR', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This text will be shown with big font size below icon', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'error404_medium_text',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Description text', 'acadevo'),
			'default' 		=> esc_attr__('This page may have been moved or deleted. Be sure to check your spelling.', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This file may have been moved or deleted. Be sure to check your spelling', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'error404_search',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Search Form', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Set this option "YES" to show search form on the 404 page', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'error404_page_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Content area background for 404 page only', 'acadevo' ),
			'after'  		=> '<div class="cs-text-muted cs-text-desc"><br>'.esc_attr__('Set background for 404 page content area only.', 'acadevo').'</div>',
			'default'		=> array(
				'image'			=> get_template_directory_uri() . '/images/404-page-bg.jpg',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center center',
				'size'			=> 'cover',
				'color'			=> 'rgba(255,255,255,0.1)',
			),
			'output' 	    => '.error404 .site-content-wrapper',
		),	
		
	)
);


// Search Page Settings
$tm_framework_options[] = array(
	'name'   => 'search_page_settings', // like ID
	'title'  => esc_attr__('Search Page Settings', 'acadevo'),
	'icon'   => 'fa fa-search',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Search Page Settings', 'acadevo'),
		),
		array(
			'id'       		 => 'searchnoresult',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('Content of the search page if no results found', 'acadevo'),
			'shortcode'		 => true,
			'after'  	     => '<div class="cs-text-muted"><br>'. esc_attr__('Specify the content of the page that will be displayed if while search no results found', 'acadevo') . '<br> ' . esc_attr__('HTML tags and shortcodes are allowed', 'acadevo').'</div>',
			'default'  		 => themetechmount_wp_kses( urldecode('%3Ch3%3ENothing+found%3C%2Fh3%3E%3Cp%3ESorry%2C+but+nothing+matched+your+search+terms.+Please+try+again+with+some+different+keywords.%3C%2Fp%3E') ),
        ),
		
	)
);


// Sidebar Settings
$tm_framework_options[] = array(
	'name'   => 'sidebar_settings', // like ID
	'title'  => esc_attr__('Sidebar Settings', 'acadevo'),
	'icon'   => 'fa fa-pause',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Sidebar Settings', 'acadevo'),
		),
		array(
			'id'              => 'custom_sidebars',
			'type'            => 'group',
			'title'           => esc_attr__('Custom Sidebars', 'acadevo'),
			'info'            => esc_attr__('Specify the custom sidebars that can be used in the pages for a widgets', 'acadevo'),
			'button_title'    => esc_attr__('Add New Sidebar', 'acadevo'),
			'accordion_title' => esc_attr__('Custom Sidebar Properties', 'acadevo'),
			'fields'          => array(
					array(
						'id'     		=> 'custom_sidebar',
						'type'    		=> 'text',
						'title'   		=> esc_attr__('Custom Sidebar Name', 'acadevo'),
						'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('Write custom sidebar name here', 'acadevo').'</div>',
					),

			)
        ),
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Sidebar Position', 'acadevo'),
			'after'  		=> '<small>'.esc_attr__('Select sidebar position for different sections', 'acadevo').'</small>',
		),
		array(
			'id'           	=> 'sidebar_post',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('Blog Post/Category Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'right',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select one of layouts for blog post. Also for Category, Tag and Archive view too. Technically, related to all blog post view.', 'acadevo').'</div>',
        ),
		array(
			'id'           	=> 'sidebar_page',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('Standard Pages Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'right',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select one of layouts for standard pages', 'acadevo').'</div>',
        ),
		array(
			'id'           	=> 'sidebar_portfolio',
			'type'        	=> 'image_select',
			'title'       	=> sprintf( esc_attr__('%s Sidebar', 'acadevo'), $pf_title_singular ),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'no',
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select one of layouts for %s single pages.', 'acadevo'), $pf_title_singular ) . '</div>',
        ),
		array(
			'id'           	=> 'sidebar_portfolio_category',
			'type'        	=> 'image_select',
			'title'       	=> sprintf( esc_attr__('%s Sidebar', 'acadevo'), $pf_cat_title_singular ),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'left',
			'after'  		=> '<div class="cs-text-muted"><br>' . sprintf( esc_attr__('Select one of layouts for %s view.', 'acadevo'), $pf_cat_title_singular ) . '</div>',
        ),
		array(
			'id'           	=> 'sidebar_search',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('Search Page Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'no',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select one of layouts for search page', 'acadevo').'</div>',
        ),
		array(
			'id'           	=> 'sidebar_woocommerce',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('WooCommerce Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'right',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select sidebar position for WooCommerce Shop and Single Product page', 'acadevo').'</div>',
        ),
		array(
			'id'           	=> 'sidebar_bbpress',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('BBPress Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'right',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select sidebar position for BBPress pages', 'acadevo').'</div>',
        ),
		array(
			'id'           	=> 'sidebar_events',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('Events Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'right',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select sidebar position for Events pages.', 'acadevo') . ' ' . sprintf( esc_attr__('This is valid for %s plugin only','acadevo') , '<a href="'. esc_url('https://wordpress.org/plugins/the-events-calendar/') .'" target="_blank">' . esc_attr__('The Events Calendar', 'acadevo').'</a>' ).'</div>',
        ),
		array(
			'id'           	=> 'sidebar_lpcourse',
			'type'        	=> 'image_select',
			'title'       	=> esc_attr__('Course Sidebar', 'acadevo'),
			'options'     	=> array(
				'no'          => get_template_directory_uri() . '/inc/images/layout_no_side.png',
				'left'        => get_template_directory_uri() . '/inc/images/layout_left.png',
				'right'       => get_template_directory_uri() . '/inc/images/layout_right.png',
				'both'        => get_template_directory_uri() . '/inc/images/layout_both.png',
				'bothleft'    => get_template_directory_uri() . '/inc/images/layout_left_both.png',
				'bothright'   => get_template_directory_uri() . '/inc/images/layout_right_both.png',
			),
			'radio'       	=> true,
			'default'      	=> 'right',
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select sidebar position for Course pages', 'acadevo').'</div>',
        ),
	)
);


// Getting social list
$global_social_list = themetechmount_shared_social_list();
	
// social service list
$sociallist = array_merge(
	$global_social_list,
	array('rss'     => 'Rss Feed')
);

// Social Links
$tm_framework_options[] = array(
	'name'   => 'social_links', // like ID
	'title'  => esc_attr__('Social Links', 'acadevo'),
	'icon'   => 'fa fa-share-square-o',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Social Links', 'acadevo'),
			'after'			=> '<small>' . sprintf(__('You can use %1$s[tm-social-links]%2$s shortcode to show social links.', 'acadevo'), '<code>' , '</code>' ) . '</small>',
		),
		array(
			'id'              => 'social_icons_list',
			'type'            => 'group',
			'title'           => esc_attr__('Social Links', 'acadevo'),
			'info'            => esc_attr__('Add your social services here. Also you can reorder the Social Links as per your choice. Just drag and drop items to reorder as per your choice', 'acadevo'),
			'button_title'    => esc_attr__('Add New Social Service', 'acadevo'),
			'accordion_title' => esc_attr__('Social Service Properties', 'acadevo'),
			'fields'          => array(
					array(
						'id'            => 'social_service_name',
						'type'          => 'select',
						'title'         =>  esc_attr__('Social Service', 'acadevo'),
						'options'  		=> $sociallist,
						'default'       => 'twitter',
						'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Select Social icon from here', 'acadevo').'</div>',
					),
					array(
						'id'     		=> 'social_service_link',
						'type'    		=> 'text',
						'title'   		=> esc_attr__('Link to Social icon selected above', 'acadevo'),
						'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('Paste URL only', 'acadevo').'</div>',
						'dependency' 	=> array( 'social_service_name', '!=', 'rss' ),
					),

			),
			'default' => array (
				
				array (
					'social_service_name' => 'facebook',
					'social_service_link' => '#',
				),
				array (
					'social_service_name' => 'twitter',
					'social_service_link' => '#',
				),
				array (
					'social_service_name' => 'flickr',
					'social_service_link' => '#',
				),
				array (
					'social_service_name' => 'linkedin',
					'social_service_link' => '',
				),
				
			),
        ),
		
		
		
	),	
);

// WooCommerce Settings
$tm_framework_options[] = array(
	'name'   => 'woocommerce_settings', // like ID
	'title'  => esc_attr__('WooCommerce Settings', 'acadevo'),
	'icon'   => 'fa fa-shopping-cart',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('WooCommerce Settings', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Setup for WooCommerce shop section. Please make sure you installed WooCommerce plugin', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'wc-header-icon',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Cart Icon in Header', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Select "On" to show the cart icon in header. Select "OFF" to hide the cart icon.', 'acadevo') . ' <br><br> ' . '<strong>' . esc_attr__('NOTE:','acadevo') . '</strong> ' . esc_attr__('Please note that if you haven\'t installed "WooCommerce" plugin than the icon will not appear even if you selected "ON" in this option.', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'woocommerce-column', 
			'type'   		=> 'radio',
			'title'  		=> esc_attr__('WooCommerce Product List Column', 'acadevo'),
			'options'  		=> array(
								'1' => esc_attr__('One Column', 'acadevo'),
								'2' => esc_attr__('Two Columns', 'acadevo'),
								'3' => esc_attr__('Three Columns', 'acadevo'),
								'4' => esc_attr__('Four Columns', 'acadevo'),
							),
			'default'  		 => '3',
			'after'   		 => '<div class="cs-text-muted">'.esc_attr__('Select how many column you want to show for product list view', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'woocommerce-product-per-page',
			'type'   		=> 'number',
			'title'         => esc_attr__('Products Per Page', 'acadevo' ),
			'default'		=> '9',
			'after'  	  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select how many product you want to show on SHOP page', 'acadevo').'</div>',
        ),
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Single Product Page Settings', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Options for Single product page', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'wc-single-show-related',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Related Products', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted">'.esc_attr__('Select "ON" to show Related Products below the product description on single page', 'acadevo').'</div>',
        ),
		array(
			'id'     		=> 'wc-single-related-column', 
			'type'   		=> 'radio',
			'title'  		=> esc_attr__('Column for Related Products', 'acadevo'),
			'options'  		=> array(
								'1' => esc_attr__('One Column', 'acadevo'),
								'2' => esc_attr__('Two Columns', 'acadevo'),
								'3' => esc_attr__('Three Columns', 'acadevo'),
								'4' => esc_attr__('Four Columns', 'acadevo'),
							),
			'default'  		 => '3',
			'after'   		 => '<div class="cs-text-muted">'.esc_attr__('Select how many column you want to show for product list of related products', 'acadevo').'</div>',
			'dependency'     => array( 'wc-single-show-related', '==', 'true' ),
        ),
		array(
			'id'     		=> 'wc-single-related-count',
			'type'   		=> 'number',
			'title'         => esc_attr__('Related Products Show', 'acadevo' ),
			'default'		=> '3',
			'after'  	  	=> '<div class="cs-text-muted"><br>'.esc_attr__('Select how many products you want to show in the Related prodcuts area on single product page', 'acadevo').'</div>',
			'dependency'    => array( 'wc-single-show-related', '==', 'true' ),
        ),
	)
);


// Under Construction
$tm_framework_options[] = array(
	'name'   => 'under_construction', // like ID
	'title'  => esc_attr__('Under Construction', 'acadevo'),
	'icon'   => 'fa fa-send',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Under Construction', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('You can set your site in Under Construciton mode during development of your site. Please note that only logged in users like admin can view the site when this mode is activated', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'uconstruction',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Show Under Construciton Message', 'acadevo'),
			'default' 		=> false,
			'label'  		=> esc_attr__('You can acitvate this during development of your site. So site visitor will see Under Construction message.', 'acadevo'). '<br>' . esc_attr__('Please note that admin (when logged in) can view live site and not Under Construction message.', 'acadevo'),
        ),
		array(
			'id'     		=> 'uconstruction_title',
			'type'    		=> 'text',
			'title'   		=> esc_attr__('Title for Under Construction page', 'acadevo'),
			'default'  		=> esc_attr__('This site is Under Construction', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('Write TITLE for the Under Construction page', 'acadevo').'</div>',
			'dependency'	=> array('uconstruction','==','true'),
		),
		array(
			'id'       		 => 'uconstruction_html',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('Page Content', 'acadevo'),
			'shortcode'		 => true,
			'dependency'	 => array('uconstruction','==','true'),
			'default' 		 => themetechmount_wp_kses( urldecode('%3Cdiv+class%3D%22un-main-page-content%22%3E%0D%0A%3Cdiv+class%3D%22un-page-content%22%3E%0D%0A%3Cdiv%3E%5Btm-logo%5D%3C%2Fdiv%3E%0D%0A%3Cdiv+class%3D%22sepline%22%3E%3C%2Fdiv%3E%0D%0A%3Ch1+class%3D%22heading%22%3EUNDER+CONSTRUCTION%3C%2Fh1%3E%0D%0A%3Ch4+class%3D%22subheading%22%3ESomething+awesome+this+way+comes.+Stay+tuned%21%3C%2Fh4%3E%0D%0A%3C%2Fdiv%3E%0D%0A%3C%2Fdiv%3E') ),
			'after'  		 => '<div class="cs-text-muted"><br>'. esc_attr__('Write your HTML code for Under Construction page body content', 'acadevo').'</div>',
        ),
		array(
			'id'      		=> 'uconstruction_background',
			'type'    		=> 'themetechmount_background',
			'title'  		=> esc_attr__('Background Properties', 'acadevo' ),
			'dependency'	 => array('uconstruction','==','true'),
			'after'  		=> '<div class="cs-text-muted"><br>'.esc_attr__('Set background options. This is for main body background', 'acadevo').'</div>',
			'default'		=> array(
				'image'			=> get_template_directory_uri() . '/images/uconstruction-bg.jpg',
				'repeat'		=> 'no-repeat',
				'position'		=> 'center top',
				'attachment'	=> 'fixed',
				'size'			=> 'cover',
				'color'			=> '#ffffff',
			),
			'output'      	=> '.uconstruction_background',
        ),
		array(
			'id'       		 => 'uconstruction_css_code',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('CSS Code for Under Construction page', 'acadevo'),
			'after'  		 => '<div class="cs-text-muted"><br>'. esc_attr__('Write your custom CSS code here', 'acadevo').'</div>',
			'dependency'	 => array('uconstruction','==','true'),
			'default' 		 => urldecode('%40import+url%28%22https%3A%2F%2Ffonts.googleapis.com%2Fcss%3Ffamily%3DOpen%2BSans%3A300%2C300i%2C400%2C400i%2C600%2C600i%2C700%2C700i%22%29%3B%0D%0Abody%7B%0D%0Apadding%3A+0%3B%0D%0Amargin%3A+0%3B%0D%0A%7D+%0D%0A.heading%2C+.subheading%7B+%0D%0Afont-family%3A+%22%22Open+Sans%22%2C+Arial%2C+Helvetica%2C+sans-serif%3B%0D%0A%7D+%0D%0A.heading%7B%0D%0Afont-size%3A+60px%3B%0D%0Aline-height%3A+65px%3B+%0D%0Aletter-spacing%3A+1px%3B%0D%0Amargin%3A+0%3B%0D%0Amargin-bottom%3A%0D%0A0px%3B+margin-bottom%3A+18px%3B%0D%0Afont-weight%3A+600%3B%0D%0Aletter-spacing%3A+2px%3B%0D%0Acolor%3A+%23283d58%3B%0D%0A+%7D+%0D%0A.subheading%7B%0D%0Afont-size%3A+23px%3B%0D%0Aline-height%3A+30px%3B%0D%0Acolor%3A+%23828c96%3B%0D%0Aletter-spacing%3A+1px%3B%0D%0Amargin%3A+0%3B%0D%0Afont-weight%3A+normal%3B%0D%0A%7D+%0D%0A.un-main-page-content%7B+%0D%0Aposition%3A+absolute%3B%0D%0Aleft%3A+50%25%3B%0D%0Atop%3A+45%25%3B%0D%0A-khtml-transform%3A+translateX%28-50%25%29+translateY%28-50%25%29%3B%0D%0A-moz-transform%3A+translateX%28-50%25%29+translateY%28-50%25%29%3B+%0D%0A-ms-transform%3A+translateX%28-50%25%29+translateY%28-50%25%29%3B%0D%0A-o-transform%3A+translateX%28-50%25%29+translateY%28-50%25%29%3B%0D%0Atransform%3A+translateX%28-50%25%29+translateY%28-50%25%29%3B%0D%0A+%7D%0D%0A.tm-sc-logo%7B+%0D%0Amargin-bottom%3A+40px%3B%0D%0Adisplay%3A+inline-block%3B%0D%0A%7D'),
        ),
		
		
	)
);




// Seperator
$tm_framework_options[] = array(
	'name'   => 'tm_seperator_1',
	'title'  => esc_attr__('Advanced', 'acadevo'),
	'icon'   => 'fa fa-ellipsis-h'
);

$cssfile = (is_multisite()) ? 'php' : 'css' ;



// Advanced Settings
$tm_framework_options[] = array(
	'name'   => 'advanced_settings', // like ID
	'title'  => esc_attr__('Advanced Settings', 'acadevo'),
	'icon'   => 'fa fa-wrench',
	'fields' => array( // begin: fields
		array(
			'type'       	=> 'heading',
			'content'    	=> sprintf( esc_attr__('Custom Post Type : %s (Portfolio) Settings', 'acadevo'), $pf_title_singular ),
			'after'  		=> '<small>'. esc_attr__('Advanced settings for Portfolio custom post type', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'pf_type_title',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('Title for %s (Portfolio) Post Type', 'acadevo'), $pf_title_singular ),
			'default'  		=> esc_attr__('Portfolio', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This will change the Title for Portfolio post type section', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'pf_type_title_singular',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('Singular title for %s (Portfolio) Post Type', 'acadevo'), $pf_title_singular ),
			'default'  		=> esc_attr__('Portfolio', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This will change the Title for Portfolio post type section. Only for singular title.', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'pf_type_slug',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('URL Slug for %s (Portfolio) Post Type', 'acadevo'), $pf_title_singular ),
			'default'  		=> esc_attr('portfolio'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This will change the URL slug for Portfolio post type section', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'pf_cat_title',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('Title for %s (Portfolio Category) List', 'acadevo'), $pf_cat_title_singular ),
			'default'  		=> esc_attr__('Portfolio Categories', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('Title for Portfolio Category list for group page. This will appear at left sidebar', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'pf_cat_title_singular',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('Singular Title for %s (Portfolio Category) List', 'acadevo'), $pf_cat_title_singular ),
			'default'  		=> esc_attr__('Portfolio Category', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('Title for Portfolio Category list for group page. This will appear at left sidebar', 'acadevo').'</div>',
		),
		array(
			'id'     		=> 'pf_cat_slug',
			'type'    		=> 'text',
			'title'   		=> sprintf( esc_attr__('URL Slug for %s (Portfolio Category) Link', 'acadevo'), $pf_cat_title_singular ),
			'default'  		=> esc_attr__('portfolio-category', 'acadevo'),
			'after'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This will change the URL slug for Portfolio Category link', 'acadevo').'</div>',
		),
		
		
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Minify Options', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Options to minify HTML/JS/CSS files', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'minify',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Minify JS and CSS files', 'acadevo'),
			'default' 		=> true,
			'label'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('This will generate MIN version of all CSS and JS files. This will help you to lower the page load time. You can use this if the Theme Options are not working', 'acadevo').'</div>',
        ),
		
		// Thumb Image Size Options
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Box Image Size Options', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Set Image size for Portfolio, Team Member and Blog boxes.', 'acadevo').'</small>',
		),
		array(
			'id'     	=> 'img-size-blog',
			'type'    	=> 'themetechmount_dimensions',
			'title'  	=> esc_attr__( 'Blog Box - Thumb image size', 'acadevo' ),
			'desc'      => esc_attr__( 'Set width and height of the Blog Box image in Visual Composer element (on frontend site)', 'acadevo' ),
			'after'     => '<p><a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">'. esc_attr__('Click here to know more about hard crop.', 'acadevo') . '</a></p><p>' . esc_attr__('After changing these settings you may need to %1$s regenerate your thumbnails %2$s.', 'acadevo') . ' <a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' . esc_attr__('You can use "Regenerate Thumbnails" plugin.', 'acadevo') . '</a></p>',
			'default' 	=> array(
				'width'		=> '1200',
				'height'	=> '800',
				'crop'		=> 'yes',
			),
        ),
				
		array(
			'id'     	=> 'img-size-blog-top',
			'type'    	=> 'themetechmount_dimensions',
			'title'  	=> esc_attr__( 'Blog Box - Thumb image size  (For Top Image Bottom Content Content Only)', 'acadevo' ),
			'desc'      => esc_attr__( 'Set width and height of the Blog Box image in Visual Composer element (on frontend site)', 'acadevo' ),
			'after'     => '<p><a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">'. esc_attr__('Click here to know more about hard crop.', 'acadevo') . '</a></p><p>' . esc_attr__('After changing these settings you may need to %1$s regenerate your thumbnails %2$s.', 'acadevo') . ' <a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' . esc_attr__('You can use "Regenerate Thumbnails" plugin.', 'acadevo') . '</a></p>',
			'default' 	=> array(
				'width'		=> '720',
				'height'	=> '544',
				'crop'		=> 'yes',
			),
        ),
		
		array(
			'id'     	=> 'img-size-portfolio',
			'type'    	=> 'themetechmount_dimensions',
			'title'  	=> sprintf( esc_attr__( '%s (Portfolio) Box - Thumb image size', 'acadevo' ), $pf_title_singular ),
			'desc'      => esc_attr__( 'Set width and height of the Portfolio Box image in Visual Composer element (on frontend site)', 'acadevo' ),
			'after'     => '<p><a href="'. esc_url('http://www.davidtan.org/wordpress-hard-crop-vs-soft-crop-difference-comparison-example/') .'" target="_blank">'. esc_attr__('Click here to know more about hard crop.', 'acadevo') . '</a></p><p>' . esc_attr__('After changing these settings you may need to %1$s regenerate your thumbnails %2$s.', 'acadevo') . ' <a href="'. esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/') .'" target="_blank">' . esc_attr__('You can use "Regenerate Thumbnails" plugin.', 'acadevo') . '</a></p>',
			'default' 	=> array(
				'width'		=> '800',
				'height'	=> '600',
				'crop'		=> 'yes',
			),
        ),
		/* Icon library selector - Only selected libraries will be loaded in VC element */
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Enabled Icon Library', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Select icon library that you like to load in Visual Composer elements like "ThemetechMount Icon", "ThemetechMount Call to Action", "ThemetechMount Service Box" etc.', 'acadevo').'</small>',
		),
		array(
			'id'        => 'icon_library',
			'type'      => 'checkbox',
			'title'     => esc_attr__('Select icon library to load', 'acadevo'),
			'options'   => array(
					'linecons'       => esc_attr__( 'Linecons', 'acadevo' ),
					'themify'        => esc_attr__( 'Themify icons', 'acadevo' ),
			),
			'default'   => array( 'linecons', 'themify' ),
			'after'    	=> '<small>'.esc_attr__('Select icon library that you want to load. This will reduce load time of Visual Composer elements. But you can see only selected libraries in the icon dropdown.', 'acadevo').'</small>',
		),
		
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Show or hide Demo Content Setup option', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Show or hide "Demo Content Setup" option under "Layout Settings" tab', 'acadevo').'</small>',
		),
		array(
			'id'     		=> 'hide_demo_content_option',
			'type'   		=> 'switcher',
			'title'   		=> esc_attr__('Hide "Demo Content Setup" option', 'acadevo'),
			'default' 		=> false,
			'label'  		=> '<div class="cs-text-muted"><br>'. esc_attr__('Show or hide "Demo Content Setup" option under "Layout Settings" tab', 'acadevo').'</div>',
        ),
		
		
	)
);


// Custom Code
$tm_framework_options[] = array(
	'name'   => 'custom_code', // like ID
	'title'  => esc_attr__('Custom Code', 'acadevo'),
	'icon'   => 'fa fa-pencil-square-o',
	'fields' => array( // begin: fields
		
		// Custom Code
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Custom Code', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Add custom JS and CSS code', 'acadevo').'</small>',
		),
		array(
			'id'       		 => 'custom_css_code',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('CSS Code', 'acadevo'),
			'after'  		 => '<div class="cs-text-muted"><br>'. esc_attr__('Add custom CSS code here. This code will be appear at bottom of the dynamic css file so you can override any existing style', 'acadevo').'</div>',
        ),
		array(
			'id'       => 'custom_js_code',
			'type'     => 'wysiwyg',
			'title'    => esc_attr__('JS Code', 'acadevo'),
			'settings' => array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
				'quicktags'     => false,
			),
			'after'    => '<div class="cs-text-muted"><br>'. esc_attr__('Paste your JS code here', 'acadevo').'</div>',
		),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Custom HTML Code', 'acadevo'),
			'after'  		=> '<small>'. sprintf(__('Custom HTML Code for different areas. You can paste <strong>Google Analytics</strong> or any tracking code here', 'acadevo'),'<strong>', '</strong>').'</small>',
		),
		array(
			'id'       => 'customhtml_head',
			'type'     => 'wysiwyg',
			'title'    => esc_attr__('Custom Code for &lt;head&gt; tag', 'acadevo'),
			'settings' => array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
				'quicktags'     => false,
			),
			'after'    => '<div class="cs-text-muted"><br>'. esc_attr__('This code will appear in &lt;head&gt; tag. You can add your custom tracking code here', 'acadevo').'</div>',
		),
		array(
			'id'       => 'customhtml_bodystart',
			'type'     => 'wysiwyg',
			'title'    => esc_attr__('Custom Code after &lt;body&gt; tag', 'acadevo'),
			'settings' => array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
				'quicktags'     => false,
			),
			'after'    => '<div class="cs-text-muted"><br>'. esc_attr__('This code will appear after &lt;body&gt; tag. You can add your custom tracking code here', 'acadevo').'</div>',
		),
		array(
			'id'       => 'customhtml_bodyend',
			'type'     => 'wysiwyg',
			'title'    => esc_attr__('Custom Code before &lt;/body&gt; tag', 'acadevo'),
			'settings' => array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
				'quicktags'     => false,
			),
			'after'    => '<div class="cs-text-muted"><br>'. esc_attr__('This code will appear before &lt;/body&gt; tag. You can add your custom tracking code here', 'acadevo').'</div>',
		),
		
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Custom Code for Login page', 'acadevo'),
			'after'  		=> '<small>'. esc_attr__('Custom Code for Login pLogin page only. This will effect only login page and not effect any other pages or admin section', 'acadevo').'</small>',
		),
		array(
			'id'       		 => 'login_custom_css_code',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('CSS Code for Login Page', 'acadevo'),
			'after'  		 => '<div class="cs-text-muted"><br>'. esc_attr__('Write your custom CSS code here', 'acadevo').'</div>',
        ),
		array(
			'type'       	=> 'heading',
			'content'    	=> esc_attr__('Advanced Custom CSS Code Option', 'acadevo'),
		),
		array(
			'id'       		 => 'custom_css_code_top',
			'type'     		 => 'textarea',
			'title'    		 =>  esc_attr__('CSS Code (at top of the file)', 'acadevo'),
			'after'  		 => '<div class="cs-text-muted"><br>'. esc_attr__('Add custom CSS code here. This code will be appear at top of the css code. specially for "@import" style tag.', 'acadevo').'</div>',
        ),
		
		
	)
);


// Backup
$tm_framework_options[]   = array(
	'name'     => 'backup_section',
	'title'    => esc_attr__('Backup / Restore', 'acadevo'),
	'icon'     => 'fa fa-shield',
	'fields'   => array(
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => esc_attr__('You can save your current options. Download a Backup and Import', 'acadevo'),
		),
		array(
			'type'    => 'backup',
		),
	)
);
