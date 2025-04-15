
<section class="dashboard-contentpanel py-lg-5 py-3 ">
<div class="container">
	<div class="row">
		
		<div class="col-md-3"></div>
		<div class="col-md-6">
            <div class="card">
            
            <div class="card-header">
                <h4 class="text-uppercase text-center">FORGET PASSWORD</h4>
            </div>
            <div class="card-body text-center">
                <?php echo $this->session->flashdata('error'); ?>
                <?php $message = $this->session->flashdata('item');
				if(isset($message)) { ?>
                <div class="row">
                    <div class="box-body col-md-12">
                        <div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
                    </div>
				</div>
				<?php } ?>
                <?php echo form_open_multipart(current_url(),array('id'=>'cepForm')); 
                        $hash = bin2hex(random_bytes(16)); ?>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email id<span class="error">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user_details->email)?$user_details->email:'';?>"/>
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        <input type="hidden" name="token_key" value="<?php echo $hash; ?>" >
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>
</div>
			
</section>