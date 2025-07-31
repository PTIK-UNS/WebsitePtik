<?php

/* Options for ThemetechMount Blogbox */


$portfolioCatList = array();
if( taxonomy_exists('tm_portfolio_category') ){
	$portfolioCatList_data = get_terms( 'tm_portfolio_category', array( 'hide_empty' => false ) );
	$portfolioCatList      = array();
	foreach($portfolioCatList_data as $cat){
		$portfolioCatList[ esc_attr($cat->name) . ' (' . esc_attr($cat->count) . ')' ] = esc_attr($cat->slug);
	}
}


// Getting Options
$acadevo_theme_options   = get_option('acadevo_theme_options');
$pf_type_title          = ( !empty($acadevo_theme_options['pf_type_title']) ) ? $acadevo_theme_options['pf_type_title'] : 'Portfolio' ;
$pf_type_title_singular = ( !empty($acadevo_theme_options['pf_type_title_singular']) ) ? $acadevo_theme_options['pf_type_title_singular'] : 'Portfolio' ;
$pf_cat_title           = ( !empty($acadevo_theme_options['pf_cat_title']) ) ? $acadevo_theme_options['pf_cat_title'] : 'Portfolio Categories' ;
$pf_cat_title_singular  = ( !empty($acadevo_theme_options['pf_cat_title_singular']) ) ? $acadevo_theme_options['pf_cat_title_singular'] : 'Portfolio Category' ;


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
				"value"       => themetechmount_global_portfolio_template_list( true ),
				"std"         => "overlay",
				'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_attr__("Show",'acadevo'),
				"description" => sprintf( esc_attr__("How many %s item you want to show.", "acadevo"), $pf_type_title ),
				"param_name"  => "show",
				"value"       => array(
					esc_attr__("All", "acadevo") => "-1",
					esc_attr__('1', "acadevo")   => "1",
					esc_attr__('2', "acadevo")   => "2",
					esc_attr__('3','acadevo')    =>'3',
					esc_attr__('4','acadevo')    =>'4',
					esc_attr__('5','acadevo')    =>'5',
					esc_attr__('6','acadevo')    =>'6',
					esc_attr__('7','acadevo')    =>'7',
					esc_attr__('8','acadevo')    =>'8',
					esc_attr__('9','acadevo')    =>'9',
					esc_attr__('10','acadevo')   =>'10',
					esc_attr__('11','acadevo')   =>'11',
					esc_attr__('12','acadevo')   =>'12',
					esc_attr__('13','acadevo')   =>'13',
					esc_attr__('14','acadevo')   =>'14',
					esc_attr__('15','acadevo')   =>'15',
					esc_attr__('16','acadevo')   =>'16',
					esc_attr__('17','acadevo')   =>'17',
					esc_attr__('18','acadevo')   =>'18',
					esc_attr__('19','acadevo')   =>'19',
					esc_attr__('20','acadevo')   =>'20',
					esc_attr__('21','acadevo')   =>'21',
					esc_attr__('22','acadevo')   =>'22',
					esc_attr__('23','acadevo')   =>'23',
					esc_attr__('24','acadevo')   =>'24',
				),
				"std"  => "3",
				'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_attr__("Show Sortable Category Links",'acadevo'),
				"description" => sprintf( esc_attr__("Show sortable category links above %s items so user can sort by just single click.",'acadevo'), $pf_type_title_singular ),
				"param_name"  => "sortable",
				"value"       => array(
					esc_attr__('No','acadevo')  => 'no',
					esc_attr__('Yes','acadevo') => 'yes',
				),
				"std"         => "no",
				'dependency'  => array(
					'element'            => 'boxview',
					'value_not_equal_to' => array( 'carousel' ),
				),
				'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_attr__( 'Replace ALL word', 'acadevo' ),
				'param_name'  => 'allword',
				'description' => esc_attr__( 'Replace ALL word in sortable category links. Default is ALL word.', 'acadevo' ),
				"std"         => "All",
				'dependency'  => array(
					'element'   => 'sortable',
					'value'     => array( 'yes' ),
				),
				'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_attr__( 'Sortable Button Type', 'acadevo' ),
				'description' => esc_attr__( 'Sortable Button type square or round', 'acadevo' ),
				'param_name'  => 'sortable_buttontype',
				"value"       => array(
					esc_attr__('Square','acadevo')  => 'square',
					esc_attr__('Round','acadevo') => 'round',
				),
				"std"         => "square",
				'dependency'  => array(
					'element'   => 'sortable',
					'value'     => array( 'yes' ),
				),
				'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_attr__("Show Pagination",'acadevo'),
				"description" => sprintf( esc_attr__("Show pagination links below %s boxes.",'acadevo'), $pf_type_title ),
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
				"heading"     => sprintf( esc_attr__("From %s", "acadevo"), $pf_cat_title_singular ),
				"description" => sprintf( esc_attr__('If you like to show %1$s from selected %2$s than select the category here.', "acadevo"), $pf_type_title, $pf_cat_title ),
				
				"param_name"  => "category",
				"value"       => $portfolioCatList,
				'group'		  => esc_attr__( 'Box Style', 'acadevo' ),
			),
			
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_attr__("Order by",'acadevo'),
				"description" => esc_attr__("Sort retrieved portfolio by parameter.",'acadevo'),
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
	if( $param_name == 'h2' ){
		$params[$i]['std'] = '';
		
	} else if( $param_name == 'h2_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'h4_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'txt_align' ){
		$params[$i]['std'] = 'center';
	}
	$i++;
}



global $tm_sc_params_portfoliobox;
$tm_sc_params_portfoliobox = $params;




vc_map( array(
	"name"     => sprintf( esc_attr__("ThemetechMount %s Box",'acadevo'), $pf_type_title_singular ),
	"base"     => "tm-portfoliobox",
	"class"    => "",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"icon"     => "icon-themetechmount-vc",
	"params"   => $params,
) );