<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	var $data = array();

	public function __construct(){
		parent::__construct();
		$this->load->model('Landing_model','landing');
		$this->load->library('upload');
		
	}


	public function index(){
			$return = '';
		
		if($this->input->post('submit')=='submit'){
			// print_r($_FILES["document"]['name']);die;
			$this->form_validation->set_rules('reg_board', 'Reg board', 'required');
			$this->form_validation->set_rules('user_name', 'Username', 'required');
			$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');




			if($this->form_validation->run() == TRUE && !empty($_FILES["document"]['name']))
			{
				


			

			$config['upload_path']="./assets/images/document/";
			$config['allowed_types']='gif|jpg|png';
			$this->upload->initialize($config);

			if($this->upload->do_upload("document")){
				$filedata = array('upload_data' => $this->upload->data());
				$document = $filedata['upload_data']['file_name'];
				$ext = explode('.',$document);
				$docimage = time().'.'.end($ext);
				
				$tConfig['image_library'] 	= 'gd2';
				$tConfig['source_image'] 	= './assets/images/document/'.$document;
				$tConfig['new_image'] 		= './assets/images/document/'.$docimage;
				// $tConfig['create_thumb'] 	= TRUE; //these feature will help to reduse the size of image
				// $tConfig['maintain_ratio'] 	= TRUE;
				// $tConfig['width']         	= 300;
				// $tConfig['height']       	= 300;
				$this->load->library('image_lib', $tConfig);
				$this->image_lib->resize();
				$file_info = pathinfo($tConfig['new_image']);
				// print_r($file_info);
				if($file_info['basename'] != ''){
					unlink('assets/images/document/'.$document);
				}
				$thumbimg = $file_info['basename'];
				$ext = explode('.',$file_info['basename']);
				// print_r($ext);
				$docimage = $ext[0].'_dcthumb.'.end($ext);
				$document = $docimage;
			}


				if($this->input->post()){
				$insertContact = array(
					'reg_board'	=>	$this->input->post('reg_board'),
					'user_name'	=>	$this->input->post('user_name'),
					'user_email'=>	$this->input->post('user_email'),
					'subject'	=>	$this->input->post('subject'),
					'phone'		=>	$this->input->post('phone'),
					'document'	=>	$document,//here upload document will go.
					'status'	=>	'1',
					'added_on'	=>	date('Y-m-d H:i:s'),
				);
				$return = $this->landing->insert('tbl_contact_us',$insertContact);
			}
			if($return){
				$this->session->set_flashdata('error','<div class="alert alert-success" role="alert">Details sent!</div>');
				//redirect('landing/professional_license');
			}
		
		}else{
			$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
			validation_errors();
		}

		}
				
		/*else{
			$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
			redirect('landing/professional_license');
		}*/


		$this->data = array('title'=> 'Welcome in Regulatry Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('contact/contact_us',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}

	

}

?>