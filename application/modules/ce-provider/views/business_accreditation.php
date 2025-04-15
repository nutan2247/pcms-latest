

            <div class="my-5">
                <h4 class="mb-4 mt-4 text-uppercase text-center">Business Information</h4>
            </div>

        <div class="col-md-8 mx-auto initial_section form-heigte">
        <?php  echo form_open_multipart('ce-provider/ce_provider/initialize_form',array("id"=>"initial_form")); 
            echo $this->session->flashdata('response'); ?>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Name<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="business_name" name="business_name"  value="<?php echo set_value('business_name'); ?>" required>
                        <div class="error" id="business_name_msg"></div>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Business Number<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="business_no" name="business_no"  value="<?php echo set_value('business_no'); ?>" required >
                        <div class="error" id="business_no_msg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="address" name="address"> 
                          <?php echo set_value('address'); ?>
                        </textarea>
                        <div class="error" id="business_no_msg"></div>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Country<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <select name="countries_id" id="countries_id" class="form-control" required>
                            <option value="">Please select one</option>
                            <?php if(!empty($countries)) {
                              foreach ($countries as $key => $value) { ?>
                                <option  value="<?php echo $value['countries_id']?>" >
                                <?php echo $value['countries_name'];?>
                                </option>
                            <?php } } ?>
                            <!-- <option  selected="selected" value="male" selected>india</option>
                            <option  selected="selected" value="female">us</option> -->
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Contact Person<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo set_value('contact_person'); ?>" required>
                        <div class="error" id="contact_person_msg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Designation<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="designation" name="designation" value="<?php echo set_value('designation'); ?>" required>
                        <div class="error" id="designation_msg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">E-mail<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" name="email"  value="<?php echo set_value('email'); ?>" required>
                        <div class="error" id="email_msg"></div>
                     </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Tel. No.<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="phone" name="phone"  pattern="[1-9]{1}[0-9]{9}" value="<?php echo set_value('phone'); ?>" required>
                        <div class="error" id="phone_msg"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Company Logo.<span class="error">*</span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="company_logo" name="company_logo" required>
                        
                     </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-12 text-center mb-5 mt-3">
                        <input type="submit" name="submit" id="initialize_submit" value="Submit for verification" class="btn btn-success text-uppercase submit_initial_form">
                    </div>
                </div>
                
        <?php echo form_close(); ?>  
        </div>
