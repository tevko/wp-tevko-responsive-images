
Make Sure current theme has 'add_theme_support( 'post-thumbnails' );'


This plugin adds 3 custom image sizes to your wordpress thumbnail function, and then uses the image id to generate a pictureTime responsive image tag using those three sizes.

It works best with advanced custom fields. If you'd like to add more sizes, you can do so in the php file of this plugin.

Put following code wherever you'd like the image to be

<picture>
    <?php
        $image = 'the image id or ACF field name';
        $mappings = array(
            0 => 'small-img', // zero maps to default
            500 => 'medium-img',
            800 => 'large-img'
        );
        echo getPictureSrcs($image, $mappings);
    ?>
</picture>

