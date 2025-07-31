<?php

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

function wpsw_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		"background_color"        => "#ffffff",
		"background_hover_color"  => "#000000",
		"icon_color"              => "#000000",
		"icon_hover_color"        => "#ffffff",
		"target"                  => "_blank",
		"icon_circle"             => "no",
		"title"	                  => "",
		"facebook" 		          => "",
		"twitter" 		          => "",
		"behance" 		          => "",
		"dribbble" 		          => "",
		"flickr"		          => "",
		"foursquare" 	          => "",
		"github" 		          => "",
		"google" 		          => "",
		"instagram" 	          => "",
		"linkedin" 		          => "",
		"mail" 			          => "",
		"pinterest" 	          => "",
		"rss" 			          => "",
		"skype" 		          => "",
		"soundcloud" 	          => "",
		"stumbleupon" 	          => "",
		"tumblr" 		          => "",
		"vimeo" 		          => "",
		"vine" 			          => "",
		"vk" 			          => "",
		"xing" 			          => "",
		"yelp" 			          => "",
		"youtube" 		          => "",

	), $atts, 'wpsw' );


	$style = "";

	// if( "yes" == $atts['add_style'] ){

		$style .= "<style type='text/css'>
			body .wpsw-social-links-shortcode li a .social-icon {
				background: ".$atts['background_color'] ." !important;
				color:".esc_attr($atts['icon_color'])." !important;
			}

			body .wpsw-social-links-shortcode li a .social-icon:hover,
			body .wpsw-social-links-shortcode li a .social-icon:focus {
				background: ".$atts['background_hover_color'] ." !important;
				color:".esc_attr($atts['icon_hover_color'])." !important;

			}";
		if( "yes" == $atts['icon_circle'] ) {
			$style .= " body .wpsw-social-links-shortcode li .social-icon,
						body .wpsw-social-links-shortcode li .social-icon:after {
	                    -webkit-border-radius: 50%;
	                    -moz-border-radius: 50%;
	                    -ms-border-radius: 50%;
	                    -o-border-radius: 50%;
	                    border-radius: 50%;
	                    }";
		}
		
		$style .= "</style>";	
	// }
	
	$socialBlock = $style;

	if( isset($atts['title']) && $atts['title']!="" ){
		$sanitizedTitle = htmlspecialchars($atts['title'], ENT_QUOTES, 'UTF-8');
      	$socialBlock .= esc_attr($sanitizedTitle);		
	}
	
	$socialBlock .= "<ul class='wpsw-social-links-shortcode'>";
	
	if( $atts['behance'] ){
		$socialBlock .= '<li class="behance"><a href="'.esc_url($atts['behance']).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Behance" ><span class="social-icon sicon-behance"></span></a></li>';
	}

	if( $atts['dribbble'] ){
		$socialBlock .= '<li class="dribbble"><a href="'.esc_url( $atts['dribbble'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Dribble" ><span class="social-icon sicon-dribbble"></span></a></li>';
	}

	if( $atts['facebook'] ){
		$socialBlock .= '<li class="facebook"><a href="'.esc_url( $atts['facebook'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="facebook" ><span class="social-icon sicon-facebook"></span></a></li>';
	}

	if( $atts['flickr'] ){
		$socialBlock .= '<li class="flickr"><a href="'.esc_url( $atts['flickr'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Flickr" ><span class="social-icon sicon-flickr"></span></a></li>';
	}
	
	if( $atts['foursquare'] ){
		$socialBlock .= '<li class="foursquare"><a href="'.esc_url( $atts['foursquare'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Foursquare" ><span class="social-icon sicon-foursquare"></span></a></li>';
	}

	if( $atts['github'] ){
		$socialBlock .= '<li class="github"><a href="'.esc_url( $atts['github'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="github" ><span class="social-icon sicon-github"></span></a></li>';
	}

	if( $atts['google'] ){
		$socialBlock .= '<li class="google"><a href="'.esc_url( $atts['google'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Google" ><span class="social-icon sicon-google"></span></a></li>';
	}

	if( $atts['instagram'] ){
		$socialBlock .= '<li class="instagram"><a href="'.esc_url( $atts['instagram'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="instagram" ><span class="social-icon sicon-instagram"></span></a></li>';
	}

	if( $atts['linkedin'] ){
		$socialBlock .= '<li class="linkedin"><a href="'.esc_url( $atts['linkedin'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Linkedin" ><span class="social-icon sicon-linkedin"></span></a></li>';
	}

	if( $atts['mail'] ){
		$socialBlock .= '<li class="mail"><a href="mailto:'.esc_attr($atts['mail']).'" rel="noopener noreferrer" aria-label="Email" ><span class="social-icon sicon-mail"></span></a></li>';
	}

	if( $atts['pinterest'] ){
		$socialBlock .= '<li class="pinterest"><a href="'.esc_url( $atts['pinterest'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Pinterest" ><span class="social-icon sicon-pinterest"></span></a></li>';
	}

	if( $atts['rss'] ){
		$socialBlock .= '<li class="rss"><a href="'.esc_url( $atts['rss'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="RSS" ><span class="social-icon sicon-rss"></span></a></li>';
	}

	if( $atts['skype'] ){
		$socialBlock .= '<li class="skype"><a href="'.esc_url( $atts['skype'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Skype" ><span class="social-icon sicon-skype"></span></a></li>';
	}

	if( $atts['soundcloud'] ){
		$socialBlock .= '<li class="soundcloud"><a href="'.esc_url( $atts['soundcloud'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Soundcloud" ><span class="social-icon sicon-soundcloud"></span></a></li>';
	}

	if( $atts['stumbleupon'] ){
		$socialBlock .= '<li class="stumbleupon"><a href="'.esc_url( $atts['stumbleupon'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Stumbleupon" ><span class="social-icon sicon-stumbleupon"></span></a></li>';
	}

	if( $atts['tumblr'] ){
		$socialBlock .= '<li class="tumblr"><a href="'.esc_url( $atts['tumblr'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Tumblr" ><span class="social-icon sicon-tumblr"></span></a></li>';
	}

	if( $atts['twitter'] ){
		$socialBlock .= '<li class="twitter"><a href="'.esc_url( $atts['twitter'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Twitter" ><span class="social-icon sicon-twitter"></span></a></li>';
	}

	if( $atts['vimeo'] ){
		$socialBlock .= '<li class="vimeo"><a href="'.esc_url( $atts['vimeo'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Vimeo" ><span class="social-icon sicon-vimeo"></span></a></li>';
	}

	if( $atts['vine'] ){
		$socialBlock .= '<li class="vine"><a href="'.esc_url( $atts['vine'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Vine" ><span class="social-icon sicon-vine"></span></a></li>';
	}

	if ( $atts['vk'] ) {
		$socialBlock .= '<li class="vk"><a href="'.esc_url( $atts['vk'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="VK" ><span class="social-icon sicon-vk"></span></a></li>';
	}

	if( $atts['xing'] ){
		$socialBlock .= '<li class="xing"><a href="'.esc_url( $atts['xing'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Xing" ><span class="social-icon sicon-xing"></span></a></li>';
	}

	if( $atts['yelp'] ){
		$socialBlock .= '<li class="yelp"><a href="'.esc_url( $atts['yelp'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Yelp" ><span class="social-icon sicon-yelp"></span></a></li>';
	}
	
	if( $atts['youtube'] ){
		$socialBlock .= '<li class="youtube"><a href="'.esc_url( $atts['youtube'] ).'" target="'. esc_attr( $atts['target'] ) .'" rel="noopener noreferrer" aria-label="Youtube" ><span class="social-icon sicon-youtube"></span></a></li>';
	}

	$socialBlock .= "</ul>";


	return $socialBlock;
}
add_shortcode( 'wpsw', 'wpsw_shortcode' );
