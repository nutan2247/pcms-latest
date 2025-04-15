<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">PROFESSIONAL LICENSE RENEWAL</h2>
</div>



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
                <span>
                    <strong>3</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>CE Certificates Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>4</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Payment</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>4</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <!--<label>Digital Professional License</label>-->
                <label>Renewed Professional License</label>
            </a>
        </div>

    </div>
    
    
    <div class="form-group row">
        <div class="col-md-8 mx-auto">
            <div class="my-5">
            
                <div class="col-sm-10">
                    <table class="table">
                        
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><a href="<?php echo base_url('license/landing/certificate_pdf?user_id='.$user_details->user_ID) ?>" class="btn btn-info btn-lg">
                                <span class="glyphicon glyphicon-download-alt"></span> Download </a></td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <th>Profession</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Address</td>
                        </tr>
                        <?php
                            if(!empty($user_details))
                            {
                        ?>
                        <tr>
                            <td><?php echo $user_details->name; ?></td>
                            <td><?php echo $user_details->pro_name; ?></td>
                            <td><?php  echo $user_details->phone; ?></td>
                            <td><?php echo $user_details->dob; ?></td>
                            <td><?php echo $user_details->gender; ?></td>
                            <td><?php echo $user_details->address; ?></td>
                        </tr>
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>








