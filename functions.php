<?php

require get_stylesheet_directory() . '/inc/theme-options/theme-options.php';

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

function fruitful_child_add_description_block ($atts, $content = null) {

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

add_shortcode ("shortcode_enabled_description", "fruitful_child_add_description_block");

/*Get footer social icons*/
function fruitful_child_get_socials_icon () {
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

?>