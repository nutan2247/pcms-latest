<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Websiteinformation extends MX_Controller {



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



		parent:: __construct();

		//$this->check_session();

		$this->load->model('Admin_model','admin');

		

	}





	public function index(){	

		$this->data = array(
				'title' => 'Website information',
				'page_title' => 'Website information',
				'table_name' => 'Website information'
			);

		if($this->input->post('update')=="update")
		{
			//$this->form_validation->set_rules("amount","Amount","required");
			//$this->form_validation->set_rules('tax', 'Tax', 'required');
			//$this->form_validation->set_rules('countdown', 'Count Down', 'required');

			//if($this->form_validation->run() == True){
				//print_r($_FILES); exit;
				$logo = '';
				if(isset($_FILES["logo"]) && !empty($_FILES["logo"]['name'])){	
					$this->load->library('upload');
					$config['upload_path'] 		= './assets/images/';
					//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
					$config['allowed_types'] 	= '*';
					//$config['max_size'] 		= '200000';
					//$config['max_width']  	= '1500';
					//$config['max_height']  	= '800';        
					$ext 						= explode('.',$_FILES["logo"]["name"]);        
					$logo 						= 'logo_'.time().'.'.end($ext);
					$config['file_name'] 		= $logo;
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('logo'))
					{
					$error = array('error' => $this->upload->display_errors());                       
						//print_r($error); exit;
					}  
					$logo = $logo;
				}else{
					$logo = $this->input->post('old_logo');
				}
			
				$data = array(
				//'amount'=>$amount,
				'phone_number' => $this->input->post('phone_number'),
				'logo' => $logo,
				'address' => $this->input->post('address'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'linkedin' => $this->input->post('linkedin'),
				'instagram' => $this->input->post('instagram'),
				'youtube' => $this->input->post('youtube'),
				'skype' => $this->input->post('skype'),
				'whatsapp' => $this->input->post('whatsapp'), 
			//	'count_down' => $count_down
				);
				$result  = $this->admin->update('tbl_website_information',$data,'web_id',1);

				if($result)
				{
					$this->session->set_flashdata('update_success','Updated successfully');
					redirect(base_url('admin/websiteinformation'), 'refresh');
				}	
			//}
			}
		$this->data['setting_data'] =  $this->admin->get_result_array('tbl_website_information','web_id','1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/websiteinformation',$this->data);
		$this->load->view('admin/common/footer');			

	}


}



?>