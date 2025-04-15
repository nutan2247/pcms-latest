<div id="banner-grid" class="py-5 px-2 bg-red mb-5">

    <h2 class="text-center text-uppercase text-white">Professional License Renewal</h2>

</div>

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
                <span>2</span>
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

    <div class="col-md-8 mx-auto form-heigte">

        <div class="my-5">

              <h4 class="mb-4 mt-4 text-uppercase text-center">Upload Photo</h4> 

            <div class="required-box p-4 rounded mb-5">

                <?php echo $this->session->flashdata('error'); ?>

                <?php echo form_open_multipart(current_url(),array('id'=>'contact_form')); 
                        // $uid = $this->session->userdata('user_ID'); 
                        $uid = base64_decode($this->uri->segment(4)); 
                        ?>
                <div class="form-group row">
                    <input type="hidden" name="user_id" value="<?php echo $uid;?>">
                    <div class="col-sm-2">
                        <label for="inputEmail" class="col-form-label">Upload Photo</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="photo" name="photo" value="">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit">Upload</button>
                    </div>
                </div>
                <?php echo form_close(); ?>


            <?php if(isset($udetails)) { ?>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <img src="<?php echo base_url('assets/uploads/profile/').$udetails->image; ?>" id="usersPhoto" style="width:250px">
                    </div>
                </div>
                <?php
                if ($udetails->image!="") {  ?>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <!-- <button class="btn btn-primary upload_photo_next">Next</button> -->
                        <a href="<?php echo base_url('license/landing/required_units/').$this->uri->segment(4);?>" class="btn btn-primary text-uppercase">Next</a>
                    </div>
                </div>

                <?php } } else { ?>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <h4>Note</h4>
                        <table>
                            <tr>
                                <td>1.</td>
                                <td>&nbsp;&nbsp;Do not smile</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>&nbsp;&nbsp;White Color</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>&nbsp;&nbsp;Black and white background</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>&nbsp;&nbsp;Eyes hould not be vocered By hair</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>&nbsp;&nbsp;Hair should be clean cut</td>
                            </tr>

                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>





<!-------------------- POP MODAL ------------------------------------------------->









<!-- <div class="modal fade" id="thanku_pop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="thanku_pop" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thanku_pop"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">             
                <div id="body" class="col-md-8 mx-auto">
                    <div class="bs-example">
                        <p class="h4 mb-4 mt-4 text-uppercase">THANKU YOU</p>
                        <p class="error">Your profile photo is now updated</p>
                        <p class="mt-4">
                            <a href="<?php echo base_url('landing/required_units/?user_id='.$this->input->get('user_id'));?>"
                                class="btn btn-success text-uppercase">Proceed</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
            </div>

        </div>
    </div>
</div> -->



<script type="text/javascript">

    /*$(document).on("click", ".upload_photo_next", function () {



        $('#thanku_pop').modal('show');

    });*/

</script>