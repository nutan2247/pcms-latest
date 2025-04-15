<style type="text/css">
    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Contact Us Form</h2>
</div>
<div class="container">
<div class="col-md-8 mx-auto">
        <div class="my-5">
           <!--  <h4 class="mb-4 mt-4 text-uppercase text-center">Personal &amp; Professional Information Verification</h4> -->
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'contact_form')); ?>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">To</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="reg_board" name="reg_board" placeholder="Name of reg. board" value="<?php echo set_value('reg_board','Regulatory Board'); ?>" >
                    <?php echo form_error('reg_board', '<div class="error">', '</div>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">From</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo set_value('user_name',isset($_REQUEST['name'])?$_REQUEST['name']:''); ?>" placeholder="Enter name">
                     <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter email" value="<?php echo set_value('user_email',isset($_REQUEST['email'])?$_REQUEST['email']:''); ?>" >
                    <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
                     
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Contact Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo set_value('phone',isset($_REQUEST['contact'])?$_REQUEST['contact']:''); ?>" >
                    <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                     
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder=" Request for verfication of professional registration" value="Request for verfication of professional registration" >
                     
                </div>
            </div>

             <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Attached document</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="document" name="document"  value="" >
                     
                </div>
            </div>
          
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Send</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>