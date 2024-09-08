<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<main id="main" class="blog">
    <?php
    $content = get_the_content();
    $blocks = parse_blocks($content);
    $sidebar = array();
    $after;
    ?>
    <section class="breadcrumbs container-xl">
    <?php
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
    ?>
    </section>
    <div class="container-xl">
        <div class="row g-4 pb-4">
            <div class="col-lg-9 order-2 order-lg-1">
                <article>
                    <header>
                        <h1 class="blog__title"><?=get_the_title()?></h1>
                    <!--
                         <p>Published on <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('jS F Y'); ?></time></p>
                        <?php
                        if (get_the_modified_date() != get_the_date()) {
                            ?>
                        <p>Last updated on <time datetime="<?php echo get_the_modified_date('Y-m-d'); ?>"><?php echo get_the_modified_date('jS F Y'); ?></time></p>
                            <?php
                        }
                        ?>
                    -->
                    </header>
                    <section>
                        <?php
                        if ($img) {
                            ?>
                        <img src="<?=$img?>" alt="" class="blog__image">
                            <?php
                        }
                        $count = estimate_reading_time_in_minutes( get_the_content(), 200, true, true );
                        echo $count;

                        foreach ($blocks as $block) {
                            if ($block['blockName'] == 'core/heading') {
                                if (!array_key_exists('level', $block['attrs'])) {
                                    $heading = strip_tags($block['innerHTML']);
                                    $id = acf_slugify($heading);
                                    echo '<a id="' . $id . '" class="anchor"></a>';
                                    $sidebar[$heading] = $id;
                                }
                            }
                            echo render_block($block);
                        }
                        ?>
                    </section>
                    <aside>
                        <?=wp_get_attachment_image(get_field('author_photo','option'),'large',false,array('class'=>'author__image','alt' => get_field('author_name','option')))?>
                        <div>
                            <div class="author__name">Written by: <?=get_field('author_name','option')?></div>
                            <div class="author__desc"><?=get_field('author_description','option')?></div>
                            <?php
                            if (get_field('author_linkedin','option') ?? null) {
                                ?>
                            <div class="author__link">
                                Follow <?=get_field('author_name','option')?>: 
                                <a href="<?=get_field('author_linkedin','option')?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                                <?php
                            }
                            ?>
                        </div>
                    </aside>
                </article>
            </div>
            <div class="col-lg-3 order-1 order-lg-2">
                <?php
                if ($sidebar) {
                    ?>
                <div class="sidebar">
                    <div class="h5 d-none d-lg-block">Quick Links</div>
                    <div class="h5 d-lg-none collapsed" data-bs-toggle="collapse" href="#links" role="button">Quick Links</div>
                    <div class="collapse d-lg-block" id="links">
                        <ul>
                        <?php
                        foreach ($sidebar as $heading => $id) {
                            ?>
                            <li><a href="#<?=$id?>"><?=$heading?></a></li>
                            <?php
                        }
                        ?>
                        </ul>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <section class="related pb-5">
            <h3><span>Related</span> Posts</h3>
            <div class="related_grid">
            <?php
            $cats = get_the_category();
            $ids = wp_list_pluck($cats,'term_id');
            $r = new WP_Query(array(
                'category__in' => $ids,
                'posts_per_page' => 4
            ));
            while ($r->have_posts()) {
                $r->the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = get_stylesheet_directory_uri() . '/img/default.png';
                }
                ?>
                <a class="blog_card" href="<?=get_the_permalink()?>">
                    <div class="blog_card__image_container">
                        <img src="<?=$img?>" alt="" class="blog_card__image">
                    </div>
                    <div class="blog_card__content">
                        <h3 class="blog_card__title"><?=get_the_title()?></h3>
                    </div>
                </a>
                <?php
            }
            ?>
            </div>
        </section>
    </div>

</main>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?=get_the_title()?>",
  "author": {
    "@type": "Person",
    "name": "<?=get_field('author_name','option')?>",
    "image": "<?=wp_get_attachment_image_url(get_field('author_photo','option'),'full')?>", 
    "description": "<?=get_field('author_description','option')?>",
    "url": "<?=home_url('/about-us/')?>", 
    <?php
    if (get_field('author_linkedin','option') ?? null) {
        ?>
        "sameAs": [
          "<?=get_field('author_linkedin','option')?>"
        ]
        <?php
    }
    ?>
  },
  "publisher": {
    "@type": "Organization",
    "name": "Tidey & Webb Limited",
    "logo": {
      "@type": "ImageObject",
      "url": "https://www.tideyandwebb.co.uk/wp-content/themes/lc-tideywebb/img/tidey-and-webb-og-1200x630.png"
    }
  },
  "datePublished": "<?=get_the_date('Y-m-d')?>",
  "dateModified": "<?=get_the_modified_date('Y-m-d')?>",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?=get_the_permalink()?>"
  }
}
</script>
<?php
get_footer();