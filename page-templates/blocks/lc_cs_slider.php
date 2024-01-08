<?php

$q = new WP_Query(array(
    'post_type' => 'case-studies',
    'post_status' => 'publish',
    'posts_per_page' => -1,
));

if ($q->have_posts()) {
    ?>
    <div class="container-xl py-4">
        <h2 class="h3 mb-4">Recent Case Studies</h2>
        <div class="row casestudies mb-4 mx-0">
    <?php
    $delay = 0;
    while ($q->have_posts()) {
        $q->the_post();
        $gallery = get_field('gallery', get_the_ID());
        $img = wp_get_attachment_image_url($gallery[0] , 'medium' );
        ?>
        <div class="blog-item col-lg-4 mb-4 py-2 px-2 animated fadeIn delay-<?=$delay?>">
            <a href="<?=get_the_permalink(get_the_ID())?>">
                <div class="index_card">
                    <div class="index_card__image_container--sm">
                        <div class="index_card__image" style="background-image:url('<?=$img?>')"></div>
                    </div>
                    <div class="index_card__content--sm">
                        <div class="index_card__title--sm"><?=get_the_title()?></div>
                    </div>
                </div>
            </a>
        </div>
        <?php
        $delay++;
    }
    ?>
        </div>
        <div class="text-center">
            <a href="/case-studies/" class="btn btn-green">All Case Studies</a>
        </div>
    </div>
    <?php
}
wp_reset_postdata();
add_action('wp_footer', function () {
    ?>
<script type="text/javascript">
jQuery(function($){
    $('.casestudies').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true
                }
            }
        ]
    });
});
</script>
    <?php
}, 9999);