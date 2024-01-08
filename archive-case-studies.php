<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option( 'page_on_front' );
$bg = get_the_post_thumbnail_url($page_for_posts,'full');



get_header();
?>
<main id="main">
<!-- hero -->
<section class="hero mb-4" data-parallax="scroll" data-image-src="<?=$bg?>">
    <div class="overlay--dark"></div>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-8 py-5 d-flex align-items-center z-index-0">
                <div>
                    <h1 class="hero__title">Case Studies</h1>
                    <a href="/get-a-quote/" class="btn btn-green">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>
    <svg class="chevron chevron--white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <!-- <polyline fill="white" points="100 50 100 100 0 100 100 50"/> -->
        <polyline points="100 50 100 100 0 100 0 50 50 75 100 50"/>
    </svg>
</section>

    <div class="container-xl py-5">
        <?php
        $cats = get_terms(array('taxonomy' => 'cstype', 'hide_empty' => true));
        ?>
        <div class="filters mb-4">
            <?php
        echo '<button class="btn btn-outline-primary active me-2 mb-2" data-filter="*">All</button>';
        foreach ($cats as $cat) {
            echo '<button class="btn btn-outline-primary me-2 mb-2" data-filter=".' . cbslugify($cat->name) . '">' . $cat->name . '</button>';
        }
        ?>
        </div>
        <div class="row w-100" id="grid">
            <?php
                query_posts( array( 'post_type' => 'case-studies', 'posts_per_page' => -1 ) );

            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
                }
                $cats = get_the_terms(get_the_ID(),'cstype');
                $category = wp_list_pluck($cats, 'name');
                $flashcat = cbslugify($category[0]);
                $catclass = implode(' ', array_map( 'cbslugify', $category ) );
                $category = implode(', ',$category);

                if (has_category('event')) {
                    $the_date = get_field('start_date',get_the_ID());
                }
                else {
                    $the_date = get_the_date('jS F, Y');
                }

                $gallery = get_field('gallery', get_the_ID());
                $img = wp_get_attachment_image_url($gallery[0] , 'medium' );
        
                ?>

        <div class="blog-item col-lg-4 py-2 px-2 <?=$catclass?>">
            <a href="<?=get_the_permalink(get_the_ID())?>">
                <div class="index_card">
                    <div class="index_card__image_container--sm">
                        <div class="index_card__flash index_card__flash--<?=$flashcat?>"><?=$category?></div>
                        <div class="index_card__image" style="background-image:url('<?=$img?>')"></div>
                    </div>
                    <div class="index_card__content--sm">
                        <div class="index_card__title--sm"><?=get_the_title()?></div>
                    </div>
                </div>
            </a>
        </div>
                <?php
            }
            ?>
        </div>
<!--        <div class="mt-5">
        <?php
        // numeric_posts_nav();
        ?>
        </div>
        -->
    </div>
</main>
<?php
add_action('wp_footer',function(){
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
(function($){
        
    var $grid=$('#grid').isotope({
        itemSelector:'.blog-item',
        percentPosition: true,
        layoutMode: 'fitRows',
    });
    
    $('.filters').on('click','button',function(){
        var filterValue=$(this).attr('data-filter');
        $('.filters').find('.active').removeClass('active');
        $(this).addClass('active');
        $grid.isotope({filter:filterValue});
    });



})(jQuery);
</script>
    <?php
},9999);

get_footer();