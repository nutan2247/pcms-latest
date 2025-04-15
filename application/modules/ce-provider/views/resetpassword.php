
<section class="dashboard-contentpanel py-lg-5 py-3 ">
    <div class="container">
        <div class="row">
            
		    <div class="col-md-2"></div>
		    <div class="col-md-8">
            
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase text-center">RESET PASSWORD</h4>
                    </div>
                    <!-- <?php print_r($_REQUEST);?> -->
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
                    
                        <?php echo form_open_multipart(base_url('ce-provider/ce_provider/resetpassword'),array('id'=>'schoolForm')); ?>
                        <div class="form-group row">
                            <?php echo form_hidden('provider_id', isset($_GET['userid'])?$_GET['userid']:'');?>
                            <label for="new_pass" class="col-sm-2 col-form-label">New Password<span class="error">*</span></label>
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
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Reset</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
    
                    </div>
                </div>
        </div>
    </div>
</section>