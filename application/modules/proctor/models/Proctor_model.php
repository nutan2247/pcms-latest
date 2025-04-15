<?php defined('BASEPATH') OR exit('No direct script access allowed');
		
class Proctor_model extends CI_Model {
	public $universityTbl;
	public $graduatesTbl;
	public $professionTbl;
	public $pDocTbl;
	public $schoolTbl;
	public $paymenttransactionlTbl;
	public $universitynotificationsTbl;
	public $notificationTbl;
	public $questionTbl;
	public $adminTbl;
	public $userTbl;
	public $calenderTbl;
	public $bookexamTbl;
	public $examscheduleTbl;
	public $proctor_exam_scheduleTbl;
	function __construct(){
		$this->universityTbl 	= 'tbl_university';
		$this->graduatesTbl 	= 'graduates';
		$this->professionTbl 	= 'tbl_profession';
		$this->pDocTbl    		= 'tbl_professional_documents';
		$this->schoolTbl 		= 'tbl_schools';
		$this->paymenttransactionlTbl = 'tbl_payment_transaction';
		$this->universitynotificationsTbl = 'tbl_university_notifications';
		$this->notificationTbl 	= 'tbl_university_notifications';
		$this->questionTbl 	= 'tbl_exam_question';
		$this->adminTbl 	= 'tbl_admin';
		$this->userTbl 		= 'tbl_users';
		$this->calenderTbl 		= 'tbl_calender';
		$this->bookexamTbl 		= 'tbl_book_exam';
		$this->examscheduleTbl 		= 'tbl_examination_schedule';
		$this->notificationTbl 		= 'tbl_proctor_notifications';
		$this->proctor_exam_scheduleTbl 		= 'tbl_proctor_exam_schedule';
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

	function get_all_questions($field = false){
		
		$this->db->select('q.*, a.first_name added_by_name, a.user_type role');	
		$this->db->from($this->questionTbl.' q');	
		$this->db->join($this->adminTbl.' a','q.added_by = a.user_ID','left');	
		if(!empty($field)){
			$this->db->where('q.set_no',$field);
		}
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
   		// echo $this->db->last_query();
		return $result;
	}

	function get_uniqueset(){
		$this->db->select('set_no');
		$this->db->group_by('set_no');
		$result = $this->db->get('tbl_exam_question')->result();
   		// echo $this->db->last_query();
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
		
		$this->db->select("u.*,CONCAT(u.fname,' ',u.lname,' ',u.name) name, doc.expiry_at,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, pt.payment_date issued_date,rev.first_name rev_firsname,rev.last_name rev_lastname,es.date exam_date,es.start_time,es.end_time");
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->paymenttransactionlTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->pDocTbl.' doc','u.user_ID = doc.user_id','left');
		$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->join($this->bookexamTbl.' b', 'u.user_ID = b.user_id','left');
		$this->db->join($this->examscheduleTbl.' es', 'b.examination_id = es.es_id','left');
		$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'pes.exam_schedule_id = es.es_id');
		$this->db->group_by('u.email');
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
		$this->db->order_by("u.user_ID", "desc");
		
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
		$this->db->join($this->paymenttransactionlTbl.' pt','u.grad_id = pt.user_id','inner');
		$this->db->join($this->professionTbl.' p','u.college_of = p.id','left');
		$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID');
		$this->db->join($this->bookexamTbl.' b', 'u.grad_id = b.user_id');
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

	function get_notifications($proctor_id,$count = false){
		$this->db->from($this->notificationTbl);
		$this->db->where('proctor_id', $proctor_id);
		$this->db->order_by('pn_id', 'desc');
		$query = $this->db->get();
		if($count==1){
			$result = $query->num_rows();
		}else{
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		}
		return false;		
	}

