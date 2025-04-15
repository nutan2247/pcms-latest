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
                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_countries')); 
                    //echo "<pre>"; print_r($countries); echo "</pre>";  ?>
                    
                    <!-- <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-5">
                            <input name="amount" value="<?php echo ($setting_data!="")?$setting_data[0]['amount']:"";?>" id="amount" class="form-control" type="number">
                            <?php echo form_error('amount', '<div class="error">', '</div>'); ?>
                        </div>
                        </div>-->

                    <div class="form-group">
                        <label for="signature_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-5">
                            <input name="signature_name" value="<?php echo ($setting_data!="")?$setting_data[0]['signature_name']:"";?>" id="signature_name" class="form-control" type="text" >
                            <?php echo form_error('signature_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="position" class="col-sm-2 control-label">Position</label>
                        <div class="col-sm-5">
                            <input name="position" value="<?php echo ($setting_data!="")?$setting_data[0]['position']:"";?>" id="position" class="form-control" type="text" >
                            <?php echo form_error('position', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rb_name" class="col-sm-2 control-label">RBoard Name</label>
                        <div class="col-sm-5">
                            <input name="rb_name" value="<?php echo ($setting_data!="")?$setting_data[0]['rb_name']:"";?>" id="rb_name" class="form-control" type="text" >
                            <?php echo form_error('rb_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<!-- <div class="form-group">
                        <label for="tax" class="col-sm-2 control-label">Tax (%)</label>
                        <div class="col-sm-5">
                            <input name="tax" value="<?php echo ($setting_data!="")?$setting_data[0]['tax']:"";?>" id="tax" class="form-control" type="number" >
                            <?php echo form_error('tax', '<div class="error">', '</div>'); ?>
                        </div>
                    </div> -->

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
                


