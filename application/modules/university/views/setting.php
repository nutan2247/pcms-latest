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
        
            <h4 class="mb-4 mt-4 text-uppercase text-center">SETTING</h4>
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
				
                <label for="chairman" class="col-sm-2 col-form-label">Name of Chairman<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="chairman" name="chairman" value="<?php echo $universitydetailsarr->chairman; ?>" />
                    <?php echo form_error('chairman', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				<label for="qualification" class="col-sm-2 col-form-label">Qualification<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo $universitydetailsarr->qualification; ?>" />
                    <?php echo form_error('qualification', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				<label for="chairposition" class="col-sm-2 col-form-label">Position<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="chairposition" name="chairposition" value="<?php echo $universitydetailsarr->chairposition; ?>" />
                    <?php echo form_error('chairposition', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
				 <label for="logo" class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
    
</div>
</div>
</div>
</section>