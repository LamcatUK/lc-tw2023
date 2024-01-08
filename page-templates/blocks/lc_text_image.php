<?php
$order_left = (get_field('order') == 'text') ? 'order-1 order-lg-1' : 'order-1 order-lg-2';
$order_right = (get_field('order') == 'text') ? 'order-2 order-lg-2' : 'order-2 order-lg-1';
$bg = get_field('background_colour');
?>
<!-- text_image_5050 -->
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
            <div class="col-lg-6 text_image_5050__image <?=$order_right?> px-lg-5">
                <img class="img-fluid" src="<?=wp_get_attachment_image_url(get_field('image'), 'full')?>">
            </div>
        </div>
    </div>
    <?php
    if (get_field('full_height')) {
        ?>
        <div class="nav-arrow"><a href="#page<?=$pp?>"><i class="fas fa-angle-down"></i></a></div>
        <?php
    }
    ?>
</section>