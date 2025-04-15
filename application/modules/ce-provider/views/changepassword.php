<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('dashboard_top'); ?>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4">
            <?php $this->view('dashboard_left'); ?>
		</div>
		<div class="col-lg-9 col-md-8">
        
            <h4 class="mb-4 mt-4 text-uppercase text-center">CHANGE PASSWORD
            <a href="<?php echo base_url('ce-provider/ce_provider/forgetpassword'); ?>" class="btn btn-primary pull-right">Forget Password</a></h4>
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
            <?php echo form_open_multipart('',array('id'=>'schoolForm')); ?>
            <div class="form-group row">
				<?php echo form_hidden('sch_id', isset($editdata->sch_id)?$editdata->sch_id:'');?>
                <label for="old_password" class="col-sm-2 col-form-label">Old Password<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="old_password" name="old_password" />
                    <?php echo form_error('old_password', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				<label for="old_password" class="col-sm-2 col-form-label">New Password<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="new_pass" name="new_pass" />
                    <?php echo form_error('new_pass', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				<label for="old_password" class="col-sm-2 col-form-label">Confirm Password<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="conf_pass" name="conf_pass" />
                    <?php echo form_error('conf_pass', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
				 <label for="logo" class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Update</button>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>