<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** Reviewer Login controller **/

class Reviewer extends MX_Controller {

	var $data = array();

	public function __construct(){
		parent:: __construct();
		$this->load->model('Reviewer_payment_model','reviewer_payment');
		// $this->check_session();
	}

	public function index(){
		echo'Dashboard';
	}

	public function dashboard(){
		$this->data = array(
			'title' => 'Govt : Reviewer Dashboard'
		);
		//echo $this->session->userdata('user_ID'); exit;
		//echo $this->session->userdata('login')['user_ID'];
		//echo $this->session->userdata('login')['user_ID']; exit;
		//print_r($_SESSION); exit;
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar',$this->data);
		$this->load->view('reviewer/dashboard',$this->data);
		$this->load->view('reviewer/common/footer',$this->data);
	}


	public function check_session(){
		$user_ID = $this->session->userdata('login')['user_ID'];
		if($user_ID){
			redirect('reviewer/reviewer/dashboard');
		}
	}

	public function onlineApplication_listing(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Govt : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		);
		
		$group_by = 't1.user_id';
		$where = '';
		$join = array('t5'=>'tbl_existing_certificate');
		$this->data['payment_details'] = $this->reviewer_payment->get_payment_details($where,$join,$group_by);
		$this->data['all_row_count'] = $this->reviewer_payment->get_payment_detail_row_count('','',$group_by);

		
		/************************************ Approved *********************************************/
		

		$this->data['approved_details'] = $this->reviewer_payment->approved_certificate();
		$this->data['approved_row_count'] = $this->reviewer_payment->get_payment_approved_row_count();
		/************************************* End Approved ****************************************/


		/************************************ PENDING *********************************************/
		
		
		$this->data['pending_details'] = $this->reviewer_payment->pending_certificate();
		$this->data['pending_row_count'] = $this->reviewer_payment->get_payment_pending_row_count();
		/************************************* END PENDING ****************************************/


		/******************************** CE-PROVIDER DATA ***********************************/
		$ce_where = array('t2.payment_type_id'=>2);

		$this->data['ce_provider_payment_details'] = $this->reviewer_payment->get_ce_provider_payment_details($ce_where);
		$this->data['ce_provider_all_row_count'] = $this->reviewer_payment->get_ce_provider_payment_detail_row_count($ce_where);	

		/******************************** END CE-PROVIDER DATA *******************************/

		/******************************** Start Professional DATA *******************************/
		$this->data['foreign_application'] = $this->reviewer_payment->get_foreign_applcaition();	
		$this->data['foreign_application_count'] = $this->reviewer_payment->get_foreign_applcaition_count();

