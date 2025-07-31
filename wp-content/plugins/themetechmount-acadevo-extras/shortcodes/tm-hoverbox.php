<?php
// [tm-hoverbox]
if( !function_exists('themetechmount_hoverbox') ){
function themetechmount_hoverbox( $atts, $content=NULL ){
	
	$return = '';
	
	if( function_exists('vc_map') ){ 
	
	global $tm_vc_custom_element_hoverbox;
	$options_list = themetechmount_create_options_list($tm_vc_custom_element_hoverbox);
	
	extract( shortcode_atts(
		$options_list
	, $atts ) );
	

		// boximage size
			$boximg_size   = ( !empty($boximg_size) ) ? $boximg_size : 'full' ;
		
			// Starting wrapper of the whole arear
		$return .= themetechmount_box_wrapper( 'start', 'box_content', get_defined_vars() );		

		// Heading element
		$return .= themetechmount_vc_element_heading( get_defined_vars() );
	
		// Getting $args for WP_Query
		$args = themetechmount_get_query_args( 'box_content', get_defined_vars() );

	
		if( !empty($box_content) ){
		
			$static_boxes = (array) vc_param_group_parse_atts( $box_content );

				
				$return .= '<div class="row multi-columns-row themetechmount-boxes-row-wrapper tm-hoverbox-wrapper">';
				foreach( $static_boxes as $tm_box ){
					$image_box = '' ;
					$tm_box['static_boximage']=( !empty($tm_box['static_boximage']) ) ? $tm_box['static_boximage'] : '';

					if( function_exists('wpb_getImageBySize') ){
							$image_box = wpb_getImageBySize( array(
								'attach_id'  => $tm_box['static_boximage'],
								'thumb_size' => $boximg_size,
							) );
							$image_box = ( !empty($image_box['thumbnail']) ) ? $image_box['thumbnail'] : '' ;
						} else {
							$image_box = wp_get_attachment_image( $tm_box['static_boximage'], 'full' );
					}
					
					$tm_bicon= do_shortcode('[tm-icon type="' . $tm_box['i_type'] . '" color="white" icon_linecons="' . $tm_box['i_icon_linecons'] . '" icon_themify="' . $tm_box['i_icon_themify'] . '" icon_fontawesome="' . $tm_box['i_icon_fontawesome'] . '" icon_kw_acadevo="' . $tm_box['i_icon_kw_acadevo'] . '" ]');
										
					$static_boxtitle      = ( !empty($tm_box['static_boxtitle']) ) ? '<div class="tm-box-title"><h5>'.$tm_box['static_boxtitle'].'</h5><div class="tm-box-icon">'.$tm_bicon.'</div></div>' : '' ;
				

	
						$return .= themetechmount_column_div('start', $column );
						$return .= '
						<div class="tm-hoverbox">
							<div class="tm-box-image"> 
									<div class="tm-hoverbox-image">
									' . $image_box . '
									</div>	
									<div class="tm-hoverbox-content" >
									'.$static_boxtitle.'									
									</div>
							</div>
						</div>
						';
						$return .= themetechmount_column_div('end', $column );
				} // end foreach
				$return .= '</div>';
				
				
			} // end if
			
	$return .= themetechmount_box_wrapper( 'end', 'static', get_defined_vars() );
		/* Restore original Post Data */
		wp_reset_postdata();
	
} else {
		$return .= '<!-- Visual Composer plugin not installed. Please install it to make this shortcode work. -->';
	}

	return $return;	
	
}
}
add_shortcode( 'tm-hoverbox', 'themetechmount_hoverbox' );