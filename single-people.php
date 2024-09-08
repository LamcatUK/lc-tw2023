<?php
/* Template Name: Author Page */
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$author = get_field('user') ?? null;
?>
<main id="main">
    <div class="container-xl py-5">
        <article itemscope itemtype="https://schema.org/Person">
            <header class="mb-5">
                <div class="row">
                    <div class="col-md-3">
                        <?=get_the_post_thumbnail(get_the_ID(), 'medium', array('class'=>'author__image', 'itemprop' => 'image', 'alt' => get_the_title()))?>
                    </div>
                    <div class="col-md-9">
                        <h1 itemprop="name"><?=get_the_title()?></h1>
                        <h2 itemprop="jobTitle"><?=get_field('role')?></h2>
                        <p itemprop="description"><?=get_the_content()?></p>
                    </div>
                </div>
            </header>
            
            <?php
            if ($author) {
                ?>
            <section class="mb-5">
                <h2>Published Work</h2>
                <ul class="cols-lg-2">
                    <?php
                    // Get posts by author ID
                    $args = array(
                        'author' => $author->ID,
                        'posts_per_page' => -1 // Get all posts (adjust as necessary)
                    );
                
                    $query = new WP_Query($args);
                
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            ?>
                    <li><a href="<?=get_the_permalink(get_the_ID())?>" itemprop="worksFor"><?=get_the_title(get_the_ID())?></a></li>
                            <?php
                        }
                        wp_reset_postdata(); // Reset post data after custom query
                    }
                    ?>
                </ul>
            </section>
                <?php
            }

            ?>
            <div class="row">
                <?php
                if (get_field('linkedin_url') ?? null) {
                ?>
                <section class="mb-5 col-md-6">
                    <h2>Connect with <?=explode(' ', get_the_title())[0]?></h2>
                    <p>Follow <?=explode(' ', get_the_title())[0]?> on <a href="<?=get_field('linkedin_url')?>" target="_blank" itemprop="sameAs">LinkedIn</a></p>
                </section>
                <?php
                }

                if (get_field('email') ?? null) {
                ?>
                <section class="mb-5 col-md-6">
                    <h2>Contact Information</h2>
                    <p>Email: <a href="mailto:<?=get_field('email')?>" itemprop="email"><?=get_field('email')?></a></p>
                </section>
                <?php
                }
                ?>
            </div>
        </article>
    </div>
</main>
<?php
get_footer();