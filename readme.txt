This plugin tells WordPress to create three additional sizes for images you upload. Then it outputs special HTML (via a shortcode) that works with the Picturefill library to achieve responsive images in content.

### Usage

    [responsive imageid="12" size1="0" size2="500" size3="1000"]

### Prereqs

Make sure your current theme has 

    'add_theme_support( 'post-thumbnails' );'

in the `functions.php` file.

### Tutorial

Here: http://css-tricks.com/hassle-free-responsive-images-for-wordpress