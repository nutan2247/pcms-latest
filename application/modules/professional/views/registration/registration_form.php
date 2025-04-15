<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('professional/include/registration_banner'); ?>

<div class="container mb-5">
    <div class="row pro-steps">
        <div class="col-4">
            <a href="javascript:void(0);" class="stepProcess">
                <span>
                    <strong>1</strong>
                </span>
                <label>Professional Information <br>and Registration Code</label>
            </a>
        </div>
        <div class="col-4">
            <a href="javascript:void(0);">
                <span>
                    <strong>2</strong>
                </span>
                <label>Payment</label>
            </a>
        </div>
        <div class="col-4">
            <a href="javascript:void(0);">
                <span>
                    <strong>3</strong>
                </span>
                <label>Registration Certificate and <br>Professional Identification Card</label>
            </a>
        </div>
    </div>
</div>

<div class="bg-light py-4">
    <div class="col-md-8 mx-auto">
        <div class="my-0">
            <h4 class="mb-4 text-uppercase text-center">
                <?php echo $title; ?>
            </h4>
            <?php echo $this->session->flashdata('message'); ?>
            <form action="<?php echo current_url(); ?>" id="personalFormsData" enctype="multipart/form-data"
                method="post">

                <span id="form-error" class="w-100 p-1 text-center alert alert-danger" style="display: none;"></span>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" value="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Middle Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name="lname" value="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Birthday <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="birthday" name="birthday" value="">
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
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Registration Code<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="registration_code" name="registration_code" value=""
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success text-uppercase" name="submit" value=""
                            id="verifyDetails">Submit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


<div id="loader"></div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content w-175">
            <div class="modal-header bg-warning text-center">
                <h2 class="modal-title text-white text-uppercase" id="staticBackdropLabel">DATA MATCHED
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header bg-primary text-center">
                <!--<h5 class="modal-title text-white text-uppercase" id="staticBackdropLabel">PROFESSIONAL PROFILE AND <span style="color:red;">REGISTRATION</span> CODE <span style="color:red;">VERIFIED</span>
                </h5>-->
                <h5 class="modal-title text-white text-uppercase" id="staticBackdropLabel">PROFESSIONAL PROFILE AND REGISTRATION CODE</h5>
            </div>
            <div class="modal-body">
                <div class="logo-box">
                    <img src="" id="dphoto" class="img-fluid">
                </div>

                <div class="details-box border border-right-0 border-left-0 border-bottom-0 px-3 pt-3">
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">First Name</label>
                        <div class="col-sm-8">
                            <div id="dfname"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Middle Name</label>
                        <div class="col-sm-8">
                            <div id="dlname"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Last name</label>
                        <div class="col-sm-8">
                            <div id="dname"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <div id="demail"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Birthday</label>
                        <div class="col-sm-8">
                            <div id="dbirthday"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Gender</label>
                        <div class="col-sm-8">
                            <div id="dgender"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Country</label>
                        <div class="col-sm-8">
                            <div id="dcountry"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <div id="daddress"></div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">University</label>
                        <div class="col-sm-8">
                            <div id="duniversity"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Course</label>
                        <div class="col-sm-8">
                            <div id="dcollegeof"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Date Graduated</label>
                        <div class="col-sm-8">
                            <div id="ddategra"></div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Registration Number</label>
                        <div class="col-sm-8">
                            <div id="drefrence_code"></div>
                        </div>
                    </div>



                    <div id="body" class="col-md-12 mx-auto">
                        <div class="bs-example text-center">
                            <p class="mt-4">
                                <a href="#" id="grad-submit" class="btn btn-success text-uppercase">Confirm</a>
                                <!--<a href="#" class="btn btn-primary text-uppercase" onclick="hidepopup()">Edit</a>
                                <a href="#" id="prof_contact_us" class="btn btn-success text-uppercase">Contact Us</a>-->
                            </p>
                        </div>
                    </div>

                </div>
                <!-- <div class="modal-footer">

                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profDataNotMatch" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <p class="error">DATA DID NOT MATCH</p>
                        <p>Please contact us to verify your status.</p>
                        <p class="mt-4">
                            <a href="<?php echo base_url('license/contact_us')?>"
                                class="btn btn-success text-uppercase">Contact Us</a>
                            <a href="#" onclick="closeMMpopup()" class="btn btn-info text-uppercase">Edit</a>
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
    $("#verifyDetails").click(function () {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url("professional/applicant/matchdata"); ?>',
            data: $('#personalFormsData').serialize(),
            dataType: 'json',
            cache: 'false',
            beforeSend: function (xhr, settings) {
                $(".loding-main").show();
            },

            success: function (result) {
                $(".loding-main").hide();
                // alert(result);
                console.log(result);
                if (result.error != undefined) {
                    if (result.error.fname != undefined && result.error.fname != "") {
                        $('#fname_error').html(result.error.fname);
                    }
                    if (result.error.lname != undefined && result.error.lname != "") {
                        $('#lname_error').html(result.error.lname);
                    }
                    if (result.error.name != undefined && result.error.name != "") {
                        $('#name_error').html(result.error.name);
                    }
                    if (result.error.email != undefined && result.error.email != "") {
                        $('#email_error').html(result.error.email);
                    }
                    if (result.error.birthday != undefined && result.error.birthday != "") {
                        $('#birthday_error').html(result.error.birthday);
                    }
                    if (result.error.gender != undefined && result.error.gender != "") {
                        $('#gender_error').html(result.error.gender);
                    }
                    if (result.error.examination_code != undefined && result.error.examination_code != "") {
                        $('#examination_code_error').html(result.error.examination_code);
                    }
                }
                //debugger;
                if (result.msg == '1') {
                    if (result.profdetails.role != "" && result.profdetails.role != undefined) {
                        var studentimg = '<?php echo base_url("assets/uploads/profile/");?>' + result.profdetails.image;
                    } else {
                        var studentimg = '<?php echo base_url("assets/images/graduates/");?>' + result.profdetails.photo;
                    }
                    var url = '<?php echo base_url('professional/applicant/registration_payment/'); ?>';
                    $("#dphoto").attr("src", studentimg);
                    $('#dfname').html(result.profdetails.fname);
                    $('#dlname').html(result.profdetails.lname);
                    $('#dname').html(result.profdetails.name);
                    $('#demail').html(result.profdetails.email);
                    $('#dbirthday').html(result.profdetails.dob);
                    if(result.profdetails.university > 0){
                    $('#duniversity').html(result.profdetails.university_name);
                    }else{
                    $('#duniversity').html(result.profdetails.other_university);
                    }

                    if(result.profdetails.college > 0){
                    $('#dcollegeof').html(result.profdetails.collegeofname);
                    }else{
                    $('#dcollegeof').html(result.profdetails.other_college);
                    }
                    $('#ddategra').html(result.profdetails.date_of_grauate);
                    $('#dgender').html(result.profdetails.gender);
                    if(result.profdetails.country > 0){
                        $('#dcountry').html(result.profdetails.countries_name);
                    }
                    $('#daddress').html(result.profdetails.address);
                    $('#drefrence_code').html(result.profdetails.registration_no);
                    $("#grad-submit").attr("href", url + result.profdetails.user_ID);
                    $('#staticBackdrop').modal('show');
                 } else if(result.msg == '2') {
                        alert('This user is already registered in our system.');
                 } else {
                    // alert('Data not found.');
                    $('#profDataNotMatch').modal('show');
                }
                // }
            }
        });
    });

    function hidepopup() {
        $('#staticBackdrop').modal('hide');
    }
    function closeMMpopup() {
        $('#profDataNotMatch').modal('hide');
    }
</script>