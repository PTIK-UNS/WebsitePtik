<?php

/* Options */



$params = array(
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Phone",'acadevo'),
		"description" => esc_attr__("Write phone number here. Example: (+01) 123 456 7890",'acadevo'),
		"param_name"  => "phone",
	),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Email",'acadevo'),
		"description" => esc_attr__("Write email here. Example: info@example.com",'acadevo'),
		"param_name"  => "email",
	),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Website",'acadevo'),
		"description" => esc_attr__("Write website URL here. Example: http://www.example.com",'acadevo'),
		"param_name"  => "website",
	),
	array(
		"type"        => "textarea",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Address",'acadevo'),
		"description" => esc_attr__("Write address here. You can write in multi-line too.",'acadevo'),
		"param_name"  => "address",
	),
	array(
		"type"        => "textarea",
		"holder"      => "div",
		"class"       => "",
		"heading"     => esc_attr__("Time",'acadevo'),
		"description" => esc_attr__("Write time here. You can write in multi-line too.",'acadevo'),
		"param_name"  => "time",
	),
);


$params    = array_merge( $params, array( vc_map_add_css_animation() ), array( themetechmount_vc_ele_extra_class_option() ), array( themetechmount_vc_ele_css_editor_option() ) );

global $tm_sc_params_contactbox;
$tm_sc_params_contactbox = $params;


vc_map( array(
	"name"     => esc_attr__("ThemetechMount Contact Details Box",'acadevo'),
	"base"     => "tm-contactbox",
	"class"    => "",
	'category' => esc_attr__( 'ThemetechMount Special Elements', 'acadevo' ),
	"icon"     => "icon-themetechmount-vc",
	"params"   => $params
) );