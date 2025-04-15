
<style type="text/css">
  .radio-class{width:18px;height:18px}#my-div{width:1100px;height:500px;overflow:hidden;position:relative}#my-iframe{position:absolute;top:-300px;left:-1px;width:1000px;height:1000px}
</style>

    <?php echo $this->load->view('ce-provider/common/online_course_banner'); ?>
  <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>2</strong>
                        </span>
                        <label>Online Course File</label>
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
                        <label>Review of Online Course</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Certificate of Accreditation</label>-->
                        <label>Digital Certificate of Accreditation</label>
                    </a>
                </div>
        </div>
    </div>


    <div class=" rounded mb-5">
        <div class="col-md-6 mx-auto text-left">
            <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?>
                <!-- <button class="btn btn-info float-right" data-target="#uploadCourseModal" data-toggle="modal" >Upload Course </button> -->
            </h4>  
        </div>
    </div>
                  

        <div class="col-md-8 mx-auto">
        <?php echo $this->session->flashdata('response'); ?> 
        
		<?php if(count($details) > 0){ ?>
            <p>Please select any one course.</p>
            <?php echo form_open_multipart('ce-provider/ce_provider/course_payment',array("id"=>"course_payment")); ?>
            <div class="table-responsive">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>S.no.</th>
                            <th>Course Title</th>
                            <th>Units</th>
                            <th>Price</th>
                            <th>Pdf</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;
                        foreach($details as $key => $value){ ?>
                    

                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $value->course_title; ?></td>
                            <td><?php echo $value->course_units; ?></td>
                            <td><?php echo $value->course_price; ?></td>
                            <td><a href="javascript:void(0)" data-id="<?php echo $value->course_pdf; ?>" class="viewPdf">View course pdf</a></td>
                            <td><input type="radio" class="iframe_cclass" id="iframe_course" name="cor_doc_id" value="<?php echo $value->cor_doc_id;?>" required> <label for="iframe_course"><i class="fa fa-arrow-left" aria-hidden="true"></i> Click to select</label></td>
                        </tr>
                    <?php $count++; } ?>
                    </tbody>
                </table>
            </div>
            
                <div class="form-group row">
                    <div class="col-sm-9">
                        <input type="submit" class="btn btn-success" name="submit"  value="submit">
                    </div>
                </div>
                
                <?php echo form_close(); ?> 

	<?php }else{
			echo '<p style="text-align:center; font-weigth:bold;">No course on Rboard.</p>';
		
	} ?>
        </div>
 <!-- Rboard modal -->

    <div class="modal fade r-board-modal" id="uploadCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    UPLOAD YOUR COURSE 
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('ce-provider/ce_provider/upload_course');?>
                       <div class="form-group row">
                           <label class="col-md-10">Course Title</label>
                           <input type="text" name="course_title" class="form-control" required>
                       </div>
                       <div class="form-group row">
                           <label class="col-md-10">Course Image</label>
                           <input type="file" name="course_image" class="form-control" accept="image/*" required>
                       </div>
                        <div class="form-group row">
                           <label class="col-md-10">Upload Course PDF</label>
                           <input type="file" name="course_pdf" class="form-control" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                       </div>
                       <div class="form-group row">
                           <label class="col-md-10">Course Units</label>
                           <input type="number" name="course_units" class="form-control" min="1" required>
                           <input type="hidden" name="provider_id" class="form-control" value="<?php echo $this->session->userdata('logincepacc')['user_ID']; ?>">
                       </div>
                       <div class="form-group row">
                           <label class="col-md-10">Course price</label>
                           <input type="number" name="course_price" class="form-control" step=".01" required>
                       </div>

                        <div class="form-group row">
                            <div class="col-md-10 text-center">
                                <button class="btn btn-success text-uppercase proceed_to_second_step" type="submit"> Upload </button>
                            </div>
                        </div>
                    <?php echo form_close();?>

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
    
   /*  $(document).ready(function(){
        $('.iframe_cclass').on('click',function(){
        var id = $('input[name=choose]:checked', '#course_payment').val();
        // alert(id);
        var path = 'https://www.ceonpoint.com/pages/course_details/'+id;
        $('#my-iframe').attr('src',path);
        });
    }); */

  </script>
    