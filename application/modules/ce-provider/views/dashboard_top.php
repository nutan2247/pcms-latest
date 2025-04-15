 <style>
     .multiselect-container {
        height: 350px;
        overflow-y: scroll;
    }
 </style>
 <section class="dashboard-heropanel jumbotron py-lg-5 py-3 border-bottom border-primary mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-2">
                        <img class="img-fluid img-rounded d-block mx-auto" width="200px" height="200px" src="<?php echo base_url('assets/images/ce_provider/').$user_details->company_logo; ?>" alt="">
                        <h5 class="mt-3"><?php echo $user_details->business_name; ?></h5>
                         <p><strong>Accrediation no: </strong><?php echo (isset($countdown->accreditation_no))?$countdown->accreditation_no:'not issued'; ?><br>
                         <strong>Validity Date: </strong><?php echo date('F d Y',strtotime($countdown->expiry_at))?></p>
                         <a href="javascript:void(0)" onclick="viewCertificate('<?php echo $countdown->reference_no; ?>')" class="btn btn-info" title="Certificate"><i class="fa fa-certificate"></i></a>
                         <a href="<?php echo base_url('ce-provider/ce_provider/notification'); ?>" class="btn btn-info" title="Notification"><i class="fa fa-bell"></i></a>
                    </div>
                </div>
                <?php //print_r($countdown);
                    $profession_list = $this->provider->get_profession_list();
                    $newdate = strtotime ( '0 day' , strtotime ( $countdown->expiry_at ) ) ;
                    $ndate = date ( 'Y-m-j' ,  $newdate);
  
                    $date1 = new DateTime($ndate);
                    $date2 = new DateTime(date('Y-m-d'));
                    $interval = $date1->diff($date2);?>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo $count_course; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Online Courses</h6>
                            <a href="<?php echo base_url('ce-provider/ce_provider/course_application'); ?>" class="btn btn-info bg-success w-100" id="online-course-app">Apply for Online Course Accreditation</a>
                            <button class="btn btn-info w-100 mt-1" data-target="#uploadCourseModal" data-toggle="modal">Upload Online Course File</button>
                        </div>
                        
                        <div class="col-lg-4">
                        <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo $count_training; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Training Courses</h6>
                            <a href="<?php echo base_url('ce-provider/ce_provider/training_application'); ?>" class="btn btn-info bg-success w-100" id="training-course-appp">Apply for Training Course Accreditation</a>
                            <button class="btn btn-info w-100 mt-1" data-target="#uploadTrainingModal" data-toggle="modal">Upload Training Course File</button>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center d-inline-block w-100 h-50 text-white bg-secondary p-2 rounded">
                                <h4 class="pt-2"><?php echo $interval->days; ?></h4>
                                <span>Days Remaining</span>
                            </div>
                            <h6 class="py-3 text-center">Accreditation Status:Valid</h6>
                            <a href="<?php echo base_url('ce-provider/ce_provider/cep_renewal') ?>"><button type="button" class="btn btn-info bg-secondary w-100">Renew Accreditation</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upload couse Modal -->
    <div class="modal fade r-board-modal" id="uploadCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    UPLOAD YOUR COURSE 
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('ce-provider/ce_provider/upload_course',['id'=>'addcourse','name'=>'addcourseacc']);?>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course Title</label>
                           <input type="text" name="course_title" class="form-control" required>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course Image</label>
                           <input type="file" name="course_image" class="form-control"  accept="image/*">
                       </div>
                        <div class="form-group row px-3">
                           <label class="col-md-10">Upload Course PDF</label>
                           <input type="file" name="course_pdf" class="form-control" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                           <input type="hidden" name="provider_id" class="form-control" value="<?php echo $this->session->userdata('logincepacc')['user_ID']; ?>">
                           <!-- <input type="hidden" name="category" class="form-control" value=""> -->
                       </div>
                       <!-- <div class="form-group row px-3">
                           <label class="col-md-10">Course Units</label>
                           <input type="number" name="course_units" class="form-control" min="1" required>
                           CEP Profession Become course category
                       </div> -->
                       <div class="form-group row px-3">
                           <label class="col-md-10">Profession <sup>(Who can take this course?)</sup></label>
                           <select name="profession[]" id="professionc" class="form-control" multiple>
                                <!-- <option>Please select profession</option> -->
                                <?php foreach($profession_list as $profession){ ?>
                                <option value="<?php echo $profession->id; ?>"><?php echo $profession->name; ?></option>
                                <?php } ?>
                           </select>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course Short Description</label>
                           <textarea name="description" class = "form-control"  required></textarea>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course price</label>
                           <input type="number" name="course_price" class="form-control" step=".01" required>
                       </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 text-right">
                                <button class="btn btn-success text-uppercase proceed_to_second_step" type="submit"> Submit </button>
                            </div>
                            <div class="col-md-6 text-left">
                                <button class="btn btn-primary text-uppercase" onclick="close_ce_popup('uploadCourseModal')"> Close </button>
                            </div>
                        </div>
                    <?php echo form_close();?>

                </div>
            </div>
        </div>
    </div>

    <!-- Upload training Modal -->
    <div class="modal fade r-board-modal" id="uploadTrainingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    UPLOAD YOUR TRAINING 
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('ce-provider/ce_provider/upload_training',['id'=>'addtraining','name'=>'addtrainingacc']);?>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Title</label>
                           <input type="text" name="training_title" class="form-control" required>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Image</label>
                           <input type="file" name="training_image" class="form-control" accept="image/*" required>
                       </div>
                        <div class="form-group row px-3">
                           <label class="col-md-10">Upload Training PDF</label>
                           <input type="file" name="training_pdf" class="form-control" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                           <input type="hidden" name="provider_id" class="form-control" value="<?php echo $this->session->userdata('logincepacc')['user_ID']; ?>">
                           <!-- <input type="hidden" name="category" class="form-control" value=""> -->
                       </div>

                       <!-- <div class="form-group row px-3">
                           <label class="col-md-10">Training Units</label>
                           <input type="number" name="training_units" class="form-control" min="1" required>
                       </div> -->
                     
                       <div class="form-group row px-3">
                           <label class="col-md-10">Profession <sup>(Who read this course)</sup></label>
                           <select name="profession[]" id="profession" class="form-control" multiple>
                                <!-- <option>Please select profession</option> -->
                                <?php foreach($profession_list as $profession){ ?>
                                <option value="<?php echo $profession->id; ?>"><?php echo $profession->name; ?></option>
                                <?php } ?>
                           </select>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Short Description</label>
                           <textarea name="description" class = "form-control"  required></textarea>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Price</label>
                           <input type="number" name="training_price" class="form-control" step=".01" required>
                       </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 text-right">
                                <button class="btn btn-success text-uppercase proceed_to_second_step" type="submit"> Submit </button>
                            </div>
                            <div class="col-md-6 text-left">
                                <button class="btn btn-primary text-uppercase" onclick="close_ce_popup('uploadTrainingModal')"> Close </button>
                            </div>
                        </div>
                    <?php echo form_close();?>

                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="viewCertificateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Cerificate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>
                <iframe src="" id="viewcertificateContent" frameborder="0" width="770" height="850"></iframe>
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <style>
        button.multiselect {           
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

        }
    </style>
<script>
      $(document).ready(function() {
            $('#profession').multiselect();
            $('#professionc').multiselect();
        });
        function viewCertificate(cepacc_no){
            if(cepacc_no!=""){
                // alert(cepacc_no);
                var path = "<?php echo base_url('assets/uploads/pdf/') ?>"+ cepacc_no +".pdf";
                $('#viewcertificateContent').attr('src',path);
                $('#viewCertificateModal').modal('show');
            }else{
                alert('Accriditation Certificate is not yet issued!');
            }
        }

        function close_ce_popup(idofmodel){
            if(idofmodel) {
                $('#'+idofmodel+'').modal('hide');  //To hide
            }
        }
      
    </script>