<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php //$this->view('university_top'); ?>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION </h2>
</div>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>

<div class="col-lg-12 col-md-12">

<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepProcess">
                <span>1</span>
                <label>Business & Accreditation Verification</label>
            </a>
      
        </div>
        <div class="col-2">
            <a href="#">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Accreditation Documents</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Verification of Documents</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Digital Accreditation</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">Business & Accreditation Verification</h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'universitysteponeForm')); ?>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                   <?php echo $universitydetailsarr->university_name;?> 
                </div>
            </div>
            <div class="form-group row">
                <label for="college_of" class="col-sm-3 col-form-label">College of</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->collegeofname;?> 
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->address;?> 
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->email;?> 
                </div>
            </div>
            <div class="form-group row">
                <label for="contact_no" class="col-sm-3 col-form-label">Contact No.</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->contact_no;?> 
                </div>
            </div>
			<div class="form-group row">
                <label for="name_of_representative" class="col-sm-3 col-form-label">Name of Representative</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->name_of_representative;?> 
                </div>
            </div>
            <div class="form-group row">
                <label for="position" class="col-sm-3 col-form-label">Position</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->position;?> 
                </div>
            </div>
            <div class="form-group row">
                <label for="business_license_number" class="col-sm-3 col-form-label">Business License No.</label>
                <div class="col-sm-9">
                     <?php echo $universitydetailsarr->business_license_number;?> 
                </div>
            </div>
			<div class="form-group row">
                <label for="validity_date" class="col-sm-3 col-form-label">Validity Date</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->validity_date;?>
                </div>
            </div>
            <div class="form-group row">
                <label for="issued_by" class="col-sm-3 col-form-label">Issued by</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->issued_by;?>
                </div>
            </div> 
			<div class="form-group row">
                <label for="accreditation_no" class="col-sm-3 col-form-label">Accreditation No.</label>
                <div class="col-sm-9">
                     <?php echo $universitydetailsarr->accreditation_no;?>
                </div>
            </div>
			<div class="form-group row">
                <label for="accreditation_validity_date" class="col-sm-3 col-form-label">Validity Date</label>
                <div class="col-sm-9">
                   <?php echo $universitydetailsarr->accreditation_validity_date;?>
                </div>
            </div>
			<div class="form-group row">
                <label for="accreditation_issued_by" class="col-sm-3 col-form-label">Issued by</label>
                <div class="col-sm-9">
                    <?php echo $universitydetailsarr->accreditation_issued_by;?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <a href="<?php echo base_url('university/university/renewuniversitytwo');?>"><button type="button" class="btn btn-success text-uppercase" name="submit" value="submit" id="submitVerificationBtn">Next</button></a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>