<?php
/**
 * Fruitful theme Theme Options
 *
 * @package Fruitful theme
 * @since Fruitful theme 1.0
 */

/**
 * Register the form setting for our fruitful_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, fruitful_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Fruitful theme 1.0
 */
function fruitful_theme_options_init() {
	register_setting(
		'fruitful_options', 		// Options group, see settings_fields() call in fruitful_theme_options_render_page()
		'fruitful_theme_options', 	// Database option, see fruitful_get_theme_options()
		'' // The sanitization callback, see fruitful_theme_options_validate()
	);
	$is_demo_content_installed = get_option('fruitful_demo_content');
	
	// Register our settings field group
	add_settings_section('general',			'',  '__return_false', 'theme_options' );
	add_settings_section('header',			'',  '__return_false', 'theme_options' );
	add_settings_section('background',		'',  '__return_false', 'theme_options' );
	add_settings_section('logo', 			'',  '__return_false', 'theme_options' );
	add_settings_section('colors', 			'',  '__return_false', 'theme_options' );
	add_settings_section('fonts', 			'',  '__return_false', 'theme_options' );
	add_settings_section('slider', 			'',  '__return_false', 'theme_options' );
	add_settings_section('links', 			'',  '__return_false', 'theme_options' );
	add_settings_section('footer', 			'',  '__return_false', 'theme_options' );
	add_settings_section('css', 			'',  '__return_false', 'theme_options' );
	
	if (!$is_demo_content_installed) {
		add_settings_field( 'general_idc', 		__( 'Install Home Page', 	'fruitful' ),	'fruitful_demo_content',	'theme_options',  'general', array('info' => __( 'Setup home page with dummy data, like on demo. Option can be used once.', 'fruitful' )));
	}
	
	add_settings_field( 'general_rs', 		__( 'Layout', 	'fruitful' ),	'fruitful_get_responsive_design',	'theme_options',  'general', array('info' => __( 'Theme supported 2 types of html layout. Default responsive  setting which adapt for mobile devices and static page with fixed width. Uncheck arrow below if you need static website display. ', 'fruitful' )));
	add_settings_field( 'general_cm',		__( 'Comments', 'fruitful' ), 	'fruitful_get_general_comment',  	'theme_options',  'general', array('info' => __( 'If you want to display comments on your post page or page, select options below.', 'fruitful' )));
	add_settings_field( 'general_ds',		__( 'Default theme styles',  'fruitful' ),'fruitful_get_style_theme', 'theme_options',  'general', array('info' => __( 'Default CSS. Theme option for styling is not working, if this option enable.', 'fruitful' )));
	if (class_exists('Woocommerce')) { 
		add_settings_field( 'general_sc',		__( 'Show cart in header',  'fruitful' ),'fruitful_show_cart_theme', 'theme_options',  'general', array('info' => __( 'If you want to display cart link in header select options below.', 'fruitful' )));
	}
	add_settings_field( 'general_rb',		__( 'Reset options', 'fruitful' ), 'fruitful_reset_btn',  'theme_options',  'general', array('info' => __( 'All theme options will be reset to default. ', 'fruitful' )));
	if(function_exists('icl_get_languages')){ // if WPML is activated
		add_settings_field( 'general_wpml',		__( 'Multilingual Switch in Header (WPML)', 'fruitful' ), 'fruitful_wpml_ready',  'theme_options',  'general', array('info' => __( 'If you wish to show Language Switch in header, select option below. ', 'fruitful' )));
	}
	add_settings_field( 'header_hd',		__( 'Sticky  header', 	 		 'fruitful' ), 	'fruitful_get_general_header', 	'theme_options',  'header', array('info' => __( 'Options relating to the website header', 'fruitful' )));
	add_settings_field( 'header_hi',		__( 'Background for header', 	 'fruitful' ), 	'fruitful_get_header_img', 		'theme_options',  'header', array('info' => __( 'Upload image with full width for background in header area. (Supported files .png, .jpg, .gif)  ', 'fruitful' )));
	add_settings_field( 'header_hh',		__( 'Height for header area', 	 'fruitful' ), 	'fruitful_get_header_height', 	'theme_options',  'header', array('info' => __( 'Minimum height in pixels', 'fruitful' )));
	add_settings_field( 'header_mp',		__( 'Menu Position', 			 'fruitful' ), 	'fruitful_set_menu_position', 	'theme_options',  'header', array('info' => __( 'Set menu position.', 'fruitful' )));
		
	
	add_settings_field( 'background_image', __( 'Background Image', 'fruitful' ),  'fruitful_get_background_img',   'theme_options',  'background', array('info' => __( 'Upload your background image for site background. (Supported files .png, .jpg, .gif)', 'fruitful' )));
	add_settings_field( 'background_color', __( 'Background Color ', 'fruitful' ), 'fruitful_get_background_color', 'theme_options',  'background', array('info' => __( 'Choose color for body background', 'fruitful' )));
	add_settings_field( 'content_background_color', __( 'Background color for content  ', 'fruitful' ), 'fruitful_get_container_background_color', 'theme_options',  'background', array('info' => __( 'Choose color for main content area', 'fruitful' )));
		
	add_settings_field( 'logo_image', 		__( 'Logo image', 'fruitful' ), 	'fruitful_get_logo_img', 		'theme_options', 'logo', 		array('info' => __( 'Upload logo image for your website. Size is original (Supported files .png, .jpg, .gif)', 'fruitful' )));
	//add_settings_field( 'logo_size', 		__( 'Logo Size', 'fruitful' ), 		'fruitful_get_logo_wh',	 		'theme_options', 'logo', 		array('info' => __( 'Specify resolution for your logo image. Our theme will crop (timthumb) your image for need size.', 'fruitful' )) );
	add_settings_field( 'fav_icon', 		__( 'Favicon', 'fruitful' ), 		'fruitful_get_fav_icon', 		'theme_options', 'logo', 		array('info' => __( 'Upload needed image for site favicon. (Supported files .ico (16x16))', 'fruitful' )));
	add_settings_field( 'logo_position', 	__( 'Logo Position', 'fruitful' ), 	'fruitful_set_logo_position', 	'theme_options', 'logo', 		array('info' => __( 'Set Logo Position', 'fruitful' )));
	

	add_settings_field( 'menu_style',		__( 'Main menu color', 'fruitful' ),	'fruitful_menu_style_color',		'theme_options', 'colors',    	array('info' => __( 'Choose your colors for main menu in header', 'fruitful' )) );
	add_settings_field( 'dropdown_menu_style',		__( 'Dropdown menu color', 'fruitful' ),'fruitful_dropdown_menu_style_color', 'theme_options', 'colors',    array('info' => __( 'Choose your colors for dropdown menu in header', 'fruitful' )) );
	add_settings_field( 'font_style',		__( 'General font color', 'fruitful' ),	'fruitful_font_style_color',		'theme_options', 'colors',    	array('info' => __( 'Choose your colors for text and links', 'fruitful' )) );
	add_settings_field( 'separator_style',	__( 'Color for lines', 'fruitful' ),	'fruitful_sep_style_color',		'theme_options', 'colors',    	array('info' => __( 'Choose you colors for lines and separators', 'fruitful' )) );
	add_settings_field( 'button_style',		__( 'Color for buttons', 'fruitful' ),	'fruitful_but_style_color',		'theme_options', 'colors',    	array('info' => __( 'Choose you colors for buttons', 'fruitful' )) );
	
	
	add_settings_field( 'fonts_options', 	__( 'Fonts', 'fruitful' ), 	'fruitful_fonts_options',	'theme_options', 'fonts', 		array('info' => __( 'Popular web safe font collection, select and use for your needs.', 'fruitful' )) );
	
	add_settings_field( 'fonts_headers', 	__( 'Headers', 'fruitful' ),'fruitful_fonts_headers',	'theme_options', 'fonts', array('info' => __( 'Choose font-family for all headlines.', 'fruitful' )) );
	add_settings_field( 'fonts_menu', 		__( 'Menu',    'fruitful' ),'fruitful_fonts_menu',		'theme_options', 'fonts', array('info' => __( 'Choose font-family for primary menu.', 'fruitful' )) );
	add_settings_field( 'fonts_content', 	__( 'Body', 'fruitful' ),   'fruitful_fonts_content',	'theme_options', 'fonts', array('info' => __( 'Choose font-family for content.', 'fruitful' )) );
	
	add_settings_field( 'fonts_size', 		__( 'Font size', 'fruitful' ), 		'fruitful_fonts_size',		'theme_options', 'fonts',  array('info' => __( 'Choose font size for specific html elements. Set size as number, without px.', 'fruitful' )) );
	add_settings_field( 'slider_select',	__( 'Slider', 'fruitful' ),	'fruitful_slider_select',	'theme_options', 'slider', array('info' => __( 'Select a slider type that will be used by default.', 'fruitful' )) );
	add_settings_field( 'slider_options',	__( 'Slider Options', 'fruitful' ),	'fruitful_slider_options',	'theme_options', 'slider', array('info' => __( 'Choose needed options for slider: animation type, sliding direction, speed of animations, etc', 'fruitful' )) );
	add_settings_field( 'slider_image',		__( 'Slides', 'fruitful' ), 		'fruitful_slider_images',	'theme_options', 'slider', array('info' => __( 'Add images to slider (Supported files .png, .jpg, .gif). If you want to change order, just drag and drop it. Image size for slides is original from media gallery, please upload images in same size, to get best display on page. To display slider in needed place use shortcode [fruitful_slider]. Current theme version support only one slider per website. ', 'fruitful' )) );
	
	add_settings_field( 'socials_links_position', 	__( 'Socials Links Position', 'fruitful' ), 	'fruitful_settings_field_socials_links_position', 'theme_options', 'links', array('info' => __( 'Choose place where social links will be displayed.', 'fruitful' )) );
	add_settings_field( 'socials_links', 	__( 'Socials Links', 'fruitful' ), 	'fruitful_settings_field_socials_links', 'theme_options', 'links', array('info' => __( 'Add link to your social media profiles. Icons with link will be display in header or footer.', 'fruitful' )) );
	add_settings_field( 'footer_text_copy',	__( 'Footer options', 'fruitful' ), 'fruitful_settings_field_footer_text', 'theme_options',   'footer', array('info' => __( 'Replace default theme copyright information and links', 'fruitful' )) );
	add_settings_field( 'custom_css',		__( 'Custom CSS', 'fruitful' ), 'fruitful_settings_field_custom_css', 'theme_options', 'css' , array('info' => __( 'Theme has two css files style.css and fixed-style.css which use default styles for front-end responsive and static layout. Do not edit theme default css files, use textarea editor below for overwriting all css styles.', 'fruitful' )) );
	
	if(!get_option( 'fruitful_theme_options' )) {
		add_option( 'fruitful_theme_options', fruitful_get_theme_options());
	}
}

