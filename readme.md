This plugin tells WordPress to create three additional sizes for images you upload. Then it outputs special HTML (via a shortcode) that works with the Picturefill library to achieve responsive images in content.

### Usage

	Shortcode -
    [responsive imageid="12" size1="0" size2="500" size3="1000"]

    PHP (use in template files) -

    <?php
		$imageid = 'your image id';
		$mappings = array(
            0 => 'small-img', // zero maps to default
            250 => 'large-img',
            1000 => 'full-width'
        );
	?>
	<picture>
        <!--[if IE 9]><video style="display: none;"><![endif]-->
        <?php echo tevkori_get_picture_srcs($imageid, $mappings) ?>
        <!--[if IE 9]></video><![endif]-->
        <img srcset="<?php wp_get_attachment_image_src( $imageid )[0] ?>" alt="<?php tevkori_get_img_alt( $imageid ) ?>">
        <noscript> <?php echo wp_get_attachment_image( $imageid, $mappings[0] ) ?> </noscript>
    </picture>

### Tutorial

Here: http://css-tricks.com/hassle-free-responsive-images-for-wordpress
