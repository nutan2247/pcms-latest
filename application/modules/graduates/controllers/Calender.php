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
		$calender = $this->Calender->get_result_object('tbl_calender','status',1);

		echo json_encode($calender);	
	}

	public function add_event(){
		$app_id = (int)$this->input->post('application_id');
		$check = $this->Calender->get_row_object('tbl_calender','application_id',$app_id);
		// echo json_encode($this->db->last_query());
		if(!empty($check) && count($check) > 0){
			$result = '0';
		}
		if(empty($check)){	
			$post = $this->input->post();
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