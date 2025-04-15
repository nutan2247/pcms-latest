<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION </h2>
</div>



<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepActive">
                <span><strong>1</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>School Information</label>
            </a>
         
        </div>
        <div class="col-2" class="stepProcess">
            <a href="#" class="stepProcess">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Business & Accreditation Documents</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Verification of Documents</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <!--<label>Digital Accreditation</label>-->
				<label>Digital Certificate of Accreditation</label>
            </a>        
        </div>
    </div>

    <?php
        if(empty($user_details))
        {
    ?>

    <div class="col-md-8 mx-auto form-heigte">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">Business & ACCREDITATION DOCUMENTS</h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'accreditationForm')); ?>
            
			<div class="form-group row">
                <label for="business_license" class="col-sm-2 col-form-label">Business License<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="business_license" name="business_license" value="<?php echo set_value('business_license'); ?>" required >
                     <?php echo form_error('business_license', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
                <label for="accreditation" class="col-sm-2 col-form-label">Accreditation Document<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="accreditation" name="accreditation" value="<?php echo set_value('accreditation'); ?>" required>
                     <?php echo form_error('accreditation', '<div class="error">', '</div>'); ?>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

<?php }else{ ?>


    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">Personal &amp; Professional Information Verification</h4>
            
            
            <div class="form-group row">

                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_details->user_ID; ?>">

                <label for="inputEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <?php echo $user_details->name; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Birthday</label>
                <div class="col-sm-10">
                    <?php echo date('M d,Y',strtotime($user_details->dob)); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Citizenship</label>
                <div class="col-sm-10">
                    <?php echo $user_details->co_name; ?>
                     
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Sex</label>
                <div class="col-sm-10">
                    <?php echo $user_details->gender; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <?php echo $user_details->address; ?>
                    
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <?php echo $user_details->email; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Tel.No</label>
                <div class="col-sm-10">
                    <?php echo $user_details->phone; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Profession</label>
                <div class="col-sm-10">
                    <?php echo $user_details->pro_name; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">License Number</label>
                <div class="col-sm-10">
                    <?php echo $user_details->license_no; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Date Issued</label>
                <div class="col-sm-10">
                    <?php echo date('M d,Y',strtotime($user_details->added_on)); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Validity</label>
                <div class="col-sm-10">
                    <?php echo date('M d,Y',$user_details->license_validity_date); ?>
                </div>
            </div>

            <?php
                if(!isset($view) && $view=="")
                {
            ?>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <?php
                        if(!empty($user_comments))
                        {
                            $i = 1;
                            foreach ($user_comments as $key => $value) {
                                # code...
                            
                    ?>
                        <p><span><?php echo date('d ,M,Y',strtotime($value['added_on'])); ?> - </span><?php echo $value['comments'] ?></p>
                    <?php $i++; } } ?>    
                   
                </div>
                <label for="inputEmail" class="col-sm-2 col-form-label">Comments</label>
                
                <div class="col-sm-10">
                    
                   
                    <textarea class="form-control" id="license_comments"></textarea>
                     


                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    
                    <button  class="btn btn-success text-uppercase" id="add_comments" >Add</button>


                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2" id="comment_msg">
                    
                  


                </div>
            </div>
                <?php } ?> 
        </div>
    </div>


<?php } ?>
</div>



<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button>
 -->
<!-- Modal -->

<?php
    
    if(!empty($udetails))
    {
    
    
?>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Personal and Professional Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="text-center" style="color:red">
            
            <p>DATA MATCHED</p>
        </div>
        <div id="body" class="col-md-8 mx-auto">
        <div class="bs-example">
       <!--  <p class="h4 mb-4 mt-4 text-uppercase">Verification</p> -->
        <?php echo $this->session->flashdata('error'); ?>
          <p>Your data is Matched in our database. Please review and click the button to confirm</p>
            <p>Please contact us if this is not you.</p>
            <table>
                <tr><th>Name :</th><td><?php echo $udetails->name; ?></td></tr>
                <tr><th>Birthday :</th><td><?php echo date('M j,Y',strtotime($udetails->dob)); ?></td></tr>
                <tr><th>Citizenship : </th><td><?php echo $udetails->country_name; ?></td></tr>
                <tr><th>Sex :</th><td><?php echo $udetails->gender; ?></td></tr>
                <tr><th>Address :</th><td><?php echo $udetails->address; ?></td></tr>
                <tr><th>Email :</th><td><?php echo $udetails->email; ?></td></tr>
                <tr><th>Tel.No :</th><td><?php echo $udetails->phone; ?></td></tr>
                <tr><th>Profession : </th><td><?php echo $udetails->profession_name; ?></td></tr>
            </table>
            <table>
                <tr><th>License Number : </th><td><?php echo $udetails->license_no; ?></td></tr>
                <tr><th>Date Issued : </th><td><?php echo date('M j,Y',strtotime($udetails->added_on)); ?></td></tr>
                <tr><th>Validity : </th><td><?php echo date('M j,Y',strtotime($udetails->license_validity_date)); ?></td></tr>
            </table>
                
            <p class="mt-4">
                <!-- <a href="#" class="btn btn-success text-uppercase" data-toggle="modal" data-target="#confirmData">Confirm</a> -->
                <a href="<?php echo base_url('license/landing/update_photo?user_id='.$udetails->user_ID) ?>" class="btn btn-success text-uppercase">Confirm</a>
                
                <a href="<?php echo base_url('license/contact_us')?>" class="btn text-uppercase text-right">Contact Us</a>
            </p>

        </div>
    </div>

      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<?php

    }
?>

<?php if(!empty($udetails_not_match)) { ?>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Personal and Professional Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div>
            <p>Your data is match in our database. please review and click the button to confirm</p>
            <p>Please call or message us if this is not you.</p>
        </div> -->
        <div id="body" class="col-md-8 mx-auto">
        <div class="bs-example">
       <!--  <p class="h4 mb-4 mt-4 text-uppercase">Verification</p> -->
       
        <p class="error">DATA DID NOT MATCH</p>
        <p>Please contact us to verify your status.</p>
          
          
            <p class="mt-4">
                <!-- <a href="#" class="btn btn-success text-uppercase" data-toggle="modal" data-target="#confirmData">Confirm</a> -->
                <a href="<?php echo base_url('license/contact_us')?>" class="btn btn-success text-uppercase">Contact Us</a>
            </p>
        </div>
    </div>

      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
<?php } ?>




<script>
    $(document).ready(function(){
      $('#staticBackdrop').modal('show');
    });


$(document).on("click","#add_comments",function(){

    var license_comments = $("#license_comments").val();
    var user_id = $("#user_id").val();
    var step_id = 1;

    $.ajax({

        url:base_url+'license/landing/add_comments',
        type:'post',
        data:{license_comments,step_id,user_id},
        beforeSend:function(){
            $("#add_comments").html('WAIT...');
            $("#add_comments").prop('disabled',true);

        },
        success:function(){

            /*$("#license_comments").val("");
            $("#add_comments").html('Add');
            $("#add_comments").prop('disabled',false);
            $("#comment_msg").html("Comments Added Successfully");*/

            location.reload();
        }

    });

});
</script>