
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Professional License Card Renewal</h2>
</div>
<!-- <?php // echo '<pre>'; echo isset($_SESSION['all_certicates_id'])?$_SESSION['all_certicates_id']:'-nk-'; echo '</pre>'; ?> -->
<div class="container">

    <div class="row pro-steps">
        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>1</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Personal & Professional Verification</label>
            </a>        
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>2</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Required CE Units Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span><strong>3</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                <label>CE Certificates Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span><strong>4</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                <label>Payment</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span><strong>5</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                 <label>Renewed Professional License</label>
            </a>
        </div>
    </div>
</div>
   
    <div class="container mb-5">
        <div class="col-md-8 mx-auto">
            <div class="row">
                <div class="text-center">
                    <h4 class="mb-3"><?=$title;?></h4>
                    <iframe src="<?php echo base_url('assets/uploads/pdf/').$profes_details.'card.pdf'?>" width="750" height="650" frameborder="0"></iframe>
                </div>
            </div>
        </div>

    </div>