	function fetchPassword($proctor_id){	
		$this->db->select('password');
		$this->db->from($this->adminTbl);	
		$this->db->where('user_ID', $proctor_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_object();
		return $result;			
	}
	function updatePassword($data, $id){		
		$this->db->where('user_ID', $id);
		$this->db->update($this->adminTbl, $data);
		//echo $this->db->last_query(); die;	
		return true;			
	}

	function get_upcomming_exam($exam_for,$limit,$proctor_id=null){
		//fillter 
		$month 		= (isset($_GET['month']))?$_GET['month']:'';
		$day 		= (isset($_GET['day']))?$_GET['day']:'';
		$year 		= (isset($_GET['year']))?$_GET['year']:date('Y');
		
		$this->db->select('es.*,pes.proctor_id');
		$this->db->from($this->examscheduleTbl.' es');
		$this->db->join($this->proctor_exam_scheduleTbl.' pes','es.es_id=pes.exam_schedule_id');
		if($proctor_id > 0){
		$this->db->where('pes.proctor_id',$proctor_id);
		}
		$this->db->where('es.date >=',date('Y-m-d'));
		
		$this->db->where('es.exam_for',$exam_for);

		if($year!=''){
			$this->db->where('year(es.date)',$year);
		}
		if($limit > 0){
			$this->db->limit($limit);
		}
		$this->db->order_by('es.date','ASC');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;	
	}
	public function get_graduate_examinee_details($id=false){
		//echo'hello';exit;
		$this->db->select("u.*,es.name_of_exam,es.exam_for,es.date exam_date, es.start_time, es.end_time, es.venue");
		//,u.examcode exam_code, u.grad_id user_ID,p.name profession_name, pt.payment_gross amount, pt.payment_status, pt.txn_id, pt.payment_date issued_date,rev.first_name rev_firsname,rev.last_name rev_lastname,es.date exam_date,es.start_time,es.end_time")
		$this->db->from($this->graduatesTbl.' u');
		//$this->db->join($this->paymenttransactionlTbl.' pt','u.grad_id = pt.user_id','inner');
		//$this->db->join($this->professionTbl.' p','u.college_of = p.id','left');
		//$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID');
		$this->db->join($this->bookexamTbl.' b', 'u.grad_id = b.user_id');
		$this->db->join($this->examscheduleTbl.' es', 'b.examination_id = es.es_id');
		//$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'pes.exam_schedule_id = es.es_id');
		//$this->db->group_by('u.email');
		//$this->db->where('pt.payment_type','E');// That means payment for exam booking 
		//$this->db->where('b.booking_for','p');// That means Exam Booking for graduate  
		$this->db->where('u.grad_id',$id);
		$this->db->where('b.payment','1');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$result = $query->row();
		//print_r($result);exit;
		return $result;	
	}
	public function get_professional_examinee_details($id=false){
		$this->db->select("u.*,CONCAT(u.fname,' ',u.lname,' ',u.name) name, doc.expiry_at, doc.license_no licenseno, es.name_of_exam,es.exam_for,es.date exam_date, es.start_time, es.end_time, es.venue");
		$this->db->from($this->userTbl.' u');
		//$this->db->join($this->paymenttransactionlTbl.' pt','u.user_ID = pt.user_id','inner');
		$this->db->join($this->pDocTbl.' doc','u.user_ID = doc.user_id','left');
		//$this->db->join($this->professionTbl.' p','u.profession = p.id','left');
		//$this->db->join($this->adminTbl.' rev', 'u.reviewer_id=rev.user_ID','left');
		$this->db->join($this->bookexamTbl.' b', 'u.user_ID = b.user_id','left');
		$this->db->join($this->examscheduleTbl.' es', 'b.examination_id = es.es_id','left');
		//$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'pes.exam_schedule_id = es.es_id');
		//$this->db->group_by('u.email');
		$this->db->where('u.user_ID',$id);// That means payment for exam booking 
		$this->db->where('b.payment','1');
		//$this->db->where('b.booking_for','PP');// That means Exam Booking for forigen professional  
		//$this->db->where('u.exam_code !=','');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$result = $query->row();
		//print_r($result);exit;
		return $result;
	}
} ?>