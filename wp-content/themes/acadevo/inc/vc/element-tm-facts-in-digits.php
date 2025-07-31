<?php

/* Options */



$allParams1 =  array(
	array(
		'type'			=> 'textfield',
		'holder'		=> 'div',
		'class'			=> '',
		'heading'		=> esc_attr__('Header (optional)', 'acadevo'),
		'param_name'	=> 'title',
		'std'			=> esc_attr__('Title Text', 'acadevo'),
		'description'	=> esc_attr__('Enter text for the title. Leave blank if no title is needed.', 'acadevo')
	),
	array(
		"type"			=> "dropdown",
		"holder"		=> "div",
		"class"			=> "",
		"heading"		=> esc_attr__("Design", 'acadevo'),
		"param_name"	=> "view",
		"description"	=> esc_attr__('Select box design.' , 'acadevo'),
		'value' => array(
			esc_attr__( 'Top Center icon', 'acadevo' )           => 'topicon',
			esc_attr__( 'Left icon', 'acadevo' )                 => 'lefticon',
			esc_attr__( 'Right icon', 'acadevo' )                => 'righticon',
			esc_attr__( 'Left icon with separator', 'acadevo' )  => 'lefticon-border',
			esc_attr__( 'Right icon with separator', 'acadevo' ) => 'righticon-border',
			esc_attr__( 'Circle Progress Style', 'acadevo' ) 	  => 'circle-progress',
		),
		'std'           => 'topicon',
	),
	array(
		'type'       => 'checkbox',
		'heading'    => esc_attr__( 'Add icon?', 'acadevo' ),
		'param_name' => 'add_icon',
		'std'        => 'true',
		'edit_field_class'	=> 'vc_col-sm-6 vc_column',
		'dependency'  => array(
					'element'            => 'view',
					'value_not_equal_to' => array( 'circle-progress' ),
				),
	),
	array(
		'type'       => 'checkbox',
		'heading'    => esc_attr__( 'Add border?', 'acadevo' ),
		'param_name' => 'add_border',
		'std'        => 'false',
		'edit_field_class'	=> 'vc_col-sm-6 vc_column',
		'dependency'  => array(
					'element'            => 'view',
					'value_not_equal_to' => array( 'circle-progress' ),
				),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_attr__( 'Circle fill color', 'acadevo' ),
		'param_name' => 'circle_fill_color',
		'value'      => array(
				esc_attr__( 'Skincolor', 'acadevo' )      => 'skincolor',
				esc_attr__( 'Dark Grey', 'acadevo' )      => '20292f',
				esc_attr__( 'White', 'acadevo' ) 		   => '#fff',
			),
		'std'         => 'skincolor',
		'description' => esc_attr__( 'Select circle fill color.', 'acadevo' ),
		'param_holder_class' => 'tm_vc_colored-dropdown',
		'edit_field_class'   => 'vc_col-sm-6 vc_column',
		'dependency'  => array(
					'element'            => 'view',
					'value_not_equal_to' => array( 'topicon','lefticon','righticon','lefticon-border','righticon-border' ),
				),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_attr__( 'Circle empty color', 'acadevo' ),
		'param_name' => 'circle_empty_color',
		'value'      => array(
				esc_attr__( 'Skincolor', 'acadevo' )      => 'skincolor',
				esc_attr__( 'Dark Grey', 'acadevo' )      => '20292f',
				esc_attr__( 'White', 'acadevo' ) 		   => 'fff',
			),
		'std'         => '20292f',
		'description' => esc_attr__( 'Select circle empty color.', 'acadevo' ),
		'param_holder_class' => 'tm_vc_colored-dropdown',
		'edit_field_class'   => 'vc_col-sm-6 vc_column',
		'dependency'  => array(
					'element'            => 'view',
					'value_not_equal_to' => array( 'topicon','lefticon','righticon','lefticon-border','righticon-border'),
				),
	),


	
);


