<?php

/************************** Custom Template *****************************/
add_filter( 'vc_load_default_templates', 'themetechmount_custom_template_for_vc' );
if( !function_exists('themetechmount_custom_template_for_vc') ){
function themetechmount_custom_template_for_vc($maindata) {
	
	$maindata = array();
	
	/* ***************** */
	
		
	// Our Team
    $data               = array();
    $data['name']       = esc_attr__( 'Our Team', 'acadevo' );
    $data['custom_class'] = 'acadevo_our_team';
    $data['content']    = <<<TMCONTENTTILLTHIS
[vc_row tm_bgimagefixed="" css=".vc_custom_1566294402100{padding-top: 110px !important;padding-bottom: 56px !important;}" tm_responsive_css="90103460|colbreak_no|||||||||colbreak_no|||||60px||10px||colbreak_no||||||||||colbreak_no|||||||||"][vc_column][tm-teambox h2="" seperator="none" show="-1" orderby="none" column="three"][/tm-teambox][/vc_column][/vc_row]
TMCONTENTTILLTHIS;
	$maindata[] = $data;
	
	
	
	
	/************* END of Visual Composer Template list ***************/
	
	
	// Return all VC templates
	return $maindata;
	
	
	
}
}
