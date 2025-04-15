<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('faq_model');
		$this->load->model('cms_model');
	}
 
	public function index(){
		$data 							= array();
		$data['faqlisting'] 			= $this->faq_model->faqlisting();
		$data['page_title'] 			= 'faq';
		$data['page_description'] 		= 'faq';
		$data['page_keywords'] 			= 'faq';
		//echo "<pre>"; print_r($data['coursedeatils']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('faq',$data);
		$this->load->view('include/footer');
	}
 
	public function licensure(){
		$data 							= array();
		$data['page_title'] 			= 'faq licensure';
		$data['page_description'] 		= 'faq licensure';
		$data['page_keywords'] 			= 'faq licensure';
		
		$data['faqlisting'] 			= $this->faq_model->faqlisting(1); // 1 for licensure
		$data['newslisting'] 			= $this->cms_model->newslisting('','',9);
		$data['newslistingrightside'] 	= $this->cms_model->newslistingrightside();
		//echo "<pre>"; print_r($data['coursedeatils']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('faq_licensure',$data);
		$this->load->view('include/footer');
	}
 
	public function examination(){
		$data 							= array();
		$data['page_title'] 			= 'faq examination';
		$data['page_description'] 		= 'faq examination';
		$data['page_keywords'] 			= 'faq examination';
		
		$data['faqlisting'] 			= $this->faq_model->faqlisting(2); // 2 for examination
		$data['newslisting'] 			= $this->cms_model->newslisting('','',8);
		$data['newslistingrightside'] 	= $this->cms_model->newslistingrightside();
		//echo "<pre>"; print_r($data['coursedeatils']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('faq_examination',$data);
		$this->load->view('include/footer');
	}
 
	public function education(){
		$data 							= array();
		$data['page_title'] 			= 'faq education';
		$data['page_description'] 		= 'faq education';
		$data['page_keywords'] 			= 'faq education';
		
		$data['faqlisting'] 			= $this->faq_model->faqlisting(3);//3 for conti. education
		$data['newslisting'] 			= $this->cms_model->newslisting('','',7);
		$data['newslistingrightside'] 	= $this->cms_model->newslistingrightside();
		//echo "<pre>"; print_r($data['coursedeatils']); exit;
		$this->load->view('include/header',$data);
		$this->load->view('faq_education',$data);
		$this->load->view('include/footer');
	}

	public function files(){
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$_REQUEST['f']);
		readfile('../some_folder/some_subfolder/'.$_REQUEST['f']); 
		exit;
	}

	public function laws_rules(){
		$data = array();
		$data['newslisting'] = $this->cms_model->newslisting('','',2);
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$this->load->view('include/header',$data);
		$this->load->view('laws_rules',$data);
		$this->load->view('include/footer');
	}
}
?>