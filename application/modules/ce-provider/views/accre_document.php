
        <div class="col-md-8 mx-auto r-bord-two form-heigte">
            <div class="my-5">
                <h4 class="mb-4 mt-4 text-uppercase text-center">REQUIRED DOCUMENTS </h4>
            </div>
              <?php echo $this->session->flashdata('response'); ?>
              <?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error'); } ?>
                    
              <?php echo form_open_multipart('ce-provider/ce_provider/accre_document',array('id'=>'license_image_form')); ?>

          <div class="form-group row">
              <label class="col-md-3 col-form-label">Business License <br> Attached Document <span class="error">*</span></label>
                <div class="col-md-7">
                  <input type="file" class="form-control" id="license_image" name="license_image" value="" required>
                  <div class="error license_image"></div>
                </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">Accreditation <br>Attached Document <span class="error">*</span></label>
              <div class="col-md-7">
                <input type="file" class="form-control" id="accreditation_image" name="accreditation_image" value="" required>
                <div class="error accreditation_image"></div>
              </div>
          </div>
              
          <div class="form-group row">
              <div class="col-md-10 text-center mt-3">
                <input type="submit" name="upload" value="Upload" class="btn btn-success text-uppercase r-bord-add-btn">    
              </div>
          </div>
                
      <?php echo form_close(); ?>       
    
      </div>
  </div>


   <script type="text/javascript">

    $(document).ready(function(){
      $(".confirm_document").click(function(){
          var bussiness_id = $("#bussiness_id").val();
         location.href = base_url+'ce-provider/ce_provider/payment';
      });
      
      $("#license_image_form").submit(function( event ) {

            var license_image = $('#license_image')[0].files;
            var accreditation_image = $('#accreditation_image')[0].files;


            //alert(license_image+'/'+accreditation_image);

            if(license_image.length==0){
             
              $(".license_image").text("Business documents required");
              return false;

            }
            if(accreditation_image.length==0){
              $(".license_image").text("");
              $(".accreditation_image").text("Accreditation documents required");
              return false;

            }

          //$("#license_image_form").submit();

      });


    });
 

  </script>


