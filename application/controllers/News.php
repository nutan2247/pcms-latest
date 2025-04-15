<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class News extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('cms_model');
    }

	public function index(){
		$data = array();
		$data['newslisting'] = $this->cms_model->newslisting();
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside();
		$this->load->view('include/header',$data);
		$this->load->view('news',$data);
		$this->load->view('include/footer');
	}
	public function submitcomment(){
		//echo '<pre>'; print_r($_POST); exit;
		$insertdata = array();
		$insertdata['news_id'] 	= $this->input->post('news_id');
		$insertdata['name'] 	= $this->input->post('name');
		$insertdata['email'] 	= $this->input->post('email');
		$insertdata['message'] 	= $this->input->post('message');
		$insertdata['status'] 	= '1';
		$insertdata['added_at'] = date('Y-m-d H:i:s');
		$comment = $this->cms_model->insertcomment($insertdata);
		if($comment){
			$this->session->set_flashdata('item', array('message' => 'Your comment successfully submited.','class' => 'alert-success'));
		}else{
			$this->session->set_flashdata('item', array('message' => 'Your comment not submited.','class' => 'alert-danger'));
		}
		redirect(base_url('news/'.$this->input->post('return_url')), 'refresh');
	}
	
	public function newsdeatils(){
		$newsurl = $this->uri->segment(2);
		$data = array();
		$data['newsdetails'] = $this->cms_model->newsdeatils($newsurl);
		//echo $data['newsdetails']['news_id'];
		$data['title'] 					= $data['newsdetails']['news_meta_title'];
		$data['page_description'] 		= $data['newsdetails']['news_meta_description'];
		$data['page_keywords'] 			= $data['newsdetails']['news_meta_keyword'];
		$data['url'] 					= base_url('news/'.$data['newsdetails']['news_url']);
		$data['image'] 					= base_url('assets/images/newsmedia/'.$data['newsdetails']['banner']);
		$data['newslisting'] 			= $this->cms_model->newslisting(12,$data['newsdetails']['news_id']);
		$data['newslistingrightside'] = $this->cms_model->newslistingrightside('',$data['newsdetails']['news_id']);
		
		$data['newscommentslisting'] 	= $this->cms_model->newscommentslisting($data['newsdetails']['news_id']);
		
		$this->load->view('include/header',$data);
		$this->load->view('newsdetails',$data);
		$this->load->view('include/footer');
	}

}