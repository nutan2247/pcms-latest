<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
        
            <h4 class="mb-4 mt-4 text-uppercase text-center">SCHOOL INOFORMATION</h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'schoolForm')); ?>
            <div class="form-group row">
				<?php echo form_hidden('sch_id', isset($editdata->sch_id)?$editdata->sch_id:'');?>
                <label for="school_name" class="col-sm-2 col-form-label">Name<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name" value="<?php echo isset($editdata->school_name)?$editdata->school_name:set_value('school_name'); ?>" >
                    <?php echo form_error('school_name', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo isset($editdata->email)?$editdata->email:set_value('email'); ?>" >
                     <?php echo form_error('email', '<div class="error">', '</div>'); ?>
					
				</div>
            </div>
			<div class="form-group row">
                <label for="website" class="col-sm-2 col-form-label">Website<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" id="website" name="website" placeholder="Enter website" value="<?php echo isset($editdata->website)?$editdata->website:set_value('website'); ?>" >
                     <?php echo form_error('website', '<div class="error">', '</div>'); ?>
					
				</div>
            </div>
			<div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo isset($editdata->address)?$editdata->address:set_value('address'); ?>" >
                     <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                </div>
            </div>
           
            <div class="form-group row">
                <label for="contact_number" class="col-sm-2 col-form-label">Contact Number<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" value="<?php echo isset($editdata->contact_number)?$editdata->contact_number:set_value('contact_number'); ?>" >
                    <?php echo form_error('contact_number', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="contact_person" class="col-sm-2 col-form-label">Contact Person<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person" value="<?php echo isset($editdata->contact_person)?$editdata->contact_person:set_value('contact_person'); ?>" >
                    <?php echo form_error('contact_person', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="position" class="col-sm-2 col-form-label">Position<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="<?php echo isset($editdata->position)?$editdata->position:set_value('position'); ?>" >
                    <?php echo form_error('position', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="accreditation_number" class="col-sm-2 col-form-label">Accreditation Number<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="accreditation_number" name="accreditation_number" placeholder="Accreditation Number" value="<?php echo isset($editdata->accreditation_number)?$editdata->accreditation_number:set_value('accreditation_number'); ?>" >
                    <?php echo form_error('accreditation_number', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="date_issued" class="col-sm-2 col-form-label">Date Issued<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_issued" name="date_issued" placeholder="Date Issued" value="<?php echo isset($editdata->date_issued)?$editdata->date_issued:set_value('date_issued'); ?>" >
                    <?php echo form_error('date_issued', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="validity_date" class="col-sm-2 col-form-label">Validity Date<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="validity_date" name="validity_date" placeholder="Validity Date" value="<?php echo isset($editdata->validity_date)?$editdata->validity_date:set_value('validity_date'); ?>" >
                    <?php echo form_error('validity_date', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="logo" class="col-sm-2 col-form-label">Logo<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="logo" name="logo" />
                    <input type="hidden" class="form-control" id="old_logo" name="old_logo" value="<?php echo isset($editdata->logo)?$editdata->logo:''; ?>" />
                    <?php echo form_error('logo', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				 <label for="logo" class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
					<a href="<?php echo base_url('university/university/school');?>">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>