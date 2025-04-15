<?php defined('BASEPATH') OR exit('No direct script access allowed');

     
class Applicant_model extends CI_Model {
	private $userTbl;
	private $cardTbl;
	private $graduateTbl;
	private $contactTbl;
	private $countriesTbl;
	private $professionTbl;
	private $universityTbl;
	private $documentTbl;
	private $transTbl;
	private $license_applicationTbl;
	private $exam_slotTbl;
	private $prof_notificationTbl;
	private $prof_licenseTbl;
	private $exist_certificateTbl;
	private $user_certificateTbl;
	private $termsconditionsTbl;
	private $tutorialTbl;
	private $receipientInformationTbl;
	private $goodstandingTbl;
	function __construct() {
		$this->userTbl 				= 'tbl_users';
		$this->cardTbl 				= 'tbl_card';
		$this->graduateTbl 			= 'graduates';
		$this->contactTbl 			= 'tbl_contact_us';
		$this->countriesTbl 		= 'tbl_countries';
		$this->professionTbl 		= 'tbl_profession';
		$this->universityTbl 		= 'tbl_university';
		$this->documentTbl 			= 'tbl_professional_documents';
		$this->transTbl 			= 'tbl_payment_transaction';
		$this->license_applicationTbl = 'tbl_license_application';
		$this->exam_slotTbl			= 'tbl_book_exam_slot';
		$this->prof_notificationTbl	= 'tbl_professional_notifications';
		$this->prof_licenseTbl		= 'tbl_professional_license';
		$this->exist_certificateTbl	= 'tbl_existing_certificate';
		$this->user_certificateTbl	= 'tbl_user_certificate';
		$this->termsconditionsTbl 	= 'tbl_terms_conditions';
		$this->tutorialTbl 			= 'tbl_tutorial';
		$this->receipientInformationTbl= 'tbl_receipient_information';
		$this->goodstandingTbl = 'tbl_good_standing';
	}

	

