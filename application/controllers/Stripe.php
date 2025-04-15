<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends MY_Controller {

	public function  __construct()
	{
	    parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
		$this->load->helper('string');
		$this->load->model('professional/Applicant_model','applicant');
		$this->load->model('professional/Profexam_model','profexam');
		$this->load->model('university/university_model');	
		$this->load->model('ce-provider/Provider_model','provider');
		$this->load->model('graduates/graduates_model');
		$this->load->model('license/Landing_model','landing');

		/* rboard check */ 
		$subscription = $this->common_model->get_admin_subscription_details();
		if($subscription->rb_sub_key == ""){
			/* go to contcat for admin with form details */
			$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
			redirect(base_url('contactus'), 'refresh');		
		}

		if($subscription->no_of_application == 0 && $subscription->subscription_id == 6){
			$this->subs_status = 'y';
		}else{
			if($subscription->total_application <= $this->common_model->get_online_application_count()){	
				$this->subs_status = 'n';
			}else{
				$this->subs_status = 'y';
			}
		}
		/* end rboard check */ 
	}

	public function index()
	{
		// if($_REQUEST['user_id']==""){
		// 	redirect(base_url('login'), 'refresh');
		// }
		$data = $_REQUEST;
		$this->load->view('include/header',$data);
		$this->load->view('stripe/product_form',$data);
		$this->load->view('include/footer');		
	}

	public function check()
	{ 
		//print_r($_POST);exit;
		if($_POST['stripeToken']==""){
			redirect(base_url('login'), 'refresh');
		}
		//print_r($this->session->all_userdata());exit;
		/* check whether stripe token is not empty */
		if(!empty($_POST['stripeToken']))
		{
			/* get token, card and user info from the form */
			$token  	= $_POST['stripeToken'];
			$type  		= $_POST['type'];
			$user_id  	= $_POST['user_id'];
			$buyername 	= $_POST['name'];
			$buyeremail = $_POST['email'];
			$card_num 	= $_POST['card_num'];
			$card_cvc 	= $_POST['cvc'];
			$card_exp_month = $_POST['exp_month'];
			$card_exp_year 	= $_POST['exp_year'];
			
			/* include Stripe PHP library */
			require_once APPPATH."third_party/stripe/init.php";

			/* set api key */
			$stripe = array(
			  "secret_key"      => STRIPE_SECRET_KEY,
			  "publishable_key" => STRIPE_PUBLISHABLE_KEY
			);
			
			\Stripe\Stripe::setApiKey($stripe['secret_key']);
			
			/* add customer to stripe */
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			/* item information */
			$itemName = $_POST['item_name'];
			$itemNumber = $_POST['item_number']*100;
			$itemPrice = (int)$_POST['amount']*100;
			$currency = $_POST['currency_code'];
			// $orderID = "SKA92712382139";
			
			/* charge a credit or a debit card */
			$charge = \Stripe\Charge::create(array(
				'customer' 		=> $customer->id,
				'amount'   		=> $itemPrice,
				'currency' 		=> $currency,
				'description' 	=> $itemNumber,
				'metadata' 		=> array(
				'item_id' 		=> $itemNumber
				)
			));
			
			/* retrieve charge details */
			$chargeJson = $charge->jsonSerialize();
			
			/*payment transction insert query start*/
			$last_id = $this->insert_initial_payment($_POST);
			
			/* check whether the charge is successful */
			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
			{
				/* order details */ 
				$amount = $chargeJson['amount']/100;
				$balance_transaction = $chargeJson['balance_transaction'];
				$currency = $chargeJson['currency'];
				$status = $chargeJson['status'];
				$date = date("Y-m-d H:i:s");

				/* insert tansaction data into the database */
				$dataDB = array(
					'buyer_name' 		=> $buyername,
					'buyer_email' 		=> $buyeremail, 
					'card_number' 		=> $card_num, 
					'product_type' 		=> $type, 
					'user_id' 			=> $user_id, 
					'card_exp_month' 	=> $card_exp_month, 
					'card_exp_year' 	=> $card_exp_year, 
					'product_name' 		=> $itemName, 
					'product_id' 		=> $itemNumber,
					'currency' 			=> $currency, 
					'paid_amount' 		=> $amount, 
					'currency' 			=> $currency, 
					'txn_id' 			=> $balance_transaction, 
					'payment_status' 	=> $status,
					'added_on' 			=> $date
				);
			    $insert_id = $this->common_model->insert_stripe_log($dataDB);

			    if ($insert_id > 0) {
					$data['txn_id'] 		= $balance_transaction;
					$data['currency_code'] 	= $currency;
					$data['payer_email'] 	= $buyeremail;
					$data['payment_status'] = $status;		
					$this->common_model->update_payment($data,$last_id);
				
					if( $insert_id > 0 && $status == 'succeeded'){
						redirect('stripe/payment_success?last_id='.$last_id.'&&type='.$type);
					}else{	
						$this->session->set_flashdata('response',"Transaction has been failed");
						redirect('stripe/payment_error');
					}
				}else{
					$this->session->set_flashdata('response',"Not inserted. Transaction has been failed");
					redirect('stripe/payment_error');
				}
			}
			else
			{
				$this->session->set_flashdata('response',"Invalid Token");
				redirect('stripe/payment_error');
			}
		}else{ echo'no token'; }
	}

	public function insert_initial_payment($post)
	{	
		$paymentdata = array();
		switch ($post['type']) {
			case "Foreign Professional Review for Licensure Examination":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('profdoc');
				$paymentdata['payment_for'] 	= 'PP';
				$paymentdata['payment_type'] 	= 'N';
				
				break;
			case "Booking For Online Licensure Examination (Foreign Professionals)":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('book_exam_id');
				$paymentdata['payment_for'] 	= 'PP';
				$paymentdata['payment_type'] 	= 'E';
				
				break;
			case "Booking for Online Licensure Examination (LOCAL GRADUATES)":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('book_exam_id');
				$paymentdata['payment_for'] 	= 'G';
				$paymentdata['payment_type'] 	= 'E';
				
				break;

			case "Foreign Professional Review for online Professional Registration":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('profdoc');
				$paymentdata['payment_for'] 	= 'P';
				$paymentdata['payment_type'] 	= 'N';
				
				break;
			case "Request for verification of registration":
				//echo $this->session->userdata('rinfo_id');exit;
				$paymentdata['doc_refrence_id'] = $this->session->userdata('rinfo_id');
				$paymentdata['payment_for'] 	= 'VR';
				$paymentdata['payment_type'] 	= 'N';
				
				break;
			case "Request for certificate of good standing":
				//echo $this->session->userdata('rinfo_id');exit;
				$paymentdata['doc_refrence_id'] = $this->session->userdata('rinfo_id');
				$paymentdata['payment_for'] 	= 'GS';
				$paymentdata['payment_type'] 	= 'N';
				
				break;
			case "professional registration":
				// Get product data from the database
				if($this->session->userdata('prof_type')=='p'){
					$user = $this->applicant->getRows($post['user_id']);
					$prouserid = $user->user_ID;
					$payment_for = 'PR';
				}else{
					$user = $this->applicant->getgraduateRows($post['user_id']);
					$payment_for = 'PRG';
				}
				$userID = $user->user_ID; 
				$certdeta = $this->common_model->get_certificatechargedetails($post['payment_for']);
				
				$expiry_at = date('Y-m-d', strtotime(date("Y-m-d").' + '.$certdeta->duration.' year'));
				
				$userid     = $prouserid;
				$bytes 		= random_bytes(2); 
				$refcode 	= bin2hex($bytes);
				$proRefCode = 'PRO-'.$prouserid.'lic'.$refcode.'-'.date('Y');
				
				$doentry = array();
				$doentry['expiry_at'] 		= $expiry_at;
				$doentry['renew_for'] 		= $certdeta->duration;
				$doentry['document_for'] 	= 'n';
				$doentry['lic_issue_date'] 	= date('Y-m-d H:i:s');
				
				$isexists = $this->applicant->fetch_userdoc_details($userID);
				if($isexists != '' && count($isexists) > 0){
					$pdgetid = $isexists->pd_id;
					$this->applicant->updateprofdoc($doentry,$pdgetid);
				}else{
					$doentry['user_id'] 		= $userID;
					$doentry['added_on'] 		= date('Y-m-d H:i:s');
					$doentry['refrence_code'] 	= $proRefCode;
					$pdgetid = $this->applicant->professional_registration_documents($doentry);
				}
				$paymentdata['doc_refrence_id'] = $pdgetid;
				$paymentdata['payment_for'] 	= $payment_for;
				$paymentdata['payment_type'] 	= 'N';
				
				break;
			case "professional license card renewal":
				if($this->session->userdata('professioanl_renew')['candidate_type']=='p'){ 
					$payment_for = 'PR'; 
				}else{ 
					$payment_for = 'PRG'; 
				}
				$userID 		= $post['user_id'];
				$certdeta = $this->common_model->get_certificatechargedetails($post['payment_for']);
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$doentry = array();
				$doentry['user_id'] 	= $userID;
				$doentry['expiry_at'] 	= $expiry_at;
				$doentry['renew_for'] 	= $certdeta->duration;
				$doentry['document_for']= 'r';
				$doentry['added_on'] 	= date('Y-m-d H:i:s');
				$pdgetid = $this->applicant->insert('tbl_professional_documents',$doentry);

				$paymentdata['doc_refrence_id'] = $pdgetid;
				$paymentdata['payment_for'] 	= $payment_for;
				$paymentdata['payment_type'] 	= 'R';

				break;
			case "School Accreditaion":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('updateunidoc');
				$paymentdata['payment_for'] 	= 'U';
				$paymentdata['payment_type'] 	= 'N';

				break;
			case "School Accreditaion Renewal":
				$certdeta = $this->common_model->get_certificatechargedetails($post['payment_for']);
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				$this->university_model->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updateunidoc'));

				$paymentdata['doc_refrence_id'] = $this->session->userdata('updateunidoc');
				$paymentdata['payment_for'] 	= 'U';
				$paymentdata['payment_type'] 	= 'R';

				break;

			case "submission of graduates for licensure examination":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('temporderid');
				$paymentdata['payment_for'] 	= 'G';
				$paymentdata['payment_type'] 	= 'S';

				break;

			case "CEP Accreditation":
				$certdeta = $this->common_model->get_certificatechargedetails($post['payment_for']);

				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				$this->provider->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updatecepdoc'));

				$paymentdata['doc_refrence_id'] = $this->session->userdata('updatecepdoc');
				$paymentdata['payment_for'] 	= 'CEP';
				$paymentdata['payment_type'] 	= 'N';

				unset($_SESSION['updatecepdoc']);

				break;
			case "CEP Accreditation Renewal":
				$certdeta = $this->common_model->get_certificatechargedetails($post['payment_for']);
				
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				//print_r($updatedocdate); exit;
				$this->provider->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updatecepdoc'));

				$paymentdata['doc_refrence_id'] = $this->session->userdata('updatecepdoc');
				$paymentdata['payment_for'] 	= 'CEP';
				$paymentdata['payment_type'] 	= 'R';
				
				unset($_SESSION['updatecepdoc']);
				
				break;
			
			case "Online Course Accreditation":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('cor_doc_id');
				$paymentdata['payment_for'] 	= 'C';
				$paymentdata['payment_type'] 	= 'N';
				unset($_SESSION['cor_doc_id']);
				break;
			
			case "Training Course Accreditation":
				$paymentdata['doc_refrence_id'] = $this->session->userdata('train_doc_id');
				$paymentdata['payment_for'] 	= 'T';
				$paymentdata['payment_type'] 	= 'N';
				unset($_SESSION['train_doc_id']);
				break;

				/* default:
				echo "Your favorite color is neither red, blue, nor green!"; */
		}

		$paymentdata['user_id'] 		= $post['user_id'];
		$paymentdata['txn_id'] 			= '';
		$paymentdata['payment_amout'] 	= $post['amount'];
		$paymentdata['payment_tax'] 	= $post['tax'];
		$paymentdata['payment_gross'] 	= $post['amount'];			
		$paymentdata['payer_email'] 	= '';
		$paymentdata['payment_status'] 	= '';
		$paymentdata['currency_code'] 	= 'USD';
		$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
		$lastpaymentid = $this->common_model->insert_payment($paymentdata);	
		
		return $lastpaymentid;
	}

	public function payment_success()
	{
		//print_r($_REQUEST);exit;
		error_reporting(0);	
		$last_id = $_REQUEST['last_id'];
		$type = $_REQUEST['type'];
		if($_REQUEST['last_id'] != ''){
			$data['details']=$this->common_model->get_one_receipt_details($last_id);
			$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

			$getuserid = $this->common_model->getuserids($last_id);	
			$userid     = $getuserid->user_id;
			//echo $userid;exit;
			$bytes 		= random_bytes(3); 
			$refcode 	= bin2hex($bytes);
			
			if($type=="Foreign Professional Review for Licensure Examination"){
				$res_id = '8';
				$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');

				$refcodearr = array();
				$refcodearr['refrence_code'] = $proRefCode;
				$refcodearr['account_type'] = 'P';
				$refcodearr['status'] = 1;
				$updaterefencecode = $this->profexam->updatereferencecode($refcodearr,$userid);

				$docdata = array();
				$docdata['refrence_code'] = $proRefCode;
				$docdata['updated_at'] = date('Y-m-d H:i:s');
				$this->profexam->updateprofdoc($docdata,$getuserid->doc_refrence_id);

				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for FOREIGN PROFESSIONAL was successfully submitted.<br><br>Provide us some time to review your documents. You can check status by '.$serachlink.' with this <br>Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';

				$userdetails = $this->profexam->fetch_user_details($getuserid->user_id);
				$datadetails = array(
					'name' => $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name,
					'email' => $userdetails->email,
				);
				$subject = 'Application submitted successfully';
				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);

				$professional = array(						
					'prof_id'  		=> $userdetails->user_ID,
					'prof_name'  	=> $userdetails->name,
					'prof_email'  	=> $userdetails->email,
					'prof_stepone' 	=> TRUE
				);
				$this->session->set_userdata($professional);
			}
			if($type=="Foreign Professional Review for online Professional Registration"){
				$res_id = '7';

				$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');
				$refcodearr = array();
				$refcodearr['refrence_code'] = $proRefCode;
				$refcodearr['account_type'] = 'P';
				$refcodearr['status'] = 1;
				$updaterefencecode = $this->profexam->updatereferencecode($refcodearr,$userid);

				$docdata = array();
				$docdata['refrence_code'] = $proRefCode;
				$docdata['updated_at'] = date('Y-m-d H:i:s');
				$this->profexam->updateprofdoc($docdata,$getuserid->doc_refrence_id);

				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for FOREIGN PROFESSIONAL was successfully submitted.<br><br>Provide us some time to review your documents. You can check status by '.$serachlink.' with this <br>Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
				
				$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
				$datadetails = array(
					'name' => $userdetails->fullname,
					'email' => $userdetails->email,
				);
				$subject = 'Application submitted successfully';
				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);

				$professional = array(						
					'prof_id'  		=> $userdetails->user_ID,
					'prof_name'  	=> $userdetails->name,
					'prof_email'  	=> $userdetails->email,
					'prof_stepone' 	=> TRUE
				);
				$this->session->set_userdata($professional);
			}
			if($type=="Request for verification of registration"){
				$res_id = '23';
				$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
				$proRefCode = 'VR-'.$userid.$refcode.'-'.date('Y');
				$docdata = array();
				$docdata['refrence_code'] = $proRefCode;
				$docdata['updated_at'] = date('Y-m-d H:i:s');
				$updaterefencecode = $this->applicant->update_receipient_information($docdata,$getuserid->doc_refrence_id);
				
				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Request for Verification of Registration has been Done.<br><br>Please '.$serachlink.' to check the status of your application <br>and use this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';
				
				$datadetails = array(
					'name' => $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name,
					'email' => $userdetails->email,
				);
				$subject = 'Application Submitted Successfully';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);

				/*$profdetailss = array(						
					'profexam_id'  		=> $userdetails->user_ID,
					'profexam_name'  	=> $userdetails->name,
					'profexam_email'  	=> $userdetails->email,
					'profexam_stepone' 	=> TRUE
				);
				$this->session->set_userdata($profdetailss); */
			}
			if($type=="Request for certificate of good standing"){
				$res_id = '24';
				$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
				$proRefCode = 'GS-'.$userid.$refcode.'-'.date('Y');
				$docdata = array();
				$docdata['refrence_code'] = $proRefCode;
				$docdata['updated_at'] = date('Y-m-d H:i:s');
				$updaterefencecode = $this->applicant->update_good_standing($docdata,$getuserid->doc_refrence_id);
				
				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Request for Certificate of Good Standing has been Done.<br><br>Please '.$serachlink.' to check the status of your application <br>and use this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';

				$datadetails = array(
					'name' => $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name,
					'email' => $userdetails->email,
				);
				$subject = 'Application Submitted Successfully';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);

				/*$profdetailss = array(						
					'profexam_id'  		=> $userdetails->user_ID,
					'profexam_name'  	=> $userdetails->name,
					'profexam_email'  	=> $userdetails->email,
					'profexam_stepone' 	=> TRUE
				);
				$this->session->set_userdata($profdetailss); */
			}
			if($type=="professional registration" ){
				$res_id = '1';
				$userid = $getuserid->user_id;
				$payment_for = $getuserid->payment_for;
				if($payment_for=='PR'){
					$userdetails = $this->applicant->fetch_user_details($getuserid->user_id,$getuserid->doc_refrence_id);
				}else{
					$userdetails = $this->applicant->fetch_graduate_details($getuserid->user_id);
				}
				$prolicno = 'LIC'.$userid.date("Ym",time());
				$prof_code = 'LIC'.random_string('alnum',20);
				$docDetails = $this->applicant->getprofdoc_by_doc_id($getuserid->doc_refrence_id);
				//generate qr code for certificate of regitration
				$qr_image = 'qrcode_'.$prolicno.'.png';
				$qr_url = base_url('assets/uploads/pdf/'.$docDetails->refrence_code.'cert.pdf');
				$params['data'] = $qr_url;
				$params['level'] = 'H';
				$params['size'] = 5;
				$params['savename'] = './assets/qrcode/'.$qr_image;
				$this->ciqrcode->generate($params);

				//generate qr code for identification card
				$qr_image2 = 'qrcode_'.$prolicno.'card.png';
				$qr_url = base_url('assets/uploads/pdf/'.$docDetails->refrence_code.'card.pdf');
				$params['data'] = $qr_url;
				$params['level'] = 'H';
				$params['size'] = 5;
				$params['savename'] = './assets/qrcode/'.$qr_image2;
				$this->ciqrcode->generate($params);
				$updateprof = array();
				$updateprof['lic_qrcode'] = $qr_image; //update qr_image name for cert into professional document table
				$updateprof['card_qrcode'] = $qr_image2; //update qr_image name for card into professional document table
				if($docDetails->reviewer_id == 0 && $docDetails->reviewer_status != '1' ){
					$updateprof['reviewer_id'] 		= 0;
					$updateprof['reviewer_status']  	= '1';
					$updateprof['review_date']  		= date('Y-m-d');
					$updateprof['review_accept_date'] 	= date('Y-m-d');
				}
				$updateprof['license_no'] 			= $prolicno;
				$updateprof['updated_at']  			= date('Y-m-d');
				$updateprof['status']  				= 1;
				$updaterefencecode = $this->applicant->updateprofdoc($updateprof,$getuserid->doc_refrence_id);

				$newpassword = substr($userid.time(),0,8);
				$add = array(
					'user_id' 			=> $userid,
					'fname'	  			=> $userdetails->fname,
					'lname'	  			=> $userdetails->lname,
					'name'	  			=> $userdetails->name,
					'email'	  			=> $userdetails->email,
					'profession'	  	=> $userdetails->profession,
					'biirthday'	  		=> $userdetails->dob,
					'registration_no'	=> $userdetails->registration_no,
					'candidate_type'	=> isset($userdetails->role)?'p':'g',
					'username'			=> $userdetails->email,
					'password'			=> password_hash($newpassword,PASSWORD_DEFAULT),
					'payment_status'	=> '1',
					'added_on'			=> date('Y-m-d'),
					'license_no'		=> $prolicno,
					'prof_code'			=> $prof_code,
					'lic_issue_date'	=> $docDetails->lic_issue_date,
					'lic_expiry_date'	=> $docDetails->expiry_at
				);
				$codedid = base64_encode($userid);
				$res = $this->applicant->save('tbl_professional_license',$add);

				if($updaterefencecode){
					//1st pdf for card
					$html= $this->getprofreg_card_pdf($userid,$getuserid->doc_refrence_id,$payment_for,$prolicno);
					// Get output html
					$this->output->get_output();
					// print_r($html);die;
					$this->load->library('Pdf');
					$this->dompdf = new DOMPDF();
					$this->dompdf->load_html($html);
					$this->dompdf->set_paper('letter','portrait');
					$this->dompdf->render();
					file_put_contents('assets/uploads/pdf/'.$docDetails->refrence_code.'card.pdf', $this->dompdf->output($html));
					// $this->dompdf->stream('cert.pdf', array('Attachment' => 0));
					// exit;
		
					//2nd pdf for cert
					$html1 = $this->getprofreg_cert_pdf($userid,$getuserid->doc_refrence_id,$payment_for,$prolicno);
					// Get output html
					$this->output->get_output();
					// print_r($html1); die;
					$this->load->library('Pdf');
					$this->dompdf = new DOMPDF();
					$this->dompdf->load_html($html1);
					$this->dompdf->set_paper('A4','portrait');
					$this->dompdf->render();
					file_put_contents('assets/uploads/pdf/'.$docDetails->refrence_code.'cert.pdf', $this->dompdf->output($html1));
					// $this->dompdf->stream('cert.pdf', array('Attachment' => 0));
					//exit;
				}

				$downloadlink = '<a href="'.base_url('professional/applicant/license_cert_card/').$codedid.'" style="color:blue;" target="_blank">Click Here</a>';
				$rboard_details = 'Now you can connect with Regulatory Board with this code 
				<br><b>Regulatory Board Name: '.$this->rbname.'</b>. 
				<br><b>Regulatory Board Code: '.$this->rbcode.'</b>
				<br><b>Professional Code: '.$prof_code.'</b> You can send your certificate to Regulatory Board for verification.';
				
				$validity = isset($docDetails->expiry_at)?date('M d,Y',strtotime($docDetails->expiry_at)):'';
				$issueddate = isset($docDetails->lic_issue_date)?date('M d,Y',strtotime($docDetails->lic_issue_date)):'';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Congratulations!<br><br>Your are now a registered professional with the following details:
					<br>Profession : '.$userdetails->profession_name.'
					<br>License Number : '.$prolicno.'
					<br>Validity : '.$validity.'
					<br>Date issued : '.$issueddate.'
					<br>Please '.$downloadlink.' to view, download and print Your Digital License and Certificate of Registration.
					<br>'.$rboard_details.'
					<br>
					<br>Here is your temporary username : '.$add['username'].' and password : '.$newpassword.' to log in and access your account.
					Please <a href="'.base_url('login').'" style="color:blue;" target="_blank">click this link </a> to log in.
					<br> Should you have questions just message us and we would be happy to assist you.</p>';
				
				$datadetails = array(
					'name' => $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name,
					'email' => $userdetails->email,
				);
				$subject = 'Professional Registration Success';
				$attachcard = $docDetails->refrence_code.'card.pdf';
				$attachcert = $docDetails->refrence_code.'cert.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode, $attachcard, $attachcert);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
				
				$profdetailsarr = $userdetails;
				$professional = array(						
					'prof_id'  		=> $profdetailsarr->user_ID,
					'prof_name'  	=> $profdetailsarr->name,
					'prof_email'  	=> $profdetailsarr->email,
					'registration_no'=> $profdetailsarr->registration_no,
					'prof_stepone' 	=> TRUE,
					'role'			=> 'professioanl'
				);
				$this->session->set_userdata($professional);
			}
			if($type == "professional license card renewal"){
				if(isset($_SESSION['all_certicates_verified']) && isset($_SESSION['all_certicates_id']) && $_SESSION['all_certicates_verified']== true && $_SESSION['all_certicates_id'] != ''){
					//$returnURL = base_url().'license/landing/paymentsuccesswithcard'; //payment success with direct license card 
					$res_id = '2';
					$professdatails = $this->landing->get_professional_details($getuserid->user_id);
					$docdatails = $this->landing->get_row_object('tbl_professional_documents','pd_id',$getuserid->doc_refrence_id);
					
					$updateprof = array();	
					// $updateprof['reviewer_id'] 		 = $this->session->userdata('login')['user_ID'];
					// $updateprof['review_date']  		 = date('Y-m-d H:i:s');
					// $updateprof['review_accept_date'] = date('Y-m-d H:i:s');
					$userid 	= $getuserid->user_id;
					$bytes 		= random_bytes(3); 
					$refcode 	= bin2hex($bytes);
					$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');

					//generate card_qrcode
					$qr_image = 'qrcode_'.$proRefCode.'.png';
					$qr_url = base_url('assets/uploads/pdf/'.$proRefCode.'card.pdf');
					$params['data'] = $qr_url;
					$params['level'] = 'H';
					$params['size'] = 5;
					$params['savename'] = './assets/qrcode/'.$qr_image;
					$this->ciqrcode->generate($params);
					
					$docdata = array();

					$updateprof['refrence_code'] = $proRefCode;
					$updateprof['lic_issue_date'] 	= date('Y-m-d H:i:s');
					$updateprof['license_no'] 		= $professdatails->license_no;
					$updateprof['reviewer_status']  = '1';
					$updateprof['updated_at']  		= date('Y-m-d H:i:s');
					$updateprof['status']  			= 1;
					$updaterefencecode = $this->applicant->updateprofdoc($updateprof,$getuserid->doc_refrence_id);
					
					// $updateproflicno['license_no'] 		= $professdatails->license_no;
					$updateproflicno['lic_issue_date'] 	= date('Y-m-d H:i:s');
					$updateproflicno['lic_expiry_date'] = $docdatails->expiry_at;
					$updateproflicno['card_qrcode']     = $qr_image;
					$updateproflicno['updated_at'] 		= date('Y-m-d H:i:s');
					$updatedpro = $this->applicant->updateproflicno($updateproflicno,$userid);

					if($updaterefencecode){
						//1st pdf for card
						$html=$this->getprofreg_renew_card_pdf($userid,$professdatails->candidate_type);
						// Get output html
						$this->load->library('Pdf');
						$this->dompdf = new DOMPDF();
						$this->dompdf->load_html($html);
						
						$this->dompdf->set_paper('A4','portrait');
						$this->dompdf->render();
						file_put_contents('assets/uploads/pdf/'.$proRefCode.'card.pdf', $this->dompdf->output($html));
						// $this->dompdf->stream('card.pdf', array('Attachment' => 0));die;
					
											
						$etcdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">
						You have successfully renew your professonal license. Please search the refrence number into the given link to find the license.    
						<br><a href="'.base_url('license/search').'">click here to search.</a></p>
						<br><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">
						<ul>
							<li>
								Refrence Number: '.$proRefCode.'
							</li>
							<li>
								License Number: '.$professdatails->license_no.'
							</li>
						</ul> </p>';
			
						$bodycontentforCode = $etcdetails.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have any question please message us and we will be happy to assist you. </p>';
						$datadetails = array(
							'name' => $professdatails->fname.' '.$professdatails->lname.' '.$professdatails->name,
							'email' => $professdatails->email,
						);
						$subject = 'Renewed Professional License';
						$attachcard = $proRefCode.'card.pdf';
						//$attachcert = $docDetails->refrence_code.'cert.pdf';
						$this->sendEmail($datadetails,$subject,$bodycontentforCode, $attachment);
						$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
					}

				}else{
					//$returnURL = base_url().'license/landing/paymentsuccess'; //payment success url
					$res_id = '2';
					$userid 	= $getuserid->user_id;
					$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');
					$docdata = array();
					$docdata['refrence_code'] = $proRefCode;
					$docdata['updated_at'] = date('Y-m-d H:i:s');
					$updaterefencecode = $this->applicant->updateprofdoc($docdata,$getuserid->doc_refrence_id);
					
					$payment_for = $getuserid->payment_for;
					if($payment_for=='PR'){
						$userdetails = $this->applicant->fetch_user_details($getuserid->user_id,$getuserid->doc_refrence_id);
					}else{
						$userdetails = $this->applicant->fetch_graduate_details($getuserid->user_id);
					}
					$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
					$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Renewal of Professional Registration has been Done.<br><br>Please '.$serachlink.' to check the status of your application <br>and use this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';
					
					$datadetails = array(
						'name' => $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name,
						'email' => $userdetails->email,
					);
					$subject = 'Renewal of Professional Registrtion';
					//$attachcard = $docDetails->refrence_code.'card.pdf';
					//$attachcert = $docDetails->refrence_code.'cert.pdf';
					$this->sendEmail($datadetails,$subject,$bodycontentforCode);
					$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
				}

			}

			if($type=="School Accreditaion"){
				$res_id = '3';

				$universityRefCode = 'UNI-'.$userid.$refcode.'-'.date('Y');
				$refcodearr = array();
				$refcodearr['refrence_code'] = $universityRefCode;
				
				$updatedocdate = array();
				$updatedocdate['refrence_code'] = $universityRefCode;
				$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
				$this->university_model->updatedocumentrenewdate($updatedocdate, $getuserid->doc_refrence_id);
				$updaterefencecode = $this->university_model->updateuniversity($refcodearr,$this->session->userdata('uniid_stepone'));
				$unvdetls = $this->university_model->universitydetails($getuserid->user_id);
				
				$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$unvdetls->email.'<br>Password: '.$unvdetls->university_password.'</p>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$universityRefCode.'</p>';
			
				$datadetails = array(
					'name' => $unvdetls->name_of_representative,
					'email' => $unvdetls->email,
				);
				$subject = 'School accreditation account created';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'School Accreditation Fee',$bodycontentforCodeemail);

				/*$profdetailss = array(						
					'profexam_id'  		=> $userdetails->user_ID,
					'profexam_name'  	=> $userdetails->name,
					'profexam_email'  	=> $userdetails->email,
					'profexam_stepone' 	=> TRUE
				);
				$this->session->set_userdata($profdetailss); */
			}
			if($type == "School Accreditaion Renewal"){
				$res_id = '4';
				$unvdetls = $this->university_model->universitydetails($getuserid->user_id);
				if($unvdetls->uniid > 0){
					$universitydata = array(
							'uniid'  			=> $unvdetls->uniid,
							'university_name'  	=> $unvdetls->university_name,
							'college_of' 		=> $unvdetls->college_of,
							'email'				=> $unvdetls->email,
							'contact_no'		=> $unvdetls->contact_no,
							'university_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($universitydata);
				}
				$universityrenewdoc = array('updateunidoc'=> $getuserid->doc_refrence_id);
				$this->session->set_userdata($universityrenewdoc);

				$universityRefCode = 'UNI-'.$unvdetls->uniid.$refcode.'-'.date('Y');
				$refcodearr = array();
				$refcodearr['refrence_code'] = $universityRefCode;
				
				$updatedocdate = array();
				$updatedocdate['refrence_code'] = $universityRefCode;
				$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
				$updaterefencecode = $this->university_model->updatedocumentrenewdate($updatedocdate, $getuserid->doc_refrence_id);

				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
				
				$bodycontent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your payment has been received successfully.<br><strong>Refrence Code: </strong>'.$universityRefCode.'<br><strong>Order No.: </strong>'.$getuserid->payment_id.'</p><br>';

				$datadetails = array(
					'name' => $unvdetls->name_of_representative,
					'email' => $unvdetls->email,
				);
				$subject = 'Renewal of school accreditaion';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Renewal of School Accreditation Fee',$bodycontentforCodeemail);
			}
			if($type=="submission of graduates for licensure examination"){
				//$res_id = '5';
				$unvdetls = $this->university_model->universitydetails($getuserid->user_id);
				if($unvdetls->uniid > 0){
					$universitydata = array(
							'uniid'  			=> $unvdetls->uniid,
							'university_name'  	=> $unvdetls->university_name,
							'college_of' 		=> $unvdetls->college_of,
							'email'				=> $unvdetls->email,
							'contact_no'		=> $unvdetls->contact_no,
							'university_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($universitydata);
				}
				// get graduates details
				$graducatelisting = $this->university_model->get_graduates_temporderid($this->session->userdata('temporderid'));
				
				$graducatelistingmail = '<table style="border-style:solid; border-width:1px; border-color:#000000;">
				<tr>
				<td style="border: 1px solid #000000;">Name</td>
				<td style="border: 1px solid #000000;">Email</td>
				<td style="border: 1px solid #000000;">Gender</td>
				<td style="border: 1px solid #000000;">Date of Graduation</td>
				<!--<td style="border: 1px solid #000000;">Refrence Code</td>-->
				</tr>';
				$bytes 		= random_bytes(4); 
				$refcode 	= bin2hex($bytes);
				$graducateRefCode = 'GRA-'.$refcode.'-'.date('Y');
				$graducate_id = '';

				foreach($graducatelisting as $grdlist){
					// update application count
					$logs = array(
						// 'application_id'	=>	$getuserid->doc_refrence_id,
						'application_id'	=>	$grdlist->grad_id,
						'res_id'			=>	'5',
						'subscription'		=>	$this->subs_status,
						'added_at'			=>	date('Y-m-d H:i:s')
					);
					$this->common_model->insert_onlineapplication_log($logs);
					
					$graducate_id = $grdlist->grad_id;
					$updatedocdate = array();
					$updatedocdate['refrence_code'] = $graducateRefCode;
					$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
					$this->university_model->updategraducates($updatedocdate, $grdlist->grad_id);
					
					$graducatelistingmail .= '<tr>
					<td style="border: 1px solid #000000;">'.$grdlist->student_name.' '.$grdlist->middle_name.' '.$grdlist->surname.'</td>
					<td style="border: 1px solid #000000;">'.$grdlist->email.'</td>
					<td style="border: 1px solid #000000;">'.$grdlist->gender.'</td>
					<td style="border: 1px solid #000000;">'.$grdlist->date_of_graduated.'</td>
					<!--<td style="border: 1px solid #000000;">'.$graducateRefCode.'</td>-->
					</tr>';
				}
				$graducatelistingmail .= '</table>';

				//echo '<p>Payment success</p>';
				//$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.</p><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your payment has been received successfully.<br><strong>Order No.: </strong>'.$getuserid->payment_id.'</p><br>'.$graducatelistingmail;
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for review of graduates for licensure examination has been approved.</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><b>Refrence Code:</b> '.$graducateRefCode.'</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please check the following graduates and their examination codes:</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;font-weight:bold;">'.$graducatelistingmail.'</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have questions just message us and we would be happy to assist you.</p>';
				
				$datadetails = array(
					'name' => $unvdetls->business_name,
					'email' => $unvdetls->email,
				);
				$subject = 'Submission of Graduate for Licensure';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				//$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
				$updaterefencecode = 1;
			}
			if($type=="CEP Accreditation"){
				$res_id = '9';

				$reference_no = 'CEP-'.$userid.$refcode.'-'.date('Y');
				$arr_provider = array( 'reference_no' => $reference_no, 'updated_at' => date('Y-m-d H:i:s') );
				$settingarr = $this->common_model->get_setting('1');
				$this->provider->update('tbl_ce_provider',$arr_provider,'provider_id',$userid);
				$updaterefencecode = $this->provider->update('tbl_cep_documents',$arr_provider,'provider_id',$userid);
				
				$unvdetls = $this->provider->cep_doc_details_for_payment($getuserid->doc_refrence_id);
				//print_r($unvdetls);exit;

				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for CEP Accreditation was successfully submitted.<br><br>Provide us some time to review your documents. You can check status by '.$serachlink.' with this <br>Refrence Code : <strong>'.$unvdetls->reference_no.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';

				$datadetails = array(
					'name' => $unvdetls->business_name,
					'email' => $unvdetls->email,
				);
				$subject = 'Application Submitted Successfully';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);

				$universitydata = array(						
					'provider_id'  		=> $unvdetls->provider_id,
					'business_name'  	=> $unvdetls->business_name,
					'cep_email'  		=> $unvdetls->email,
					'cep_logged_in'  		=> true,
					);

				$this->session->set_userdata('logincepacc',$universitydata);
			}
			if($type == "CEP Accreditation Renewal"){
				$res_id = '10';
				$info = $this->provider->get_providerdetails($getuserid->user_id);
				if($info->provider_id > 0){
					$ip_address = $_SERVER['REMOTE_ADDR'];

					$create_session = array(
						'user_ID' 		=> $info->provider_id,   
						'ip_address' 	=> $ip_address,
						'username' 		=> $info->email,
						'name' 			=> $info->business_name,
						'session'		=> true,
						'role'			=> 'cep'
					);
					$this->session->set_userdata('logincepacc',$create_session);
				}
				$reference_no = 'CEP-'.$getuserid->user_id.$refcode.'-'.date('Y');

				// $reference_no = 'CEP-'.time().'-'.date('Y');
				
				$updatedocdate = array();
				$updatedocdate['reference_no'] = $reference_no;
				$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
				$updaterefencecode = $this->provider->updatedocumentrenewdate($updatedocdate, $getuserid->doc_refrence_id);
				
				$unvdetls = $this->provider->get_user_details($info->provider_id);
				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for Renewal CEP was successfully submitted.<br><br>Provide us some time to review your documents. You can check status by '.$serachlink.' with this <br>Refrence Code : <strong>'.$reference_no.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
				
				$datadetails = array(
					'name' => $unvdetls->business_name,
					'email' => $unvdetls->email,
				);
				$subject = 'Renewal of CEP Accreditation';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
			}
			if($type=="Online Course Accreditation"){
				$res_id = '11';
				$courseRefCode = 'COU-'.$userid.$refcode.'-'.date('Y');
				//assing refrence code and status
				$applied = array('refrence_code'=>$courseRefCode,'licence_applied'=>'1','applied_date'=>date('Y-m-d H:i:s'),'submitted'=>'y');
				$updaterefencecode = $this->provider->update('tbl_course_documents',$applied,'cor_doc_id',$getuserid->doc_refrence_id);
				
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$courseRefCode.'</p>';

				$user = $this->provider->get_row_object('tbl_ce_provider','provider_id',$getuserid->user_id);
				$datadetails = array(
					'name' => $user->contact_person,
					'email' => $user->email,
				);
				$subject = 'Online Course apply for certificate';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
			}

			if($type=="Training Course Accreditation"){
				$res_id = '12';
				$courseRefCode = 'TRA-'.$userid.$refcode.'-'.date('Y');
				//assing refrence code and status
				$applied = array('refrence_code'=>$courseRefCode,'licence_applied'=>'1','applied_date'=>date('Y-m-d H:i:s'),'submitted'=>'y');
				$updaterefencecode = $this->provider->update('tbl_training_documents',$applied,'train_doc_id',$getuserid->doc_refrence_id);
				
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$courseRefCode.'</p>';

				$user = $this->provider->get_row_object('tbl_ce_provider','provider_id',$getuserid->user_id);
				$datadetails = array(
					'name' => $user->contact_person,
					'email' => $user->email,
				);
				$subject = 'Training Course apply for certificate';
				//$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
			}

			if($type=="Booking For Online Licensure Examination (Foreign Professionals)"){
				$res_id = '6';
				$userdetails = $this->profexam->fetch_user_details($userid);
				//print_r($userdetails);exit;
				//qrcode allready generate in reviewer when verification
				// Genrate PDF start
				$this->getexampasspdf($userid);
				// Get output html
				$html = $this->output->get_output();
				$this->load->library('Pdf');
				$this->dompdf->load_html($html);
				$this->dompdf->set_paper('letter','portrait');
				$this->dompdf->render();
				file_put_contents('assets/uploads/pdf/'.$userdetails->exam_code.'.pdf', $this->dompdf->output($html));
				
				$search_link = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br>
				<br>Your Exam has been booked successfully.<br><br>In this regard, 
				you can use your Refrence Code : '.$userdetails->refrence_code.' to learn the Guidline and get the EXAM PASS.<br>
				Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass. .<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
				
				$datadetails = array(
					'name' => $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name,
					'email' => $userdetails->email,
				);
				$subject = 'Exam booked successfully.';
				$attachment = $userdetails->exam_code.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode, $attachment);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
				$updaterefencecode = 1;

				$profdetailss = array(						
					'profexam_id'  		=> $userdetails->user_ID,
					'profexam_name'  	=> $userdetails->name,
					'profexam_email'  	=> $userdetails->email,
					'profexam_stepone' 	=> TRUE
				);
				$this->session->set_userdata($profdetailss);
			}
			if($type=="Booking for Online Licensure Examination (LOCAL GRADUATES)"){
				$res_id = '13';
				
				$graducatedetailsarr = $this->graduates_model->fetch_user_details($userid);
				$userdetails = $graducatedetailsarr;
				//print_r($graducatedetailsarr);exit;
				//generate qrcode
				$examcode = $graducatedetailsarr->examcode;
				$qr_image = 'qrcode_'.$examcode.'.png';
				$qr_url = base_url('assets/uploads/pdf/'.$examcode.'.pdf');
				$params['data'] = $qr_url;
				$params['level'] = 'H';
				$params['size'] = 5;
				$params['savename'] = './assets/qrcode/'.$qr_image;
				$this->ciqrcode->generate($params);
				$graqrcode['exam_pass_qrcode'] = $qr_image;
				$this->db->where('grad_id', $graducatedetailsarr->grad_id)->update('graduates', $graqrcode);
				
				// Genrate PDF start
				$html=$this->get_gra_exampasspdf($userid);
				// Get output html
				$html.= $this->output->get_output();
				// print_r($html);die;
				$this->load->library('Pdf');
				$this->dompdf = new DOMPDF();
				$this->dompdf->load_html($html);
				$this->dompdf->set_paper('letter','portrait');
				$this->dompdf->render();
				
				file_put_contents('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf', $this->dompdf->output($html));
				// $this->dompdf->stream("school.pdf",array('Attachment'=>0));
				// Genrate PDF End
				
				$search_link = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Exam has been booked successfully.<br><br>In this regard, you can use your Refrence Code : '.$userdetails->refrence_code.' to learn the Guidline and get the EXAM PASS.<br>Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';

				$datadetails = array(
					'name' => $graducatedetailsarr->student_name.' '.$graducatedetailsarr->middle_name.' '.$graducatedetailsarr->surname,
					'email' => $graducatedetailsarr->email,
				);
				//print_r($datadetails);exit;
				$subject = 'Exam booked successfully.';
				$attachment = $graducatedetailsarr->examcode.'.pdf';

				$this->sendEmail($datadetails,$subject,$bodycontentforCode, $attachment);
				$this->sendEmail($datadetails,'Payment Receipt',$bodycontentforCodeemail);
				//$updaterefencecode = 1;

				//setting session
				$graducate = array(						
					'grad_id'  			=> $graducatedetailsarr->grad_id,
					'graduate_name'  	=> $graducatedetailsarr->student_name,
					'graduate_email'  	=> $graducatedetailsarr->email,
					'graduate_stepone' 	=> TRUE
				);
				$this->session->set_userdata($graducate);
			}

			/* update application count start */
			if($type != "submission of graduates for licensure examination"){
				$logs = array('application_id'=>$getuserid->doc_refrence_id,'res_id'=>$res_id,'subscription'=>$this->subs_status,'added_at'=>date('Y-m-d H:i:s'));
				$this->common_model->insert_onlineapplication_log($logs);
			}
			
			if($updaterefencecode){
				// send refrence code email  
				//$this->sendEmail($getuserid->user_id,$subject,$bodycontentforCode);
				
				// send receipt code email  
				//$this->sendEmail($getuserid->user_id,'Payment Receipt',$bodycontentforCodeemail);
				
				// insert notification  
				$this->notification($getuserid->user_id,$subject,$bodycontentforCode,$type);
			}

			/*$prof = $this->profexam->fetch_user_details($getuserid->user_id);
				$professional = array(						
					'prof_id'  		=> $prof->user_ID,
					'prof_name'  	=> $prof->name,
					'prof_email'  	=> $prof->email,
					'prof_stepone' 	=> TRUE
				);
			$this->session->set_userdata($professional); */
			$this->session->set_flashdata('response','<div class="alert alert-success">Payment Successfully Done.</div>');

			if($type=="Foreign Professional Review for Licensure Examination"){
				$this->data = array('title'=> 'Review of Documents');
				$data['profes_details'] = $this->profexam->fetch_user_details($getuserid->user_id);
				$this->load->view('include/header',$this->data);
				$this->load->view('professional/profexam/review_doc',$data);
				$this->load->view('include/footer');
			}
			if($type=="Booking For Online Licensure Examination (Foreign Professionals)"){
				redirect('professional/profexam/guidelines/'.base64_encode($getuserid->user_id));				
			}
			if($type=="Booking for Online Licensure Examination (LOCAL GRADUATES)"){
				redirect('graduates/graduates/exam_guidlines');				
			}
			if($type=="Foreign Professional Review for online Professional Registration"){
				$this->data = array('title'=> 'Review of Documents');
				$data['profes_details'] = $this->applicant->fetch_user_details($getuserid->user_id);
				$this->load->view('include/header',$this->data);
				$this->load->view('professional/applicant/review_doc',$data);
				$this->load->view('include/footer');
			}
			if($type=="Request for verification of registration"){
				//print_r($getuserid);exit;
				redirect('professional/applicant/verificationrequeststatus/'.base64_encode($getuserid->user_id));				
			}
			if($type=="Request for certificate of good standing"){
				//print_r($getuserid);exit;
				redirect('professional/applicant/gsrequeststatus/'.base64_encode($getuserid->doc_refrence_id));				
			}
			if($type == "professional registration"){
				$this->data = array('title'=> 'Registration Certificate and Professional Identification Card');
				if($payment_for=='PR'){
					$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
				}else{
					$userdetails = $this->applicant->fetch_graduate_details($getuserid->user_id);
				}
				$data['profes_details'] = $userdetails;
				$data['license_no'] = $docDetails->refrence_code;
				
				$this->load->view('include/header',$this->data);
				$this->load->view('professional/registration/certificate',$data);
				$this->load->view('include/footer',$this->data);
			}
			if($type == "professional license card renewal"){
				if(isset($_SESSION['all_certicates_verified']) && isset($_SESSION['all_certicates_id']) && $_SESSION['all_certicates_verified']== true && $_SESSION['all_certicates_id'] != ''){
					//$returnURL = base_url().'license/landing/paymentsuccesswithcard'; //payment success with direct license card 
					unset($_SESSION['all_certicates_verified']);
					unset($_SESSION['all_certicates_id']);
					
					$this->data = array('title'=> 'Renewed Professional License');
					$data['profes_details'] = $proRefCode;
					// echo $this->db->last_query(); die();
					$this->load->view('include/header',$this->data);
					$this->load->view('license/renewed_license',$data);
					$this->load->view('include/footer',$this->data);
				}else{
					//$returnURL = base_url().'license/landing/paymentsuccess'; //payment success url
					unset($_SESSION['professioanl_renew']);
					
					$this->data = array('title'=> 'Review of Certificates');
					$data['profes_details'] = $this->landing->fetch_doc_details($getuserid->doc_refrence_id);
					// echo $this->db->last_query(); die();
					$this->load->view('include/header',$this->data);
					$this->load->view('license/review_doc',$data);
					$this->load->view('include/footer',$this->data);
				}
			}
			if($type=="School Accreditaion"){
				redirect(base_url('university/university/universitypaymentsucess'), 'refresh');
			}
			if($type=="School Accreditaion Renewal"){
				redirect(base_url('university/university/universityrenewpaymentsucess'), 'refresh');
			}
			if($type=="submission of graduates for licensure examination"){
				redirect(base_url('university/university/graducatelicencestatus/'.base64_encode($graducateRefCode)), 'refresh');
			}
			if($type=="CEP Accreditation"){
				redirect(base_url('ce-provider/ce_provider/verification_document/'.base64_encode($getuserid->doc_refrence_id)),'refresh');
			}
			if($type=="CEP Accreditation Renewal"){
				$this->data = array();
				$this->data['unvdetls'] = $this->provider->cep_doc_details($getuserid->doc_refrence_id,'r');
				$this->data['id'] = $getuserid->doc_refrence_id;
				$this->data['payment_document_active'] 	= 'stepActive';
				$this->data['busniess_document_active'] = 'stepActive';
				$this->data['accre_document_active'] 	= 'stepActive';
				$this->data['verification_stepProcess'] = 'stepProcess';

				$this->load->view('include/header',$this->data);
				$this->load->view('ce-provider/renew_steps',$this->data);
				$this->load->view('ce-provider/renew_verification_document',$this->data);
				$this->load->view('include/footer',$this->data);
			}
			if($type=="Online Course Accreditation"){
				redirect(base_url('ce-provider/ce_provider/reviewcourse/'.base64_encode($getuserid->doc_refrence_id)));
			}
			if($type=="Training Course Accreditation"){
				redirect(base_url('ce-provider/ce_provider/reviewtraining/'.base64_encode($getuserid->doc_refrence_id)));
			}

		}else{
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	public function payment_error()
	{
		$this->load->view('include/header');	
		$this->load->view('stripe/payment_error');
		$this->load->view('include/footer');	
	}

	public function help()
	{
		$this->load->view('include/header');		
		$this->load->view('stripe/help');
		$this->load->view('include/footer');
	}

	public function sendEmail($datadetails,$subject,$bodycontentforCode, $attachment=null, $attachment2=null){
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

		$settingarr = $this->common_model->get_setting('1');
		//$userdetails = $this->profexam->fetch_user_details($user_id);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
		$this->email->to($datadetails['email']);
		$this->email->subject($subject);
		$emailbody = array();
		$emailbody['name'] 			= $datadetails['name'];
		$emailbody['thanksname'] 	= $settingarr->signature_name;
		$emailbody['thanks2'] 		= '';
		$emailbody['thanks3'] 		= $settingarr->position;
		$emailbody['body_msg'] 		= $bodycontentforCode;
		$emailmessage = $this->load->view('emailer', $emailbody, TRUE);
		$this->email->message($emailmessage);

		if($attachment !=null && file_exists('assets/uploads/pdf/'.$attachment)){
			$this->email->attach(base_url('assets/uploads/pdf/'.$attachment));
		}
		if($attachment2 !=null && file_exists('assets/uploads/pdf/'.$attachment2)){
			$this->email->attach(base_url('assets/uploads/pdf/'.$attachment2));
		}
		return $this->email->send();
	}

	public function notification($user_id,$subject,$bodycontentforCode,$type){
		$updatenotification 				= array();
		$updatenotification['subject'] 		= $subject;
		$updatenotification['message'] 		= $bodycontentforCode;
		$updatenotification['from'] 		= SENDER_NAME;
		$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
		$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
		
		if($type=="Foreign Professional Review for Licensure Examination" || $type=="Foreign Professional Review for online Professional Registration" || $type=="Booking For Online Licensure Examination (Foreign Professionals)"){
			$updatenotification['user_id'] 		= $user_id;
			return $this->profexam->insertnotifications($updatenotification); 
		}
		if($type == "professional license card renewal" || $type == "professional registration"){
			$updatenotification['user_id'] 		= $user_id;
			return $this->applicant->insertnotifications($updatenotification);
		}
		if($type=="School Accreditaion" || $type == "School Accreditaion Renewal" || $type == "submission of graduates for licensure examination"){
			$updatenotification['uniid'] 		= $user_id;
			return $this->university_model->insertnotifications($updatenotification);
		}
		if($type=="CEP Accreditaion" || $type=="CEP Accreditation Renewal" || $type=="Online Course Accreditation" || $type=="Training Course Accreditation"){
			$updatenotification['uniid'] 		= $user_id;
			$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);
		}
		if($type=="Request for verification of registration"){
			$updatenotification['ri_id'] 		= $user_id;
			$this->common_model->insertnotifications('tbl_receipient_notifications',$updatenotification);
		}
		if($type=="Request for certificate of good standing"){
			$updatenotification['gs_id'] 		= $user_id;
			$this->common_model->insertnotifications('tbl_goodstanding_notifications',$updatenotification);
		}
	}
	
	public function getexampasspdf($uid)
	{
		$data['profes_details'] = $this->profexam->fetch_user_details($uid);
		$data['exam_details']   = $this->common_model->is_pexam_booked($uid);
		$this->load->view('professional/include/profexam_pass_preview',$data);
	}
	public function get_gra_exampasspdf($uid){
		$data['profes_details'] = $this->graduates_model->fetch_user_details($uid);
		$data['exam_details'] = $this->common_model->is_gexam_booked($uid);
		$result=$this->load->view('professional/include/gradexam_pass_preview',$data, TRUE);
		return $result;
	}
	function getprofreg_card_pdf($userid,$doc_id,$payment_for,$prolicno){
		if($payment_for=='PR'){
			$userdetails = $this->applicant->fetch_user_details($userid,$doc_id);
		}else{
			$userdetails = $this->applicant->fetch_graduate_details($userid);
		}
		$data['profes_details'] = $userdetails;
		$data['license_no'] = $prolicno;
		// echo '<pre>'; print_r($data['profes_details']);die;
		//$this->load->view('professional/include/profregisteration_card_pdf_preview',$data);
		$result = $this->load->view('professional/include/profregisteration_card_pdf_preview',$data, TRUE);
		return $result;
	}
	function getprofreg_cert_pdf($userid,$doc_id,$payment_for,$prolicno){
		if($payment_for=='PR'){
			$userdetails = $this->applicant->fetch_user_details($userid,$doc_id);
		}else{
			$userdetails = $this->applicant->fetch_graduate_details($userid);
		}
		$data['profes_details'] = $userdetails;
		$data['license_no'] = $prolicno;
		
		// echo '<pre>'; print_r($data['profes_details']);die;
		//$this->load->view('professional/include/profregisteration_card_pdf_preview',$data);
		$result=$this->load->view('professional/include/profregisteration_cert_pdf_preview',$data, TRUE);
		return $result;
	}
	function getprofreg_renew_card_pdf($userid,$payment_for){
		$data['profes_details'] = new \stdClass();
		if($payment_for=='p'){
			$userdetails = $this->applicant->fetch_user_details($userid);
			$candidate_type = 'p';
		}else{
			$candidate_type = 'g';
			$userdetails = $this->applicant->fetch_graduate_details($userid);
		}
		$license_details = $this->applicant->get_one_professional_license($userid,$candidate_type);
		// print_r($license_details);die;
		$data['profes_details']->license_no = $license_details->license_no; 
		$data['profes_details']->lic_issue_date = $license_details->lic_issue_date; 
		$data['profes_details']->validity_date = $license_details->lic_expiry_date; 
		//$data['profes_details']->fullname = $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
		$data['profes_details']->fullname = $userdetails->fullname;
		$data['profes_details']->card_qrcode = $license_details->card_qrcode;
		$data['profes_details']->fname = $userdetails->fname;
		$data['profes_details']->lname = $userdetails->lname;
		$data['profes_details']->name = $userdetails->name;
		$data['profes_details']->image = $userdetails->image;
		$data['profes_details']->profession_name = $userdetails->profession_name;
		$result = $this->load->view('professional/include/profregisteration_card_pdf_preview',$data, TRUE);
		return $result;
	}
	
}
