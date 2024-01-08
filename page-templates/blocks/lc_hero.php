<section class="hero mb-4" data-parallax="scroll" data-image-src="<?=get_the_post_thumbnail_url( get_the_ID(), 'full' )?>">
    <div class="overlay--dark"></div>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-8 py-5 d-flex align-items-center z-index-0">
                <div>
                    <h1 class="hero__title"><?=get_field('title')?></h1>
                    <div class="hero__content mb-4"><?=get_field('content')?></div>
                    <?php
                    if (get_field('show_cta')) {
                        ?>
                        <a href="/get-a-quote/" class="btn btn-green">Get a Quote</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <svg class="chevron chevron--white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <!-- <polyline fill="white" points="100 50 100 100 0 100 100 50"/> -->
        <polyline points="100 50 100 100 0 100 0 50 50 75 100 50"/>
    </svg>
</section>
