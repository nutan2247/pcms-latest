<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ceprovider extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('ceprovider_model');
		$this->load->model('cms_model');
    }

	public function index(){
		$data = array();
		$data['ceplisting'] = $this->ceprovider_model->ceplisting();
		$data['countrylistarr'] = $this->common_model->countrylistarr();
		$data['professionarr'] = $this->common_model->professionarr();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		//echo '<pre>'; print_r($data['ceplisting']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('ceplisting',$data);
		$this->load->view('include/footer');
	}
	public function deatils(){
		$newsurl = $this->uri->segment(2);
		$data = array();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$data['details'] 				= $this->ceprovider_model->cepdeatils($newsurl);
		$data['page_title'] 			= $data['details']['business_name'];
		$data['page_description'] 		= $data['details']['business_name'];
		$data['page_keywords'] 			= $data['details']['business_name'];
		$this->load->view('include/header',$data);
		$this->load->view('cepdetails',$data);
		$this->load->view('include/footer');
	}
}