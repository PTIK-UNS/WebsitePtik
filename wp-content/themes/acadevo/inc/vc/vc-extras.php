<?php

/**** Security ****/
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }



/**
 * Adding extra parameters in VC
 */
if( !function_exists('themetechmount_vc_add_extra_param') ){
function themetechmount_vc_add_extra_param(){
	
	// VC ROW : Text Color
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Text Color", "acadevo"),
		"description" => esc_attr__("Select text color.", "acadevo"),
		"param_name"  => "tm_textcolor",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("Default", "acadevo")     => "",
			esc_attr__("Dark Color", "acadevo")  => "dark",
			esc_attr__("White Color", "acadevo") => "white",
			esc_attr__("Skin Color", "acadevo")  => "skincolor",
		),
	));
	
	// VC ROW : Background Color
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Background Color", "acadevo"),
		"description" => esc_attr__("Select Background Color. If you select color and also select background Video or background Image than the color will be overlay with some opacity.", "acadevo"),
		"param_name"  => "tm_bgcolor",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("Default (From Design Options tab)", "acadevo") => "",
			esc_attr__('Dark grey color as background color', 'acadevo') => 'darkgrey',
			esc_attr__('Grey color as background color', 'acadevo')      => 'grey',
			esc_attr__('White color as background color', 'acadevo')     => 'white',
			esc_attr__('Skincolor color as background color', 'acadevo') => 'skincolor',
			
		),
	));
	
	// VC ROW : Background Image Position
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Background Image Position", "acadevo"),
		"description" => esc_attr__("Select Background Image Position", "acadevo"),
		"param_name"  => "tm_bgimage_position",
		"weight"      => 1,
		"value"       => array(
			esc_attr__('left top', "acadevo")      => 'left_top',
			esc_attr__('left center', "acadevo")   => 'left_center',
			esc_attr__('left bottom', "acadevo")   => 'left_bottom',
			esc_attr__('right top', "acadevo")     => 'right_top',
			esc_attr__('right center', "acadevo")  => 'right_center',
			esc_attr__('right bottom', "acadevo")  => 'right_bottom',
			esc_attr__('center center', "acadevo") => 'center_center',
			esc_attr__('center top', "acadevo")    => 'center_top',
			esc_attr__('center bottom', "acadevo") => 'center_bottom'
		),
		"std"  => "center_center",
	));
	
	// VC ROW : Fixed Background Image
	vc_add_param( 'vc_row', array(
		"type"        => "checkbox",
		"heading"     => esc_attr__("Fix Background Image", "acadevo"),
		"description" => esc_attr__("If checked, background image display fixed", "acadevo"),
		"param_name"  => "tm_bgimagefixed",
		"weight"      => 1,
		"std"  => "false",
	));
	
	// VC ROW : Break column in Tablet
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Break column in Responsive", "acadevo"),
		"description" => esc_attr__("Break columns (set in one row) in Desktop or Tablet screens. This is useful if your content breaks (or not fit) due to wider content in columns.", "acadevo"),
		"param_name"  => "break_in_responsive",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("None (default)", "acadevo")									=> "",
			esc_attr__('Break in small desktop (under 1200 pixel size)', "acadevo")	=> '1200',
			esc_attr__('Break in tablet (under 992 pixel size)', "acadevo")			=> '991',
		),
	));
	
	// VC ROW : Add Shadow effect
	vc_add_param( 'vc_row', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Add shadow?", "acadevo"),
		"description" => esc_attr__("Select YES to set shadow for the column.", "acadevo"),
		"param_name"  => "tm_shadow",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("No", "acadevo")  => "",
			esc_attr__('Yes', 'acadevo') => 'yes',
		),
	));
	
	// VC ROW : Z-index
	vc_add_param( 'vc_row', array(
		'type'			=> 'themetechmount_style_selector',
		'heading'		=> esc_attr__( 'Section position of this ROW (z-index of the ROW)', 'acadevo' ),
		'description'	=> esc_attr__( 'Select position of this ROW. This will add z-index css property to row. So you can overlap ROW on each over by setting this z-index css property.', 'acadevo' ),
		'param_name'	=> 'tm_zindex',
		"weight"      	=> 1,
		'std'			=> 'zero',
		'value'			=> array(
			array(
				'label'	=> esc_attr('Z-Index- Style 0','acadevo'),
				'value'	=> 'zero',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-0.jpg',
				'width'	=> '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 1','acadevo'),
				'value'	=> '1',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-1.jpg',
				'width' => '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 2','acadevo'),
				'value'	=> '2',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-2.jpg',
				'width' => '120px',
			),
		),
	));
	
	// VC ROW : Responsive css settings
	vc_add_param( 'vc_row', themetechmount_responsive_padding_margin_option() );
	
	// VC COLUMN : Text Color
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Text Color", "acadevo"),
		"description" => esc_attr__("Select text color", "acadevo"),
		"param_name"  => "tm_textcolor",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("Default", "acadevo")     => "",
			esc_attr__("Dark Color", "acadevo")  => "dark",
			esc_attr__("White Color", "acadevo") => "white",
			esc_attr__("Skin Color", "acadevo")  => "skincolor",
		),
	));
	
	// VC COLUMN : Background Color
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Background Color", "acadevo"),
		"description" => esc_attr__("Select Background Color. If you select color and also select background Image than the color will be overlay with some opacity", "acadevo"),
		"param_name"  => "tm_bgcolor",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("Default (From Design Options tab)", "acadevo") => "",
			esc_attr__('Dark grey color as background color', 'acadevo') => 'darkgrey',
			esc_attr__('Grey color as background color', 'acadevo')      => 'grey',
			esc_attr__('White color as background color', 'acadevo')     => 'white',
			esc_attr__('Skincolor color as background color', 'acadevo') => 'skincolor',
			
		),
	));
	
	// VC COLUMN : Lower padding in responsive mode
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Reduce spacing (Padding) from left/right area in responsive mode", "acadevo"),
		"description" => esc_attr__("This is useful if you set extra padding via 'Design Options' tab. This will reset spacing (padding) from left/right area for the column.", "acadevo"),
		"param_name"  => "reduce_extra_padding",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("None (default)", "acadevo")                       		   => "",
			esc_attr__('Reset in small desktop (under 1200 pixel size)', "acadevo") => '1200',
			esc_attr__('Reset in tablet (under 992 pixel size)', "acadevo")         => '991',
		),
	));
	
	// VC COLUMN : Exapand Column BG to left or right
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Exapand Column Background", "acadevo"),
		"description" => esc_attr__("Exapand Column BG to left or right. This will expand the Background image/color visibility to border of the browser border.", "acadevo"),
		"param_name"  => "tm_col_bg_expand",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("No expand (default)", "acadevo")                => "",
			esc_attr__('Exapand Column background to left', 'acadevo')  => 'left',
			esc_attr__('Exapand Column background to right', 'acadevo') => 'right',
		),
	));
	
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Background Image Position", "acadevo"),
		"description" => esc_attr__("Select Background Image Position", "acadevo"),
		"param_name"  => "tm_bgimage_position",
		"weight"      => 1,
		"value"       => array(
			esc_attr__('left top', "acadevo")      => 'left_top',
			esc_attr__('left center', "acadevo")   => 'left_center',
			esc_attr__('left bottom', "acadevo")   => 'left_bottom',
			esc_attr__('right top', "acadevo")     => 'right_top',
			esc_attr__('right center', "acadevo")  => 'right_center',
			esc_attr__('right bottom', "acadevo")  => 'right_bottom',
			esc_attr__('center center', "acadevo") => 'center_center',
			esc_attr__('center top', "acadevo")    => 'center_top',
			esc_attr__('center bottom', "acadevo") => 'center_bottom'
		),
		"std"  => "center_center",
	));
	
	// VC Column : Add Shadow
	vc_add_param( 'vc_column', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Add shadow?", "acadevo"),
		"description" => esc_attr__("Select YES to set shadow for the column.", "acadevo"),
		"param_name"  => "tm_shadow",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("No", "acadevo")  => "",
			esc_attr__('Yes', 'acadevo') => 'yes',
		),
	));
	
	// VC COLUMN : Z-index
	vc_add_param( 'vc_column', array(
		'type'			=> 'themetechmount_style_selector',
		'heading'		=> esc_attr__( 'Section position of this COLUMN (z-index of the COLUMN)', 'acadevo' ),
		'description'	=> esc_attr__( 'Select position of this COLUMN. This will add z-index css property to column. So you can overlap COLUMN on each over by setting z-index css property.', 'acadevo' ),
		'param_name'	=> 'tm_zindex',
		'std'			=> 'zero',
		"weight"      	=> 1,
		'value'			=> array(
			array(
				'label'	=> esc_attr('Z-Index- Style 0','acadevo'),
				'value'	=> 'zero',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-0.jpg',
				'width'	=> '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 1','acadevo'),
				'value'	=> '1',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-1.jpg',
				'width' => '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 2','acadevo'),
				'value'	=> '2',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-2.jpg',
				'width' => '120px',
			),
		),
	));
		
	// VC COLUMN : Responsive css settings
	vc_add_param( 'vc_column', themetechmount_responsive_padding_margin_option('column') );
	
	// VC ROW INNER : Break column in Tablet
	vc_add_param( 'vc_row_inner', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Break column in Responsive", "acadevo"),
		"description" => esc_attr__("Break columns (set in one row) in Desktop or Tablet screens. This is useful if your content breaks (or not fit) due to wider content in columns.", "acadevo"),
		"param_name"  => "break_in_responsive",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("None (default)", "acadevo")									=> "",
			esc_attr__('Break in small desktop (under 1200 pixel size)', "acadevo")	=> '1200',
			esc_attr__('Break in tablet (under 992 pixel size)', "acadevo")			=> '991',
		),
	));
	
	// VC ROW INNER : Add Shadow
	vc_add_param( 'vc_row_inner', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Add shadow?", "acadevo"),
		"description" => esc_attr__("Select YES to set shadow for the column.", "acadevo"),
		"param_name"  => "tm_shadow",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("No", "acadevo")  => "",
			esc_attr__('Yes', 'acadevo') => 'yes',
		),
	));
	
	// VC ROW : Z-index
	vc_add_param( 'vc_row_inner', array(
		'type'			=> 'themetechmount_style_selector',
		'heading'		=> esc_attr__( 'Section position of this ROW (z-index of the ROW)', 'acadevo' ),
		'description'	=> esc_attr__( 'Select position of this ROW. This will add z-index css property to row. So you can overlap ROW on each over by setting this z-index css property.', 'acadevo' ),
		'param_name'	=> 'tm_zindex',
		'std'			=> 'zero',
		"weight"      	=> 1,
		'value'			=> array(
			array(
				'label'	=> esc_attr('Z-Index- Style 0','acadevo'),
				'value'	=> 'zero',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-0.jpg',
				'width'	=> '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 1','acadevo'),
				'value'	=> '1',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-1.jpg',
				'width' => '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 2','acadevo'),
				'value'	=> '2',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-2.jpg',
				'width' => '120px',
			),
		),
	));
	
	// VC ROW INNER : Responsive css settings
	vc_add_param( 'vc_row_inner', themetechmount_responsive_padding_margin_option() );
	
	// VC COLUMN INNER : Text Color
	vc_add_param( 'vc_column_inner', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Text Color", "acadevo"),
		"description" => esc_attr__("Select text color", "acadevo"),
		"param_name"  => "tm_textcolor",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("Default", "acadevo")     => "",
			esc_attr__("Dark Color", "acadevo")  => "dark",
			esc_attr__("White Color", "acadevo") => "white",
			esc_attr__("Skin Color", "acadevo")  => "skincolor",
		),
	));
	
	// VC COLUMN INNER : Background Color
	vc_add_param( 'vc_column_inner', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Background Color", "acadevo"),
		"description" => esc_attr__("Select Background Color. If you select color and also select background Image than the color will be overlay with some opacity", "acadevo"),
		"param_name"  => "tm_bgcolor",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("Default (From Design Options tab)", "acadevo") => "",
			esc_attr__('Dark grey color as background color', 'acadevo') => 'darkgrey',
			esc_attr__('Grey color as background color', 'acadevo')      => 'grey',
			esc_attr__('White color as background color', 'acadevo')     => 'white',
			esc_attr__('Skincolor color as background color', 'acadevo') => 'skincolor',
			
		),
	));
	
	// VC COLUMN INNER : Lower padding in responsive mode
	vc_add_param( 'vc_column_inner', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Reduce spacing (Padding) from left/right area in responsive mode", "acadevo"),
		"description" => esc_attr__("This is useful if you set extra padding via 'Design Options' tab. This will reset spacing (padding) from left/right area for the column.", "acadevo"),
		"param_name"  => "reduce_extra_padding",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("None (default)", "acadevo")                       		   => "",
			esc_attr__('Reset in small desktop (under 1200 pixel size)', "acadevo") => '1200',
			esc_attr__('Reset in tablet (under 992 pixel size)', "acadevo")         => '991',
		),
	));
	
	// VC COLUMN INNER : Add Shadow
	vc_add_param( 'vc_column_inner', array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Add shadow?", "acadevo"),
		"description" => esc_attr__("Select YES to set shadow for the column.", "acadevo"),
		"param_name"  => "tm_shadow",
		"weight"      => 1,
		"value"       => array(
			esc_attr__("No", "acadevo")  => "",
			esc_attr__('Yes', 'acadevo') => 'yes',
		),
	));
	
	// VC COLUMN INNER : Z-index
	vc_add_param( 'vc_column_inner', array(
		'type'			=> 'themetechmount_style_selector',
		'heading'		=> esc_attr__( 'Section position of this COLUMN (z-index of the COLUMN)', 'acadevo' ),
		'description'	=> esc_attr__( 'Select position of this COLUMN. This will add z-index css property to column. So you can overlap COLUMN on each over by setting z-index css property.', 'acadevo' ),
		'param_name'	=> 'tm_zindex',
		'std'			=> 'zero',
		"weight"      	=> 1,
		'value'			=> array(
			array(
				'label'	=> esc_attr('Z-Index- Style 0','acadevo'),
				'value'	=> 'zero',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-0.jpg',
				'width'	=> '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 1','acadevo'),
				'value'	=> '1',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-1.jpg',
				'width' => '120px',
			),
			array(
				'label'	=> esc_attr('Z-Index- Style 2','acadevo'),
				'value'	=> '2',
				'thumb'	=> get_template_directory_uri() . '/inc/images/zindex-2.jpg',
				'width' => '120px',
			),
		),
	));
	
	// VC COLUMN INNER : Responsive css settings
	vc_add_param( 'vc_column_inner', themetechmount_responsive_padding_margin_option('column') );	
	
}
}
add_action( 'vc_after_init', 'themetechmount_vc_add_extra_param' );






