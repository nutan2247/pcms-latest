<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="dashboard-heropanel jumbotron py-lg-5 mt-5 py-3 border-bottom border-primary mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-2">
                        <img class="img-fluid img-rounded d-block mx-auto" width="200px" height="200px" src="<?php echo base_url('assets/images/ce_provider/').$user_details->company_logo; ?>" alt="">
                        <h5 class="mt-3"><?php echo $user_details->business_name; ?></h5>
                         <p><strong>Accrediation no: </strong>1234567890</p>
                         <p><strong>Validate Date: </strong><?php echo date('F d Y',strtotime(date('Y-m-d')))?></p>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo $count_course; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Online Courses</h6>
                            <a href="<?php echo base_url('ce-provider/CE_provider/course_application'); ?>" class="btn btn-info bg-success w-100" id="online-course-app">Submit Online Courses</a>
                        </div>
                        
                        <div class="col-lg-4">
                        <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo $count_training; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Training Courses</h6>
                            <a href="<?php echo base_url('ce-provider/CE_provider/training_application'); ?>" class="btn btn-info bg-success w-100" id="training-course-appp">Submit Training Courses</a>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center d-inline-block w-100 h-50 text-white bg-secondary p-2 rounded">
                                <h4 class="pt-2">251</h4>
                                <span>Days Remaining</span>
                            </div>
                            <h6 class="py-3 text-center">Accrediation Status:Valid</h6>
                            <a target="_blank" href="<?php echo base_url('ce-provider/CE_provider/cep_renewal/'.$id) ?>"><button type="button" class="btn btn-info bg-secondary w-100">Renew Accrediation</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
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
            <?php echo form_open_multipart('',array('id'=>'universityForm')); ?>
            <div class="form-group row">
                <label for="business_name" class="col-sm-2 col-form-label">Business Name<span class="error">*</span></label>
                <div class="col-sm-10">
					<input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name" value="<?php echo isset($user_details->business_name)?$user_details->business_name:set_value('business_name'); ?>" >
                    <?php echo form_error('business_name', '<div class="error">', '</div>'); ?>
					<div id="student_name_error"></div>
                </div>
            </div>
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
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
					<a href="<?php echo base_url('ce-provider/CE_provider/dashboard');?>">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>