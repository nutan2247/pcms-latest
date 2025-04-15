<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Courses extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('courses_model');
		$this->load->model('cms_model');
    }

	public function index(){
		$data = array();
		$data['courselisting'] 	= $this->courses_model->courselisting();
		$data['profession'] 	= $this->common_model->professionarr();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		//echo '<pre>'; print_r($data['courselisting']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('courses',$data);
		$this->load->view('include/footer');
	}
	public function deatils(){
		$newsurl = $this->uri->segment(2);
		$data = array();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$data['details'] = $this->courses_model->deatils($newsurl);
		//echo '<pre>'; print_r($data['details']); exit;
		$data['provider'] = $this->common_model->cep_deatils($data['details']['provider_id']);
		$data['page_title'] 			= $data['details']['course_title'];
		$data['page_description'] 		= $data['details']['course_title'];
		$data['page_keywords'] 			= $data['details']['course_title'];
		$this->load->view('include/header',$data);
		$this->load->view('coursedetails',$data);
		$this->load->view('include/footer');
	}
}