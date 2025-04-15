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

                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_countries')); //echo "<pre>"; print_r($countries); echo "</pre>";  ?>
                    <?php echo form_hidden('countries_id', isset($countries->countries_id)?$countries->countries_id:'');?>
                            
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" value="<?php echo isset($countries->countries_name)?$countries->countries_name:''; ?>" id="name" class="form-control" type="text" required>
                        </div>
                    </div>    
                    
                    <div class="form-group">
                        <label for="iso_code" class="col-sm-2 control-label">ISO Code</label>
                        <div class="col-sm-5">
                            <input name="iso_code" value="<?php echo isset($countries->countries_iso_code)?$countries->countries_iso_code:''; ?>" id="iso_code" class="form-control" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isd_code" class="col-sm-2 control-label">ISD Code</label>
                        <div class="col-sm-5">
                            <input name="isd_code" value="<?php echo isset($countries->countries_isd_code)?$countries->countries_isd_code:''; ?>" id="isd_code" class="form-control" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status1" value="1" <?php echo (isset($countries->status) && $countries->status==1)? 'checked="checked"':''; ?>> Active
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status0" value="0" <?php echo (isset($countries->status) && $countries->status !=1)? 'checked="checked"':''; ?>> Inactive
                            </label>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="btn-group">
                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
                                <?php echo anchor('admin/country_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>
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
                


