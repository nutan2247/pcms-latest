<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<style type="text/css">
    .error{color:red;}
</style>>		
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
                    <div class="btn-success"><?php echo $this->session->flashdata('update_success'); ?></div>
                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_countries')); //echo "<pre>"; print_r($countries); echo "</pre>";  ?>
                    
                  

                    <div class="form-group">
                        <label for="phone_number" class="col-sm-2 control-label">Phone number</label>
                        <div class="col-sm-5">
                            <input name="phone_number" value="<?php echo ($setting_data!="")?$setting_data[0]['phone_number']:"";?>" id="phone_number" class="form-control" type="text" >
                            <?php echo form_error('phone_number', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-5">
                            <input name="address" value="<?php echo ($setting_data!="")?$setting_data[0]['address']:"";?>" id="address" class="form-control" type="text" >
                            <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="facebook" class="col-sm-2 control-label">Facebook</label>
                        <div class="col-sm-5">
                            <input name="facebook" value="<?php echo ($setting_data!="")?$setting_data[0]['facebook']:"";?>" id="facebook" class="form-control" type="url" >
                            <?php echo form_error('facebook', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="twitter" class="col-sm-2 control-label">Twitter</label>
                        <div class="col-sm-5">
                            <input name="twitter" value="<?php echo ($setting_data!="")?$setting_data[0]['twitter']:"";?>" id="twitter" class="form-control" type="url" >
                            <?php echo form_error('twitter', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="linkedin" class="col-sm-2 control-label">Linkedin</label>
                        <div class="col-sm-5">
                            <input name="linkedin" value="<?php echo ($setting_data!="")?$setting_data[0]['linkedin']:"";?>" id="linkedin" class="form-control" type="url" >
                            <?php echo form_error('linkedin', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="instagram" class="col-sm-2 control-label">Instagram</label>
                        <div class="col-sm-5">
                            <input name="instagram" value="<?php echo ($setting_data!="")?$setting_data[0]['instagram']:"";?>" id="instagram" class="form-control" type="url" >
                            <?php echo form_error('instagram', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="youtube" class="col-sm-2 control-label">Youtube</label>
                        <div class="col-sm-5">
                            <input name="youtube" value="<?php echo ($setting_data!="")?$setting_data[0]['youtube']:"";?>" id="youtube" class="form-control" type="url" >
                            <?php echo form_error('youtube', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="skype" class="col-sm-2 control-label">Skype</label>
                        <div class="col-sm-5">
                            <input name="skype" value="<?php echo ($setting_data!="")?$setting_data[0]['skype']:"";?>" id="skype" class="form-control" type="text" >
                            <?php echo form_error('skype', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="whatsapp" class="col-sm-2 control-label">Whatsapp</label>
                        <div class="col-sm-5">
                            <input name="whatsapp" value="<?php echo ($setting_data!="")?$setting_data[0]['whatsapp']:"";?>" id="whatsapp" class="form-control" type="text" >
                            <?php echo form_error('whatsapp', '<div class="error">', '</div>'); ?>
                        </div>
                    </div> 
					<div class="form-group">
                        <label for="logo" class="col-sm-2 control-label">Logo</label>
                        <div class="col-sm-5">
                            <input name="logo" value="" id="logo" class="form-control" type="file" >
                            <input name="old_logo" value="<?php echo ($setting_data!="")?$setting_data[0]['logo']:"";?>" id="old_logo" class="form-control" type="hidden" >
                            <?php echo form_error('logo', '<div class="error">', '</div>'); ?>
                        </div>
						<?php 
							if(isset($setting_data[0]['logo']) && $setting_data[0]['logo'] !=""){
								if(file_exists('./assets/images/'.$setting_data[0]['logo'])){
									echo '<br><img src="'.base_url().'assets/images/'.$setting_data[0]['logo'].'"  height="100">';
								}
							}
						?>
                    </div>

                    <!--<div class="form-group">
                        <label for="countdown" class="col-sm-2 control-label">Count Down</label>
                        <div class="col-sm-5">
                            <input name="countdown" value="<?php echo ($setting_data!="")?$setting_data[0]['count_down']:""; ?>" id="countdown" class="form-control" type="number" >
                            <?php echo form_error('countdown', '<div class="error">', '</div>'); ?>
                        </div>
                    </div> -->
                            
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="btn-group">
                                
                                 <input type="submit" name="update" value="update" class="btn btn-primary btn-flat">
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
                


