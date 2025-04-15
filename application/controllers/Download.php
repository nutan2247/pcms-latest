<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Download extends MY_Controller 

{

	function __construct()

	 {

		parent:: __construct();

		$this->load->model('cms_model');
		$this->load->helper('download');
	 }

	 

	public function index(){

		$data 							= array();

		$data['downloadlisting'] 		= $this->cms_model->downloadlisting();

		$data['page_title'] 			= 'Download';

		$data['page_description'] 		= 'Download';

		$data['page_keywords'] 			= 'Download';

		//echo "<pre>"; print_r($data['coursedeatils']); exit;

		$this->load->view('include/header',$data);

		$this->load->view('download',$data);

		$this->load->view('include/footer');

	}

	public function files($filename){
		$file = ('./assets/images/download/'.$filename);
		force_download($file, NULL);
	}

}

?>