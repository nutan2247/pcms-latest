<style>
        .login-panal {
            width: 100%;
            display: block;
            position: relative;
        }

        #slider-container {
            margin: 0px;
            padding: 0px;
        }

        .login-panal .item img {
            height: 700px !important;
            object-fit: cover;
            width: 100%;
        }

        .login_backend_box {
            position: absolute;
            left: 40%;
            top: 0;
            z-index: 99;
            width: 50%;
            height: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .login-backend-text h5 {
            font-size: 60px;
            color: #fff;
            margin-bottom: 0px;
            margin-top: 0;
            font-family: 'Brush Script MT', cursive;
            font-style: italic;
        }

        .login-backend-text p {
            margin-bottom: 0;
            color: #fff;
            font-size: 22px;
        }

        .login-backend-text span {
            color: #fff;
            font-size: 16px;
        }

        .login-grid {
            background: rgb(235, 235, 235, 0.6);
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            width: 25%;
            top: 0;
            left: 15%;
            right: 0;
            bottom: 0;
            margin: 100px 0;
            position: absolute;
            z-index: 1;
        }

        .login-grid .required {
            color: red;
        }

        .form-control {
            height: 40px;
        }

        .input_change_box {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .input_change_box input {
            padding-right: 10%;
        }

        .input_change_icon {
            position: absolute;
            top: 0px;
            right: 0px;
            height: 100%;
            width: 10%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            cursor: pointer;
        }

        .login-grid .btn {
            margin-bottom: 10px;
        }

        .login-panal .item:after {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0 auto;
            text-align: center;
            width: 100%;
            padding: 10px 0px;
            padding-left: 0px;
            background: rgba(0, 0, 0, 0.3);
            height: 100%;
            content: '';
        }
</style>
<section class="login-panal">
        <div class="login-slide">
            <div class="item">
                <img src="https://ceonpoint.com/assets/upload/login_backend/lb_1606368310.jpg" alt="">
                <div class="login_backend_box login-backend-text">
                    <div class="box_slider_content">
                        <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px">
                            Salute to Nurses!</h5>
                        <p>Healing through compassion and knowledge.</p>
                        <span>Nursing</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="https://ceonpoint.com/assets/upload/login_backend/lb_1606488617.png" alt="">
                <div class="login_backend_box login-backend-text">
                    <div class="box_slider_content">
                        <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px">
                            Salute to Midwives!</h5>
                        <p>And what could be more beautiful, than bringing new life into the world.</p>
                        <span>Midwifery</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="https://ceonpoint.com/assets/upload/login_backend/lb_1606496155.png" alt="">
                <div class="login_backend_box login-backend-text">
                    <div class="box_slider_content">
                        <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px">
                            Salute to Teachers!</h5>
                        <p>Molding the youth for a brigther future.</p>
                        <span>Professional Teacher</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="https://ceonpoint.com/assets/upload/login_backend/lb_1606497834.jpg" alt="">
                <div class="login_backend_box login-backend-text">
                    <div class="box_slider_content">
                        <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px">
                            Salute to Engineers!</h5>
                        <p>Building a stronger future.</p>
                        <span>Engineering</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="https://ceonpoint.com/assets/upload/login_backend/lb_1607479635.jpg" alt="">
                <div class="login_backend_box login-backend-text">
                    <div class="box_slider_content">
                        <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px">
                            Salute to Doctors!</h5>
                        <p>You are on your way to good health.</p>
                        <span>Medicine</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="clearfix login-grid">
            <div class="">
                <h3 class="mt-0">LOGIN</h3>
            </div>
            <form action="<?php echo base_url('login'); ?>" method="post" enctype="multipart/form-data" name="login-form" id="login-form" autocomplete="off">
                <?php echo $this->session->flashdata('message'); ?>
                <div class="form-group">
                    <label>User Role <span class="required"> * </span> </label>
                    <select name="role" class="form-control" required>
                        <option value="">Please select a role</option>
                        <option value="admin">Administrator</option>
                        <option value="professioanl">Professional</option>
                        <option value="examiner">Examiner</option>
                        <option value="reviewer">Reviewer</option>
                        <option value="proctor">Proctor</option>
                        <option value="ce-provider">CE Provider</option>
                        <!-- <option value="graduate">Graduate</option> -->
                        <option value="university">School</option>
                        <option value="finance">Finance</option>
                        <!--<option value="public-relations">Public Relations</option>-->
                        <option value="media">Media</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Username/Email <span class="required"> * </span> </label>
                    <input name="username" class="form-control" value="" size="20" type="text" autocomplete="false" required>
                    <input name="location" class="form-control" value="" type="hidden">
                    <span class="error"></span>
                </div>
                <div class="form-group">
                    <label>Password <span class="required"> * </span> </label>
                    <div class="input_change_box">
                        <input name="password" id="password-field" class="form-control pwd" value="" size="20" type="password" autocomplete="false" required>
                        <span class="error"></span>
                       
						<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password position-absolute input_change_icon"></span>
                    </div>
                </div>
                <p class="text-right">
                    <a class="text-dark" href="#">Forgot
                        Password</a>
                </p>
                <input class="btn btn-lg btn-primary w-100" value="Login" type="submit" name="save">
            </form>
        </div>

    </section>

    <script src="<?php echo base_url('assets/js/owl.carousel.js'); ?>"></script>
    <script>
        $('.login-slide').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: false,
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

                600: {
                    items: 1
                },

                1000: {
                    items: 1
                }
            }
        });
		$(".toggle-password").click(function() {

		  $(this).toggleClass("fa-eye fa-eye-slash");
		  var input = $($(this).attr("toggle"));
		  if (input.attr("type") == "password") {
			input.attr("type", "text");
		  } else {
			input.attr("type", "password");
		  }
		});
    </script>