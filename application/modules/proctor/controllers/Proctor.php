<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proctor extends MX_Controller {

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
		$this->load->model('proctor_model','proctor');	
		$this->load->library('upload');
		// if($this->session->userdata('login')['session']==true){
		// 	redirect(base_url('proctor/proctor'), 'refresh');
		// }
	}

	public function dashboard(){
		if(!$this->session->userdata('login')['role']=='proctor'){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array('title'=> 'Examination Schedule');
		
		$uid = $this->session->userdata('login')['user_ID'];
		$user_type = $this->session->userdata('login')['user_type'];

		if($user_type == 'pp'){
			$exam_for = 'pp';
			$data['listing'] = $this->proctor->get_forigen_examiness_list();
		}else{
			$exam_for = 'p';
			$data['listing'] = $this->proctor->get_graduate_examiness_list();
		}
		$data['details'] = $this->proctor->get_row_object('tbl_admin','user_ID',$uid);
		$data['total_exam'] = $this->proctor->get_upcomming_exam($exam_for,2,$uid);
		// print_r($data['total_exam']);die;
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar',$this->data);
		$this->load->view('dashboard',$data);
		$this->load->view('common/footer',$this->data);
	}

	public function foreign_examnees_listing()
	{		
		$count = $this->proctor->get_forigen_examiness_list(1);
		$this->data = array(
				'title' => 'Govt : Foreign Examinees & Exam Code Listing',
				'page_title' => 'Foreign Examinees & Exam Code Listing ('.$count.')',
				'table_name' => 'Foreign Examinees & Exam Code Listing'
			);
		$data['listing'] = $this->proctor->get_forigen_examiness_list();
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('examinees/foreign_examnees',$data);
		$this->load->view('common/footer');
	}

	function graduate_examnees_listing()
	{	$count = $this->proctor->get_graduate_examiness_list(1);
		$this->data = array(
				'title' => 'Graduate Examinees & Exam Code Listing',
				'page_title' => 'graduate Examinees & Exam Code Listing ('.$count.')',
				'table_name' => 'graduate Examinees & Exam Code Listing'
			);
		$data['listing'] = $this->proctor->get_graduate_examiness_list();
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('examinees/graduate_examnees',$data);
		$this->load->view('common/footer');
	}

	function markAttendance(){
		$id = $this->input->post('user_id');
		$data['attendance'] = $this->input->post('attendance');
		$result = $this->proctor->update('graduates',$data,'grad_id',$id);

		if($result == true){
			$this->session->set_flashdata('item','<div class="alert alert-success">Examiness Status changed.</div>');
		}else{
			$this->session->set_flashdata('item','<div class="alert alert-success">Something went wrong!</div>');
		}
			redirect('proctor/graduate_examnees_listing');
	}

	function profMarkAttendance(){
		$id = $this->input->post('user_id');
		$type = $this->input->post('type');
		$data['attendance'] = $this->input->post('attendance');
		$data['attendence_mark_ip'] = $_SERVER['REMOTE_ADDR'];
		if($type == 'pp'){
		$result = $this->proctor->update('tbl_users',$data,'user_ID',$id);
		}
		if($type == 'p'){
		$result = $this->proctor->update('graduates',$data,'grad_id',$id);
		}

		if($result == true){
			$this->session->set_flashdata('item','<div class="alert alert-success">Examiness Status changed.</div>');
		}else{
			$this->session->set_flashdata('item','<div class="alert alert-success">Something went wrong!</div>');
		}
			redirect('proctor/dashboard');
	}

	function notification()
	{		
		$count = $this->proctor->get_notifications($this->session->userdata('login')['user_ID'],1);

		$this->data = array(
				'title' => 'Notification',
				'page_title' => 'Notification ('.$count.')',
				'table_name' => 'Notification'
			);
		$data['get_notifications'] = $this->proctor->get_notifications($this->session->userdata('login')['user_ID']); 
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('notification',$data);
		$this->load->view('common/footer');
	}

	function changepassword(){
		$this->data = array(
				'title' => 'Change Password',
				'page_title' => 'Change Password',
				'table_name' => 'Change Password'
			);
		if(!$this->session->userdata('login')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$uid = $this->session->userdata('login')['user_ID'];
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('old_password', 'Current Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required');
			if ($this->form_validation->run() == TRUE) {
				$fetchPassword = $this->proctor->fetchPassword($this->session->userdata('login')['user_ID']); 
				$verify = password_verify($this->input->post('old_password'),$fetchPassword->password);
				if($verify!=true){
					$this->session->set_flashdata('item', '<div class="alert alert-danger">Old password not matched.</div>');
				}
				elseif($this->input->post('new_pass') != $this->input->post('conf_pass')){
					$this->session->set_flashdata('item', '<div class="alert alert-danger">Confirm password not matched.</div>');
				}else{
					$updatepass = array();
					$updatepass['password'] = password_hash($this->input->post('conf_pass'), PASSWORD_DEFAULT);
					$this->proctor->updatePassword($updatepass,$this->session->userdata('login')['user_ID']);
					$this->session->set_flashdata('item', '<div class="alert alert-success">New password successfully updated.</div>');
				}
				redirect(base_url('proctor/proctor/changepassword'), 'refresh');
			}else{
				validation_errors();
			}
		}
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('changepassword',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	public function get_exam_pass(){
		$schid = $_POST['schid'];
		$type = $_POST['type'];
		
		if($type == 'p'){
			$datam = $this->proctor->get_graduate_examinee_details($schid);
			//print_r($datam);exit;
			$result=array(
				"image"=>$datam->photo,
				"exam_name"=>$datam->name_of_exam,
				"exam_date"=>$datam->exam_date,
				"fullname"=>$datam->student_name.' '.$datam->middle_name.' '.$datam->surname,
				"exam_start_time"=>$datam->start_time,
				"exam_end_time"=>$datam->end_time,
				"exam_venue" => $datam->venue,
				"examcode" => $datam->examcode,
				"type"=>'p',
			);
			$data['result']=$result;
		}else{
			$datam = $this->proctor->get_professional_examinee_details($schid);
			//print_r($datam);exit;
			$result=array(
				"image"=>$datam->image,
				"exam_name"=>$datam->name_of_exam,
				"exam_date"=>$datam->exam_date,
				"fullname"=>$datam->name,
				"exam_start_time"=>$datam->start_time,
				"exam_end_time"=>$datam->end_time,
				"exam_venue" => $datam->venue,
				"examcode" => $datam->exam_code,
				"type"=>'pp',
			);
			$data['result']=$result;
		}
		//print_r($data);exit;
		$this->load->view("proctor/common/exam_pass_preview",$data);
	}
	
}?>
