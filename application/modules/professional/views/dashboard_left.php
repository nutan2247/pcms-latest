<?php $uri = $this->uri->segment(3); ?>
<div class="w-100">
	<!--<a href="<?echo base_url('professional/applicant/dashboard');?>" class="btn-primary w-100 d-block border-0 p-2 text-center">Dashboard</a>-->
	<a href="" class="btn-primary w-100 d-block border-0 p-2 text-center">Dashboard</a>
	<ul class="list-group mt-3 active-color">
		<li class="list-group-item <?php if($uri == 'certificate_listing'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/certificate_listing');?>">Certificate Listing</a></li>
		<li class="list-group-item <?php if($uri == 'license_history'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/license_history');?>">License History</a></li>
		
		<li class="list-group-item <?php if($uri == 'card_listing'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/card_listing');?>">Professional Identification Card</a></li>
		
		<!--<li class="list-group-item <?php if($uri == 'certificate'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/certificate');?>">Certificate of Registration</a></li>-->
		<li class="list-group-item <?php if($uri == 'certificate_of_registration'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/certificate_of_registration');?>">Certificate of Registration</a></li>
		<li class="list-group-item <?php if($uri == 'purchase_list'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/purchase_list');?>">Purchase List</a></li>
		<?php  if(!$this->session->userdata('admin_login')){ ?>
		<li class="list-group-item <?php if($uri == 'notification'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/notification');?>">Notification</a></li>
		
		<li class="list-group-item <?php if($uri == 'tutorials'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/tutorials');?>">Tutorials</a></li>
		<li class="list-group-item <?php if($uri == 'terms'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/terms');?>">Terms</a></li>
		<li class="list-group-item <?php if($uri == 'changepassword'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/changepassword');?>">Change Password</a></li>
		
		<!-- <li class="list-group-item <?php if($uri == 'notification'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('university/university/notification');?>">Notification</a></li> -->
		<li class="list-group-item <?php if($uri == 'editprofile'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/editprofile');?>">Edit Profile</a></li>
		 
		
		
		
		<li class="list-group-item <?php if($uri == 'logout'){ echo 'active'; } ?>"><a class="text-dark" href="<?php echo base_url('professional/applicant/logout');?>">Logout</a></li>
		<?php } ?>
	</ul>

</div>