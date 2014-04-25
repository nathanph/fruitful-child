<?php


foreach(
		array(
			get_stylesheet_directory() . '/inc/tweaks.php',
			get_stylesheet_directory() . '/inc/widgets.php',
			get_stylesheet_directory() . '/inc/template-tags.php',
			get_stylesheet_directory() . '/inc/func/plugins-included.php',
			get_stylesheet_directory() . '/inc/func/fruitful-function.php',
			get_stylesheet_directory() . '/inc/func/import_front_page.php',
			get_stylesheet_directory() . '/inc/func/comment-inline-error.php',
			get_stylesheet_directory() . '/inc/theme-options/theme-options.php',
		) as $key => $file) 
{
	if( file_exists($file) )
	{
		require_once $file;
	}
}
	
//Create Shortcode to be used to generate random letters for smiley faces
//[smiley]
function smiley_shortcode( ){
	$random = rand(0,3);
	$character;
	if($random===0)
		$character = chr(rand(48,57));
	else if($random===1)
		$character = chr(rand(65,90));
	else if($random===2)
		$character = chr(rand(97,122));
	else {
		$array = array("$","/","%","\"","#","&",".","!");
		$character = $array[array_rand($array)];
	}
	return '<span class="smiley">'.$random.'</span>';
}
add_shortcode( 'smiley', 'smiley_shortcode' );

function fruitful_add_description_block ($atts, $content = null) {
	$out = "";
	
	 extract(shortcode_atts(array(
		  'id'		=> 'description_0',
		  'style' 	=> 'font-size: 40px; text-transform : uppercase; text-align: center; font-weight: 300;'
     ), $atts));
	 
    $out .= '<div class="description" id="'. $id .'">' . "\n";
		$out .= '<span class="top_line"></span>' . "\n";
			if (!empty($content)) {
				$out .=	'<div class="text" style="'. $style .'">' . do_shortcode($content) . '</div>';
			}
			else {
				$out .= '<div class="text" style="'. $style .'">No text Description</div>';
			}			
		$out .= '<span class="btm_line"></span>' . "\n";
	$out .= '</div>' . "\n";

    return $out;
}

/*Get footer social icons*/
function fruitful_get_socials_icon () {
	$out = '';
	$theme_options  = fruitful_ret_options("fruitful_theme_options"); 
	
	if(!empty($theme_options['facebook_url'])) 		{ $out .= '<a class="facebook" 	href="'	. esc_url($theme_options['facebook_url']) 	. '" target="_blank"></a>';	}
	if(!empty($theme_options['twitter_url']))		{ $out .= '<a class="twitter" 	href="'	. esc_url($theme_options['twitter_url']) 	. '" target="_blank"></a>'; }
	if(!empty($theme_options['linkedin_url'])) 		{ $out .= '<a class="linkedin" 	href="'	. esc_url($theme_options['linkedin_url']) 	. '" target="_blank"></a>'; }
	if(!empty($theme_options['myspace_url'])) 		{ $out .= '<a class="myspace" 	href="'	. esc_url($theme_options['myspace_url']) 	. '" target="_blank"></a>'; }	
	if(!empty($theme_options['googleplus_url'])) 	{ $out .= '<a class="googleplus" href="'. esc_url($theme_options['googleplus_url']) . '" target="_blank"></a>'; }		
	if(!empty($theme_options['dribbble_url'])) 	 	{ $out .= '<a class="dribbble" 	href="'			. esc_url($theme_options['dribbble_url']) 	. '" target="_blank"></a>'; }		
	if(!empty($theme_options['skype_link'])) 		{ $out .= '<a class="skype" 	href="skype:' 	. esc_attr($theme_options['skype_link'])	. '?call"></a>'; }		
	if(!empty($theme_options['flickr_link'])) 		{ $out .= '<a class="flickr" 	href="'		. esc_url($theme_options['flickr_link']) 	. '" target="_blank"></a>'; }		
	if(!empty($theme_options['youtube_url'])) 		{ $out .= '<a class="youtube" 	href="'		. esc_url($theme_options['youtube_url']) 	. '" target="_blank"></a>'; }		
	if(!empty($theme_options['rss_link'])) 			{ $out .= '<a class="rss" 		href="'		. esc_url($theme_options['rss_link']) 		. '" target="_blank"></a>'; }			
	if(!empty($theme_options['vk_link'])) 			{ $out .= '<a class="vk" 		href="'		. esc_url($theme_options['vk_link']) 		. '" target="_blank"></a>'; }			
	if(!empty($theme_options['instagram_url']))		{ $out .= '<a class="instagram"	href="'		. esc_url($theme_options['instagram_url'])	. '" target="_blank"></a>'; }			
	if(!empty($theme_options['pinterest_url']))		{ $out .= '<a class="pinterest"	href="'		. esc_url($theme_options['pinterest_url'])	. '" target="_blank"></a>'; }			
	if(!empty($theme_options['yelp_url']))			{ $out .= '<a class="yelp"		href="'		. esc_url($theme_options['yelp_url'])		. '" target="_blank"></a>'; }			
	if(!empty($theme_options['email_link'])) 		{ $out .= '<a class="email" 	href="mailto:'		. sanitize_email($theme_options['email_link']) . '"></a>'; }			
	if(!empty($theme_options['github_url'])) 		{ $out .= '<a class="github" 	href="'	. esc_url($theme_options['github_url']) 	. '" target="_blank"></a>';	}
	
	echo '<div class="social-icon">' . $out . '</div>';
}

