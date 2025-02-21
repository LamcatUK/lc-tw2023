<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(),'full');

function get_people_post_by_author($author_id) {
    // Query the 'people' CPT
    $args = array(
        'post_type'      => 'people',
        'posts_per_page' => -1, // You can limit if needed
        'post_status'    => 'publish',
    );
    
    $people_posts = new WP_Query($args);

    if ($people_posts->have_posts()) {
        while ($people_posts->have_posts()) {
            $people_posts->the_post();
            
            // Get the associated user object from the ACF field
            $user_object = get_field('user'); // ACF 'user' field

            // Check if the returned object is a WP_User, and get the ID
            if ($user_object instanceof WP_User) {
                $user_id = $user_object->ID;
            } else {
                // Handle if it's returning an ID directly (just in case)
                $user_id = $user_object;
            }

            // Check if the user ID matches the author ID
            if ($user_id == $author_id) {
                return get_the_ID(); // Return the 'people' CPT post ID
            }
        }
    }

    // Reset the post data after custom query
    wp_reset_postdata();

    // Return false if no match is found
    return false;
}


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
                    <?php
                    // get author information
                    $post_author_id = get_the_author_meta('ID'); // Get the current post's author ID
                    $people_post_id = get_people_post_by_author($post_author_id);
                    
                    if ($people_post_id) {
                        ?>
                    <aside>
                        <?=get_the_post_thumbnail($people_post_id, 'medium', array('class'=>'author__image', 'itemprop' => 'image', 'alt' => get_the_title()))?>
                        <div>
                            <div class="author__name">Written by: <?=get_the_title($people_post_id)?></div>
                            <div class="author__desc"><?=get_the_content(null, false, $people_post_id)?></div>
                            <?php
                            if (get_field('linkedin_url',$people_post_id) ?? null) {
                                ?>
                            <div class="author__link">
                                Follow <?=explode(' ', get_the_title($people_post_id))[0]?> on <a href="<?=get_field('linkedin_url',$people_post_id)?>" target="_blank">LinkedIn</a>
                            </div>
                                <?php
                            }
                            ?>
                        </div>
                    </aside>
                        <?php
                    }
                    ?>
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
    "name": "<?=get_the_title($people_post_id)?>",
    "image": "<?=get_the_post_thumbnail_url($people_post_id, 'medium')?>", 
    "description" => <?=get_post_meta($post_id, '_yoast_wpseo_metadesc', true) ?: wp_strip_all_tags(get_the_excerpt($post_id))?>,
    "url": "<?=get_the_permalink($people_post_id)?>"
    <?php
    if (get_field('linkedin_url',$people_post_id) ?? null) {
        ?>,
        "sameAs": [
          "<?=get_field('linkedin_url',$people_post_id)?>"
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
