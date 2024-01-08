<!-- faq -->
<section class="faq py-5">
    <div class="container">
        <?php
        if (get_field('title')) {
            ?>
        <h2 class="faq__title"><?=get_field('title')?></h2>
            <?php
        }
        $accordion = random_str(5);
        echo '<div itemscope="" itemtype="https://schema.org/FAQPage" id="accordion' . $accordion . '">';
        $counter = 0;
        $show = 'show';
        $collapsed = '';
        while (have_rows('faq')) {
            the_row();
            $border = $counter == 0 ? 'border-top' : '';
            echo '<div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="py-4 border-bottom ' . $border . '">';
            echo '  <div class="question ' . $collapsed . '" itemprop="name" data-bs-toggle="collapse" id="heading_' . $accordion . '_' . $counter . '" data-bs-target="#collapse_' . $accordion . '_' . $counter . '" aria-expanded="true" aria-controls="collapse_' . $accordion . '_' . $counter . '">' . get_sub_field('question') . '</div>';
            echo '  <div class="answer collapse ' . $show . '" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" id="collapse_' . $accordion . '_' . $counter . '" aria-labelledby="heading_' . $accordion . '_' . $counter . '" data-bs-parent="#accordion' . $accordion . '"><div itemprop="text" class="pt-2">' . apply_filters('the_content',get_sub_field('answer')) . '</div></div>';
            echo '</div>';
            $counter++;
            $show = '';
            $collapsed = 'collapsed';
        }
        echo '</div>';
        ?>
    </div>
</section>