<?php
$team = get_field('team');
$termObj = get_term_by('id', $team[0], 'team');
?>
<section class="team_full pt-4">
<div class="container">
    <h3><?=$termObj->name?></h3>
    <div class="row justify-content-center">
    <?php
    $q = new WP_Query(array(
        'post_type' => 'people',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'team',
                'field' => 'term_id',
                'terms' => $team,
            )
        )
    ));
    $i = 0;
    $n = 250;
    while ($q->have_posts()) {
        $q->the_post(); ?>
        <div class="col-12 col-md-4 mb-5 team__member animated fadeIn" style="animation-delay:<?=$n?>ms">
            <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>" class="d-flex img-fluid mb-2 team__image">
            <div>
                <div class="team__name"><?=get_the_title(get_the_ID())?></div>
                <div class="team__title mb-2"><?=get_field('role', get_the_ID())?></div>
                <div class="team__contact mb-2">
                    <ul class="fa-ul">
                    <?php
                        if (get_field('email', get_the_ID())) {
                            echo '<li><span class="fa-li"><i class="fa-regular fa-envelope"></i></span> <a href="mailto:' . get_field('email', get_the_ID()) . '">' . get_field('email', get_the_ID()) . '</a></li>';
                        }
                        if (get_field('phone', get_the_ID())) {
                            echo '<li><span class="fa-li"><i class="fa-solid fa-phone-alt"></i></span> <a href="tel:' . parse_phone(get_field('phone', get_the_ID())) . '">' . get_field('phone', get_the_ID()) . '</a></li>';
                        }
                        if (get_field('mobile', get_the_ID())) {
                            echo '<li><span class="fa-li"><i class="fa-solid fa-mobile-alt"></i></span> <a href="tel:' . parse_phone(get_field('mobile', get_the_ID())) . '">' . get_field('mobile', get_the_ID()) . '</a></li>';
                        }
                        echo '</ul>';
                        if (get_field('linkedin_url', get_the_ID())) {
                            echo '<a href="' . get_field('linkedin_url', get_the_ID()) . '" ><i class="fa-brands fa-linkedin-in"></i></a>';
                        }
                    ?>
                </div>
                <div class="pb-4"><?=get_the_content()?></div>
            </div>
        </div>
        <?php
        $i++;
        $n += 250;
    }
    wp_reset_postdata();
    ?>
    </div>
</div>
</section>