		/******************************** Start Online Course DATA *******************************/
		$this->data['online_course_application'] = $this->reviewer_payment->get_online_course_applcaition();	
		$this->data['online_course_application_count'] = $this->reviewer_payment->get_online_course_applcaition_count();
		$this->data['university'] = $this->reviewer_payment->university_listing();
		$this->data['graduates'] = $this->reviewer_payment->graduates_listing();


		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/listing',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function universitylisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'University Listing',
			'page_title' => 'University Listing',
			'table_name' => 'University Listing'
		);
		$this->data['university'] = $this->reviewer_payment->university_listing();
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/universitylisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function universityassignedreviewer()
	{
		//print_r($_POST);
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] =  $reviewer_id;
		$assingrev['review_accept_date'] =  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->univassignedreviewerupdate($assingrev,$appid);
		echo  $appid; exit;
	}
	public function unversitydetails($id=null){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		if($this->input->post('uniid') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('uniid', 'university id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['uniid'] 			= $this->input->post('uniid');
				$univsitdata['unidoc_id'] 		= $this->input->post('unidoc_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertuniversityreview($univsitdata);
				if($insrtcommert){
					$datastatus = array();
					$datastatus['reviewer_status'] = $this->input->post('status');
					$this->reviewer_payment->updateunversitydocreviewstatus($datastatus,$this->input->post('unidoc_id'));
					$unvdetls = $this->reviewer_payment->universitydetails($this->input->post('uniid'));
					//print_r($unvdetls); exit;
					///start mail function
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
						}
						$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$unvdetls->email.'<br>Password: '.$unvdetls->university_password.'</p>';
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your university details has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p><br>'.$logindetails;
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
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($unvdetls->email);
						$this->email->subject('University review');
						$emailbody 					= array();
						$emailbody['name'] 			= $unvdetls->name_of_representative;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= 'RBoard Reviewer';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
					///end mail function 
					
					redirect('reviewer/reviewer/universitylisting', true);
				}
			}else{
				$id = $this->input->post('uniid');
				validation_errors();
			}
		}
		$this->data = array(
			'title' => 'Govt : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		); 
		$this->data['universitydetails'] = $this->reviewer_payment->universitydetails($id);
		$this->data['universityreviewdatails'] = $this->reviewer_payment->universityreviewdatails($id);
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/universitydetails',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function professionallisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Professional Listing',
			'page_title' => 'Professional Listing',
			'table_name' => 'Professional Listing'
		);
		$this->data['foreign_application'] = $this->reviewer_payment->get_foreign_applcaition();	
		$this->data['foreign_application_count'] = $this->reviewer_payment->get_foreign_applcaition_count();
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/professionallisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function professionallicense(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Professional License',
			'page_title' => 'Professional License',
			'table_name' => 'Professional License'
		);
		$group_by = 't1.user_id';
		$where = '';
		$join = array('t5'=>'tbl_existing_certificate');
		$this->data['payment_details'] = $this->reviewer_payment->get_payment_details($where,$join,$group_by);
		$this->data['all_row_count'] = $this->reviewer_payment->get_payment_detail_row_count('','',$group_by);
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/professionallicense',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function provideraccreditation(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Provider Accreditation',
			'page_title' => 'Provider Accreditation',
			'table_name' => 'Provider Accreditation'
		);
		$ce_where = array('t2.payment_type_id'=>2);

		$this->data['ce_provider_payment_details'] = $this->reviewer_payment->get_ce_provider_payment_details($ce_where);
		$this->data['ce_provider_all_row_count'] = $this->reviewer_payment->get_ce_provider_payment_detail_row_count($ce_where);	
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/provideraccreditation',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function onlinecourse(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Online Course Accreditation',
			'page_title' => 'Online Course Accreditation',
			'table_name' => 'Online Course Accreditation'
		);
		$ce_where = array('t2.payment_type_id'=>2);

		$this->data['online_course_application'] = $this->reviewer_payment->get_online_course_applcaition();	
		$this->data['online_course_application_count'] = $this->reviewer_payment->get_online_course_applcaition_count();	
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/onlinecourse',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function graduateslisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Graduates Listing',
			'page_title' => 'Graduates Listing',
			'table_name' => 'Graduates Listing'
		);
		$ce_where = array('t2.payment_type_id'=>2);

		$this->data['graduates'] = $this->reviewer_payment->graduates_listing();
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/graduateslisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	
	public function graduatedetails($id=null){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		if($this->input->post('grad_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('grad_id', 'university id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['grad_id'] 		= $this->input->post('grad_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertuniversityreview($univsitdata);
				if($insrtcommert){
					$datastatus = array();
					$datastatus['reviewer_status'] = $this->input->post('status');
					$this->reviewer_payment->updateunversityreviewstatus($datastatus,$this->input->post('grad_id'));
					$unvdetls = $this->reviewer_payment->universitydetails($this->input->post('grad_id'));
					///start mail function
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
						}
						$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$unvdetls->email.'<br>Password: '.$unvdetls->university_password.'</p>';
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your university details has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p><br>'.$logindetails;
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
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($unvdetls->email);
						$this->email->subject('University review');
						$emailbody 					= array();
						$emailbody['name'] 			= $unvdetls->name_of_representative;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= 'RBoard Reviewer';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
					///end mail function 
					
					redirect('reviewer/reviewer/onlineApplication_listing', true);
				}
			}else{
				$id = $this->input->post('uniid');
				validation_errors();
			}
		}
		$this->data = array(
			'title' => 'Govt : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		);
		$this->data['graduatedetails'] = $this->reviewer_payment->graduates_details($id);
		$this->data['graduatereviewdatails'] = $this->reviewer_payment->universityreviewdatails($id);
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/graduatedetails',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function reviewer_accept()
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$reviewer_id = $this->input->post('reviewer_id');
		$certificate_id = $this->input->post('certificate_id');

		$data = array(

			'reviewer_id' =>  $reviewer_id
		);

		$this->reviewer_payment->update('tbl_user_certificate',$data,'id',$certificate_id);
	}
	public function reviewer_accept_ce_provider()
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$reviewer_id = $this->input->post('reviewer_id');
		$provider_id = $this->input->post('provider_id');
		//$password = $this->randomPassword();
		
		//echo "<pre>"; print_r($_SESSION); exit;
		$data = array(

			'reviewer_id' =>  $reviewer_id,
			//'status' => 1,
			//'password' => $password
		);

		$affected_row = $this->reviewer_payment->update('tbl_ce_provider',$data,'provider_id',$provider_id);

		//echo "ssssssssssssssss".$affected_row; exit;
		if($affected_row){
				$this->data['payment_success'] = "success";
		//$where = array('t1.provider_id'=>$provider_id);
		//$user_details = $this->reviewer_payment->get_ce_provider_payment_details($where);
		
		//print_r(expression)	

		/*if(!empty($user_details)){

			$this->load->library('email');
			$to = $user_details[0]['email'];
			$this->email->from("pradeepsingh123786@gmail.com");
			$this->email->to($to);
			$this->email->subject("Applications Accepted");
			$this->email->message("Email :- ".$user_details[0]['email']."
				Password :- ".$user_details[0]['password']);

			if ($this->email->send()) {
			echo 'Your Email has successfully been sent.';
			} else {
			echo show_error($this->email->print_debugger());
			}
			$this->data['payment_success'] = "success";
		}*/
		}


	}
	public function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	public function professionalassignedreviewer()
	{
		//print_r($_POST);
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] 			=  $reviewer_id;
		$assingrev['review_accept_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->profesassignedreviewerupdate($assingrev,$appid);
		echo  $appid; exit;
	}

	public function courseassignedreviewer()
	{	
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		print_r($this->input->post());die;
		$assincou = array();
		$assincou['reviewer_id'] 			=  $reviewer_id;
		$assincou['review_accept_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->courseassignedreviewerupdate($assincou,$appid);
		echo  $this->db->last_query(); exit;
		// echo  $appid; exit;
	}
	
	public function graduateassignedreviewer() 
	{
		//print_r($_POST);
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] =  $reviewer_id;
		$assingrev['reviewer_accept_date'] =  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->graducateassignedreviewerupdate($assingrev,$appid);
		echo  $appid; exit;
	}
	// public function reviewer_took_fapp($appid,$reviewer_id)
	// {
	// 	// $appid = $this->input->post('appid');
	// 	// $reviewer_id = $this->input->post('reviewer_id');

	// 	$data['reviewer_id'] =  $reviewer_id;
	// 	$result = $this->reviewer_payment->update('tbl_users',$data,'user_ID',$appid);
	// 	return $appid;
	// }

	public function verify_document($appid=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'View Documents'
		);
		
		if($this->input->post('prof_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('prof_id', 'professional id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['prof_id'] 		= $this->input->post('prof_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertprofessionalreview($univsitdata);
				if($insrtcommert){
					$professdatails = $this->reviewer_payment->getprofessionaldetails($this->input->post('prof_id'));
					$passwordnew = $professdatails->user_ID.date('YmdHis');
					
					$datastatus = array();
					$datastatus['password']  	= password_hash($passwordnew,PASSWORD_DEFAULT);
					$datastatus['reviewer_status'] = $this->input->post('status');
					$this->reviewer_payment->professionalreviewstatus($datastatus,$this->input->post('prof_id'));
					
					///start mail function
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
						}
						$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$professdatails->email.'<br>Password: '.$passwordnew.'</p>';
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your professional details has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p><br>'.$logindetails;
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
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($professdatails->email);
						$this->email->subject('Professional details review');
						$emailbody 					= array();
						$emailbody['name'] 			= $professdatails->name;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= 'RBoard Reviewer';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
					///end mail function 
					
					redirect('reviewer/reviewer/onlineApplication_listing', true);
				}
			}else{
				$appid = $this->input->post('prof_id');
				validation_errors();
			}
		}
		$this->data['professreviewdatails'] = $this->reviewer_payment->professionlareviewdatails($appid);
		$this->data['application'] = $this->reviewer_payment->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_payment->get_row_object('tbl_professional_documents','user_id',$appid);
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/verify',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function document_approval(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$user_ID = $this->session->userdata('login')['user_ID'];
		$post = $this->input->post();
		$result = $this->reviewer_payment->change_doc_status($post);
		if($result > 0){
			$this->reviewer_took_fapp($post['id'],$post['reviewer_id']);
			echo "<script>alert('Status changed successfully.');
			window.location.href='onlineApplication_listing';</script>"; 
			// $this->session->set_flashdata('message','Status changed successfully.');
		}else{
			$this->session->set_flashdata('message','Something went wrong please try again!');
			redirect('reviewer/reviewer/onlineApplication_listing');
		}

	}
	public function cep_details($id=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		}



		if($this->input->post('Submit')=='Submit'){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comments'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['user_id'] 			= $id;
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['added_on'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->save('tbl_cep_comments',$univsitdata);

				//echo $insrtcommert; exit;

				if($insrtcommert){
					$datastatus = array();
					$datastatus['status'] = $this->input->post('status');
					$datastatus['password'] = $this->randomPassword();
					$this->reviewer_payment->update('tbl_ce_provider',$datastatus,'provider_id',$id);
					$cep_details = $this->reviewer_payment->get_cep_details($id);
					///start mail function
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
						}
						$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$cep_details->email.'<br>Password: '.$cep_details->password.'</p>';
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your application has been reviewed .<br><strong>Status: </strong>'.$curstatus.'</p><br>'.$logindetails;
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
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($cep_details->email);
						$this->email->subject('CEP PROVIDER');
						$emailbody 					= array();
						$emailbody['name'] 			= '';//$unvdetls->name_of_representative;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= 'RBoard Reviewer';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
						
					///end mail function 
					
					redirect('reviewer/reviewer/onlineApplication_listing', true);
				}
			}else{
				//$id = $this->input->post('uniid');
				validation_errors();
			}
		}





		$this->data = array(
			'title' => 'Govt : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		);

		

		$this->data['cep_details'] = $this->reviewer_payment->get_cep_details($id);

		//$this->data['ce_provider_all_row_count'] = $this->reviewer_payment->get_ce_provider_payment_detail_row_count($ce_where);

		//echo "<pre>"; print_r($this->data); exit;

		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/cep_details',$this->data);
		$this->load->view('reviewer/common/footer');
	}

}

?>