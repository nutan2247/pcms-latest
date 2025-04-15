<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/** Reviewer Login controller **/

class Reviewer extends MX_Controller {

	var $data = array();
	public $rbcode;
	public $rbname;
	public function __construct(){
		parent:: __construct();
		
		$this->load->model('Reviewer_payment_model','reviewer_payment');
		$this->load->model('professional/Applicant_model','applicant');
		$subscription = $this->common_model->get_admin_subscription_details();
		// if($subscription->rb_sub_key == ""){
		// 	//go to contcat for admin with form details
		// 	$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
		// 	redirect(base_url('contactus'), 'refresh');		
		// }
// 		$this->rbcode = $subscription->rb_code;
// 		$this->rbname = $subscription->rb_name;

		$this->load->library('ciqrcode');
		$this->load->helper('string');
	}

	public function index(){ 
		//redirect(base_url('/reviewe/reviewer/testredirect'),'refresh');
		echo'Dashboard';
		redirect('login', true);
		
	}
	
	public function dashboard(){ 
		$this->data = array(
			'title' => 'Reviewer Dashboard'
		);
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true); 
		} 
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['details'] = $this->reviewer_payment->get_row_object('tbl_admin','user_ID',$uid);

		$this->data['school'] = $this->reviewer_payment->get_school_application('','0','','y');
		$this->data['school_count'] = $this->reviewer_payment->get_school_application(1,'0','','y');

		$this->data['graduates'] = $this->reviewer_payment->get_graduates_apllication('','','0','y');
		$this->data['graduates_count'] = $this->reviewer_payment->get_graduates_apllication(1,'','0','y');

		$this->data['fp'] = $this->reviewer_payment->get_fp_application('','0','','y');
		$this->data['fp_count'] = $this->reviewer_payment->get_fp_application(1,'0','','y');	
		
		$this->data['fpexamreg_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,'0','','y');
		$this->data['fpexamreg'] = $this->reviewer_payment->get_fpexam_reg_application('','0','','y');
		$this->data['fpexamreg_for_review_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,3,$uid,'y');
		$this->data['fpexamreg_for_reviewed_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,'r',$uid,'y');
		$this->data['fpexamreg_for_approved_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,1,$uid,'y');
		$this->data['fpexamreg_for_dispproved_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,2,$uid,'y');
		
		$this->data['cep'] = $this->reviewer_payment->get_cep_acc_application('','0','','y');
		// echo '<pre>';
		// echo $this->db->last_query();
		// print_r($this->data['cep']);die;
		$this->data['cep_count'] = $this->reviewer_payment->get_cep_acc_application(1,'0','','y');		
		
		$this->data['course'] 		= $this->reviewer_payment->get_course_acc_application('','0',0,'y');
		$this->data['course_count'] = $this->reviewer_payment->get_course_acc_application(1,'0',0,'y');
		
		$this->data['training'] = $this->reviewer_payment->get_training_acc_application('','0',0,'y');
		$this->data['training_count'] = $this->reviewer_payment->get_training_acc_application(1,'0',0,'y');
				
		// professional renewal 
		$this->data['professional_renewal'] = $this->reviewer_payment->get_professional_renewal_application('','0',0,'y');
		$this->data['professional_renewal_count'] = $this->reviewer_payment->get_professional_renewal_application(1,'0',0,'y');	
		$this->data['professional_review_count'] = $this->reviewer_payment->get_professional_renewal_application(1,3,$uid,'','y');
		$this->data['professional_reviewed_count'] = $this->reviewer_payment->get_professional_renewal_application(1,'r',$uid,'','y');
		$this->data['professional_approved_count'] = $this->reviewer_payment->get_professional_renewal_application(1,1,$uid,'','y');
		$this->data['professional_dispproved_count'] = $this->reviewer_payment->get_professional_renewal_application(1,2,$uid,'','y');	
		// end professional renewal total_graduates_reviewed_count professional_approved_reviewed_count
		// for school
		$this->data['total_school_count'] = $this->reviewer_payment->get_school_application(1,'','','y');
		$this->data['total_school_for_review_count'] = $this->reviewer_payment->get_school_application(1,3,$uid,'y');
		$this->data['total_school_reviewed_count'] = $this->reviewer_payment->get_school_application(1,'r',$uid,'y');
		$this->data['total_school_approved_count'] = $this->reviewer_payment->get_school_application(1,1,$uid,'y');
		$this->data['total_school_dispproved_count'] = $this->reviewer_payment->get_school_application(1,2,$uid,'y');
		// end for school
		// $this->data['total_exam_count'] = $this->reviewer_payment->get_fpexam_application(1,'','','');
		// $this->data['total_exam_for_review_count'] = $this->reviewer_payment->get_fpexam_application(1,3,$uid,'');
		// $this->data['total_exam_reviewed_count'] = $this->reviewer_payment->get_fpexam_application(1,'r',$uid,'');
		// $this->data['total_exam_approved_count'] = $this->reviewer_payment->get_fpexam_application(1,1,$uid,'');
		// $this->data['total_exam_dispproved_count'] = $this->reviewer_payment->get_fpexam_application(1,2,$uid,'');
		
		$this->data['total_fprofesional_count'] = $this->reviewer_payment->get_fp_application(1,'','','y');
		$this->data['total_fprofesional_for_review_count'] = $this->reviewer_payment->get_fp_application(1,3,$uid,'y');
		$this->data['total_fprofesional_reviewed_count'] = $this->reviewer_payment->get_fp_application(1,'r',$uid,'y');
		$this->data['total_fprofesional_approved_count'] = $this->reviewer_payment->get_fp_application(1,1,$uid,'y');
		$this->data['total_fprofesional_dispproved_count'] = $this->reviewer_payment->get_fp_application(1,2,$uid,'y');
		
		$this->data['total_cep_count'] = $this->reviewer_payment->get_cep_acc_application(1,'','','y');
		$this->data['total_cep_for_review_count'] = $this->reviewer_payment->get_cep_acc_application(1,3,$uid,'y');
		$this->data['total_cep_reviewed_count'] = $this->reviewer_payment->get_cep_acc_application(1,'r',$uid,'y');
		$this->data['total_cep_approved_count'] = $this->reviewer_payment->get_cep_acc_application(1,1,$uid,'y');
		$this->data['total_cep_dispproved_count'] = $this->reviewer_payment->get_cep_acc_application(1,2,$uid,'y');
		
		//for graduates 
		$this->data['total_graduates_count'] = $this->reviewer_payment->get_graduates_apllication(1,'','','y'); 
		$this->data['total_graduates_for_review_count'] = $this->reviewer_payment->get_graduates_apllication(1,$uid,3,'y');
		$this->data['total_graduates_reviewed_count'] = $this->reviewer_payment->get_graduates_apllication(1,$uid,'r','y');
		$this->data['total_graduates_approved_count'] = $this->reviewer_payment->get_graduates_apllication(1,$uid,1,'y');
		$this->data['total_graduates_dispproved_count'] = $this->reviewer_payment->get_graduates_apllication(1,$uid,2,'y');
		//end graduates
		
		$this->data['total_course_count'] = $this->reviewer_payment->get_course_acc_application(1,'','','y');
		$this->data['total_course_for_review_count'] = $this->reviewer_payment->get_course_acc_application(1,'0',$uid,'y');
		$this->data['total_course_reviewed_count'] = $this->reviewer_payment->get_course_acc_application(1,'r',$uid,'y');
		$this->data['total_course_approved_count'] = $this->reviewer_payment->get_course_acc_application(1,1,$uid,'y');
		$this->data['total_course_dispproved_count'] = $this->reviewer_payment->get_course_acc_application(1,2,$uid,'y');
		
		$this->data['total_training_count'] = $this->reviewer_payment->get_training_acc_application(1,'','','y');
		$this->data['total_training_for_review_count'] = $this->reviewer_payment->get_training_acc_application(1,'0',$uid,'y');
		$this->data['total_training_reviewed_count'] = $this->reviewer_payment->get_training_acc_application(1,'r',$uid,'y');
		$this->data['total_training_approved_count'] = $this->reviewer_payment->get_training_acc_application(1,1,$uid,'y');
		$this->data['total_training_dispproved_count'] = $this->reviewer_payment->get_training_acc_application(1,2,$uid,'y');

		$this->data['receipient_information'] = $this->reviewer_payment->get_receipient_information('','0',0,'y');
		$this->data['total_receipient_information'] = $this->reviewer_payment->get_receipient_information(1,'0',0,'y');

		$this->data['reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand('','0',0,'y');
		$this->data['total_reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand(1,'0',0,'y');
		// echo $this->db->last_query();die;

		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar',$this->data);
		$this->load->view('reviewer/dashboard',$this->data);
		$this->load->view('reviewer/common/footer',$this->data);
	}

	public function forReview_listing(){
		$this->data = array(
			'title' => 'Govt : For Review Applcaition'
		);
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true); 
		} 
		
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['school'] = $this->reviewer_payment->get_school_application('','0',$uid,'y');
		$this->data['school_count'] = $this->reviewer_payment->get_school_application(1,'0',$uid,'y');

		$this->data['graduates'] = $this->reviewer_payment->get_graduates_apllication('',$uid,'0','y');
		$this->data['graduates_count'] = $this->reviewer_payment->get_graduates_apllication(1,$uid,'0','y');

		$this->data['fp'] = $this->reviewer_payment->get_fp_application('','0',$uid,'y');
		$this->data['fp_count'] = $this->reviewer_payment->get_fp_application(1,'0',$uid,'y');	

		$this->data['cep'] = $this->reviewer_payment->get_cep_acc_application('','0',$uid,'y');
		$this->data['cep_count'] = $this->reviewer_payment->get_cep_acc_application(1,'0',$uid,'y');	

		$this->data['fpexamreg'] = $this->reviewer_payment->get_fpexam_reg_application('','0',$uid,'y');
		$this->data['fpexamreg_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,'0',$uid,'y');
		
		$this->data['professional_renewal'] = $this->reviewer_payment->get_professional_renewal_application('','0',$uid,'y');
		$this->data['professional_renewal_count'] = $this->reviewer_payment->get_professional_renewal_application(1,'0',$uid,'y');		

		$this->data['course'] 		= $this->reviewer_payment->get_course_acc_application('','0',$uid,'y');
		$this->data['course_count'] = $this->reviewer_payment->get_course_acc_application(1,'0',$uid,'y');

		$this->data['training'] = $this->reviewer_payment->get_training_acc_application('','0',$uid,'y');
		$this->data['training_count'] = $this->reviewer_payment->get_training_acc_application(1,'0',$uid,'y');

		$this->data['receipient_information'] = $this->reviewer_payment->get_receipient_information('','0',$uid,'y');
		$this->data['total_receipient_information'] = $this->reviewer_payment->get_receipient_information(1,'0',$uid,'y'); 

		$this->data['reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand('','0',$uid,'y');
		$this->data['total_reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand(1,'0',$uid,'y');
		// echo $this->db->last_query();die;
		

		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar',$this->data);
		$this->load->view('reviewer/forReview_listing',$this->data);
		$this->load->view('reviewer/common/footer',$this->data);
	}

	public function reviewed_listing(){
		$this->data = array(
			'title' => 'Govt : Reviewed Applcaition'
		);
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['school'] = $this->reviewer_payment->get_school_application('','r',$uid,'y');
		$this->data['school_count'] = $this->reviewer_payment->get_school_application(1,'r',$uid,'y');
		// echo $this->db->last_query();die;
		
		$this->data['graduates'] = $this->reviewer_payment->get_graduates_apllication('',$uid,'r','y');
		$this->data['graduates_count'] = $this->reviewer_payment->get_graduates_apllication(1,$uid,'r','y');
		
		// with without exam foreign professional 
		$this->data['fp'] = $this->reviewer_payment->get_fp_application('','r',$uid,'y');
		$this->data['fp_count'] = $this->reviewer_payment->get_fp_application(1,'r',$uid,'y');
		// end with without exam foreign professional 	
		
		$this->data['cep'] = $this->reviewer_payment->get_cep_acc_application('','r',$uid,'y');
		$this->data['cep_count'] = $this->reviewer_payment->get_cep_acc_application(1,'r',$uid,'y');	
		
		// with exam foreign professional 
		$this->data['fpexamreg'] = $this->reviewer_payment->get_fpexam_reg_application('','r',$uid,'y');
		$this->data['fpexamreg_count'] = $this->reviewer_payment->get_fpexam_reg_application(1,'r',$uid,'y');	
		// end with exam foreign professional
		$this->data['professional_renewal'] = $this->reviewer_payment->get_professional_renewal_application('','r',$uid,'y');
		$this->data['professional_renewal_count'] = $this->reviewer_payment->get_professional_renewal_application(1,'r',$uid,'y');	 
		
		$this->data['course'] 		= $this->reviewer_payment->get_course_acc_application('','r',$uid,'y');
		$this->data['course_count'] = $this->reviewer_payment->get_course_acc_application(1,'r',$uid,'y');

		$this->data['training'] = $this->reviewer_payment->get_training_acc_application('','r',$uid,'y');
		$this->data['training_count'] = $this->reviewer_payment->get_training_acc_application(1,'r',$uid,'y');
		
		$this->data['receipient_information'] = $this->reviewer_payment->get_receipient_information('','a',$uid,'y');
		$this->data['total_receipient_information'] = $this->reviewer_payment->get_receipient_information(1,'a',$uid,'y');

		$this->data['reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand('','a',$uid,'y');
		$this->data['total_reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand(1,'a',$uid,'y');
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar',$this->data);
		$this->load->view('reviewer/reviewed_listing',$this->data);
		$this->load->view('reviewer/common/footer',$this->data);
	}


	public function check_session(){
		$user_ID = $this->session->userdata('login')['user_ID'];
		if($user_ID){
			redirect('reviewer/reviewer/dashboard');
		}
	}

	public function onlineApplication_listing(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Govt : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		);
		
		$group_by = 't1.user_id';
		$where = '';
		$join = array('t5'=>'tbl_existing_certificate');
		$this->data['payment_details'] = $this->reviewer_payment->get_payment_details($where,$join,$group_by);
		$this->data['all_row_count'] = $this->reviewer_payment->get_payment_detail_row_count('','',$group_by);

		
		/************************************ Approved *********************************************/
		

		$this->data['approved_details'] = $this->reviewer_payment->approved_certificate();
		$this->data['approved_row_count'] = $this->reviewer_payment->get_payment_approved_row_count();
		/************************************* End Approved ****************************************/


		/************************************ PENDING *********************************************/
		
		
		$this->data['pending_details'] = $this->reviewer_payment->pending_certificate();
		$this->data['pending_row_count'] = $this->reviewer_payment->get_payment_pending_row_count();
		/************************************* END PENDING ****************************************/


		/******************************** CE-PROVIDER DATA ***********************************/
		//$ce_where = array('t2.payment_type_id'=>2);

		$this->data['ce_provider_payment_details'] = $this->reviewer_payment->get_ce_provider_payment_details();
		
		/******************************** END CE-PROVIDER DATA *******************************/

		/******************************** Start Professional DATA *******************************/
		$this->data['foreign_application'] = $this->reviewer_payment->get_foreign_applcaition();	
		$this->data['foreign_application_count'] = $this->reviewer_payment->get_foreign_applcaition_count();

			/******************************** Start Online Course DATA *******************************/
		$this->data['online_course_application'] = $this->reviewer_payment->get_online_course_applcaition();

		$this->data['online_course_application_count'] = $this->reviewer_payment->get_online_course_applcaition_count();
		$this->data['university'] = $this->reviewer_payment->university_listing();
		$this->data['graduates'] = $this->reviewer_payment->graduates_listing();


		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/listing',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function universitylisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Accredited Schools',
			'page_title' => 'Accredited Schools',
			'table_name' => 'Accredited Schools'
		);
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['university'] = $this->reviewer_payment->university_listing('1',$uid);
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/universitylisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function universityassignedreviewer()
	{
		//print_r($_POST);
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] =  $reviewer_id;
		$assingrev['review_accept_date'] =  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->univassignedreviewerupdate($assingrev,$appid);
		echo  $appid; exit;
	}
	
	public function graduatecertificate()
	{
		//print_r($_POST);
		// $docid = $this->input->post('docid');
		// $data['result'] = $this->reviewer_payment->graduatecertificate($docid);
		// $this->load->view('reviewer/common/graduatecertificate_preview',$data);
		echo 'Comming soon';
	}
	
	public function providercertificate()
	{
		$docid = $_POST['docid'];
		$data['result'] = $this->reviewer_payment->providercertificate($docid);
		//$this->load->view('reviewer/common/providercertificate_preview',$data);
		$this->load->view('admin/common/cepcertificate_preview',$data);
		
	}
	
	public function schoolcertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->reviewer_payment->schoolcertificate($docid);
		$this->load->view('reviewer/common/schoolcertificate_preview',$data);
	}

	
	public function getschoolcertificatepdf($docid)
	{
		$data['result'] = $this->reviewer_payment->schoolcertificate($docid);
		$this->load->view('reviewer/common/schoolcertificate_preview',$data);
	}
	
	public function getprofcertificatepdf($docid)
	{
		$data['result'] = $this->common_modal->profcertificate($docid);
		$data['prof'] = $this->$this->applicant->fetch_user_details($data['result']->user_id);
		echo'<pre>';print_r($data);die;
		$this->load->view('reviewer/common/profcertificate_pdf',$data);
	}
	public function getproflicensepdf($docid)
	{
		$data['result'] = $this->common_modal->profcertificate($docid);
		$data['prof'] = $this->$this->applicant->fetch_user_details($data['result']->user_id);
		$this->load->view('reviewer/common/proflicense_pdf',$data);
	}
	
	public function getexampasspdf($grad_id)
	{
		$data['result'] = $this->reviewer_payment->getexampassdetails($grad_id);
		$this->load->view('reviewer/common/exampass_preview',$data);
	}
	
	public function getexampassfppdf($grad_id)
	{
		$data['result'] = $this->reviewer_payment->getexampassfpdetails($grad_id);
		$this->load->view('reviewer/common/exampass_preview',$data);
	}

	public function getcoursecertificatepdf($doc_id)
	{
		$data['result'] = $this->reviewer_payment->coursecertificate($doc_id);
		$this->load->view('reviewer/common/coursecertificate_preview',$data);
	}

	public function getceppdf($doc_id)
	{
		$data['result'] = $this->reviewer_payment->providercertificate($doc_id);
		// echo'<pre>';print_r($data);die;
		$this->load->view('reviewer/common/providercertificate_preview',$data);
	}

	public function getProfessionalEligibilityPdf($doc_id)
	{
		$data['result'] = $this->reviewer_payment->professional_eligibility_certificate($doc_id);
		// echo'<pre>';print_r($data);die;
		$this->load->view('reviewer/common/professional_eligibility_pdf',$data);
	}

	public function gettrainingcertificatepdf($doc_id)
	{
		$data['result'] = $this->reviewer_payment->trainingcertificate($doc_id);
		$this->load->view('reviewer/common/trainingcertificate_preview',$data);
	}
	public function get_goodstanding_certificatepdf($gs_id)
	{
		$data['result'] = $this->reviewer_payment->requestgoodstanddocument($gs_id);
		//echo '<pre>'; print_r($data);die;
		$this->load->view('reviewer/common/pro_goodstanding_pdf',$data);
	}
	public function coursecertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->reviewer_payment->coursecertificate($docid);
		$this->load->view('reviewer/common/coursecertificate_preview',$data);
	}

	public function trainingcertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->reviewer_payment->trainingcertificate($docid);
		$this->load->view('reviewer/common/trainingcertificate_preview',$data);
	}


	public function unversitydetails($id=null,$flag=null){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 

		if($this->input->post('uniid') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('uniid', 'university id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['uniid'] 			= $this->input->post('uniid');
				$univsitdata['unidoc_id'] 		= $this->input->post('unidoc_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertuniversityreview($univsitdata);
				if($insrtcommert){
					$settingarr = $this->common_model->get_setting('1');
					$logindetails = '';
					$accreditation_number = '';
					$datastatus = array();
					$datastatus['reviewer_status'] = $this->input->post('status');
					$univsitdata['review_date']    = date('Y-m-d H:i:s');
					$this->reviewer_payment->updateunversitydocreviewstatus($datastatus,$this->input->post('unidoc_id'));
					
					$unvdetls = $this->reviewer_payment->universitydetails($this->input->post('unidoc_id'));
					// print_r($unvdetls); exit;
					///start mail function
						$schoolinformation ='';
						$comment = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><strong>Comment: </strong>'.$this->input->post('comment').'</p>';
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
							
							
							$accreditation_number = 'SCH'.date('Y').$this->input->post('uniid').$this->input->post('unidoc_id');

							//generate qrcode
							$qr_image = 'qrcode_'.$accreditation_number.'.png';
							$qr_url = base_url('assets/uploads/pdf/'.$accreditation_number.'.pdf');
							$params['data'] = $qr_url;
							$params['level'] = 'H';
							$params['size'] = 5;
							$params['savename'] = './assets/qrcode/'.$qr_image;
							$this->ciqrcode->generate($params);
							
							$datastatus = array();
							$datastatus['accr_qrcode'] = $qr_image;
							$datastatus['accreditation_number'] = $accreditation_number;
							$this->reviewer_payment->updateunversitydocreviewstatus($datastatus,$this->input->post('unidoc_id'));
							
							$schoolinformation = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><strong>Accreditation Number: </strong>'.$accreditation_number.'</p>
							<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><strong>Date Issued: </strong>'.date("M d, Y",strtotime($unvdetls->review_accept_date)).'</p>
							<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><strong>Validity Date: </strong>'.date("M d, Y",strtotime($unvdetls->expiry_at)).'</p>';
							
							// Genrate PDF start
							$html = ob_get_clean();
							$this->getschoolcertificatepdf($this->input->post('unidoc_id'));
							// Get output html
							$html = $this->output->get_output();
							// $this->load->library('Pdf');
						
							// $this->dompdf->load_html($html);
							// $this->dompdf->set_paper('letter','portrait');
							// $this->dompdf->render();
							
							// file_put_contents('assets/uploads/pdf/'.$accreditation_number.'.pdf', $this->dompdf->output($html));
							// $this->dompdf->stream("school.pdf",array('Attachment'=>0));die;
							// Genrate PDF End
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
						}
						if($this->input->post('document_for') == 'n'){
						$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Username: '.$unvdetls->email.'<br>Password: '.$unvdetls->university_password.'</p>';
						}
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your application for School accreditation has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p>
						'.$schoolinformation.$comment.'
						<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">We have created a school account for you and here are the credentials below:</p>
						'.$logindetails.
						'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please <a style="color:#15c;" href="'.base_url('login').'">click here</a> to access your account.</p>
						<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Further please click this <a style="color:#15c;" href="'.base_url('university/university/digitalaccreditation/'.base64_encode($this->input->post('uniid'))).'">link</a> to access your Certicate of Accreditation.</p>
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
						$this->load->library('email');
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($unvdetls->email);
						//$this->email->cc('abhijeetkuma@gmail.com'); 
						$this->email->subject('School accreditation reviewed');
						$emailbody 					= array();
						$emailbody['name'] 			= $unvdetls->name_of_representative;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						if(isset($accreditation_number) && file_exists('assets/uploads/pdf/'.$accreditation_number.'.pdf')){
						$this->email->attach(base_url('assets/uploads/pdf/'.$accreditation_number.'.pdf'));
						}
						$this->load->helper('mail');
						$email_status = send_mail($unvdetls->email, 'School accreditation reviewed',$emailmessage, $bodycontentforCode);
						// $this->email->send();
						//insert in notification
						$updatenotification 				= array();
						$updatenotification['uniid'] 		= $unvdetls->uniid;
						$updatenotification['subject'] 		= 'School accreditation reviewed';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->common_model->insertnotifications('tbl_university_notifications',$updatenotification);
						//end insert in notification
					///end mail function 
					//exit;
					redirect('reviewer/reviewer/universitylisting', true);
				}
			}else{
				$id = $this->input->post('uniid');
				validation_errors();
			}
		}
		$this->data = array(
			'title' => 'Govt : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		); 
		if($id){
		$this->data['universitydetails'] = $this->reviewer_payment->universitydetails($id);
		$this->data['universityreviewdatails'] = $this->reviewer_payment->universityreviewdatails($id);
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		}else{
			redirect('reviewer/reviewer/universitylisting', true);
		}
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/universitydetails',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function professionallisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Foreign Professionals for Registration',
			'page_title' => 'Foreign Professionals for Registration',
			'table_name' => 'Foreign Professionals for Registration'
		);
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['foreign_application'] = $this->reviewer_payment->foreign_applcaition_details('','1',$uid);	
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/professionallisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function professionallicense(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Foreign Professionals for Exam',
			'page_title' => 'Foreign Professionals for Exam',
			'table_name' => 'Professional License'
		);
		$group_by = 't1.user_id';
		$where = '';
		$join = array('t5'=>'tbl_existing_certificate');
		//$this->data['payment_details'] = $this->reviewer_payment->get_payment_details($where,$join,$group_by);
		$this->data['listing'] = $this->reviewer_payment->get_prof_application_list(0,'1');
		$this->data['all_row_count'] = $this->reviewer_payment->get_payment_detail_row_count('','',$group_by);
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/professionallicense',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function provideraccreditation(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
	$count	= $this->reviewer_payment->get_ce_provider_payment_details(1);
		$this->data = array(
			'title' => 'accredited ce providers',
			'page_title' => 'Accredited CE Providers ('.$count.')',
			'table_name' => 'Accredited CE Providers'
		);

		$this->data['ce_provider_payment_details'] = $this->reviewer_payment->get_ce_provider_payment_details('',array('t1.reviewer_status'=>'1'));
		$this->data['ce_provider_approved'] = $this->reviewer_payment->get_ce_provider_payment_details('',array('t1.reviewer_status'=>'1'));
		$this->data['ce_provider_approved_count'] = $this->reviewer_payment->get_ce_provider_payment_details(1,array('t1.reviewer_status'=>'1'));
		$this->data['ce_provider_pending'] = $this->reviewer_payment->get_ce_provider_payment_details('',array('t1.reviewer_status'=>'0'));
		$this->data['ce_provider_pending_count'] = $this->reviewer_payment->get_ce_provider_payment_details(1,array('t1.reviewer_status'=>'0'));
		$this->data['ce_provider_rejected'] = $this->reviewer_payment->get_ce_provider_payment_details('',array('t1.reviewer_status'=>'2'));
		$this->data['ce_provider_rejected_count'] = $this->reviewer_payment->get_ce_provider_payment_details(1,array('t1.reviewer_status'=>'2'));
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/provideraccreditation',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function onlinecourse(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'ct'){
			redirect('login', true);
		} 
		$this->data = array('title' => 'Accredited Online Courses',	'page_title' => 'Accredited Online Courses');
		
		$where = array('c.reviewer_id'=>$this->session->userdata('login')['user_ID']);
		$this->data['online_course_application'] = $this->reviewer_payment->get_online_course_applcaition($where);
		$this->data['online_course_application_count'] = $this->reviewer_payment->get_online_course_applcaition_count($where);	
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/onlinecourse',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function graduateslisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Graduates Listing & Exam Codes',
			'page_title' => 'Graduates Listing & Exam Codes',
			'table_name' => 'Graduates Listing & Exam Codes'
		);
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['listing'] = $this->reviewer_payment->graduates_listing('1',$uid);
		$this->data['getuniversityArr'] = $this->common_model->getuniversityArr();
		$this->data['getschoolArr'] = $this->common_model->getschoolArr();	
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('admin/graduates/listing',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function graduatedetailsforpopup(){
		$this->load->helper('mail');

		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$docid = $_POST['docid'];
		$graduatedetails = $this->reviewer_payment->graduates_details($docid);
		echo '<div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <img align="center" width="200" height="200" src="'.base_url('assets/images/graduates/').$graduatedetails->photo.'" alt="'.$graduatedetails->student_name.' '.$graduatedetails->middle_name.' '.$graduatedetails->surname.'">    
                            </div>                           
                        </div>
                    </div>
                    
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Name:</label>
                            </div>
                            <div class="col-sm-8">
                                '.$graduatedetails->student_name.' '.$graduatedetails->middle_name.' '.$graduatedetails->surname.'
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Date of Birth:</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->dob.'</div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Email:</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->email.'</div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Gender</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->gender.'</div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Year of Graduated</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->year_of_graduated.'</div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Exam Code</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-8">'.$graduatedetails->examcode.'</div>
                            </div>                           
                        </div>
                    </div>';
	}
	public function graduatedetails($id=null, $flag=null){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		if($this->input->post('grad_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('grad_id', 'university id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$examcode = 'EXA'.$this->input->post('grad_id').date('YmdHis');
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['grad_id'] 		= $this->input->post('grad_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				//$insrtcommert = $this->reviewer_payment->insertuniversityreview($univsitdata);
				$insrtcommert = $this->reviewer_payment->insertgraduatesreview($univsitdata);
				if($insrtcommert){
					$settingarr = $this->common_model->get_setting('1');
					$datastatus = array();
					$datastatus['reviewer_status'] 	= $this->input->post('status');
					//$datastatus['examcode'] 		= $this->input->post('examcode');
					$datastatus['examcode'] 		= $examcode;
					$datastatus['date_issued'] 		= date('Y-m-d');
					//$this->reviewer_payment->updateunversityreviewstatus($datastatus,$this->input->post('grad_id'));
					//$unvdetls = $this->reviewer_payment->universitydetails($this->input->post('grad_id'));
					$this->reviewer_payment->graducateassignedreviewerupdate($datastatus,$this->input->post('grad_id'));					
					$graduatedetls = $this->reviewer_payment->graduates_details($this->input->post('grad_id'));
					///start mail function
						
					if($this->input->post('status') == 1){
						$curstatus = 'Approved';
						$examcodetext = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">You are now eligible to take the Licensure Examination using this examination code : <b>'.$examcode.'</b></p>';
						/*  // Genrate PDF start
						$html = ob_get_clean();
						$this->getexampasspdf($this->input->post('grad_id'));
						// Get output html
						$html = $this->output->get_output();
						$this->load->library('Pdf');
					
						$this->dompdf->load_html($html);
						$this->dompdf->set_paper('letter','portrait');
						$this->dompdf->render();
						
						file_put_contents('assets/uploads/pdf/'.$examcode.'.pdf', $this->dompdf->output($html));
						// $this->dompdf->stream("exam.pdf",array('Attachment'=>0));
						// Genrate PDF End  */
					}
					if($this->input->post('status') == 2){
						$curstatus = 'Rejected';
						$examcodetext = '';
					}
						
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><b>'.date('d M, Y').'</b><br>Dear '.$graduatedetls->fullname.', </p>'.$examcodetext.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please click this link to register for your licensure examination.</p>
						<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><a href="'.base_url('graduates').'">'.base_url('graduates').'</a></p>
						<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have question please message us with this link: <br><a href="'.base_url('contactus').'">'.base_url('contactus').'</a></p>';
						
						// $config = Array(
						// 	'protocol' => 'smtp',
						// 	'smtp_host' => SMTP_HOSTNAME,
						// 	'smtp_port' => SMTP_PORT,
						// 	'smtp_user' => SENT_EMAIL_FROM,
						// 	'smtp_pass' => SENT_EMAIL_PASSWORD,
						// 	'mailtype'  => 'html', 
						// 	'newline'   => "\r\n",
						// 	'AuthType'   => "XOAUTH2",
						// 	'charset'   => 'iso-8859-1',
							
						// );  
						// $subject = 'Graduate Reviewed';
						// $this->load->library('email');
						// $this->email->initialize($config);
						// $this->email->set_newline("\r\n");
						// $this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						// $this->email->to($graduatedetls->email);
						// //$this->email->to('abhijeetkuma@gmail.com'); 
						// $this->email->subject($subject);
						$emailbody 					= array();
						$emailbody['name'] 			= $graduatedetls->fullname;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						/*if(isset($graduatedetls->examcode) && file_exists('assets/uploads/pdf/'.$graduatedetls->examcode.'.pdf')){
						$this->email->attach(base_url('assets/uploads/pdf/'.$graduatedetls->examcode.'.pdf'));
						} */	
						//$this->email->message('Testing the email class.');
						// $this->email->message($emailmessage);
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($graduatedetls->email, 'Graduate Reviewed',$emailmessage, $bodycontentforCode);
						
						//send school graducate mail 
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($graduatedetls->uni_email);
						//$this->email->to('abhijeetkuma@gmail.com'); 
						$this->email->subject($subject);
						$emailbody 					= array();
						$emailbody['name'] 			= $graduatedetls->fullname;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						// $this->email->message($emailmessage);
						/* if(isset($graduatedetls->examcode) && file_exists('assets/uploads/pdf/'.$graduatedetls->examcode.'.pdf')){
						$this->email->attach(base_url('assets/uploads/pdf/'.$graduatedetls->examcode.'.pdf'));
						} */	
						//$this->email->message('Testing the email class.');
						// $this->email->message($emailmessage);
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($graduatedetls->email, 'School accreditation reviewed',$emailmessage, $bodycontentforCode);
						
						//end send school graducate mail 
						$updatenotification 				= array();
						$updatenotification['uniid'] 		= $graduatedetls->uniid;
						$updatenotification['subject'] 		= $subject;
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->common_model->insertnotifications('tbl_university_notifications',$updatenotification);
					///end mail function 
					//exit;
					//redirect('reviewer/reviewer/reviewed_listing', true);
					redirect('reviewer/reviewer/graduateslisting', true);
				}
			}else{
				$id = $this->input->post('grad_id');
				validation_errors();
			}
		}
		$this->data = array(
			'title' => 'PCMS : Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		);
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		$this->data['graduatedetails'] = $this->reviewer_payment->graduates_details($id);
		$this->data['graduatereviewdatails'] = $this->reviewer_payment->graducatereviewdatails($id);
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/graduatedetails',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function reviewer_accept()
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$reviewer_id = $this->input->post('reviewer_id');
		$certificate_id = $this->input->post('certificate_id');

		$data = array(

			'reviewer_id' =>  $reviewer_id
		);

		$this->reviewer_payment->update('tbl_user_certificate',$data,'id',$certificate_id);
	}
	public function reviewer_accept_ce_provider()
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$reviewer_id = $this->input->post('reviewer_id');
		$provider_id = $this->input->post('provider_id');
		//$password = $this->randomPassword();
		
		//echo "<pre>"; print_r($_POST); exit;
		$data = array(

			'reviewer_id' =>  $reviewer_id,
			//'status' => 1,
			//'password' => $password
		);

		$affected_row = $this->reviewer_payment->update('tbl_ce_provider',$data,'provider_id',$provider_id);

		//echo "ssssssssssssssss".$affected_row; exit;
		if($affected_row){
				$this->data['payment_success'] = "success";
		//$where = array('t1.provider_id'=>$provider_id);
		//$user_details = $this->reviewer_payment->get_ce_provider_payment_details($where);
		
		//print_r(expression)	

		/*if(!empty($user_details)){

			$this->load->library('email');
			$to = $user_details[0]['email'];
			$this->email->from("pradeepsingh123786@gmail.com");
			$this->email->to($to);
			$this->email->subject("Applications Accepted");
			$this->email->message("Email :- ".$user_details[0]['email']."
				Password :- ".$user_details[0]['password']);

			if ($this->email->send()) {
			echo 'Your Email has successfully been sent.';
			} else {
			echo show_error($this->email->print_debugger());
			}
			$this->data['payment_success'] = "success";
		}*/
		}


	}
	public function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	function cepassignedreviewer(){
		$doc_id = $this->input->post('doc_id');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] 			=  $reviewer_id;
		$assingrev['review_accept_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->cepassignedreviewerupdate($assingrev,$doc_id);
		echo  $doc_id; exit;
	}

	public function professionalassignedreviewer()
	{
		//print_r($_POST);
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] 			=  $reviewer_id;
		$assingrev['review_accept_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->profesassignedreviewerupdate($assingrev,$appid);
		echo  $appid; exit;
	}

	public function courseassignedreviewer()
	{	
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		// print_r($this->input->post());die;
		$assincou = array();
		$assincou['reviewer_id'] 			=  $reviewer_id;
		$assincou['review_accept_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->courseassignedreviewerupdate($assincou,$appid);
		// echo  $this->db->last_query(); exit;
		echo  $appid; exit;
	}
	
	public function graduateassignedreviewer() 
	{
		//print_r($_POST);
		$appid = $this->input->post('appid');
		$reviewer_id = $this->input->post('reviewer_id');
		$assingrev = array();
		$assingrev['reviewer_id'] =  $reviewer_id;
		$assingrev['reviewer_accept_date'] =  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->graducateassignedreviewerupdate($assingrev,$appid);
		echo  $appid; exit;
	}

	public function verify_document($appid=null,$doc_id=null,$flag=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Foreign Professional Review For Professional Registration'
		);
		
		if($this->input->post('prof_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('prof_id', 'professional id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['doc_id'] 			= $this->input->post('doc_id');
				$univsitdata['prof_id'] 		= $this->input->post('prof_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertprofessionalreview($univsitdata);
				if($insrtcommert){
					$settingarr = $this->common_model->get_setting('1');
					$professdatails = $this->reviewer_payment->getprofessionaldetails($this->input->post('prof_id'));
					$passwordnew 	= $professdatails->user_ID.date('YmdHis');
					$datastatus 	= array();
					$docdatastatus 	= array();
					if($this->input->post('status') == 1){
						$bytes 		= random_bytes(3); 
						$regcode 	= bin2hex($bytes);
						$registration_no = 'REG-'.$professdatails->user_ID.$regcode.'-'.date('Y');
						$datastatus['registration_no'] = $registration_no;
						$datastatus['updated_at'] = date('Y-m-d');

						//generate qrcode
						$qr_image = 'qrcode_'.$registration_no.'.png';
						$qr_url = base_url('assets/uploads/pdf/'.$registration_no.'.pdf');
						$params['data'] = $qr_url;
						$params['level'] = 'H';
						$params['size'] = 5;
						$params['savename'] = './assets/qrcode/'.$qr_image;
						$this->ciqrcode->generate($params);
						$docdatastatus['qrcode'] = $qr_image;
					}	
					
					// $datastatus['reviewer_status'] 		= $this->input->post('status'); //no need status here, it will comes in doc tbl. 
					$docdatastatus['reviewer_id'] 		= $this->session->userdata('login')['user_ID'];
					$docdatastatus['reviewer_status'] 	= $this->input->post('status');
					$docdatastatus['review_date'] 		= date('Y-m-d H:i:s');
					$this->reviewer_payment->professionalreviewstatus($datastatus,$this->input->post('prof_id'));
					$this->reviewer_payment->profdocreviewstatus($docdatastatus,$this->input->post('doc_id'));
					
					///start mail function
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
							$required_info = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"> 
								<table>
									<tr><th>Name</th><td>'.$professdatails->fullname.'</td></tr>
									<tr><th>Email</th><td>'.$professdatails->email.'</td></tr>
									<tr><th>Date of Birth</th><td>'.$professdatails->dob.'</td></tr>
									<tr><th>Gender</th><td>'.$professdatails->gender.'</td></tr>
									<tr><th>Registration Code</th><td>'.$registration_no.'</td></tr>
								</table>
							</p>';
							$etcdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please check the link below to start application for Professional Registrtion. 
							<br><a href="'.base_url('professional/applicant/registration_form').'">Professional Registration (Ceonpoint.com).</a></p>
							<br><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please use the Registration Code below to complete Step 1 of Professional Registration.<br>Registration Code: '.$registration_no.'</p>'.$required_info;
							
							// Genrate PDF start
							$html = ob_get_clean();
							$this->getProfessionalEligibilityPdf($this->input->post('doc_id'));
							// Get output html
							$html = $this->output->get_output();
							// print_r($html);die;
							$this->load->library('Pdf');
							$this->dompdf->load_html($html);
							$this->dompdf->set_paper('letter','portrait');
							$this->dompdf->render();
							
							file_put_contents('assets/uploads/pdf/'.$registration_no.'.pdf', $this->dompdf->output($html));
							// $this->dompdf->stream("course.pdf",array('Attachment'=>0));die;
							// Genrate PDF End

						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
							$etcdetails = '';
						}

						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your professional details has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p>
						<br>'.$etcdetails.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have any question please message us and we will be happy to assist you. </p>';
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
						$this->email->subject('Professional details review');
						$emailbody 					= array();
						$emailbody['name'] 			= $professdatails->fullname;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						if(isset($registration_no) && file_exists('assets/uploads/pdf/'.$registration_no.'.pdf')){
							$this->email->attach(base_url('assets/uploads/pdf/'.$registration_no.'.pdf'));
						}
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($professdatails->email, 'Professional details review',$emailmessage, $bodycontentforCode);
						
						//end mail function 
					
					// redirect('reviewer/reviewer/onlineApplication_listing', true);
					redirect('reviewer/reviewer/professionallisting', true);
				}
			}else{
				$appid = $this->input->post('prof_id');
				validation_errors();
			}
		}
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		$this->data['professreviewdatails'] = $this->reviewer_payment->professionlareviewdatails($appid,$doc_id);
		$this->data['application'] = $this->reviewer_payment->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_payment->get_row_object('tbl_professional_documents','pd_id',$doc_id);
		$this->data['profession'] = $this->applicant->get_profession();
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/verify',$this->data);
		$this->load->view('reviewer/common/footer');
	}


	public function profexam_verify_document($appid=null,$doc_id=null,$flag=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Foreign Professional Review For Licensure Examination'
		);
		
		if($this->input->post('prof_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('prof_id', 'professional id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['doc_id'] 			= $this->input->post('doc_id');
				$univsitdata['prof_id'] 		= $this->input->post('prof_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertprofessionalreview($univsitdata);
				if($insrtcommert){
					$settingarr = $this->common_model->get_setting('1');
					$professdatails = $this->reviewer_payment->getprofessionaldetails($this->input->post('prof_id'));
					$passwordnew = $professdatails->user_ID.date('YmdHis');
					
					$datastatus = array();
					if($this->input->post('status') == 1){
						$exam_code  	   			= 'EXA'.$professdatails->user_ID.date('YmdHis');
						$datastatus['exam_code']  	= $exam_code;
						$curstatus = 'Approved';
						$curcomment = $this->input->post('comment');
						$required_info = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"> 
								Please click the link below to apply now:<br><a href="'.base_url('professional/profexam/registerexam').'">Foreign Professional Profile & Exam Code (ceonpoint.com).</a><br>Should you have any question please contact us and will be happy to assist you.
							</p>';
						$details = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Now you can apply for Booking for Online Licensure Examination for Foreign professionals with this EXAM CODE: '.$exam_code.'</p>'.$required_info;

						//generate qr code
						$qr_image = 'qrcode_'.$exam_code.'.png';
						$qr_url = base_url('assets/uploads/pdf/'.$exam_code.'.pdf');
						$params['data'] = $qr_url;
						$params['level'] = 'H';
						$params['size'] = 5;
						$params['savename'] = './assets/qrcode/'.$qr_image;
						$this->ciqrcode->generate($params);
						$datastatus['exam_pass_qrcode'] = $qr_image;
					}
					if($this->input->post('status') == 2){
						$curstatus = 'Rejected';
						$curcomment = $this->input->post('comment');
						$details = '';
					}
					// $datastatus['password']     = password_hash($passwordnew,PASSWORD_DEFAULT);
					$datastatus['reviewer_status'] = $this->input->post('status');
					$this->reviewer_payment->professionalreviewstatus($datastatus,$this->input->post('prof_id'));
					
					$docdatastatus['reviewer_id'] 		= $this->session->userdata('login')['user_ID'];
					$docdatastatus['reviewer_status'] 	= $this->input->post('status');
					$docdatastatus['review_date'] 		= date('Y-m-d H:i:s');
					$this->reviewer_payment->profdocreviewstatus($docdatastatus,$this->input->post('doc_id'));
					
						// start mail function
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your professional details has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p>
						<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><i><strong>Comment : </strong>'.$curcomment.'</i></p><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$details.'</p>';
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
						$this->email->subject('Professional details review');
						$emailbody 					= array();
						$emailbody['name'] 			= $professdatails->fname.' '.$professdatails->lname.' '.$professdatails->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
						$this->email->message($emailmessage);
						// $this->email->send();
					///end mail function 
					$this->load->helper('mail');
					$email_status = send_mail($professdatails->email, 'Professional details review',$emailmessage, $bodycontentforCode);
						
					
					redirect('reviewer/reviewer/professionallicense', true);
					//redirect('reviewer/reviewer/reviewed_listing', true);
				}
			}else{
				$appid = $this->input->post('prof_id');
				validation_errors();
			}
		}
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		$this->data['professreviewdatails'] = $this->reviewer_payment->professionlareviewdatails($appid,$doc_id);
		$this->data['application'] = $this->reviewer_payment->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_payment->get_row_object('tbl_professional_documents','pd_id',$doc_id);
		$this->data['profession'] = $this->applicant->get_profession();
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/profexam_verify',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	
	public function verify_certificate($appid=null,$doc_id=null,$flag=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Professional License Renewal'
		);
		if($this->input->post('prof_id') > 0){
			// echo '<pre>'; print_r($this->input->post());die;
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('prof_id', 'professional id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comment'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['doc_id'] 			= $this->input->post('doc_id');
				$univsitdata['prof_id'] 		= $this->input->post('prof_id');
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->insertprofessionalreview($univsitdata);
				if($insrtcommert){
					$settingarr = $this->common_model->get_setting('1');
					$professdatails = $this->reviewer_payment->getprofessionaldetails($this->input->post('prof_id'));
					$docdatails = $this->reviewer_payment->get_row_object('tbl_professional_documents','pd_id',$this->input->post('doc_id'));
					// $datastatus 	= array();
					$docdatastatus 	= array();
				
					// $datastatus['reviewer_status'] 		= $this->input->post('status');
					$docdatastatus['reviewer_id'] 		= $this->session->userdata('login')['user_ID'];
					$docdatastatus['reviewer_status'] 	= $this->input->post('status');
					$docdatastatus['review_date'] 		= date('Y-m-d H:i:s');
					$docdatastatus['updated_at'] 		= date('Y-m-d H:i:s');
					$docdatastatus['status'] 			= 1;
					// $this->reviewer_payment->professionalreviewstatus($datastatus,$this->input->post('prof_id'));
					$this->reviewer_payment->profdocreviewstatus($docdatastatus,$this->input->post('doc_id'));
				
					///start mail function
						if($this->input->post('status') == 1){
							$userid = $this->input->post('prof_id');
							$candidate_type = $this->input->post('candidate_type');

							if($candidate_type=='PR'){
								$userdetails = $this->applicant->fetch_user_details($userid);
							}else{
								$userdetails = $this->applicant->fetch_graduate_details($user_id);
							}
							//generate card_qrcode
							$ref_code = $docdatails->refrence_code;
							$qr_image = 'qrcode_'.$ref_code.'.png';
							$qr_url = base_url('assets/uploads/pdf/'.$ref_code.'card.pdf');
							$params['data'] = $qr_url;
							$params['level'] = 'H';
							$params['size'] = 5;
							$params['savename'] = './assets/qrcode/'.$qr_image;
							$this->ciqrcode->generate($params);
							
							$updateprof = array();
							// $updateprof['refrence_code'] 	= $docdatails->refrence_code;
							$updateprof['lic_issue_date'] 	= date('Y-m-d H:i:s');
							$updateprof['license_no'] 		= $userdetails->license_no;
							$updateprof['reviewer_id'] 		= $this->session->userdata('login')['user_ID'];
							$updateprof['reviewer_status']  = '1';
							$updateprof['review_date']  	= date('Y-m-d H:i:s');
							$updateprof['review_accept_date'] = date('Y-m-d H:i:s');
							$updateprof['updated_at']  		= date('Y-m-d H:i:s');
							$updateprof['status']  			= 1;
							$updated = $this->applicant->updateprofdoc($updateprof,$this->input->post('doc_id'));
							
							$updateproflicno['license_no'] 		= $userdetails->license_no;
							$updateproflicno['lic_issue_date'] 	= date('Y-m-d H:i:s');
							$updateproflicno['lic_expiry_date'] = $docdatails->expiry_at;
							$updateproflicno['card_qrcode'] 	= $qr_image;
							$updateproflicno['updated_at'] 		= date('Y-m-d H:i:s');
							$updatedpro = $this->applicant->updateproflicno($updateproflicno,$userid);
							// echo $this->db->last_query();die();

							if($updated){
								//1st pdf for card
								$html = ob_get_clean();
								$html=$this->getprofreg_card_pdf($userid,$candidate_type);
								// print_r($html);die;	
								// Get output html
								$this->load->library('Pdf');
								$this->dompdf = new DOMPDF();
								$this->dompdf->load_html($html);
								
								$this->dompdf->set_paper('A4','portrait');
								$this->dompdf->render();
								file_put_contents('assets/uploads/pdf/'.$docdatails->refrence_code.'card.pdf', $this->dompdf->output($html));
								// $this->dompdf->stream('card.pdf', array('Attachment' => 0));
								// exit;

								// $this->getprofreg_cert_pdf($userid,$candidate_type);
								// // Get output html
								// $newhtml = $this->output->get_output();
								// // print_r($newhtml);die;
								// $this->dompdf->load_html($newhtml);
								// $this->dompdf->set_paper('A4','portrait');
								// $this->dompdf->render();
								// file_put_contents('assets/uploads/pdf/'.$docdatails->refrence_code.'cert.pdf', $this->dompdf->output($newhtml));
								// $this->dompdf->stream('certificate.pdf', array('Attachment' => 0));
								// exit;
							}

							$curstatus = 'Approved';
							
							$etcdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">
							You have successfully renew your professonal license. Please search the refrence number into the given link to find the license.    
							<br><a href="'.base_url('license/search').'">click here to search.</a></p>
							<br><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">
							<ul>
								<li>
									Refrence Number: '.$docdatails->refrence_code.'
								</li>
								<li>
									License Number: '.$docdatails->license_no.'
								</li>
							</ul> </p>';

						}
						if($this->input->post('status') == 2){
							
							$updateprof = array();
							$updateprof['refrence_code'] 	= $docdatails->refrence_code;
							$updateprof['reviewer_id'] 		= $this->session->userdata('login')['user_ID'];
							$updateprof['reviewer_status']  = '2';
							$updateprof['review_date']  	= date('Y-m-d H:i:s');
							$updateprof['review_accept_date'] = date('Y-m-d H:i:s');
							$updateprof['updated_at']  		= date('Y-m-d H:i:s');
							$updateprof['status']  			= 2;
							$updated = $this->applicant->updateprofdoc($updateprof,$this->input->post('doc_id'));

							$curstatus = 'Rejected';
							$etcdetails 	= $this->input->post('comment');
						}

						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your Certificates has been reviewed successfully.<br><strong>Status: </strong>'.$curstatus.'</p>
						<br>'.$etcdetails.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have any question please message us and we will be happy to assist you. </p>';
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
						$this->email->subject('Certificate Verification Done');
						$emailbody 					= array();
						$emailbody['name'] 			= $professdatails->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
						$this->email->message($emailmessage);
						if(isset($docdatails->refrence_code) && file_exists('assets/uploads/pdf/'.$docdatails->refrence_code.'card.pdf')){
							$this->email->attach(base_url('assets/uploads/pdf/'.$docdatails->refrence_code.'card.pdf'));
						}
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($professdatails->email, 'Certificate Verification Done',$emailmessage, $bodycontentforCode);
						
					///end mail function 
					
					redirect('reviewer/reviewer/reviewed_listing', true);
					// redirect('reviewer/reviewer/professionallisting', true);
				}
			}else{
				$appid = $this->input->post('prof_id');
				validation_errors();
			}
		}
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		$this->data['professreviewdatails'] = $this->reviewer_payment->professionlareviewdatails($this->session->userdata('login')['user_ID'],$doc_id);
		$this->data['application'] 	= $this->reviewer_payment->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] 	= $this->reviewer_payment->get_row_object('tbl_professional_documents','pd_id',$doc_id);
		$this->data['certificate'] 	= $this->reviewer_payment->get_submitted_certificate($appid);
		$this->data['profession']   = $this->applicant->get_profession();
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/verify_certificate',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	function getprofreg_card_pdf($userid,$payment_for){
		$data['profes_details'] = new \stdClass();
		if($payment_for=='PR'){
			$userdetails = $this->applicant->fetch_user_details($userid);
			$candidate_type = 'p';
		}else{
			$candidate_type = 'g';
			$userdetails = $this->applicant->fetch_graduate_details($userid);
		}
		$license_details = $this->applicant->get_one_professional_license($userid,$candidate_type);
		//print_r($userdetails);die;
		$data['profes_details']->license_no = $license_details->license_no; 
		$data['profes_details']->lic_issue_date = $license_details->lic_issue_date; 
		$data['profes_details']->validity_date = $license_details->lic_expiry_date; 
		$data['profes_details']->fullname = $userdetails->fullname;
		$data['profes_details']->card_qrcode = $license_details->card_qrcode;
		//$data['profes_details']->lname = $userdetails->lname;
		//$data['profes_details']->name = $userdetails->name;
		$data['profes_details']->image = $userdetails->image;
		$result = $this->load->view('professional/include/profregisteration_card_pdf_preview',$data, TRUE);
		return $result;
	}
	
	// **********In Renewal of professional license we don't need certificate only license validity will change all were lookes same.***************
	// function getprofreg_cert_pdf($userid,$payment_for){
	// 	if($payment_for=='PR'){
	// 		$userdetails = $this->applicant->fetch_user_details($userid);
	// 	}else{
	// 		$userdetails = $this->applicant->fetch_graduate_details($userid);
	// 	}
	// 	$data['profes_details'] = $userdetails;
	// 	//$this->load->view('professional/include/profregisteration_card_pdf_preview',$data);
	// 	$result=$this->load->view('professional/include/profregisteration_cert_pdf_preview',$data, TRUE);
	// 	return $result;
	// } 

	public function approve_certificate(){
		// print_r($this->input->post());die;
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$user_id = $this->input->post('user_id');
		$doc_id = $this->input->post('doc_id');
		$data['certificate_identify'] = $status;
		$result = $this->reviewer_payment->approve_certificate($data,$id);
		if($result > 0){
			$this->session->set_flashdata('message','Certificate Verifyed');
		}else{
			$this->session->set_flashdata('message','Something went wrong please try again!');
		}
		redirect('reviewer/reviewer/verify_certificate/'.$user_id.'/'.$doc_id.'');
	}

	public function document_approval(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$user_ID = $this->session->userdata('login')['user_ID'];
		$post = $this->input->post();
		$result = $this->reviewer_payment->change_doc_status($post);
		if($result > 0){
			$this->reviewer_took_fapp($post['id'],$post['reviewer_id']);
			echo "<script>alert('Status changed successfully.');
			window.location.href='onlineApplication_listing';</script>"; 
			// $this->session->set_flashdata('message','Status changed successfully.');
		}else{
			$this->session->set_flashdata('message','Something went wrong please try again!');
			redirect('reviewer/reviewer/onlineApplication_listing');
		}
	}

	public function cep_details($id=null,$flag=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		}

		if($this->input->post('Submit')=='Submit'){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comments'] 	= $this->input->post('comment');
				$univsitdata['status'] 		= $this->input->post('status');
				$univsitdata['user_id'] 	= $this->input->post('provider_id');
				$univsitdata['doc_id'] 		= $id;
				$univsitdata['reviewed_by'] = $this->session->userdata('login')['user_ID'];
				$univsitdata['added_on'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->reviewer_payment->save('tbl_cep_comments',$univsitdata);
				// echo $this->db->last_query();die;

				$provider_id = $this->input->post('provider_id');
				//echo $insrtcommert; exit;

				if($insrtcommert){					
					$settingarr = $this->common_model->get_setting('1');
					$datastatus = array();
					// start mail function
					$cep_details = $this->reviewer_payment->get_cep_details($id);
					$logindetails = '';
					$topbodymsg = '';
					$accreditation_no = '';
					$referencetxt = '';
					$cep_code = 'CEP'.random_string('alnum',20);
					if($this->input->post('status') == 1){
						$curstatus = 'Approved';
						$datastatus['status'] 				= $this->input->post('status');
						$datastatus['reviewer_status'] 		= $this->input->post('status');
						$datastatus['reviewer_accept_date'] = date('Y-m-d H:i:s');
						if($this->input->post('document_for') == 'n'){
							$datastatus['password'] 			= $this->randomPassword();
							$datastatus['cep_code'] 			= $cep_code;
						}
						$this->reviewer_payment->update('tbl_ce_provider',$datastatus,'provider_id',$provider_id);
						
						$datastatusd['reviewer_id'] 		= $this->session->userdata('login')['user_ID'];
						$datastatusd['reviewer_status'] 	= $this->input->post('status');
						$datastatusd['review_date'] 		= date('Y-m-d H:i:s');
						$this->reviewer_payment->update('tbl_cep_documents',$datastatusd,'id',$id);
						// echo $this->db->last_query();die;
						if($this->input->post('document_for') == 'n'){
							$accreditation_no = 'CEP'.date('Y').$this->session->userdata('login')['user_ID'].$id;

						}else{
							$last_acc_no = $this->db->where(array('provider_id'=>$cep_details->provider_id,'reviewer_status'=>'1','document_for'=>'n'))->get('tbl_cep_documents')->row_object();
							$accreditation_no = $last_acc_no->accreditation_no;
						}
							$accupdate = array('accreditation_no'=>$accreditation_no);				
							$this->db->where('id',$id);
							$this->db->update('tbl_cep_documents',$accupdate);

							$validity_date=$this->db->where('id',$id)->get('tbl_cep_documents')->row_array();
							$vali_date=date('M-d-Y',strtotime($validity_date['expiry_at']));
							$date_issue=date('M-d-Y',strtotime($validity_date['review_date']));
							$refrence_no	=	$validity_date['reference_no'];

							//generate qrcode
							$qr_image = 'qrcode_'.$refrence_no.'.png';
							$qr_url = base_url('assets/uploads/pdf/'.$refrence_no.'.pdf');
							$params['data'] = $qr_url;
							$params['level'] = 'H';
							$params['size'] = 5;
							$params['savename'] = './assets/qrcode/'.$qr_image;
							$this->ciqrcode->generate($params);
							
							$qrupdate = array('cep_qrcode'=>$qr_image);				
							$this->db->where('id',$id);
							$this->db->update('tbl_cep_documents',$qrupdate);

						$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
						
						$referencetxt = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Refence number : '.$refrence_no.'<br>Please '.$serachlink.' and copy and paste your reference number.</p>';
						
						if($this->input->post('document_for') == 'n'){
							$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">This is your credentials :<br>
							Username : '.$cep_details->email.'<br>Password: '.$datastatus['password'].' (this is your temporary password. You can change when you are already In your account.)</p>';
						}else{
							$logindetails = '';
						}	

						$topbodymsg = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your application for CEP accreditation has been reviewed and approved.</p>
						<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Certificate title: Certificate of Accreditation<br>Accreditation No. : '.$accreditation_no.'<br>Date issued : '.$date_issue.'<br>Validity date : '.$vali_date.'</p>';
						$rboard_details = '<br>Now you can connect with Regulatory Board with this code 
						<br><b>Regulatory Board Name: '.$this->rbname.'</b>. 
						<br><b>Regulatory Board Code: '.$this->rbcode.'</b>
						<br><b>CE Provider Code: '.$cep_code.'</b> You can send your certificate to Regulatory Board for verification.';

						/* It will help us to send acc details to ceonpoint and saved it. */
						$_SESSION['sessaccnum'] = $accreditation_no;
						$_SESSION['sessaccvalidity'] = $validity_date['expiry_at'];
						
						// Genrate PDF start
						$html = ob_get_clean();
						$this->getceppdf($id);
						// Get output html
						$html = $this->output->get_output();
						$this->load->library('Pdf');
					
						$this->dompdf->load_html($html);
						$this->dompdf->set_paper('letter','portrait');
						$this->dompdf->render();
						
						// file_put_contents('assets/uploads/pdf/'.$accreditation_no.'.pdf', $this->dompdf->output($html));
						file_put_contents('assets/uploads/pdf/'.$refrence_no.'.pdf', $this->dompdf->output($html));
						// $this->dompdf->stream("course.pdf",array('Attachment'=>0));die;
						// Genrate PDF End
					}

					if($this->input->post('status') == 2){
						$curstatus = 'Rejected';

						$datastatus['status'] = $this->input->post('status');
						$datastatus['reviewer_status'] 		= $this->input->post('status');
						$this->reviewer_payment->update('tbl_ce_provider',$datastatus,'provider_id',$id);
						
						$datastatusd['reviewer_id'] 	= $this->session->userdata('login')['user_ID'];
						$datastatusd['review_date'] 	= date('Y-m-d H:i:s');
						$datastatusd['reviewer_status'] = $this->input->post('status');
						$this->reviewer_payment->update('tbl_cep_documents',$datastatusd,'provider_id',$id);
						
						$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$this->input->post('comment').'</p>';
					}
						
				if($this->input->post('document_for') == 'n'){					
					$bodycontentforCode = $topbodymsg.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Likewise, we have created an account for you so you can apply for accreditation of your Online Courses and Training Courses. You can access your CEP account by clicking this link : <a href="'.base_url('login').'">'.base_url('login').'</a></p>'.$logindetails.' '.$rboard_details.' '.$referencetxt;
					
				}else{
					$bodycontentforCode = $topbodymsg.$referencetxt;
				}
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
					$this->email->to($cep_details->email);
					$this->email->subject('CEP PROVIDER');
					$emailbody 					= array();
					$emailbody['name'] 			= $cep_details->contact_person;
					$emailbody['thanksname'] 	= $settingarr->signature_name;
					$emailbody['thanks2'] 		= '';
					$emailbody['thanks3'] 		= $settingarr->position;
					$emailbody['body_msg'] 		= $bodycontentforCode;
					$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					if(isset($refrence_no) && file_exists('assets/uploads/pdf/'.$refrence_no.'.pdf')){
						$this->email->attach(base_url('assets/uploads/pdf/'.$refrence_no.'.pdf'));
						}
					// $this->email->send();
					$this->load->helper('mail');
					$email_status = send_mail($cep_details->email, 'CEP PROVIDER',$emailmessage, $bodycontentforCode);
					
						$updatenotification 				= array();
						$updatenotification['uniid'] 		= $cep_details->provider_id;
						$updatenotification['subject'] 		= 'CEP accreditation reviewed';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);
				
					//end mail function 
					// redirect('reviewer/reviewer/provideraccreditation', true);
					redirect('reviewer/reviewer/cep_details/'.$cep_details->provider_id, true);
				}
			}else{
				//$id = $this->input->post('uniid');
				validation_errors();
			}
		}

		$this->data = array(
			'title' => 'CE Provider Accreditation',
			'page_title' => 'CE Provider Accreditation',
			'table_name' => 'CE Provider Accreditation'
		);
		if(isset($flag)){
			$this->data['flag']=$flag;
		}

		$this->data['cep_details'] = $this->reviewer_payment->get_cep_details($id);
		$this->data['cepreviewdatails'] = $this->reviewer_payment->cepreviewdatails($this->session->userdata('login')['user_ID'],$id);
			
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/cep_details',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function reviewer_viewcourse($provider_id=null,$doc_id=null,$flag=null) 
	{ 
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'ct'){	
			redirect('login', true);
		} 
		$this->data = array( 'title' => 'Review Course Accreditation');
		
		if($this->input->post('cor_doc_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('unit', 'CE Units', 'trim|required');
			$this->form_validation->set_rules('cor_doc_id', 'course id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$cepemail 		= $this->input->post('cep_email');
				$cepname 		= $this->input->post('cep_name');

				$commentdata = array();
				$commentdata['comment'] 		= $this->input->post('comment');
				$commentdata['status'] 			= $this->input->post('status');
				$commentdata['cor_doc_id'] 		= $this->input->post('cor_doc_id');
				$commentdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$commentdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				$insrtcomment = $this->reviewer_payment->insertcoursereview($commentdata);
				
				$coursedetails = $this->reviewer_payment->get_row_object('tbl_course_documents','cor_doc_id',$this->input->post('cor_doc_id'));
				if($insrtcomment){
				$settingarr = $this->common_model->get_setting('1');	
				$update = array('reviewer_status'=>$this->input->post('status'),'review_date'=>date('Y-m-d H:i:s'));				
				$this->db->where('cor_doc_id',$this->input->post('cor_doc_id'));
				$this->db->update('tbl_course_documents',$update);
				$accreditation_no = '';
				
				if($this->input->post('status') == 1){
					$curstatus = 'Approved';
					$accreditation_no = 'COU'.date('Y').$this->input->post('provider_id').$this->input->post('cor_doc_id');

					//generate qrcode
					$qr_image = 'qrcode_'.$accreditation_no.'.png';
					$qr_url = base_url('assets/uploads/pdf/'.$accreditation_no.'.pdf');
					$params['data'] = $qr_url;
					$params['level'] = 'H';
					$params['size'] = 5;
					$params['savename'] = './assets/qrcode/'.$qr_image;
					$this->ciqrcode->generate($params);

					$accupdate = array('accreditation_no'=>$accreditation_no,'course_units'=>$this->input->post('unit'), 'cor_qrcode'=>$qr_image);				
					$this->db->where('cor_doc_id',$this->input->post('cor_doc_id'));
					$this->db->update('tbl_course_documents',$accupdate);
					
					// Genrate PDF start
					$html = ob_get_clean();
					$this->getcoursecertificatepdf($this->input->post('cor_doc_id'));
					// Get output html
					$html = $this->output->get_output();
					$this->load->library('Pdf');
					
					$this->dompdf->load_html($html);
					$this->dompdf->set_paper('letter','portrait');
					$this->dompdf->render();
					
					file_put_contents('assets/uploads/pdf/'.$accreditation_no.'.pdf', $this->dompdf->output($html));
					// $this->dompdf->stream("course.pdf",array('Attachment'=>0));die;
					// Genrate PDF End

					$download_link = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please copy and paste this accreditation number : '.$accreditation_no.' in this <a href="'.base_url('license/search').'"> link </a> to see and download the accreditation certificate of your online course.</p>';
					$accdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><table border="1">
					<tr><th>Accreditation No.: </th><td>'.$accreditation_no.'</td></tr>
					<tr><th>Date Issued.: </th><td>'.date('M d, Y',strtotime($coursedetails->review_accept_date)).'</td></tr>
					<tr><th>Validity Date.: </th><td>'.date('M d, Y',strtotime($coursedetails->expiry_at)).'</td></tr>
					</table></p>'.$download_link;

					/* It will help us to send online course acc details to ceonpoint and saved it. */
					$_SESSION['sessocaccnum'] = $accreditation_no;
					$_SESSION['sessocaccvalidity'] = $coursedetails->expiry_at;
				}
				if($this->input->post('status') == 2){
					$curstatus = 'Rejected';
					$accdetails = '';
				}

				///start mail function
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your Online Course('.$coursedetails->course_title.') has been reviewed and <b>'.$curstatus.'</b>.</p>'.$accdetails.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"> Should you have any question please contact us in this link and we will be happy to assist you.</p>';
				
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
						$this->email->to($cepemail);
						$this->email->subject('Online course review');
						$emailbody 					= array();
						$emailbody['name'] 			= $cepname;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						if(isset($accreditation_no) && file_exists('assets/uploads/pdf/'.$accreditation_no.'.pdf')){
							$this->email->attach(base_url('assets/uploads/pdf/'.$accreditation_no.'.pdf'));
							}
						// $this->email->send();
						$this->load->helper('mail');
					$email_status = send_mail($cepemail, 'Online course review',$emailmessage, $bodycontentforCode);
					
						///end mail function 
						
						$updatenotification 				= array();
						$updatenotification['uniid'] 		= $coursedetails->provider_id;
						$updatenotification['subject'] 		= 'Online Course Review';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);
					
					 redirect('reviewer/reviewer/onlinecourse', true);
					//redirect('reviewer/reviewer/reviewer_viewcourse/'.$coursedetails->provider_id.'/'.$coursedetails->cor_doc_id, true);
				}
			}else{
				// $doc_id = $this->input->post('cor_doc_id');
				validation_errors();
			} 
		}
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		$this->data['coursereviewdatails'] = $this->reviewer_payment->coursereviewdatails($doc_id);
		$this->data['course_details'] = $this->reviewer_payment->get_online_course_applcaition(array('c.cor_doc_id'=>$doc_id));
		$this->data['logs'] 		= $this->reviewer_payment->get_course_log($provider_id,$doc_id);
	
		$this->load->view('reviewer/common/header',$this->data); 
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/review_course',$this->data);
		$this->load->view('reviewer/common/footer');
	}


	public function trainingcourse(){
		//if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'ct'){
			redirect('login', true);
		} 
		$this->data = array('title' => 'Accredited Training Courses','page_title' => 'Accredited Training Courses');

		$where = array('t.reviewer_id'=>$this->session->userdata('login')['user_ID']);
		$this->data['training_course_application'] = $this->reviewer_payment->get_training_course_applcaition($where);
		// $this->data['training_course_application_count'] = $this->reviewer_payment->get_training_course_applcaition_count($where);
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/trainingcourse',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function trainingassignedreviewer(){
		$appid 			= $this->input->post('appid');
		$reviewer_id 	= $this->input->post('reviewer_id');
		// print_r($this->input->post());die;
		$assincou = array();
		$assincou['reviewer_id'] 			=  $reviewer_id;
		$assincou['review_accept_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->trainingassignedreviewerupdate($assincou,$appid);
		// echo  $this->db->last_query(); exit;
		echo  $appid; exit;
	}
	public function reviewer_trainingdoc($appid=null,$doc_id=null,$flag=null) 
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'ct'){	
			redirect('login', true);
		} 
		$this->data = array('title' => 'Review Training Accreditation');
		
		if($this->input->post('train_doc_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('unit', 'CE Units', 'trim|required');
			$this->form_validation->set_rules('train_doc_id', 'course id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$cepemail 		= $this->input->post('cep_email');
				$cepname 		= $this->input->post('cep_name');

				$commentdata = array();
				$commentdata['comment'] 		= $this->input->post('comment');
				$commentdata['status'] 			= $this->input->post('status');
				$commentdata['train_doc_id'] 	= $this->input->post('train_doc_id');
				$commentdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$commentdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				$insrtcomment = $this->reviewer_payment->inserttriningcommentsreview($commentdata);
				if($insrtcomment){
				$update = array('reviewer_status'=>$this->input->post('status'),'review_date'=>date('Y-m-d H:i:s'));
				$this->db->where('train_doc_id',$this->input->post('train_doc_id'));
				$this->db->update('tbl_training_documents',$update);
				
				
				$trainingdetails = $this->reviewer_payment->get_row_object('tbl_training_documents','train_doc_id',$this->input->post('train_doc_id'));
					///start mail function
						$accreditation_no = '';
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
							$accreditation_no = 'TRA'.date('Y').$this->input->post('provider_id').$this->input->post('train_doc_id');

							//Generate QrCode
							$qr_image = 'qrcode_'.$accreditation_no.'.png';
							$qr_url = base_url('assets/uploads/pdf/'.$accreditation_no.'.pdf');
							$params['data'] = $qr_url;
							$params['level'] = 'H';
							$params['size'] = 5;
							$params['savename'] = './assets/qrcode/'.$qr_image;
							$this->ciqrcode->generate($params);

							$accupdate = array('accreditation_no'=>$accreditation_no,'training_units'=>$this->input->post('unit'), 'train_qrcode'=>$qr_image);				
							$this->db->where('train_doc_id',$this->input->post('train_doc_id'));
							$this->db->update('tbl_training_documents',$accupdate);

							// Genrate PDF start
							$html = ob_get_clean();
							$this->gettrainingcertificatepdf($this->input->post('train_doc_id'));
							// Get output html
							$html = $this->output->get_output();
							$this->load->library('Pdf');
						
							$this->dompdf->load_html($html);
							$this->dompdf->set_paper('letter','portrait');
							$this->dompdf->render();
							
							file_put_contents('assets/uploads/pdf/'.$accreditation_no.'.pdf', $this->dompdf->output($html));
							// $this->dompdf->stream("school.pdf",array('Attachment'=>0));die;
							// Genrate PDF End

							$download_link = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please copy and paste this accreditation number : '.$accreditation_no.' in this <a href="'.base_url('license/search').'">link</a> to see and download the accreditation certificate of your training course.</p>';
							$accdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><table border="1">
							<tr><th>Accreditation No.: </th><td>'.$accreditation_no.'</td></tr>
							<tr><th>Date Issued.: </th><td>'.date('M d, Y',strtotime($trainingdetails->review_accept_date)).'</td></tr>
							<tr><th>Validity Date.: </th><td>'.date('M d, Y',strtotime($trainingdetails->expiry_at)).'</td></tr>
							</table></p>'.$download_link;

							/* It will help us to send training course acc details to ceonpoint and saved it. */
							$_SESSION['sesstcaccnum'] = $accreditation_no;
							$_SESSION['sesstcaccvalidity'] = $trainingdetails->expiry_at;
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
							$accdetails = '';
						}
						
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your Training('.$trainingdetails->training_title.') has been reviewed and <b>'.$curstatus.'</b>.</p>'.$accdetails.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"> Should you have any question please contact us in this link and we will be happy to assist you.</p>';
						$settingarr = $this->common_model->get_setting('1');	
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
						$this->email->to($cepemail);
						$this->email->subject('Training Course Review');
						$emailbody 					= array();
						$emailbody['name'] 			= $cepname;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						if(isset($accreditation_no) && file_exists('assets/uploads/pdf/'.$accreditation_no.'.pdf')){
							$this->email->attach(base_url('assets/uploads/pdf/'.$accreditation_no.'.pdf'));
							}
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($cepemail, 'Training course review',$emailmessage, $bodycontentforCode);
						
						$updatenotification 				= array();
						$updatenotification['uniid'] 		= $trainingdetails->provider_id;
						$updatenotification['subject'] 		= 'Training Course Review';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);
					///end mail function
					// redirect('reviewer/reviewer/trainingcourse', true);
					redirect('reviewer/reviewer/reviewer_trainingdoc/'.$trainingdetails->provider_id.'/'.$trainingdetails->train_doc_id, true);
				}
			}else{
				$doc_id = $this->input->post('train_doc_id');
				validation_errors();
			} 
		}
		if(isset($flag)){
			$this->data['flag']=$flag;
		}
		$this->data['trainingreviewdatails'] = $this->reviewer_payment->trainingreviewdatails($doc_id);
		$this->data['training_details'] = $this->reviewer_payment->get_trainingdetails(array('t.train_doc_id'=>$doc_id));	
		$this->data['logs'] 		= $this->reviewer_payment->get_training_log($appid,$doc_id);
		$this->load->view('reviewer/common/header',$this->data); 
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/reviewer_trainingdoc',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function grad_elig_cert_forreviewer(){
		$gradid = $_POST['docid'];
		$data['result'] = $this->reviewer_payment->grad_elig_cert_forreviewer($gradid);
		//print_r($data['result']);
		$this->load->view('admin/common/grad_elig_cert_forreviewer_blue',$data);
	}
	
	// request for verification of registration start
	public function requestverificationassignedreviewer(){
		$appid 			= $this->input->post('appid');
		$reviewer_id 	= $this->input->post('reviewer_id');
		// print_r($this->input->post());die;
		$assincou = array();
		$assincou['reviewer_id'] 			=  $reviewer_id;
		$assincou['review_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->requestverificationassignedreviewerupdate($assincou,$appid);
		// echo  $this->db->last_query(); exit;
		echo  $appid; exit;
	}
	public function view_requestforverification($ri_id){
		//echo $ri_id;
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'sub-admin'){	
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Request for Verification of Registration'
		);
		$this->data['requestverificationdocument'] = $this->reviewer_payment->requestverificationdocument($ri_id);
		$this->load->view('reviewer/common/header',$this->data); 
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/request_verification/request_verification_doc_view',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function verify_requestforverification($ri_id){
		//echo $ri_id;
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'sub-admin'){	
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Request for Verification of Registration'
		);
		
		if($this->input->post('ri_id') > 0){
			//print_r($_POST);exit;
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			//$this->form_validation->set_rules('unit', 'CE Units', 'trim|required');
			//$this->form_validation->set_rules('train_doc_id', 'course id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$profemail 		= $this->input->post('email');
				$proname 		= $this->input->post('proname');

				$commentdata = array();
				$commentdata['comment'] 		= $this->input->post('comment');
				$commentdata['status'] 			= $this->input->post('status');
				$commentdata['ri_id'] 			= $this->input->post('ri_id');
				$commentdata['user_id'] 		= $this->input->post('user_id');
				$commentdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$commentdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				$insrtcomment = $this->reviewer_payment->insertreceipientcommentsreview($commentdata);
				
				if($insrtcomment){
				$update = array('reviewer_status'=>$this->input->post('status'),'review_date'=>date('Y-m-d H:i:s'), 'review_comment'=>$this->input->post('comment'));
				$this->db->where('ri_id',$this->input->post('ri_id'));
				$this->db->update('tbl_receipient_information',$update);
				
				
				$receipientdetails = $this->reviewer_payment->get_row_object('tbl_receipient_information','ri_id',$this->input->post('ri_id'));
					///start mail function
						//$accreditation_no = '';
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
							//$accreditation_no = 'TRA'.date('Y').$this->input->post('provider_id').$this->input->post('train_doc_id');
							//$accupdate = array('accreditation_no'=>$accreditation_no,'training_units'=>$this->input->post('unit'));				
							//$this->db->where('train_doc_id',$this->input->post('train_doc_id'));
							//$this->db->update('tbl_training_documents',$accupdate);

							// Genrate PDF start
							//$this->gettrainingcertificatepdf($this->input->post('train_doc_id'));
							// Get output html
							//$html = $this->output->get_output();
							//$this->load->library('Pdf');
						
							//$this->dompdf->load_html($html);
							//$this->dompdf->set_paper('letter','portrait');
							//$this->dompdf->render();
							
							//file_put_contents('assets/uploads/pdf/'.$accreditation_no.'.pdf', $this->dompdf->output($html));
							// $this->dompdf->stream("school.pdf",array('Attachment'=>0));die;
							// Genrate PDF End

							//$download_link = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please copy and paste this accreditation number : '.$accreditation_no.' in this <a href="'.base_url('license/search').'">link</a> to see and download the accreditation certificate of your training course.</p>';
							/*$accdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><table border="1">
							<tr><th>Accreditation No.: </th><td>'.$accreditation_no.'</td></tr>
							<tr><th>Date Issued.: </th><td>'.date('M d, Y',strtotime($trainingdetails->review_accept_date)).'</td></tr>
							<tr><th>Validity Date.: </th><td>'.date('M d, Y',strtotime($trainingdetails->expiry_at)).'</td></tr>
							</table></p>'.$download_link;*/
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
							$accdetails = '';
						}
						
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your Request for Verification of Registration has been reviewed and <b>'.$curstatus.'</b>.</p><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"> Should you have any question please contact us in this link and we will be happy to assist you.</p>';
						$settingarr = $this->common_model->get_setting('1');	
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
						$this->email->to($profemail);
						$this->email->subject('Request for Verification of Registration Review');
						$emailbody 					= array();
						$emailbody['name'] 			= $proname;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($profemail, 'Request for Verification of Registration Review',$emailmessage, $bodycontentforCode);
						
						/*if(isset($accreditation_no) && file_exists('assets/uploads/pdf/'.$accreditation_no.'.pdf')){
							$this->email->attach(base_url('assets/uploads/pdf/'.$accreditation_no.'.pdf'));
							}
						$this->email->send();*/
						$updatenotification 				= array();
						$updatenotification['ri_id'] 		= $receipientdetails->ri_id;
						$updatenotification['subject'] 		= 'Request for Verification of Registration Review';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$inserted = $this->common_model->insertnotifications('tbl_receipient_notifications',$updatenotification);
					///end mail function
					
						return redirect(base_url('reviewer/reviewer/reviewed_listing'));
					
				}
			} 
		}

		$this->data['requestverificationdocument'] = $this->reviewer_payment->requestverificationdocument($ri_id);
		$this->load->view('reviewer/common/header',$this->data); 
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/request_verification/request_verification_doc',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	
	public function requestverificationlisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Request for Verification of Registration',
			'page_title' => 'Request for Verification of Registration',
			'table_name' => 'Request for Verification of Registration'
		);
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['receipient_information'] = $this->reviewer_payment->get_receipient_information('','1',$uid,'y');
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/requestverificationlisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function requestverificationforpopup()
	{
		$schid = $_POST['schid'];
		$application = $this->reviewer_payment->requestverificationdocument($schid);
		//print_r($application);exit;
		$logo = '<div class="border border-primary"><img
				src="'.base_url('assets/images/university/default-logo.png').'"
				width="100%"></div>';
		if($application->image !="" && file_exists('./assets/uploads/profile/'.$application->image)){	
		$logo ='<div class="border border-primary"><img
				src="'.base_url('assets/uploads/profile/').$application->image.'"
				width="100%"></div>';
		}
		
		//if($cep_details->document_for=='n'){$doc_for='<h3>New</h3>';}else{$doc_for='<h3>Re-New</h3>';}
		echo 	'<div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                '.$logo.'   
                            </div>
							<div class="col-md-10">
                                <h4>'.ucwords(!empty($application)?$application->fname.' '.$application->lname.' '.$application->name:"--").
                                '</h4>
                                <p><b>Profession:</b>
                                    '.(!empty($application)?$application->profession_name:"").
                                    '<br><b>License No:</b>
                                    '.(!empty($application->license_no)?$application->license_no:$application->license_no).'<br>
                                    <b>Validity:</b>
                                    '.(($application->license_validity_date != '0000-00-00')?date('M d,Y',strtotime($application->license_validity_date)):'N/A').'
                                </p>
                            </div>                           
                        </div>
                </div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Name :</label>
						</div>
						<div class="col-sm-8">
							'.(($application->insname)?$application->insname:'N/A').'
						</div>                           
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Address :</label>
						</div>
						<div class="col-sm-8">
							'.(($application->insaddress)?$application->insaddress:'N/A').'
						</div>                           
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Country :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application->country)?$application->country:"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Email :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application->insemail)?$application->insemail:"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Purpose :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application->inspurpose)?$application->inspurpose:"N/A").'
						</div>                           
					</div>
					</div>'	;
	}
	// request for verification of registration end
	// request for certificate of good standing start
	public function req_good_stand_assigned_reviewer(){
		$appid 			= $this->input->post('appid');
		$reviewer_id 	= $this->input->post('reviewer_id');
		// print_r($this->input->post());die;
		$assincou = array();
		$assincou['reviewer_id'] 			=  $reviewer_id;
		$assincou['review_date'] 	=  date('Y-m-d H:i:d');
		$result = $this->reviewer_payment->req_good_stand_reviewer_update($assincou,$appid);
		// echo  $this->db->last_query(); exit;
		echo  $appid; exit;
	}
	public function view_requestforgoodstand($gs_id){
		//echo $ri_id;
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'sub-admin'){	
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Request for Certificate of Good Standing'
		);
		$this->data['reqgoodstanddoc'] = $this->reviewer_payment->requestgoodstanddocument($gs_id);
		$this->load->view('reviewer/common/header',$this->data); 
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/good_stand/good_stand_doc_view',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function verify_req_for_good_standing($gs_id){
		//echo $ri_id;
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['user_type'] != 'sub-admin'){	
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Request for Certificate of Good Standing'
		);
		
		if($this->input->post('gs_id') > 0){
			//print_r($_POST);exit;
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			//$this->form_validation->set_rules('unit', 'CE Units', 'trim|required');
			//$this->form_validation->set_rules('train_doc_id', 'course id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$profemail 		= $this->input->post('email');
				$proname 		= $this->input->post('proname');

				$commentdata = array();
				$commentdata['comment'] 		= $this->input->post('comment');
				$commentdata['status'] 			= $this->input->post('status');
				$commentdata['gs_id'] 			= $this->input->post('gs_id');
				$commentdata['user_id'] 		= $this->input->post('user_id');
				$commentdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$commentdata['reviewed_at'] 	= date('Y-m-d H:i:s');
				$insrtcomment = $this->reviewer_payment->insert_good_standing_commentsreview($commentdata);
				
				if($insrtcomment){
				$update = array('reviewer_status'=>$this->input->post('status'),'review_date'=>date('Y-m-d H:i:s'), 'review_comment'=>$this->input->post('comment'));
				$this->db->where('gs_id',$this->input->post('gs_id'));
				$this->db->update('tbl_good_standing',$update);
				
				
				$pro_gsdetails = $this->reviewer_payment->get_row_object('tbl_good_standing','gs_id',$this->input->post('gs_id'));
					///start mail function
						//$accreditation_no = '';
						
						if($this->input->post('status') == 1){
							$ref_code = '';
							$curstatus = 'Approved';
							//$accreditation_no = 'TRA'.date('Y').$this->input->post('provider_id').$this->input->post('train_doc_id');
							//$accupdate = array('accreditation_no'=>$accreditation_no,'training_units'=>$this->input->post('unit'));				
							//$this->db->where('train_doc_id',$this->input->post('train_doc_id'));
							//$this->db->update('tbl_training_documents',$accupdate);
							$ref_code = $pro_gsdetails->refrence_code;

							//Generate QRcode
							$qr_image = 'qrcode_'.$ref_code.'.png';
							$qr_url = base_url('assets/uploads/pdf/'.$ref_code.'.pdf');
							$params['data'] = $qr_url;
							$params['level'] = 'H';
							$params['size'] = 5;
							$params['savename'] = './assets/qrcode/'.$qr_image;
							$this->ciqrcode->generate($params);
							
							//$qrcodeupdate = array();
							$qrcodeupdate['gs_qrcode'] = $qr_image;
							$this->db->where('gs_id',$this->input->post('gs_id'));
							$this->db->update('tbl_good_standing', $qrcodeupdate);
							
							// Genrate PDF start
							$html = ob_get_clean();
							$html = $this->get_goodstanding_certificatepdf($this->input->post('gs_id'));
							// Get output html
							$html .= $this->output->get_output();
							//echo $html; exit;
							$this->load->library('Pdf');
							$this->dompdf = new DOMPDF();
							$this->dompdf->load_html($html);
							$this->dompdf->set_paper('letter','portrait');
							$this->dompdf->render();
							
							file_put_contents('assets/uploads/pdf/'.$ref_code.'.pdf', $this->dompdf->output($html));
							//$this->dompdf->stream("school.pdf",array('Attachment'=>0));die;
							// Genrate PDF End
							
							

							$download_link = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please copy and paste this Refrence number : <b>'.$ref_code.'</b> in this <a href="'.base_url('license/search').'">link</a> to see and download the Good Standing Certificate.</p>';
							/*$accdetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><table border="1">
							<tr><th>Accreditation No.: </th><td>'.$accreditation_no.'</td></tr>
							<tr><th>Date Issued.: </th><td>'.date('M d, Y',strtotime($trainingdetails->review_accept_date)).'</td></tr>
							<tr><th>Validity Date.: </th><td>'.date('M d, Y',strtotime($trainingdetails->expiry_at)).'</td></tr>
							</table></p>'.$download_link;*/
						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';
							$download_link = '';
						}
						
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your Request for Certificate of Good Standing has been reviewed and <b>'.$curstatus.'</b>.</p>'.$download_link.'<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"> Should you have any question please contact us in this link and we will be happy to assist you.</p>';
						$settingarr = $this->common_model->get_setting('1');	
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
						$this->email->to($profemail);
						$this->email->subject('Request for Certificate of Good Standing Review');
						$emailbody 					= array();
						$emailbody['name'] 			= $proname;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						//$this->email->send();
						if(isset($ref_code) && file_exists('assets/uploads/pdf/'.$ref_code.'.pdf')){
							$this->email->attach(base_url('assets/uploads/pdf/'.$ref_code.'.pdf'));
							}
						// $this->email->send();
						$this->load->helper('mail');
						$email_status = send_mail($profemail, 'Request for Certificate of Good Standing Review',$emailmessage, $bodycontentforCode);
						
						$updatenotification 				= array();
						$updatenotification['gs_id'] 		= $pro_gsdetails->gs_id;
						$updatenotification['subject'] 		= 'Request for Certificate of Good Standing Review';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$insert_id = $this->common_model->insertnotifications('tbl_goodstanding_notifications',$updatenotification);
					///end mail function 					
					redirect('reviewer/reviewer/reviewed_listing', true);
				}
			} 
		}
		$this->data['reqgoodstanddoc'] = $this->reviewer_payment->requestgoodstanddocument($gs_id);
		$this->load->view('reviewer/common/header',$this->data); 
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/good_stand/good_stand_doc',$this->data);
		$this->load->view('reviewer/common/footer');
	}

	public function requestgoodstandinglisting(){
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		} 
		$this->data = array(
			'title' => 'Request for Certificate of Good Standing',
			'page_title' => 'Request for Certificate of Good Standing',
			'table_name' => 'Request for Certificate of Good Standing'
		);
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['reqforgoodstand'] = $this->reviewer_payment->get_reqforgoodstand('','1',$uid,'y');
		
		$this->load->view('reviewer/common/header',$this->data);
		$this->load->view('reviewer/common/sidebar');
		$this->load->view('reviewer/online_applications/requestgoodstandlisting',$this->data);
		$this->load->view('reviewer/common/footer');
	}
	public function req_goodstand_forpopup()
	{
		$schid = $_POST['schid'];
		$application = $this->reviewer_payment->requestgoodstanddocument($schid);
		//print_r($application);exit;
		$logo = '<div class="border border-primary"><img
				src="'.base_url('assets/images/university/default-logo.png').'"
				width="100%"></div>';
		if($application->image !="" && file_exists('./assets/uploads/profile/'.$application->image)){	
		$logo ='<div class="border border-primary"><img
				src="'.base_url('assets/uploads/profile/').$application->image.'"
				width="100%"></div>';
		}
		
		//if($cep_details->document_for=='n'){$doc_for='<h3>New</h3>';}else{$doc_for='<h3>Re-New</h3>';}
		echo 	'<div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                '.$logo.'   
                            </div>
							<div class="col-md-10">
                                <h4>'.ucwords(!empty($application)?$application->fname.' '.$application->lname.' '.$application->name:"--").
                                '</h4>
                                <p><b>Profession:</b>
                                    '.(!empty($application)?$application->profession_name:"").
                                    '<br><b>License No:</b>
                                    '.(!empty($application->license_no)?$application->license_no:$application->license_no).'<br>
                                    <b>Validity:</b>
                                    '.(($application->license_validity_date != '0000-00-00')?date('M d,Y',strtotime($application->license_validity_date)):'N/A').'
                                </p>
                            </div>                           
                        </div>
                </div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Name :</label>
						</div>
						<div class="col-sm-8">
							'.(($application->insname)?$application->insname:'N/A').'
						</div>                           
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Address :</label>
						</div>
						<div class="col-sm-8">
							'.(($application->insaddress)?$application->insaddress:'N/A').'
						</div>                           
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Country :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application->country)?$application->country:"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Institute Email :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application->insemail)?$application->insemail:"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Purpose :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application->inspurpose)?$application->inspurpose:"N/A").'
						</div>                           
					</div>
					</div>'	;
	}
	// request for certificate of good standing new

	/* send course preapproved feedback to cep on his email*/
	public function send_course_changes(){
		$cepid = $this->input->post('cep_provider_id');
		$courseid = $this->input->post('course_id');
		$saveData = [
			'provider_id'   => $cepid,
			'course_id' 	=> $courseid,
			'changes' 		=> $this->input->post('changes'),
			'pdf_file' 		=> $this->input->post('course_pdf'),
			'reviewer_id' 	=> $this->session->userdata('login')['user_ID'],
			'reviewer_email'=> $this->session->userdata('login')['username'],
			'added_on' 		=> date('Y-m-d H:i:s')
		];
		$this->reviewer_payment->saveFeedbackOfcourse($saveData);

		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your application for Course accreditation has been reviewed successfully.<br><strong> We found some issues in it. required changes are below:</strong></p>
		<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$this->input->post('changes').'</p>
		<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please fix those issues and resubmit the pdf file on same application.</p>
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
		$this->email->to($this->input->post('cep_email'));
		$this->email->subject('Course Feedback:'.$this->input->post('course_title'));
		$emailbody 					= array();
		$emailbody['name'] 			= $this->input->post('cep_name');
		$emailbody['thanksname'] 	= $settingarr->signature_name;
		$emailbody['thanks2'] 		= '';
		$emailbody['thanks3'] 		= $settingarr->position;
		$emailbody['body_msg'] 		= $bodycontentforCode;
		$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
		$this->email->message($emailmessage);
		// $this->email->send();
		$this->load->helper('mail');
		$email_status = send_mail($this->input->post('cep_email'), 'Course Feedback',$emailmessage, $bodycontentforCode);
		
		//insert in notification
		$updatenotification 				= array();
		$updatenotification['uniid'] 		= $cepid;
		$updatenotification['subject'] 		= 'Course Feedback:'.$this->input->post('course_title');
		$updatenotification['message'] 		= $bodycontentforCode;
		$updatenotification['from'] 		= SENDER_NAME;
		$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
		$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
		$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);
	
		redirect(base_url('reviewer/reviewer/reviewer_viewcourse/'.$cepid.'/'.$courseid), 'refresh');	
	}				

	/* send training preapproved feedback to cep on his email*/
	public function send_training_changes(){
		$cepid = $this->input->post('cep_provider_id');
		$trainingid = $this->input->post('training_id');
		$saveData = [
			'provider_id'   => $cepid,
			'training_id' 	=> $trainingid,
			'changes' 		=> $this->input->post('changes'),
			'pdf_file' 		=> $this->input->post('training_pdf'),
			'reviewer_id' 	=> $this->session->userdata('login')['user_ID'],
			'reviewer_email'=> $this->session->userdata('login')['username'],
			'added_on' 		=> date('Y-m-d H:i:s')
		];
		$this->reviewer_payment->saveFeedbackOftraining($saveData);

		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your application for Training accreditation has been reviewed successfully.<br><strong> We found some issues in it. required changes are below:</strong></p>
		<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$this->input->post('changes').'</p>
		<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please fix those issues and resubmit the pdf file on same application.</p>
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
		$this->email->to($this->input->post('cep_email'));
		$this->email->subject('Training Feedback:'.$this->input->post('training_title'));
		$emailbody 					= array();
		$emailbody['name'] 			= $this->input->post('cep_name');
		$emailbody['thanksname'] 	= $settingarr->signature_name;
		$emailbody['thanks2'] 		= '';
		$emailbody['thanks3'] 		= $settingarr->position;
		$emailbody['body_msg'] 		= $bodycontentforCode;
		$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);	
		$this->email->message($emailmessage);
		// $this->email->send();
		$this->load->helper('mail');
		$email_status = send_mail($this->input->post('cep_email'), 'Training Feedback:'.$this->input->post('training_title'),$emailmessage, $bodycontentforCode);
		
		//insert in notification
		$updatenotification 				= array();
		$updatenotification['uniid'] 		= $cepid;
		$updatenotification['subject'] 		= 'Training Feedback:'.$this->input->post('training_title');
		$updatenotification['message'] 		= $bodycontentforCode;
		$updatenotification['from'] 		= SENDER_NAME;
		$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
		$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
		$this->common_model->insertnotifications('tbl_provider_notifications',$updatenotification);
	
		redirect(base_url('reviewer/reviewer/reviewer_trainingdoc/'.$cepid.'/'.$trainingid), 'refresh');	
	}	
	
	public function test(){
		$html_message = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
                .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
                .header { font-size: 24px; font-weight: bold; margin-bottom: 10px; color: #333; }
                .content { font-size: 16px; color: #555; }
                .footer { margin-top: 20px; font-size: 14px; color: #999; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">Test Email</div>
                <div class="content">
                    <p>This is a test email sent from the <strong>send_mail</strong> helper in CodeIgniter.</p>
                    <p><strong>Message:</strong></p>
                    <p>test mail</p>
                </div>
                <div class="footer">Best regards,<br>RTMS Mailer</div>
            </div>
        </body>';

		$this->load->helper('mail');
		$email_status = send_mail('tester4545@yopmail.com', 'Exam booked successfully.',$html_message, ['1','2']);
		if($email_status){
			echo"send success";
		}else{
			echo"send faild";
		}
	}
}

?>