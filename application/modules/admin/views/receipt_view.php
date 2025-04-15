<?php //print_r($details);exit;
	///
	
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
		//$user = $this->db->get_where('tbl_course_documents',array('provider_id'=>$details->user_id))->row();
		$c_doc = $this->db->get_where('tbl_course_documents',array('cor_doc_id'=>$details->doc_refrence_id))->row();
		
		$name = $user->business_name;
		$course_title = $c_doc->course_title;
		$type ='Online Course Accreditation : '.$course_title.' ('.$name.')';
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
		$c_doc = $this->db->get_where('tbl_training_documents',array('train_doc_id'=>$details->doc_refrence_id))->row();

		$name = $user->business_name;
		$course_title = $c_doc->training_title;
		$type ='Training Course Accreditation : '.$course_title.' ('.$name.')';
	}
	if($details->payment_for == 'PR' || $details->payment_for == 'PRG'){
		if($details->payment_for == 'PR'){
			$user = $this->db->get_where('tbl_users',array('user_ID'=>$details->user_id))->row();
			$name = $user->fname.' '.$user->lname.' '.$user->name; 
		}else{
			$user = $this->db->get_where('graduates',array('grad_id'=>$details->user_id))->row();
			$name = $user->student_name.' '.$user->middle_name.' '.$user->surname; 
		}
		$type =($details->payment_type == 'N')?'Professional Registration ('.$name.')':'Professional License Renewal ('.$name.')';
	} 
	if($details->payment_for == 'CEP'){
		$user = $this->db->get_where('tbl_ce_provider',array('provider_id'=>$details->user_id))->row();
		
		$name = $user->business_name;
		$type =($details->payment_type == 'N')?'CEP Accreditation ('.$name.')':'Renewal of CEP Accreditation ('.$name.')';
	} 
	if($details->payment_for == 'VR'){
		$user = $this->db->get_where('tbl_users',array('user_ID'=>$details->user_id))->row();
		$name = $user->fname.' '.$user->lname.' '.$user->name; 
		$type ='Request for Verification of Registration ('.$name.')';
	}
	if($details->payment_for == 'GS'){
		$user = $this->db->get_where('tbl_users',array('user_ID'=>$details->user_id))->row();
		$name = $user->fname.' '.$user->lname.' '.$user->name; 
		$type ='Request for Certificate of Good Standing ('.$name.')';
	}
	
	/* if($details->payment_for == 'U' && $details->payment_type == 'N'){
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
		$payment_type = 'Foreign Professional Review for Professional Registration Fee';
	}
	else if($details->payment_for == 'PP'){
		$payment_type = 'Foreign Professional for Licensure Examination Fee';
	}
	else{
		$payment_type =($details->payment_type == 'R')?'Renew':'New';
	} */  ?>

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
			<th>Description</th>
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