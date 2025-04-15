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
           <a href="#" class="stepActive">
                <span><strong>1</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>Business & Accreditation Verification</label>
            </a>
         
        </div>
        <div class="col-2" class="stepProcess">
            <a href="#" class="stepProcess">
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
            <h4 class="mb-4 mt-4 text-uppercase text-center">ACCREDITATION DOCUMENTS</h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'renewaccreditationForm')); ?>            
			<div class="form-group row">
                <label for="business_license" class="col-sm-2 col-form-label">Business License<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="business_license" name="business_license" value="" required />
                     <?php echo form_error('business_license', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
                <label for="accreditation" class="col-sm-2 col-form-label">Accreditation License<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="accreditation" name="accreditation" value="" required />
                     <?php echo form_error('accreditation', '<div class="error">', '</div>'); ?>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Submit</button>
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
