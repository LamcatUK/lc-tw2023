<?php
/**
 * The template for displaying all single posts
 *
 * @package lc-tideywebb
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action('wp_head',function(){
    echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css" />';
});

get_header();
?>
<main id="main">
<?php
the_post();

$catnames = get_the_category(get_the_ID());
$catnameArr = array();
if ($catnames) {
    foreach ($catnames as $obj) {
        $catnameArr[] = $obj->category_nicename;
    }
}
$cats = implode(', ', $catnameArr);
$posttags = get_the_tags();
$tagnameArr = array();
if ($posttags) {
    foreach ($posttags as $tag) {
        $tagnameArr[] = $tag->name;
    }
}
$tags = implode(', ', $tagnameArr);
?>

    <div class="container-xl pt-sm-0 pt-lg-5 mt-3">
        <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
        <div class="max-ch">
                <?php
                if (get_the_post_thumbnail_url()) {
                    ?>
                <div class="single_blog__image mb-4" style="background-image:url(<?=get_the_post_thumbnail_url(get_the_ID(), 'full')?>"></div>
                    <?php
                }
                ?>
                <h1 class="single_blog__title"><?=get_the_title()?></h1>
                <div class="py-4">
                    <?=apply_filters('the_content', get_the_content())?>
                </div>
            </div>
        </div>
        <div class="container-xl py-4">
        <?php
            $images = get_field('gallery');
            if ($images) {
                echo '<div class="gallery">';
                foreach ($images as $img) {
                    ?>
                    <a class="gallery__preview" data-fancybox="gallery" href="<?=wp_get_attachment_image_url( $img, 'full' )?>" style="background-image:url(<?=wp_get_attachment_image_url( $img, 'medium' )?>)"></a>
                    <?php
                }
                echo '</div>';
            }
        ?>
        <?php lc_post_nav(); ?>
        </div>
    </div>
</main>
<?php

add_action( 'wp_footer', function(){
    ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/jquery.fancybox.min.js"></script>
    <?php
},9999);

get_footer();
