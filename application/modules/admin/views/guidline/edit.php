<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h2 class="mt-4"><?php echo $page_title; ?>
    </h2>
        
    <div class="card mb-4">

        <div class="card-header">

            <i class="fas fa-table mr-1"></i>

            <?php echo $table_name; ?>
            <a class="btn btn-primary float-right" href="<?php echo site_url('admin/lesson'); ?>">Back</a>

        </div>

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 



                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_lesson')); //echo "<pre>"; print_r($lesson); echo "</pre>";  ?>

                    <?php echo form_hidden('lesson_id', isset($lesson->id)?$lesson->id:'');?>
                    <div id="copycontent">                         
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Lessons Title 1</label>
                        <div class="col-sm-12">
                            <input name="lesson_title" value="<?php echo $lesson->lesson_title; ?>" id="lesson_title" class="form-control" type="text" required>
                        </div>
                    </div>    
                <?php if($lesson->lesson_video !=''){ ?>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Attached Video (Uploaded MP4 File)</label>
                        <div class="col-sm-12">
                            <video width="540" height="310" controls>
                              <source src="<?php echo base_url('assets/upload/video/').$lesson->lesson_video; ?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                <?php } ?>

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Attached Video (MP4 File)</label>
                        <div class="col-sm-12">
                            <input name="lesson_video" value="" id="lesson_video" class="form-control" type="file">
                        </div>
                    </div>

                <?php if($lesson->youtube_video !=''){
                    $videourl = explode('v=',$lesson->youtube_video); 
                    $urlstring = $videourl[1];
                    $url = substr($urlstring,0,11);
                    ?>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Youtube Video (Uploaded)</label>
                        <div class="col-sm-12">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php } ?>

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Youtube Video Link:</label>
                        <div class="col-sm-12">
                            <input name="youtube_video" value="<?php echo $lesson->youtube_video;?>" id="youtube_video" class="form-control" type="text" placeholder="https://">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="general_units" class="col-sm-12 control-label">Lessons Content</label>
                        <div class="col-sm-12">
                            <textarea name="lesson_content" class="form-control" rows="10" id="lesson_content" placeholder="Please write here..."><?php echo $lesson->lesson_content; ?></textarea>  
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status1" value="1" <?php echo (isset($lesson->status) && $lesson->status==1)? 'checked="checked"':''; ?>> Active
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="status" id="status0" value="0" <?php echo (isset($lesson->status) && $lesson->status !=1)? 'checked="checked"':''; ?>> Inactive

                            </label>
                        </div>


                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>

                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>

                                <?php echo anchor('admin/lesson', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>

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





