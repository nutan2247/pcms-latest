<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Professional License Card Renewal</h2>
</div>

<?php // print_r($udetails); ?>

<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
            <a href="#" class="stepProcess">
                <span>1</span>
                <label>Personal & Professional Verification</label>
            </a>
        </div>
            
        <div class="col-2">
            <a href="#">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Required CE Units <br>Verification</label>
            </a>
        </div>
            
        <div class="col-2">
            <a href="#">
                <span>3</span>
                <label>CE Certificates <br>Verification</label>
            </a>
        </div>
                
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Payment</label>
            </a>
        </div>

        <div class="col-2">
            <a href="#">
                <span>5</span>
                <!--<label>Digital Professional License</label>-->
                <label>Renewed Professional License</label>
            </a>
        </div>

    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5 ">
            <h4 class="mb-4 mt-4 text-uppercase text-center">Personal &amp; Professional Information Verification</h4>
            <form action="#" id="personalFormsData" enctype="multipart/form-data" method="post">

                <span id="form-error" class="w-100 p-1 text-center alert alert-danger" style="display: none;"></span>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname',isset($details->fname)?$details->fname:''); ?>" required>
                    <?php echo form_error('fname', '<div class="error">', '</div>'); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Middle Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname',isset($details->lname)?$details->lname:''); ?>" required>
                    <?php echo form_error('lname', '<div class="error">', '</div>'); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name',isset($details->name)?$details->name:''); ?>" required>
                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email',isset($details->email)?$details->email:''); ?>" required>

                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gender <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Please select one</option>
                            <option value="male" <?php if(isset($details->gender) &&  $details->gender=='male'){ echo 'selected';} ?>>Male</option>
                            <option value="female" <?php if(isset($details->gender) &&  $details->gender=='female'){ echo 'selected';} ?>>Female</option>
                        </select>
                <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
                <div id="gender_error"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Birthday <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo set_value('birthday',isset($details->biirthday)?$details->biirthday:''); ?>">
                <?php echo form_error('birthday', '<div class="error">', '</div>'); ?>
                <div id="birthday_error"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profession <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="profession" id="profession" class="form-control">
                            <option value="">Please select one</option>
                            <?php foreach($profession as $value){  ?>
                            <option value="<?php echo $value->id; ?>" <?php if(isset($details->profession) && $details->profession == $value->id){ echo 'selected';} ?> ><?php echo $value->name;?></option>
                            <?php } ?>
                        </select>
                <?php echo form_error('profession', '<div class="error">', '</div>'); ?>
                <div id="profession_error"></div>
                    </div>
                </div> 

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">License Number <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="license_number" name="license_number" value="<?php echo set_value('license_number',isset($details->license_no)?$details->license_no:''); ?>" required>
                        <?php echo form_error('license_number', '<div class="error">', '</div>'); ?>
                        <div id="license_number_error"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Date Issued <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date_issued" name="date_issued" value="<?php echo set_value('date_issued',isset($details->lic_issue_date)?$details->lic_issue_date:''); ?>" required>
                        <?php echo form_error('date_issued', '<div class="error">', '</div>'); ?>
                        <div id="date_issued_error"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Validity Date<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="validity_date" name="validity_date" value="<?php echo set_value('validity_date',isset($details->lic_expiry_date)?$details->lic_expiry_date:''); ?>" required>
                        <?php echo form_error('validity_date', '<div class="error">', '</div>'); ?>
                        <div id="validity_date_error"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Submit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


</div>


<?php if(isset($match_success) && $match_success == 1 && !empty($user) && !empty($udetails)) { ?>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Personal and Professional Information: Verified </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="body" class="col-md-12">
        <div class="bs-example">
       <!--  <p class="h4 mb-4 mt-4 text-uppercase">Verification</p> -->
        <?php echo $this->session->flashdata('error'); ?>
            <p>Your data is Matched in our database. Please review and click the button to confirm</p>
            <p>Please contact us if this is not you.</p>
            <p>
                <img src="<?php echo base_url('assets/uploads/profile/').$udetails->image; ?>" alt="Photo" width="250">
            </p>
            <table>
                <tr><th>Name :</th><td><?php echo $udetails->fullname; ?></td></tr>
                <tr><th>Birthday :</th><td><?php echo date('M j,Y',strtotime($udetails->dob)); ?></td></tr>
                <tr><th>Citizenship : </th><td><?php echo $udetails->countries_name; ?></td></tr>
                <tr><th>Sex :</th><td><?php echo $udetails->gender; ?></td></tr>
                <!-- <tr><th>Address :</th><td><?php echo $udetails->address; ?></td></tr> -->
                <tr><th>Email :</th><td><?php echo $udetails->email; ?></td></tr>
                <!-- <tr><th>Tel.No :</th><td><?php echo $udetails->phone; ?></td></tr> -->
                <tr><th>Profession : </th><td><?php echo $udetails->profession_name; ?></td></tr>
            </table>
            <table>
                <tr><th>License Number : </th><td><?php echo $udetails->license_no; ?></td></tr>
                <tr><th>Date Issued : </th><td><?php echo date('M j,Y',strtotime($udetails->added_on)); ?></td></tr>
                <tr><th>Validity : </th><td><?php echo date('M j,Y',strtotime($udetails->license_validity_date)); ?></td></tr>
            </table>
                
            <p class="mt-4 text-center">
                <a href="<?php echo base_url('license/landing/update_photo/').base64_encode($udetails->user_ID); ?>" class="btn btn-success text-uppercase">Confirm</a>
                <a href="<?php echo base_url('contactus').'?name='.$udetails->fullname.'&&email='.$udetails->email; ?>" class="btn btn-info text-uppercase text-right">Contact Us</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </p>

        </div>
    </div>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>

<?php

    }
?>

<?php if(isset($match_success) && $match_success == 0 && !empty($udetails_not_match)) { ?>
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
            <div id="body" class="col-md-8 mx-auto">
                <div class="bs-example">
                    <p class="error">DATA DID NOT MATCH</p>
                    <p>Please contact us to verify your status.</p>
                    <p class="mt-4">
                        <a href="<?php echo base_url('license/contact_us')?>" class="btn btn-success text-uppercase">Contact Us</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </p>
                </div>
            </div>
      </div>

    </div>
  </div>
</div>
<?php } ?>

<?php if(isset($match_success) && $match_success > 1 && !empty($status)) { ?>
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
            <div id="body" class="col-md-8 mx-auto">
                <div class="bs-example">
                <?php if($status == 4){ ?>
                    <p class="error">You Are Revoked</p>
                <?php } ?>
                <?php if($status == 3){ ?>
                    <p class="error">You Are Suspended</p>
                <?php } ?>
                    <p>Please contact us to verify your status.</p>
                    <p class="mt-4">
                        <a href="<?php echo base_url('license/contact_us')?>" class="btn btn-success text-uppercase">Contact Us</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </p>
                </div>
            </div>
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


<style type="text/css">
    .error{
        color:#ce2b2b;
    }
</style>