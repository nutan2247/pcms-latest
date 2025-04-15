<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends MX_Controller {
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
		$this->check_session();
	}

	public function index()
	{ 
		$validation = array(
			array('field' => 'username' ,'rules' => 'required' ),
			array('field' => 'password' ,'rules' => 'required' )
		);

		$this->form_validation->set_rules($validation);

		if($this->form_validation->run() == true){
		// print_r($this->input->post());exit;
			$user_post = $this->input->post('username');
			$pass_post = $this->input->post('password');

			if($this->_resolve_user_login($user_post,$pass_post)){
				$user_ID = $this->_get_user_ID_from_username($user_post);
				$ip_address = $this->input->ip_address();

				$create_session = array(
					'user_ID' 		=> $user_ID['user_ID'],   
					'ip_address' 	=> $ip_address,
					'name' 			=> $user_ID['first_name'],
					'session'		=> true
				);

				$this->session->set_userdata($create_session);
				redirect('admin/dashboard');
			}else{
				$this->session->set_flashdata('response','<div class="form-label-group"> <p class="alert alert-danger text-danger">Invalid username or password, Please try again! </p></div>');
				redirect('login/index');
			}

		}else{
			$this->data = array(
				'title' => 'Govt : Admin Login'
			);
			// $this->load->view('welcome_message');
			$this->load->view('admin/login',$this->data);
		}
	}


	private function _resolve_user_login($username,$password){

		$this->db->where('username',$username);

		$hash = $this->db->get('tbl_admin')->row('password');

		return $this->_verifiy_password_hash($password, $hash);

	}



	private function _get_user_ID_from_username($username){

		$this->db->select('user_ID,first_name');

		$this->db->from('tbl_admin');

		$this->db->where('username', $username);

		return $this->db->get()->row_array();

	}



	private function _verifiy_password_hash($password, $hash){

		return password_verify($password, $hash);

	}



	public function check_session(){

		$user_ID = $this->session->userdata('user_ID');

		

		if($user_ID){

			redirect('admin/dashboard');

		}

	}





}



?>