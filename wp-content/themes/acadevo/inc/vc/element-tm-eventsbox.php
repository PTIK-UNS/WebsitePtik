<?php

/* Options */

$eventCatList = array();
if( taxonomy_exists('tribe_events_cat') ){
	$eventCatList_data = get_terms( 'tribe_events_cat', array( 'hide_empty' => false ) );
	$eventCatList      = array();
	foreach($eventCatList_data as $cat){
		$eventCatList[ esc_attr($cat->name) . ' (' . esc_attr($cat->count) . ')' ] = esc_attr($cat->slug);
	}
}


$allParams = array(
	array(
		"type"        => "themetechmount_style_selector",
		"heading"     => esc_attr__("Box Style", "acadevo"),
		"description" => esc_attr__("Select box style.", "acadevo"),
		"group"       => esc_attr__( "Box Design", "acadevo" ),
		"param_name"  => "view",
		'value'		  => array(
							array(
								'label'	=> esc_attr('Default Style','acadevo'),
								'value'	=> 'top-image',
								'thumb'	=> get_template_directory_uri() . '/inc/images/eventbox-style1.png',
							),
						),
		"std"         => "top-image",
		'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
	),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Show Events Item",'acadevo'),
		"description" => esc_attr__("How many events you want to show.",'acadevo'),
		"param_name"  => "show",
		"value"       => array(
			esc_attr__('All','acadevo') => '-1',
			esc_attr__('1','acadevo')  => '1',
			esc_attr__('2','acadevo') => '2',
			esc_attr__('3','acadevo')=>'3',
			esc_attr__('4','acadevo')=>'4',
			esc_attr__('5','acadevo')=>'5',
			esc_attr__('6','acadevo')=>'6',
			esc_attr__('7','acadevo')=>'7',
			esc_attr__('8','acadevo')=>'8',
			esc_attr__('9','acadevo')=>'9',
			esc_attr__('10','acadevo')=>'10',
			esc_attr__('11','acadevo')=>'11',
			esc_attr__('12','acadevo')=>'12',
			esc_attr__('13','acadevo')=>'13',
			esc_attr__('14','acadevo')=>'14',
			esc_attr__('15','acadevo')=>'15',
			esc_attr__('16','acadevo')=>'16',
			esc_attr__('17','acadevo')=>'17',
			esc_attr__('18','acadevo')=>'18',
			esc_attr__('19','acadevo')=>'19',
			esc_attr__('20','acadevo')=>'20',
			esc_attr__('21','acadevo')=>'21',
			esc_attr__('22','acadevo')=>'22',
			esc_attr__('23','acadevo')=>'23',
			esc_attr__('24','acadevo')=>'24',
		),
		"std"  => "3",
		'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
	),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Show Pagination",'acadevo'),
		"description" => esc_attr__("Show pagination links below Event boxes.",'acadevo'),
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
		"type"        => "checkbox",
		"heading"     => sprintf( esc_attr__("From %s", "acadevo"), 'Event Category'),		
		"param_name"  => "category",
		"value"       => $eventCatList,
		'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
	),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Order by",'acadevo'),
		"description" => esc_attr__("Sort retrieved events by parameter.",'acadevo'),
		"param_name"  => "orderby",
		"value"       => array(
			esc_attr__('No order (none)','acadevo')           => 'none',
			esc_attr__('Order by post id (ID)','acadevo')     => 'ID',
			esc_attr__('Order by author (author)','acadevo')  => 'author',
			esc_attr__('Order by title (title)','acadevo')    => 'title',
			esc_attr__('Order by slug (name)','acadevo')      => 'name',
			esc_attr__('Order by date (date)','acadevo')      => 'date',
			esc_attr__('Order by last modified date (modified)','acadevo') => 'modified',
			esc_attr__('Random order (rand)','acadevo')       => 'rand',
			esc_attr__('Order by number of comments (comment_count)','acadevo') => 'comment_count',
			
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
	),
	
);


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

$boxParams = themetechmount_box_params();
$params    = array_merge( $heading_element, $allParams, $boxParams );


// Changing default values
$i = 0;
foreach( $params as $param ){
	$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
	if( $param_name == 'h2' ){
		$params[$i]['std'] = 'Latest Events';
		
	} else if( $param_name == 'h2_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'h4_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	}
	$i++;
}


global $tm_sc_params_eventsbox;
$tm_sc_params_eventsbox = $params;


vc_map( array(
	"name"     => esc_attr__("ThemetechMount Events Box", "acadevo"),
	"base"     => "tm-eventsbox",
	"icon"     => "icon-themetechmount-vc",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"params"   => $params
) );