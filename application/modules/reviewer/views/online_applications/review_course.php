
<div id="layoutSidenav_content">
<!-- <?php //echo 'nutan'; print_r($_SESSION);?> -->
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
                <!--<a href="<?php echo base_url('reviewer/reviewer/onlinecourse');?>" class="btn btn-info float-right">Back</a>-->
                <a href="javascript:history.back()" class="btn btn-info float-right">Back</a>
            </h4>
            <div class="card mb-4"></div>
            <?php //echo'<pre>'; print_r($coursereviewdatails); ?>
            <div class="row border-bottom border-primary">
                <div class="col-md-12 mx-auto v-div">
                    <div class="row mt-3 pb-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php  if(!empty($course_details[0]->course_image)) { ?>
                                    <div class="border border-primary"><img
                                            src="<?php echo base_url('assets/images/ce_provider/').$course_details[0]->course_image; ?>"
                                            width="100%"></div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                    <h4><?php echo (!empty($course_details)?ucfirst($course_details[0]->course_title):""); ?></h4>
                                    <p><b>CEP Name:</b>
                                        <?php echo (!empty($course_details)?ucfirst($course_details[0]->business_name):""); ?>
                                    </p>
                                    <p><b>CEP Email:</b>
                                        <?php echo (!empty($course_details)?$course_details[0]->email:""); ?><br>
                                    </p>
									<p><b>CEP Accreditation no.:</b>
                                        <?php $cepAccNo = $this->db->get_where('tbl_cep_documents',array('provider_id'=>$course_details[0]->provider_id,'reviewer_status'=>'1'))->row()->accreditation_no;
                                        echo (!empty($course_details)?$cepAccNo:""); ?>
                                    </p>
									<p><b>Validity:</b>
                                        <?php echo (!empty($course_details)?date('F m,Y',strtotime($course_details[0]->expiry_at)):""); ?>
                                    </p>
									<p><b>Status:</b>
										<?php echo (!empty($course_details[0]->status == 1 )?"Valid":"Invalid"); ?>
                                        
                                    </p>
									
                                </div>
                            </div>

                            <div class="card">
            <div class="card-body">
                <?php if($course_details[0]->course_units > 1){ ?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Course Units :</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($course_details)?ucfirst($course_details[0]->course_units):""); ?>           
                            </div>
                        </div>
                    </div>  
                <?php } ?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Course Price :</label>
                            </div>
                            <div class="col-sm-8">
                            $<?php echo (!empty($course_details)?ucfirst($course_details[0]->course_price):""); ?>            
                            </div>
                        </div>
                    </div> 
                    <!-- <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Course Category :</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($course_details)?ucfirst($course_details[0]->category_name):""); ?>           
                            </div>
                        </div>
                    </div>   -->
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Profession (Who can learn this course):</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($course_details)?ucfirst($course_details[0]->profession_name):""); ?>            
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Course Document :</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($course_details)?'<a href="javascript:void(0);" data-id="'.$course_details[0]->course_pdf.'" class="viewPdf">View course pdf</a>':"No PDF found!"); ?>
                                        
                            </div>
                        </div>
                    </div>                  
                    <?php if(!isset($flag)){ ?>
                    <div class="card bg-light mt-2 mb-2">
                        <div class="card-body">
                            <?=form_open(base_url('reviewer/reviewer/send_course_changes')); ?>
                            <label for="coursechanges">Note: Please enter your comment/s for the online course below and send to the CPD Provider for correction.</label>
                            <?php if($logs != ''): ?>
                                <div class="p-4">
                                <label for=""><b>Required changes logs</b></label>
                                <div class="table-responsive">
                                <table class="table table-border">
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Issue</th>
                                        <th>PDF</th>
                                        <th>Date</th>
                                    </tr>
                                    <?php
                                        $count = 1; 
                                        foreach($logs as $log):?>
                                    <tr>
                                        <td><?=$count; ?></td>
                                        <td><?=$log['changes']; ?></td>
                                        <td><a href="javascript:void(0);" data-id="<?=$log['pdf_file'];?>" class="viewPdf">View pdf</a></td>
                                        <td><?=$log['added_on']; ?></td>
                                    </tr>
                                    <?php $count++; endforeach; ?>
                                </table>
                                </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($course_details[0]->reviewer_id) && $course_details[0]->reviewer_id == $this->session->userdata('login')['user_ID']):

                            if(isset($coursereviewdatails)): ?>                                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="coursechanges" class="control-label">Required changes:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea name="changes" id="coursechanges" class="form-control" placeholder="Please enter your comment/s here..." rows="5" required><?php echo set_value('changes');?></textarea>
                                        <?php echo form_error('changes', '<div class="error">', '</div>'); ?>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <input type="hidden" name="cep_email" value="<?php echo $course_details[0]->email; ?>">
                                    <input type="hidden" name="cep_name" value="<?php echo $course_details[0]->business_name; ?>">
                                    <input type="hidden" name="cep_provider_id" value="<?php echo $course_details[0]->provider_id; ?>">
                                    <input type="hidden" name="course_id" value="<?php echo $course_details[0]->cor_doc_id; ?>">
                                    <input type="hidden" name="course_title" value="<?php echo $course_details[0]->course_title; ?>">
                                    <input type="hidden" name="course_pdf" value="<?php echo $course_details[0]->course_pdf; ?>">
                                    <input type="submit" class="btn btn-success offset-sm-5" name="send_changes" value="Send Changes to CEP">  
                                </div>
                            </div>
                            
                            <?php endif; 
                             endif; ?>
                            <?=form_close(); ?>
                        </div>
                    </div>
                    <?php } ?>
                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo current_url();?>">
                    <?php if(!isset($flag)){
                    if(!empty($course_details[0]->reviewer_id) && $course_details[0]->reviewer_id == $this->session->userdata('login')['user_ID']){ 
                        // if(1){ 
                        if(isset($coursereviewdatails)){
                            ?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Comment:</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea name="comment" class="form-control" placeholder="Please enter your comment/s here..." rows="5" required><?php echo set_value('comment');?></textarea>
								<?php echo form_error('comment', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                        <div class="col-sm-4">
                                <label for="field-1" class="control-label">CE Units:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" name="unit"  class="form-control" value="<?php echo set_value('unit');?>" required>
                                <?php echo form_error('unit', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>

             
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Status:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="radio" name="status" value="1" id="st1" required> <label for="st1">Approve </label> |
                                <input type="radio" name="status" value="2" id="st2" required> <label for="st2">Disapprove </label>
								<br><?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div> 
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-5">
                            <input type="hidden" name="cor_doc_id" id="cor_doc_id" value="<?php echo isset($course_details[0]->cor_doc_id)?$course_details[0]->cor_doc_id:'';?>">
                            <input type="hidden" name="cep_email" value="<?php echo isset($course_details[0]->email)?$course_details[0]->email:'';?>">
                            <input type="hidden" name="cep_name" value="<?php echo isset($course_details[0]->business_name)?$course_details[0]->business_name:'';?>">
                            <input type="hidden" name="provider_id" value="<?php echo isset($course_details[0]->provider_id)?$course_details[0]->provider_id:'';?>">
                            <input type="submit" class="btn btn-success" value="Submit">                            
                        </div>
                    </div>
                <?php } } else{ echo 'Already submitted!'; } }?>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-5">
                        <!-- <a href="javascript:history.back()" class="btn btn-info">Back</a> -->
                        <a href="<?php echo base_url('reviewer/reviewer/onlinecourse');?>" class="btn btn-info">Back</a>
                    </div>
                </div>
                
                </form>             
            </div>              
        </div>
                        </div>
                    </div>
                </div>
                        <?php //echo'<pre>';print_r($course_details); ?>

        

            </div>
          
            <div>
            </div>
        </div>
</div>
</div>
</div>

</main>

<!-- The Modal -->
<div class="modal" id="cepViewPdf">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Course</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <iframe src="" id="pdfsrc" frameborder="0" width="600" height="850"></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

    <script>
    $( document ).ready(function() {
        <?php if(!empty($_SESSION['sessocaccnum'])){  ?> online_course_acc_send_to_ceonpoint(); <?php } ?>
    });
    $('.viewPdf').on('click',function(){
        var id = $(this).attr('data-id');
        var path = '<?php echo base_url('assets/images/ce_provider/'); ?>'+id;  
        $('#pdfsrc').attr('src',path);
        $('#cepViewPdf').modal('show');
    });
    
    function online_course_acc_send_to_ceonpoint(){
        var email = '<?php echo $course_details[0]->email; ?>';
        var course_name = '<?php echo $course_details[0]->course_title;?>';
        var website = '<?php echo base_url(); ?>';
        var accreditation_num = '<?php echo $_SESSION['sessocaccnum']; ?>';
        var accreditation_validity = '<?php echo $_SESSION['sessocaccvalidity']; ?>';

        var dataValues = { 
                email : email,
                course_name : course_name,
                website : website, 
                accreditation_num : accreditation_num, 
                accreditation_validity : accreditation_validity 
            }
        var dataValue = JSON.stringify(dataValues);
        // console.log('inside the api '+ email +','+ course_name +','+ website +','+ accreditation_num +','+ accreditation_validity);
        
        $.ajax({
            type: "POST",
            url: "https://ceonpoint.com/api/accreditationapi/onlinecourseaccapi",
            data: dataValue,
            success: function(result) {
                    // console.log(result.code);
                if(result.code==200){
                     alert(result.msg)
                }  
                if(result.code==404){
                     alert(result.msg)
                } 
            }
        });
    }
    var sess = "<?php unset($_SESSION['sessocaccnum']); unset($_SESSION['sessocaccvalidity']); ?>";
    </script>
   
    