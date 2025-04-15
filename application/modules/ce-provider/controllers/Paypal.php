<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MX_Controller{
	
	function  __construct(){
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('Provider_model','provider');
	}
	 
	function success(){
		
		// Get the transaction data
		$paypalInfo = $this->input->post();

		$data['item_name']		= $paypalInfo['item_name']; //tbl_course id
		$data['item_number']	= $paypalInfo['item_number'];
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['status'] 		= $paypalInfo["payment_status"];
		
		// Pass the transaction data to view
		// $this->load->view('paypal/success', $data);
		redirect('ce-provider/CE_provider/verify_course/'.$paypalInfo['item_name'].'');
	}
	 
	function cancel(){
		// Load payment failed view
		$this->load->view('paypal/cancel');
	 }
	 
	function ipn(){
		// Paypal posts the transaction data
		$paypalInfo = $this->input->post();
		if(!empty($paypalInfo)){
			// Validate and get the ipn response
			$ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

			// Check whether the transaction is valid
			if($ipnCheck){
				// Insert the transaction data in the database
				$data['user_id']		= $paypalInfo["custom"];
				$data['payment_for']	= $paypalInfo["item_number"];
				$data['txn_id']			= $paypalInfo["txn_id"];
				$data['payment_gross']	= $paypalInfo["mc_gross"];
				$data['currency_code']	= $paypalInfo["mc_currency"];
				$data['payer_email']	= $paypalInfo["payer_email"];
				$data['payment_status'] = $paypalInfo["payment_status"];
				$data['payment_type'] 	= 'N';
				$data['payment_date'] 	= date('Y-m-d H:i:s',strtotime($paypalInfo["payment_date"]));
				
				$res = $this->provider->insertTransaction($data);
			
				if($res==true){
					$userid = $paypalInfo["custom"];
					$bytes 		= random_bytes(3); 
					$refcode 	= bin2hex($bytes);
					$traRefCode = 'COR-'.$userid.$refcode.'-'.date('Y');
					
					$update = array(
						'licence_applied'=> 1,
						'applied_date'=> date('Y-m-d H:i:s'),
						'refrence_code'=> $traRefCode
					);
					$updaterefencecode = $this->provider->update('tbl_course',$update,'id',$paypalInfo["item_name"]);
					// $refcodearr = array();
					// $refcodearr['refrence_code'] = $proRefCode;
					// $updaterefencecode = $this->applicant->updatereferencecode($refcodearr,$userid);
					$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for course accreditation was approved.<br><br><br>Should you have questions just message us and we would be happy to assist you.<br><strong>Refrence Code : </strong>'.$traRefCode.'</p>';
					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => SMTP_HOSTNAME,
						'smtp_port' => SMTP_PORT,
						'smtp_user' => SENT_EMAIL_FROM,
						'smtp_pass' => SENT_EMAIL_PASSWORD,
						'mailtype'  => 'html', 
						'newline'   => "\r\n",
						'AuthType'   => "XOAUTH2",
						'charset'   => 'iso-8859-1',
						
					);  
					$this->load->library('email');
					if($updaterefencecode){
						$userdetails = $this->provider->get_user_details($userid);
						//send refrence code 
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($userdetails->email);
						$this->email->subject('Course application submitted');
						$emailbody = array();
						$emailbody['name'] 			= $userdetails->business_name;
						$emailbody['thanksname'] 	= 'RBoard Team';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 	= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
						//end send refrence code 
					}

				}

			}
		}
    }

	function training_success(){
		
		// Get the transaction data
		$paypalInfo = $this->input->post();

		$data['item_name']		= $paypalInfo['item_name'];
		$data['item_number']	= $paypalInfo['item_number'];
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['status'] 		= $paypalInfo["payment_status"];
		
		// Pass the transaction data to view
		// $this->load->view('paypal/success', $data);
		redirect('ce-provider/CE_provider/verify_training/'.$paypalInfo['item_name'].'');
	}

	 
	function training_cancel(){
		// Load payment failed view
		$this->load->view('paypal/cancel');
	 }
	 
	function training_ipn(){
		// Paypal posts the transaction data
		$paypalInfo = $this->input->post();
		if(!empty($paypalInfo)){
			// Validate and get the ipn response
			$ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

			// Check whether the transaction is valid
			if($ipnCheck){
				// Insert the transaction data in the database
				$data['user_id']		= $paypalInfo["custom"];
				$data['payment_for']	= $paypalInfo["item_number"];
				$data['txn_id']			= $paypalInfo["txn_id"];
				$data['payment_gross']	= $paypalInfo["mc_gross"];
				$data['currency_code']	= $paypalInfo["mc_currency"];
				$data['payer_email']	= $paypalInfo["payer_email"];
				$data['payment_status'] = $paypalInfo["payment_status"];
				$data['payment_type'] 	= 'N';
				$data['payment_date'] 	= date('Y-m-d H:i:s',strtotime($paypalInfo["payment_date"]));
				
				$res = $this->provider->insertTransaction($data);
				if($res==true){
					$userid = $paypalInfo["custom"];
					$bytes 		= random_bytes(3); 
					$refcode 	= bin2hex($bytes);
					$traRefCode = 'TRA-'.$userid.$refcode.'-'.date('Y');
					
					$update = array(
						'licence_applied'=> 1,
						'applied_date'=> date('Y-m-d H:i:s'),
						'refrence_code'=> $traRefCode
					);
					$updaterefencecode = $this->provider->update('tbl_training',$update,'id',$paypalInfo["item_name"]);
					// $refcodearr = array();
					// $refcodearr['refrence_code'] = $proRefCode;
					// $updaterefencecode = $this->applicant->updatereferencecode($refcodearr,$userid);
					$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for training accreditation was approved.<br><br><br>Should you have questions just message us and we would be happy to assist you.<br><strong>Refrence Code : </strong>'.$traRefCode.'</p>';
					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => SMTP_HOSTNAME,
						'smtp_port' => SMTP_PORT,
						'smtp_user' => SENT_EMAIL_FROM,
						'smtp_pass' => SENT_EMAIL_PASSWORD,
						'mailtype'  => 'html', 
						'newline'   => "\r\n",
						'AuthType'   => "XOAUTH2",
						'charset'   => 'iso-8859-1',
						
					);  
					$this->load->library('email');
					if($updaterefencecode){
						$userdetails = $this->provider->get_user_details($userid);
						//send refrence code 
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($userdetails->email);
						$this->email->subject('Training application submitted');
						$emailbody = array();
						$emailbody['name'] 			= $userdetails->business_name;
						$emailbody['thanksname'] 	= 'RBoard Team';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 	= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
						//end send refrence code 
					}

				}

			}
		}
    }
}