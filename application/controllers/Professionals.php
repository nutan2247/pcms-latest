<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Professionals extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('professionals_model');
		$this->load->model('cms_model');
    }
	public function index(){
		$data = array();
		$data['listing'] = $this->professionals_model->listing();
		$data['countrylistarr'] = $this->common_model->countrylistarr();
		$data['professionarr'] = $this->common_model->professionarr();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		//echo '<pre>'; print_r($data['listing']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('professionalslisting',$data);
		$this->load->view('include/footer');
	}
	public function deatils(){
		$proid = $this->uri->segment(2);
		$data = array();
		$data['details'] 				= $this->professionals_model->deatils($proid);
		// echo '<pre>'; print_r($data);die;
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$data['page_title'] 			= $data['details']['name'];
		$data['page_description'] 		= $data['details']['name'];
		$data['page_keywords'] 			= $data['details']['name'];
		$this->load->view('include/header',$data);
		$this->load->view('professionaldetails',$data);
		$this->load->view('include/footer');
	}
}