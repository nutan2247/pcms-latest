<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid">
    <h2 class="mt-4"><?php echo $page_title; ?></h2>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <?php echo $page_title; ?>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body"> 
					<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_download','enctype' => 'multipart/form-data')); //echo "<pre>"; print_r($cms); echo "</pre>";  ?>				
							
							<?php echo form_hidden('dwnid', isset($cms->dwnid)?$cms->dwnid:'');?>
							
							<div class="form-group">
								<label for="file_name" class="col-sm-2 control-label">Document Name</label>
								<div class="col-sm-10">
									<input name="file_name" value="<?php echo isset($cms->file_name)?$cms->file_name:''; ?>" id="file_name" class="form-control" type="text" required>
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="dowloadfile" class="col-sm-2 control-label">Upload File</label>
								<div class="col-sm-10">
									<input name="dowloadfile" id="dowloadfile" class="form-control" type="file" >
									<input name="old_dowloadfile" id="old_dowloadfile" class="form-control" type="hidden" value="<?php echo isset($cms->dowloadfile)?$cms->dowloadfile:''; ?>">
									
								</div>
							</div>
							<div class="form-group">
								<label for="status" class="col-sm-2 control-label">Status</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="status" id="status1" value="1" <?php echo (isset($cms->status) && $cms->status==1)? 'checked="checked"':''; ?>> Active
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" id="status0" value="0" <?php echo (isset($cms->status) && $cms->status !=1)? 'checked="checked"':''; ?>> Inactive
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('admin/download', 'Cancel', array('class' => 'btn btn-default btn-flat')); ?>
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