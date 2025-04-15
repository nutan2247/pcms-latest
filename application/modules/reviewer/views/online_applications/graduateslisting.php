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
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
            <input type="hidden" name="reviewer_id" id="reviewer_id" value="<?php echo $this->session->userdata('log-in')['user_ID']; ?>">
            <div>
			<?php 
							if(is_array($graduates)?count($graduates):0 > 0){
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
                        </ul>-->
						<div class="card-body">
                            <div class="table-responsive"><table class="table table-bordered" id="dataTable_4" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Exam Code</th>
											<th>Name of Examinee</th>
											<th>Date issued</th>
											<th>Validity Date</th>
											<th>Gender</th>
											<th>Dateof Birth</th>
											<th>Course</th>
											<th>Reviewer</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
										//echo '<pre>'; print_r($graduates); 
										$ucount = 1;
										foreach($graduates as $grrd){
											if($grrd->reviewer_status == 2){
												$status= 'Rejected';
											}
											else if($grrd->reviewer_status == 1){
												$status= 'Approved';
											}else{
												$status= 'Pending';
											}
											$years = explode(" ",$grrd->validity);
											$date = date('Y-m-d',strtotime($grrd->date_issued));
											$validity = date($date,strtotime('+2 years'));
											$reviewerName = ($grrd->reviewer_id > 0)?$grrd->rev_firsname:'<button type="button" data-id="'.$grrd->grad_id.'" id="revewier_accept'.$grrd->grad_id.'" onClick="acceptgraduatesApplication(\''.$grrd->grad_id.'\')" class="btn btn-primary px-5">Accept</button>';
											
											echo '<tr>
													<td>'.$ucount++.'.</td>
													<td>'.$grrd->examcode.'</td>
													<td>'.$grrd->student_name.' '.$grrd->middle_name.''.$grrd->surname.'</td>
													<td>'.$date.'</td>
													<td>'.$validity.'</td>
													<td>'.$grrd->gender.'</td>
													<td>'.$grrd->dob.'</td>
													<td>'.$grrd->collegeofname.'</td>	
													<td>'.$reviewerName.'</td>	
													<td>'.$status.'</td>
													<td><a href="javascript:void(0);" data-id="'.$grrd->grad_id.'" class="viewgraduatedetails"><i class="fas fa-eye"></i> </a><a class="viewcertificate" href="javascript:void(0);" data-id="'.$grrd->grad_id.'"><i class="fas fa-id-card"></i></a></td>
												</tr>';
										}
									echo '</tbody>
									</table></div></div>';
									
								
							}else{
								echo 'No graduates available.';
							}
						?>
            </div>
        </div>
    </main>


<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="crtdetials"></div>
      <!-- end body -->
    </div>
  </div>
</div>
<div class="modal fade viewgraduatedetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- body -->
	   
		<div id="grddetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div>	

<script>
 function acceptgraduatesApplication(appid){
		//alert(appid); 
		//return false;
		var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
	   // alert(appid+' * '+reviewer_id)
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>reviewer/reviewer/graduateassignedreviewer",
			data: { appid : appid,reviewer_id:reviewer_id },
			success: function(data) {
				//alert(data);
				if(data>0){
					alert('Reviewer assigned for the graduates.');
					location.reload();
				}   
			}
		});
	 }

	$(document).ready(function() {
        $('#dataTable_4').DataTable();
    } );


	$( ".viewcertificate" ).click(function() {
		var docid = $(this).data("id");
		if(docid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>reviewer/reviewer/graduatecertificate",
				data: { docid : docid},
				success: function(data) {
					//alert(data);
					$('#crtdetials').html(data); 
				}
			});
			$('.certificate-modal').modal('show'); 
		}
	  
	});
	$( ".viewgraduatedetails" ).click(function() {
		$('#grddetials').html('Loading...'); 
		var docid = $(this).data("id");
		if(docid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>reviewer/reviewer/graduatedetailsforpopup",
				data: { docid : docid},
				success: function(data) {
					//alert(data);
					$('#grddetials').html(data); 
				}
			});
			$('.viewgraduatedetails-modal').modal('show'); 
		}
	  
	});
 </script>	