<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

        
        <div class="card mb-4 mt-4">
            
        <div class="card">
        <div class="card-header">
            <div class="clearfix right-side-btn">
                <h3 class="float-left"><?php echo $page_title; ?></h3>
                <a class="btn btn-primary float-right mr-2" href="<?php echo site_url('admin/publish_exam_question_listing'); ?>">Back</a>
                <a class="btn btn-primary float-right mr-2" href="<?php echo base_url('admin/question_paper_preview/'.$this->uri->segment(3)); ?>" >QUESTIONNAIRES</a>
                <a class="btn btn-primary float-right mr-2" href="<?php echo base_url('admin/answer_key/'.$this->uri->segment(3)); ?>" >ANSWER KEY</a>
            </div>
        </div>
        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 


                        <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_lesson')); //echo "<pre>"; print_r($schedule); echo "</pre>";  ?>

                        <div class="form-group">
                            <label for="required_units" class="col-sm-12 control-label">Exam Date : <b><?php echo date('F d,Y',strtotime($schedule->date)); ?></b></label>
                        </div> 

                        <div class="form-group">
                            <label for="required_units" class="col-sm-12 control-label">Name of Exam : <b><?php echo $schedule->name_of_exam; ?></b></label>
                        </div>

                        <div class="form-group">
                            <label for="required_units" class="col-sm-12 control-label">Total Number of Questions in this Exam  : <b><?=count($all_questions)?></b></label>
                            
                        </div>                        
                    
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th>S. no.</th>
                                            <th>Question</th>
                                            <th>Rationale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $encodedquestionno='';
                                            if(isset($all_questions) && count($all_questions)>0){
                                                $count=1;
                                            $all_qno = array_column($all_questions,'id');
                                            $encodedquestionno = implode(',',$all_qno);
                                            
                                            foreach($all_questions as $value){ ?>
                                                <tr>
                                                    <td><?=$count; ?></td>
                                                    <td><?=$value->question_title; ?></td>
                                                    <td><?=readMoreHelper($value->rationale,100);?></td>
                                                </tr>
                                            <?php $count++; } 
                                            }else{ echo '<tr><td colspan="3">No question found!</td></tr>'; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_input(array('type' => 'hidden','name' => 'question_numbers', 'value'=>$encodedquestionno)); ?>
                                <?php echo form_input(array('type' => 'hidden','name' => 'total_question', 'id'=>'total_questions','value'=>count($all_questions))); ?>
                                <?php echo form_input(array('type' => 'hidden','name' => 'es_id', 'id' =>'es_id', 'value' => $schedule->es_id)); ?>
                                <?php echo form_input(array('type' => 'hidden','name' => 'pqs_id', 'id' =>'pqs_id', 'value' => isset($published_set->pqs_id)?$published_set->pqs_id:"")); ?>
                                <?php if(count($all_questions)>0){ ?>
                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Publish')); ?>
                                    <a href="<?=base_url('admin/unpublish_exam_question/'.$published_set->pqs_id) ?>" class="btn btn-warning">Unpublished</a>
                                <?php } ?>

                                <?php echo anchor('admin/publish_exam_question_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>
                                
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

</div>
    
        <?php 
        function readMoreHelper($story_desc, $chars) {
            $story_desc = substr($story_desc,0,$chars);  
            $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
            $story_desc = $story_desc." <a href='javascript:void(0);'>Read More...</a>";  
            return $story_desc;  
        } 
        ?> 
</main>

<!-- <script>
    $( document ).ready(function() {
        var set_no = $('#es_id').val();
        alert(set_no);
        $.ajax({
            type: "POST", 
            url: "<?php echo base_url('admin/get_question_details/'); ?>"+set_no,
            dataType: "json", 
            success: function(result){
            var total =  result.length;   
                console.log(total);
            $('#tquestions').html(total);
            $('#total_questions').val(total);

            }
        });
    });
</script> -->