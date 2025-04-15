<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">
    <div class="clearfix">
        <h4 class="mt-4 mb-2 float-left"><?php echo $page_title; ?></h4>
        <a class="btn btn-primary mt-4 mb-2 float-right" href="<?php echo base_url('admin/lesson'); ?>" >Back</a>
    </div>

    <div class="card mb-4">

        <!-- <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <?php echo $table_name; ?>
        </div> -->

        <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body"> 

                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_lesson')); //echo "<pre>"; print_r($lesson); echo "</pre>";  ?>

                    <?php // echo form_hidden('lesson_id', isset($lesson->id)?$lesson->id:'');?>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Guidelines For</label>
                        <div class="col-sm-12">
                            <select name="guidline_for" id="guidline_for" class="form-control" required>
                                <option value="">Please select one</option>
                                <option value="fp">Foreign Professional</option>
                                <option value="g">Local Graduates</option>
                            </select>
                        </div>
                    </div>
                    <div id="copycontent">                         
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Guidelines Title 1</label>
                        <div class="col-sm-12">
                            <input name="lesson_title[0]" value="" id="lesson_title" class="form-control" type="text" required>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Attached Video (MP4 File)</label>
                        <div class="col-sm-12">
                            <input name="lesson_video[0]" value="" id="lesson_video" class="form-control" type="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Youtube Video Link:</label>
                        <div class="col-sm-12">
                            <input name="youtube_video[0]" value="" id="youtube_video" class="form-control" type="text" placeholder="https://">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="general_units" class="col-sm-12 control-label">Content</label>
                        <div class="col-sm-12">
                            <textarea name="lesson_content[0]" class="form-control" id="lesson_content" placeholder="Please write here..."> </textarea>  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-success add-more pull-right" type="button"><i class="glyphicon glyphicon-plus"></i> Add Lesson</button>
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
<style>
#copycontent .form-control {
    height: 45px;
}
.add-more {
    margin: 15px 0 25px 0;
}
.remove {
    margin: 0 15px 13px 0;
    color: #fff !important;
    display: block;
}
.remove-section-tab {
    display: block;
    position: relative;
}
.remove {
    position: absolute;
    top: -62px;
    right: 0;
}
</style>
   
    <script type="text/javascript">

    $(document).ready(function() {
        var lessioncount = 0;
        var lessionnum = 1;

        $("body").on("click",".add-more",function(){ 
        lessioncount++;
        lessionnum++;
        var html = $("#copycontent").html();
         $("#copycontent").append('<span class="remove-section-tab" id="copycontent'+lessioncount+'"><a class="btn btn-danger remove float-right" alt="remove" data-id="'+lessioncount+'">X</a></div><div class="form-group"><label for="name" class="col-sm-2 control-label">Lessons Title '+lessionnum+'</label><div class="col-sm-12"><input name="lesson_title['+lessioncount+']" value="" id="lesson_title'+lessioncount+'" class="form-control" type="text" required></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Attached Video (MP4 File)</label><div class="col-sm-12"><input name="lesson_video['+lessioncount+']" value="" id="lesson_video'+lessioncount+'" class="form-control" type="file"></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Youtube Video Link:</label><div class="col-sm-12"><input name="youtube_video['+lessioncount+']" value="" id="youtube_video'+lessioncount+'" class="form-control" type="text" placeholder="https://"></div></div><div class="form-group"><label for="general_units" class="col-sm-2 control-label">Lessons Content</label><div class="col-sm-12"><textarea name="lesson_content['+lessioncount+']" class="form-control" id="lesson_content'+lessioncount+'" placeholder="Please write here..."> </textarea></div></div><div class="col-sm-12"><button class="btn btn-success add-more pull-right" type="button"><i class="glyphicon glyphicon-plus"></i> Add Lesson</button></div></div>');
      });
      $("body").on("click",".remove",function(){ 
          var dataid = $(this).data("id");
         $('#copycontent'+dataid).remove();
      });

});
</script>             





