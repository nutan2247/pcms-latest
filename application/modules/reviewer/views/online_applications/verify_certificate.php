<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3">
                <?php echo $title; ?>
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
                                    <h4>
                                        <?php echo ucwords(!empty($application)?$application[0]->fname.' '.$application[0]->lname.' '.$application[0]->name:"--"); ?>
                                    </h4>

                                    <p><b>Profession:</b>

                                        <?php echo (!empty($application)?$application[0]->profession_name:""); ?><br><b>License

                                            No:</b>
                                        <?php echo (!empty($application)?$application[0]->license_no:""); ?><br><b>Validity:</b>
                                        <?php echo (!empty($application)?date('M d,Y',strtotime($application[0]->license_validity_date)):""); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">University :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo (($application[0]->university > 0)?$application[0]->university_name:$application[0]->other_university); ?>
                                                </label>
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
                                                <label for="field-1" class="control-label">
                                                    <?php echo (($application[0]->college > 0)?$college_of:$application[0]->other_college); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($application[0]->u_address)){ ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">Address :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo (!empty($application[0]->u_address)?$application[0]->u_address:"--"); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">Email :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo (!empty($application[0]->email)?$application[0]->email:"--"); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($application[0]->u_contact)){ ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">Contact No. :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo (!empty($application[0]->u_contact)?$application[0]->u_contact:"--"); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">Date of Birth :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo (!empty($application[0]->dob)?date('M d,Y',strtotime($application[0]->dob)):"--"); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">Gender :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo ucwords(!empty($application[0]->gender)?$application[0]->gender:"--"); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="field-1" class="control-label">Country :</label>
                                            </div>

                                            <div class="col-sm-8">
                                                <label for="field-1" class="control-label">
                                                    <?php echo (!empty($application[0]->countries_name)?$application[0]->countries_name:"--"); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <form role="form" class="form-horizontal form-groups-bordered validate"
                                        method="post"
                                        action="<?php echo base_url('reviewer/reviewer/verify_certificate');?>">

                                        <!-- <h4>Uploaded Documents</h4>   -->
                                        <div class="table-div bg-primary p-4 rounded my-1">

                                            <h4 class="text-light mb-3 text-uppercase">Reported CERTIFICATES</h4>

                                            <div class="bg-white p-3">
                                                <div class="tab-content pt-2">
                                                    <div id="home" class="tab-pane fade in active show">
                                                        <!-- <h3>ALL</h3> -->
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Certificate No</th>
                                                                    <th>Course/Traning Name</th>
                                                                    <th>Units</th>
                                                                    <th>Category</th>
                                                                    <th>Issued By</th>
                                                                    <!-- <th>Issued From</th> -->
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                    <?php if(!empty($certificate)) {
                                        $s_no = 1; 
                                        $certificate_status = array_diff(array_column($certificate,'certificate_identify'),['']);
                                        foreach ($certificate as $key => $value) {   ?>

                                                                <tr>
                                                                    <td>
                                                                        <?php echo $s_no; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $value->certificate_id; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $value->course_name; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $value->units; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $value->category; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $value->issue_by; ?>
                                                                    </td>
                                                                    <!-- <td><?php echo $value->issue_from; ?></td> -->
                                                                    <?php   if($value->certificate_identify == 1){ 
                                                                        $status = '<span style="color:green" ><i class="fa fa-check-circle"></i>VERFIED </span>';
                                                                    }elseif($value->certificate_identify == 2){ 
                                                                        $status = '<span style="color:red" ><i class="fa fa-times-circle"></i> UNVERFIED </span>';
                                                                    }else{
                                                                        $status = '<span style="color:red" ><i class="fa fa-check-circle"></i>PENDING</span>';
                                                                    } ?>
                                                                    <td  style="width: 115px;"><?php echo $status; ?></td>
                                                                    
                                                                    <td style="width: 261px;">
                                                                        <a href="javascript:void(0)"
                                                                            onclick="viewCertificate('<?php echo $value->certificate; ?>')"
                                                                            class="btn btn-info">View</a>
                                                                        <a href="<?php echo $value->web_link; ?>"
                                                                            target="_blank"
                                                                            class="btn btn-info">website</a>
                                                                        <?php if($documents->reviewer_id > 0 && $documents->reviewer_id == $this->session->userdata('login')['user_ID']){ ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="verify('<?php echo $value->id; ?>','<?php echo $value->user_id; ?>')"
                                                                            class="btn btn-info">Verify</a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php $s_no++; } }else{ echo 'No certificate found!'; } ?>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                    <?php if(isset($flag)){

                    }else{
                    if($documents->reviewer_id > 0 && $documents->reviewer_id == $this->session->userdata('login')['user_ID']){ 
					
					if(is_array($professreviewdatails) ? count($professreviewdatails) : 0 < 1){
					?>
                        <?php if(in_array(0, $certificate_status)){ 
                            echo '<p class="text-center">Need to verify all certificates!</p>';
                        }else{ ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="field-1" class="control-label">Comment:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <textarea name="comment" class="form-control"
                                                        placeholder="Please add your all comments here..."
                                                        required><?php echo set_value('comment');?></textarea>
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
                                                    <input type="radio" name="status" value="2" required> Disapprove
                                                    <br>
                                                    <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-6 col-sm-5">
                                                <input type="hidden" name="prof_id" id="prof_id"
                                                    value="<?php echo isset($documents->user_id)?$documents->user_id:'';?>">
                                                <input type="hidden" name="doc_id" id="doc_id"
                                                    value="<?php echo isset($documents->pd_id)?$documents->pd_id:'';?>">
                                                <input type="hidden" name="candidate_type" id="candidate_type"
                                                    value="<?php echo isset($application[0])?'PR':'PRG';?>">
                                                <input type="submit" class="btn btn-success" value="Submit">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php }else{ echo '<p><b>Already commented.</b></p>'; }
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

<div class="modal fade r-board-modal" id="viewcertificateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Certificate</h5>
            </div>

            <div class="modal-body">
                <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
                    <iframe src="" id="viewImageDoc" width="750" height="870" frameborder="0"></iframe>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="close();" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- View verify Modal Start-->

<div class="modal fade r-board-modal" id="verifycertificateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verify Certificate</h5>
            </div>
            <?php echo form_open('reviewer/reviewer/approve_certificate');?>
            <div class="modal-body">
                <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
                    <input type="hidden" name="user_id" id="certuser_id">
                    <input type="hidden" name="doc_id" id="certdoc_id">
                    <input type="hidden" name="id" id="certid">

                    <!-- <input type="radio" name="status" value="1" required> Verifyed |
                    <input type="radio" name="status" value="0" required> Unverifyed -->
                    <input class="radio-check" type="radio" id="status1" name="status" value="1">
                    <label for="status1">VERIFIED</label> |
                    <input class="radio-check" type="radio" id="status" name="status" value="0">
                    <label for="status">UNVERIFIED</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="close();" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<!-- View Documnet Modal End-->

<script>
    function viewCertificate(certificate) {
        var url = "<?php echo base_url('assets/uploads/certificate/'); ?>" + certificate
        $('#viewImageDoc').attr('src', url);
        $('#viewcertificateModal').modal('show');
    }

    function close() {
        $('#viewImageDoc').attr('src', '');
    }

    function verify(id, user_id) {
        var doc_id = '<?php echo $this->uri->segment(5); ?>';
        $('#certid').val(id);
        $('#certuser_id').val(user_id);
        $('#certdoc_id').val(doc_id);
        $('#verifycertificateModal').modal('show');
    }
</script>