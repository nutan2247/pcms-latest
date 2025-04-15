<?php  $this->load->view('professional/include/professional_banner'); ?>
    
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
                        <label>Exam Result</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>5</strong>
                        </span>
                        <label>Professional Certificate of Recognition</label>
                    </a>
                </div>
            </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <p>User name: <b><?php echo $exam_result->user_name; ?></b> </p>
                                <p>Your Result: <b><?php echo $exam_result->status; ?></b> </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>