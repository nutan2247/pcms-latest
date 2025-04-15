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
<link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese"
        rel="stylesheet">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title;?> </h4>
            <input type="hidden" name="reviewer_id" id="reviewer_id" value="">
            <div>
			
								<!--<ul class="nav nav-tabs border-0" id="myTab" role="tablist">
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
                            <div class="table-responsive"><table class="table table-bordered" id="dataTable_4" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <!--<th>College of</th>-->
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact No.</th>
                                            <th>Name of Representative</th>
											<th>Position</th>
                                            <th>Type</th>
                                            <th>Accreditation Number</th>
                                            <th>Validity Date</th>
                                            <th>Date Issued</th>
                                            <th>Duration</th>
                                            <th>Reviewer</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
			<?php 
							if(is_array($university)?count($university):0 > 0){
								
										//echo '<pre>'; print_r($university); 
										$ucount = 1;
										foreach($university as $uni){
											if($uni->reviewer_status == 2){
												$status= 'Rejected';
											}
											else if($uni->reviewer_status == 1){
												$status= 'Approved';
											}else{
												$status= 'Pending';
											}
											$reviewerName = ($uni->reviewer_id > 0)?$uni->rev_firsname:'<button type="button" data-id="'.$uni->unidoc_id.'" id="revewier_accept'.$uni->unidoc_id.'" onClick="acceptuniversityApplication(\''.$uni->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>';
											$type = ($uni->document_for == 'r')?'Renew':'New';
											$logo = ($uni->college_logo !="" && file_exists('./assets/images/university/'.$uni->college_logo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/'.$uni->college_logo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/default-logo.png').'" width="200px" height="200px">';
											echo '<tr>
													<td>'.$ucount++.'.</td>
													<td>'.$logo.'</td>
													<td>'.$uni->university_name.'</td>
													<!--<td>'.$uni->collegeofnmae.'</td>-->
													<td>'.$uni->address.'</td>
													<td>'.$uni->email.'</td>
													<td>'.$uni->contact_no.'</td>
													<td>'.$uni->name_of_representative.'</td>
													<td>'.$uni->position.'</td>
													<td>'.$type.'</td>
													<td>'.$uni->accreditation_number.'</td>
													<td>'.date("M d, Y", strtotime($uni->expiry_at)).'</td>
													<td>'.date("M d, Y", strtotime($uni->review_accept_date)).'</td>
													<td>'.$uni->renew_for.' Years</td>
													<td>'.$reviewerName.'</td>
													<td>'.$status.'</td>
													
													<td>
													<a href="javascript:void(0);" data-id="'.$uni->unidoc_id.'" class="viewdetails"><i class="fas fa-eye"></i> </a> 
                                                    <a class="viewcertificate" href="javascript:void(0);" data-id="'.$uni->unidoc_id.'" data-name="'.$uni->accreditation_number.'"><i class="fas fa-id-card"></i></a></td>
												</tr>';
										}
									
									
								
							}else{
								echo '<tr><td colspan="16"><p style="text-align:center;">No school available.</p></td></tr>';
							}
						?>
						</tbody>
							</table></div></div>
               
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
<div class="modal fade viewdetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="displaydetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div> 
<script>

$(".viewcertificate").click(function() {
	var docid = $(this).data("id");
	var accr = $(this).data("name");
	if(docid > 0){
		// $.ajax({
		// 	type: "POST",
		// 	url: "<?php echo base_url();?>reviewer/reviewer/schoolcertificate",
		// 	data: { docid : docid},
		// 	success: function(data) {
		// 		//alert(data);
		// 		$('#crtdetials').html(data); 
		// 	}
		// });
		// $('.certificate-modal').modal('show');
        var url = '<?php echo base_url("assets/uploads/pdf/"); ?>'+accr+'.pdf';
        // alert(url);
        var result = '<iframe src="'+url+'" width="100%" height="750" style="border:1px solid black;"></iframe>';
		$('#crtdetials').html(result); 
		$('.certificate-modal').modal('show'); 
	}
  
});
 function acceptuniversityApplication(appid){
	//alert(appid); 
	//return false;
	var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
   // alert(appid+' * '+reviewer_id)
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>reviewer/reviewer/universityassignedreviewer",
		data: { appid : appid,reviewer_id:reviewer_id },
		success: function(data) {
			//alert(data);
			if(data>0){
				alert('Reviewer assigned for the university.');
				location.reload();
			}   
		}
	});
 }
 $( ".viewdetails" ).click(function() {
		$('#displaydetials').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/universitydetailsforpopup",
				data: { schid : schid},
				success: function(data) {
					//alert(data);
					$('#displaydetials').html(data); 
				}
			});
			$('.viewdetails-modal').modal('show'); 
		}
	  
	});

   $(document).ready(function() {
        $('#dataTable_4').DataTable();
    } );

 </script>	