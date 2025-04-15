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
					<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_cms','enctype' => 'multipart/form-data')); //echo "<pre>"; print_r($cms); echo "</pre>";  ?>	
							<?php echo form_hidden('cms_id', isset($cms->cms_id)?$cms->cms_id:'');?>
							
							<div class="form-group">
								<label for="cms_title" class="col-sm-2 control-label">Cms Title</label>
								<div class="col-sm-10">
									<input name="cms_title" value="<?php echo isset($cms->cms_title)?$cms->cms_title:''; ?>" id="cms_title" class="form-control" type="text" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="cms_url" class="col-sm-2 control-label">Cms URL</label>
								<div class="col-sm-10">
									<input name="cms_url" value="<?php echo isset($cms->cms_url)?$cms->cms_url:''; ?>" id="cms_url" class="form-control" type="text" required>
								</div>
							</div>
							
                            <!--<div class="form-group">
								<label for="cms_description" class="col-sm-2 control-label">Cms Description</label>
								<div class="col-sm-10">
									<textarea name="cms_description" id="cms_description" class="form-control" rows="4"><?php echo isset($cms->cms_description)?$cms->cms_description:''; ?></textarea>
								</div>
							</div>
                            
                            <div class="form-group">
								<label for="cms_meta_title" class="col-sm-2 control-label">Cms Meta Title</label>
								<div class="col-sm-10">
									<input name="cms_meta_title" value="<?php echo isset($cms->cms_meta_title)?$cms->cms_meta_title:''; ?>" id="cms_meta_title" class="form-control" type="text" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="cms_meta_description" class="col-sm-2 control-label">Cms Meta Description</label>
								<div class="col-sm-10">
									<input name="cms_meta_description" value="<?php echo isset($cms->cms_meta_description)?$cms->cms_meta_description:''; ?>" id="cms_meta_description" class="form-control" type="text" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="cms_meta_keyword" class="col-sm-2 control-label">Cms Meta Keyword</label>
								<div class="col-sm-10">
									<input name="cms_meta_keyword" value="<?php echo isset($cms->cms_meta_keyword)?$cms->cms_meta_keyword:''; ?>" id="cms_meta_keyword" class="form-control" type="text" required>
								</div>
							</div> -->
							<div class="form-group">
								<label for="banner" class="col-sm-2 control-label">Banner</label>
								<div class="col-sm-10">
									<input name="banner" id="banner" class="form-control" type="file" >
									<input name="old_banner" id="old_banner" class="form-control" type="hidden" value="<?php echo isset($cms->banner)?$cms->banner:''; ?>">
									<?php 
										if(isset($cms->banner) && $cms->banner !=""){
											if(file_exists('./assets/images/banner/'.$cms->banner)){
												echo '<br><img src="'.base_url().'assets/images/banner/'.$cms->banner.'"  height="100">';
											}
										}
									?>
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="bannertext" class="col-sm-2 control-label">Banner Text</label>
								<div class="col-sm-10">
									<textarea name="bannertext" id="bannertext" class="form-control" rows="4"><?php echo isset($cms->bannertext)?$cms->bannertext:''; ?></textarea>
								</div>
							</div> -->
							<div class="form-group">
								<label for="cms_description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<textarea name="cms_description" id="cms_description" class="form-control" rows="4"><?php echo isset($cms->cms_description)?$cms->cms_description:''; ?></textarea>
								</div>
							</div>
                            <div class="form-group">
								<label for="cms_status" class="col-sm-2 control-label">Cms Status</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="cms_status" id="cms_status1" value="1" <?php echo (isset($cms->cms_status) && $cms->cms_status==1)? 'checked="checked"':''; ?>> Active
									</label>
									<label class="radio-inline">
										<input type="radio" name="cms_status" id="cms_status0" value="0" <?php echo (isset($cms->cms_status) && $cms->cms_status !=1)? 'checked="checked"':''; ?>> Inactive
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('admin/cms', 'Cancel', array('class' => 'btn btn-default btn-flat')); ?>
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