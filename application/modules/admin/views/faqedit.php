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
					<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_faq')); //echo "<pre>"; print_r($faq); echo "</pre>";  ?>
							
							<?php echo form_hidden('faq_id', isset($faq->faq_id)?$faq->faq_id:'');?>
							<div class="form-group">
								<label for="news_title" class="col-sm-2 control-label">Choose Category</label>
								<div class="col-sm-10">
									<select name="faq_category" id="faq_category" class="form-control" required>
									<option> Choose Category</option>
										<?php
											foreach($newscategoryarr as $newscat){
												$selected = (isset($faq->faq_category) && $faq->faq_category == $newscat->newscat_id)?'selected':'';
												echo '<option value="'.$newscat->newscat_id.'" '.$selected.'>'.$newscat->news_category_name.'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="faq_title" class="col-sm-2 control-label">FAQ Title</label>
								<div class="col-sm-10">
									<input name="faq_title" value="<?php echo isset($faq->faq_title)?$faq->faq_title:''; ?>" id="faq_title" class="form-control" type="text" required>
								</div>
							</div>
							
                            <div class="form-group">
								<label for="faq_description" class="col-sm-2 control-label">FAQ Description</label>
								<div class="col-sm-10">
									<textarea name="faq_description" id="faq_description" class="form-control" rows="4" ><?php echo isset($faq->faq_description)?$faq->faq_description:''; ?></textarea>
								</div>
							</div>
                            
                            <div class="form-group">
								<label for="faq_position" class="col-sm-2 control-label">FAQ Position</label>
								<div class="col-sm-2">
									<input name="faq_position" value="<?php echo isset($faq->faq_position)?$faq->faq_position:''; ?>" id="faq_position" class="form-control" type="text" required>
								</div>
							</div>
							
                            <div class="form-group">
								<label for="faq_status" class="col-sm-2 control-label">FAQ Status</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="faq_status" id="faq_status1" value="1" <?php echo (isset($faq->faq_status) && $faq->faq_status==1)? 'checked="checked"':''; ?>> Active
									</label>
									<label class="radio-inline">
										<input type="radio" name="faq_status" id="faq_status0" value="0" <?php echo (isset($faq->faq_status) && $faq->faq_status !=1)? 'checked="checked"':''; ?>> Inactive
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('admin/faq', 'Cancel', array('class' => 'btn btn-default btn-flat')); ?>
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