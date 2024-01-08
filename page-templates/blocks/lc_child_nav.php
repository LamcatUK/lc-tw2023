<section class="child_nav py-4">
    <div class="container-xl">
        <div class="child_nav__grid">
            <?php


// Create a new WP_Query instance
$cpq = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
));
            while ($cpq->have_posts()) {
                $cpq->the_post();
                ?>
            <a class="child_nav__card"
                href="<?=get_the_permalink()?>">
                <div class="img_container">
                    <img src="<?=get_the_post_thumbnail_url($cpq->ID, 'large')?>"
                        alt="">
                </div>
                <div class="card_inner"><?=get_the_title()?></div>
            </a>
            <?php
            }

            ?>
        </div>
    </div>
</section>