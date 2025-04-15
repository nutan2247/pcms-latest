<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

//print_r($details);
?>
<style type="text/css">
    
    .error{
        color:#ce2b2b;
    }
</style>
<?php $this->view('professional_top'); ?>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4">
            <?php $this->view('dashboard_left'); ?>
		</div>
		<div class="col-lg-9 col-md-8">        
            <h4 class="mb-4 mt-4 text-uppercase text-center">PERSONAL INFORMATION </h4>
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
            
            <input type="hidden" name="id"  value="<?php echo $this->session->userdata('id'); ?>">
            <input type="hidden" name="user_type"  value="<?php echo $this->session->userdata('candidate_type'); ?>">
            <input type="hidden" name="name"  value="<?php echo $details->fullname; ?>">
            <input type="hidden" name="old_image"  value="<?php echo isset($details->image)?$details->image:''; ?>">
            <div class="form-group row">
                <label for="fname" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
					<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo isset($details->address)?$details->address:set_value('address'); ?>" >
                    <?php echo form_error('address', '<div class="error">', '</div>'); ?>
					<div id="student_name_error"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="lname" class="col-sm-2 col-form-label">Contact Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact Number" value="<?php echo isset($details->phone)?$details->phone:set_value('phone'); ?>" >
                    <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                    <div id="student_name_error"></div>
                </div>
            </div>
            <!--<div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Surname<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Surname" value="<?php echo isset($details->name)?$details->name:set_value('name'); ?>" >
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                    <div id="student_name_error"></div>
                </div>
            </div>-->

            <?php if(isset($details->image)){?>
			<div class="form-group row">
                <label for="college_logo" class="col-sm-2 col-form-label">Uploaded Photo</label>
                <div class="col-sm-10">
                    <img src="<?php echo base_url('assets/uploads/profile/').$details->image; ?>" width="150" height="150">
                </div>            
			</div>
            <?php } ?>
            <div class="form-group row">
                <label for="college_logo" class="col-sm-2 col-form-label">Profile Photo</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" >
                     <?php echo form_error('college_logo', '<div class="error">', '</div>'); ?>
                </div>            
            </div> 

			<div class="form-group row">
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>