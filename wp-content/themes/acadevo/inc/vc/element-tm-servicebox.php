<?php

/* Options for ThemetechMount Servicebox */
$bgcolor_custom = array();
$bgcolor_custom[__( 'Transparent', 'acadevo' )] = 'transparent';
$bgcolor_custom[__( 'Skin color', 'acadevo' )]  = 'skincolor';
$boxcolor =   array_merge( $bgcolor_custom , themetechmount_getVcShared( 'colors-dashed' ) ) ;

$params = array_merge(
	
	array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Icon position', 'acadevo' ),
			'description' => esc_attr__( 'Icon position in the Service box.', 'acadevo' ),
			'param_name'  => 'add_icon',
			'std'         => 'left-spacing',
			'value'       => array(
				esc_attr__( 'Before Heading', 'acadevo' )           => 'before-heading',
				esc_attr__( 'Top Center', 'acadevo' )               => 'top-center',
				esc_attr__( 'Top Left', 'acadevo' )                 => 'top-left',
				esc_attr__( 'Left with spacing', 'acadevo' )        => 'left-spacing',
				esc_attr__( 'Bottom Center', 'acadevo' )            => 'bottom-center',
				esc_attr__( 'Top Right (RTL)', 'acadevo' )          => 'top-right',
				esc_attr__( 'Right with spacing (RTL)', 'acadevo' ) => 'right-spacing',
				esc_attr__( 'After Heading (RTL)', 'acadevo' )      => 'after-heading',
				esc_attr__( 'Without Icon', 'acadevo' )      		 => 'without-icon',
			),
		),
	),
	
	themetechmount_vc_heading_params(),
	array(
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_attr__( 'Text', 'acadevo' ),
			'param_name' => 'content',
			'value'      => esc_attr__( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'acadevo' )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Background Color', 'acadevo' ),
			'param_name' => 'bgcolor',
			'value'      => array( 'Transparent' => 'transparent' ) + themetechmount_getVcShared('pre-bg-colors'),
			'std'         => 'transparent',
			'description' => esc_attr__( 'Select Service Box display style.', 'acadevo' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_attr__( 'Text Color', 'acadevo' ),
			'param_name' => 'textcolor',
			'value'      => array( esc_attr__('Default', 'acadevo') => '' ) + themetechmount_getVcShared('pre-text-colors'),
			'std'         => '',
			'description' => esc_attr__( 'Select Service Box display style.', 'acadevo' ),
		)
	),
	array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Add button', 'acadevo' ) . '?',
			'description' => esc_attr__( 'Add button to Service Box.', 'acadevo' ),
			'param_name'  => 'add_button',
			'value'       => array(
				esc_attr__( 'No', 'acadevo' )  => '',
				esc_attr__( 'Yes', 'acadevo' ) => 'bottom',
			),
			'std' 		  => '',
			
		),
	),
	vc_map_integrate_shortcode( 'tm-btn', 'btn_', esc_attr__( 'Button', 'acadevo' ),
		array(
		'exclude' => array(
			'align',
			'button_block',
			'el_class',
			'css_animation',
			'css',
		),
	),
		array(
			'element' => 'add_button',
			'not_empty' => true,
		)
	),
	
	vc_map_integrate_shortcode( 'tm-icon', 'i_', esc_attr__( 'Icon', 'acadevo' ),
		array(
			'exclude' => array( 'align', 'el_class', 'css_animation', 'link', 'css' ),
		),
		array(
			'element' => 'add_icon',
			'not_empty' => true,
		)
	),
	
	array(
		
		array(
			"type"       => "dropdown",
			"heading"    => esc_attr__("Box Hover Effect",'acadevo'),
			"param_name" => "hover",
			"value"      => array(
				esc_attr__('None','acadevo')                   => 'none',
				esc_attr__('Float Shadow','acadevo')           => 'hvr-float-shadow',
				esc_attr__('Grow','acadevo')                   => 'hvr-grow',
				esc_attr__('Shrink','acadevo')                 => 'hvr-shrink',
				esc_attr__('Pulse','acadevo')                  => 'hvr-pulse',
				esc_attr__('Pulse Grow','acadevo')             => 'hvr-pulse-grow',
				esc_attr__('Pulse Shrink','acadevo')           => 'hvr-pulse-shrink',
				esc_attr__('Push','acadevo')                   => 'hvr-push',
				esc_attr__('Pop','acadevo')                    => 'hvr-pop',
				esc_attr__('Bounce In','acadevo')              => 'hvr-bounce-in',
				esc_attr__('Bounce Out','acadevo')             => 'hvr-bounce-out',
				esc_attr__('Rotate','acadevo')                 => 'hvr-rotate',
				esc_attr__('Grow Rotate','acadevo')            => 'hvr-grow-rotate',
				esc_attr__('Float','acadevo')                  => 'hvr-float',
				esc_attr__('Sink','acadevo')                   => 'hvr-sink',
				esc_attr__('Bob','acadevo')                    => 'hvr-bob',
				esc_attr__('Hang','acadevo')                   => 'hvr-hang',
				esc_attr__('Skew','acadevo')                   => 'hvr-skew',
				esc_attr__('Skew Forward','acadevo')           => 'hvr-skew-forward',
				esc_attr__('Wobble Horizontal','acadevo')      => 'hvr-wobble-horizontal',
				esc_attr__('Wobble Vertical','acadevo')        => 'hvr-wobble-vertical',
				esc_attr__('Wobble To Bottom Right','acadevo') => 'hvr-wobble-to-bottom-right',
				esc_attr__('Wobble To Top Right','acadevo')    => 'hvr-wobble-to-top-right',
				esc_attr__('Wobble Top','acadevo')             => 'hvr-wobble-top',
				esc_attr__('Wobble Bottom','acadevo')          => 'hvr-wobble-bottom',
				esc_attr__('Wobble Skew','acadevo')            => 'hvr-wobble-skew',
				esc_attr__('Buzz','acadevo')                   => 'hvr-buzz',
				esc_attr__('Buzz Out','acadevo')               => 'hvr-buzz-out',
			),
			"description"      => esc_attr__("Select hover effect.",'acadevo') . ' <a href="' . esc_url('http://ianlunn.github.io/Hover/') . '" target="_blank">' . esc_attr__("Click here to view sample animation of each.",'acadevo') . '</a>',
			'std'              => 'none',
			'group'            => esc_attr__( 'Animations', 'acadevo' ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => esc_attr__("Box Hover Effect: For Background Image",'acadevo'),
			"param_name" => "hover_bg_effect",
			"value"      => array(
				esc_attr__('None','acadevo')                    => '',
				esc_attr__('Zoom-in image','acadevo')           => 'zoomin',
				esc_attr__('Zoom-out image','acadevo')          => 'zoomout',
			),
			"description" => esc_attr__("Select hover effect for background image only.",'acadevo') . '<br>' . '<strong>' . esc_attr__("NOTE:",'acadevo') . '</strong>' . esc_attr__("This will work with \"Top Center\", \"Top Left\" and \"Top Right\" icon position only.",'acadevo'),
			'dependency'  => array(
				'element'   => 'add_icon',
				'value'     => array( 'top-center', 'top-left', 'top-right', 'bottom-center' ),
			),
			'std'              => '',
			'group'            => esc_attr__( 'Animations', 'acadevo' ),
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_attr__( 'Rotate background on hover?', 'acadevo' ),
			'param_name'       => 'hover_bg_rotate',
			'description'      => esc_attr__( 'Rotate background on hover?', 'acadevo' ),
			"value"      => array(
				esc_attr__('No','acadevo')  => 'no',
				esc_attr__('Yes','acadevo') => 'yes',
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency'  => array(
				'element'        => 'hover_bg_effect',
				'value'          => array('zoomin','zoomout'),
			),
			'group'            => esc_attr__( 'Animations', 'acadevo' ),
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_attr__( 'Blur background on hover?', 'acadevo' ),
			'param_name'       => 'hover_bg_blur',
			'description'      => esc_attr__( 'Blur background on hover?', 'acadevo' ),
			"value"      => array(
				esc_attr__('No','acadevo')  => 'no',
				esc_attr__('Yes','acadevo') => 'yes',
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency'  => array(
				'element'            => 'hover_bg_effect',
				'value'          => array('zoomin','zoomout'),
			),
			'group'            => esc_attr__( 'Animations', 'acadevo' ),
		),
		
		array(
			"type"			=> "dropdown",
			"heading"		=> esc_attr__("Box Hover Effect: Select content animation style",'acadevo'),
			"param_name"	=> "box_effect",
			"value"			=> array(
				esc_attr__('None','acadevo')                => '',
				esc_attr__('Animate from bottom','acadevo') => 'one',
			),
			"description"	=> esc_attr__("Select hover effect for content only.",'acadevo') . '<br>' . '<strong>' . esc_attr__("NOTE:",'acadevo') . '</strong> ' . esc_attr__("This will work with \"Top Center\", \"Top Left\" and \"Top Right\" icon position only.",'acadevo'),
			'std'			=> '',
			'group'			=> esc_attr__( 'Animations', 'acadevo' ),
			'dependency'	=> array(
				'element'		=> 'add_icon',
				'value'			=> array('top-center','top-left','top-right', 'bottom-center'),
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

// Changing modifying, adding extra options
$i = 0;
foreach( $params as $param ){
	
	$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
	
	if( $param_name == 'txt_align' ){ // Remove Text Alignment option
		$params[$i]['dependency'] = array(  // This is to hide this option forever
			'element'  => 'btn_style',
			'value'    => array( 'abcdefg' )
		);
		
	} else if( $param_name == 'btn_style' ){
		$style = $param['value'];
		if( is_array($style) ){
			$params[$i]['std']   = 'text';
		}
		
	} else if( $param_name == 'btn_color' ){
		$colors = $param['value'];
		if( is_array($colors) ){
			$params[$i]['std']   = 'skincolor';
		}
	
	} else if( $param_name == 'color' ){
		$colors = $param['value'];
		if( is_array($colors) ){
			$colors = array_reverse($colors);
			$colors[__( 'Skin color', 'acadevo' )] = 'skincolor';
			$params[$i]['value'] = array_reverse($colors);
			$params[$i]['std']   = 'grey';
		}
	
	} else if( $param_name == 'btn_shape' ){
		$params[$i]['dependency'] = array(
			'element'            => 'btn_style',
			'value_not_equal_to' => array( 'text' )
		);
	} else if( $param_name == 'btn_title' ){
		$params[$i]['std'] = esc_attr__( 'Read More', 'acadevo' );
	
	} else if( $param_name == 'btn_add_icon' ){
		$params[$i]['std']   = false;
	
	} else if( $param_name == 'i_background_style' ){
		$params[$i]['value'][__( 'None', 'acadevo' )] = 'none';
		$params[$i]['std'] = 'none';
		
	} else if( $param_name == 'i_background_color' ){
		$params[$i]['value'][__( 'None', 'acadevo' )] = 'none';
		$params[$i]['std'] = 'grey';
		$params[$i]['dependency'] = array(
			'element'               => 'i_background_style',
			'value_not_equal_to'    => array( 'none' )
		);
		
	} else if( $param_name == 'separator' ){
		$params[$i]['dependency'] = array(
			'element'  => 'i_type',
			'value'    => array( 'notavailablevalue' ),
		);
	
	
	} else if( $param_name == 'i_size' ){
		$params[$i]['std'] = 'md';
		
	} else if( $param_name == 'h2_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'h4_use_theme_fonts' ){
		$params[$i]['std'] = 'yes';
		
	} else if( $param_name == 'h2_google_fonts' ){
		$params[$i]['std'] = 'font_family:Arimo%3Aregular%2Citalic%2C700%2C700italic|font_style:700%20bold%20regular%3A700%3Anormal';
	
	} else if( $param_name == 'h4_google_fonts' ){
		$params[$i]['std'] = 'font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal';
	
	} else if( $param_name == 'css_animation' ){
		$params[$i]['group'] = esc_attr__( 'Animations', 'acadevo' );
	
	}
	
	$i++;
} // Foreach


global $tm_sc_params_servicebox;
$tm_sc_params_servicebox = $params;




vc_map( array(
	'name'        => esc_attr__( 'ThemetechMount Service Box', 'acadevo' ),
	'base'        => 'tm-servicebox',
	"icon"        => "icon-themetechmount-vc",
	'category'    => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	'params'      => $params,
) );