/**
 *  Adding skincolor in some elements
 */
if( !function_exists('themetechmount_vc_add_skin_color') ){
function themetechmount_vc_add_skin_color() {
	
	// Add vc element in which you like to add skincolor
	$vc_element_array = array(
		array( 'vc_tta_accordion', 'color' ),
		array( 'vc_tta_tour', 'color' ),
		array( 'vc_tta_tabs', 'color' ),
		array( 'vc_toggle', 'color' ),
	);
	
	// looping vc elements and adding skincolor
	foreach( $vc_element_array as $vc_element ){
		$element = $vc_element[0];
		$option  = $vc_element[1];
		$param   = WPBMap::getParam( $element, $option );
		$colors  = $param['value'];
		if( is_array($colors) ){
			$colors = array_reverse($colors);
			$colors[__( '[Skin color]', 'acadevo' )] = 'skincolor';
			$param['value']      = array_reverse($colors);
		}
		vc_update_shortcode_param( $element, $param );
	}
	
}
}
add_action( 'vc_after_init', 'themetechmount_vc_add_skin_color', 2 ); /* Note: here we are using vc_after_init because WPBMap::GetParam and mutateParame are available only when default content elements are "mapped" into the system */



/**
 *  Modify default values for VC elements
 */
if( !function_exists('themetechmount_vc_change_default_values') ){
function themetechmount_vc_change_default_values() {
	
	$vc_element_array = array(
		array( 'vc_tta_accordion',	'shape',	'square' ),
		array( 'vc_tta_accordion',	'no_fill',	'true' ),
		array( 'vc_tta_accordion',	'color',	'white' ),
		array( 'vc_tta_accordion',	'gap',		'10' ),
		array( 'vc_tta_tabs',		'shape',	'square' ),
		array( 'vc_tta_tabs',		'no_fill_content_area',	'true' ),
		array( 'vc_tta_tabs',		'color',	'skincolor' ),
		
		// style="outline" shape="square" controls_size="lg" active_section="1" no_fill_content_area="true" el_class="tm-tourtab-style1"
		array( 'vc_tta_tour',		'style',	'outline' ),
		array( 'vc_tta_tour',		'shape',	'square' ),
		array( 'vc_tta_tour',		'controls_size',	'lg' ),
		array( 'vc_tta_tour',		'active_section',	'1' ),
		array( 'vc_tta_tour',		'no_fill_content_area',	'true' ),
		
		
		
	);
	
	
	// looping vc elements and adding skincolor
	foreach( $vc_element_array as $vc_element ){
		$element = $vc_element[0];
		$option  = $vc_element[1];
		$new_std = $vc_element[2];
	
		$param			= WPBMap::getParam( $element, $option );
		$param['std']	= $new_std;
		vc_update_shortcode_param( $element, $param );
	
	}
	
	
	
	
}
}
add_action( 'vc_after_init', 'themetechmount_vc_change_default_values' );







