<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 <?php $this->view('dashboard_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
                	<h4 class="mb-4 mt-4 text-uppercase text-center">Accreditation History</h4>
				<?php
						echo '<table class="table table-bordered">
						<tr>
						<th>Sl No.</th>
						<th>Application for</th>
						<th>Date applied</th>
						<th>Reference #</th>
						<th>Amount</th>
						<th>Accreditation #</th>
						<th>Date Issued #</th>
						<th>Validity Date</th>
						<th>Duration</th>
						<th>Status</th>
						<th>Action</th>
						</tr>';
						//echo '<pre>';print_r($paymentarr);exit;
						if(count($paymentarr) > 0){
						$count = 1;
						foreach($paymentarr as $payments){
							$payment_type = ($payments->payment_type == 'N')?'CEP Accreditation':'Renew CEP Accreditation';
							
							// $date1 = new DateTime($payments->issued_date);
							// $date2 = new DateTime($payments->validity_date);
							// $interval = $date1->diff($date2);
							// $duration =  $interval->y.' year'.$interval->m.' month'.$interval->d.' days';
							$duration =  ($payments->renew_for <= 1)?$payments->renew_for.' Year':$payments->renew_for.' Years';
							if($payments->reviewer_status > 0){
								if($payments->validity_date > date('Y-m-d H:i:s')){
									$accstatus = 'Valid';
								}else{
									$accstatus = 'Expired';
								}

								if($payments->reviewer_status == '1'){
									$status = 'Approved';
								}else{
									$status = 'Rejected';
								}
							}else{
								$status = 'Pending'; 
								$accstatus = 'Pending'; 
							}

							if($payments->reviewer_id && $payments->reviewer_status == 1 ){
								$renewAcc = $payments->accreditation_no;
								$issued_date = date('Y-m-d',strtotime($payments->issued_date));
								$validity_date = date('Y-m-d',strtotime($payments->validity_date));
								$duration = $duration;
								$viewBtn = "<a href='javascript:void(0)' onclick=viewCertificate('".$payments->reference_no."') class='btn btn-info' title='Certificate'>View</a>";
							}else{
								$renewAcc = '--';
								$issued_date = '--';
								$validity_date =  '--';
								$duration = '--';
								$viewBtn = '<a href="javascript:void(0)" class="btn btn-info" title="Certificate">Pending</a>';
							}
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$payment_type.'</td>';
							echo '<td>'.date('Y-m-d',strtotime($payments->payment_date)).'</td>';	
							echo '<td>'.$payments->txn_id.'</td>';		
							echo '<td>'.$payments->payment_gross.'</td>';	
							echo '<td>'.$renewAcc.'</td>';	
							echo '<td>'.$issued_date.'</td>';	
							echo '<td>'.$validity_date.'</td>';	
							echo '<td>'.$duration.'</td>';				
							echo '<td>'.$accstatus.'</td>';				
							echo '<td>'.$viewBtn.' </td>';
							echo '</tr>';
						}
					}else{
						echo '<tr style="text-align:center;color:red;"><th colspan="11" >No Accreditation History</th></tr>';
					}
					echo '</table>'; ?> 
				</div>
            </div>
        </div>
    </section>