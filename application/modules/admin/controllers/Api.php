<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Api extends MX_Controller {

	public function  __construct(){
		parent::__construct(); 
		$this->load->model('Admin_model','admin');
		header('Access-Control-Allow-Origin: *');
	}
	
	public function user_certificate() {
		// header('Content-type: application/json');
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		// $result = $jsonvalue;
		$this->db->select('*');
		$this->db->where('email',$jsonvalue['user_email']);
		$sql = $this->db->get('tbl_professional_license');
		$userdetail = $sql->row(); 
		$add = array(
			'user_id' 		=> $userdetail->user_id,
			'user_email' 	=> $jsonvalue['user_email'],
			'certificate_id'=> $jsonvalue['certificate_id'],
			'course_name' 	=> $jsonvalue['course_name'],
			'units' 		=> $jsonvalue['units'],
			'category' 		=> $jsonvalue['category'],
			'certificate' 	=> $jsonvalue['certificate'],
			'issue_date' 	=> $jsonvalue['issue_date'],
			'issue_from' 	=> $jsonvalue['issue_from'],
			'issue_by' 		=> $jsonvalue['issue_by'],
			'status' 		=> 0,
			'added_on' 		=> date('Y-m-d H:i:s'),
			'certificate_identify' => 0
		);
		// $this->db->insert('tbl_existing_certificate',$add); //this is only for testing
		$this->db->insert('tbl_user_certificate',$add);
		$saved = $this->db->insert_id();

		if($saved > 0){
			$result['msg'] = 'New certificate added successfully.'; 
			$result['success'] = true; 
			$result['report'] = $saved.date('Y'); 
			$result['error'] = false; 
		}else{
			$result['msg'] = 'Something went wrong!'; 
			$result['success'] = false; 
			$result['error'] = true; 
		}
		echo json_encode($result);
	}

	public function add_certificate() {
		// header('Content-type: application/json');
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		$this->db->select('*');
		$this->db->where('email',$jsonvalue['user_email']);
		$sql = $this->db->get('tbl_professional_license');
		$userdetail = $sql->row(); 
		// $result = $jsonvalue;
		$add = array(
			'user_id' 		=> ($userdetail!='')?$userdetail->user_id:0,
			'user_email' 	=> $jsonvalue['user_email'],
			'course_name' 	=> $jsonvalue['course_name'],
			'units' 		=> $jsonvalue['units'],
			'start_date' 	=> $jsonvalue['start_date'],
			'end_date' 		=> $jsonvalue['end_date'],
			'certificate_id'=> $jsonvalue['certificate_id'],
			'certificate' 	=> $jsonvalue['certificate'],
			'category' 		=> $jsonvalue['category'],
			'issue_date' 	=> $jsonvalue['issue_date'],
			'issue_from' 	=> $jsonvalue['issue_from'],
			'issue_by' 		=> $jsonvalue['issue_by'],
			'cep_name' 		=> $jsonvalue['cep_name'],
			'status' 		=> $jsonvalue['status'],
			'added_on' 		=> $jsonvalue['added_on'],
			'certificate_identify' => $jsonvalue['certificate_identify']
		);
		$this->db->insert('tbl_existing_certificate',$add);
		$saved = $this->db->insert_id();
		// echo $this->db->last_query();
		if($saved > 0){
			$result['msg'] = 'New certificate added successfully.'; 
			$result['success'] = true; 
			$result['error'] = false; 
		}else{
			$result['msg'] = 'Something went wrong!'; 
			$result['success'] = false; 
			$result['error'] = true; 
		}
		echo json_encode($result);
	}

	public function add_course_old() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		// $result = $jsonvalue;
		$add = array(
			'acceditation_validity' => $jsonvalue['acceditation_validity'],
			'author_reference_id' 	=> $jsonvalue['author_reference_id'],
			'country_id' 			=> $jsonvalue['country_id'],
			'course_category' 		=> $jsonvalue['course_category'],
			// 'course_certificate_note' => $jsonvalue['course_certificate_note'],
			// 'cpdprovider' 		=> $jsonvalue['cpdprovider'],
			// 'id' 				=> $jsonvalue['id'],
			// 'prof_name' 			=> $jsonvalue['prof_name'],
			'course_description' 	=> $jsonvalue['course_description'],
			'course_evaluation_note'=> $jsonvalue['course_evaluation_note'],
			'course_exam_note' 		=> $jsonvalue['course_exam_note'],
			'course_for' 			=> $jsonvalue['course_for'],
			'course_photo' 			=> $jsonvalue['course_photo'],
			'course_title' 			=> $jsonvalue['course_title'],
			'course_validity' 		=> $jsonvalue['course_validity'],
			'course_video' 			=> $jsonvalue['course_video'],
			'disabled_by' 			=> $jsonvalue['disabled_by'],
			'expiry_on' 			=> $jsonvalue['expiry_on'],
			'featured_from' 		=> $jsonvalue['featured_from'],
			'featured_to' 			=> $jsonvalue['featured_to'],
			'insititution_id' 		=> $jsonvalue['insititution_id'],
			'objective' 			=> $jsonvalue['objective'],
			'paid_status' 			=> $jsonvalue['paid_status'],
			'passing_marks' 		=> $jsonvalue['passing_marks'],
			'prc_acceditation_number'=> $jsonvalue['prc_acceditation_number'],
			'price' 				=> $jsonvalue['price'],
			'profession' 			=> $jsonvalue['profession'],
			'quiz_retek' 			=> $jsonvalue['quiz_retek'],
			'rating' 				=> $jsonvalue['rating'],
			'status' 				=> $jsonvalue['status'],
			'tax' 					=> $jsonvalue['tax'],
			'total' 				=> $jsonvalue['total'],
			'units' 				=> $jsonvalue['units'],
			'added_on' 				=> $jsonvalue['added_on'],
			// 'user_email' 			=> $jsonvalue['user_email'],
			'licence_applied' 		=> $jsonvalue['licence_applied'],
			'course_id' 			=> $jsonvalue['id'],
			'course_acceditation_number' 	=> $jsonvalue['course_acceditation_number']
		);
		$this->db->insert('tbl_course',$add);
		$saved = $this->db->insert_id();

		if($saved > 0){
			$result['msg'] = 'Thankyou for sending the cousre to RBoard.'; 
			$result['success'] = true; 
			$result['error'] = false; 
		}else{
			$result['msg'] = 'Something went wrong!'; 
			$result['success'] = false; 
			$result['error'] = true; 
		}
		echo json_encode($result);
	}

	public function add_course() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		// $result = $jsonvalue;
		$add = array(
			'provider_id' 		=> $jsonvalue['provider_id'],
			'ceon_course_id' 	=> $jsonvalue['id'],
			'course_website_url'=> 'https://ceonpoint.com/staging/index.php/pages/course_details/'.$jsonvalue['id'],
			'course_title' 		=> $jsonvalue['course_title'],
			'course_image' 		=> 'https://ceonpoint.com/staging/assets/images/uploads/'.$jsonvalue['course_photo'],
			'course_pdf' 		=> $jsonvalue['course_pdf_url'],
			'course_units' 		=> $jsonvalue['units'],
			'course_price' 		=> $jsonvalue['price']
		);
		$this->db->insert('tbl_course_documents',$add); 
		$saved = $this->db->insert_id();

		if($saved > 0){
			$result['msg'] = 'Thankyou for sending the cousre to RBoard.'; 
			$result['success'] = true; 
			$result['error'] = false; 
		}else{
			$result['msg'] = 'Something went wrong!'; 
			$result['success'] = false; 
			$result['error'] = true; 
		}
		echo json_encode($result);
	}

	public function add_training() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		// $result = $jsonvalue;
		$add = array(
			'user_email' 		=> $jsonvalue['user_email'],
			'training_type' 	=> $jsonvalue['training_type'],
			'templates' 		=> $jsonvalue['templates'],
			'certificate' 		=> $jsonvalue['certificate'],
			'category_id' 		=> $jsonvalue['category_id'],
			// 'background_image' => $jsonvalue['background_image'],
			// 'image' 			=> $jsonvalue['image'],
			'title' 			=> $jsonvalue['title'],
			'sub_title' 		=> $jsonvalue['sub_title'],
			'host'				=> $jsonvalue['host'],
			'units' 			=> $jsonvalue['units'],
			'speaker' 			=> $jsonvalue['speaker'],
			'tax' 				=> $jsonvalue['tax'],
			'price' 			=> $jsonvalue['price'],
			'total' 			=> $jsonvalue['total'],
			'add_link' 			=> $jsonvalue['add_link'],
			'location' 			=> $jsonvalue['location'],
			'start_date' 		=> $jsonvalue['start_date'],
			'end_date' 			=> $jsonvalue['end_date'],
			'start_time' 		=> $jsonvalue['start_time'],
			'end_time' 			=> $jsonvalue['end_time'],
			'status' 			=> $jsonvalue['status'],
			'disabled_by' 		=> $jsonvalue['disabled_by'],
			'description' 		=> $jsonvalue['description'],
			'contact_person' 	=> $jsonvalue['contact_person'],
			'email' 			=> $jsonvalue['email'],
			'phone' 			=> $jsonvalue['phone'],
			// 'cp_number' 		=> $jsonvalue['cp_number'],
			'video'				=> $jsonvalue['video'],
			'objectives' 		=> $jsonvalue['objectives'],
			'methodologies' 	=> $jsonvalue['methodologies'],
			'participants' 		=> $jsonvalue['participants'],
			'item_to_bring' 	=> $jsonvalue['item_to_bring'],
			'featured_to' 		=> $jsonvalue['featured_to'],
			'featured_from' 	=> $jsonvalue['featured_from'],
			'country_id' 		=> $jsonvalue['country_id'],
			'host_name' 		=> $jsonvalue['host_name'],
			'about_host' 		=> $jsonvalue['about_host'],
			'chairman' 			=> $jsonvalue['chairman'],
			'position' 			=> $jsonvalue['position'],
			'insititution_id' 	=> $jsonvalue['insititution_id'],
			'venue_photo' 		=> $jsonvalue['venue_photo'],
			'attach_logo' 		=> $jsonvalue['attach_logo'],
			'evaluation_note' 	=> $jsonvalue['evaluation_note'],
			'registration_limit'=> $jsonvalue['registration_limit'],
			'registration_status'=> $jsonvalue['registration_status'],
			'paid_status' 		=> $jsonvalue['paid_status'],
			'training_id' 		=> $jsonvalue['id'],
			'licence_applied' 	=> $jsonvalue['licence_applied']
		);
		$this->db->insert('tbl_training',$add);
		$saved = $this->db->insert_id();

		if($saved > 0){
			$result['msg'] = 'Thankyou for sending the training to RBoard.'; 
			$result['success'] = true; 
			$result['error'] = false; 
		}else{
			$result['msg'] = 'Something went wrong!'; 
			$result['success'] = false; 
			$result['error'] = true; 
		}
		echo json_encode($result);
	}
	
	// Checking CE Provider on RBoard
	
	function check_user() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		$email = $jsonvalue['email'];

		$res = $this->admin->check_user($email);
		if($res != '' && count($res) > 0){
			if($res->status == 1){ 
				$result['email'] = $res->email; 
				$result['provider_id'] = $res->provider_id; 
				$result['error'] = false;
			}elseif($res->status == 2){
				$result['msg']   = 'Your account is INACTIVE, Please contact to RBoard administration!';
				$result['error'] = true;
			}else{
				$result['msg']   = 'Your RBoard account is NOT APPROVED yet, Please contact to RBoard administration!';
				$result['error'] = true;
			} 
		}else{
			$result['error'] = true; 
			$result['msg'] 	   = 'Please sign up in RBoard first!'; 
		}
		echo json_encode($result);
	}
	
	// Checking Professional on RBoard
	
	function check_professional_user() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		$email = $jsonvalue['email'];

		$res = $this->admin->check_professional_user($email);
		if($res != '' && count($res) > 0){
			if($res->status == 1){ 
				$result['email'] = $res->email; 
				$result['user_id'] = $res->user_id; 
				$result['error'] = false;
			}elseif($res->status == 2){
				$result['msg']   = 'Your account is INACTIVE, Please contact to RBoard administration!';
				$result['error'] = true;
			}else{
				$result['msg']   = 'Your RBoard account is NOT APPROVED yet, Please contact to RBoard administration!';
				$result['error'] = true;
			} 
		}else{
			$result['error'] = true; 
			$result['msg'] 	   = 'Please sign up in RBoard first!'; 
		}
		echo json_encode($jsonvalue);
	}

	function validateProfessionalCode() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		$email = $jsonvalue['email'];
		$profcode = $jsonvalue['prof_code'];
		$res = $this->admin->check_professional_user($email);

		if($res != '' && count($res) > 0){
			if($res->prof_code == $profcode){ 
				$result['code']  = 200; 
				$result['msg'] 	 = 'Successfully matched'; 
				$result['user_id'] 	 = $res->user_id; 
				$result['error'] = false;
			}else{
				$result['code']  = 401; 
				$result['msg']   = 'Wrong code';
				$result['user_id']= $res->user_id; 
				$result['error'] = true;
			} 
		}else{
			$result['error'] = true; 
			$result['msg'] 	   = 'Invalid user!'; 
		}
		echo json_encode($result);
	}

	function validateCPDCode() {
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		$email = $jsonvalue['email'];
		$cpdcode = $jsonvalue['cpd_code'];
		$res = $this->admin->check_user($email);

		if($res != '' && count($res) > 0){
			if($res->cep_code == $cpdcode){ 
				$result['code']  = 200; 
				$result['msg'] 	 = 'Successfully matched'; 
				$result['user_id'] 	 = $res->user_id; 
				$result['error'] = false;
			}else{
				$result['code']  = 401; 
				$result['msg']   = 'Wrong code';
				$result['user_id']= $res->user_id; 
				$result['error'] = true;
			} 
		}else{
			$result['error'] = true; 
			$result['msg'] 	   = 'Invalid user!'; 
		}
		echo json_encode($result);
	}

	public function update_admin_subscription_package() {
		// header('Content-type: application/json');
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true);
		$result = $jsonvalue; 
		// print_r($result); exit;
		$add = array(
			'admin_email' 		=> $jsonvalue['admin_email'],
			'domain'			=> $jsonvalue['domain'],
			'subscription_id' 	=> $jsonvalue['subscription_id'],
			'subscription_name' => $jsonvalue['subscription_name'],
			'no_of_application' => $jsonvalue['no_of_application'],
			'rb_sub_key' 		=> $jsonvalue['rb_sub_key'],
			'rb_code' 			=> $jsonvalue['rb_code'],
			'added_on' 			=> date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_admin_subscription_details',$add);
		$saved = $this->db->insert_id();

		if($saved > 0){
			$result['msg'] = 'successfully.'; 
			$result['success'] = true; 
		}else{
			$result['msg'] = 'Something went wrong!'; 
			$result['success'] = false; 
		}
		echo json_encode($result);
	}

}
?>