<div class="w-100">
	<a href="<?echo base_url('university/university/dashboard');?>" class="btn-primary w-100 d-block border-0 p-2 text-center">Dashboard</a>
	<ul class="list-group mt-3 active-color">
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='renewalhistory')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/renewalhistory');?>">Accreditation History</a></li>
		<!--<li class="list-group-item"><a class="" href="<?echo base_url('university/university/school');?>">School Listing</a></li>-->
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='graduate' || $this->uri->segment(3)=='graducateform' )?'active':'';?>"><a class="" href="<?php echo base_url('university/university/graduate');?>">List of Graduates</a></li>
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='examcodegraduate')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/examcodegraduate');?>">Graduates and Exam Codes</a></li>
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='purchaselist')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/purchaselist');?>">Purchase List</a></li>
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='notification')?'active':'';?>"><a class=" " href="<?php echo base_url('university/university/notification');?>">Notification</a></li>
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='terms')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/terms');?>">Terms</a></li>
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='tutorial')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/tutorial');?>">Tutorial</a></li>
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='editprofile')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/editprofile');?>">Edit Profile</a></li>
		<!--<li class="list-group-item"><a class="" href="<?php echo base_url('university/university/setting');?>">Setting</a></li> -->
		<li class="list-group-item <?php echo ($this->uri->segment(3)=='changepassword')?'active':'';?>"><a class="" href="<?php echo base_url('university/university/changepassword');?>">Change Password</a></li> 
		<li class="list-group-item "><a class="" href="<?php echo base_url('university/university/logout');?>">Logout</a></li>
	  </ul>

</div>