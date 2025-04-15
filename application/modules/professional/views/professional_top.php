    <?php //echo '<pre>'; print_r($details);exit;
    
    if($this->session->userdata('candidate_type')=='p'){
    $logo = ($details->image !="" && file_exists('./assets/uploads/profile/'.$details->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$details->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/default-logo.png').'" width="200px" height="200px">';
    }else{
    $logo = ($details->image !="" && file_exists('./assets/images/graduates/'.$details->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/'.$details->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/default-logo.png').'" width="200px" height="200px">';
    } 
    $userid = $this->session->userdata('user_ID');
    $unreadnotifications= $this->applicant->get_unread_notifications($this->session->userdata('user_ID'));
    if(!empty($ecertificate)){
        $arrofunits = array_column($ecertificate, 'units');
        $sumofunits = array_sum($arrofunits);
    }else{
        $sumofunits = 0;
    }   

    $sumofcerticates = isset($ecertificate)?count($ecertificate):0; 
    
    if($details->status==1){    $current_status = 'Valid'; }
    elseif($details->status==2){ $current_status = 'Expired'; }
    elseif($details->status==3){ $current_status = 'Suspended'; }
    elseif($details->status==4){ $current_status = 'Revoked'; }
    else{ $current_status = 'Pending'; }

    if(isset($details->renew_lic_issue_date)){
        $issue_date = $details->renew_lic_issue_date;
    }else{
        $issue_date = $details->lic_issue_date;
    }
    if(isset($details->renew_lic_expiry_date)){
        $validity_date = $details->renew_lic_expiry_date;
    }
    else if($details->validity_date != '0000-00-00'){
        $validity_date = $details->validity_date;}
    else{
        $validity_date = date('Y-m-d');
        }
    ?>


    <section class="dashboard-heropanel jumbotron py-lg-5 py-3 border-bottom border-primary mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-2">
                        <?php echo $logo; ?>
                        <h5 class="mt-3"><?php echo ucwords($details->fullname);?></h5>
						<p><?php echo $details->profession_name;?></p>
                            <strong>Licence no: </strong><?php echo $details->license_no;?></br>
                            <strong>Date issued: </strong><?php echo date('F d, Y',strtotime($issue_date)); ?></br>
                            <strong>Validity: </strong><?php echo date('F d, Y',strtotime($validity_date));?></br>
                            <strong>License Status: </strong><?php echo $current_status;?></p>
                        
                            <button type="button"  title="License Card" class="btn btn-info upload-cert" data-id="<?=$doc->refrence_code; ?>"><i class="fa fa-credit-card" aria-hidden="true"></i></button>

						<?php  if(!$this->session->userdata('admin_login')){ ?>			
                            <a href="<?php echo base_url('professional/applicant/editprofile'); ?>" class="btn btn-info" title="edit profile"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-dark noticationcount" href="<?php echo base_url('professional/applicant/notification');?>"><i class="fa fa-bell"></i>
                            <span><?php echo count($unreadnotifications);?></span>
                            </a>
                            <!-- <div class="notificationbell">
                            </div> -->
						<?php } ?>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="min-height text-center d-inline-block w-100 text-white bg-info p-2 rounded">
                               <h4 class="pt-4"><?php echo $sumofunits; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Units</h6>
                      
                        </div>
                        <div class="col-lg-4">
                            <div class="min-height text-center d-inline-block w-100 text-white bg-info p-2 rounded">
                               <h4 class="pt-4"><?php echo $sumofcerticates; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Certificates</h6>
                        </div>

                        <div class="col-lg-4">
                            <div class="min-height text-center d-inline-block w-100 text-white bg-success p-2 rounded">
                                <h4 class="pt-2"><?php 
								// $validity_date = $details->accreditation_validity_date;
                                
                                
								$date1 = new DateTime($validity_date);
								$date2 = new DateTime(date('Y-m-d'));
								$interval = $date1->diff($date2);
								//print_r($interval);
								echo $interval->days;
								?></h4>
                                <span>Days Remaining</span>
                            </div>
                            <h6 class="py-3 text-center">License Status:
							<?php echo $current_status;  ?>                        
                            </h6>
							<?php if(!$this->session->userdata('admin_login')){ ?>
                            <?php if($interval->days > 1){ ?>
                            <!-- <a href="<?php echo base_url('professioanl/applicant/certificate');?>" ><button type="button" class="btn bg-secondary w-100">Download</button></a> -->
                            <?php } ?>
                            <?php } ?>

                            <?php // if($interval->days < 90){ ?>
                            <!-- <a href="<?php echo base_url('professional/applicant/renewprofessional');?>" ><button type="button" class="btn bg-warning w-100">Renew Application</button></a> -->
                           
                        </div>
                        <?php if($this->session->userdata('login')['role'] != 'admin'){ ?>
                        <div class="col-lg-12">
                        <a href="javascript:void(0);" class="upload-certificate"><button type="button" class="btn bg-danger w-100 text-white text-uppercase">Upload Certifcate</button></a>
                        </div>
                        <div class="col-lg-4 mt-2">
                        <a href="<?php echo base_url('license/landing/professional_license');?>" ><button type="button" class="btn bg-warning w-100 text-white text-uppercase">Application for <br />License Card Renewal</button></a> 
                        </div>
                        <div class="col-lg-4 mt-2">
                        <a href="<?php echo base_url('professional/applicant/verificationOfRegistration');?>" ><button type="button" class="btn bg-danger w-100 text-white text-uppercase">Request for Verification of Registration</button></a> 
                        </div>
                        <div class="col-lg-4 mt-2">
                        <a href="<?php echo base_url('professional/applicant/requestForGoodStanding');?>" ><button type="button" class="btn bg-primary w-100 text-white text-uppercase">Request for Certificate of Good Standing</button></a> 
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

</section>

<div class="modal certificate-modal" id= "certificate-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
                <div class="modal-body text-center">
                <!-- body -->
                <iframe src="" id="carddetials" frameborder="0" style="width:100%;height:100%;min-height:630px"></iframe>
                <!-- end body -->
                </div>
        </div>
    </div>
</div>	
   
<div class="modal" id="uploadCertificateModal">
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #6610f2">
                <h5 class="modal-title">Upload Certificate</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

              <form action="<?php echo base_url('professional/applicant/upload_certificate'); ?>" method="post" enctype="multipart/form-data" name="upload-cert" id="upload-cert">
                <div class="modal-body"> 
                    <p>
                        <label>Certificate No </label>
                        <input name="certi_no" value="" size="20" type="text" class="form-control">
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Course Title <span class="required text-danger"> * </span> </label>
                        <input name="course_name" value="" size="20" type="text" class="form-control" required="">
                        <span class="error"></span>
                    </p>
                    <p>
                        <label>Course Units <span class="required text-danger"> * </span> </label>
                        <input name="course_unit" value="" size="20" type="number" class="form-control" required="">
                        <span class="error"></span>
                    </p>

                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Date Issued <span class="required text-danger"> * </span> </label>
                                <input name="course_start_date" value="" type="date" class="form-control" required="">
                                <span class="error"></span>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <label>Category</label>
                                <select name="category" id="category1" class="form-control">
                                    <option value="" selected="">Please Select</option>
                                    <option value="general">General</option>
                                    <option value="specific">Specific</option>
                                </select>
                                <span class="error"></span>
                            </p>
                        </div>
                         <div class="col-md-6">
                            <p>
                                <label>Issued From<span class="required text-danger"> * </span> </label>
                                <select name="issue_from" id="issue_from" class="form-control" required="">
                                    <option value="" selected="">Please Select</option>
                                    <option value="Online Course">Online Course</option>
                                    <option value="Training">Training</option>
                                </select>
                                <span class="error"></span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <label>Issued By<span class="required text-danger"> * </span> </label>
                                <input name="issue_by" value="" type="text" class="form-control" required="">

                                <span class="error"></span>
                            </p>
                        </div>
                         <div class="col-md-6">
                             <p>
                        <label>Certificate <span class="required text-danger"> * </span> </label>
                        <input name="certificate" value="" size="20" type="file" class="form-control" required="">
                        <span class="error"></span>
                    </p>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input name="user_email" value="<?php echo $this->session->userdata('email'); ?>" type="hidden" class="form-control">
                    <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="uploadCardModal">
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #6610f2">
                <h5 class="modal-title">Upload Card</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

              <form action="<?php echo base_url('professional/applicant/upload_card'); ?>" method="post" enctype="multipart/form-data" name="upload-cert" id="upload-card">
              <div class="modal-body"> 
                    <p>
                        <label>Card No </label>
                        <input name="card_no" value="" size="20" type="text" class="form-control">
                        <span class="error"><?php echo  form_error('card_no'); ?></span>
                    </p>
                    <p>
                        <label>Card Name <span class="required text-danger"> * </span> </label>
                        <input name="card_name" value="" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('card_name'); ?></span>
                    </p>


                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Date Issued <span class="required text-danger"> * </span> </label>
                                <input name="date_issued" value="" size="20" type="date" class="form-control" required>
                                <span class="error"><?php echo  form_error('date_issued'); ?></span>
                            </p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Expiration Date <span class="required text-danger"> * </span> </label>
                                <input name="expiry_date" value="" size="20" type="date" class="form-control" required>
                                <span class="error"><?php echo  form_error('expiry_date'); ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Issue By (Name of company) <span class="required text-danger"> * </span> </label>
                                <input name="issue_by" value="" size="20" type="text" class="form-control " required>
                                <span class="error"><?php echo  form_error('issue_by'); ?></span>
                            </p>
                        </div>
                    </div>


                    <p>
                        <label>Upload Photo <span class="required text-danger"> * </span> </label>
                        <input name="photos" value="" size="20" type="file" class="form-control" required>
                        <span class="error"><?php echo  form_error('photos'); ?></span>
                    </p>



                    </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.upload-certificate').on('click', function(){
       $('#uploadCertificateModal').modal('show');
   });
    
    $('.upload-card').on('click', function(){
        $('#uploadCardModal').modal('show');
    });

    $('.upload-cert').on('click', function(){
        var licenseno = $(this).attr("data-id");
        if(licenseno){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ licenseno +"card.pdf";
        // alert(path);
            $('#carddetials').attr('src',path); 
            $('#certificate-modal').modal('show');
        }else{
            alert('No license number found !');
        }
    });
</script>