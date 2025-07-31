<?php

/**
 *  ThemetechMount: Schedule Box
 */


	$params = array_merge(
		themetechmount_vc_heading_params(),
		array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_attr__( 'Extra class name', 'acadevo' ),
				'param_name'  => 'el_class',
				'description' => esc_attr__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'acadevo' ),
			),
			array(
			'type' => 'param_group',
			'heading' => esc_attr__( 'Pricelist', 'acadevo' ),
			'param_name' => 'pricelist',
			'group'       => esc_attr__( 'Pricelist', 'acadevo' ),
			'description' => esc_attr__( 'Set Service price', 'acadevo' ),
			'value' => urlencode( json_encode( array(
				array(
					'service_name' => esc_attr__( 'Developemnt', 'acadevo' ),
					'price' => '$30',
				),
			
			))),
			'params' => array(
				array(
						'type'        => 'textarea',
						'heading'     => esc_attr__( 'Service Name', 'acadevo' ),
						'param_name'  => 'service_name',
						'description' => esc_attr__( 'Fill Service information here', 'acadevo' ),
						// 'value'       => '',
						'group'       => esc_attr__( 'Pricelist', 'acadevo' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
						'type'        => 'textarea',
						'heading'     => esc_attr__( 'Price', 'acadevo' ),
						'param_name'  => 'price',
						'description' => esc_attr__( 'Fill Price details here eg: $30', 'acadevo' ),
						'group'       => esc_attr__( 'Pricelist', 'acadevo' ),
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
			),
		),
			
			
		)
	);
	

	
	global $tm_vc_custom_element_pricelistbox;
	$tm_vc_custom_element_pricelistbox = $params;
	
	

	vc_map( array(
		'name'        => esc_attr__( 'ThemetechMount Pricelist Box', 'acadevo' ),
		'base'        => 'tm-pricelistbox',
		"class"    => "",
		"icon"        => "icon-themetechmount-vc",
		'category'    => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
		'params'      => $params,
	) );

