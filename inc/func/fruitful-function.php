<?php
function fruitful_get_default_array() {
return array(
				/*General Settings*/
				'responsive'		=> 'on',
				'postcomment'		=> 'on',
				'pagecomment'		=> 'on',
				'is_fixed_header'	=> 'off',
				'styletheme'		=> 'off',
				'showcart'  		=> 'on',
				'is_wpml_ready'		=> 'on',

				/*Header image*/
				'header_bg_color'	=> '#ffffff',	
				'header_img' 	=> '',
				'header_height' => '84',
				
				/*Background Image*/
				'backgroung_img'    => '',
				'background_color'	=> '#ffffff', 
				'bg_repeating'		=> 'off',
				'container_bg_color' => '#ffffff', 
				
				/*logo*/
				'logo_img'			=> '',
				'fav_icon'			=> '',
				
				'logo_position'		=> '0',
				'menu_position'		=> '2',
				
				/*Color*/
				'menu_bg_color'		=> '#ffffff',
				'menu_btn_color'	=> '#F15A23',
				'menu_hover_color'	=> '#ffffff',
				'menu_font_color'	=> '#333333',		
				

				/*Dropdown Color*/
				'dd_menu_bg_color'		=> '#ffffff',
				'dd_menu_btn_color'		=> '#F15A23',
				'dd_menu_hover_color'	=> '#333333',
				'dd_menu_font_color'	=> '#333333',		
	
				/*General font colors*/
				'p_font_color'			=> '#333333',
				'a_font_color'			=> '#333333',
				'a_hover_font_color'	=> '#FF5D2A',
				'a_focus_font_color'	=> '#FF5D2A',
				'a_active_font_color'	=> '#FF5D2A',
				
				/*Color for lines*/
				'widgets_sep_color'		=> '#F15A23',	
				'btn_color'				=> '#333333',	
				'btn_active_color'		=> '#F15A23',	
				'date_of_post_b_color' 	=> '#F15A23',
				'date_of_post_f_color'	=> '#ffffff',
				
				
				/*fonts*/
				'h_font_family'		=> 'Open Sans, sans-serif',
				'h1_size'			=> '27',
				'h2_size'			=> '23',
				'h3_size'			=> '20',
				'h4_size'			=> '17',
				'h5_size'			=> '14',
				'h6_size'			=> '12',
				'm_font_family'		=> 'Open Sans, sans-serif',
				'm_size'			=> '14',
				'p_font_family'		=> 'Open Sans, sans-serif',
				'p_size'			=> '14',
				'select_slider'     => '1',
				
				
				/*Sliders*/
				
				//'s_width'			=> '960',
				//'s_height'		=> '520',
				
				/*slider flex*/
				's_animation'		=> 'fade', 
				's_direction'		=> 'horizontal',
				's_reverse'			=> 'false',
				's_slideshow'		=> 'true',
				's_slideshowSpeed'	=> '7000',
				's_animationSpeed'	=> '600',
				's_initDelay'		=> '0',
				's_randomize'		=> 'false',
				's_controlnav'		=> 'true',
				
				/*slider nivo*/
				'nv_skins'				=> 'theme-bar',
				'nv_animation' 			=> 'random',
				'nv_slice' 				=> '15',
				'nv_boxCols' 			=> '8',
				'nv_boxRows' 			=> '4',
				'nv_animSpeed' 			=> '500',
				'nv_pauseTime' 			=> '3000',
				'nv_startSlide'			=> '0',
				'nv_directionNav' 		=> 'true',
				'nv_controlNav' 		=> 'true',
				'nv_controlNavThumbs' 	=> 'false',
				'nv_pauseOnHover' 		=> 'true',
				'nv_manualAdvance' 		=> 'false',
				'nv_prevText' 			=> 'Prev',
				'nv_nextText' 			=> 'Next',
				'nv_randomStart' 		=> 'false',
				'slides'				=> '',
				
				/*End Sliders*/
				
				/*footer*/			 
				'footer_text'	 => esc_attr__( 'Fruitful theme by', 'fruitful' ) . ' <a href="' . esc_url(__('http://fruitfulcode.com','fruitful')) . '">' . esc_attr__( 'fruitfulcode', 'fruitful' ) . '</a> ' . esc_attr__( 'Powered by:', 'fruitful' ) . ' <a href="' . esc_url(__('http://wordpress.org','fruitful')) . '">' . esc_attr__( 'WordPress', 'fruitful' ) . '</a>', 
				
				/*socials*/
				'sl_position'		=> '0',
				'facebook_url' 		=> '',
				'twitter_url' 		=> '',
				'linkedin_url'		=> '',
				'myspace_url'		=> '',
				'googleplus_url'	=> '',
				'dribbble_url'		=> '',
				'skype_link'		=> '',
				'flickr_link'		=> '',
				'youtube_url'		=> '',
				'rss_link'			=> '',
				'vk_link'			=> '',
				'instagram_url'		=> '',
				'pinterest_url'		=> '',
				'yelp_url'			=> '',
				'email_link'		=> '', 
				'github_url'		=> '', 

				'custom_css'        => stripslashes('')
		);
}
?>