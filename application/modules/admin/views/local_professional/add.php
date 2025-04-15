<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid">
        <div class="clearfix">
            <h4 class="float-left mt-4 mb-3"><?php echo $page_title; ?></h4>
            <a class="btn btn-primary float-right mt-4 mb-3" href="<?php echo base_url('admin/local_professional_listing'); ?>"> Back</a>
        </div>
    <div class="card mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="box"> -->
                    <!-- <div class="box-body">  -->
                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_listing', 'onsubmit'=>'return Validate()', 'name'=>'AddProForm' )); //echo "<pre>"; print_r($listing); echo "</pre>";  ?>
                    <?php echo form_hidden('listing_id', isset($listing->user_ID)?$listing->user_ID:'');?>
                    <?php //echo form_hidden('role', 'L');?> <!-- role L means Local Professional -->
                    
                <?php echo validation_errors(); ?>
                    <h5 class="text-uppercase p-2">I.personal information</h5>    
                    <div class="form-group">
                        <label for="fname" class="col-sm-2 control-label">First Name<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="fname" value="<?php echo isset($listing->fname)?$listing->fname:''; ?>" id="fname" class="form-control" type="text" required>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="lname" class="col-sm-2 control-label">Middle Name<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="lname" value="<?php echo isset($listing->lname)?$listing->lname:''; ?>" id="lname" class="form-control" type="text" required>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Last name<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="name" value="<?php echo isset($listing->name)?$listing->name:''; ?>" id="name" class="form-control" type="text" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">Country<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <select name="country" id="country" class="form-control">
                                <option value="" selected>Please select one</option>
                                <?php foreach($country_list as $key => $value){ ?>
                                <option value="<?=$value->countries_id;?>" ><?=$value->countries_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address<sup class="text-danger">*</sup></label>
                       <div class="col-sm-12">
                          <textarea name="address" id="address" class="form-control" rows="4"><?php echo isset($listing->address)?$listing->address:''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="dob" class="col-sm-2 control-label">Date Of Birth<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="dob" value="<?php echo isset($listing->dob)?$listing->dob:''; ?>" id="dob" class="form-control" type="date" required>
                            <span class="text-danger" id="doberr"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="email" value="<?php echo isset($listing->email)?$listing->email:''; ?>" id="email" class="form-control" type="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Gender<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <select name="gender" id="gender" class="form-control" >
                            <option value="">Choose Gender</option>
                            <?php $maleselected = (isset($listing->gender) && $listing->gender == 'male')?'selected':'';
                                echo '<option value="male"'.$maleselected.' > Male </option>'; 
                                  $femaleselected = (isset($listing->gender) && $listing->gender == 'female')?'selected':'';
                                echo '<option value="female"'.$femaleselected.' > Female </option>';  ?>
                            </select>
                        </div>
                    </div>

                    <?php if(!empty($listing->image)){ ?>
                    <div class="form-group">
                       <label for="image" class="col-sm-2 control-label">Uploaded Image</label>
                        <div class="col-sm-12">
                            <img src="<?php echo base_url('assets/uploads/profile/'.$listing->image); ?>" width="150" height="150">
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                       <label for="image" class="col-sm-2 control-label">Image<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="image" id="image" class="form-control" type="file">
                        </div>
                    </div>            
                  

                    <h5 class="text-uppercase p-2">II.educational background</h5>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">School Name<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <select class="form-control" id="university" name="university" onchange="getValue(this);">
                            <option>Please select any one</option>    
                            <?php foreach($university as $value){
                             $uniselected = (isset($listing->university) && $listing->university == $value->uniid)?'selected':''; ?>
                                <option value="<?php echo $value->uniid; ?>" <?php echo $uniselected; ?>><?php echo $value->university_name;?></option>
                            <?php } ?>
                            <option value="0">Other School</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="display:none;" id="other_university">
                        <label class="col-sm-2 col-form-label">Other School Name<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="prof_university_name" name="other_university" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Course Name<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <select class="form-control" id="college_of" name="college_of" onchange="getCollegeValue(this);">
                            <option>Please select any one</option>    
                            <?php foreach($profession_list as $value){ 
                                 $courseselected = (isset($listing->college) && $listing->college == $value->id)?'selected':'';?>
                                <option value="<?php echo $value->id; ?>" <?php echo $courseselected; ?>><?php echo $value->name;?></option>
                            <?php } ?>
                            <option value="0">Other Course Name</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="display:none;" id="other_college">
                        <label class="col-sm-2 col-form-label">Other Course<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="prof_college_name" name="other_college" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_of_grauate" class="col-sm-2 control-label">Date of graduation<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="date_of_grauate" value="<?php echo isset($listing->date_of_grauate)?$listing->date_of_grauate:''; ?>" id="date_of_grauate" class="form-control" type="date" required>
                        </div>
                    </div>

                    <h5 class="text-uppercase p-2">III.Professional information</h5>
                    <div class="form-group">
                        <label for="profession" class="col-sm-2 control-label">Profession<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <select name="profession" id="profession" class="form-control" >
                            <option value="">Choose Profession</option>
                            <?php foreach($profession_list as $profession){
                                $profselected = (isset($listing->profession) && $listing->profession == $profession->id)?'selected':'';
                                echo '<option value="'.$profession->id.'"'.$profselected.' >'.$profession->name.'</option>';  } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="license_no" class="col-sm-2 control-label">License No<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="license_no" value="<?php echo isset($listing->license_no)?$listing->license_no:''; ?>" id="license_no" class="form-control" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                       <label for="license_issued_date" class="col-sm-2 control-label">Date Issued<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <!-- <span><?php echo isset($listing->added_on)?date('M d,Y',strtotime($listing->added_on)):''; ?></span> -->
                            <input name="license_issued_date" value="<?php echo isset($listing->license_issued_date)?$listing->license_issued_date:''; ?>" id="license_issued_date" class="form-control" type="date" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="license_validity_date" class="col-sm-2 control-label">Validity Date<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="license_validity_date" value="<?php echo isset($listing->license_validity_date)?$listing->license_validity_date:''; ?>" id="license_validity_date" class="form-control" type="date" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg_board" class="col-sm-2 control-label">Issued By<sup class="text-danger">*</sup></label>
                        <div class="col-sm-12">
                            <input name="reg_board" value="<?php echo isset($listing->reg_board)?$listing->reg_board:''; ?>" id="reg_board" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="status" class="col-sm-2 control-label">Professional Category:<sup class="text-danger">*</sup></label>
                      <div class="col-sm-12">
                            <label class="radio-inline">
                                <input type="radio" name="role" value="L" <?php echo (isset($listing->role) && $listing->role=='L')? 'checked="checked"':''; ?>> Local Professional
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="role" value="PP" <?php echo (isset($listing->role) && $listing->role=='PP')? 'checked="checked"':''; ?>> Foreign Professional(with exam)
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="role" value="P" <?php echo (isset($listing->role) && $listing->role =='P')? 'checked="checked"':''; ?>> Foreign Professional(without exam)
                            </label>
                        </div>
                    </div>
                                                                        
                    <div class="form-group">
                       <label for="status" class="col-sm-2 control-label">License Status<sup class="text-danger">*</sup></label>
                      <div class="col-sm-12">
                           <!--  <label class="radio-inline">
                                <input type="radio" name="status"  value="0" <?php echo (isset($listing->status) && $listing->status ==0)? 'checked="checked"':''; ?>> Pending
                            </label> -->
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status1"  value="1" <?php echo (isset($listing->status) && $listing->status==1)? 'checked="checked"':''; ?>> Valid
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status2" value="2" <?php echo (isset($listing->status) && $listing->status==2)? 'checked="checked"':''; ?>> Expired
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status3" value="3" <?php echo (isset($listing->status) && $listing->status ==3)? 'checked="checked"':''; ?>> Suspended
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status4" value="4" <?php echo (isset($listing->status) && $listing->status ==4)? 'checked="checked"':''; ?>> Revoked
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                            <div class="btn-group">
                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
                                <?php echo anchor('admin/local_professional_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close();?>
                    <!-- </div> -->

                <!-- </div> -->

            </div>

        </div>



        </div>

    </div> 

</div>

</main>

                
<script>
    var crdate = '<?php echo date('Y-m-d'); ?>';
    function getValue(myuniversity){
        currentValue = myuniversity.value;
        if(currentValue > 0){
            $('#other_university').hide();
        }else{
            $('#other_university').show();
        }
    }

    function getCollegeValue(mycollege){
        currentcoValue = mycollege.value;
        if(currentcoValue > 0){
            $('#other_college').hide();
        }else{
            $('#other_college').show();
        }
    }

    $('#license_validity_date').blur(function(){
        
        var selected = $('#license_validity_date').val();
        // console.log();
        if(selected > crdate){
            $('#status1').prop('checked',true);
        }else{
            $('#status2').prop('checked',true);
        }

    });

    function Validate(){
        $('#doberr').html('');
        var dob = new Date($('#dob').val());
        var cdate = new Date(crdate);
        var timediff = cdate.getTime() - dob.getTime();
        var days = timediff / (1000*60*60*24);
        if(days < 6575){
            $('#doberr').html('Your age less than 18 years.');
            return false;
        }else{
            return true;
        }
    }

    /*$('#dob').blur(function(){
        var dob = new Date($('#dob').val());
        var cdate = new Date(crdate);
        var timediff = cdate.getTime() - dob.getTime();
        var days = timediff / (1000*60*60*24);
        if(days < 6575){
            $('#doberr').html('Your age less than 18 years.');
        }else{
            $('#doberr').html('Your age greater than 18 years.');
        }
    }); */
</script>