/*Add information box into content block*/
function fruitful_add_info_box ($atts, $content = null) {
	global $columns_count;
	$out = $columns_class = "";
	shortcode_atts(array(
		  'id'				=> '',
		  'icon_url' 		=> '', 
		  'title'	   		=> '', 
		  'type_column' 	=> '', 
		  'alt'				=> '',
		  'style_text'	  	=> '',
		  'style_title'		=> ''
     ), $atts, 'info_box');

	 $id = 'info_box_0';
	 $icon_url  = get_template_directory_uri()  . '/images/default_icon.png'; 
	 $title		= 'Some title';
	 $type_column = '';
	 $alt 		  = '';
	 $style_text  = 'text-align:center; font-size:13px; ';
	 $style_title = 'text-align:center; font-size: 20px; text-transform: uppercase; ';

	 if (isset($atts['id'])) 			{ $id = sanitize_html_class($atts['id']); }
	 if (isset($atts['type_column'])) 	{ $type_column  = esc_attr($atts['type_column']); }
	 if (isset($atts['icon_url'])) 		{ $icon_url 	= $atts['icon_url']; }
	 if (isset($atts['title'])) 		{ $title 		= esc_attr($atts['title']); }
	 if (isset($atts['alt'])) 			{ $alt 			= esc_attr($atts['alt']); }
	 if (isset($atts['style_text'])) 	{ $style_text  	= esc_html($atts['style_text']); }
	 if (isset($atts['style_title'])) 	{ $style_title 	= esc_html($atts['style_title']); }

	 if ($columns_count != '') {
		 if ($columns_count == 1) { $columns_class	= 'sixteen columns'; } 
		 else if ($columns_count == 2)	{ $columns_class	= 'eight columns';} 
		 else if ($columns_count == 3)	{ $columns_class	= 'one-third column'; } 
		 else if ($columns_count == 4)	{ $columns_class	= 'four columns'; }
	 }

	 $out .= '<div class="'.$columns_class.' info_box '. $type_column .'" id="' . $id . '">';
		$out .= '<img class="icon" src="'. esc_url($icon_url) .'" title="' . $title . '" alt="'.$alt.'"/>';
		$out .= '<div class="infobox_title" style="' . $style_title .'">'  . $title . '</div>';
		$out .= '<div class="info_box_text" style="' . $style_text .'" >'  . do_shortcode($content) . '</div>';
	 $out .= '</div>';
return $out;	 
} 
add_shortcode ("info_box", "fruitful_add_info_box");



