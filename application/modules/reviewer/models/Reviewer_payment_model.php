
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Reviewer_payment_model extends CI_Model {

    public $paymentTbl, $userTbl, $professionTbl, $courseTbl, $coursedocumentsTbl, $trainingTbl, $trainingdocumentsTbl,
           $cepTbl, $countryTbl, $pDocTbl, $universityTbl, $universitydocumentsTbl, $adminTbl, $graduatesTbl,
           $universityreviewertbl_cep_commentsentTbl, $professionalreviewercommentTbl, $graduates_reviewer_commentTbl,
           $coursereviewercommentTbl, $trainingdocumentsreviewercommentTbl, $tbl_cep_documents, $cep_commentsTbl,
           $book_examTbl, $examination_scheduleTbl, $plicenseTbl, $usercertificateTbl, $applicationLogTbl,
           $receipientinformationTbl, $receipientreviewercommentTbl, $goodstandingTbl, $goodstandingreviewercommentTbl,
           $courseFeedbackCepTbl, $trainingFeedbackCepTbl;

    public function __construct() {
        parent::__construct();
        $this->paymentTbl = 'tbl_payment_transaction';
        $this->userTbl = 'tbl_users';
        $this->professionTbl = 'tbl_profession';
        $this->courseTbl = 'tbl_course';
        $this->coursedocumentsTbl = 'tbl_course_documents';
        $this->trainingTbl = 'tbl_training';
        $this->trainingdocumentsTbl = 'tbl_training_documents';
        $this->cepTbl = 'tbl_ce_provider';
        $this->countryTbl = 'tbl_countries';
        $this->pDocTbl = 'tbl_professional_documents';
        $this->universityTbl = 'tbl_university';
        $this->universitydocumentsTbl = 'tbl_university_documents';
        $this->adminTbl = 'tbl_admin';
        $this->graduatesTbl = 'graduates';
        $this->universityreviewertbl_cep_commentsentTbl = 'tbl_university_reviewer_comment';
        $this->professionalreviewercommentTbl = 'tbl_professional_reviewer_comment';
        $this->graduates_reviewer_commentTbl = 'tbl_graduates_reviewer_comment';
        $this->coursereviewercommentTbl = 'tbl_course_reviewer_comment';
        $this->trainingdocumentsreviewercommentTbl = 'tbl_training_documents_reviewer_comment';
        $this->tbl_cep_documents = 'tbl_cep_documents';
        $this->cep_commentsTbl = 'tbl_cep_comments';
        $this->book_examTbl = 'tbl_book_exam';
        $this->examination_scheduleTbl = 'tbl_examination_schedule';
        $this->plicenseTbl = 'tbl_professional_license';
        $this->usercertificateTbl = 'tbl_user_certificate';
        $this->applicationLogTbl = 'tbl_application_log';
        $this->receipientinformationTbl = 'tbl_receipient_information';
        $this->receipientreviewercommentTbl = 'tbl_receipient_reviewer_comment';
        $this->goodstandingTbl = 'tbl_good_standing';
        $this->goodstandingreviewercommentTbl = 'tbl_goodstanding_reviewer_comment';
        $this->courseFeedbackCepTbl = 'tbl_course_feedback_to_cep';
        $this->trainingFeedbackCepTbl = 'tbl_training_feedback_to_cep';
    }

    public function save($tbl_name, $data) {
        $this->db->insert($tbl_name, $data);
        return $this->db->insert_id();
    }

    public function update($tbl_name, $data, $db_id, $id) {
        $this->db->where($db_id, $id);
        return $this->db->update($tbl_name, $data);
    }

    public function delete($tbl_name, $db_field, $field) {
        $this->db->where($db_field, $field);
        return $this->db->delete($tbl_name);
    }

    public function count_rows($tbl_name, $db_field = false, $field = false) {
        if ($db_field) {
            $this->db->where($db_field, $field);
        }
        $query = $this->db->get($tbl_name);
        return ($query && $query instanceof CI_DB_result) ? $query->num_rows() : 0;
    }

    public function get_result_array($tbl_name, $db_field = false, $field = false) {
        if (!empty($field)) {
            $this->db->where($db_field, $field);
        }
        $query = $this->db->get($tbl_name);
        return ($query && $query instanceof CI_DB_result) ? $query->result_array() : [];
    }

    public function get_row_array($tbl_name, $db_field, $field) {
        $this->db->where($db_field, $field);
        $query = $this->db->get($tbl_name);
        return ($query && $query instanceof CI_DB_result) ? $query->row_array() : [];
    }

    public function get_row_object($tbl_name, $db_field, $field) {
        $this->db->where($db_field, $field);
        $query = $this->db->get($tbl_name);
        return ($query && $query instanceof CI_DB_result) ? $query->row() : null;
    }

    public function get_result_object($tbl_name, $db_field = false, $field = false) {
        if (!empty($field)) {
            $this->db->where($db_field, $field);
        }
        $query = $this->db->get($tbl_name);
        return ($query && $query instanceof CI_DB_result) ? $query->result() : [];
    }

	public function get_payment_details($where=null,$join=null,$group_by=null)
	{
		$this->db->select("t1.image as user_image,t2.certificate_identify as verified_certificate,t1.user_ID,t1.name as user_name,t2.added_on,t2.units,t2.id user_certificate_id,t2.certificate_id,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.payment_status status,t4.payment_gross amount,t4.payment_tax tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment_transaction as t4','t4.user_id=t1.user_Id','inner');
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
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.payment_status status,t4.payment_gross amount,t4.payment_tax tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment_transaction as t4','t4.user_id=t1.user_Id','inner');
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
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.payment_status status,t4.payment_gross amount,t4.payment_tax tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment_transaction as t4','t4.user_id=t1.user_Id','inner');
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
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.payment_status status,t4.payment_gross amount,t4.payment_tax tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment_transaction as t4','t4.user_id=t1.user_Id','inner');
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
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.payment_status status,t4.payment_gross amount,t4.payment_tax tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment_transaction as t4','t4.user_id=t1.user_Id','inner');
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
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.payment_status status,t4.payment_gross amount,t4.payment_tax tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment_transaction as t4','t4.user_id=t1.user_Id','inner');
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
		$this->db->select("t1.*, 
			t1.id doc_id, t1.reviewer_id rev_id, t1.reviewer_status rev_status, 
			t2.business_name, t2.business_no, t2.email, t2.phone, t2.contact_person, t2.address, t2.provider_id pid, t2.company_logo logo, t2.contact_person, t2.designation, 
			t3.payment_gross amount, t3.payment_status, t3.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as t1');
		$this->db->join($this->cepTbl.' as t2','t1.provider_id = t2.provider_id','inner');
		$this->db->join($this->paymentTbl .' as t3','t3.user_id = t1.provider_id','inner');
		$this->db->join($this->adminTbl .' as t4','t1.reviewer_id = t4.user_ID','left');
		$this->db->where('t3.payment_for','CEP');
		$this->db->where('t1.reference_no !=','');

		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}
		$this->db->group_by('t1.reference_no');
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

	public function foreign_applcaition_details($id=null,$status=null,$reviewerid=null)
	{
		$this->db->select('doc.*, doc.pd_id doc_id,doc.expiry_at license_validity_date, 
		prof.license_validity_date lic_val_date, prof.license_issued_date, prof.user_ID, prof.role, prof.email, 
		prof.name, prof.fname, prof.lname,CONCAT(prof.name," ",prof.fname," ",prof.lname) fullname, prof.dob, 
		prof.gender, prof.license_no, prof.registration_no, prof.image, p.name profession_name, 
		pt.payment_gross amount, pt.payment_status, pt.txn_id, 
		rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->pDocTbl.' doc');
		$this->db->join($this->paymentTbl.' pt', 'doc.pd_id = pt.doc_refrence_id');	
		$this->db->join($this->userTbl.' prof', 'doc.user_id = prof.user_ID');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		$this->db->where('prof.role', 'F');

		if($reviewerid!=null){
			$this->db->where('doc.reviewer_id',$reviewerid);			
		}else{
			$this->db->where('doc.reviewer_id >',0);
		}
		
		if($id!=null){
			$this->db->where('doc.pd_id',$id);			
		}
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
		$this->db->group_by('doc.refrence_code');			
		$this->db->order_by('pt.user_id','DESC');	
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($id != null){
				return $q->row();
			}else{
				return $q->result();
			}
		}
		return false;
	}

	public function get_foreign_applcaition_cert($where=null,$group_by=null)
	{
		$this->db->select("u.*,prof.expiry_at,prof.license_no licenseno,pl.lic_issue_date,pl.lic_expiry_date,pl.registration_no registrationno,p.name profession_name,c.name college_of, uni.university_name,cou.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,pt.payment_date,rev.first_name rev_firsname,rev.last_name rev_lastname"); 
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->pDocTbl.' prof', 'u.user_ID = prof.user_id','left');
		$this->db->join($this->plicenseTbl.' pl', 'u.user_ID = pl.user_id','left');
		$this->db->join($this->paymentTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->professionTbl.' c','u.college = p.id','left');
		$this->db->join($this->universityTbl.' uni','u.university = uni.uniid','left');
		$this->db->join($this->countryTbl.' cou','u.country = cou.countries_id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if($group_by!="") {
			$this->db->group_by('pt.user_id');	
		}
		$this->db->order_by('pt.user_id','DESC');	
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			return $q->result();
		}
		return false;
	}

	public function professional_eligibility_certificate($doc_id){
		$this->db->select('pd.*,u.*,CONCAT(u.fname," ",u.lname," ",u.name) fullname');
		$this->db->from($this->pDocTbl.' pd');
		$this->db->join($this->userTbl.' u', 'pd.user_id = u.user_ID','left');
		$this->db->where('pd.pd_id',$doc_id);
		$q = $this->db->get();
		return $q->row();
	}

	public function grad_elig_cert_forreviewer($gradid){
		$this->db->select("g.*");
		$this->db->from($this->graduatesTbl.' g');
		$this->db->where('g.grad_id',$gradid);
		$q = $this->db->get();
		return $q->row();
	}

	public function get_foreign_applcaition($where=null,$group_by=null)
	{
		$this->db->select("u.*,prof.lic_issue_date,prof.expiry_at,p.name profession_name,c.name college_of, uni.university_name,cou.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,pl.license_no licenseno,rev.first_name rev_firsname,rev.last_name rev_lastname"); 
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->pDocTbl.' prof','u.user_ID = prof.user_id','left');
		$this->db->join($this->paymentTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->plicenseTbl.' pl', 'u.user_ID = pl.user_id','left');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->professionTbl.' c','u.college = c.id','inner');
		$this->db->join($this->universityTbl.' uni','u.university = uni.uniid','left');
		$this->db->join($this->countryTbl.' cou','u.country = cou.countries_id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if($group_by!="") {
			$this->db->group_by('pt.user_id');	
		}
		$this->db->order_by('pt.user_id','DESC');	
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
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
		$this->db->select("c.*, u.provider_id, u.business_name,u.company_logo,u.email,u.status,c.accreditation_no,pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname, pro.name profession_name, cat.name category_name");
		$this->db->from($this->coursedocumentsTbl.' c');
		$this->db->join($this->paymentTbl.' pt','c.cor_doc_id = pt.doc_refrence_id');
		$this->db->join($this->cepTbl.' u','c.provider_id = u.provider_id','left');
		$this->db->join($this->adminTbl.' rev', 'c.reviewer_id = rev.user_ID','left');
		$this->db->join($this->professionTbl.' pro', 'c.profession = pro.id','left');
		$this->db->join($this->professionTbl.' cat', 'c.category = cat.id','left');
		// $this->db->where('c.licence_applied','1');
		// $this->db->where('c.reviewer_status','1');
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
		// echo $this->db->last_query(); 
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
		$this->db->join($this->paymentTbl.' pt','c.cor_doc_id = pt.doc_refrence_id');
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
	public function university_listing($reviewer_status=null,$reviewer_id=null){
		$this->db->select( 'ud.*,u.uniid,u.university_name,u.address,u.email,u.contact_no,u.name_of_representative,u.college_logo,u.position,p.name collegeofnmae,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->universitydocumentsTbl.' ud'); 
		$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
		$this->db->join($this->paymentTbl.' pt', 'ud.unidoc_id=pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'ud.reviewer_id=rev.user_ID','left');
		$this->db->where('pt.payment_for','U');
		$this->db->where('pt.txn_id !=','');
		if($reviewer_status != ""){
			$this->db->where('ud.reviewer_status',$reviewer_status);
		}
		if($reviewer_id != ""){
			$this->db->where('ud.reviewer_id',$reviewer_id);
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
		$this->db->join($this->paymentTbl.' pt', 'ud.unidoc_id=pt.doc_refrence_id');
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
		// $this->db->join($this->paymentTbl .' as pt','pt.user_id = doc.provider_id','inner');
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
	public function providercertificate_backup($docid){
		$this->db->select("doc.*, doc.cor_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id');
		//$this->db->join($this->paymentTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->paymentTbl.' pt','doc.cor_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','C');
		$this->db->where('pt.txn_id!=','');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('doc.cor_doc_id',$docid);
		
		$query = $this->db->get();
		//$this->db->last_query();			
		$result = $query->row_object();
		//return count($result);
		return $result;			
		
	}
	public function providercertificate($docid){
		$this->db->select("doc.*, doc.id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id');
		// $this->db->join($this->paymentTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->paymentTbl.' pt','doc.provider_id = pt.user_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		// $this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','CEP');
		$this->db->where('pt.txn_id!=','');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('doc.id',$docid);
		
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
		// $this->db->join($this->paymentTbl .' as pt','pt.user_id = doc.provider_id','inner');
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
	
	
	public function profcertificate($docid){
		$this->db->select("doc.*, prof.fname, prof.lname, prof.name, prof.registration_no,prof.license_issued_date,prof.license_validity_date, doc.pd_id doc_id, doc.reviewer_id rev_id, doc.review_accept_date,  doc.expiry_at, doc.reviewer_status rev_status, p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->from($this->pDocTbl.' doc');
		$this->db->join($this->userTbl.' prof', 'doc.user_id = prof.user_ID','left');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->paymentTbl.' pt', 'doc.user_id = pt.user_id','inner');	
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		// $this->db->where('doc.refrence_code !=','');	
		// $this->db->where('pt.txn_id!=','');
		// $this->db->where('doc.reviewer_status','1');
		$this->db->where('doc.pd_id',$docid);
		$query = $this->db->get();	
		//echo $this->db->last_query(); die;		
		$result = $query->row_object();
		//print_r($result);exit;
		return $result;			
	}
	public function graduatecertificate($docid)
	{
		//$this->db->select("g.*, prof.fname, prof.lname, prof.name, doc.pd_id doc_id, doc.reviewer_id rev_id, doc.review_accept_date,  doc.expiry_at, doc.reviewer_status rev_status, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->select("g.*");
		$this->db->from($this->graduatesTbl.' g');
		//$this->db->join($this->userTbl.' prof', 'doc.user_id = prof.user_ID','left');
		//$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		//$this->db->join($this->paymentTbl.' pt', 'doc.user_id = pt.user_id','inner');	
		//$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		// $this->db->where('doc.refrence_code !=','');	
		// $this->db->where('pt.txn_id!=','');
		// $this->db->where('doc.reviewer_status','1');
		$this->db->where('g.grad_id',$docid);
		$query = $this->db->get();	
		//echo $this->db->last_query(); die;		
		$result = $query->row_object();
		//print_r($result);exit;
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

	public function graduates_listing($approval=null,$reviewer_id=null){ 
		$uniid 		= (isset($_GET['uniid']))?$_GET['uniid']:'';
		$sch_id 	= (isset($_GET['sch_id']))?$_GET['sch_id']:'';
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		$this->db->select('g.*,p.name collegeofname,rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->paymentTbl .' as pt','g.temp_order_id = pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');	
		$this->db->join($this->adminTbl.' rev', 'g.reviewer_id=rev.user_ID','left');
		//$this->db->where('g.examcode !=', '');
		$this->db->where('pt.doc_refrence_id >', 0);
		$this->db->where('pt.txn_id !=', '');
		if($approval == 1){
			$this->db->where('g.reviewer_status', '1');
			$this->db->where('g.examcode !=', '');
		}else{
			$this->db->where('g.reviewer_status !=', '1');
		}

		if($reviewer_id != ""){
			$this->db->where('g.reviewer_id',$reviewer_id);
		}
		if($uniid != ""){
			$this->db->where('g.uniid',$uniid);
		}
		if($sch_id != ""){
			$this->db->where('g.name_of_school',$sch_id);
		}
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(g.reviewer_accept_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(g.reviewer_accept_date)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(g.reviewer_accept_date)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(g.reviewer_accept_date)',$year);
			$this->db->where('month(g.reviewer_accept_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(g.reviewer_accept_date)',$day);
			$this->db->where('month(g.reviewer_accept_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(g.reviewer_accept_date)',$year.'-'.$month.'-'.$day);
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
		$this->db->select('g.*,CONCAT(g.student_name," ",g.middle_name," ",g.surname) fullname,u.email uni_email,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->universityTbl.' u', 'g.uniid=u.uniid');		
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		//$this->db->where('g.examcode !=', '');
		$this->db->where('g.grad_id =', $id);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit; 
		return $result;				
	}

	public function getexampassdetails($id){
		$this->db->select('g.*,p.name collegeofname, 
		b.examination_id,
		e.name_of_exam exam_name,e.date exam_date,e.start_time exam_time,');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');	
		$this->db->join($this->book_examTbl.' b', 'g.grad_id = b.user_id','left');	
		$this->db->join($this->examination_scheduleTbl.' e', 'b.examination_id = e.es_id','left');		
		//$this->db->where('g.examcode !=', '');
		$this->db->where('g.grad_id =', $id);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit; 
		return $result;				
	}

	public function getexampassfpdetails($id){
		$this->db->select('u.*,p.name collegeofname, 
		b.examination_id,
		e.name_of_exam exam_name,e.date exam_date,e.start_time exam_time,');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->professionTbl.' p', 'u.college=p.id','left');	
		$this->db->join($this->book_examTbl.' b', 'u.user_ID = b.user_id','left');	
		$this->db->join($this->examination_scheduleTbl.' e', 'b.examination_id = e.es_id','left');		
		//$this->db->where('u.examcode !=', '');
		$this->db->where('u.user_ID =', $id);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit; 
		return $result;				
	}
	
	public function professionlareviewdatails($rev_id,$doc_id){
		$this->db->select('*');
		$this->db->from($this->professionalreviewercommentTbl);
		$this->db->where('reviewed_by',$rev_id);
		$this->db->where('doc_id',$doc_id);
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
		$this->db->where('doc_id',$doc_id);
		// $this->db->where('comment_id',$doc_id);
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
		$this->db->select('u.*,CONCAT(u.fname," ",u.lname," ",u.name) fullname,p.name professionname');
		$this->db->from($this->userTbl.' u');
		$this->db->from($this->professionTbl.' p','u.profession = p.name');
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
		$this->db->join($this->paymentTbl .' as t3','t3.user_id=t1.provider_id','inner');
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
		$this->db->join($this->paymentTbl.' pt','t.train_doc_id = pt.doc_refrence_id','left');
		$this->db->join($this->countryTbl.' con','u.countries_id = con.countries_id','left');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID','left');
		// $this->db->where('t.licence_applied',1);
		$this->db->group_start();
		$this->db->where('t.reviewer_status','1');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}
		$this->db->group_end();
		$this->db->where('pt.payment_for','T');
		// $this->db->group_by('t.train_doc_id');	
		$q = $this->db->get();
		
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			
			return $q->result();
		}
		return $q->result();
	}

	public function get_training_course_applcaition_count($where=null,$group_by=null)
	{
		$this->db->select("t.*, u.*,con.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->from($this->trainingTbl.' t');
		$this->db->join($this->cepTbl.' u','u.email = t.user_email','left');
		$this->db->join($this->paymentTbl.' pt','t.train_doc_id = pt.doc_refrence_id');
		$this->db->join($this->countryTbl.' con','t.country_id = con.countries_id','left');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID','left');
		// $this->db->where('t.licence_applied',1);
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
		$this->db->select("t.*, u.business_name,u.company_logo,u.email,u.status, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname,pro.name profession_name, cat.name category_name");
		$this->db->from($this->trainingdocumentsTbl.' t');
		$this->db->join($this->paymentTbl.' pt','t.train_doc_id = pt.doc_refrence_id');
		$this->db->join($this->cepTbl.' u','t.provider_id = u.provider_id','left');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID','left');
		$this->db->join($this->professionTbl.' pro', 't.profession = pro.id','left');
		$this->db->join($this->professionTbl.' cat', 't.category = cat.id','left');
		$this->db->where('pt.payment_for','T');
		$this->db->where('pt.txn_id !=','');
		// $this->db->where('t.licence_applied','1');
		
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
		$this->db->join($this->paymentTbl .' as t3','t3.user_id = t1.provider_id','inner');
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


	public function get_graduates_apllication($count=null, $reviewer_id=null, $status=null , $subscription=null){ 
		$this->db->select('al.*,g.*,p.name collegeofname,pt.doc_refrence_id,pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->graduatesTbl.' g','al.application_id = g.grad_id');
		$this->db->join($this->paymentTbl .' pt','g.temp_order_id = pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'g.reviewer_id=rev.user_ID','left');
		$this->db->where('al.res_id', '5');
		// $this->db->where('pt.doc_refrence_id >', 0);
		$this->db->where('pt.payment_for','G');
		$this->db->where('pt.txn_id !=', '');
		if($reviewer_id !=null ){
			$this->db->where('g.reviewer_id',$reviewer_id);
		}
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
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		// $this->db->group_by('g.grad_id');
		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		
		return false;				
	}

	public function get_graduates_exam_booking_apllication($count=null, $subscription=null, $archive=null){ 
		$this->db->select('al.*, g.grad_id, 
			g.email, g.refrence_code, CONCAT(g.student_name," ",g.middle_name," ",g.surname) fullname,
			b.examination_id,
			e.name_of_exam exam_name,e.date exam_date,e.start_time exam_time,
			pt.payment_gross amount, pt.payment_status, pt.txn_id');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->book_examTbl.' b', 'al.application_id = b.be_id');	
		$this->db->join($this->graduatesTbl.' g','b.user_id = g.grad_id');
		$this->db->join($this->paymentTbl.' pt', 'g.temp_order_id = pt.doc_refrence_id');	
		$this->db->join($this->examination_scheduleTbl.' e', 'b.examination_id = e.es_id','left');	 
		$this->db->where('al.res_id', '13');
		$this->db->where('b.booking_for', 'p');
		$this->db->where('pt.txn_id !=', '');

		if($archive=='y'){
			$this->db->where('g.examcode !=', '');
		}else{
			$this->db->where('g.examcode', '');
		}

		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;				
	}

	public function get_submitted_certificate($uid)
	{
		$this->db->select('uc.*');
		$this->db->from($this->usercertificateTbl.' uc');
		$this->db->where('uc.submitted','y');
		// $this->db->where('uc.certificate_identify',0);
		$this->db->where('uc.user_id',$uid);
		$this->db->order_by('uc.id', 'asc');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result();
		}
		return false;
	}

	function get_cep_acc_application($count = false, $status=null, $reviewer_id=null,$subscription=null){
		$this->db->select("al.*, doc.*, doc.id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, doc.accreditation_no,
		cep.business_name, cep.business_no, cep.email, cep.provider_id pid, cep.company_logo logo, 
		pt.payment_gross amount, pt.payment_status, pt.txn_id,
		t4.first_name rev_firsname,t4.last_name rev_lastname"); 
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->tbl_cep_documents.' doc','al.application_id = doc.id');
		$this->db->join($this->paymentTbl .' pt','pt.doc_refrence_id = doc.id');
		$this->db->join($this->cepTbl.' cep','doc.provider_id = cep.provider_id');
		$this->db->join($this->adminTbl .' t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where_in('al.res_id', array('9','10'));
		$this->db->where('pt.payment_for','CEP');
		// $this->db->where('doc.reference_no !=','');
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
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		// $this->db->group_by('cep.email');
		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}

	function get_fp_application($count=null, $status=null, $reviewer_id=null,$subscription = null){ 
		$this->db->select('doc.*, doc.pd_id doc_id, prof.user_ID, prof.registration_no, prof.role, prof.email, CONCAT(prof.fname," ",prof.lname," ",prof.name) fullname, prof.image,prof.license_issued_date, prof.license_validity_date licvaldate, p.name collegeofname, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->pDocTbl.' doc','al.application_id = doc.pd_id');
		$this->db->join($this->paymentTbl.' pt', 'doc.pd_id = pt.doc_refrence_id');	
		$this->db->join($this->userTbl.' prof', 'doc.user_id = prof.user_ID','left');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		// $this->db->where('prof.refrence_code !=','');	
		$this->db->where('prof.role', 'F');
		$this->db->where('pt.txn_id !=','');
		$this->db->where('pt.payment_for', 'P');
		$this->db->where('al.res_id', '7');
		
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
		if($reviewer_id != null){
			$this->db->where('doc.reviewer_id',$reviewer_id);
		}
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		
		// $this->db->group_by('prof.user_ID');
		$this->db->order_by('al.added_at', 'DESC');

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

	public function get_fprofessional_exam_booking_apllication($count=null, $subscription=null){ 
		$this->db->select('al.*, p.user_ID, 
			p.email, p.refrence_code, CONCAT(p.fname," ",p.lname," ",p.name) fullname,
			b.examination_id,
			e.name_of_exam exam_name,e.date exam_date,e.start_time exam_time,
			pt.payment_gross amount, pt.payment_status, pt.txn_id');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->book_examTbl.' b', 'al.application_id = b.be_id');	
		$this->db->join($this->userTbl.' p', 'b.user_id = p.user_ID');
		$this->db->join($this->paymentTbl.' pt', 'al.application_id = pt.doc_refrence_id'); 
		$this->db->join($this->examination_scheduleTbl.' e', 'b.examination_id = e.es_id');	 
		$this->db->where('al.res_id', '6');
		$this->db->where('b.booking_for', 'pp');
		$this->db->where('pt.payment_for','G');
		$this->db->where('pt.payment_type','E');
		$this->db->where('pt.txn_id !=', '');
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;				
	}
	
	function get_prof_application_list($count=false,$status=false){
		$this->db->select("u.*,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->paymentTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->where('u.exam_code !=','');
		$this->db->where('u.role ','P');
		if($status != null){
			$this->db->where('u.reviewer_status', $status);
		}
		
		$this->db->group_by('u.email');
		$this->db->order_by("u.user_ID", "desc");

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

	// need to test get_professional_registration_application
	function get_professional_registration_application($count=null, $status=null, $reviewer_id=null,$subscription = null){ 
		$this->db->select('doc.*, doc.pd_id doc_id,doc.user_id user_ID,u.image, l.fname, l.lname, l.name, l.username email, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->pDocTbl.' doc','al.application_id = doc.pd_id');
		$this->db->join($this->userTbl.' u','doc.user_id = u.user_ID','left');
		$this->db->join($this->paymentTbl.' pt', 'doc.pd_id = pt.doc_refrence_id','inner');	
		$this->db->join($this->plicenseTbl.' l', 'doc.user_id = l.user_id','left');
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		$this->db->where('pt.payment_type','N');
		$this->db->where_in('pt.payment_for',array('PR','PRG')); //need to test it
		$this->db->where('pt.txn_id!=','');
		$this->db->where('al.res_id', '1');

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

		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}

		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;				
	}

	function get_professional_renewal_application($count=null, $status=null, $reviewer_id=null,$subscription = null){ 
		$this->db->select('doc.*, CONCAT(u.fname," ",u.lname," ",u.name) fullname, doc.pd_id doc_id,doc.user_id user_ID,u.image,l.fname,l.lname,l.name, l.username email, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->pDocTbl.' doc','al.application_id = doc.pd_id');
		$this->db->join($this->userTbl.' u','doc.user_id = u.user_ID','left');
		$this->db->join($this->paymentTbl.' pt', 'doc.pd_id = pt.doc_refrence_id','inner');	
		$this->db->join($this->plicenseTbl.' l', 'doc.user_id = l.user_id','left');
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		$this->db->where('pt.payment_type','R');
		$this->db->where_in('pt.payment_for',array('PR','PRG')); //need to test it
		$this->db->where('pt.txn_id!=','');
		$this->db->where('al.res_id', '2');

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

		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}

		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;				
	}
	
	function get_fpexam_reg_application($count=null, $status=null, $reviewer_id=null,$subscription = null){ 
		// echo CI_VERSION; die;

		$this->db->select('doc.*, doc.pd_id doc_id, 
			prof.user_ID, prof.role, prof.email, CONCAT(prof.fname," ",prof.lname," ",prof.name) fullname,prof.image,prof.exam_code,
			p.name collegeofname, 
			pt.payment_gross amount, pt.payment_status, pt.txn_id,
			rev.first_name rev_firsname,rev.last_name rev_lastname ');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->pDocTbl.' doc','al.application_id = doc.pd_id');
		$this->db->join($this->paymentTbl.' pt', 'doc.pd_id = pt.doc_refrence_id');	
		$this->db->join($this->userTbl.' prof', 'doc.user_id = prof.user_ID','left');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->adminTbl.' rev', 'doc.reviewer_id=rev.user_ID','left');
		$this->db->where('prof.role', 'P');
		$this->db->where('pt.payment_for', 'PP');
		$this->db->where('pt.txn_id !=', '');
		$this->db->where('al.res_id', '8');
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
		if($reviewer_id != null){
			$this->db->where('doc.reviewer_id',$reviewer_id);
		}
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		$this->db->group_by('prof.user_ID');
		$this->db->order_by('al.added_at', 'DESC');
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
	
	function get_school_application($count=null, $status=null, $reviewer_id=null, $subscription=null){  
		$this->db->select('al.*,ud.unidoc_id,ud.business_license,ud.accreditation,ud.reviewer_id,ud.reviewer_status,ud.review_date,ud.document_for,ud.renew_for,ud.accreditation_number,ud.expiry_at,ud.review_accept_date,
			u.uniid,u.university_name,u.address,u.email,u.contact_no,u.name_of_representative,u.college_logo,u.position,u.refrence_code,u.added_date,
			p.name collegeofnmae, 
			pt.payment_gross amount, pt.payment_status, pt.txn_id,
			rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->universitydocumentsTbl.' ud','al.application_id = ud.unidoc_id');
		$this->db->join($this->paymentTbl.' pt', 'al.application_id = pt.doc_refrence_id');
		$this->db->join($this->universityTbl.' u', 'ud.uniid = u.uniid','left');	
		$this->db->join($this->professionTbl.' p', 'u.college_of = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'ud.reviewer_id = rev.user_ID','left');
		$this->db->where('pt.payment_for','U');
		$this->db->where('pt.txn_id !=', '');
		$this->db->where_in('al.res_id', array('3','4'));
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
		if($reviewer_id != null){
			$this->db->where('ud.reviewer_id',$reviewer_id);
		}
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		
		// $this->db->group_by('u.email');
		$this->db->order_by('al.added_at', 'DESC');
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

	function get_course_acc_application($count = false, $status=null, $reviewer_id=null,$subscription = null){
		$this->db->select("doc.*, doc.cor_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status,doc.course_title title, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->coursedocumentsTbl.' doc','al.application_id = doc.cor_doc_id');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id');
		$this->db->join($this->paymentTbl.' pt','doc.cor_doc_id = pt.doc_refrence_id');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','C');
		$this->db->where('pt.txn_id !=','');
		$this->db->where('al.res_id','11');
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
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		
		$this->db->order_by('al.added_at', 'DESC');
		$q = $this->db->get();
		// echo $this->db->last_query(); die();
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows(); 
			}else{
				return $q->result();
			}
		}
		return false;
	}

	function get_training_acc_application($count = false, $status=null, $reviewer_id=null,$subscription = null){
		$this->db->select("doc.*, doc.train_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status,doc.training_title title, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->trainingdocumentsTbl.' doc','al.application_id = doc.train_doc_id');
		$this->db->join($this->paymentTbl.' pt','doc.train_doc_id = pt.doc_refrence_id');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id','left');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('doc.licence_applied','1');
		$this->db->where('pt.payment_for','T');
		$this->db->where('pt.txn_id !=','');
		$this->db->where('al.res_id','12');
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
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		
		$this->db->order_by('al.added_at', 'DESC');
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

	public function approve_certificate($data,$id){
		$this->db->where('id', $id);
		$this->db->update($this->usercertificateTbl, $data);
	}
	public function get_receipient_information($count=false, $status=false, $reviewer_id=null, $subscription = null){
		$this->db->select("ri.*, u.image, u.fname, u.lname, u.name, u.email, ad.first_name rev_firsname, ad.last_name rev_lastname");
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->receipientinformationTbl.' ri', 'al.application_id = ri.ri_id', 'left');
		$this->db->join($this->userTbl.' u', 'ri.user_id = u.user_ID', 'left');
		$this->db->join($this->adminTbl.' ad', 'ri.reviewer_id = ad.user_id', 'left');
		$this->db->where('al.res_id','23');
		
		if($status == 'a'){
			$this->db->where('ri.reviewer_status', '1');
			$this->db->or_where('ri.reviewer_status', '2');
		}
		else if($status == '1'){
			$this->db->where('ri.reviewer_status', '1');
		}else{
			$this->db->where('ri.reviewer_status <', '1');
		}
		
		if($reviewer_id){
			$this->db->where('ri.reviewer_id',$reviewer_id);
		}
		if($subscription != null){
			$this->db->where('al.subscription',$subscription);
		}
		$this->db->order_by('al.added_at', 'DESC');
		$this->db->group_by('ri.ri_id');
		$q = $this->db->get();
		//echo $this->db->last_query();die;
		if(($q !== false) ? $q->num_rows() : 0){
			if($count == 1){
				return $q->num_rows();
			}else{
				return $q->result();
			}
		}
		return false;
	}
	public function requestverificationassignedreviewerupdate($data, $id = false){
		if($id){
			$this->db->where('ri_id', $id);
		}
		$this->db->update($this->receipientinformationTbl, $data);
		return true;
	}
	public function requestverificationdocument($ri_id = false){
		$this->db->select("ri.*, c.countries_name country, p.name profession_name, u.license_no, u.license_validity_date, u.fname, u.lname, u.name, u.email, u.image, ad.first_name rev_firsname, ad.last_name rev_lastname");
		$this->db->from($this->receipientinformationTbl.' ri');
		$this->db->join($this->countryTbl.' c', 'c.countries_id = ri.inscountry', 'left');
		$this->db->join($this->userTbl.' u', 'ri.user_id = u.user_ID', 'left');
		$this->db->join($this->professionTbl.' p', 'u.profession = p.id', 'left');
		$this->db->join($this->adminTbl.' ad', 'ri.reviewer_id = ad.user_id', 'left');
		//$this->db->where('al.res_id','23');
		if($ri_id != false){
			$this->db->where('ri.ri_id', $ri_id);
		}
		
		$q = $this->db->get();
		$result = $q->row();
		return $result;
		
	}
	public function insertreceipientcommentsreview($data){		 
		$this->db->set($data);
		$this->db->insert($this->receipientreviewercommentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	//request for good standing start
	public function get_reqforgoodstand($count=false, $status=false, $reviewer_id=null, $subscription = null){
		$this->db->select("
			gs.gs_id,
			gs.user_id,
			gs.reviewer_status,
			gs.reviewer_id,
			al.added_at,
			MAX(u.image) AS image,
			MAX(u.fname) AS fname,
			MAX(u.lname) AS lname,
			MAX(u.name) AS name,
			MAX(u.email) AS email,
			MAX(ad.first_name) AS rev_firsname,
			MAX(ad.last_name) AS rev_lastname
		");
		$this->db->from($this->applicationLogTbl.' al');
		$this->db->join($this->goodstandingTbl.' gs', 'al.application_id = gs.gs_id', 'left');
		$this->db->join($this->userTbl.' u', 'gs.user_id = u.user_ID', 'left');
		$this->db->join($this->adminTbl.' ad', 'gs.reviewer_id = ad.user_id', 'left');
		$this->db->where('al.res_id','24');
	
		if($status == 'a'){
			$this->db->where('(gs.reviewer_status = 1 OR gs.reviewer_status = 2)');
		}
		else if($status == '1'){
			$this->db->where('gs.reviewer_status', '1');
		}else{
			$this->db->where('gs.reviewer_status <', '1');
		}
	
		if($reviewer_id){
			$this->db->where('gs.reviewer_id', $reviewer_id);
		}
		if($subscription != null){
			$this->db->where('al.subscription', $subscription);
		}
	
		$this->db->group_by('gs.gs_id, al.added_at');
		$this->db->order_by('al.added_at', 'DESC');
	
		$q = $this->db->get();
	
		if($count == 1){
			return $q->num_rows();
		}else{
			return $q->result();
		}
		return false;
	}
	

	public function req_good_stand_reviewer_update($data, $id = false){
		if($id){
			$this->db->where('gs_id', $id);
		}
		$this->db->update($this->goodstandingTbl, $data);
		return true;
	}

	public function requestgoodstanddocument($gs_id = false){
		$this->db->select("gs.*, c.countries_name country, p.name profession_name, u.license_no, u.license_validity_date, u.fname, u.lname, u.name, u.email, u.image, ad.first_name rev_firsname, ad.last_name rev_lastname");
		$this->db->from($this->goodstandingTbl.' gs');
		$this->db->join($this->countryTbl.' c', 'c.countries_id = gs.inscountry', 'left');
		$this->db->join($this->userTbl.' u', 'gs.user_id = u.user_ID', 'left');
		$this->db->join($this->professionTbl.' p', 'u.profession = p.id', 'left');
		$this->db->join($this->adminTbl.' ad', 'gs.reviewer_id = ad.user_id', 'left');
		//$this->db->where('al.res_id','23');
		if($gs_id != false){
			$this->db->where('gs.gs_id', $gs_id);
		}
		
		$q = $this->db->get();
		$result = $q->row();
		return $result;
		
	}
	public function insert_good_standing_commentsreview($data){		 
		$this->db->set($data);
		$this->db->insert($this->goodstandingreviewercommentTbl);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	//request for good standing end

	
	public function saveFeedbackOfcourse($data){
		$this->db->insert($this->courseFeedbackCepTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}

	public function get_course_log($provider_id,$doc_id){
		$this->db->where('provider_id',$provider_id);
		$this->db->where('course_id',$doc_id);
		$this->db->order_by('cfid','desc');

		$result = $this->db->get($this->courseFeedbackCepTbl)->result_array();
		return $result;
	}
	
	public function saveFeedbackOftraining($data){
		$this->db->insert($this->trainingFeedbackCepTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}

	public function get_training_log($provider_id,$doc_id){
		$this->db->where('provider_id',$provider_id);
		$this->db->where('training_id',$doc_id);
		$this->db->order_by('tfid','desc');

		$result = $this->db->get($this->trainingFeedbackCepTbl)->result_array();
		return $result;
	}
} ?>