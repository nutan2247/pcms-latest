<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

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
		$this->data = array('title'=> 'Welcome in Regulatry Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('landing',$this->data);
		$this->load->view('include/footer',$this->data);
		
	}

	public function professional_license(){
		$this->data = array('title'=> 'Professional License Renewal');

		if($this->input->post('submit')=='submit')
		{
			$this->form_validation->set_rules('name', 'Username', 'required');
			$this->form_validation->set_rules('birthday', 'DOB', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('profession', 'Profession', 'required');
			$this->form_validation->set_rules('license_number', 'License number', 'required');

			$this->form_validation->set_rules('date_issued', 'Date issued', 'required');
			$this->form_validation->set_rules('validity', 'Validity', 'required');
			if($this->form_validation->run() == TRUE)
			{
				$_POST = $this->input->post();
				$name = $_POST['name'];
				$birthday = $_POST['birthday'];
				$citizenship = $_POST['citizenship'];
				$gender = $_POST['gender'];
				$address = $_POST['address'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$profession = $_POST['profession'];
				$license_number = $_POST['license_number'];
				$validity = $_POST['validity'];

				$date_issued = 	$_POST['date_issued'];


				$where = array(
							'name'=>$name,
							'dob' => $birthday,
							'gender' => $gender,
							'email' => $email,
							'phone'=>$phone,
							'profession' => $profession,
							'license_no' => $license_number,
							'license_validity_date' => $validity,
							'added_on' => $date_issued

						);
				



				$user_exsits = $this->landing->get_result_arrays('tbl_users','','',$where);

				if(!empty($user_exsits)){
					
					$this->data['udetails'] = $user_exsits;
					
				}else{
					$this->data['udetails_not_match'] = 1;
				}

			}else{

				validation_errors();
			}
		}


		$this->load->view('include/header',$this->data);
		$this->load->view('license_form',$this->data);
		$this->load->view('include/footer',$this->data);
	}


	

	public function update_photo(){
		$photo = '';
		if($this->input->post('submit')=='submit')
		{



			$uid = $this->input->get('user_id');

			//echo $uid; exit;
			//$uemail = 'professional@gmail.com';
		if(!empty($_FILES["photo"]['name'])){
			$config['upload_path']="./assets/images/profile/";
			$config['allowed_types']='gif|jpg|png';
			$this->upload->initialize($config);

			if($this->upload->do_upload("photo")){
				$filedata = array('upload_data' => $this->upload->data());
				$photo = $filedata['upload_data']['file_name'];
				$ext = explode('.',$photo);
				$profileimage = time().'.'.end($ext);
				
				$tConfig['image_library'] 	= 'gd2';
				$tConfig['source_image'] 	= './assets/images/profile/'.$photo;
				$tConfig['new_image'] 		= './assets/images/profile/'.$profileimage;
				$tConfig['create_thumb'] 	= TRUE; //these features will help to reduse the size of image
				$tConfig['maintain_ratio'] 	= TRUE;
				$tConfig['width']         	= 300;
				$tConfig['height']       	= 300;
				$this->load->library('image_lib', $tConfig);
				$this->image_lib->resize();
				$file_info = pathinfo($tConfig['new_image']);
				// print_r($file_info);
				if($file_info['basename'] != ''){
					unlink('assets/images/profile/'.$photo);
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

		// echo 'required_units';die;
		$balanced = "";
		$specific_balanced = "";
		$gernal_balanced = "";
		$user_id =  $this->input->get('user_id');
		$udetails = $this->landing->fetch_user_details($user_id);
		//print_r($udetails); die;
		
		// $profdetails = $this->landing->get_row_object('tbl_profession','id',$udetails->profession);
		$profdetails = $this->landing->get_row_object('tbl_profession','id',$udetails->profession);


		/*********************** GET ALL GERTIFICATE *******************************/

		$get_all_certificate = $this->landing->get_result_array('tbl_existing_certificate','user_id',$user_id);



		$where2 = array('user_id'=>$user_id,'category' => 'specific');
		$where3 = array('user_id'=>$user_id,'category' => 'general');

		$where_online_certificate = array('user_id'=>$user_id,'issue_from' => 'Online Course');
		$where_traning_certificate = array('user_id'=>$user_id,'issue_from' => 'Training');

		/************************* GET SPECIFIC CERTIFICATE ************************/

	$where2 = array('user_id'=>$user_id,'category'=>'specific');	
	$get_specific_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where2);

		/************************* GET GERNAL CERTIFICATE ************************/

	
	$get_general_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where3);		


	/************************* GET Online CERTIFICATE ************************/

	
	$get_online_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where_online_certificate);


	/************************* GET TRANING CERTIFICATE ************************/

	
	$get_traning_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where_traning_certificate);		

		//echo "<pre>"; print_r($get_specific_certificate); exit;

		/************************** This is for get certificate unite sum ************/
		$field = 'units';
		$group_by = 'user_id';
		$where = array('user_id'=>$user_id);
		$unit_obtain = $this->landing->get_result_group_by('tbl_existing_certificate',$field,$group_by,$where);

		/************************** This is for get certificate SPECIFIC sum ************/

		$group_by2 = 'user_id,category';

		$specific_unit_obtain = $this->landing->get_result_group_by('tbl_existing_certificate',$field,$group_by2,$where2);
		

		/************************** This is for get certificate GERNAL sum ************/

		
		
		$gernal_unit_obtain = $this->landing->get_result_group_by('tbl_existing_certificate',$field,$group_by2,$where3);
		//echo "<pre>"; print_r($gernal_unit_obtain); exit;

		/********************************** Total NEEDED Unit ****************************/

			if($profdetails!="" && $unit_obtain!="")
			{
				$balanced = ($profdetails->required_units-$unit_obtain->certificate_unit_count);
			}
	/********************************** Total needed SPECIFIC ****************************/

			if($profdetails!="" && $specific_unit_obtain!="")
			{
				$specific_balanced = ($profdetails->specific_units-$specific_unit_obtain->certificate_unit_count);
			}		

	/********************************** Total needed GERNAL ****************************/

			if($profdetails!="" && $specific_unit_obtain!="")
			{
				$gernal_balanced = ($profdetails->general_units-$gernal_unit_obtain->certificate_unit_count);
			}		

		

		$this->data = array( 
			'title'  => 'Required units',
			'udetails'  => $udetails,
			'profession'  => $profdetails,
			'unit_obtain' => $unit_obtain,
			'specific_obtain' => $specific_unit_obtain,
			'gernal_obtain' => $gernal_unit_obtain,
			'balanced' =>  $balanced,
			'specific_balanced' => $specific_balanced,
			'gernal_balanced' => $gernal_balanced,
			'get_all_certificate' => $get_all_certificate,
			'get_specific_certificate'=>$get_specific_certificate,
			'get_general_certificate' => $get_general_certificate,
			'get_online_certificate' => $get_online_certificate,
			'get_traning_certificate' => $get_traning_certificate,
			'user_id' => $user_id
		);

		

		$this->load->view('include/header',$this->data);
		$this->load->view('required_units',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function add_certificate()
	{
		if($this->input->post('save')=='SAVE')
		{
				$_POST = $this->input->post();

				$certi_no = $_POST['certi_no'];
				$course_name = $_POST['course_name'];
				$course_unit = $_POST['course_unit'];
				$course_start_date = $_POST['course_start_date'];
				$category = $_POST['category'];
				$issue_from = $_POST['issue_from'];
				$issue_by = $_POST['issue_by'];
				
				$user_id = $_POST['user_id'];	
				$data = array(

					'user_id' => $user_id, 
					'certificate_id'=> $certi_no,
					'course_name'=>$course_name,
					'units' => $course_unit,
					'issue_date' => $course_start_date,
					'category' => $category,
					'issue_from' => $issue_from,
					'issue_by' => $issue_by
				);

				$last_id = $this->landing->insert('tbl_existing_certificate',$data);
				redirect(base_url('landing/required_units?user_id='.$user_id));
		}
	
	}
	public function verificatiom_of_contiuning()
	{
		$user_id = $this->input->get('user_id');

		

		/************************ GET TOTAL VERIFIED CERTIFICATE *******************/
		$get_total_verfied_where = array('certificate_identify'=>1,'user_id'=>$user_id);
		$get_total_verified_certified = $this->landing->count_rows('tbl_existing_certificate',$get_total_verfied_where);


		/************************ GET TOTAL NOT VERIFIED CERTIFICATE *******************/
		$get_total_not_verfied_where = array('certificate_identify'=>0,'user_id'=>$user_id);
		$get_total_not_verified_certified = $this->landing->count_rows('tbl_existing_certificate',$get_total_not_verfied_where);		

		/*********************** GET ALL GERTIFICATE *******************************/

		$get_all_certificate = $this->landing->get_result_array('tbl_existing_certificate','user_id',$user_id);



		$where2 = array('user_id'=>$user_id,'category' => 'specific');
		$where3 = array('user_id'=>$user_id,'category' => 'general');

		$where_online_certificate = array('user_id'=>$user_id,'issue_from' => 'Online Course');
		$where_traning_certificate = array('user_id'=>$user_id,'issue_from' => 'Training');

		/************************* GET SPECIFIC CERTIFICATE ************************/

	$where2 = array('user_id'=>$user_id,'category'=>'specific');	
	$get_specific_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where2);

		/************************* GET GERNAL CERTIFICATE ************************/

	
	$get_general_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where3);		


	/************************* GET Online CERTIFICATE ************************/

	
	$get_online_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where_online_certificate);


	/************************* GET TRANING CERTIFICATE ************************/

	
	$get_traning_certificate = $this->landing->get_result_array('tbl_existing_certificate','','',$where_traning_certificate);
	


		$this->data = array( 
			
		
			
			'get_all_certificate' => $get_all_certificate,
			'get_specific_certificate'=>$get_specific_certificate,
			'get_general_certificate' => $get_general_certificate,
			'get_online_certificate' => $get_online_certificate,
			'get_traning_certificate' => $get_traning_certificate,
			'get_total_verified_certified' => $get_total_verified_certified,
			'get_total_not_verified_certified' => $get_total_not_verified_certified
		);

		

		$this->load->view('include/header',$this->data);
		$this->load->view('verification_of_continuing',$this->data);
		$this->load->view('include/footer',$this->data);

	}
	public function payment()
	{
		$this->load->view('include/header',$this->data);
		$this->load->view('payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function digital_professional()
	{
		$this->load->view('include/header',$this->data);
		$this->load->view('digital_professional',$this->data);
		$this->load->view('include/footer',$this->data);	
	}

	
	
	
	

}

?>