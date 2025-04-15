<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h2>

    <div class="card mb-4">

    <div class="card-header d-flex align-items-center justify-content-between">
        <span>
            <!-- <i class="fas fa-table mr-1"></i> -->
            <?php //echo $table_name; ?>
        </span>
        <a class="btn btn-primary text-uppercase" href="<?php echo site_url('admin/listing'); ?>"> Back to Professional
            Listing</a>
    </div>

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 



                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_listing')); //echo "<pre>"; print_r($listing); echo "</pre>";  ?>

                    <?php echo form_hidden('listing_id', isset($listing->user_ID)?$listing->user_ID:'');?>

                    <?php echo form_hidden('role', 2);?> <!-- role 2 means Professional -->

                            

                    <div class="form-group">

                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">

                            <input name="name" value="<?php echo isset($listing->name)?$listing->name:''; ?>" id="name" class="form-control" type="text" required>

                        </div>

                    </div> 



                    <div class="form-group">

                        <label for="profession" class="col-sm-2 control-label">Profession</label>

                        <div class="col-sm-10">

                            <select name="profession" id="profession" class="form-control" >

                            <option value="">Choose Profession</option>

                            <?php foreach($profession_list as $profession){

                                $profselected = (isset($listing->profession) && $listing->profession == $profession->id)?'selected':'';

                                echo '<option value="'.$profession->id.'"'.$profselected.' >'.$profession->name.'</option>';  } ?>

                            </select>

                        </div>

                    </div> 



                 <!--    <div class="form-group">

                        <label for="country" class="col-sm-2 control-label">Country</label>

                        <div class="col-sm-10">

                            <select name="country" id="country" class="form-control" >

                            <option value="">Choose Country</option>

                            <?php foreach($country_list as $country){

                                $countryselected = (isset($listing->country) && $listing->country == $country->countries_id)?'selected':'';

                                echo '<option value="'.$country->countries_id.'"'.$countryselected.' >'.$country->countries_name.'</option>';  } ?>

                            </select>

                        </div>

                    </div>  -->



                    <div class="form-group">

                        <label for="gender" class="col-sm-2 control-label">Gender</label>

                        <div class="col-sm-10">

                            <select name="gender" id="gender" class="form-control" >

                            <option value="">Choose Gender</option>

                            <?php $maleselected = (isset($listing->gender) && $listing->gender == 'Male')?'selected':'';

                                echo '<option value="Male"'.$maleselected.' > Male </option>'; 

                                  $femaleselected = (isset($listing->gender) && $listing->gender == 'Female')?'selected':'';

                                echo '<option value="Female"'.$femaleselected.' > Female </option>';  ?>

                            </select>

                        </div>

                    </div>   

                    

                    <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-5">

                            <input name="email" value="<?php echo isset($listing->email)?$listing->email:''; ?>" id="email" class="form-control" type="email" required>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="dob" class="col-sm-2 control-label">Date Of Birth</label>

                        <div class="col-sm-5">

                            <input name="dob" value="<?php echo isset($listing->dob)?$listing->dob:''; ?>" id="dob" class="form-control" type="date" required>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="address" class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-10">

                            <textarea name="address" id="address" class="form-control" rows="4"><?php echo isset($listing->address)?$listing->address:''; ?></textarea>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="license_no" class="col-sm-2 control-label">Licese No</label>

                        <div class="col-sm-5">

                            <input name="license_no" value="<?php echo isset($listing->license_no)?$listing->license_no:''; ?>" id="license_no" class="form-control" type="text" required>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="date_issued" class="col-sm-2 control-label">Date of Issued</label>

                        <div class="col-sm-5">
                            <span><?php echo isset($listing->added_on)?date('M d,Y',strtotime($listing->added_on)):''; ?></span>
                            <!-- <input name="date_issued" value="<?php echo isset($listing->added_on)?date('M d,Y',strtotime($listing->added_on)):''; ?>" id="license_validity_date" class="form-control" type="date" required> -->

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="license_validity_date" class="col-sm-2 control-label">Validity Date</label>

                        <div class="col-sm-5">

                            <input name="license_validity_date" value="<?php echo isset($listing->license_validity_date)?$listing->license_validity_date:''; ?>" id="license_validity_date" class="form-control" type="date" required>

                        </div>

                    </div>



                    <!-- <div class="form-group">

                        <label for="profileimg" class="col-sm-2 control-label">Image</label>

                        <div class="col-sm-10">

                            <input name="profileimg" id="profileimg" class="form-control" type="file" <?php echo ((isset($listing->listing_id) && $listing->listing_id)?'':'required'); ?>>

                        </div>

                    </div> -->

                                                                        

                    <div class="form-group">

                        <label for="status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10">


                            <?php
                                if(!empty($professional_status))
                                {
                                    $checked = '';
                                    foreach ($professional_status as $key => $value) {

                                        if(!isset($listing->status) && $value['professional_status_id']==1) {
                                            $checked = "checked";
                                            }else{
                                                $checked = "";
                                            }
                                        
                                    
                            ?>
                            <label class="radio-inline">

                                <input type="radio" name="status" id="status_<?php echo $value['professional_status_id']; ?>" value="<?php echo $value['professional_status_id']; ?>" <?php echo (isset($listing->status) && $listing->status==$value['professional_status_id'])? 'checked="checked"':''; ?> <?php echo $checked; ?>> <?php echo $value['name'];?>

                            </label>
                            <?php } } ?>

                            <!-- <label class="radio-inline">

                                <input type="radio" name="status" id="status0" value="0" <?php echo (isset($listing->status) && $listing->status !=1)? 'checked="checked"':''; ?>> Inactive

                            </label> -->

                        </div>

                    </div>
                    <?php
                    if(isset($listing->image))
                    {
                    ?>
                    <div class="form-group row">
                    <div class="col-sm-2"></div>
                    
                        <img src="<?php echo base_url('assets/images/profile/').$listing->image; ?>" id="usersPhoto">
                    
                    </div>
                    <?php } ?>

                    <div class="form-group">
                            <label for="photo" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">
                                <input type="file" class="form-control" id="photo" name="photo" value="">
                                
                            </div>

                        </div>

                    </div>        

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>

                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>

                                <?php echo anchor('admin/listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>

                            </div>

                        </div>

                    </div>

                    <?php echo form_close();?>

                    </div>

                </div>

            </div>

        </div>



        </div>

    </div> 

</div>

</main>

                





