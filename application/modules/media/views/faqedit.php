<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid mt-4">
		<div class="clearfix">
			<h3 class="float-left"><?php echo $page_title; ?></h3>
			<a class="btn btn-primary float-right" href="<?php echo base_url('media/newsnmedia');?>">Back</a>
		</div>
    <div class="card">
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body"> 
					<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_faq'));  ?>
							<?php echo form_hidden('faq_id', isset($faq->faq_id)?$faq->faq_id:'');?>

						<!--<div class="form-group">
								<label for="news_title" class="col-sm-2 control-label">Faq Category</label>
								<div class="col-sm-12">
									<select name="faq_category" id="faq_category" class="form-control" required >
										<?php
											foreach($newscategoryarr as $newscat){
												$selected = (isset($faq->faq_category) && $faq->faq_category == $newscat->newscat_id)?'selected':'';
												echo '<option value="'.$newscat->newscat_id.'" '.$selected.'>'.$newscat->news_category_name.'</option>';
											}
										?>
									</select>
								</div>
							</div>-->

							<div class="form-group">
								<label for="faq_status" class="col-sm-2 control-label">Faq Page</label>
								<div class="col-sm-12">
									<label class="radio-inline">
										<input type="radio" name="faq_page" id="faq_page1" value="1" <?php echo (isset($faq->faq_page) && $faq->faq_page==1)? 'checked="checked"':'checked'; ?>> Licensure Page
									</label>
									<label class="radio-inline">
										<input type="radio" name="faq_page" id="faq_page2" value="2" <?php echo (isset($faq->faq_page) && $faq->faq_page ==2)? 'checked="checked"':''; ?>> Examination Page
									</label>
									<label class="radio-inline">
										<input type="radio" name="faq_page" id="faq_page3" value="3" <?php echo (isset($faq->faq_page) && $faq->faq_page ==3)? 'checked="checked"':''; ?>> Continuing Edu. Page
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="faq_title" class="col-sm-2 control-label">Faq Title</label>
								<div class="col-sm-12">
									<input name="faq_title" value="<?php echo isset($faq->faq_title)?$faq->faq_title:''; ?>" id="faq_title" class="form-control" type="text" required>
								</div>
							</div>
							
                            <div class="form-group">
								<label for="faq_description" class="col-sm-2 control-label">Faq Description</label>
								<div class="col-sm-12">
									<textarea name="faq_description" id="faq_description" class="form-control" rows="8" ><?php echo isset($faq->faq_description)?$faq->faq_description:''; ?></textarea>
								</div>
							</div>
                            
                            <div class="form-group">
								<label for="faq_position" class="col-sm-2 control-label">Faq Position</label>
								<div class="col-sm-2">
									<input name="faq_position" value="<?php echo isset($faq->faq_position)?$faq->faq_position:''; ?>" id="faq_position" class="form-control" type="text" required>
								</div>
							</div>
							
                            <div class="form-group">
								<label for="faq_status" class="col-sm-2 control-label">Faq Status</label>
								<div class="col-sm-12">
									<label class="radio-inline">
										<input type="radio" name="faq_status" id="faq_status1" value="1" <?php echo (isset($faq->faq_status) && $faq->faq_status==1)? 'checked="checked"':''; ?>> Active
									</label>
									<label class="radio-inline">
										<input type="radio" name="faq_status" id="faq_status0" value="0" <?php echo (isset($faq->faq_status) && $faq->faq_status !=1)? 'checked="checked"':''; ?>> Inactive
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-12">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('media/faq', 'Cancel', array('class' => 'btn btn-default btn-flat')); ?>
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