<?php //print_r($application[0]);exit;?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
            <a href="javascript:history.back(1)" class="btn btn-info float-right">
                    <span class="glyphicon glyphicon-download-alt"></span> Back
                </a>
            </h4>
            <!-- <div class="card mb-4"></div> -->
            <div class="row border-bottom border-primary">
                <div class="col-md-12 mx-auto v-div">
                    <div class="row mt-3 pb-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php  if(!empty($application[0]->image)) { ?>
                                        <div class="border border-primary">
                                            <img src="<?php echo base_url('assets/uploads/profile/').$application[0]->image; ?>"
                                            width="100%">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                <h4><?php echo ucwords(!empty($application)?$application[0]->fname.' '.$application[0]->lname.' '.$application[0]->name:"--"); ?></h4>

                                    <p><b>Profession:</b> <?php echo (!empty($application)?$application[0]->profession_name:""); ?><br>
                                    <b>License  No:</b> <?php echo (!empty($application)?$application[0]->license_no:""); ?><br>
                                    <b>Issued Date:</b> <?php echo ($application[0]->license_issued_date!='0000-00-00')?date('M d,Y',strtotime($application[0]->license_issued_date)):'N/A'; ?><br>
                                    <b>Validity Date:</b> <?php echo ($application[0]->license_validity_date!='0000-00-00')?date('M d,Y',strtotime($application[0]->license_validity_date)):'N/A'; ?>
                                    </p>
                                </div>
                            </div>
                           
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label for="field-1" class="control-label"><b>Personal Information</b></label>
                            <ul>
                                <li>Citizenship: <?php echo (!empty($application[0]->countries_name)?$application[0]->countries_name:"--"); ?></li>
                                <li>Email: <?php echo (!empty($application[0]->email)?$application[0]->email:"--"); ?></li>
                                <li>Date of Birth: <?php echo (!empty($application[0]->dob)?date('F d, Y',strtotime($application[0]->dob)):"--"); ?></li>
                                <li>Gender: <?php echo (!empty($application[0]->gender)?$application[0]->gender:"--"); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <label for="field-1" class="control-label"><b>Professional Information</b></label>
                            <ul>
                                <li>Professional Regularity Board: <?php echo (!empty($application[0]->reg_board)?$application[0]->reg_board:"--"); ?></li>
                                <li>Country: <?php echo (!empty($application[0]->reg_country)?$application[0]->reg_country:"--"); ?></li>
                                <li>Address: <?php echo (!empty($application[0]->reg_address)?$application[0]->reg_address:"--"); ?></li>
                                <li>Email: <?php echo (!empty($application[0]->reg_email)?$application[0]->reg_email:"--"); ?></li>
                                <li>Website: <?php echo (!empty($application[0]->reg_website)?$application[0]->reg_website:"--"); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <label for="field-1" class="control-label"><b>Educational Background</b></label>
                            <?php $college_of ='';
                                if($application[0]->college_of==''){
                                    if(isset($profession)){
                                        foreach($profession as $prof){
                                            if($prof->id==$application[0]->college){
                                                $college_of=$prof->name;
                                            }
                                        }
                                    }
                                }else{
                                    $college_of=$application[0]->college_of;
                                } ?>
                            <ul>
                                <li>University Name: <?php echo (($application[0]->university > 0)?$application[0]->university_name:$application[0]->other_university); ?></li>
                                <li>College Name: <?php echo (($application[0]->college > 0)?$college_of:$application[0]->other_college); ?></li>
                                <li>Address: <?php echo (!empty($application[0]->u_address)?$application[0]->u_address:"--"); ?></li>
                                <li>Email:  <?php echo (!empty($application[0]->u_email)?$application[0]->u_email:"--"); ?></li>
                                <li>Contact No.: <?php echo (!empty($application[0]->u_contact)?$application[0]->u_contact:"--"); ?></li>
                                <li>Website: <?php echo (!empty($application[0]->u_website)?$application[0]->u_website:"--"); ?></li>
                            </ul>
                        </div>
                    </div>
