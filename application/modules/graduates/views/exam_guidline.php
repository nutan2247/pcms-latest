<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//print_r($heading);exit;?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title;?></h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepActive">
                <span>
                	<strong>1</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Graduate Profile & Code</label>
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
            <a href="#" class="stepProcess">
                <span>4</span>
                <label>Examination Guidelines and Information</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Exam Pass</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
            <?php echo $this->session->flashdata('error'); ?>
            <p><?php echo (isset($heading->content))?$heading->content:''; ?></p>
             <!--<p>Please bring your exam slip on the day of examination for the instructor to validate your booking. Your application number in your exam slip will be used by to log in for the online examination. (click here to exam slip ) </p>
               <p>It is required that you bring and present the document you submitted online for verification by the instructor before you can take the exam.</p>-->
                <div class="text-right pt-4">
                    <a href="#" class="btn btn-success text-uppercase mb-4" onclick="goToExamslip()">View Exam Slip</a>
                </div>
                <div id="accordion" class="guidelines-accodian">
                    <div class="card mb-3">
                    <?php if(!empty($lesson)){?>
                    <?php foreach($lesson as $key => $value){ ?>
                        <div class="card-header" id="headingOne<?php echo $key; ?>">
                            <h5 class="mb-0">
                                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php echo $key; ?>"
                                    aria-expanded="true" aria-controls="collapseOne<?php echo $key; ?>"
                                    style=" display: inline-block; width: 100%; text-align: left;">
                                    <?php echo $value->lesson_title; ?>
                                </a>
                            </h5>
                        </div>

                        <div id="collapseOne<?php echo $key; ?>" class="collapse <?php if($key < 1){ echo 'show'; }?>" aria-labelledby="headingOne<?php echo $key; ?>"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p class="mb-3">
                                    <?php echo $value->lesson_content; ?>
                                </p>
                                <?php if($value->lesson_image != ''){?>
                                <img src="<?php echo base_url('assets/upload/').$value->lesson_image?>"
                                    class="img-fluid text-center mb-3" alt="">
                                <?php } ?>

                                <?php if($value->lesson_video != ''){?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                        src="<?php echo base_url('assets/upload/video/').$value->lesson_video;?>" allowfullscreen></iframe>
                                </div>
                                <?php } ?>

                                <?php if($value->youtube_video != ''){
                                        $youtube = explode('v=', $value->youtube_video);
                                        $urlstring = $youtube[1];
                                        $url = substr($urlstring,0,11); ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/<?php echo $url; ?>" allowfullscreen></iframe>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } } ?>
                    </div>
                   
                </div>

            <div class="form-group row">
                <div class="text-center pt-4">
                    <!--<a href="#" class="btn btn-success text-uppercase" onclick="goToExamslip()">View Exam Slip</a>-->
                    <a href="#" class="btn btn-success text-uppercase" onclick="goToExamslip()">View Exam Slip</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function goToExamslip(){
        window.location.href = "<?php echo base_url('graduates/graduates/exam_pass/'.base64_encode($this->session->userdata('grad_id'))); ?>";
    }
</script>