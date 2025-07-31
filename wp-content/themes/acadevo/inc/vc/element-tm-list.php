<?php

/* Options */

$allParams = array(
	array(
		'type'       => 'dropdown',
		'heading'    => esc_attr__( 'List Type', 'acadevo' ),
		'param_name' => 'type',
		'value'      => array(
			esc_attr__( 'None', 'acadevo' )                    => 'none',
			esc_attr__( 'Icon', 'acadevo' )                    => 'icon',
			esc_attr__( 'Disc', 'acadevo' )                    => 'disc',
			esc_attr__( 'Circle', 'acadevo' )                  => 'circle',
			esc_attr__( 'Square', 'acadevo' )                  => 'square',
			esc_attr__( 'Decimal (1, 2, 3, 4)', 'acadevo' )    => 'decimal',
			esc_attr__( 'Alphabetic (A, B, C, D)', 'acadevo' ) => 'upper-alpha',
			esc_attr__( 'Roman (I, II, III, IV)', 'acadevo' )  => 'roman',
		),
		'std'         => 'icon',
		'description' => esc_attr__( 'Select list style.', 'acadevo' ),
	),

	array(
		'type'       => 'dropdown',
		'heading'    => esc_attr__( 'List icon color', 'acadevo' ),
		'param_name' => 'icon_color',
		'value'      => array( esc_attr__( 'Default (same as text color)', 'acadevo' ) => '' ) + themetechmount_getVcShared( 'colors' ),
		'std'         => 'skincolor',
		'description' => esc_attr__( 'Select icon color.', 'acadevo' ),
		'param_holder_class' => 'tm_vc_colored-dropdown',
		'edit_field_class'   => 'vc_col-sm-6 vc_column',
	),
	array(
		"type"        => "dropdown",
		"heading"     => esc_attr__("Text Color", "acadevo"),
		"description" => esc_attr__("Select text color.", "acadevo"),
		"param_name"  => "tm_textcolor",
		'value'       => array( esc_attr__( 'Default', 'acadevo' ) => '' ) + themetechmount_getVcShared( 'colors' ),
		'param_holder_class' => 'tm_vc_colored-dropdown',
		'edit_field_class'   => 'vc_col-sm-6 vc_column',
	),
	
	
	array(
		'type'       => 'dropdown',
		'heading'    => esc_attr__( 'List Font size', 'acadevo' ),
		'param_name' => 'textsize',
		'value'      => array(
			esc_attr__( 'Default', 'acadevo' )     => '',
			esc_attr__( 'Small', 'acadevo' )       => 'small',
			esc_attr__( 'Medium', 'acadevo' )      => 'medium',
			esc_attr__( 'Large', 'acadevo' )       => 'large',
			esc_attr__( 'Extra Large', 'acadevo' ) => 'xlarge',
		),
		'std'         => '',
		'description' => esc_attr__( 'Select list font size. This will also apply to icon too', 'acadevo' ),
	),
);

$icon_options = vc_map_integrate_shortcode(
	'tm-icon',
	'icon_',
	'',
	array(
		'include_only' => array(
			'type',
			'icon_fontawesome',
			'icon_linecons',
			'icon_themify',
		),
	),
	array(
		'element' => 'type',
		'value'   => 'icon',
	)
);

// Setting default icon for Font Awesome icon
foreach( $icon_options as $index=>$icon_option ){
	if( isset($icon_option['param_name']) && $icon_option['param_name']=='icon_icon_fontawesome' ){
		$icon_options[$index]['value'] = 'fa fa-angle-right';
	}
}




// each line
$lines = array();
$total = 20;
for( $x=1; $x <= $total ; $x++ ){
	$lines[] = array(
		'type'        => 'textarea_raw_html',
		'heading'     => sprintf( esc_attr__( 'List Line %s','acadevo' ), $x ),
		'param_name'  => 'line'.$x,
		'description' => esc_attr__( 'Enter text for the list line. Some HTML tags are allowed.', 'acadevo' ),
		'std'         => '',
		'value'       => '',
		'param_holder_class' => 'tm-simplify-textarea',
	);
}

// Merge all parameters
$params = array_merge( $allParams, $icon_options, $lines, array( vc_map_add_css_animation() ), array( themetechmount_vc_ele_extra_class_option() ), array( themetechmount_vc_ele_css_editor_option() ) );



// Changing default values
$i = 0;
foreach( $params as $param ){
	
	$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
	
	if( $param_name == 'icon_type' ){
		$params[$i]['std']   = 'fontawesome';
	
	} else if( $param_name == 'icon_icon_fontawesome' ){
		$params[$i]['value'] = 'fa fa-caret-right';
		$params[$i]['std']   = 'fa fa-caret-right';
		
	} else if( $param_name == 'icon_icon_linecons' ){
		$params[$i]['value'] = 'vc_li vc_li-location';
		$params[$i]['std']   = 'vc_li vc_li-location';
	
	} else if( $param_name == 'icon_icon_themify' ){
		$params[$i]['value'] = 'themifyicon ti-angle-double-right';
		$params[$i]['std']   = 'themifyicon ti-angle-double-right';

	}
	
	$i++;
}



global $tm_sc_params_list;
$tm_sc_params_list = $params;




vc_map( array(
	'name'		=> esc_attr__( 'ThemetechMount List', 'acadevo' ),
	'base'		=> 'tm-list',
	'class'		=> '',
	'icon'		=> 'icon-themetechmount-vc',
	'category'	=> esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	'params'	=> $params
) );