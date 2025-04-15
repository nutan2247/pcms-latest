<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Graduates_model extends CI_Model {
	public $universityTbl;
	public $graduatesTbl;
	public $professionTbl;
	public $calenderTbl;
	public $book_examTbl;
	public $guidlineTbl;
	public $guidlineheadTbl;
	public $paymenttransactionlTbl;
	public $examscheduleTbl;
	public $exam_resultTbl;
	public $proctor_exam_scheduleTbl;
	function __construct(){
		$this->universityTbl 	= 'tbl_university';
		$this->graduatesTbl 	= 'graduates';
		$this->professionTbl 	= 'tbl_profession';
		$this->calenderTbl 		= 'tbl_calender';
		$this->book_examTbl 		= 'tbl_book_exam';
		$this->guidlineTbl 		= 'tbl_guidline';
		$this->guidlineheadTbl	= 'tbl_guidline_head';
		$this->paymenttransactionlTbl = 'tbl_payment_transaction';
		$this->examscheduleTbl = 'tbl_examination_schedule';
		$this->exam_resultTbl = 'tbl_exam_result';
		$this->proctor_exam_scheduleTbl	= 'tbl_proctor_exam_schedule';
	}
	
	function universitylogin($username,$password){
			//echo $userarr['email'];
			//print_r($userarr); exit;
			$this->db->from($this->universityTbl);
			//$this->db->where(array('student_email'=>$student_email,'student_password'=>$student_password));
			$this->db->where('university_password', $password);
			$this->db->group_start(); // Open bracket
			$this->db->where('email', $username);
			//$this->db->or_where('contact_no', $student_email);
			$this->db->group_end(); // Close bracket
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function universitydetails($uniid){
			//echo $userarr['email'];
			//print_r($userarr); exit;
			$this->db->from($this->universityTbl);	//$this->db->where(array('student_email'=>$student_email,'student_password'=>$student_password));
			$this->db->where('uniid', $uniid);
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function getgraducatedetails($name,$middle_name,$surname,$email,$birthday,$gender,$examination_code){
		$this->db->select('g.*,p.name collegeofname,u.university_name');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		$this->db->join($this->universityTbl.' u', 'g.uniid=u.uniid','left');		
		$this->db->where('g.student_name', $name);
		//if($middle_name != ""){
		$this->db->where('g.middle_name', $middle_name);	
		//}
		//if($surname != ""){
		$this->db->where('g.surname', $surname);	
		//}
		$this->db->where('g.email', $email);
		$this->db->where('g.dob', $birthday);
		$this->db->where('g.gender', $gender);
		$this->db->where('g.examcode', $examination_code);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;		
	}


	public function insert_payment($data){
		$this->db->insert($this->paymenttransactionlTbl, $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function graduatedetails($uniid){
		//echo $userarr['email'];
		//print_r($userarr); exit;
		$this->db->from($this->graduatesTbl);	//$this->db->where(array('student_email'=>$student_email,'student_password'=>$student_password));
		$this->db->where('uniid', $uniid);
		$this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;	
	}
	
	public function updategraduate($data, $id){		
		$this->db->where('grad_id', $id);
		$this->db->update($this->graduatesTbl, $data);
		// echo $this->db->last_query(); die;	
		return true;
	}	

	public function get_guidlines(){
		$this->db->where('status', '1');
		$this->db->where('guidline_for', 'g');
		$query = $this->db->get($this->guidlineTbl);
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
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

	public function fetch_user_details($user_id){
		$this->db->select('u.*,p.name profession_name');
		$this->db->from($this->graduatesTbl.' u');
		$this->db->join($this->professionTbl.' p','u.college_of = p.id','left');
		$this->db->where('u.grad_id',$user_id);
		$result = $this->db->get()->row_object();
   		//echo $this->db->last_query(); exit;
		return $result;
	}

	public function add_exam_date($data){
		$add = array(
			'user_id'			=> $data['uid'],
			'examination_id' 	=> $data['id'],
			'booking_for'  		=> 'p',
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
		$this->db->where('booking_for', 'p');
		$query = $this->db->get($this->book_examTbl);
		$result = $query->row();
		return !empty($result)?$result:false;
	}
	public function getRows($id = ''){
		$this->db->select('*');
		$this->db->from($this->graduatesTbl);
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
	
	public function get_examination_schedule(){
		
		$this->db->select('es.*');
		$this->db->from($this->examscheduleTbl.' es');
		//$this->db->join($this->proctor_exam_scheduleTbl.' pes', 'es.es_id = pes.exam_schedule_id');	
		$this->db->where('es.status', '1');
		$this->db->where('es.exam_for', 'p');
		$this->db->where('es.date >=', date('Y-m-d'));
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
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
	
	function update_book_exam($data, $id){		
		$this->db->where('be_id', $id);
		$this->db->update($this->book_examTbl, $data);
		return true;
	}

} ?>