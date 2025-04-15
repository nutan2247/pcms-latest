<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h2 class="mt-4"><?php echo $page_title; ?></h2>

    <div class="card mb-4">

        <div class="card-header">

            <i class="fas fa-table mr-1"></i>

            <?php echo $table_name; ?>

        </div>

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 



                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_listing')); //echo "<pre>"; print_r($listing); echo "</pre>";  ?>

                    <?php echo form_hidden('listing_id', isset($listing->cep_ID)?$listing->cep_ID:'');?>

                            

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



                    <!-- <div class="form-group">

                        <label for="country" class="col-sm-2 control-label">Country</label>

                        <div class="col-sm-10">

                            <select name="country" id="country" class="form-control" >

                            <option value="">Choose Country</option>

                            <?php foreach($country_list as $country){

                                $countryselected = (isset($listing->country) && $listing->country == $country->countries_id)?'selected':'';

                                echo '<option value="'.$country->countries_id.'"'.$countryselected.' >'.$country->countries_name.'</option>';  } ?>

                            </select>

                        </div>

                    </div> 



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
 -->
                    

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

                        <label for="contact_person" class="col-sm-2 control-label">Contact Person</label>

                        <div class="col-sm-10">

                            <input name="contact_person" id="contact_person" class="form-control" value="<?php echo isset($listing->contact_person)?$listing->contact_person:''; ?>">

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="contact_no" class="col-sm-2 control-label">Contact Number</label>

                        <div class="col-sm-10">

                            <input name="contact_no" id="contact_no" class="form-control" value="<?php echo isset($listing->contact_no)?$listing->contact_no:''; ?>" >

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="accreditation" class="col-sm-2 control-label">Accreditation</label>

                        <div class="col-sm-5">

                            <input name="accreditation" value="<?php echo isset($listing->accreditation)?$listing->accreditation:''; ?>" id="accreditation" class="form-control" type="text" required>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="issued_date" class="col-sm-2 control-label">Issued Date</label>

                        <div class="col-sm-5">

                            <input name="issued_date" value="<?php echo isset($listing->issued_date)?$listing->issued_date:''; ?>" id="issued_date" class="form-control" type="date" required>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="validity_date" class="col-sm-2 control-label">Validity Date</label>

                        <div class="col-sm-5">

                            <input name="validity_date" value="<?php echo isset($listing->validity_date)?$listing->validity_date:''; ?>" id="validity_date" class="form-control" type="date" required>

                        </div>

                    </div>


                    <?php $dpImage = isset($listing->image)?$listing->image:'';
                     if($dpImage != ""){ ?>
                    <div class="form-group">

                        <label for="image" class="col-sm-2 control-label">Uploaded Image</label>

                        <div class="col-sm-10 dp-image">
                            <img src="<?php echo base_url('assets/images/dp/').$listing->image; ?>">

                        </div>

                    </div>
                    <?php } ?>

                    <div class="form-group">

                        <label for="image" class="col-sm-2 control-label">Image</label>

                        <div class="col-sm-10">
                            <input name="image" id="image" class="form-control" type="file">

                        </div>

                    </div>

                                                                        

                    <div class="form-group">

                        <label for="status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10">

                            <label class="radio-inline">

                                <input type="radio" name="status" id="status1" value="1" <?php echo (isset($listing->status) && $listing->status==1)? 'checked="checked"':''; ?>> Active

                            </label>

                            <label class="radio-inline">

                                <input type="radio" name="status" id="status0" value="0" <?php echo (isset($listing->status) && $listing->status !=1)? 'checked="checked"':''; ?>> Inactive

                            </label>

                        </div>

                    </div>

                            

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>

                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>

                                <?php echo anchor('admin/cep_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>

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

                





