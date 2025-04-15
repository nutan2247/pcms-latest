<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function __contruct(){
		parent::__contruct();
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
				$ip_address = $this->input->ip_address();

				$create_session = array(
					'user_ID' => $user_ID,
					'ip_address' => $ip_address
				);
				$this->session->set_userdata($create_session);
				
			}
		}else{
			$this->data = array(
				'title' => 'Govt : Login'
			);
			// $this->load->view('welcome_message');
			$this->load->view('login',$this->data);
		}
	}

	private function _resolve_user_login($username,$password){
		$this->db->where('username',$username);
		$hash = $this->db->get('tbl_users')->row('password');
		return $this->_verifiy_password_hash($password, $hash);
	}

	private function _get_user_ID_from_username($uername){
		$this->db->select('user_ID');
		$this->db->from('tbl_users');
		$this->db->where('username', $username);
		return $this->db->get()->row('user_ID');
	}

	private function _verifiy_password_hash($password, $hash){
		return password_verify($password, $hash);
	}
	public function paypal()
	{
		$this->load->view('paypal');
	}
	public function return_paypal()
	{
		if($_POST){

				echo "<pre>"; print_r($_POST);
		}else{
			echo "sss";
		}
	}

}

?>