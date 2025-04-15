<?php //echo '<pre>'; print_r($graduatedetails); exit; ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h4 class="mt-4 mb-3"><?php echo $title; ?>
        <a href="javascript:history.back(1)" class="btn btn-info float-right">
            <span class="glyphicon glyphicon-download-alt"></span> Back
        </a>
            </h4>
            <div class="card mb-4"></div>
            <div class="row border-bottom border-primary">
                <div class="col-md-12 mx-auto v-div">
                    <div class="row mt-3 pb-3">
                        <div class="col-md-12">
                            <div class="card">
            <div class="card-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo base_url('reviewer/reviewer/graduatedetails');?>">
                    <!-- <h4>Uploaded Documents</h4>   -->
                    
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Photo:</label>
                            </div>
                            <div class="col-sm-8">
                                <img width="200" height="200" src="<?php echo base_url('assets/images/graduates/').$graduatedetails->photo; ?>" alt="<?php echo $graduatedetails->student_name.' '.$graduatedetails->middle_name.' '.$graduatedetails->surname; ?>">    
                            </div>                           
                        </div>
                    </div>
                    
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Name:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $graduatedetails->student_name.' '.$graduatedetails->middle_name.' '.$graduatedetails->surname; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Date of Birth:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $graduatedetails->dob; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Email:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $graduatedetails->email; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Gender</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $graduatedetails->gender; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Date of Graduated</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $graduatedetails->date_of_graduated; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-12">
                                <label for="field-1" class="control-label"><b>Documents</b></label>
                            </div>                                                     
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Diploma </label>
                            </div>
                            <div class="col-sm-8">
                                <?php
								if($graduatedetails->diploma != ""){
									$docurl = base_url('assets/images/graduates/'.$graduatedetails->diploma);
									echo '<a href="javasrcript:void(0);" class="btn btn-info" onclick="viewDoc(\''.$docurl.'\')">Click to View</a>'; 
								}else{
									echo 'N/A';
								}
								?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">OTR</label>
                            </div>
                            <div class="col-sm-8">
                                <?php
								if($graduatedetails->official_transcription != ""){
									$docurl = base_url('assets/images/graduates/'.$graduatedetails->official_transcription);
									echo '<a href="javasrcript:void(0);"  class="btn btn-info" onclick="viewDoc(\''.$docurl.'\')">Click to View</a>'; 
								}else{
									echo 'N/A';
								}
								?>
                            </div>                           
                        </div>
                    </div>
					
					<?php if(isset($flag)){

                    }else{
                    if($graduatedetails->reviewer_id > 0 && $graduatedetails->reviewer_id == $this->session->userdata('login')['user_ID']){ 
                      
					if(is_array($graduatereviewdatails) ? count($graduatereviewdatails) : 0 < 1){ 
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
                                <label for="field-1" class="control-label">Status:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="radio" name="status" value="1" required> Approve |
                                <input type="radio" name="status" value="2" required> Reject
                            <br><?php echo form_error('status', '<div class="error">', '</div>'); ?>
							</div>
                        </div>
                    </div>
					<!--<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Exam Code</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-8">
                                <input type="text" name="examcode" class="form-control" placeholder="Exam Code" value="<?php echo $graduatedetails->examcode; ?>">
								<?php //echo form_error('examcode', '<div class="error">', '</div>'); ?>
                            </div>
                            </div>                           
                        </div>
                    </div> -->
                            
                    <div class="form-group">
						<div class="row">
						<div class="col-sm-4">
									&nbsp;
								</div>
							<div class="col-sm-8">
								<input type="hidden" name="grad_id" id="grad_id" value="<?php echo $graduatedetails->grad_id;?>">
								<input type="submit" class="btn btn-success" value="Submit">
							</div>
						</div>
                    </div>
					<?php }else{
							echo '<p><b>Already commented.</b></p>';
						}
					
					} }?>
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-5">
                            <a href="javascript:history.back(1)" class="btn btn-info btn-lg">
                                <span class="glyphicon glyphicon-download-alt"></span> Back
                            </a>
                        </div>
                    </div>
                </form>             
            </div>              
        </div>
                        </div>
                    </div>
                </div>
                        <?php //echo'<pre>';print_r(graduatedetails); ?>

        

            </div>
          
            <div>
            </div>
        </div>
</div>
</div>
</div>

</main>

<!-- View Documnet Modal Start-->

<div class="modal fade r-board-modal" id="viewDocModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Document</h5>
            </div>

        <div class="modal-body">
            <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
                <img src="" id="viewImageDoc" width="750">
            </div>
        </div>
             
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="close();" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<!-- View Documnet Modal End-->

<script>
    function viewDoc(url){
        $('#viewImageDoc').attr('src',url);
        $('#viewDocModal').modal('show');
    }
        
    function close(){
        $('#viewImageDoc').attr('src','');
    }
</script>