<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

	<div id="body" class="col-md-8 mx-auto">
		<div class="bs-example">
		<p class="h4 mb-4 mt-4 text-uppercase">Error</p>
		<?php echo $this->session->flashdata('error'); ?>
			<p>Please contact us to verify your status.</p>
	        <a href="#" class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#contactUsData">Contact us</a>
		</div>
	</div>

	
</div>



<!-- Modal -->
<div class="modal fade" id="contactUsData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase" id="exampleModalLabel">Contact us form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
	    <?php echo form_open_multipart('landing/contact_us',array('id' =>'contactformSubmit')); ?>
	    <span id="error"></span>
	    <p class="form-group">
	        <label for="inputEmail" class="col-form-label">To</label>
	        <input type="text" class="form-control" placeholder="Name of reg. board" name="reg_board" id="reg_board" required>
		</p>
		<p class="form-group">
	        <label for="inputEmail" class="col-form-label">From</label>
	        <input type="text" class="form-control" placeholder="Enter name" name="user_name" id="user_name" required>
		</p>
		<p class="form-group">
	        <label for="inputEmail" class="col-form-label">Email</label>
	        <input type="text" class="form-control" placeholder="Enter your email" name="user_email" id="user_email" required>
		</p>
		<p class="form-group">
	        <label for="inputEmail" class="col-form-label">Conatct Number</label>
	        <input type="number" class="form-control" placeholder="Enter contact number" pattern="[1-9]{1}[0-9]{9}" name="phone" id="phone" required>
		</p>
		<p><b>Subject:</b>
			<i>Request for verification of professional registration.</i>
	        <input type="hidden" class="form-control" value="Request for verification of professional registration." name="subject" id="subject">
		</p>
		<p class="form-group" id="addDoc">
	        <label for="inputEmail" class="col-form-label">Attached Document</label>
	        <input type="file" class="form-control" name="document" id="document" required>
		</p>
		<?php echo form_close();?>
		
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary text-uppercase" onclick="contact_form()">send</button>
      </div>
    </div>
  </div>
</div>

<script>
	function contact_form(){
		var reg_board =	$('#reg_board').val();
		var user_name =	$('#user_name').val();
		var user_email = $('#user_email').val();
		var phone =	$('#phone').val();
		var cdocument =	$('#document').val();
		if(reg_board==''){
			$('#error').html('Please enter regulatory board name.').css('color','red');
			return false;
		}else if(user_name==''){
			$('#error').html('Please enter user name.').css('color','red');
			return false;
		}else if(user_email==''){
			$('#error').html('Please enter user email.').css('color','red');
			return false;
		}else if(phone == ''){
			$('#error').html('Please enter phone number.').css('color','red');
			return false;
		}else if(cdocument == ''){
			$('#error').html('Please upload document.').css('color','red');
			return false;
		}else{
			$('#contactformSubmit').submit();
			return true;
		}

	}
</script>