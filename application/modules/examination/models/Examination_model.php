<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Examination_model extends CI_Model {

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
		$this->calenderTbl 		= 'tbl_calender';
		$this->examscheduleTbl 	= 'tbl_examination_schedule'; 
		$this->book_examTbl 	= 'tbl_book_exam'; 
		$this->examresultTbl 	= 'tbl_exam_result';
		$this->publishquestionset_Tbl = 'tbl_publish_question_set';
		$this->examinationcategoriesTbl = 'tbl_examination_categories';
	}

	function verify_professional($post){
		$this->db->select('u.*,be.examination_id,es.date exam_date,es.start_time,es.end_time');
		$this->db->from($this->userTbl.' u');
		$this->db->join($this->book_examTbl.' be','u.user_ID=be.user_id');
		$this->db->join($this->examscheduleTbl.' es','es.es_id=be.examination_id');
		// $this->db->join();
		$this->db->where('u.fname',$post['fname']);
		$this->db->where('u.lname',$post['lname']);
		$this->db->where('u.name',$post['name']);
		$this->db->where('u.email',$post['email']);
		$this->db->where('u.dob',$post['dob']);
		//$this->db->where('u.exam_code',$post['exam_code']);
		$this->db->where('u.role','P');
		$this->db->where('u.reviewer_status','1');
		$this->db->where('be.booking_for','pp');
		$sql = $this->db->get();
		$result = $sql->row();  
   		//echo $this->db->last_query();
		return $result;
	}
	
	function verify_graduate($post){
		$this->db->select('g.*,be.examination_id,g.student_name name,g.examcode exam_code,g.grad_id user_ID,be.examination_id,es.date exam_date,es.start_time,es.end_time');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->book_examTbl.' be','g.grad_id=be.user_id');
		$this->db->join($this->examscheduleTbl.' es','es.es_id=be.examination_id');
		$this->db->where('g.student_name',trim($post['fname']));
		$this->db->where('g.middle_name',trim($post['lname']));
		$this->db->where('g.surname',trim($post['name']));
		$this->db->where('g.email',trim($post['email']));
		$this->db->where('g.dob',trim($post['dob']));
		//$this->db->where('g.examcode',trim($post['exam_code']));
		$this->db->where('g.reviewer_status','1');
		$this->db->where('be.booking_for','p');
		$sql = $this->db->get();
		$result = $sql->row();  
   		//echo $this->db->last_query();
		return $result;
	}
	

	function get_question_paper($set_number){
		$this->db->where('set_no',$set_number);
		$this->db->where('status','2');
		//$this->db->order_by("id", "rand");
		//$this->db->order_by("rand()");
		// $this->db->group_by('set_no');
		$result = $this->db->get('tbl_exam_question')->result();
   		// echo $this->db->last_query();
		return $result;
	}
	function get_limited_random_question(){
		$this->db->select('*');
		$this->db->from('tbl_exam_question');
		$this->db->where('status','2');
		//$this->db->order_by("id", "rand");
		$this->db->order_by("id", "RANDOM");
		$this->db->limit(5);
		$result = $this->db->get()->result_array();
   		// echo $this->db->last_query();
		return $result;
	}
	
	public function check_exam_paper($post){
		$categories = $this->db->where('status', 1)->get('tbl_examination_categories')->result();
		foreach($post as $key => $value){
			if(strpos($key, 'ans-') !== false){
				$ques_no = explode('-',$key);
				$ques_details = $this->db->get_where('tbl_exam_question', array('id'=>$ques_no[1]))->row();
				if($value == $ques_details->correct_answere){
					$qdata[] = array(
						'qid' => $ques_no[1],
						'ques_cat_id' => $ques_details->ques_cat_id,
						'examinee_ans' => $value,
						'correct_answer' => $ques_details->correct_answere,
						'remark' => 'True',
					);
				}else{
					$qdata[] = array(
						'qid' => $ques_no[1],
						'ques_cat_id' => $ques_details->ques_cat_id,
						'examinee_ans' => $value,
						'correct_answer' => $ques_details->correct_answere,
						'remark' => 'False',
					);
				}
				
			}
		}
		//calculating each category true or false
		$totalpasspercent = 0; $catnum = 0;
		foreach($categories as $key => $list){
			$totalpasspercent = $totalpasspercent + $list->passing_score;
			$passingpercent = $totalpasspercent/ ++$catnum;
			$c = 0;
			$f = 0;
			$resultbycat[$key]['cat_id'] = $list->excat_id;
			$resultbycat[$key]['pass_percent'] = $list->passing_score;
			$resultbycat[$key]['true_count'] = 0;
			$resultbycat[$key]['false_count'] = 0;
			
			foreach($qdata as $value){
				if($list->excat_id == $value['ques_cat_id']){
					if($value['remark'] == 'True'){
						$resultbycat[$key]['true_count'] = ++$c;
					}else{
						$resultbycat[$key]['false_count'] = ++$f;
					}
				}
			}
		}
		//calculating total_marks, total_percentage_bycategory, and result
		$toalMarks = count($qdata)*1;
		$totaltrue = 0;
		foreach($resultbycat as $list){
			$totaltrue = $totaltrue+$list['true_count'];
		}
		$obtainpercent = (100 * $totaltrue) / $toalMarks;
		$obtainmarks = $totaltrue * 1;

		/*echo $toalMarks.$totalpasspercent.$passingpercent.$totaltrue.$obtainpercent.'<br>';
		echo '<pre>';print_r($resultbycat);
		
		echo '<br>';
		echo '<pre>';print_r($qdata);
		echo '<br>';
		print_r($_POST);
		exit;
		$this->db->where('set_no',$post['set_no']);
		$this->db->where('status','2');
		$all_question = $this->db->get('tbl_exam_question')->result();
		//$all_question = $this->get_result_object('tbl_exam_question','status','1');
		// echo $this->db->last_query();die;
		$passmarks  = 80;
		$correct 	= 0;
		$wrong   	= 0;
		$qdata		=array();
		// $data['all'] = $all_question; 
		// $data['exam'] = $post; 
		// echo'<pre>'; print_r($all_question);die;
		foreach ($all_question as $key => $value) {
			$qdata[$key]['qid']=$value->id;
			$qdata[$key]['ans']=$post['ans-'.$value->id];
			
			if($post['ans-'.$value->id]==$value->correct_answere)
			{
				$correct++;
			}else{
				$wrong++;
			}	
		}

		$toalMarks 		= count($all_question)*100;
		$totalCorrect 	= $correct*100;
		// $obtainedMarks 	= $totalCorrect * 100 / $toalMarks;
		$percentage 	= $totalCorrect * 100 / $toalMarks; */

		if($obtainpercent >= $passingpercent){
			$status = "Pass";
		}else{
			$status = "Fail";
		}

		$add = array(
			'user_id'		=>	$post['user_id'],
			'user_type'		=>	$post['user_type'],
			'user_name'		=>	$post['user_name'],
			'question_set'	=>	$post['set_no'],
			'answers'		=>	json_encode($qdata),
			'answer_cat_wise' => json_encode($resultbycat),
			'total_marks'	=>	$toalMarks,
			'obtained_marks'=>	$obtainmarks,
			'percentage'	=>	$obtainpercent,
			'status'		=>	$status,
			'added_on'		=>	date('Y-m-d H:i:s'),
		);
		// print_r($add);die;
  		$this->db->insert('tbl_exam_result',$add);
		$insert_id = $this->db->insert_id(); 
		$data = array(
			'id'		=> $insert_id,
			'user_id'	=> $post['user_id'],
			'user_type'	=> $post['user_type'],
			'status'	=> $status,
			'total'		=> $toalMarks,
			'obtained'	=> $obtainmarks,
			'passing'	=> $passingpercent,
			'percentage'=> $obtainpercent
		);
   		return $data;
	}

	function get_result_object($tbl_name,$db_field = false,$field = false){
			
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

	function get_current_exam_list(){
		$this->db->where('status','1');
		// $this->db->where('date',date('Y-m-d'));
		$query = $this->db->get($this->examscheduleTbl);
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}
	function get_current_exam($id){
		$this->db->where('es_id',$id);
		$this->db->where('status','1');
		// $this->db->where('date',date('Y-m-d'));
		$query = $this->db->get($this->examscheduleTbl);
		$result = $query->row();
		return $result;
	}
	function get_nearest_exam(){
		$this->db->where('status','1');
		$this->db->where('date > now()');
		$this->db->order_by('date','asc');
		$this->db->limit(1);
		$query = $this->db->get($this->examscheduleTbl);
		$result = $query->row();
		return $result;
	}

	function update_graduate_registration_no($post){
		$update['registration_no'] = $post['registration_no'];
		$this->db->where('grad_id', $post['user_id']);
		$result = $this->db->update($this->graduatesTbl, $update);
		return $result;
	}

	function update_prof_registration_no($post){
		$update['registration_no'] = $post['registration_no'];
		$this->db->where('user_ID', $post['user_id']);
		$result = $this->db->update($this->userTbl, $update);
		return $result;
	}

	function get_examinee_details($user_id,$user_type){

		if($user_type=='g'){
			$this->db->select('u.*,u.student_name name,u.email');
			$this->db->from($this->graduatesTbl.' u');
			$this->db->where('u.grad_id',$user_id);
			$result = $this->db->get()->row();
		}else{
			$this->db->select('u.*,u.name,u.email');
			$this->db->from($this->userTbl.' u');
			$this->db->where('u.user_ID',$user_id);
			$result = $this->db->get()->row();
		}
		return false;
	}

	function check_exam_attend($uid,$examniee_type){

		$this->db->from($this->examresultTbl);
		$this->db->where('user_id',$uid);
		$this->db->where('user_type',$examniee_type);
		$result = $this->db->get()->row();
		return $result;
	}
	function is_question_set($es_id){
		$this->db->from($this->publishquestionset_Tbl);
		$this->db->where('es_id',$es_id);
		$this->db->where('status','1');
		$result = $this->db->get()->row();
		return $result;
	}
	function get_one_question_by_id($id){
		$this->db->select('q.*, ec.category_name, ec.passing_score');
		$this->db->from($this->questionTbl.' q');
		$this->db->join($this->examinationcategoriesTbl.' ec','ec.excat_id = q.ques_cat_id','left');
		$this->db->where('q.id',$id);
		//$this->db->where('q.status','1');
		$result = $this->db->get()->row();
		return $result;
	}

} ?>