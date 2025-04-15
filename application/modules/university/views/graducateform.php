<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

//print_r($editdata);
?>
<style type="text/css">
    
    .error{
        color:#ce2b2b;
    }
</style>
<?php $this->view('university_top'); ?>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
<div class="container">
	<div class="row">
    <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
		</div>
		<div class="col-lg-9 col-md-8">
        
            <h4 class="mb-4 mt-4 text-uppercase text-center">COLLEGE GRADUATE INFORMATION</h4>
            <?php 
				$message = $this->session->flashdata('item');
				if(isset($message)) {
				?>
				<div class="row"><div class="box-body col-md-12">
					<div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
				</div>
				</div>
				<?php } ?>
            <?php echo form_open_multipart('',array('id'=>'graduateForm')); ?>
            <div class="form-group row">
                <label for="student_name" class="col-sm-2 col-form-label">First Name<span class="error">*</span></label>
                <div class="col-sm-10">
					<?php echo form_hidden('grad_id', isset($editdata->grad_id)?$editdata->grad_id:'');?>
                    <input type="text" class="form-control" id="student_name" name="student_name" placeholder="First Name" value="<?php echo isset($editdata->student_name)?$editdata->student_name:set_value('student_name'); ?>" >
                    <?php echo form_error('student_name', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
                <label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
                <div class="col-sm-10">
					<input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php echo isset($editdata->middle_name)?$editdata->middle_name:set_value('middle_name'); ?>" >
                </div>
            </div>
			<div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">Surname</label>
                <div class="col-sm-10">
					<input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?php echo isset($editdata->surname)?$editdata->surname:set_value('surname'); ?>" >
                </div>
            </div>
			<div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo isset($editdata->email)?$editdata->email:set_value('email'); ?>" >
                     <?php echo form_error('email', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="dob" class="col-sm-2 col-form-label">Date of Birth<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter DOB" value="<?php echo isset($editdata->dob)?$editdata->dob:set_value('dob'); ?>" >
                     <?php echo form_error('dob', '<div class="error">', '</div>'); ?>
					 <div id="dob_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Gender<span class="error">*</span></label>
                <div class="col-sm-10">
                    <select name="gender" id="gender" class="form-control">
	            		<option value="Male" <?php echo (isset($editdata->gender) && $editdata->gender == 'Male')?'selected':''; ?> >Male</option>
	            		<option value="Female" <?php echo (isset($editdata->gender) && $editdata->gender == 'Female')?'selected':''; ?>>Female</option>
					</select>
                     <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
					 <div id="sch_id_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="name_of_school" class="col-sm-2 col-form-label">Name of School<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input name="name_of_school" id="name_of_school" class="form-control" value="<?php echo isset($editdata->name_of_school)?$editdata->name_of_school:set_value('name_of_school',$universitydetailsarr->university_name); ?>">
                     <?php echo form_error('name_of_school', '<div class="error">', '</div>'); ?>
					 <div id="sch_id_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="college_of" class="col-sm-2 col-form-label">College of<span class="error">*</span></label>
                <div class="col-sm-10">
                    <select name="college_of" id="college_of" class="form-control">
	            		<option value="">Please select one</option>
						<?php
							foreach($collegeofArr as $colof){
								$cselected =  (isset($editdata->college_of) && $editdata->college_of == $colof->id || $universitydetailsarr->college_of == $colof->id )?'selected':''; 
								echo '<option value="'.$colof->id.'" '.$cselected.'>'.$colof->name.'</option>';
							}
						?>
	            	</select>
                     <?php echo form_error('college_of', '<div class="error">', '</div>'); ?>
					 <div id="college_of_error"></div>
                </div>
            </div>
			<!--<div class="form-group row">
                <label for="year_of_graduated" class="col-sm-2 col-form-label">Year Graduated<span class="error">*</span></label>
                <div class="col-sm-10">
                    <select name="year_of_graduated" id="year_of_graduated" class="form-control">
	            		<option value="">Please select one</option>
						<?php
							for($y = date('Y')-50; $y <= date('Y'); $y++){
								$yearselected =  (isset($editdata->year_of_graduated) && $editdata->year_of_graduated == $y)?'selected':''; 
								echo '<option value="'.$y.'" '.$yearselected.'>'.$y.'</option>';
							}
						?>
	            	</select>
                     <?php echo form_error('year_of_graduated', '<div class="error">', '</div>'); ?>
					 <div id="sch_id_error"></div>
                </div>
            </div>-->
			<div class="form-group row">
                <label for="year_of_graduated" class="col-sm-2 col-form-label">Date Graduated<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" name="date_of_graduated" id="date_of_graduated" value="<?php echo isset($editdata->date_of_graduated)?$editdata->date_of_graduated:set_value('date_of_graduated'); ?>" class="form-control">
                     <?php echo form_error('date_of_graduated', '<div class="error">', '</div>'); ?>
					 <div id="sch_id_error"></div>
                </div>
            </div>
            
			<div class="form-group row">
                <label for="diploma" class="col-sm-2 col-form-label">Diploma<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="diploma" name="diploma" >
                    <input type="hidden" class="form-control" id="old_diploma" name="old_diploma" value="<?php echo isset($editdata->diploma)?$editdata->photo:''; ?>" />
                     <?php echo form_error('diploma', '<div class="error">', '</div>'); ?>
                </div>            
			</div>
			<div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Official transcript of Records<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="official_transcription" name="official_transcription" >
                    <input type="hidden" class="form-control" id="old_official_transcription" name="old_official_transcription" value="<?php echo isset($editdata->official_transcription)?$editdata->official_transcription:''; ?>" />
                     <?php echo form_error('official_transcription', '<div class="error">', '</div>'); ?>
                </div>            
			</div>
			<div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Photo<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="photo" name="photo" >
                    <input type="hidden" class="form-control" id="old_photo" name="old_photo" value="<?php echo isset($editdata->photo)?$editdata->photo:''; ?>" />
                    <input type="hidden" class="form-control" id="submittype" name="submittype" value="" />
                     <?php echo form_error('photo', '<div class="error">', '</div>'); ?>
                </div>            
			</div>
			<div class="form-group row">
				<label for="logo" class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10 col-md-offset-2">
					<?php if(isset($editdata->grad_id) && $editdata->grad_id > 0){ 
						echo '<button type="submit" class="btn btn-success text-uppercase submitbtn" name="submit" value="submit" id="submit">Update</button>';
					}else{
						echo '<button type="submit" class="btn btn-success text-uppercase submitbtn" name="submit" value="submit" id="submit">Submit</button> <button type="submit" class="btn btn-success text-uppercase submitbtn" name="submit" value="next" id="submit">Submit and Next</button>';
					}	
					?>
                    
					<a href="<?php echo base_url('university/university/graduate');?>">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>
<script>

$(".submitbtn").click(function(e){
	var sumitype = $(this).val();
	$('#submittype').val(sumitype);
	//$( "#graduateForm" ).submit();
});
</script>