	public function get_unread_notifications($userid){
		$this->db->from($this->prof_notificationTbl);
		$this->db->where('user_id', $userid);
		$this->db->where('read_status <', '1');
		$this->db->order_by('profn_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		//print_r($result);exit;
		return $result;		
	}
	public function get_notifications($userid,$read_status){
		$this->db->from($this->prof_notificationTbl);
		$this->db->where('user_id', $userid);
		//if($read_status == 1){
			$this->db->where('read_status', $read_status);
		//}
		$this->db->order_by('profn_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;		
	}
	public function update_notifications($profn_id,$data){
		$this->db->where('profn_id', $profn_id);
		$result = $this->db->update($this->prof_notificationTbl, $data);
   		//echo $this->db->last_query();
		return $result;
	}
	public function get_terms(){
		$this->db->from($this->termsconditionsTbl);
		$this->db->where('type', 'professional');
		$this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;	
		
	}
	public function get_tutorial(){
		$this->db->from($this->tutorialTbl);
		$this->db->where('type', 'professional');
		$this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;	
		
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
	function updateproflicno($data, $id){
		$this->db->where('user_id', $id);
		$this->db->update($this->prof_licenseTbl, $data);
		return true;
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

	function getgraduateRows($id = ''){
		$this->db->select('*,grad_id user_ID,reviewer_status review_status,reviewer_accept_date review_accept_date');
		$this->db->from($this->graduateTbl);
		if($id){
			$this->db->where('grad_id', $id);
			$query = $this->db->get();
			$result = $query->row();
		}else{
			$this->db->order_by('student_name', 'asc');
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
		$query = $this->db->get($this->userTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->num_rows();
		}
		return false;
	}

	public function check_professional_exsits($email){
		$this->db->where('email',$email);
		$query = $this->db->get($this->prof_licenseTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->num_rows();
		}
		return false;
	}
	
	public function fetch_user_details($user_id,$pd_id = false){ 
		$this->db->select('u.*,CONCAT(u.fname," ",u.lname," ",u.name) fullname, p.name profession_name, doc.reviewer_status rev_status, doc.license_no, doc.reviewer_id rev_id, doc.expiry_at validity_date, doc.lic_issue_date, doc.refrence_code refrencecode, doc.lic_qrcode, doc.card_qrcode, un.university_name, ps.name college_name, cn.countries_name, pl.lic_issue_date renew_lic_issue_date, pl.lic_expiry_date renew_lic_expiry_date');
		$this->db->from($this->documentTbl.' doc');
		$this->db->join($this->userTbl.' u','doc.user_id = u.user_ID');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->professionTbl.' ps','u.college = ps.id','left');
		$this->db->join($this->universityTbl.' un','u.university = un.uniid','left');
		$this->db->join($this->countriesTbl.' cn','u.country = cn.countries_id','left');
		$this->db->join($this->prof_licenseTbl.' pl','u.user_ID = pl.user_id','left');
		$this->db->where('u.user_ID',$user_id);
		// $this->db->where('u.status',1); //if presently registered professionals are expired. that's why we have to comment this line.
		
		if($pd_id != false){
			$this->db->where('doc.pd_id',$pd_id);
		}
		$this->db->group_by('u.user_ID');
		$this->db->order_by('doc.pd_id','desc');
		$query = $this->db->get();
		if ($query && $query->num_rows() > 0) {
			return $query->row_object();
		}
		return false;
	}
	public function fetch_user_detailsforcert($user_id){
		$this->db->select('*');
		$this->db->from($this->documentTbl);
		$this->db->where('user_id',$user_id);
		$this->db->order_by('pd_id','desc');
		$this->db->limit(1);
		$q = $this->db->get();
		return $q->row();
	}
	
	public function fetch_graduate_details($user_id){
		
		$this->db->select('u.*,u.grad_id user_ID,u.photo image,u.student_name fname,u.middle_name lname,u.surname name,p.name profession_name');
		$this->db->from($this->graduateTbl.' u');
		$this->db->join($this->professionTbl.' p','u.college_of = p.id','left');
		$this->db->where('u.grad_id',$user_id);
		$query = $this->db->get();
		if ($query && $query->num_rows() > 0) {
			return $query->row_object();
		}
		return false;
	}

	function get_all_details($user_id,$type){
		if($type=='p'){
			return $this->fetch_user_details($user_id);
		}
		if($type=='g'){
			return $this->fetch_graduate_details($user_id);
		}
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
		$query = $this->db->get($tbl_name);
		if ($query && $query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

		
	function get_user_certificate($uid,$uemail = false){
		$this->db->select('ec.*');
		$this->db->from($this->user_certificateTbl.' ec');
		$this->db->join($this->userTbl.' u','ec.user_id=u.user_ID','left');
		$this->db->where('ec.user_id',$uid);
		
		if($uemail !=''){
			$this->db->or_where('ec.user_email',$uemail);
		}
		// $this->db->where('ec.archive',1);
		// $this->db->where('ec.status',1);
		$query = $this->db->get();
		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	
	public function getcertificatelisting($uid, $uemail=null, $status=null, $submitted=null){
		$this->db->select('uc.*');
		$this->db->from($this->user_certificateTbl.' uc');
		$this->db->join($this->userTbl.' u','uc.user_id=u.user_ID','left');
	
		// $this->db->group_start();
		if(!empty($uemail) && $uemail != null){
			$this->db->where('uc.user_id',$uid);
			$this->db->or_where('uc.user_email',$uemail);
		}else{
			$this->db->where('uc.user_id',$uid);
		}
		// $this->db->group_end();

		if(!empty($status) && $status != null){
			if($status == 0){
				$this->db->where('uc.certificate_identify', 0);
			}else if($status == 1){
				$this->db->where('uc.certificate_identify', 1);
			}else{
				$this->db->where('uc.certificate_identify', 2);
			}
		}
		
		if(!empty($submitted) && $submitted != null){
			if($submitted == 'y'){
				$this->db->where('uc.submitted', 'y');
			}
			if($submitted == 'n'){
				$this->db->where('uc.submitted', null);
				// $this->db->or_where('uc.submitted','n');
			}
		}
		$this->db->group_by('uc.id');
		$this->db->order_by('uc.id','DESC');
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		// echo $this->db->last_query(); exit;
		return $result;
	}
		
	public function getPendingCertificate($uemail){
		$this->db->select('uc.*');
		$this->db->from($this->user_certificateTbl.' uc');
		$this->db->join($this->userTbl.' u','uc.user_id=u.user_ID','left');
		$this->db->where('uc.user_email',$uemail);
		$this->db->where('uc.certificate_identify', 0);
		$this->db->where('uc.submitted', null);
		$this->db->order_by('uc.id','DESC');
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		// echo $this->db->last_query(); exit;
		return $result;
	}
		
	public function getSubmittedCertificate($uemail){
		$this->db->select('uc.*');
		$this->db->from($this->user_certificateTbl.' uc');
		$this->db->join($this->userTbl.' u','uc.user_id=u.user_ID','left');
		$this->db->where('uc.user_email',$uemail);
		$this->db->where_in('uc.submitted', array('y','n'));
		$this->db->order_by('uc.id','DESC');
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		// echo $this->db->last_query(); exit;
		return $result;
	}

	public function get_row_array($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$query = $this->db->get($tbl_name);
		if ($query && $query->num_rows() > 0) {
			return $query->row_array();
		}
		return false;
	}	

	public function get_row_object($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		
		$query = $this->db->get($tbl_name);
		if ($query && $query->num_rows() > 0) {
			return $query->row();
		}
		return false;
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
	public function get_result_arrays($tbl_name,$db_field = false,$field = false,$where=false,$group_by=false){
	
		if(!empty($where)){
		
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		
		$query = $this->db->get($tbl_name);
		if ($query && $query->num_rows() > 0) {
			return $query->row();
		}
		return false;
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
	public function get_certificate_count($tbl_name,$where=null,$join=null)
	{
		$this->db->select("*");
		$this->db->from($tbl_name.' as t1');
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as t2','t1.certificate_id=t2.certificate_id','left');
			}
		}
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where('t1.'.$key,$value);
			}
		
		}

		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
			
	}
	public function get_verified_unverified_certificate($tbl_name,$where=null,$join=null)
	{
		$this->db->select("t1.*,t2.certificate_identify as verified_certificate");
		$this->db->from($tbl_name.' as t1');
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as t2','t1.certificate_id=t2.certificate_id','left');
			}
		}
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where('t1.'.$key,$value);
			}
		}

		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
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
					'fname'				=>	trim($post['fname']),
					'lname'				=>	trim($post['lname']),
					'name'				=>	trim($post['name']),
					'country'			=>	trim($post['citizenship']),
					'email'				=>	trim($post['email']),
					'role'				=>	'F',
					'dob' 				=> 	trim($post['birthday']),
					'gender' 			=> 	trim($post['gender']),
					'profession' 		=> 	trim($post['profession']),
					'license_no' 		=> 	trim($post['license_no']),

					'license_validity_date' => 	trim($post['license_validity_date']),
					'license_issued_date' 	=> 	trim($post['license_issued_date']),

					'university' 			=> 	trim($post['university']),
					'other_university' 		=> trim($post['other_university']),
					'college' 				=> 	trim($post['college_of']),
					'other_college' 		=> 	trim($post['other_college']),
					'u_contact'			=>	trim($post['university_contact']),
					'u_address'			=>	trim($post['university_address']),
					'u_website'			=>	trim($post['university_website']),

					'reg_board'			=>	trim($post['reg_board']),
					'reg_country'		=>	trim($post['reg_country']),
					'reg_address'		=>	trim($post['reg_address']),
					'reg_email'			=>	trim($post['reg_email']),
					'reg_website'		=>	trim($post['reg_website']),

					'image'				=>	trim($image),
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
		$query = $this->db->get($this->countriesTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}
		return false;


	}

	public function get_profession(){
		$this->db->where('status',1);
		$this->db->order_by('name','ASC');
		$query = $this->db->get($this->professionTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	public function get_university(){
		$this->db->where('status','1');
		$this->db->order_by('university_name','ASC');
		$query = $this->db->get($this->universityTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}


	public function insert_exam_slot($post){
		$add = array(
					'application_id'=>	$post['application_id'],
					'date'		=>	$post['date'],
					'slot' 		=> 	$post['slot'],
					'added_on' 	=> 	date('Y-m-d H:i:s')
				);

		$this->db->insert($this->exam_slotTbl,$add);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}	

	function login($username, $password){
		$query = $this -> db -> query("SELECT * FROM `tbl_license_application` WHERE email = '".$username."' AND (password = '$password') LIMIT 1");
		if($query -> num_rows() == 1){ return $query->row_array(); } else { return false; }
	}

	function check_unique_email($email){
		$this->db->where('email',$email);
		$query = $this->db->get('tbl_license_application');
		if ($query && $query->num_rows() > 0) {
			return $query->num_rows();
		}
		return false;
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
		$add['added_on'] 	= date('Y-m-d H:i:s');
		$this->db->insert($this->documentTbl,$add);
		$data['insert_id'] 	= $this->db->insert_id(); 
		$data['uid'] 		= $post['user_id']; 
   		return  $data;
	}
	public function update_expiry($id,$data){
		$this->db->where('user_id',$id);
		$this->db->update($this->documentTbl,$data);
	}
	public function fetch_userdoc_details($id){
		$this->db->where('user_id',$id);
		$q= $this->db->get($this->documentTbl);
		return $q->row();
	}
	public function getprofdoc_by_doc_id($doc_id){
		$this->db->where('pd_id',$doc_id);
		$q= $this->db->get($this->documentTbl);
		return $q->row();
	}

	public function insertTransaction($data){
		$insert = $this->db->insert($this->transTbl,$data);
		return $insert?true:false;
	}

	public function getprofdetails($fname,$lname,$name,$email,$gender,$birthday,$registration_code){
		$this->db->select('u.*,u.fname,u.lname,u.name,p.name collegeofname,un.university_name');
		
		$this->db->from($this->documentTbl.' doc');
		$this->db->join($this->userTbl.' u','doc.user_id = u.user_ID');
		$this->db->join($this->professionTbl.' p', 'u.college = p.id','left');		
		$this->db->join($this->universityTbl.' un', 'u.university = un.uniid','left');	
		$this->db->where('doc.reviewer_status', '1');
		$this->db->like('u.fname', $fname);
		$this->db->like('u.lname', $lname);
		$this->db->like('u.name', $name);
		$this->db->where('u.email', $email);
		$this->db->where('u.dob', $birthday);
		$this->db->where('u.gender', $gender);
		$this->db->where('u.registration_no', $registration_code);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		$result = $query->row();
		return $result;		
	}

	public function match_profdetails($fname,$lname,$name,$email,$gender,$birthday,$registration_code){
		$this->db->select('u.*,u.fname,u.lname,u.name,p.name collegeofname,un.university_name,c.countries_name');
		
		// $this->db->from($this->documentTbl.' doc');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->professionTbl.' p', 'u.college = p.id','left');		
		$this->db->join($this->universityTbl.' un', 'u.university = un.uniid','left');
		$this->db->join($this->countriesTbl.' c', 'c.countries_id = u.country','left');
		// $this->db->where('doc.reviewer_status', '1');
		$this->db->like('u.fname', $fname);
		$this->db->like('u.lname', $lname);
		$this->db->like('u.name', $name);
		$this->db->where('u.email', $email);
		$this->db->where('u.dob', $birthday);
		$this->db->where('u.gender', $gender);
		$this->db->where('u.registration_no', $registration_code);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		$result = $query->row();
		return $result;		
	}

	function get_graduate_details($fname,$lname,$name,$email,$gender,$birthday,$registration_code){
		$this->db->select('u.*,u.grad_id user_ID,u.student_name fname,u.middle_name lname,u.surname name,p.name collegeofname,un.university_name');
		
		// $this->db->from($this->documentTbl.' doc');
		// $this->db->join($this->graduateTbl.' u','doc.user_id = u.grad_id');
		$this->db->from($this->graduateTbl.' u');
		$this->db->join($this->professionTbl.' p', 'u.college_of = p.id','left');		
		$this->db->join($this->universityTbl.' un', 'u.uniid = un.uniid','left');		
		$this->db->where('u.reviewer_status', '1');
		// $this->db->where('doc.reviewer_status', '1');
		$this->db->like('u.student_name', $fname);
		$this->db->like('u.middle_name', $lname);
		$this->db->like('u.surname', $name);
		$this->db->where('u.email', $email);
		$this->db->where('u.dob', $birthday);
		$this->db->where('u.gender', $gender);
		$this->db->where('u.registration_no', $registration_code);
		$query = $this->db->get();
		$result = $query->row();
		return $result;		
	}

	function get_user_details($fname,$lname,$name,$email,$gender,$birthday,$registration_code){
		$user = $this->match_profdetails($fname,$lname,$name,$email,$gender,$birthday,$registration_code);
		if(empty($user)){
			$user = $this->get_graduate_details($fname,$lname,$name,$email,$gender,$birthday,$registration_code);
			// echo $this->db->last_query();
		}
		return $user;
	}

	function get_user_type($registration_code){
		$this->db->where('registration_no',$registration_code);
		$query = $this->db->get($this->prof_licenseTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	function get_one_professional_license($user_id,$candidate_type){

		$this->db->where('user_id',$user_id);
		$this->db->where('candidate_type',$candidate_type);
		$query = $this->db->get($this->prof_licenseTbl);
		if ($query && $query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	function insertnotifications($data){
		$insert = $this->db->insert($this->prof_notificationTbl,$data);
		return $insert?true:false;
	}

	function fetchPassword($id){	
		$this->db->select('password');
		$this->db->from($this->prof_licenseTbl);	
		$this->db->where('pl_id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;			
	}

	function updatePassword($data, $id){		
		$this->db->where('pl_id', $id);
		$this->db->update($this->prof_licenseTbl, $data);
		//echo $this->db->last_query(); die;	
		return true;			
	}


	public function savecard($post){
		$userid = $this->session->userdata('user_ID');

		if(isset($_FILES["photos"]) && !empty($_FILES["photos"]['name'])){
		$config['upload_path'] = './assets/uploads/card/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';      
		$ext = explode('.',$_FILES["photos"]["name"]);        
		$imageName = 'CARD_'.time().'.'.end($ext);
		$config['file_name'] = $imageName;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('photos'))
		{       
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
			// redirect('professioanl/applicant/card_listing');   
			// die;              
		}  
		$data['photo'] = $imageName;
		}

		$data['user_id']         = $userid; 
		$data['card_no']         = $post['card_no']; 
		$data['card_name']       = $post['card_name']; 
		$data['date_issued']     = $post['date_issued']; 
		$data['expiry_date']     = $post['expiry_date'];  
		$data['issue_by']     	 = $post['issue_by'];  
		$data['status']          = 1; 
		$data['added_on']        = date('Y-m-d h:i:s');  
		
		$this->db->insert($this->cardTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		return  ($insert_id > 0)? $insert_id : 0;
	}

	public function get_all_cards($uid){
		$this->db->from($this->cardTbl);	
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;	
	} 

	public function delete_cards($id,$uid){
		$this->db->where('user_id',$uid);
		$result = $this->db->delete($this->cardTbl,'id',$id);
		return $result;
	}

	public function get_licensehistory($user_id){
		$this->db->select('p.*,doc.license_no, doc.reviewer_status,doc.reviewer_id,doc.updated_at issued_date, doc.expiry_at validity_date, doc.refrence_code');
		// $this->db->select('p.*');
		$this->db->from($this->transTbl.' p');
		$this->db->join($this->documentTbl.' doc', 'p.doc_refrence_id = doc.pd_id');		
		$this->db->where('p.user_id', $user_id);
		$this->db->where('p.payment_for', 'PR');
		$this->db->where('p.txn_id !=', '');
		$this->db->order_by('p.payment_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		// echo $this->db->last_query(); exit;
		return $result;		
	}

	public function get_purchaselist($user_id){
		$this->db->select('p.*');
		$this->db->from($this->transTbl.' p');
		$this->db->where('p.user_id', $user_id);
		$this->db->where('p.payment_for !=', 'G');
		$this->db->where('p.txn_id !=', '');
		$this->db->order_by('p.payment_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		// echo $this->db->last_query(); exit;
		return $result;	
	}

	public function get_registered_professional($user_id){
		$this->db->select('p.*');
		$this->db->from($this->prof_licenseTbl.' p');
		$this->db->where('p.user_id', $user_id);
		// $this->db->where('p.payment_for', 'PR');
		$query = $this->db->get();
		$result = $query->row();
		// echo $this->db->last_query(); exit;
		return $result;	
	}
		
	public function professional_registration_documents($data){
		$this->db->insert($this->documentTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}
	
	public function get_latest_license($uid){
		$this->db->select('d.*, u.registration_no');
		$this->db->from($this->documentTbl.' d');
		$this->db->join($this->userTbl.' u','u.user_ID = d.user_id');
		$this->db->where('d.user_id', $uid);
		$this->db->order_by('d.pd_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;	
	}
	public function get_cert_of_registration($uid){
		$this->db->select('d.*, u.registration_no');
		$this->db->from($this->documentTbl.' d');
		$this->db->join($this->userTbl.' u','u.user_ID = d.user_id');
		$this->db->where('d.user_id', $uid);
		$this->db->order_by('d.pd_id', 'asc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;	
	}
	public function get_all_licenses_of_user($uid){
		$this->db->from($this->documentTbl);
		$this->db->where('user_id', $uid);
		$this->db->where('reviewer_id >', 0);
		$this->db->where('reviewer_status', '1');
		$this->db->order_by('pd_id', 'desc');
		// $this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;	
	}

	public function insert_receipient_information($data){
		$this->db->insert($this->receipientInformationTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}
	public function update_receipient_information($data, $ri_id){
		$this->db->where('ri_id', $ri_id);
		$result = $this->db->update($this->receipientInformationTbl, $data);
   		//echo $this->db->last_query();
		return $result;
	}
	public function get_receipient_details($ri_id){
		$this->db->select('ri.*');
		$this->db->from($this->receipientInformationTbl.' ri');
		$this->db->where('user_id', $ri_id);
		$this->db->order_by('ri_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function insert_good_standing($data){
		$this->db->insert($this->goodstandingTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}
	public function update_good_standing($data, $gs_id){
		$this->db->where('gs_id', $gs_id);
		$result = $this->db->update($this->goodstandingTbl, $data);
   		//echo $this->db->last_query();
		return $result;
	}
	public function get_goodstand_details($gs_id){
		$this->db->select('gs.*');
		$this->db->from($this->goodstandingTbl.' gs');
		$this->db->where('gs_id', $gs_id);
		//$this->db->order_by('gs_id', 'desc');
		//$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
} 
?>