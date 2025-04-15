<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid">
		<div class="clearfix">
			<h3 class="float-left"><?php echo $page_title; ?></h3>
		<a class="btn btn-primary float-right" href="<?php echo base_url('media/newsnmedia');?>">Back</a>
	</div>
    <div class="card mb-4">
        <!-- <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <?php echo $page_title; ?>
        </div> -->
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body"> 
					<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_cms','enctype' => 'multipart/form-data')); //echo "<pre>"; print_r($cms); echo "</pre>";  ?>						
							
							<?php echo form_hidden('newscat_id', isset($cms->newscat_id)?$cms->newscat_id:'');?>
							
							<div class="form-group">
								<label for="news_category_name" class="col-sm-2 control-label">Category Name</label>
								<div class="col-sm-12">
									<input name="news_category_name" value="<?php echo isset($cms->news_category_name)?$cms->news_category_name:''; ?>" id="news_category_name" class="form-control" type="text" required>
								</div>
							</div>
							<div class="form-group">
								<label for="display_position" class="col-sm-2 control-label">Display Position</label>
								<div class="col-sm-12">
									<input name="display_position" value="<?php echo isset($cms->display_position)?$cms->display_position:''; ?>" id="display_position" class="form-control" type="number" required>
								</div>
							</div>
							
							
                            <div class="form-group">
								<label for="news_status" class="col-sm-2 control-label">News Status</label>
								<div class="col-sm-12">
									<label class="radio-inline">
										<input type="radio" name="news_status" id="news_status1" value="1" <?php echo (isset($cms->news_status) && $cms->news_status==1)? 'checked="checked"':''; ?>> Active
									</label>
									<label class="radio-inline">
										<input type="radio" name="news_status" id="news_status0" value="0" <?php echo (isset($cms->news_status) && $cms->news_status !=1)? 'checked="checked"':''; ?>> Inactive
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-12">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('media/newscategories', 'Cancel', array('class' => 'btn btn-default btn-flat')); ?>
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