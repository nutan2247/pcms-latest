<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


        <?php  $this->load->view('professional/include/profexam_banner'); ?>
        <div class="container mb-5">
            <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>1</strong>
                        </span>
                        <label>Foreign Professional Profile <br> & Exam Code</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>2</strong>
                        </span>
                        <label>Exam Booking</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>3</strong>
                        </span>
                        <label>Payment</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>4</strong>
                        </span>
                        <label>Examination Guidlines<br>and Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Exam Slip</label>-->
                        <label>Exam Pass</label>
                    </a>
                </div>
            </div>
        </div>

    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <div class="my-0">
                <h4 class="mb-4 text-uppercase text-center">Foreign Professional Profile & Exam Code</h4>
                <?php echo $this->session->flashdata('message'); ?>
                <form action="#" id="personalFormsData" enctype="multipart/form-data" method="post">

                    <span id="form-error" class="w-100 p-1 text-center alert alert-danger" style="display: none;"></span>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" required>
                        <?php echo form_error('fname', '<div class="error">', '</div>'); ?>
                        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Middle Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname'); ?>" required>
                        <?php echo form_error('lname', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Last name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" required>
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>

                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Please select one</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
                            <!--<div id="gender_error"></div>-->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Birthday <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo set_value('birthday'); ?>">
                            <?php echo form_error('birthday', '<div class="error">', '</div>'); ?>
                            <!--<div id="birthday_error"></div>-->
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Profession <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="profession" id="profession" class="form-control">
                                <option value="">Please select one</option>
                                <?php foreach($profession as $value){ ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name;?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('profession', '<div class="error">', '</div>'); ?>
                            <!--<div id="profession_error"></div>-->
                        </div>
                    </div> 
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Exam Code <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="examination_code" name="examination_code" value="<?php echo set_value('examination_code'); ?>" required>
                            <?php echo form_error('examination_code', '<div class="error">', '</div>'); ?>
                            <!--<div id="examination_code_error"></div>-->
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-success text-uppercase" name="submit" value="" id="verifyDetails">Submit</button>
                        </div>
                    </div>
                </form>
               
            </div>
        </div>
    </div>

    <div id="loader"></div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content w-175">
                <div class="modal-header bg-primary text-center">
                    <h5 class="modal-title text-white text-uppercase" id="staticBackdropLabel">PROFESSIONAL PROFILE AND CODE VERIFIED</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">    
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="logo-box">
                        <img src="" id="dphoto" class="img-fluid">
                    </div>
                    
                    <div class="details-box">
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">First Name</label>
                        <div class="col-sm-8">
                            <div id="dfname"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Middle Name</label>
                        <div class="col-sm-8">
                            <div id="dlname"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Last name</label>
                        <div class="col-sm-8">
                            <div id="dname"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <div id="demail"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Birthday</label>
                        <div class="col-sm-8">
                            <div id="dbirthday"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Gender</label>          
                        <div class="col-sm-8">
                            <div id="dgender"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">University</label>          
                        <div class="col-sm-8">
                            <div id="duniversity"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">College of</label>          
                        <div class="col-sm-8">
                            <div id="dcollegeof"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Examination Code</label>
                        <div class="col-sm-8">
                            <div id="dexamination_code"></div>
                        </div>
                    </div>

                    <div id="body" class="col-md-12 mx-auto">
                        <div class="bs-example text-center">
                            <p class="mt-4">
                                <a href="#" id="grad-submit" class="btn btn-success text-uppercase" >Submit</a>
                                    <a href="#" class="btn btn-primary text-uppercase" onclick="closeMMpopup()">Edit</a>
                                    <a href="<?php echo base_url('license/contact_us')?>" class="btn btn-success text-uppercase">Contact Us</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profDataNotMatch" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Professional Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div id="body" class="col-md-8 mx-auto">
            <div class="bs-example">
                <p class="error" id="NotMatch">DATA DID NOT MATCH</p>
                <p class="error" id="PPerr"></p>
                <p>Please contact us to verify your status.</p>
                <p class="mt-4">
                    <a href="#" onclick="closePVpopup()" class="btn btn-info text-uppercase">Edit</a>
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

<script>
$("#verifyDetails").click(function(){  
        $.ajax({
            type:'post',
            url: '<?php echo base_url("professional/profexam/validateprof"); ?>',
            data: $('#personalFormsData').serialize(),
            dataType: 'json',
            cache: 'false',
            // beforeSend: function(xhr, settings) {
            //     $(".loding-main").show();
            // },
                
            success: function(result){    
                    // $(".loding-main").hide();
                    // var obj = JSON.parse(result)
                //  alert(result);
                    console.log(result);
                    if(result.error != undefined){
                        if(result.error.fname != undefined && result.error.fname != ""){
                            $('#fname_error').html(result.error.fname);
                        }
                        if(result.error.lname != undefined && result.error.lname != ""){
                            $('#lname_error').html(result.error.lname);
                        }
                        if(result.error.name != undefined && result.error.name != ""){
                            $('#name_error').html(result.error.name);
                        }
                        if(result.error.email != undefined && result.error.email != ""){
                            $('#email_error').html(result.error.email);
                        }
                        if(result.error.birthday != undefined && result.error.birthday !=""){
                            $('#birthday_error').html(result.error.birthday);
                        } 
                        if(result.error.gender != undefined && result.error.gender !=""){
                            $('#gender_error').html(result.error.gender);
                        } 
                        if(result.error.examination_code != undefined && result.error.examination_code !=""){
                            $('#examination_code_error').html(result.error.examination_code);
                        }
                    }
                    //debugger;
                    if(result.msg == '1'){  
                        // if(result.profdetails.length > 0){
                            if(result.profdetails.image !=""){
                                var studentimg = '<?php echo base_url("assets/uploads/profile/");?>'+result.profdetails.image;
                            }else{
                                var studentimg = '';
                            }
                            var url = '<?php echo base_url('professional/profexam/book_exam/'); ?>';  
                            $("#dphoto").attr("src",studentimg);
                            $('#dfname').html(result.profdetails.fname);
                            $('#dlname').html(result.profdetails.lname);
                            $('#dname').html(result.profdetails.name);
                            $('#demail').html(result.profdetails.email);
                            $('#dbirthday').html(result.profdetails.dob);
                            $('#dregistration').html(result.profdetails.registration_no);

                            if(result.profdetails.university!=0){
                            $('#duniversity').html(result.profdetails.university_name);
                            }else{
                            $('#duniversity').html(result.profdetails.other_university);
                            }
                            if(result.profdetails.college!=0){
                            $('#dcollegeof').html(result.profdetails.collegeofname);
                            }else{
                            $('#dcollegeof').html(result.profdetails.other_college);
                            }

                            $('#dgender').html(result.profdetails.gender);
                            $('#dprofessoion').html(result.profdetails.profession);
                            $('#dexamination_code').html(result.profdetails.exam_code);
                            // $("#grad-submit").attr("href",url+result.profdetails.user_ID);
                            $("#grad-submit").attr("href",url);
                            $('#staticBackdrop').modal('show'); 
                        }else{
                            // alert('Data not found.');
                            $('#NotMatch').hide();
                            if(result.error.fname != undefined && result.error.fname != ""){
                                $('#PPerr').html(result.error.fname);
                            }else if(result.error.lname != undefined && result.error.lname != ""){
                                $('#PPerr').html(result.error.lname);
                            }else if(result.error.name != undefined && result.error.name != ""){
                                $('#PPerr').html(result.error.name);
                            }else if(result.error.email != undefined && result.error.email != ""){
                                $('#PPerr').html(result.error.email);
                            }else if(result.error.gender != undefined && result.error.gender !=""){
                                $('#PPerr').html(result.error.gender);
                            }else if(result.error.birthday != undefined && result.error.birthday !=""){
                                $('#PPerr').html(result.error.birthday);
                            }else if(result.error.profession != undefined && result.error.profession !=""){
                                $('#PPerr').html(result.error.profession);
                            }else if(result.error.examination_code != undefined && result.error.examination_code !=""){
                                $('#PPerr').html(result.error.examination_code);
                            }else if(result.error.err != undefined && result.error.err !=""){
                                $('#NotMatch').show();
                                $('#PPerr').html(result.error.err);
                            }else{
                                $('#PPerr').html('');
                            }
                            $('#profDataNotMatch').modal('show'); 
                        }
                    // }
            } 
        });
});


function closeMMpopup(){
    $('#staticBackdrop').modal('hide'); 

}
function closePVpopup(){
    $('#profDataNotMatch').modal('hide'); 

}
</script>

    
<style type="text/css">
 .error{color:#ce2b2b}#loader{display:none;position:fixed;top:0;left:0;right:0;bottom:0;width:100%;background:rgba(0,0,0,.75) url('<?php echo base_url('assets/');?>images/loading.gif') no-repeat center center;z-index:10000}
</style>