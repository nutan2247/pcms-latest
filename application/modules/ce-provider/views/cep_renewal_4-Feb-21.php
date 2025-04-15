
<style type="text/css">
  
  .radio-class{
    width: 18px;
    height: 18px;
  }
</style>

            <div class="my-5">
                <h4 class="mb-4 mt-4 text-uppercase text-center">Renewal Company/business information verification </h4>
               
            </div>

           
    <!----------------------------- Renewal Form ---------------------------------------------->



    <div class="col-md-8 mx-auto renewal_section">
            <?php
                echo form_open_multipart('ce-provider/CE_provider/renewal_form',array("id"=>'renewal_form'));
              ?>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Name<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="business_name_view" name="business_name_view"  value="<?php echo set_value('business_name_view'); ?>" >
                        <?php echo form_error('business_name', '<div class="error">', '</div>'); ?>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Number<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="business_no_view" name="business_no_view"  value="<?php echo set_value('business_no_view'); ?>" >
                        <?php echo form_error('business_no', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="address_view" name="address_view"> 
                          <?php echo set_value('address_view'); ?>
                        </textarea>
                        <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Country<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <select name="countries_id_view" id="countries_id_view" class="form-control">
                            <option value="">Please select one</option>
                            <?php
                            if(!empty($countries))
                            {
                              foreach ($countries as $key => $value) {
                                # code...
                              
                            ?>
                              <option  value="<?php echo $value['countries_id']?>" ><?php echo $value['countries_name']?></option>
                          <?php } } ?>
                            <!-- <option  selected="selected" value="male" selected>india</option>
                            <option  selected="selected" value="female">us</option> -->
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Contact Person<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="contact_person_view" name="contact_person_view" value="<?php echo set_value('contact_person'); ?>">
                        <?php echo form_error('contact_person', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Designation<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="designation_view" name="designation_view" value="<?php echo set_value('designation_view'); ?>">
                        <?php echo form_error('designation', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">E-mail<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email_view" name="email_view"  value="<?php echo set_value('email_view'); ?>" >
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                     </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Tell. No.</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="phone_view" name="phone_view"  pattern="[1-9]{1}[0-9]{9}" value="<?php echo set_value('phone_view'); ?>" >
                        <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-10 text-center mb-5 mt-3 ">
                        

                        <!-- <button type="submit" class="btn btn-success text-uppercase" name="submit" value="" data-toggle="modal" data-target="#exampleModal">Submit for varification</button> -->
                        <input type="submit" id="confirm_submit" name="submit" value="Submit for varification" class="btn btn-success text-uppercase">
                    </div>
                </div>
                
                <?php
                  echo form_close();
                ?>  
        </div>



   <!-- Rboard modal -->

    <div class="modal fade r-board-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title  mx-auto" id="exampleModalLabel">INFORMATION CONFIRMATION</h5>
          <!-- <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
         </div>
        <div class="modal-body">
          <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
              
             <!--  <h2 class="text-danger"><span class="text-warning align-middle mr-2" style="font-size: 60px;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>data matched</h2> -->
            </div>
            <!-- <p class="my-2 my-md-3 r-bord-text">Your data matched in our datrabase.please review and click the button to confirm.</p>
            <p class="r-bord-text">Please call or message us if this is Not you.</p> -->
            <div class="table-responsive info_div">
                
            </div>
            <!-- <div class="profassion">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                          <tr>
                            <td class="table-width">Focus Profession</td>
                            <td>Nursung</td>
                          </tr>
                          <tr>
                            <td class="table-width">Accreditation Number </td>
                            <td>32154454</td>
                          </tr>
                          <tr>
                            <td class="table-width">Date Issued</td>
                            <td>jan.21.2021</td>
                          </tr>
                          <tr>
                            <td class="table-width">Validity</td>
                            <td>fab.21.2021</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div> -->
            <div class="d-match text-center my-2">
                <img src="images/Untitled-2.png" alt="">
            </div>
            <div class="form-group row">
                <div class="col-md-10 text-center">
                    <button type="button" id="confirm_button" class="btn btn-success text-uppercase" name="confirm"></button>

                    <button type="button" id="edit_information" class="btn btn-success text-uppercase" name="" value="">Edit  Information</button>
                </div>
            </div>
        </div>
      
      </div>
    </div>
  </div>


 <!-- Rboard modal -->

    <div class="modal fade r-board-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
              
             <!--  <h2 class="text-danger"><span class="text-warning align-middle mr-2" style="font-size: 60px;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>data matched</h2> -->
            </div>
            <!-- <p class="my-2 my-md-3 r-bord-text">Your data matched in our datrabase.please review and click the button to confirm.</p>
            <p class="r-bord-text">Please call or message us if this is Not you.</p> -->
            <div class="table-responsive">
                <div class="text-center">Step 1</div><br>
                <div class="text-center">Business and Accreditation Verification</div><br><br>
                <div class="text-center">Successfully completed</div>
                <div class="text-center pro-steps">
                       
                       <a href="#" class="stepActive">
                    <span>
                        <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    
                </a>

                </div>

                <div class="text-center">Please proceed to step 2.</div>
            </div>
            
            <div class="profassion">
                <div class="table-responsive"></div>
            </div>
            <div class="d-match text-center my-2"><img src="images/Untitled-2.png" alt=""></div>
            <div class="form-group row">
                <div class="col-md-10 text-center">
                    
                    <a class="btn btn-success text-uppercase proceed_to_second_step" href="">Next Step</a>

                    
                </div>
            </div>
        </div>
      
      </div>
    </div>
  </div>





<!------------------------------------ DATA NOT MATCHED POPUP ----------------------------------------->

<div class="modal fade r-board-modal" id="data_not_matched_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title  mx-auto" id="exampleModalLabel">INFORMATION CONFIRMATION</h5>
          
         </div>
        <div class="modal-body">
          <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
              
             <!--  <h2 class="text-danger"><span class="text-warning align-middle mr-2" style="font-size: 60px;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>data matched</h2> -->
            </div>
             <p class="my-2 my-md-3 r-bord-text text-center">Your Accreditation details.</p>
            <p class="r-bord-text text-danger text-center">DID NOT MATCHED<br></p>
            <p class="r-bord-text text-center">in our database.</p>
            <div class="text-center">
                Please check your accreditation again or contact us for manual verification.
            </div>
            <div class="text-center mt-2">
                    <h2 class="text-danger"><span class="text-danger  align-middle" style="font-size: 100px;"><i class="fa fa-times-circle" aria-hidden="true"></i></span></h2>

            </div>
            
            <div class="d-match text-center my-2">
                <img src="images/Untitled-2.png" alt="">
            </div>
            <div class="form-group row">
                <div class="col-md-10 text-center">
                    <button type="button"  class="btn btn-success text-uppercase" name="contact_us">Contact Us</button>

                    <button type="button" id="not_matched_edit_information" class="btn btn-success text-uppercase" name="" value="">Edit  Information</button>
                </div>
            </div>
        </div>
      
      </div>
    </div>
  </div>

  <script type="text/javascript">
    

    $(document).ready(function(){
    
        
        /*$("input[name='ce_provider_radio']").click(function(){

          var radio_val =  $(this).val();
          
          if(radio_val==1)
          {
            $(".initial_section").show();
            $(".renewal_section").hide();
          }else if(radio_val==2){
            $(".initial_section").hide();
            $(".renewal_section").show();
          }

        });*/

        $("button[name='confirm']").click(function(){
            
                $("#exampleModal").modal("hide");
                $("#confirmModal").modal("show");
        });

        $("button[name='contact_us']").click(function(){
            window.open(base_url+'license/Contact_us','_blank');
        })

      
});


       

/**************************** RENEWAL FORM *****************************************************/


 $('#renewal_form').validate({ // initialize the plugin
        rules: {
            business_name_view: {
                required: true,
               
            },
            business_no_view: {
                required: true,
            
            },
            countries_id_view: {
                required: true,
            
            },
            contact_person_view: {
                required: true,
            
            },
           designation_view:{
              required:true
           },
            email_view: {
                required: true,
            
            },
            phone_view: {
                required: true,
            
            }

            
        },
        messages: {
        business_name_view: "Business name fields required",
        business_no_view: "Business no fields required",
        countries_id_view: "Country fields required",
        contact_person_view: "Contact person fields required",
        designation_view: "Designation fields required",
        email_view: "Email fields required",
        phone_view: "Tell. no fields required",


        },
        submitHandler:function(form)
        {
            var formData = new FormData(form);
      

          

          $.ajax({

                type: "POST",
                url: base_url+'ce-provider/CE_provider/renewal_form',
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend:function(){
                    $("#confirm_submit").val('WAIT...');
                    $("#confirm_submit").css('disabled',true);
                },
                success: function (data) {

                    if(data!=""){
                       
                    

                      var table = '<table class="table"><tbody><tr><td class="table-width">Business Name </td><td>'+data.business_name+'</td></tr><tr><td class="table-width">Business Number </td><td>'+data.business_no+'</td></tr><tr><td class="table-width">Address</td><td>'+data.address+'</td></tr><tr><td class="table-width">Country</td><td>'+data.co_name+'</td></tr><tr><td class="table-width">Contact Person</td><td>'+data.contact_person+'</td></tr><tr><td class="table-width">Designation</td><td>'+data.designation+'</td></tr><tr><td class="table-width">E-mail</td><td>'+data.email+'</td></tr><tr><td class="">Tell. No.</td><td>'+data.phone+'</td></tr><tr><td class="">Logo .</td><td><img src='+base_url+'assets/images/ce_provider/'+data.company_logo+'></td></tr></tbody></table>';
                        $(".info_div").html(table);
                        $("#confirm_button").html("Submit For Verification");
                        $("#exampleModal").modal("show");

                        
                        $("#confirm_submit").val('Submit For Verification');
                        $("#confirm_submit").css('disabled',false);
                    
                     
                 }else{
                    $("#data_not_matched_Modal").modal("show");
                    $("#confirm_submit").val('Submit For Verification');
                        $("#confirm_submit").css('disabled',false);
                 }
                } 
             });
             return false;
        }

    });

$(document).on("click","#edit_information",function(){

    $("#exampleModal").modal("hide");

});

$(document).on("click","#not_matched_edit_information",function(){

    $("#data_not_matched_Modal").modal("hide");

});




  </script>

     