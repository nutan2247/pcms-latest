<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Examiner_model extends CI_Model {
	public $universityTbl;
	public $graduatesTbl;
	public $professionTbl;
	public $schoolTbl;
	public $paymenttransactionlTbl;
	public $universitynotificationsTbl;
	public $notificationTbl;
	public $questionTbl;
	public $adminTbl;
	public $userTbl;
	public $calenderTbl;
	public $exam_scheduleTbl;
	public $examquescategoryTbl;
	function __construct(){
		$this->universityTbl 	= 'tbl_university';
		$this->graduatesTbl 	= 'graduates';
		$this->professionTbl 	= 'tbl_profession';
		$this->schoolTbl 		= 'tbl_schools';
		$this->paymenttransactionlTbl = 'tbl_payment_transaction';
		$this->universitynotificationsTbl = 'tbl_university_notifications';
		$this->notificationTbl 	= 'tbl_university_notifications';
		$this->questionTbl 	= 'tbl_exam_question';
		$this->adminTbl 	= 'tbl_admin';
		$this->userTbl 		= 'tbl_users';
		$this->calenderTbl 	= 'tbl_calender';
		$this->exam_scheduleTbl 	= 'tbl_examination_schedule';
		$this->examquescategoryTbl = 'tbl_examination_categories';
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

	public function get_all_exam_dates($year=false)
	{		
		$this->db->select('es.*');	
		$this->db->from($this->exam_scheduleTbl.' es');	
		$this->db->where('es.status','1');
		
		if($year!=''){
			$this->db->where('year(es.date)',$year);
		}

		$this->db->order_by('es.date', 'ASC');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
   		// echo $this->db->last_query();die;
		return $result;
	}

	public function get_all_questions($added_by = false,$publish_status = false)
	{	
		//fillter 
		//$set_no 		= (isset($_GET['set_no']))?$_GET['set_no']:'';
		$excat_id 		= (isset($_GET['excat_id']))?$_GET['excat_id']:'';
		//$year 			= (isset($_GET['year']))?$_GET['year']:'';
		$this->db->select('q.*, a.first_name added_by_name, a.user_type role, es.date examdate, ec.category_name');	
		$this->db->from($this->questionTbl.' q');
		$this->db->join($this->adminTbl.' a','q.added_by = a.user_ID','left');	
		$this->db->join($this->exam_scheduleTbl.' es','q.set_no = es.es_id','left');	
		$this->db->join($this->examquescategoryTbl.' ec','q.ques_cat_id = ec.excat_id','left');
		if(!empty($added_by)){
			$this->db->where('q.added_by',$added_by);
		}

		/*if($set_no != ""){
			$this->db->where('q.set_no',$set_no);
		}*/
		if($excat_id != ""){
			$this->db->where('q.ques_cat_id',$excat_id);
		}
		/*if($year != ""){
			$this->db->where('Year(es.date)',$year);
		}*/
		if($publish_status != ""){
			if($publish_status == '2'){
				$this->db->where('q.status','2');
			}
		}

		$this->db->order_by('q.id', 'DESC');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
   		// echo $this->db->last_query();die;
		return $result;
	}
	public function get_all_questions_for_admin($added_by = false)
	{	
		//fillter
		$status 		= (isset($_GET['status']))?$_GET['status']:'';
		$set_no 		= (isset($_GET['set_no']))?$_GET['set_no']:'';
		$excat_id 		= (isset($_GET['excat_id']))?$_GET['excat_id']:'';
		$excat_idb 		= (isset($_GET['excat_idb']))?$_GET['excat_idb']:'';
		$year 			= (isset($_GET['year']))?$_GET['year']:'';
		$this->db->select('q.*, a.first_name added_by_name, a.user_type role, es.date examdate, ec.category_name');	
		$this->db->from($this->questionTbl.' q');
		$this->db->join($this->adminTbl.' a','q.added_by = a.user_ID','left');	
		$this->db->join($this->exam_scheduleTbl.' es','q.set_no = es.es_id','left');	
		$this->db->join($this->examquescategoryTbl.' ec','q.ques_cat_id = ec.excat_id','left');
		if(!empty($added_by)){
			$this->db->where('q.added_by',$added_by);
		}

		if($set_no != ""){
			$this->db->where('q.set_no',$set_no);
		}
		if($excat_id != ""){
			$this->db->where('q.ques_cat_id',$excat_id);
		}
		if($excat_idb != ""){

			$this->db->where('q.ques_cat_id',$excat_idb);
		}
		if($year != ""){
			$this->db->where('Year(es.date)',$year);
		}
		if($status == 'selected'){
			$this->db->where('q.status','2');
		}
		if($status == 'submitted'){
			$this->db->where('q.status','1');
		}
		if($status == ''){
			$this->db->where('q.status','1');
		}

		$this->db->order_by('q.id', 'DESC');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
   		// echo $this->db->last_query();die;
		return $result;
	}

	
	public function get_question($qid)
	{	
		$this->db->select('q.*, a.first_name added_by_name, a.user_type role, es.date examdate, ec.category_name, ec.excat_id');	
		$this->db->from($this->questionTbl.' q');
		$this->db->join($this->adminTbl.' a','q.added_by = a.user_ID','left');	
		$this->db->join($this->exam_scheduleTbl.' es','q.set_no = es.es_id','left');	
		$this->db->join($this->examquescategoryTbl.' ec','q.ques_cat_id = ec.excat_id','left');
		$this->db->where('q.id',$qid);
		
		$query = $this->db->get();
		$result = $query->row();
   		// echo $this->db->last_query();die;
		return $result;
	}

	function get_uniqueset($added_by=false){
		$this->db->select('q.set_no ,es.date');
		$this->db->from($this->questionTbl.' q');
		$this->db->join($this->exam_scheduleTbl.' es','q.set_no = es.es_id','left');	
		if(!empty($added_by)){
		$this->db->where('q.added_by',$added_by);
		}
		$this->db->where('q.set_no !=','0');
		$this->db->group_by('q.set_no');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
   		// echo $this->db->last_query();
		return $result;
	}

	function get_forigen_examiness_list($count=false){
		//fillter 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:'';
		
		$this->db->select("u.*,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id,rev.first_name rev_firsname,rev.last_name rev_lastname,c.date exam_date,c.slot exam_slot");
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->paymenttransactionlTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->join($this->calenderTbl.' c', 'u.user_ID = c.application_id','left');
		$this->db->group_by('u.email');
		$this->db->where('pt.payment_type','R');// That means payment for exam booking 
		$this->db->where('c.booking_for','P');// That means Exam Booking for forigen professional  

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


} ?>