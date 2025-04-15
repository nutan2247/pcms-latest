<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profexam extends MX_Controller {

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
	protected $subs_status;
	protected $data;
	public function __construct(){
		parent::__construct();
		$this->load->model('professional/Profexam_model','profexam');
		$this->load->library('paypal_lib');
		
		//rboard check 
		$subscription = $this->common_model->get_admin_subscription_details();
		// if($subscription->rb_sub_key == ""){
		// 	//go to contcat for admin with form details
		// 	$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
		// 	redirect(base_url('contactus'), 'refresh');		
		// }
		$this->subs_status = 'y';
		// if($subscription->no_of_application == 0 && $subscription->subscription_id == 6){
		// 	$this->subs_status = 'y';
		// }else{
		// 	if($subscription->total_application <= $this->common_model->get_online_application_count()){	
		// 		$this->subs_status = 'n';
		// 	}else{
		// 		$this->subs_status = 'y';
		// 	}
		// }
		//end rboard check 
	}

	private function check_profexam_session(){
		
		if(empty($this->session->userdata('profexam_stepone'))){
			redirect('professional/profexam/registerexam');
		}
	}

	public function index(){
		$this->data = array(
			'title'=> 'Foreign Professional Profile'
		);
		$data['countries'] = $this->profexam->get_countries();
		$data['profession'] = $this->profexam->get_profession();
		$data['university'] = $this->profexam->get_university();
	
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/application_form',$data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function add_application(){

		if($this->input->post()){
			$post = $this->input->post();
			$result = $this->profexam->insert_applcaition($post);
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
				redirect('professional/profexam/upload_documents', 'refresh');
			}else{
				$data['success'] = false;
				$data['message'] = 'Something went wrong!';
				$this->session->set_flashdata('message','<div class="alert alert-danger">Something went wrong, Plesae try again.</div>');
				redirect('professional/profexam/index', 'refresh');
			}
				// echo json_encode($data);
		}		
	}

	public function upload_documents(){
		if(!$this->session->userdata('prof_stepone')==TRUE){
			redirect('professional/profexam');
		}
		$this->data = array('title'=> 'Upload Documents');
		$data['data'] = array(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/upload_documents',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function add_documents(){
		if($this->input->post()){
			$post = $this->input->post();
			$result = $this->profexam->insert_documents($post);
			$profdoc = array('profdoc'=> $result['insert_id']);
			$this->session->set_userdata($profdoc);
			if(!empty($result)){
			$this->session->set_flashdata('response','<div class="alert alert-success">Documents Uploaded successfully.</div>');
				redirect('professional/profexam/payment?user_id='.$result['uid'].'', 'refresh');
			}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong, Plesae try again.</div>');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		}
	}			

	public function payment(){
		if(!$this->session->userdata('prof_stepone')==TRUE){
			redirect('professional/profexam');
		}
		$this->data = array('title'=> 'Payment');
		$data['details'] = array();
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/payment',$data);
		$this->load->view('include/footer',$this->data);
	}


	function paypal_payment(){
		$post = $this->input->post();
		// Set variables for paypal form
		$returnURL = base_url().'professional/profexam/paymentsuccess'; //payment success url
		$cancelURL = base_url().'professional/profexam/paymentcancel'; //payment cancel url
		$notifyURL = base_url().'professional/profexam/ipn'; //ipn url
		
			// Get product data from the database
		$user = $this->profexam->getRows($post['uid']);
		
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
			$paymentdata['payment_for'] 	= 'PP';
			$paymentdata['payment_type'] 	= 'N';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$lastpaymentid = $this->common_model->insert_payment($paymentdata);

			unset($_SESSION['profdoc']);
		
		// Add fields to paypal form
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name_1', 'Foreign Professional Review for online Licensure Examination');
		$this->paypal_lib->add_field('item_number_1',  $lastpaymentid);
		$this->paypal_lib->add_field('amount_1',  $post['total']);		
		$this->paypal_lib->add_field('quantity_1' ,1);
		$this->paypal_lib->add_field('lc' ,'US');
		$this->paypal_lib->add_field('custom' ,'');
		$this->paypal_lib->add_field('upload' ,'1');
		$this->paypal_lib->add_field('cbt' ,'Return to The Store');
		
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();
	}

	public function paymentsuccess(){
		// Get the transaction data
		$paypalInfo = $this->input->post();
		// print_r($paypalInfo);die;
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
			'res_id'			=>	'8',
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
						//send refrence code 
						$settingarr = $this->common_model->get_setting('1');
						$userdetails = $this->profexam->fetch_user_details($getuserid->user_id);
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($userdetails->email);
						$this->email->subject('Application submitted successfully');
						$emailbody = array();
						$emailbody['name'] 			= $userdetails->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 	= $bodycontentforCode;
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
						$emailbody = array();
						$emailbody['name'] 			= $userdetails->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 	= $bodycontentforCodeemail;
						$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
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
						$this->profexam->insertnotifications($updatenotification); 
					}
 
		$prof = $this->profexam->fetch_user_details($getuserid->user_id);
		$professional = array(						
			'prof_id'  		=> $prof->user_ID,
			'prof_name'  	=> $prof->name,
			'prof_email'  	=> $prof->email,
			'prof_stepone' 	=> TRUE
		);
		$this->session->set_userdata($professional);

		$this->data = array('title'=> 'Review of Documents');
		$data['profes_details'] = $this->profexam->fetch_user_details($getuserid->user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function paymentcancel(){
		$this->data = array( 'title'  => 'Payment Cancel');
		redirect('professional/profexam/payment',$this->data);
	}

	function ipn(){
		// Paypal posts the transaction data
		$paypalInfo = $this->input->post();
		
    }

	public function review_doc($user_ID){
		if(!$this->session->userdata('prof_stepone')==TRUE){
			redirect('professional/profexam');
		}
		$this->data = array('title'=> 'Review of Documents');
		$data['profes_details'] = $this->profexam->fetch_user_details($user_ID);
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}

    // *********************** Professional Exam Start******************************* //

	public function registerexam(){
		$this->data = array(
			'title'=> 'Foreign Professional Profile & Exam Code'
		);
		$data['countries'] = $this->profexam->get_countries();
		$data['profession'] = $this->profexam->get_profession();
		$data['university'] = $this->profexam->get_university();
	
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/license_form',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function validateprof(){
		$output = array('error' => false);	
		$msg = 0;	
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Middle Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
		$this->form_validation->set_rules('examination_code', 'examination code', 'trim|required');			
		if($this->form_validation->run() == TRUE){
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$gender = $this->input->post('gender');
			$birthday = $this->input->post('birthday');
			$profession = $this->input->post('profession');
			$examination_code = $this->input->post('examination_code');
			$profdetailsarr = $this->profexam->getprofdetails($fname,$lname,$name,$email,$gender,$birthday,$profession,$examination_code);
			//$profdetailsarr = $this->profexam->getprofdetails($fname,$lname,$name,$email);
			
			//  echo json_encode(['error'=>'','msg'=>'1','graducatdetails'=>$profdetailsarr]); exit;
			$err = 0;
			if(count($profdetailsarr) > 0){
				if($profdetailsarr->fname != $fname){
					$errors = array('err' => 'First Name not match!.');
					$err = 1;
				}else if($profdetailsarr->lname != $lname){
					$errors = array('err' => 'Middle Name not match!.');
					$err = 1;
				}else if($profdetailsarr->name != $name){
					$errors = array('err' => 'Last Name not match!.');
					$err = 1;
				}else if($profdetailsarr->gender != $gender){
					$errors = array('err' => 'Gender not match!.');
					$err = 1;
				}else if($profdetailsarr->dob != $birthday){
					$errors = array('err' => 'BirthDay not match!.');
					$err = 1;
				}else if($profdetailsarr->profession != $profession){
					$errors = array('err' => 'Profession not match!.');
					$err = 1;
				}else if($profdetailsarr->exam_code != $examination_code){
					$errors = array('err' => 'Examination Code not match!.');
					$err = 1;
				}
				if($err == 1){
					$result['error'] = $errors;
					$result['success'] = false;
					$result['msg'] = '0';
				}else{
					$profdetailss = array(						
						'profexam_id'  		=> $profdetailsarr->user_ID,
						'profexam_name'  	=> $profdetailsarr->name,
						'profexam_email'  	=> $profdetailsarr->email,
						'profexam_stepone' 	=> TRUE
					);
					$this->session->set_userdata($profdetailss);
					$result['success'] = true;
					$result['msg'] = '1';
					$result['profdetails'] = $profdetailsarr;
				}
			}else{
				$errors = array('err' => 'This Email is not registered in our system.');
				$result['error'] = $errors;
				$result['success'] = false;
				$result['msg'] = '0';
			}
			// echo json_encode(['error'=>'','msg'=>'1','graducatdetails'=>$profdetailsarr]); exit;
		}else{
			$errors = array(
				'fname' => form_error('fname', '<p class="mt-3 text-danger">', '</p>'),
				'lname' => form_error('lname', '<p class="mt-3 text-danger">', '</p>'),
				'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
				'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
				'gender' => form_error('gender', '<p class="mt-3 text-danger">', '</p>'),
				'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
				'profession' => form_error('profession', '<p class="mt-3 text-danger">', '</p>'),
				'examination_code' => form_error('examination_code', '<p class="mt-3 text-danger">', '</p>'),
			);
			$result['error'] = $errors;
			$result['success'] = False;
			$result['msg'] = '0';
		}

		echo json_encode($result); exit;
	}
	

	public function book_exam(){
		$this->check_profexam_session();
		$this->data = array(
			'title'=> 'Licensure Examination Schedule',
			'page_title'=> 'Booking for Online Licensure Examination'
			);
		$uid = $this->session->userdata('profexam_id');
		$this->data['booking_status'] = $this->common_model->is_pexam_booked($uid);
		if(isset($this->data['booking_status']) && $this->data['booking_status']->payment=='1'){
			$booked = $this->data['booking_status']->be_id;
			$examination_booked_id['book_exam_id'] = $booked;
			$this->session->set_userdata($examination_booked_id);
			redirect('professional/applicant/exam_code/'.base64_encode($uid)); die(); 
		}
		$this->data['schedule'] = $this->profexam->get_examination_schedule();
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/book_exam_slot',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function book_exam_date(){
		$id = $this->input->post('id');
		$uid = $this->input->post('uid');
		$post = $this->input->post();
		$check = $this->profexam->already_booked_exam($post);
		if($check==true){
			$result['error'] = '2';
			$result['msg'] = 'User Already Booked this exam!';
		}else{

		$booked = $this->profexam->add_exam_date($post);
		if($booked==true){
			$examination_booked_id['book_exam_id'] = $booked;
			$this->session->set_userdata($examination_booked_id);
			$examschld=$this->db->where('es_id',$id)->get('tbl_examination_schedule')->row_array();
			$result['date'] = date('F d,Y',strtotime($examschld['date']));
			$result['start_time'] = date('H:i A',strtotime($examschld['start_time']));
			$result['end_time'] = date('H:i A',strtotime($examschld['end_time']));
			$result['venue'] = $examschld['venue'];
			$result['last_id'] 	= $booked;
			$result['error'] 	= '0';
			$result['msg'] 		= 'Your exam schedule is <br>';
		}else{
			$result['error'] 	= '1';
			$result['msg'] 		= 'Something went wrong, Please try again!';
		}
		}
		echo json_encode($result);	
	}

	public function exam_payment(){
		$this->check_profexam_session();
		$this->data = array('title'=> 'Payment');
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/exam_payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function getprice(){
		$chargeid = $_POST['chargeid'];
		$charges_for = $_POST['charges_for'];
		$data['chargesarr'] = $this->common_model->getcharges($chargeid,$charges_for);
		$charge = $data['chargesarr']->charge; 
		// $tax = $data['chargesarr']->tax; 
		$settingarr = $this->common_model->get_setting('1');
		$tax = $settingarr->tax;
		$tax_amount = $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}

	// Exam Payment Start
	function exam_paypal_payment(){
		$post = $this->input->post();
		if($post['submit'] == "paynow"){
			$this->form_validation->set_rules('amount', 'amount', 'trim|required');
				if($this->form_validation->run() == TRUE){
					// Set variables for paypal form
		$returnURL = base_url().'professional/profexam/exam_paymentsuccess'; //payment success url
		$cancelURL = base_url().'professional/profexam/exam_paymentcancel'; //payment cancel url
		$notifyURL = base_url().'professional/profexam/exam_ipn'; //ipn url
			
			// Get product data from the database
			$user = $this->profexam->getRows($post['uid']);
			
			// Get current user ID from the session
			$userID = $user->user_ID; 
			$paymentdata 					= array();
			$paymentdata['user_id'] 		= $userID;
			$paymentdata['doc_refrence_id'] = $this->session->userdata('book_exam_id');
			$paymentdata['txn_id'] 			= '';
			$paymentdata['payment_amout'] 	= $post['amount'];
			$paymentdata['payment_tax'] 	= $post['taxamt'];
			$paymentdata['payment_gross'] 	= $post['total'];			
			$paymentdata['payer_email'] 	= '';
			$paymentdata['payment_status'] 	= '';
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'PP';
			$paymentdata['payment_type'] 	= 'E';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			// Add fields to paypal form
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name_1', 'Booking for online licensure examination (foreign professionals)');
			$this->paypal_lib->add_field('item_number_1', $lastpaymentid);
			$this->paypal_lib->add_field('amount_1',  $post['total']);
			$this->paypal_lib->add_field('quantity_1' ,1);
			$this->paypal_lib->add_field('lc' ,'US');
			$this->paypal_lib->add_field('custom', $userID);
			$this->paypal_lib->add_field('upload' ,'1');
			$this->paypal_lib->add_field('cbt' ,'Return to The Store');
			// $this->paypal_lib->add_field('tax',  $post['taxamt']);
			
			// Render paypal form
			$this->paypal_lib->paypal_auto_form();
			
				}else{
					$this->data = array('title'=> 'Examination Payment','page_title'=> 'Booking for Online Licensure Examination');
					$data['details'] = array();
					$this->load->view('include/header',$this->data);
					$this->load->view('profexam/exam_payment',$data);
					$this->load->view('include/footer',$this->data);
				}
	
		}
	}

	function exam_paymentsuccess(){
		// Get the transaction data
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
		
		$updateexam = array('payment'=>'1');
		$upexam = $this->profexam->update_book_exam($updateexam,$this->session->userdata('book_exam_id'));
		$getuserid = $this->common_model->getuserids($item_number);		

		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'6',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);
		
		$this->session->sess_destroy();
		
		$profdetailsarr = $this->profexam->fetch_user_details($getuserid->user_id);
		$profdetailss = array(						
			'profexam_id'  		=> $profdetailsarr->user_ID,
			'profexam_name'  	=> $profdetailsarr->name,
			'profexam_email'  	=> $profdetailsarr->email,
			'profexam_stepone' 	=> TRUE
		);
		$this->session->set_userdata($profdetailss);
		
			// Genrate PDF start
			$this->getexampasspdf($profdetailsarr->user_ID);
			// Get output html
			$html = $this->output->get_output();
			$this->load->library('Pdf');
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper('letter','portrait');
			$this->dompdf->render();
			
			file_put_contents('assets/uploads/pdf/'.$profdetailsarr->exam_code.'.pdf', $this->dompdf->output($html));
			
			// $this->dompdf->stream("school.pdf",array('Attachment'=>0)); die;
			// Genrate PDF End
			
		$userid = $getuserid->user_id;
		$userdetails = $this->profexam->fetch_user_details($getuserid->user_id);
		$search_link = '<a href="'.base_url('license/search').'">Click here</a>';
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br>
		<br>Your Exam has been booked successfully.<br><br>In this regard, 
		you can use your Refrence Code : '.$userdetails->refrence_code.' to learn the Guidline and get the EXAM PASS.<br>
		Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass. .<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
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
				$this->email->subject('Exam booked successfully.');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				if(isset($profdetailsarr->exam_code) && file_exists('assets/uploads/pdf/'.$profdetailsarr->exam_code.'.pdf')){
					$this->email->attach(base_url('assets/uploads/pdf/'.$profdetailsarr->exam_code.'.pdf'));
					}
				$this->email->send();

				//2ns email
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
				$emailbody['body_msg'] 	= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				//end send refrence code 
				$updatenotification 				= array();
				$updatenotification['user_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Exam booked successfully';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->profexam->insertnotifications($updatenotification); 
			// }
			}

		redirect('professional/profexam/guidelines/'.base64_encode($userid));
		// $this->data = array('title'=> 'Examination Guidelines and Information','page_title'=> 'Booking for Online Licensure Examination');
		// $this->data['lesson'] = $this->profexam->get_guidlines();
		// $this->load->view('include/header',$this->data);
		// $this->load->view('profexam/guidelines',$this->data);
		// $this->load->view('include/footer',$this->data);
	}

	function exam_paymentcancel(){
		$this->data = array( 'title'  => 'Payment Cancel','page_title'=> 'Booking for Online Licensure Examination');
		redirect('professional/profexam/payment',$this->data);
	}	

	function exam_ipn(){

	}
	
	// Exam Payment End

	public function guidelines($uid){
		// $this->check_profexam_session();
		$this->data = array('title'=> 'Examination Guidlines and Information');
		$uid = $this->session->userdata('profexam_id');
		$data['profes_details'] = $this->profexam->fetch_user_details(base64_decode($uid));
		$data['lesson'] = $this->profexam->get_result_object('tbl_guidline','status',1);
		$data['heading'] = $this->profexam->get_heading();
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/guidelines',$data);
		$this->load->view('include/footer');
	}

	// public function exam_pass(){
	// 	$this->check_profexam_session();
	// 	$this->data = array('title'=> 'Exam Pass');
	// 	$uid = $this->session->userdata('profexam_id');
	// 	$this->data['profes_details'] = $this->profexam->fetch_user_details(base64_decode($uid));
	// 	$this->load->view('include/header',$this->data);
	// 	$this->load->view('profexam/exam_pass',$this->data);
	// 	$this->load->view('include/footer',$this->data);
	// }

	public function exam_result($uid){
		$this->check_profexam_session();
		$this->data = array('title'=> 'Examination Result','page_title'=> 'Examination Result');
		$this->data['result'] = $this->profexam->graduateresult(base64_decode($uid));
		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/exam_result',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function eligibility($uid){
		$this->check_profexam_session();
		$this->data['title']= 'Eligibility Certificate';
		$this->data['page_title']= 'Eligibility Certificate';
		$this->data['profes_details'] = $this->profexam->fetch_user_details(base64_decode($uid));

		$this->load->view('include/header',$this->data);
		$this->load->view('profexam/eligibility',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function getexampasspdf($uid)
	{
		$data['profes_details'] = $this->profexam->fetch_user_details($uid);
		$data['exam_details']   = $this->common_model->is_pexam_booked($uid);
		$this->load->view('professional/include/profexam_pass_preview',$data);
	}
	

}

?>