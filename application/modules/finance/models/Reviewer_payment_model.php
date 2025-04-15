<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer_payment_model extends CI_Model {
	
	public function  __construct()
	{
		parent::__construct();
		// $this->prefix  = $this->db->dbprefix;
		$this->paymentTbl 		= 'tbl_payment_transaction';
		$this->userTbl    		= 'tbl_users';
		$this->professionTbl 	= 'tbl_profession';
		$this->courseTbl    	= 'tbl_course';
		$this->coursedocumentsTbl = 'tbl_course_documents';
		$this->trainingTbl    	= 'tbl_training';
		$this->trainingdocumentsTbl = 'tbl_training_documents';
		$this->cepTbl    		= 'tbl_ce_provider';
		$this->countryTbl    	= 'tbl_countries';
		$this->pDocTbl    		= 'tbl_professional_documents';
		$this->universityTbl    = 'tbl_university';
		$this->universitydocumentsTbl    = 'tbl_university_documents';
		$this->adminTbl    		= 'tbl_admin';
		$this->graduatesTbl    	= 'graduates';
		$this->universityreviewertbl_cep_commentsentTbl    = 'tbl_university_reviewer_comment';
		$this->professionalreviewercommentTbl    = 'tbl_professional_reviewer_comment';
		$this->graduates_reviewer_commentTbl    = 'tbl_graduates_reviewer_comment';
		$this->coursereviewercommentTbl    = 'tbl_course_reviewer_comment';
		$this->trainingdocumentsreviewercommentTbl    = 'tbl_training_documents_reviewer_comment';
		$this->paymenttransactionTbl    = 'tbl_payment_transaction';
		$this->tbl_cep_documents = 'tbl_cep_documents';
		$this->cep_commentsTbl = 'tbl_cep_comments';
		$this->book_examTbl = 'tbl_book_exam';
		$this->examination_scheduleTbl = 'tbl_examination_schedule';
	}
	

	public function save($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		// echo $this->db->last_query();
   		return  $insert_id;
	}
		
	public function update($tbl_name,$data,$db_id,$id){
		$this->db->where($db_id, $id);
		$result = $this->db->update($tbl_name, $data);
   		//echo $this->db->last_query(); exit;
		return $result;
	}
	
	public function delete($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->delete($tbl_name);
   		// echo $this->db->last_query();
		return $result;
	}

	public function count_rows($tbl_name,$db_field=false,$field=false){
		if($db_field){
		$this->db->where($db_field,$field);
		}
		$query  = $this->db->get($tbl_name);
		$result = $query->num_rows();
   		// echo $this->db->last_query();
		return $result;
	}

	public function get_result_array($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$result = $this->db->get($tbl_name)->result_array();
   		// echo $this->db->last_query();
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
   		// echo $this->db->last_query();
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
	public function get_payment_details($where=null,$join=null,$group_by=null)
	{
		$this->db->select("t1.image as user_image,t2.certificate_identify as verified_certificate,t1.user_ID,t1.name as user_name,t2.added_on,t2.units,t2.id user_certificate_id,t2.certificate_id,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t1.email=t2.user_email','inner');
		
		
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as '.$key,$key.'.certificate_id=t2.certificate_id','inner');
			}
		}
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		if($group_by!="")
		{
			$this->db->group_by('t1.user_id');	
		}

		
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}
	public function get_payment_detail_row_count($where=null,$join=null)
	{
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t1.email=t2.user_email','inner');
		
		
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as '.$key,$key.'.certificate_id=t2.certificate_id','inner');
			}
		}
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}


		$this->db->group_by('t1.user_id');
		$q = $this->db->get();
		//echo $this->db->last_query();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}
	public function approved_certificate()
	{
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t2.user_email=t1.email','inner');
		$this->db->join('tbl_existing_certificate as t5','t5.certificate_id=t2.certificate_id','inner');
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		$this->db->where('t5.certificate_identify',1);
		$this->db->where('t2.certificate_identify',0);
		$this->db->group_by('t2.user_email');
		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}
	public function get_payment_approved_row_count()
	{
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t2.user_email=t1.email','inner');
		$this->db->join('tbl_existing_certificate as t5','t5.certificate_id=t2.certificate_id','inner');
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		$this->db->where('t5.certificate_identify',1);
		$this->db->where('t2.certificate_identify',1);
		$this->db->group_by('t2.user_email');
		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}
	public function pending_certificate()
	{
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t2.user_email=t1.email','inner');
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		$this->db->where_not_in('t2.certificate_id','select certificate_id from tbl_existing_certificate');
		$this->db->group_by('t2.user_email');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}

	public function get_payment_pending_row_count()
	{
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t2.user_email=t1.email','inner');
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		$this->db->where_not_in('t2.certificate_id','select certificate_id from tbl_existing_certificate');
		$this->db->group_by('t2.user_email');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}

	public function get_users($data){

		


			$this->db->select("t1.*");
			$this->db->from('tbl_users as t1');
			if(!empty($data))
			{
				if(isset($data['name']) && $data['name']!="")
				{
					$this->db->where('t1.name',$data['name']);
				}	
				if(isset($data['profession']) && $data['profession']!="")
				{
					
					$this->db->where('t1.profession',$data['profession']);
					
				}
				if(isset($data['status']) && $data['status']!="")
				{
					
					$this->db->where('t1.status',$data['status']);
					
				}
				if(isset($data['gender']) && $data['gender']!="")
				{
					
					$this->db->where('t1.gender',$data['gender']);
					
				}
			}
			$q  = $this->db->get();

			//echo $this->db->last_query(); exit;
			if(($q !== false) ? $q->num_rows() : 0)
			{
				return $q->result_array();
			}
			return false;




	}
	public function get_ce_provider_payment_details($count = false, $where=null)
	{
		$this->db->select("t1.*, t1.id doc_id, t1.reviewer_id rev_id, t1.reviewer_status rev_status, t2.business_name, t2.business_no, t2.email, t2.provider_id pid, t3.payment_gross amount, t3.payment_status, t3.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as t1');
		$this->db->join($this->cepTbl.' as t2','t1.provider_id = t2.provider_id','inner');
		$this->db->join($this->paymenttransactionTbl .' as t3','t3.user_id = t1.provider_id','inner');
		$this->db->join($this->adminTbl .' as t4','t1.reviewer_id = t4.user_ID','left');
		$this->db->where('t3.payment_for','CEP');
		$this->db->where('t1.reference_no !=','');

		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		$this->db->order_by('t3.user_id','desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result_array();
			}
		}
		return false;
	}




	public function get_foreign_applcaition($where=null,$group_by=null)
	{
		$this->db->select("u.*,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname"); 
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->paymentTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		if($group_by!="")
		{
			$this->db->group_by('pt.user_id');	
		}

		$this->db->order_by('pt.user_id','DESC');	
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result();
		}
		return false;
	}

	public function get_foreign_applcaition_count($where=null,$group_by=null)
	{
		$this->db->select("u.*,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id");
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->paymentTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}

		if($group_by!="")
		{
			$this->db->group_by('pt.user_id');	
		}

		$q = $this->db->get();
		//echo $this->db->last_query();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}
	public function get_online_course_applcaition($where=null,$group_by=null)
	{
		//$this->db->select("c.*, u.business_name,u.company_logo,u.email,con.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname");
		$this->db->select("c.*, u.business_name,u.company_logo,u.email,pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname");
		$this->db->from($this->coursedocumentsTbl.' c');
		$this->db->join($this->cepTbl.' u','c.provider_id = u.provider_id');
		$this->db->join($this->paymentTbl.' pt','c.cor_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl.' rev', 'c.reviewer_id = rev.user_ID','left');
		$this->db->where('c.licence_applied','1');
		$this->db->where('pt.payment_for','C');
		$this->db->where('pt.txn_id!=','');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		/* if($group_by!="")
		{
			$this->db->group_by('pt.user_id');	
		} */
		$this->db->order_by('c.cor_doc_id','desc');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result();
		}
		return false;
	} 

	public function get_online_course_applcaition_count($where=null,$group_by=null)
	{
		$this->db->select("c.*, u.*, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->from($this->coursedocumentsTbl.' c');
		$this->db->join($this->cepTbl.' u','c.provider_id = u.provider_id');
		$this->db->join($this->paymentTbl.' pt','u.provider_id = pt.user_id','inner');
		$this->db->join($this->adminTbl.' rev', 'c.reviewer_id = rev.user_ID','left');
		$this->db->where('c.licence_applied','1');
		$this->db->where('pt.payment_for','C');
		$this->db->where('pt.txn_id!=','');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}

		if($group_by!="")
		{
			$this->db->group_by('pt.user_id');	
		}

		$q = $this->db->get();
		//echo $this->db->last_query();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}

	public function change_doc_status($post){
		$this->db->where('pd_id', $post['id']);
		$value = array(
			'reviewer_id'=> $post['reviewer_id'],
			'status'=> $post['status'],
			'comment'=> $post['comment'],
			'updated_at'=> date('Y-m-d')
		);
		$result = $this->db->update($this->pDocTbl, $value);
		return $result;
	}
	public function university_listing($reviewer_status=null){
		$this->db->select( 'ud.*,u.uniid,u.university_name,u.address,u.email,u.contact_no,u.name_of_representative,u.college_logo,u.position,p.name collegeofnmae,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->universitydocumentsTbl.' ud'); 
		$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
		$this->db->join($this->paymenttransactionTbl.' pt', 'ud.unidoc_id=pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'ud.reviewer_id=rev.user_ID','left');
		$this->db->where('pt.payment_for','U');
		$this->db->where('pt.txn_id !=','');
		if($reviewer_status != ""){
			$this->db->where('ud.reviewer_status',$reviewer_status);
		}
		//$this->db->where('rev.user_type','sub-admin');
		$this->db->order_by('ud.unidoc_id', 'desc');
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//return count($result);
		return $result;			
	}
	public function schoolcertificate($unidoc_id){
		$this->db->select( 'ud.*,u.uniid,u.university_name,u.address,u.email,u.contact_no,u.name_of_representative,u.college_logo,u.position,p.name collegeofnmae,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->universitydocumentsTbl.' ud'); 
		$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
		$this->db->join($this->paymenttransactionTbl.' pt', 'ud.unidoc_id=pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'ud.reviewer_id=rev.user_ID','left');
		$this->db->where('pt.payment_for','U');
		$this->db->where('ud.reviewer_status','1');
		$this->db->where('ud.unidoc_id',$unidoc_id);
		$query = $this->db->get();	
//echo $this->db->last_query(); die;		
		$result = $query->row_object();
		//return count($result);
		return $result;			
	}
	public function coursecertificate($docid){
		$this->db->select("doc.*, doc.cor_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->coursedocumentsTbl.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id');
		// $this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->paymentTbl.' pt','doc.cor_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','C');
		$this->db->where('pt.txn_id!=','');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('doc.cor_doc_id',$docid);
		
		$query = $this->db->get();	
//echo $this->db->last_query(); die;		
		$result = $query->row_object();
		//return count($result);
		return $result;			
	}
	public function trainingcertificate($docid){
		
		$this->db->select("doc.*, doc.train_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->trainingdocumentsTbl.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id','inner');
		// $this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->paymentTbl.' pt','doc.train_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','T');
		$this->db->where('pt.txn_id!=','');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('doc.train_doc_id',$docid);
		$query = $this->db->get();	
//echo $this->db->last_query(); die;		
		$result = $query->row_object();
		//return count($result);
		return $result;			
	}
	
	public function universitydetails($id){ 
		$this->db->select('ud.*,u.uniid,u.university_name,u.address,u.email,u.university_password,u.contact_no,u.name_of_representative,u.college_logo,u.position,ud.unidoc_id,u.business_license_number,u.validity_date,u.issued_by,u.accreditation_no,u.accreditation_validity_date,u.accreditation_issued_by,p.name collegeofnmae,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->universitydocumentsTbl.' ud'); 
		$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
		$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		//$this->db->where('u.reviewer_status <','1');
		$this->db->where('ud.unidoc_id',$id);
		$query = $this->db->get();	
		//echo $this->db->last_query(); die;	
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;				
	}
	public function universityreviewdatails($id){
		//$this->db->select('u.*,p.name collegeofnmae,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->universityreviewertbl_cep_commentsentTbl.' u');
		//$this->db->where('u.uniid',$id);
		$this->db->where('u.unidoc_id',$id);
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;			
	}
	public function graducatereviewdatails($id){
		$this->db->from($this->graduates_reviewer_commentTbl);
		$this->db->where('grad_id',$id);
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;		
	}

	public function graduates_listing($approval=null){ 
		$this->db->select('g.*,p.name collegeofname,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');	
		$this->db->join($this->adminTbl.' rev', 'g.reviewer_id=rev.user_ID','left');
		//$this->db->where('g.examcode !=', '');
		if($approval == 1){
			$this->db->where('g.reviewer_status', '1');
		}else{
			$this->db->where('g.reviewer_status !=', '1');
		}
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//echo $this->db->last_query(); exit;
		return $result;				
	}

	public function graduates_details($id){
		$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		//$this->db->where('g.examcode !=', '');
		$this->db->where('g.grad_id =', $id);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit; 
		return $result;				
	}
	public function professionlareviewdatails($id){
		$this->db->select('*');
		$this->db->from($this->professionalreviewercommentTbl);
		$this->db->where('prof_id',$id);
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;			
	}
	public function cepreviewdatails($rev_id,$doc_id){
		$this->db->select('*');
		$this->db->from($this->cep_commentsTbl);
		$this->db->where('reviewed_by',$rev_id);
		$this->db->where('comment_id',$doc_id);
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;			
	}
	public function coursereviewdatails($id){
		$this->db->from($this->coursereviewercommentTbl);
		$this->db->where('cor_doc_id',$id);//Rboard course table id not ceonpoint's course id
		$query = $this->db->get();	
		$result = $query->row_object();
		// $result = $query->num_rows();
		return $result;			
	}
	public function trainingreviewdatails($id){
		$this->db->from($this->trainingdocumentsreviewercommentTbl);
		$this->db->where('train_doc_id',$id);//Rboard course table id not ceonpoint's course id
		$query = $this->db->get();	
		$result = $query->row_object();
		// $result = $query->num_rows();
		return $result;			
	}
	public function insertuniversityreview($data){		
		$this->db->set($data);
		$this->db->insert($this->universityreviewertbl_cep_commentsentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function insertgraduatesreview($data){		
		$this->db->set($data);
		$this->db->insert($this->graduates_reviewer_commentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function insertprofessionalreview($data){		
		$this->db->set($data);
		$this->db->insert($this->professionalreviewercommentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function insertcoursereview($data){		 
		$this->db->set($data);
		$this->db->insert($this->coursereviewercommentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function inserttriningcommentsreview($data){		 
		$this->db->set($data);
		$this->db->insert($this->trainingdocumentsreviewercommentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
		
	public function cepassignedreviewerupdate($data, $id = false){
		if($id){
			// $this->db->where('provider_id', $id);
			// $this->db->update($this->cepTbl, $data);
			$this->db->where('id', $id);
			$this->db->update($this->tbl_cep_documents, $data);
			return true;
		}
	}	
	public function profesassignedreviewerupdate($data, $id){
		if($id){
			$this->db->where('pd_id', $id);
			$this->db->update($this->pDocTbl, $data);
			return true;
		}
			return false;
	}

	public function courseassignedreviewerupdate($data, $id = false){
		if($id){
			$this->db->where('cor_doc_id', $id);
		}
		$this->db->update($this->coursedocumentsTbl, $data);
		return TRUE;
	}

	public function trainingassignedreviewerupdate($data, $id = false){
		if($id){
			$this->db->where('train_doc_id', $id);
		}
		$this->db->update($this->trainingdocumentsTbl, $data);
		return true;
	}
		
	public function univassignedreviewerupdate($data, $id = false){
		
		if($id){
			//$this->db->where('uniid', $id);
			$this->db->where('unidoc_id', $id);
		}
		//$this->db->update($this->universityTbl, $data);
		$this->db->update($this->universitydocumentsTbl, $data);
		//echo $this->db->last_query(); die;
		return true;
		
	}
	public function graducateassignedreviewerupdate($data, $id = false){
		
		if($id){
			$this->db->where('grad_id', $id);
		}
		$this->db->update($this->graduatesTbl, $data);
		//echo $this->db->last_query(); die;
		return TRUE;
		
	}
	public function updateunversityreviewstatus($data, $id = false){
		
		if($id){
			$this->db->where('uniid', $id);
		}
		$this->db->update($this->universityTbl, $data);
		//echo $this->db->last_query(); die;
		return TRUE;
		
	}
	public function updateunversitydocreviewstatus($data, $id = false){
		
		if($id){
			$this->db->where('unidoc_id', $id);
		}
		$this->db->update($this->universitydocumentsTbl, $data);
		//echo $this->db->last_query(); die;
		return TRUE;
		
	}
		
	public function professionalreviewstatus($data, $id = false){
		if($id){
			$this->db->where('user_ID', $id);
		}
		$this->db->update($this->userTbl, $data);
		//echo $this->db->last_query(); die;
		return TRUE;
	}
		
	public function profdocreviewstatus($data, $id = false){
		if($id){
			$this->db->where('pd_id', $id);
		}
		$this->db->update($this->pDocTbl, $data);
		//echo $this->db->last_query(); die;
		return TRUE;
	}
		
	public function getprofessionaldetails($id){
		//$this->db->select('u.*,p.name collegeofnmae,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->userTbl.' u');
		$this->db->where('u.user_ID',$id);
		$query = $this->db->get();	
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;			
	}

	public function get_cep_details($doc_id)
	{
		$this->db->select("t2.*, t2.email, t2.contact_person, t1.id doc_id, t1.accreditation_image,t1.accreditation_image,t1.license_image,t1.document_for,t1.provider_id,t1.reviewer_id rev_id,t1.reviewer_status rev_status,t5.countries_name as co_name");
		$this->db->from($this->tbl_cep_documents. ' as t1');
		$this->db->join($this->cepTbl .' as t2','t2.provider_id=t1.provider_id','inner');
		$this->db->join($this->countryTbl .' as t5','t5.countries_id=t2.countries_id','left');
		$this->db->join($this->paymenttransactionTbl .' as t3','t3.user_id=t1.provider_id','inner');
		$this->db->join($this->adminTbl . ' as t4','t1.reviewer_id=t4.user_ID','left');
		$this->db->where('t3.payment_for','CEP');
		// $this->db->where('t1.document_for','n');
		$this->db->where('t1.id',$doc_id);
		

		
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;

	}
	

	public function get_training_course_applcaition($where=null,$group_by=null)
	{
		$this->db->select("t.*, u.business_name,u.company_logo,u.email,con.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname");
		//$this->db->from($this->trainingTbl.' t');
		$this->db->from($this->trainingdocumentsTbl.' t');
		$this->db->join($this->cepTbl.' u','u.provider_id = t.provider_id','left');
		$this->db->join($this->countryTbl.' con','u.countries_id = con.countries_id','left');
		$this->db->join($this->paymentTbl.' pt','u.provider_id = pt.user_id','inner');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID','left');
		// $this->db->where('t.licence_applied',1);
		$this->db->where('pt.payment_for','T');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}
		$this->db->group_by('t.train_doc_id');	
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result();
		}
		return false;
	}

	public function get_training_course_applcaition_count($where=null,$group_by=null)
	{
		$this->db->select("t.*, u.*,con.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->from($this->trainingTbl.' t');
		$this->db->join($this->cepTbl.' u','u.email = t.user_email','left');
		$this->db->join($this->countryTbl.' con','t.country_id = con.countries_id','left');
		$this->db->join($this->paymentTbl.' pt','u.provider_id = pt.user_id','inner');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID','left');
		$this->db->where('t.licence_applied',1);
		$this->db->where('pt.payment_for','T');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}

		if($group_by!="")
		{
			$this->db->group_by('pt.user_id');	
		}

		$q = $this->db->get();
		//echo $this->db->last_query();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}
	public function get_trainingdetails($where=null,$group_by=null)
	{
		
		$this->db->select("t.*, u.business_name,u.company_logo,u.email,pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname");
		$this->db->from($this->trainingdocumentsTbl.' t');
		$this->db->join($this->cepTbl.' u','t.provider_id = u.provider_id');
		$this->db->join($this->paymentTbl.' pt','t.train_doc_id = pt.doc_refrence_id');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID');
		$this->db->where('t.licence_applied','1');
		$this->db->where('pt.payment_for','T');
		$this->db->where('pt.txn_id!=','');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		/* if($group_by!="")
		{
			$this->db->group_by('pt.user_id');	
		} */
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row_object();
		}
		return false;
	} 


	public function get_professional_reg_list($count = false, $where=null)
	{
		$this->db->select("t1.*, t1.id doc_id, t1.reviewer_id rev_id, t1.reviewer_status rev_status, t2.business_name, t2.business_no, t2.email, t2.provider_id pid, t3.payment_gross amount, t3.payment_status, t3.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as t1');
		$this->db->join($this->cepTbl.' as t2','t1.provider_id = t2.provider_id','inner');
		$this->db->join($this->paymenttransactionTbl .' as t3','t3.user_id = t1.provider_id','inner');
		$this->db->join($this->adminTbl .' as t4','t1.reviewer_id = t4.user_ID','left');
		$this->db->where('t3.payment_for','CEP');
		$this->db->where('t1.reference_no !=','');

		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		$this->db->order_by('t3.user_id','desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result_array();
			}
		}
		return false;
	}


	public function get_graduates_apllication($count=null, $reviewer_id=null, $status=null ){ 
		$this->db->select('g.*,p.name collegeofname,pt.doc_refrence_id,pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->paymenttransactionTbl .' as pt','g.temp_order_id = pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'g.reviewer_id=rev.user_ID','left');
		//$this->db->where('g.examcode !=', '');
		$this->db->where('pt.doc_refrence_id >', 0);
		$this->db->where('pt.txn_id !=', '');
		
		if($status!=null && $status !=""){
			if($status == 'r'){
				$this->db->where('g.reviewer_status','1');
				$this->db->or_where('g.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('g.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('g.reviewer_status','2');
			}else{
				$this->db->where('g.reviewer_status <','1');
			}
		}
		if($reviewer_id){
			$this->db->where('g.reviewer_id',$reviewer_id);
		}
		$this->db->group_by('g.grad_id');
		$this->db->order_by('pt.payment_date', 'desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		
		return false;				
	}

	function get_cep_acc_application($count = false, $status=null, $reviewer_id=null,$document_for=null){
		$this->db->select("doc.*, doc.id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id','inner');
		$this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('pt.payment_for','CEP');
		$this->db->where('doc.reference_no !=','');
		if($status!=null && $status !=""){
			if($status == 'r'){
				$this->db->where('doc.reviewer_status','1');
				$this->db->or_where('doc.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('doc.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('doc.reviewer_status','2');
			}else{
				$this->db->where('doc.reviewer_status <','1');
			}
		}
		if($reviewer_id){
			$this->db->where('doc.reviewer_id',$reviewer_id);
		}
		if($document_for!=null){
			$this->db->where('doc.document_for',$document_for);
		}

		$this->db->group_by('cep.email');
		$this->db->order_by('pt.payment_date','desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}

	function get_fp_application($count=null, $status=null, $reviewer_id=null, $document_for = null){ 
		$this->db->select('doc.*, doc.pd_id doc_id, prof.user_ID, prof.role, prof.email, prof.name, prof.fname, prof.lname, p.name collegeofname, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->pDocTbl.' doc');
		$this->db->join($this->userTbl.' prof', 'doc.user_id = prof.user_ID','left');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->paymenttransactionTbl.' pt', 'doc.user_id = pt.user_id','inner');	
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		$this->db->where('prof.refrence_code !=','');	
		$this->db->where('pt.txn_id!=','');
		if($status!=null && $status !=""){
			if($status == 'r'){
				$this->db->where('doc.reviewer_status','1');
				$this->db->or_where('doc.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('doc.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('doc.reviewer_status','2');
			}else{
				$this->db->where('doc.reviewer_status <','1');
			}
		}
		if($reviewer_id){
			$this->db->where('doc.reviewer_id',$reviewer_id);
		}
		if($document_for!=null){
			$this->db->where('doc.document_for',$document_for);
		}
		$this->db->where('prof.role', 'F');
		$this->db->or_where('prof.role', 'P');
		// $this->db->group_by('prof.email');
		$this->db->order_by('pt.payment_date', 'desc');
		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		// echo $this->db->last_query(); exit;
		return false;				
	}

	function get_fpexam_application($count=null, $status=null, $reviewer_id=null, $type = null){ 
		$this->db->select('prof.*,
			p.name collegeofname, 
			b.examination_id,
			e.name_of_exam exam_name,e.date exam_date,e.start_time exam_time,
			pt.payment_gross amount, pt.payment_status, pt.txn_id,
			rev.first_name rev_firsname,rev.last_name rev_lastname ');
		$this->db->from($this->userTbl.' prof');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->book_examTbl.' b', 'prof.user_ID = b.user_id','left');	
		$this->db->join($this->examination_scheduleTbl.' e', 'b.examination_id = e.es_id','left');	
		$this->db->join($this->paymenttransactionTbl.' pt', 'prof.user_ID = pt.user_id','inner');	
		$this->db->join($this->adminTbl.' rev', 'prof.reviewer_id=rev.user_ID','left');
		
		if($status!=null && $status !=""){
			if($status == 'r'){
				$this->db->where('prof.reviewer_status','1');
				$this->db->or_where('prof.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('prof.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('prof.reviewer_status','2');
			}else{
				$this->db->where('prof.reviewer_status <','1');
			}
		}
		if($reviewer_id){
			$this->db->where('prof.reviewer_id',$reviewer_id);
		}
		$this->db->where('pt.payment_type ', 'E');
		$this->db->where('prof.role', 'P');
		$this->db->group_by('prof.email');
		$this->db->order_by('pt.payment_date', 'desc');
		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		// echo $this->db->last_query(); exit;
		return false;				
	}

	function get_school_application($count=null, $status=null, $reviewer_id=null, $document_for=null){ 
		$this->db->select('ud.unidoc_id,ud.business_license,ud.accreditation,ud.reviewer_id,ud.reviewer_status,ud.review_date,ud.document_for,ud.renew_for,
			u.uniid,u.university_name,u.address,u.email,u.contact_no,u.name_of_representative,u.college_logo,u.position,u.refrence_code,
			p.name collegeofnmae, 
			pt.payment_gross amount, pt.payment_status, pt.txn_id,
			rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->universitydocumentsTbl.' ud');
		$this->db->join($this->universityTbl.' u', 'ud.uniid = u.uniid','left');	
		$this->db->join($this->paymenttransactionTbl.' pt', 'ud.unidoc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'ud.reviewer_id=rev.user_ID','left');
		$this->db->where('pt.payment_for','U');
		if($status!=null && $status !=""){
			if($status == 'r'){
				$this->db->where('ud.reviewer_status','1');
				$this->db->or_where('ud.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('ud.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('ud.reviewer_status','2');
			}else{
				$this->db->where('ud.reviewer_status <','1');
			}
		}
		if($reviewer_id==0){
			$this->db->where('ud.reviewer_id',0);
		} 
		if($reviewer_id){
			$this->db->where('ud.reviewer_id',$reviewer_id);
		}
		/* if($document_for!=null){
			$this->db->where('ud.document_for',$document_for);
		} */
		$this->db->group_by('u.email');
		$this->db->order_by('pt.payment_date', 'desc');
		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		//echo '<pre>'.$this->db->last_query(); die;
		return false;				
	}

	function get_course_acc_application($count = false, $status=null, $reviewer_id=null,$document_for=null){
		$this->db->select("doc.*, doc.cor_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->coursedocumentsTbl.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id');
		// $this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->paymentTbl.' pt','doc.cor_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','C');
		$this->db->where('pt.txn_id!=','');
		if($status!=null && $status !=""){
			if($status == 'r'){
				$this->db->where('doc.reviewer_status','1');
				$this->db->or_where('doc.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('doc.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('doc.reviewer_status','2');
			}else{
				$this->db->where('doc.reviewer_status <','1');
			}
		}
		if($reviewer_id){
			$this->db->where('doc.reviewer_id',$reviewer_id);
		}
		if($document_for!=null){
			$this->db->where('doc.document_for',$document_for);
		}

		// $this->db->group_by('cep.email');
		$this->db->group_by('doc.cor_doc_id');

		$this->db->order_by('pt.payment_date','desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); echo '<br>';
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows(); 
			}else{
				return $q->result();
			}
		}
		return false;
	}

	function get_training_acc_application($count = false, $status=null, $reviewer_id=null,$document_for=null){
		$this->db->select("doc.*, doc.train_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->trainingdocumentsTbl.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id','inner');
		// $this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->paymentTbl.' pt','doc.train_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','T');
		$this->db->where('pt.txn_id!=','');
		
		if($status != null && $status != ""){
			if($status == 'r'){
				$this->db->where('doc.reviewer_status','1');
				$this->db->or_where('doc.reviewer_status','2');
			}
			else if($status == '1'){
				$this->db->where('doc.reviewer_status','1');
			}
			else if($status == '2'){
				$this->db->where('doc.reviewer_status','2');
			}else{
				$this->db->where('doc.reviewer_status <','1');
			}
			
		}
		if($reviewer_id){
			$this->db->where('doc.reviewer_id',$reviewer_id);
		}
		if($document_for!=null){
			$this->db->where('doc.document_for',$document_for);
		}

		// $this->db->group_by('cep.email');
		$this->db->group_by('pt.user_id');

		$this->db->order_by('pt.payment_date','desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}

} ?>