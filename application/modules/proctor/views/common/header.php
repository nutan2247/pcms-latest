<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8"> 

		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<title><?php echo $title; ?></title>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">

		

		<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>

		<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

	</head>

	<body class="sb-nav-fixed">

		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

		    <a class="navbar-brand" href="index.html">CEonpoint GOVT.</a>

		    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

		    <!-- Navbar Search-->

		    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

		        <div class="input-group">

		            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />

		            <div class="input-group-append">

		                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>

		            </div>

		        </div>

		    </form>

		    <!-- Navbar-->

		    <ul class="navbar-nav ml-auto ml-md-0">

		        <li class="nav-item dropdown">

		            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>

		            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

		                <!-- <a class="dropdown-item" href="<?php echo base_url(''); ?>">Profile</a> -->

		                <a class="dropdown-item" href="<?php echo base_url('proctor/changepassword'); ?>">Change Password</a>

		                <!-- <a class="dropdown-item" href="#">Settings</a> -->
		                <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a>
		                
		            </div>



		        </li>

		    </ul>

		</nav>
