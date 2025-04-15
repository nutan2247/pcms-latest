<?php //echo $license_no;exit;//print_r($profes_details); ?>
<?php  $this->load->view('professional/include/registration_banner'); ?>


<div class="container mb-5">
    <div class="row pro-steps">
        <div class="col-4">
            <a href="javascript:void(0);" class="stepActive">
                <span>
                    <strong>1</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Professional Information</label>
            </a>
        </div>
        <div class="col-4">
            <a href="javascript:void(0);" class="stepActive">
                <span>
                    <strong>2</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Payment</label>
            </a>
        </div>
        <div class="col-4">
            <a href="javascript:void(0);" class="stepProcess">
                <span>
                    <strong>3</strong>
                </span>
                <label>Registration Certificate and <br>Professional Identification Card</label>
            </a>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="col-md-8 mx-auto mt-2">
        <div class="row">
            <div class="text-center">
                <h4 class="mb-3">Professional Identification Card</h4>
                <iframe src="<?php echo base_url('assets/uploads/pdf/').$license_no.'card.pdf'?>" width="750" height="550" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <div class="col-md-8 mx-auto mt-2">
        <div class="row">
            <div class="text-center">
                <h4 class="mb-3">Certificate</h4>
                
                <iframe src="<?php echo base_url('assets/uploads/pdf/').$license_no.'cert.pdf'?>" width="750" height="850" frameborder="0"></iframe>
                
            </div>
        </div>
    </div>

</div>



