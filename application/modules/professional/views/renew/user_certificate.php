<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

//print_r($grduatelistingarr); exit;

?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title; ?></h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
          <a href="#" class="stepActive">
                <span><strong>1</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>Personal and Professional<br> Verification</label>
            </a>         
        </div>
        <div class="col-2" >
            <a href="#" class="stepProcess">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Required CE Units Verification</label>
            </a>
        </div>
        <div class="col-2" >
            <a href="#" class="stepProcess">
                <span>
                    <strong>3</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>CE Certificate Verification</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label> Payment</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Digital Professional License</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
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
            <?php echo form_open_multipart('professional/applicant/graducatelicencepayment',array('id'=>'submissiongraduatelistForm')); ?>
            <div class="form-group row">
            
            </div>
			
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submitBtn">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


</div>