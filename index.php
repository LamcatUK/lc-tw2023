<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option( 'page_for_posts' );
$bg = get_the_post_thumbnail_url($page_for_posts,'full');



get_header();
?>
<main id="main">
<!-- hero -->
<section class="hero mb-4" data-parallax="scroll" data-image-src="<?=$bg?>">
    <div class="overlay--dark"></div>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-8 py-5 d-lg-flex align-items-center z-index-0">
                <div class="text-center text-lg-start">
                    <h1 class="hero__title"><?=get_the_title($page_for_posts)?></h1>
                    <a href="/get-a-quote/" class="btn btn-green mb-3">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>
    <svg class="chevron chevron--white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <!-- <polyline fill="white" points="100 50 100 100 0 100 100 50"/> -->
        <polyline points="100 50 100 100 0 100 0 50 50 75 100 50"/>
    </svg>
</section>

<div class="container-xl py-5">
        <?php
        if (get_the_content(null, false, $page_for_posts)) {
            echo '<div class="mb-5">' . get_the_content(null, false, $page_for_posts) . '</div>';
        }
/*
        $cats = get_categories(array('exclude' => array(32)));
        ?>
        <div class="filters mb-4">
            <?php
        echo '<button class="btn btn-outline-primary active me-2 mb-2" data-filter="*">All</button>';
        foreach ($cats as $cat) {
            echo '<button class="btn btn-outline-primary me-2 mb-2" data-filter=".' . cbslugify($cat->name) . '">' . $cat->cat_name . '</button>';
        }
        ?>
        </div>
        <?php
*/
        ?>
        <div class="blog_grid">
            <?php
            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
                }
                // $cats = get_the_category();
                // $category = wp_list_pluck($cats, 'name');
                // $flashcat = cbslugify($category[0]);
                // $catclass = implode(' ', array_map( 'cbslugify', $category ) );
                // $category = implode(', ',$category);

                $the_date = get_the_date('jS F, Y');

                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = get_stylesheet_directory_uri() . '/img/default.png';
                }

                ?>
                <a class="blog_grid__card" href="<?=get_the_permalink(get_the_ID())?>">
                    <div class="blog_grid__image_container">
                        <img class="blog_grid__image" src="<?=$img?>">
                    </div>
                    <div class="blog_grid__inner">
                        <h3 class="blog_grid__title mb-0"><?=get_the_title()?></h3>
                        <div class="blog_grid__date"><?=$the_date?></div>
                        <div class="blog_grid__content">
                            <div class="blog_grid__content__overlay"></div>
                            <?=wp_trim_words(get_the_content(get_the_ID()),18)?>
                        </div>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="mt-5">
        <?php
        numeric_posts_nav();
        ?>
        </div>
    </div>
</main>
<?php

get_footer();