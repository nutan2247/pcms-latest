<script type="text/javascript">   var base_url = "<?php echo base_url(); ?>"; </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/revewier/revewer.js'); ?>"></script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="clearfix">
                <?php if(isset($foreign_application) && $foreign_application !=''){ $countuing = count($foreign_application); }else{ $countuing = 0; } ?>
                <h4 class="float-left mt-4 mb-3"><?php echo $page_title.'('.$countuing.')'; ?></h4>
                <a class="btn btn-primary float-right mt-4 mb-3" href="javascript:history.back()"> Back</a>
            </div>

            <!-- <input type="hidden" name="reviewer_id" id="reviewer_id" value="<?php echo $this->session->userdata('log-in')['user_ID']; ?>"> -->
            <div class="card">
			    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Photo</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Refrence Number</th>
                                    <th>Type</th>
                                    <th>Date of birth</th>
                                    <th>Gender</th>
                                    <th>Profession</th>
                                    <th>Email</th>
                                    <th>Registration Code</th>
                                    <th>Date Issued</th>
                                    <th>Validity</th>
                                    <!--<th>Amount</th>
                                    <th>Receipt</th>-->
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                            if(!empty($foreign_application)){
                                $i = 1;
                                foreach ($foreign_application as $key => $value) {
                                    if($value->reviewer_status==1){
                                        $appstatus = '<span class="text-success">Approved</span>';
                                    }elseif($value->reviewer_status==2){
                                        $appstatus = '<span class="text-danger">Rejected</span>';
                                    }else{
                                        $appstatus = '<span class="text-primary">Pending</span>';
                                    }

                                    if($value->role == 'P'){
                                        $type = 'Exam';
                                        $verify_url = site_url('admin/admin/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;
                                    }else{
                                        $type = 'Non-Exam';
                                        $verify_url = site_url('admin/admin/verify_document/').$value->user_ID;
                                    }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';
                                    $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/').'" width="200px" height="200px">';
                            ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class="dp-image"><?=$photo;?></td>
                                            <td><?php echo $value->name; ?></td>
                                            <td><?php echo $value->fname; ?></td>
                                            <td><?php echo $value->lname; ?></td>
                                            <td><?php echo $value->refrence_code; ?></td>
                                            <td><?php echo $type; ?></td>
                                            <td><?php echo date('F d Y',strtotime($value->dob)); ?></td>
                                            <td><?php echo $value->gender; ?></td>
                                            <td><?php echo $value->profession_name; ?></td>
                                            <td><?php echo $value->email; ?></td>
                                            <td><?php echo $value->registration_no; ?></td>
                                            <td><?php echo ($value->lic_issue_date!='0000-00-00 00:00:00')?date('M d,Y',strtotime($value->lic_issue_date)): date('M d,Y',strtotime($value->license_issued_date)); ?></td>
                                            <td><?php echo ($value->expiry_at!='0000-00-00')?date('M d,Y',strtotime($value->expiry_at)):date('M d,Y',strtotime($value->lic_val_date)); ?></td>
                                            <!--<td><?php echo $value->amount; ?></td>
                                            <td><?php echo $value->txn_id; ?></td>-->
                                            <td><?php echo $appstatus; ?></td>
                                            <td><?php echo $reviewerName; ?></td>
                                            <td>
                                                <!-- <a target="_blank" href="<?php echo site_url('license/landing/professional_license?user_view=').base64_encode($value->user_ID);?>" title="View"><i class="fas fa-eye"></i> </a> -->
                                                
                                                <!--<a target="" href="<?php echo $verify_url;?>" title="View Documents">View</a>-->
                                                <a href="javascript:void(0);" data-id="<?=$value->user_ID?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                                <a class="viewcertificate" href="javascript:void(0);" data-id="<?php echo $value->user_ID; ?>"><i class="fas fa-id-card"></i></a>

                                            </td>
                                        </tr>

                                        <?php $i++; } 
                                            }else{
                                                echo '<tr><td colspan="17" class="text-center">No professional available.</td></tr>';
                                            } ?>
                                    </tbody>

                                </table>
							
							<?php echo '</div></div>';  
						?>
					
               
            </div>

        </div>

    </main>

    <div class="modal fade certificate-modal certificat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- body -->
                <div class="modal-body text-center">
                    <div id="crtdetials"></div>
                </div>
                <!-- end body -->
            </div>
        </div>
    </div> 

<script>

    $( ".viewdetails" ).click(function() {
		$('#displaydetials').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/prodetailsforpopup",
				data: { schid : schid},
				success: function(data) {
					//alert(data);
					$('#displaydetials').html(data); 
				}
			});
			$('.viewdetails-modal').modal('show'); 
		}
	  
	});

    $( ".viewcertificate" ).click(function() {
        var docid = $(this).data("id");
        if(docid > 0){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>admin/profcertificateforreviewer",
                data: { docid : docid},
                success: function(data) {
                    //alert(data);
                    $('#crtdetials').html(data); 
                }
            });
            $('.certificate-modal').modal('show'); 
        }
    });
 </script>	
