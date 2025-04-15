<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examiner extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('examiner_model','examiner');	
		$this->load->library('upload');
		// if($this->session->userdata('login')['session']==true){
		// 	redirect(base_url('examiner/examiner'), 'refresh');
		// }
	}

	public function dashboard($id=false){
		if(!$this->session->userdata('login')['role']=='examiner'){
			redirect(base_url('login'), 'refresh');
		}

		$uid = $this->session->userdata('login')['user_ID'];
		$this->data = array('title'=> 'Dashboard','page_title' => 'Exam Question Listing');
		$this->data['details'] = $this->examiner->get_row_object('tbl_admin','user_ID',$uid);
		$this->data['exam_dates'] = $this->examiner->get_all_exam_dates(date('Y'));
		$this->data['question_listing'] = $this->examiner->get_all_questions($uid);
		//$this->data['uniqueset'] = $this->examiner->get_uniqueset($uid);
		$this->data['ques_category'] = $this->examiner->get_result_object('tbl_examination_categories');

		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar',$this->data);
		$this->load->view('dashboard',$this->data);
		$this->load->view('common/footer',$this->data);
	}


	//Add Exam Question, Edit Exam Question, List Exam Question, Delete Exam Question  

	public function exam_question_listing($id=false){
		$count = $this->examiner->count_rows('tbl_exam_question','','');
		$this->data = array(
				'title' => 'Govt : Exam Question Listing',
				'page_title' => 'Exam Question Listing ('.$count.')',
				'table_name' => 'Exam Question Listing'
			);
		$data['uniqueset'] = $this->examiner->get_uniqueset();
		$data['exam_dates'] = $this->examiner->get_all_exam_dates(date('Y'));
		
		if($id > 0){ $filter = $id;
		}else{ $filter = ''; }
		
		$this->db->order_by('set_no','asc');
		$data['question_listing'] = $this->examiner->get_all_questions($filter);
		$data['total_listing'] = $this->examiner->get_result_object('tbl_exam_question','','');
		$data['total'] = $count;
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('exam/listing',$data);
		$this->load->view('common/footer');	
	}


	public function add_question(){
		$this->data = array(
				'title' => 'Govt : Add Question',
				'page_title' => 'Add Question',
				'table_name' => 'Add Question'
			);

		if($this->input->post()){
			
			$count = count($this->input->post('question_title'));
			
			for($i=0;$i<$count;$i++){
			/*if($this->input->post('set_no') > 0){
				$set_no  			= $this->input->post('set_no');
			}else{
				$set_no  			= $this->input->post('new_set_no');
			}
			$insert['set_no']				= $set_no; */

			$insert['ques_cat_id']  		= $this->input->post('ques_cat_id');
			$insert['question_title']  		= $this->input->post('question_title')[$i];
			$insert['answere1']  			= $this->input->post('answere1')[$i];
			$insert['answere2']  			= $this->input->post('answere2')[$i];
			$insert['answere3']  			= $this->input->post('answere3')[$i];
			$insert['answere4']  			= $this->input->post('answere4')[$i];
			$insert['correct_answere']  	= $this->input->post('correct_answere')[$i];
			$insert['rationale']  			= $this->input->post('rationale')[$i];
			$insert['added_by']  			= $this->session->userdata('login')['user_ID'];
			$insert['added_on'] 			= date('Y-m-d H:i:s');
			$insert['status']  				= 1;
			
				$inserted	=	$this->examiner->save('tbl_exam_question',$insert);
			}
			
			if($inserted){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Exam Question added successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('examiner/dashboard', 'refresh');
		}
		$data['uniqueset'] = $this->examiner->get_uniqueset();
		//$data['exam_dates'] = $this->examiner->get_all_exam_dates(date('Y'));
		$data['ques_category'] = $this->examiner->get_result_object('tbl_examination_categories','status',1);
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('exam/add',$data);
		$this->load->view('common/footer');
	}


	public function question_view($id=false)
	{		
		$this->data = array(
			'title' => 'Govt : View Question',
			'page_title' => 'View Question',
			'table_name' => 'View Question'
		);

		$data['view'] = $this->examiner->get_question($id);
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('exam/view',$data);
		$this->load->view('common/footer');
	}

	public function question_delete($id=false){
		$result = $this->examiner->delete('tbl_exam_question','id',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('examiner/dashboard');
	}

	public function question_edit($id=false){

		if($this->input->post()){
			$insert['question_title']  			= $this->input->post('question_title');
			$insert['ques_cat_id']  			= $this->input->post('ques_cat_id');
			$insert['answere1']  			= $this->input->post('answere1');
			$insert['answere2']  			= $this->input->post('answere2');
			$insert['answere3']  			= $this->input->post('answere3');
			$insert['answere4']  			= $this->input->post('answere4');
			$insert['correct_answere']  	= $this->input->post('correct_answere');
			$insert['rationale']  			= $this->input->post('rationale');
			$insert['updated_at'] 			= date('Y-m-d'); 
			$insert['status']  				= $this->input->post('status');	
			
			$updated = $this->examiner->update('tbl_exam_question',$insert,'id',$this->input->post('question_id'));
			if($updated){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson updated successfully.</div>');
				redirect('examiner/dashboard/'.$id);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('examiner/dashboard/'.$id);
			}
		}else{
			$this->data = array(
				'title' => 'Govt : Edit Question',
				'page_title' => 'Edit Question',
				'table_name' => 'Edit Question'
			);
			
			$data['question'] =  $this->examiner->get_question($id);
			$data['exam_dates'] = $this->examiner->get_all_exam_dates(date('Y'));
			$data['uniqueset'] = $this->examiner->get_uniqueset();
			$data['ques_category'] = $this->examiner->get_result_object('tbl_examination_categories','status',1);
			$this->load->view('common/header',$this->data);
			$this->load->view('common/sidebar');
			$this->load->view('exam/edit',$data);
			$this->load->view('common/footer');
		}
	}


	public function foreign_examnees_listing()
	{	$this->db->where('u.exam_code !=','');	
		$count = $this->examiner->get_forigen_examiness_list(1);
		$this->data = array(
				'title' => 'Govt : Foreign Examinees & Exam Code Listing',
				'page_title' => 'Foreign Examinees & Exam Code Listing ('.count($count).')',
				'table_name' => 'Foreign Examinees & Exam Code Listing'
			);
		$this->db->where('u.exam_code !=','');
		$data['listing'] = $this->examiner->get_forigen_examiness_list();
		$this->load->view('common/header',$this->data);
		$this->load->view('common/sidebar');
		$this->load->view('examinees/foreign_examnees',$data);
		$this->load->view('common/footer');
	}


}?>
