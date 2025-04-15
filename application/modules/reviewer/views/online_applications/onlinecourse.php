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
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?>(<?php echo is_array($online_course_application)?count($online_course_application):0; ?>)</h4>
            <input type="hidden" name="reviewer_id" id="reviewer_id" value="<?php echo $this->session->userdata('log-in')['user_ID']; ?>">
            <div>
			<?php 
							if(is_array($online_course_application)?count($online_course_application):0 > 0){
								 echo '<!--<ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link active text-dark" data-toggle="tab"
                                    href="#all"><small>ALL</small></a>
                            </li>
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link text-dark" data-toggle="tab"
                                    href="#approval"><small>Approved(<?php echo !empty($approved_row_count)?$approved_row_count:"";?>)</small></a>
                            </li>
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link text-dark" data-toggle="tab"
                                    href="#pending"><small>Pending(<?php echo !empty($pending_row_count)?$pending_row_count:"";?>)</small></a>
                            </li>
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link text-dark" data-toggle="tab"
                                    href="#disapproval"><small>Disapproval(0)</small></a>
                            </li>
                        </ul> -->
						<div class="card-body">
                            <div class="table-responsive">'; ?>
								<table class="table table-bordered" id="dataTable_4" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Photo</th>
                                            <th>Course Name</th>
                                            <th>Course Unit</th>
                                            <th>CEP name</th>
                                            <th>Accreditation No.</th>
                                            <th>Validity Date</th>
                                            <th>Date Issued</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Reviewer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php if(!empty($online_course_application)){
                                $i = 1;
                                foreach ($online_course_application as $key => $value) {
                                    if($value->reviewer_status == 2){ $status= 'Rejected'; }else if($value->reviewer_status == 1){ $status= 'Approved'; }else{ $status= 'Pending'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->cor_doc_id.'" id="revewier_accept'.$value->cor_doc_id.'" onClick="acceptCourseAccr(\''.$value->cor_doc_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                    $photo = ($value->course_image !="" && file_exists('./assets/images/ce_provider/'.$value->course_image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/'.$value->course_image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/default-logo.jpg').'" width="200px" height="200px">'; ?>
                            
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?=$photo;?></td>
                                            <td><?php echo $value->course_title; ?></td>
                                            <td><?php echo $value->course_units; ?></td>
                                            <td><?php echo $value->business_name; ?></td>
                                            <td><?php echo $value->accreditation_no; ?></td>
                                            <td><?php echo date('F d Y',strtotime($value->expiry_at));?></td>
                                            <td><?php echo date('F d Y',strtotime($value->review_accept_date)); ?></td>
                                            <td><?=$value->renew_for;?> year/s'</td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $reviewerName; ?></td>  
                                                
                                            <td>
                                                <a href="<?php echo site_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->cor_doc_id;?>" title="View Course"><i class="fas fa-eye"></i></a>
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

    function acceptCourseAccr(appid){
        var conf = confirm("Do you accept to review this couse application ?");
        if (conf == true) {
            var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>reviewer/reviewer/courseassignedreviewer",
                data: { appid : appid,reviewer_id:reviewer_id },
                success: function(data) {
                    //alert(data);
                    if(data > 0){
                        alert('Reviewer assigned for Course.');
                        location.reload();
                    }   
                }
            });
        }
    }

 </script>	