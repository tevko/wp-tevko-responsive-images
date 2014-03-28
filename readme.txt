
Make Sure current theme has 'add_theme_support( 'post-thumbnails' );'


This plugin adds 3 custom image sizes to your wordpress thumbnail function, and then uses the image id to generate a pictureTime responsive image tag using those three sizes.

It works best with advanced custom fields. If you'd like to add more sizes, you can do so in the php file of this plugin.

Put following code wherever you'd like the image to be in your template files

<span data-picture>
    <?php
        $image ='the id of your image';
        $mappings = array(
            0 => 'small-img', // zero maps to default
            500 => 'medium-img',
            800 => 'large-img'
        );
        echo getPictureSrcs($image, $mappings),
        '<noscript>',wp_get_attachment_image( $image, 800 ),' </noscript>';
    ?>
</span>

To use as a shortcode, pass in the image id and breakpoint sizes. ex:

[responsive imageid="12" size1="0" size2="500" size3="1000"]



