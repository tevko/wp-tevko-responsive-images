<?php

	/*
	Plugin Name: WP Tevko Responsive Images
	Plugin URI: http://timevko.com
	Description: Fully responsive image solution using pictureTime and the ID of your image.
	Version: 0.2.0
	Author: Tim Evko
	Author URI: http://timevko.com
	License: Creative Commons
	*/


	//first we get pictureTime and matchMedia.js

	function get_pictureTime() {
	    wp_enqueue_script( 'pictureTime', plugins_url( '/js/pictureTime.js', __FILE__ ));
	}

    function get_matchMedia() {
        wp_enqueue_script( 'matchMedia', plugins_url( '/js/matchMedia.js', __FILE__ ));
    }

	add_action('init','get_pictureTime');
    add_action('init','get_matchMedia');

	//add support for our desired image sizes
	add_image_size( 'large-img', 1000, 702);
	add_image_size( 'medium-img', 700, 372);
	add_image_size( 'small-img', 300, 200);

    function getPictureSrcs($image, $mappings)
    {
        $arr = array();

        foreach ($mappings as $size => $type)
        {
            $imageSrc = wp_get_attachment_image_src($image, $type);
            $arr[] ='<source srcset="'. $imageSrc[0] . ' "media="(min-width:'. $size .'px)"/>';
        }
        return implode(array_reverse($arr));
    }

?>