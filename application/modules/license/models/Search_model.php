<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

	function __construct() {
		$this->userTbl 				= 'tbl_users';
		$this->professionaDocTbl 	= 'tbl_professional_documents';
		$this->contactTbl 			= 'tbl_contact_us';
		$this->universityTbl		= 'tbl_university';
		$this->courseTbl 			= 'tbl_course_documents';
		$this->trainingTbl 			= 'tbl_training_documents';
		$this->graduateTbl 			= 'graduates';
		$this->cepTbl 				= 'tbl_ce_provider';
		$this->cepdocumentsTbl 		= 'tbl_cep_documents';
		$this->exam_resultTbl  		= 'tbl_exam_result';
		$this->universitydocumentsTbl = 'tbl_university_documents';
		$this->examscheduleTbl 		= 'tbl_examination_schedule';
		$this->profLicenseTbl 		= 'tbl_professional_license';
		$this->receipientinformationTbl = 'tbl_receipient_information';
		$this->goodstandingTbl = 'tbl_good_standing';
	}

	function search($referenceNo)
	{
		if(!empty($referenceNo))
		{
			$this->db->select("*");
			$this->db->from($this->userTbl);
			$this->db->where('license_no',$referenceNo);
			$q = $this->db->get();
			if(($q !== false) ? $q->num_rows() : 0)
			{
				return $q->result()[0]->user_ID;
			}
			return false;
		}
	}

	function universitysearch($referenceNo)
	{
		if(!empty($referenceNo)){
			$this->db->select("ud.*,u.uniid,u.university_name,u.college_of,u.email,u.contact_no");
			$this->db->from($this->universitydocumentsTbl.' ud');
			$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
			//$this->db->where('ud.document_for','n');
			$this->db->where('ud.accreditation_number',$referenceNo);
			$this->db->or_where('ud.refrence_code',$referenceNo);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}

	function coursesearch($referenceNo)
	{
		if(!empty($referenceNo)){
			$this->db->select("*");
			$this->db->from($this->courseTbl);
			$this->db->where('refrence_code',$referenceNo);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}

	function coursesearchbyname($courseName)
	{
		if(!empty($courseName)){
			$this->db->select("*");
			$this->db->from($this->courseTbl);
			$this->db->like('course_title',$courseName);
			$this->db->where('reviewer_status','1');
			$this->db->where('reviewer_id !=',0);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}

	function trainingsearchbyname($trainingName)
	{
		if(!empty($trainingName)){
			$this->db->select("*");
			$this->db->from($this->trainingTbl);
			$this->db->like('training_title',$trainingName);
			$this->db->where('reviewer_status','1');
			$this->db->where('reviewer_id !=',0);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}
	function trainingsearch($referenceNo)
	{
		if(!empty($referenceNo)){
			$this->db->select("*");
			$this->db->from($this->trainingTbl);
			$this->db->where('refrence_code',$referenceNo);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}

	function profesinalsearch($referenceNo)
	{
		if(!empty($referenceNo))
		{
			$this->db->select("doc.*, p.user_ID, p.exam_code, p.registration_no, p.attendance, p.attendence_mark_ip, p.license_no, p.license_validity_date, p.license_issued_date");
			$this->db->from($this->professionaDocTbl.' doc');
			$this->db->join($this->userTbl.' p','doc.user_id = p.user_ID');
			
			$this->db->where('doc.refrence_code',$referenceNo);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}

	function graduatesearch($referenceNo)
	{
		if(!empty($referenceNo))
		{
			$this->db->select("*");
			$this->db->from($this->graduateTbl);
			$this->db->where('refrence_code',$referenceNo);
			$query = $this->db->get();
			$result = $query->row_object();
			return $result;	
		}
	}

	function graduateresult($uid)
	{
		if(!empty($uid))
		{
			$this->db->select("*");
			$this->db->from($this->exam_resultTbl);
			$this->db->where('user_id',$uid);
			$query = $this->db->get();
			$result = $query->row();
			return $result;	
		}
	}

	function professionalresult($uid,$examdate)
	{
		if(!empty($uid))
		{
			$this->db->select("er.*,er.status exam_status, es.date");
			$this->db->from($this->exam_resultTbl.' er');
			$this->db->join($this->examscheduleTbl.' es','er.question_set = es.es_id');
			$this->db->where('er.user_id',$uid);
			$this->db->where('date(es.date)',$examdate);
			// $this->db->where('question_set',$esid);
			$query = $this->db->get();
			$result = $query->row();
			return $result;	
		}
	}

	function get_cep_reference_search($ref_no)
	{
		if(!empty($ref_no))
		{
			$this->db->select("cd.*,cep.provider_id,cep.updated_at as cep_update_date,cep.status as cep_status,cep.reference_no,cep.business_name,cep.email");
			$this->db->from($this->cepdocumentsTbl.' cd');
			$this->db->join($this->cepTbl.' cep','cd.provider_id = cep.provider_id','left');
			$this->db->where('cd.reference_no',$ref_no);
			$query = $this->db->get();
			$result = $query->row();
			
			if($query->num_rows() > 0){
				return $result;
			}	

			return false;	
		}
	}
	function get_cep_accridiation_search($ref_no)
	{
		if(!empty($ref_no))
		{
			$this->db->select("cd.*,cep.provider_id,cep.updated_at as cep_update_date,cep.status as cep_status,cep.reference_no,cep.business_name,cep.email");
			$this->db->from($this->cepdocumentsTbl.' cd');
			$this->db->join($this->cepTbl.' cep','cd.provider_id = cep.provider_id','left');
			$this->db->where('cd.accreditation_no',$ref_no);
			$this->db->order_by('cd.id','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			$result = $query->row();
			//echo $this->db->last_query(); die;
			if($query->num_rows() > 0){
				return $result;
			}	

			return false;	
		}
	}
	function get_course_accridiation_search($ref_no)
	{
		if(!empty($ref_no))
		{
			$this->db->select("cou.*,cep.business_name,cep.email");
			$this->db->from($this->courseTbl.' cou');
			$this->db->join($this->cepTbl.' cep','cou.provider_id = cep.provider_id','left');
			$this->db->where('cou.accreditation_no',$ref_no);
			$query = $this->db->get();
			$result = $query->row();
			//echo $this->db->last_query(); die;
			if($query->num_rows() > 0){
				return $result;
			}	

			return false;	
		}
	}
	function get_training_accridiation_search($ref_no)
	{
		if(!empty($ref_no))
		{
			$this->db->select("tra.*,cep.business_name,cep.email");
			$this->db->from($this->trainingTbl.' tra');
			$this->db->join($this->cepTbl.' cep','tra.provider_id = cep.provider_id','left');
			$this->db->where('tra.accreditation_no',$ref_no);
			$query = $this->db->get();
			$result = $query->row();
			//echo $this->db->last_query(); die;
			if($query->num_rows() > 0){
				return $result;
			}	

			return false;	
		}
	}
	
	public function get_professionalexampass_search($examcode){
		
		$this->db->select('u.*,u.user_ID user_id, CONCAT(u.fname," ",u.lname," ",u.name) fullname, doc.reviewer_status , doc.license_no, doc.reviewer_id , doc.expiry_at validity_date, doc.updated_at issued_date');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->professionaDocTbl.' doc','u.user_ID = doc.user_id');
		$this->db->where('u.exam_code',$examcode);
		$query = $this->db->get();
		$result = $query->row();
		if($query->num_rows() > 0){
			return $result;
		}	

		return false;
	}
	
	public function get_professional_registration_no_search($regnumber){
		
		$this->db->select('u.*,u.user_ID user_id, CONCAT(u.fname," ",u.lname," ",u.name) fullname, doc.reviewer_status , doc.license_no, doc.reviewer_id , doc.expiry_at validity_date, doc.updated_at issued_date');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->professionaDocTbl.' doc','u.user_ID = doc.user_id');
		$this->db->where('u.registration_no',$regnumber);
		$query = $this->db->get();
		$result = $query->row();
		if($query->num_rows() > 0){
			return $result;
		}	

		return false;
	}
	
	public function get_graduateexampass_search($examcode){
		
		$this->db->select('u.*,u.grad_id user_id, CONCAT(u.student_name," ",u.middle_name," ",u.surname) fullname ,u.reviewer_status , u.reviewer_id , u.validity validity_date, u.date_issued issued_date');
		$this->db->from($this->graduateTbl.' u');
		$this->db->where('u.examcode',$examcode);
		$query = $this->db->get();
		$result = $query->row();
		if($query->num_rows() > 0){
			return $result;
		}	

		return false;
	}
	public function get_licenseno_search($licenseno){
		$this->db->select('pl.*');
		$this->db->from($this->profLicenseTbl.' pl');
		$this->db->where('pl.license_no',$licenseno);
		$this->db->limit(1);
		$query=$this->db->get();
		$result=$query->row();
		if($query->num_rows() > 0){
			return $result;
		}
		return false;
	}
	public function receipient_information_search($refrenceno){
		$this->db->select('ri.*');
		$this->db->from($this->receipientinformationTbl.' ri');
		$this->db->where('ri.refrence_code',$refrenceno);
		$this->db->limit(1);
		$query=$this->db->get();
		$result=$query->row();
		if($query->num_rows() > 0){
			return $result;
		}
		return false;
	}
	public function good_standing_search($refrenceno){
		$this->db->select('gs.*');
		$this->db->from($this->goodstandingTbl.' gs');
		$this->db->where('gs.refrence_code',$refrenceno);
		$this->db->limit(1);
		$query=$this->db->get();
		$result=$query->row();
		if($query->num_rows() > 0){
			return $result;
		}
		return false;
	}
} ?>