<?php
$bg = get_field('background') ? 'bg--green-400' : 'bg--white';
$title = $bg == 'bg--green-400' ? 'text-gold-400' : '';
?>
<!-- reviews_slider -->
<section class="reviews_slider <?=$bg?> py-5">
    <div class="container">
        <h2 class="text-center title mb-4 <?=$title?>">Our <span>Customer Reviews</span></h2>
        <?=testimonials_slider($bg)?>
        <div class="text-center"><a href="/reviews/" class="btn btn-gold">View More</a></div>
    </div>
</section>