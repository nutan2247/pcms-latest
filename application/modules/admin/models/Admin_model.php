<?php //defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	private $adminTbl;
private $userTbl;
private $pDocTbl;
private $professionTbl;
private $profLicenseTbl;
private $courseTbl;
private $trainingTbl;
private $cepTbl;
private $countryTbl;
private $universityTbl;
private $schoolsTbl;
private $graduatesTbl;
private $paymentTbl;
private $paymenttransactionTbl;
private $universitydocumentsTbl;
private $universityreviewercommentTbl;
private $professionalreviewercommentTbl;
private $graduates_reviewer_commentTbl;
private $coursereviewercommentTbl;
private $examscheduleTbl;
private $publishquestionTbl;
private $tbl_cep_documents;
private $coursedocumentTbl;
private $proctor_notificationsTbl;
private $trainingdocumentsTbl;
private $trainingdocumentsreviewercommentTbl;
private $cep_commentsTbl;
private $book_examTbl;
private $termsTbl;
private $tutorialTbl;
private $examQuestionsTbl;
private $universityreviewertbl_cep_commentsentTbl;
private $proctor_exam_scheduleTbl;
private $exam_resultTbl;
private $adminCommentTbl;
private $contactTbl;
private $adminSubscriptionDetailsTbl;
private $existingCertificateTbl;
private $userCertificateTbl;
private $exam_ques_by_cat_setTbl;
	public function  __construct()
	{
		parent::__construct();
		$this->adminTbl    		= 'tbl_admin';
		$this->userTbl    		= 'tbl_users';
		$this->pDocTbl    		= 'tbl_professional_documents';
		$this->professionTbl 	= 'tbl_profession';
		$this->profLicenseTbl 	= 'tbl_professional_license';
		$this->courseTbl    	= 'tbl_course';
		$this->trainingTbl    	= 'tbl_training';
		$this->cepTbl    		= 'tbl_ce_provider';
		$this->countryTbl    	= 'tbl_countries';
		$this->universityTbl    = 'tbl_university';
		$this->schoolsTbl 		= 'tbl_schools'; 
		$this->graduatesTbl    	= 'graduates';
		$this->paymentTbl 				= 'tbl_payment_transaction';
		$this->paymenttransactionTbl 	= 'tbl_payment_transaction';
		$this->universitydocumentsTbl   = 'tbl_university_documents';
		$this->universityreviewercommentTbl   = 'tbl_university_reviewer_comment';
		$this->professionalreviewercommentTbl = 'tbl_professional_reviewer_comment';
		$this->graduates_reviewer_commentTbl  = 'tbl_graduates_reviewer_comment';
		$this->coursereviewercommentTbl = 'tbl_course_reviewer_comment';
		$this->examscheduleTbl    		= 'tbl_examination_schedule';
		$this->publishquestionTbl    	= 'tbl_publish_question_set';
		$this->tbl_cep_documents 		= 'tbl_cep_documents';
		$this->coursedocumentTbl 		= 'tbl_course_documents';
		$this->proctor_notificationsTbl = 'tbl_proctor_notifications';
		$this->trainingdocumentsTbl 	= 'tbl_training_documents';
		$this->trainingdocumentsreviewercommentTbl = 'tbl_training_documents_reviewer_comment';
		$this->coursereviewercommentTbl = 'tbl_course_reviewer_comment';
		$this->cep_commentsTbl 			= 'tbl_cep_comments';
		$this->book_examTbl 			= 'tbl_book_exam';
		$this->termsTbl 				= 'tbl_terms_conditions';
		$this->tutorialTbl 				= 'tbl_tutorial';
		$this->examQuestionsTbl 		= 'tbl_exam_question';
		$this->universityreviewertbl_cep_commentsentTbl = 'tbl_university_reviewer_comment';
		$this->proctor_exam_scheduleTbl = 'tbl_proctor_exam_schedule';
		$this->exam_resultTbl   	 	= 'tbl_exam_result';
		$this->adminCommentTbl 			= 'tbl_admin_comments';
		$this->contactTbl 				= 'tbl_contact';
		$this->adminSubscriptionDetailsTbl	= 'tbl_admin_subscription_details';	 
		$this->existingCertificateTbl	= 'tbl_existing_certificate';	 
		$this->userCertificateTbl	= 'tbl_user_certificate';
		$this->exam_ques_by_cat_setTbl = 'tbl_exam_ques_by_cat_set';
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
   		// echo $this->db->last_query();
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
		if(($query !== false) ? $query->num_rows() : 0){
		$result = $query->num_rows();
		return $result;
		}
		return false;
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
	public function get_instruction(){
		$this->db->from('tbl_examination_instruction');
		$this->db->where('status', 1);
		$q = $this->db->get();
		$result = $q->result();
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

	/*********************************** CE-PROVIDER **************************************/
	public function get_ce_provider_payment_details($where=null,$join=null,$group_by=null)
	{
		$this->db->select("t2.reviewer_id,t2.password,t3.payment_id,t2.email,t2.status as ce_status,t2.provider_id,t2.business_name as user_name,t2.business_no,t2.added_on as issue_date,t3.payment_status as status,t3.payment_amout as amount,t3.payment_tax as tax,t4.first_name as reviewer_name");
		$this->db->from($this->tbl_cep_documents. ' as t1');
		$this->db->join($this->cepTbl .' as t2','t2.provider_id=t1.provider_id','inner');
		$this->db->join($this->paymenttransactionTbl .' as t3','t3.user_id=t1.provider_id','inner');
		$this->db->join($this->adminTbl . ' as t4','t2.reviewer_id=t4.user_ID','left');
		$this->db->where('t3.payment_for','CEP');
		//$this->db->where('t1.document_for','n');
		
		
		/*if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as '.$key,$key.'.certificate_id=t2.certificate_id','inner');
			}
		}*/
		
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		/*if($group_by!="")
		{
			$this->db->group_by('t1.user_id');	
		}*/

		$this->db->order_by('t1.id','desc');
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}


	public function get_ce_provider_payment_detail_row_count($where=null,$join=null)
	{
		$this->db->select("t1.provider_id,t1.business_name as user_name,t1.business_no,t1.added_on as issue_date,t2.status,t2.amount,t2.tax");
		$this->db->from('tbl_ce_provider as t1');
		$this->db->join('tbl_payment as t2','t2.user_id=t1.provider_id','inner');
		
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}
		
		$q = $this->db->get();
		//echo $this->db->last_query();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}

/************************************************ END CE PROVIDER ********************************/

	public function get_payment_details($where=null,$join=null,$group_by=null)
	{
		$this->db->select("t1.image as user_image,t2.certificate_identify as verified_certificate,t1.user_ID,t1.name as user_name,t2.reviewer_id,t2.added_on,t2.units,t2.certificate_id,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
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
	function graduates_list($reviewer_status){ 
		$examinees = $this->db->select('user_id')->where('booking_for','p')->get('tbl_book_exam')->result();
		if(!empty($examinees)){
			$examids = array();
			foreach($examinees as $ex){
				$examids[] = $ex->user_id;
				
			}
		}
		
		//print_r($examids );exit;
		$uniid 		= (isset($_GET['uniid']))?$_GET['uniid']:'';
		$sch_id 	= (isset($_GET['sch_id']))?$_GET['sch_id']:'';
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';

		$this->db->select('g.*,p.name collegeofname,pt.doc_refrence_id,pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->paymenttransactionTbl .' as pt','g.temp_order_id = pt.doc_refrence_id');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');
		$this->db->join($this->adminTbl.' rev', 'g.reviewer_id=rev.user_ID','left');
		//$this->db->where('g.examcode !=', '');
		$this->db->where('pt.doc_refrence_id >', 0);
		$this->db->where('pt.txn_id !=', '');

		if($reviewer_status != ""){
			$this->db->where('g.reviewer_status',$reviewer_status);
		}
		if($reviewer_status == 1){
			$this->db->where('g.examcode !=','');
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
		if(!empty($examids)){
			$this->db->where_not_in('g.grad_id', $examids);
		}
		$this->db->order_by("g.grad_id", "desc");
		$query = $this->db->get();	
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//echo'<pre>';print_r($result);exit;
		return $result;
	}

	function university_list($reviewer_status){ 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		
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
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(ud.review_accept_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(ud.review_accept_date)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(ud.review_accept_date)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(ud.review_accept_date)',$year);
			$this->db->where('month(ud.review_accept_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(ud.review_accept_date)',$day);
			$this->db->where('month(ud.review_accept_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(ud.review_accept_date)',$year.'-'.$month.'-'.$day);
		}
		
		$this->db->order_by('ud.unidoc_id', 'desc');
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}

	function universitydetails($id){ 
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
		//return count($result);
		return false;			
	}

	function universityreviewdatails($id){
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

	function schoolcertificate($unidoc_id){
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
	function get_cep_accreditation_list($count=false,$status=false){
		//fillter 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		$this->db->select("doc.*, doc.id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.phone, cep.address, cep.contact_person, cep.designation, cep.business_no, cep.email, , cep.company_logo, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id','inner');
		$this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
		$this->db->join($this->adminTbl .' as t4','doc.reviewer_id = t4.user_ID','left');
		$this->db->where('pt.payment_for','CEP');
		$this->db->where('doc.reference_no !=','');
		if($status != null){
			$this->db->where('doc.reviewer_status', $status);
		}

		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(doc.review_accept_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(doc.review_accept_date)',$month);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(doc.review_accept_date)',$day);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(doc.review_accept_date)',$year);
			$this->db->where('month(doc.review_accept_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(doc.review_accept_date)',$day);
			$this->db->where('month(doc.review_accept_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(doc.review_accept_date)',$year.'-'.$month.'-'.$day);
		}
		$this->db->group_by('doc.reference_no');
		$this->db->order_by("cep.provider_id", "desc");

		$q = $this->db->get();
		//echo $this->db->last_query();exit;
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
	function cepcertificate($docid){
		$this->db->select("doc.*, doc.id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->tbl_cep_documents.' as doc');
		$this->db->join($this->cepTbl.' as cep','doc.provider_id = cep.provider_id');
		// $this->db->join($this->paymenttransactionTbl .' as pt','pt.user_id = doc.provider_id','inner');
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

	function coursecertificate($docid){
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
	function trainingcertificate($docid){
		
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
	
	function getuniversityArr(){ 
		$this->db->select('uniid,university_name');
		$this->db->from($this->universityTbl);
		$this->db->order_by("university_name", "asc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->result_array();
		return $result;
	}
	function getschoolArr(){ 
		$this->db->select('sch_id,school_name');
		$this->db->from($this->schoolsTbl);
		$this->db->order_by("school_name", "asc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->result_array();
		return $result;
	}

	function get_uniqueset(){
		$this->db->select('set_no');
		$this->db->group_by('set_no');
		$result = $this->db->get('tbl_exam_question')->result();
   		// echo $this->db->last_query();
		return $result;
	}


	function get_examinee(){
		$booking = isset($_GET['id'])?$_GET['id']:'';
		$esid = isset($_GET['es_id'])?$_GET['es_id']:'';
		$this->db->select('g.*');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->book_examTbl.' b','g.grad_id = b.user_id','inner');
		$this->db->where('g.reviewer_status','1');

		if($booking != ''  && $booking == 'p'){
			$this->db->where('b.booking_for','p');
		}elseif($booking != '' && $booking == 'pp'){
			$this->db->where('b.booking_for','');
		}else{
			$this->db->where('b.booking_for','p');
		}
		if($esid != ''){
			$this->db->where('b.examination_id', $esid);
		}
		$this->db->order_by('g.reviewer_accept_date','ASC');
		$q = $this->db->get();
		$result = $q->result_array();
		//$result = $this->db->get('graduates')->result_array();
   		// echo $this->db->last_query();
		return $result;
	}
	function get_total_grad_examinee(){
		$this->db->select('g.*');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->book_examTbl.' b','g.grad_id = b.user_id','inner');
		$this->db->where('g.reviewer_status','1');

			$this->db->where('b.booking_for','p');
		
		$this->db->order_by('g.reviewer_accept_date','ASC');
		$q = $this->db->get();
		$result = $q->num_rows();
		//$result = $this->db->get('graduates')->result_array();
   		// echo $this->db->last_query();
		return $result;
	}
	function get_pro_examinees(){
		$booking = isset($_GET['id'])?$_GET['id']:'';
		$esid = isset($_GET['es_id'])?$_GET['es_id']:'';
		$this->db->select('u.*');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->book_examTbl.' b','u.user_ID = b.user_id','inner');
		//$this->db->join($this->examscheduleTbl.' s','b.examination_id = s.es_id', 'inner');
		$this->db->where('u.reviewer_status','1');
		
		if($booking != '' && $booking == 'pp'){
			$this->db->where('b.booking_for','pp');
		}elseif($booking != '' && $booking == 'p'){
			$this->db->where('b.booking_for','');
		}else{
			$this->db->where('b.booking_for','pp');
		}
		if($esid != ''){
			$this->db->where('b.examination_id', $esid);
		}
		
		$this->db->order_by('u.review_accept_date','ASC');
		$q = $this->db->get();
		$result = $q->result_array();
		//$result = $this->db->get('graduates')->result_array();
   		// echo $this->db->last_query();
		//echo '<pre>';print_r($result);exit;
		return $result;
	}
	function get_total_pro_examinees(){
		$this->db->select('u.*');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->book_examTbl.' b','u.user_ID = b.user_id','inner');
		//$this->db->join($this->examscheduleTbl.' s','b.examination_id = s.es_id', 'inner');
		$this->db->where('u.reviewer_status','1');
		
			$this->db->where('b.booking_for','pp');
		
		$this->db->order_by('u.review_accept_date','ASC');
		$q = $this->db->get();
		$result = $q->num_rows();
		//$result = $this->db->get('graduates')->result_array();
   		// echo $this->db->last_query();
		//echo '<pre>';print_r($result);exit;
		return $result;
	}
	public function get_examschedule(){
		$this->db->select('*');
		$this->db->from($this->examscheduleTbl);
		//$this->db->where('status', '1');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;

	}

	function get_prof_application_list($count = false, $status = false) {
		$month = isset($_GET['month']) ? $_GET['month'] : '';
		$day = isset($_GET['day']) ? $_GET['day'] : '';
		$year = isset($_GET['year']) ? $_GET['year'] : '';
	
		$this->db->select("
			u.email,
			MAX(u.user_ID) AS user_ID,
			MAX(u.name) AS name,
			MAX(u.fname) AS fname,
			MAX(u.lname) AS lname,
			MAX(u.profession) AS profession,
			MAX(u.reviewer_id) AS reviewer_id,
			MAX(u.reviewer_status) AS reviewer_status,
			MAX(u.exam_code) AS exam_code,
			MAX(u.review_accept_date) AS review_accept_date,
			MAX(p.name) AS profession_name,
			MAX(pt.payment_gross) AS amount,
			MAX(pt.payment_status) AS payment_status,
			MAX(pt.txn_id) AS txn_id,
			MAX(rev.first_name) AS rev_firsname,
			MAX(rev.last_name) AS rev_lastname
		");
		$this->db->from($this->userTbl . ' u');
		$this->db->join($this->paymentTbl . ' pt', 'u.user_ID = pt.user_id', 'inner');
		$this->db->join($this->professionTbl . ' p', 'u.profession = p.id', 'left');
		$this->db->join($this->adminTbl . ' rev', 'u.reviewer_id = rev.user_ID', 'left');
		$this->db->where('u.exam_code !=', '');
		$this->db->where('u.role', 'P');
	
		if ($status != null) {
			$this->db->where('u.reviewer_status', $status);
		}
	
		if ($month == "" && $day == "" && $year != "") {
			$this->db->where('YEAR(u.review_accept_date)', $year);
		}
		if ($month != "" && $day == "" && $year == "") {
			$this->db->where('MONTH(u.review_accept_date)', $month);
		}
		if ($month == "" && $day != "" && $year == "") {
			$this->db->where('DAY(u.review_accept_date)', $day);
		}
		if ($month != "" && $day == "" && $year != "") {
			$this->db->where('YEAR(u.review_accept_date)', $year);
			$this->db->where('MONTH(u.review_accept_date)', $month);
		}
		if ($month != "" && $day != "" && $year == "") {
			$this->db->where('DAY(u.review_accept_date)', $day);
			$this->db->where('MONTH(u.review_accept_date)', $month);
		}
		if ($month != "" && $day != "" && $year != "") {
			$this->db->where('DATE(u.review_accept_date)', "$year-$month-$day");
		}
	
		$this->db->group_by('u.email');
		$this->db->order_by("MAX(u.user_ID)", "DESC");
	
		$q = $this->db->get();
		if (($q !== false) ? $q->num_rows() : 0) {
			return $count == 1 ? $q->num_rows() : $q->result();
		}
		return false;
	}
	
	
	function income_report_listing($payment_for=""){
		$this->db->select("pt.*,u.university_name as name");
		$this->db->from($this->paymentTbl.' pt');
		$this->db->join($this->universityTbl.' u','pt.user_id = u.uniid');
		if($payment_for !=""){
		$this->db->where('pt.payment_for',$payment_for);
		}
		$this->db->order_by("pt.payment_id", "desc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}  
	function profession_income_report_listing($payment_for){
		$this->db->select("pt.*,u.fname,u.lname,u.name");
		$this->db->from($this->paymentTbl.' pt');
		$this->db->join($this->userTbl.' u','pt.user_id = u.user_ID');
		$this->db->where('pt.payment_for',$payment_for);
		$this->db->order_by("pt.payment_id", "desc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}
	function course_income_report_listing($payment_for){
		$this->db->select("pt.*,c.course_title name, cep.business_name cep_name");
		$this->db->from($this->paymentTbl.' pt');
		$this->db->join($this->coursedocumentTbl.' c','pt.doc_refrence_id = c.cor_doc_id');
		$this->db->join($this->cepTbl.' cep','pt.user_id = cep.provider_id');
		$this->db->where('pt.payment_for',$payment_for);
		$this->db->order_by("pt.payment_id", "desc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}
	function graduate_income_report_listing($payment_for){
		$this->db->select("pt.*,concat(g.student_name,' ',g.middle_name,' ',g.surname) name,u.university_name");
		$this->db->from($this->paymentTbl.' pt');
		$this->db->join($this->graduatesTbl.' g','pt.user_id = g.grad_id');
		$this->db->join($this->universityTbl.' u', 'g.uniid=u.uniid');
		$this->db->where('pt.payment_for',$payment_for);
		$this->db->where('pt.txn_id !=','');
		$this->db->order_by("pt.payment_id", "desc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}
	function training_income_report_listing($payment_for){
		$this->db->select("pt.*,t.training_title name, cep.business_name cep_name");
		$this->db->from($this->paymentTbl.' pt');
		$this->db->join($this->trainingdocumentsTbl.' t','pt.doc_refrence_id = t.train_doc_id');
		$this->db->join($this->cepTbl.' cep','pt.user_id = cep.provider_id');
		$this->db->where('pt.payment_for',$payment_for);
		$this->db->order_by("pt.payment_id", "desc");
		$query = $this->db->get();		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}
	
	public function get_cep_details($provider_id)
	{
		$this->db->select("t2.*,t1.accreditation_image,t1.accreditation_image,t1.license_image,t5.countries_name as co_name");
		$this->db->from($this->tbl_cep_documents. ' as t1');
		$this->db->join($this->cepTbl .' as t2','t2.provider_id=t1.provider_id','inner');
		$this->db->join($this->countryTbl .' as t5','t5.countries_id=t2.countries_id','left');
		$this->db->join($this->paymenttransactionTbl .' as t3','t3.user_id=t1.provider_id','inner');
		$this->db->join($this->adminTbl . ' as t4','t1.reviewer_id=t4.user_ID','left');
		$this->db->where('t3.payment_for','CEP');
		$this->db->where('t1.document_for','n');
		$this->db->where('t2.provider_id',$provider_id);
		

		
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;

	}
	

	function candidates_for_professional_registration_by_admin(){
		// ,doc.pd_id doc_id,doc.reviewer_status, doc.expiry_at,
		$this->db->select("u.*");
		$this->db->from($this->userTbl.' u','doc.user_id = u.user_ID');
		$this->db->where('u.registration_no !=','');
		$this->db->where('u.role','L');
		$this->db->where('u.refrence_code','');

		$this->db->group_by('u.registration_no');
		$this->db->order_by("u.user_ID", "DESC");

		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result();
		}
		return false;
	}

	function candidates_for_professional_registration_by_itself(){
		$this->db->select("u.*,doc.pd_id doc_id,doc.reviewer_status");
		$this->db->from($this->pDocTbl.' doc');
		$this->db->join($this->userTbl.' u','doc.user_id = u.user_ID');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('u.registration_no !=','');
		$this->db->where('u.role !=','L'); // this role is added by admin, so we don't need it here

		$this->db->group_by('u.registration_no');
		$this->db->order_by("doc.pd_id", "DESC");

		$q = $this->db->get();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result();
		}
		return false;
	}

	function candidates_for_professional_registration_from_gradutes($count=false){
		
		$this->db->select("u.*");
		$this->db->from($this->graduatesTbl.' u','pl.user_id = u.grad_id');
		$this->db->where('u.registration_no !=','');

		$this->db->group_by('u.registration_no');
		$this->db->order_by("u.grad_id", "DESC");

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
	
	function get_registered_candidates($count=false){
		//fillter 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		$addedbyadmin = (isset($_GET['id']))?$_GET['id']:'';
		
		$this->db->select("u.*,doc.pd_id doc_id,doc.reviewer_status, doc.expiry_at, u.license_no, u.license_validity_date lic_expiry_date,u.license_issued_date lic_issue_date");
		// $this->db->from($this->profLicenseTbl.' pl');
		$this->db->from($this->pDocTbl.' doc');
		$this->db->join($this->userTbl.' u','doc.user_id = u.user_ID');
		//$this->db->group_by('doc.pd_id','DESC');
		$this->db->where('doc.reviewer_status','1');
		$this->db->where('u.registration_no !=','');

		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(doc.added_on)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(doc.added_on)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(doc.added_on)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(doc.added_on)',$year);
			$this->db->where('month(doc.added_on)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(doc.added_on)',$day);
			$this->db->where('month(doc.added_on)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(doc.added_on)',$year.'-'.$month.'-'.$day);
		}
		if($addedbyadmin != ""){
			if($addedbyadmin == "l"){
				$this->db->where('u.role','L');
				$this->db->where('u.added_by_admin','l');
			}
			if($addedbyadmin == "p"){
				$this->db->where('u.role','P');
				$this->db->or_where('u.added_by_admin','p');
			}
			if($addedbyadmin == "f"){
				$this->db->where('u.role','F');
				$this->db->or_where('u.added_by_admin','f');
			}
		}
		
		$this->db->group_by('u.registration_no');
		$this->db->order_by("doc.pd_id", "DESC");

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

	function get_registered_professional($count=false){
		$name  = isset($_GET['name']) ? $_GET['name'] : '';
		$month = isset($_GET['month']) ? $_GET['month'] : '';
		$day   = isset($_GET['day']) ? $_GET['day'] : '';
		$year  = isset($_GET['year']) ? $_GET['year'] : '';
	
		$this->db->select("u.pl_id, u.user_id, u.username, pt.payment_gross as amount, pt.payment_status, pt.txn_id, pt.payment_date, us.role, us.fname, us.lname, us.name as surname, us.license_no as licenseno, us.image, p.status, p.expiry_at, p.refrence_code");
		$this->db->from($this->paymentTbl.' pt');
		$this->db->join($this->pDocTbl.' p','pt.doc_refrence_id = p.pd_id');
		$this->db->join($this->profLicenseTbl.' u','p.user_id = u.user_id');
		$this->db->join($this->userTbl.' us','u.user_id = us.user_ID','left');
		$this->db->where('u.payment_status','1');
		$this->db->where('pt.payment_for','PR');
	
		$this->db->group_by([ // Explicit all selected fields to avoid ONLY_FULL_GROUP_BY error
			'u.pl_id', 'u.user_id', 'u.username',
			'pt.payment_gross', 'pt.payment_status', 'pt.txn_id', 'pt.payment_date',
			'us.role', 'us.fname', 'us.lname', 'us.name', 'us.license_no', 'us.image',
			'p.status', 'p.expiry_at', 'p.refrence_code'
		]);
	
		if($name != ""){
			$this->db->like('us.fname', $name);
			$this->db->or_like('us.lname', $name);
			$this->db->or_like('us.name', $name);
		}
		if($month == "" && $year != ""){
			$this->db->where('year(pt.payment_date)', $year);
		}
		if($month != "" && $year == ""){
			$this->db->where('month(pt.payment_date)', $month);
		}
		if($month != "" && $year != ""){
			$this->db->where('month(pt.payment_date)', $month);
			$this->db->where('year(pt.payment_date)', $year);
		}
	
		$this->db->order_by("u.pl_id", "DESC");
		$q = $this->db->get();
	
		if(($q !== false) ? $q->num_rows() : 0){
			return $count == 1 ? $q->num_rows() : $q->result();
		}
		return false;
	}
	

	function assingedexaschudule($proctor_id){
		$this->db->select('es.*');
		$this->db->from($this->proctor_exam_scheduleTbl.' es');
		$this->db->where('es.proctor_id',$proctor_id);
		$sql = $this->db->get();
		$result = $sql->result();
		return $result;
	}
	function get_examination_schedule_for_proctor($proctor,$date){
		$this->db->select('es.*');
		$this->db->from($this->examscheduleTbl.' es');
		//$this->db->join($this->proctor_exam_scheduleTbl.' pes','es.es_id != pes.exam_schedule_id');
		$this->db->where('es.exam_for',$proctor);
		$this->db->where('es.date >=',$date);
		$this->db->where('es.status','1');
		//$this->db->where('pes.exam_schedule_id',null);
		$this->db->order_by("es.date", "asc");
		$sql = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $sql->result();
		return $result;
	}
	function get_examination_schedule($id){
		$this->db->select('es.*');
		$this->db->from($this->examscheduleTbl.' es');
		// $this->db->join($this->publishquestionTbl.' pq','es.es_id = pq.es_id','left');
		$this->db->where('es.es_id',$id);
		$this->db->where('es.status','1');
		$sql = $this->db->get();
		$result = $sql->result();
		return $result;
	}

	function get_publish_examination_question($count=false){
		$this->db->select('es.*,es.name_of_exam exam_title,es.es_id esid,pq.*,pq.status pstatus');
		$this->db->from($this->examscheduleTbl.' es');
		$this->db->join($this->publishquestionTbl.' pq','es.es_id = pq.es_id','left');
		$this->db->where('exam_mode', 'pb');
		$this->db->where('es.status','1');
		$sql = $this->db->get();
		if($sql->num_rows()>0)
		{
			if($count==1){
				return $sql->num_rows();
			}else{
				return $sql->result();
			}
		}
		return false;
	}

	function checkExamQuestionLimit($es_id){
		$this->db->select('*');
		$this->db->from($this->examQuestionsTbl);
		$this->db->where('set_no',$es_id);
		$this->db->where('status','2');
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result; 
		}
	}
	function check_ques_limit_by_catid_and_setno($ques_cat_id, $set_no){
		$this->db->select('*');
		$this->db->from($this->exam_ques_by_cat_setTbl);
		$this->db->where('set_no',$set_no);
		$this->db->where('cat_id',$ques_cat_id);
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		$result = $query->row();
		return $result; 
	}
	function check_get_question($ques_cat_id, $set_no){
		$this->db->select('*');
		$this->db->from($this->examQuestionsTbl);
		$this->db->where('set_no',$set_no);
		$this->db->where('ques_cat_id',$ques_cat_id);
		$this->db->where('status','2');
		$query = $this->db->get();
		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->num_rows();
			return $result;		
		}
		return false; 
	}

	function get_all_published_questions($es_id){
		$this->db->select('*');
		$this->db->from($this->examQuestionsTbl);
		$this->db->where('set_no',$es_id);
		$this->db->where('status','2');
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result; 
		}
	}

	function get_course_document($count=false,$status=false){
		//fillter 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		
		$this->db->select("cd.*,cep.provider_id provider_id,cep.business_name provider_name, cep.email provider_email,rev.first_name rev_firsname,rev.last_name rev_lastname");
		$this->db->select("cd.*");
		$this->db->from($this->coursedocumentTbl.' cd');
		$this->db->join($this->cepTbl.' cep','cd.provider_id = cep.provider_id','left');
		// $this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'cd.reviewer_id = rev.user_ID','left');
		// $this->db->group_by('u.username');
		// $this->db->where('u.payment_status','1');
			
		if($status!=""){
		$this->db->where('cd.reviewer_status',$status);
		}
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(cd.applied_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(cd.applied_date)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(cd.applied_date)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(cd.applied_date)',$year);
			$this->db->where('month(cd.applied_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(cd.applied_date)',$day);
			$this->db->where('month(cd.applied_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(cd.applied_date)',$year.'-'.$month.'-'.$day);
		}
		$this->db->order_by("cd.cor_doc_id", "DESC");

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
	function get_training_document($count=false,$status=false){
		//fillter 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		
		$this->db->select("t.*, u.business_name,u.company_logo,u.email,con.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname, rev.last_name rev_lastname");
		$this->db->from($this->trainingdocumentsTbl.' t');
		$this->db->join($this->cepTbl.' u','u.provider_id = t.provider_id','left');
		$this->db->join($this->countryTbl.' con','u.countries_id = con.countries_id','left');
		$this->db->join($this->paymentTbl.' pt','t.train_doc_id = pt.doc_refrence_id','inner');
		$this->db->join($this->adminTbl.' rev', 't.reviewer_id = rev.user_ID','left');
		// $this->db->where('t.licence_applied',1);
		$this->db->where('pt.payment_for','T');
			
		if($status!=""){
		$this->db->where('t.reviewer_status',$status);
		}
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(t.applied_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(t.applied_date)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(t.applied_date)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(t.applied_date)',$year);
			$this->db->where('month(t.applied_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(t.applied_date)',$day);
			$this->db->where('month(t.applied_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(t.applied_date)',$year.'-'.$month.'-'.$day);
		}
		$this->db->order_by("t.train_doc_id", "DESC");

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
	function insertproctornotifications($data){
		$this->db->insert($this->proctor_notificationsTbl,$data);
		$insert_id = $this->db->insert_id(); 
   		// echo $this->db->last_query();
   		return  $insert_id;
	}

	function check_user($email){
		$this->db->select('*');
		$this->db->from($this->cepTbl);
		$this->db->where('email',$email);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result = $query->row();
		}else{
			$result = $query->num_rows();
		}
		return false;
	}

	function check_professional_user($email){
		$this->db->from($this->profLicenseTbl);
		$this->db->where('email',$email);
		$this->db->group_by('license_no');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
		}else{
			$result = $query->num_rows();
		}
		return false;
	}

	public function get_one_receipt_details($id)
	{
		$this->db->select("pt.*");
		$this->db->from($this->paymenttransactionTbl. ' pt');
		//$this->db->join($this->universityTbl .' as u','pt.user_id = u.uniid','inner');
		$this->db->where('pt.payment_id',$id);
				
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
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
		if($status != null){
			$this->db->where('g.reviewer_status', $status);
		}
		// if($reviewer_id){
		// 	$this->db->where('g.reviewer_id',$reviewer_id);
		// }
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

		if($status!=null){
			$this->db->where('doc.reviewer_status',$status);
		}
		// if($reviewer_id){
		// 	$this->db->where('doc.reviewer_id',$reviewer_id);
		// }
		if($document_for!=null){
			$this->db->where('doc.document_for',$document_for);
		}

		$this->db->group_by('doc.reference_no');
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

	function get_fp_application($count=null, $status=null, $reviewer_id=null, $type = null){ 
		$this->db->select('prof.*,p.name collegeofname, pt.payment_gross amount, pt.payment_status, pt.txn_id, rev.first_name rev_firsname,rev.last_name rev_lastname');
		$this->db->from($this->userTbl.' prof');
		$this->db->join($this->professionTbl.' p', 'prof.profession = p.id','left');	
		$this->db->join($this->paymenttransactionTbl.' pt', 'prof.user_ID = pt.user_id','inner');	
		$this->db->join($this->adminTbl.' rev', 'prof.reviewer_id=rev.user_ID','left');
		//$this->db->where('prof.examcode !=', '');
		if($status != null){
			$this->db->where('prof.reviewer_status', $status);
		}
		// if($reviewer_id){
		// 	$this->db->where('prof.reviewer_id',$reviewer_id);
		// }
		$this->db->where('prof.role', 'F');
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
		$this->db->join($this->examscheduleTbl.' e', 'b.examination_id = e.es_id','left');	
		$this->db->join($this->paymenttransactionTbl.' pt', 'prof.user_ID = pt.user_id','inner');	
		$this->db->join($this->adminTbl.' rev', 'prof.reviewer_id=rev.user_ID','left');
		if($status != null){
			$this->db->where('prof.reviewer_status', $status);
		}
		// if($reviewer_id){
		// 	$this->db->where('prof.reviewer_id',$reviewer_id);
		// }
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
		if($status != null){
			$this->db->where('ud.reviewer_status',$status);
		}
		// if($reviewer_id==0){
		// 	$this->db->where('ud.reviewer_id',0);
		// }
		// if($reviewer_id){
		// 	$this->db->where('ud.reviewer_id',$reviewer_id);
		// }
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
		// echo '<pre>'.$this->db->last_query(); die;
		return false;				
	}

	function get_course_acc_application($count = false, $status=null, $reviewer_id=null,$document_for=null){
		$this->db->select("doc.*, doc.cor_doc_id doc_id, doc.reviewer_id rev_id, doc.reviewer_status rev_status, cep.business_name, cep.business_no, cep.email, cep.provider_id pid, pt.payment_gross amount, pt.payment_status, pt.txn_id,t4.first_name rev_firsname,t4.last_name rev_lastname");
		$this->db->from($this->coursedocumentTbl.' as doc');
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
		// if($reviewer_id){
		// 	$this->db->where('doc.reviewer_id',$reviewer_id);
		// }
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
		// if($reviewer_id){
		// 	$this->db->where('doc.reviewer_id',$reviewer_id);
		// }
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

	function get_terms($type=false){
		if(!empty($type))
		{
			$this->db->where('type',$type);
		}
		$this->db->order_by('type','ASC');
		$result = $this->db->get($this->termsTbl)->row_array();
		return $result; 
	}
	
	function get_tutorial($type=false){
		if(!empty($type))
		{
			$this->db->where('type',$type);
		}
		$this->db->order_by('added_on','DESC');
		$result = $this->db->get($this->tutorialTbl)->result_array();
		return $result; 
	}

	
	function get_forigen_examiness_result($count=false){
		//fillter 
		$es_id 		= (isset($_GET['es_id']))?$_GET['es_id']:'';
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		$id 		= (isset($_GET['id']))?$_GET['id']:'';
		
		$this->db->select('er.*,er.id er_id,er.status exam_result, p.expiry_at validity,p.pd_id,u.registration_no registration_code,CONCAT(u.fname," ",u.lname," ",u.name) fullname, u.email, u.fname, u.lname, u.name, u.exam_code, u.attendance, u.image photo, es.es_id, es.name_of_exam exam_name, es.date exam_date, es.start_time exam_start_time, es.end_time exam_end_time,es.venue exam_venue');
		$this->db->from($this->exam_resultTbl.' er');
		$this->db->join($this->userTbl.' u','er.user_id = u.user_ID');
		$this->db->join($this->pDocTbl.' p','er.user_id = p.user_id');
		$this->db->join($this->examscheduleTbl.' es','er.question_set = es.es_id');
		$this->db->where("er.user_type", "pp");
		$this->db->order_by("er.id", "desc");

		if($id != '' && $id == 1){
			$this->db->where('es.date >=', date('Y-m-d'));
		}
		if($id != '' && $id == 2){
			$this->db->where('es.exam_mode', 'cb');
		}
		if($id != '' && $id == 3){
			$this->db->where('es.exam_mode', 'pb');
		}
		if($es_id != ""){
			$this->db->where('er.question_set',$es_id);
		}
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(er.added_on)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(er.added_on)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(er.added_on)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(er.added_on)',$year);
			$this->db->where('month(er.added_on)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(er.added_on)',$day);
			$this->db->where('month(er.added_on)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(er.added_on)',$year.'-'.$month.'-'.$day);
		}
		$q = $this->db->get();
		// echo $this->db->last_query();die;
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
	function get_examresultdataforpopup($id=false){
		$this->db->select('er.*,er.id er_id,er.status exam_result, p.expiry_at validity,u.registration_no registration_code,CONCAT(u.fname," ",u.lname," ",u.name) fullname, u.email, u.exam_code, u.attendance, u.image photo, es.es_id, es.name_of_exam exam_name, es.date exam_date, es.start_time exam_start_time, es.end_time exam_end_time,es.venue exam_venue');
		$this->db->from($this->exam_resultTbl.' er');
		$this->db->join($this->userTbl.' u','er.user_id = u.user_ID');
		$this->db->join($this->pDocTbl.' p','er.user_id = p.user_id');
		$this->db->join($this->examscheduleTbl.' es','er.question_set = es.es_id');
		$this->db->where("er.id", $id);
		
		//$this->db->order_by("er.id", "desc");
		$q = $this->db->get();
		return $q->row();
	}

	function get_graexamresultdataforpopup($id=false){
		$this->db->select('er.*,er.id er_id,er.status exam_result,CONCAT(g.student_name," ",g.middle_name," ",g.surname) fullname, g.photo, es.es_id, es.name_of_exam exam_name, es.date exam_date, es.start_time exam_start_time, es.end_time exam_end_time,es.venue exam_venue');
		$this->db->from($this->exam_resultTbl.' er');
		$this->db->join($this->graduatesTbl.' g','er.user_id = g.grad_id');
		//$this->db->join($this->pDocTbl.' p','er.user_id = p.user_id');
		$this->db->join($this->examscheduleTbl.' es','er.question_set = es.es_id');
		$this->db->where("er.id", $id);
		
		//$this->db->order_by("er.id", "desc");
		$q = $this->db->get();
		return $q->row();
	}

	
	function get_graduate_examiness_result($count=false){
		//fillter 
		$es_id 		= (isset($_GET['es_id']))?$_GET['es_id']:'';
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		$id 		= (isset($_GET['id']))?$_GET['id']:'';
		
		$this->db->select('er.*,er.id er_id,er.status exam_result, CONCAT(u.student_name," ",u.middle_name," ",u.surname) fullname, u.student_name, u.middle_name, u.surname, u.email, u.examcode exam_code, u.attendance, u.photo, u.validity, u.registration_no registration_code,es.es_id, es.name_of_exam exam_name, es.date exam_date, es.start_time exam_start_time, es.end_time exam_end_time,es.venue exam_venue');
		$this->db->from($this->exam_resultTbl.' er');
		$this->db->join($this->graduatesTbl.' u','er.user_id = u.grad_id');
		$this->db->join($this->examscheduleTbl.' es','er.question_set = es.es_id');
		$this->db->where("er.user_type", "p");
		$this->db->order_by("er.id", "desc");

		if($id != '' && $id == 1){
			$this->db->where('es.date >=', date('Y-m-d'));
		}
		if($id != '' && $id == 2){
			$this->db->where('es.exam_mode', 'cb');
		}
		if($id != '' && $id == 3){
			$this->db->where('es.exam_mode', 'pb');
		}
		if($es_id != ""){
			$this->db->where('er.question_set',$es_id);
		}
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(er.added_on)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(er.added_on)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(er.added_on)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(er.added_on)',$year);
			$this->db->where('month(er.added_on)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(er.added_on)',$day);
			$this->db->where('month(er.added_on)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(er.added_on)',$year.'-'.$month.'-'.$day);
		}
		$q = $this->db->get();
		//echo $this->db->last_query();die;
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
	public function get_profession()
	{
		$this->db->select('*');
		$this->db->from($this->professionTbl);
		$this->db->where('status', 1);
		$q = $this->db->get();
		return $q->result();
	}
	public function prof_detail_for_newstatus($userid=null){
		$this->db->select("u.*,prof.expiry_at, prof.pd_id, prof.license_no licenseno, prof.lic_issue_date,pl.lic_expiry_date,pl.registration_no registrationno, p.name profession_name ,c.name college_of, uni.university_name,cou.countries_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname"); 
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->pDocTbl.' prof', 'u.user_ID = prof.user_id','left');
		$this->db->join($this->profLicenseTbl.' pl', 'u.user_ID = pl.user_id','left');
		$this->db->join($this->paymentTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->professionTbl.' c','u.college = c.id','inner');
		$this->db->join($this->universityTbl.' uni','u.university = uni.uniid','left');
		$this->db->join($this->countryTbl.' cou','u.country = cou.countries_id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->where('u.user_ID',$userid);
		$q = $this->db->get();
		return $q->result();
	}
	public function update_status($userid='', $data=''){
		$this->db->where('user_ID',$userid);
		$result = $this->db->update($this->userTbl,$data);
		return $result;
	}
	public function insert_admin_comment($insertcomment){
		$result = $this->db->insert($this->adminCommentTbl, $insertcomment);
		return $result;
	}
	public function get_contact_us_list(){		
		$this->db->select('cus.*,c.countries_name country_name');
		$this->db->from($this->contactTbl.' cus');
		$this->db->join($this->countryTbl.' c','cus.country = c.countries_id','left');
		$this->db->order_by('cus.cont_id','DESC');
		$result = $this->db->get()->result_array();
   		// echo $this->db->last_query(); die();
		return $result;
	}
	function get_forigen_examiness_list($count=false){ 
		//fillter 
		$es_id 		= (isset($_GET['es_id']))?$_GET['es_id']:'';
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		
		$name 		= (isset($_GET['name']))?$_GET['name']:'';
		$email 		= (isset($_GET['email']))?$_GET['email']:'';
		$exam_code 	= (isset($_GET['exam_code']))?$_GET['exam_code']:'';
		$dob 		= (isset($_GET['dob']))?$_GET['dob']:'';
		
		/* $this->db->select("u.*,CONCAT(u.fname,' ',u.lname,' ',u.name) name, doc.expiry_at,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, pt.payment_date issued_date,rev.first_name rev_firsname,rev.last_name rev_lastname,es.date exam_date,es.start_time,es.end_time");
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->paymenttransactionTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->pDocTbl.' doc','u.user_ID = doc.user_id','left');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->join($this->book_examTbl.' b', 'u.user_ID = b.user_id','left');
		$this->db->join($this->examscheduleTbl.' es', 'b.examination_id = es.es_id','left');
		$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'pes.exam_schedule_id = es.es_id');
		
		$this->db->where('pt.payment_type','E');// That means payment for exam booking 
		$this->db->where('b.booking_for','PP');// That means Exam Booking for forigen professional  
		$this->db->where('u.exam_code !=',''); */
		
		$this->db->select("u.*,CONCAT(u.fname,' ',u.lname,' ',u.name) name,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, pt.payment_date issued_date,rev.first_name rev_firsname,rev.last_name rev_lastname,es.date exam_date,es.start_time,es.end_time");
		$this->db->from($this->book_examTbl.' b');
		$this->db->join($this->userTbl.' u', 'b.user_id=u.user_ID');
		$this->db->join($this->paymenttransactionTbl.' pt','u.user_ID = pt.user_id');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->join($this->examscheduleTbl.' es', 'b.examination_id = es.es_id');		
		$this->db->where('pt.payment_type','E');// That means payment for exam booking 
		$this->db->where('b.booking_for','PP');// That means Exam Booking for forigen professional  
		$this->db->where('u.exam_code !=','');
		if($name != "" ){
			$this->db->like('u.fname',$name);
			$this->db->or_like('u.lname',$name);
			$this->db->or_like('u.name',$name);
		}
		if($email != "" ){
			$this->db->where('u.email',$email);
		}
		if($dob != "" ){
			$this->db->where('u.dob',$dob);
		}
		if($exam_code != "" ){
			$this->db->where('u.exam_code',$exam_code);
		}
		if($es_id != "" && $es_id > 0 ){
			$this->db->where('b.examination_id',$es_id);
		}

		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(u.added_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(u.added_date)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(u.added_date)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(u.added_date)',$year);
			$this->db->where('month(u.added_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(u.added_date)',$day);
			$this->db->where('month(u.added_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(u.added_date)',$year.'-'.$month.'-'.$day);
		}
		$this->db->order_by("es.date", "desc");
		$this->db->group_by('u.email');
		$q = $this->db->get();
		//echo $this->db->last_query();exit;
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

	function get_graduate_examiness_list($count=false){
		//fillter 
		$es_id 		= (isset($_GET['es_id']))?$_GET['es_id']:'';
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		$name 		= (isset($_GET['name']))?$_GET['name']:'';
		$email 		= (isset($_GET['email']))?$_GET['email']:'';
		$exam_code 	= (isset($_GET['exam_code']))?$_GET['exam_code']:'';
		$dob 		= (isset($_GET['dob']))?$_GET['dob']:'';
		
		$this->db->select("u.*,CONCAT(u.student_name,' ',u.middle_name,' ',u.surname) name,u.examcode exam_code, u.grad_id user_ID,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, pt.payment_date issued_date,rev.first_name rev_firsname,rev.last_name rev_lastname,es.date exam_date,es.start_time,es.end_time");
		$this->db->from($this->graduatesTbl.' u');
		$this->db->join($this->paymenttransactionTbl.' pt','u.grad_id = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.college_of = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID');
		$this->db->join($this->book_examTbl.' b', 'u.grad_id = b.user_id');
		$this->db->join($this->examscheduleTbl.' es', 'b.examination_id = es.es_id');
		$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'pes.exam_schedule_id = es.es_id');
		$this->db->group_by('u.email');
		$this->db->where('pt.payment_type','E');// That means payment for exam booking 
		$this->db->where('b.booking_for','p');// That means Exam Booking for graduate  
		$this->db->where('u.examcode !=','');

		if($name != "" ){
			$this->db->like('u.student_name',$name);
			$this->db->or_like('u.middle_name',$name);
			$this->db->or_like('u.surname',$name);
		}
		if($email != "" ){
			$this->db->where('u.email',$email);
		}
		if($dob != "" ){
			$this->db->where('u.dob',$dob);
		}
		if($exam_code != "" ){
			$this->db->where('u.examcode',$exam_code);
		}
		if($es_id != "" && $es_id > 0 ){
			$this->db->where('b.examination_id',$es_id);
		}
		if($month == "" && $day =="" && $year !=""){
			$this->db->where('year(u.added_date)',$year);
		}
		if($month != "" && $day =="" && $year ==""){
			$this->db->where('month(u.added_date)',$year);
		}
		if($month == "" && $day !="" && $year ==""){
			$this->db->where('day(u.added_date)',$year);
		}
		if($month != "" && $day =="" && $year !=""){
			$this->db->where('year(u.added_date)',$year);
			$this->db->where('month(u.added_date)',$month);
		}
		if($month != "" && $day !="" && $year ==""){
			$this->db->where('day(u.added_date)',$day);
			$this->db->where('month(u.added_date)',$month);
		}
		if($month != "" && $day !="" && $year !=""){
			$this->db->where('date(u.added_date)',$year.'-'.$month.'-'.$day);
		}
		$this->db->order_by("u.grad_id", "desc");
		
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
	
	function all_online_application_listing_old($payment_for= null,$limit=null){		
		$this->db->from($this->paymenttransactionTbl.' pt');
		$this->db->where('txn_id !=','');
		$this->db->where('subscription','n');		
		if(isset($_GET['modules']) && $_GET['modules'] !=""){ 
			$this->db->where('user_id',$_GET['modules']);	
		}
		
		if(isset($_GET['income_sources']) && $_GET['income_sources'] !="" || $payment_for !=""){
			
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'professional_registration' || $payment_for == 'professional_registration'){
				$this->db->where('payment_for','PR');
				$this->db->where('payment_type','N');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'professional_license_renewal' || $payment_for == 'professional_license_renewal'){
				//$this->db->where('payment_for','PR');
				$this->db->where_in('payment_for',array('PR','PRG'));	
				$this->db->where('payment_type','R'); 
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'school_accreditaion' || $payment_for == 'school_accreditaion'){
				//echo 'sdfs'; exit;
				$this->db->where('payment_for','U');
				$this->db->where_in('payment_type',array('N','R')); 
			}
			
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'submission_of_graduates' || $payment_for == 'submission_of_graduates'){
				$this->db->where('payment_for','G');
				$this->db->where('payment_type','S');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'booking_for_exam_graduates' || $payment_for == 'booking_for_exam_graduates'){
				$this->db->where('payment_for','G');
				$this->db->where('payment_type','E');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'foreign_professional_registration' || $payment_for == 'foreign_professional_registration'){
				$this->db->where('payment_for','P');
				$this->db->where('payment_type','N');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'foreign_professional_examination' || $payment_for == 'foreign_professional_examination'){
				$this->db->where('payment_for','PP');
				$this->db->where('payment_type','N');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'booking_for_exam_foreign_professionals' || $payment_for == 'booking_for_exam_foreign_professionals'){
				$this->db->where('payment_for','PP');
				$this->db->where('payment_type','E');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'cep_accreditation' || $payment_for == 'cep_accreditation'){
				$this->db->where('payment_for','CEP');
				//$this->db->where('payment_type','E');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'online_course_accreditation' || $payment_for == 'online_course_accreditation'){
				$this->db->where('payment_for','C');
				$this->db->where('payment_type','N');
			}
			if(isset($_GET['income_sources']) && $_GET['income_sources'] == 'training_course_accreditation' || $payment_for == 'training_course_accreditation'){
				$this->db->where('payment_for','T');
				$this->db->where('payment_type','N');
			}
			
				
		}
		if(isset($_GET['user_role']) && $_GET['user_role'] !=""){
			$this->db->where('payment_for',$_GET['user_role']);	
		}
		if(isset($_GET['day']) && $_GET['day'] !=""){
			$this->db->where('day(payment_date)',$_GET['day']);	
		}
		if(isset($_GET['mouth']) && $_GET['mouth'] !=""){
			$this->db->where('month(payment_date)',$_GET['mouth']);			
		}
		
		if(isset($_GET['year']) && $_GET['year'] !=""){
			$this->db->where('year(payment_date)',$_GET['year']);	
		}
		
		if($limit != null){
			$this->db->limit($limit,0);
		}
		$this->db->order_by("pt.payment_id", "asc");
		$query = $this->db->get();
		//echo $this->db->last_query(); die;		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}

	function all_online_application_listing($limit=null){		
		$this->db->from($this->paymenttransactionTbl.' pt');
		$this->db->where('txn_id !=','');
		$this->db->order_by("pt.payment_id", "asc");
		if($limit != null){
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); die;		
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}

	function get_admin_all_subscription_details(){
		$this->db->select('asd.*');
		$this->db->from($this->adminSubscriptionDetailsTbl.' asd');
		// $this->db->where('admin_email',1);
		$query = $this->db->get();	
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}

	
	public function get_professioanl_details($uid){
		$this->db->select('u.*,CONCAT(u.fname," ",u.lname," ",u.name) fullname, p.name profession_name, un.university_name, ps.name college_name, cn.countries_name');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->professionTbl.' ps','u.college = ps.id','left');
		$this->db->join($this->universityTbl.' un','u.university = un.uniid','left');
		$this->db->join($this->countryTbl.' cn','u.country = cn.countries_id','left');
		$this->db->where('u.user_ID',$uid);
		$result = $this->db->get()->row_object();
   		// echo $this->db->last_query();
		return $result;
	}

	public function savetermscondition($data){
		return $this->db->insert('tbl_terms_conditions',$data);
	}

	public function get_presently_added_professionals(){
		$type = isset($_GET['id'])?$_GET['id']:'';
		
		$this->db->where('role','L');
		if($type != ''){
			$this->db->where('added_by_admin',$type);
		}
		$result = $this->db->get($this->userTbl)->result();
   		// echo $this->db->last_query();
		return $result;
	}
	public function get_number_of_professionals($type=''){
		$this->db->where('role','L');
		if($type != ''){
			$this->db->where('added_by_admin',$type);
		}
		$result = $this->db->get($this->userTbl)->num_rows();
   		// echo $this->db->last_query();
		return $result;
	}	
		
	public function get_certificate_reported_by_cep($id=false, $count_submitted=false){
		$submitted = isset($_GET['cer'])?$_GET['cer']:'';
		$date = isset($_GET['date'])?$_GET['date']:'';
		$monthyear = isset($_GET['month'])?$_GET['month']:'';
		$cpd = isset($_GET['cpd'])?$_GET['cpd']:'';
		$this->db->select('ec.*,u.fname,u.lname,u.name');
		$this->db->from($this->existingCertificateTbl.' ec');
		$this->db->join($this->userTbl.' u','u.user_ID = ec.user_id','left'); 	
		if(!empty($submitted)){
			if($submitted==1){
				$this->db->where('submitted',NULL);
				$this->db->or_where('submitted','n');
			}elseif($submitted==2){
				$this->db->where('submitted',NULL);
			}else{
				$this->db->where('submitted',NULL);
			}
		}
		if($count_submitted != false){
			if($count_submitted == 'new' || $count_submitted == 'all'){
				$this->db->where('submitted', NULL);
			}else if($count_submitted == 'n'){
				$this->db->where('submitted', 'n');
			}
		}
		if($date !='' && $monthyear ==''):
			$this->db->where('issue_date',$date);
		elseif($monthyear !=''):
			$this->db->where('YEAR(issue_date)',$monthyear);
		else:
			// $this->db->where('issue_date','n');
		endif;
		if($id != false){
			$this->db->where('ec.id', $id);
		}
		$this->db->order_by('id', 'DESC');
		if($id != false){
			$result = $this->db->get()->row();
		}else if($count_submitted != false){
			$result = $this->db->get()->num_rows();
		}else{
			$result = $this->db->get()->result_array();
		}
		return false;
	}
	public function count_certificate_reported_by_cep($count_submitted=false){
		$this->db->select('ec.*,u.fname,u.lname,u.name');
		$this->db->from($this->existingCertificateTbl.' ec');
		$this->db->join($this->userTbl.' u','u.user_ID = ec.user_id','left'); 	
		if($count_submitted != false){
			if($count_submitted == 'all'){
				// $this->db->where('submitted', NULL);
			}else if($count_submitted == 'new'){
				$this->db->where('submitted', NULL);
				$this->db->or_where('submitted', 'n');
			}else if($count_submitted == 'n'){
				$this->db->where('submitted', 'n');
			}
		}
		$result = $this->db->get()->num_rows();
		return $result;
	}
		
	public function get_certificate_reported_by_prof($id=false, $count_submitted=false){
		$submitted = isset($_GET['cer'])?$_GET['cer']:'';
		$date = isset($_GET['date'])?$_GET['date']:'';
		$monthyear = isset($_GET['month'])?$_GET['month']:'';
		$cpd = isset($_GET['cpd'])?$_GET['cpd']:'';

		$this->db->select('uc.*,u.fname,u.lname,u.name');
		$this->db->from($this->userCertificateTbl.' uc');
		$this->db->join($this->userTbl.' u','u.user_ID = uc.user_id','left');
		if(!empty($submitted)){
			if($submitted==1){
				$this->db->where('submitted',NULL);
				$this->db->or_where('submitted','n');
			}elseif($submitted==2){
				$this->db->where('submitted','n');
			}else{
				$this->db->where('submitted',NULL);
			}
		}
		if($date !='' && $monthyear ==''):
			$this->db->where('issue_date',$date);
		elseif($monthyear !=''):
			$this->db->where('YEAR(issue_date)',$monthyear);
		else:
			// $this->db->where('issue_date','n');
		endif;
		if($count_submitted != false){
			if($count_submitted == 'new' || $count_submitted == 'all'){
				$this->db->where('submitted', NULL);
			}else if($count_submitted == 'n'){
				$this->db->where('submitted', 'n');
			}
		}
		if($id != false){
			$this->db->where('uc.id', $id);
		}
		$this->db->order_by('id', 'DESC');
		if($id != false){
			$result = $this->db->get()->row();
		}else if($count_submitted != false){
			$result = $this->db->get()->num_rows();
		}else{
			$result = $this->db->get()->result_array();
		}
		return false;
	}

	public function count_certificate_reported_by_prof($count_submitted=false){
		$this->db->select('ec.*,u.fname,u.lname,u.name');
		$this->db->from($this->userCertificateTbl.' ec');
		$this->db->join($this->userTbl.' u','u.user_ID = ec.user_id','left'); 	
		if($count_submitted != false){
			if($count_submitted == 'all'){
				// $this->db->where('submitted', NULL);
			}else if($count_submitted == 'new'){
				$this->db->where('submitted', NULL);
				$this->db->or_where('submitted', 'n');
			}else if($count_submitted == 'n'){
				$this->db->where('submitted', 'n');
			}
		}
		$result = $this->db->get()->num_rows();
		return $result;
	}
}
?>