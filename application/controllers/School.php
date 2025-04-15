<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class School extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('school_model');
		$this->load->model('cms_model');
    }

	public function index(){
		$data = array();
		$data['schoollisting'] = $this->school_model->schoollisting();
		$data['countrylistarr'] = $this->common_model->countrylistarr();
		$data['professionarr'] = $this->common_model->professionarr();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		//echo '<pre>'; print_r($data['schoollisting']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('schools',$data);
		$this->load->view('include/footer');
	}
	public function deatils(){
		$newsurl = $this->uri->segment(2);
		$data = array();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$data['details'] = $this->school_model->deatils($newsurl);
		//print_r($data['details']); exit;
		$data['page_title'] 			= $data['details']['university_name'];
		$data['page_description'] 		= $data['details']['university_name'];
		$data['page_keywords'] 			= $data['details']['university_name'];
		$this->load->view('include/header',$data);
		$this->load->view('schooldetails',$data);
		$this->load->view('include/footer');
	}
}