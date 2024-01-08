<?php
$bg = get_field('background') ? 'bg--green-400' : 'bg--white';
$title = $bg == 'bg--green-400' ? 'text-gold-400' : '';
?>
<!-- accreditations -->
<section class="accreditations py-5 <?=$bg?>">
    <div class="container">
        <div class="d-flex justify-content-around align-items-center flex-wrap">
            <img src="<?=get_stylesheet_directory_uri()?>/img/safecontractor.png" alt="Alcumus Safe Contractor Seal" class="img-fluid mb-4 mb-md-0">
            <img src="<?=get_stylesheet_directory_uri()?>/img/constructionline.png" alt="Constructionline Silver Member" class="img-fluid">
        </div>
    </div>
</section>