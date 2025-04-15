<?php //echo print_r($universitydetails); exit; ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card mb-4"></div>
            <div class="row border-bottom border-primary">
                <div class="col-md-12 mx-auto v-div">
                    <div class="row mt-3 pb-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                        if(!empty($universitydetails->college_logo))
                                        {
                                    ?>
                                    <div class="border border-primary"><img
                                            src="<?php echo base_url('assets/images/university/').$universitydetails->college_logo; ?>"
                                            width="100%"></div>
                                        <?php } ?>
                                </div>
								<div class="col-md-10">
									<div style="text-align:right;">
									<a href="javascript:history.back(1)" class="btn btn-info btn-lg">
										<span class="glyphicon glyphicon-download-alt"></span> Back
									</a>
									</div>
								</div>
								
                                <div class="col-md-8">
                                    <h4><?php echo (!empty($application)?$universitydetails->university_name:""); ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="card">
            <div class="card-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo base_url('reviewer/reviewer/unversitydetails/'.$universitydetails->unidoc_id);?>">
                
                    <!-- <h4>Uploaded Documents</h4>   -->
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">School Name</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->university_name; ?>
                            </div>
                           
                        </div>
                    </div> 
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">College of :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->collegeofnmae; ?>
                            </div>
                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Address :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->address; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Email :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->email; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Contact No. :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->contact_no; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Name of Representative:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->name_of_representative; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Position:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->position; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Business License No:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->business_license_number; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Validity Date</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->validity_date; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Issued by</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->issued_by; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Accreditation No.</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->accreditation_no; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Validity Date</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->accreditation_validity_date; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Issued by</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $universitydetails->accreditation_issued_by; ?>
                            </div>                           
                        </div>
                    </div>
					
					
					
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-12">
                                <label for="field-1" class="control-label"><b>Accreditation Documents</b></label>
                            </div>                                                     
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Business License</label>
                            </div>
                            <div class="col-sm-8">
								
								<?php
								if($universitydetails->business_license != ""){
									$docurl = base_url('assets/images/university/'.$universitydetails->business_license);
									echo '<button type="button" onclick="viewDoc(\''.$docurl.'\')" class="btn btn-info">Click to View</button>'; 
								}
								?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Accreditation</label>
                            </div>
                            <div class="col-sm-8">
                                <?php
								if($universitydetails->accreditation != ""){
									$docurl = base_url('assets/images/university/'.$universitydetails->accreditation);
									echo '<button type="button" onclick="viewDoc(\''.$docurl.'\')" class="btn btn-info">Click to View</button>'; 
								}
								?>
                            </div>                           
                        </div>
                    </div>
					<?php if(isset($flag)){
                        //echo '<p><b>Comment : </b>'.$universityreviewdatails->comment.'</p>';
                    }else{
                    if($universitydetails->reviewer_id > 0 && $universitydetails->reviewer_id == $this->session->userdata('login')['user_ID']){ 
					
					if(is_array($universityreviewdatails)?count($universityreviewdatails):0 < 1){
					?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Comment:</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea name="comment" class="form-control" placeholder="Please add your all comments here..." required ><?php echo set_value('comment');?></textarea>
								<?php echo form_error('comment', '<div class="error" style="color:red;">', '</div>'); ?>
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
                            <br><?php echo form_error('status', '<div class="error" style="color:red;">', '</div>'); ?>
							</div>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-5">
                            <input type="hidden" name="uniid" id="uniid" value="<?php echo $universitydetails->uniid;?>">
                            <input type="hidden" name="unidoc_id" id="unidoc_id" value="<?php echo $universitydetails->unidoc_id;?>">
                            <input type="hidden" name="document_for" id="document_for" value="<?php echo $universitydetails->document_for;?>">
                            <input type="submit" class="btn btn-success" name="Submit" value="Submit">
                        </div>
                    </div>
					<?php }else{
							if($universityreviewdatails->comment !=""){	
								echo '<p><b>Comment : </b>'.$universityreviewdatails->comment.'</p>';
							}
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
                        <?php //echo'<pre>';print_r($universitydetails); ?>

        

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