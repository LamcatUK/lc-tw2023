<section class="sib_nav py-4">
    <div class="container-xl">
        <div class="sib_nav__grid">
            <?php
// Create a new WP_Query instance
$parent_page_id = get_post(get_the_ID())->post_parent;

            $cpq = new WP_Query(array(
                'post_type' => 'page',
                'post_parent' => $parent_page_id,
                'posts_per_page' => -1,
                'post__not_in' => array(get_the_ID()),
            ));
            while ($cpq->have_posts()) {
                $cpq->the_post();
                ?>
            <a class="sib_nav__card" href="<?=get_the_permalink()?>">
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