<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Request for Verification of Registration</h2>
</div>

<!-- steps start -->
<div class="container">
    <div class="row pro-steps text-center">
        <div class="col-3">
            <a href="#" class="stepActive">
                <span>
                    <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Personal & Professional Information Verification</label>
            </a>
        </div>
            
        <div class="col-3">
            <a href="#" class="stepProcess">
                <span>
                    <strong>2</strong>
                </span>
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

            <form action="<?php echo base_url('professional/applicant/receipientInformation'); ?>" id="receipientInformationFormsData" enctype="multipart/form-data" method="post">
            
            <?php echo $this->session->flashdata('item'); ?>
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name of Institution<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="insname" name="insname" value="<?php echo set_value('insname'); ?>" placeholder="Please enter institution name" required>
                    <?php echo form_error('insname', '<div class="error">', '</div>'); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="insaddress" id="insaddress" cols="30" rows="5" class="form-control" placeholder="Please enter institution addredd"><?php echo set_value('insaddress'); ?></textarea>
                        <?php echo form_error('insaddress', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Country <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="inscountry" id="inscountry" class="form-control">
                            <option value="">Please choose country</option>
                            <?php foreach($countries as $value){  ?>
                            <option value="<?php echo $value->countries_id; ?>" ><?php echo $value->countries_name;?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('inscountry', '<div class="error">', '</div>'); ?>
                    </div>
                </div> 

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="insemail" name="insemail" value="<?php echo set_value('insemail'); ?>" placeholder="Please enter institution email" required>
                        <?php echo form_error('insemail', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Purpose <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inspurpose" name="inspurpose" value="<?php echo set_value('inspurpose'); ?>" placeholder="Please enter purpose" required>
                        <?php echo form_error('inspurpose', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Submit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


</div>