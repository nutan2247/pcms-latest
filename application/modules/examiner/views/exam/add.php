<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">
        <div class="clearfix">
            <h4 class="float-left mb-4 mt-4"><?php echo $page_title; ?></h4>
            <a class="btn btn-primary mb-4 mt-4 float-right" href="<?php echo site_url('examiner/dashboard'); ?>">Back</a>
        </div>  
        
        
    <div class="card mb-4">
        <!-- <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            <?php echo $table_name; ?>
            </div>  -->

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 



                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_lesson')); //echo "<pre>"; print_r($lesson); echo "</pre>";  ?>

                    <div id="copycontent"> 
                    <!--<div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Exam Date</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="set_no" id="set_no" required>
                                <option >Please select exam date</option>
                                <?php /*foreach($exam_dates as $value){ ?>
                                <option value="<?php echo $value->es_id; ?>"> <?php echo $value->name_of_exam.' ( '.$value->date.' )'; ?> </option>
                                <?php } */?>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Question Category</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="ques_cat_id" id="ques_cat_id" required>
                                <option value="">Please select exam ques category</option>
                                <?php foreach($ques_category as $value){ ?>
                                <option value="<?php echo $value->excat_id; ?>"> <?php echo $value->category_name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>                       
                    <!-- <div class="form-group" id="newSetBox" style="display: none;">
                        <label for="name" class="col-sm-12 control-label">Add New Set Number</label>
                        <div class="col-sm-12">
                            <input name="new_set_no" value="" id="new_set_no" class="form-control" type="text">
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Question Title 1</label>
                        <div class="col-sm-12">
                            <input name="question_title[0]" value="" id="question_title" class="form-control" type="text" required>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 1 </label>
                        <div class="col-sm-12">
                            <input name="answere1[0]" value="" id="answere1" class="form-control" type="text" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 2 </label>
                        <div class="col-sm-12">
                            <input name="answere2[0]" value="" id="answere2" class="form-control" type="text" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 3 </label>
                        <div class="col-sm-12">
                            <input name="answere3[0]" value="" id="answere3" class="form-control" type="text" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 4 </label>
                        <div class="col-sm-12">
                            <input name="answere4[0]" value="" id="answere4" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Correct Answer</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="correct_answere[0]" required>
                                <option value="">Please select one answer</option>
                                <option value="1"> Answer 1</option>
                                <option value="2"> Answer 2</option>
                                <option value="3"> Answer 3</option>
                                <option value="4"> Answer 4</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Rationale</label>
                        <div class="col-sm-12">
                            <textarea name="rationale[0]" id="rationale" cols="30" rows="10"  class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <button class="btn btn-success add-more pull-right" type="button"><i class="glyphicon glyphicon-plus"></i> Add Question</button>
                    </div> 
                </div>

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>

                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>

                                <?php echo anchor('examiner/dashboard', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>

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
         $("#copycontent").append('<span class="remove-section-tab" id="copycontent'+lessioncount+'"><a class="btn btn-danger remove float-right" alt="remove" data-id="'+lessioncount+'">X</a><div class="form-group"><label for="name" class="col-sm-12 control-label">Question Title '+lessionnum+'</label><div class="col-sm-12"><input name="question_title['+lessioncount+']" value="" class="form-control" type="text" required></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Answer 1 </label><div class="col-sm-12"><input name="answere1['+lessioncount+']" value="" class="form-control" type="text" required></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Answer 2 </label><div class="col-sm-12"><input name="answere2['+lessioncount+']" value="" class="form-control" type="text" required></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Answer 3 </label><div class="col-sm-12"><input name="answere3['+lessioncount+']" value="" class="form-control" type="text" required></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Answer 4 </label><div class="col-sm-12"><input name="answere4['+lessioncount+']" value="" class="form-control" type="text" required></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Correct Answer</label><div class="col-sm-12"><select class="form-control" name="correct_answere['+lessioncount+']" required><option value="">Please select one answer</option><option value="1"> Answer 1</option><option value="2"> Answer 2</option><option value="3"> Answer 3</option><option value="4"> Answer 4</option></select></div></div><div class="form-group"><label for="required_units" class="col-sm-12 control-label">Rationale</label><div class="col-sm-12"> <textarea name="rationale['+lessioncount+']" id="rationale" rows="10"  class="form-control"></textarea></div></div><div class="col-md-6"><button class="btn btn-success add-more pull-right" type="button"><i class="glyphicon glyphicon-plus"></i> Add Question</button></div></div></span>');
      });
      $("body").on("click",".remove",function(){ 
          var dataid = $(this).data("id");
         $('#copycontent'+dataid).remove();
      });

});
</script>             





