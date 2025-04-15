<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Booking for Online Licensure Examination (Foreign Professionals) </h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepActive">
                <span>
                	<strong>1</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Foreign Professional Profile <br> Exam Code</label>
            </a>         
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span>
                    <strong>2</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Exam Booking</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
				<span>
                    <strong>3</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span>
                    <strong>4</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Examination Guidelines and Information</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#" class="stepProcess">
                <span>5</span>
                <label>Exam Pass</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
            <div class="text-center">
                <iframe src="<?php echo base_url('assets/uploads/pdf/').$profes_details->exam_code.'.pdf'?>" width="650" height="850" frameborder="0"></iframe>
            </div>
        </div>
    </div>

</div>
<style type="text/css">    
    .error{ color:#ce2b2b; }
</style>