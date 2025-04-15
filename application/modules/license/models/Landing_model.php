<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_model extends CI_Model {
	private $userTbl;
	private $contactTbl;
	private $prof_licenseTbl;
	private $graduatesTbl;
	private $cepTbl;
	private $cepDocTbl;
	private $schoolTbl;
	private $universityTbl;
	private $universityDocTbl;
	private $professionTbl;
	private $courseTbl;
	private $bannerTbl;
	private $documentTbl;
	private $userCertificateTbl;
	private $existingCertificateTbl;
	function __construct() {
		$this->userTbl 			= 'tbl_users';
		$this->contactTbl 		= 'tbl_contact_us';
		$this->prof_licenseTbl 	= 'tbl_professional_license';
		$this->graduatesTbl 	= 'graduates';
		$this->cepTbl    		= 'tbl_ce_provider';
		$this->cepDocTbl    	= 'tbl_cep_documents';
		$this->schoolTbl    	= 'tbl_schools';
		$this->universityTbl    = 'tbl_university';
		$this->universityDocTbl = 'tbl_university_documents';
		$this->professionTbl 	= 'tbl_profession';
		$this->courseTbl 		= 'tbl_course_documents';
		$this->bannerTbl 		= 'tbl_banner';
		$this->documentTbl 		= 'tbl_professional_documents';
		$this->userCertificateTbl 	= 'tbl_user_certificate';
		$this->existingCertificateTbl 	= 'tbl_existing_certificate';
	}

	public function topbanners(){
		$this->db->from($this->bannerTbl);
		$this->db->where('bnr_status', '1');
		$this->db->order_by("display_position", "asc");
		//echo $this->db->last_query(); exit;
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false; 
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
	
	public function fetch_prof_doc($doc_id){

		$this->db->select('doc.*');
		$this->db->from($this->documentTbl.' doc');
		$this->db->join($this->userTbl.' p','doc.pd_id=p.user_ID');
		$this->db->where('pd_id',$doc_id);
		$result = $this->db->get()->row_object();
   		//echo $this->db->last_query(); exit;
		return $result;
	}

	public function fetch_doc_details($doc_id){
		$this->db->from($this->documentTbl);
		$this->db->where('pd_id',$doc_id);
		$result = $this->db->get()->row_object();
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
	public function get_result_arrays($tbl_name,$db_field = false,$field = false,$where=false,$group_by=false,$join=false){
	
		$custom_fields = "t1.*";

		if($join!="")
		{
			$custom_fields .= ",t2.name as profession_name,t3.countries_name as country_name";
		}

		$this->db->select($custom_fields);
		$this->db->from($tbl_name. " as t1");

		if($join!="")
		{
			$this->db->join('tbl_profession as t2','t1.profession=t2.id','left');
			$this->db->join('tbl_countries as t3','t1.country=t3.countries_id','left');
		}
		

		if(!empty($where)){
		
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		
		$result = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($result->num_rows() > 0)
		{
			return $result->row();
		}
		return false;
		//$result = $this->db->get($tbl_name)->row();
   		//echo $this->db->last_query(); exit;
		
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
				$this->db->where($key,$value);
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
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}

	function get_pprofessional($count = false) {
		$this->db->select("u.image, pl.pl_id, pl.user_id, pl.username, pl.payment_status"); // Select only needed columns
		$this->db->from($this->userTbl . ' u');
		$this->db->join($this->prof_licenseTbl . ' pl', 'u.user_ID = pl.user_id', 'inner');
		$this->db->where('pl.payment_status', '1');
		$this->db->group_by('pl.username, u.image, pl.pl_id, pl.user_id, pl.payment_status'); // Add all selected columns
		$this->db->order_by("pl.pl_id", "DESC");
	
		$q = $this->db->get();
		if (($q !== false) ? $q->num_rows() : 0) {
			return ($count == 1) ? $q->num_rows() : $q->result();
		}
		return false;
	}
		

	function get_professional_details($pl_id){
		
		$this->db->select("pl.*");
		$this->db->from($this->prof_licenseTbl.' pl');
		$this->db->where('pl.user_id',$pl_id);
		$this->db->where('pl.payment_status','1');
		$this->db->where('pl.license_no !=','');
		$this->db->order_by("pl.pl_id", "DESC");
		$this->db->limit(1);
		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;
	}		
		
	function get_gprofessional($count = false) {
		$this->db->select("g.photo AS image, pl.pl_id, pl.user_id, pl.username, pl.payment_status");
		$this->db->from($this->graduatesTbl . ' g');
		$this->db->join($this->prof_licenseTbl . ' pl', 'g.grad_id = pl.user_id', 'inner');
		$this->db->where('pl.payment_status', '1');
		
		// Add all selected columns to GROUP BY
		$this->db->group_by('pl.username, g.photo, pl.pl_id, pl.user_id, pl.payment_status');
		
		$this->db->order_by("pl.pl_id", "DESC");
	
		$q = $this->db->get();
		if (($q !== false) ? $q->num_rows() : 0) {
			return ($count == 1) ? $q->num_rows() : $q->result();
		}
		return false;
	}
	
		
	function get_cep($count = false) {
		$this->db->select("doc.id, doc.provider_id, doc.review_accept_date, c.business_name, c.company_logo");
		$this->db->from($this->cepDocTbl . ' doc');
		$this->db->join($this->cepTbl . ' c', 'doc.provider_id = c.provider_id', 'left');
		$this->db->where('doc.reviewer_status', '1');
		$this->db->where('doc.reviewer_id >', 0);
	
		// Add all selected columns to GROUP BY
		$this->db->group_by('doc.provider_id, doc.id, doc.review_accept_date, c.business_name, c.company_logo');
	
		$this->db->order_by("doc.review_accept_date", "DESC");
	
		$q = $this->db->get();
		if (($q !== false) ? $q->num_rows() : 0) {
			return ($count == 1) ? $q->num_rows() : $q->result();
		}
		return false;
	}
	
		
	function get_schools($count=false){
		$this->db->select("s.*,u.university_name");
		$this->db->from($this->schoolTbl.' s');
		$this->db->join($this->universityTbl.' u','s.uniid = u.uniid','left');
		$this->db->group_by('s.email');
		$this->db->where('s.status','1');
		$this->db->order_by("s.sch_id", "DESC");

		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			if($count==1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}	
		
	function get_university($count=false){
		$this->db->select("doc.*,un.college_logo, un.university_name, p.name college_name");
		$this->db->from($this->universityDocTbl.' doc');
		$this->db->join($this->universityTbl.' un','doc.uniid = un.uniid','left');
		$this->db->join($this->professionTbl.' p','un.college_of = p.id','left');
		// $this->db->group_by('un.email');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('doc.reviewer_id >',0);
		$this->db->order_by("doc.review_accept_date", "DESC");

		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			if($count==1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}
		
	function get_course($count=false){
		$this->db->select("c.*,p.business_name cep_name");
		$this->db->from($this->courseTbl.' c');
		$this->db->join($this->cepTbl.' p','c.provider_id = p.provider_id','left');
		// $this->db->group_by('c.email');
		$this->db->where('c.reviewer_status','1');
		$this->db->order_by("c.review_accept_date", "DESC");

		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			if($count==1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}	
	
	public function is_unique_certficate($certificate_id){
		$this->db->where('certificate_id',$certificate_id);
		$query = $this->db->get($this->userCertificateTbl);
		$result = $query->row(); 
		return $result;
	}	
	
	public function matchdata($data){
		$this->db->select('pl.*, CONCAT(pl.fname," ",pl.lname," ",pl.name) fullname,');
		$this->db->from($this->prof_licenseTbl.' pl');
		$this->db->like('fname',trim($data['fname']));
		$this->db->like('lname',trim($data['lname']));
		$this->db->like('name',trim($data['name']));
		$this->db->where('username',trim($data['email']));
		$this->db->where('gender',trim($data['gender']));
		$this->db->where('biirthday',trim($data['birthday']));
		$this->db->where('profession',trim($data['profession']));
		$this->db->where('license_no',trim($data['license_number']));
		$this->db->where('lic_issue_date',trim($data['date_issued']));
		$this->db->where('lic_expiry_date',trim($data['validity_date']));
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row(); 
		return $result;
	}

	public function is_license_expired($uid){
		$this->db->where('user_id',$uid);
		$this->db->where('license_no!=','');
		$query = $this->db->get($this->documentTbl);
		$result = $query->row(); 
		return $result;
	} 
		
	public function delete_uploded_certificate($uid,$id){
		$this->db->where(array('user_id'=>$uid,'id'=>$id));
		$result = $this->db->delete($this->userCertificateTbl);
   		// echo $this->db->last_query();
		return $result;
	}
	
	public function fetch_one_certificate($id,$uid){
		$this->db->where('id',$id);
		$this->db->where('user_id',$uid);
		$result = $this->db->get($this->userCertificateTbl)->row();
		return $result;
	}

	public function matchCertificate($id,$uid)
		{
			$this->db->select('uc.id');
			$this->db->from($this->userCertificateTbl.' uc');
			$this->db->join($this->existingCertificateTbl.' ec','uc.certificate_id = ec.certificate_id');
			$this->db->where('uc.id',$id);
			$this->db->where('uc.user_id',$uid);
			$this->db->where('ec.source','ceonpoint');
			$sql = $this->db->get();
			$result = $sql->row();
			if(count($result) > 0){
				return $result->id; 
			}else{
				return 0; 
			}
		}

	public function get_verified_certificate($uid,$certificate_identify){
		
		$this->db->from($this->userCertificateTbl);
		$this->db->where('user_id',$uid);
		$this->db->where('submitted','y');
		$this->db->where('certificate_identify',$certificate_identify);
		// $this->db->where('archive',1);
		// $this->db->where('status',0); //not paid for certificate
		$sql = $this->db->get();
		if($sql->num_rows() > 0){
			return $sql->result(); 
		}else{
			return 0; 
		}
	}

} ?>