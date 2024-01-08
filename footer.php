<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lc-tideywebb
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<div id="footer-top"></div>
<div class="footer pt-5">
    <div class="container-xl" id="footer-content">
        <div class="row pb-4">
            <div class="col-sm-6 col-lg-3 mb-2">
                <a href="<?=get_home_url()?>"><img src="<?=get_stylesheet_directory_uri()?>/img/tw-logo.svg" alt="Tidey & Webb" class="logo img-fluid mb-4"></a>
				<?=do_shortcode('[brb_collection id="615"]')?>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2">
                <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-envelope"></i></span> <a href="mailto:<?=get_field('contact_email','options')?>"><?=get_field('contact_email','options')?></a></li>
                <li><span class="fa-li"><i class="fas fa-phone-alt"></i></span> <a href="tel:<?=parse_phone(get_field('contact_phone','options'))?>"><?=get_field('contact_phone','options')?></a></li>
                <li><span class="fa-li"><i class="fas fa-fax"></i></span> <?=get_field('contact_fax','options')?></li>
                </ul>
                <div class="social-icons mb-2">
                    <?=do_shortcode('[social_icons]')?>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2">
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span> <a href="<?=get_field('google_directions','options')?>" target="_blank"><?=get_field('contact_address','options')?></a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2">
                <?php wp_nav_menu(array('theme_location' => 'footer_menu1')); ?>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="colophon">
    <div class="container-xl py-2">
        <div class="row">
            <div class="col-md-6 mb-2 mb-md-0">
                &copy; <?=date('Y')?> Tidey &amp; Webb Ltd. Registered in England No. 01329531                
            </div>
            <div class="col-md-6 text-md-right">
                <a href="/privacy-policy/">Privacy Policy</a> | <a href="/cookie-policy/">Cookie Policy</a> <!-- | <a href="/terms-conditions/">Terms &amp; Conditions</a> --> | Site by <a href="https://www.lamcat.co.uk/" rel="nofollow noopener" target="_blank" class="lc" title="Site by Lamcat">Lamcat</a>
            </div>
        </div>
    </div>
</div>
</div><!-- #page -->
<div class="scroll-button"></div>

<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}
?>
</body>

</html>