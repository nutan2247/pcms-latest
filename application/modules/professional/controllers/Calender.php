<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Calender_model','Calender');
	}

	// public function index(){
	// }

	public function fetch_event(){
		$this->db->where('booking_for','p');
		$calender = $this->Calender->get_result_object('tbl_calender','status',1);
		echo json_encode($calender);	
	}

	public function add_event(){
		$check = $this->Calender->get_row_object('tbl_calender','application_id',$this->session->userdata('profexam_id'));
		if(count($check) > 0){
			$result = 0;
		}else{	
			$session['application_id'] = $this->session->userdata('profexam_id');
			$p = $this->input->post();
			$post = array_merge($p,$session);
			$result = $this->Calender->add_date($post);
		}
		echo json_encode($result);	
	}

	public function edit_event(){
		$post = $this->input->post();
		$result = $this->Calender->edit_date($post);
		echo json_encode($result);	
	}

	public function delete_event(){
		$id = $this->input->post('id');
		$result = $this->Calender->delete_date($id);
		echo json_encode($result);	
	}

}
?>