<?php

/* Options */


$clientsGroupList = array();
if( taxonomy_exists('tm_client_group') ){
	$clientsGroupList_data = get_terms( 'tm_client_group', array( 'hide_empty' => false ) );
	$clientsGroupList      = array();
	foreach($clientsGroupList_data as $cat){
		$clientsGroupList[ esc_attr($cat->name) . ' (' . esc_attr($cat->count) . ')' ] = esc_attr($cat->slug);
	}
}


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
			"heading"     => esc_attr__("Client Logo Design",'acadevo'),
			"description" => esc_attr__("Select Client logo design.",'acadevo'),
			"param_name"  => "view",
			"value"       => themetechmount_global_client_template_list( true ),
			"std"         => "simple-logo",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_attr__("Show", "acadevo"),
			"param_name"  => "show",
			"description" => esc_attr__("Total Clients Logos you want to show.", "acadevo"),
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
				esc_attr__("11", "acadevo") => "11",
				esc_attr__("12", "acadevo") => "12",
				esc_attr__("13", "acadevo") => "13",
				esc_attr__("14", "acadevo") => "14",
				esc_attr__("15", "acadevo") => "15",
				esc_attr__("16", "acadevo") => "16",
				esc_attr__("17", "acadevo") => "17",
				esc_attr__("18", "acadevo") => "18",
				esc_attr__("19", "acadevo") => "19",
				esc_attr__("20", "acadevo") => "20",
			),
			"std"  => "10",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_attr__("From Group", "acadevo"),
			"param_name"  => "category",
			"description" => esc_attr__("Select group so it will show client logo from selected group only.", "acadevo"),
			"value"       => $clientsGroupList,
			"std"         => "",
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_attr__("Show Tooltip on Logo?",'acadevo'),
			"description" => esc_attr__("Select YES to show Tooltip on the logo.",'acadevo'),
			"param_name"  => "show_tooltip",
			"value"       => array(
				esc_attr__("Yes", "acadevo") => "yes",
				esc_attr__("No", "acadevo")  => "no",
			),
			"std"         => "yes",
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		array(
			"type"        => "dropdown",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_attr__("Add link to all logos?",'acadevo'),
			"description" => esc_attr__("Select YES to add link to all logos. Please note that link should be added to each client logo. If no link found than the logo will appear without link.",'acadevo'),
			"param_name"  => "add_link",
			"value"       => array(
				esc_attr__("Yes", "acadevo") => "yes",
				esc_attr__("No", "acadevo")  => "no",
			),
			"std"         => "yes",
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
		),
		
		
		
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
	if( $param_name == 'h2' ){
		$params[$i]['std'] = 'Our Clients';
	
	} else if( $param_name == 'column' ){
		$params[$i]['std'] = 'five';
		
	} else if( $param_name == 'boxview' ){
		$params[$i]['std'] = 'carousel';
		
	} else if( $param_name == 'content' ){
		$params[$i]['std'] = '';
		
	} else if( $param_name == 'carousel_loop' ){
		$params[$i]['std'] = '1';
		
	} else if( $param_name == 'carousel_dots' ){
		$params[$i]['std'] = 'true';
		
	} else if( $param_name == 'carousel_nav' ){
		$params[$i]['std'] = '0';
		
	} else if( $param_name == 'h2_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'h4_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
			
	} else if( $param_name == 'txt_align' ){
		$params[$i]['std'] = 'center';
		
	}
	
	$i++;
}


global $tm_sc_params_clients;
$tm_sc_params_clients = $params;


vc_map( array(
	"name"     => esc_attr__("ThemetechMount Client Logo Box", "acadevo"),
	"base"     => "tm-clientsbox",
	"icon"     => "icon-themetechmount-vc",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"params"   => $params,
) );