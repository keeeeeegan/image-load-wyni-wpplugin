<?php

/*
* Plugin Name: Image Loading WYNI
* Author: Keegan Berry
* Author URI: http://keeganberry.com
* Description: Modifies post content so that images will instead load as you scroll to them
*/

function ilwyni_modify_image_content($content) {
	// replace image tags with the placeholder div	
	return preg_replace('/<img(.*?)src="(.*?)"(.*?)>/i', '<div class="img-placeholder" data-src="$2"></div>', $content);
}

function ilwyni_add_script_and_styles()  
{  
	// Register the script like this for a plugin:  
	wp_register_script( 'custom-liwyni-script', plugins_url( '/image-load-wyni.js', __FILE__ ) , array('jquery'));  
	wp_register_style('custom-liwyni-style', plugins_url('/image-load-wyni.css', __FILE__) );
	
	// For either a plugin or a theme, you can then enqueue the script:  
	wp_enqueue_script( 'custom-liwyni-script' );
	wp_enqueue_style('custom-liwyni-style');  
}  

add_action( 'wp_enqueue_scripts', 'ilwyni_add_script_and_styles' ); 
add_action('the_content', 'ilwyni_modify_image_content');