/********* Add extra Google Fonts in Custom Heading's Google Font list - Working Code Sample **********/
if( !function_exists('themetechmount_add_google_fonts') ){
function themetechmount_add_google_fonts($fonts_list){
	
	$return = $fonts_list;
	
	// reverse array so new font will be at top
	$return = array_reverse($return);
	
	// Adding: Source Sans Pro
	$Source_Sans_Pro->font_family = esc_attr('Source Sans Pro');
	$Source_Sans_Pro->font_styles = "200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic";
    $Source_Sans_Pro->font_types = "200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic";
	
	// Adding "Source Sans Pro" font in return variable
	$return[] = $Source_Sans_Pro;
	
	
	// Adding: Nunito Sans
	$Nunito_Sans->font_family = esc_attr('Nunito Sans');
	$Nunito_Sans->font_styles = "200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic";
    $Nunito_Sans->font_types = "200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic";
	
	// Adding "Nunito Sans" font in return variable
	$return[] = $Nunito_Sans;
	
	
	// Adding: Saira
	$Source_Saira->font_family = esc_attr('Saira');
	$Source_Saira->font_styles = "100,200,300,regular,500,600,700,800,900";
    $Source_Saira->font_types = "100 light regular:100:normal,200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal,900 bold regular:900:normal";
	
	// Adding "Source Sans Pro" font in return variable
	$return[] = $Source_Saira;
	

	
	// *** Removing: Montserrat font as VC is already providing but with less options
	foreach( $return as $key=>$val ){
		if( !empty($val->font_family) && $val->font_family == 'Montserrat' ){
			unset( $return[$key] );
		}
	}
	// *** Adding: Montserrat
	$Montserrat->font_family = esc_attr('Montserrat');
	$Montserrat->font_styles = "100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i";
    $Montserrat->font_types = "100 Thin:100:normal,100 Thin Italic:100:normal,200 Extra-Light:200:normal,200 Extra-light Italic:200:italic,300 Light:300:normal,300 Light Italic:300:italic,400 Regular:400:normal,400 Regular Italic:400:italic,500 Medium:500:normal,500 Medium Italic:500:italic,600 Semi-bold:600:normal,600 Semi-bold Italic:600:italic,700 Bold:700:normal,700 Bold Italic:700:italic,800 Extra-bold:800:normal,800 Extra-bold Italic:800:italic,900 Black:900:normal,900 Black Italic:900:italic";
	// Adding "Nunito Sans" font in return variable
	$return[] = $Montserrat;
	
	
	
	
	
	// again reverse
	$return = array_reverse($return);
	
	return $return;
}
}
add_filter('vc_google_fonts_get_fonts_filter', 'themetechmount_add_google_fonts');
/*************************************************************************************/






