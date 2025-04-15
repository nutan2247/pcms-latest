<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Setting extends MX_Controller {



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





	public function index($id = false){	

		$this->data = array(
				'title' => 'Setting',
				'page_title' => 'Setting',
				'table_name' => 'Setting'
			);

		if($this->input->post('update')=="update")
		{
			$this->form_validation->set_rules("signature_name","Signature Name","required");
			// $this->form_validation->set_rules('tax', 'Tax', 'required');
			//$this->form_validation->set_rules('countdown', 'Count Down', 'required');

			if($this->form_validation->run() == True)
			{
				// $amount = $this->input->post('amount');
				// $tax = $this->input->post('tax');
				$setting_id = $this->input->post('setting_id');
				$position = $this->input->post('position');
				$rb_name = $this->input->post('rb_name');
				$signature_name = $this->input->post('signature_name');
				$count_down = $this->input->post('countdown');

				$data = array(
				//'amount'=>$amount,
				// 'tax' => $tax,
				'position' => $position,
				'rb_name' => $rb_name,
				'signature_name' => $signature_name,
			//	'count_down' => $count_down
				);
				$result  = $this->admin->update('tbl_setting',$data,'setting_id',$setting_id);
				if($result)
				{
					$this->session->set_flashdata('update_success','<div class="alert alert-success">Updated successfully</div>');
					redirect(base_url('admin/setting'), 'refresh');
				}	
			}
			} 
		$this->data['setting_data'] =  $this->admin->get_result_array('tbl_setting','type_id','1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/setting/add',$this->data);
		$this->load->view('admin/common/footer');			

	}

	public function tax($id = false){	

		$this->data = array(
				'title' => 'TAX',
				'page_title' => 'Tax',
				'table_name' => 'Tax'
			);

		if($this->input->post('update')=="update")
		{
			$this->form_validation->set_rules('tax', 'Tax', 'required');

			if($this->form_validation->run() == True)
			{
				
				$setting_id = $this->input->post('setting_id');
				$tax = $this->input->post('tax');
				$data = array(
					'tax' => $tax,
				);
				$result  = $this->admin->update('tbl_setting',$data,'setting_id',$setting_id);

				if($result)
				{
					$this->session->set_flashdata('update_success','<div class="alert alert-success">Updated successfully</div>');
					redirect(base_url('admin/setting/tax'), 'refresh');
				}	
			}
			} 
		$this->data['setting_data'] =  $this->admin->get_result_array('tbl_setting','type_id','1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/setting/tax',$this->data);
		$this->load->view('admin/common/footer');			

	}


}



?>