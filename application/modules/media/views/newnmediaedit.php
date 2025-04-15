<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid">
    <h3 class="mt-4"><?php echo $page_title; ?></h3>
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
							
							<?php echo form_hidden('news_id', isset($cms->news_id)?$cms->news_id:'');?>
							
							<div class="form-group">
								<label for="location" class="col-sm-2 control-label">Location</label>
								<div class="col-sm-10">
									<select name="location" id="location" class="form-control" required >
										<option value="m" <?php echo (isset($cms->location) && $cms->location =='m')?'selected':''; ?>>Main</option>
										<option value="r" <?php echo (isset($cms->location) && $cms->location =='r')?'selected':''; ?>>Right Side</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="news_title" class="col-sm-2 control-label">News Category</label>
								<div class="col-sm-10">
									<select name="newscat_id" id="newscat_id" class="form-control" required >
										<?php
											foreach($newscategoryarr as $newscat){
												$selected = (isset($cms->newscat_id) && $cms->newscat_id == $newscat->newscat_id)?'selected':'';
												echo '<option value="'.$newscat->newscat_id.'" '.$selected.'>'.$newscat->news_category_name.'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="news_title" class="col-sm-2 control-label">News Title</label>
								<div class="col-sm-10">
									<input name="news_title" value="<?php echo isset($cms->news_title)?$cms->news_title:''; ?>" id="news_title" class="form-control" type="text" required>
								</div>
							</div>
							
							<!--<div class="form-group">
								<label for="news_url" class="col-sm-2 control-label">News URL</label>
								<div class="col-sm-10">
									<input name="news_url" value="<?php echo isset($cms->news_url)?$cms->news_url:''; ?>" id="news_url" class="form-control" type="text" required>
									<small>(Don't use space & special characters in url)</small>
								</div>
							</div>-->
							
                            <div class="form-group">
								<label for="news_description" class="col-sm-2 control-label">Content</label>
								<div class="col-sm-10">
									<textarea name="news_description" id="news_description" class="form-control" rows="8"><?php echo isset($cms->news_description)?$cms->news_description:''; ?></textarea>
								</div>
							</div>
                            
                            <!--<div class="form-group">
								<label for="news_meta_title" class="col-sm-2 control-label">News Meta Title</label>
								<div class="col-sm-10">
									<input name="news_meta_title" value="<?php echo isset($cms->news_meta_title)?$cms->news_meta_title:''; ?>" id="news_meta_title" class="form-control" type="text" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="news_meta_description" class="col-sm-2 control-label">News Meta Description</label>
								<div class="col-sm-10">
									<input name="news_meta_description" value="<?php echo isset($cms->news_meta_description)?$cms->news_meta_description:''; ?>" id="news_meta_description" class="form-control" type="text" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="news_meta_keyword" class="col-sm-2 control-label">News Meta Keyword</label>
								<div class="col-sm-10">
									<input name="news_meta_keyword" value="<?php echo isset($cms->news_meta_keyword)?$cms->news_meta_keyword:''; ?>" id="news_meta_keyword" class="form-control" type="text" required>
								</div>
							</div>-->
							<div class="form-group">
								<label for="new_date" class="col-sm-2 control-label">News Date</label>
								<div class="col-sm-10">
									<input name="new_date" value="<?php echo isset($cms->new_date)?$cms->new_date:''; ?>" id="new_date" class="form-control" type="date" required>
								</div>
							</div>
							<div class="form-group">
								<label for="new_addedby" class="col-sm-2 control-label">News Added By</label>
								<div class="col-sm-10">
									<input name="new_addedby" value="<?php echo isset($cms->new_addedby)?$cms->new_addedby:$this->session->userdata('login')['name']; ?>" id="new_addedby" class="form-control" type="text" required>
								</div>
							</div>
							<div class="form-group">
								<label for="banner" class="col-sm-2 control-label">Image</label>
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
							<!--<div class="form-group">
								<label for="bannertext" class="col-sm-2 control-label">Image Text</label>
								<div class="col-sm-10">
									<textarea name="bannertext" id="bannertext" class="form-control" rows="4"><?php echo isset($cms->bannertext)?$cms->bannertext:''; ?></textarea>
								</div>
							</div> -->
                            <div class="form-group">
								<label for="news_status" class="col-sm-2 control-label">News Status</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="news_status" id="news_status1" value="1" <?php echo (isset($cms->news_status) && $cms->news_status==1)? 'checked="checked"':''; ?>> Published
									</label>
									<label class="radio-inline">
										<input type="radio" name="news_status" id="news_status0" value="0" <?php echo (isset($cms->news_status) && $cms->news_status !=1)? 'checked="checked"':''; ?>> Unpublished
									</label>
								</div>
							</div>
                            
                            <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="btn-group">
										<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
										<?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
										<?php echo anchor('media/newsnmedia', 'Cancel', array('class' => 'btn btn-default btn-flat')); ?>
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
<script>
$("body").on("keyup","#news_title", function(event){	
	var news_title = $(this).val();
	var newsurl = news_title.replace(/[_\s]/g, '-').replace(/[^a-z0-9-\s]/gi, '');
	$('#news_url').val(newsurl.toLowerCase());
}); 
</script>