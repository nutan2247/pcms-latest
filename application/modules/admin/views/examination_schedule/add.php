<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h3 class="mt-4"><?php echo $page_title; ?>
        <a class="btn btn-primary float-right" href="<?php echo site_url('admin/examination_schedule_listing'); ?>">Back</a>
    </h3>
        

    <div class="card mb-4">
        <div class="card-body">
        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 

                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_lesson')); //echo "<pre>"; print_r($schedule); echo "</pre>";  ?>
                    <?php echo form_hidden('es_id', isset($schedule->es_id)?$schedule->es_id:'');?>

                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Exam Name</label>
                        <div class="col-sm-12">
                            <input name="exam_name" value="<?php echo isset($schedule->name_of_exam)?$schedule->name_of_exam:''; ?>" id="exam_name" class="form-control" type="text" required>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Exam Date </label>
                        <div class="col-sm-12">
                            <input name="exam_date" value="<?php echo isset($schedule->date)?$schedule->date:''; ?>" id="exam_date" class="form-control" type="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Mode of Examination</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="exam_mode" required>
                                <option value="">Please select one</option>
                                <option value="cb" <?php if(!empty($schedule->exam_mode) && $schedule->exam_mode=='cb'){ echo 'selected'; } ?> > Computer-based </option>
                                <option value="pb" <?php if(!empty($schedule->exam_mode) && $schedule->exam_mode=='pb'){ echo 'selected';  } ?> >Paper-based </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Exam For</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="exam_for" required>
                                <option value="">Please select one</option>
                                <option value="pp" <?php if(!empty($schedule->exam_for) && $schedule->exam_for=='pp'){ echo 'selected'; } ?> > Foreign Professionals </option>
                                <option value="p" <?php if(!empty($schedule->exam_for) && $schedule->exam_for=='p'){ echo 'selected';  } ?> >Local Graduates </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Registration Start Date </label>
                        <div class="col-sm-12">
                            <input name="reg_start_date" value="<?php echo isset($schedule->reg_start_date)?$schedule->reg_start_date:''; ?>" id="reg_start_date" class="form-control" type="date" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Registration End Date </label>
                        <div class="col-sm-12">
                            <input name="reg_end_date" value="<?php echo isset($schedule->reg_end_date)?$schedule->reg_end_date:''; ?>" id="reg_end_date" class="form-control" type="date" required>
                        </div>
                    </div> 
                      

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Exam Start Time</label>
                        <div class="col-sm-12">
                            <input name="exam_start_time" value="<?php echo isset($schedule->start_time)?$schedule->start_time:''; ?>" id="exam_start_time" class="form-control" type="time" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Exam End Time</label>
                        <div class="col-sm-12">
                            <input name="exam_end_time" value="<?php echo isset($schedule->end_time)?$schedule->end_time:''; ?>" id="exam_end_time" class="form-control" type="time" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Maximum Applicant</label>
                        <div class="col-sm-12">
                            <input name="maximum_applicant" value="<?php echo isset($schedule->maximum_applicant)?$schedule->maximum_applicant:''; ?>" id="maximum_applicant" class="form-control" type="number" min="1" required <?php echo isset($schedule->maximum_applicant)?'readonly':''; ?>>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Venue</label>
                        <div class="col-sm-12">
                            <textarea name="venue" id="venue" cols="30" rows="10"  class="form-control"><?php echo isset($schedule->venue)?$schedule->venue:''; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="required_units" class="col-sm-12 control-label">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status">
                                <option >Please select one</option>
                                <option value="0" <?php if(!empty($schedule->status) && $schedule->status=='0'){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(!empty($schedule->status) && $schedule->status=='1'){ echo 'selected'; } ?>>Publish</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="btn-group">
                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>
                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>
                                <?php echo anchor('admin/examination_schedule_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>
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




