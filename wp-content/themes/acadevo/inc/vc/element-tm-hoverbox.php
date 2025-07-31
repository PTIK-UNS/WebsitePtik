<?php

/**
 *  ThemetechMount: hoverbox Box
 */

// Icon picker
$icons_params = vc_map_integrate_shortcode( 'tm-icon', 'i_', '',
	array(
		'include_only_regex' => '/^(type|icon_\w*)/',
	)
);

	$param_group = array(
				array(
						'type'        => 'attach_image',
						'heading'     => esc_attr__( 'Box Image', 'acadevo' ),
						'param_name'  => 'static_boximage',
						'description' => esc_attr__( 'Select image', 'acadevo' ),
						'group'       => esc_attr__( 'Content', 'acadevo' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'Box Title', 'acadevo' ),
						'param_name'  => 'static_boxtitle',
						'description' => esc_attr__( 'Enter text used as title', 'acadevo' ),
						'group'       => esc_attr__( 'Content', 'acadevo' ),
						'admin_label' => true,
				),
			);

// Merging icon with other options
$param_group = array_merge( $param_group, $icons_params );

$params =  array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Extra class name', 'acadevo' ),
					'param_name'  => 'el_class',
					'description' => esc_attr__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'acadevo' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Box Image size', 'acadevo' ),
					'param_name'  => 'boximg_size',
					'value'			=> 'full',
					'description' => esc_attr__( 'Enter image size (Example: "thumbnail", "medium", "large", "full"). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'acadevo' ),
					'group'       => esc_attr__( 'Content', 'acadevo' ),
				),
				array(
					'type' => 'param_group',
					'heading' => esc_attr__( 'Box Content', 'acadevo' ),
					'param_name' => 'box_content',
					'group'       => esc_attr__( 'Content', 'acadevo' ),
					'description' => esc_attr__( 'Set box content', 'acadevo' ),
					'params' => $param_group,
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

$params    = array_merge( $heading_element, $params, $boxParams );
	
	global $tm_vc_custom_element_hoverbox;
	$tm_vc_custom_element_hoverbox = $params;
		
	vc_map( array(
		'name'        => esc_attr__( 'ThemetechMount Hover Box', 'acadevo' ),
		'base'        => 'tm-hoverbox',
		"class"    => "",
		"icon"        => "icon-themetechmount-vc",
		'category'    => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
		'params'      => $params,
	) );