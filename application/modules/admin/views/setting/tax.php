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
                    <?php if($setting_data) { ?>
                    <?php echo $this->session->flashdata('update_success'); ?>
                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_countries')); //echo "<pre>"; print_r($countries); echo "</pre>";  ?>
                    
					<div class="form-group">
                        <label for="tax" class="col-sm-2 control-label">Tax (%)</label>
                        <div class="col-sm-5">
                            <input name="tax" value="<?php echo ($setting_data!="")?$setting_data[0]['tax']:"";?>" step=".01" id="tax" class="form-control" type="number" >
                            <?php echo form_error('tax', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="btn-group">
                                
                            <input name="setting_id" value="<?php echo ($setting_data!="")?$setting_data[0]['setting_id']:""; ?>" id="setting_id" type="hidden">
                                 <input type="submit" name="update" value="update" class="btn btn-primary btn-flat">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();
                    } ?>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div> 
</div>
</main>
                


