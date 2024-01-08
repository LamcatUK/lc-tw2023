<!-- usp_block -->
<section class="usp-block py-5">
    <div class="container-xl">
        <div class="usp_slider">
            <div class="usp_slider__slide wow animated fadeIn">
                <div class="usp-block__icon">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-landmark fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="usp-block__content">Established in 1977</div>
            </div>
            <div class="usp_slider__slide wow animated fadeIn delay-1">
                <div class="usp-block__icon">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-pound-sign fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="usp-block__content">£10m Public &amp; Employee<br/>Liability Insurance</div>
            </div>
            <div class="usp_slider__slide wow animated fadeIn delay-2">
                <div class="usp-block__icon">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-handshake fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="usp-block__content">Trusted by Our Clients.<br/>80% Repeat Business</div>
            </div>
            <div class="usp_slider__slide wow animated fadeIn delay-3">
                <div class="usp-block__icon">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-award fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="usp-block__content">Quality Workmanship</div>
            </div>
            <div class="usp_slider__slide wow animated fadeIn delay-3">
                <div class="usp-block__icon">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-user-check fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="usp-block__content">Pre-Qualified Health &amp; Safety</div>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script type="text/javascript">
(function($){
    $('.usp_slider').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        arrows: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
})(jQuery);
</script>
    <?php
}, 9999);