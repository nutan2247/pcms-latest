
    <?php echo $this->load->view('ce-provider/common/training_course_banner.php'); ?>
	<div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP & Accreditaion Verification</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>2</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Online Training Course File</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>3</strong>
							 <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Payment</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>4</strong>
							<i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Review of Online Course</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>5</strong>
							<i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <!--<label>Digital Accreditaion</label>-->
                        <label>Digital Certificate of Accreditaion</label>
                    </a>
                </div>
            </div>
    </div>

    <div class="container mb-5">

    <div class="col-md-8 mx-auto">
            <div class="row">
                <div class="text-center">
                    <h4><?=$title;?></h4>
                    <iframe src="<?php echo base_url('assets/uploads/pdf/').$training_details->accreditation_no.'.pdf'?>" width="750" height="850" frameborder="0"></iframe>
                </div>
            </div>
        </div>

    </div>
         
	