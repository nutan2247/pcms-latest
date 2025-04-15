     
    <?php
    if($profes_details->role=='P'){
        $this->load->view('professional/include/professional_banner'); 
    } 
    if($profes_details->role=='F'){ ?>
    <div id="banner-grid" class="py-5 px-2 bg-red online-red-banner mb-5"> 
        <div class="container">
            <h3 class="text-center text-uppercase text-white">Foreign Professional Review for Licensure Examination </h3>    
        </div>
    </div>   
    <?php } ?>
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Foreign Professional Profile</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>2</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Upload Documents</label>
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
                        <label>Review of Documents</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>5</strong>
                        </span>
                        <label>Examination Code</label>
                    </a>
                </div>
            </div>
    </div>

    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <div class="text-center">
                <h4 class="mb-4 text-uppercase text-center">Exam Code</h4>
                <div class="card">
                    <div class="card-header">
                    Now you are eligible for apply for exam booking.
                    </div>
                    <div class="card-body">
                    <ul style="list-style-type:none;">
                        <li>Username: <?php echo ucwords($profes_details->fname.' '.$profes_details->lname.' '.$profes_details->name);?></li>
                        <li>Your Exam Code : <?php echo $profes_details->exam_code; ?></li>
                    </ul>
                    </div>
                </div>
                <?php if(count($exam_details) > 0 && $exam_details->payment == '1'){ ?>
                    <div class="card">
                        <div class="card-body">
                        <a class="btn btn-info" href="<?php echo base_url('professional/applicant/exam_pass/'.base64_encode($profes_details->user_ID)); ?>">Click here to view your exam Pass.</a>
                        </div>
                    </div>
                <?php } ?>
               </div>
            </div>
        </div>
    </div>

