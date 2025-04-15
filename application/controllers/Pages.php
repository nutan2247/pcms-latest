<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends MY_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('graduates/graduates_model');
		$this->load->model('professional/Profexam_model','profexam');	
		$this->load->model('cms_model');	
    }

	public function index(){
		echo 'blank';
	}

	public function graduate_exam_schedule(){
		$data = array();
		$data['page_title'] = 'Licensure Examination Schedule <br>(Local Graduates)';
		$data['schedule'] 	= $this->graduates_model->get_examination_schedule();
		$data['redirect'] = base_url('graduates');
		$this->load->view('include/header',$data);
		$this->load->view('pages/exam_schedule',$data);
		$this->load->view('include/footer');
	}

	public function professional_exam_schedule(){
		$data = array();
		$data['page_title'] = 'Licensure Examination Schedule <br>(Foreign Professional)';
		$data['schedule'] = $this->profexam->get_examination_schedule();
		$data['redirect'] = base_url('professional/profexam/registerexam');
		$this->load->view('include/header',$data);
		$this->load->view('pages/exam_schedule',$data);
		$this->load->view('include/footer');
	}

	public function contactus(){
		$data = array();
		$data['page_title'] = 'Contact Us';
		$data['countrylist'] = $this->common_model->countrylistarr();
		$data['contactusbody'] = $this->common_model->contactus_details();
		$this->load->view('include/header',$data);
		$this->load->view('pages/contactus',$data);
		$this->load->view('include/footer');
	}

	public function save_contact(){
		// print_r($this->input->post()); exit;
		$data['name']  				= $_POST['name'];
		$data['email']  			= $_POST['email'];
		$data['telnumber']  		= $_POST['telnumber'];
		$data['faxnumber']  		= $_POST['faxnumber'];
		$data['address']    		= $_POST['address'];
		$data['country']    		= $_POST['city'];
		$data['subject']    		= $_POST['subject'];
		$data['message']    		= $_POST['message'];
		$data['ipAddress']    		= $_SERVER['REMOTE_ADDR'];
		$data['query_at']    		= date('Y-m-d H:i:s');
		$inserted 					= $this->cms_model->insertcommonquery($data);

		if($inserted){
			$this->session->set_flashdata('response', '<div class="alert alert-success">Successfully Submited.</div>');	
		}else{
			$this->session->set_flashdata('response', '<div class="alert alert-danger">Not submited.</div>');
		}
		redirect(base_url('contactus'), 'refresh');
	}
}