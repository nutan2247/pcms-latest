<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        
    <div id="banner-grid" class="py-5 px-2 bg-red online-red-banner mb-5"> 
        <div class="container">
            <h3 class="text-center text-uppercase text-white">Foreign Professional Review for Licensure Examination </h3>    
        </div>
    </div>   
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>1</strong>
                        </span>
                        <label>Foreign Professional Profile</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>2</strong>
                        </span>
                        <label>Upload Documents</label>
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
                        <label>Review of Documents</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Digital License</label>-->
                        <label>Examination Code</label>
                    </a>
                </div>
            </div>
    </div>

    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto form-heigte">
            <div class="my-0">
                <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>
                <?php echo $this->session->flashdata('message'); ?>
                <!--  id="personalFormsData" -->
                <form action="<?php echo base_url('professional/profexam/add_application'); ?>" enctype="multipart/form-data" method="post">

                    <span id="form-error" class="w-100 p-1 text-center alert alert-danger" style="display: none;"></span>
                    <h5 class="text-uppercase p-2 text-center mb-4">I.personal information</h5>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo isset($details->fname)?$details->fname:''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Middle Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo isset($details->lname)?$details->lname:''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($details->name)?$details->name:''; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Citizenship <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="citizenship" id="citizenship" class="form-control" required>
                                <option value="" selected>Please select one</option>
                                <?php foreach($countries as $key => $value){ ?>
                                <option value="<?=$value->countries_id;?>" ><?=$value->countries_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($details->email)?$details->email:''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Birthday <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo isset($details->dob)?$details->dob:''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Please select one</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Upload Photo<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="photo" name="photo" value="" accept="image/*" required>
                        </div>
                    </div>

                    <h5 class="text-uppercase p-2 text-center mb-3">II.Professional information</h5>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Profession <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="profession" id="profession" class="form-control" required>
                                <option value="">Please select one</option>
                                <?php foreach($profession as $value){ ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">License Number <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="license_no" name="license_no" value="<?php echo isset($details->license_no)?$details->license_no:''; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date Issued <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="license_issued_date" name="license_issued_date" value="<?php echo isset($details->license_issued_date)?$details->license_issued_date:''; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">License Validity Date <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="" id="validityselect" class="form-control" required>
                                <option value="">Please select one</option>
                                <option value="1">Validity Date</option>
                                <option value="2">LifeTime</option>
                            </select>
                            <!--<input type="date" class="form-control" id="license_validity_date" name="license_validity_date" value="<?php echo isset($details->license_validity_date)?$details->license_validity_date:''; ?>" required>-->
                        </div>
                    </div>
                    <div class="form-group row" id="validitydate">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="license_validity_date" name="license_validity_date" value="<?php echo isset($details->license_validity_date)?$details->license_validity_date:''; ?>" required>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('#validitydate').hide();
                            $("#validityselect").change(function(){
                                var option = $("#validityselect").val();
                                if(option == 1){
                                    $('#license_validity_date').val('');
                                    $('#validitydate').show();
                                }
                                if(option == 2){
                                    $('#validitydate').hide();
                                    $('#license_validity_date').val('9999-09-09');
                                }
                            });
                        });
                    </script>
                    <!-- <hr> -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Professional Regulatory Board <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="reg_board" name="reg_board" value="<?php echo isset($details->reg_board)?$details->reg_board:''; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Country <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="reg_country" id="reg_country" class="form-control" required>
                                <option value="" selected>Please select one</option>
                                <?php foreach($countries as $key => $value){ ?>
                                <option value="<?=$value->countries_id;?>" ><?=$value->countries_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="reg_address" name="reg_address"><?php echo isset($details->reg_address)?$details->reg_address:''; ?></textarea required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email<span class="text-danger"></span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="reg_email" name="reg_email" value="<?php echo isset($details->reg_email)?$details->reg_email:''; ?>" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Website<span class="text-danger"></span></label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" id="reg_website" name="reg_website" placeholder="https://" value="<?php echo isset($details->reg_website)?$details->reg_website:''; ?>">
                        </div>
                    </div>

                    <h5 class="text-uppercase p-2 text-center mb-3">III.educational background</h5>
                  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">University Name<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="university" name="university" onchange="getValue(this);" required>
                            <option>Please select any one</option>    
                            <?php foreach($university as $value){ ?>
                                <option value="<?php echo $value->uniid; ?>"><?php echo $value->university_name;?></option>
                            <?php } ?>
                                <option value="0">Other University</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="display:none;" id="other_university">
                        <label class="col-sm-2 col-form-label">Other University Name<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prof_university_name" name="other_university" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">College Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="college_of" name="college_of" onchange="getCollegeValue(this);" required>
                            <option>Please select any one</option>    
                            <?php foreach($profession as $value){ ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name;?></option>
                            <?php } ?>
                            <option value="0">Other College Name</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row" style="display:none;" id="other_college">
                        <label class="col-sm-2 col-form-label">Other College<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prof_college_name" name="other_college" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="university_address" name="university_address" required><?php echo isset($details->university_address)?$details->university_address:''; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email.<span class="text-danger"></span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="university_email" name="university_email" value="<?php echo isset($details->university_email)?$details->university_email:''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Contact No.<span class="text-danger"></span></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="university_contact" name="university_contact"
                                pattern="[1-9]{1}[0-9]{9}" value="<?php echo isset($details->university_contact)?$details->university_contact:''; ?>" min="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Website<span class="text-danger"></span></label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" id="university_website" name="university_website" placeholder="https://" value="<?php echo isset($details->university_website)?$details->university_website:''; ?>">
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <!-- <button type="button" class="btn btn-success text-uppercase" name="submit" value="" id="verifyDetails">Submit</button> -->
                            <button type="submit" class="btn btn-success text-uppercase" name="submit">Submit</button>
                        </div>
                    </div>

                </form>
               
            </div>
        </div>
    </div>
    <div id="loader"></div>

    <div class="modal fade show" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" style="padding-right: 17px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style=" background: #315594;  border-radius: 0; color: #fff;">
                    <h5 class="modal-title" id="staticBackdropLabel">Personal and Professional Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modalid">
                    <p class="text-center"><strong> Please verify your details below</strong></p>
                    
                   <ul class="personal-info">
                        <li><strong>Profile photo :</strong> <span ><img style="width: 150px; height: 160px;" id="uphoto" src="#" alt="your image" /></span></li>
                        <li><strong>First Name :</strong> <span id="ufname"></span></li>
                        <li><strong>Middle Name :</strong> <span id="ulname"></span></li>
                        <li><strong>Last name :</strong> <span id="uname"></span></li>
                        <li><strong>Citizenship :</strong> <span id="ucitizenship"></span></li>
                        <li><strong>Email :</strong> <span id="uemail"></span></li>
                        <li><strong>Birthday  :</strong> <span id="udob"></span></li>
                        <li><strong>Gender :</strong> <span id="ugender"></span></li>
                        <li><strong>Profession :</strong> <span id="uprofession"></span></li>
                        <li><strong>License Number :</strong> <span id="ulicense_no"></span></li>
                        <li><strong>Issued Date :</strong> <span id="ulicense_issued_date"></span></li>
                        <li><strong>Validity Date :</strong> <span id="ulicense_validity_date"></span></li>
                   </ul>
                   <ul class="personal-info">
                        <li><strong>University name :</strong> <span id="uuniversity"></span></li>
                        <li><strong>College of :</strong> <span id="ucollege"></span></li>
                        <li><strong>Address :</strong> <span id="uuaddress"></span></li>
                        <li><strong>Email :</strong> <span id="uuemail"></span></li>
                        <li><strong>Contact Number :</strong> <span id="uucontact"></span></li>
                        <li><strong>Website :</strong> <span id="uuwebsite"></span></li>
                   </ul>
                   <ul class="personal-info">
                        <li><strong>Regularity Board :</strong><span id="uregboard"></span></li>
                        <li><strong>Country :</strong><span id="uregcountry"></span></li>
                        <li><strong>Address :</strong><span id="uregaddress"></span></li>
                        <li><strong>Email :</strong><span id="uregemail"></span></li>
                        <li><strong>Website :</strong><span id="uregwebsite"></span></li>
                   </ul>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-info text-uppercase" id="submitFormPersonal">Confirm</button>
                    <a href="#" class="btn btn-primary text-uppercase" onclick="hidepopup()">Edit</a>
                    <a href="#" id="prof_contact_us" class="btn btn-success text-uppercase">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade personal-info-modal" id="successModal" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
            </div>
            <div class="modal-body suc-full">
                <div class="text-center text-success">
                    <i class="fa fa-check-circle"></i>
                    <p>Personal Information</p>
                </div>
                <h4 class="text-uppercase text-center my-md-3">Step 1 <br>Successfully Done</h4>
                <h3 class="text-uppercase text-center text-danger" id="result_message" ></h3>
                <div class="modal-footer justify-content-center">
                    <a href="#" id="next_page_link" class="btn btn-success text-uppercase">next</a>
                </div>
            </div>
           
            </div>
        </div>
    </div>

<script>

    $( document ).ready(function() {
        $("#submitFormPersonal").click(function() {
            var spinner = $('#loader');
            var frm = $('#personalFormsData');
            var formData = new FormData(frm[0]);
            formData.append('file', $('input[type=file]')[0].files[0]);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>professional/profexam/add_application",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(".loding-main").show();
                },
                success: function(result) {
                    $(".loding-main").hide();
                    // alert(result)
                    var obj = JSON.parse(result);
                    console.log(obj);

                    if(obj.success==true){
                        var src = "<?php echo base_url();?>professional/profexam/upload_documents/";
                        // $('#result_message').html(obj.message);
                        // $('#next_page_link').attr('href',src);
                        // $('#successModal').modal('show');
                        window.location.href = src;
                    }else{
                        alert(obj.message);
                    }
                }
            });

        });

    });

  
    function getMaxDate() {
        var millisecondsIn18years = 568080000000;
        var ceil = new Date(Date.now() - millisecondsIn18years);
        var date = ceil.getDate();
        var month = String(ceil.getMonth() + 1);
        month = month.length > 1 ? month : '0' + month;
        var year = ceil.getFullYear();
        return year + '-' + month + '-'  + date;
    }
    document.getElementById('birthday').max = getMaxDate();
    
    function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( $email );
    }       

    $(document).on("click","#verifyDetails",function(){
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var name = $('#name').val();
        var citizenship = $('#citizenship').val();
        var email = $('#email').val();
        var dob = $('#birthday').val();
        var gender = $('#gender').val();
        var profession = $( "#profession option:selected" ).text();
        // var profession = $('#profession').val();
        var license_no = $('#license_no').val();
        var license_issued_date = $('#license_issued_date').val();
        var license_validity_date = $('#license_validity_date').val();

        if($('#university').val() > 0){
        var university = $( "#university option:selected" ).text();
        }else{
        var university  = $('#prof_university_name').val(); 
        }

        if($('#college_of').val() > 0){
        var college_of = $( "#college_of option:selected" ).text();
        }else{
        var college_of  = $('#prof_college_name').val(); 
        }
        
        var university_address = $('#university_address').val();
        var university_email = $('#university_email').val();
        var university_contact = $('#university_contact').val();
        var university_website = $('#university_website').val();
        var reg_board = $('#reg_board').val();
        var reg_country = $( "#reg_country option:selected" ).text();
        // var reg_country = $('#reg_country').val();
        var reg_address = $('#reg_address').val();
        var reg_email = $('#reg_email').val();
        var reg_website = $('#reg_website').val();
        var photo = $('#photo').val();
        if(fname==''|| name==''){
            $('#form-error').css('display','block').html('Name can\'t be blank');
            return false;
        }
        if(citizenship==''){
            $('#form-error').css('display','block').html('Citizenship can\'t be blank');
            return false;
        }
        if(email==''){
            $('#form-error').css('display','block').html('User email can\'t be blank');
            return false;
        }
        if(email!=''){
            if(!validateEmail(email)) {
                $('#form-error').css('display','block').html('Invalid username (email)');
            return false;
            } 
        }
        if(dob==''){
            $('#form-error').css('display','block').html('Date of Birth can\'t be blank');
            return false;
        }
        if(gender==''){
            $('#form-error').css('display','block').html('Gender can\'t be blank');
            return false;
        }
        if(profession==''){
            $('#form-error').css('display','block').html('Profession can\'t be blank');
            return false;
        }
        if(license_no==''){
            $('#form-error').css('display','block').html('License Number can\'t be blank');
            return false;
        }
        if(license_issued_date==''){
            $('#form-error').css('display','block').html('License Issued Date can\'t be blank');
            return false;
        }
        if(license_validity_date==''){
            $('#form-error').css('display','block').html('License Validity Date can\'t be blank');
            return false;
        }
        if(photo==''){
            $('#form-error').css('display','block').html('Photo can\'t be blank');
            return false;
        }
        if(university==''){
            $('#form-error').css('display','block').html('University can\'t be blank');
            return false;
        }

        if(college_of==''){
            $('#form-error').css('display','block').html('College can\'t be blank');
            return false;
        }
        if(university_address==''){
            $('#form-error').css('display','block').html('University address can\'t be blank');
            return false;
        }

        //if(university_email==''){
        //    $('#form-error').css('display','block').html('email can\'t be blank');
        //    return false;
        //}

        //if(university_email!=''){
        //    if(!validateEmail(university_email)) {
        //        $('#form-error').css('display','block').html('Invalid University email');
        //    return false;
        //    } 
        //}
        //if(university_contact==''){
        //    $('#form-error').css('display','block').html('University contact can\'t be blank');
        //    return false;
        //}
        //if(university_website==''){
        //    $('#form-error').css('display','block').html('University website can\'t be blank');
        //    return false;
        //}
        if(reg_board==''){
            $('#form-error').css('display','block').html('Regularity board name can\'t be blank');
            return false;
        }
        if(reg_country==''){
            $('#form-error').css('display','block').html('Regularity board country can\'t be blank');
            return false;
        }
        if(reg_address==''){
            $('#form-error').css('display','block').html('Regularity board address can\'t be blank');
            return false;
        }
        //if(reg_email==''){
        //    $('#form-error').css('display','block').html('Regularity board email can\'t be blank');
        //    return false;
        //}
        //if(reg_website==''){
        //    $('#form-error').css('display','block').html('Regularity board website can\'t be blank');
        //    return false;
        //}
        $('#ufname').html(fname);
        $('#ulname').html(lname);
        $('#uname').html(name);
        $('#ucitizenship').html(citizenship);
        $('#uemail').html(email);
        $('#udob').html(dob);
        $('#ugender').html(gender);
        $('#uprofession').html(profession);
        $('#ulicense_no').html(license_no);
        $('#ulicense_issued_date').html(license_issued_date);
        $('#ulicense_validity_date').html(license_validity_date);

        $('#uuemail').html(university_email);
        $('#uuniversity').html(university);
        $('#ucollege').html(college_of);
        $('#uuaddress').html(university_address);
        $('#uucontact').html(university_contact);
        $('#uuwebsite').html(university_website);
        $('#uregboard').html(reg_board);
        $('#uregcountry').html(reg_country);
        $('#uregaddress').html(reg_address);
        $('#uregemail').html(reg_email);
        $('#uregwebsite').html(reg_website);
        var path = "<?php echo base_url('license/contact_us?'); ?>";
        var url = path+'name='+name+'&&email='+email;
        $('#prof_contact_us').attr('href',url);
        $('#staticBackdrop').modal('show');
    });


    $("#photo").change(function(){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uphoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function goToUploadDocuments(uid){
        window.location.href="<?php echo base_url();?>professional/profexam/upload_documents/"+uid;
    }

    function hidepopup(){
        $('#staticBackdrop').modal('hide');
    }

    
    function getValue(myuniversity){
        currentValue = myuniversity.value;
        if(currentValue > 0){
	    	$('#other_university').hide();
	    }else{
	    	$('#other_university').show();
        }
    }
    
    function getCollegeValue(mycollege){
        currentcoValue = mycollege.value;
        if(currentcoValue > 0){
	    	$('#other_college').hide();
	    }else{
	    	$('#other_college').show();
        }
    }
</script>