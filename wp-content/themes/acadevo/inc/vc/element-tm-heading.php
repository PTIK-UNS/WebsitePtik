<?php

/* Options for ThemetechMount Heading and Subheading */


$h2_custom_heading = vc_map_integrate_shortcode( 'tm-custom-heading', 'h2_', esc_attr__( 'Heading', 'acadevo' ),
	array(
		'exclude' => array(
			'source',
			'text',
			'css',
		),
	),
	array(
		'element' => 'use_custom_fonts_h2',
		'value'   => 'true',
	)
);

// This is needed to remove custom heading _tag and _align options.
if ( is_array( $h2_custom_heading ) && ! empty( $h2_custom_heading ) ) {
	foreach ( $h2_custom_heading as $key => $param ) {
		if ( is_array( $param ) && isset( $param['type'] ) && 'font_container' === $param['type'] ) {
			$h2_custom_heading[ $key ]['value'] = '';
			if ( isset( $param['settings'] ) && is_array( $param['settings'] ) && isset( $param['settings']['fields'] ) ) {
				$sub_key = array_search( 'tag', $param['settings']['fields'] );
				if ( false !== $sub_key ) {
					unset( $h2_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
				} elseif ( isset( $param['settings']['fields']['tag'] ) ) {
					unset( $h2_custom_heading[ $key ]['settings']['fields']['tag'] );
				}
				$sub_key = array_search( 'text_align', $param['settings']['fields'] );
				if ( false !== $sub_key ) {
					unset( $h2_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
				} elseif ( isset( $param['settings']['fields']['text_align'] ) ) {
					unset( $h2_custom_heading[ $key ]['settings']['fields']['text_align'] );
				}
			}
		}
	}
}
$h4_custom_heading = vc_map_integrate_shortcode( 'tm-custom-heading', 'h4_', esc_attr__( 'Subheading', 'acadevo' ),
	array(
		'exclude' => array(
			'source',
			'text',
			'css',
		),
	),
	array(
		'element' => 'use_custom_fonts_h4',
		'value' => 'true',
	)
);

// This is needed to remove custom heading _tag and _align options.
if ( is_array( $h4_custom_heading ) && ! empty( $h4_custom_heading ) ) {
	foreach ( $h4_custom_heading as $key => $param ) {
		if ( is_array( $param ) && isset( $param['type'] ) && 'font_container' === $param['type'] ) {
			$h4_custom_heading[ $key ]['value'] = '';
			if ( isset( $param['settings'] ) && is_array( $param['settings'] ) && isset( $param['settings']['fields'] ) ) {
				$sub_key = array_search( 'tag', $param['settings']['fields'] );
				if ( false !== $sub_key ) {
					unset( $h4_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
				} elseif ( isset( $param['settings']['fields']['tag'] ) ) {
					unset( $h4_custom_heading[ $key ]['settings']['fields']['tag'] );
				}
				$sub_key = array_search( 'text_align', $param['settings']['fields'] );
				if ( false !== $sub_key ) {
					unset( $h4_custom_heading[ $key ]['settings']['fields'][ $sub_key ] );
				} elseif ( isset( $param['settings']['fields']['text_align'] ) ) {
					unset( $h4_custom_heading[ $key ]['settings']['fields']['text_align'] );
				}
			}
		}
	}
}
$params = array_merge(
	array(
		array(
			'type'             => 'textarea',
			'heading'          => esc_attr__( 'Heading', 'acadevo' ),
			'admin_label'      => true,
			'param_name'       => 'h2',
			'value'            => '',
			'description'      => esc_attr__( 'Enter text for heading line.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-9 vc_column',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_attr__( 'Use custom font?', 'acadevo' ),
			'param_name'       => 'use_custom_fonts_h2',
			'description'      => esc_attr__( 'Enable Google fonts.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-3 vc_column',
		),

	),
	$h2_custom_heading,
	array(
		array(
			'type'             => 'textarea',
			'heading'          => esc_attr__( 'Subheading', 'acadevo' ),
			'param_name'       => 'h4',
			'value'            => '',
			'description'      => esc_attr__( 'Enter text for subheading line.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-9 vc_column',
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_attr__( 'Use custom font?', 'acadevo' ),
			'param_name'       => 'use_custom_fonts_h4',
			'description'      => esc_attr__( 'Enable custom font option.', 'acadevo' ),
			'edit_field_class' => 'vc_col-sm-3 vc_column',
		),
	),
	
	$h4_custom_heading,
	
	array(
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_attr__( 'Text', 'acadevo' ),
			'param_name' => 'content',
			'value'      => esc_attr__( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'acadevo' )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Text alignment', 'acadevo' ),
			'param_name'  => 'txt_align',
			'std'		  => 'left',
			'value'       => themetechmount_getVcShared( 'text align' ), // default left
			'description' => esc_attr__( 'Select text alignment in "Call to Action" block.', 'acadevo' ),
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_attr__( 'Reverse heading order', 'acadevo' ),
			'param_name'       => 'reverse_heading',
			'description'      => esc_attr__( 'Show sub-heading before heading.', 'acadevo' ),
			'std'			   => 'true',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Seperator', 'acadevo' ),
			'param_name'  => 'seperator',
			'value'       => array(
				esc_attr__( 'Solid', 'acadevo' )		=> 'solid',
				esc_attr__( 'None', 'acadevo' )			=> 'none',
			),
			'description' => esc_attr__( 'Show separator between Heading and Subheading', 'acadevo' ),
			'std'		  => 'solid',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Heading Style', 'acadevo' ),
			'param_name'  => 'heading_style',
			'value'       => array(
				esc_attr__( 'Vertical (Default)', 'acadevo' )	=> 'vertical',
				esc_attr__( 'Horizontal', 'acadevo' )			=> 'horizontal',
			),
			'description' => esc_attr__( 'Select Heading Style', 'acadevo' ),
			'std'  		  => 'vertical',
			'dependency'  => array(
					'element'            => 'seperator',
					'value_not_equal_to' => array( 'after_before' ),
				),
		),

	),

	array(
		/// cta3
		vc_map_add_css_animation(),
		themetechmount_vc_ele_extra_class_option(),
		themetechmount_vc_ele_css_editor_option(),
	)
);



	
global $tm_sc_params_heading;
$tm_sc_params_heading = $params;



vc_map( array(
	'name'     => esc_attr__( 'ThemetechMount Heading and Subheading', 'acadevo' ),
	'base'     => 'tm-heading',
	'icon'     => 'icon-themetechmount-vc',
	'category' => array( esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ) ),
	'since'    => '4.5',
	'params'   => $params,
	'js_view'  => 'VcCallToActionView3',
) );