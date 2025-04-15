<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h2 class="mt-4"><?php echo $page_title; ?></h2>

    <div class="card mb-4">

        <div class="card-header">

            <i class="fas fa-table mr-1"></i>

            <?php echo $table_name; ?>
            <a class="btn btn-primary float-right" href="<?php echo site_url('examiner/dashboard'); ?>">Back</a>


        </div>

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 



                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_question')); //echo "<pre>"; print_r($question); echo "</pre>";  ?>

                    <?php echo form_hidden('question_id', isset($question->id)?$question->id:'');?>
                    <div id="copycontent">  
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Exam Date</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="set_no" id="set_no">
                                <option>Please select exam date</option>
                                 <?php foreach($exam_dates as $value){ 
                                    if($question->set_no == $value->es_id){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }?>
                                <option value="<?php echo $value->es_id; ?>" <?=$selected; ?>> <?php echo $value->name_of_exam.' ( '.$value->date.' )'; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Question Category</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="ques_cat_id" id="ques_cat_id" required>
                                <option >Please select exam ques category</option>
                                <?php foreach($ques_category as $value){ ?>
                                <option value="<?php echo $value->excat_id; ?>"<?=($question->excat_id==$value->excat_id)?'selected':'';?>> <?php echo $value->category_name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>                  
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Questions Title</label>
                        <div class="col-sm-12">
                            <input name="question_title" value="<?php echo $question->question_title; ?>" id="question_title" class="form-control" type="text" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 1</label>
                        <div class="col-sm-12">
                            <input name="answere1" value="<?php echo $question->answere1;?>" id="answere1" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 2</label>
                        <div class="col-sm-12">
                            <input name="answere2" value="<?php echo $question->answere2;?>" id="answere2" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 3</label>
                        <div class="col-sm-12">
                            <input name="answere3" value="<?php echo $question->answere3;?>" id="answere3" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Answer 4</label>
                        <div class="col-sm-12">
                            <input name="answere4" value="<?php echo $question->answere4;?>" id="answere4" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Correct Answer</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="correct_answere">
                                <option >Please select one answer</option>
                                <option value="1" <?php if($question->correct_answere==1){ echo 'selected'; } ?> > Answere 1</option>
                                <option value="2" <?php if($question->correct_answere==2){ echo 'selected'; } ?>> Answere 2</option>
                                <option value="3" <?php if($question->correct_answere==3){ echo 'selected'; } ?>> Answere 3</option>
                                <option value="4" <?php if($question->correct_answere==4){ echo 'selected'; } ?>> Answere 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Rationale</label>
                        <div class="col-sm-12">
                        <textarea name="rationale" id="rationale" class="form-control" cols="30" rows="10"><?php echo $question->rationale;?></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="status" id="status1" value="1" <?php echo (isset($question->status) && $question->status==1)? 'checked="checked"':''; ?>> Submit to Admin
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="status" id="status0" value="0" <?php echo (isset($question->status) && $question->status !=1)? 'checked="checked"':''; ?>> Pending

                            </label>
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






