<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graduates extends MX_Controller {

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
	var $data = array();
	//var $tbl_user_certificate  = 'tbl_user_certificate';

	public function __construct(){
		parent::__construct();
		//$this->load->model('Landing_model','landing');
		$this->load->model('graduates_model');	
		$this->load->library('upload');
		$this->load->library('Variablebilling'); 
		$this->load->library('paypal_lib');
		$this->load->library('ciqrcode');
		
		$subscription = $this->common_model->get_admin_subscription_details();
		if($subscription->rb_sub_key == ""){
			//go to contcat for admin with form details
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
	}
	public function index(){
		//echo 'sdf'; exit;
		$this->data = array(
			'title'=> 'Graduate profile and code',
			'page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)'
		);
		$this->load->view('include/header',$this->data);
		$this->load->view('graduates_form',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function graduatestep(){
		$output = array('error' => false);	
		$msg = 0;	
		//echo '<pre>'; print_r($_POST); exit;
		//if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('birthday', 'birthday', 'trim|required');
			//$this->form_validation->set_rules('gender', 'gender', 'required');
			$this->form_validation->set_rules('examination_code', 'examination code', 'trim|required');			
			//$this->form_validation->set_rules('college_logo', 'college logo', 'required');
			if($this->form_validation->run() == TRUE){
				$graducatedetailsarr = $this->graduates_model->getgraducatedetails($this->input->post('name'),$this->input->post('middle_name'),$this->input->post('surname'),$this->input->post('email'),$this->input->post('birthday'),$this->input->post('gender'),$this->input->post('examination_code'));
				$graducatedata = array(						
					'grad_id'  			=> $graducatedetailsarr[0]->grad_id,
					'graduate_name'  	=> $graducatedetailsarr[0]->student_name,
					'graduate_email'  	=> $graducatedetailsarr[0]->email,
					'graduate_stepone' 	=> TRUE
				);
				$this->session->set_userdata($graducatedata);
				echo json_encode(['error'=>'','msg'=>'1','graducatdetails'=>$graducatedetailsarr]); exit;
			}else{
				//validation_errors();
				$errors = array(
					'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
					'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
					'examination_code' => form_error('examination_code', '<p class="mt-3 text-danger">', '</p>'),
				);
				//$errors = validation_errors();
				echo json_encode(['error'=>$errors,'msg'=>'0']); exit;
			}
		//}		
	}
	
	public function book_exam($id=false){
		if($this->session->userdata('graduate_stepone')==''){
				redirect(base_url('graduates/graduates/index'), 'refresh');
		}
		$this->data = array(
			'title'=> 'Licensure Examination Schedule',
			'page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)'
			);
		$this->data['schedule'] = $this->graduates_model->get_examination_schedule();
		$this->load->view('include/header',$this->data);
		$this->load->view('book_exam',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function book_exam_date(){
		$id = $this->input->post('id');
		$uid = $this->input->post('uid');
		$post = $this->input->post();
		$check = $this->graduates_model->already_booked_exam($post);
		if($check==true){
			$result['error'] = '2';
			$result['msg'] = 'User Already Booked this exam!';
		}else{
			$booked = $this->graduates_model->add_exam_date($post);
			if($booked==true){

			$examination_booked_id['book_exam_id'] = $booked;
			$this->session->set_userdata($examination_booked_id);
			$examschld=$this->db->where('es_id',$id)->get('tbl_examination_schedule')->row_array();
				$result['date'] = date('F d,Y',strtotime($examschld['date']));
				$result['start_time'] = date('H:i A',strtotime($examschld['start_time']));
				$result['end_time'] = date('H:i A',strtotime($examschld['end_time']));
				$result['venue'] = $examschld['venue'];
				$result['last_id'] = $booked;
				$result['error'] = '0';
				$result['msg'] = 'Your exam schedule is <br>';
			}else{
				$result['error'] = '1';
				$result['msg'] = 'Something went wrong, Please try again!';
			}
		}
		echo json_encode($result);	
	}


	function getprice(){
		$chargeid = $_POST['chargeid'];
		$charges_for = $_POST['charges_for'];
		$data['chargesarr'] = $this->common_model->getcharges($chargeid,$charges_for);
		$charge = $data['chargesarr']->charge; 
		$settingarr = $this->common_model->get_setting('1');
		$tax = $settingarr->tax;
		$tax_amount = $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}

	public function exam_payment($grad_id=false){
		if($this->session->userdata('graduate_stepone')==''){
				redirect(base_url('graduates/graduates/index'), 'refresh');
		}
		$this->data = array(
			'title'=> 'Exam Payment',
			'page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)'
		);
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	// public function paymentsucess(){
	// 	$this->data = array('title'=> 'Payment Success');
	// 	/* if(!$this->session->userdata('university_stepone')){
	// 		redirect(base_url('university/university/index'), 'refresh');
	// 	} */
	// 	//echo '<pre>'; print_r($_POST); exit;
	// 	if($_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
	// 		$gdetails = $this->graduates_model->graduatedetails($_POST['item_number']);
			
	// 		$paymentdata 					= array();
	// 		$paymentdata['user_id'] 		= $_POST['item_number'];
	// 		$paymentdata['txn_id'] 			= $_POST['txn_id'];
	// 		$paymentdata['payment_gross'] 	= $_POST['payment_gross'];
	// 		$paymentdata['payer_email'] 	= $_POST['payer_email'];
	// 		$paymentdata['payment_status'] 	= $_POST['payment_status'];
	// 		$paymentdata['currency_code'] 	= 'USD';
	// 		$paymentdata['payment_for'] 	= 'G';
	// 		$paymentdata['payment_type'] 	= 'N';
	// 		$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
	// 		$inserted = $this->graduates_model->insert_payment($paymentdata);
	// 		if($inserted >0){
	// 			$bytes 		= random_bytes(5); 
	// 			$refcode 	= bin2hex($bytes);
	// 			$refcodearr = array();
	// 			$refcodearr['refrence_code'] = 'GRA-'.$gdetails->grad_id.$refcode.'-'.date('Y');
	// 			$updaterefencecode = $this->graduates_model->updategraduate($refcodearr,$_POST['item_number']);
	// 			//echo '<p>Payment success</p>';
	// 			$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your payment for course exam is successfully done.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$refcode.'</p>';
				
	// 			$bodycontent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your payment has been received successfully.<br><strong>Order No.: </strong>'.$inserted.'</p><br>';
	// 			$config = Array(
	// 				'protocol' => 'smtp',
	// 				'smtp_host' => SMTP_HOSTNAME,
	// 				'smtp_port' => SMTP_PORT,
	// 				'smtp_user' => SENT_EMAIL_FROM,
	// 				'smtp_pass' => SENT_EMAIL_PASSWORD,
	// 				'mailtype'  => 'html', 
	// 				'newline'   => "\r\n",
	// 				'AuthType'   => "XOAUTH2",
	// 				'charset'   => 'iso-8859-1',
					
	// 			);  
	// 			$this->load->library('email');
	// 			if($updaterefencecode){
	// 				//send refrence code 
	// 				$this->email->initialize($config);
	// 				$this->email->set_newline("\r\n");
	// 				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
	// 				$this->email->to($gdetails->email);
	// 				$this->email->subject('Account created');
	// 				$emailbody1 = array();
	// 				$emailbody1['name'] = $gdetails->student_name;
	// 				$emailbody1['thanksname'] = SENDER_NAME;
	// 				// $emailbody1['thanksname'] = $gdetails->chairman;
	// 				// $emailbody1['thanks2'] = $gdetails->qualification;
	// 				// $emailbody1['thanks3'] = $gdetails->chairposition;
	// 				$emailbody1['body_msg'] = $bodycontentforCode;
	// 				$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
	// 				//$this->email->message('Testing the email class.');
	// 				$this->email->message($emailmessage);
	// 				$this->email->send();
	// 				//end send refrence code 
	// 			}
	// 			redirect(base_url('graduates/graduates/exam_guidlines'), 'refresh');
	// 		}
	// 	}
	// 	$this->load->view('include/header',$this->data);
	// 	$this->load->view('exam_payment',$this->data);
	// 	$this->load->view('include/footer',$this->data);
	// }
	// public function paymentcancel(){
	// 	$this->data = array('title'=> 'Cancel');
	// 	// if(!$this->session->userdata('university_stepone')){
	// 	// 	redirect(base_url('university/university/index'), 'refresh');
	// 	// }
	// 	$this->load->view('include/header',$this->data);
	// 	$this->load->view('exam_payment',$this->data);
	// 	$this->load->view('include/footer',$this->data);
	// }

	// Exam Payment Start
	function paypal_payment(){
		$post = $this->input->post();
		if($post['submit'] == "paynow"){
			$this->form_validation->set_rules('amount', 'amount', 'trim|required');
				//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
				if($this->form_validation->run() == TRUE){
					// Set variables for paypal form
			$returnURL = base_url().'graduates/graduates/paymentsuccess'; //payment success url
			$cancelURL = base_url().'graduates/graduates/paymentcancel'; //payment cancel url
			$notifyURL = base_url().'graduates/graduates/ipn'; //ipn url
			
			// Get product data from the database
			$user = $this->graduates_model->getRows($post['uid']);
			// Get current user ID from the session
			$userID = $user->grad_id; 
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
			$paymentdata['payment_for'] 	= 'G';
			$paymentdata['payment_type'] 	= 'E';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			// Add fields to paypal form
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			// $this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name_1', 'Graduate Exam Booking Fee');
			$this->paypal_lib->add_field('item_number_1', $lastpaymentid);
			$this->paypal_lib->add_field('amount_1',  $post['total']);
			$this->paypal_lib->add_field('custom', $userID);		
			$this->paypal_lib->add_field('quantity_1' ,1);
			$this->paypal_lib->add_field('lc' ,'US');
			$this->paypal_lib->add_field('upload' ,'1');
			$this->paypal_lib->add_field('cbt' ,'Return to The Store');
			
			// Render paypal form
			$this->paypal_lib->paypal_auto_form();
				}else{
					$this->data = array('title'=> 'Examination Payment','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
					$data['details'] = array();
					$this->load->view('include/header',$this->data);
					$this->load->view('exam_payment',$data);
					$this->load->view('include/footer',$this->data);
				}
			
			
		}
	}

	function paymentsuccess(){
		// Get the transaction data
		$paypalInfo = $this->input->post();
		$inumber = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];		
		$this->common_model->update_payment($data,$inumber);

		$data['details']=$this->common_model->get_one_receipt_details($inumber);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$updateexam = array('payment'=>'1');
		$upexam = $this->graduates_model->update_book_exam($updateexam,$this->session->userdata('book_exam_id'));
		$getuserid = $this->common_model->getuserids($inumber);	
		
		$graducatedetailsarr = $this->graduates_model->fetch_user_details($getuserid->user_id);
		// echo '<pre>'; print_r($getuserid);die;
		$this->session->sess_destroy();
		if($upexam){
			
			//*** count appylcaition start***//
			$logs = array(
				'application_id'	=>	$getuserid->doc_refrence_id,
				'res_id'			=>	'13',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);
			//*** count appylcaition end***//
			/*generate qrcode */
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
			$html=$this->getexampasspdf($getuserid->user_id);
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
		}
		$userid = $getuserid->user_id;
		$userdetails = $this->graduates_model->fetch_user_details($getuserid->user_id);
			
			$search_link = '<a href="'.base_url('license/search').'">Click here</a>';
			$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Exam has been booked successfully.<br><br>In this regard, you can use your Refrence Code : '.$userdetails->refrence_code.' to learn the Guidline and get the EXAM PASS.<br>Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
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
				$settingarr = $this->common_model->get_setting('1');
				//send refrence code 
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Exam booked successfully.');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->student_name.' '.$userdetails->middle_name.' '.$userdetails->surname;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				if(isset($graducatedetailsarr->examcode) && file_exists('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf')){
					$this->email->attach(base_url('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf'));
					}
				$this->email->send();

				//2nd email
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment_Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->student_name.' '.$userdetails->middle_name.' '.$userdetails->surname;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				//end send refrence code 
			// }
			}

		$graducate = array(						
			'grad_id'  			=> $graducatedetailsarr->grad_id,
			'graduate_name'  	=> $graducatedetailsarr->student_name,
			'graduate_email'  	=> $graducatedetailsarr->email,
			'graduate_stepone' 	=> TRUE
		);
		$this->session->set_userdata($graducate);
		$this->data = array('title'=> 'Examination Guidelines and Information','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		
		$this->data['lesson'] = $this->graduates_model->get_guidlines();
		$this->data['heading'] = $this->graduates_model->get_heading();
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_guidline',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function paymentcancel(){
		$this->data = array( 'title'  => 'Payment Cancel','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		redirect('graduates/graduates/exam_payment',$this->data);
	}

	function ipn(){

	}

	// Exam Payment End
	public function exam_guidlines(){
		$this->data = array('title'=> 'Examination Guidelines and Information','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		
		$uid = $this->session->userdata('grad_id');
		$data['profes_details'] = $this->graduates_model->fetch_user_details($uid);
		$this->data['lesson'] = $this->graduates_model->get_guidlines();
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_guidline',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function exam_pass($uid){
		$data['profes_details'] = $this->graduates_model->fetch_user_details(base64_decode($uid));
		$data['exam_details'] = $this->common_model->is_gexam_booked(base64_decode($uid));
		$this->data = array('title'=> 'Graduates Exam Pass');
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_pass',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function exam_result($uid){
		$this->data = array('title'=> 'Examination Result','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		$this->data['result'] = $this->graduates_model->graduateresult(base64_decode($uid));
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_result',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function eligibility($uid){
		$this->data = array('title'=> 'Eligibility Certificate','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		$this->data['profes_details'] = $this->graduates_model->fetch_user_details(base64_decode($uid));

		$this->load->view('include/header',$this->data);
		$this->load->view('eligibility',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function getexampasspdf($uid)
	{
		$data['profes_details'] = $this->graduates_model->fetch_user_details($uid);
		$data['exam_details'] = $this->common_model->is_gexam_booked($uid);
		$result=$this->load->view('professional/include/gradexam_pass_preview',$data, TRUE);
		return $result;
	}
}

?>