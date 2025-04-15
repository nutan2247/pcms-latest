<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Cms extends MY_Controller {

	function __construct() {

        parent::__construct();

        $this->load->model('cms_model');

		

    }

	public function page()
	{
		//print_r($_POST); exit;
		$cmsurl = $this->uri->segment(1);	

		$data = array();

		if($this->input->post('cmd_id') == 2){
			
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
				$this->session->set_flashdata('response', '<div class="alert alert-success">Successfully submited.</div>');	
			}else{
				$this->session->set_flashdata('response', '<div class="alert alert-danger">Not submited.</div>');
			}
			redirect(base_url('contactus'), 'refresh');
		}

		$data['cmsdetails'] 			= $this->cms_model->cmsdeatils($cmsurl);

		// print_r($data['cmsdetails']); exit;

		$data['page_title'] 			= $data['cmsdetails']['cms_meta_title'];

		$data['page_description'] 		= $data['cmsdetails']['cms_meta_description'];

		$data['page_keywords'] 			= $data['cmsdetails']['cms_meta_keyword'];

		//$data['topmenucourse'] 		= $this->top_model->topcourses();

		//$data['topmenucat'] 			= $this->top_model->topcategories();

		$this->load->view('include/header',$data);

		$this->load->view('page',$data);

		$this->load->view('include/footer');

	}
	public function updatemail(){
		$email = $_REQUEST['email'];
		$updatemail = array();
		$updatemail['mail_read'] = '1';
		$this->cms_model->updaterequestquote($updatemail,$email);
	} 
	public function not_found() {
		$data = array();
		$this->load->view('includes/header',$data);
		$this->load->view('not_found');
		$this->load->view('includes/footer');
        
    }

	

}