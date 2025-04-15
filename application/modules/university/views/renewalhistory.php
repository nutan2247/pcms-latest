<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
				<h3>Accreditation History</h3>
				<?php
					$count = 1; 
					if(count($renewdocarr) > 0){
						echo '<table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Application For</th>
							<!--<th>Application Number</th>-->
							<th>Date Applied</th>
							<th>Amount</th>
							<th>Receipt</th>
							<th>Accreditation No.</th>
							<th>Date Issued</th>
							<th>Validity</th>
							<th>Status</th>
							<th>Action</th>
						</tr>';
						foreach($renewdocarr as $payments){
							// echo '<pre>'; print_r($payments);
							$application_for = ($payments->document_for == 'n')?'School Accreditaion':'Renewal of School Accreditaion';
							if($payments->reviewer_status < 1 ){
								$status = 'Pending';	
							}
							elseif($payments->reviewer_status == 1 ){
								$status = 'Approved';	
							}else{
								$status = 'Rejected';	
							}
							if($payments->reviewer_status == 1 ){
								$actionlink = '<a href="javascript:void(0);" data-id="'.$payments->accreditation_number.'" class="viewcertificate">Cert. of Accreditation</a>';
							}else{
								$actionlink = '--';
							}
							$date = explode('-',$payments->payment_date);
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$application_for.'</td>';
							//echo '<td>--</td>';
							echo '<td>'.date("M d, Y",strtotime($payments->updated_at)).'</td>';
							echo '<td>'.$payments->payment_gross.'</td>';
							echo '<td>#'.$payments->payment_id.'-'.$date[0].'</td>';
							echo '<td>'.$payments->accreditation_number.'</td>';
							echo '<td>'.date("M d, Y",strtotime($payments->updated_at)).'</td>';
							echo '<td>'.date("M d, Y",strtotime($payments->expiry_at)).'</td>';
							echo '<td>'.$status.'</td>';
							echo '<td>'.$actionlink.'</td>';
							echo '</tr>';
						}
						echo '</table>';
					}else{
						echo '<p style="text-align:center;color:red;">No Accreditaion History</p>';
					}
				?>
				
				</div>
            </div>
        </div>
    </section>
	<!-- certifcate modal -->
		<div class="modal fade" id="certificate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Certificate
						<!--<button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>-->
						<!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- Body part -->
						<iframe src="" id="crtificatedetials" width="750" height="850" frameborder="0"></iframe>
						<!-- end Body part -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
			</div>
		</div>
	<!-- end certifcate modal -->
   <script>
	$( ".viewcertificate" ).click(function() {
		var refrenceno = $(this).data("id");
		var path = "<?php echo base_url()?>assets/uploads/pdf/"+refrenceno+".pdf";
		// alert(path);
		if(refrenceno != ''){
			$('#crtificatedetials').attr('src',path); 
			$('#certificate-modal').modal('show'); 
		}
		// if(docid > 0){
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "<?php echo base_url('university/university/viewcertificate');?>",
		// 		data: { docid : docid},
		// 		success: function(data) {
		// 			//alert(data);
		// 			$('#crtdetials').html(data); 
		// 		}
		// 	});
		// 	$('#certificate-modal').modal('show'); 
		// }
	  
	});
</script>