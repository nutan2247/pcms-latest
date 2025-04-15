
<div id="layoutSidenav_content">
    
<?php //echo '<pre>'; print_r($training_details);exit;?>
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
                <?php if(isset($flag) && $flag==1){ ?>
                    <a href="javascript:history.back()" class="btn btn-info float-right">Back</a>
                <?php }else{?>
                <a href="<?php echo base_url('reviewer/reviewer/forReview_listing');?>" class="btn btn-info float-right">Back</a>
                <?php } ?>
            </h4>
            <div class="card mb-4"></div>
            <?php //echo'<pre>'; print_r($training_details->train_doc_id); ?>
            <div class="row border-bottom border-primary">
                <div class="col-md-12 mx-auto v-div">
                    <div class="row mt-3 pb-3">
                        <div class="col-md-12">
                        <div class="row">
                                <div class="col-md-2">
                                    <?php  if(!empty($training_details->training_image)) { ?>
                                    <div class="border border-primary"><img src="<?php echo base_url('assets/images/ce_provider/').$training_details->training_image; ?>"  width="100%"></div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                    <h4><?php echo (!empty($training_details)?ucfirst($training_details->training_title):""); ?>
                                    </h4>
                                    <p><b>CEP Name:</b>
                                        <?php echo (!empty($training_details)?ucfirst($training_details->business_name):""); ?>
                                    </p>
                                    <p><b>CEP Email:</b>
                                        <?php echo (!empty($training_details)?$training_details->email:""); ?><br>
                                    </p>
									<p><b>CEP Accreditation no.:</b>
                                        <?php echo (!empty($training_details)?ucfirst($training_details->accreditation_no):""); ?>
                                    </p>
									<p><b>Validity:</b>
                                        <?php echo (!empty($training_details)?date('F m,Y',strtotime($training_details->expiry_at)):""); ?>
                                    </p>
									<p><b>Status:</b>
										<?php echo (!empty($training_details->status == 1 )?"Valid":"Invalid"); ?>
                                        
                                    </p>
									
                                </div>
                            </div>

        <div class="card">
            <div class="card-body">
                    <?php if($training_details->training_units > 0){ ?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Training Units :</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($training_details)?ucfirst($training_details->training_units):""); ?>           
                            </div>
                        </div>
                    </div> 
                    <?php } ?> 
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Training Price :</label>
                            </div>
                            <div class="col-sm-8">
                            $<?php echo (!empty($training_details)?ucfirst($training_details->training_price):""); ?>            
                            </div>
                        </div>
                    </div>  
                    <!-- <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Training Category :</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($training_details->category > 0)?ucfirst($training_details->category_name):""); ?>           
                            </div>
                        </div>
                    </div>   -->
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Profession (Who can learn this Training):</label>
                            </div>
                            <div class="col-sm-8">
                            <?php echo (!empty($training_details->profession > 0)?ucfirst($training_details->profession_name):""); ?>            
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Training Document :</label>
                            </div>
                            <div class="col-sm-8">
                        <?php echo (!empty($training_details)?'<a href="javascript:void(0)" data-id="'.$training_details->training_pdf.'" class="viewPdf">View training pdf</a>':"No training PDF Found!"); ?>
                                        
                            </div>
                        </div>
                    </div> 
                    <?php if(!isset($flag)){ ?>
                    <div class="card bg-light mt-2 mb-2">
                        <div class="card-body">
                            <?=form_open(base_url('reviewer/reviewer/send_training_changes')); ?>
                            <label for="trainingchanges">If you found some minor mistake on this training, you can raise the issues and send to CEP directly. If not than skip this section.</label>
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
                            <?php 
                                if(!empty($training_details->reviewer_id) && $training_details->reviewer_id == $this->session->userdata('login')['user_ID']):
                                if(count($trainingreviewdatails) == 0): ?>                                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="trainingchanges" class="control-label">Required changes:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea name="changes" id="trainingchanges" class="form-control" placeholder="Please add your all required changes here..." rows="5" required><?php echo set_value('changes');?></textarea>
                                        <?php echo form_error('changes', '<div class="error">', '</div>'); ?>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <input type="hidden" name="cep_email" value="<?php echo $training_details->email; ?>">
                                    <input type="hidden" name="cep_name" value="<?php echo $training_details->business_name; ?>">
                                    <input type="hidden" name="cep_provider_id" value="<?php echo $training_details->provider_id; ?>">
                                    <input type="hidden" name="training_id" value="<?php echo $training_details->train_doc_id; ?>">
                                    <input type="hidden" name="provider_title" value="<?php echo $training_details->provider_title; ?>">
                                    <input type="hidden" name="training_pdf" value="<?php echo $training_details->training_pdf; ?>">

                                    <input type="submit" class="btn btn-success offset-sm-5" name="send_changes" value="Send Changes to CEP">  
                                </div>
                            </div>
                            
                            <?php endif; endif; ?>
                            <?=form_close(); ?>
                        </div>
                    </div>
                    <?php } ?>
                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo current_url();?>">
                    <?php //print_r($training_details);?>

                        <?php if(!isset($flag)){
                        if(!empty($training_details->reviewer_id) && $training_details->reviewer_id == $this->session->userdata('login')['user_ID']){ 
                            if(isset($trainingreviewdatails)){ 
                                ?>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-sm-4">
                                    <label for="field-1" class="control-label">Comment:</label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea name="comment" class="form-control" placeholder="Please add your all comments here..." required><?php echo set_value('comment');?></textarea>
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
                                    <!-- <input type="radio" name="status" value="3" required> Hold -->
                                    <br><?php echo form_error('status', '<div class="error">', '</div>'); ?>
                                </div> 
                            </div>
                        </div>
                                
                        <div class="form-group">
                            <div class="col-sm-offset-6 col-sm-5">
                                <input type="hidden" name="train_doc_id" id="train_doc_id" value="<?php echo isset($training_details->train_doc_id)?$training_details->train_doc_id:'';?>">
                                <input type="hidden" name="cep_email" value="<?php echo isset($training_details->email)?$training_details->email:'';?>">
                                <input type="hidden" name="cep_name" value="<?php echo isset($training_details->business_name)?$training_details->business_name:'';?>">
                                <input type="hidden" name="provider_id" value="<?php echo isset($training_details->provider_id)?$training_details->provider_id:'';?>">
                                <input type="submit" class="btn btn-success" value="Submit">                            
                            </div>
                        </div>
                    <?php } }else{ echo 'Already submitted!'; } ?>
                        <div class="form-group">
                            <div class="col-sm-offset-6 col-sm-5">
                            <!-- <a href="javascript:history.back()" class="btn btn-info">Back</a> -->
                            <a href="<?php echo base_url('reviewer/reviewer/forReview_listing');?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    <?php } ?>
                </form>             
            </div>              
        </div>
                        </div>
                    </div>
                </div>

        

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
        <h4 class="modal-title">View Tarining</h4>
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
        <?php if(!empty($_SESSION['sesstcaccnum'])){ ?> training_course_acc_send_to_ceonpoint(); <?php } ?>
    });
    $('.viewPdf').on('click',function(){
        var id = $(this).attr('data-id');
        var path = '<?php echo base_url('assets/images/ce_provider/'); ?>'+id;  
        $('#pdfsrc').attr('src',path);
        $('#cepViewPdf').modal('show');
    });
    
    function training_course_acc_send_to_ceonpoint(){
        var email = '<?php echo $training_details->email; ?>';
        var training_name = '<?php echo $training_details->training_title;?>';
        var website = '<?php echo base_url(); ?>';
        var accreditation_num = '<?php echo $_SESSION['sesstcaccnum']; ?>';
        var accreditation_validity = '<?php echo $_SESSION['sesstcaccvalidity']; ?>';
        // console.log('inside the api '+ email +','+ training_name +','+ website +','+ accreditation_num +','+ accreditation_validity);

        var dataValues = { 
                email : email,
                training_name : training_name,
                website : website, 
                accreditation_num : accreditation_num, 
                accreditation_validity : accreditation_validity 
            }
        var dataValue = JSON.stringify(dataValues);
        $.ajax({
            type: "POST",
            url: "https://ceonpoint.com/api/accreditationapi/trainingcourseaccapi",
            data: dataValue,
            success: function(result) {
                    // console.log(result);
                if(result.code==200){
                    // var lastid = result.data;
                    // location.reload();
                }   
                
                if(result.code==404){
                    // alert(result.msg)
                } 
            }
        });
    }

var sess = "<?php  unset($_SESSION['sesstcaccnum']); unset($_SESSION['sesstcaccvalidity']);  ?>";    
</script>