function fruitful_settings_field_socials_links() {
	$options = fruitful_get_theme_options();
	?>
	<div class="socials">
		<h4>Facebook</h4>		<input id="facebook_url" 	class="text-input" name="fruitful_theme_options[facebook_url]" 	type="text"   value="<?php echo esc_url( $options['facebook_url'] ); ?>"/>
		<h4>Twitter</h4>		<input id="twitter_url" 	class="text-input" name="fruitful_theme_options[twitter_url]" 	type="text"   value="<?php echo esc_url( $options['twitter_url'] ); ?>"/>
		<h4>LinkedIn</h4>		<input id="linkedin_url" 	class="text-input" name="fruitful_theme_options[linkedin_url]" 	type="text"   value="<?php echo esc_url( $options['linkedin_url'] ); ?>"/>
		<h4>MySpace</h4>		<input id="myspace_url" 	class="text-input" name="fruitful_theme_options[myspace_url]" 	type="text"   value="<?php echo esc_url( $options['myspace_url'] ); ?>"/>
		<h4>Google Plus+</h4>	<input id="googleplus_url" 	class="text-input" name="fruitful_theme_options[googleplus_url]" type="text" value="<?php echo esc_url( $options['googleplus_url'] ); ?>"/>
		<h4>Dribbble</h4>		<input id="dribbble_url" 	class="text-input" name="fruitful_theme_options[dribbble_url]" 	type="text"   value="<?php echo esc_url( $options['dribbble_url'] ); ?>"/>
		<h4>Skype</h4>			<input id="skype_link" 		class="text-input" name="fruitful_theme_options[skype_link]" 	type="text"   value="<?php echo esc_attr( $options['skype_link'] ); ?>"/>
		<h4>Flickr</h4>			<input id="flickr_link" 	class="text-input" name="fruitful_theme_options[flickr_link]" 	type="text"   value="<?php echo esc_url( $options['flickr_link'] ); ?>"/>
		<h4>You Tube</h4>		<input id="youtube_url" 	class="text-input" name="fruitful_theme_options[youtube_url]"	type="text"   value="<?php echo esc_url( $options['youtube_url'] ); ?>"/>
		<h4>RSS</h4>			<input id="rss_link" 		class="text-input" name="fruitful_theme_options[rss_link]" 		type="text"   value="<?php echo esc_url( $options['rss_link'] ); ?>"/>
		<h4>Vk.com</h4>			<input id="vk_link" 		class="text-input" name="fruitful_theme_options[vk_link]" 		type="text"   value="<?php echo esc_url( $options['vk_link'] ); ?>"/>
		<h4>Instagram</h4>		<input id="instagram_url"	class="text-input" name="fruitful_theme_options[instagram_url]"	type="text"   value="<?php echo esc_url( $options['instagram_url'] ); ?>"/>
		<h4>Pinterest</h4>		<input id="pinterest_url"	class="text-input" name="fruitful_theme_options[pinterest_url]"	type="text"   value="<?php echo esc_url( $options['pinterest_url'] ); ?>"/>
		<h4>Yelp</h4>			<input id="yelp_url"		class="text-input" name="fruitful_theme_options[yelp_url]"		type="text"   value="<?php echo esc_url( $options['yelp_url'] ); ?>"/>
		<h4>E-mail</h4>			<input id="email_link" 		class="text-input" name="fruitful_theme_options[email_link]" 	type="text"   value="<?php echo sanitize_email( $options['email_link'] ); ?>"/>				
		<h4>Github</h4>			<input id="github_url"	 	class="text-input" name="fruitful_theme_options[github_url]" 	type="text"   value="<?php echo esc_url( $options['github_url'] ); ?>"/>
	</div>
	<?php
}	
?>