<!-- 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">University :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (($application[0]->university > 0)?$application[0]->university_name:$application[0]->other_university); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Collage of :</label>
                            </div>
                            <?php $college_of ='';
                                if($application[0]->college_of==''){
                                    if(isset($profession)){
                                        foreach($profession as $prof){
                                            if($prof->id==$application[0]->college){
                                                $college_of=$prof->name;
                                            }
                                        }
                                    }
                                }else{
                                    $college_of=$application[0]->college_of;
                                } ?>
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (($application[0]->college > 0)?$college_of:$application[0]->other_college); ?></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Address :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (!empty($application[0]->u_address)?$application[0]->u_address:"--"); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Email :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (!empty($application[0]->email)?$application[0]->email:"--"); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Contact No. :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (!empty($application[0]->u_contact)?$application[0]->u_contact:"--"); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Date of Birth :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (!empty($application[0]->dob)?date('M d,Y',strtotime($application[0]->dob)):"--"); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Gender :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo ucwords(!empty($application[0]->gender)?$application[0]->gender:"--"); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="field-1" class="control-label">Country :</label>
                            </div>
                            
                            <div class="col-sm-8">
                                <label for="field-1" class="control-label"> <?php echo (!empty($application[0]->countries_name)?$application[0]->countries_name:"--"); ?></label>
                            </div>
                        </div>
                    </div> -->

                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo base_url('reviewer/reviewer/verify_document');?>">
                
                    <!-- <h4>Uploaded Documents</h4>   -->
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Diploma :</label>
                            </div>
                            <?php if(!empty($documents->diploma)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->diploma;?>" width="150">
                            </div>-->
                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->diploma;?>')" class="btn btn-info">Click to view</button>
                                <!-- <input type="hidden" name="app_id" value=""> -->
                                <input type="hidden" name="user_id"     value="<?php echo $documents->user_id;?>">
                                <input type="hidden" name="reviewer_id"     value="<?php echo $this->session->userdata('login')['user_ID'];?>">
                            </div>
                       <?php }else{ echo 'Diploma not uploaded yet!'; } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Official Transcript :</label>
                            </div>
                            <?php if(!empty($documents->ot_record)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->ot_record;?>" width="150">
                            </div>-->
                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->ot_record;?>')" class="btn btn-info">Click to view</button>
                            </div>
                        <?php }else{ echo 'Official Transcript not uploaded yet!'; } ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Character Reference :</label>
                            </div>

                            <?php if(!empty($documents->charecter)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->charecter;?>" width="150">
                            </div>-->

                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->charecter;?>')" class="btn btn-info">Click to view</button>
                            </div>
                        <?php }else{ echo 'Character Reference  not uploaded yet! '; } ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Professional Reference 1 :</label>
                            </div>

                            <?php if(!empty($documents->p_reference1)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->p_reference1;?>" width="150">
                            </div>-->

                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->p_reference1;?>')" class="btn btn-info">Click to view</button>
                            </div>
                        <?php }else{ echo 'Professional Reference 1 not uploaded yet! '; } ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Professional Reference 2 :</label>
                            </div>

                            <?php if(!empty($documents->p_reference2)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->p_reference2;?>" width="150">
                            </div>-->
                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->p_reference2;?>')" class="btn btn-info">Click to view</button>
                            </div>
                        <?php }else{ echo 'Professional Reference 2 not uploaded yet! '; } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Medical Certificate :</label>
                            </div>

                            <?php if(!empty($documents->medical)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->medical;?>" width="150">
                            </div>-->
                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->medical;?>')" class="btn btn-info">Click to view</button>
                            </div>
                        <?php }else{ echo 'Medical Certificate not uploaded yet! '; } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Police Certificate :</label>
                            </div>

                            <?php if(!empty($documents->police_certificate)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->police_certificate;?>" width="150">
                            </div>-->
                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->police_certificate;?>')" class="btn btn-info">Click to view</button>
                            </div>

                        <?php }else{ echo 'Police Certificate not uploaded yet! '; } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Passport ID:</label>
                            </div>

                            <?php if(!empty($documents->passport)){ ?>
                            <!--<div class="col-sm-4">
                                <img src="<?php echo base_url('assets/uploads/document/').$documents->passport;?>" width="150" alt="<?php echo $documents->passport; ?>">
                            </div>-->
                            <div class="col-sm-4">
                                <button type="button" onclick="viewDoc('<?php echo base_url('assets/uploads/document/').$documents->passport;?>')" class="btn btn-info">Click to view</button>
                            </div>
                        <?php }else{ echo 'Passport ID not uploaded yet! '; } ?>
                        </div>
                    </div>  
                    <?php if(isset($flag)){

                    }else{
                    if($documents->reviewer_id > 0 && $documents->reviewer_id == $this->session->userdata('login')['user_ID']){ 
					
					if(isset($professreviewdatails)){
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
                            
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-5">
                            <input type="hidden" name="prof_id" id="prof_id" value="<?php echo isset($documents->user_id)?$documents->user_id:'';?>">
                            <input type="hidden" name="doc_id" id="doc_id" value="<?php echo isset($documents->pd_id)?$documents->pd_id:'';?>">
                            <input type="submit" class="btn btn-success" value="Submit">                            
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
                        <?php //echo'<pre>';print_r($documents); ?>

        

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
    
    function Previous() {
            window.history.back()
    }
</script>