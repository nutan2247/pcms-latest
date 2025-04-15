
<style type="text/css"> .radio-class{ width: 18px; height: 18px; } </style>

    <?php echo $this->load->view('ce-provider/common/online_course_banner'); ?>
               
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>1</strong>
                        </span>
                        <label>CEP Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
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
                        <label>Verification of Documents</label>
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
                  
                <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>  
              </div>
            </div>

            
            <?php //print_r($details); ?>
            <div class="col-md-8 mx-auto initial_section">
           
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Name : </label>
                    <div class="col-sm-9">
                        <input type="text" name="" value="<?php echo isset($details->business_name)?$details->business_name:''; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Number : </label>
                    <div class="col-sm-9">
                        <input type="number" name="" value="<?php echo isset($details->business_no)?$details->business_no:''; ?>" class="form-control">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Address : </label>
                    <div class="col-sm-9">
                        <textarea name="address" id="" cols="30" rows="3" class="form-control"><?php echo isset($details->address)?$details->address:''; ?></textarea>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Country : </label>
                    <div class="col-sm-9">
                        <input type="text" name="" value="<?php echo isset($details->countries_name)?$details->countries_name:''; ?>" class="form-control">
						
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Contact Person<span class="error">*</span> : </label>
                    <div class="col-sm-9">
                        <input type="text" name="" value="<?php echo isset($details->contact_person)?$details->contact_person:''; ?>" class="form-control">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Designation : </label>
                    <div class="col-sm-9">
                        <input type="text" name="" value="<?php echo isset($details->designation)?$details->designation:''; ?>" class="form-control">
                       
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">E-mail : </label>
                    <div class="col-sm-9">
                        <input type="email" name="" value="<?php echo isset($details->email)?$details->email:''; ?>" class="form-control">
                       
                     </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Tell. No. : </label>
                    <div class="col-sm-9">
                        <input type="text" name="" value="<?php echo isset($details->phone)?$details->phone:''; ?>" class="form-control">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10 text-center mb-5 mt-3">
                        
                        <a href="javascript:void(0);"><button type="button" class="btn btn-success text-uppercase" name="submit" value="" onclick="goToNextStep();" >Next Step</button></a>
                    </div>
                </div>
                
                <?php
                  echo form_close();
                ?>  
        </div>
        <div class="col-md-8 mx-auto error_msg error"></div>
 

  <script type="text/javascript">
    

    $(document).ready(function(){
    

        $("input[name='ce_provider_radio']").click(function(){

          var radio_val =  $(this).val();
          
          if(radio_val==1)
          {
            $(".initial_section").show();
            $(".renewal_section").hide();
          }else if(radio_val==2){
            $(".initial_section").hide();
            $(".renewal_section").show();
          }

        });

        $("button[name='confirm']").click(function(){
            
                $("#exampleModal").modal("hide");
                $("#confirmModal").modal("show");
        });

        $("button[name='contact_us']").click(function(){
            window.open(base_url+'license/Contact_us','_blank');
        })

      
});


            $('#initial_form').validate({ // initialize the plugin
        rules: {
            business_name: {
                required: true,
               
            },
            business_no: {
                required: true,
            
            },
            countries_id: {
                required: true,
            
            },
            contact_person: {
                required: true,
            
            },
           designation:{
              required:true
           },
            email: {
                required: true,
            
            },
            phone: {
                required: true,
            
            }

            
        },
        messages: {
        business_name: "Business name fields required",
        business_no: "Business no fields required",
        countries_id: "Country fields required",
        contact_person: "Contact person fields required",
        designation: "Designation fields required",
        email: "Email fields required",
        phone: "Tell. no fields required",


        },
        submitHandler:function(form)
        {
                //var formData = new FormData(this);
                  //  alert(files);
                 // var form_data = $(form).serialize();


                               var formData = new FormData(form);
        var files = $('#company_logo')[0].files;



           
                      // if(files.length > 0 ){
           formData.append('company_logo',files[0]);

         //}

          

          $.ajax({

                type: "POST",
                url: base_url+'ce-provider/CE_provider/initialize_form',
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend:function(){
                    //$(".initialize_submit").addClass("btn btn-success text-uppercase");
                    $("#initialize_submit").val('WAIT...');
                    $("#initialize_submit").prop('disabled',true);
                },
                success: function (data) {

                      var table = '<table class="table"><tbody><tr><td class="table-width">Business Name </td><td>'+data.business_name+'</td></tr><tr><td class="table-width">Business Number </td><td>'+data.business_no+'</td></tr><tr><td class="table-width">Address</td><td>'+data.address+'</td></tr><tr><td class="table-width">Country</td><td>'+data.co_name+'</td></tr><tr><td class="table-width">Contact Person</td><td>'+data.contact_person+'</td></tr><tr><td class="table-width">Designation</td><td>'+data.designation+'</td></tr><tr><td class="table-width">E-mail</td><td>'+data.email+'</td></tr><tr><td class="">Tell. No.</td><td>'+data.phone+'</td></tr><tr><td class="">Logo .</td><td><img src='+base_url+'assets/images/ce_provider/'+data.company_logo+'></td></tr></tbody></table>';
                        $(".info_div").html(table);
                        $("#confirm_button").html("Confirm");
                        $("#exampleModal").modal("show");
                        $("#initialize_submit").val('Submit for varification');
                        $("#initialize_submit").prop('disabled',false);  
                        $(".proceed_to_second_step").prop('href',base_url+'ce-provider/CE_provider/accre_document?id='+data.provider_id);
                     
                 }
             });
             return false;
        }

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

    function goToNextStep(){
        var check = '<?php echo $this->session->userdata('logincepacc')['user_ID']; ?>';
        if(check > 0){
            window.location.href="<?php echo base_url('ce-provider/ce_provider/review_course')?>";
        }else{
            var x = confirm('Please Login as a CEP to proceed!');
            if(x==true){
              window.location.href="<?php echo base_url('login');?>";  
            }
        }

    }


  </script>

     