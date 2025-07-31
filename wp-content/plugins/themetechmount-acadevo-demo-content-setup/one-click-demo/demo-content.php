<?php


/******************* Helper Functions ************************/

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
	function cs_encode_string( $string ) {
		return rtrim( strtr( call_user_func( 'base'. '64' .'_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
	}
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
	function cs_decode_string( $string ) {
		return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
	}
}



/*************** Demo Content Settings *******************/
function themetechmount_action_rss2_head(){
	// Get theme configuration
	$sidebars = get_option('sidebars_widgets');
	// Get Widgests configuration
	$sidebars_config = array();
	foreach ($sidebars as $sidebar => $widget) {
		if ($widget && is_array($widget)) {
			foreach ($widget as $name) {
				$name = preg_replace('/-\d+$/','',$name);
				$sidebars_config[$name] = get_option('widget_'.$name);
			}
		}
	}
	
	// Get Menus
	$locations = get_nav_menu_locations();
	$menus     = wp_get_nav_menus();
	$menuList  = array();
	foreach( $locations as $location => $menuid ){
		if( $menuid!=0 && $menuid!='' && $menuid!=false ){
			if( is_array($menus) && count($menus)>0 ){
				foreach( $menus as $menu ){
					if( $menu->term_id == $menuid ){
						$menuList[$location] = $menu->name;
					}
				}
			}
		}
	}
	
	$config = array(
			'page_for_posts'   => get_the_title( get_option('page_for_posts') ),
			'show_on_front'    => get_option('show_on_front'),
			'page_on_front'    => get_the_title( get_option('page_on_front') ),
			'posts_per_page'   => get_option('posts_per_page'),
			'sidebars_widgets' => $sidebars,
			'sidebars_config'  => $sidebars_config,
			'menu_list'        => $menuList,
		);            
	if ( defined('THEMETECHMOUNT_THEME_DEVELOPMENT') ) {
		echo sprintf('<wp:theme_custom>%s</wp:theme_custom>', base64_encode(serialize($config)));
	}
}

if ( defined('THEMETECHMOUNT_THEME_DEVELOPMENT') ) {
	add_action('rss2_head', 'themetechmount_action_rss2_head');
}

/**********************************************************/




/********************* Ajax Callback Init **************************/
add_action( 'admin_footer', 'themetechmount_one_click_js_code' );
function themetechmount_one_click_js_code() {
	$images   = array();
	$images[] = get_template_directory_uri() . '/cs-framework-override/fields/themetechmount_one_click_demo_content/import-alert.jpg';
	$images[] = get_template_directory_uri() . '/cs-framework-override/fields/themetechmount_one_click_demo_content/import-loader.gif';
	$images[] = get_template_directory_uri() . '/cs-framework-override/fields/themetechmount_one_click_demo_content/import-success.jpg';
	
	?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
		
		/*********** Preload images **************/
		function preload(arrayOfImages) {
			$(arrayOfImages).each(function(){
				$('<img/>')[0].src = this;
			});
		}
		preload([
			<?php
			$total = count($images);
			$x     = 1;
			foreach( $images as $image ){
				echo '"'. $image . '"' ;
				if( $total != $x ){
					echo ',';
				}
				$x++;
			}
			?>
		]);
		/*****************************************/
		
	});
	</script>
	<?php
}




