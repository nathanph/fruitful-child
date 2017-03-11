<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

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
		) as $key => $file) {
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
	if(!empty($theme_options['pgp_key'])) 		{ $out .= '<a class="pgp" 	href="'	. esc_url($theme_options['pgp_key']) 	. '" target="_blank"></a>';	}
	if(!empty($theme_options['coinbase_url'])) 		{ $out .= '<a class="coinbase" 	href="'	. esc_url($theme_options['coinbase_url']) 	. '" target="_blank"></a>';	}

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
		switch($theme_options['select_slider']) {
			// Flex Slider
			case "1":
				wp_enqueue_script('flex-fitvid-j',			get_template_directory_uri() . '/js/flex_slider/jquery.flexslider-min.js', array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-froogaloop-j',		get_template_directory_uri() . '/js/flex_slider/froogaloop.js', 	array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-easing-j', 			get_template_directory_uri() . '/js/flex_slider/jquery.easing.js', 	array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-fitvid-j',			get_template_directory_uri() . '/js/flex_slider/jquery.fitvid.js', 	array( 'jquery' ), '20130930', true);
				wp_enqueue_script('flex-mousewheel-j',		get_template_directory_uri() . '/js/flex_slider/jquery.mousewheel.js', array( 'jquery' ), '20130930', true );
				wp_enqueue_script('flex-modernizr-j',		get_template_directory_uri() . '/js/flex_slider/modernizr.js', array( 'jquery' ), '20130930', true );
				break;
			// Nivo Slider
			case "2":
				wp_enqueue_script('nivo-slider',		get_template_directory_uri() . '/js/nivo_slider/jquery.nivo.slider.pack.js', array( 'jquery' ), '20130930', true );
				break;
		}
	}

	/*add fancybox*/
	wp_enqueue_script('fn-box',				get_template_directory_uri() . '/js/fnBox/jquery.fancybox-1.3.4.pack.js',   array( 'jquery' ), '20130930', true );
	wp_enqueue_script('fn-box-wheel',		get_template_directory_uri() . '/js/fnBox/jquery.mousewheel-3.0.4.pack.js', array( 'jquery' ), '20130930', true );
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

function fruitful_get_responsive_style () {
}

function fruitful_footer_custom_styles () {
	$style_ = $back_style = $woo_style_ = '';
	$theme_options  = fruitful_ret_options("fruitful_theme_options");

 	if (isset($theme_options['responsive']) && ($theme_options['responsive'] == 'on')) {
		wp_enqueue_style('main-style',  get_stylesheet_uri());
	} else {
		wp_enqueue_style('main-style',  get_stylesheet_directory_uri()  .'/fixed-style.css');
	}

 	if (isset($theme_options['responsive']) && ($theme_options['responsive'] == 'on') && is_plugin_active( "woocommerce/woocommerce.php" )) {
			wp_enqueue_style( 'woo-style', get_template_directory_uri() . '/woocommerce/woo.css');
	} else if ( is_plugin_active( "woocommerce/woocommerce.php" ) ) {
			wp_enqueue_style( 'woo-style', get_template_directory_uri() . '/woocommerce/woo-fixed.css');
	}

	if (!empty($theme_options['styletheme'])) {
		if ($theme_options['styletheme'] == 'off') {
			$style_ .= 'H1 {font-size : '.esc_js($theme_options['h1_size']) .'px; }' . "\n";
			$style_ .= 'H2 {font-size : '.esc_js($theme_options['h2_size']) .'px; }' . "\n";
			$style_ .= 'H3 {font-size : '.esc_js($theme_options['h3_size']) .'px; }' . "\n";
			$style_ .= 'H4 {font-size : '.esc_js($theme_options['h4_size']) .'px; }' . "\n";
			$style_ .= 'H5 {font-size : '.esc_js($theme_options['h5_size']) .'px; }' . "\n";
			$style_ .= 'H6 {font-size : '.esc_js($theme_options['h6_size']) .'px; }' . "\n";

			$style_ .= 'H1, H2, H3, H4, H5, H6 {font-family : '. esc_js($theme_options['h_font_family']) .'; } ' . "\n";
			$style_ .= '.main-navigation a     {font-family : '. esc_js($theme_options['m_font_family']) .'; color : '.esc_js($theme_options['menu_font_color']). '; } ' . "\n";
			$style_ .= '.main-navigation ul:not(.sub-menu) > li > a, .main-navigation ul:not(.sub-menu) > li:hover > a   { font-size : '.esc_js($theme_options['m_size']) .'px;    } ' . "\n";


			if (!empty($theme_options['menu_bg_color']))   { $style_ .= '.main-navigation {background-color : ' .esc_js($theme_options['menu_bg_color']) . '; }' . "\n";  }

			$style_ .= '#header_language_select a {font-family : '.  esc_js($theme_options['m_font_family']) .';} ' . "\n";
			$style_ .= 'body {font-size : '. esc_js($theme_options['p_size']) .'px; font-family : ' . esc_js($theme_options['p_font_family']) . '; }' . "\n";


			if(!empty($theme_options['background_color']))  { $back_style .= ' background-color : '. esc_js($theme_options['background_color']) .'; '; }
			if(!empty($theme_options['backgroung_img']))    {
				$bg_url = array();
				$bg_url = wp_get_attachment_image_src(intval($theme_options['backgroung_img']), 'full');
				$bg_url = esc_url_raw($bg_url[0]);

				if(isset($theme_options['bg_repeating']) && ($theme_options['bg_repeating'] == 'on')) {
					$back_style .= 'background-image : url(' .$bg_url .'); background-repeat : repeat; ';
				} else {
					$back_style .= 'background-image : url(' .$bg_url .'); background-repeat : no-repeat; background-size:100% 100%; background-size:cover; background-attachment:fixed; ';
				}
			}

			$style_ .= 'body {'. $back_style .'}' . "\n";

			if(!empty($theme_options['container_bg_color']))  {
				$style_ .= '.container.page-container {background-color : '. esc_js($theme_options['container_bg_color']) . '; } ' . "\n";
			}


			if (!empty($theme_options['header_bg_color']))   { $style_ .= '.head-container  {background-color : ' .esc_js($theme_options['header_bg_color']) . '; }' . "\n";  }
			if (!empty($theme_options['header_img']))    {
				$header_url = wp_get_attachment_image_src(intval($theme_options['header_img']), 'full');
				$header_url = esc_url_raw($header_url[0]);
				$style_ .= '.head-container {background-image : url(' .esc_js($header_url) . '); } ' . "\n";
			}

			if (!empty($theme_options['header_height'])) {
				$style_ .= '.head-container {min-height : '.esc_js($theme_options['header_height']).'px; }' . "\n";
			}

			if (!empty($theme_options['menu_btn_color']))    { $style_ .= '.main-navigation ul li.current_page_item a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current-menu-parent a, .main-navigation ul li.current_page_parent a {background-color : '.esc_js($theme_options['menu_btn_color']) . '; }' . "\n";  }
			if (!empty($theme_options['menu_hover_color']))  { $style_ .= '.main-navigation ul li.current_page_item a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current-menu-parent a, .main-navigation ul li.current_page_parent a {color : '.esc_js($theme_options['menu_hover_color']) . '; } ' . "\n";  }

			$style_ .= '.main-navigation ul > li:hover>a {' . "\n";
				if (!empty($theme_options['menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['menu_btn_color']) . '; ' . "\n"; }
				if (!empty($theme_options['menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['menu_hover_color']) . ';  ' . "\n"; }
			$style_ .= ' } ' . "\n";

			/*styles for dropdown menu*/
			$style_ .= '#masthead .main-navigation ul > li > ul > li > a {' . "\n";
				if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_font_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
			$style_ .= ' } ' . "\n";

			$style_ .= '#masthead .main-navigation ul > li > ul > li:hover > a {' . "\n";
				if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
			$style_ .= ' } ' . "\n";

			$style_ .= '#masthead .main-navigation ul > li ul > li.current-menu-item > a {' . "\n";
				if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
			$style_ .= ' } ' . "\n";

			$style_ .= '#masthead div .main-navigation ul > li > ul > li > ul a {' . "\n";
				if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_font_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
			$style_ .= ' } ' . "\n";

			$style_ .= '#masthead div .main-navigation ul > li > ul > li > ul li:hover a {' . "\n";
				if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
			$style_ .= ' } ' . "\n";

			$style_ .= '#lang-select-block li ul li a{'. "\n";
				if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_font_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
			$style_ .= '}';

			$style_ .= '#lang-select-block li ul li a:hover{'. "\n";
				if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
			$style_ .= '}';

			$style_ .= '#lang-select-block li ul li.active a{'. "\n";
				if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
				if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
			$style_ .= '}';
			/*end of styles for dropdown menu*/

			$style_ .= '#header_language_select ul li.current > a { color : '.esc_js($theme_options['menu_font_color']). '; } ' . "\n";
			if (!empty($theme_options['menu_bg_color'])) { $style_ .= '#header_language_select { background-color : '.esc_js($theme_options['menu_bg_color']) . '; } ' . "\n";  }

			$style_ .= '#header_language_select ul li.current:hover > a { ' . "\n";
				if (!empty($theme_options['menu_btn_color']))    { $style_ .= 'background-color : '. esc_js($theme_options['menu_btn_color']) . ';' . "\n"; }
				if (!empty($theme_options['menu_hover_color']))  { $style_ .= 'color : '.esc_js($theme_options['menu_hover_color']) . ';' . "\n"; }
			$style_ .= '} ' . "\n";

			/*Add Custom Colors to theme*/
			if (!empty($theme_options['p_font_color']))  	    { $style_ .= 'body {color : '. esc_js($theme_options['p_font_color']) .'; } ' . "\n"; }
			if (!empty($theme_options['a_font_color']))   		{ $style_ .= 'a    {color : '. esc_js($theme_options['a_font_color']) .'; } ' . "\n"; }
			if (!empty($theme_options['a_hover_font_color']))   { $style_ .= 'a:hover   {color : '. esc_js($theme_options['a_hover_font_color']) .'; } '  . "\n"; }
			if (!empty($theme_options['a_focus_font_color']))   { $style_ .= 'a:focus   {color : '. esc_js($theme_options['a_focus_font_color']) .'; } '  . "\n"; }
			if (!empty($theme_options['a_active_font_color']))  { $style_ .= 'a:active  {color : '. esc_js($theme_options['a_active_font_color']) .'; } ' . "\n"; }
			if (!empty($theme_options['widgets_sep_color']))  {
				$style_ .= '#page .container #secondary .widget h3.widget-title, #page .container #secondary .widget h1.widget-title, header.post-header .post-title  {border-color : '. esc_js($theme_options['widgets_sep_color']) .'; } ' . "\n";
				$style_ .= 'body.single-product #page .related.products h2  {border-bottom-color : '. esc_js($theme_options['widgets_sep_color']) .'; } ' . "\n";
			}

			if (!empty($theme_options['date_of_post_b_color']))  {
				$style_ .= '.blog_post .date_of_post  {background : none repeat scroll 0 0 '. esc_js($theme_options['date_of_post_b_color']) .'; } ' . "\n";
			}

			if (!empty($theme_options['date_of_post_f_color']))  {
				$style_ .= '.blog_post .date_of_post  {color : '. esc_js($theme_options['date_of_post_f_color']) .'; } ' . "\n";
			}

			$woo_style_ .= '.num_of_product_cart {border-color: '. esc_js($theme_options['menu_btn_color']) . '; }  ' . "\n";

			if (!empty($theme_options['btn_color'])) {
				$style_		 .= 'button, input[type="button"], input[type="submit"], input[type="reset"]{background-color : '.esc_js($theme_options['btn_color']).' !important; } ' . "\n";
				$woo_style_  .= '.woocommerce table.my_account_orders .order-actions .button, .woocommerce-page table.my_account_orders .order-actions .button{background-color : '.esc_js($theme_options['btn_color']).' !important; } ' . "\n";
				$style_ 	 .= '.nav-links.shop .pages-links .page-numbers, .nav-links.shop .nav-next a, .nav-links.shop .nav-previous a{background-color : '.esc_js($theme_options['btn_color']).' !important; } ' . "\n";
			}

			if (!empty($theme_options['btn_active_color'])) {
				$style_ .= 'button:hover, button:active, button:focus{background-color : '.esc_js($theme_options['btn_active_color']).' !important; } ' . "\n";
				$style_ .= 'input[type="button"]:hover, input[type="button"]:active, input[type="button"]:focus{background-color : '.esc_js($theme_options['btn_active_color']).' !important; } ' . "\n";
				$style_ .= 'input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus{background-color : '.esc_js($theme_options['btn_active_color']).' !important; } ' . "\n";
				$style_ .= 'input[type="reset"]:hover, input[type="reset"]:active, input[type="reset"]:focus{background-color : '.esc_js($theme_options['btn_active_color']).' !important; } ' . "\n";
				$woo_style_  .= '.woocommerce table.my_account_orders .order-actions .button:hover, .woocommerce-page table.my_account_orders .order-actions .button:hover{background-color : '.esc_js($theme_options['btn_active_color']).' !important; } ' . "\n";
				$style_ .= '.nav-links.shop .pages-links .page-numbers:hover, .nav-links.shop .nav-next a:hover, .nav-links.shop .nav-previous a:hover, .nav-links.shop .pages-links .page-numbers.current{background-color : '.esc_js($theme_options['btn_active_color']).' !important; } ' . "\n";
			}
		} else {
			$style_ .= 'body {font-family:Open Sans, sans-serif}' . "\n";
		}
	}

	if (!empty($theme_options['custom_css'])) {
		$style_ .= wp_kses_stripslashes($theme_options['custom_css']) . "\n";
	}

	wp_add_inline_style( 'main-style', $style_ );
	if ($woo_style_ != '') {
		wp_add_inline_style( 'woo-style', $woo_style_ );
	}
}
add_action( 'wp_enqueue_scripts', 'fruitful_footer_custom_styles' );

function fruitful_footer_styles () {
	$theme_options  = fruitful_ret_options("fruitful_theme_options");

	wp_enqueue_style('fonts-style', get_template_directory_uri()    . '/inc/css/fonts-style.css');

	if (isset($theme_options['select_slider'])){
		switch($theme_options['select_slider']) {
			// Flex Slider
			case "1":
				wp_enqueue_style( 'flex-slider', 			get_template_directory_uri() . '/js/flex_slider/slider.css');
				break;
			// Nivo Slider
			case "2":
				wp_enqueue_style( 'nivo-style', 		get_template_directory_uri() . '/js/nivo_slider/nivo-slider.css');
				switch($theme_options['nv_skins']) {
					case "theme-bar":
						wp_enqueue_style( 'nivo-bar-skin', 		get_template_directory_uri() . '/js/nivo_slider/skins/bar/bar.css');
						break;
					case "theme-dark":
						wp_enqueue_style( 'nivo-dark-skin', 	get_template_directory_uri() . '/js/nivo_slider/skins/dark/dark.css');
						break;
					case "theme-default":
						wp_enqueue_style( 'nivo-default-skin', 	get_template_directory_uri() . '/js/nivo_slider/skins/default/default.css');
						break;
					case "theme-light":
						wp_enqueue_style( 'nivo-light-skin', 	get_template_directory_uri() . '/js/nivo_slider/skins/light/light.css');
						break;
				}
				break;
		}
	}

	/*add woocommerce styles for ie*/
	if ( is_plugin_active( "woocommerce/woocommerce.php" ) ) {
		wp_enqueue_style( 'ie-style',		get_template_directory_uri() . '/woocommerce/ie.css');
	}

	wp_enqueue_style( 'fn-tabs',			get_template_directory_uri() . '/js/tabs/easyResponsiveTabs.css');
	wp_enqueue_style( 'fn-box-style',		get_template_directory_uri() . '/js/fnBox/jquery.fancybox-1.3.4.css');
}
add_action( 'wp_enqueue_scripts', 'fruitful_footer_styles' );

?>
