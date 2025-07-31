<?php

/* Options for ThemetechMount Icon */


/*
 * Icon Element
 * @since 4.4
 */


/**
 *  Show selected icon library only
 */
global $acadevo_theme_options;

// Temporary new list of icon libraries
$icon_library_array = array( // all icon library list array
	'themify'        => array( esc_attr__( 'Themify icons', 'acadevo' ),   'themifyicon ti-thumb-up'),
	'linecons'       => array( esc_attr__( 'Linecons', 'acadevo' ), 'vc_li vc_li-star'),
	'kw_acadevo'   => array( esc_attr__( 'Special Icons', 'acadevo' ), 'flaticon-honey'),
);


$icon_library = array();
if( isset($acadevo_theme_options['icon_library']) && is_array($acadevo_theme_options['icon_library']) && count($acadevo_theme_options['icon_library'])>0 ){
	// if selected icon library
	foreach( $acadevo_theme_options['icon_library'] as $i_library ){
		$icon_library[$i_library] = $icon_library_array[$i_library];
	}
}



$icon_element_array  = array();
$icon_dropdown_array = array( esc_attr__( 'Font Awesome', 'acadevo' )    => 'fontawesome' );   // Font Awesome icons
$icon_dropdown_array[ esc_attr__( 'Special Icons', 'acadevo' ) ] = 'kw_acadevo'; // Special icons

if( is_array($icon_library) && count($icon_library)>0 ){
foreach( $icon_library as $library_id=>$library ){
	
	$icon_dropdown_array[$library[0]] = $library_id;
	
	$icon_element_array[]  = array(
		'type'        => 'themetechmount_iconpicker',
		'heading'     => esc_attr__( 'Icon', 'acadevo' ),
		'param_name'  => 'icon_'.$library_id,
		'value'       => $library[1], // default value to backend editor admin_label
		'settings'    => array(
			'emptyIcon'    => false, // default true, display an "EMPTY" icon?
			'type'         => $library_id,
		),
		'dependency'  => array(
			'element'   => 'type',
			'value'     => $library_id,
		),
		'description' => esc_attr__( 'Select icon from library.', 'acadevo' ),
		'edit_field_class' => 'vc_col-sm-9 vc_column',
	);
	
	
}
}
/* Select icon library code end here */




// All icon related elements
$icon_elements = array_merge(
	array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Icon library', 'acadevo' ),
			'value'       => $icon_dropdown_array,
			'std'         => '',
			'admin_label' => true,
			'param_name'  => 'type',
			'description' => esc_attr__( 'Select icon library.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-3 vc_column',
		)
	),
	array(
		array(  // Font Awesome icons
			'type'       => 'themetechmount_iconpicker',
			'heading'    => esc_attr__( 'Icon', 'acadevo' ),
			'param_name' => 'icon_fontawesome',
			'value'      => 'fa fa-thumbs-o-up', // default value to backend editor admin_label
			'settings'   => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'fontawesome',
			),
			'dependency' => array(
				'element'  => 'type',
				'value'    => 'fontawesome',
			),
			'description' => esc_attr__( 'Select icon from library.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-9 vc_column',
		),
	),
	
	array(
		array(  // Acadevo special icons
			'type'       => 'themetechmount_iconpicker',
			'heading'    => esc_attr__( 'Icon', 'acadevo' ),
			'param_name' => 'icon_kw_acadevo',
			'value'      => 'flaticon-honey', // default value to backend editor admin_label
			'settings'   => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'kw_acadevo',
			),
			'dependency' => array(
				'element'  => 'type',
				'value'    => 'kw_acadevo',
			),
			'description' => esc_attr__( 'Select icon from library.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-9 vc_column',
		)
	),
	
	$icon_element_array
	
	
);


