<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profexam_model extends CI_Model {
	public $userTbl;
	public $contactTbl;
	public $countriesTbl;
	public $professionTbl;
	public $universityTbl;
	public $documentTbl;
	public $transTbl;
	public $license_applicationTbl;
	public $examscheduleTbl;
	public $exam_resultTbl;
	public $book_examTbl;
	public $guidlineTbl;
	public $guidlineheadTbl;
	public $prof_notificationTbl;
	public $proctor_exam_scheduleTbl;
	function __construct() {
		$this->userTbl 				= 'tbl_users';
		$this->contactTbl 			= 'tbl_contact_us';
		$this->countriesTbl 		= 'tbl_countries';
		$this->professionTbl 		= 'tbl_profession';
		$this->universityTbl 		= 'tbl_university';
		$this->documentTbl 			= 'tbl_professional_documents';
		$this->transTbl 			= 'tbl_payment_transaction';
		$this->license_applicationTbl = 'tbl_license_application';
		$this->examscheduleTbl 		= 'tbl_examination_schedule';
		$this->exam_resultTbl 		= 'tbl_exam_result';
		$this->book_examTbl 		= 'tbl_book_exam';
		$this->guidlineTbl 			= 'tbl_guidline';
		$this->guidlineheadTbl		= 'tbl_guidline_head';
		$this->prof_notificationTbl	= 'tbl_professional_notifications';
		$this->proctor_exam_scheduleTbl	= 'tbl_proctor_exam_schedule';
	}
	function updatereferencecode($data, $id){		
		$this->db->where('user_ID', $id);
		$this->db->update($this->userTbl, $data);
		// echo $this->db->last_query(); die;	
		return true;
	}
	function updateprofdoc($data, $id){		
		$this->db->where('pd_id', $id);
		$this->db->update($this->documentTbl, $data);
		return true;
	}

	function update_book_exam($data, $id){		
		$this->db->where('be_id', $id);
		$this->db->update($this->book_examTbl, $data);
		return true;
	}
	function insertnotifications($data){
		$insert = $this->db->insert($this->prof_notificationTbl,$data);
		return $insert?true:false;
	}

	public function getRows($id = ''){
		$this->db->select('*');
		$this->db->from($this->userTbl);
		// $this->db->where('status', '1');
		if($id){
			$this->db->where('user_ID', $id);
			$query = $this->db->get();
			$result = $query->row();
		}else{
			$this->db->order_by('name', 'asc');
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		}
		
		// return fetched data
		return !empty($result)?$result:false;
	}

	public function check_user_exsits($email){
		$this->db->where('email',$email);
		$result = $this->db->get($this->userTbl)->num_rows();
   		// echo $this->db->last_query();
		return $result;
	}
	
	public function fetch_user_details($user_id){
		$this->db->where('user_ID',$user_id);
		$result = $this->db->get($this->userTbl)->row_object();
   		//echo $this->db->last_query(); exit;
		return $result;
	}

	public function insert($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		 //echo $this->db->last_query(); exit;
   		return  $insert_id;
	}

	public function update($tbl_name,$data,$db_id,$id){
		$this->db->where($db_id, $id);
		$result = $this->db->update($tbl_name, $data);
   		// echo $this->db->last_query();
		return $result;
	}

	public function save($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		// echo $this->db->last_query();
   		return  $insert_id;
	}
	
	public function delete($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->delete($tbl_name);
   		// echo $this->db->last_query();
		return $result;
	}

	public function count_rows($tbl_name,$where=null){
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}
		$query  = $this->db->get($tbl_name);
		$result = $query->num_rows();
  		// echo $this->db->last_query();
		return $result;
	}

	public function get_result_array($tbl_name,$db_field = false,$field = false,$where =  false){
		if($where!="")
		{
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}else{
			
			if(!empty($field)){
				$this->db->where($db_field,$field);
			}	
		}
		$result = $this->db->get($tbl_name)->result_array();
   		return $result;
	}
		
	public function get_row_array($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->get($tbl_name)->row_array();
   		// echo $this->db->last_query();
		return $result;
	}	

	public function get_row_object($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->get($tbl_name)->row();
  		 //echo $this->db->last_query(); exit;
		return $result;
	}

	public function get_result_object($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$query = $this->db->get($tbl_name);

		// Safely check if the query ran successfully
		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}
	public function get_heading(){
		$this->db->where('status', '1');
		$this->db->limit(1);
		$query = $this->db->get($this->guidlineheadTbl);
		$result = $query->row();
		return $result;
	}
	public function get_result_arrays($tbl_name,$db_field = false,$field = false,$where=false,$group_by=false){
	
		if(!empty($where)){
		
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		
		$result = $this->db->get($tbl_name)->row();
   		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function get_result_group_by($tbl_name,$field,$group_by=false,$where=false)
	{
		$this->db->select_sum($field,'certificate_unit_count');
		$this->db->from($tbl_name);
		if(!empty($group_by))
		{
			$this->db->group_by($group_by);
		}
		if(!empty($where)){
		
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}

		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;
	}

	public function insert_applcaition($post){

		$this->load->library('upload');
		if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){
			$config['upload_path'] = './assets/uploads/profile/';	
			$config['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["photo"]["name"]);        
			$imageName = 'dp_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('photo')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$image = $imageName; 
			}else{
				$image = null; 
			}

		$add = array(
					// 'application_id'	=>	$application_id,
			'fname'				=>	$post['fname'],
					'lname'				=>	$post['lname'],
					'name'				=>	$post['name'],
					'country'			=>	$post['citizenship'],
					'email'				=>	$post['email'],
					'role'				=>	'P',
					'dob' 				=> 	$post['birthday'],
					'gender' 			=> 	$post['gender'],
					'profession' 		=> 	$post['profession'],
					'license_no' 		=> 	$post['license_no'],

					'license_validity_date' => 	$post['license_validity_date'],
					'license_issued_date' 	=> 	$post['license_issued_date'],

					'university' 			=> 	$post['university'],
					'other_university' 		=> 	$post['other_university'],
					'college' 				=> 	$post['college_of'],
					'other_college' 		=> 	$post['other_college'],
					'u_contact'			=>	$post['university_contact'],
					'u_address'			=>	$post['university_address'],
					'u_website'			=>	$post['university_website'],

					'reg_board'			=>	$post['reg_board'],
					'reg_country'		=>	$post['reg_country'],
					'reg_address'		=>	$post['reg_address'],
					'reg_email'			=>	$post['reg_email'],
					'reg_website'		=>	$post['reg_website'],

					'image'				=>	$image,
					'status'			=>	0,
					'added_on' 			=> 	date('Y-m-d')
				);

		$this->db->insert($this->userTbl,$add);
		return $this->db->insert_id(); 
   		
	}

	private function get_application_id(){
		$this->db->order_by('id','DESC');
		$query = $this->db->get($this->license_applicationTbl)->row();
		if($query){
			$appArr = explode('-',$query->application_id);
			$app_id = sprintf('%05d',$appArr[0]+1);
		}else{
			$app_id = sprintf('%05d',1);
		}
		$application_id = $app_id.'-'.date('Y');
		return $application_id;
	}

	private function get_password(){
		$password = substr(mt_rand(100000, 999999),0,6);
		return $password;
	}

	public function get_countries(){
		$this->db->where('status',1);
		$this->db->order_by('countries_name','ASC');
		$result = $this->db->get($this->countriesTbl)->result();
		return $result;
	}

	public function get_profession(){
		$this->db->where('status',1);
		$this->db->order_by('name','ASC');
		$result = $this->db->get($this->professionTbl)->result();
		return $result;
	}
	public function get_university(){
		$this->db->where('status','1');
		$this->db->order_by('university_name','ASC');
		$result = $this->db->get($this->universityTbl)->result();
		return $result;
	}

	function login($username, $password){
		$query = $this -> db -> query("SELECT * FROM `tbl_license_application` WHERE email = '".$username."' AND (password = '$password') LIMIT 1");
		if($query -> num_rows() == 1){ return $query->row_array(); } else { return false; }
	}

	function check_unique_email($email){
		$this->db->where('email',$email);
		$result = $this->db->get('tbl_license_application')->num_rows();
		return $result;
	}

	
	public function insert_documents($post){

		$this->load->library('upload');
		if(isset($_FILES["diploma"]) && !empty($_FILES["diploma"]['name'])){
			$config1['upload_path'] = './assets/uploads/document/';	
			$config1['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["diploma"]["name"]);        
			$imageName = 'docd_'.time().'.'.end($ext);
			$config1['file_name'] = $imageName;
			$this->upload->initialize($config1);

			if ( ! $this->upload->do_upload('diploma')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['diploma'] = $imageName; 
			}
		if(isset($_FILES["ot_record"]) && !empty($_FILES["ot_record"]['name'])){
			$config2['upload_path'] = './assets/uploads/document/';	
			$config2['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["ot_record"]["name"]);        
			$imageName = 'doco_'.time().'.'.end($ext);
			$config2['file_name'] = $imageName;
			$this->upload->initialize($config2);

			if ( ! $this->upload->do_upload('ot_record')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['ot_record'] = $imageName; 
		}
		if(isset($_FILES["charecter"]) && !empty($_FILES["charecter"]['name'])){
			$config3['upload_path'] = './assets/uploads/document/';	
			$config3['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["charecter"]["name"]);        
			$imageName = 'docc_'.time().'.'.end($ext);
			$config3['file_name'] = $imageName;
			$this->upload->initialize($config3);

			if ( ! $this->upload->do_upload('charecter')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['charecter'] = $imageName; 
			}
		if(isset($_FILES["p_reference1"]) && !empty($_FILES["p_reference1"]['name'])){
			$config4['upload_path'] = './assets/uploads/document/';	
			$config4['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["p_reference1"]["name"]);        
			$imageName = 'docp1_'.time().'.'.end($ext);
			$config4['file_name'] = $imageName;
			$this->upload->initialize($config4);

			if ( ! $this->upload->do_upload('p_reference1')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['p_reference1'] = $imageName; 
		}
		if(isset($_FILES["p_reference2"]) && !empty($_FILES["p_reference2"]['name'])){
			$config5['upload_path'] = './assets/uploads/document/';	
			$config5['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["p_reference2"]["name"]);        
			$imageName = 'docp2_'.time().'.'.end($ext);
			$config5['file_name'] = $imageName;
			$this->upload->initialize($config5);

			if ( ! $this->upload->do_upload('p_reference2')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['p_reference2'] = $imageName; 
		}
		if(isset($_FILES["medical"]) && !empty($_FILES["medical"]['name'])){
			$config6['upload_path'] = './assets/uploads/document/';	
			$config6['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["medical"]["name"]);        
			$imageName = 'docm_'.time().'.'.end($ext);
			$config6['file_name'] = $imageName;
			$this->upload->initialize($config6);

			if ( ! $this->upload->do_upload('medical')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['medical'] = $imageName; 
		}
		if(isset($_FILES["police_certificate"]) && !empty($_FILES["police_certificate"]['name'])){
			$config7['upload_path'] = './assets/uploads/document/';	
			$config7['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["police_certificate"]["name"]);        
			$imageName = 'docpo_'.time().'.'.end($ext);
			$config7['file_name'] = $imageName;
			$this->upload->initialize($config7);

			if ( ! $this->upload->do_upload('police_certificate')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['police_certificate'] = $imageName; 
		}
		if(isset($_FILES["passport"]) && !empty($_FILES["passport"]['name'])){
			$config8['upload_path'] = './assets/uploads/document/';	
			$config8['allowed_types'] = 'gif|jpg|png|jpeg';       
			$ext = explode('.',$_FILES["passport"]["name"]);        
			$imageName = 'docpa_'.time().'.'.end($ext);
			$config8['file_name'] = $imageName;
			$this->upload->initialize($config8);

			if ( ! $this->upload->do_upload('passport')) { 
				$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} 
				$add['passport'] = $imageName; 
		}

		$add['user_id'] 	= $post['user_id'];
		$add['status'] 		= 0;
		$add['added_on'] 	= date('Y-m-d');
		if(isset($post['expiry_at'])){
			$add['expiry_at'] = $post['expiry_at'];
		}

		$this->db->insert($this->documentTbl,$add);
		$data['insert_id'] 	= $this->db->insert_id(); 
		$data['uid'] 		= $post['user_id']; 
   		return  $data;
	}


	public function insertTransaction($data){
		$insert = $this->db->insert($this->transTbl,$data);
		return $insert?true:false;
	}

	public function getprofdetails($fname,$lname,$name,$email,$gender,$birthday,$profession,$examination_code){
		$this->db->select('u.*,p.name collegeofname,un.university_name');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->professionTbl.' p', 'u.college = p.id','left');		
		$this->db->join($this->universityTbl.' un', 'u.university = un.uniid','left');		
		$this->db->where('u.role', 'P');
		$this->db->where('u.reviewer_status', '1');
		$this->db->where('u.email', $email);
		//$this->db->like('u.fname', $fname);
		//$this->db->like('u.lname', $lname);
		//$this->db->like('u.name', $name);
		//$this->db->where('u.email', $email);
		//$this->db->where('u.dob', $birthday);
		//$this->db->where('u.gender', $gender);
		//$this->db->where('u.profession', $profession);
		//$this->db->where('u.exam_code', $examination_code);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->row();
		//$result = $query->row_object();
		return $result;		
	}

	function get_examination_schedule(){
	
		$this->db->select('es.*');
		$this->db->from($this->examscheduleTbl.' es');
		//$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'es.es_id = pes.exam_schedule_id');	
		$this->db->where('es.status', '1');
		$this->db->where('es.exam_for', 'pp');
		$this->db->where('es.date >=', date('Y-m-d'));
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}

	function add_exam_date($data){
		$add = array(
			'user_id'			=> $data['uid'],
			'examination_id' 	=> $data['id'],
			'booking_for'  		=> 'pp',
			'added_on'  		=> date('Y-m-d'),
			);
		$this->db->insert($this->book_examTbl, $add);
		$id = $this->db->insert_id();
		$this->db->set('remaining_slot','remaining_slot-1',FALSE);
		$this->db->where('es_id',$data['id']);
		$this->db->update($this->examscheduleTbl);
		return (isset($id)) ? $id : FALSE;
	}

	function already_booked_exam($data){
		$this->db->where('user_id', $data['uid']);
		// $this->db->where('examination_id', $data['id']);
		$this->db->where('booking_for', 'pp');
		$query = $this->db->get($this->book_examTbl);
		$result = $query->row();
		return !empty($result)?$result:false;
	}

	function get_guidlines(){
		$this->db->where('status', '1');
		$this->db->where('guidline_for', 'fp');
		$query = $this->db->get($this->guidlineTbl);
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}


} 

?>