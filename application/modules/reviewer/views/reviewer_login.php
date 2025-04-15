<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<title><?php echo $title; ?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/adminstyle.css'); ?>">

	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>

	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</head>





<body>

  <div class="container">

    <div class="row">

      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">

        <div class="card card-signin my-5">

          <div class="card-body">

            <!-- <img src="<?php echo base_url('assets/images/logo.png'); ?>" class="admin-logo"> -->

            <h5 class="card-title text-center"><b>Reviewer login</b></h5>

            <?php echo $this->session->flashdata('response'); ?>

            <form class="form-signin" action="<?php echo current_url(); ?>" method="post" >

              <div class="form-label-group">

                <input type="email" id="inputEmail" class="form-control" name="username" placeholder="Email address" required autofocus>

                <label for="inputEmail">Username</label>

              </div>



              <div class="form-label-group">

                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>

                <label for="inputPassword">Password</label>

              </div>



              <div class="custom-control custom-checkbox mb-3">

                <input type="checkbox" class="custom-control-input" id="customCheck1">

                <label class="custom-control-label" for="customCheck1">Remember password</label>

              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login">Login</button>

              <!-- <hr class="my-4">

              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>

              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->

            </form>



          </div>

        </div>

      </div>

    </div>

  </div>

</body>

<body>



	<?php //echo password_hash('admin' ,PASSWORD_BCRYPT); ?>

	<!-- <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p> -->





</body>

</html>