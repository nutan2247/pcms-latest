<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="loding-main" style="display:none;"><p> Please wait...</p></div>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 ftrabout">
                <div class="h3"><img src="https://ceonpoint.com/assets/images/logo-whitesmall.png"></div>
                <p>Is an online platform for Continuing Education (CE) to all professionals, 24/7, worldwide.</p>
		<p>All CE issue digital certificate with corresponding CE Units or contact hours approved by the government regulatory board.</p>
		<p>Ceonpoint offers Professional CE Management Software (PCE-MS)to all professionals to keep on track the Required, Obtained and Needed CE Units for license renewal or performance appraisal.</p>                <!-- <p><a href="#" title="" class="btn bg-yellow"> SIGN-UP NOW!</a></p> -->
                <div class="header-register icons-header">
                    <ul class="dt-sc-default-login">
                                                 <li>
                            <a href="<?php echo base_url('login');?>" class="lgn" title="Login" style=" background: #3d66b0;"><i class="fa fa-user" ></i>Login</a>
                            <!--<a href="#" title="Register Now" class="register" style=" background: orange;">Sign Up</a>-->
                        </li>
                                        </ul> 
                </div>
            </div>
            <div class="col-sm-4 ftradd">
                <div class="h3">COUNTACT US</div>
                <ul>
                    <li><i class="fa fa-location-arrow"></i><p>21 Mohawk Trail, Greenfield,<br>MA 01301, United States</p>                                              <li><i class="fa fa-phone"></i>+(954) 988-0710</li><li><i class="fa fa-phone"></i>+(242) 565-9121</li>                    <!-- <li><i class="fa fa-envelope"></i><a href="mailto:team@ceonpoint.com">team@ceonpoint.com</a></li> -->
                    <li><i class="fa fa-envelope"></i><a href="#">team@ceonpoint.com</a></li>
                </ul>
            </div>
            <div class="col-sm-4 ftrnav">
                <div class="h3">MOBILE APP DOWNLOAD</div>
                <a href="#">
                <img src="https://ceonpoint.com/assets/images/mobile_app_pop_up.png" alt="">
                </a>
                <span style="color: #ffff;">Ceonpoint Mobile App</span>
            </div>
        </div>
    </div>
    <div class="graybg-ft">
        <div class="container">
            <div class="col-md-12">
                <div class="box-content">
                  <img src="https://ceonpoint.com/assets/images/logo.png" alt="">
                   <span class="cp-text">Copyright © 2021</div>
            </div>
        </div>
    </div>
</footer>

    <!-- Modal -->
    <div class="modal fade" id="ctDetails" tabindex="-1" aria-labelledby="ctModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ctModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ctModalContent"></div>
            </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
        </div>
    </div>
    </div>

<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-multiselect.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/owl.carousel.js'); ?>"></script>
<!-- <script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script> -->
     
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
    $('.Professional-slider').owlCarousel({
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
                items: 4
            },
            1000: {
                items: 4
            }
        }
    });
  

    $('.letest-online-slider').owlCarousel({
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
                items: 4
            },
            1000: {
                items: 4
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

    
    // $('.detailsPop').click(function(){
    //     var id = $(this).attr('data-id');
    //     var type = $(this).attr('data-value');
    //     var name = $(this).attr('data-name').toUpperCase();
    //     $.ajax({
    //         type: "POST",
    //         url: '<?php echo base_url('landing/getOneCTDetail'); ?>',
    //         data: {id:id,type:type}
    //     }).done(function(result) {
    //        alert(result); 
    //         $('#ctModalLabel').html(name);
    //         $('#ctModalContent').html(result);
    //         $('#ctDetails').modal('show');
    //     });
    // });

    $('.showSingle').click(function(){
        $('.targetDiv').hide();
        $('.showSingle').removeClass('active active1')
        if($(this).attr('target') === "1") {
            $(this).toggleClass('active');
        } else {
            $(this).toggleClass('active1');
        }
        $('#div'+$(this).attr('target')).show();
    });
        
    $('.regulatory_bord_slider').owlCarousel({
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
                items: 5
            },
            1000: {
                items: 5
            }
        }
    });
    

    $('.latest_pfofessionals_slider').owlCarousel({
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
                items: 3
            },
            768: {
                items: 5
            },
            1000: {
                items: 5
            }
        }
    });

    $('.inline_course_slider').owlCarousel({
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
                items: 3
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
    $('.temp2_online_course_slider').owlCarousel({
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
                items: 3
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
    $('.banner-slider').owlCarousel({
        loop: true,
        margin: 0,
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
                items: 1
            },

            580: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('.ce-Provider-slider').owlCarousel({
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
                items: 3
            },
            768: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });
    $('.accredited-schools-slider').owlCarousel({
        loop: true,
        margin: 0,
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
                items: 1
            },

            580: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    
    $('.temptwo-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
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
                items: 1
            },

            580: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.tempthree_slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
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
                items: 1
            },

            580: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    </script>
<style>
	
.loding-main {
    position: fixed;
    z-index: 100;
    color: #000;
    left: 0;
    top: 0;
    background: rgba(0,0,0,0.5);
    width: 100%;
    height: 100%;
}
.loding-main p {
    position: absolute;
    z-index: 200;
    color: #fff;
    transform: translate(-50%, 50%);
    left: 50%;
    top: 50%;
	font-weight: 700;
    font-size: 22px;
}


