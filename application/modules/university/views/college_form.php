<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION </h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepProcess">
                <span>1</span>
                <label>School Information</label>
            </a>
      
        </div>
        <div class="col-2">
            <a href="#">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Business & Accreditation Documents</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Verification of Documents</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <!--<label>Digital Accreditation</label>-->
				<label>Digital Certificate of Accreditation</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto form-heigte">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">SCHOOL INFORMATION</h4>
			<!-- <?php print_r($subscription); ?> -->
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'universitysteponeForm')); ?>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Name<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="university_name" name="university_name" placeholder="Name" value="<?php echo set_value('university_name'); ?>" >
                    <?php echo form_error('university_name', '<div class="error">', '</div>'); ?>
					<div id="university_name_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="college_of" class="col-sm-2 col-form-label">College of<span class="error">*</span></label>
                <div class="col-sm-10">
                    <select name="college_of" id="college_of" class="form-control">
	            		<option value="">Please select one</option>
						<?php
							foreach($collegeofArr as $colg){
								echo '<option value="'.$colg->id.'">'.$colg->name.'</option>';
							}
						?>
	            	</select>
                     <?php echo form_error('college_of', '<div class="error">', '</div>'); ?>
					 <div id="college_of_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address<span class="error">*</span></label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="address" rows="4" cols="50" name="address" placeholder="Enter Address"><?php echo set_value('address'); ?> 
                    </textarea>
                    <?php echo form_error('address', '<div class="error">', '</div>'); ?>
					<div id="address_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Country<span class="error">*</span></label>
                <div class="col-sm-10">
                    <select name="countries_id" id="countries_id" class="form-control">
							<option value="">Country</option>
							<?php
								foreach($countrylistarr as $cnt){
									echo '<option value="'.$cnt->countries_id.'">'.$cnt->countries_name.'</option>';
								}
							?>
							</select>
                    <?php echo form_error('address', '<div class="error">', '</div>'); ?>
					<div id="countries_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo set_value('email'); ?>" >
                     <?php echo form_error('email', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="contact_no" class="col-sm-2 col-form-label">Contact No.<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact Number" pattern="[1-9]{1}[0-9]{9}" value="<?php echo set_value('contact_no'); ?>" >
                     <?php echo form_error('contact_no', '<div class="error">', '</div>'); ?>
					 <div id="contact_no_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="name_of_representative" class="col-sm-2 col-form-label">Name of Representative<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name_of_representative" name="name_of_representative" placeholder="Name of Representative" value="<?php echo set_value('name_of_representative'); ?>" >
                     <?php echo form_error('name_of_representative', '<div class="error">', '</div>'); ?>
					 <div id="name_of_representative_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="position" class="col-sm-2 col-form-label">Position<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="position" name="position" placeholder="Enter Position" value="<?php echo set_value('position'); ?>" >
                     <?php echo form_error('position', '<div class="error">', '</div>'); ?> 
					 <div id="position_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="business_license_number" class="col-sm-2 col-form-label">Business License No.<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="business_license_number" name="business_license_number" placeholder="Enter Business License Number" value="<?php echo set_value('business_license_number'); ?>" >
                     <?php echo form_error('business_license_number', '<div class="error">', '</div>'); ?>
					 <div id="business_license_number_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="validity_date" class="col-sm-2 col-form-label">Validity Date<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="validity_date" name="validity_date" value="<?php echo set_value('validity_date'); ?>">
                     <?php echo form_error('validity_date', '<div class="error">', '</div>'); ?>
					 <div id="validity_date_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="issued_by" class="col-sm-2 col-form-label">Issued by<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="issued_by" name="issued_by" value="<?php echo set_value('issued_by'); ?>">
                     <?php echo form_error('issued_by', '<div class="error">', '</div>'); ?>
					 <div id="issued_by_error"></div>
                </div>
            </div> 
			<div class="form-group row">
                <label for="accreditation_no" class="col-sm-2 col-form-label">Accreditation No. (from Department of Education)<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="accreditation_no" name="accreditation_no" value="<?php echo set_value('accreditation_no'); ?>">
                     <?php echo form_error('accreditation_no', '<div class="error">', '</div>'); ?>
					 <div id="accreditation_no_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="accreditation_validity_date" class="col-sm-2 col-form-label">Validity Date<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="accreditation_validity_date" name="accreditation_validity_date" value="<?php echo set_value('accreditation_validity_date'); ?>">
                     <?php echo form_error('accreditation_validity_date', '<div class="error">', '</div>'); ?>
					 <div id="accreditation_validity_date_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="accreditation_issued_by" class="col-sm-2 col-form-label">Issued by<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="accreditation_issued_by" name="accreditation_issued_by" value="<?php echo set_value('accreditation_issued_by'); ?>">
                     <?php echo form_error('accreditation_issued_by', '<div class="error">', '</div>'); ?>
					 <div id="accreditation_issued_by_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="college_logo" class="col-sm-2 col-form-label">Logo<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="college_logo" name="college_logo" value="">
                     <?php echo form_error('college_logo', '<div class="error">', '</div>'); ?>
					<div id="college_logo_error"></div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn btn-success text-uppercase" name="submit" value="submit" id="submitVerificationBtn">Submit for Verification</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


</div>


<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-center">
        <h5 class="modal-title text-white text-uppercase" id="staticBackdropLabel">University Information Details</h5>
		<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">	
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="logo-box w-100 text-center">
	  <img src="" id="disp_college_logo" class="img-fluid">
	  </div>
        
		<div class="details-box pt-4">
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">University Name</label>
			<div class="col-sm-6">
				<div id="duniversity_name"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">College of</label>
			<div class="col-sm-6">
				<div id="dcollege_of"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Address</label>
			<div class="col-sm-6">
				<div id="daddress"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Country</label>
			<div class="col-sm-6">
				<div id="dcountries_id"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Email</label>
			<div class="col-sm-6">
				<div id="demail"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Contact No.</label>
			<div class="col-sm-6">
				<div id="dcontact_no"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Name of Representative</label>
			<div class="col-sm-6">
				<div id="dname_of_representative"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Position</label>
			<div class="col-sm-6">
				<div id="dposition"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Business license number</label>
			<div class="col-sm-6">
				<div id="dbusiness_license_number"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Validity Date</label>
			<div class="col-sm-6">
				<div id="dvalidity_date"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Issued by</label>
			<div class="col-sm-6">
				<div id="dissued_by"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Accreditation no.</label>
			<div class="col-sm-6">
				<div id="daccreditation_no"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Accreditation validity date</label>
			<div class="col-sm-6">
				<div id="daccreditation_validity_date"></div>
			</div>
		</div>
		<div class="form-group row border-top mb-0 p-2">
			<label for="inputEmail" class="col-sm-6 mb-0">Accreditation issued by</label>
			<div class="col-sm-6">
				<div id="daccreditation_issued_by"></div>
			</div>
		</div>
        <div id="body" class="col-md-12 mx-auto">
        <div class="bs-example text-center">
            <p class="mt-4">
                <!-- <a href="#" class="btn btn-success text-uppercase" data-toggle="modal" data-target="#confirmData">Confirm</a> -->
				<button class="btn btn-success text-uppercase" type="button" id="confirmsubmit">CONFIRM & SUBMIT</button>
				<button class="btn btn-secondary text-uppercase" data-dismiss="modal">EDIT INFORMATION</button>
            </p>
        </div>
    </div>

      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
</div>
<script>
//$("#confirmsubmit").click(function(){
$("body").on("click","#confirmsubmit",function(){ 
	//alert('formsubmit');
	$('#staticBackdrop').modal('hide');
	//$('#universitysteponeForm').submit();
	var frm = $('#universitysteponeForm');
	var formData = new FormData(frm[0]);
	formData.append('file', $('input[type=file]')[0].files[0]);
	//alert(formData);
	$.ajax({
		type:'post',
		url: '<?php echo base_url("university/university/index"); ?>',
		//data: $('#universitysteponeForm').serialize(),
		data: formData,
		//dataType: 'json',
		//cache: 'false',
		 processData: false,
         contentType: false,
	   //data: {cust_email: cust_email, cust_password: cust_password}, 
		beforeSend: function(xhr, settings) {
			$(".loding-main").show();
		},
		success: function(result){ 
			//alert(result);
			$(".loding-main").hide();
			window.location.href = result;
		} 
	});
});
$("#submitVerificationBtn").click(function(){  
		//alert('test');
		//var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajax({
			type:'post',
			url: '<?php echo base_url("university/university/universitystep"); ?>',
			data: $('#universitysteponeForm').serialize(),
			dataType: 'json',
			cache: 'false',
		   //data: {cust_email: cust_email, cust_password: cust_password}, 
			beforeSend: function(xhr, settings) {
				$(".loding-main").show();
			},
			success: function(result){ 
				//alert('sdf');
				//alert(result.csrfHash);
				//csrf_token = result.csrfHash;
				//alert(JSON.stringify(result));
				//alert(result.msg);	
					$(".loding-main").hide();
					if(result.error != undefined){
					 if(result.error.university_name != undefined && result.error.university_name != ""){
						$('#university_name_error').html(result.error.university_name);
					 }else{
						$('#university_name_error').html(''); 
					 }
					 if(result.error.college_of != undefined && result.error.college_of !=""){
						$('#college_of_error').html(result.error.college_of);
					 }else{
						$('#college_of_error').html('');
					 } 
					 if(result.error.address != undefined && result.error.address !=""){
						$('#address_error').html(result.error.address);
					 }else{
						$('#address_error').html(''); 
					 }
					 if(result.error.countries_id != undefined && result.error.countries_id !=""){
						$('#countries_error').html(result.error.countries_id);
					 }else{
						$('#countries_error').html(''); 
					 } 
					 if(result.error.email != undefined && result.error.email !=""){
						$('#email_error').html(result.error.email);
					 }else{
						 $('#email_error').html('');
					 } 
					 if(result.error.contact_no != undefined && result.error.contact_no !=""){
						$('#contact_no_error').html(result.error.contact_no);
					 }else{
						$('#contact_no_error').html(''); 
					 }
					 if(result.error.name_of_representative != undefined && result.error.name_of_representative !=""){
						$('#name_of_representative_error').html(result.error.name_of_representative);
					 }else{
						$('#name_of_representative_error').html(''); 
					 }  
					 if(result.error.position != undefined && result.error.position !=""){
						$('#position_error').html(result.error.position);
					 }else{
						$('#position_error').html(''); 
					 } 
					 if(result.error.business_license_number != undefined && result.error.business_license_number !=""){
						$('#business_license_number_error').html(result.error.business_license_number);
					 }else{
						$('#business_license_number_error').html(''); 
					 } 
					 if(result.error.validity_date != undefined && result.error.validity_date !=""){
						$('#validity_date_error').html(result.error.validity_date);
					 }else{
						$('#validity_date_error').html(''); 
					 } 
					 if(result.error.issued_by != undefined && result.error.issued_by !=""){
						$('#issued_by_error').html(result.error.issued_by);
					 }else{
						$('#issued_by_error').html(''); 
					 } 
					 if(result.error.accreditation_no != undefined && result.error.accreditation_no !=""){
						$('#accreditation_no_error').html(result.error.accreditation_no);
					 }else{
						$('#accreditation_no_error').html(''); 
					 }
					 if(result.error.accreditation_validity_date != undefined && result.error.accreditation_validity_date !=""){
						$('#accreditation_validity_date_error').html(result.error.accreditation_validity_date);
					 }else{
						$('#accreditation_validity_date_error').html(''); 
					 } 
					 if(result.error.accreditation_issued_by != undefined && result.error.accreditation_issued_by !=""){
						$('#accreditation_issued_by_error').html(result.error.accreditation_issued_by);
					 }else{
						$('#accreditation_issued_by_error').html(''); 
					 }
					 if(result.error.college_logo != undefined && result.error.college_logo !=""){
						$('#college_logo_error').html(result.error.college_logo);
					 }else{
						$('#college_logo_error').html(''); 
					 }  
					 
					}
					//debugger;
					if(result.msg == '1'){
						$('#duniversity_name').html($('#university_name').val()); 
						//$('#dcollege_of').html($('#college_of').val()); 
						$('#dcollege_of').html($("#college_of :selected").text()); 
						$('#daddress').html($('#address').val()); 
						$('#dcountries_id').html($("#countries_id :selected").text()); 
						$('#demail').html($('#email').val()); 
						$('#dcontact_no').html($('#contact_no').val()); 
						$('#dname_of_representative').html($('#name_of_representative').val()); 
						$('#dposition').html($('#position').val()); 
						$('#dbusiness_license_number').html($('#business_license_number').val()); 
						$('#dvalidity_date').html($('#validity_date').val()); 
						$('#dissued_by').html($('#issued_by').val()); 
						$('#daccreditation_no').html($('#accreditation_no').val()); 
						$('#daccreditation_validity_date').html($('#accreditation_validity_date').val()); 
						$('#daccreditation_issued_by').html($('#accreditation_issued_by').val()); 
						$('#staticBackdrop').modal('show'); 
					}
				
				//$('input:hidden[name="token"]').val(result.csrfHash);
				/* if(result.msg == 1){
					window.location.href = "<?php echo base_url('student/dashboard');?>";
				}
				if(result.msg == 2){
					$('#loginerr').html('Your account is not activated.');
				}if(result.msg == 3){
					$('#loginerr').html('Your account is already login on another system.');
				}if(result.msg == 0){
					$('#loginerr').html('Email and Password not matched.');
				} */
				
			} 
		});
		
	
});
$("#college_logo").change(function(){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#disp_college_logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>