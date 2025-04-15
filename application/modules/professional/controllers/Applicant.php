<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends MX_Controller {
	private $subs_status; 
	private $rbcode; 
	private $rbname; 
	private $data ; 
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->model('professional/Applicant_model','applicant');
		$this->load->model('license/Landing_model','landing');
		$this->load->library('upload');
		$this->load->library('paypal_lib');
		$this->load->library('ciqrcode');
		$this->load->helper('string');
		//rboard check 
		
		$subscription = $this->common_model->get_admin_subscription_details();
		if(isset($subscription->rb_sub_key) && $subscription->rb_sub_key == ""){
			//go to contcat for admin with form details
			$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
			redirect(base_url('contactus'), 'refresh');		
		}
		
		if(isset($subscription->no_of_application) && $subscription->no_of_application == 0 && $subscription->subscription_id == 6){
			$this->subs_status = 'y';
		}else{
			if($subscription->total_application <= $this->common_model->get_online_application_count()){	
				$this->subs_status = 'n';
			}else{
				$this->subs_status = 'y';
			}
		}
		$this->rbcode = isset($subscription->rb_code)?$subscription->rb_code:'';
		$this->rbname = isset($subscription->rb_name)?$subscription->rb_name:'';
		//end rboard check 
	}
	
	function index(){
		$this->data = array( 'title'=> 'Foreign Professional Profile' );
		$data['countries'] = $this->applicant->get_countries();
		$data['profession'] = $this->applicant->get_profession();
		$data['university'] = $this->applicant->get_university();
	
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/application_form',$data);
		$this->load->view('include/footer',$this->data);
	}
	
	function add_application(){

		if($this->input->post()){
			$post = $this->input->post();
			$result = $this->applicant->insert_applcaition($post);
			if(!empty($result)){

				$professional = array(						
					'prof_id'  		=> $result,
					'prof_name'  	=> $this->input->post('name'),
					'prof_email'  	=> $this->input->post('email'),
					'prof_stepone' 	=> TRUE
				);
				$this->session->set_userdata($professional);
				$data['id'] 	 = $result;
				$data['success'] = true;
				$data['message'] = 'Application submitted successfully.';
				$this->session->set_flashdata('message','<div class="alert alert-success">Application submitted successfully.</div>');
				redirect('professional/applicant/upload_documents', 'refresh');
			}else{
				$data['success'] = false;
				$data['message'] = 'Something went wrong!';
				$this->session->set_flashdata('message','<div class="alert alert-danger">Something went wrong, Plesae try again.</div>');
				redirect('professional/applicant/index', 'refresh');
			}
				// echo json_encode($data);
		}		
	}

	function upload_documents(){
		if(!$this->session->userdata('prof_stepone')==TRUE){
			redirect('professional/applicant/index');
		}
		$this->data = array('title'=> 'Upload Documents');
		$data['data'] = array(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/upload_documents',$data);
		$this->load->view('include/footer',$this->data);
	}

	function add_documents(){
		if($this->input->post()){
			$post = $this->input->post();
			$result = $this->applicant->insert_documents($post);
			$profdoc = array('profdoc' => $result['insert_id']);
			$this->session->set_userdata($profdoc);
			if(!empty($result)){
			$this->session->set_flashdata('response','<div class="alert alert-success">Documents Uploaded successfully.</div>');
				redirect('professional/applicant/payment', 'refresh');
			}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong, Plesae try again.</div>');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		}
	}			

	function checkEmail(){
		$email = $this->input->post('email');
		$result = $this->landing->check_unique_email($email);
		if($result>0){
			echo 1;
		}else{
			echo 0;
		}
	}
	function payment(){
		if(!$this->session->userdata('prof_stepone')==TRUE){
			redirect('professional/applicant/index');
		}
		$this->data = array('title'=> 'Payment');
		$data['details'] = array();
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/payment',$data);
		$this->load->view('include/footer',$this->data);
	}

	function paypal_payment(){
		$post = $this->input->post();
		// Get product data from the database
		$user = $this->applicant->getRows($post['uid']);
		
		// Get current user ID from the session
			$userID = $user->user_ID; 
			$paymentdata 					= array();
			$paymentdata['user_id'] 		= $userID;
			$paymentdata['doc_refrence_id'] = $this->session->userdata('profdoc');
			$paymentdata['txn_id'] 			= '';
			$paymentdata['payment_amout'] 	= $post['amount'];
			$paymentdata['payment_tax'] 	= $post['taxamt'];
			$paymentdata['payment_gross'] 	= $post['total'];			
			$paymentdata['payer_email'] 	= '';
			$paymentdata['payment_status'] 	= ''; 
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'P';
			$paymentdata['payment_type'] 	= 'N';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			
			unset($_SESSION['profdoc']);
			
			// Set variables for paypal form
			$returnURL = base_url().'professional/applicant/paymentsuccess'; //payment success url
			$cancelURL = base_url().'professional/applicant/paymentcancel'; //payment cancel url
			$notifyURL = base_url().'professional/applicant/ipn'; //ipn url
			
			// Add fields to paypal form
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name_1', 'Foreign Professional Review for Professional Registration');
			$this->paypal_lib->add_field('item_number_1',  $lastpaymentid);
			$this->paypal_lib->add_field('amount_1',  $post['total']);
			$this->paypal_lib->add_field('quantity_1' ,1);
			$this->paypal_lib->add_field('lc' ,'US');
			$this->paypal_lib->add_field('custom' ,'');
			$this->paypal_lib->add_field('upload' ,'1');
			$this->paypal_lib->add_field('cbt' ,'Return to The Store');
			// $this->paypal_lib->add_field('item_name', 'Foreign Professional Review for Professional Registration');
			// // $this->paypal_lib->add_field('custom', $userID);
			// $this->paypal_lib->add_field('item_number',  $lastpaymentid);
			// $this->paypal_lib->add_field('amount',  $post['total']);
		
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();
	}

	function paymentsuccess(){
		// Get the transaction data
		// echo '<pre>'; print_r($_REQUEST);die;
		$paypalInfo = $this->input->post();
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		$this->common_model->update_payment($data,$item_number);

		$data['details']=$this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);	
		
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'7',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);
		
		$this->session->sess_destroy();
		// Update and send mail

		$userid     = $getuserid->user_id;
		$bytes 		= random_bytes(3); 
		$refcode 	= bin2hex($bytes);
		$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');
		$refcodearr = array();
		// $refcodearr['refrence_code'] = $proRefCode;
		$refcodearr['account_type'] = 'P';
		$refcodearr['status'] = 1;
		$updaterefencecode = $this->applicant->updatereferencecode($refcodearr,$userid);
		$docdata = array();
		$docdata['refrence_code'] = $proRefCode;
		$docdata['updated_at'] = date('Y-m-d H:i:s');
		$this->applicant->updateprofdoc($docdata,$getuserid->doc_refrence_id);
		$serachlink = '<a href="'.base_url('license/search').'" style="color:blue;">Click here</a>';
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for FOREIGN PROFESSIONAL was successfully submitted. Please provide us some time to review your documents.<br><br>Please '.$serachlink.' to check the status of your application <br>And enter this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';
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
			$settingarr = $this->common_model->get_setting('1');
			//send refrence code 
			$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($userdetails->email);
			$this->email->subject('Application submitted successfully');
			$emailbody = array();
			$emailbody['name'] 			= $userdetails->fullname;
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 		= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
			//$this->email->message('Testing the email class.');
			$this->email->message($emailmessage);
			$this->email->send();

			//2nd email
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($userdetails->email);
			$this->email->subject('Payment_Receipt');
			$emailbodyr = array();
			$emailbodyr['name'] 		= $userdetails->fullname;
			$emailbodyr['thanksname'] 	= $settingarr->signature_name;
			$emailbodyr['thanks2'] 		= '';
			$emailbodyr['thanks3'] 		= $settingarr->position;
			$emailbodyr['body_msg'] 	= $bodycontentforCodeemail;
			$emailmessage = $this->load->view('emailer_receipt', $emailbodyr,  TRUE);
			//$this->email->message('Testing the email class.');
			$this->email->message($emailmessage);
			$this->email->send();

			//end send refrence code
			$updatenotification 				= array();
			$updatenotification['user_id'] 		= $userdetails->user_ID;
			$updatenotification['subject'] 		= 'Application submitted successfully';
			$updatenotification['message'] 		= $bodycontentforCode;
			$updatenotification['from'] 		= SENDER_NAME;
			$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
			$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
			$this->applicant->insertnotifications($updatenotification); 
		}
 
		$prof = $this->applicant->fetch_user_details($getuserid->user_id);
		$professional = array(						
			'prof_id'  		=> $prof->user_ID,
			'prof_name'  	=> $prof->name,
			'prof_email'  	=> $prof->email,
			'prof_stepone' 	=> TRUE
		);
		$this->session->set_userdata($professional);

		$this->data = array('title'=> 'Review of Documents');
		$data['profes_details'] = $this->applicant->fetch_user_details($getuserid->user_id);

		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}

	function paymentcancel(){
		$this->data = array( 'title'  => 'Payment Cancel');
		redirect('professional/applicant/payment',$this->data);
	}

	function ipn(){
		// Paypal posts the transaction data
		$paypalInfo = $this->input->post();
    }	

	function review_doc($user_ID){
		// if(!$this->session->userdata('prof_stepone')==TRUE){
		// 	redirect('professional/applicant/index');
		// }
		$this->data = array('title'=> 'Review of Documents');
		$data['profes_details'] = $this->applicant->fetch_user_details(base64_decode($user_ID));
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}

	function exam_code($uid){
		$data['profes_details'] = $this->applicant->fetch_user_details(base64_decode($uid));
		$data['exam_details'] = $this->common_model->is_pexam_booked(base64_decode($uid));
		$this->data = array('title'=> 'Professional exam Code');
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/exam_code',$data);
		$this->load->view('include/footer',$this->data);
	}	

	public function exam_pass($uid){
		$data['profes_details'] = $this->applicant->fetch_user_details(base64_decode($uid));
		$data['exam_details'] = $this->common_model->is_pexam_booked(base64_decode($uid));
		$this->data = array('title'=> 'Professional Exam Pass');
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/exam_pass',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function exam_result($uid,$id){
		$data['profes_details'] = $this->applicant->fetch_user_details(base64_decode($uid));
		$data['exam_result'] = $this->common_model->exam_result(base64_decode($id));
		// echo '<pre>'; print_r($data);die();
		$this->data = array('title'=> 'Examination Result');
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/exam_result',$data);
		$this->load->view('include/footer',$this->data);
	}


	function digital_license($uid){
		$data['profes_details'] = $this->applicant->fetch_user_details(base64_decode($uid));
		$this->data = array('title'=> 'Certificate of Eligibility & Registration Code');
		$this->load->view('include/header',$this->data);
		$this->load->view('applicant/digital_license',$data);
		$this->load->view('include/footer',$this->data);
	}	

	function get_certificate(){
		$data = array();
		return $this->load->view('professional/applicant/certificate_html',$data);
	}

	function send_certificate_mail(){
		$email 		= $this->input->post('to');
		$name 		= $this->input->post('name');
		$subject 	= $this->input->post('subject');
		$content 	= $this->input->post('content');
		
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Certificate for Professional accreditation is here.<br><br>
			'.$content.'
			<br><br>Should you have questions just message us and we would be happy to assist you.<br></p>';
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
		if($email != ''){
			//send certificate 
			$settingarr = $this->common_model->get_setting('1');
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($email);
			$this->email->subject($subject);
			$emailbody = array();
			$emailbody['name'] 			= $name;
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 	= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
			$this->email->message($emailmessage);
			$this->email->send();
			//end send certificate 
			echo 'Mail sent successfully';
		}else{
			echo 'Please enter a valid email.';
		}
	}

	// professional registration start step 1 to step 3  
	function registration_form(){
		$this->data = array(
			'title'=> 'Professional Information and Registration Code'
		);
	
		$this->load->view('include/header',$this->data);
		$this->load->view('registration/registration_form',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function matchdata(){
		$output = array('error' => false);	
		$msg = 0;	
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Surname', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
		//$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('registration_code', 'Registration code', 'trim|required');			
		if($this->form_validation->run() == TRUE){
			$fname = trim($this->input->post('fname'));
			$lname = trim($this->input->post('lname'));
			$name = trim($this->input->post('name'));
			$email = trim($this->input->post('email'));
			$gender = trim($this->input->post('gender'));
			$birthday = trim($this->input->post('birthday'));
			$registration_code = trim($this->input->post('registration_code'));
			
			$check = $this->applicant->check_professional_exsits($email);
			if($check == ''){
				$profdetailsarr = $this->applicant->get_user_details($fname,$lname,$name,$email,$gender,$birthday,$registration_code);
				if(count($profdetailsarr) > 0){
					if(isset($profdetailsarr->role) && $profdetailsarr->role != ''){ $utype = 'p';}else{ $utype = 'g'; }
					$profdetailss = array(						
						'prof_id'  		=> $profdetailsarr->user_ID,
						'prof_name'  	=> $profdetailsarr->name,
						'prof_email'  	=> $profdetailsarr->email,
						'registration_no'=> $profdetailsarr->registration_no,
						'prof_type'		=> $utype,
						'prof_stepone' 	=> TRUE
					);
					$this->session->set_userdata($profdetailss);
					$result['success'] = true;
					$result['msg'] = '1';
					$result['profdetails'] = $profdetailsarr;
				}else{
					$result['success'] = false;
					$result['msg'] = '0';
				}
		
			}else{
				$result['success'] = false;
				$result['msg'] = '2';
			}
		
		}else{
			$errors = array(
				'fname' => form_error('fname', '<p class="mt-3 text-danger">', '</p>'),
				'lname' => form_error('lname', '<p class="mt-3 text-danger">', '</p>'),
				'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
				'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
				'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
				'registration_code' => form_error('registration_code', '<p class="mt-3 text-danger">', '</p>'),
			);
			$result['error'] = $errors;
			$result['success'] = False;
			$result['msg'] = '0';
		}
		echo json_encode($result); exit;
	}

	function getprice(){
		$chargeid = $_POST['chargeid'];
		$charges_for = $_POST['charges_for'];
		$data['chargesarr'] = $this->common_model->getcharges($chargeid,$charges_for);
		if($data['chargesarr']){
		// echo json_encode($this->db->last_query());
		$charge = $data['chargesarr']->charge; 
		// $tax = $data['chargesarr']->tax; 
		$settingarr = $this->common_model->get_setting('1');
		$tax = $settingarr->tax;
		$tax_amount = $charge*$tax/100; 
		// $tax_amount = $data['chargesarr']->tax_amount; 
		echo json_encode(array('err'=>'','charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
		}else{
			$err = 'Nope, Something went wrong';
			echo json_encode(array('err'=>$err));
			exit;
		}
	}

	function registration_payment(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/registration_form');
		}
		$this->data = array('title'=> 'Registration Payment');
		$data['details'] = array();
		$data['chargesarr'] = $this->common_model->certificatechargesarr('professional_registration');
		$this->load->view('include/header',$this->data);
		$this->load->view('registration/payment',$data);
		$this->load->view('include/footer',$this->data);
	}

	function registration_paypal_payment(){
		$post = $this->input->post();
		
		if($post['submit'] == "paynow"){
			$this->form_validation->set_rules('process_fee', 'process fee', 'trim|required');
				//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if($this->form_validation->run() == TRUE){
				// Set variables for paypal form
				$returnURL = base_url().'professional/applicant/registration_paymentsuccess'; //payment success url
				$cancelURL = base_url().'professional/applicant/registration_paymentcancel'; //payment cancel url
				$notifyURL = base_url().'professional/applicant/registration_ipn'; //ipn url
				
				// Get product data from the database
				if($this->session->userdata('prof_type')=='p'){
					$user = $this->applicant->getRows($post['uid']);
					$prouserid = $user->user_ID;
				}else{
					$user = $this->applicant->getgraduateRows($post['uid']);
				}

				// Get current user ID from the session
				$userID = $user->user_ID; 
				$certdeta = $this->common_model->get_certificatechargedetails($post['process_fee']);
				
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

				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $userID;
				$paymentdata['doc_refrence_id'] = $pdgetid;
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $post['amount'];
				$paymentdata['payment_tax'] 	= $post['taxamt'];
				$paymentdata['payment_gross'] 	= $post['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= $post['payment_for'];
				$paymentdata['payment_type'] 	= 'N';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			
				// Add fields to paypal form
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name_1', 'Professional Registration Payment');
				$this->paypal_lib->add_field('custom', $userID);
				$this->paypal_lib->add_field('item_number_1', $lastpaymentid);
				$this->paypal_lib->add_field('amount_1',  $post['total']);
				$this->paypal_lib->add_field('quantity_1' ,1);
				$this->paypal_lib->add_field('lc' ,'US');
				$this->paypal_lib->add_field('upload' ,'1');
				$this->paypal_lib->add_field('cbt' ,'Return to The Store');
				
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();
			}else{
				$this->data = array('title'=> 'Registration Payment');
				$data['details'] = array();
				$this->load->view('include/header',$this->data);
				$this->load->view('registration/payment',$data);
				$this->load->view('include/footer',$this->data);
			}
		}
	}

	function registration_paymentsuccess(){
		// Get the transaction data
		$paypalInfo = $this->input->post();
		if($paypalInfo["txn_id"] ==''){
			redirect('professional/applicant/registration_payment',$this->data);
		}
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		
		$this->common_model->update_payment($data,$item_number);
		$receipt['details']=$this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $receipt, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);	
		
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'1',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);

		$this->session->sess_destroy();

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
		$updated = $this->applicant->updateprofdoc($updateprof,$getuserid->doc_refrence_id);
	
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

		// $check = $this->applicant->check_professional_exsits($userdetails->email);
		// echo '<pre>'; echo $this->db->last_query(); print_r($res); exit;
		// if($check ==''){
			// if($res){
			// 	//updating new license number and validaity date in user table
			// 	$updatenewdata = array();
			// 	$updatenewdata = array(
			// 		'license_no'		=> $prolicno,
			// 		'license_validity_date'	=> $docDetails->lic_issue_date,
			// 		'license_issued_date'	=> $docDetails->expiry_at
			// 	);
			// 	$this->applicant->update('tbl_users',$updatenewdata,'user_ID',$userid);
			// }
		// }
			
		if($updated){
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
				<br>Here is your username : '.$add['username'].' and temporary password : '.$newpassword.' to log in and access your account.
				Please <a href="'.base_url('login').'" style="color:blue;" target="_blank">click this link </a> to log in.
				<br> Should you have questions just message us and we would be happy to assist you.</p>';
			
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
			if(isset($res) && $res){
				//send refrence code 
				$settingarr = $this->common_model->get_setting('1');
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Professional Registration Success');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fullname;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				if(isset($userdetails->registration_no) && file_exists('assets/uploads/pdf/'.$docDetails->refrence_code.'card.pdf')){
					$this->email->attach(base_url('assets/uploads/pdf/'.$docDetails->refrence_code.'card.pdf'));
					}	
				if(isset($userdetails->registration_no) && file_exists('assets/uploads/pdf/'.$docDetails->refrence_code.'cert.pdf')){
					$this->email->attach(base_url('assets/uploads/pdf/'.$docDetails->refrence_code.'cert.pdf'));
					}	
				$this->email->send();
				//end send refrence code 

				//2nd email
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fullname;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();

				$updatenotification 				= array();
				$updatenotification['user_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Professional Registration Account Created';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->applicant->insertnotifications($updatenotification); 
			}

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
		$this->data = array('title'=> 'Registration Certificate and Professional Identification Card');
		if($payment_for=='PR'){
			$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
		}else{
			$userdetails = $this->applicant->fetch_graduate_details($getuserid->user_id);
		}
		$data['profes_details'] = $userdetails;
		$data['license_no'] = $docDetails->refrence_code;
		
		$this->load->view('include/header',$this->data);
		$this->load->view('registration/certificate',$data);
		$this->load->view('include/footer',$this->data);
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

	function registration_paymentcancel(){
		$this->data = array( 'title'  => 'Payment Cancel');
		redirect('professional/applicant/registration_payment',$this->data);
	}

	function registration_ipn(){
		// Paypal posts the transaction data
		$paypalInfo = $this->input->post();
    }

	//****************** Professional login and dashboard start ****************// 

	function login(){ 
		//echo '<pre>'; print_r($_POST); exit;
		$validation = array(
			array('field' => 'username' ,'rules' => 'trim|required' ),
			array('field' => 'password' ,'rules' => 'trim|required' )
		);

		$this->form_validation->set_rules($validation);

		if($this->form_validation->run() == true){
			// print_r($this->input->post());exit;
			$role = $this->input->post('role');
			$user_post = $this->input->post('username');
			$pass_post = $this->input->post('password');
			$result = $this->professional_login($user_post,$pass_post);
			// print_r($result['success']);die;
			if($result['success'] == 1){
	
				redirect('professional/applicant/dashboard','refresh');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
				redirect('professional/applicant/login','refresh');
			}	
			
		}else{
			if($this->session->userdata('registration_no') > 0 && $this->session->userdata('session') == true){
				redirect('professional/applicant/dashboard');
			}
			$this->data = array( 'title' => 'Login' );
			$this->load->view('include/header',$this->data);
			$this->load->view('professional/login',$this->data);
			$this->load->view('include/footer',$this->data);
		}
	}

	private function professional_login($username,$pass_post){
		if($this->_resolve_user_login($username,$pass_post)){
			$this->db->where('username',$username);
			$info = $this->db->get('tbl_professional_license')->row();
			$create_session = array(
				'id' 			=> $info->pl_id,   
				'user_ID' 		=> $info->user_id,   
				'email' 		=> $info->username,
				'name' 			=> $info->name,
				'registration_no'=> $info->registration_no,
				'candidate_type' => $info->candidate_type,
				'professional_session'=> true,
				'role'			=> 'professioanl'
			);
			$this->session->set_userdata($create_session);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}

	private function _resolve_user_login($username,$password){
		$this->db->where(array('username'=>$username,'payment_status'=>'1'));
		$hash = $this->db->get('tbl_professional_license')->row('password');
		// echo $this->db->last_query();
		if($hash != ''){
			return $this->_verifiy_password_hash($password, $hash);
		}else{
			return false;
		}
	}

	private function _verifiy_password_hash($password, $hash){
		return password_verify($password, $hash);
	}

	function logout(){
		 $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'user_ID' && $key != 'email' && $key != 'name' && $key != 'registration_no'&& $key != 'session' && $key != 'role') {
                $this->session->unset_userdata($key);
            }
        }
    	$this->session->sess_destroy();
		// redirect('professional/applicant/login');
		redirect(base_url('login'));
	}


	function dashboard(){

		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('title'=> 'Certificate Listing','page_title'=>'Certificate Listing');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');

		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
	
		$data['doc'] = $this->applicant->get_latest_license($userid);
		
		$this->load->view('include/header',$this->data);
		// $this->load->view('professional/dashboard',$data);
		$this->load->view('certificate_listing',$data);
		$this->load->view('include/footer',$this->data);
	} 

	function certificate(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}

		$userid = $this->session->userdata('user_ID');
		$this->data = array('title'=> 'Registration Certificate and Professional Identification Card','page_title'=> 'Registration Certificate and Professional Identification Card');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['profes_details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('registration/certificate',$data);
		$this->load->view('include/footer',$this->data);
	}

	function changepassword(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}

		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);

		if($this->input->post('submit')){
			$this->form_validation->set_rules('old_password', 'Current Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required');
			if ($this->form_validation->run() == TRUE) {
				$fetchPassword = $this->applicant->fetchPassword($this->session->userdata('id')); 
			
				$verify = password_verify($this->input->post('old_password'),$fetchPassword->password);
				if($verify!=true){
					$this->session->set_flashdata('item', '<div class="alert alert-danger">Old password not matched.</div>');
				}
				elseif($this->input->post('new_pass') != $this->input->post('conf_pass')){
					$this->session->set_flashdata('item', '<div class="alert alert-danger">Confirm password not matched.</div>');
				}else{
					$updatepass = array();
					$updatepass['password'] = password_hash($this->input->post('conf_pass'), PASSWORD_DEFAULT);
					$this->applicant->updatePassword($updatepass,$this->session->userdata('id'));
					$this->session->set_flashdata('item', '<div class="alert alert-success">New password successfully updated.</div>');
				}
				redirect(base_url('professional/applicant/changepassword'), 'refresh');
			}else{
				validation_errors();
			}
		}
		$this->data = array('title'=> 'Welcome in Regulatry Board');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('changepassword',$data);
		$this->load->view('include/footer',$this->data);
	}


	function editprofile(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		if($this->input->post('submit')=='submit'){
			// $this->form_validation->set_rules('address', 'address', 'trim|required');
			// $this->form_validation->set_rules('phone', 'phone', 'trim|required');
			$this->form_validation->set_rules('name', 'name', 'trim');
			
			//$this->form_validation->set_rules('photo', 'photo', 'trim|required');
			if($this->form_validation->run() == TRUE){
				// image upload				
					$image = '';
					if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
						
						if($candidate_type == 'p'){
							$path 		= './assets/uploads/profile/';
						}else{
							$path 		= './assets/images/graduates/';
						}	
						
						$config['upload_path'] 		= $path;
						//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
						$config['allowed_types'] 	= '*';
						//$config['max_size'] 		= '200000';
						//$config['max_width']  	= '1500';
						//$config['max_height']  	= '800';        
						$ext 						= explode('.',$_FILES["image"]["name"]);        
						$image 						= 'dp_'.time().'.'.end($ext);
						
						$config['file_name'] 		= $image;
						//$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('image'))
						{
							$error = array('error' => $this->upload->display_errors());        
						}  
						$image = $image;
					}else{
						$image = $this->input->post('old_image');
					}
					//echo $image;exit;
				// end image upload
				$candidate_type  		= $this->input->post('user_type');
					
				$profdata 				= array();
				$profdata['address']  	= $this->input->post('address');
				$profdata['phone']  	= $this->input->post('phone');
				//$profdata['name']  		= $this->input->post('name');

				if($candidate_type == 'p'){
				$profdata['image']		= $image;
				$result = $this->applicant->update('tbl_users',$profdata,'user_ID',$userid);
				}else{
				$profdata['photo']		= $image;
				$result = $this->applicant->update('graduates',$profdata,'grad_id',$userid);
				}

				if($result){
					$this->session->set_flashdata('item', array('message' => 'Updated successfully','class' => 'alert-success'));
					redirect(base_url('professional/applicant/editprofile'), 'refresh');
				}
			}else{
				validation_errors();
			}
		}
		$this->data = array('title'=> 'Welcome in Regulatry Board');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('editprofile',$data);
		$this->load->view('include/footer',$this->data);
	}

	function upload_certificate(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}

		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);

      
		if($this->input->post() != ''){
			
			if($this->input->post('certi_no') != ''){
				$result = $this->landing->is_unique_certficate($_POST['certi_no']);
				if(count($result) > 0){
					$this->session->set_flashdata('response','<div class="alert alert-danger">You have uploaded this certificate already.</div>');
					redirect(base_url('professional/applicant/certificate_listing'));  die();
				}
			}

            if(isset($_FILES["certificate"]) && !empty($_FILES["certificate"]['name'])){
				$config['upload_path'] = './assets/uploads/certificate/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';   
				$ext = explode('.',$_FILES["certificate"]["name"]);    
				$imageName = 'CERTIFICATE_'.time().'.'.end($ext);
				$config['file_name'] = $imageName;
				$this->upload->initialize($config);
				if ( !$this->upload->do_upload('certificate'))
				{
					$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
					redirect('professional/applicant/certificate_listing');              
				}  
            	$insert['certificate'] = $imageName;
            }

	        $insert['certificate_id'] = $this->input->post('certi_no'); 
	        $insert['course_name']    = $this->input->post('course_name'); 
	        $insert['units']          = $this->input->post('course_unit'); 
	        $insert['start_date']     = $this->input->post('course_start_date'); 
	        // $insert['end_date']    = $this->input->post('course_end_date'); 
	        $insert['category']       = $this->input->post('category'); 
	        $insert['issue_from']     = $this->input->post('issue_from'); 
	        $insert['issue_by']       = $this->input->post('issue_by'); 
	        $insert['status']         = 1; 
  			$insert['archive'] 		  = 1;
	        $insert['added_on']       = date('Y-m-d h:i:s'); 
	        $insert['user_id']        = $userid;

			if($this->input->post('user_email')){
				$insert['user_email']  	  = $this->input->post('user_email');
			}
       		$result = $this->applicant->save('tbl_user_certificate',$insert); 
			//    echo $this->db->last_query();die;
            if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Certificate added successfully to your lists.</div>');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
            }
            redirect('professional/applicant/certificate_listing');
            
        }
	}

	function certificate_listing(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Certificate Listing','title'=> 'Certificate Listing');
		
		$userid = $this->session->userdata('user_ID');
		$user_email = $this->session->userdata('email');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid,$user_email);
		$data['pending'] 	= $this->applicant->getPendingCertificate($user_email);
		$data['submitted'] 	= $this->applicant->getSubmittedCertificate($user_email);
		
		$this->load->view('include/header',$this->data);
		$this->load->view('certificate_listing',$data);
		$this->load->view('include/footer');
	}

	public function change_category(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		if($this->input->post()){
			$data = array();
			$id = $this->input->post('id');
			$data['category'] = $this->input->post('category');
			$updated = $this->applicant->update('tbl_user_certificate', $data, 'id', $id);
			if($updated){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Category changed successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong.</div>');
			}
			return redirect(base_url('professional/applicant/certificate_listing'));
		}else{
			return redirect(base_url('professional/applicant/certificate_listing'));
		}
	}
	
	function upload_card(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		if($this->input->post('save')=='SAVE'){

			$post = $this->input->post();
			$result = $this->applicant->savecard($post); 
			if($result){
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">1 Card added successfully to your lists.</div>');
            } else {
                $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
            }
            redirect('professional/applicant/card_listing');
		}
	}

	function card_listing(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Professional Identification Card','title'=> 'Professional Identification Card');
		
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$data['alllicense'] = $this->applicant->get_all_licenses_of_user($userid);
		$data['all_cards'] = $this->applicant->get_all_cards($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('card_listing',$data);
		$this->load->view('include/footer',$this->data);
	}
	function certificate_of_registration(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Certificate of Registration','title'=> 'Certificate of Registration');
		
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		//$data['doc'] = $this->applicant->get_cert_of_registration($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		// $data['all_cards'] = $this->applicant->get_all_cards($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('certificateofregistration_listing',$data);
		$this->load->view('include/footer',$this->data);
	}

	function deletecard($id){
		$userid = $this->session->userdata('user_ID');
		$del = $this->applicant->delete_cards($id,$uid);
		if($del){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Card Deleted.</div>');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		redirect('professional/applicant/card_listing');
	}

	function renewprofessional(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Renew Professional license','title'=> 'Renew Professional license');
		
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('renew/user_details',$data);
		$this->load->view('include/footer',$this->data);
	}

	function professional_ceunits(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Renew Professional license','title'=> 'Required CE Units Verification');
		
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('renew/user_units',$data);
		$this->load->view('include/footer',$this->data);
	}

	function professional_cecertificates(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Renew Professional license','title'=> 'CE Certificate Verification');
		
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$this->load->view('include/header',$this->data);
		$this->load->view('renew/user_certificate',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function license_history(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'License History','title'=> 'License History');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		
		$data['paymentarr'] = $this->applicant->get_licensehistory($userid);

		$this->load->view('include/header',$this->data);
		$this->load->view('license_history',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function purchase_list(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Purchase List','title'=> 'Purchase List');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		
		$data['paymentarr'] = $this->applicant->get_purchaselist($userid);

		$this->load->view('include/header',$this->data);
		$this->load->view('purchase_list',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function get_receipt(){
		$id = $this->input->post('id');
		$data['details'] = $this->common_model->get_one_receipt_details($id);
// echo $this->db->last_query();
		$this->load->view('admin/receipt_view',$data);
	}

	public function send_receipt_mail(){
		$email 		= $this->input->post('to');
		$name 		= $this->input->post('name');
		$subject 	= $this->input->post('subject');
		$content 	= $this->input->post('content');
		
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Certificate for Professional accreditation is here.<br><br>
			'.$content.'
			<br><br>Should you have questions just message us and we would Be happy to assist you.<br></p>';
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
		if($email != ''){
			//send certificate 
			$settingarr = $this->common_model->get_setting('1');
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($email);
			$this->email->subject($subject);
			$emailbody 					= array();
			$emailbody['name'] 			= $name;
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 		= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
			$this->email->message($emailmessage);
			$this->email->send();
			//end send certificate 
			echo 'Mail sent successfully';
		}else{
			echo 'Please enter a valid email.';
		}
	}
	function notification(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> 'Notification','title'=> 'Notification');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$data['get_notifications'] = $this->applicant->get_notifications($userid,'0'); 
		$data['get_notifications_read'] = $this->applicant->get_notifications($userid,'1'); 
		$this->load->view('include/header',$this->data);
		$this->load->view('notification',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function notification_read_status(){
		$profn_id = $_POST['profn_id'];
		//$this->university_model->update_notifications($this->session->userdata('uniid'),array('read_status'=>'1','uninot_id'=>$uninot_id));
		$this->applicant->update_notifications($profn_id,array('read_status'=>'1'));
		echo 'alert'; exit;
	}
	public function messagereply(){
		//echo $this->session->userdata('name'); exit;
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$_POST['message'].'</p>';
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
				//send refrence code 
				$settingarr = $this->common_model->get_setting('1');
				$subject = 'Reply From RBoard - '.$_POST['pursosefor'];
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($this->session->userdata('email'));
				$this->email->subject($subject);
				$emailbody1 = array();
				$emailbody1['name'] = $this->session->userdata('name');
				$emailbody1['thanksname'] 	= $settingarr->signature_name;
				$emailbody1['thanks2'] 		= '';
				$emailbody1['thanks3'] 		= $settingarr->position;
				$emailbody1['body_msg'] = $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$sent = $this->email->send();
				if($sent){
					echo 'Message sent successfully.';		
				}else{
					echo 'Message not sent please try again.';
				}
				//end send refrence code 
			exit;
	}
	function terms(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> '','title'=> 'Welcome in Regulatry Board');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['get_terms'] = $this->applicant->get_terms();
		$this->load->view('include/header',$this->data);
		$this->load->view('terms',$data);
		$this->load->view('include/footer',$this->data);
	}
	function tutorials(){
		if(!$this->session->userdata('registration_no') != ''){
			redirect('professional/applicant/login');
		}
		$this->data = array('page_title'=> '','title'=> 'Welcome in Regulatry Board');
		$userid = $this->session->userdata('user_ID');
		$candidate_type = $this->session->userdata('candidate_type');
		$data['details'] = $this->applicant->get_all_details($userid,$candidate_type);
		$data['doc'] = $this->applicant->get_latest_license($userid);
		$data['ecertificate'] = $this->applicant->get_user_certificate($userid);
		$data['get_tutorial'] = $this->applicant->get_tutorial();
		$this->load->view('include/header',$this->data);
		$this->load->view('tutorial',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function license_cert_card($codedid){
		$this->data = array('title'=> 'Registration Certificate and Professional Identification Card');
		$user_id = base64_decode($codedid);
		//if($payment_for=='PR'){
		$userdetails = $this->applicant->fetch_user_detailsforcert($user_id);
		//echo '<pre>';print_r($userdetails);exit;
			// $details = $this->applicant->get_registered_professional($user_id);
		//}else{
		//	$userdetails = $this->applicant->fetch_graduate_details($getuserid->user_id);
		//}
		if(!empty($userdetails)){
		$data['profes_details'] = $userdetails;
		$data['license_no'] 	= $userdetails->refrence_code;
		
		$this->load->view('include/header',$this->data);
		$this->load->view('registration/certificate',$data);
		$this->load->view('include/footer',$this->data);
		}else{
			redirect(base_url('license/search'), 'refresh');
		}
	}

	// Verification Of Registration Start
	public function verificationOfRegistration(){
		$this->data = array('title'=> 'Personal &amp; Professional Information Verification');
		$userid = $this->session->userdata('user_ID');
		
		$this->form_validation->set_rules('email', 'Email', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->db->order_by('name','ASC');
			$data['profession']  = $this->landing->get_result_object('tbl_profession','status',1);
			$data['details'] = $this->landing->get_professional_details($userid);
			$this->load->view('include/header',$this->data);
			$this->load->view('vr_step1',$data);
			$this->load->view('include/footer');
		}
		else
		{
			$this->session->set_flashdata('item','<div class="alert alert-success">Success.</div>');
			redirect(base_url('professional/applicant/receipientInformation'), 'refresh');	
		}
	}

	public function receipientInformation(){
		$this->data = array('title'=> 'Receipient Information');
		$userid = $this->session->userdata('user_ID');

		$this->form_validation->set_rules('insname', 'Institution Name', 'required');
		$this->form_validation->set_rules('insaddress', 'Institution Address', 'required');
		$this->form_validation->set_rules('inscountry', 'Institution Country', 'required');
		$this->form_validation->set_rules('insemail', 'Institution email', 'required');
		$this->form_validation->set_rules('inspurpose', 'Institution Purpose', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data['countries'] = $this->applicant->get_countries();
			$this->load->view('include/header',$this->data);
			$this->load->view('vr_step2',$data);
			$this->load->view('include/footer');
		}
		else
		{
			$insertdata = [
				'user_id'	=>	$userid,
				'insname'	=>	$_POST['insname'],
				'insaddress'=>	$_POST['insaddress'],
				'inscountry'=>	$_POST['inscountry'],
				'insemail'	=>	$_POST['insemail'],
				'inspurpose'=>	$_POST['inspurpose'],
				'added_on'  =>	date('Y-m-d H:i:s'),
			];

			$result = $this->applicant->insert_receipient_information($insertdata);
			if($result){
				$_SESSION['rinfo_id'] = $result;
				$this->session->set_flashdata('item','<div class="alert alert-success">Success.</div>');
				redirect(base_url('professional/applicant/vrPayment'), 'refresh');		
			}
			else
			{
				$this->session->set_flashdata('item','<div class="alert alert-danger">fail.</div>');
				redirect(base_url('professional/applicant/receipientInformation'), 'refresh');
			}
		}
	}

	public function vrPayment(){
		$this->data = array('title'=> 'Payment');
		$userid = $this->session->userdata('user_ID');

		$this->form_validation->set_rules('amount', 'Amount', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data['chargesarr'] 	= $this->common_model->certificatechargesarr('professional_verification_registration');
			$data['settingarr'] 	= $this->common_model->get_setting('1');
			$this->load->view('include/header',$this->data);
			$this->load->view('vr_step3',$data);
			$this->load->view('include/footer');
		}
		else
		{
			$returnURL = base_url().'professional/applicant/vrpaymentsuccess'; //payment success url
			$cancelURL = base_url().'professional/applicant/vrPayment'; //payment cancel url
			$notifyURL = base_url().'professional/applicant/vrPayment'; //ipn url
			
			$userID 		= $_POST['uid']; 
			$lastid = $_SESSION['rinfo_id'];

			$paymentdata 					= array();
			$paymentdata['user_id'] 		= $userID;
			$paymentdata['doc_refrence_id'] = $lastid;
			$paymentdata['txn_id'] 			= '';
			$paymentdata['payment_amout'] 	= $_POST['amount'];
			$paymentdata['payment_tax'] 	= $_POST['taxamt'];
			$paymentdata['payment_gross'] 	= $_POST['total'];			
			$paymentdata['payer_email'] 	= '';
			$paymentdata['payment_status'] 	= '';
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'VR';
			$paymentdata['payment_type'] 	= 'N';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			// echo '<pre>'; print_r($paymentdata);die;
			$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			
			unset($_SESSION['rinfo_id']); //unset
			// Add fields to paypal form
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name_1', 'Professional Verification Registration Payment');
			$this->paypal_lib->add_field('item_number_1', $lastpaymentid);
			$this->paypal_lib->add_field('amount_1',  $_POST['total']);
			$this->paypal_lib->add_field('custom', $userID);
			$this->paypal_lib->add_field('quantity_1' ,1);
			$this->paypal_lib->add_field('lc' ,'US');
			$this->paypal_lib->add_field('upload' ,'1');
			$this->paypal_lib->add_field('cbt' ,'Return to Website');

			// Render paypal form
			$this->paypal_lib->paypal_auto_form();
		}
	}

	public function vrpaymentsuccess(){
		//echo '<pre>'; print_r($_POST);die;
		$paypalInfo = $this->input->post();
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		$this->common_model->update_payment($data,$item_number);

		$data['details']=$this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);		
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'23',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);

		$userid 	= $getuserid->user_id;
		$bytes 		= random_bytes(3); 
		$refcode 	= bin2hex($bytes);
		$proRefCode = 'VR-'.$userid.$refcode.'-'.date('Y');
		$docdata = array();
		$docdata['refrence_code'] = $proRefCode;
		$docdata['updated_at'] = date('Y-m-d H:i:s');
		$this->applicant->update_receipient_information($docdata,$getuserid->doc_refrence_id);

		$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
		$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Request for Verification of Registration has been Done.<br><br>Please '.$serachlink.' to check the status of your application <br>and use this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';
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
			if($userdetails){
				//send refrence code 
				$settingarr = $this->common_model->get_setting('1');
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Application Submitted Successfully');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				//end send refrence code 

				//2nd email for payment receipt
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send(); 

				$updatenotification 				= array();
				$updatenotification['ri_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Application Submitted Successfully';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				//$this->applicant->insertnotifications($updatenotification);
				$this->common_model->insertnotifications('tbl_receipient_notifications',$updatenotification); 
			}
		$this->data = array('title'=> 'Status');
		$this->data['receipient'] = $this->applicant->get_receipient_details($userid);
		// echo $this->db->last_query(); die();
		$this->load->view('include/header',$this->data);
		$this->load->view('vr_step4',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function verificationrequeststatus($user_id=null){
		if($user_id != null){
			$userid = base64_decode($user_id);
			$this->data = array('title'=> 'Status');
			$this->data['receipient'] = $this->applicant->get_receipient_details($userid);
			// echo $this->db->last_query(); die();
			$this->load->view('include/header',$this->data);
			$this->load->view('vr_step4',$this->data);
			$this->load->view('include/footer',$this->data);
		}else{
			return redirect(base_url('license/search'));
		}

	}
	// Verification Of Registration End

	// Certificate of Good Standing Start
	public function requestForGoodStanding(){
		$this->data = array('title'=> 'Personal &amp; Professional Information Verification');
		$userid = $this->session->userdata('user_ID');
		
		$this->form_validation->set_rules('email', 'Email', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->db->order_by('name','ASC');
			$data['profession']  = $this->landing->get_result_object('tbl_profession','status',1);
			$data['details'] = $this->landing->get_professional_details($userid);
			$this->load->view('include/header',$this->data);
			$this->load->view('gs_step1',$data);
			$this->load->view('include/footer');
		}
		else
		{
			$this->session->set_flashdata('item','<div class="alert alert-success">Success.</div>');
			redirect(base_url('professional/applicant/gsreceipientInformation'), 'refresh');	
		}
	}
	public function gsreceipientInformation(){
		$this->data = array('title'=> 'Receipient Information');
		$userid = $this->session->userdata('user_ID');

		$this->form_validation->set_rules('insname', 'Institution Name', 'required');
		$this->form_validation->set_rules('insaddress', 'Institution Address', 'required');
		$this->form_validation->set_rules('inscountry', 'Institution Country', 'required');
		$this->form_validation->set_rules('insemail', 'Institution email', 'required');
		$this->form_validation->set_rules('inspurpose', 'Institution Purpose', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data['countries'] = $this->applicant->get_countries();
			$this->load->view('include/header',$this->data);
			$this->load->view('gs_step2',$data);
			$this->load->view('include/footer');
		}
		else
		{
			$insertdata = [
				'user_id'	=>	$userid,
				'insname'	=>	$_POST['insname'],
				'insaddress'=>	$_POST['insaddress'],
				'inscountry'=>	$_POST['inscountry'],
				'insemail'	=>	$_POST['insemail'],
				'inspurpose'=>	$_POST['inspurpose'],
				'added_on'  =>	date('Y-m-d H:i:s'),
			];

			$result = $this->applicant->insert_good_standing($insertdata);
			if($result){
				$_SESSION['rinfo_id'] = $result;
				$this->session->set_flashdata('item','<div class="alert alert-success">Success.</div>');
				redirect(base_url('professional/applicant/gsPayment'), 'refresh');		
			}
			else
			{
				$this->session->set_flashdata('item','<div class="alert alert-danger">fail.</div>');
				redirect(base_url('professional/applicant/gsreceipientInformation'), 'refresh');
			}
		}
	}
	public function gsPayment(){
		$this->data = array('title'=> 'Payment');
		$userid = $this->session->userdata('user_ID');

		$this->form_validation->set_rules('amount', 'Amount', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data['chargesarr'] 	= $this->common_model->certificatechargesarr('professional_good_standing');
			$data['settingarr'] 	= $this->common_model->get_setting('1');
			$this->load->view('include/header',$this->data);
			$this->load->view('gs_step3',$data);
			$this->load->view('include/footer');
		}
		else
		{
			$returnURL = base_url().'professional/applicant/gspaymentsuccess'; //payment success url
			$cancelURL = base_url().'professional/applicant/gsPayment'; //payment cancel url
			$notifyURL = base_url().'professional/applicant/gsPayment'; //ipn url
			
			$userID 		= $_POST['uid']; 
			$lastid = $_SESSION['rinfo_id'];

			$paymentdata 					= array();
			$paymentdata['user_id'] 		= $userID;
			$paymentdata['doc_refrence_id'] = $lastid;
			$paymentdata['txn_id'] 			= '';
			$paymentdata['payment_amout'] 	= $_POST['amount'];
			$paymentdata['payment_tax'] 	= $_POST['taxamt'];
			$paymentdata['payment_gross'] 	= $_POST['total'];			
			$paymentdata['payer_email'] 	= '';
			$paymentdata['payment_status'] 	= '';
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'GS';
			$paymentdata['payment_type'] 	= 'N';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			// echo '<pre>'; print_r($paymentdata);die;
			$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			
			unset($_SESSION['rinfo_id']); //unset
			// Add fields to paypal form
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name_1', 'Certificate of Good Standing');
			$this->paypal_lib->add_field('item_number_1', $lastpaymentid);
			$this->paypal_lib->add_field('amount_1',  $_POST['total']);
			$this->paypal_lib->add_field('custom', $userID);
			$this->paypal_lib->add_field('quantity_1' ,1);
			$this->paypal_lib->add_field('lc' ,'US');
			$this->paypal_lib->add_field('upload' ,'1');
			$this->paypal_lib->add_field('cbt' ,'Return to Website');

			// Render paypal form
			$this->paypal_lib->paypal_auto_form();
		}
	}
	public function gspaymentsuccess(){
		//echo '<pre>'; print_r($_POST);die;
		$paypalInfo = $this->input->post();
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		$this->common_model->update_payment($data,$item_number);

		$data['details']=$this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);
		$gs_id = $getuserid->doc_refrence_id;		
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'24',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);

		$userid 	= $getuserid->user_id;
		$bytes 		= random_bytes(3); 
		$refcode 	= bin2hex($bytes);
		$proRefCode = 'GS-'.$userid.$refcode.'-'.date('Y');
		$docdata = array();
		$docdata['refrence_code'] = $proRefCode;
		$docdata['updated_at'] = date('Y-m-d H:i:s');
		$this->applicant->update_good_standing($docdata,$getuserid->doc_refrence_id);

		$userdetails = $this->applicant->fetch_user_details($getuserid->user_id);
		$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Request for Certificate of Good Standing has been Done.<br><br>Please '.$serachlink.' to check the status of your application <br>and use this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';
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
			if($userdetails){
				//send refrence code 
				$settingarr = $this->common_model->get_setting('1');
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Application Submitted Successfully');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				//end send refrence code 

				//2nd email for payment receipt
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send(); 

				$updatenotification 				= array();
				$updatenotification['gs_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Application Submitted Successfully';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				//$this->applicant->insertnotifications($updatenotification);
				$this->common_model->insertnotifications('tbl_goodstanding_notifications',$updatenotification); 
			}
		$this->data = array('title'=> 'Status');
		$this->data['gsreceipient'] = $this->applicant->get_goodstand_details($gs_id);
		// echo $this->db->last_query(); die();
		$this->load->view('include/header',$this->data);
		$this->load->view('gs_step4',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function gsrequeststatus($gs_id=null){
		if($gs_id != null){
			$gsid = base64_decode($gs_id);
			$this->data = array('title'=> 'Status');
			$this->data['gsreceipient'] = $this->applicant->get_goodstand_details($gsid);
			// echo $this->db->last_query(); die();
			$this->load->view('include/header',$this->data);
			$this->load->view('gs_step4',$this->data);
			$this->load->view('include/footer',$this->data);
		}else{
			return redirect(base_url('license/search'));
		}

	}
	
	// Certificate of Good Standing end
}
?>