<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ce_provider extends MX_Controller {
	protected $subs_status;
	protected $data;
	public function __construct(){
		parent::__construct();
		$this->load->model('Provider_model','provider');
		$this->load->library('upload');
		$this->load->library('paypal_lib');
		
		//rboard check 
		$subscription = $this->common_model->get_admin_subscription_details();
		// if($subscription->rb_sub_key == ""){
		// 	//go to contcat for admin with form details
		// 	$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
		// 	redirect(base_url('contactus'), 'refresh');		
		// }

		// if($subscription->no_of_application == 0 && $subscription->subscription_id == 6){
			$this->subs_status = 'y';
		// }else{
		// 	if($subscription->total_application <= $this->common_model->get_online_application_count()){	
		// 		$this->subs_status = 'n';
		// 	}else{
		// 		$this->subs_status = 'y';
		// 	}
		// }
		//end rboard check 
	}

	public function dashboard(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		redirect(base_url('ce-provider/ce_provider/onlinecourse'), 'refresh');
		
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$uemail = $this->session->userdata('logincepacc')['username'];
		$this->data = array('title'=> 'Dashboard');
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['countdown'] 	= $this->provider->cep_doc_details($uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->load->view('include/header',$this->data);
		$this->load->view('dashboard',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	
	public function accreditedoc(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Course Application');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);

		$this->data['countdown'] 		= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['approvedcourses'] 	= $this->provider->getcourselisting($uid,1,'y');
		$this->db->where('co.expiry_at <',date('Y-m-d'));
		$this->data['expairedcourses'] 	= $this->provider->getcourselisting($uid,1,'y');
		$this->data['user_details'] 	= $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/accreditedoc_listing',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function accreditedtc(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Course Application');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);

		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['approvedcourses'] 	= $this->provider->gettraininglisting($uid,1,'y');
		$this->db->where('t.expiry_at <',date('Y-m-d'));
		$this->data['expairedcourses'] 	= $this->provider->gettraininglisting($uid,1,'y');
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('accreditedtc_listing',$this->data);
		$this->load->view('include/footer',$this->data);
	}


	public function trainingcourse(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Course Application');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);

		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['pendingtraining'] 	= $this->provider->gettraininglisting($uid,'','n');
		$this->data['submittedtraining'] 	= $this->provider->gettraininglisting($uid,'','y');
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['profession_list'] = $this->provider->get_profession_list();
		$this->data['id'] = $uid;
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('trainingcourse_listing',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function onlinecourse(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Course Application');
		$this->data['countries'] = $this->Master_m->get_countries(); 
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);

		$this->data['countdown'] 		= $this->provider->cep_doc_details_for_dashboard($uid);
		
		$this->data['pendingcourses'] 	= $this->provider->getcourselisting($uid,'','n');
		$this->data['submittedcourses'] = $this->provider->getcourselisting($uid,'','y');
		$this->data['user_details'] 	= $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] 	= $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] 	= $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['profession_list'] 	= $this->provider->get_profession_list();
		// $this->data['course_logs'] 		= $this->provider->get_course_log($uid);
		$this->data['id'] = $uid;
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/olinecourse_listing',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function delete_course($id){
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$result = $this->provider->deleteCourse($id,$uid);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert-success">Course Deleted successfully. </div>');
		}else{
			$this->session->set_flashdata('item','<div class="alert-danger">Something went wrong !</div>');
		}
		redirect(base_url('ce-provider/ce_provider/onlinecourse'), 'refresh');

	}

	public function delete_training($id){
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$result = $this->provider->deletetraining($id,$uid);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert-success">Training Deleted successfully. </div>');
		}else{
			$this->session->set_flashdata('item','<div class="alert-danger">Something went wrong !</div>');
		}
		redirect(base_url('ce-provider/ce_provider/trainingcourse'), 'refresh');

	}

	public function renewalhistory(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Renewal History');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['paymentarr'] = $this->provider->get_renewalhistory($uid);
		// echo $this->db->last_query();die;
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/renewalhistory_listing',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function purchaselist(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Purchase List');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['paymentarr'] = $this->provider->get_paymenthistory($uid);
		//echo '<pre>';print_r($this->data['paymentarr']);exit;
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/purchaselist',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function editprofile(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Purchase List');
		
		if($this->input->post('submit')=='submit'){
			//echo $this->input->post('submit');
			//print_r($_POST); exit;
			// $this->form_validation->set_rules('business_name', 'business name', 'trim|required');
			$this->form_validation->set_rules('business_no', 'business no.', 'trim|required');
			$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');
			$this->form_validation->set_rules('designation', 'designation', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');
			
			//$this->form_validation->set_rules('photo', 'photo', 'trim|required');
			if($this->form_validation->run() == TRUE){
			
			$photo = "";
			if(!empty($_FILES["company_logo"]['name'])){
				$config['upload_path']="./assets/images/ce_provider/";
				$config['allowed_types']='gif|jpg|png';
				$this->upload->initialize($config);

				if($this->upload->do_upload("company_logo")){
					$filedata = array('upload_data' => $this->upload->data());
					$photo = $filedata['upload_data']['file_name'];
					$ext = explode('.',$photo);
					$profileimage = time().'.'.end($ext);

					$tConfig['image_library'] 	= 'gd2';
					$tConfig['source_image'] 	= './assets/images/ce_provider/'.$photo;
					$tConfig['new_image'] 		= './assets/images/ce_provider/'.$profileimage;
					$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
					$tConfig['maintain_ratio'] 	= TRUE;
					$tConfig['width']         	= 300;
					$tConfig['height']       	= 300;
					$this->load->library('image_lib', $tConfig);
					$this->image_lib->resize();
					$file_info = pathinfo($tConfig['new_image']);
					// print_r($photo); exit;
					if($file_info['basename'] != ''){
					//unlink('assets/images/ce_provider/'.$photo);
					}
					$thumbimg = $file_info['basename'];
					$ext = explode('.',$file_info['basename']);
					// print_r($ext);
					$profileimage = $ext[0].'_thumb.'.end($ext);
					$photo = $profileimage;
				}
			}else{
					$photo = $this->input->post('old_company_logo');
				}
					

			$univerdata 					= array();
			// $univerdata['business_name']  	= $this->input->post('business_name');
			$univerdata['business_no'] 		= $this->input->post('business_no');
			$univerdata['contact_person']	= $this->input->post('contact_person');
			$univerdata['designation'] 		= $this->input->post('designation');
			$univerdata['address']  		= $this->input->post('address');
			$univerdata['company_logo']  	= $photo;
			$univerdata['updated_at']  		= date('Y-m-d H:i:s');
			
			$grduactid = $this->provider->providerupdate($univerdata,$this->session->userdata('logincepacc')['user_ID']);
				if($grduactid){
					$this->session->set_flashdata('item', array('message' => 'Updated successfully','class' => 'alert-success'));
					redirect(base_url('ce-provider/ce_provider/editprofile'), 'refresh');
				}
			}else{
				validation_errors();
			}
		}
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['paymentarr'] = $this->provider->get_paymenthistory($this->session->userdata('logincepacc')['user_ID']);
		$this->load->view('include/header',$this->data);
		$this->load->view('editprofile',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function notification(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Purchase List');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['get_notifications'] = $this->provider->get_notifications($uid); 
		$this->load->view('include/header',$this->data);
		$this->load->view('notification',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function terms(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Purchase List');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['get_terms'] = $this->provider->get_terms(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('terms',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function tutorial(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Purchase List');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['get_tutorial'] = $this->provider->get_tutorial(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('tutorial',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function changepassword(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('old_password', 'Current Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required');
			if ($this->form_validation->run() == TRUE) {
				$fetchPassword = $this->provider->fetchPassword($this->session->userdata('logincepacc')['user_ID']); 
				//$fetchPassword->university_password;
				//print_r($fetchPassword); exit;
				if($fetchPassword->password != $this->input->post('old_password')){
					$this->session->set_flashdata('item', array('message' => 'Old password not matched.','class' => 'alert-danger'));
				}
				elseif($this->input->post('new_pass') != $this->input->post('conf_pass')){
					$this->session->set_flashdata('item', array('message' => 'Confirm password not matched.','class' => 'alert-danger'));
				}else{
					$updatepass = array();
					$updatepass['password'] = $this->input->post('conf_pass');
					$this->provider->updatePassword($updatepass,$this->session->userdata('logincepacc')['user_ID']);
					$this->session->set_flashdata('item', array('message' => 'New password successfully updated.','class' => 'alert-success'));
				}
				redirect(base_url('ce-provider/ce_provider/changepassword'), 'refresh');
			}else{
				validation_errors();
			}
		}
		
		$this->data = array('title'=> 'Change Password');
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		
		$this->data['countdown'] 	= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] = $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] = $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['id'] = $uid;
		$this->data['get_notifications'] = $this->provider->get_notifications($this->session->userdata('logincepacc')['user_ID']); 
		$this->load->view('include/header',$this->data);
		$this->load->view('changepassword',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	/* CONTINUING EDUCATION PROVIDER (CEP) ACCREDITATION  */
	public function index(){
		$user_id = $this->input->get('user_view');
		$view 	 = $this->input->get('view');
		$popup 	 = $this->input->get('popup');

		$this->data = array('title'=> 'CEP ACCREDITATION');
		$this->data['popup'] =  $popup;
		$this->data['countries'] = $this->Master_m->get_countries();
		$this->data['business_stepProcess'] = 'stepProcess';

		if(isset($user_id))
		{
			$this->session->unset_userdata('logincepacc');
			$user_ids =  base64_decode($user_id);
			$this->data['user_id'] 	= $user_ids;
			$this->data['view'] 	= $view;
			$this->data['user_details'] = $this->Master_m->get_user_details($user_ids);
			$cep_details = $this->Master_m->get_user_details($user_ids);

			$cep_session_arr 	= array(
				'provider_id'  	=> $cep_details->provider_id,
				'business_name' => $cep_details->business_name,
				'cep_email'  	=> $cep_details->email,
				'cep_logged_in' => true,
				);
			$this->session->set_userdata('logincepacc',$cep_session_arr);

		}

		$this->load->view('include/header',$this->data);
		$this->load->view('steps',$this->data);
		$this->load->view('business_accreditation',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function accre_document()
	{
		if(empty($this->session->userdata('logincepacc'))){
			redirect(base_url('ce-provider/ce_provider/index','refresh'));
		}
		$uid =  $this->session->userdata('logincepacc')['provider_id'];

   		/********* License Image Upload *********/
		if($this->input->post('upload')=='Upload'){
			if(!empty($_FILES["license_image"]['name'])){
				$config['upload_path']	 =	"./assets/images/ce_provider/";
				$config['allowed_types'] =	'gif|jpg|png|pdf|csv';
				$this->upload->initialize($config);

				if($this->upload->do_upload("license_image")){
					$filedata = array('upload_data' => $this->upload->data());
					$photo = $filedata['upload_data']['file_name'];
					$ext = explode('.',$photo);
					$profileimage = time().'.'.end($ext);

					$tConfig['image_library'] 	= 'gd2';
					$tConfig['source_image'] 	= './assets/images/ce_provider/'.$photo;
					$tConfig['new_image'] 		= './assets/images/ce_provider/'.$profileimage;
					$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
					$tConfig['maintain_ratio'] 	= TRUE;
					$tConfig['width']         	= 300;
					$tConfig['height']       	= 300;
					$this->load->library('image_lib', $tConfig);
					$this->image_lib->resize();
					$file_info = pathinfo($tConfig['new_image']);
					if($file_info['basename'] != ''){
						//unlink('assets/images/ce_provider/'.$photo);
					}
					$thumbimg = $file_info['basename'];
					$ext = explode('.',$file_info['basename']);
					$license_image = $photo;
				}

				}else{
					$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
					redirect(base_url('ce-provider/ce_provider/accre_document'));exit;
				}
		
			/******* Accreditation Image Upload ************/
	
			if(!empty($_FILES["accreditation_image"]['name'])){
				$config['upload_path']="./assets/images/ce_provider/";
				$config['allowed_types']='gif|jpg|png|pdf|csv';
				$this->upload->initialize($config);

				if($this->upload->do_upload("accreditation_image")){
					$filedata = array('upload_data' => $this->upload->data());
					$photo = $filedata['upload_data']['file_name'];
					$ext = explode('.',$photo);
					$profileimage = time().'.'.end($ext);

					$tConfig['image_library'] 	= 'gd2';
					$tConfig['source_image'] 	= './assets/images/ce_provider/'.$photo;
					$tConfig['new_image'] 		= './assets/images/ce_provider/'.$profileimage;
					$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
					$tConfig['maintain_ratio'] 	= TRUE;
					$tConfig['width']         	= 300;
					$tConfig['height']       	= 300;
					$this->load->library('image_lib', $tConfig);
					$this->image_lib->resize();
					$file_info = pathinfo($tConfig['new_image']);
					if($file_info['basename'] != ''){
						//unlink('assets/images/ce_provider/'.$photo);
					}
					$thumbimg = $file_info['basename'];
					$ext = explode('.',$file_info['basename']);
					$profileimage =  $photo;//$ext[0].'_thumb.'.end($ext);
					$photo = $profileimage;
				}

				}else{
					$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
					redirect(base_url('ce-provider/ce_provider/accre_document'));exit;
				}

				$uphoto = array(
						'provider_id' =>$uid,
						'license_image'=>$license_image,
						'accreditation_image'=>$photo,
						'document_for' => 'n',
					);
				$update = $this->provider->insert('tbl_cep_documents',$uphoto);

				if($update){
					$ceprenewdoc = array('updatecepdoc'=> $update);
					$this->session->set_userdata($ceprenewdoc);
					$this->session->set_flashdata('error','<div class="alert alert-success" role="alert">Documents uploaded successfully.</div>');
				}else{
					$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
				}
				redirect(base_url('ce-provider/ce_provider/payment'),'refresh');
		}
		$this->data = array('title'=> 'CEP ACCREDITATION');
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_stepProcess'] 		= 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('steps',$this->data);
		$this->load->view('accre_document',$this->data);
		$this->load->view('include/footer',$this->data);

	}

	public function payment(){
		
		if(empty($this->session->userdata('logincepacc'))){
			redirect(base_url('ce-provider/ce_provider/index','refresh'));
		}

		if(isset($_POST['submit']) && $_POST['submit']== "paynow") {
			$this->form_validation->set_rules('duration', 'purchase for', 'trim|required');
			//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$certdeta = $this->common_model->get_certificatechargedetails($_POST['duration']);

				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' year'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				$this->provider->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updatecepdoc'));
				
				$userID = $this->session->userdata('logincepacc')['provider_id']; 
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $userID;
				$paymentdata['doc_refrence_id'] = $this->session->userdata('updatecepdoc');
				$paymentdata['payment_amout'] 	= $_POST['amount'];
				$paymentdata['payment_tax'] 	= $_POST['taxamt'];
				$paymentdata['payment_gross'] 	= $_POST['total'];	
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'CEP';
				$paymentdata['payment_type'] 	= 'N';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);

				unset($_SESSION['updatecepdoc']);

				echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';
				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalformN"> 
					
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="item_name_1" value="CEP Accreditation Payment">
				<input type="hidden" name="item_number_1" value="'.$lastpaymentid.'">
				<input type="hidden" name="amount_1" id="amount_1"  value="'.$_POST['total'].'">
				<input type="hidden" name="quantity_1" value="1"> 
				<input type="hidden" name="custom" value="'.$userID.'">
				<!--<input type="hidden" name="notify_url" value="https://www.yoursite.com/my_ipn.php">-->
				<input type="hidden" name="return" value="'.base_url('ce-provider/ce_provider/paymentsucess').'">
				<input type="hidden" name="cbt" value="Return to The Store">
				<input type="hidden" name="cancel_return" value="'.base_url('ce-provider/ce_provider/paymentcancel').'">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" value="2" name="rm"> 	
				<input type="hidden" name="currency_code" value="USD">
				<!--<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">-->
				
				'.form_close();	
				echo '<script> document.getElementById("paypalformN").submit(); </script>';
				exit;
			}else{
				validation_errors();
			}
		}
		$this->data = array('title'=> 'CEP ACCREDITATION');
		$this->data['chargesarr'] = $this->common_model->certificatechargesarr('cep_accreditation');

		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_stepProcess'] 		= 'stepActive';
		$this->data['payment_stepProcess'] 		= 'stepProcess';

		$this->load->view('include/header',$this->data);
		$this->load->view('steps',$this->data);
		$this->load->view('payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}


	public function paymentsucess(){

		if(isset($_POST['txn_id']) && $_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
			$this->session->unset_userdata('login');
			$data['txn_id'] 		= $_POST["txn_id"];
			$data['currency_code'] 	= $_POST["mc_currency"];
			$data['payer_email'] 	= $_POST["payer_email"];
			$data['payment_status'] = $_POST["payment_status"];
			$item_number = isset($_POST['item_number1'])?$_POST['item_number1']:$_POST['item_number'];		
			$update = $this->common_model->update_payment($data,$item_number);
			$payment_details = $this->db->get_where('tbl_payment_transaction',array('payment_id'=>$item_number))->row_object();
			$doc_id = $payment_details->doc_refrence_id;
			$unvdetls = $this->provider->get_providerdetails($_POST['custom']);
			
			$getuserid = $this->common_model->getuserids($item_number);	
			if($update){
				//fetch data for receipt email
				$data['details']=$this->provider->get_one_receipt_details();
				$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);
				//
				$bytes 		= random_bytes(3); 
				$refcode 	= bin2hex($bytes);
				$reference_no = 'CEP-'.$unvdetls->provider_id.$refcode.'-'.date('Y');
				$arr_provider = array(
					'reference_no' => $reference_no,
					'updated_at' => date('Y-m-d H:i:s')
			);
			$settingarr = $this->common_model->get_setting('1');
			$this->provider->update('tbl_ce_provider',$arr_provider,'provider_id',$unvdetls->provider_id);
			$this->provider->update('tbl_cep_documents',$arr_provider,'provider_id',$unvdetls->provider_id);
			
			// update application count
			$logs = array(
				'application_id'	=>	$getuserid->doc_refrence_id,
				'res_id'			=>	'9',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);

				$unvdetls = $this->provider->cep_doc_details_for_payment($doc_id);
				//print_r($unvdetls);exit;
				$universitydata = array(						
					'provider_id'  		=> $unvdetls->provider_id,
					'business_name'  	=> $unvdetls->business_name,
					'cep_email'  		=> $unvdetls->email,
					'cep_logged_in'  		=> true,
					);

					$this->session->set_userdata('logincepacc',$universitydata);

				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for CEP Accreditation was successfully submitted.<br><br>Provide us some time to review your documents. You can check status by '.$serachlink.' with this <br>Refrence Code : <strong>'.$unvdetls->reference_no.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';

						$config = Array(
							'protocol' => 'smtp',
							'smtp_host' => SMTP_HOSTNAME,
							'smtp_port' => SMTP_PORT,
							'smtp_user' => SENT_EMAIL_FROM,
							'smtp_pass' => SENT_EMAIL_PASSWORD,
							'mailtype'  => 'html', 
							'newline'   => "\r\n",
							'AuthType'   => "XOAUTH2",
							'charset'   => 'iso-8859-1',
						);  
							
						$this->load->library('email');
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($unvdetls->email);
						$this->email->subject('Application Submitted Successfully');
						$emailbody 					= array();
						$emailbody['name'] 			= $unvdetls->business_name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();

						//2nd email for receipt;
					
						$config = Array(
							'protocol' => 'smtp',
							'smtp_host' => SMTP_HOSTNAME,
							'smtp_port' => SMTP_PORT,
							'smtp_user' => SENT_EMAIL_FROM,
							'smtp_pass' => SENT_EMAIL_PASSWORD,
							'mailtype'  => 'html', 
							'newline'   => "\r\n",
							'AuthType'   => "XOAUTH2",
							'charset'   => 'iso-8859-1',
						);  
							
						$this->load->library('email');
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($unvdetls->email);
						$this->email->subject('Payment Receipt');
						$emailbody 					= array();
						$emailbody['name'] 			= $unvdetls->business_name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCodeemail;
						$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
						$updatenotification 				= array();
						$updatenotification['uniid'] 		= $unvdetls->provider_id;
						$updatenotification['subject'] 		= 'Payment Done';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);

					$this->session->set_flashdata('error','<div class="alert alert-success" role="alert">Payment successfully done.</div>');	
					redirect(base_url('ce-provider/ce_provider/verification_document/'.base64_encode($doc_id).''), 'refresh');

			}else{
					$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');	
					redirect(base_url('ce-provider/ce_provider/payment'), 'refresh');
			}
		}
		
	}


	
	public function paymentcancel(){
		if(empty($this->session->userdata('logincepacc'))){
			redirect(base_url('ce-provider/ce_provider/index','refresh'));
		}
		redirect(base_url('ce-provider/ce_provider/payment'), 'refresh');
	}

	public function getrenewprice(){
		$chargeid 		= $_POST['chargeid'];
		$charges_for 	= $_POST['charges_for'];
		$data['chargesarr'] = $this->provider->getunicertificatecharge($chargeid,$charges_for);
		$data['settingarr'] = $this->common_model->get_setting('1');
		if($data['chargesarr'] && $data['settingarr']){
			$charge 		= $data['chargesarr']->charge; 
			$tax 			= $data['settingarr']->tax; 
			$tax_amount 	= $charge*$tax/100; 
			echo json_encode(array('err'=>'','charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
			exit;
		}else{
			$err = 'Nope, Something went wrong';
			echo json_encode(array('err'=>$err));
			exit;
		}
	}

	public function verification_document($doc_id)
	{	
		//echo base64_decode($doc_id)	;exit;
		$this->data = array();
		$this->data['unvdetls'] = $this->provider->cep_doc_details(base64_decode($doc_id));
		$this->data['ceppaydetls'] = $this->provider->cep_payment_details(base64_decode($doc_id));
		
		$this->data['payment_document_active'] 	= 'stepActive';
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_document_active'] 	= 'stepActive';
		$this->data['verification_stepProcess'] = 'stepProcess';
		$this->data['settings'] = $this->common_model->get_setting('1');
		$this->data['webinfo'] = $this->common_model->get_websiteinformation();
		
		$this->load->view('include/header',$this->data);
		$this->load->view('steps',$this->data);
		$this->load->view('verification_document',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function digital_accr($referenceNo)
	{
		$data['payment_document_active'] 	= 'stepActive';
		$data['busniess_document_active'] 	= 'stepActive';
		$data['accre_document_active'] 		= 'stepActive';	
		$data['digital_document_active'] 	= 'stepActive';
		$data['verification_document_active'] = 'stepActive';
		$data['digital_stepProcess'] 		= 'stepActive';
		$data['referenceNo'] = base64_decode($referenceNo);
		// $this->data['cep_details'] = $this->provider->cep_doc_details(base64_decode($uid));
		// echo'<pre>'; print_r($referenceNo);die;
		$this->load->view('include/header');
		$this->load->view('steps',$data);
		$this->load->view('digital_accr',$data);
		$this->load->view('include/footer');
	}
	
	public function initialize_form(){
		if($this->input->post())
		{
			$photo = "";
			if(!empty($_FILES["company_logo"]['name'])){
				$config['upload_path']="./assets/images/ce_provider/";
				$config['allowed_types']='gif|jpg|png';
				$this->upload->initialize($config);

				if($this->upload->do_upload("company_logo")){
					$filedata = array('upload_data' => $this->upload->data());
					$photo = $filedata['upload_data']['file_name'];
					$ext = explode('.',$photo);
					$profileimage = time().'.'.end($ext);

					$tConfig['image_library'] 	= 'gd2';
					$tConfig['source_image'] 	= './assets/images/ce_provider/'.$photo;
					$tConfig['new_image'] 		= './assets/images/ce_provider/'.$profileimage;
					$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
					$tConfig['maintain_ratio'] 	= TRUE;
					$tConfig['width']         	= 300;
					$tConfig['height']       	= 300;
					$this->load->library('image_lib', $tConfig);
					$this->image_lib->resize();
					$file_info = pathinfo($tConfig['new_image']);
					// print_r($photo); exit;
					if($file_info['basename'] != ''){
					//unlink('assets/images/ce_provider/'.$photo);
					}
					$thumbimg = $file_info['basename'];
					$ext = explode('.',$file_info['basename']);
					// print_r($ext);
					$profileimage = $ext[0].'_thumb.'.end($ext);
					$photo = $profileimage;
				}
			}
			$_POST = $this->input->post();
			$business_name 	= $_POST['business_name'];
			$business_no 	= $_POST['business_no'];
			$countries_id 	= $_POST['countries_id'];
			$contact_person = $_POST['contact_person'];
			$designation 	= $_POST['designation'];
			$email 			= $_POST['email'];
			$phone 			= $_POST['phone'];
			$address 		= $_POST['address'];
			
			$is_exist = $this->provider->is_email_exist($email);
			
			if($is_exist != ''){
				$this->session->set_flashdata('response','<div class="alert alert-danger">'.$email.' already exits. Please try with another email.</div>');
				redirect(base_url('ce-provider/ce_provider/index'));
				exit;
			}
			$data = array(
				'business_name'		=> $business_name,
				'business_no' 		=> $business_no,
				'countries_id' 		=> $countries_id,
				'contact_person' 	=> $contact_person,
				'designation'		=> $designation,
				'email' 			=> $email,
				'phone' 			=> $phone,
				'status' 			=> 0,
				'address' 			=> trim($address),
				'company_logo' 		=> $photo
			);			
			$last_id = $this->provider->cepAccinsert($data);
			if($last_id!=""){
				$user_details = $this->provider->get_user_details($last_id);
				$universitydata = array(						
					'provider_id'  		=> $user_details->provider_id,
					'business_name'  	=> $user_details->business_name,
					'cep_email'  		=> $user_details->email,
					'cep_logged_in'  	=> true,
				);

				$this->session->set_userdata('logincepacc',$universitydata);
				$this->session->set_flashdata('response','<div class="alert alert-success">Business information added successfully. </div>');
				redirect(base_url('ce-provider/ce_provider/accre_document'));
				exit;
			}
		}
		redirect(base_url('ce-provider/ce_provider/index'));
	}
		
	public function renewal_form(){

		$_POST = $this->input->post();
				$business_name 	= $_POST['business_name_view'];
				$business_no 	= $_POST['business_no_view'];
				$countries_id 	= $_POST['countries_id_view'];
				$contact_person = $_POST['contact_person_view'];
				$designation 	= $_POST['designation_view'];
				$email 			= $_POST['email_view'];
				$phone 			= $_POST['phone_view'];
				$address 		= $_POST['address_view'];

				$data = array(
						't1.business_name'	=>	$business_name,
						't1.business_no' 	=> 	$business_no,
						't1.contact_person' =>  $contact_person,
						't1.designation'	=>	$designation,
						't1.email' 			=>  $email,
						't1.status' 		=>  1,
						't1.address' 		=>  trim($address)
					);
		$user_details = $this->provider->get_user_details("",$data);

		//echo print_r($user_details); exit;
		if(!empty($user_details)) {
				echo json_encode($user_details);
		}else{
			echo json_encode(array());
		}	
	}
	public function course_application(){
		$loginData = $this->session->userdata('logincepacc');
		$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'CEP & Accreditation Verification');
		$this->data['countries'] = $this->Master_m->get_countries();
		//$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['details'] = $this->provider->get_providerdetails($uid);
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/business_accreditation',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function review_course(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$uemail = $this->session->userdata('logincepacc')['username']; 
		$this->data = array('title'=> 'Online Course File');
		$this->data['countries'] = $this->Master_m->get_countries();
		//$this->db->where('licence_applied',0);
		//$this->data['details'] = $this->provider->get_result_object('tbl_course','user_email',$uemail);
		$this->data['details'] = $this->provider->getcourses($this->session->userdata('logincepacc')['user_ID']);
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/review_course',$this->data);
		$this->load->view('include/footer',$this->data);
	}


	public function course_payment(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		
		$uemail = $this->session->userdata('logincepacc')['username']; 
		$this->data = array('title'=> 'Online Course Payment');
		$post = $this->input->post();
		$this->data['post'] = $post;
		$cepCoursedoc = array('cor_doc_id'=> $post['cor_doc_id']);
		$this->session->set_userdata($cepCoursedoc);
		$this->data['chargesarr'] = $this->common_model->certificatechargesarr('online_course_accreditation');
		$this->data['settingarr'] = $this->common_model->get_setting('1');
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/course_payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function paypal_payment(){ 
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
			if($_POST['submit'] == "paynow"){
				$this->form_validation->set_rules('duration', 'accreditation period', 'trim|required');
			
				if($this->form_validation->run() == TRUE){
					$post 						= $this->input->post();
					$certdeta = $this->common_model->get_certificatechargedetails($post['duration']);
					$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' year'));
					$updatedocdate = array();
					$updatedocdate['expiry_at'] = $expiry_at;
					$updatedocdate['renew_for'] = $certdeta->duration;
					$this->provider->update('tbl_course_documents',$updatedocdate,'cor_doc_id',$post['cor_doc_id']);
					
					$paymentdata 				= array();
					$paymentdata['user_id'] 	= $this->session->userdata('logincepacc')['user_ID'];
					$paymentdata['doc_refrence_id'] = $post['cor_doc_id'];
					$paymentdata['txn_id'] 			= '';
					$paymentdata['payment_amout'] 	= $post['amount'];
					$paymentdata['payment_tax'] 	= $post['taxamt'];
					$paymentdata['payment_gross'] 	= $post['total'];			
					$paymentdata['payer_email'] 	= '';
					$paymentdata['payment_status'] 	= '';
					$paymentdata['currency_code'] 	= 'USD';
					$paymentdata['payment_for'] 	= 'C';
					$paymentdata['payment_type'] 	= 'N';
					$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
					$lastpaymentid = $this->common_model->insert_payment($paymentdata);
					
					unset($_SESSION['cor_doc_id']);
				
				// Set variables for paypal form				
				$returnURL = base_url().'ce-provider/ce_provider/coursesuccess'; //payment success url
				$cancelURL = base_url().'ce-provider/ce_provider/coursecancel'; //payment cancel url
				$notifyURL = base_url().'ce-provider/ce_provider/courseipn'; //ipn url
				
				// Get product data from the database
				$user = $this->provider->get_row_object('tbl_ce_provider','provider_id',$this->session->userdata('logincepacc')['user_ID']);
				
				
				// Get current user ID from the session
				//$userID = $_SESSION['userID'];
				//$userID = $post['uid']; 
				
				// Add fields to paypal form
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name_1', 'Online Course Accreditation');
				$this->paypal_lib->add_field('item_number_1',  $lastpaymentid);
				$this->paypal_lib->add_field('amount_1',  $post['total']);		
				$this->paypal_lib->add_field('quantity_1' ,1);
				$this->paypal_lib->add_field('lc' ,'US');
				$this->paypal_lib->add_field('custom' ,'');
				$this->paypal_lib->add_field('upload' ,'1');
				$this->paypal_lib->add_field('cbt' ,'Return to The Store');
				
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();
				}else{
					validation_errors();
					$this->data = array('title'=> 'Online Course Payment');
					$post = $this->input->post();
					$this->data['post'] = $post;
					$this->data['chargesarr'] = $this->common_model->certificatechargesarr('online_course_accreditation');
					$this->data['settingarr'] = $this->common_model->get_setting('1');
					$this->load->view('include/header',$this->data);
					$this->load->view('online_course/course_payment',$this->data);
					$this->load->view('include/footer',$this->data);
				}
			}//paynow close
				
			
	}
	public function coursesuccess(){
		$inumber = isset($_POST['item_number1'])?$_POST['item_number1']:$_POST['item_number'];
		$getuserid = $this->common_model->getuserids($inumber);
		$user = $this->provider->get_row_object('tbl_ce_provider','provider_id',$getuserid->user_id);
		
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'11',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);

		if($_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
			$paypalInfo = $this->input->post();
			// print_r($paypalInfo);die;
			$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];
			$data['txn_id'] 		= $paypalInfo["txn_id"];
			//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
			$data['currency_code'] 	= $paypalInfo["mc_currency"];
			$data['payer_email'] 	= $paypalInfo["payer_email"];
			$data['payment_status'] = $paypalInfo["payment_status"];		
			$inserted =$this->common_model->update_payment($data,$item_number);
			
			/* $paymentdata 					= array();
			$paymentdata['user_id'] 		= $_POST['custom'];
			$paymentdata['doc_refrence_id'] = $_POST['item_name'];
			$paymentdata['txn_id'] 			= $_POST['txn_id'];
			$paymentdata['payment_gross'] 	= $_POST['payment_gross'];
			$paymentdata['payer_email'] 	= $_POST['payer_email'];
			$paymentdata['payment_status'] 	= $_POST['payment_status'];
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'C';
			$paymentdata['payment_type'] 	= 'R';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$inserted = $this->provider->insert_payment($paymentdata); */
			if($inserted){
				$settingarr = $this->common_model->get_setting('1');
				$bytes 		= random_bytes(3); 
				$refcode 	= bin2hex($bytes);
				$courseRefCode = 'COU-'.$user->provider_id.$refcode.'-'.date('Y');
				//assing refrence code and status
				$applied = array('refrence_code'=>$courseRefCode,'licence_applied'=>'1','applied_date'=>date('Y-m-d H:i:s'),'submitted'=>'y');
				$this->provider->update('tbl_course_documents',$applied,'cor_doc_id',$getuserid->doc_refrence_id);
				
				$bodycontentforCodeCo = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$courseRefCode.'</p>';
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => SMTP_HOSTNAME,
					'smtp_port' => SMTP_PORT,
					'smtp_user' => SENT_EMAIL_FROM,
					'smtp_pass' => SENT_EMAIL_PASSWORD,
					'mailtype'  => 'html', 
					'newline'   => "\r\n",
					'AuthType'   => "XOAUTH2",
					'charset'   => 'iso-8859-1',
					
				);  
				$this->load->library('email');
				$subject = 'Online Course apply for certificate';
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($user->email);
				$this->email->subject($subject);
				$emailbody = array();
				$emailbody['name'] = $user->contact_person;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCodeCo;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				$updatenotification 				= array();
				$updatenotification['uniid'] 		= $user->provider_id;
				$updatenotification['subject'] 		= $subject;
				$updatenotification['message'] 		= $bodycontentforCodeCo;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->provider->insertnotifications($updatenotification);
				redirect(base_url('ce-provider/ce_provider/reviewcourse/'.base64_encode($getuserid->doc_refrence_id)));
			}
			
		}
	}
	public function coursecancel(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		redirect(base_url('ce-provider/ce_provider/course_application'), 'refresh');
	}
	public function courseipn(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		redirect(base_url('ce-provider/ce_provider/course_application'), 'refresh');
	}
	
	public function reviewcourse($cor_doc_id){
		$this->data = array('title'=> 'Verification of Documents');
		$this->data['course_details'] = $this->provider->get_row_object('tbl_course_documents','cor_doc_id',base64_decode($cor_doc_id));
		$this->data['coudtls'] = $this->provider->get_course_details_all(base64_decode($cor_doc_id));
		$this->data['settings'] = $this->common_model->get_setting('1');
		$this->data['webinfo'] = $this->common_model->get_websiteinformation();
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/reviewcourse',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function digitalaccreditation($cor_doc_id){
		$this->data = array('title'=> 'Certificate of Accreditation');
		$this->data['course_details'] = $this->provider->get_row_object('tbl_course_documents','cor_doc_id',base64_decode($cor_doc_id));
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/digitalaccreditation',$this->data);
		$this->load->view('include/footer',$this->data);
	}	

	public function old_renewonlinecourse($id=null){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array('title'=> 'Verification of Documents');
		$courdoc_id = base64_decode($id);
		// $user_ID = base64_decode($cid); 
		/* $user_ID = $cid; */
		if($courdoc_id < 1){
			redirect(base_url('ce-provider/ce_provider/course_application'), 'refresh');
		} 
		
		//$this->data['course_details'] = $this->provider->get_row_object('tbl_course','id',$courdoc_id);
		$this->data['course_details'] = $this->provider->get_row_object('tbl_course_documents','cor_doc_id',$courdoc_id);
		if($this->data['course_details']->reviewer_status == 1){
			redirect(base_url('ce-provider/ce_provider/digitallicence/'.base64_encode($this->data['course_details']->cor_doc_id)), 'refresh');
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/renewonlinecourse',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	public function old_digitallicence($id=null){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array('title'=> 'Digital licence');
		$doc_refrence_id = base64_decode($id); 
		// $user_ID = base64_decode($cid); 
		/* $user_ID = $cid; */
		if($doc_refrence_id < 1){
			redirect(base_url('ce-provider/ce_provider/course_application'), 'refresh');
		} 
		
		//$this->data['course_details'] = $this->provider->get_row_object('tbl_course','id',$doc_refrence_id);
		$this->data['course_details'] = $this->provider->get_row_object('tbl_course_documents','cor_doc_id',$doc_refrence_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/digitallicence',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	public function verify_course($cid){
		$this->data = array('title'=> 'Online Course Review');
		// $user_ID = base64_decode($cid); 
		$user_ID = $cid; 
		if($user_ID < 1){
			redirect(base_url('ce-provider/ce_provider/course_application'), 'refresh');
		}
		$this->data['course_details'] = $this->provider->get_row_object('tbl_course_documents','cor_doc_id',$user_ID);
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/verify_course',$this->data);
		$this->load->view('include/footer',$this->data);
	}	

	// Training Course code - Start 
	

	public function training_application(){
		// if(!$this->session->userdata('logincepacc')['user_ID']){
		// 	redirect(base_url('login'), 'refresh');
		// }
		$loginData = $this->session->userdata('logincepacc');
		$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'CEP & Accreditaion Verification');
		$this->data['countdown'] 	= $this->provider->cep_doc_details($uid);
		$this->data['countries'] = $this->Master_m->get_countries();
		//$this->data['details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['details'] = $this->provider->get_providerdetails($uid);
		// $this->data['business_stepProcess'] = 'stepProcess';
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/business_accreditation',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function review_training(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
		$uid = $loginData['user_ID'] ?? null;
		$uemail = $this->session->userdata('logincepacc')['username']; 
		$this->data = array('title'=> 'Training Course File');
		$this->data['countries'] = $this->Master_m->get_countries();
		// $this->db->where('licence_applied',0);
		// $this->db->where('document_for', 'n');
		// $this->db->where('reviewer_status', '0');
		// $this->db->where('reviewer_id', '0');
		// $this->db->where('review_date', '0000-00-00 00:00:00');
		// $this->data['details'] = $this->provider->get_result_object('tbl_training_documents','provider_id',$uid);
		$this->data['details'] = $this->provider->gettraining($uid);
		
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/review_training',$this->data);
		$this->load->view('include/footer',$this->data);
	}


	public function training_payment(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$uemail = $this->session->userdata('logincepacc')['username']; 
		$this->data = array('title'=> 'online training payment');
		$post = $this->input->post();
		$this->data['post'] = $post;
		$cepCoursedoc = array('train_doc_id'=> $post['train_doc_id']);
		$this->session->set_userdata($cepCoursedoc);
		$this->data['chargesarr'] = $this->common_model->certificatechargesarr('training_course_accreditation');
		$this->data['settingarr'] = $this->common_model->get_setting('1');
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/training_payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function trainng_paypal_payment(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		
		if($_POST['submit'] == "paynow"){
			$this->form_validation->set_rules('duration', 'accreditation period', 'trim|required');
			if($this->form_validation->run() == TRUE){
					$post 						= $this->input->post();
					$certdeta = $this->common_model->get_certificatechargedetails($post['duration']);
					$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' year'));
					$updatedocdate = array();
					$updatedocdate['expiry_at'] = $expiry_at;
					$updatedocdate['renew_for'] = $certdeta->duration;
					$this->provider->update('tbl_training_documents',$updatedocdate,'train_doc_id',$post['train_doc_id']);
					
					$paymentdata 				= array();
					$paymentdata['user_id'] 	= $this->session->userdata('logincepacc')['user_ID'];
					$paymentdata['doc_refrence_id'] = $post['train_doc_id'];
					$paymentdata['txn_id'] 			= '';
					$paymentdata['payment_amout'] 	= $post['amount'];
					$paymentdata['payment_tax'] 	= $post['taxamt'];
					$paymentdata['payment_gross'] 	= $post['total'];			
					$paymentdata['payer_email'] 	= '';
					$paymentdata['payment_status'] 	= '';
					$paymentdata['currency_code'] 	= 'USD';
					$paymentdata['payment_for'] 	= 'T';
					$paymentdata['payment_type'] 	= 'N';
					$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
					$lastpaymentid = $this->common_model->insert_payment($paymentdata);

					unset($_SESSION['train_doc_id']);
				
				$returnURL = base_url().'ce-provider/ce_provider/trainingsuccess'; //payment success url
				$cancelURL = base_url().'ce-provider/ce_provider/trainingcancel'; //payment cancel url
				$notifyURL = base_url().'ce-provider/ce_provider/trainingipn'; //ipn url
				
				// Get product data from the database
				$user = $this->provider->get_row_object('tbl_ce_provider','provider_id',$this->session->userdata('logincepacc')['user_ID']);
				
				
				// Get current user ID from the session
				//$userID = $_SESSION['userID'];
				//$userID = $post['uid']; 
				
				// Add fields to paypal form
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name_1', 'Training Course Accreditation');
				$this->paypal_lib->add_field('item_number_1',  $lastpaymentid);
				$this->paypal_lib->add_field('amount_1',  $post['total']);		
				$this->paypal_lib->add_field('quantity_1' ,1);
				$this->paypal_lib->add_field('lc' ,'US');
				$this->paypal_lib->add_field('custom' ,'');
				$this->paypal_lib->add_field('upload' ,'1');
				$this->paypal_lib->add_field('cbt' ,'Return to The Store');
				
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();
				}else{
					validation_errors();
					$this->data = array('title'=> 'training course Payment');
					$post = $this->input->post();
					$this->data['post'] = $post;
					$this->data['chargesarr'] = $this->common_model->certificatechargesarr('training_course_accreditation');
					$this->data['settingarr'] = $this->common_model->get_setting('1');
					$this->load->view('include/header',$this->data);
					$this->load->view('training_course/training_payment',$this->data);
					$this->load->view('include/footer',$this->data);
				}
			}//paynow close
		
	}
	public function trainingsuccess(){
		$inumber = isset($_POST['item_number1'])?$_POST['item_number1']:$_POST['item_number'];
		$getuserid = $this->common_model->getuserids($inumber);
		$user = $this->provider->get_row_object('tbl_ce_provider','provider_id',$getuserid->user_id);
		
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'12',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);

		if($_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
			$paypalInfo = $this->input->post();
			// print_r($paypalInfo);die;

			$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];
			$data['txn_id'] 		= $paypalInfo["txn_id"];
			//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
			$data['currency_code'] 	= $paypalInfo["mc_currency"];
			$data['payer_email'] 	= $paypalInfo["payer_email"];
			$data['payment_status'] = $paypalInfo["payment_status"];		
			$inserted =$this->common_model->update_payment($data,$item_number);
			if($inserted){
				
				$bytes 		= random_bytes(3); 
				$refcode 	= bin2hex($bytes);
				$courseRefCode = 'TRA-'.$user->provider_id.$refcode.'-'.date('Y');
				//assing refrence code and status
				$applied = array('refrence_code'=>$courseRefCode,'licence_applied'=>'1','applied_date'=>date('Y-m-d H:i:s'),'submitted'=>'y');
				$this->provider->update('tbl_training_documents',$applied,'train_doc_id',$getuserid->doc_refrence_id);
				
				$bodycontentforCodeTr = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$courseRefCode.'</p>';
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => SMTP_HOSTNAME,
					'smtp_port' => SMTP_PORT,
					'smtp_user' => SENT_EMAIL_FROM,
					'smtp_pass' => SENT_EMAIL_PASSWORD,
					'mailtype'  => 'html', 
					'newline'   => "\r\n",
					'AuthType'   => "XOAUTH2",
					'charset'   => 'iso-8859-1',
					
				);  
				$this->load->library('email');
				$subject = 'Training Course apply for certificate';
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($user->email);
				$this->email->subject($subject);
				$emailbody = array();
				$emailbody['name'] = $user->contact_person;
				$emailbody['thanksname'] = 'RBoard Team';
				$emailbody['thanks2'] = '';
				$emailbody['thanks3'] = '';
				$emailbody['body_msg'] = $bodycontentforCodeTr;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				$updatenotification 				= array();
				$updatenotification['uniid'] 		= $user->provider_id;
				$updatenotification['subject'] 		= $subject;
				$updatenotification['message'] 		= $bodycontentforCodeTr;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->provider->insertnotifications($updatenotification);
				redirect(base_url('ce-provider/ce_provider/reviewtraining/'.base64_encode($getuserid->doc_refrence_id)));
			}
			
		}
	}
	public function trainingcancel(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		redirect(base_url('ce-provider/ce_provider/training_application'), 'refresh');
	}
	public function trainingipn(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		redirect(base_url('ce-provider/ce_provider/training_application'), 'refresh');
	}
	
	public function reviewtraining($train_doc_id){
		$this->data = array('title'=> 'Review of Training Course');
		$this->data['training_details'] = $this->provider->get_row_object('tbl_training_documents','train_doc_id',base64_decode($train_doc_id));
		$this->data['tradtls'] = $this->provider->get_training_details_all(base64_decode($train_doc_id));
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/reviewtraining',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function digitalaccreditaion_training($train_doc_id){
		$this->data = array('title'=> 'Review of Training Course');
		$this->data['training_details'] = $this->provider->get_row_object('tbl_training_documents','train_doc_id',base64_decode($train_doc_id));		
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/digitalaccreditation',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function old_verify_training($tid){
		$this->data = array('title'=> 'Review of Training Course');
		$trainingid = base64_decode($tid); 
		//echo $user_ID; exit;
		//$user_ID = $tid; 
		if($trainingid < 1){
			redirect(base_url('ce-provider/ce_provider/training_application'), 'refresh');
		}
		$this->data['training_details'] = $this->provider->get_row_object('tbl_training_documents','train_doc_id',$trainingid);
		if($this->data['training_details']->reviewer_status == 1){
			redirect(base_url('ce-provider/ce_provider/digital_accreditaion/'.base64_encode($trainingid)));
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/verify_training',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function old_digital_accreditaion($tid){
		$this->data = array('title'=> 'Review of Training Course');
		$trainingid = base64_decode($tid); 
		//echo $user_ID; exit;
		//$user_ID = $tid; 
		if($trainingid < 1){
			redirect(base_url('ce-provider/ce_provider/training_application'), 'refresh');
		}
		$this->data['training_details'] = $this->provider->get_row_object('tbl_training_documents','train_doc_id',$trainingid);		
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/digital_accreditaion',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	

	function cep_renewal($id=null){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array();
		$user_id 	= $this->session->userdata('logincepacc')['user_ID'];
		$this->data = array('title'=> 'Professional License Renewal');
		$this->data['user_details'] = $this->provider->get_user_details($user_id);
		$this->data['business_stepProcess'] = 'stepProcess';

		$this->load->view('include/header',$this->data);
		$this->load->view('renew_steps',$this->data);
		$this->load->view('cep_renewal',$this->data);
		$this->load->view('include/footer',$this->data);
	}	

	
	function renew_accre_document(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array();
		$uid =  $this->session->userdata('logincepacc')['user_ID'];

		$this->data['id'] = $uid;
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_stepProcess'] = 'stepProcess';

		$this->load->view('include/header',$this->data);
		$this->load->view('renew_steps',$this->data);
		$this->load->view('renew_accre_document',$this->data);
		$this->load->view('include/footer',$this->data);

	}

	function renewal_document(){
		$uid =  $this->session->userdata('logincepacc')['user_ID'];
		
		if($this->input->post('upload')=='Upload'){
			$license_image = "";
			if(!empty($_FILES["license_image"]['name'])){
				$config['upload_path']="./assets/images/ce_provider/";
				$config['allowed_types']='gif|jpg|png|pdf|csv';
				$this->upload->initialize($config);

				if($this->upload->do_upload("license_image")){
					$filedata = array('upload_data' => $this->upload->data());
					$photo = $filedata['upload_data']['file_name'];
					$ext = explode('.',$photo);
					$profileimage = time().'.'.end($ext);

					$tConfig['image_library'] 	= 'gd2';
					$tConfig['source_image'] 	= './assets/images/ce_provider/'.$photo;
					$tConfig['new_image'] 		= './assets/images/ce_provider/'.$profileimage;
					$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
					$tConfig['maintain_ratio'] 	= TRUE;
					$tConfig['width']         	= 300;
					$tConfig['height']       	= 300;
					$this->load->library('image_lib', $tConfig);
					$this->image_lib->resize();
					$file_info = pathinfo($tConfig['new_image']);
					if($file_info['basename'] != ''){
						//unlink('assets/images/ce_provider/'.$photo);
					}
					$thumbimg = $file_info['basename'];
					$ext = explode('.',$file_info['basename']);
					$license_image = $photo;
				}

			}else{
				$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
				redirect(base_url('ce-provider/ce_provider/renew_accre_document'));exit;

			}
			$photo = "";
			if(!empty($_FILES["accreditation_image"]['name'])){
				$config['upload_path']="./assets/images/ce_provider/";
				$config['allowed_types']='gif|jpg|png|pdf|csv';
				$this->upload->initialize($config);

				if($this->upload->do_upload("accreditation_image")){
					$filedata = array('upload_data' => $this->upload->data());
					$photo = $filedata['upload_data']['file_name'];
					$ext = explode('.',$photo);
					$profileimage = time().'.'.end($ext);

					$tConfig['image_library'] 	= 'gd2';
					$tConfig['source_image'] 	= './assets/images/ce_provider/'.$photo;
					$tConfig['new_image'] 		= './assets/images/ce_provider/'.$profileimage;
					$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
					$tConfig['maintain_ratio'] 	= TRUE;
					$tConfig['width']         	= 300;
					$tConfig['height']       	= 300;
					$this->load->library('image_lib', $tConfig);
					$this->image_lib->resize();
					$file_info = pathinfo($tConfig['new_image']);
					if($file_info['basename'] != ''){
						//unlink('assets/images/ce_provider/'.$photo);
					}
					$thumbimg = $file_info['basename'];
					$ext = explode('.',$file_info['basename']);
					// print_r($ext);
					$profileimage = $photo; //$ext[0].'_thumb.'.end($ext);
					$photo = $profileimage;
				}

			}else{
				$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
				redirect(base_url('ce-provider/ce_provider/renew_accre_document'));exit;
			}

				$uphoto = array(
						'provider_id' 			=>	$uid,
						'license_image'			=>	$license_image,
						'document_for' 			=> 	'r',
						'accreditation_image'	=>	$photo,
					);

				$update = $this->provider->insert('tbl_cep_documents',$uphoto);
// echo $this->db->last_query();die;
				
				if($update > 0){
					$ceprenewdoc = array('updatecepdoc'=> $update);
					$this->session->set_userdata($ceprenewdoc);
					$this->session->set_flashdata('error','<div class="alert alert-success" role="alert">Documents uploaded successfully.</div>');
					redirect(base_url('ce-provider/ce_provider/renew_payment'));exit;
				}else{
					$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
					redirect(base_url('ce-provider/ce_provider/renew_accre_document'));exit;
				}
		}
	}
	public function renew_payment(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array();
		$uid =  $this->session->userdata('logincepacc')['user_ID'];
		
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_stepProcess'] 		= 'stepActive';
		$this->data['payment_stepProcess'] 		= 'stepProcess';
		
		$data['settingarr'] = $this->common_model->get_setting('1');
		$this->data['chargesarr'] = $this->common_model->certificatechargesarr('cep_accreditation');
		//print_r($data['chargesarr']);
		$this->load->view('include/header',$this->data);
		$this->load->view('renew_steps',$this->data);
		$this->load->view('renew_payment',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function renewal_payment()
	{
		// if(!$this->session->userdata('logincepacc')['user_ID']){
		// 	redirect(base_url('login'), 'refresh');
		// }

		if(isset($_POST['submit']) && $_POST['submit']== "paynow") {
			$this->form_validation->set_rules('duration', 'purchase for', 'trim|required');
			//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$certdeta = $this->common_model->get_certificatechargedetails($_POST['duration']);
				
				
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' year'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				//print_r($updatedocdate); exit;
				$this->provider->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updatecepdoc'));
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $this->session->userdata('logincepacc')['user_ID'];
				$paymentdata['doc_refrence_id'] = $this->session->userdata('updatecepdoc');
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $_POST['amount'];
				$paymentdata['payment_tax'] 	= $_POST['taxamt'];
				$paymentdata['payment_gross'] 	= $_POST['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'CEP';
				$paymentdata['payment_type'] 	= 'R';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
				
				
				echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';
				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalform"> 
					
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="item_name_1" value="CEP Accreditation Renewal">
				<input type="hidden" name="item_number_1" value="'.$lastpaymentid.'">
				<input type="hidden" name="amount_1" id="amount_1"  value="'.$_POST['total'].'">
				<input type="hidden" name="quantity_1" value="1"> 
				<input type="hidden" name="custom" value="ss">
				<!--<input type="hidden" name="notify_url" value="https://www.yoursite.com/my_ipn.php">-->
				<input type="hidden" name="return" value="'.base_url('ce-provider/ce_provider/renewal_paymentsucess').'">
				<input type="hidden" name="cbt" value="Return to The Store">
				<input type="hidden" name="cancel_return" value="'.base_url('ce-provider/ce_provider/renewal_paymentcancel').'">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" value="2" name="rm"> 	
				<input type="hidden" name="currency_code" value="USD">
				<!--<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">-->
				
				'.form_close();	
				//echo '<script> $("#paypalform").submit(); </script>';
				echo '<script> document.getElementById("paypalform").submit(); </script>';
				exit;
			}else{
				validation_errors();
			}
		}
	}	

	


	function renewal_paymentsucess(){
		
		//echo '<pre>'; print_r($_POST); exit;
		if(isset($_POST['txn_id']) && $_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
			$paypalInfo 						= $this->input->post();
			$paymentupdate 						= array();
			$paymentupdate['txn_id'] 			= $paypalInfo["txn_id"];
			$paymentupdate['currency_code'] 	= $paypalInfo["mc_currency"];
			$paymentupdate['payer_email'] 		= $paypalInfo["payer_email"];
			$paymentupdate['payment_status'] 	= $paypalInfo["payment_status"];		
			$updatepayment = $this->common_model->update_payment($paymentupdate,$paypalInfo['item_number1']);
			$getuserid = $this->common_model->getuserids($paypalInfo['item_number1']);
			// update application count
			$logs = array(
				'application_id'	=>	$getuserid->doc_refrence_id,
				'res_id'			=>	'10',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);

			$info = $this->provider->get_providerdetails($getuserid->user_id);
			if($info->provider_id > 0){
				$ip_address = $_SERVER['REMOTE_ADDR'];

				$create_session = array(
					'user_ID' 		=> $info->provider_id,   
					'ip_address' 	=> $ip_address,
					'username' 		=> $info->email,
					'name' 			=> $info->business_name,
					'session'		=> true,
					'role'			=> 'cep'
				);
				$this->session->set_userdata('logincepacc',$create_session);
			} 
			
			$bytes 		= random_bytes(3); 
			$refcode 	= bin2hex($bytes);
			$reference_no = 'CEP-'.$getuserid->user_id.$refcode.'-'.date('Y');

			// $reference_no = 'CEP-'.time().'-'.date('Y');
			
			$updatedocdate = array();
			$updatedocdate['reference_no'] = $reference_no;
			$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
			$this->provider->updatedocumentrenewdate($updatedocdate, $getuserid->doc_refrence_id);
			//$this->provider->update('tbl_ce_provider',$arr_provider,'provider_id',$unvdetls->provider_id);

			//if($inserted >0){
				$unvdetls = $this->provider->get_user_details($info->provider_id);
		
				$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for Renewal CEP was successfully submitted.<br><br>Provide us some time to review your documents. You can check status by '.$serachlink.' with this <br>Refrence Code : <strong>'.$reference_no.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';

						$config = Array(
							'protocol' => 'smtp',
							'smtp_host' => SMTP_HOSTNAME,
							'smtp_port' => SMTP_PORT,
							'smtp_user' => SENT_EMAIL_FROM,
							'smtp_pass' => SENT_EMAIL_PASSWORD,
							'mailtype'  => 'html', 
							'newline'   => "\r\n",
							'AuthType'   => "XOAUTH2",
							'charset'   => 'iso-8859-1',
							
						);  
						$this->load->library('email');
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($info->email);
						$this->email->subject('Renewal of CEP Accreditation');
						$emailbody 					= array();
						$emailbody['name'] 			= $info->business_name;
						$emailbody['thanksname'] 	= 'RBoard';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
			//}
		}
		$this->data = array();
		$this->data['unvdetls'] = $this->provider->cep_doc_details($getuserid->doc_refrence_id,'r');
		$this->data['id'] = $getuserid->doc_refrence_id;
		$this->data['payment_document_active'] 	= 'stepActive';
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_document_active'] 	= 'stepActive';
		$this->data['verification_stepProcess'] = 'stepProcess';
		
		$this->load->view('include/header',$this->data);
		$this->load->view('renew_steps',$this->data);
		$this->load->view('renew_verification_document',$this->data);
		$this->load->view('include/footer',$this->data);
		// redirect(base_url('ce-provider/ce_provider/renew_verification_document/'.base64_encode($getuserid->doc_refrence_id)), 'refresh');
	}

	function renew_verification_document($id=null){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		
		$cepdoc_id = base64_decode($id); 
		$this->data['unvdetls'] = $this->provider->cep_doc_details($uid,'r');

		//print_r($this->data['unvdetls']); exit;
		$this->data = array();
		$this->data['id'] = $uid;
		$this->data['payment_document_active'] 	= 'stepActive';
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_document_active'] 	= 'stepActive';
		$this->data['verification_stepProcess'] = 'stepProcess';
		
		$this->load->view('include/header',$this->data);
		$this->load->view('renew_steps',$this->data);
		$this->load->view('renew_verification_document',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function renewal_paymentcancel(){
		if(!$this->session->userdata('logincepacc')['user_ID']){
			redirect(base_url('login'), 'refresh');
		}
		redirect(base_url('ce-provider/ce_provider/renew_payment'), 'refresh');
	}

	function renew_digital_accr()
	{
		if(empty($this->session->userdata('logincepacc')))
		{
			redirect(base_url('ce-provider/ce_provider/index','refresh'));
		}

		$uid = $this->session->userdata('logincepacc')['provider_id'];
		
		$this->data['cep_details'] = $this->provider->cep_doc_details($uid,'r');



		$this->data['payment_document_active'] = 'stepActive';
		$this->data['busniess_document_active'] = 'stepActive';
		$this->data['accre_document_active'] = 'stepActive';	
		$this->data['digital_document_active'] = 'stepActive';
		$this->data['verification_document_active'] = 'stepActive';
		$this->data['digital_stepProcess'] = 'stepProcess';
		
		$this->data['id'] = $uid;

		$this->load->view('include/header',$this->data);
		$this->load->view('renew_steps',$this->data);
		//$this->load->view('digital_accr',$this->data);
		$this->load->view('renew_digital_license',$this->data);
		$this->load->view('include/footer',$this->data);

	}


	function upload_course(){
		$post = $this->input->post();
		$result = $this->provider->insertCourse($post);
		if($result){
			$this->session->set_flashdata('response','<div class="alert alert-success">Course uploaded successfully.</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong!</div>');
		}
		// redirect('ce-provider/ce_provider/review_course');
		redirect('ce-provider/ce_provider/onlinecourse');
	}

	function edit_training($tid = false){

		if($this->input->post('update')=='Update'){
			
			$post = $this->input->post();
			$result = $this->provider->updateTraining($post);
			if($result){
				$this->session->set_flashdata('response','<div class="alert alert-success">Trainnig Updated successfully.</div>');
			}else{
				$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong!</div>');
			}
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Edit Training Course');
		$this->data['countdown'] 		= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] 	= $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] 	= $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] 	= $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['training'] 		= $this->provider->get_row_object('tbl_training_documents','train_doc_id',base64_decode($tid));
		$this->data['profession_list'] 	= $this->provider->get_profession_list();
		$this->load->view('include/header',$this->data);
		$this->load->view('training_course/edit_training_course',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	function edit_course($cid = false){

		if($this->input->post('update')=='Update'){
			$post = $this->input->post();
			$result = $this->provider->updateCourse($post);
			if($result){
				$this->session->set_flashdata('response','<div class="alert alert-success">Course Updated successfully.</div>');
			}else{
				$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong!</div>');
			}
		}
		$loginData = $this->session->userdata('logincepacc');
$uid = $loginData['user_ID'] ?? null;
		$this->data = array('title'=> 'Edit Online Course');
		$this->data['countdown'] 		= $this->provider->cep_doc_details_for_dashboard($uid);
		$this->data['user_details'] 	= $this->provider->get_row_object('tbl_ce_provider','provider_id',$uid);
		$this->data['count_course'] 	= $this->provider->count_rows('tbl_course_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['count_training'] 	= $this->provider->count_rows('tbl_training_documents',array('provider_id'=>$uid,'reviewer_status'=>'1'));
		$this->data['course'] 		= $this->provider->get_row_object('tbl_course_documents','cor_doc_id',base64_decode($cid));
		$this->data['profession_list'] 	= $this->provider->get_profession_list();
		$this->load->view('include/header',$this->data);
		$this->load->view('online_course/edit_online_course',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	function upload_training(){
		$this->load->library('upload');
		$post = $this->input->post();
		$result = $this->provider->insertTraining($post);
		if($result){
			$this->session->set_flashdata('response','<div class="alert alert-success">Course uploaded successfully.</div>');
		}else{
			$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong!</div>');
		}
		// redirect('ce-provider/ce_provider/review_training');
		redirect('ce-provider/ce_provider/trainingcourse');
	}

	public function forgetpassword(){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('email', 'Email', 'required');
			if ($this->form_validation->run() == TRUE) {
				$email_details = $this->provider->is_email_exist($this->input->post('email')); 
				
				if(count($email_details) > 0){
					$updatepass = array();
					$updatepass['token_key'] = $this->input->post('token_key');
					$resupdate = $this->provider->updatePassword($updatepass, $email_details->provider_id);
					$this->session->set_flashdata('item', array('message' => 'we have sent you an email for reset you password.','class' => 'alert-success'));
				
				$settingarr = $this->common_model->get_setting('1');	
				$resetlink = base_url('ce-provider/ce_provider/resetpassword').'?token='.$this->input->post('token_key').'&&useremail='.$this->input->post('email').'&&userid='.$email_details->provider_id;
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your have requested for reset you password.<br><br>In this regard, we have sent you a reset password link.<br> Please click the Reset Password Link to reset your password <a href="'.$resetlink.'" class="btn btn-success" >'.$resetlink.'</a></p>';
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => SMTP_HOSTNAME,
					'smtp_port' => SMTP_PORT,
					'smtp_user' => SENT_EMAIL_FROM,
					'smtp_pass' => SENT_EMAIL_PASSWORD,
					'mailtype'  => 'html', 
					'newline'   => "\r\n",
					'AuthType'   => "XOAUTH2",
					'charset'   => 'iso-8859-1',
					
				);  
				$this->load->library('email');
				$subject = 'Password reset link';
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($email_details->email);
				$this->email->subject($subject);
				$emailbody = array();
				$emailbody['name'] 			= $email_details->business_name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] = $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				$updatenotification 				= array();
				$updatenotification['uniid'] 		= $email_details->provider_id;
				$updatenotification['subject'] 		= $subject;
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->provider->insertnotifications($updatenotification);
				}else{
					$this->session->set_flashdata('item', array('message' => 'This email is not exist in our system!!!','class' => 'alert-danger'));
				}
				redirect(base_url('ce-provider/ce_provider/forgetpassword'), 'refresh');
			}else{
				validation_errors();
			}
		}
		
		$this->data = array('title'=> 'Forget Password');
		$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id', $this->session->userdata('logincepacc')['user_ID']);
		$this->load->view('include/header',$this->data);
		$this->load->view('forgetpassword',$this->data);
		// $this->load->view('include/footer',$this->data);
	}

	
	public function resetpassword(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|matches[new_pass]');
			if ($this->form_validation->run() == TRUE) {
				
				$updatepass['token_key'] = '';
				$this->provider->updatePassword($updatepass,$this->input->post('provider_id'));
				
				if($this->input->post('new_pass') != $this->input->post('conf_pass')){
					$this->session->set_flashdata('item', array('message' => 'Confirm password not matched.','class' => 'alert-danger'));
					redirect(base_url('ce-provider/ce_provider/resetpassword'), 'refresh');
				}else{
					$updatepass = array();
					$updatepass['password'] = $this->input->post('conf_pass');
					$this->provider->updatePassword($updatepass,$this->input->post('provider_id'));
					$this->session->set_flashdata('item', array('message' => 'New password successfully updated.','class' => 'alert-success'));
					// redirect(base_url('ce-provider/ce_provider/successpassword'), 'refresh');
					$this->load->view('include/header',$this->data);
					$this->load->view('successpassword',$this->data);
					exit();
				}
			}else{
				validation_errors();
				$this->data = array('title'=> 'Reset Password');
				$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$this->input->post('provider_id'));
				$this->load->view('include/header',$this->data);
				$this->load->view('resetpassword',$this->data);
				// $this->load->view('include/footer',$this->data);
			}
		}
		
		if(isset($_GET['userid']) && $_GET['userid'] > 0 ){
			$email_details = $this->provider->is_email_exist($_GET['useremail']); 
			if(isset($email_details)&& $email_details->token_key == $_GET['token']){
				$this->data = array('title'=> 'Reset Password');
				$this->data['user_details'] = $this->provider->get_row_object('tbl_ce_provider','provider_id',$_GET['userid']);
				$this->load->view('include/header',$this->data);
				$this->load->view('resetpassword',$this->data);
				// $this->load->view('include/footer',$this->data);
			}else{
				$this->session->set_flashdata('item', array('message' => 'link expired, Please try again!','class' => 'alert-danger'));
				redirect(base_url('ce-provider/ce_provider/forgetpassword'), 'refresh'); 
			}
		}else{
			$this->session->set_flashdata('item', array('message' => 'Not a valid link, Please try again!','class' => 'alert-danger'));
			redirect(base_url('ce-provider/ce_provider/forgetpassword'), 'refresh'); 
		}
	}
		
	public function logout(){
		$this->session->unset_userdata('logincepacc');
		redirect(base_url('login'), 'refresh');
	}

	public function get_receipt(){
		$id = $this->input->post('id');
		$data['details'] = $this->provider->get_one_receipt($id);
		$this->load->view('admin/receipt_view',$data);
		// echo 'json_encode($data)';
	}

	public function resubmitCourse(){
		$post = $this->input->post();
		$result = false;		
		$this->load->library('upload');
		if(isset($_FILES["upload_course"]) && !empty($_FILES["upload_course"]['name'])){
			$config1['upload_path'] 	= './assets/images/ce_provider/';
			$config1['allowed_types'] 	= 'pdf|csv';     
			$ext 						= explode('.',$_FILES["upload_course"]["name"]);        
			$upload_course 				= 'p_'.time().'.'.end($ext);
			$config1['file_name'] 		= $upload_course;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('upload_course'))
			{ 
				$this->session->set_flashdata('item','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');      
				redirect('ce-provider/ce_provider/onlinecourse'); exit;
			}  
			$upload_course = $upload_course;
			
			$value = array(
				'course_pdf'	=> $upload_course,
				'updated_at'	=> date('Y-m-d H:i:s')
			);  
			$where = array( 
				'cor_doc_id' => $post['cid'],
				'provider_id' => $post['provider_id']
			); 
			$result = $this->provider->resubmitCourse($value,$where);		
		}
		if($result){
				
			$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please check your for-review application, You got updated course application from '.$post['course_name'].'<br>
			<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have any questions feel free to message and we will be happy to assist you.</p>';
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => SMTP_HOSTNAME,
				'smtp_port' => SMTP_PORT,
				'smtp_user' => SENT_EMAIL_FROM,
				'smtp_pass' => SENT_EMAIL_PASSWORD,
				'mailtype'  => 'html', 
				'newline'   => "\r\n",
				'AuthType'   => "XOAUTH2",
				'charset'   => 'iso-8859-1',
			);  
			
			$settingarr = $this->common_model->get_setting('1');
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($post['reviewer_email']);
			$this->email->subject('Updated Course :'.$post['course_name']);
			$emailbody 					= array();
			$emailbody['name'] 			= $post['reviewer_email'];
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 		= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
			$this->email->message($emailmessage);
			$this->email->send();
		
			$this->session->set_flashdata('item','<div class="alert alert-success">Course re-uploaded successfully.</div>');
		}else{
			$this->session->set_flashdata('item','<div class="alert alert-danger">Something went wrong!</div>');
		}
		redirect('ce-provider/ce_provider/onlinecourse');
	}

	public function resubmitTraining(){
		$post = $this->input->post();
		$result = false;		
		$this->load->library('upload');
		if(isset($_FILES["upload_training"]) && !empty($_FILES["upload_training"]['name'])){
			$config1['upload_path'] 	= './assets/images/ce_provider/';
			$config1['allowed_types'] 	= 'pdf|csv';     
			$ext 						= explode('.',$_FILES["upload_training"]["name"]);        
			$upload_training 				= 'p_'.time().'.'.end($ext);
			$config1['file_name'] 		= $upload_training;
			$this->upload->initialize($config1);
			if ( ! $this->upload->do_upload('upload_training'))
			{ 
				$this->session->set_flashdata('item','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');      
				redirect('ce-provider/ce_provider/trainingcourse'); exit;
			}  
			$upload_training = $upload_training;
			
			$value = array(
				'training_pdf'	=> $upload_training,
				'updated_at'	=> date('Y-m-d H:i:s')
			);  
			$where = array( 
				'train_doc_id' => $post['tid'],
				'provider_id' => $post['provider_id']
			); 
			$result = $this->provider->resubmitTraining($value,$where);		
		}
		if($result){
				
			$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please check your for-review application, You got updated Training application from '.$post['training_name'].'<br>
			<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have any questions feel free to message and we will be happy to assist you.</p>';
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => SMTP_HOSTNAME,
				'smtp_port' => SMTP_PORT,
				'smtp_user' => SENT_EMAIL_FROM,
				'smtp_pass' => SENT_EMAIL_PASSWORD,
				'mailtype'  => 'html', 
				'newline'   => "\r\n",
				'AuthType'   => "XOAUTH2",
				'charset'   => 'iso-8859-1',
			);  
			
			$settingarr = $this->common_model->get_setting('1');
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($post['reviewer_email']);
			$this->email->subject('Updated Training :'.$post['training_name']);
			$emailbody 					= array();
			$emailbody['name'] 			= $post['reviewer_email'];
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 		= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
			$this->email->message($emailmessage);
			$this->email->send();
		
			$this->session->set_flashdata('item','<div class="alert alert-success">Training re-uploaded successfully.</div>');
		}else{
			$this->session->set_flashdata('item','<div class="alert alert-danger">Something went wrong!</div>');
		}
		redirect('ce-provider/ce_provider/trainingcourse');
	}

}

?>