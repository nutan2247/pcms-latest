<?php //echo '<pre>'; print_r($details);
	
	if($details->payment_for == 'P'){
		$user = $this->db->get_where('tbl_users',array('user_ID'=>$details->user_id))->row();
		$name = $user->fname.' '.$user->lname.' '.$user->name; 
		$type ='Foreign Professional Review of Documents for Professional Registration ('.$name.')';
	}
	if($details->payment_for == 'PP'){
		$user = $this->db->get_where('tbl_users',array('user_ID'=>$details->user_id))->row();
		$name = $user->fname.' '.$user->lname.' '.$user->name;
		$type ='Foreign Professional Review of Documents for Licensure Examination ('.$name.')';
	}
	if($details->payment_for == 'U'){
		$user = $this->db->get_where('tbl_university',array('uniid'=>$details->user_id))->row();
		$name = $user->university_name;
		$type =($details->payment_type == 'N')?'School Accreditation Fee ('.$name.')':'Renewal of School Accreditation Fee ('.$name.')';
	}
	if($details->payment_for == 'C'){
		$user = $this->db->get_where('tbl_ce_provider',array('provider_id'=>$details->user_id))->row();
		$name = $user->business_name;
		$type ='Online Course Accreditation ('.$name.')';
	}
	if($details->payment_for == 'G'){
		if($details->payment_type == 'S'){
			$name = $this->common_model->getsectionname($details->user_id,'U'); //university name will goes to front end because univerty pay for submission of graduates.
			$type =	'Submission of Graduates for Licensure Examination ('.$name->section_name.')';
		}
		if($details->payment_type == 'E'){
			$name = $this->common_model->getsectionname($details->user_id,'G');
			$type =	'Booking for Online Licensure Examination ('.$name->section_name.')';
		}
	}
	if($details->payment_for == 'T'){
		$user = $this->db->get_where('tbl_ce_provider',array('provider_id'=>$details->user_id))->row();
		$name = $user->business_name;
		$type ='Training Course Accreditation ('.$name.')';
	}
	if($details->payment_for == 'PR' || $details->payment_for == 'PRG'){
		if($details->payment_for == 'PR'){
			$user = $this->db->get_where('tbl_users',array('user_ID'=>$details->user_id))->row();
			$name = $user->fname.' '.$user->lname.' '.$user->name; 
		}else{
			$user = $this->db->get_where('graduates',array('grad_id'=>$details->user_id))->row();
			$name = $user->student_name.' '.$user->middle_name.' '.$user->surname; 
		}
		$type =($details->payment_type == 'N')?'Professional Registration ('.$name.')':'Renewal of Professional Registration ('.$name.')';
	} 
	if($details->payment_for == 'CEP'){
		$user = $this->db->get_where('tbl_ce_provider',array('provider_id'=>$details->user_id))->row();
		$name = $user->business_name;
		$type =($details->payment_type == 'N')?'CEP Accreditation ('.$name.')':'Renewal of CEP Accreditation ('.$name.')';
	}  ?>

<div class="order-receipt">
	<div class="row">
		<div class="col-sm-6">
			<div class="box-layout" style="height:175px;">
				<div class="box-title">Bill To</div>
					<div class="box-desc">
						<!-- <p><strong><?php echo $details->user_id; ?></strong><br></p> -->
						<p><strong><?php echo $details->payer_email; ?></strong></p>
						<?php $date = explode('-',$details->payment_date);?>
						<p>Receipt Number: <strong>#<?=$details->payment_id.'-'.$date[0];?></strong></p>
					</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="box-layout" style="height:175px;">
			<div class="box-title">Invoice Date</div>
				<div class="box-desc">
					<p><strong><?php echo date('M d, Y',strtotime($details->payment_date)); ?></strong><br></p>						 
				</div>
			</div>
		</div>
	</div>
	<table class="table table-bordered">
		<tr>
			<th>Description Accreditation</th>
			<th width="10%">Qty</th>
			<th width="15%">Price</th>
			<th width="15%">Amount</th>
		</tr>
		<tr>
			<td>
			<?php echo $type; ?>
				<div class="transaction-short-desc"> 
					Transaction id: <b><?php echo $details->txn_id; ?></b>
				</div>
			</td> 
			<td class="text-center">1</td>
			<td class="text-right">$<?php echo $details->payment_amout; ?></td>
			<td class="text-right">$<?php echo $details->payment_amout; ?></td>								
		</tr>
		
	<!-- 	<tr>
			<td>Processing Fee</td>
			<td class="text-right" colspan="2">$<?php echo $details->payment_amout; ?></td>
			<td class="text-right">$<?php echo $details->payment_amout; ?></td>
		</tr> -->
		<tr>
			<td>Sales Tax </td>
			<td class="text-right" colspan="2">$<?php echo $details->payment_tax; ?></td>
			<td class="text-right">$<?php echo $details->payment_tax; ?></td>
		</tr>
		<tr>
			<td>Thank you for using RBoard! We would be glad if you can refer a friend to our website if you are satisfied with our service. If not ,please contact us at <b><?php echo SENT_EMAIL_FROM; ?></b> 
			and tell us how we can improve.</td>
			<?php $total = $details->payment_gross; ?>
			<td class="text-right" colspan="2">Subtotal<br><br><strong>Total</strong></td>	
			<td class="text-right">$<?php echo $total; ?><br> <br>
				<strong>$<?php echo $total; ?></strong>
			</td>							
		</tr>
	</table>
</div>	