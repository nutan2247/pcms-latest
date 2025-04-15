
        <div class="col-md-8 mx-auto r-bord-two">
            <div class="my-5">
                <h4 class="mb-4 mt-4 text-uppercase text-center">ACCEREDITATION DOCUMENTS </h4>
             
            </div>

            <div>
                
                <?php
                  if($this->session->flashdata('error')){
                    echo $this->session->flashdata('error');
                  }
                ?>
                <input type="hidden" id="bussiness_id" name="bussiness_id" value="<?php echo $id; ?>">
            </div>
            <!-- <form action="" class="mb-5"> -->
              <?php
                if($renewal==0)
                {


                echo form_open_multipart('ce-provider/CE_provider/accre_document?id='.$id,array('id'=>'license_image_form'));
                }else{
                  echo form_open_multipart('ce-provider/CE_provider/renewal_document?id='.$id,array('id'=>'license_image_form'));
                }
              ?>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Business License <br> Attached Document <span class="error">*</span></label>
                    <div class="col-md-7">
                         <input type="file" class="form-control" id="license_image" name="license_image"   value="">
                         <?php //echo form_error('license_image', '<div class="error license_image">', '</div>'); ?>
                         <div class="error license_image"></div>

                        
                        
                    </div>
                    <div class="col-md-2">
                        <!-- <a href="#" class="btn btn-success text-uppercase r-bord-add-btn">Add</a> -->
                        <!-- <input type="submit" name="license_img" value="Add" class="btn btn-success text-uppercase r-bord-add-btn"> -->

                    </div>
                    <?php
                      if(!empty($provider_details) && isset($provider_details))
                      {
                        if($provider_details->license_image!=""){
                    ?>
                    <div class="col-md-3">
                      <input type="hidden" id="license_image_hidden" value="<?php echo $provider_details->license_image?>">
                        
                        <a target="_blank" href="<?php echo base_url('assets/images/ce_provider/').$provider_details->license_image; ?>" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-download-alt"></span> Download
        </a>
                    </div>
                  <?php }else{ ?>
                    <input type="hidden" id="license_image_hidden" value="">
                  <?php } }  ?>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Accreditation <br>Attached Document <span class="error">*</span></label>
                    <div class="col-md-7">
                        <input type="file" class="form-control" id="accreditation_image" name="accreditation_image" value="">
                       <?php //echo form_error('accreditation_image','<div class="error accreditation_image">','</div>'); ?>
                       <div class="error accreditation_image"></div>
                    </div>
                    <div class="col-md-2">
                      <!-- <input type="submit" name="accred_img" value="Add" class="btn btn-success text-uppercase r-bord-add-btn"> -->
                       <!--  <a href="#" class="btn btn-success text-uppercase r-bord-add-btn">Add</a> -->
                    </div>
                    <?php
                      if(!empty($provider_details) && isset($provider_details))
                      {
                        if($provider_details->accreditation_image!="")
                        {
                    ?>
                    <div class="col-md-3">
                      <input type="hidden" id="accred_img_hidden" value="<?php echo $provider_details->accreditation_image?>">
                        <!-- <img src="<?php echo base_url('assets/images/ce_provider/').$provider_details->accreditation_image; ?>"> -->
                        <a target="_blank" href="<?php echo base_url('assets/images/ce_provider/').$provider_details->accreditation_image; ?>" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-download-alt"></span> Download
        </a>

                    </div>
                  <?php }else{  ?>
                      <input type="hidden" id="accred_img_hidden" value="">
                    <?php } } ?>
                </div>
              
               
                
                
                <div class="form-group row">
                    <div class="col-md-10 text-center mt-3">

                      <input type="submit" name="upload" value="Upload" class="btn btn-success text-uppercase r-bord-add-btn">
                      <?php
                        if(!empty($provider_details) && isset($provider_details))
                        {
                          if($provider_details->accreditation_image!="" || $provider_details->license_image!="")
                        {
                      ?>
                        <!-- <button  type="button" class="btn btn-success text-uppercase submit_verification" name="submit" value="" data-toggle="modal" data-target="#exampleModal">Submit for varification</button> -->


                        <a class="btn btn-success text-uppercase r-bord-add-btn" href="<?php echo $submit_for_varification; ?>">Submit for varification</a>
                      <?php } } ?>
                        
                    </div>
                    <div class="display_none col-md-10 text-center mt-3 alert alert-danger" role="alert"></div>
                </div>
                
                <?php echo form_close(); ?>       
        </div>
    
    </div>

       <!-- Rboard modal exampleModal -->

    <div  class="modal fade r-board-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"> 
          
            <h5 class="modal-title  mx-auto" id="exampleModalLabel">ACCREDITATION DOCUMENTS</h5>
              <!-- <img class="w-100" src="https://ceonpointllc.com/rboard/assets/images/logo.png" alt="" ></h5> -->
          <!-- <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
         <div class="modal-thank text-center">
             
         </div>
         <p class="text-center my-2 my-md-4 ">Your Accreditation Documents Were Successfully Sent For Verification.</p>
            <!-- <div class="form-group row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success text-uppercase confirm_document" name="submit" value="">Confirm</button>
                </div>
            </div> -->

            <div class="text-center pro-steps">
                       
                       <a href="#" class="stepActive">
                    <span>
                        <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    
                </a>

                </div>
                <div class="form-group  text-center">
                  Please allow
                </div>
                <div class="form-group text-center">
                  <h2 style="color:red">30 Days</h2>
                  <p>for review of your documents.</p>
                </div>

                <div class="form-group text-center">
                  Please proceed to step 3 for payment.
                </div>
                <div class="form-group row">
                <div class="col-md-10 text-center">
                    <a  href="<?php echo base_url('ce-provider/CE_provider/payment?id='.$id)?>"><button class="btn btn-success text-uppercase">Pay Now</button></a>
                  </div>
                </div>

        </div>
      
      </div>
    </div>
  </div> 

   <script type="text/javascript">

    




    $(document).ready(function(){

      /*$(".submit_verification").click(function(){

        var lic_img = $.trim($("#license_image_hidden").val());
        var acc_img  =   $.trim($("#accred_img_hidden").val());


       
        if(lic_img!="" && acc_img!=""){
          $(".r-board-modal").attr("id","exampleModal")
          $("#exampleModal").modal("show");
        }else{
          $(".display_none").css("display","block");
          $(".display_none").text("Please upload document");
           $("#exampleModal").modal('hide');
  
        }
        

              
      });*/


      $(".confirm_document").click(function(){
          var bussiness_id = $("#bussiness_id").val();
         location.href = base_url+'ce-provider/CE_provider/payment?id='+bussiness_id;
      });
      
      $("#license_image_form").submit(function( event ) {

     // $("input[name='upload']").click(function(){

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


