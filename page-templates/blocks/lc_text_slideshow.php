<?php
$order_left = (get_field('order') == 'text') ? 'order-1 order-lg-1' : 'order-1 order-lg-2';
$order_right = (get_field('order') == 'text') ? 'order-2 order-lg-2' : 'order-2 order-lg-1';
$bg = get_field('background_colour');
?>
<!-- text_slideshow_5050 -->
<section class="text_image_5050 py-4 bg--<?=$bg?>">
    <div class="container animated wow fadeIn">
        <div class="row">
            <div class="col-lg-6 text_image_5050__content <?=$order_left?>">
                <?php
                if (get_field('title')) {
                    echo '<h2 class="h3">' . get_field('title') . '</h2>';
                }
                echo get_field('content');
                if (get_field('cta')) {
                    $cta = get_field('cta');
                    echo '<a href="' . $cta['url'] . '" target="' . $cta['target'] .'" class="btn btn-primary">' . $cta['title'] . '</a>';
                }
                ?>
            </div>
            <div class="col-lg-6 text_image_5050__image <?=$order_right?> px-lg-5 align-items-center">
                <?php
                $gallery = get_field('slides');
                ?>
                <div class="slides animated fadeIn">
                    <?php
                    foreach ($gallery as $id) {
                        ?>
                    <img class="slide" src="<?=wp_get_attachment_image_url($id, 'thumbnail')?>">
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
add_action( 'wp_footer', function(){
    ?>
<script type="text/javascript">
(function($){
    $('.slides').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        arrows: false,
    });
})(jQuery);
</script>
    <?php
}, 9999 );
