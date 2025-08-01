<?php

// [tm-coursebox]

if( !function_exists('themetechmount_sc_coursebox') ){
function themetechmount_sc_coursebox( $atts, $content=NULL ){
	
	$return = '';
	
	if( function_exists('vc_map') ){
		
		global $tm_sc_params_coursebox;
		
		$options_list = themetechmount_create_options_list($tm_sc_params_coursebox);
		
		extract( shortcode_atts(
			$options_list
		, $atts ) );
		
		// Starting wrapper of the whole arear
		$return .= themetechmount_box_wrapper( 'start', 'course', get_defined_vars() );
		
			// Heading element
			$return .= themetechmount_vc_element_heading( get_defined_vars() );
			
			
			
			// Getting $args for WP_Query
			$args = themetechmount_get_query_args( 'lp_course', get_defined_vars() );
			
			// Wp query to fetch posts
			$posts = new WP_Query( $args );
			
			
			if ( $posts->have_posts() ) {
				$return .= themetechmount_get_boxes( 'course', get_defined_vars() );
			}
			
		
		// Ending wrapper of the whole arear
		$return .= themetechmount_box_wrapper( 'end', 'course', get_defined_vars() );
			
			/* Restore original Post Data */
			wp_reset_postdata();	
		
	} else {
		$return .= '<!-- Visual Composer plugin not installed. Please install it to make this shortcode work. -->';
	}
	
	return $return;
}
}
add_shortcode( 'tm-coursebox', 'themetechmount_sc_coursebox' ); ?>