if( !class_exists( 'themetechmount_acadevo_one_click_demo_setup' ) ) {
	

	class themetechmount_acadevo_one_click_demo_setup{
		
		
		function __construct(){
			add_action( 'wp_ajax_acadevo_install_demo_data', array( &$this , 'ajax_install_demo_data' ) );
		}
		
		
		/**
		 * Decide if the given meta key maps to information we will want to import
		 *
		 * @param string $key The meta key to check
		 * @return string|bool The key if we do want to import, false if not
		 */
		function is_valid_meta_key( $key ) {
			// skip attachment metadata since we'll regenerate it from scratch
			// skip _edit_lock as not relevant for import
			if ( in_array( $key, array( '_wp_attached_file', '_wp_attachment_metadata', '_edit_lock' ) ) )
				return false;
			return $key;
		}
		
		
		
		
		/**
		 * Added to http_request_timeout filter to force timeout at 60 seconds during import
		 * @return int 60
		 */
		function bump_request_timeout() {
			return 600;
		}
		
		
		
		/**
		 * Map old author logins to local user IDs based on decisions made
		 * in import options form. Can map to an existing user, create a new user
		 * or falls back to the current user in case of error with either of the previous
		 */
		function get_author_mapping() {
			
			if ( ! isset( $_POST['imported_authors'] ) )
				return;

			$create_users = $this->allow_create_users();

			foreach ( (array) $_POST['imported_authors'] as $i => $old_login ) {
				// Multisite adds strtolower to sanitize_user. Need to sanitize here to stop breakage in process_posts.
				$santized_old_login = sanitize_user( $old_login, true );
				$old_id = isset( $this->authors[$old_login]['author_id'] ) ? intval($this->authors[$old_login]['author_id']) : false;

				if ( ! empty( $_POST['user_map'][$i] ) ) {
					$user = get_userdata( intval($_POST['user_map'][$i]) );
					if ( isset( $user->ID ) ) {
						if ( $old_id )
							$this->processed_authors[$old_id] = $user->ID;
						$this->author_mapping[$santized_old_login] = $user->ID;
					}
				} else if ( $create_users ) {
					if ( ! empty($_POST['user_new'][$i]) ) {
						$user_id = wp_create_user( $_POST['user_new'][$i], wp_generate_password() );
					} else if ( $this->version != '1.0' ) {
						$user_data = array(
							'user_login' => $old_login,
							'user_pass' => wp_generate_password(),
							'user_email' => isset( $this->authors[$old_login]['author_email'] ) ? $this->authors[$old_login]['author_email'] : '',
							'display_name' => $this->authors[$old_login]['author_display_name'],
							'first_name' => isset( $this->authors[$old_login]['author_first_name'] ) ? $this->authors[$old_login]['author_first_name'] : '',
							'last_name' => isset( $this->authors[$old_login]['author_last_name'] ) ? $this->authors[$old_login]['author_last_name'] : '',
						);
						$user_id = wp_insert_user( $user_data );
					}

					if ( ! is_wp_error( $user_id ) ) {
						if ( $old_id )
							$this->processed_authors[$old_id] = $user_id;
						$this->author_mapping[$santized_old_login] = $user_id;
					} else {
						printf( __( 'Failed to create new user for %s. Their posts will be attributed to the current user.', 'acadevo-demosetup' ), esc_html($this->authors[$old_login]['author_display_name']) );
						if ( defined('IMPORT_DEBUG') && IMPORT_DEBUG )
							echo ' ' . $user_id->get_error_message();
						echo '<br />';
					}
				}

				// failsafe: if the user_id was invalid, default to the current user
				if ( ! isset( $this->author_mapping[$santized_old_login] ) ) {
					if ( $old_id )
						$this->processed_authors[$old_id] = (int) get_current_user_id();
					$this->author_mapping[$santized_old_login] = (int) get_current_user_id();
				}
			}
		}
		
		
		
		/**
		 * Install demo data
		 **/
		function ajax_install_demo_data() {
		
			// Maximum execution time
			@ini_set('max_execution_time', 60000);
			@set_time_limit(60000);

			define('WP_LOAD_IMPORTERS', true);
			include_once( ACADEVO_TMDC_DIR .'one-click-demo/wordpress-importer/wordpress-importer.php' );
			$included_files = get_included_files();


			$WP_Import = new themetechmount_WP_Import;
			
			$WP_Import->fetch_attachments = true;
			
			// Getting layout type
			$layout_type = 'default';

			$filename = 'demo.xml';
			
			if( !empty($_POST['layout_type']) && $_POST['layout_type']=='rtl' ){
				$filename = 'rtl-demo.xml';
			}
			$WP_Import->import_start( ACADEVO_TMDC_DIR .'one-click-demo/'.$filename );
			
			
			$_POST     = stripslashes_deep( $_POST );
			$subaction = $_POST['subaction'];
			if( !empty($_POST['layout_type']) ){
				$layout_type = $_POST['layout_type'];
				$layout_type = strtolower($layout_type);
				$layout_type = str_replace(' ','-',$layout_type);
				$layout_type = str_replace(' ','-',$layout_type);
				$layout_type = str_replace(' ','-',$layout_type);
				$layout_type = str_replace(' ','-',$layout_type);
			}
			$data      = isset( $_POST['data'] ) ? unserialize( base64_decode( $_POST['data'] ) ) : array();
			$answer    = array();
			echo '';  //Patch for ob_start()   If you remove this the ob_start() will not work.
			
			
			switch( $subaction ) {
				
				case( 'start' ):
				
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_cat';
					$answer['message']        = __('Inserting Categories...', 'acadevo-demosetup');
					$answer['data']           = '';
					$answer['layout_type']	  = $layout_type;
				
					die( json_encode( $answer ) );
				
				break;
				
				
				case( 'install_demo_cat' ):
					wp_suspend_cache_invalidation( true );
					$WP_Import->process_categories();
					wp_suspend_cache_invalidation( false );
					
					// Output message
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_tags';
					$answer['message']        = __('All Categories were inserted successfully. Inserting Tags...', 'acadevo-demosetup');
					$answer['data']           = base64_encode( serialize( $data ) );
					$answer['layout_type']	  = $layout_type;
					
					die( json_encode( $answer ) );
				break;
				
				case( 'install_demo_tags' ):
					wp_suspend_cache_invalidation( true );
					$WP_Import->process_tags();
					wp_suspend_cache_invalidation( false );
					
					// Output message
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_terms';
					$answer['message']        = __('All Tags were inserted successfully. Inserting Terms...', 'acadevo-demosetup');
					$answer['data']           = base64_encode( serialize( $data ) );
					$answer['layout_type']	  = $layout_type;
					
					die( json_encode( $answer ) );
				break;
				
				case( 'install_demo_terms' ):
					
					wp_suspend_cache_invalidation( true );
					ob_start();
					$WP_Import->process_terms();
					ob_end_clean();
					wp_suspend_cache_invalidation( false );
					
					// Output message
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_posts';
					$answer['message']        = __('All Terms were inserted successfully. Inserting Posts...', 'acadevo-demosetup');
					$answer['data']           = base64_encode( serialize( $data ) );
					$answer['layout_type']	  = $layout_type;
					
					die( json_encode( $answer ) );
				break;
				
				
				case( 'install_demo_posts' ):
					//wp_suspend_cache_invalidation( true );
					echo '';  //Patch for ob_start()   If you remove this the ob_start() will not work.
					ob_start();
					echo '';  //Patch for ob_start()   If you remove this the ob_start() will not work.
					$WP_Import->process_posts();
					ob_end_clean();
					
					// Output message
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_images';
					$answer['message']        = __('All Posts were inserted successfully. Importing images...', 'acadevo-demosetup');
					$answer['data']           = base64_encode( serialize( $data ) );
					$answer['layout_type']	  = $layout_type;
					$answer['missing_menu_items']   = base64_encode( serialize( $WP_Import->missing_menu_items ) );
					$answer['processed_terms']      = base64_encode( serialize( $WP_Import->processed_terms ) );
					$answer['processed_posts']      = base64_encode( serialize( $WP_Import->processed_posts ) );
					$answer['processed_menu_items'] = base64_encode( serialize( $WP_Import->processed_menu_items ) );
					$answer['menu_item_orphans']    = base64_encode( serialize( $WP_Import->menu_item_orphans ) );
					$answer['url_remap']            = base64_encode( serialize( $WP_Import->url_remap ) );
					$answer['featured_images']      = base64_encode( serialize( $WP_Import->featured_images ) );
					
					die( json_encode( $answer ) );
				break;
				
				
				
				case( 'install_demo_images' ):
					$WP_Import->missing_menu_items   = unserialize( base64_decode( $_POST['missing_menu_items'] ) );
					$WP_Import->processed_terms      = unserialize( base64_decode( $_POST['processed_terms'] ) );
					$WP_Import->processed_posts      = unserialize( base64_decode( $_POST['processed_posts'] ) );
					$WP_Import->processed_menu_items = unserialize( base64_decode( $_POST['processed_menu_items'] ) );
					$WP_Import->menu_item_orphans    = unserialize( base64_decode( $_POST['menu_item_orphans'] ) );
					$WP_Import->url_remap            = unserialize( base64_decode( $_POST['url_remap'] ) );
					$WP_Import->featured_images      = unserialize( base64_decode( $_POST['featured_images'] ) );
					
					
					ob_start();
					$WP_Import->backfill_parents();
					$WP_Import->backfill_attachment_urls();
					$WP_Import->remap_featured_images();
					$WP_Import->import_end();
					ob_end_clean();
					
					// Output message
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_slider';
					$answer['message']        = __('All Images were inserted successfully. Inserting demo sliders...', 'acadevo-demosetup');
					$answer['data']           = base64_encode( serialize( $data ) );
					$answer['layout_type']	  = $layout_type;
					
					die( json_encode( $answer ) );
				break;
				
				
				
				
				case( 'install_demo_slider' ):
					
					$json_message		= __('RevSlider plugin not found. Setting the widgets and options...', 'acadevo-demosetup');
					
					if ( class_exists( 'RevSlider' ) ){
						$json_message	= __('All demo sliders inserted successfully. Setting the widgets and options...', 'acadevo-demosetup');
						
						// List of slider backup ZIP that we will import
						$slider_array	= array(
							ACADEVO_TMDC_DIR . 'sliders/home-mainclassic-slider.zip',
							ACADEVO_TMDC_DIR . 'sliders/home-maincorporate-slider.zip',
							ACADEVO_TMDC_DIR . 'sliders/home-maincreative-slider.zip',
							ACADEVO_TMDC_DIR . 'sliders/home-maincreative-slider-1.zip',
							ACADEVO_TMDC_DIR . 'sliders/home-shopmain-slider.zip',
							ACADEVO_TMDC_DIR . 'sliders/home-maincorporate-slider2.zip',
							ACADEVO_TMDC_DIR . 'sliders/home-maincorporate-slider3.zip',
						);
						
						$slider			= new RevSlider();
						foreach($slider_array as $filepath){
							if( file_exists($filepath) ){
								$result = $slider->importSliderFromPost(true,true,$filepath);  
							}
						}

					}
					
					// Output message
					$answer['answer']         = 'ok';
					$answer['next_subaction'] = 'install_demo_settings';
					$answer['message']        = $json_message;
					$answer['data']           = base64_encode( serialize( $data ) );
					$answer['layout_type']	  = $layout_type;
					
					die( json_encode( $answer ) );
					
				break;
				
				
				
				
				
				case( 'install_demo_settings' ):
					
					
					/**** Breacrumb NavXT related changes ****/
					$breadcrumb_navxt_settings						= array();
					$breadcrumb_navxt_settings['hseparator']		= '<span class="tm-bread-sep">&nbsp; &gt;&nbsp;</span>';  // General > Breadcrumb Separator
					$breadcrumb_navxt_settings['Hhome_template']	= '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="Go to %title%." href="%link%" class="%type%">Home<span class="hide">%htitle%</span></a></span>';  // General > Home Template
					$breadcrumb_navxt_settings['Hhome_template_no_anchor']	= '<span property="itemListElement" typeof="ListItem"><span property="name">%htitle%</span><meta property="position" content="%position%"></span>';  // General > Home Template
					
					// Getting existing settings
					$bcn_options    = get_option('bcn_options');
					if( !empty($bcn_options) && is_array($bcn_options) ){
						// options already exists... so merging changes with existing options
						$breadcrumb_navxt_settings = array_merge($bcn_options, $breadcrumb_navxt_settings);
					}
					update_option( 'bcn_options', $breadcrumb_navxt_settings );
					
					/**** Finish Breadcrumb NavXT changes ****/
					
					
					
					/**** START CodeStart theme options import ****/
					
					$theme_options = array();
					
					$theme_options['classic']	= 'eNrdPGtz2ziSny9V-Q9YTW3VuNa0-dJzEu_msrnZ-bBJzvHU3tRWSgWRkMQxRXBJ0I434x90f-N-2XXjQYIUJdsTO2NPnMQU0FwwuhuNfqEpOvP96exzOZvOBuV5kkU85cXgu3I2ng2-WS7Dpevhp9FskNIrXgn8EM4Gl0nM8NGbzAbLKk3n2DBnKduwTJSD7-jMm31OZq4aumY0ZjDrNQyAeVcpX9B0vqDR-argVRYj_BiRGM4GyYau5NTubKDxkE1JbDXCnAXLGRVWG2CS8zIRCc-sVg9-UyFotEbMrA4gokz-ba8Ei3eoxz8Ka1gwyTJWPCWkYUdTjoxPNit78knTDijOo6oUfGMD-LBFDIiFPVpyXFyfXCJGnyUFS7pJ0isJBp9O-YILTl7zLGZZySS1XjAbIJeq3GmAfVwwPqNrvqGH5HuY-wJ-lzQrnRLQWGrkL2iRUEXvGHm1qlIqCfOAbsE-CUcUMGbJCxtdIBOxdAxjXDB7byRHeUBokjFnzZLVWug-f2RmTJkQrHDKnEZJJjkEA9w-po5Go3jiGd7QNHUQVSXpclK1e6HCRO_1ivNVypT4uBKTc8eeNWZLWqWi3pK637Eohym_cV3X8NsCWvMLViM4ZgvqBhIKcF97czxxQFS9f9Mv3D5A8BVsTnpI_sbSCyaS6IYNhFnGGu87bl7o7t68cHj3zfMCLw4W-_cHmeY_ZaYFwz1Mcx-OacGTZtoeSQseUNLCp8w0f4-kBQ8oacNcJ80097dh2ugpM80b77Hi_sMwzVfO6qPmGHoTEc0TQVPNrB7mDfdI3OjhJK6sFr85_27jOwLHqjxnRURL9mucyP0c9Po9cxNM7RW_CHrAs3zc7PstXFzv3Vxc82Q8umJPlml-uMc8PJCmg7GLSgie1UwbPVLT0E97ExHvIBBm1_mIuUgEtv4GJH7hYZrcSOJyQQvHTiF0XCJLDTJfrOa1iMAsTdCPWltB7M9sTIH2tRD57PiYRjRmF_xIrIG9gkXrDYwSRxkTpsuJqaDHl7mjtdmxBC1N97GctTxeppwK2E-kYbE6-jlf3S55AqzKuNN87mRRkOgIVmUFUb9um1OR50iH1faZ8mEvCsDyW384PDT_3CPXO6gNn2Qh7m3DZsAqpgXwlF2ZSSwouQHz1rGN41ww_khkxxp2TbM4ZcU8iZA0Csh-lrBpsihocaVHXCJ3k6WS52ndKQ82vWQl3zAj6ktKltShRcEvnZhfZk1iQQ1B_QNLlSYrcRFBE5H_O4tqsUiZkRkzorO2_oj4EpE4wOtK8sgPeiiaRykv2RfTFbbpqvJ7pcp3t6jSaNtbr8gxuwmtl-tEsNZeLkTWOobdjKsfdlwwe0TEY-NgodSDWVmbPlwwqzbZvMnSQn84h59a9uzDVjB6nvMkM_lcXM9Xitif7gJ0GpVhwaMZKdf8ci54vkAlt5h5mpWqpUVxz4mwoDrk4o7LQ-ce-kF4GOCJm04ODEv1wPaRs_mO7GwBdeb3vXp-An_xSBP3yB8eGOnRg1O2FHIGNQiWflGlJEppWb5EGKnjaCQGXCcv0uTkRWK6lEiy7IKlPGcOXCdi4zT7ffLiGIApWRds-XKwoUkq-CzJlvwvsH9FzKEly-iGHUXA85MdHS-OKcyDq_asnK95xnoWJX_yHGDo0BmNXCdTx3M9NcNxlZ50eFugG1KT7uHJ-VwnzKd6HdkrD_hHbC15BIbRwQxlSQTnqUjyl6CmBx-fP8N-EGpcIu3wy8Ep-1fFSkEo-QHoGpByTXNoLv9V0YINCE7xclAV6eyPfvDLL78MPrbx2iO9YQ_MDsHF6RCd_cZxakPdYCCH928gzdqP2jriWdEHSf40dtHm3p6D6llgv__oe_grMotuECxCutcZlLJvuPhUwvBfGUeO787BaUwXdHl7DqL-iKOi2iweNwdvJY4qjri_9OMtmIksqJl5kbDLnthk2Dr3BqdcMDe49oLVPlSb3Toarxat3erzJLoKauge1OaiRlwwL7CbeTR3wH5pTGl8MRcIGIHmLlwiYx1eU8FWvLhcIq-KaJ1cXLByRrZGCLoyI0K8Bl11gNE3roFBVQtpx5NloqQJ0XwPrSVp2glYIVbotSbWcFqJNS_McsDAV7Khi15gLuXbjPe05hvW3TbbW0rbb4Hs8q28CXhW00MSTtC5Ur4VbhiYEZT_dG7meCzX6nc2ckGA65c5hBfA3_lunkj33fdideBQG2hYa_TuKEJe2q-4uMoNmjVzTJf203DPlRehtQF27lFiQ6mWNvzxZMPuWfX7Lv7s1VZjxSVZKEHhIHyWi7XETMa2oBgccEwl1x8gH4I4HOWKGl1Y83WW05GslJQN_TRv3x-PjGiUsPXnV3NTzqNiPYyPW7pkrsD06LFr1EVr9G7FMu2D3BUb-t6h-gux4eiglg21lzVcIrfc0kZ52JyXrdeKhA6D2pTqK2OklIECXs-TLFehOA49g5NL_sGLmJytWUbeoOd9dGRUixqBZ8MkK5Xe_1sCh45fktc0I_9geP5y8hOv_mxOiGJRKa7SOtegjETkrAHD1GxjA1vHc5paa_swlpvbehP2pagFwcUSqCXYIdAPJttcMBGmolwwePZcIk4uTASqJnRk1uqE2D2qqRurVqBInE2so-JjgDf_b0-qZRpg18HJeyCeZzQFBi1AWYgXx9D4Yj08-e8KHFwiaSk_CLpcXEL7UE-5kxhxqXTgePRlxEiZKh2Oiag7E_Q9E-SUleBcIpF3Geq_mqIPVCSlpOg9PGHxUZcov4-odcGUWzhW0bsVh3__5oy8ev_-3Q9vz_7-5u3ZHyASR0ECOlKwpt2wXFwevpdWympHoN7mrcxCbMlcXFjLnM5e7YkO_ZZ8Aip03nOb2RXjfWmn8TboTR5j4B2YoW3ldNNiQbhzRNdnco3PBA6T7w0PRyNYeHygzRiqnpJx48esvTXfMJ7pQAQ4pubdlRpBzbBhK4pQDjo4hazg1Crc3xq-I2uCgDTJEPh3EBbtKzDwHuTaza-tqM3GHbOgo2zA5jQS6CHimWtkJlQpZClowS7gHj_UVImqvYoLnuNlwKPf1T3pgj1VSTr6ve9rZ19zbvfutMJU3J9-8P37M7WG3VeUdFOG0K0zhILnXxo5daqS_aAROKULS5bTgopaoms97TUqq7YT5ib395mMeaCyJuRkjxDNvcdXw1572ztQ9p8eysHTQzl8eigPnx7Ko6eH8vjpoTx5eihPHzHK_g5T4j5inKVh5GBP55Gg25US4CCM5qO6TqKBXFzwTxras6PXXUD-bYACm65pG2hXSmy0BdbxGTtekwXcDqxDFZyacFO-uaeB7cXROZGODThmmuH1i34NOE3T_ovw4AEqxeSqj_oavJY23K2kKIVh1Za8Ae7BXFz-1Btmw--rEZIS0wHetQ_3Fg40nALv2lRG3Aengg4xe7JAmHjBGq74tlxc9bsDbhBwPA9bA75cImvvRwhlsDVcXE6WtNZ8baL2XCfa1P7egWNbAx4Jx7A4LvmkAsCbX5p1vSDAt-Q0x9pE7S9cXKmlMb9S5VJYLiZXDYcq4aogZJ3U82f_vIiaeNekVHWSgNAISZrr1r6C09EBllPZ9Wcbh17SXCIG-zI4ef6M_IeqBNusSFlEL2-hhi3NW-X4WnB57Lve9NidHJu5HZ4xeU1EaCpeDuq2ATlW1WcPta645FvrYpK-WVdWrcEvK6kuo3ItGlwnr822kP_7X4LzE1mqBvvnyEzCxyPyKk2JBClJwSD2v2DxUTunvrXF9Z2IMeMjmZ5NshtLxPwHucRLsns1jA-Z_cFE9QJQVqcqTTaJsHMbgae69R3WXFyWlkZ8I6v4s2qzaK4d0SGRM2HJxoYXzSUD0HcKbeTv0Kg_S0CrCkXPb5It2N14aNolNHdbk6a_jXQg8-KmgAPrNuaqCBLQpoiPuchD_n3AJoJlHMaj2x6A0pdErNQF0errE9DvohFbcA5uW1wiScfSxctESOWXzHzF8VWeViV-DnRJQJKdsxhzwzrQsPkKXCJHgZBSpnp9XXvNMrpIWVxcNwGOqppES9Cr-gPqYCU7SJougUkQ8Wt1AZKU9VTy5lX6nUppwuNf9SOWCNGVbjyjq9LsjtpwLZuv1VwnnPxaOQJblODcmIOj3UumLUhYDxlTX3z0wVwwaS2YvhUVY2wwb9zIyddm7x6e7eBy34ZcXGuXrEVFm7UgZz-T_1wiP9Xm3wbt8rbb3-Vrd6ltnmKNe84LseRpwud5wX9mkZjHXDCcpGVcJ45q4PCc1zfiMpWqLLI6pQaqYCmQFlunFPPHqpG8V0uVxgRsDzPKxGgulKRtqEahYK2buYrtnxF1nZ6x_iaHfGmole8w1N-rEtYlDd4WUEORddRwM7pwe94p8TyVSrbfsrjNCxgRTVkW02LvCxihfgGjDb3jlRJZG2xBXhvZpZ0bFim9E5ux_cp4qHWxPBpuCz7JVinDNxnkGxj1CKNPpnuAldS2Ehb5EgR-S07wBlX19MtGM9KSh6m5wWVFwYvQDeeLZHWP-zeddUsXbno3yNC5Y9dkZaeTcqADvApcJ9dmaIsEy2RDE3lzevru1IhrDbgBM1ZtatgxHOOzdVKSHLwcsqFXZE0vGFkwlpENuCAxAc86Zil4VfER-U9Gygosr-AkWrPonOBbFKTMWQrkrI4MtvViqhDHtg91F6731a7gHiQwnCyny0jtRGhqjjLwkkpTkYvqBKtQ3nKxBvaQJRKqKlDykw-8KK4OyaISJNP9YBaAq7FmqpyPYLBTHpH3KaMl8L24XCJ0RZOMgMeyJihyJE6WS4ZRJDlnV5e8iEvwuPOTunoqiZmphO1WIbX6Nc9b_WN7vD6srVpedL22INA2yTLejsmQbNLARjLsuuBp033JubTBRbSN1LABWyxy4He5BWItxC6M6W5BWHineQQML_upV1oPlUNZ-yDam9Seh0RbK0flcs7xjaJB19vshTSaDiTlGxAl9Ehvntb2WG83q3-LWTHRlibR-a1cJw1ux4HGdd47rUpj6cN0GTl2nZgVpFiC4TQ631h5vwMBTk5cXEXCyWEmI-DGAqDfXDDrKNPjoH1wtPNg66sGQnf2rRr0w1WZaLkg-DUJKEiiXDCcQDU1RhEjNamFMZgm8PtHLEjHm_ca2ERP7RnWYpOq9xf9dpldlTlYv1wiqW5q4trBfdXffYJRPRZIfVSRe3tQyXLpPJ3UnWvPLsHD-_WTH9_-9c0pef3u7Yez0x9fn_3w7i2oPU8Ch_VE9Vs1A1CG4LNKHagNKRHIjUswR7CXDBTgBwHPospY_AeYKpTZCr1-k14Iu-y5wb54rnv_KYQWBl87lbAjU3fbahK_y8CoLMG1ivVNBAz9S7JBPU-qXCL9VrKuBN6hB1QeqRIJmlwnJb5NeQxD_6xKRF6-y1n2pw80Qx_RPYR_yWEIDyE-jOBhhA9jeIB_yeDgu-fPFjy--vz8WU5jFJAZcaFtQ4tVkqnna_L82ZEWn0Ny1MjSZ-iQNVwiaukZGQxwdYKrDw7JviqVzrSf9UTIwxkZuflcJ1wwsIpMoG0IbTCiXV0yI54EtdFVz45Khc6eP8PJSLuReBM5TK55aVZwcXR3fl8Cyk2ckW_8SRAPXCfQQCT2FitaBPjBNgGB25pp4k-i6ei72xDUwjLDiDY17OvTPLgrRpRnhC5K0KGCyZWWMMHQ_SM8g1DPSDjER-ccFVtTDjQj8hEV6_9861ww-EHT8JNqwFEb_u-7jSE4qLzzOvyuI-4ITq6Bj5hajaQeRu51hCVUOxdcJ2WeUpDyRFY3OwsIEs5xI4zXC1EqvuTSWJopvv1ke3J-B0jGYqYwqwvtWdBlWq00TN4Dg0FXU3zvWhMROwdTB901fAsBtHhbA-ugTA8zmHh2wOrYTiiWfiaZjKe0KxGgNl7Js4FcXGveVBnKr78R606trvzeVevdrolr3oGJCqWMofFKZ5W8cWd2RyrsnhXw_Vi_d4FhGO5ZYGItYHG_f4VJPwmjvSRg-Tu-P1XHwdLZq7OoTfjaZFFNyKoz0-Za3TIh1nfQ6N6ftzvroagDZJ135wULqxftRCloITpfydoBYVlrDs_cMOxBcbpFwFxcW93GdCtb2CEMXCIS9YWwOuewkCzzVA5cXIW9pbzyUh1T_cUTNrBM9jUvYaIjo6-Km8l0_XsTYbsmoJMF0eqapW4Pu_UT9giTNzTZFavowkrR4OWB5SC7OpnbgbDTRAYMvdsdiaQmSa_RaeRGh2etBEnQ8U9qRPAVCHzlNGYbCD_1l37xvIG5_n9zRu1V';
					$theme_options['infostack']	= 'eNrdPGtv3Li1n2-A_Ad2ggJr1LL1muc6btM0vS3QbhZJFr2LYjHgSJwZrTWirkjZcYP8oP6N_rKew4dEaR62d-2svXESa8hD8pzDw_Pi0dBZGE5nn8RsOhuIi6xIeM6rwddiNp4NXiyX8dIP8NNoNsjpNa8lfohng6ssZfgYTGaDZZ3nc2yYs5xtWCHF4Gs6C2afspmvh64ZTRnM-hkGwLyrnC9oPl_Q5GJV8bpIEX6MSAxng2xDV2pqfzYweKimLHUaYc6KlYxKpw0wKbnIZMYLpzWA31RKmqwRM6cDiBDZv9yVYPEe9fhHYw0LZkXBqqeENOxozpHx2WblTj5p2wHFeVILyTcuQAhbxIBY2KMlx_UpYvRJUbCkmyy_VmDw6R1fcMnJa16krBBMURtEswFyqS69FjgE4A90zTf0mPwvzH0JvwUthFwnXDCNpUH-klYZ1fSOkVerOqeKsFww6Jbso_RkBWOWvHLRBTIRS88yBrAPRmpUXDCEZgXz1ixbraXpC0d2xpxJySpPlDTJCsUhGODvYupoNEpcJ4HlDc1zD1HVkq4m1bsXa0zMXq84X-VMi4-vMLnw3FlTtqR1Lpstafo9h3KY8oXv-5bfDtCaX7IGwTFbUD9SUID7OpjjiQOimv2b_sztAwRfwebkx-QvLL9kMktu2ECYZWzwvuPmxf7-zYuHd9-8IArSaHF4f5Bp4VNmWjQ8wDT_4ZgWPWmmHZC06AElLX7KTAsPSFr0gJI2fNJM838Zpo2eMtOC8QErHj4M00LtrD5qjqE3kdAykzQ3zNrBvOEBiRs9nMSJevGL8-82viNwrC5LViVUsJ_iRB7mYLDbM7fB1EHxS6AHPMvHzb5fwvXez7VAxaMr9mSZFsYHzMMDaToYu6il5EXDtNEjNQ27aW8j4j0EwuwmHzGXmcTWX4DEn3mYJjeSuFxc0MpzUwi9yNKAzBereSNcIjBLG_Sj1tYQhzMbU6B9LWU5Oz2lCU3ZJT-Ra2CvZMl6A6PkScGk7fJSKunpVekZbXaqQIXtPlWzitNlzqmE_UQaFquTH8vV7ZJcJ8Cqgnvt514WBYlOYFVWEf3rtjkVdY5MWO2eqRD2ogIsvwqHw2P7zz_xg6PG8CkW4t62bAasUloBT9m1ncSBUhsw7xzbNI3gj0J2bGDXtEhzVs2zBEmjgOxcJwWbZ4uKVtdmJHI3W2p5njad6mDTKyb4hllRX1KypB6tKn7lpfyqaBMLegjqH1hK2KzEZQJNRP3vLerFXCJnVmbsiN7a5iPiS2TmAa9rxaMw2kHRPMm5YD-brrhLV13eK1Whv0WVQdvdek2O3U1ovVpnknX2ciGLzjHsZ1xcw7gHuENEAjaOFlo92JWN6QOwelPM2ywt9Mdz-Glkzz1sFaMXJc8Km88NQq2Iw-k-QK9VGQ48mhGx5ldzycsFKrnFLDCs1C0dinecCAeqRy7uuDp0_nEYxccRnrjp5Miy1AzsHjmX78jODlBv_jBo5lwn8BePNPFPwuGRlR4zOGdLqWbQWgSwOqtzkuRUiJcIo3QcTSSRG28NhjtH4-3hqMH5WZ6dvy1Q_MibtE4oaiiwM3UlmCB_z_IcPgvCl6RkvMwZyRmtCmD9b85OYeTZaZ2f9-itcPYGnSFw8J-wru70VKc6cz9gq-AJ2CoPk4aCSM5zmZUvQXMOfuhOekAc4h0weyQBp0M7e9jaTF2oGyzO8P4tjl37UZsbFD4jmeqnNTQu9w5IfuCA_frD2eFPSNX5UbSI6UHvSsm-5eJTiWt_YmA2vjsHpyld0OXtOYj6I02qerN43By8lThqx_z-8nm3YCayoGHmZcaudjj7w865tzhFuMGNW6n3od7s19F4V-fs1i7T3FdQQ_-oMRcNAngj3M5juAPWx2BK08u5REAwi7RKrHV4TSVb8eqavKqSdXbJxIxsjZB0ZUfEeK-46gGjs9lcMIOqlspaZ8tMSxOi-S20CtK2E7BCrDJrTZzhtJZrXtnlgIGvVEMfvcjecncZH8Rhcyunu122d5R22AHZ56wEE3BVpscknqC3op0V3DAwIyj_-dzO8Vjuqe9s5KII1xcleEbA3_l-nih_OAxSfeBQGxhYZ_R-t1xc3YKvuLwuLZoNc2yXcbJwz7UXYbQBdh5QYkOlljb88aSX7ln1hz7-HNRWY80lVXlA4SB8Uot1xEwFi6AYvLrKFdcfIMGAOJyUmhpTqfJlljOhoZKUDf04717Ijq1oCNj6i-u5rY_RwRMGnB1dMtdgZvTYt-qiM3q_YpnugtwXbIXBsf4LwdboqJENvZcNXCK33NJWebicV62fNQk9BnUpjcY91SogPErWTZCJLFAt86woddCLc36AI03-wauUfFizgrxBl_zkxOocPQIPjU0LaoPwlwxOI79cIq9pQf7B8GCW5Hte_94eHY2CkNe5dQqyYglGBA53F6QJzgz1znZiZDZ39SjsU9UIhu9MacN5XpjUDTDhLM0ubdypXCf0VFronLg9uuksa1wi1F5Chi8yoFwwYkuML2Gc_X97ciPrXDC7js5f0zw_O4WHs_Xw_HdBGJF4OBqTyTTwoXloZtlLh7zS6nAc3BMdCd-gzfFoLu9OzJsNzVpqENk_sI90AxH4Cczbp1wn3EXPumKmXDBuck8U5Vxc5we8MivuTtKrNAWzXCcaokgYkz9nS7kmQh6Tv3FBXhUrljNxTL57_-rglpVrkLpGitFYnVEC9C5fDl4Mzt-x_6-ZkOSvXDB_dkrP7fkxXCJuslEHgtOwcxwoOIjzHeFcXP_UuNoNVmtSSONtsJuc1Sg4skO7evHQQlG8F7rvqvnWVQM_LQyGx6MRLDo-MtYTNZ5g3LpP62DNN4wXJv4BTul592Vk0APdsBVFKA_9qkpVYhrLEW4N35OsQUCaFQj8K4jGDhUKBA9yfRY2xttl455Z0D-3YHOaSHRMMSnXETRMBStBi_YB73B_bbWn3qu04iUm9R_9rh7IUhyoLjJB931fH4eGc_t3pxMd4_7sBj-8P1Nn2H0FZzclJv0mMSl5-XMDtl51cRi1Aqd1oWAlrajc1tFBq7Ia-2BvZH-dOaAHKk9CTu4Qonnw-GrRG1wnfw_K4dNDOXp6KMdPD-Xh00N59PRQHj89lFwnTw_l6SNGOdxjSvxHjLMyjBzs6TyRdLviARyE0XzU1Du0kAv-0UAHbmJmH1B4G6DIpWvaBdqXiRttgfV8xp7X5FwwdwPqWBdS2HBTvYFngN3F0TlRjg04ZobhzQt7LTjN893379EDVHypVR_17XsjbbhbWSWkZdWWvAHu0Vxc_TQb5sIfqvVREtMD3rcP9xYOtJwC79oWZNwHp6IeMQeyP5h0wVqs9LZcXA37A24QcDwPWwO-IGvvRwhVsDVcXE6WtNF8XaIOXCfY9P7egWNbAx4Jx7DILfuoA8CbX371gyjCt90Mx7pEHa6XaaSxvNYlVqqAC1eNh7rGSkOo4qrnz_55mbTxLlGzvrRJAkITJGluWncVjo6OBjCJW0e28egVrVKwL4Pz58_I_2Dl2Fm2WRFRJS9voYYdzVuX-HqvOA39YHrqT07t3B4vmLqdXCI0ly8HTduAnJ6rerOHWlde8a118UKgXVdVusEvXCfJraJyIxrnr-22kP_8m-D8RNW3wf55KpPwwwl5ledEgQhSMYj9L1l60k3ib21xc_VizfhIpWez4sbKtPBB7g6z4l4N40NmfzBRvVwwlPWpyrNNJt3cRhTobl1fAUcFS0TNlc28qDeL9rYTHRI1E1aKbHjV3jxcMH3voI38HRrNZwXoFL-Y-W2yBbtbD824hPYKbdL2d5GOVF7c1o1guchcXFdOAtoU8bHXhMi_99hEsHrEenTbA1D6soQJU9isvwYB_S6asAXn4LZlinSsmLzKpFJ-2SzUHF-VeS3wc2QqEbLigqWYGzaBhstXEDkKhAiV6g1NDTUr6FwiZ2nTBDjqXCIWI0Gvmg-og6m0pJnKmwwR_6yLdTPRTKUufJXfqZUmPP7JPGJlEl2Zxg90Jezu6A03svlaf8LJP2tHYIsSnBtzcJ1QXCKMd0DCesiY5uJjFwyQ1oHZtaJmjAsWjFs5-dLsPcCzPVxc3rUhn41L1qGiy1qQsx_Jn8n3jfl3Qfu87ff3-dpfapunWKte8koueZ7xeVnxH1lcIucpXDBnuejFUS0cnvPmvl2lUrVF1qfUQlUsB9JS55Ri_lg3km_1UsKagO1hVplYzYWStA3VKhQssbN3v7tnRF1nZmy-kaFcXFpq1bsIzfejxE0lRbAF1FLkHDXcjD7cgXdDgkCnkt23JW7zXCJFQnNWpLQ6-FwiRWxepOhC73k1RJUkO5CfrezS3g2Lkt6Jy9jdynhodLE6Gn4HPitWOcM3EtSbFM0Iq0-mB4C11HYSFuUSBH5LTvAGVffslo12pCMPU3uDy6qKV7EfzxfZ6h73b2r3T1XhCI_f-I6PpXPPrqmC0m5lgv0Snw4JjsmGJvLm3bu376y4NoAbMGP1poEdwzH-sM4EKcHLIRt6Tdb0kpEFYwXZgAuSEvCsU5aDV5WekD8yXCJqsLySk2TNkgsC4WJFRMlyIGd1YrFtFuuWCuGpbrpwvS92BfcggeFkOV0melwnYlvRVICXJGwhMKoTrAr5hss1sIcskVBdG1Kev-dVdX1MFrUkhekHs1wwXFxNDVPVfASDHXFCvs0ZFcD36prQFc0KAh7LmqDIkTRbLhlGkeSCXV_xKhXgcZfn9niILGW2XDC3X-zU6Tc87_SP3fHmsHZKiNH12oJA26Sqh3smQ7HJXDBbyXDLkadt9xXnygZXyTZSwxZssSix3mYLxFmIXVrT3YFw8M7LRL0LtJN6rfVQOYjGBzHepPE8FNpGOWqXc17QjS1hbb3NnZBW04GkvFwwUUKP9OZpXY_1drOGt5gVE215llxc3HrS6HYcaF3ng9PqNJY5TFeJ51ZwOUGKIxheq_OtlQ97EODkpHVcIr0SZrICbi1cMPoNsI42PR7aB884D66-aiFM565Vo91wdSE7Lgh-3QEKkqxcMFwnUE2tUcRITWlhDKYJ_P4O6-Dx5r0BttFTd4a13OT6PcSwW1wwVxce1q8oqtsatW5wX-_uPseoHgukftCRe3eQYKVyns6bznXglsTh_fr5d9_86c078vrtN-8_vPvu9Ye_vv0G1F6ggONmouZlngEoQ_BZlQ40hpRI5MYVmCPYSwYK8L2EZ1kXLP0NTBWrbIVZv00vxH323GBfAt-__xRCB4MvnUrYk6m7bTVJ2GdgXCIEuFapuYmAoX_INqjnSV3lXynWCeAdekDiRJdI0DITWL95CkN_r0tEXr4tWfG797RAH9E_hn_ZcQwPMT6M4GGED2N4gH_Z4Ojr588WPL3-9PxZSVMUkBnxoW1Dq1VW6OfP5PmzEyM-x-SklaVP0KFqRPTSMzIY4OoEVx8ck0NVKr1pP5mJkIczMvLLj1ww4BSZQNsQ2mBEt7pkRgIF6qKrnz2dCp09f4aTkW4jCSZqmFrzyq7g4-j-_KECVJs4Iy_CSZQOXCfQQBT2Dis6BITRNgGR35lpEk6S6ejr2xDUwbLAiDa37NuleXBXrCjPCF0I0KGSqZWWMMHQ_y08g1DPSDzER-8CFVtbDjQj6hEV6_995QH4UdvwvW7AURv-r7uNIThI3HkdftcRdwRcJ5-Bj5haTZQeRu71hCXWO5dmoswpSHmmXm_2FhAkXFzgRlivF6JUfLemtTRTfOnK9eTCHpCKxWxhVh86cKBFXq8MTLkDBoOutrTfdyZcIm4Opgm6G_gOAmjxtgY2QZkZZjEJ3IDVc51QLP3MChVPGVdcIkJtvFJnA7nWviAzVF9jI9e9Wl31_anOK2UT3756k1RaGUPjtckqBePe7J5S2DtWwNdyw50LDOP4wAITZwGH-7tXmOwmYXSQBKy3x9e2mjhYOXtNFrUNX9ssqg1ZTWbaXqs7JsT5LhnT--N2ZzMUdYCq8-69x-H0op0Qklay99WqPRBWdOYI7A3DARSnWwTMjdVtTbe2hT3CIFwi0V_sanIOC8WyQOfAddgr1JWX7piaL5BwgVWyr333Ex0Zc1VsJmteO9K3KU173C-TcEfY9KBNoji1FU4mBu8IHD_YNznbHoSbDbJg6MTuyRe1uXiDTiseJgrr5EGinhvSIIJvOOALrSnbQJRpvqOLly3M5_8CuAfQ7A';
					$theme_options['overlayinfostack']	= 'eNrdPNty3Dayz-sq_wN2XFynKqoVJd7mGlm7Pt7s2X3YOGU7tZvaSk1hSMwMIw7BJUHJWpc-6PzG-bLTjQsJcjiUlEiOFDuOZoAG0N1o9A0N0YXvzxefy8V8MSovkiziKS9GX5eL6WL0ar0O166H3yaLUUqveSXwS7gYXSUxw4_ebDFaV2m6xIYlS9mOZaIcfU0X3uJzsnDV0C2jMYNZb2BcMMy7SfmKpssVjS42Ba-yGOGniMR4MUp2dCOndhcjjYdsSmKrEeYsWM6osNpcMJOcl4lIeGa1evCTCkGjLWJmdVwwEWXyH3slWLxDPf5RWMOCSZax4jkhDTuacmR8stvYk8-adkBxGVWl4DsbwIctYkAs7NGa4_oUMfosKVjTXZJeSzD49p6vuODkLc9ilpVMUusFixFyqcqdBtgH4I90y3f0mPwPzH0JP0ualU4JaKw18pe0SKiid4q82lQplYR5QLdgn4QjChiz5oWNLpCJWDqGMYC9N5GjPCA0yZizZclmK3SfPzEzpkwIVjhlTqMkkxyCAW4fU1wnk0k88wxvaJo6iKqSdDmp2r1QYaL3esP5JmVKfFxcicmFY88aszWtUlFvSd3vWJTDlK9cXNc1_LaAtvyS1QhO2Yq6gYQC3LfeEk8cEFXv3_wXbh8g-AY2XCc9Jn9l6SUTSXTLBsIsU433PTcvdA9vXji-_-Z5gRcHq-H9Qab5z5lpwXiAae7jMS141kwbkLTgESUtfM5M8wckLXhESRs_a6a5vw7TJs-Zad50wIr7j8M0XzmrT5pj6E1ENE8ETTWzepg3HpC4yeNJXFxZrX51_t3FdwSOVXnOioiW7Oc4kcMc9Po9cxNMDYpfBD3gWT5t9v0arvdhrnkyHt2wZ8s0PxwwD4-k6WDsqhKCZzXTJk_UNPTT3kTEBwiE2XU-YikSga2_Aom_8DDNbiVxvaKFY6cQOpGlBlmuNstaRGCWJuhHra0ghjMbc6B9K0S-OD2lEY3ZJT8RW2CvYNF2B6PEScaE6XJiKujpVe5obXYqQUvTfSpnLU_XKacC9hNpWG1Ofso3d0ueXDCrMu403ztZFCQ6glVZQdSPu-ZU5DnSYbV9pnzYiwKw_Mofj4_NP_fE9Y5qw1wnWYh727AZsIppATxl12YSC0puwLJ1bOM4gD8S2amG3dIsTlmxTFwiJI0Csp8lbJqsClpcXOuRyN1kreR5XnfKg02vWMl3zIj6mpI1dWhR8CtcJ-ZXWZNYUENQ_8BSpclKXFxG0ETk_51VtVqlzMiMGdFZW39FfIlIHOB1JXnkBz0ULaOUl-wX0xW26aryB6XKd_eo0mjbW6_IMbsJrVfbRLDWXq5E1jqG3YyrH3ZcMHtExGPTYKXUg1lZmz5cMKt22bLJ0kJ_uIS_tezZh61g9Fwi50lm8rmerxSxPz8E6DQqw4JH-gXPuxqmR_QtqA5duLXydLnHfhAeB3i05rMjwzs9sH22bAYj31pAnfl9r56fwH94dol74o-PjJjowSlbCzmDUheA1VmVkiilZfkaYaQyo5EgYudswUKnaKUdHDU6P0uT83cZyhn5Jq5cIoqqCAxKVZSsJH9P0hS-l4SvSc54njKSMlpkwOPfn53CyLPTKj3v0Fvg7DU6Y-Dgv2Bd1enITnm4fsTWkkdglBzMDpZEcJ6KJH8NKnL0Y3vSgX0Pe2AObDlOhwZ12KzMbahbTMv44U2LWftJ2xUUPi2Z8m9jUWzuDUi-Z4H99uPW8c_IyblBsArpoBslZd9w8bkEsD8zApven4PzmK7o-u4cRP0RR0W1Wz1tDt5JHJUH_nCJuzswE1lQM_MyYVc9Xv24de4NTgFekNQ6Wu1DtTuso_FSztqtPtPcVVBj96g2FzUCePXbzKO5A9ZHY0rjy6VAQDCLtIiMdXhLBdvw4pq8KaJtcsnKBdkbIejGjAjxAnHTAUavsgYGVS2ktU7WiZImRPM7aC1J007ACrFCrzWzhtNKbHlhlgMGvpENXfQCc53dZrw3rv0h3W2zvaW0_RbIIWfFm4GrMj8m4Qy9FeWs4IaBGUH5T5dmjqdyIX1vIxcEuH6Zg2cE_F0e5ol0fH0vVgcOtYGGtUYf9r_ldfeGi-vcoFkzx3RpXCcL91xceRFaG2DngBIbS7W0409cJ4_0wKrfd_HvoLaaKi7JEgMKB-GzXFysJWYyKgTF4FRFKr-HD-_uIQ6O3PKTXFzRpAtTvuSiOh6UUrOjn5btW9ipEZMSxODiemmKYlYLT0eZLb2yVGB69NQ1qqM1-rCSmfdBHgq8fO9Y_QeB1-SolhO1rzVcInfc3kaR2PyXrTeKhA6D2pQG046aLSFUiraGT5hcIlctyyTLVaSLc36E403-wYuYfNyyjHyD7vnJidE_agQeIJMLVMbhrwmcTH5F3tKM_IPhIc3JD7z6ozlGCoVSXFyndSifZGuwKHDSHVR2EG63YeuITbPB2lcM15a2coUNK2oJca2pTTDPM-3mTw_FoiryPEtMl8qDsOySpTxnDsdYtUkyQKAJwJRsC7Z-PdrRJBV8gav-6RpC1ZhDS5bRHTuJwEE4P9BxdkrPVdTas3K-BZx7FiV_8BwI7sfOZDqbO57rtePeXurFFTe72x_6mt79kUCg5Fxc4KqxwwFye3VJQr2NqMJrjr0anb9n_65YKcjfXDAeOWEkSe-xTsYMhGx-Sx4ouE3LniCnKzaDeaPpPuxtflxc4B2ZoW01cetqQXhwSNeVcY0rA36M742PXCcTWHl6pK0LaoGSceNebL0t3zGe6fhcMHim5j2UscAzsWMbilDyKBayJFFrU39v-IFkBgKCcCPwbyBaGbox9-5v_00x4VDoVxs0m40HZkH_1YAtQXuh44Zn8kB8gg5iP3iPg9isgrsVFzzH_PaT39eBOH6g0EaHpQ99k-przt1jf_rBh_dnbg17qPDlttSdW6fuwI780pCmU2jrB43AKW1YspwWVHBTw1lcJ8K9RmnVtsJcXE7-NrMkj1Spg5zsEaKl9_TKsmvX91wwyv7zQzl4fiiHzw_l8fNDefL8UJ4-P5Rnzw_l-RNG2T9gStxcJ4yzNIwc7OkyEnT_8h8chMlyUl_9N5Ar_klDe3aW4hCQfxegwKZr3gY6lJ-a7IF1fMaO12QBt4PrUJUamIBTPkbTwPbi6JxIxwYcM83w-u1aA07TtP-GOniE4lwnueqTvp-upQ13KylKYVi1XCdvgHuwlH_rDbPhhxIKUmI6wIf24cHCgYZT4F2bkoWH4FTQIWYgE4S5FyxLiu_KVb874BYBx_OwN-ALsvZhhFAGW-P1bE1rzdcmajjZpvb3HhzbG_BEOIb1XslcJxVcMN7-DtT1glwwH35pjrWJGq4oqaUxv1ZFSLLECVcNxyqdqiBkDvbli39dRk28S-Ssr02SgNAISVrq1r4aysnRCCaxs9s7h17RXCIG-zI6f_mC_E7lmXcbUhbR6zuoYUvzVjm-dC1Pfdebn7qzUzO3wzN1Z0NoKl6P6rYROVW57cdaV1xc8b11Mc_drCtz4vAjTi5rjmBUrkXj_K3ZFvJ__0twflwiE9ywf47MJPx4Qt6kKZEgJSkYxP6XLD45O4UJz7tmvN7i-h7CmPGJTNAm2a21W_6j3Ksl2YMaxsfM_mCqegUoq1OVJrtE2LmNwFPdqgIBjsqWXwHjd7IwPat2q-YOEB0SORPWUux40dxCXDB976GN_B0a9XcJaJWH6PlNsgW7Gw9Nu4T6Psmsg_1tpAOZGTeVFVhQsVRXXCeANkV8zOUZ8u8DNhGsrzAe3f5cMJS-JGKlrvFVvxFcMP0uGrEV5-C2JZJ0rCm8SoRUfsnCVxzf5GlV4vdA39VcJ9kFi5OsDjRsvoLIUSCklKleX5cTs4yuUhbXTYCjKvPQEvSm_oI6mApDmq5NSRDxG1XOmpT1VPIaVPqdSmnCxz_rj1i7Qze68SPdlGZ31IZr2XyrvuHkN8oR2KME58YcXFwrlPDDHkhYDxlTX330wVwwaS2YvhUVY2wwb9rIyZdm71wwzw5wuW9DbrRL1qKizVqQs5_IX8gPtfm3Qbu87fZ3-dpdap-nWLad80KseZrwZV7wn1gkljFcMFwnadmJoxo4POf1LbRMpSqLrE6pgSpYCqTF1inF_LFqJN-ppUpjAvaHGWViNBdK0j5Uo1CwCM1cXLT2z4i6Ts9Y_3KCfG2olWX59a8KCev6Am8PqKHIOmq4GV24gWcSnqdSyfbDgbu8KYhoyrKYFoNvCkL9pqANfeCVhCzatSBvjOzSzg2LlN6Zzdh-ZTzWutjceFvwSbZJAZLn8lFBPcLok_lcMLCS2lbCXCJfg8DvyQneoaqeftloRlryMDd3uKwoeBG64XKVbB5w_-Zm_2RtSunwW5-7GDoP7JosuXRSrmr7nVxcm6E9EiyTDU3km_fv37034loD7sCMVbsadgrH-OM2KUkOXg7Z0WuypZeMrBjLyA5cXJCYgGcdsxS8qviE_DcjZQWWV3ASbVl0QbBGg5Q5S4GczYnBtl6sXUCDp7ruwvW-2BXcowSGs_V8HamdCE2dTwZeUmlKZVGdnG2D82-52AJ7yBoJPTuFlrP8_AMviutjsqoEyXQ_mAXgaqyZKucjGOyUXCfku5TREvheXFwTuqFJRsBj2RIUORJcJ-s1wyiSXFyw6ytexCV43Pm5OR5lEjNTotqt_Gn1a563-qf2eH1YW0W26HrtQaBtkvW1HZMh2aSBjWTYBbvzpvuKc2mDi2gfqXEDtlrlwO9yD8RaiF0a092CsPBO80i-lumlXmk9VA5l7YNob1J7HhJtrRyVy7nEeqVR19vshTSaDiTlFYgSeqS3T2t7rHeb1b_DrJhoS5Po4s6TBnfjQOM6D06r0lj6MF1FjqrwcZRaboIUSzCcRucbK-93IMDJiatIODnMZATcWFww9BtgHWV6HLQPjnYebH3VQOjOvlWDfrgqEy0XBF_-oyCJAnAC1dQYRYzUpBbGYJrAz--xUhxv3mtgEz21Z9iKXaqe5AE1duBeZQ7Wr0iqTcw76gT3VX_3OUb1WFwi9aOK3NuDSpZL5-m87tx6pk8_Xxmdf__tn795T96--_bDx_ffv_34t3ffgtrzJHBYT1Q_dxmBMgSfVepAbUiJQG5cXIE5gr1koFwwPwj4LKqMxb-HqUKZrdDrN-mFsMueW-yL57oPn0JoYfClUwkHMnV3rSbxuwyMyhJcXKtY30TA0D8lO9TzpCrSryTrSuAdekDliSqRoHlSYq3mKQz9oyoRef0uZ9kfPtAMfUT3GP4lxyF8CPHDBD5M8MMUPsC_ZHT09csXKx5ff375XCKnMQrIgrjQtqPFJsnU5xvy8sWJFp9jctLI0mfokDVcImrpBRmNcHWCq4-OyVCVSmfaz3pcIuThgkzc_BNcMFhFJtA2hjYY0a4uWRBPgtroqs-OSoUuXr7AyUi7kXgzOUyueWVWcHF0d35fAspNXFyQV_4siMczaCASe4sVLQL8YJ-AwG3NNPNn0Xzy9V0IamGZYUSbGvb1aR7cFSPKC0JXJehQweRKa5hg7P4XfAahXpBwjB-dC1RsTTnQgsiPqFj_-ZUD4EdNww-qAUft-H_uN4bgoPLe6_D7jrhcJzi5AT5iajWSehi51xGWUO1cXJyUeUpByhP5XDDYWUGQcIEbYbxeiFLx9Uljaeb4LMn25PwOkIzFTGFWF9qzoMu02miYvAcGg66m4N21Jlwidg6mDrpr-BYCaPH2BtZBmR5mMPHsgNWxnVAs_kwyGU9pV1wiQG28kWcDudY8IRnL3-hcIradal35q0StR1cz1zxOiQqljKHxWmeVZLG-PbsjFXbPCvhw1e9dYByGAwvMrAUs7vevMOtcJ2EySAIWt-PDpjoOls5enUVtwtcmi2pCVp2ZNtfqlgmxfq2K7v1pv7MeijpAVnp3HjVYvWhcJ0pBC9H5LaMdEJa15vDMDcNcMIrzPQKW2uo2plvZwg5hEJGo33Gqcw4ryTJP5cBV2FvKKy_VMde_S6EFDAjKZL16eGCaZQ6weTSJ_o2-QdbD6jc66pKlbg-71RP2CJM1NLkVq-TCStAgNpZ77OpUbgfCThIZMPRtD6SRmhS9RqeRGh2ctdIjQcc7qRHBRxD4EjRmOwg-9W-x4nkDc_P_qG-Osw';
					$theme_options['rtl']	= 'eNrlPGuT20Zyn6Mq_YcJXUl56xZLvPiUtHcuXR7-YrssuSpXVyrWEByS8IJcMA5cMHe1p9oPsi2d4uQ_pK6cOz3OtqycHcdf8yvIf5PueVwwAxDEriyttetIWi0409PTL_T09PSQDm17MLyXDgfDVnrgh14UREnrWjrsDVtvTafu1LTwU3fYCuhxtMzwgztsHfkTho9Wf9iaLoNghA0jFrAFC7O0dY0OreE9f2iKoXNGXCcMsJ7AXDDAOwuiMQ1GY-odzJJoGU4QvodEdIYtf0FnHLU5bEk6eJM_0RoBZ8JiRjOtDSiJo9TP_CjUWi34TbOMenOkTOtcMCZS__f6TDB5hXv8I6iGCf0wZMllXCIaNBpEKHh_MdOR94t2IHHkLdMsWuhcMDaoiAGzoKNphPNTpOge52BKF35wzMHg04fROMpcInIzClwnLEwZ59Zyhi2U0jI2CmAbgG_TebSgu-SfXDD3IfxOaZgaKZAxlcQf0sSngt8eymq2DChnzAK-M3Y3M7IExkyjRFwnF9hEKg0lGKDe6vJRFjDqh8yYM382z2Sf3VUYA5ZlLDHSmHp-yCUEA8w6oXa73UnfUrKhQWAgqcLSOVKhPVdQXCJ1PYuiWcCE-ZickgNDxzphU7oMslxcJXm_oXEOKN8yTVPJWwOaR4csXCewx8bUdDgU0D63RvjGAVO5_gavqD4g8B1QTrBL_pkFhyzzvVMUCFh6ku6XVJ5rblee23l55VmONXHGzfpBodmXWWhOp0Fo5vkJzbnUQmuwNOccLc29zEKzGyzNOUdL61xcaqGZb0Zo3cssNKvXsIrb5yM0WwSrF1piGE14NPYzGkhh1Qiv02Bx3fOzuHQ5fuPyO0vsCBJbxjFLPJqyHxNENkvQqo_M1Waq0fw86IHI8mKL702E3tulZvH96IxdWqHZbsPycE6eDsaOl1kWhbnQuhd0aajnvdgRb2EQsMt8xCjzM2x9Ayy-4svUb2QRR4xpMkrn0VHr2nhoSbqx0dDTCpXdpgQZjWej3GxcMHORCEBPLiCasx19wDTPsnjYblOPTthhtJfNQeQZ8-YLGJXthSxrH8WGdGrtZYyZh7Rtm9agbQ7aU_iYgUKR4PHM8BezvY_j2WYGBUTg9AfmRhYFJBBGRvG5kk5BTj2YlyVE_DprcoW_UHJ_rb9cXDYoJQFq37Y7nV31Y-6Z1k6-AnK5oZIL2QJVE5qAINmxQqJBcamPSu_vZOLAH05sT8LOaTgJWDLyPWSNArH3OGzgjxOaHMuRKH1_Kgx7kHfyN5wesTRaMGXzU0qm1KBJEh0Zk-goLDIMYgg6XCKYKlXpiUMPmgj_3xgvx-OAKUNRIypzy49IL8l8A2S95DKynRqORl4QpeyV-XLLfC3j18qVbW5wJcnWVS_YUdqE1qO5n7GSLsdZWHr3qqlX261cMNaYiMV6zlj4CTWzXFwDAWy5CEdFuhb63RH8zW1Pf-kSRg_iyA9VYteyhUe2B9tcMI3CT2jwuJ6gHxplUTxGb1wn3RFMLlpKHNe8ERpUhV3UOH_pzF3bcXcdfOMG_R0lUjmw_MrpckdxloAq-G0rx0_gH77SxNyzOzvKeuTggE0zjkEMgqmvLwPiBTRNbyAM93LUy1r71wN__7qvuoRJsvCQBVHMjIhkC6PQ9_71NlwwUzJP2PRGa0H9IIuGfjiNfgX6SyYRtIQhXbA9D2S-v6XjepsCHpy1ZuZ4HoWsZlLyC8tcMIF2jG6vPzAs0xIY2stgv1wi2wTjkZz1Luq6zDpaSEgPxVuORKg-bDBADwuSPxnZMUhBKEFrjcYfMy_bbLf7PatVCOit1v7q8fqz1derF-vPV1-uP18_zJm_euUsM8MCAbzA0-bkMSw45altberTV7ogNuIkmvoBawsy1w_g5z7hFH8LNH-3_lxcpxZF_VtUTORBUGFgdjclWRQFmR_fgJWtdef6xD_M5bwwwFOBT3CEpYEvS4jW6Ifo3jjBpREyl6-B6qNwyTMWk1LTnIKc0t8tacJK7dlxwIxpQDO99YhHq0YYkRKBmKMuDC7XHuGx2I0Wymf1PYjlCVk_WP1cMGJ6BL8fr54J-Vww2xUjbHBVbg3MFi-F6JCA5vBnoEM1h0C93iuGQGqi5uCn5_beePCDrlD6Sf63CHt0eTX4YUsD-_lnWTo_XCKDbDrO2KWNQT-3diXFy5Ju-ZH5gt7LS3AwoWM6PbsE0WNMvGS5GF9sCZ7JHMV-8fWlmc8gTBRBLsxDnx3V7Dc7pfde0eSggvNNjtDDcrHdK-MRsqatukCx6qA65k6-QOQEYKFCgUdKB9ZaSSmdHI4yBPRoRhOP9wN96_urP6-eErGor75a318_Wv0PrldDsjEyozM50gEmV1-sXqy-hUDlPoKLWOBPEA08huZ8PO6K8vEYofAV3J_6wtAcsCk-tZj0zzKmXDBKvls_BMRA2LPVVzkxfQ0ZXWbzKFGcdHR6FI7_xCBFDnVUtUZZU5Z0lZ28W9dTycvbJZCqinq5ihx710UluTtKu7Dm4MsSjNT4i1Jr8dIrXCLqPWFpDFtN_5CNtsuj7PTRdUhYbfT2HSWv5JhFGMzKrlwiNSO7ZMwO87wjwhPpOrCzweN1uA9bRBdcJ0X6mtcJ28S_ja6tXCekxKtnKLwE9_hkeUzmur2eJDabg1wnMZZJIAzKOktIKLuMJAuMCbiauhgRjJWl7W4bSW2b_TaSY1gd826_vxcL_mT9lZp84J7n3GJSme3gFrSgd0flYgNbmUwKJnFwPFK1X1wiH4A5lJJ_GQkwObpnKhdSGr3d2QzqILflD2xrV_wz9wbdndxmhI5zQqqqLmyypObCqejy561cJ4KFioDKnMr6gsLdpgx89DzPm6AIeMvID2ORx3FcXL4IfAquHjZNn3LXDY7_L-sHBHz689XX68_I3p7yS2I0vlgq_Q2iA6ww6AUsFU_W_7Z6TFb_johwKYD_HsDjw_VDaAaYv8Iy8wMgfQbz_Yd69QSpfBuonLlYpzxjDiwGyg4K2DxpIMWl6R_32SPdIYNik9ySTCy4m8JCCI5HpbSikP3_SL3Ucp8dRerlwJyB3PFyifG8yx3VuzkSGOSSc0wxdnu-YXN2zkKR9gJ713MxH7LfLVmakXcBHiWhwi2pY5mSbNgT2iV7oBCXjWrOqqtm05g97W3CnhYoOtaOGlp2XCenzoYv5ZYh1TSjKVwntewBOKHObrcLM_d25IqE3lwiZZEKSebWPFqwKJQbEJCZwLstCYLvxILNKM9eYayS8Apd6XXtjeFb8iMICMaNwD-D7VBTAYl1Lseqdr7w6WLcggVjXgU2Au-FwR6-k4XNuMLa1FaiHrgmpFRVwEJXkySK8Yznwmu1IU3QUHUmd72vu6zAlpLbrp3S9hT1Uw_erJ-BNux1bXhOywyaeWYQVpFX3QRVqs5tpzA44QtTFtOEZrlF56c-VuGy8pVCndT_PJMw51S2hpKsMaKRdfHuKOQB8haS7ctHsnP5SHYvH8mdy0dy9_KR3Lt8JPcvH8mDC0yyvWUpMS8wzXxhjGA9HXkZ3SyAwUXZzqtfCsBxdFcC80iwj2mFub3_Lo-MbkZBwGaMvJNk5O_pXCK-Rj6A6BvLYaBrEUNEgUwQfTN8fbl_U-QhyEcpbOb3RW5cMFA2Tm7r-ZFtQI4urkEZqGkz3N1cMK2Eo5WATANu2LWb8tanhNYpwMCHB00Q9Ell5pdEC3AaBPUVhearVhTyKRY0NsYz07S2n6gPxMnjGz1Rzw0YteRcJ2mmJLRhwkC_M-J_c0Xp8KcpYLAJv00Dr22TUQgLYnZVWfE6hOVUmGmwU8znYMHf5KyCtasDTpEsvgkbA35C0b4eO-RbuM60P6W5Py0z1ZzAE_p9CYltDLggEsNKSv8um5ztqrVpOQ7erZQSKzPVXFwGk1tjfCxq67C2kAPiLhdTtNKPYV736pXfHnrFLppwrDdU6oFQD1kayda66uTuTguQ6BnzhUGPaDKB5aW1f_UK-RuRu17MSJp4N17FAffbCrcRhYyfFxEaZDdaeVuLtFX92_nMmx1FG_Ni7ryYl-fZ4ZdeW4d7fWka-6uv1p-sH60_EefjD1ffrl6Q_31KUC3eMkFDNo4ZTe6Q1RfrT1ePV8_xBGX9SBb8PVr9N_z8QFZPsGn119X3q6dFmMDT72AJeGB0p7Wff-SJjzvl4jc9GMgtJT9cIlHBQJfnjv3wtOzRoPuqR4McPFUgbY45bfPJYbWtX2ovWnoKM-ljIFm8oIG_8DM9-eJYolsea_GrFSD8Bb9GEi4X4-IoE6MajglrSRZRoh2SgLdZf8LLO_5Y1Iz81_rz1XPJPh-nVcvI6VRyCLuL0E-WYMjTLzUt9pd5cHgeXxHAy1xcxUEPcEGRPHUMiOK8hU3kA1wwUmHi5oCUJYe-x1JZly--zgNjOeqxcRQdtK75XFwSWFR55GfcrfpDWyhgFgfLFD87shrBDw_YBHPZcmOkixmskAIjKU9N2_IKXDAL6Thgk7wJaBTFLNKg3sk_oHcXpoSs3aQZm0WJj4SfiFpzP81R8cNdF-vPhTuGx1_LRyxlojPZeJvOUqUdoX9pqjfFXCdEflwiQowNThA35gxLWx_brYGE-VAw-UFNHQywVoKpm1EIRgezeoWd_NTibZDZFinXKeREBnslLsqiBTv7mPwj-U0eWOigVdlW-6tyrU61KVMsn4qjJJtGgR-N4iTCqvHRBID9IK1s0Ao4fM_zM3Oe-p1mxVuqoBIWXDBrE-0txXy3aCQfiKlStSpsDlPORDkytKRNqMKhYE2eOhauxyhulXGM-TeLxFPFLb9Kk3_Pj5tXTVgbQGW_s3qGhW_gCr9WOquCN9xwsiyRAdfv_JzlOpBHAxZOaNJ4HciV14HK0FsuOPFSZg3yRJkwrRwMcSPu6_Kt98kd6ZLVMb0G74ezgOG9Gn4fKB-h3MqgAVgYbynPEk_B7jfMBQ9-RU-9iRQjNbMYqINnliRR4pruaOzPXqP-Bkp_vPAmNaJTb6opPrdojReiGkEEfECsYcRyNdpgQS3kyDW0kdXXEMR9oQw2B13AerZcXGjQQPD6D6tv1n8QVZ7fre-vvsJcMOAFxIIPsNzm2foBWT-E6PIzgHuM8eMjAiDfQPgIn_ewihNDyucE4siHAskzHo1-ordcMOyXWI26p5jKKSoXEaEPyLvwbstPdsB4LhvU_nQw9YTCXFxV3xRC3JWqOuOBgwk8Zx_i7i-xdIlgmSsI6vH1NrRej_dXP6y-wbCM1z19huVO8As_XCLcHwn89z14p1wnGPlDzA9ovhcSfwI6-guR944er75DnT5Zf7pHeC3tl6hEWRcMvx8B1FPCy6yeXCJcMN5U-leAX_0J9gLP4ONzXDB6oAq4eEmwBNq73o73lU5lni71XCdYtlxcfKWaJR6EEMpARZZEfpeAbOcFxdUKq1K_1H-pv6ePl_6lVC2NQeMGBK6qGB4cVxY7rjIJrKxUr7weFN1HUcSjh8TbJKpTgI3HMeg-3Vww0SZihyroKEFodAexFy2TtJ574ajRn6V59CTjYBkzcbKlPxfB8gjrwlrVOLkWUjlncIpvgc6Eak9Dq8faZ8NqnwEr5h8D3zs4M1LnbBIogv5GtIXR4lcLeoaopDLESlLstjTDMIplSsVcJ3YFAsKzyRIv9QEmZeBq0cKIB-YRq6WBS5ohwx7ddxYQsrNuVqcebhlmpeAJv3AEDSlLgCZwk8U6jlvO23M_JZgHIPD7o3DCzx8KYLXvK2OYZ4tAFPUDN3oyYxkaWCnEuVab91Yl4bGs7-YJCSxFuyPSEOVBKYvlFUPVObdUn7yH1Nr_6L1f_8OH5Ob77926_eFHN2-_-_574H4tDuzmiPJ7S639W7DcZ3M8V5FrP8lQGkf0mIAuWbpHbmXwnC1DNvlbQOXyDI6cv8iVuFXxnLLWWaZ7PvmQEhU_dV5kSwbzrLU7dlWIXppCRCi-63PgwNBf-Qv09WSZBG9z8aUgPwzc0j1RkEJjP8W62DYM_aUoyLnxfszCX9yiIYa25i78-LsuPLj40IWHLj704AF-_NbOtatXxtHk-N7VKzGdoJEMiQltC5rM_FA8n5CrV_akCe2SvcKe7kEHr8gRUw9Jq4WzE5y9tUuaaoIqaO9JRCjDIema8V1cMNBKeqCtA20wolxcyzMkFgfVyRXPhkgRD69eQWSk3EisPh_G5zxSM5g4uorf5oBcXIlD8pbddyadPjQQTr0mihIDtrPJgGOWMPXtvjfoXjsLQyUqQ9yPB0p8dd4HtaJMeUjoOAU_mjE-0xQQdMy_g2cw6iFxO_hoHKBzK4qvhoQ_onP9l7cNXDDfKRp-Ixpw1Fwi-v3LjSE4KH3peaKXHfGS4OQE5IiZYY_7YpRexVhcXKG5iZ_GAQUrF3e_jTHsbQ5QESoKh8013g4qVhvwMR-Uojm7AsS3kKoMrgptadBpsJxJmLgGBveK-ay4bcoRET2DlKcMcvgSAbjqbQzM95JymKLE0vfZhh6IYqGtH_JtYPE1Of5iJm6_Y9ZcJ89ddfiXSWXzSmU0_xZj7UJcXN9Ul4e8RDhjaDyWOTGrV8FucIddMwPeQrZrXCfouG7DBH1tAk369TP061noNrKAFwnw4lm-fecBX54DLnbdRQ5Y7bRPSjsYfQnRvtFJ9n682ZkPRR_Aq-orF0i0XlxcXCfSjCZZ5QuOKyAsLOGw1JFJA4mDDQZGctUtlm6xFlYYg12J-Hrl_HuZTGlweJGCb8NTfhQoOnhasrjWioGLPC6XA_PLUOIoKG93q5VcIvoIlchUeR6tvERLFuHhhhb3mjK7XFyB0BNWCgyD1i0preLUoOC8FFTkU2FcMIa3cVwnbAH7Rvm9d1FcXMCc_B-lVMJC';			
					
					if ( !function_exists( 'tm_cs_decode_string' ) ) {
						function tm_cs_decode_string( $string ) {
							
							// decode the encrypted theme opitons
							$options = unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
							
							
							// Getting layout type
							$layout_type = 'default';
							if( isset($_POST['layout_type']) && !empty($_POST['layout_type']) ){
								$layout_type = strtolower($_POST['layout_type']);
								$layout_type = str_replace(' ','-',$layout_type);
								$layout_type = str_replace(' ','-',$layout_type);
								$layout_type = str_replace(' ','-',$layout_type);
								$layout_type = str_replace(' ','-',$layout_type);
							}
							
							foreach( $options as $key=>$val ){
								
								// changing image path with client website url so image will be fetched from client server directly
								$demo_domains = array(
									'http://acadevo.themetechmount.net/acadevo-data/',
									'http://acadevo.themetechmount.net/overlay-infostack-header/',
									'http://acadevo.themetechmount.net/infostack-header-style/',
									'http://acadevo.themetechmount.net/',
								);
								
								// getting current site URL
								$current_url = get_site_url() . '/';
								
								if( substr($val,0,7) == 'http://' ){
									$val = str_replace( $demo_domains, $current_url, $val );
									$options[$key] = $val;
								}
							
								
							}  // foreach
						
							return $options;
						}
					}
					
					
					// Update theme options according to selected layout
					if( !empty($theme_options[$layout_type]) ){
						$new_options = tm_cs_decode_string( $theme_options[$layout_type] );
						
						// Image path URL change is pending
						// we need to replace image path with correct path 
						
						update_option('acadevo_theme_options', $new_options);
					}
					
					/**** END CodeStart theme options import ****/
						
					
					/**** START - Edit "Hello World" post and change *****/
					$hello_world_post = get_post(1);
					if( !empty($hello_world_post) ){
						$newDate = array(
							'ID'		=> '1',
							'post_date'	=> "2014-12-10 0:0:0" // [ Y-m-d H:i:s ]
						);
						
						wp_update_post($newDate);
					}
					/**** END - Edit "Hello World" post and change *****/
					

			        // Import custom configuration
					$content = file_get_contents( ACADEVO_TMDC_DIR .'one-click-demo/'.$filename );
					
					if ( false !== strpos( $content, '<wp:theme_custom>' ) ) {
						preg_match('|<wp:theme_custom>(.*?)</wp:theme_custom>|is', $content, $config);
						if ($config && is_array($config) && count($config) > 1){
							$config = unserialize(base64_decode($config[1]));
							if (is_array($config)){
								$configs = array(
										'page_for_posts',
										'show_on_front',
										'page_on_front',
										'posts_per_page',
										'sidebars_widgets',
									);
								foreach ($configs as $item){
									if (isset($config[$item])){
										if( $item=='page_for_posts' || $item=='page_on_front' ){
											$page = get_page_by_title( $config[$item] );
											if( isset($page->ID) ){
												$config[$item] = $page->ID;
											}
										}
										update_option($item, $config[$item]);
									}
								}
								if (isset($config['sidebars_widgets'])){
									$sidebars = $config['sidebars_widgets'];
									update_option('sidebars_widgets', $sidebars);
									// read config
									$sidebars_config = array();
									if (isset($config['sidebars_config'])){
										$sidebars_config = $config['sidebars_config'];
										if (is_array($sidebars_config)){
											foreach ($sidebars_config as $name => $widget){
												update_option('widget_'.$name, $widget);
											}
										}
									}
								}
								
								if ( isset($config['menu_list']) && is_array($config['menu_list']) && count($config['menu_list'])>0 ){
									foreach( $config['menu_list'] as $location=>$menu_name ){
										$locations = get_theme_mod('nav_menu_locations'); // Get all menu Locations of current theme
										
										// Get menu name by id
										$term = get_term_by('name', $menu_name, 'nav_menu');
										$menu_id = $term->term_id;
										
										$locations[$location] = $menu_id;  //$foo is term_id of menu
										set_theme_mod('nav_menu_locations', $locations); // Set menu locations
									}
								}
								
							}
						}
					}
					
					
					// overlayinfostack - change homepage slider
					if( !empty($layout_type) && $layout_type=='overlayinfostack' ){
						$show_on_front  = get_option( 'show_on_front' );
						$page_on_front  = get_option( 'page_on_front' );
						$page           = get_page( $page_on_front );
						$theme_options = get_option('acadevo_theme_options');
						update_option('acadevo_theme_options', $theme_options);
						if( $show_on_front == 'page' && !empty($page) ){
							$post_meta = get_post_meta( $page_on_front, '_themetechmount_metabox_group', true );
							$post_meta['revslider'] = 'home-maincreative-slider-1';
							update_post_meta( $page_on_front, '_themetechmount_metabox_group', $post_meta );
						}
					}
					
					
					
					$user_migration = array();
					global $wpdb;

					$existing_users = array();
					$existing_users_obj = get_users( array( 'number' => -1, 'fields' => array( 'ID', 'user_login' ) ) );
					foreach ( $existing_users_obj as $existing_user ) {
						$existing_users[$existing_user->user_login] = $existing_user->ID;
					}

					$user_data = file_get_contents( ACADEVO_TMDC_DIR . 'one-click-demo/instructor-users/inst-users.json' );
					$user_data = json_decode( $user_data, true );

					foreach ( $user_data as $user_value ) {
						if ( array_key_exists( $user_value['user_login'], $existing_users ) ) {
							if ( user_can( $existing_users[$user_value['user_login']], 'lp_teacher' ) ) {
								wp_delete_user( $existing_users[$user_value['user_login']] );
							}
							else {
								continue;
							}
						}

						$old_id = $user_value['ID'];
						unset( $user_value['ID'] );
						if ( $wpdb->insert( $wpdb->users, $user_value ) ) {
							$this->user_migration[$old_id] = $wpdb->insert_id;
						}
					}
					
					$user_meta_data = file_get_contents( ACADEVO_TMDC_DIR . 'one-click-demo/instructor-users/inst-usermeta.json' );
					$user_meta_data = json_decode( $user_meta_data, true );

					foreach ( $user_meta_data as $user_meta_value ) {

						if ( !array_key_exists( $user_meta_value['user_id'], $this->user_migration ) ) {
							continue;
						}

						$user_meta_value['user_id'] = $this->user_migration[$user_meta_value['user_id']];
						$user_meta_value['meta_value'] = maybe_unserialize( $user_meta_value['meta_value'] );

						$old_prefix = 'ac_';
						$new_prefix = $wpdb->prefix;
						$user_meta_value['meta_key'] = preg_replace("/{$old_prefix}/", $new_prefix, $user_meta_value['meta_key'], 1 );

						if ( $user_meta_value['meta_key'] == '_lp_profile_picture' ) {
							$user_meta_value['meta_value'] = preg_replace( '/(\w+)\/(\w+)\/(\w+)/', '${1}/'. $user_meta_value['user_id'] .'/${3}', $user_meta_value['meta_value'] );
						}
						update_user_meta( $user_meta_value['user_id'], $user_meta_value['meta_key'], $user_meta_value['meta_value'] );
					}
						
										
					// Update term count in admin section
					tm_update_term_count();
					flush_rewrite_rules(); // flush rewrite rule
					
					$answer['answer'] = 'finished';
					$answer['reload'] = 'yes';
					die( json_encode( $answer ) );
					
				break;
				
			}
			die;
		}
		
		
		
		/**
		 * Fetch and save image
		 **/
		function grab_image($url,$saveto){
			$ch = curl_init ($url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
			$raw=curl_exec($ch);
			curl_close ($ch);
			if(file_exists($saveto)){
				unlink($saveto);
			}
			$fp = fopen($saveto,'x');
			fwrite($fp, $raw);
			fclose($fp);
		}



	} // END class

} // END if



if( !function_exists('tm_update_term_count') ){
function tm_update_term_count(){
	$get_taxonomies = get_taxonomies();
	foreach( $get_taxonomies as $taxonomy=>$taxonomy2 ){
		$terms = get_terms( $taxonomy, 'hide_empty=0' );
		$terms_array = array();
		foreach( $terms as $term ){
			$terms_array[] = $term->term_id;
		}
		if( !empty($terms_array) && count($terms_array)>0 ){
			$output = wp_update_term_count_now( $terms_array, $taxonomy );
		}
	}
}
}

	
	


// For AJAX callback
$themetechmount_acadevo_one_click_demo_setup = new themetechmount_acadevo_one_click_demo_setup;