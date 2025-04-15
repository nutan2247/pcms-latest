
    <div class="my-5">
        <h4 class="mb-4 mt-4 text-uppercase text-center">business information</h4>
    </div>

           
    <!----------------------------- Renewal Form ---------------------------------------------->

            <div class="col-md-6 mx-auto initial_section form-heigte">
           
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Name</label>
                    <div class="col-sm-9">
                        <?php echo $user_details->business_name; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Number</label>
                    <div class="col-sm-9">
                        <?php echo isset($user_details->business_no)?$user_details->business_no:''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <?php echo isset($user_details->address)?$user_details->address:''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Country</label>
                    <div class="col-sm-9">
                        <?php echo $user_details->co_name; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Contact Person<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <?php echo isset($user_details->contact_person)?$user_details->contact_person:''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Designation</label>
                    <div class="col-sm-9">
                       <?php echo isset($user_details->designation)?$user_details->designation:''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9">
                       <?php echo isset($user_details->email)?$user_details->email:''; ?>
                     </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Tel. No.</label>
                    <div class="col-sm-9">
                        <?php echo isset($user_details->phone)?$user_details->phone:''; ?>
                    </div>
                </div>
                        
                <div class="form-group row">
                    <div class="col-md-12 text-center mb-5 mt-3">
                        <a href="javascript:void(0)" onclick="goToNextStep();" class="btn btn-success text-uppercase">Next Step</a>
                    </div>
                </div>
        </div>



<style type="text/css">
  .radio-class{
    width: 18px;
    height: 18px;
  }
</style>
        
<script type="text/javascript">
    function goToNextStep(){
        window.location.href="<?php echo base_url('ce-provider/ce_provider/renew_accre_document')?>";
    }
</script>


     