<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->view('dashboard_top'); ?>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4">
            <?php $this->view('dashboard_left'); ?>
		</div>
		<div class="col-lg-9 col-md-8">        
            <h4 class="mb-4 mt-4 text-uppercase text-center">PROVIDER INOFORMATION </h4>
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
            <?php echo form_open_multipart('',array('id'=>'cepProfileForm')); ?>
            <!-- <div class="form-group row">
                <label for="business_name" class="col-sm-2 col-form-label">Business Name<span class="error">*</span></label>
                <div class="col-sm-10">
					<input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name" value="<?php echo isset($user_details->business_name)?$user_details->business_name:set_value('business_name'); ?>" readonly>
                    <?php echo form_error('business_name', '<div class="error">', '</div>'); ?>
					<div id="student_name_error"></div>
                </div>
            </div> -->
			<div class="form-group row">
                <label for="business_no" class="col-sm-2 col-form-label">Business no.<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="business_no" name="business_no" placeholder="Business no." value="<?php echo isset($user_details->business_no)?$user_details->business_no:set_value('business_no'); ?>" >
                     <?php echo form_error('business_no', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="contact_person" class="col-sm-2 col-form-label">Contact Person<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person" value="<?php echo isset($user_details->contact_person)?$user_details->contact_person:set_value('contact_person'); ?>" >
                     <?php echo form_error('contact_person', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			<div class="form-group row">
                <label for="designation" class="col-sm-2 col-form-label">Designation<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="designation" name="designation" value="<?php echo isset($user_details->designation)?$user_details->designation:set_value('designation'); ?>" >
                     <?php echo form_error('designation', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>
			
			<div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($user_details->address)?$user_details->address:set_value('address'); ?>" >
                     <?php echo form_error('address', '<div class="error">', '</div>'); ?>
					 <div id="email_error"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Company Logo</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="company_logo" value="" >
                    <input type="hidden" class="form-control" name="old_company_logo" value="<?php echo isset($user_details->company_logo)?$user_details->company_logo:''; ?>" >
                </div>
            </div>
			
			
			<div class="form-group row">
                <div class="col-sm-12 offset-5">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
					<a href="<?php echo base_url('ce-provider/ce_provider/dashboard');?>" class="btn btn-info">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>