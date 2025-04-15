<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Request for Verification of Registration</h2>
</div>

<!-- steps start -->
<div class="container">
    <div class="row pro-steps text-center">
        <div class="col-3">
            <a href="#" class="stepProcess">
                <span>1</span>
                <label>Personal & Professional Information Verification</label>
            </a>
        </div>
            
        <div class="col-3">
            <a href="#">
                <span>2</span>
                <label>Receipient Information</label>
            </a>
        </div>
            
        <div class="col-3">
            <a href="#">
                <span>3</span>
                <label>Payment</label>
            </a>
        </div>
                
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Status</label>
            </a>
        </div>

        <!-- <div class="col-2">
            <a href="#">
                <span>5</span>
                <label>Renewed Professional License</label>
            </a>
        </div> -->

    </div>
</div>
    
<!-- steps end -->

<div class="container">
    <div class="col-md-8 mx-auto">
        <div class="my-5 ">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
            <?php if($details ==''){
                        echo '<p class="text-center">Please login for Request for verification of registration <a href="'.base_url('login').'">Click to Login</a></p>'; 
                }else{ ?>
            <form action="<?php echo base_url('professional/applicant/verificationOfRegistration'); ?>" id="personalFormsData" enctype="multipart/form-data" method="post">
            <?php echo $this->session->flashdata('item'); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname',isset($details->fname)?$details->fname:''); ?>" required>
                    <?php echo form_error('fname', '<div class="error">', '</div>'); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Middle Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname',isset($details->lname)?$details->lname:''); ?>" required>
                    <?php echo form_error('lname', '<div class="error">', '</div>'); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name',isset($details->name)?$details->name:''); ?>" required>
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email',isset($details->email)?$details->email:''); ?>" required>

                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gender <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Please select one</option>
                            <option value="male" <?php if(isset($details->gender) &&  $details->gender=='male'){ echo 'selected';} ?>>Male</option>
                            <option value="female" <?php if(isset($details->gender) &&  $details->gender=='female'){ echo 'selected';} ?>>Female</option>
                        </select>
                <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
                <div id="gender_error"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Birthday <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo set_value('birthday',isset($details->biirthday)?$details->biirthday:''); ?>">
                <?php echo form_error('birthday', '<div class="error">', '</div>'); ?>
                <div id="birthday_error"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profession <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="profession" id="profession" class="form-control">
                            <option value="">Please select one</option>
                            <?php foreach($profession as $value){  ?>
                            <option value="<?php echo $value->id; ?>" <?php if(isset($details->profession) && $details->profession == $value->id){ echo 'selected';} ?> ><?php echo $value->name;?></option>
                            <?php } ?>
                        </select>
                <?php echo form_error('profession', '<div class="error">', '</div>'); ?>
                <div id="profession_error"></div>
                    </div>
                </div> 

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">License Number <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="license_number" name="license_number" value="<?php echo set_value('license_number',isset($details->license_no)?$details->license_no:''); ?>" required>
                        <?php echo form_error('license_number', '<div class="error">', '</div>'); ?>
                        <div id="license_number_error"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Date Issued <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date_issued" name="date_issued" value="<?php echo set_value('date_issued',isset($details->lic_issue_date)?$details->lic_issue_date:''); ?>" required>
                        <?php echo form_error('date_issued', '<div class="error">', '</div>'); ?>
                        <div id="date_issued_error"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Validity Date<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="validity_date" name="validity_date" value="<?php echo set_value('validity_date',isset($details->lic_expiry_date)?$details->lic_expiry_date:''); ?>" required>
                        <?php echo form_error('validity_date', '<div class="error">', '</div>'); ?>
                        <div id="validity_date_error"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Submit</button>
                    </div>
                </div>

            </form>
            <?php } ?>
        </div>
    </div>


</div>
