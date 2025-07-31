<?php

/* Options for ThemetechMount Button */



global $tm_pixel_icons;
$icons_params = vc_map_integrate_shortcode( 'tm-icon', 'i_', '',
	array(
		'include_only_regex' => '/^(type|icon_\w*)/',
		// we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
	), array(
		'element' => 'add_icon',
		'value' => 'true',
	)
);
// populate integrated tm-icons params.
if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
	foreach ( $icons_params as $key => $param ) {
		if ( is_array( $param ) && ! empty( $param ) ) {
			if ( 'i_type' === $param['param_name'] ) {
				// Do nothing
			}
			if ( isset( $param['admin_label'] ) ) {
				// remove admin label
				unset( $icons_params[ $key ]['admin_label'] );
			}

		}
	}
}
$params = array_merge(
	array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_attr__( 'Text', 'acadevo' ),
			'param_name' => 'title',
			'value'      => esc_attr__( 'Text on the button', 'acadevo' ),
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_attr__( 'URL (Link)', 'acadevo' ),
			'param_name' => 'link',
			'description' => esc_attr__( 'Add link to button.', 'acadevo' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Style', 'acadevo' ),
			'description' => esc_attr__( 'Select button display style.', 'acadevo' ),
			'param_name' => 'style',
			'std'		 => 'flat',
			'value' => array(
				esc_attr__( 'Flat', 'acadevo' ) => 'flat',
				esc_attr__( 'Modern', 'acadevo' ) => 'modern',
				esc_attr__( 'Classic', 'acadevo' ) => 'classic',
				esc_attr__( 'Outline', 'acadevo' ) => 'outline',
				esc_attr__( '3d', 'acadevo' ) => '3d',
				esc_attr__( 'Simple Text', 'acadevo' ) => 'text',
				esc_attr__( 'Custom', 'acadevo' ) => 'custom',
				esc_attr__( 'Outline custom', 'acadevo' ) => 'outline-custom',
				esc_attr__( 'Gradient', 'acadevo' ) => 'gradient',
				esc_attr__( 'Gradient Custom', 'acadevo' ) => 'gradient-custom',
			),
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Gradient Color 1', 'acadevo' ),
			'param_name' => 'gradient_color_1',
			'description' => esc_attr__( 'Select first color for gradient.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_btn3-colored-dropdown',
			'value' => getVcShared( 'colors-dashed' ),
			'std' => 'turquoise',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'gradient' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Gradient Color 2', 'acadevo' ),
			'param_name' => 'gradient_color_2',
			'description' => esc_attr__( 'Select second color for gradient.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_btn3-colored-dropdown',
			'value' => getVcShared( 'colors-dashed' ),
			'std' => 'blue',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'gradient' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Gradient Color 1', 'acadevo' ),
			'param_name' => 'gradient_custom_color_1',
			'description' => esc_attr__( 'Select first color for gradient.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_btn3-colored-dropdown',
			'value' => '#dd3333',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'gradient-custom' ),
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Gradient Color 2', 'acadevo' ),
			'param_name' => 'gradient_custom_color_2',
			'description' => esc_attr__( 'Select second color for gradient.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_btn3-colored-dropdown',
			'value' => '#eeee22',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'gradient-custom' ),
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Button Text Color', 'acadevo' ),
			'param_name' => 'gradient_text_color',
			'description' => esc_attr__( 'Select button text color.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_btn3-colored-dropdown',
			'value' => '#ffffff',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'gradient-custom' ),
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
		),
		
		
		
		
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Background', 'acadevo' ),
			'param_name' => 'custom_background',
			'description' => esc_attr__( 'Select custom background color for your element.', 'acadevo' ),
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'custom' )
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std' => '#ededed',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Text', 'acadevo' ),
			'param_name' => 'custom_text',
			'description' => esc_attr__( 'Select custom text color for your element.', 'acadevo' ),
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'custom' )
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'std' => '#666',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Outline and Text', 'acadevo' ),
			'param_name' => 'outline_custom_color',
			'description' => esc_attr__( 'Select outline and text color for your element.', 'acadevo' ),
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'outline-custom' )
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'std' => '#666',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Hover background', 'acadevo' ),
			'param_name' => 'outline_custom_hover_background',
			'description' => esc_attr__( 'Select hover background color for your element.', 'acadevo' ),
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'outline-custom' )
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'std' => '#666',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Hover text', 'acadevo' ),
			'param_name' => 'outline_custom_hover_text',
			'description' => esc_attr__( 'Select hover text color for your element.', 'acadevo' ),
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'outline-custom' )
			),
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'std' => '#fff',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Shape', 'acadevo' ),
			'description' => esc_attr__( 'Select button shape.', 'acadevo' ),
			'param_name'  => 'shape',
			'std'		  => 'square',
			'value'       => array(
				esc_attr__( 'Square', 'acadevo' ) => 'square',
				esc_attr__( 'Rounded', 'acadevo' ) => 'rounded',
				esc_attr__( 'Round', 'acadevo' ) => 'round',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Color', 'acadevo' ),
			'param_name' => 'color',
			'description' => esc_attr__( 'Select button color.', 'acadevo' ),
			'param_holder_class' => 'tm_vc_colored-dropdown vc_btn3-colored-dropdown',
			'value' => array(
							esc_attr__( '[Skin Color]', 'acadevo' ) => 'skincolor',
							esc_attr__( 'Classic Grey', 'acadevo' ) => 'default',
							esc_attr__( 'Classic Blue', 'acadevo' ) => 'primary',
							esc_attr__( 'Classic Turquoise', 'acadevo' ) => 'info',
							esc_attr__( 'Classic Green', 'acadevo' ) => 'success',
							esc_attr__( 'Classic Orange', 'acadevo' ) => 'warning',
							esc_attr__( 'Classic Red', 'acadevo' ) => 'danger',
							esc_attr__( 'Classic Black', 'acadevo' ) => 'inverse'
					   ) + themetechmount_getVcShared( 'colors-dashed' ),
			'std' => 'skincolor',
			'dependency' => array(
				'element' => 'style',
				'value_not_equal_to' => array( 'custom', 'outline-custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Button Size', 'acadevo' ),
			'param_name' => 'size',
			'description' => esc_attr__( 'Select button display size.', 'acadevo' ),
			'std' => 'md',
			'value' => themetechmount_getVcShared( 'sizes' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Button Text Bold?', 'acadevo' ),
			'param_name'  => 'font_weight',
			'description' => esc_attr__( 'Select YES if you like to bold the font text.', 'acadevo' ),
			'std'         => 'no',
			'value'       => array(
				esc_attr__( 'Yes', 'acadevo' ) => 'yes',
				esc_attr__( 'No', 'acadevo' )  => 'no',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Alignment', 'acadevo' ),
			'param_name' => 'align',
			'description' => esc_attr__( 'Select button alignment.', 'acadevo' ),
			'value' => array(
				esc_attr__( 'Inline', 'acadevo' ) => 'inline',
				esc_attr__( 'Left', 'acadevo' ) => 'left',
				esc_attr__( 'Right', 'acadevo' ) => 'right',
				esc_attr__( 'Center', 'acadevo' ) => 'center'
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Set full width button?', 'acadevo' ),
			'param_name' => 'button_block',
			'dependency' => array(
				'element'            => 'align',
				'value_not_equal_to' => 'inline',
			),
			'value'      => array(
				esc_attr__( 'No', 'acadevo' )  => 'false',
				esc_attr__( 'Yes', 'acadevo' ) => 'true',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Add icon?', 'acadevo' ),
			'param_name' => 'add_icon',
			'value'      => array(
				esc_attr__( 'No',  'acadevo' ) => '',
				esc_attr__( 'Yes', 'acadevo' ) => 'true',
			),
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Icon Alignment', 'acadevo' ),
			'description' => esc_attr__( 'Select icon alignment.', 'acadevo' ),
			'param_name' => 'i_align',
			'value' => array(
				esc_attr__( 'Left', 'acadevo' ) => 'left',
				// default as well
				esc_attr__( 'Right', 'acadevo' ) => 'right',
			),
			'dependency' => array(
				'element' => 'add_icon',
				'value' => 'true',
			),
		),
	),
	
	$icons_params,
	
	array(
		vc_map_add_css_animation(),
		themetechmount_vc_ele_extra_class_option(),
		themetechmount_vc_ele_css_editor_option(),
	)
);











// Changing modifying, adding extra options
$i = 0;
foreach( $params as $param ){
	
	$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
	
	
	// Button Icon
	if( $param_name == 'i_align' ){
		$params[$i]['std'] = 'right';
	
	} else if( $param_name == 'i_type' ){
		$params[$i]['std'] = 'themify';
		
	} else if( $param_name == 'i_icon_themify' ){
		$params[$i]['std']   = 'themifyicon ti-arrow-right';
		$params[$i]['value'] = 'themifyicon ti-arrow-right';

	}
	
	
	$i++;
} // Foreach











	
global $tm_sc_params_btn;
$tm_sc_params_btn = $params;



vc_map( array(
	'name'     => esc_attr__( 'ThemetechMount Button', 'acadevo' ),
	'base'     => 'tm-btn',
	'icon'     => 'icon-themetechmount-vc',
	'category' => array( esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ) ),
	'params'   => $params,
	'js_view'  => 'VcButton3View',
	'custom_markup' => '{{title}}<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-{{ params.shape }} vc_btn3-style-{{ params.style }} vc_btn3-color-{{ params.color }}">{{{ params.title }}}</button></div>',
) );


