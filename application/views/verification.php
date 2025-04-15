<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

	<div id="body" class="col-md-8 mx-auto">
		<div class="bs-example">
		<p class="h4 mb-4 mt-4 text-uppercase">Verification</p>
		<?php echo $this->session->flashdata('error'); ?>
			<p>Your data matched in our database. Please review and click the button to confirm.<br>
			Please call or message us if this is not you.</p>
			<table>
				<tr><td><?php echo $udetails->name; ?></td></tr>
				<tr><td><?php echo date('M j,Y',strtotime($udetails->dob)); ?></td></tr>
				<tr><td><?php echo $udetails->country; ?></td></tr>
				<tr><td><?php echo $udetails->gender; ?></td></tr>
				<tr><td><?php echo $udetails->address; ?></td></tr>
				<tr><td><?php echo $udetails->email; ?></td></tr>
				<tr><td><?php echo $udetails->phone; ?></td></tr>
				<tr><td><?php echo $udetails->profession; ?></td></tr>
			</table>
			<table>
				<tr><th>License Number : </th><td><?php echo $udetails->license_no; ?></td></tr>
				<tr><th>Date Issued : </th><td><?php echo date('M j,Y',strtotime($udetails->license_validity_date)); ?></td></tr>
				<tr><th>Validity : </th><td><?php echo date('M j,Y',strtotime($udetails->license_validity_date)); ?></td></tr>
			</table>
				
			<p class="mt-4">
	        	<!-- <a href="#" class="btn btn-success text-uppercase" data-toggle="modal" data-target="#confirmData">Confirm</a> -->
	        	<a href="#" class="btn btn-success text-uppercase" onclick="profile_photo_form();">Confirm</a>
			</p>
		</div>
	</div>

	<div id="profile-photo" class="col-md-8 mx-auto" style="display: none;">

	<div class="card">
		<div class="card-header">Please update your License photo.</div>

		<div class="card-body">
			<?php echo form_open_multipart('landing/update_photo',array('id' =>'photoformSubmit')); ?>
				<img src="" id="userPhoto" width="60">
			    <label for="inputEmail" class="col-form-label">Upload Photo :</label>
			    <input type="file" class="form-control" name="photo" id="photo" required>
			    <input type="hidden" class="form-control" name="id" value="<?php echo $udetails->user_ID; ?>">
			    <input type="hidden" class="form-control" name="email" value="<?php echo $udetails->email; ?>">
			    <span id="photo-error"></span>
			<?php echo form_close();?>

			<div class="form-group"><b><i>Notes:</i></b>
				<ol>
					<li><i>Do not smile</i></li>
					<li><i>With collor</i></li>
					<li><i>Black and white background</i></li>
					<li><i>Eyes should not be covered</i></li>
					<li><i>Hair should be clean cut</i></li>
				</ol>
			</div>
		</div>

		<div class="card-footer">
			<button type="button" class="btn btn-primary" onclick="submit_form()">Submit</button>
			<a href="<?php echo base_url('landing/required_units?email=').$udetails->email; ?>" class="btn btn-primary">Next</a>
		</div>
	</div>

	</div>

	
</div>



<script>
	function profile_photo_form(){
		$('#body').hide();
		$('#profile-photo').show();
	}

	function submit_form(){
	var photo =	$('#photo').val();
		if(photo == ''){
			$('#photo-error').html('Please upload a photo.').css('color','red');
			return false;
		}else{
			$('#photoformSubmit').submit();
			return true;
		}
	}
</script>

