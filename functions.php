<?php

require get_stylesheet_directory() . '/inc/theme-options/theme-options.php';
require get_stylesheet_directory() . '/inc/func/fruitful-function.php';

//Create Shortcode to be used to generate random letters for smiley faces
//[random_character]
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

?>