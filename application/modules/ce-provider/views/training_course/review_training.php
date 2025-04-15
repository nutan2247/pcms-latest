
<style type="text/css">
  
  .radio-class{
    width: 18px;
    height: 18px;
  }

#my-div {
    width: 1100px;
    height: 500px;
    overflow: hidden;
    position: relative;
}

#my-iframe {
    position: absolute;
    top: -300px;
    left: -1px;
    width: 1000px;
    height: 1000px;
}
</style>


    <?php echo $this->load->view('ce-provider/common/training_course_banner'); ?>

  <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP & Accreditaion Verification</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>2</strong>
                        </span>
                        <label>Accreditaion Documents</label>
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
                        <label>Verification of Documents</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Digital Accreditaion</label>-->
                        <label>Digital Certificate of Accreditaion</label>
                    </a>
                </div>
        </div>
    </div>


    <div class=" rounded mb-5">
        <div class="col-md-6 mx-auto text-left">
            <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?>
                <!-- <button class="btn btn-info float-right" data-target="#uploadTrainingModal" data-toggle="modal" >Upload Training </button> -->
            </h4>  
        </div>
    </div>
                  

           <?php //print_r($details); ?> 

        <div class="col-md-8 mx-auto">
            <?php if(!empty($details)){ ?>
            <p>Please select any one Training.</p>
            <?php } ?>
            <?php echo form_open_multipart('ce-provider/ce_provider/training_payment',array("id"=>"training_payment")); ?>
            <div class="table-responsive">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>S.no.</th>
                            <th>Training Title</th>
                            <th>Units</th>
                            <th>Price</th>
                            <th>Pdf</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($details)){ ?>
                    <?php $count = 1;
                        foreach($details as $key => $value){ ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $value->training_title; ?></td>
                            <td><?php echo $value->training_units; ?></td>
                            <td><?php echo $value->training_price; ?></td>
                                        <td><a href="javascript:void(0)" data-id="<?php echo $value->training_pdf; ?>" class="viewPdf">View training pdf</a></td>
                            <td><input type="radio" class="iframe_cclass" id="train_doc_id" name="train_doc_id" value="<?php echo $value->train_doc_id;?>" required> <i class="fa fa-arrow-left" aria-hidden="true"></i> Click to select</td>
                        </tr>
                    <?php $count++; } }else{ echo '<tr><td colspan="9">No Training Found!</td></tr>'; } ?>
                    </tbody>
                </table>
            </div>
            
                <div class="form-group row">
                    <div class="col-sm-9">
                        <input type="submit" class="btn btn-success" name="submit"  value="submit">
                    </div>
                </div>
                <?php echo form_close(); ?> 

        </div>

  <div class="modal fade r-board-modal" id="uploadTrainingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    UPLOAD YOUR TRAINING 
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('ce-provider/ce_provider/upload_training');?>
                       <div class="form-group row">
                           <label class="col-md-10">Training Title</label>
                           <input type="text" name="training_title" class="form-control" required>
                       </div>
                       <div class="form-group row">
                           <label class="col-md-10">Training Image</label>
                           <input type="file" name="training_image" class="form-control" accept="image/*" required>
                       </div>
                        <div class="form-group row">
                           <label class="col-md-10">Upload Training PDF</label>
                           <input type="file" name="training_pdf" class="form-control" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                       </div>
                       <div class="form-group row">
                           <label class="col-md-10">Training Units</label>
                           <input type="number" name="training_units" class="form-control" min="1" required>
                           <input type="hidden" name="provider_id" class="form-control" value="<?php echo $this->session->userdata('logincepacc')['user_ID']; ?>">
                       </div>
                       <div class="form-group row">
                           <label class="col-md-10">Training Price</label>
                           <input type="number" name="training_price" class="form-control" step=".01" required>
                       </div>

                        <div class="form-group row">
                            <div class="col-md-10 text-center">
                                <button class="btn btn-success text-uppercase proceed_to_second_step" type="submit"> Upload </button>
                            </div>
                        </div>
                    <?php echo form_open();?>

                </div>
            </div>
        </div>
    </div>


<!-- The Modal -->
<div class="modal" id="cepViewPdf">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Course</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <iframe src="" id="pdfsrc" frameborder="0" width="600" height="850"></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

    <script>
    $('.viewPdf').on('click',function(){
        var id = $(this).attr('data-id');
        var path = '<?php echo base_url('assets/images/ce_provider/'); ?>'+id;  
        $('#pdfsrc').attr('src',path);
        $('#cepViewPdf').modal('show');
    });
    
    
    /* $(document).ready(function(){
        $('.iframe_cclass').on('click',function(){
        var id = $('input[name=choose]:checked', '#training_payment').val();
        // alert(id);
        var path = 'https://www.ceonpoint.com/pages/training_details/'+id;
        $('#my-iframe').attr('src',path);
        });
    }); */

  </script>
    