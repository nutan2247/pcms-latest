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
		// $this->check_session();
	}

	public function index()
	{ 
		//echo '<pre>'; print_r($_POST); exit;
		$validation = array(
			array('field' => 'username' ,'rules' => 'trim|required' ),
			array('field' => 'password' ,'rules' => 'trim|required' )
		);

		$this->form_validation->set_rules($validation);

		if($this->form_validation->run() == true){
		// print_r($this->input->post());exit;
			$role = $this->input->post('role');
			$user_post = $this->input->post('username');
			$pass_post = $this->input->post('password');

			if($role=='admin'){
				$result = $this->admin_login($user_post,$pass_post);
				// print_r($result['success']);die;
				if($result['success'] == 1){
					redirect('admin/dashboard');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}elseif($role == 'reviewer' || $role == 'examiner' || $role == 'proctor'){
				$result = $this->reviewer_login($user_post,$pass_post,$role);
				// print_r($result['success']);die;
				if($result['success'] == 1){
					if($role == 'reviewer'){
						redirect('reviewer/reviewer/dashboard');
					}elseif($role == 'examiner'){
						redirect('examiner/dashboard');
					}else{//$role == 'proctor'
						redirect('proctor/dashboard');
					}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}elseif($role=='professioanl'){
				$result = $this->professional_login($user_post,$pass_post);
				// print_r($result['success']);die;
				if($result['success'] == 1){
					$this->db->where('username',$user_post);
					$info = $this->db->get('tbl_professional_license')->row();
					$create_session = array(
						'id' 			=> $info->pl_id,   
						'user_ID' 		=> $info->user_id,   
						'email' 		=> $info->username,
						'name' 			=> $info->name,
						'registration_no'=> $info->registration_no,
						'candidate_type' => $info->candidate_type,
						'professional_session'=> true,
						'role'			=> 'professioanl'
					);
					$this->session->set_userdata($create_session);
					// redirect('professional/applicant/dashboard','refresh');
					redirect('professional/applicant/certificate_listing','refresh');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}elseif($role=='ce-provider'){
				$result = $this->cep_login($user_post,$pass_post);
				// print_r($result['success']);die;
				if($result['success'] == 1){
					redirect('ce-provider/ce_provider/dashboard','refresh');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}elseif($role=='media'){
				$result = $this->media_login($user_post,$pass_post,'m');
				// print_r($result['success']);die;
				if($result['success'] == 1){
					redirect('media/dashboard','refresh');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}
			elseif($role=='finance'){
				$result = $this->finance_login($user_post,$pass_post,'c');
				// print_r($result['success']);die;
				if($result['success'] == 1){
					redirect('finance/dashboard','refresh');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}elseif($role=='university'){
				
				$result = $this->university_login($user_post,$pass_post);
				// print_r($result);die;
				if($result['success'] == 1){
					redirect(base_url('university/university/dashboard'), 'refresh');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">'.$result['msg'].'</div>');
					redirect('login/index','refresh');
				}	
			}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">Wrong username or password!</div>');
					redirect('login/index','refresh');
				}

		}else{
			$this->data = array(
				'title' => 'Login'
			);
			$this->load->view('include/header',$this->data);
			$this->load->view('login',$this->data);
			$this->load->view('include/footer',$this->data);
		}
	}


	private function _resolve_user_login($tblName,$where){
		$this->db->where($where);
		$hash = $this->db->get($tblName)->row();
		if($hash != ''){
			return true;
		}else{
			return false;
		}
	}

	private function _resolve_admin_login($username,$password){
		$this->db->where('username',$username);
		$hash = $this->db->get('tbl_admin')->row('password');
		if ($hash && isset($hash) && is_string($hash)) {
			return $this->_verifiy_password_hash($password, $hash);
		}else{
			return false;
		}

	}

	private function _verifiy_password_hash($password, $hash){
		if ($hash && isset($hash) && is_string($hash)) {
			return password_verify($password, $hash);
			}else{
				return false;
			}
	}

	// public function check_session(){
	// 	$user_ID = $this->session->userdata('user_ID');
	// 	if($user_ID){
	// 		redirect('admin/dashboard');
	// 	}
	// }



	private function _get_user_Info_from_username($tblName,$where){
		$this->db->where($where);
		$query = $this->db->get($tblName);
		//echo $this->db->last_query(); exit;
		$result = $query->row();
		return $result;
	}

	public function professional_login($username,$pass_post){
	$var = array('username'=>$username,'payment_status'=>'1');
	if($this->_resolve_user_login('tbl_professional_license',$var)){
		
		$this->db->where(array('username'=>$username,'payment_status'=>'1'));
		$hash = $this->db->get('tbl_professional_license')->row('password');
		
		if($hash != ''){
			if($this->_verifiy_password_hash($pass_post, $hash)){
				$data['success'] = 1;
				$data['msg']	 = 'You are sucessfully logged in.';
			
			}else{
				$data['success'] = 0;
				$data['msg']	 = 'Wrong username or password!';
			}
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
			
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}

	public function admin_login($username,$pass_post){
		if($this->_resolve_admin_login($username,$pass_post)){
			$where = array('username'=>$username);
			$info = $this->_get_user_Info_from_username('tbl_admin',$where);
			$ip_address = $this->input->ip_address();

			$create_session = array(
				'user_ID' 		=> $info->user_ID,   
				'ip_address' 	=> $ip_address,
				'username' 		=> $info->username,
				'name' 			=> $info->first_name,
				'session'		=> true,
				'role'			=> 'admin'
			);
			$this->session->set_userdata('login',$create_session);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}

	public function cep_login($username,$pass_post){
	$var = array('status'=>1,'email'=>$username,'password'=>$pass_post);
		if($this->_resolve_user_login('tbl_ce_provider',$var)){
			$where = array('email'=>$username);
			$info = $this->_get_user_Info_from_username('tbl_ce_provider',$where);
			$ip_address = $this->input->ip_address();

			$create_session = array(
				'user_ID' 		=> $info->provider_id,   
				'ip_address' 	=> $ip_address,
				'username' 		=> $info->email,
				'name' 			=> $info->business_name,
				'session'		=> true,
				'cep_logged_in' => true,
				'role'			=> 'cep'
			);
			$this->session->set_userdata('logincepacc',$create_session);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}


	public function reviewer_login($username,$pass_post,$role){
		if($this->_resolve_reviewer_login($username,$pass_post,$role)){
			$where = array('username'=>$username);
			$info = $this->_get_user_Info_from_username('tbl_admin',$where);
			$ip_address = $this->input->ip_address();

			$create_session = array(
				'user_ID' 		=> $info->user_ID,   
				'ip_address' 	=> $ip_address,
				'username' 		=> $info->username,
				'user_type' 	=> $info->user_type,
				'name' 			=> $info->first_name,
				'session'		=> true,
				'reviewer_logged_in' => true,
				'role'			=> $role
			);
			$this->session->set_userdata('login',$create_session);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}
	public function media_login($username,$pass_post,$role){
		if($this->section_login($username,$pass_post,$role)){
			$where = array('username'=>$username);
			$info = $this->_get_user_Info_from_username('tbl_admin',$where);
			$ip_address = $this->input->ip_address();

			$create_session = array(
				'user_ID' 		=> $info->user_ID,   
				'ip_address' 	=> $ip_address,
				'username' 		=> $info->username,
				'user_type' 	=> $info->user_type,
				'name' 			=> $info->first_name.' '.$info->last_name,
				'session'		=> true,
				'media_logged_in' => true,
				'role'			=> $role
			);
			$this->session->set_userdata('login',$create_session);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}
	public function finance_login($username,$pass_post,$role){
		if($this->section_login($username,$pass_post,$role)){
			$where = array('username'=>$username);
			$info = $this->_get_user_Info_from_username('tbl_admin',$where);
			$ip_address = $this->input->ip_address();

			$create_session = array(
				'user_ID' 		=> $info->user_ID,   
				'ip_address' 	=> $ip_address,
				'username' 		=> $info->username,
				'user_type' 	=> $info->user_type,
				'name' 			=> $info->first_name,
				'session'		=> true,
				'finance_logged_in' => true,
				'role'			=> $role
			);
			$this->session->set_userdata('login',$create_session);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}
	public function university_login($username,$pass_post){
		//if($this->_resolve_university_login($username,$pass_post)){
			$where = array('email'=>$username,'university_password'=>$pass_post);
			$info = $this->_get_user_Info_from_username('tbl_university',$where);
			//$data['infod'] = $info;
			// echo '<pre>'; print_r($info); exit;
			if($info){
			$ip_address = $this->input->ip_address();
			$universitydata = array(
					'uniid'  			=> $info->uniid,
					'university_name'  	=> $info->university_name,
					'college_of' 		=> $info->college_of,
					'email'				=> $info->email,
					'contact_no'		=> $info->contact_no,
					'university_logged_in' 	=> TRUE
			);
			//print_r($_SESSION); exit;
			//echo $loginuser->username;
			$this->session->set_userdata($universitydata);
			$data['success'] = 1;
			$data['msg']	 = 'you are successfully login.';
		}else{
			$data['success'] = 0;
			$data['msg']	 = 'Wrong username or password!';
		}
		return $data;
	}

	private function _resolve_reviewer_login($username,$password,$role){
		if($role=='reviewer'){
			$user_type = 'sub-admin';
		}elseif($role=='examiner'){
			$user_type = 'e';
		}else{ //proctor
			$user_type = 'p';
		}

		//$this->db->where(array('username'=>$username,'user_type'=>$user_type));
		$this->db->where(array('username'=>$username));
		$hash = $this->db->get('tbl_admin')->row('password');
		return $this->_verifiy_password_hash($password, $hash);
	}
	private function section_login($username,$password,$role){
		$this->db->where(array('username'=>$username,'user_type'=>$role));
		//$this->db->where(array('username'=>$username));
		$hash = $this->db->get('tbl_admin')->row('password');
		return $this->_verifiy_password_hash($password, $hash);
	}
	private function _resolve_university_login($username,$password){
		$this->db->where(array('email'=>$username,'university_password'=>$password));
		//$hash = $this->db->get('tbl_admin')->row('password');
		//return $this->_verifiy_password_hash($password, $hash);
	}

	public function logout(){
		$this->session->unset_userdata('login');
		redirect(base_url('login'), 'refresh');
	}
}



?>