<?php
$cat = get_field('category');
$loc = get_field('region');

$catTax = '';
$locTax = '';

if ($cat) {
    $catTax = array(
        'taxonomy' => 'cstype',
        'terms' => $cat
    );
}
if ($loc) {
    $locTax = array(
        'taxonomy' => 'csregion',
        'terms' => $loc
    );
}

$args = array(
    'post_type' => 'case-studies',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'post__not_in' => array(get_the_ID()),
    'tax_query' => array(
        'relation' => 'AND',
        $catTax,
        $locTax
    )
);

$q = new WP_Query($args);

if ($q->have_posts()) {
    ?>
    <div class="container py-4">
        <h2 class="h3 mb-4">Related Case Studies</h2>
        <div class="row casestudies mb-4">
    <?php
    $delay = 0;
    while ($q->have_posts()) {
        $q->the_post();
        $gallery = get_field('gallery',get_the_ID());
        $img = parse_url(wp_get_attachment_image_url($gallery[0] , 'medium' ));
        $img = dirname( $img['path'] ) . '/' . rawurlencode( basename( $img['path'] ) );
        ?>
        <div class="blog-item col-lg-4 mb-4 p-2 animated fadeIn delay-<?=$delay?>">
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
    </div>
    <?php
}
wp_reset_postdata();