function fruitful_scripts () {

	$theme_options = fruitful_ret_options("fruitful_theme_options");

	wp_enqueue_script('migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array( 'jquery' ), '20130930', true );

	if (isset($theme_options['select_slider'])){

		  if ($theme_options['select_slider'] == "1") {
				wp_enqueue_style( 'flex-slider', 			get_template_directory_uri() . '/js/flex_slider/slider.css');
				wp_enqueue_script('flex-fitvid-j',			get_template_directory_uri() . '/js/flex_slider/jquery.flexslider-min.js', array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-froogaloop-j',		get_template_directory_uri() . '/js/flex_slider/froogaloop.js', 	array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-easing-j', 			get_template_directory_uri() . '/js/flex_slider/jquery.easing.js', 	array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-fitvid-j',			get_template_directory_uri() . '/js/flex_slider/jquery.fitvid.js', 	array( 'jquery' ), '20130930', true);
				wp_enqueue_script('flex-mousewheel-j',		get_template_directory_uri() . '/js/flex_slider/jquery.mousewheel.js', array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-modernizr-j',		get_template_directory_uri() . '/js/flex_slider/modernizr.js', array( 'jquery' ), '20130930', true );
			} else if ($theme_options['select_slider'] == "2") {
				wp_enqueue_style( 'nivo-bar-skin', 		get_template_directory_uri() . '/js/nivo_slider/skins/bar/bar.css');
				wp_enqueue_style( 'nivo-dark-skin', 	get_template_directory_uri() . '/js/nivo_slider/skins/dark/dark.css');
				wp_enqueue_style( 'nivo-default-skin', 	get_template_directory_uri() . '/js/nivo_slider/skins/default/default.css');
				wp_enqueue_style( 'nivo-light-skin', 	get_template_directory_uri() . '/js/nivo_slider/skins/light/light.css');
				wp_enqueue_style( 'nivo-style', 		get_template_directory_uri() . '/js/nivo_slider/nivo-slider.css');
				wp_enqueue_script('nivo-slider',		get_template_directory_uri() . '/js/nivo_slider/jquery.nivo.slider.pack.js', array( 'jquery' ), '20130930', true );
			}
	}

	/*add woocommerce styles for ie*/
	wp_enqueue_style( 'ie-style',		get_template_directory_uri() . '/woocommerce/ie.css');

	/*add fancybox*/
	wp_enqueue_script('fn-box',				get_template_directory_uri() . '/js/fnBox/jquery.fancybox-1.3.4.pack.js',   array( 'jquery' ), '20130930', true );
	wp_enqueue_script('fn-box-wheel',		get_template_directory_uri() . '/js/fnBox/jquery.mousewheel-3.0.4.pack.js', array( 'jquery' ), '20130930', true );
	wp_enqueue_style( 'fn-box-style',		get_template_directory_uri() . '/js/fnBox/jquery.fancybox-1.3.4.css');
	wp_enqueue_style( 'fn-tabs',			get_template_directory_uri() . '/js/tabs/easyResponsiveTabs.css');
	wp_enqueue_script('fn-tabs',			get_template_directory_uri() . '/js/tabs/easyResponsiveTabs.js', 	array( 'jquery' ), '20130930', true );
	wp_enqueue_script('resp-dropdown',		get_template_directory_uri() . '/js/mobile-dropdown.min.js', 	array( 'jquery' ), '20130930', true );
	wp_enqueue_script('init',				get_template_directory_uri() . '/js/init.min.js', array( 'jquery' ), '20130930', true );

	$is_fixed_header = -1;
	if (isset($theme_options['is_fixed_header']) && ($theme_options['is_fixed_header'] == 'on')) {
		$is_fixed_header = 1;
	}

	wp_localize_script( 'init', 'ThGlobal', 	array( 'ajaxurl' 			=> admin_url( 'admin-ajax.php' ), 
													   'is_fixed_header' 	=> $is_fixed_header ) 
	);  

	wp_enqueue_script('small-menu-select', get_template_directory_uri() . '/js/small-menu-select.js', array( 'jquery' ), '20130930', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	/*Smiley changer*/
	wp_enqueue_script( 'smiley_cycle', get_stylesheet_directory_uri() . '/js/home.js', array( 'jquery' ), '20130930', true );

}

?>