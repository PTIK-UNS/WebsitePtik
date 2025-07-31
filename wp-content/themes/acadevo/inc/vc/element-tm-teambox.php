<?php

/* Options for ThemetechMount teambox */


/**
 * Heading Element
 */
$heading_element = vc_map_integrate_shortcode( 'tm-heading', '', '',
	array(
		'exclude' => array(
			'el_class',
			'css',
			'css_animation'
		),
	)
);

/**
 * Box Design options
 */
$boxParams = themetechmount_box_params();



$allParams = array_merge(

	$heading_element,
	array(
		array(
			"type"        => "themetechmount_style_selector",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_attr__("Box Design",'acadevo'),
			"description" => esc_attr__("Select box design.",'acadevo'),
			"param_name"  => "view",
			"value"       => themetechmount_global_team_member_template_list( true ),
			"std"         => "overlay",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_attr__("Show", "acadevo"),
			"param_name"  => "show",
			"description" => esc_attr__("How many %s item you want to show.", "acadevo"),
			"value"       => array(
				esc_attr__("All", "acadevo") => "-1",
				esc_attr__("1", "acadevo")  => "1",
				esc_attr__("2", "acadevo") => "2",
				esc_attr__("3", "acadevo") => "3",
				esc_attr__("4", "acadevo") => "4",
				esc_attr__("5", "acadevo") => "5",
				esc_attr__("6", "acadevo") => "6",
				esc_attr__("7", "acadevo") => "7",
				esc_attr__("8", "acadevo") => "8",
				esc_attr__("9", "acadevo") => "9",
				esc_attr__("10", "acadevo") => "10",
			),
			"std"  => "4",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_attr__("Show Pagination",'acadevo'),
			"description" => esc_attr__("Show pagination links below %s boxes.",'acadevo'),
			"param_name"  => "pagination",
			"value"       => array(
				esc_attr__('No','acadevo')  => 'no',
				esc_attr__('Yes','acadevo') => 'yes',
			),
			"std"         => "no",
			'dependency'  => array(
				'element'    => 'sortable',
				'value_not_equal_to' => array( 'yes' ),
			),
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_attr__("Order by",'acadevo'),
			"description" => esc_attr__("Sort retrieved %s by parameter.",'acadevo'),
			"param_name"  => "orderby",
			"value"       => array(
				esc_attr__('No order (none)','acadevo')           => 'none',
				esc_attr__('Order by post id (ID)','acadevo')     => 'ID',
				
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			"std"              => "date",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_attr__("Order",'acadevo'),
			"description" => esc_attr__("Designates the ascending or descending order of the 'orderby' parameter.",'acadevo'),
			"param_name"  => "order",
			"value"       => array(
				esc_attr__('Ascending (1, 2, 3; a, b, c)','acadevo')  => 'ASC',
				esc_attr__('Descending (3, 2, 1; c, b, a)','acadevo') => 'DESC',
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			"std"              => "DESC",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_attr__("Box Spacing", "acadevo"),
			"param_name"  => "box_spacing",
			"description" => esc_attr__("Spacing between each box.", "acadevo"),
			"value"       => array(
				esc_attr__("Default", "acadevo")                        => "",
				esc_attr__("0 pixel spacing (joint boxes)", "acadevo")  => "0px",
				esc_attr__("5 pixel spacing", "acadevo")                => "5px",
				esc_attr__("10 pixel spacing", "acadevo")               => "10px",
			),
			"std"  => "",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		)
	),
	$boxParams,
	array(
		themetechmount_vc_ele_css_editor_option(),
	)
	
);


$params = $allParams;


// Changing default values
$i = 0;
foreach( $params as $param ){
	$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
	if( $param_name == 'column' ){
		$params[$i]['std'] = 'four';
		
	} else if( $param_name == 'h2' ){
		$params[$i]['std'] = 'Our Team';
	
	} else if( $param_name == 'h2_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'h4_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
			
	} else if( $param_name == 'txt_align' ){
		$params[$i]['std'] = 'center';
		
	}
	
	$i++;
}


global $tm_sc_params_teambox;
$tm_sc_params_teambox = $params;


vc_map( array(
	"name"     => esc_attr__("ThemetechMount Team Box", "acadevo"),
	"base"     => "tm-teambox",
	"icon"     => "icon-themetechmount-vc",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"params"   => $params,
) );