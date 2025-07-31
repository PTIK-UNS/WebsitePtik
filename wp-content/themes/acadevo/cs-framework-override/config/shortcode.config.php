<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// SHORTCODE GENERATOR OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options       = array();

// -----------------------------------------
// Basic Shortcode Examples                -
// -----------------------------------------
$options[]     = array(
  'title'      => 'ThemetechMount Special Shortcodes',
  'shortcodes' => array(
	
	//Site Tagline
	array(
		'name'      => 'tm-site-tagline',
		'title'     => esc_attr__('Site Tagline', 'acadevo'),
		'fields'    => array(
			array(
				'type'    => 'content',
				'content' => esc_attr__('This shortcode will show the Site Tagline. There are no options for this shortcode. So just click Insert Shortcode button below to add this shortcode. ', 'acadevo'),
			),
      ),
    ),
	// Site Title
	array(
		'name'      => 'tm-site-title',
		'title'     => esc_attr__('Site Title', 'acadevo'),
		'fields'    => array(

			array(
				'type'    => 'content',
				'content' => esc_attr__('This shortcode will show the Site Title. There are no options for this shortcode. So just click Insert Shortcode button below to add this shortcode.', 'acadevo'),
			),

      ),
    ),
	// Site URL
	array(
		'name'      => 'tm-site-url',
		'title'     => esc_attr__('Site URL', 'acadevo'),
		'fields'    => array(

			array(
				'type'    => 'content',
				'content' => esc_attr__('This shortcode will show the Site URL. There are no options for this shortcode. So just click Insert Shortcode button below to add this shortcode.', 'acadevo'),
			),

      ),
    ),
	// Site LOGO
	array(
		'name'      => 'tm-logo',
		'title'     => esc_attr__('Site Logo', 'acadevo'),
		'fields'    => array(

			array(
				'type'    => 'content',
				'content' => esc_attr__('This shortcode will show the Site Logo. There are no options for this shortcode. So just click Insert Shortcode button below to add this shortcode.', 'acadevo'),
			),

      ),
    ),
	// Current Year
	array(
		'name'      => 'tm-current-year',
		'title'     => esc_attr__('Current Year', 'acadevo'),
		'fields'    => array(

			array(
				'type'    => 'content',
				'content' => esc_attr__('This shortcode will show the Current Year. There are no options for this shortcode. So just click Insert Shortcode button below to add this shortcode.', 'acadevo'),
			),

      ),
    ),
	// Footer Menu
	array(
		'name'      => 'tm-footermenu',
		'title'     => esc_attr__('Footer Menu', 'acadevo'),
		'fields'    => array(

			array(
				'type'    => 'content',
				'content' => esc_attr__('This shortcode will show the Footer Menu. There are no options for this shortcode. So just click Insert Shortcode button below to add this shortcode.', 'acadevo'),
			),

      ),
    ),
	// Skin Color
	array(
		'name'      => 'tm-skincolor',
		'title'     => esc_attr__('Skin Color', 'acadevo'),
		'fields'    => array(

			array(
				'type'   	 => 'content',
				'content'	 => esc_attr__('This shortcode will show the Text in Skin Color', 'acadevo'),
			),
			 array(
				'id'         => 'content',
				'type'       => 'text',
				'title'      => esc_attr__('Skin Color Text', 'acadevo'),
				'after'   	 => '<div class="cs-text-muted"><br>'.esc_attr__('The content is this box will be shown in Skin Color', 'acadevo').'</div>', 
			),

      ),
    ),
	// Dropcaps
	array(
		'name'      => 'tm-dropcap',
		'title'     => esc_attr__('Dropcap', 'acadevo'),
		'fields'    => array(
			array(
				'type'   	 => 'content',
				'content'	 => esc_attr__('This will show text in dropcap style.', 'acadevo'),
			),
			array(
				'id'        	=> 'style',
				'title'     	=> esc_attr__('Style', 'acadevo'),
				'type'      	=> 'image_select',
				'options'    	=> array(
									''        => get_template_directory_uri() .'/inc/images/dropcap1.png',
									'square'  => get_template_directory_uri() .'/inc/images/dropcap2.png',
									'rounded' => get_template_directory_uri() .'/inc/images/dropcap3.png',
									'round'   => get_template_directory_uri() .'/inc/images/dropcap4.png',
								),
				'default'     	=> ''
			),
			array(
				'id'         	=> 'bgcolor',
				'type'       	=> 'select',
				'title'     	=> esc_attr__('Background Color', 'acadevo'),
				'options'    	=> array(
									'white' 	    => esc_attr__('White', 'acadevo'),
									'skincolor'     => esc_attr__('Skin Color', 'acadevo'),
									'grey' 			=> esc_attr__('Grey', 'acadevo'),
									'dark' 		    => esc_attr__('Dark', 'acadevo'),
								),
				'class'         => 'chosen',
				'default'     	=> 'skincolor'
			),
			array(
				'id'         	=> 'color',
				'type'       	=> 'select',
				'title'     	=> esc_attr__('Color', 'acadevo'),
				'options'    	=> array(
									'skincolor'     => esc_attr__('Skin Color', 'acadevo'),
									'white' 	    => esc_attr__('White', 'acadevo'),
									'grey' 			=> esc_attr__('Grey', 'acadevo'),
									'dark' 		    => esc_attr__('Dark', 'acadevo'),
								),
				'class'         => 'chosen',
				'default'     	=> 'skincolor'
			),
			 array(
				'id'         	=> 'content',
				'type'      	=> 'text',
				'title'     	=> esc_attr__('Text', 'acadevo'),
				'after'   	 	=> '<div class="cs-text-muted"><br>'.esc_attr__('The Letter in this box will be shown Dropcapped', 'acadevo').'</div>', 
			),

      ),
    ),
	
	
 
  ),
);



CSFramework_Shortcode_Manager::instance( $options );
