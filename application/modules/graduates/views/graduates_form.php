<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title; ?></h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepProcess">
                <span>1</span>
                <label>Graduate Profile & Code</label>
            </a>         
        </div>
        <div class="col-2">
            <a href="#">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Exam Booking</label>
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
                <label>Examination Guidelines and Information</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Exam Pass</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto form-heigte">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'graduateprofileForm')); ?>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" >
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
					<div id="name_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php echo set_value('middle_name'); ?>" >
                    <?php echo form_error('middle_name', '<div class="error">', '</div>'); ?>
					<div id="name_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">Surname</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?php echo set_value('surname'); ?>" >
                    <?php echo form_error('surname', '<div class="error">', '</div>'); ?>
					<div id="name_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" >
                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
					<div id="email_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="birthday" class="col-sm-2 col-form-label">Birthday<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo set_value('birthday'); ?>">
                     <?php echo form_error('birthday', '<div class="error">', '</div>'); ?>
					 <div id="birthday_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Gender<span class="error">*</span></label>
                <div class="col-sm-10">
                    <select  class="form-control" id="gender" name="gender" >
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</select>
                     <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
					 <div id="gender_error"></div>
                </div>
            </div>
            
			<div class="form-group row">
                <label for="examination_code" class="col-sm-2 col-form-label">Examination Code<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="examination_code" name="examination_code" value="<?php echo set_value('examination_code'); ?>">
                     <?php echo form_error('examination_code', '<div class="error">', '</div>'); ?>
					 <div id="examination_code_error"></div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn btn-success text-uppercase" name="submit" value="submit" id="submitBtn">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


</div>


<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content w-175">
      <div class="modal-header bg-primary text-center">
        <h5 class="modal-title text-white text-uppercase" id="staticBackdropLabel">GRADUATE PROFILE AND CODE VERIFIED</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="logo-box">
	  <img src="" id="dphoto" class="img-fluid">
	  </div>
        
		<div class="details-box">
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Name</label>
			<div class="col-sm-8">
				<div class="name-fild" id="dname"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
			<div class="col-sm-8">
				<div class="name-fild" id="demail"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Birthday</label>
			<div class="col-sm-8">
				<div class="name-fild" id="dbirthday"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Gender</label>			
			<div class="col-sm-8">
				<div class="name-fild" id="dgender"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">University</label>			
			<div class="col-sm-8">
				<div class="name-fild" id="duniversity"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">College of</label>			
			<div class="col-sm-8">
				<div class="name-fild" id="dcollegeof"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Date of Graduatation</label>			
			<div class="col-sm-8">
				<div class="name-fild" id="dyear_of_graduated"></div>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Examination Code</label>
			<div class="col-sm-8">
				<div class="name-fild" id="dexamination_code"></div>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputEmail" class="col-sm-4 col-form-label">Date Issued</label>			
			<div class="col-sm-8">
				<div class="name-fild" id="dvalidity"></div>
			</div>
		</div>
		
        <div id="body" class="col-md-12 mx-auto">
		
	        <div class="bs-example text-center">
	        	<label>Please click confirm button, if this is you ?</label>
	            <p class="mt-3">
	                <a href="#" id="grad-submit" class="btn btn-success text-uppercase">Confirm</a>
					<button class="btn btn-info text-uppercase" onclick="hide_popup()">Edit</button>
                    <a href="<?php echo base_url('license/contact_us')?>" class="btn btn-info text-uppercase">Contact Us</a>
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

<div class="modal fade" id="graduteDataNotMatch" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Graduate Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div id="body" class="col-md-8 mx-auto">
	        <div class="bs-example">
	        	<p class="error">DATA DID NOT MATCH</p>
	        	<p>Please contact us to verify your status.</p>
	            <p class="mt-4">
	                <a href="<?php echo base_url('license/contact_us')?>" class="btn btn-success text-uppercase">Contact Us</a>
	                <a href="#" onclick="closeMMpopup()" class="btn btn-info text-uppercase">Edit</a>
	            </p>
	        </div>
	    </div>
      </div>

      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
<script>
$("#submitBtn").click(function(){  
		// alert('test');
		//var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajax({
			type:'post',
			url: '<?php echo base_url("graduates/graduates/graduatestep"); ?>',
			data: $('#graduateprofileForm').serialize(),
			dataType: 'json',
			cache: 'false',
		   //data: {cust_email: cust_email, cust_password: cust_password}, 
			// beforeSend: function(xhr, settings) {
			// 	$(".loding-main").show();
			// },
			success: function(result){ 
					$(".loding-main").hide();
					if(result.error != undefined){
						if(result.error.name != undefined && result.error.name != ""){
							$('#name_error').html(result.error.name);
						}
						if(result.error.email != undefined && result.error.email != ""){
							$('#email_error').html(result.error.email);
						}
						if(result.error.birthday != undefined && result.error.birthday !=""){
							$('#birthday_error').html(result.error.birthday);
						} 
						if(result.error.gender != undefined && result.error.gender !=""){
							$('#gender_error').html(result.error.gender);
						} 
						if(result.error.examination_code != undefined && result.error.examination_code !=""){
							$('#examination_code_error').html(result.error.examination_code);
						}
					}
					//debugger;
					if(result.msg == '1'){	
						
						//alert(JSON.stringify(result));
						//alert(result.graducatdetails.length);
						//debugger;
						//alert(result.graducatdetails[0].student_name);
						//alert(result.graducatdetails->examcode);
						//$('#dphoto').html(result.graducatdetails[0].dphoto);
						//alert(result.graducatdetails.length);
						if(result.graducatdetails.length > 0){
							//alert(result.graducatdetails[0].student_name);
							if(result.graducatdetails[0].photo !=""){
								var studentimg = '<?php echo base_url("assets/images/graduates/");?>'+result.graducatdetails[0].photo;
							}else{
								var studentimg = '';
							}
							var url = '<?php echo base_url('graduates/graduates/book_exam/'); ?>';	
							$("#dphoto").attr("src",studentimg);
							$('#dname').html(result.graducatdetails[0].student_name+' '+result.graducatdetails[0].middle_name+' '+result.graducatdetails[0].surname);
							$('#demail').html(result.graducatdetails[0].email);
							$('#dbirthday').html(result.graducatdetails[0].dob);
							$('#duniversity').html(result.graducatdetails[0].university_name);
							$('#dcollegeof').html(result.graducatdetails[0].collegeofname);
							$('#dgender').html(result.graducatdetails[0].gender);
							$('#dexamination_code').html(result.graducatdetails[0].examcode);
							$('#dyear_of_graduated').html(result.graducatdetails[0].date_of_graduated);
							$('#dvalidity').html(result.graducatdetails[0].updated_at);
							$("#grad-submit").attr("href",url+result.graducatdetails[0].grad_id);
							$('#staticBackdrop').modal('show'); 
						}else{
							// alert('Data not found.');
							$('#graduteDataNotMatch').modal('show'); 
						}
					}
			} 
		});
});

function goToBookExam(){
	window.location.href = "<?php echo base_url('graduates/graduates/book_exam'); ?>";
}

function closeMMpopup(){
	$('#graduteDataNotMatch').modal('hide'); 

}
function hide_popup(){
	$('#staticBackdrop').modal('hide'); 

}
</script>