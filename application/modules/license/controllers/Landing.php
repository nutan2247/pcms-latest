<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MX_Controller {
	var $subs_status;
	var $data = array();
	var $tbl_user_certificate  = 'tbl_user_certificate';

	public function __construct(){
		parent::__construct();
		$this->load->model('professional/Applicant_model','applicant');
		$this->load->model('Landing_model','landing');
        $this->load->model('courses_model');
        $this->load->model('training_model');
		$this->load->library('upload');
		$this->load->library('paypal_lib');
		$this->load->library('Variablebilling');
		$this->load->library('ciqrcode');
		//rboard check 
		$subscription = $this->common_model->get_admin_subscription_details();
		if(isset($subscription->rb_sub_key) && $subscription->rb_sub_key == ""){
			//go to contcat for admin with form details
			$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
			redirect(base_url('contactus'), 'refresh');		
		}

		if(isset($subscription->no_of_application) && $subscription->no_of_application == 0 && $subscription->subscription_id == 6){
			$this->subs_status = 'y';
		}else{
			if(isset($subscription->total_application) && $subscription->total_application <= $this->common_model->get_online_application_count()){	
				$this->subs_status = 'n';
			}else{
				$this->subs_status = 'y';
			}
		}
		//end rboard check 

	}


	public function index(){
		$this->load->model('cms_model');
		$this->data = array('title'=> 'Welcome to Regulatory  Board');
		$this->data['pprofessional'] = $this->landing->get_pprofessional();
		$this->data['gprofessional'] = $this->landing->get_gprofessional();
		$this->data['cep'] 			 = $this->landing->get_cep();
		$this->data['university'] 	 = $this->landing->get_university();
		
		$this->data['courselisting']   	= $this->courses_model->courselisting();
		$this->data['traininglisting'] 	= $this->training_model->traininglisting();
		
		$this->data['profession'] 		= $this->common_model->professionarr();
		$this->data['topbanners'] 		= $this->landing->topbanners();
		$this->data['newslisting'] 		= $this->cms_model->newslisting('','',3);
		$this->data['newslistingrightside'] 	= $this->cms_model->newslistingrightside(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('landing',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}

	public function landing2(){
		$this->load->model('cms_model');
		$this->data = array('title'=> 'Welcome to Regulatory  Board');
		$this->data['pprofessional'] = $this->landing->get_pprofessional();
		$this->data['gprofessional'] = $this->landing->get_gprofessional();
		$this->data['cep'] 			 = $this->landing->get_cep();
		$this->data['university'] 	 = $this->landing->get_university();
		
		$this->data['courselisting']   	= $this->courses_model->courselisting();
		$this->data['traininglisting'] 	= $this->training_model->traininglisting();
		
		$this->data['profession'] 		= $this->common_model->professionarr();
		$this->data['topbanners'] 		= $this->landing->topbanners();
		$this->data['newslisting'] 		= $this->cms_model->newslisting(3);
		$this->data['newslistingrightside'] 	= $this->cms_model->newslistingrightside(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('landing2',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}

	public function landing3(){
		$this->load->model('cms_model');
		$this->data = array('title'=> 'Welcome to Regulatory  Board');
		$this->data['pprofessional'] = $this->landing->get_pprofessional();
		$this->data['gprofessional'] = $this->landing->get_gprofessional();
		$this->data['cep'] 			 = $this->landing->get_cep();
		$this->data['university'] 	 = $this->landing->get_university();
		
		$this->data['courselisting']   	= $this->courses_model->courselisting();
		$this->data['traininglisting'] 	= $this->training_model->traininglisting();
		
		$this->data['profession'] 		= $this->common_model->professionarr();
		$this->data['topbanners'] 		= $this->landing->topbanners();
		$this->data['newslisting'] 		= $this->cms_model->newslisting(3);
		$this->data['newslistingrightside'] 	= $this->cms_model->newslistingrightside(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('landing3',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}
	public function landing4(){
		$this->load->model('cms_model');
		$this->data = array('title'=> 'Welcome to Regulatory  Board');
		$this->data['pprofessional'] = $this->landing->get_pprofessional();
		$this->data['gprofessional'] = $this->landing->get_gprofessional();
		$this->data['cep'] 			 = $this->landing->get_cep();
		$this->data['university'] 	 = $this->landing->get_university();
		
		$this->data['courselisting']   	= $this->courses_model->courselisting();
		$this->data['traininglisting'] 	= $this->training_model->traininglisting();
		
		$this->data['profession'] 		= $this->common_model->professionarr();
		$this->data['topbanners'] 		= $this->landing->topbanners();
		$this->data['newslisting'] 		= $this->cms_model->newslisting(3);
		$this->data['newslistingrightside'] 	= $this->cms_model->newslistingrightside(); 
		$this->load->view('include/header',$this->data);
		$this->load->view('landing4',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}


	public function professional_license(){

		if($this->session->userdata('professioanl_renew')){
			$this->session->unset_userdata('professioanl_renew');
		}

		$this->data = array('title'=> 'Professional License Renewal');

		if($this->input->post('submit')=='submit')
		{
			$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lname', 'Middle  Name', 'trim|required');
			$this->form_validation->set_rules('name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('birthday', 'DOB', 'trim|required');
			$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
			$this->form_validation->set_rules('license_number', 'License number', 'trim|required');
			$this->form_validation->set_rules('date_issued', 'Date issued', 'trim|required');
			$this->form_validation->set_rules('validity_date', 'Date issued', 'trim|required');
			if($this->form_validation->run() == TRUE)
			{
				$post = $this->input->post();
				$result = $this->landing->matchdata($post);
				// echo '<pre>'; echo $this->db->last_query(); print_r($result);die;

				if($result){
					if($result->candidate_type=='p'){
						$details = $this->applicant->fetch_user_details($result->user_id);
					}
					
					if($result->candidate_type=='g'){
						$details = $this->applicant->fetch_graduate_details($result->user_id);
					}
				}else{
					$details = '';
				}

				if(!empty($details)){
					$set_session = array(
						'user_id' => $result->user_id,
						'name' 	  => $result->fullname,
						'email'   => $result->email,
						'candidate_type'=> $result->candidate_type,
					);
					$this->session->set_userdata('professioanl_renew',$set_session);
					$data['match_success'] = 1;
					$data['user'] = $result;
					$data['udetails'] = $details;
				}else{
					$data['match_success'] = 0;
					$data['udetails_not_match'] = 1;
				}
				// echo '<pre>'; print_r($data);die; it will goes to same page again...
			}else{

				validation_errors();
			}
		}

		$userid = $this->session->userdata('user_ID');

		$this->db->order_by('name','ASC');
		$data['profession']  = $this->landing->get_result_object('tbl_profession','status',1);
		$data['details'] = $this->landing->get_professional_details($userid);

		$this->load->view('include/header',$this->data);
		$this->load->view('license_form',$data);
		$this->load->view('include/footer',$this->data);
	}


	

	public function update_photo(){
		if(!$this->session->userdata('professioanl_renew')){
			redirect(base_url('license/landing/professional_license')); die();
		}
		$uid = base64_decode($this->uri->segment(4));
		$photo = ''; 
		// $uid = $this->session->userdata('user_ID');
		if($this->input->post('submit')=='submit')
		{
		if(!empty($_FILES["photo"]['name'])){
			$config['upload_path']="./assets/uploads/profile/";
			$config['allowed_types']='gif|jpg|png';
			$this->upload->initialize($config);

			if($this->upload->do_upload("photo")){
				$filedata = array('upload_data' => $this->upload->data());
				$photo = $filedata['upload_data']['file_name'];
				$ext = explode('.',$photo);
				$profileimage = time().'.'.end($ext);
				
				$tConfig['image_library'] 	= 'gd2';
				$tConfig['source_image'] 	= './assets/uploads/profile/'.$photo;
				$tConfig['new_image'] 		= './assets/uploads/profile/'.$profileimage;
				$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
				$tConfig['maintain_ratio'] 	= TRUE;
				$tConfig['width']         	= 300;
				$tConfig['height']       	= 300;
				$this->load->library('image_lib', $tConfig);
				$this->image_lib->resize();
				$file_info = pathinfo($tConfig['new_image']);
				// print_r($file_info);
				if($file_info['basename'] != ''){
					unlink('assets/uploads/profile/'.$photo);
				}
				$thumbimg = $file_info['basename'];
				$ext = explode('.',$file_info['basename']);
				// print_r($ext);
				$profileimage = $ext[0].'_thumb.'.end($ext);
				$photo = $profileimage;
			}
		
		$uphoto = array('image'=>$photo);
		$update = $this->landing->update('tbl_users',$uphoto,'user_ID',$uid);
		if($update){
			$this->session->set_flashdata('error','<div class="alert alert-success" role="alert">Profile photo updated successfully!</div>');
			$udetails = $this->landing->fetch_user_details($uid);
			$this->data = array( 'title'  => 'Profile updated','udetails'  => $udetails);
		}else{
			$this->session->set_flashdata('error','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
			//redirect('landing/professional_license');
		}

		}
	}else{
		$udetails = $this->landing->fetch_user_details($uid);
		$this->data = array('udetails'  => $udetails);
	}
		$this->load->view('include/header',$this->data);
		$this->load->view('upload_photo',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function user_verification($email){
		$udetails = $this->landing->fetch_user_details($email);
		$this->data = array( 'title'  => 'Verification','udetails'  => $udetails);
		$this->load->view('include/header',$this->data);
		$this->load->view('verification',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function required_units(){
		if(!$this->session->userdata('professioanl_renew')){
			redirect(base_url('license/landing/professional_license')); die();
		}
		// echo 'required_units';die;
		$balanced = "";
		$specific_balanced = "";
		$gernal_balanced = "";
		// $user_id 	=  $this->session->userdata('user_ID');
		$user_id 	=  base64_decode($this->uri->segment(4));
		$user_view 	=  $this->input->get('user_view');
		$view 		=  $this->input->get('view');
		// $udetails = $this->Master_m->get_user_details($user_id);
		if($this->session->userdata('professioanl_renew')['candidate_type']=='p'){
			$udetails = $this->applicant->fetch_user_details($user_id);
		}
		
		if($this->session->userdata('professioanl_renew')['candidate_type']=='g'){
			$udetails = $this->applicant->fetch_graduate_details($user_id);
		}
		if(!empty($udetails)){
		$profdetails = $this->landing->get_row_object('tbl_profession','id',$udetails->profession);

		/*********************** GET ALL GERTIFICATE *******************************/
		//echo "sdf".$this->tbl_user_certificate; exit;
		$this->db->where(array('certificate_identify'=>0));
		$get_all_certificate = $this->landing->get_result_array($this->tbl_user_certificate,'user_email',$udetails->email);

		$where2 = array('user_email'=>$udetails->email,'category' => 'specific','certificate_identify'=>0);
		$where3 = array('user_email'=>$udetails->email,'category' => 'general','certificate_identify'=>0);

		$where_online_certificate = array('user_email'=>$udetails->email,'issue_from' => 'Online Course','certificate_identify'=>0);
		$where_traning_certificate = array('user_email'=>$udetails->email,'issue_from' => 'Training','certificate_identify'=>0);

		/************************* GET SPECIFIC CERTIFICATE ************************/
		$get_specific_certificate = $this->landing->get_result_array($this->tbl_user_certificate,'','',$where2);

		/************************* GET GERNAL CERTIFICATE ************************/
		$get_general_certificate = $this->landing->get_result_array($this->tbl_user_certificate,'','',$where3);		


		/************************* GET Online CERTIFICATE ************************/	
		$get_online_certificate = $this->landing->get_result_array($this->tbl_user_certificate,'','',$where_online_certificate);


		/************************* GET TRANING CERTIFICATE ************************/
		$get_traning_certificate = $this->landing->get_result_array($this->tbl_user_certificate,'','',$where_traning_certificate);		

		/************************** This is for get certificate unite sum ************/
		$field = 'units';
		$group_by = 'user_email';
		$where = array('user_email'=>$udetails->email,'certificate_identify'=>0);
		$unit_obtain = $this->landing->get_result_group_by($this->tbl_user_certificate,$field,$group_by,$where);
		/************************** This is for get certificate SPECIFIC sum ************/
		$group_by2 = 'user_email,category';
		$specific_unit_obtain = $this->landing->get_result_group_by($this->tbl_user_certificate,$field,$group_by2,$where2);
		

		/************************** This is for get certificate GERNAL sum ************/
		$gernal_unit_obtain = $this->landing->get_result_group_by($this->tbl_user_certificate,$field,$group_by2,$where3);

		/********************************** Total NEEDED Unit ****************************/
		if($profdetails!="" && $unit_obtain!="")
		{
			$balanced = ($unit_obtain->certificate_unit_count - $profdetails->required_units);
			if($balanced > 0){
				$balanced = '+'.$balanced;
			}
		}

		/********************************** Total needed SPECIFIC ****************************/
		if($profdetails!="" && $specific_unit_obtain!="")
		{
			$specific_balanced = ($specific_unit_obtain->certificate_unit_count - $profdetails->specific_units);
			if($specific_balanced > 0){
				$specific_balanced = '+'.$specific_balanced;
			}
		}		

		/********************************** Total needed GERNAL ****************************/
		if($profdetails!="" && $gernal_unit_obtain!="")
		{
			$gernal_balanced = ($gernal_unit_obtain->certificate_unit_count - $profdetails->general_units);
			if($gernal_balanced > 0){
				$gernal_balanced = '+'.$gernal_balanced;
			}
			
		}		

		}

		$this->data = array( 
			'title'  			=> 'Required units',
			'udetails'  		=> $udetails,
			'profession'  		=> $profdetails,
			'unit_obtain' 		=> $unit_obtain,
			'specific_obtain' 	=> $specific_unit_obtain,
			'gernal_obtain' 	=> $gernal_unit_obtain,
			'balanced' 			=>  $balanced,
			'specific_balanced' => $specific_balanced,
			'gernal_balanced' 	=> $gernal_balanced,
			'get_all_certificate' => $get_all_certificate,
			'get_specific_certificate'=>$get_specific_certificate,
			'get_general_certificate' => $get_general_certificate,
			'get_online_certificate' => $get_online_certificate,
			'get_traning_certificate' => $get_traning_certificate,
			'user_id' 			=> $user_id,
			'user_view' 		=>$user_view,
			'view' 				=> $view
		);

		$this->load->view('include/header',$this->data);
		$this->load->view('required_units',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function add_certificate()
	{
		if(!$this->session->userdata('professioanl_renew')){
			redirect(base_url('license/landing/professional_license')); die();
		}
		if($this->input->post('save')=='SAVE' || $this->input->post('update')=='SUBMIT')
		{
			$this->load->library('upload');
			if(isset($_FILES["certificate"]) && !empty($_FILES["certificate"]['name'])){
				$config['upload_path'] = './assets/uploads/certificate/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docs';   
				$ext = explode('.',$_FILES["certificate"]["name"]);    
				$imageName = 'CERTIFICATE_'.time().'.'.end($ext);
				$config['file_name'] = $imageName;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('certificate')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
				$insert['certificate'] = $imageName;
			}
			$_POST 			= $this->input->post();
			
			if(isset($_POST['id']) && empty($_POST['id'])){
				$result = $this->landing->is_unique_certficate($_POST['certi_no']);
				if(count($result) > 0){
					$this->session->set_flashdata('response','<div class="alert alert-danger">You have uploaded this certificate already.</div>');
					redirect(base_url('license/landing/required_units/').base64_encode($_POST['user_id']));  die();
				}
			}

			$udetails 		= $this->landing->fetch_user_details($_POST['user_id']);
			if(count($udetails) < 1){
				$udetails 		= $this->applicant->fetch_graduate_details($_POST['user_id']);
			}
			
			$insert['certificate_id']= $_POST['certi_no'];
			$insert['course_name'] 	= $_POST['course_name'];
			$insert['units'] 		= $_POST['course_unit'];
			$insert['issue_date'] 	= $_POST['course_start_date'];
			$insert['category'] 	= $_POST['category'];
			$insert['issue_from'] 	= $_POST['issue_from'];
			$insert['issue_by'] 	= $_POST['issue_by'];
			$insert['web_link'] 	= $_POST['web_link'];
			$insert['user_id'] 		= $_POST['user_id'];
			$insert['user_email'] 	= $udetails->email;	
			// $insert['submitted'] 	= 'n';
			$insert['status'] 		= 0;
			$insert['certificate_identify'] = 0;

			if(isset($_POST['id']) && !empty($_POST['id'])){
				$last_id = $this->landing->update($this->tbl_user_certificate,$insert,'id',$_POST['id']);
			}else{
				$last_id = $this->landing->insert($this->tbl_user_certificate,$insert);
			}

			if($last_id){
				$this->session->set_flashdata('response','<div class="alert alert-success" role="alert">Certificate added successfully!</div>');
			}else{
				$this->session->set_flashdata('response','<div class="alert alert-danger" role="alert">Something went wrong, please try again!</div>');
			}
			redirect(base_url('license/landing/required_units/').base64_encode($_POST['user_id']));
		}

	}
	
	function get_one_certificate(){
		$id = $this->input->post('id');
		$uid = $this->input->post('uid');
		$result = $this->landing->fetch_one_certificate($id,$uid);
		echo json_encode($result);
	}
	function deletecertificate($id,$uid){
		$del = $this->landing->delete_uploded_certificate($uid,$id);
		if($del){
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Certificate Deleted.</div>');
		} else {
			$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
		}
		redirect(base_url('license/landing/required_units/').base64_encode($uid));
	}

	public function verificatiom_of_contiuning()
	{
		if(!$this->session->userdata('professioanl_renew')){
			redirect(base_url('license/landing/professional_license')); die();
		}
		// $user_id 	= $this->session->userdata('user_ID');
		$user_id 	= base64_decode($this->uri->segment(4));
		$user_view  = $this->input->get('user_view');
		$view 	 	= $this->input->get('view');
		$udetails  = $this->landing->fetch_user_details($user_id);

		if(!empty($udetails)) {
			/************************ GET TOTAL VERIFIED CERTIFICATE *******************/
			$get_total_verified_certified = $this->landing->get_verified_certificate($user_id,1);
				if(isset($get_total_verified_certified) && !empty($get_total_verified_certified) ){ 
					$verified_certified = count($get_total_verified_certified); 
				}else{ 
					$verified_certified = 0; 
				} 

			/************************ GET TOTAL NOT VERIFIED CERTIFICATE *******************/	
			$get_total_not_verified_certified = $this->landing->get_verified_certificate($user_id,2);	
			if(isset($get_total_not_verified_certified) && !empty($get_total_not_verified_certified) ){ 
				$unverified_certified = count($get_total_not_verified_certified); 
			}else{ 
				$unverified_certified = 0; 
			}

			/*********************** GET ALL GERTIFICATE *******************************/
			$join = array('tbl_existing_certificate');
			$where1 = array('user_email'=>$udetails->email);

			$get_all_certificate = $this->landing->get_verified_unverified_certificate($this->tbl_user_certificate,$where1,$join);

			$where2 = array('user_email'=>$udetails->email,'category' => 'specific','certificate_identify'=>0);
			$where3 = array('user_email'=>$udetails->email,'category' => 'general','certificate_identify'=>0);

			$where_online_certificate = array('user_email'=>$udetails->email,'issue_from' => 'Online Course','certificate_identify'=>0);
			$where_traning_certificate = array('user_email'=>$udetails->email,'issue_from' => 'Training','certificate_identify'=>0);

			/************************* GET SPECIFIC CERTIFICATE ************************/
			$where2 = array('user_email'=>$udetails->email,'category'=>'specific','certificate_identify'=>0);	
			$get_specific_certificate = $this->landing->get_verified_unverified_certificate($this->tbl_user_certificate,$where2,$join);

			/************************* GET GERNAL CERTIFICATE ************************/
			$get_general_certificate = $this->landing->get_verified_unverified_certificate($this->tbl_user_certificate,$where3,$join);		

			/************************* GET Online CERTIFICATE ************************/
			$get_online_certificate = $this->landing->get_verified_unverified_certificate($this->tbl_user_certificate,$where_online_certificate,$join);

			/************************* GET TRANING CERTIFICATE ************************/
			$get_traning_certificate = $this->landing->get_verified_unverified_certificate($this->tbl_user_certificate,$where_traning_certificate,$join);
			
		}

		$this->data = array( 
			'get_all_certificate' 		=> $get_all_certificate,
			'get_specific_certificate'	=> $get_specific_certificate,
			'get_general_certificate' 	=> $get_general_certificate,
			'get_online_certificate' 	=> $get_online_certificate,
			'get_traning_certificate' 	=> $get_traning_certificate,
			'get_total_verified_certified' 	   => $verified_certified,
			'get_total_not_verified_certified' => $unverified_certified,
			'user_view' 				=> $user_view,
			'user_id' 					=> $user_id,
			'view' 						=> $view,
		);

		$this->load->view('include/header',$this->data);
		$this->load->view('verification_of_continuing',$this->data);
		$this->load->view('include/footer',$this->data);

	}

	public function submit_certificate(){
		$uid = $this->input->post('uid');
		$cid = $this->input->post('value');
		$cidArr = explode(',',$cid);
		$counter = count($cidArr);
		$ismatched = 0;
		
		for($i=0;$i<$counter;$i++){
			$ismatched = $this->landing->matchCertificate($cidArr[$i],$uid);
			if($ismatched > 0){
				$data['certificate_identify'] = 1;
				$this->landing->update('tbl_existing_certificate',$data,'id',$ismatched);
			}else{
				$data['certificate_identify'] = 2;
			}
			
			$data['submitted'] = 'y';
			$result = $this->landing->update('tbl_user_certificate',$data,'id',$cidArr[$i]);
		}

		$verified = $this->landing->get_verified_certificate($uid,1);	
		$unverified = $this->landing->get_verified_certificate($uid,2);

		$getlatest = array(
			'verified'=>$verified,
			'unverified'=>$unverified,
		); 
		if($verified > 0 && $unverified == 0){
			$_SESSION['all_certicates_verified'] = true;
			$_SESSION['all_certicates_id'] = $cid;
		}
		echo json_encode($getlatest);
	}

	function getprice(){
		$chargeid 			= $_POST['chargeid'];
		$charges_for 		= $_POST['charges_for'];
		$data['chargesarr'] = $this->common_model->getcharges($chargeid,$charges_for);
		$charge 			= $data['chargesarr']->charge; 
		$settingarr 		= $this->common_model->get_setting('1');
		$tax 				= $settingarr->tax;
		$tax_amount 		= $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}

	public function payment()
	{ 
		if(!$this->session->userdata('professioanl_renew')){
			redirect(base_url('license/landing/professional_license')); die();
		}
		// $user_id 	= $this->session->userdata('user_ID');
		$user_id 	= base64_decode($this->uri->segment(4));

		$this->data['user_details'] = $this->Master_m->get_user_details($user_id);
		$this->data['user_id'] 		= $this->session->userdata('user_ID');
		$this->data['user_view'] 	= $this->input->get('user_view');
		$this->data['view'] 		= $this->input->get('view');
		$this->data['chargesarr'] 	= $this->common_model->certificatechargesarr('renewal_of_professional_registration');
		$this->data['settingarr'] 	= $this->common_model->get_setting('1');

		$this->load->view('include/header',$this->data);
		$this->load->view('payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	
	function paypal_payment(){ 
		if(!$this->session->userdata('professioanl_renew')){
			redirect(base_url('license/landing/professional_license')); die();
		}
		if($_POST['submit'] == "paynow"){
			$this->form_validation->set_rules('duration', 'License period', 'trim|required');
		
			if($this->form_validation->run() == TRUE){

				if(isset($_SESSION['all_certicates_verified']) && isset($_SESSION['all_certicates_id']) && $_SESSION['all_certicates_verified']== true && $_SESSION['all_certicates_id'] != ''){
					$returnURL = base_url().'license/landing/paymentsuccesswithcard'; //payment success with direct license card 
				}else{
					$returnURL = base_url().'license/landing/paymentsuccess'; //payment success url
				}
				$cancelURL = base_url().'license/landing/paymentcancel'; //payment cancel url
				$notifyURL = base_url().'license/landing/paymentipn'; //ipn url

				$post 			= $this->input->post();
				$userID 		= $post['user_id']; 
				
				$certdeta = $this->common_model->get_certificatechargedetails($post['duration']);
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$doentry = array();
				$doentry['user_id'] 	= $userID;
				$doentry['expiry_at'] 	= $expiry_at;
				$doentry['renew_for'] 	= $certdeta->duration;
				$doentry['document_for']= 'r';
				$doentry['added_on'] 	= date('Y-m-d H:i:s');
				$pdgetid = $this->applicant->insert('tbl_professional_documents',$doentry);

				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $userID;
				$paymentdata['doc_refrence_id'] = $pdgetid;
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $post['amount'];
				$paymentdata['payment_tax'] 	= $post['taxamt'];
				$paymentdata['payment_gross'] 	= $post['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= $post['payment_for'];
				$paymentdata['payment_type'] 	= 'R';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			
			// Add fields to paypal form
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name_1', 'Renewal of Professional Registration Payment');
			$this->paypal_lib->add_field('item_number_1', $lastpaymentid);
			$this->paypal_lib->add_field('amount_1',  $post['total']);
			$this->paypal_lib->add_field('custom', $userID);
			$this->paypal_lib->add_field('quantity_1' ,1);
			$this->paypal_lib->add_field('lc' ,'US');
			$this->paypal_lib->add_field('upload' ,'1');
			$this->paypal_lib->add_field('cbt' ,'Return to The Store');
			
			// Render paypal form
			$this->paypal_lib->paypal_auto_form();
			}else{
				validation_errors();
				// $user_id 	= $this->session->userdata('user_ID');
				$user_id 	= base64_decode($this->uri->segment(4));
				$this->data['user_details'] = $this->Master_m->get_user_details($user_id);
				$this->data['user_id'] 		= $this->session->userdata('user_ID');
				$this->data['user_view'] 	= $this->input->get('user_view');
				$this->data['view'] 		= $this->input->get('view');
				$this->data['chargesarr'] 	= $this->common_model->certificatechargesarr('renewal_of_professional_registration');
				$this->data['settingarr'] 	= $this->common_model->get_setting('1');
		
				$this->load->view('include/header',$this->data);
				$this->load->view('payment',$this->data);
				$this->load->view('include/footer',$this->data);
			}
		} //paynow close		
	}

	public function paymentsuccesswithcard(){

		$paypalInfo = $this->input->post();
		// echo '<pre>'; print_r($paypalInfo);die;

		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		$this->common_model->update_payment($data,$item_number);
	
		$data['details']=$this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);	
		// print_r($getuserid);
			
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'2',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);

		$settingarr = $this->common_model->get_setting('1');
		$professdatails = $this->landing->get_professional_details($getuserid->user_id);
		$docdatails = $this->landing->get_row_object('tbl_professional_documents','pd_id',$getuserid->doc_refrence_id);

		$updateprof = array();	
		// $updateprof['reviewer_id'] 		 = $this->session->userdata('login')['user_ID'];
		// $updateprof['review_date']  		 = date('Y-m-d H:i:s');
		// $updateprof['review_accept_date'] = date('Y-m-d H:i:s');
		$userid 	= $getuserid->user_id;
		$bytes 		= random_bytes(3); 
		$refcode 	= bin2hex($bytes);
		$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');
		
		//generate card_qrcode
		$qr_image = 'qrcode_'.$proRefCode.'.png';
		$qr_url = base_url('assets/uploads/pdf/'.$proRefCode.'card.pdf');
		$params['data'] = $qr_url;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = './assets/qrcode/'.$qr_image;
		$this->ciqrcode->generate($params);

		$docdata = array();

		$updateprof['refrence_code'] = $proRefCode;
		$updateprof['lic_issue_date'] 	= date('Y-m-d H:i:s');
		$updateprof['license_no'] 		= $professdatails->license_no;
		$updateprof['reviewer_status']  = '1';
		$updateprof['updated_at']  		= date('Y-m-d H:i:s');
		$updateprof['status']  			= 1;
		$updated = $this->applicant->updateprofdoc($updateprof,$getuserid->doc_refrence_id);

		// $updateproflicno['license_no'] 		= $professdatails->license_no;
		$updateproflicno['lic_issue_date'] 	= date('Y-m-d H:i:s');
		$updateproflicno['lic_expiry_date'] = $docdatails->expiry_at;
		$updateproflicno['card_qrcode']     = $qr_image;
		$updateproflicno['updated_at'] 		= date('Y-m-d H:i:s');
		$updatedpro = $this->applicant->updateproflicno($updateproflicno,$userid);
		// echo $this->db->last_query();die();
		unset($_SESSION['all_certicates_verified']);
		unset($_SESSION['all_certicates_id']);

		if($updated){
			//1st pdf for card
			$html=$this->getprofreg_card_pdf($userid,$professdatails->candidate_type);
			// Get output html
			$this->load->library('Pdf');
			$this->dompdf = new DOMPDF();
			$this->dompdf->load_html($html);
			
			$this->dompdf->set_paper('A4','portrait');
			$this->dompdf->render();
			file_put_contents('assets/uploads/pdf/'.$proRefCode.'card.pdf', $this->dompdf->output($html));
			// $this->dompdf->stream('card.pdf', array('Attachment' => 0));die;
		
								
			$etcdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">
			You have successfully renew your professonal license. Please search the refrence number into the given link to find the license.    
			<br><a href="'.base_url('license/search').'">click here to search.</a></p>
			<br><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">
			<ul>
				<li>
					Refrence Number: '.$proRefCode.'
				</li>
				<li>
					License Number: '.$professdatails->license_no.'
				</li>
			</ul> </p>';

			$bodycontentforCode = $etcdetails.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have any question please message us and we will be happy to assist you. </p>';
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
			$this->email->to($professdatails->email);
			$this->email->subject('Renewed Professional License');
			$emailbody 					= array();
			$emailbody['name'] 			= $professdatails->fname.' '.$professdatails->lname.' '.$professdatails->name;
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 		= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
			$this->email->message($emailmessage);
			if(isset($proRefCode) && file_exists('assets/uploads/pdf/'.$proRefCode.'card.pdf')){
				$this->email->attach(base_url('assets/uploads/pdf/'.$proRefCode.'card.pdf'));
			}
			$this->email->send();
			$updatenotification 				= array();
			$updatenotification['user_id'] 		= $professdatails->user_id;
			$updatenotification['subject'] 		= 'Renewed Professional License';
			$updatenotification['message'] 		= $bodycontentforCode;
			$updatenotification['from'] 		= SENDER_NAME;
			$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
			$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
			$this->applicant->insertnotifications($updatenotification); 
			
		}
		
		$this->data = array('title'=> 'Renewed Professional License');
		$data['profes_details'] = $proRefCode;
		// echo $this->db->last_query(); die();
		$this->load->view('include/header',$this->data);
		$this->load->view('license/renewed_license',$data);
		$this->load->view('include/footer',$this->data);

	}

	public function paymentsuccess(){
		// Get the transaction data
		// if(!$this->session->userdata('professioanl_renew')){
		// 	redirect(base_url('license/landing/professional_license')); die();
		// }
		$paypalInfo = $this->input->post();
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		$this->common_model->update_payment($data,$item_number);
		
		$data['details']=$this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);	
		echo $this->db->last_query();
		// print_r($getuserid);die;	
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid['doc_refrence_id'],
			'res_id'			=>	'2',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);
		unset($_SESSION['professioanl_renew']);
		// $this->session->unset_userdata('professioanl_renew');
		// $this->session->sess_destroy();
		
		$userid 	= $getuserid->user_id;
		$bytes 		= random_bytes(3); 
		$refcode 	= bin2hex($bytes);
		$proRefCode = 'PRO-'.$userid.$refcode.'-'.date('Y');
		$docdata = array();
		$docdata['refrence_code'] = $proRefCode;
		$docdata['updated_at'] = date('Y-m-d H:i:s');
		$this->applicant->updateprofdoc($docdata,$getuserid->doc_refrence_id);
		$payment_for = $getuserid->payment_for;

		if($payment_for=='PR'){
			$userdetails = $this->applicant->fetch_user_details($getuserid->user_id,$getuserid->doc_refrence_id);
		}else{
			$userdetails = $this->applicant->fetch_graduate_details($getuserid->user_id);
		}
		
		$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Renewal of Professional Registration has been Done.<br><br>Please '.$serachlink.' to check the status of your application <br>and use this Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would be happy to assist you.</p>';
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
			if($userdetails){
				//send refrence code 
				$settingarr = $this->common_model->get_setting('1');
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Renewal of Professional Registrtion');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				//end send refrence code 

				//2nd email
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 		= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();

				$updatenotification 				= array();
				$updatenotification['user_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Renewal of Professional Registrtion';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->applicant->insertnotifications($updatenotification); 
			}			
		
		$this->data = array('title'=> 'Review of Certificates');
		$data['profes_details'] = $this->landing->fetch_doc_details($getuserid->doc_refrence_id);
		// echo $this->db->last_query(); die();
		$this->load->view('include/header',$this->data);
		$this->load->view('license/review_doc',$data);
		$this->load->view('include/footer',$this->data);
			// redirect(base_url('license/landing/review_doc',json_encode($profdetailsarr->user_ID)), 'refresh');

	}

	public function paymentcancel(){
		// if(!$this->session->userdata('user_ID')){
		// 	redirect(base_url('professional/applicant/login'), 'refresh');
		// }
		redirect(base_url('license/landing/payment'), 'refresh');
	}
	public function paymentipn(){
		// if(!$this->session->userdata('user_ID')){
		// 	redirect(base_url('professional/applicant/login'), 'refresh');
		// }
		redirect(base_url('license/landing/payment'), 'refresh');
	}


	function review_doc($doc_id){
		$this->data = array('title'=> 'Review of Certificates');
		$data['profes_details'] = $this->landing->fetch_doc_details(base64_decode($doc_id));
		$this->load->view('include/header',$this->data);
		$this->load->view('review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}



	public function digital_professional()
	{
		// $user_id =  $this->session->userdata('user_ID');
		$user_id 	= base64_decode($this->uri->segment(4));
		$user_view = $this->input->get('user_view');
		$view = $this->input->get('view');

		$this->data['user_details'] = $this->Master_m->get_user_details($user_id);
		$udetails = $this->Master_m->get_user_details($user_id);
		if(!empty($udetails))
		{
		/****************    GET TOTAL COUNT OF VERIFIED CERTIFICATE *************************/
		$verified_where = array('user_email'=>$udetails->user_email,'certificate_identify'=>1);
		$this->data['verified_certified'] = $this->landing->count_rows($this->tbl_user_certificate,$verified_where);


		/****************    GET TOTAL COUNT OF UNVERIFIED CERTIFICATE *************************/
		$unverified_where = array('user_email'=>$udetails->user_email,'certificate_identify'=>0);
		$this->data['unverified_certified'] = $this->landing->count_rows($this->tbl_user_certificate,$unverified_where);
		}
		/************************************** Get User Comments *******************************/

		$comment_where  = array('user_id'=>$user_id,'step_id'=>5);
		$user_comments = $this->landing->get_result_array('tbl_license_renewal_comments','','',$comment_where);


		$this->data['user_id'] = $user_id;
		$this->data['user_view'] = $user_view;
		$this->data['view'] = $view;
		$this->data['user_comments'] = $user_comments;

		//echo "<pre>"; print_r($this->data['unverified_certified']); exit;

		$this->load->view('include/header',$this->data);
		$this->load->view('digital_professional',$this->data);
		$this->load->view('include/footer',$this->data);	
	}

	public function paypal()
	{
		$this->load->view('paypal',$this->data);
	}
	public function certificate_pdf()
	{
		$user_id = $this->input->get('user_id');
		$this->data['user_details'] = $this->Master_m->get_user_details($user_id);
		$html = $this->load->view('certificate_pdf',$this->data,TRUE);
		$name = 'Certificate.pdf';
		//$this->variablebilling->generate_pdf($html, $name);
		$this->variablebilling->generate_pdf($html, $name);
	}


	public function add_comments()
	{
		$license_comments = $this->input->post('license_comments');
		$user_id = $this->input->post('user_id');
		$step_id = $this->input->post('step_id');

		if($license_comments)
		{
			$data = array(

				'comments'=>$license_comments,
				'user_id' => $user_id,
				'step_id' => $step_id

			);

			//print_r($data); exit;

			$last_id = $this->landing->insert('tbl_license_renewal_comments',$data);
			if($last_id)
			{
				echo  $last_id;
			}
			echo ""; 
		}
	}


	public function getOneCTDetail(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		if($type='c'){
			$data['result'] = $this->courses_model->deatils($id);
		}
		if($type='t'){
			$data['result'] = $this->training_model->deatils($id);
		}
		echo json_encode($data);
		// $this->load->view('onedetail',data);
	}

	function getprofreg_card_pdf($userid,$payment_for){
		$data['profes_details'] = new \stdClass();
		if($payment_for=='p'){
			$userdetails = $this->applicant->fetch_user_details($userid);
			$candidate_type = 'p';
		}else{
			$candidate_type = 'g';
			$userdetails = $this->applicant->fetch_graduate_details($userid);
		}
		$license_details = $this->applicant->get_one_professional_license($userid,$candidate_type);
		// print_r($license_details);die;
		$data['profes_details']->license_no = $license_details->license_no; 
		$data['profes_details']->lic_issue_date = $license_details->lic_issue_date; 
		$data['profes_details']->validity_date = $license_details->lic_expiry_date; 
		//$data['profes_details']->fullname = $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
		//$data['profes_details']->fullname = $userdetails->fullname;
		$data['profes_details']->card_qrcode = $license_details->card_qrcode;
		$data['profes_details']->fname = $userdetails->fname;
		$data['profes_details']->lname = $userdetails->lname;
		$data['profes_details']->name = $userdetails->name;
		$data['profes_details']->profession_name = $userdetails->profession_name;
		$data['profes_details']->image = $userdetails->image;
		$result = $this->load->view('professional/include/profregisteration_card_pdf_preview',$data, TRUE);
		return $result;
	}

}

?>