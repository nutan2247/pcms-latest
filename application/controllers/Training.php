<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('training_model');
		$this->load->model('cms_model');
    }

	public function index(){
		$data = array();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$data['traininglisting'] 	= $this->training_model->traininglisting();
		$data['profession'] 	= $this->common_model->professionarr();
		$this->load->view('include/header',$data);
		$this->load->view('training',$data);
		$this->load->view('include/footer');
	}
	public function deatils(){
		$newsurl = $this->uri->segment(2);
		$data = array();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$data['details'] = $this->training_model->deatils($newsurl);
		
		$data['provider'] = $this->common_model->cep_deatils($data['details']['provider_id']);
		$data['page_title'] 			= $data['details']['training_title'];
		$data['page_description'] 		= $data['details']['training_title'];
		$data['page_keywords'] 			= $data['details']['training_title'];
		$this->load->view('include/header',$data);
		$this->load->view('trainingdetails',$data);
		$this->load->view('include/footer');
	}
}