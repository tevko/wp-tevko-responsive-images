<?php
defined('ABSPATH') or die("No script kiddies please!");
/*
Plugin Name: WP Tevko Responsive Images
Plugin URI: http://timevko.com
Description: Fully responsive image solution using picturefill and the ID of your image. Supports sizes and picture syntax
Version: 2.0.0
Author: Tim Evko
Author URI: http://timevko.com
License: GPL2
*/


// First we queue the polyfill 
function tevkori_get_picturefill() {
	echo 
    '<style>
	    picture {
	    	display: block;
	    }
    </style>
    <script>
    // Picture element HTML5 shiv
    document.createElement( "picture" );
    </script>
    <script src="' . plugins_url( 'js/picturefill.js', __FILE__ ) . '" async></script>' ;
}
add_action( 'wp_footer', 'tevkori_get_picturefill' );


// ensure theme support for thumbnails exists, if not add it

function add_thumbnail_support() {
	$supported = get_theme_support( 'post-thumbnails' );
	if( $supported == false )
		add_theme_support( 'post-thumbnails');
}

add_action( 'after_setup_theme', 'add_thumbnail_support' );

// Add support for our default image sizes - if you add to these, you may have to adjust your shortcode function
// TODO: Add UI for adjusting?
function tevkori_add_image_sizes() {
	add_image_size( 'large-img', 1280, 702 );
    add_image_size( 'large-img', 960, 702 );
    add_image_size( 'medium-img', 640, 372 );
    add_image_size( 'small-img', 320, 200 );
}
add_action( 'plugins_loaded', 'tevkori_add_image_sizes' );


// alt tags will now be automatically included
function tevkori_get_img_alt( $id ) {
	$alt = wp_prepare_attachment_for_js( $id )['alt'];
	$title = wp_prepare_attachment_for_js( $id )['title'];
	if ($alt) {
		return $alt;
	} else {
		return $title;
	}
}

function tevkori_get_picture_srcs( $image, $mappings ) {
    $arr = array();
    foreach ( $mappings as $size => $type ) {
        $image_src = wp_get_attachment_image_src( $image, $type );
        $arr[] = '<source srcset="'. $image_src[0] . '" media="(min-width: '. $size .'px)">';
    }
    return implode( array_reverse ( $arr ) );
}

//http://codex.wordpress.org/Function_Reference/wp_get_attachment_metadata

function tevkori_responsive_shortcode( $atts ) {
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
        '<picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->'
            . tevkori_get_picture_srcs( $imageid, $mappings ) .
            '<!--[if IE 9]></video><![endif]-->
            <img srcset="' . wp_get_attachment_image_src( $imageid )[0] . '" alt="' . tevkori_get_img_alt( $imageid ) . '">
            <noscript>' . wp_get_attachment_image( $imageid, $mappings[0] ) . ' </noscript>
        </picture>';
}
// TODO: It this the best name? responsive_img? picture?
add_shortcode( 'responsive', 'tevkori_responsive_shortcode' );

// Alter Media Uploader output to output shortcode instead
// TODO: Make optional?
// TODO: Make this know what sizes are chosen, rather than hardcoded
function tevkori_responsive_insert_image( $html, $id, $caption, $title, $align, $url ) {
    return "[responsive imageid='$id' size1='0' size2='600' size3='1000']";
}
add_filter( 'image_send_to_editor', 'tevkori_responsive_insert_image', 10, 9 );
