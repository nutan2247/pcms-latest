<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MX_Controller {

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
	var $tbl_user_certificate  = 'tbl_user_certificate';

	public function __construct(){
		$this->load->model('Search_model');
		parent::__construct();
	}


	public function index(){
		
		if($this->input->post('submit')=="Submit")
		{
			$this->form_validation->set_rules('referenceNo', 'ReferenceNo', 'trim|required');

			if($this->form_validation->run() == TRUE)
			{
				$referenceNo = $this->input->post('referenceNo');
				$verifiedcourse = $this->Search_model->coursesearchbyname($referenceNo);
				if(!empty($verifiedcourse)){
					redirect(base_url('ce-provider/ce_provider/digitalaccreditation/'.base64_encode($verifiedcourse->cor_doc_id))); exit;
				}
				$verifiedtraining = $this->Search_model->trainingsearchbyname($referenceNo);
				if(!empty($verifiedtraining)){
					redirect(base_url('ce-provider/ce_provider/digitalaccreditaion_training/'.base64_encode($user_id->train_doc_id))); exit;
				}
				$refcodearr = explode('-',$referenceNo);
				if (strpos($referenceNo, '-') == false) { 
					$accrodation = substr($referenceNo,0,3);
					//school
					if($accrodation== 'SCH'){
						$user_id = $this->Search_model->universitysearch(trim($referenceNo));
						if(count($user_id) == 0){
							$this->session->set_flashdata('search_error','Record not found..');
						}
						//echo $user_id->unidoc_id; exit;
						//echo $user_id->status; exit;
						if(count($user_id) > 0 && $user_id->reviewer_status < 1){
							//countdown 30 days in pending case	
							$universitydata = array('uniid' => $user_id->uniid);
							$this->session->set_userdata($universitydata);
							redirect(base_url('university/university/verificationdocuments/'.base64_encode($user_id->unidoc_id)));
						}else if(count($user_id) > 0 && $user_id->reviewer_status == 1 && $user_id->reviewer_id > 0){
							//case of approved go to the university dashboard						
							
							redirect(base_url('university/university/digitalaccreditation/'.base64_encode($user_id->uniid)));
						}else{
							//case of rejection
							if(isset($user_id->uniid) && $user_id->uniid > 0){
								redirect(base_url('university/university/verificationdocuments/'.base64_encode($user_id->uniid)));
							}else{
								$this->session->set_flashdata('search_error','Record not found..');
								redirect(base_url('license/Search'));
							}
						}
						
					}
					//school end

					//start cep
					if($accrodation=='CEP'){
						$user_id = $this->Search_model->get_cep_accridiation_search(trim($referenceNo));
						// echo '<pre>'; print_r($user_id); exit;
						if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){
							redirect(base_url('ce-provider/ce_provider/digital_accr/'.base64_encode($user_id->reference_no)));
						}else{
							//redirect(base_url('ce-provider/ce_provider/verification_document'));
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					//end cep
					
					//start course
					if($accrodation== 'COU'){
						$user_id = $this->Search_model->get_course_accridiation_search(trim($referenceNo));
						if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){
							redirect(base_url('ce-provider/ce_provider/digitalaccreditation/'.base64_encode($user_id->cor_doc_id)));
						}else{
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					//end course
					//start training
					if($accrodation== 'TRA'){
						$user_id = $this->Search_model->get_training_accridiation_search(trim($referenceNo));
						if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){
							redirect(base_url('ce-provider/ce_provider/digitalaccreditaion_training/'.base64_encode($user_id->train_doc_id)));
						}else{
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					//end training
					// ***************************
					//start Exampass
					if($accrodation== 'EXA'){
						$user_id = $this->Search_model->get_professionalexampass_search(trim($referenceNo));

						if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){
							//Exam Code						
							redirect(base_url('professional/applicant/exam_code/'.base64_encode($user_id->user_id)), 'refresh'); 
						}
						
						if($user_id == ''){
							$user_id = $this->Search_model->get_graduateexampass_search(trim($referenceNo));
							// print_r($user_id);die;
							if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){
								redirect(base_url('graduates/graduates/exam_pass/'.base64_encode($user_id->user_id)), 'refresh'); 
							}else{
								$this->session->set_flashdata('search_error','Record not found..');
								redirect(base_url('license/Search'));
							}
						}
					}
					//end Exampass
					// *****************************
					//start Licenseno
					if($accrodation== 'LIC'){
						$licuser_id = $this->Search_model->get_licenseno_search(trim($referenceNo));
						
						if(isset($licuser_id->user_id) > 0 && $licuser_id->payment_status > 0){
							redirect(base_url('professional/applicant/license_cert_card/'.base64_encode($licuser_id->user_id)), 'refresh');
						}else{
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					
				}else{
					//search refrence no. 
					if($refcodearr[0]== 'UNI'){
					$user_id = $this->Search_model->universitysearch($referenceNo);
					if(count($user_id) == 0){
						$this->session->set_flashdata('search_error','Record not found..');
					}
					//echo $user_id->unidoc_id; exit;
					//echo $user_id->status; exit;
					if(count($user_id) > 0 && $user_id->reviewer_status < 1){
						
						//countdown 30 days in pending case	
						$universitydata = array('uniid' => $user_id->uniid);
						$this->session->set_userdata($universitydata);
						redirect(base_url('university/university/verificationdocuments/'.base64_encode($user_id->unidoc_id)));
					}
					else if(count($user_id) > 0 && $user_id->reviewer_status == 1 && $user_id->reviewer_id > 0){
						//print_r($user_id);exit;
						//case of approved go to the university dashboard						
						/* $universitydata = array(
							'uniid'  			=> $user_id->uniid,
							'university_name'  	=> $user_id->university_name,
							'college_of' 		=> $user_id->college_of,
							'email'				=> $user_id->email,
							'contact_no'		=> $user_id->contact_no,
							'university_logged_in' 	=> TRUE
						);
						//print_r($_SESSION); exit;
						//echo $loginuser->username;
						$this->session->set_userdata($universitydata); */
						redirect(base_url('university/university/acceptnotification/'.base64_encode($user_id->uniid)));
						//redirect(base_url('university/university/digitalaccreditation/'.base64_encode($user_id->uniid)));
					}else if(count($user_id) > 0 && $user_id->reviewer_status == 2 && $user_id->reviewer_id > 0){
						redirect(base_url('university/university/rejectnotification/'.base64_encode($user_id->uniid)));
					}else{
						//case of rejection
						if(count($user_id) > 0 && $user_id->uniid > 0){
							redirect(base_url('university/university/verificationdocuments/'.base64_encode($user_id->uniid)));
						}else{
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					
				}
				else if($refcodearr[0]== 'COU'){
					$user_id = $this->Search_model->coursesearch($referenceNo);
					if(count($user_id) == 0){
						$this->session->set_flashdata('search_error','Record not found..');
					}
					if(count($user_id) > 0 && $user_id->reviewer_status < 1){
						//countdown 30 days in pending case						
						redirect(base_url('ce-provider/ce_provider/reviewcourse/'.base64_encode($user_id->cor_doc_id)));
					}
					else if(count($user_id) > 0 && $user_id->reviewer_status == 1 && $user_id->reviewer_id > 0){
						redirect(base_url('ce-provider/ce_provider/digitalaccreditation/'.base64_encode($user_id->cor_doc_id)));
					}else{
						//case of rejection
						if(count($user_id) > 0 && $user_id->id > 0){
							redirect(base_url('ce-provider/ce_provider/reviewcourse/'.base64_encode($user_id->cor_doc_id)));
						}else{
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					
				}
				else if($refcodearr[0]== 'TRA'){
					$user_id = $this->Search_model->trainingsearch($referenceNo);
					if(count($user_id) == 0){
						$this->session->set_flashdata('search_error','Record not found..');
					}
					if(count($user_id) > 0 && $user_id->reviewer_status < 1){
						//countdown 30 days in pending case						
						redirect(base_url('ce-provider/ce_provider/reviewtraining/'.base64_encode($user_id->train_doc_id)));
					}
					else if(count($user_id) > 0 && $user_id->reviewer_status == 1 && $user_id->reviewer_id > 0){
						redirect(base_url('ce-provider/ce_provider/digitalaccreditaion_training/'.base64_encode($user_id->train_doc_id)));
					}else{
						//case of rejection
						if(count($user_id) > 0 && $user_id->id > 0){
							redirect(base_url('ce-provider/ce_provider/reviewtraining/'.base64_encode($user_id->train_doc_id)));
						}else{
							$this->session->set_flashdata('search_error','Record not found..');
							redirect(base_url('license/Search'));
						}
					}
					
				}else if($refcodearr[0]== 'PRO'){
					$user_id = $this->Search_model->profesinalsearch($referenceNo);
					// print_r($user_id);exit;
				if($user_id != ''){
					if(count($user_id) > 0 && $user_id->reviewer_status < 1){
						//countdown 30 days in pending case						
						redirect(base_url('professional/applicant/review_doc/'.base64_encode($user_id->user_ID)));
					}else if($user_id->reviewer_status == 1 && $user_id->exam_code != ''){
						
						$isbook = $this->common_model->is_pexam_booked($user_id->user_ID);
						if($isbook){
							$exam_date = date('Y-m-d',strtotime($isbook->exam_date));
							$check_result = $this->Search_model->professionalresult($user_id->user_ID,$exam_date);
							// echo '<pre>'; echo $this->db->last_query(); die;
							if(isset($check_result) && $check_result->status == 'Pass'){
								// redirect(base_url('graduates/graduates/eligibility/'.base64_encode($user_id->user_ID)), 'refresh');
								redirect(base_url('professional/applicant/exam_result/'.base64_encode($user_id->user_ID)).'/'.base64_encode($check_result->id), 'refresh');
							}else{
								//Exam Code						
								redirect(base_url('professional/applicant/exam_code/'.base64_encode($user_id->user_ID)), 'refresh');
							}
						}
						}else if($user_id->reviewer_status == 1 && $user_id->reviewer_id > 0){
							redirect(base_url('professional/applicant/digital_license/'.base64_encode($user_id->user_ID)), 'refresh');
						}else{
							//case of rejection
							redirect(base_url('professional/applicant/review_doc/'.base64_encode($user_id->user_ID)));
						}
					}else{
						$this->session->set_flashdata('search_error','Record not found..');
					}

				}else if($refcodearr[0]=='REG'){
					$user_id = $this->Search_model->get_professional_registration_no_search($referenceNo);
					if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){
						redirect(base_url('professional/applicant/digital_license/'.base64_encode($user_id->user_ID)), 'refresh');
					}else{
						$this->session->set_flashdata('search_error','Record not found..');
					}
				}else if($refcodearr[0]== 'GRA'){
					$user_id = $this->Search_model->graduatesearch($referenceNo);
				if(!empty($user_id)){
					if($user_id->reviewer_status < 1){
						//countdown 30 days in pending case						
						// redirect(base_url('graduates/graduates/exam_pass/'.base64_encode($user_id->grad_id)));
						redirect(base_url('university/university/graducatelicencestatus/'.base64_encode($user_id->refrence_code)));
					}elseif($user_id->reviewer_status == 1 && $user_id->examcode != '' && $user_id->reviewer_id > 0){
						
						redirect(base_url('university/university/graducatelicencestatus/'.base64_encode($user_id->refrence_code)));
					}else if($user_id->reviewer_status == 1 && $user_id->reviewer_id > 0){
						$isbook = $this->common_model->is_gexam_booked($user_id->grad_id);
						if($isbook){
							$check_result = $this->Search_model->graduateresult($user_id->grad_id);
							if(isset($check_result) && $check_result->status == 'Pass'){
								redirect(base_url('graduates/graduates/eligibility/'.base64_encode($user_id->grad_id)), 'refresh');
							}else{
								redirect(base_url('graduates/graduates/exam_pass/'.base64_encode($user_id->grad_id)), 'refresh');
							}
						}else{
							redirect(base_url('graduates/graduates/exam_result/'.base64_encode($user_id->grad_id)), 'refresh');
						}
					}else{
						//case of rejection
						redirect(base_url('graduates/graduates/review_doc/'.base64_encode($user_id->grad_id)), 'refresh');
					}
				}else{
					$this->session->set_flashdata('search_error','Record not found..');
				}
					
				}else if($refcodearr[0]=='CEP'){
					$user_id = $this->Search_model->get_cep_reference_search($referenceNo);
					if(isset($user_id->reviewer_id) > 0 && $user_id->reviewer_id > 0 && $user_id->reviewer_status == 1 ){							
						redirect(base_url('ce-provider/ce_provider/digital_accr/'.base64_encode($referenceNo)));
					}else{
						redirect(base_url('ce-provider/ce_provider/verification_document/'.base64_encode($user_id->id)));
					}
				}else if($refcodearr[0] == 'VR'){
					$user_id = $this->Search_model->receipient_information_search($referenceNo);
					if(!empty($user_id)){
						return redirect(base_url('professional/applicant/verificationrequeststatus/'.base64_encode($user_id->user_id)));
					}
				}else if($refcodearr[0] == 'GS'){
					$user_id = $this->Search_model->good_standing_search($referenceNo);
					if(!empty($user_id)){
						return redirect(base_url('professional/applicant/gsrequeststatus/'.base64_encode($user_id->gs_id)));
					}
				}else {
					$user_id = $this->Search_model->search($referenceNo);
					$user_view = base64_encode($user_id);
				}				
				if($user_id !="")
				{
					redirect(base_url('license/landing/professional_license?view=1&user_id='.$user_id.'1&user_view='.$user_view));
				}else{
					$this->session->set_flashdata('search_error','Record not found..');
				}
					//end search refrence no .
				}


				
			}else{
				validation_errors();
			}
		}


		$this->load->view('include/header',$this->data);
		$this->load->view('search/search',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}

	public function send_email(){
		$this->load->library('email');
		$this->email->from("pradeep.singhpccsoftech@gmail.com");
        $this->email->to("pradeepsingh123786@gmail.com");
        $this->email->subject("test");
        $this->email->message("ddddddddddddd");

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
	}

	

}

?>