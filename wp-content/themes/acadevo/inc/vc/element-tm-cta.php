<?php

/* Options for ThemetechMount Call To Action */


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
			'type'             => 'textfield',
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
			'type'             => 'textfield',
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
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Text alignment', 'acadevo' ),
			'param_name'  => 'txt_align',
			'value'       => themetechmount_getVcShared( 'text align' ), // default left
			'description' => esc_attr__( 'Select text alignment in "Call to Action" block.', 'acadevo' ),
		),
		array(
			'type'             => 'checkbox',
			'heading'          => esc_attr__( 'Reverse heading order', 'acadevo' ),
			'param_name'       => 'reverse_heading',
			'description'      => esc_attr__( 'Show sub-heading before heading.', 'acadevo' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Shape', 'acadevo' ),
			'param_name' => 'shape',
			'std'        => 'rounded',
			'value'      => array(
				esc_attr__( 'Square', 'acadevo' )  => 'square',
				esc_attr__( 'Rounded', 'acadevo' ) => 'rounded',
				esc_attr__( 'Round', 'acadevo' )   => 'round',
			),
			'description' => esc_attr__( 'Select call to action shape.', 'acadevo' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Style', 'acadevo' ),
			'param_name' => 'style',
			'value' => array(
				esc_attr__( 'Classic', 'acadevo' ) => 'classic',
				esc_attr__( 'Flat', 'acadevo' )    => 'flat',
				esc_attr__( 'Outline', 'acadevo' ) => 'outline',
				esc_attr__( '3d', 'acadevo' )      => '3d',
			),
			'std'         => 'classic',
			'description' => esc_attr__( 'Select call to action display style.', 'acadevo' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Color', 'acadevo' ),
			'param_name'  => 'color',
			'value'       => array_merge( array( esc_attr__('Transparent', 'acadevo' ) => 'transparent' ), themetechmount_getVcShared( 'colors-dashed' ) ),
			'std'         => 'transparent',
			'description' => esc_attr__( 'Select color for button.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_cta3-colored-dropdown',
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'custom' )
			),
		),
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_attr__( 'Text', 'acadevo' ),
			'param_name' => 'content',
			'value'      => esc_attr__( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'acadevo' )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Width', 'acadevo' ),
			'param_name' => 'el_width',
			'value'      => array(
					'100%' => '',
					'90%'  => 'xl',
					'80%'  => 'lg',
					'70%'  => 'md',
					'60%'  => 'sm',
					'50%'  => 'xs',
			),
			'description' => esc_attr__( 'Select call to action width (percentage).', 'acadevo' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Add button', 'acadevo' ) . '?',
			'description' => esc_attr__( 'Add button for call to action.', 'acadevo' ),
			'std'		  => 'right',
			'param_name'  => 'add_button',
			'value'       => array(
				esc_attr__( 'No', 'acadevo' )     => '',
				esc_attr__( 'Top', 'acadevo' )    => 'top',
				esc_attr__( 'Bottom', 'acadevo' ) => 'bottom',
				esc_attr__( 'Left', 'acadevo' )   => 'left',
				esc_attr__( 'Right', 'acadevo' )  => 'right',
			),
		),
	),
	vc_map_integrate_shortcode( 'tm-btn', 'btn_', esc_attr__( 'Button', 'acadevo' ),
		array(
			'exclude' => array( 'css' )
		),
		array(
			'element'   => 'add_button',
			'not_empty' => true,
		)
	),
	array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Add icon?', 'acadevo' ),
			'description' => esc_attr__( 'Add icon for call to action.', 'acadevo' ),
			'param_name'  => 'add_icon',
			'value'       => array(
				esc_attr__( 'No', 'acadevo' )     => '',
				esc_attr__( 'Top', 'acadevo' )    => 'top',
				esc_attr__( 'Bottom', 'acadevo' ) => 'bottom',
				esc_attr__( 'Left', 'acadevo' )   => 'left',
				esc_attr__( 'Right', 'acadevo' )  => 'right',
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Place icon on border?', 'acadevo' ),
			'description' => esc_attr__( 'Display icon on call to action element border.', 'acadevo' ),
			'param_name'  => 'i_on_border',
			'value'       => array(
				esc_attr__( 'No', 'acadevo' )     => 'false',
				esc_attr__( 'Yes', 'acadevo' )    => 'true',
			),
			'group'       => esc_attr__( 'Icon', 'acadevo' ),
			'dependency'  => array(
				'element'   => 'add_icon',
				'not_empty' => true,
			),
		),
		
	),
	vc_map_integrate_shortcode( 'tm-icon', 'i_', esc_attr__( 'Icon', 'acadevo' ),
		array(
			'exclude' => array( 'align', 'css' )
		),
		array(
			'element'   => 'add_icon',
			'not_empty' => true,
		)
	),
	array(
		/// cta3
		vc_map_add_css_animation(),
		themetechmount_vc_ele_extra_class_option(),
		themetechmount_vc_ele_css_editor_option(),
	)
);



	
global $tm_sc_params_cta;
$tm_sc_params_cta = $params;



vc_map( array(
	'name'     => esc_attr__( 'ThemetechMount Call to Action', 'acadevo' ),
	'base'     => 'tm-cta',
	'icon'     => 'icon-themetechmount-vc',
	'category' => array( esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ) ),
	'since'    => '4.5',
	'params'   => $params,
	'js_view'  => 'VcCallToActionView3',
) );