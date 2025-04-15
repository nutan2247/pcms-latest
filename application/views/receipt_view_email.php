<?php 

	if($details->payment_for == 'P'){
		$payment_type ='Foreign Professional Review of Documents for Professional Registration';
	}
	if($details->payment_for == 'PP'){
		$payment_type ='Foreign Professional Review of Documents for Licensure Examination';
	}
	if($details->payment_for == 'U'){
		$payment_type =($details->payment_type == 'N')?'School Accreditation Fee':'Renewal of School Accreditation Fee';
	}
	if($details->payment_for == 'C'){
		$payment_type ='Online Course Accreditation';
	}
	if($details->payment_for == 'G'){
		$payment_type =($details->payment_type == 'S')?'Submission of Graduates for Licensure Examination':'Booking for Online Licensure Examination';
	}
	if($details->payment_for == 'T'){
		$payment_type ='Training Course Accreditation';
	}
	if($details->payment_for == 'PR' || $details->payment_for == 'PRG'){
		$payment_type =($details->payment_type == 'N')?'Professional Registration':'Renewal of Professional Registration';
	} 
	if($details->payment_for == 'CEP'){
		$payment_type =($details->payment_type == 'N')?'CEP Accreditation':'Renewal of CEP Accreditation';
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
	} */
?>  
    <div class="invoice-dtl" style="width: 80%; float: left;">
        <p><strong>Bill To:</strong><?php echo $details->payer_email; ?></p>
        <?php $date = explode('-',$details->payment_date);?>
        <p>Receipt Number: <strong>#<?=$details->payment_id.'-'.$date[0];?></strong></p>
    </div>
        <div class="invoice-date">
            <p>Invoice Date : <strong><?php echo date('F d,Y',strtotime($details->payment_date)); ?></strong></p>
        </div>
    </div>
    <div style="clear: both; padding: 15px 0 0 0;">
    <div class="container" style="width: 1100px; margin: 0 auto;">
        <div class="invoice-content" style=" border-bottom: 1px solid #ddd;">
            <table class="table" style="width: 100%; border-spacing: 0;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="border-top: none;border-bottom: none;padding: 10px;background-color: #ddd;">#</th>
                        <th scope="col" style="border-top: none;border-bottom: none;padding: 10px;background-color: #ddd;">Description </th>
                        <th scope="col" style="border-top: none;border-bottom: none;padding: 10px;background-color: #ddd;">Transaction Id</th>
                        <th scope="col" style="border-top: none;border-bottom: none;padding: 10px;background-color: #ddd;">Amount </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" style="border-top: none;border-bottom: none;padding: 10px;text-align: center;">1</th>
                        <td style="border-top: none;border-bottom: none;padding: 10px;text-align: center;"><?php echo $payment_type; ?></td>
                        <td style="border-top: none;border-bottom: none;padding: 10px;text-align: center;"><?php echo $details->txn_id; ?></td>
                        <td style="border-top: none;border-bottom: none;padding: 10px;text-align: center;">$<?php echo $details->payment_amout; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
   </div>

    <div class="container" style="width: 1100px; margin: 0 auto;">
        <div class="total">
            <div style="width: 300px;float: right;">
                <table class="table" style="width: 100%;margin: 20px 0;">

                    <tbody>
                        <tr>
                            <td style="border-top: none;border-bottom: none;padding: 10px;">Subtotal</td>
                            <td style="border-top: none;border-bottom: none;padding: 10px;">$<?php echo $details->payment_amout; ?></td>
                        </tr>
                        <tr>
                            <td style="border-top: none;border-bottom: none;padding: 10px;">Sales tax</td>
                            <td style="border-top: none;border-bottom: none;padding: 10px;">$<?php echo $details->payment_tax; ?></td>
                        </tr>
                        <tr>
                            <td style="border-top: none;border-bottom: none;padding: 10px;"><strong>Total</strong></td>
                            <td style="border-top: none;border-bottom: none;padding: 10px;"><strong>$<?php echo $details->payment_gross; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>