/********************* Modifying TAB SECTION adding our own icon picker ***********************/

if( function_exists('vc_map_update') ){
	
	function themetechmount_vc_edit_tab_element(){
		
		$params = vc_map_integrate_shortcode( 'vc_tta_section');
		$new_params = array();
		
		// adding new icon library
		foreach( $params as $key=>$param ){
			
			if( isset($param['param_name']) && $param['param_name']=='i_type' ){
				
				// adding new icon library
				$libraries = array_merge(
					array( esc_attr__('Acadevo Special Icons','acadevo') => 'tm_acadevo' ),
					$param['value']
				);
				
				$param['value'] = $libraries;
				
				// adding new option
				$new_params[] = $param;
				
				// adding icon picker : tm_acadevo
				
				$new_params[] = array(
					'type'        => 'themetechmount_iconpicker',
					'heading'     => esc_attr__( 'Icon', 'acadevo' ),
					'param_name'  => 'i_icon_tm_acadevo',
					'value'       => 'flaticon-healthy-breakfast', // default value to backend editor admin_label
					'settings'    => array(
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'kw_acadevo',
					),
					'dependency'  => array(
						'element'  => 'i_type',
						'value'    => 'tm_acadevo',
					),
					'description'      => esc_attr__( 'Select icon from library.', 'acadevo' ),
					'edit_field_class' => 'vc_col-sm-9 vc_column',
				);
				
				
				
			} else {
				
				$new_params[] = $param;
				
			}
			
			
		
		}
		

		
		vc_map_update( 'vc_tta_section', array( 'params'=>$new_params ) );
	}
	
	add_action( 'vc_after_init', 'themetechmount_vc_edit_tab_element' );
	
}


