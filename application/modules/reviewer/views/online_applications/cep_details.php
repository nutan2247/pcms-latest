<?php //echo print_r($universitydetails); exit; ?>
<style type="text/css">
    
    .error{
        color:red;
    }
</style>
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
                            <div class="row">
                                <div class="col-md-2">
                                    <?php  if(!empty($cep_details->company_logo)) { ?>
                                        <div class="border border-primary">
                                            <img src="<?php echo base_url('assets/images/ce_provider/').$cep_details->company_logo; ?>"
                                            width="100%">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-8">
                                    <h4><?php //echo (!empty($application)?$universitydetails->university_name:""); ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="card">
            <div class="card-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo base_url('reviewer/reviewer/cep_details/'.$cep_details->doc_id);?>">
                
                    <!-- <h4>Uploaded Documents</h4>   -->
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Business Name :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->business_name; ?>
                            </div>
                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Business Number :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->business_no; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Address :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->address; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Country. :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->co_name; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Contact Person:</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->contact_person; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Designation :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->designation; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">E-mail   :</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->email; ?>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Tell. No</label>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $cep_details->phone; ?>
                            </div>                           
                        </div>
                    </div>
					
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label"><h3><?php echo ($cep_details->document_for=='n')?'New':'Renewal'; ?></h3></label>
                            </div>
                            <div class="col-sm-8">
                               
                            </div>                           
                        </div>
                    </div>
					
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Business License</label>
                            </div>  
                            <div class="col-sm-8">
                                <!--<a target="_blank" href="<?php echo base_url('assets/images/ce_provider/').$cep_details->license_image; ?>" class="btn btn-info btn-lg">
                                  <span class="glyphicon glyphicon-download-alt"></span> View Document
                                </a>-->
                                <?php
								if($cep_details->license_image != ""){
									$docurl = base_url('assets/images/ce_provider/'.$cep_details->license_image);
									echo '<a href="javasrcript:void(0);" onclick="viewDoc(\''.$docurl.'\')" class="btn btn-info" >View Document</a>'; 
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
                                <label for="field-1" class="control-label">Accreditation Attached</label>
                            </div>  
                            <div class="col-sm-8">
                               <!--<a target="_blank" href="<?php echo base_url('assets/images/ce_provider/').$cep_details->accreditation_image; ?>" class="btn btn-info btn-lg">
                                  <span class="glyphicon glyphicon-download-alt"></span> View Document
                                </a>-->
                                <?php
								if($cep_details->accreditation_image != ""){
									$docurl = base_url('assets/images/ce_provider/'.$cep_details->accreditation_image);
									echo '<a href="javasrcript:void(0);" onclick="viewDoc(\''.$docurl.'\')" class="btn btn-info" >View Document</a>'; 
								}else{
									echo 'N/A';
								}
								?>
                            </div>                                                   
                        </div>
                    </div>

		<?php if(isset($flag)){

        }else{
        if($cep_details->rev_id != 0 && $this->session->userdata('login')['user_ID'] == $cep_details->rev_id){ 
                if(!isset($cepreviewdatails) && $cepreviewdatails == ''){
					?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Comment:</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea name="comment" class="form-control" placeholder="Please add your all comments here..." required ><?php echo set_value('comment');?></textarea>
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
                                <input type="radio" id="st1" <?php echo ($cep_details->rev_status==1)?"checked":""; ?> name="status" value="1" required> <label for="st1"> Approve</label> |
                                <input type="radio" id="st2" <?php echo ($cep_details->rev_status==2)?"checked":""; ?> name="status" value="2" required> <label for="st2"> Reject</label>
                            <br><?php echo form_error('status', '<div class="error">', '</div>'); ?>
							</div>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-5">
                            <input type="hidden" name="provider_id" id="provider_id" value="<?php echo $cep_details->provider_id;?>">
                            <input type="hidden" name="document_for" id="document_for" value="<?php echo $cep_details->document_for;?>">
                            <input type="submit" class="btn btn-success" name="Submit" value="Submit">
                        </div>
                    </div>

                    
					<?php 
                    }else{ 	echo '<p><b>Already commented.</b></p>';}
					
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
     $( document ).ready(function() {
        <?php if(!empty($_SESSION['sessaccnum'])){ ?> cep_acc_send_to_ceonpoint(); <?php } ?>
    });
    function viewDoc(url){
        $('#viewImageDoc').attr('src',url);
        $('#viewDocModal').modal('show');
    }
        
    function close(){
        $('#viewImageDoc').attr('src','');
    }
    
    function cep_acc_send_to_ceonpoint(){
        var email = '<?php echo $cep_details->email; ?>';
        var user_name = '<?php echo $cep_details->business_name; ?>';
        var website = '<?php echo base_url(); ?>';
        var accreditation_num = '<?php echo $_SESSION['sessaccnum']; ?>';
        var accreditation_validity = '<?php echo $_SESSION['sessaccvalidity']; ?>';
        var dataValues = { 
                email : email,
                user_name : user_name,
                website : website, 
                accreditation_num : accreditation_num, 
                accreditation_validity : accreditation_validity 
            }
        var dataValue = JSON.stringify(dataValues);

        $.ajax({
            type: "POST",
            url: "https://ceonpoint.com/api/accreditationapi/cepaccreditationapi",
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

var sess = "<?php unset($_SESSION['sessaccnum']); unset($_SESSION['sessaccvalidity']); ?>";
</script>