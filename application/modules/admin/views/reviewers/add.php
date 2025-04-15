<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h2 class="mt-4"><?php echo $page_title; ?></h2>

    <div class="card mb-4">

        <div class="card-header">

            <i class="fas fa-table mr-1"></i>

            <?php echo $table_name; ?>

        </div>

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 


                    <?php echo validation_errors(); ?>
                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_reviewer')); //echo "<pre>"; print_r($reviewer); echo "</pre>";  ?>

                    <?php echo form_hidden('reviewer_id', isset($reviewer->user_ID)?$reviewer->user_ID:'');?>

                            

                    <div class="form-group">

                        <label for="first_name" class="col-sm-2 control-label">First Name</label>

                        <div class="col-sm-10">

                            <input name="first_name" value="<?php echo isset($reviewer->first_name)?$reviewer->first_name:''; ?>" id="first_name" class="form-control" type="text" required>

                        </div>

                    </div> 

                    <div class="form-group">

                        <label for="last_name" class="col-sm-2 control-label">Last Name</label>

                        <div class="col-sm-10">

                            <input name="last_name" value="<?php echo isset($reviewer->last_name)?$reviewer->last_name:''; ?>" id="last_name" class="form-control" type="text" required>

                        </div>

                    </div> 

                    <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">

                            <input name="email" value="<?php echo isset($reviewer->email)?$reviewer->email:''; ?>" id="email" class="form-control" type="email" required>

                        </div>

                    </div>  
  
                    <div class="form-group">

                        <label for="photo" class="col-sm-2 control-label">Photo</label>

                        <div class="col-sm-10">

                            <input name="photo" value="<?php echo isset($reviewer->photo)?$reviewer->photo:''; ?>" id="photo" class="form-control" type="file">
                            <input name="old_photo" value="<?php echo isset($reviewer->photo)?$reviewer->photo:''; ?>" class="form-control" type="hidden">

                        </div>

                        </div>  


                        <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Date of Appointment</label>

                        <div class="col-sm-10">

                            <input name="created_on" value="<?php echo isset($reviewer->created_on)?$reviewer->created_on:''; ?>" id="created_on" class="form-control" type="date" required>

                        </div>

                        </div>  


                        <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Validity Date</label>

                        <div class="col-sm-10">

                            <input name="validity_date" value="<?php echo isset($reviewer->validity_date)?$reviewer->validity_date:''; ?>" id="validity_date" class="form-control" type="date" required>

                        </div>

                        </div>  
                    <div class="form-group">

                        <label for="username" class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10">
                            <?php $condition = isset($reviewer->username)?'readonly':'required'; ?>
                            <input name="username" value="<?php echo isset($reviewer->username)?$reviewer->username:''; ?>" id="username" class="form-control" type="email" <?php echo $condition; ?>>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="password" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <?php $random_password = rand(10000,999999); ?>
                            <input name="password" value="<?php echo isset($reviewer->password)?$reviewer->password:$random_password; ?>" id="password" class="form-control" type="text">

                        </div>

                    </div>    
             
                    <div class="form-group">

                        <label for="user_type" class="col-sm-2 control-label">Reviewer Type</label>

                        <div class="col-sm-10">
                            <label class="radio-inline">
                            <input type="radio" name="user_type" value="sub-admin" required <?php echo (isset($reviewer->user_type) && $reviewer->user_type=='sub-admin')? 'checked="checked"':''; ?>> Document Reviewer
                            </label>

                            <label class="radio-inline">
                            <input type="radio" name="user_type" value="ct" required <?php echo (isset($reviewer->user_type) && $reviewer->user_type=='ct')? 'checked="checked"':''; ?>>
                            Course Training Reviewer

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10">

                            <label class="radio-inline">

                                <input type="radio" name="status" id="status1" value="enable" <?php echo (isset($reviewer->status) && $reviewer->status=='enable')? 'checked="checked"':''; ?>> Active

                            </label>

                            <label class="radio-inline">

                                <input type="radio" name="status" id="status0" value="disable" <?php echo (isset($reviewer->status) && $reviewer->status =='disable')? 'checked="checked"':''; ?>> Inactive

                            </label>

                        </div>

                    </div>
                            

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>

                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>

                                <?php echo anchor('admin/reviewers_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>

                            </div>

                        </div>

                    </div>

                    <?php echo form_close();?>

                    </div>

                </div>

            </div>

        </div>



        </div>

    </div> 

</div>

</main>

                





