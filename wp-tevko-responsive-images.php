<?php

	/*
	Plugin Name: WP Tevko Responsive Images
	Plugin URI: http://timevko.com
	Description: Fully responsive image solution using picturefill and the ID of your image.
	Version: 0.2.0
	Author: Tim Evko
	Author URI: http://timevko.com
	License: Creative Commons
	*/


	// First we queue the polyfill
	function get_picturefill() {
		wp_enqueue_script('picturefill', plugins_url('/js/picturefill.js', __FILE__ ));
	}
	add_action('init', 'get_picturefill');


	// Add support for our desired image sizes - if you add to these, you may have to adjust your shortcode function
	// TODO: Add UI for adjusting?
	add_image_size('large-img', 1000, 702);
	add_image_size('medium-img', 700, 372);
	add_image_size('small-img', 300, 200);


	function getPictureSrcs($image, $mappings) {
		$arr = array();

		foreach ($mappings as $size => $type) {
			$imageSrc = wp_get_attachment_image_src($image, $type);
			$arr[] ='<span data-src="'. $imageSrc[0] . ' "data-media="(min-width:'. $size .'px)"></span>';
		}
		return implode($arr);
	}

	function responsiveShortcode($atts) {
		extract( shortcode_atts( array(
			'imageid'    => 1,
			// You can add more sizes for your shortcodes here
			'size1' => 0,
			'size2' => 600,
			'size3' => 1000,
		), $atts ) );

		$mappings = array(
			$size1 => 'small-img',
			$size2 => 'medium-img',
			$size3 => 'large-img'
		);

	   return 
			'<span data-picture>'
				. getPictureSrcs($imageid, $mappings) .
				'<noscript>' . wp_get_attachment_image($imageid, $size2) . ' </noscript>
			</span>';
	}
	// TODO: It this the best name? responsive_img? picture?
	add_shortcode('responsive', 'responsiveShortcode');

	// Alter Media Uploader output to output shortcode instead
	// TODO: Make optional?
	// TODO: Make this know what sizes are chosen, rather than hardcoded
	function responsive_insert_image($html, $id, $caption, $title, $align, $url) {
		return "[responsive imageid='$id' size1='0' size2='600' size3='1000']";
	}
	add_filter('image_send_to_editor', 'responsive_insert_image', 10, 9);

?>