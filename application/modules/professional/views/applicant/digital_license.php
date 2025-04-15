     
    <?php  $this->load->view('professional/include/professional_banner'); 
    //print_r($profes_details);exit;?>
    
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
                        <!--<label>Professional Certificate of Eligiblity</label>-->
                        <label>Certificate of Eligibility & Registration Code</label>
                    </a>
                </div>
            </div>
    </div>

   
    <div class="container mb-5">

        <div class="col-md-8 mx-auto">
            <div class="row">
                <div class="text-center">
                    <h4 class="mb-3"><?=$title;?></h4>
                    <iframe src="<?php echo base_url('assets/uploads/pdf/').$profes_details->registration_no.'.pdf'?>" width="750" height="850" frameborder="0"></iframe>
                </div>
            </div>
        </div>

    </div>


