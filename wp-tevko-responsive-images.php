<?php

	/*
	Plugin Name: WP Tevko Responsive Images
	Plugin URI: http://timevko.com
	Description: Fully responsive image solution using Borealis and the ID of your image.
	Version: 0.0.1
	Author: Tim Evko
	Author URI: http://timevko.com
	License: Creative Commons
	*/


	//first we get borealis

	function get_borealis() {
	    wp_enqueue_script( 'borealis', plugins_url( '/js/borealis.js', __FILE__ ));
	}

	add_action('init','get_borealis');

	//add support for our desired image sizes
	add_image_size( 'large-img', 1000, 702);
	add_image_size( 'medium-img', 700, 372);
	add_image_size( 'small-img', 300, 200);

	function getBorealisSrcs($image, $mappings)
	{
	    $arr = array();
        //mapings are defined here, but can be overridden in the template files, just redefine the variable there, or here, it doesn't really matter
        $mappings = array(
            0 => 'small-img', // zero maps to default
            700 => 'medium-img',
            1000 => 'large-img'
    	);
	    foreach ($mappings as $size => $type)
	    {
            $imageSrc = wp_get_attachment_image_src($image, $type);
            if ($size)
            {
                    $arr[] = $size . ': ' . $imageSrc[0];
            }
            else
            {
                    $arr[] = $imageSrc[0];
            }
	    }
	    return implode(', ', $arr);
	}

?>