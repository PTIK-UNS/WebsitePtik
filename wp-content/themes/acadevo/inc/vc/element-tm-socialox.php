<?php

/* Options */


// Social services
$sociallist = array(
	esc_attr__('Select service','acadevo') => '',
	'Twitter'      => 'twitter',
	'YouTube'      => 'youtube',
	'Flickr'       => 'flickr',
	'Facebook'     => 'facebook',
	'LinkedIn'     => 'linkedin',
	'Google+'      => 'gplus',
	'yelp'         => 'yelp',
	'Dribbble'     => 'dribbble',
	'Pinterest'    => 'pinterest',
	'Podcast'      => 'podcast',
	'Instagram'    => 'instagram',
	'Xing'         => 'xing',
	'Vimeo'        => 'vimeo',
	'VK'           => 'vk',
	'Houzz'        => 'houzz',
	'Issuu'        => 'issuu',
	'Google Drive' => 'google-drive',
	'Rss Feed'     => 'rss',
);



/**
 * Box Design options
 */
$boxParams = themetechmount_box_params();


$allParams = array_merge(
	$heading_element,
	array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_attr__( 'Extra class name', 'acadevo' ),
			'param_name'  => 'el_class',
			'description' => esc_attr__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'acadevo' ),
		),
		array(
			'type'        => 'param_group',
			'heading'     => esc_attr__( 'Social Services List', 'acadevo' ),
			'param_name'  => 'socialservices',
			'description' => esc_attr__( 'Select social service and add URL for it.', 'acadevo' ).'<br><strong>'.esc_attr__('NOTE:','acadevo').'</strong> '.esc_attr__("You don't need to add URL if you are selecting 'RSS' in the social service",'acadevo'),
			'group'       => esc_attr__( 'Social Services', 'acadevo' ),
			'params'     => array(
				array( // First social service
					'type'        => 'dropdown',
					'heading'     => esc_attr__( 'Select Social Service', 'acadevo' ),
					'param_name'  => 'servicename',
					'std'         => 'none',
					'value'       => $sociallist,
					'description' => esc_attr__( 'Select social service', 'acadevo' ),
					'group'       => esc_attr__( 'Social Services', 'acadevo' ),
					'admin_label' => true,
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_attr__( 'Social URL', 'acadevo' ),
					'param_name'  => 'servicelink',
					'dependency'  => array(
						'element'            => 'servicename',
						'value_not_equal_to' => array( 'rss' )
					),
					'value'       => '',
					'description' => esc_attr__( 'Fill social service URL', 'acadevo' ),
					'group'       => esc_attr__( 'Social Services', 'acadevo' ),
					'admin_label' => true,
					'edit_field_class' => 'vc_col-sm-8 vc_column',
				),
			),
		),
		array( // First social service
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Select column', 'acadevo' ),
			'param_name'  => 'column',
			'value'       => array(
				esc_attr__('One column','acadevo')   => 'one',
				esc_attr__('Two column','acadevo')   => 'two',
				esc_attr__('Three column','acadevo') => 'three',
				esc_attr__('Four column','acadevo')  => 'four',
				esc_attr__('Five column','acadevo')  => 'five',
				esc_attr__('Six column','acadevo')   => 'six',
			),
			'std'         => 'six',
			'description' => esc_attr__( 'Select how many column will show the social icons', 'acadevo' ),
			'group'       => esc_attr__( 'Social Services', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		array( // First social service
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Social icon size', 'acadevo' ),
			'param_name'  => 'iconsize',
			'std'         => 'large',
			'value'       => array(
				esc_attr__('Small icon','acadevo')  => 'small',
				esc_attr__('Medium icon','acadevo') => 'medium',
				esc_attr__('Large icon','acadevo')  => 'large',
			),
			'description' => esc_attr__( 'Select social icon size', 'acadevo' ),
			'group'       => esc_attr__( 'Social Services', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
	),
	$boxParams,
	array(
		themetechmount_vc_ele_css_editor_option(),
	)
);


$params = $allParams;


global $tm_sc_params_clients;
$tm_sc_params_clients = $params;


vc_map( array(
	"name"     => esc_attr__("ThemetechMount Social Box", "acadevo"),
	"base"     => "tm-socialbox",
	"icon"     => "icon-themetechmount-vc",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"params"   => $params,
) );