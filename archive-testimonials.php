<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main" class="pb-4 pt-5">
    <div class="container py-5 pt-sm-0 pt-lg-5 mt-3">
        <h1>Testimonials</h1>
        <?php
        $test = new WP_query(array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
            'posts_per_page' => -1
        ));

        if ($test->have_posts()) {
            while ($test->have_posts()) {
                $test->the_post();
                global $post;
                $slug = $post->post_name;
            ?>
                    <div class="">
            <a class="anchor" id="<?=$slug?>"></a>
            <div class="mb-4 max-ch border-bottom px-lg-0 testimonial">
                <div class="quote"><?=apply_filters('the_content',get_the_content())?></div>
                <div class="cite py-4"><?=get_the_title()?></div>
            </div>
            <?php
            }
            ?>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</main>
<?php

get_footer();
