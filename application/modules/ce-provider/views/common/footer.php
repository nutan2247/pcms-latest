<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer>
    <div class="footer-logostrip">
        <img src="<?php echo base_url('assets/images/logo.png'); ?>">">
    </div>
</footer>

<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/owl.carousel.js'); ?>"></script>
<script>
    $('.speakingslider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        autoplaySpeed: 2000,
        dotsSpeed: 2000,
        responsive: {
            320: {
                items: 1
            },

            360: {
                items: 2
            },

            580: {
                items: 2
            },
            768: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
    $('.committeeslider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        autoplaySpeed: 2000,
        dotsSpeed: 2000,
        responsive: {
            320: {
                items: 1
            },

            360: {
                items: 2
            },

            580: {
                items: 2
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() >= 250) {
            $('.header').addClass('fixed-header');
        } else {
            $('.header').removeClass('fixed-header');
        }
    });
</script>

</body>

</html>