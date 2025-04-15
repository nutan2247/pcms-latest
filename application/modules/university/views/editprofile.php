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
            <h4 class="mb-4 mt-4 text-uppercase text-center">UNIVERSITY INFORMATION </h4>
            <?php echo $this->session->flashdata('error'); ?>
			<?php
			$message = $this->session->flashdata('item');
			if(isset($message)) {
			?>
			<div class="row"><div class="box-body col-md-12">
				<div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
			</div>
			</div>
			<?php } ?>
            <?php echo form_open_multipart('',array('id'=>'universityForm')); ?>
            <div class="form-group row">
                <label for="university_name" class="col-sm-2 col-form-label">University Name</label>
                <div class="col-sm-10">
					<p style="padding-top:5px;"><?php echo isset($editdata->university_name)?$editdata->university_name:set_value('university_name'); ?></p>
                    
                </div>
            </div>
			<div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo isset($editdata->address)?$editdata->address:set_value('address'); ?>" >
                     <?php echo form_error('address', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="contact_no" class="col-sm-2 col-form-label">Contact No.<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact no." value="<?php echo isset($editdata->contact_no)?$editdata->contact_no:set_value('contact_no'); ?>" >
                     <?php echo form_error('contact_no', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="name_of_representative" class="col-sm-2 col-form-label">Name of Representative<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name_of_representative" name="name_of_representative" value="<?php echo isset($editdata->name_of_representative)?$editdata->name_of_representative:set_value('name_of_representative'); ?>" >
                     <?php echo form_error('name_of_representative', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="position" class="col-sm-2 col-form-label">Position<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="position" name="position" value="<?php echo isset($editdata->position)?$editdata->position:set_value('position'); ?>" >
                     <?php echo form_error('position', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			
			<!--<div class="form-group row">
                <label for="business_license_number" class="col-sm-2 col-form-label">Business License Number<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="business_license_number" name="business_license_number" value="<?php echo isset($editdata->business_license_number)?$editdata->business_license_number:set_value('business_license_number'); ?>" >
                     <?php echo form_error('business_license_number', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>-->
			
            
			<div class="form-group row">
                <label for="college_logo" class="col-sm-2 col-form-label">Logo<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="college_logo" name="college_logo" >
                    <input type="hidden" class="form-control" id="old_college_logo" name="old_college_logo" value="" />
                     <?php echo form_error('college_logo', '<div class="error">', '</div>'); ?>
                </div>            
			</div>
			<div class="form-group row">
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
					<a href="<?php echo base_url('university/university/graduate');?>">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>