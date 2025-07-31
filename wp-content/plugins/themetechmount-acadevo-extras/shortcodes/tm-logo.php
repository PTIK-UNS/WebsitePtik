<?php
// [tm-logo]
if( !function_exists('themetechmount_sc_logo') ){
function themetechmount_sc_logo( $atts, $content=NULL ){
	
	
	
	$acadevo_theme_options = get_option('acadevo_theme_options');
	
	if( !empty($acadevo_theme_options['logotype']) ){
	
		$return = '<span class="tm-sc-logo tm-sc-logo-type-'.$acadevo_theme_options['logotype'].'">';
		
		if( $acadevo_theme_options['logotype']=='image' ){
			if( isset($acadevo_theme_options['logoimg']) && is_array($acadevo_theme_options['logoimg']) ){
				
				// standard logo
				if( isset($acadevo_theme_options['logoimg']['full-url']) && trim($acadevo_theme_options['logoimg']['full-url'])!='' ){
					$image = $acadevo_theme_options['logoimg']['full-url'];
					$return .= '<img class="themetechmount-logo-img standardlogo" alt="' . get_bloginfo( 'name' ) . '" src="'.$acadevo_theme_options['logoimg']['full-url'].'">';
				
				} else if( isset($acadevo_theme_options['logoimg']['thumb-url']) && trim($acadevo_theme_options['logoimg']['thumb-url'])!='' ){
					$image = $acadevo_theme_options['logoimg']['thumb-url'];
					$return .= '<img class="themetechmount-logo-img standardlogo" alt="' . get_bloginfo( 'name' ) . '" src="'.$acadevo_theme_options['logoimg']['thumb-url'].'">';

				} else if( isset($acadevo_theme_options['logoimg']['id']) && trim($acadevo_theme_options['logoimg']['id'])!='' ){
					$image   = wp_get_attachment_image_src( $acadevo_theme_options['logoimg']['id'], 'full' );
					$return .= '<img class="themetechmount-logo-img standardlogo" alt="' . get_bloginfo( 'name' ) . '" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'">';
					
					
				}
				
				
				// stikcy logo
				if( isset($acadevo_theme_options['logoimg_sticky']) && is_array($acadevo_theme_options['logoimg_sticky']) ){
					
					if( isset($acadevo_theme_options['logoimg_sticky']['full-url']) && trim($acadevo_theme_options['logoimg_sticky']['full-url'])!='' ){
						$sticky_image   = $acadevo_theme_options['logoimg_sticky']['full-url'];
						$return .= '<img class="themetechmount-logo-img stickylogo" alt="' . get_bloginfo( 'name' ) . '" src="'.$acadevo_theme_options['logoimg_sticky']['full-url'].'">';
					
					} else if( isset($acadevo_theme_options['logoimg_sticky']['thumb-url']) && trim($acadevo_theme_options['logoimg_sticky']['thumb-url'])!='' ){
						$sticky_image   = $acadevo_theme_options['logoimg_sticky']['thumb-url'];
						$return .= '<img class="themetechmount-logo-img stickylogo" alt="' . get_bloginfo( 'name' ) . '" src="'.$acadevo_theme_options['logoimg_sticky']['thumb-url'].'">';
					
					} else if( isset($acadevo_theme_options['logoimg_sticky']['id']) && trim($acadevo_theme_options['logoimg_sticky']['id'])!='' ){
						$sticky_image   = wp_get_attachment_image_src( $acadevo_theme_options['logoimg_sticky']['id'], 'full' );
						$return .= '<img class="themetechmount-logo-img stickylogo" alt="' . get_bloginfo( 'name' ) . '" src="'.$sticky_image[0].'" width="'.$sticky_image[1].'" height="'.$image[2].'">';
						
					}
					
				}
				
				
			}
		} else {
			if( !empty($acadevo_theme_options['logotext']) ){
				$return = $acadevo_theme_options['logotext'];
			}
		}
		
		$return .= '</span>';
		
	}
	
	return $return;
}
}
add_shortcode( 'tm-logo', 'themetechmount_sc_logo' );