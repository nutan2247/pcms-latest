<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** Reviewer Login controller **/

class Reviewerlogin extends MX_Controller {
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
		// $this->check_session();
	}

	public function index()
	{ 
		$validation = array(
			array('field' => 'username' ,'rules' => 'required' ),
			array('field' => 'password' ,'rules' => 'required' )
		);

		$this->form_validation->set_rules($validation);

		if($this->form_validation->run() == true){
			$user_post = $this->input->post('username');
			$pass_post = $this->input->post('password');

			if($this->_resolve_user_login($user_post,$pass_post)){
				$user_ID = $this->_get_user_ID_from_username($user_post);

				//print_r($user_ID); exit;

				$ip_address = $this->input->ip_address();

				$create_session = array(
					'user_ID' 		=> $user_ID['user_ID'],   
					'ip_address' 	=> $ip_address,
					'name' 			=> $user_ID['name'],
					'session'		=> true
				);
				//echo "<pre>"
				$this->session->set_userdata('log-in',$create_session);
				
				//echo "<pre>"; print_r($this->session->userdata('log-in')['user_ID']); exit;
				redirect('reviewer/dashboard');
			}else{
				$this->session->set_flashdata('response','<div class="form-label-group"> <p class="alert alert-danger text-danger">Invalid username or password, Please try again! </p></div>');
				redirect('reviewer/reviewerlogin/index');
			}

		}else{
			$this->data = array(
				'title' => 'Govt : Reviewer Login'
			);
			$this->load->view('reviewer_login',$this->data);
		}
	}


	private function _resolve_user_login($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
		$result = $this->db->get('tbl_users')->row();
		// echo $this->db->last_query();
		return $result; 
		// return $this->_verifiy_password_hash(md5($password), $hash);
		
	}



	private function _get_user_ID_from_username($username){
		$this->db->select('user_ID,name');
		$this->db->from('tbl_users');
		$this->db->where('username', $username);
		return $this->db->get()->row_array();
	}



	private function _verifiy_password_hash($password, $hash){
		
		if ($hash && isset($hash) && is_string($hash)) {
			return password_verify($password, $hash);
			}else{
				return false;
			}

	}



	public function check_session(){
		$user_ID = $this->session->userdata('user_ID');
		if($user_ID == ''){
			redirect('reviewer/reviewerlogin/index');
		}
	}

	public function logout(){
		$this->session->unset_userdata('user_ID');
		$this->session->unset_userdata('ip_address');
		$this->session->sess_destroy();
		redirect('reviewer/reviewerlogin/index');
	}

	// public function dashboard(){
	// 	$this->data = array(
	// 		'title' => 'Govt : Reviewer Dashboard'
	// 	);
	// 	$this->load->view('common/header',$this->data);
	// 	$this->load->view('common/sidebar',$this->data);
	// 	$this->load->view('dashboard',$this->data);
	// 	$this->load->view('common/footer',$this->data);
	// }
}



?>