$allparams = array(
	array(
		'type'        => 'dropdown',
		'heading'     => esc_attr__( 'Icon color', 'acadevo' ),
		'param_name'  => 'color',
		'value'       => array_merge( 
			themetechmount_getVcShared( 'colors' ),
			array(
				esc_attr__( 'Classic Grey', 'acadevo' )      => 'bar_grey',
				esc_attr__( 'Classic Blue', 'acadevo' )      => 'bar_blue',
				esc_attr__( 'Classic Turquoise', 'acadevo' ) => 'bar_turquoise',
				esc_attr__( 'Classic Green', 'acadevo' )     => 'bar_green',
				esc_attr__( 'Classic Orange', 'acadevo' )    => 'bar_orange',
				esc_attr__( 'Classic Red', 'acadevo' )       => 'bar_red',
				esc_attr__( 'Classic Black', 'acadevo' )     => 'bar_black',
			),
			array( esc_attr__( 'Custom color', 'acadevo' ) => 'custom' )
		),
		'std'         => 'skincolor',
		'description' => esc_attr__( 'Select icon color.', 'acadevo' ),
		'param_holder_class' => 'tm_vc_colored-dropdown',
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_attr__( 'Custom color', 'acadevo' ),
		'param_name'  => 'custom_color',
		'description' => esc_attr__( 'Select custom icon color.', 'acadevo' ),
		'dependency'  => array(
			'element'   => 'color',
			'value'     => 'custom',
		),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_attr__( 'Background shape', 'acadevo' ),
		'param_name'  => 'background_style',
		'value'       => array(
			esc_attr__( 'None', 'acadevo' ) => '',
			esc_attr__( 'Circle', 'acadevo' ) => 'rounded',
			esc_attr__( 'Square', 'acadevo' ) => 'boxed',
			esc_attr__( 'Rounded', 'acadevo' ) => 'rounded-less',
			esc_attr__( 'Outline Circle', 'acadevo' ) => 'rounded-outline',
			esc_attr__( 'Outline Square', 'acadevo' ) => 'boxed-outline',
			esc_attr__( 'Outline Rounded', 'acadevo' ) => 'rounded-less-outline',
		),
		'std'         => '',
		'description' => esc_attr__( 'Select background shape and style for icon.', 'acadevo' ),
		'param_holder_class' => 'tm-simplify-textarea',
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_attr__( 'Background color', 'acadevo' ),
		'param_name'  => 'background_color',
		'value'       => array_merge( array( esc_attr__( 'Transparent', 'acadevo' ) => 'transparent' ), themetechmount_getVcShared( 'colors' ), array( esc_attr__( 'Custom color', 'acadevo' ) => 'custom' ) ),
		'std'         => 'grey',
		'description' => esc_attr__( 'Select background color for icon.', 'acadevo' ),
		'param_holder_class' => 'tm_vc_colored-dropdown',
		'dependency'  => array(
			'element'   => 'background_style',
			'not_empty' => true,
		),
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_attr__( 'Custom background color', 'acadevo' ),
		'param_name'  => 'custom_background_color',
		'description' => esc_attr__( 'Select custom icon background color.', 'acadevo' ),
		'dependency'  => array(
			'element'   => 'background_color',
			'value'     => 'custom',
		),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_attr__( 'Size', 'acadevo' ),
		'param_name'  => 'size',
		'value'       => array_merge( themetechmount_getVcShared( 'sizes' ), array( 'Extra Large' => 'xl' ) ),
		'std'         => 'md',
		'description' => esc_attr__( 'Icon size.', 'acadevo' )
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_attr__( 'Icon alignment', 'acadevo' ),
		'param_name' => 'align',
		'value'      => array(
			esc_attr__( 'Left', 'acadevo' )   => 'left',
			esc_attr__( 'Right', 'acadevo' )  => 'right',
			esc_attr__( 'Center', 'acadevo' ) => 'center',
		),
		'std'         => 'left',
		'description' => esc_attr__( 'Select icon alignment.', 'acadevo' ),
	),
	array(
		'type'        => 'vc_link',
		'heading'     => esc_attr__( 'URL (Link)', 'acadevo' ),
		'param_name'  => 'link',
		'description' => esc_attr__( 'Add link to icon.', 'acadevo' )
	),
	vc_map_add_css_animation(),
	themetechmount_vc_ele_extra_class_option(),
	themetechmount_vc_ele_css_editor_option(),
);


// All params
$params = array_merge( $icon_elements, $allparams );

	
	
global $tm_sc_params_icon;
$tm_sc_params_icon = $params;

	
	

vc_map( array(
	'name'     => esc_attr__( 'ThemetechMount Icon', 'acadevo' ),
	'base'     => 'tm-icon',
	'icon'     => 'icon-themetechmount-vc',
	'category' => array( esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ) ),
	'admin_enqueue_css' => array(get_template_directory_uri().'/assets/themify-icons/themify-icons.css', get_template_directory_uri().'/assets/twemoji-awesome/twemoji-awesome.css' ),
	'params'   => $params,
	'js_view'  => 'VcIconElementView_Backend',
) );
