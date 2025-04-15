<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Provider_model extends CI_Model {

	function __construct() {
		$this->userTbl 			= 'tbl_users';
		$this->contactTbl 		= 'tbl_contact_us';
		$this->courseTbl 		= 'tbl_course';
		$this->transTbl 		= 'tbl_payment_transaction';
		$this->providerTbl 		= 'tbl_ce_provider'; 
		$this->countriesTbl 	= 'tbl_countries'; 
		$this->notificationTbl 	= 'tbl_provider_notifications';
		$this->certificatepriceTbl 	= 'tbl_certificate_price';
		$this->tbl_cep_documents 	= 'tbl_cep_documents';
		$this->coursedocumentsTbl 	= 'tbl_course_documents';
		$this->trainingdocumentsTbl = 'tbl_training_documents';
		$this->tbl_profession 		= 'tbl_profession';
		$this->paymenttransactionlTbl = 'tbl_payment_transaction';
		$this->termsconditionsTbl 	= 'tbl_terms_conditions';
		$this->tutorialTbl 			= 'tbl_tutorial';
		$this->tblCourseFeedbackCep = 'tbl_course_feedback_to_cep';
	}
	
	public function get_one_receipt_details()
	{
		$this->db->select("pt.*");
		$this->db->from($this->paymenttransactionlTbl. ' pt');
		// $this->db->join($this->cepTbl .' as t2','t2.provider_id=t1.provider_id','inner');
		//$this->db->where('pt.payment_id',$id);
		$this->db->order_by('payment_id',"desc");
		$this->db->limit(1);		
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;
	}
	
	public function get_one_receipt($id)
	{
		$this->db->select("pt.*");
		$this->db->from($this->paymenttransactionlTbl. ' pt');
		$this->db->where('pt.payment_id',$id);
				
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;

	}

	public function check_user_exsits($email){
		$this->db->where('email',$email);
		$result = $this->db->get($this->userTbl)->num_rows();
   		// echo $this->db->last_query();
		return $result;
	}
	
	public function is_email_exist($email){
		$this->db->where('email',$email);
		$this->db->limit(1);
		$this->db->order_by('provider_id','desc');
		$result = $this->db->get($this->providerTbl)->row_object();
   		// echo $this->db->last_query();
		return $result;
	}
	function providerupdate($data, $id){		
		$this->db->where('provider_id', $id);
		$this->db->update($this->providerTbl, $data);
		// echo $this->db->last_query(); die;	
		return true;
	}
	public function fetchPassword($uniid){	
		$this->db->select('password');
		$this->db->from($this->providerTbl);	
		$this->db->where('provider_id', $uniid);
		$this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
		$result = $query->row_object();
			return $result;		
		}
		//echo $this->db->last_query(); exit;
		return false;			
	}
	public function updatePassword($data, $id){		
		$this->db->where('provider_id', $id);
		$this->db->update($this->providerTbl, $data);
		//echo $this->db->last_query(); die;	
		return true;			
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

	Public function cepAccinsert($data){
		$this->db->insert($this->providerTbl,$data);
		$insid = $this->db->insert_id();
		return $insid;
	} 
	public function update($tbl_name,$data,$db_id,$id){
		$this->db->where($db_id, $id);
		$result = $this->db->update($tbl_name, $data);
   		// echo $this->db->last_query(); exit;
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

	public function get_row_object($tbl_name,$db_field,$field,$where=null){

		if(!empty($where)){

			foreach ($where as $key => $value) {
				$this->db->where($key,$value);		
			}
		}else{
			$this->db->where($db_field,$field);	
		}
		
		$result = $this->db->get($tbl_name)->row();
  		 //echo $this->db->last_query(); exit;
		return $result;
	}
	public function get_course_details_all($cor_doc_id){
		$this->db->select('co.*,cep.*,p.payment_status,p.txn_id,p.payment_date,p.payment_amout,p.payment_tax,p.payment_gross,co.profession courseprofession');
		$this->db->from($this->coursedocumentsTbl.' co');
		$this->db->join($this->providerTbl.' cep','co.provider_id = cep.provider_id','left');
		$this->db->join($this->paymenttransactionlTbl.' p','p.user_id = co.provider_id', 'left');
		$this->db->where('co.cor_doc_id', $cor_doc_id);
		$this->db->where('p.payment_for','C');
		$query = $this->db->get();		
		$result = $query->row();
		return $result;
	}
	public function get_training_details_all($train_doc_id){
		$this->db->select('tr.*,cep.*,p.payment_status,p.txn_id,tr.profession traprofession');
		$this->db->from($this->trainingdocumentsTbl.' tr');
		$this->db->join($this->providerTbl.' cep','tr.provider_id = cep.provider_id','left');
		$this->db->join($this->paymenttransactionlTbl.' p','p.user_id = tr.provider_id', 'left');
		$this->db->where('tr.train_doc_id', $train_doc_id);
		$this->db->where('p.payment_for','T');
		$query = $this->db->get();		
		$result = $query->row();
		return $result;
	}
	public function getcourselisting($provider_id, $status=null, $submitted=null){
		$this->db->select('co.*,p.name profession_name');
		$this->db->from($this->coursedocumentsTbl.' co');
		$this->db->join($this->tbl_profession.' p','co.profession = p.id','left');
		$this->db->where('co.provider_id', $provider_id);
		$this->db->where('co.document_for', 'n');

		if($submitted != null){
			$this->db->where('co.submitted', $submitted);
		}
		if($status != null){
			if($status > 0){
				$this->db->where('co.reviewer_status', '1');
			}
			if($status < 1){
				$this->db->where('co.reviewer_status', '0');
			}
		}
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		// echo $this->db->last_query(); exit;
		return $result;
	}

	public function gettraininglisting($provider_id, $status=null, $submitted=null){
		$this->db->select('t.*,p.name profession_name');
		$this->db->from($this->trainingdocumentsTbl.' t');
		$this->db->join($this->tbl_profession.' p','t.profession = p.id','left');
		$this->db->where('t.provider_id', $provider_id);
		$this->db->where('t.document_for', 'n');
		if($submitted != null){
			$this->db->where('t.submitted', $submitted);
		}
		if($status != null){
			if($status > 0){
				$this->db->where('t.reviewer_status', '1');
			}
			if($status < 1){
				$this->db->where('t.reviewer_status', '0');
			}
		}
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		//echo $this->db->last_query(); exit;
		return $result;
	}
	
	public function get_paymenthistory($uniid){
		$this->db->select('p.*');
		$this->db->from($this->paymenttransactionlTbl.' p');
		// $this->db->join($this->coursedocumentsTbl.' cd', 'p.doc_refrence_id=cd.cor_doc_id');		
		$this->db->where('p.txn_id !=', '');
		$this->db->where('p.user_id', $uniid);
		$this->db->group_start();
		$this->db->or_where('p.payment_for', 'C');
		$this->db->or_where('p.payment_for', 'T');
		$this->db->or_where('p.payment_for', 'CEP');
		$this->db->group_end();
		$this->db->order_by('p.payment_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//print_r($result);exit;
		//$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;		
	}
	public function get_section_name($docrefid, $type){
		if($type == 'C'){
			$this->db->select('course_title sectionname');
			$this->db->from($this->coursedocumentsTbl);
			$this->db->where('cor_doc_id', $docrefid);
		}
		if($type == 'T'){
			$this->db->select('training_title sectionname');
			$this->db->from($this->trainingdocumentsTbl);
			$this->db->where('train_doc_id', $docrefid);
		}
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}

	public function get_renewalhistory($uniid){
		$this->db->select('p.*,doc.reviewer_status,doc.reviewer_id,doc.reference_no,doc.accreditation_no, doc.updated_at issued_date, doc.expiry_at validity_date, doc.renew_for');
		$this->db->from($this->paymenttransactionlTbl.' p');
		$this->db->join($this->tbl_cep_documents.' doc', 'p.doc_refrence_id = doc.id');		
		$this->db->where('p.user_id', $uniid);
		$this->db->where('p.payment_for', 'CEP');
		$this->db->where('p.txn_id !=', '');
		$this->db->order_by('p.payment_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//print_r($result);exit;
		//$result = $query->row_object();
		// echo $this->db->last_query(); exit;
		return $result;		
	}

	public function get_notifications($uniid){
		$this->db->from($this->notificationTbl);
		$this->db->where('uniid', $uniid);
		$this->db->order_by('not_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		// echo $this->db->last_query(); exit;
		return $result;		
	}
	public function get_terms(){
		$this->db->from($this->termsconditionsTbl);
		$this->db->where('type', 'cep');
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
		$this->db->where('type', 'ceprovider');
		$this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;	
		
	}
	public function getcourses($provider_id){
		$this->db->select('*');
		$this->db->from($this->coursedocumentsTbl);
		$this->db->where('provider_id', $provider_id);
		$this->db->where('document_for', 'n');
		$this->db->where('reviewer_status', '0');
		$this->db->where('reviewer_id', '0');
		$this->db->where('review_date', '0000-00-00 00:00:00');
		$this->db->where('licence_applied', '0');
		$query 	= $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function gettraining($provider_id){
		$this->db->select('*');
		$this->db->from($this->trainingdocumentsTbl);
		$this->db->where('provider_id', $provider_id);
		$this->db->where('document_for', 'n');
		$this->db->where('reviewer_status', '0');
		$this->db->where('reviewer_id', '0');
		$this->db->where('review_date', '0000-00-00 00:00:00');
		$this->db->where('licence_applied', '0');
		$query 	= $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
  		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function get_providerdetails($provider_id){
		$this->db->select('p.*,c.countries_name');
		$this->db->from($this->providerTbl.' p');
		$this->db->join($this->countriesTbl.' c', 'p.countries_id=c.countries_id','left');
		$this->db->where('p.provider_id', $provider_id);
		$this->db->limit(1);
		$query = $this->db->get();		
		$result = $query->row_object();
  		 //echo $this->db->last_query(); exit;
		return $result;
	}

	public function get_result_object($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$result = $this->db->get($tbl_name)->result();
   		 //echo $this->db->last_query();
		return $result;
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
	public function get_user_details($user_id,$where=null)
	{
		
		$this->db->select("t1.*,t2.countries_name as co_name");
		$this->db->from('tbl_ce_provider as t1');
		$this->db->join('tbl_countries as t2','t1.countries_id=t2.countries_id','left');
		if($where!=""){
				foreach ($where as $key => $value) {
					$this->db->where($key,$value);
				}
		}else{
			$this->db->where('t1.provider_id',$user_id);
		}
		
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();

		}
		return false;
	}
	public function insertTransaction($data){
		$insert = $this->db->insert($this->transTbl,$data);
		return $insert?true:false;
	}
	
	public function insert_payment($data){
		$this->db->insert($this->transTbl, $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	function insertnotifications($insetdata){
		//print_r($memberdata); exit;
		$this->db->insert($this->notificationTbl, $insetdata);
		// echo $this->db->last_query(); die;
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
		
	}
	public function getunicertificatecharge($chargeid,$charges_for){
		//$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->certificatepriceTbl);
		$this->db->where('pri_id', $chargeid);
		$this->db->where('charges_for', $charges_for);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;		
	}
	public function certificatechargesarr($chargefor){
		$this->db->select('pr.*');
		$this->db->from($this->certificatepriceTbl.' pr');
		$this->db->where('pr.charges_for', $chargefor);
		$this->db->order_by("pr.display_position ", "asc");
		//echo $this->db->last_query(); exit;
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false; 
	}
	public function updatedocumentrenewdate($data, $id){		
		$this->db->where('id', $id);
		$this->db->update($this->tbl_cep_documents, $data);
		// echo $this->db->last_query(); die;	
		return true;
	}
			
	public function cep_doc_details($provider_id,$document_for=false){
		//echo $provider_id;exit;
		$this->db->select('t1.*,t2.provider_id,t1.updated_at as cep_update_date,t2.status as cep_status,t2.reference_no,t2.business_name,t2.email,t2.business_no,t2.company_logo,t2.address,t2.contact_person,t2.designation,t2.phone,t3.countries_name');
		$this->db->from($this->tbl_cep_documents.' t1');
		$this->db->join($this->providerTbl.' t2', 't1.provider_id = t2.provider_id','left');
		$this->db->join($this->countriesTbl.' t3','t3.countries_id = t2.countries_id','left');
		//$this->db->where('t1.provider_id', $provider_id);
		$this->db->where('t1.id', $provider_id);
		if($document_for){
		$this->db->where('t1.document_for',$document_for);
		} 
		$this->db->order_by('t1.id','DESC');	
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function cep_payment_details($doc_id){
		$this->db->select('p.*');
		$this->db->from($this->paymenttransactionlTbl.' p');
		$this->db->where('doc_refrence_id', $doc_id);
		$this->db->where('payment_for','CEP');
		$query = $this->db->get();
		$result = $query->row();
		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function cep_doc_details_for_dashboard($provider_id,$document_for=false){
		//echo $provider_id;exit;
		$this->db->select('t1.*,t2.provider_id,t1.updated_at as cep_update_date,t2.status as cep_status,t2.reference_no,t2.business_name,t2.email');
		$this->db->from($this->tbl_cep_documents.' t1');
		$this->db->join($this->providerTbl.' t2', 't1.provider_id = t2.provider_id','left');
		$this->db->where('t1.provider_id', $provider_id);
		//$this->db->where('t1.id', $provider_id);
		if($document_for){
		$this->db->where('t1.document_for',$document_for);
		} 
		$this->db->order_by('t1.id','DESC');	
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function cep_doc_details_for_payment($provider_id,$document_for=false){
		$this->db->select('t1.*,t2.provider_id,t1.updated_at as cep_update_date,t2.status as cep_status,t2.reference_no,t2.business_name,t2.email');
		$this->db->from($this->tbl_cep_documents.' t1');
		$this->db->join($this->providerTbl.' t2', 't1.provider_id=t2.provider_id');
		//$this->db->where('t1.provider_id', $provider_id);
		$this->db->where('t1.id', $provider_id);
		if($document_for){
		$this->db->where('t1.document_for',$document_for);
		} 
		$this->db->order_by('t1.id','DESC');	
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;
	}
	public function insertCourse($data){
		
		$this->load->library('upload');
		if(isset($_FILES["course_image"]) && !empty($_FILES["course_image"]['name'])){
			$config['upload_path'] 		= './assets/images/ce_provider/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';    
			$ext 						= explode('.',$_FILES["course_image"]["name"]);        
			$course_image 				= 'c_'.time().'.'.end($ext);
			$config['file_name'] 		= $course_image;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('course_image')){
				$error = array('error' => $this->upload->display_errors());        
			}  
			$course_image = $course_image;
		}

		if(isset($_FILES["course_pdf"]) && !empty($_FILES["course_pdf"]['name'])){

			$config1['upload_path'] 		= './assets/images/ce_provider/';
			$config1['allowed_types'] 	= 'pdf|csv';     
			$ext 						= explode('.',$_FILES["course_pdf"]["name"]);        
			$course_pdf 				= 'p_'.time().'.'.end($ext);
			$config1['file_name'] 		= $course_pdf;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('course_pdf'))
			{
				$error = array('error' => $this->upload->display_errors());        
			}  
			$course_pdf = $course_pdf;
		}

		$value = array(
			'course_image'	=> $course_image,
			'course_pdf'	=> $course_pdf,
			'course_title'	=> $data['course_title'],
			// 'course_units'	=> $data['course_units'],
			'profession'	=> implode(',',$data['profession']),
			'description'	=> $data['description'],
			// 'category'		=> $data['category'],
			'course_price'	=> $data['course_price'],
			'provider_id'	=> $data['provider_id']
		);  

		$insert = $this->db->insert($this->coursedocumentsTbl,$value);
		return $insert?true:false;
	}

	public function resubmitCourse($value,$where){
		$this->db->where($where);
		$update = $this->db->update($this->coursedocumentsTbl, $value);
		return $update?true:false;
	}

	public function resubmitTraining($value,$where){
		$this->db->where($where);
		$update = $this->db->update($this->trainingdocumentsTbl, $value);
		return $update?true:false;
	}

	public function insertTraining($data){
		if(isset($_FILES["training_image"]) && !empty($_FILES["training_image"]['name'])){
			$config['upload_path'] 		= './assets/images/ce_provider/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';    
			$ext 						= explode('.',$_FILES["training_image"]["name"]);        
			$training_image 			= 't_'.time().'.'.end($ext);
			$config['file_name'] 		= $training_image;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('training_image')){
				$error = array('error' => $this->upload->display_errors());        
			}  
			$training_image = $training_image;
		}

		if(isset($_FILES["training_pdf"]) && !empty($_FILES["training_pdf"]['name'])){

			$config1['upload_path'] 		= './assets/images/ce_provider/';
			$config1['allowed_types'] 	= 'pdf|csv';   
			$ext 						= explode('.',$_FILES["training_pdf"]["name"]);        
			$training_pdf 				= 'p_'.time().'.'.end($ext);
			$config1['file_name'] 		= $training_pdf;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('training_pdf'))
			{
				$error = array('error' => $this->upload->display_errors());        
			}  
			$training_pdf = $training_pdf;
		}

		$value = array(
			'training_image'	=> $training_image,
			'training_pdf'		=> $training_pdf,
			'training_title'	=> $data['training_title'],
			// 'training_units'	=> $data['training_units'], 
			'profession'		=> implode(',',$data['profession']),
			'description'		=> $data['description'],
			// 'category'			=> $data['category'],
			'training_price'	=> $data['training_price'],
			'provider_id'		=> $data['provider_id']
		);  

		$insert = $this->db->insert($this->trainingdocumentsTbl,$value);
		return $insert?true:false;
	}

	public function updateTraining($data){
		if(isset($_FILES["training_image"]) && !empty($_FILES["training_image"]['name'])){
			$config['upload_path'] 		= './assets/images/ce_provider/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';    
			$ext 						= explode('.',$_FILES["training_image"]["name"]);        
			$training_image 			= 't_'.time().'.'.end($ext);
			$config['file_name'] 		= $training_image;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('training_image')){
				$error = array('error' => $this->upload->display_errors());        
			}  
			$training_image = $training_image;
		}else{
			$training_image = $data['old_training_image'];
		}

		if(isset($_FILES["training_pdf"]) && !empty($_FILES["training_pdf"]['name'])){

			$config1['upload_path'] 		= './assets/images/ce_provider/';
			$config1['allowed_types'] 	= 'pdf|csv';   
			$ext 						= explode('.',$_FILES["training_pdf"]["name"]);        
			$training_pdf 				= 'p_'.time().'.'.end($ext);
			$config1['file_name'] 		= $training_pdf;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('training_pdf'))
			{
				$error = array('error' => $this->upload->display_errors());        
			}  
			$training_pdf = $training_pdf;
		}else{
			$training_pdf = $data['old_training_pdf'];
		}


		$value = array(
			'training_image'	=> $training_image,
			'training_pdf'		=> $training_pdf,
			'training_title'	=> $data['training_title'],
			// 'training_units'	=> $data['training_units'],
			'profession'		=> implode(',',$data['profession']),
			'description'		=> $data['description'],
			// 'category'			=> $data['category'],
			'training_price'	=> $data['training_price'],
		);  

		$this->db->where('train_doc_id', $data['train_doc_id']);
		$update = $this->db->update($this->trainingdocumentsTbl, $value);
		return $update?true:false;
	}

	public function updateCourse($data){
		if(isset($_FILES["course_image"]) && !empty($_FILES["course_image"]['name'])){
			$config['upload_path'] 		= './assets/images/ce_provider/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';    
			$ext 						= explode('.',$_FILES["course_image"]["name"]);        
			$course_image 				= 't_'.time().'.'.end($ext);
			$config['file_name'] 		= $training_image;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('course_image')){
				$error = array('error' => $this->upload->display_errors());        
			}  
			$course_image = $course_image;
		}else{
			$course_image = $data['old_course_image'];
		}

		if(isset($_FILES["course_pdf"]) && !empty($_FILES["course_pdf"]['name'])){

			$config1['upload_path'] 		= './assets/images/ce_provider/';
			$config1['allowed_types'] 	= 'pdf|csv';   
			$ext 						= explode('.',$_FILES["course_pdf"]["name"]);        
			$course_pdf 				= 'p_'.time().'.'.end($ext);
			$config1['file_name'] 		= $course_pdf;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('course_pdf'))
			{
				$error = array('error' => $this->upload->display_errors());        
			}  
			$course_pdf = $course_pdf;
		}else{
			$course_pdf = $data['old_course_pdf'];
		}


		$value = array(
			'course_image'	=> $course_image,
			'course_pdf'		=> $course_pdf,
			'course_title'	=> $data['course_title'],
			// 'course_units'	=> $data['course_units'],
			'profession'		=> implode(',',$data['profession']),
			'description'		=> $data['description'],
			// 'category'			=> $data['category'],
			'course_price'	=> $data['course_price'],
		);  

		$this->db->where('cor_doc_id', $data['cor_doc_id']);
		$update = $this->db->update($this->coursedocumentsTbl, $value);
		return $update?true:false;
	}

	public function get_profession_list(){
		$this->db->select("p.*");
		$this->db->from($this->tbl_profession.' p');
		$this->db->where('p.status',1);
		$this->db->order_by('p.name','ASC');
		$query  = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false; 
	}

	public function deleteCourse($id,$uid){
		$this->db->where('cor_doc_id',$id);
		$this->db->where('provider_id',$uid);
		$result = $this->db->delete($this->coursedocumentsTbl);
		// echo $this->db->last_query();
		return $result;
	}

	public function deletetraining($id,$uid){
		$this->db->where('train_doc_id',$id);
		$this->db->where('provider_id',$uid);
		$result = $this->db->delete($this->trainingdocumentsTbl);
		// echo $this->db->last_query();
		return $result;
	}

	public function getCourseLogs($cid,$pid){
		$this->db->select("cfc.*, COUNT(cfc.cfid) logs_count");
		$this->db->from($this->tblCourseFeedbackCep.' cfc');
		$this->db->where('cfc.course_id',$cid);
		$this->db->where('cfc.provider_id',$pid);
		$this->db->order_by('cfc.cfid','desc');
		$query  = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false; 
	}

} ?>