$icons_params = vc_map_integrate_shortcode( 'tm-icon', 'i_', '', array(
	'include_only_regex' => '/^(type|icon_\w*)/',
	// we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
), array(
	'element' => 'add_icon',
	'value' => 'true',
) );

$icons_params_new = array();

/* Adding class for two column */
foreach( $icons_params as $param ){
	$param['edit_field_class'] = 'vc_col-sm-6 vc_column';
	$icons_params_new[] = $param;
}



$allParams2 = array(
			array(
				'type'				=> 'textfield',
				'holder'			=> 'div',
				'class'				=> '',
				'heading'			=> esc_attr__('Rotating Number', 'acadevo'),
				'param_name'		=> 'digit',
				'std'				=> '100',
				'description'		=> esc_attr__('Enter rotating number digit here.', 'acadevo'),
			),
			array(
				'type'				=> 'textfield',
				'holder'			=> 'div',
				'heading'			=> esc_attr__('Text Before Number', 'acadevo'),
				'param_name'		=> 'before',
				'description'		=> esc_attr__('Enter text which appear just before the rotating numbers.', 'acadevo'),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column',
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"heading"		=> esc_attr__("Text Style",'acadevo'),
				"param_name"	=> "beforetextstyle",
				"description"	=> esc_attr__('Select text style for the text.', 'acadevo') . '<br>' . esc_attr__('Superscript text appears half a character above the normal line, and is rendered in a smaller font.','acadevo') . '<br>' . esc_attr__('Subscript text appears half a character below the normal line, and is sometimes rendered in a smaller font.','acadevo'),
				'value' => array(
					esc_attr__( 'Superscript', 'acadevo' ) => 'sup',
					esc_attr__( 'Subscript', 'acadevo' )   => 'sub',
					esc_attr__( 'Normal', 'acadevo' )      => 'span',
				),
				'std' => 'sup',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column',
			),
			array(
				'type'				=> 'textfield',
				'holder'			=> 'div',
				'class'				=> '',
				'heading'			=> esc_attr__('Text After Number', 'acadevo'),
				'param_name'		=> 'after',
				'description'		=> esc_attr__('Enter text which appear just after the rotating numbers.', 'acadevo'),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column',
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> esc_attr__("Text Style",'acadevo'),
				"param_name"	=> "aftertextstyle",
				"description"	=> esc_attr__('Select text style for the text.', 'acadevo') . '<br>' . esc_attr__('Superscript text appears half a character above the normal line, and is rendered in a smaller font.','acadevo') . '<br>' . esc_attr__('Subscript text appears half a character below the normal line, and is sometimes rendered in a smaller font.','acadevo'),
				'value' => array(
					esc_attr__( 'Superscript', 'acadevo' ) => 'sup',
					esc_attr__( 'Subscript', 'acadevo' )   => 'sub',
					esc_attr__( 'Normal', 'acadevo' )      => 'span',
				),
				'std' => 'sub',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column',
			),
			array(
				'type'			=> 'textfield',
				'holder'		=> 'div',
				'class'			=> '',
				'heading'		=> esc_attr__('Rotating digit Interval', 'acadevo'),
				'param_name'	=> 'interval',
				'std'			=> '5',
				'description'	=> esc_attr__('Enter rotating interval number here.', 'acadevo')
			)
);



// merging all options
$params = array_merge( $allParams1, $icons_params_new, $allParams2 );

// merging extra options like css animation, css options etc
$params = array_merge(
	$params,
	array( vc_map_add_css_animation() ),
	array( themetechmount_vc_ele_extra_class_option() ),
	array( themetechmount_vc_ele_css_editor_option() )
);




global $tm_sc_params_facts_in_digits;
$tm_sc_params_facts_in_digits = $params;






vc_map( array(
	'name'		=> esc_attr__( 'ThemetechMount Facts in digits', 'acadevo' ),
	'base'		=> 'tm-facts-in-digits',
	'class'		=> '',
	'icon'		=> 'icon-themetechmount-vc',
	'category'	=> esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	'params'	=> $params
) );

