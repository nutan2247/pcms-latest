<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="container">
	<div id="profile-photo" class="col-md-6 mx-auto">

	<div class="card">
		<div class="card-header">Thankyou</div>

		<img src="<?php echo base_url('assets/images/profile/').$udetails->image; ?>" class="card-img-top" id="usersPhoto">
		<div class="card-body text-center">
			<p>Your profile photo is now updated</p>
		</div>

		<div class="card-footer">
			<a href="<?php echo base_url('landing/required_units'); ?>" class="btn btn-primary">Next</a>
		</div>
	</div>

	</div>
</div>