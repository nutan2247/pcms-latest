<?php //echo '<pre>'; print_r($details);
	///
	
	if($details->payment_for == 'U' && $details->payment_type == 'N'){
									$payment_type = 'School Accreditation Fee';
								}
								else if($details->payment_for == 'U' && $details->payment_type == 'R'){
									$payment_type = 'Renewal of School Accreditation Fee';
								}
								else if($details->payment_for == 'PR' && $details->payment_type == 'N'){
									$payment_type = 'Professional Registration Fee';
								}
								else if($details->payment_for == 'PR' && $details->payment_type == 'R'){
									$payment_type = 'Renewal of Professional Registration Fee';
								}
								else if($details->payment_for == 'CEP' && $details->payment_type == 'N'){
									$payment_type = 'CEP Accreditation Fee';
								}
								else if($details->payment_for == 'CEP' && $details->payment_type == 'R'){
									$payment_type = 'Renewal of CEP Accreditation Fee';
								}
								else if($details->payment_for == 'T'){
									$payment_type = 'Training Course Accreditation Fee';
								}
								else if($details->payment_for == 'C'){
									$payment_type = 'Online Course Accreditation Fee';
								}
								else if($details->payment_for == 'G'){
									$payment_type = 'Submission of Graduates for licensure Examination Fee';
								}
								else if($details->payment_for == 'P'){
									$payment_type = 'Professional Registration';
								}
								else if($details->payment_for == 'F'){
									$payment_type = 'Foreign Professional';
								}
								else{
									$payment_type =($details->payment_type == 'R')?'Renew':'New';
								}
	 ?>

	<p><strong>Email: <?php echo $details->payer_email; ?></strong></p></br>
	<?php $date = explode('-',$details->payment_date);?>
	<p>Receipt Number: <strong>#<?=$details->payment_id.'-'.$date[0];?></strong></p></br>
					
	<p>Invoice Date :<strong><?php echo date('F d,Y',strtotime($details->payment_date)); ?></strong></p><br>						 
				
	<p>Description : <?php echo $payment_type; ?></p><br>
	<p>Transaction id: <b><?php echo $details->txn_id; ?></p><br>
	<p>Price : $<?php echo $details->payment_amout; ?></p><br>
	<p>Amount : $<?php echo $details->payment_amout; ?></p><br>
	<p>>Sales Tax : $<?php echo $details->payment_tax; ?></p><br>
	<?php $total = $details->payment_gross; ?>		
	<p>Subtotal : $<?php echo $total; ?></p><br>
	<p>Total : $<?php echo $total; ?></p><br>	
	<p>Thank you for using RBoard! We would be glad if you can refer a friend to our website if you are satisfied with our service. If not ,please contact us at <b><?php echo SENT_EMAIL_FROM; ?></b> 
		and tell us how we can improve.</p>		