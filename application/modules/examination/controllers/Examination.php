<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examination extends MX_Controller {

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

	public function __construct(){
		parent::__construct();
		$this->load->model('examination_model','examination');	
		$this->load->library('upload'); 
		$this->load->library('form_validation');
		
	}

	// public function index(){
	// 	$this->data = array('title'=> 'Examination Panel');
	// 	$this->data['exam_list'] = $this->examination->get_current_exam_list();
	// 	$this->load->view('welcome',$this->data);
	// }

	public function index(){
		// if($this->input->post('proccesed')=='next-step'){
			// $es_id = $this->input->post('exam_type');
			$this->data = array( 'title'=> 'Enroll Student');
			$this->data['exam'] = $this->examination->get_nearest_exam();
			//print_r($this->data);exit;
			$this->load->view('examinee_login',$this->data); 
		// }
	}

	public function check_professional(){
		$post = $this->input->post();
		//echo '<pre>';print_r($post);die;
		//if($post['exam_code']!=''){
		if(is_array($post)){
			
			$check = $this->examination->verify_professional($post);
			// echo '<pre>';echo $this->db->last_query(); print_r($check); exit;
				$examniee_type = 'pp';
			if(count($check) < 1 && $check == ''){
				$check = $this->examination->verify_graduate($post);
				$examniee_type = 'p';
			}
		
			if(count($check) > 0){
				if($check->attendance == '1'){
					//echo $check->exam_date.'--'.date('Y-m-d'); exit;
					// if($check->exam_date != date('Y-m-d')){
					// 	$this->session->set_flashdata('message', '<div class="alert alert-danger">Today is not your exam schedule.</div>');
					// 	redirect('examination/examination/index'); die();	
					// }

				//check question set available or not
				$examination_id = $check->examination_id;
				$is_question_set = $this->examination->is_question_set($examination_id);
				if(count($is_question_set) < 1){
					$this->session->set_flashdata('message', '<div class="alert alert-danger">You have not book this examination.</div>');
					redirect('examination/examination/index'); die();
				}

				$chattend = $this->examination->check_exam_attend($check->user_ID,$examniee_type);
				if(count($chattend) > 0){	 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">You have done your examination.</div>');
					redirect('examination/examination/index'); die();
				}

				if($examniee_type == 'pp'){	
					$exam_session = array(
						'examniee_id' 	=> $check->user_ID,
						'examniee_name' => $check->fname.' '.$check->lname.' '.$check->name,
						'examniee_email'=> $check->email,
						'examniee_code' => $check->exam_code,
						'examniee_type' => $examniee_type,
						'examniee_session' 	=> true,
						'exam_date' 	=> $check->exam_date,
						'start_time' 	=> $check->start_time,
						'end_time' 		=> $check->end_time,
						'examination_id' => $check->examination_id,
					);
				}else{
					$exam_session = array(
						'examniee_id' 	=> $check->grad_id,
						'examniee_name' => $check->student_name.' '.$check->middle_name.' '.$check->surname,
						'examniee_email'=> $check->email,
						'examniee_code' => $check->examcode,
						'examniee_type' => $examniee_type,
						'examniee_session' 	=> true,
						'exam_date' 	=> $check->exam_date,
						'start_time' 	=> $check->start_time,
						'end_time' 		=> $check->end_time,
						'examination_id' => $check->examination_id,
					);
				}
				$this->session->set_userdata($exam_session);
				redirect('examination/examination/question_paper'); die();
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Please mark your attendance first, Please contact to Examiner.</div>');
					redirect('examination/examination/index'); die();
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Wrong information please try again!</div>');
				redirect('examination/examination/index'); die();
			}
		}
		}
	public function question_paper(){
		if(empty($this->session->userdata('examniee_code'))){
			redirect('examination/examination');
		}
		/* //this section is for question_set which is published by admin
		$examination_id = $this->session->userdata('examination_id');
		$exam_sch_data = $this->examination->is_question_set($examination_id);
		$all_ques_id = explode(',',$exam_sch_data->question_numbers);
		//print_r($all_ques_id);exit; 
		shuffle($all_ques_id);
		$allquestion = array();
		foreach($all_ques_id as $id){
			$question = $this->examination->get_one_question_by_id($id);
			$allquestion[] = array(
				'id' 				=> $question->id,
				'set_no' 			=> $question->set_no,
				'ques_cat_id' 		=> $question->ques_cat_id,
				'question_title' 	=> $question->question_title,
				'answere1' 			=> $question->answere1,
				'answere2' 			=> $question->answere2,
				'answere3' 			=> $question->answere3,
				'answere4' 			=> $question->answere4,
				'correct_answere' 	=> $question->correct_answere,
				'rationale' 		=> $question->rationale,
				'added_by' 			=> $question->added_by,
				'status' 			=> $question->status,
				'added_on' 			=> $question->added_on,
				'updated_at' 		=> $question->updated_at,
				'category_name'		=> $question->category_name,
				'passing_score'		=> $question->passing_score,
			);
		} */
		$this->data = array('title'=> 'Question Paper','page_title'=> 'Question Paper');
		//$this->data['all_question'] = $this->examination->get_question_paper(1);
		$this->data['all_question'] = $this->examination->get_limited_random_question();
		//$this->data['all_question'] = $allquestion; //for published set shuffled question
		//echo '<pre>';print_r($this->data['all_question']);die;

		$this->load->view('common/header',$this->data);
		$this->load->view('question_paper',$this->data);
		$this->load->view('common/footer',$this->data);
	}

	public function save_exam_result(){
		if($this->input->post()){
			//print_r($_POST);exit;
			$post = $this->input->post();
			$result = $this->examination->check_exam_paper($post);
			if(count($result) > 0){
				if($result['status']=="Pass"){
					$settingarr = $this->common_model->get_setting('1');
					$bytes 		= random_bytes(3); 
					$regcode 	= bin2hex($bytes);
					$registration_no = 'REG-'.$result['user_id'].$regcode.'-'.date('Y');
					$update['user_id'] = $result['user_id'];
					$update['registration_no'] = $registration_no;

					if($result['user_type']=="g"){
						$this->examination->update_graduate_registration_no($update);
					}else{
						$this->examination->update_prof_registration_no($update);
					}
					$details = $this->examination->get_examinee_details($result['user_id'],$result['user_type']);
				
					//$mailContent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Now you are eligible for Register yourself on Professional Registration form. here is your Registration Number: '.$details->registration_no.'. <br/>Please <a href="'.base_url('professional/applicant/registration_form').'">click here</a> to go the registration form page.</p>';
					$mailContent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Thank You for your exam submission.<br>Please give us 48 hours to check your exam paper, 
									after 48 hours, you will get the result on your email.</p>';
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
						$this->email->to($details->email);
						$this->email->subject('Eligibility Confirmation');
						$emailbody 					= array();
						$emailbody['name'] 			= $details->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $mailContent;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
				}
				$this->session->set_flashdata('message', '<div class="alert alert-success">Thank You for your exam submission.</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			$this->session->sess_destroy();
			$this->data = array(
				'title' => ' Exam Completion',
				'page_title' => 'Exam Completion'
			);
			$this->load->view('common/header',$this->data);
			$this->load->view('examination/exam_completion',$result);
			$this->load->view('common/footer');
		}
	}

}?>
