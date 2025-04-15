<script type="text/javascript">    
    var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/revewier/revewer.js'); ?>"></script>
<style>
    #myTabContent {
        border: 1px solid #efefef;
        margin-top: -1px;
    }

    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #007bff;
        border-color: #007bff !important;
    }

    #o-all .nav-link.active {
        color: #fff !important;
        background-color: #000;
        border-color: #000 !important;
    }
</style>
<?php //print_r($training_course_application);exit;?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
            <input type="hidden" name="reviewer_id" id="reviewer_id" value="<?php echo $this->session->userdata('log-in')['user_ID']; ?>">
            <div>
			<?php 
							if(isset($training_course_application) > 0){
								echo '<div class="card-body">
                            <div class="table-responsive">'; ?>
								<table class="table table-bordered" id="dataTable_4" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Photo</th>
                                            <th>Training Name</th>
                                            <th>Units</th>
                                            <th>CEP name</th>
                                            <!-- <th>Price</th> -->
											<th>Accreditation No.</th>
                                            <th>Date Issued</th>
                                            <th>Validity</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Reviewer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($training_course_application)){
                                            $i = 1;
                                            foreach ($training_course_application as $key => $value) {
                                            if($value->reviewer_status == 2){ $status= 'Rejected'; }else if($value->reviewer_status == 1){ $status= 'Approved'; }else{ $status= 'Pending'; }
                                            $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->train_doc_id.'" id="revewier_accept'.$value->train_doc_id.'" onClick="acceptTrainingAccr(\''.$value->train_doc_id.'\')" class="btn btn-primary px-5">Accept</button>';

                                            $photo = ($value->training_image !="" && file_exists('./assets/images/ce_provider/'.$value->training_image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/'.$value->training_image).'" width="250px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/default-logo.jpg').'" width="250px" height="200px">'; 
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?=$photo;?></td>
                                            <td><?php echo $value->training_title; ?></td>
                                            <td><?php echo $value->training_units; ?></td>
                                            <td><?php echo $value->business_name; ?></td>
                                            <!-- <td><?php echo $value->training_price; ?></td> -->
                                            <td><?php echo $value->accreditation_no; ?></td>
                                            <td><?php echo date('F d Y',strtotime($value->expiry_at));?></td>
                                            <td><?php echo date('F d Y',strtotime($value->review_accept_date)); ?></td>
                                            <td><?=$value->renew_for;?> year/s'</td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $reviewerName; ?></td>  
                                                
                                            <td>
                                                <a href="<?php echo site_url('reviewer/reviewer/reviewer_trainingdoc/').$value->provider_id.'/'.$value->train_doc_id;?>" title="Verify Documents"><i class="fas fa-eye"></i></a>
												<a class="viewcertificate" href="javascript:void(0);" data-id="<?php echo $value->accreditation_no;?>"><i class="fas fa-id-card"></i></a>
                                            </td>
                                        </tr>

                                        <?php $i++; } } ?>
                                    </tbody>

                                </table>
							
							<?php echo '</div></div>'; 
									
								
							}else{
								echo 'No professional license available.';
							}
						?>
					
               
            </div>

        </div>

    </main>

    <div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" id="crtdetials" frameborder="0" width="850" height="950"></iframe>
           </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


<script>
    $( ".viewcertificate" ).click(function() {
        var acc_no = $(this).data("id");
        var path = "<?php echo base_url('assets/uploads/pdf/'); ?>"+acc_no+".pdf";
        $('#crtdetials').attr('src',path); 
        $('.certificate-modal').modal('show'); 
    });

    function acceptTrainingAccr(appid){
        var conf = confirm("Do you accept to review this training ?");
        if (conf == true) {
            var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>reviewer/reviewer/trainingassignedreviewer",
                data: { appid : appid,reviewer_id:reviewer_id },
                success: function(data) {
                    if(data > 0){
                        alert('Reviewer assigned on training.');
                        location.reload();
                    }   
                }
            });
        }
    }

 
 </script>	