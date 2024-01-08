<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main" class="padding-top">
    <?php
$bg = '/wp-content/uploads/2021/05/groundworks-hero.jpg';
?>
    <section class="hero mb-4" data-parallax="scroll"
        data-image-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full')?>">
        <div class="overlay--dark"></div>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-8 py-5 d-lg-flex align-items-center z-index-0">
                    <div class="text-center text-lg-start">
                        <h1 class="mb-4">404 - Page Not Found</h1>
                        <div class="hero__content fs-5 mb-4">We can't seem to find the page you're looking for</div>
                        <div class="hero__cta">
                            <a class="btn btn-default--secondary mb-4" href="/">Return to Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>