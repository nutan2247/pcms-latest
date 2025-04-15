<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        
    <div id="banner-grid" class="py-5 px-2 bg-red online-red-banner mb-5"> 
        <div class="container">
            <h3 class="text-center text-uppercase text-white">Foreign Professional Review for Licensure Examination </h3>    
        </div>
    </div>   
     
    <?php $prof_id = $this->session->userdata('prof_id'); ?>
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Foreign Professional Profile</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
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
        <div class="col-md-8 mx-auto">

            <div class="my-0">
                <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>

            <div class="required-box p-4 rounded mb-5">

                <?php echo $this->session->flashdata('error'); ?>

                <?php echo form_open_multipart('professional/profexam/add_documents',array('id'=>'contact_form')); 
                    $validity=date('Y-m-d',strtotime(date('Y-m-d') . ' + 1 year'));               
                ?>
                
                <div class="form-group row">
                    <input type="hidden" name="expiry_at" value="<?php echo $validity;?>">
                    <!-- <input type="hidden" name="user_id" value="<?php echo $this->input->get('user_id');?>"> -->
                    <input type="hidden" name="user_id" value="<?php echo $prof_id;?>">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Diploma :</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="diploma" name="diploma" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Official Transcript of Records :</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="ot_record" name="ot_record" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Character Reference  :</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="charecter" name="charecter" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Professional Reference 1:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="p_reference1" name="p_reference1" value="" required>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Professional Reference 2:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="p_reference2" name="p_reference2" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Medical Certificate  :</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="medical" name="medical" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Police Certificate:</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="police_certificate" name="police_certificate" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="inputEmail" class="col-form-label">Passport ID :</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="passport" name="passport" value="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 offset-sm-4">
                        <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>












<script type="text/javascript">

    /*$(document).on("click", ".upload_photo_next", function () {



        $('#thanku_pop').modal('show');

    });*/

</script>