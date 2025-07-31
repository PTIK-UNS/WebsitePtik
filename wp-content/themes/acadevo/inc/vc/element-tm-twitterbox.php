<?php

/* Options */



$allParams = array(
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> esc_attr__("Twitter handle (Twitter Username)",'acadevo'),
			"param_name"	=> "username",
			"description"	=> esc_attr__('Twitter user name. Example "envato".','acadevo')
		),
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> esc_attr__('"Follow us" text after big icon','acadevo'),
			"param_name"	=> "followustext",
			"description"	=> esc_attr__('(optional) Follow us text after the big Twitter icon so user can click on it and go to Twitter profile page.','acadevo')
		),
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> esc_attr__("Show Tweets",'acadevo'),
			"param_name"	=> "show",
			"description"	=> esc_attr__('How many Tweets you like to show.','acadevo'),
			'value' => array(
				esc_attr__( '1', 'acadevo' ) => '1',
				esc_attr__( '2', 'acadevo' ) => '2',
				esc_attr__( '3', 'acadevo' ) => '3',
				esc_attr__( '4', 'acadevo' ) => '4',
				esc_attr__( '5', 'acadevo' ) => '5',
				esc_attr__( '6', 'acadevo' ) => '6',
				esc_attr__( '7', 'acadevo' ) => '7',
				esc_attr__( '8', 'acadevo' ) => '8',
				esc_attr__( '9', 'acadevo' ) => '9',
				esc_attr__( '10', 'acadevo' ) => '10',
			),
			'std' => '3',
		),
		
	);


$boxParams  = themetechmount_box_params();
$css_editor = array( themetechmount_vc_ele_css_editor_option() );

$params = array_merge( $allParams, $boxParams, $css_editor );



// Changing default values
$i = 0;
foreach( $params as $param ){
	
	$param_name = (isset($param['param_name'])) ? $param['param_name'] : '' ;
	
	if( $param_name == 'column' ){
		$params[$i]['std'] = 'one';
	
	} else if( $param_name == 'view' ){
		$params[$i]['std'] = 'carousel';
		
	} else if( $param_name == 'carousel_dots' ){
		$params[$i]['std'] = 'true';
		
	} else if( $param_name == 'carousel_nav' ){ // Removing "About Carousel" option as it's not used here.
		unset( $params[$i]['value']["Above Carousel"] );
		
	}
	
	
	
	
	$i++;
}



global $tm_sc_params_twitterbox;
$tm_sc_params_twitterbox = $params;




vc_map( array(
	"name"        => esc_attr__("ThemetechMount Twitter Box",'acadevo'),
	"base"        => "tm-twitterbox",
	"class"       => "",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"icon"        => "icon-themetechmount-vc",
	"params"      => $params,
) );