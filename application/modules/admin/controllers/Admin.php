<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');



class Admin extends MX_Controller {
	
	var $data = array();
	public function __construct(){
		parent:: __construct();
		$this->check_session();
		$this->load->model('Admin_model','admin');
		$this->load->model('Professional_model');
		$this->load->model('reviewer/Reviewer_payment_model','reviewer_modal');
		$this->load->model('examiner/examiner_model','examiner');
		$this->load->model('proctor/proctor_model','proctor');
		$this->load->model('cms_model');
		$this->load->model('faqs_model');
		$this->load->model('professional/Applicant_model','applicant');
		$this->load->library('upload');
		$this->load->library('ciqrcode');		
		//rboard check 
		// $subscription = $this->common_model->get_admin_subscription_details();
		// $this->subscription = $subscription; 
		// if($subscription->rb_sub_key == ""){
		// $this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
		// 	redirect(base_url('contactus'), 'refresh');		
		// }
		// if($subscription->total_application <= $this->common_model->get_online_application_count()){
		// 	$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
		// 	redirect(base_url('contactus'), 'refresh');	
		// }
		//end rboard check 
	}
	public function test(){
		echo ' redirection test';
		return redirect (base_url('admin/dashboard'));
	}
	public function dashboard()
	{		
		$data['title'] 		= 'Admin Dashboard';
		$data['count_cep'] 	= $this->admin->count_rows('tbl_cep','status','1');

		$data['count_professional'] = $this->admin->count_rows('tbl_users','','');
		$data['count_profession'] 	= $this->admin->count_rows('tbl_profession','status','1');
		$data['count_country'] 		= $this->admin->count_rows('tbl_countries','status','1');
		$data['todayincome'] 		= $this->common_model->sumincomereport('','today');
		$data['monthlyincome'] 		= $this->common_model->sumincomereport('','monthly');
		$data['anualincome'] 		= $this->common_model->sumincomereport('','anual');
		$data['lifetimeincome'] 	= $this->common_model->sumincomereport('','');	 
		
		$data['total_school'] 		= $this->common_model->get_count_record('tbl_university');	
		$data['total_graduates'] 	= $this->common_model->get_count_record('graduates');	
		$data['total_ceps'] 		= $this->common_model->get_count_record('tbl_ce_provider');	
		$data['total_course'] 		= $this->common_model->get_count_record('tbl_course_documents');	
		$data['total_training'] 	= $this->common_model->get_count_record('tbl_training_documents');	
		$data['total_digital_certificates'] = $this->common_model->get_count_record('tbl_training_documents');

		//PROFESSIONALS	
		$data['total_professionals'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','u.status'=>'1'));
		
		$data['total_local_professionals'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','u.status'=>'1','u.role'=>'L'));

		$data['total_foreign_professionals_withexam'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','u.status'=>'1','u.role'=>'F'));

		$data['total_foreign_professionals_withoutexam'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','u.status'=>'1','u.role'=>'P'));
		
		$data['total_foreign_professionals'] = $data['total_foreign_professionals_withexam'] + $data['total_foreign_professionals_withoutexam']; 
		
		$data['total_pending_license'] = $this->common_model->get_professional_licence_count(array('pl.payment_status <'=>'1','u.status'=>'1'));
				
		$data['total_valid_license'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','pl.lic_expiry_date >='=>date('Y-m-d'),'u.status'=>'1'));	
		/* echo $this->db->last_query(); 
		exit; */		
		$data['total_expired_license'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','lic_expiry_date <' => date('Y-m-d'),'u.status'=>'1'));	
		$data['total_suspended_license'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','u.status'=>'3'));	
		$data['total_revoked_license'] = $this->common_model->get_professional_licence_count(array('pl.payment_status'=>'1','u.status'=>'4'));	
		//end PROFESSIONALS
		
		$data['total_reviewer_course'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'ct'));	
		$data['total_reviewer_schoolcep'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'sub-admin'));	
		$data['total_reviewer_professional'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'p'));
		$data['total_reviewer_examiners'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'e'));

		//for school
		$data['total_school_accreditation'] = $this->common_model->get_count_record('tbl_university_documents',array('reviewer_status <'=>'1','document_for'=>'n','refrence_code !='=>''));	
		$data['total_school_accreditation_approved'] = $this->common_model->get_count_record('tbl_university_documents',array('reviewer_status'=>'1','document_for'=>'n','refrence_code !='=>''));	
		$data['total_school_accreditation_rejected'] = $this->common_model->get_count_record('tbl_university_documents',array('reviewer_status'=>'2','document_for'=>'n','refrence_code !='=>''));
		
		$data['total_school_accreditation_renewal'] = $this->common_model->get_count_record('tbl_university_documents',array('reviewer_status <'=>'1','document_for'=>'r','refrence_code !='=>''));	
		$data['total_school_accreditation_renewal_approved'] = $this->common_model->get_count_record('tbl_university_documents',array('reviewer_status'=>'1','document_for'=>'r','refrence_code !='=>''));	
		$data['total_school_accreditation_renewal_rejected'] = $this->common_model->get_count_record('tbl_university_documents',array('reviewer_status'=>'2','document_for'=>'r','refrence_code !='=>''));	
		//end for school
		
		//for submition of graduates
		$data['total_graduates'] = $this->common_model->get_count_record('graduates',array('reviewer_status <'=>'1','refrence_code !='=>''));	
		$data['total_graduates_approved'] = $this->common_model->get_count_record('graduates',array('reviewer_status'=>'1','refrence_code !='=>''));	
		$data['total_graduates_rejected'] = $this->common_model->get_count_record('graduates',array('reviewer_status'=>'2','refrence_code !='=>''));	
		//end for submition of graduates
		
		// for LOCAL PROFESSIONAL REGISTRATION
		$data['total_local_professional'] = $this->common_model->get_count_record('tbl_users',array('role'=>'L'));		
		// end for LOCAL PROFESSIONAL REGISTRATION
		
		// for PROFESSIONAL REGISTRATION
		//$data['total_foreign_professional'] = $this->common_model->get_count_record('tbl_users',array('role'=>'F'));
		$data['total_professional_registration'] = $this->common_model->get_professional_registration_count(array('pt.payment_type'=>'N','pt.txn_id !='=>''));
		/* echo $this->db->last_query(); 
		exit; */
		// end for PROFESSIONAL REGISTRATION
		
		// for BOOKING FOR LICENSURE EXAM (GRADUATES)
		$data['total_booking_for_licensure_exam_graduates'] = $this->common_model->get_count_record('tbl_book_exam',array('booking_for'=>'p','payment'=>'1'));
		
		// end for PROFESSIONAL REGISTRATION
		
		// for BOOKING FOR LICENSURE EXAM (FOREIGN PROFESSIONAL)
		$data['total_booking_for_licensure_exam_foreign_professional'] = $this->common_model->get_count_record('tbl_book_exam',array('booking_for'=>'pp','payment'=>'1'));
		// end for PROFESSIONAL REGISTRATION
		
		// for FOREIGN PROFESSIONAL REGISTRATION
		//$data['total_foreign_professional'] = $this->common_model->get_count_record('tbl_users',array('role'=>'F'));
		$data['total_new_foreign_professional'] = $this->common_model->get_professional_count(array('u.role'=>'F','pd.reviewer_status <'=>'1','pd.document_for'=>'n','pd.refrence_code !='=>''));
		//echo $this->db->last_query();  exit;
		$data['total_approved_foreign_professional'] = $this->common_model->get_professional_count(array('u.role'=>'F','pd.reviewer_status'=>'1','pd.document_for'=>'n','pd.refrence_code !='=>''));
		$data['total_reject_foreign_professional'] = $this->common_model->get_professional_count(array('u.role'=>'F','pd.reviewer_status'=>'2','pd.document_for'=>'n','pd.refrence_code !='=>''));
		// end for FOREIGN PROFESSIONAL REGISTRATION
		
		
		// for FOREIGN PROFESSIONAL REGISTRATION licensse
		//$data['total_licensse_renewal'] = $this->common_model->get_count_licensse_renewal_record();	
		$data['total_new_foreign_professional_renewal'] = $this->common_model->get_professional_count(array('pd.reviewer_status <'=>'1','pd.document_for'=>'r','pd.refrence_code !='=>''));
		//echo $this->db->last_query();  exit;
		$data['total_approved_foreign_professional_renewal'] = $this->common_model->get_professional_count(array('pd.reviewer_status'=>'1','pd.document_for'=>'r','pd.refrence_code !='=>''));
		$data['total_reject_foreign_professional_renewal'] = $this->common_model->get_professional_count(array('pd.reviewer_status'=>'2','pd.document_for'=>'r','pd.refrence_code !='=>''));
		// end for FOREIGN PROFESSIONAL REGISTRATION
		
		
		// for FOREIGN PROFESSIONAL REVIEW FOR EXAMINATION
		//$data['total_foreign_professional'] = $this->common_model->get_count_record('tbl_users',array('role'=>'P'));
		$data['total_new_foreign_professional_review_for_examination'] = $this->common_model->get_professional_count(array('u.role'=>'P','pd.reviewer_status <'=>'1','pd.document_for'=>'n','pd.refrence_code !='=>''));
		//echo $this->db->last_query();  exit;
		$data['total_approved_foreign_professional_review_for_examination'] = $this->common_model->get_professional_count(array('u.role'=>'P','pd.reviewer_status'=>'1','pd.document_for'=>'n','pd.refrence_code !='=>''));
		$data['total_reject_foreign_professional_review_for_examination'] = $this->common_model->get_professional_count(array('u.role'=>'P','pd.reviewer_status'=>'2','pd.document_for'=>'n','pd.refrence_code !='=>''));
		// end for FOREIGN PROFESSIONAL REVIEW FOR EXAMINATION

			
		// for FOREIGN PROFESSIONAL REVIEW FOR REGISTRATION
		//$data['total_foreign_professional'] = $this->common_model->get_count_record('tbl_users',array('role'=>'P'));
		$data['total_new_foreign_professional_review_for_registration'] = $this->common_model->get_professional_count(array('u.role'=>'F','pd.reviewer_status <'=>'1','pd.document_for'=>'n','pd.refrence_code !='=>''));
		//echo $this->db->last_query();  exit;
		$data['total_approved_foreign_professional_review_for_registration'] = $this->common_model->get_professional_count(array('u.role'=>'F','pd.reviewer_status'=>'1','pd.document_for'=>'n','pd.refrence_code !='=>''));
		$data['total_reject_foreign_professional_review_for_registration'] = $this->common_model->get_professional_count(array('u.role'=>'F','pd.reviewer_status'=>'2','pd.document_for'=>'n','pd.refrence_code !='=>''));
		// end for FOREIGN PROFESSIONAL REVIEW FOR REGISTRATION


		// for CEP
		//$data['total_cep_accreditation'] = $this->common_model->get_count_record('tbl_ce_provider');	
		$data['total_new_cep'] = $this->common_model->get_count_record('tbl_cep_documents',array('reviewer_status <'=>'1','document_for'=>'n','reference_no!='=>''));
		$data['total_approved_cep'] = $this->common_model->get_count_record('tbl_cep_documents',array('reviewer_status'=>'1','document_for'=>'n','reference_no!='=>''));
		$data['total_reject_cep'] = $this->common_model->get_count_record('tbl_cep_documents',array('reviewer_status'=>'2','document_for'=>'n','reference_no!='=>''));
		
		$data['total_new_renew_cep'] = $this->common_model->get_count_record('tbl_cep_documents',array('reviewer_status <'=>'1','document_for'=>'r','reference_no!='=>''));
		$data['total_approved_renew_cep'] = $this->common_model->get_count_record('tbl_cep_documents',array('reviewer_status'=>'1','document_for'=>'r','reference_no!='=>''));
		$data['total_reject_renew_cep'] = $this->common_model->get_count_record('tbl_cep_documents',array('reviewer_status'=>'2','document_for'=>'r','reference_no!='=>''));
		// end CEP
		
		//for course
		$data['total_new_course'] = $this->common_model->get_count_record('tbl_course_documents',array('reviewer_status <'=>'1','document_for'=>'n','refrence_code !='=>''));
		$data['total_approved_course'] = $this->common_model->get_count_record('tbl_course_documents',array('reviewer_status'=>'1','document_for'=>'n','refrence_code !='=>''));
		$data['total_reject_course'] = $this->common_model->get_count_record('tbl_course_documents',array('reviewer_status'=>'2','document_for'=>'n','refrence_code !='=>''));
		//end for course
		
		//for training
		$data['total_new_training'] = $this->common_model->get_count_record('tbl_training_documents',array('reviewer_status <'=>'1','document_for'=>'n','refrence_code !='=>''));
		$data['total_approved_training'] = $this->common_model->get_count_record('tbl_training_documents',array('reviewer_status'=>'1','document_for'=>'n','refrence_code !='=>''));
		$data['total_reject_training'] = $this->common_model->get_count_record('tbl_training_documents',array('reviewer_status'=>'2','document_for'=>'n','refrence_code !='=>''));
		//end for training
		
		$data['total_media'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'m'));
		$data['total_cashier'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'c'));
		$data['total_proctor'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'p'));	
		$data['total_foreign_proctor'] = $this->common_model->get_count_record('tbl_admin',array('user_type'=>'pp'));	
		$data['get_examschedule_graducate'] 		= $this->common_model->get_examschedule('p');	//graducate
		$data['get_examschedule_professional'] 		= $this->common_model->get_examschedule('pp');	//Foreign Professionals
		$data['get_bookedexam_forign_pro'] 	= $this->common_model->get_bookedexam('pp');	
		$data['get_bookedexam'] 			= $this->common_model->get_bookedexam('p');	
		$data['get_passedexam'] 			= $this->common_model->get_passedexam();	
		//echo '<pre>'; print_r($data['get_bookedexam_forign_pro']); exit;
		// for notification section 
		$data['total_Inquiry'] = $this->common_model->get_count_record('tbl_contact',array('subject'=>'Inquiry'));	
		$data['total_Testimonial'] = $this->common_model->get_count_record('tbl_contact',array('subject'=>'Testimonial'));	
		$data['total_Complaint'] = $this->common_model->get_count_record('tbl_contact',array('subject'=>'Complaint'));	
		$data['total_Refund'] = $this->common_model->get_count_record('tbl_contact',array('subject'=>'Refund'));	
		$data['total_Suggestion'] = $this->common_model->get_count_record('tbl_contact',array('subject'=>'Suggestion'));	
		$data['total_Verification'] = $this->common_model->get_count_record('tbl_contact',array('subject'=>'Verification'));
		$data['total_school_notification'] = $this->common_model->get_count_record('tbl_university_notifications');	
		$data['total_cep_notification'] = $this->common_model->get_count_record('tbl_provider_notifications');	
		$data['total_professional_notification'] = $this->common_model->get_count_record('tbl_professional_notifications');	
		// end for notification section 

		//Admin subscription Tracker
		$data['subscrition_list'] = $this->admin->get_admin_all_subscription_details();

		// accreditation
			//for university
		$data['total_valid_accreditated_school'] = $this->common_model->get_count_accreditation('tbl_university', array('status'=>'1'));
		$data['total_expired_accreditated_school'] = $this->common_model->get_count_accreditation('tbl_university', array('status'=>'2'));
		$data['total_suspended_accreditated_school'] = $this->common_model->get_count_accreditation('tbl_university', array('status'=>'3'));
		$data['total_revoked_accreditated_school'] = $this->common_model->get_count_accreditation('tbl_university', array('status'=>'4'));
			//for cep 
		$data['total_valid_accreditated_cep'] = $this->common_model->get_count_accreditation('tbl_ce_provider', array('status'=>'1'));
		$data['total_expired_accreditated_cep'] = $this->common_model->get_count_accreditation('tbl_ce_provider', array('status'=>'2'));
		$data['total_suspended_accreditated_cep'] = $this->common_model->get_count_accreditation('tbl_ce_provider', array('status'=>'3'));
		$data['total_revoked_accreditated_cep'] = $this->common_model->get_count_accreditation('tbl_ce_provider', array('status'=>'4'));
			//for online course
		$data['total_valid_accreditated_onlinecourse'] = $this->common_model->get_count_accreditation('tbl_course', array('status'=>'1'));
		$data['total_expired_accreditated_onlinecourse'] = $this->common_model->get_count_accreditation('tbl_course', array('status'=>'2'));
		$data['total_suspended_accreditated_onlinecourse'] = $this->common_model->get_count_accreditation('tbl_course', array('status'=>'3'));
		$data['total_revoked_accreditated_onlinecourse'] = $this->common_model->get_count_accreditation('tbl_course', array('status'=>'4'));
			//for online traning
		$data['total_valid_accreditated_onlinetraning'] = $this->common_model->get_count_accreditation('tbl_training', array('status'=>'1'));
		$data['total_expired_accreditated_onlinetraning'] = $this->common_model->get_count_accreditation('tbl_training', array('status'=>'2'));
		$data['total_suspended_accreditated_onlinetraning'] = $this->common_model->get_count_accreditation('tbl_training', array('status'=>'3'));
		$data['total_revoked_accreditated_onlinetraning'] = $this->common_model->get_count_accreditation('tbl_training', array('status'=>'4'));
		//end accreditation

		//certificate
		$data['total_cert_reported_by_professional'] = $this->common_model->get_count_accreditation('tbl_user_certificate');
		$data['total_cert_reported_by_cep'] = $this->common_model->get_count_accreditation('tbl_existing_certificate');
		//end certificate
		$this->load->view('admin/common/header',$data); 
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/common/footer');
	}

	public function onlineApplication_listing()
	{		
		$this->data = array(
			'title' => 'Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications' 
		);		
		// status 3 means not yet registered 
		$this->data['school'] 			= $this->reviewer_modal->get_school_application('','3','','y');
		$this->data['school_count'] 	= $this->reviewer_modal->get_school_application(1,'3','','y');

		$this->data['graduates'] 		= $this->reviewer_modal->get_graduates_apllication('','','3','y');
		$this->data['graduates_count']  = $this->reviewer_modal->get_graduates_apllication(1,'','3','y');

		$this->data['graduates_exam'] 	= $this->reviewer_modal->get_graduates_exam_booking_apllication('','y');
		// echo $this->db->last_query();die;
		$this->data['graduates_exam_count']= $this->reviewer_modal->get_graduates_exam_booking_apllication(1,'y');	

		$this->data['fprofessional_exam'] = $this->reviewer_modal->get_fprofessional_exam_booking_apllication('','y');
		$this->data['fprofessional_exam_count'] = $this->reviewer_modal->get_fprofessional_exam_booking_apllication(1,'y');	

		$this->data['fp'] 				= $this->reviewer_modal->get_fp_application('','3','','y');
		$this->data['fp_count'] 		= $this->reviewer_modal->get_fp_application(1,'3','','y');	
		
		$this->data['fpexamreg'] 		= $this->reviewer_modal->get_fpexam_reg_application('','3','','y');
		$this->data['fpexamreg_count'] 	= $this->reviewer_modal->get_fpexam_reg_application(1,'3','','y');	
		
		$this->data['professional_renewal'] = $this->reviewer_modal->get_professional_renewal_application('','3','','y');
		$this->data['professional_renewal_count'] = $this->reviewer_modal->get_professional_renewal_application(1,'3','','y');	

		$this->data['professional_registration'] = $this->reviewer_modal->get_professional_registration_application('','3','','y');
		$this->data['professional_registration_count'] = $this->reviewer_modal->get_professional_registration_application(1,'3','','y');	
		
		$this->data['cep'] 		 		= $this->reviewer_modal->get_cep_acc_application('','3','','y');
		$this->data['cep_count'] 		= $this->reviewer_modal->get_cep_acc_application(1,'3','','y');
		
		$this->data['course'] 			= $this->reviewer_modal->get_course_acc_application('','3','','y');
		$this->data['course_count'] 	= $this->reviewer_modal->get_course_acc_application(1,'3','','y');

		$this->data['training'] 		= $this->reviewer_modal->get_training_acc_application('','3','','y');
		$this->data['training_count'] 	= $this->reviewer_modal->get_training_acc_application(1,'3','','y');

		$this->data['receipient_information'] = $this->reviewer_modal->get_receipient_information('','0',0,'y');
		$this->data['total_receipient_information'] = $this->reviewer_modal->get_receipient_information(1,'0',0,'y');

		$this->data['reqforgoodstand'] = $this->reviewer_modal->get_reqforgoodstand('','0',0,'y');
		$this->data['total_reqforgoodstand'] = $this->reviewer_modal->get_reqforgoodstand(1,'0',0,'y');

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/online_applications/listing',$this->data);
		$this->load->view('admin/common/footer');
	}

	public function onlineApplication_archive()
	{		
		$this->data = array(
			'title' => 'Online Applications Archive',
			'page_title' => 'Online Applications Archive',
			'table_name' => 'Online Applications Archive' 
		);
		
		$this->data['school'] 			= $this->reviewer_modal->get_school_application('','','','y');
		$this->data['school_count'] 	= $this->reviewer_modal->get_school_application(1,'','','y');

		$this->data['graduates'] 		= $this->reviewer_modal->get_graduates_apllication('','','','y');
		$this->data['graduates_count']  = $this->reviewer_modal->get_graduates_apllication(1,'','','y');

		$this->data['graduates_exam'] 	= $this->reviewer_modal->get_graduates_exam_booking_apllication('','y','y'); //3rd segment for archive yes/no
		$this->data['graduates_exam_count']= $this->reviewer_modal->get_graduates_exam_booking_apllication(1,'y','y'); //3rd segment for archive yes/no	

		$this->data['fprofessional_exam'] = $this->reviewer_modal->get_fprofessional_exam_booking_apllication('','y');
		$this->data['fprofessional_exam_count'] = $this->reviewer_modal->get_fprofessional_exam_booking_apllication(1,'y');	

		$this->data['fp'] 				= $this->reviewer_modal->get_fp_application('','','','y');
		$this->data['fp_count'] 		= $this->reviewer_modal->get_fp_application(1,'','','y');	
		
		$this->data['fpexamreg'] 		= $this->reviewer_modal->get_fpexam_reg_application('','','','y');
		$this->data['fpexamreg_count'] 	= $this->reviewer_modal->get_fpexam_reg_application(1,'','','y');	
		
		$this->data['professional_renewal'] = $this->reviewer_modal->get_professional_renewal_application('','','','y');
		$this->data['professional_renewal_count'] = $this->reviewer_modal->get_professional_renewal_application(1,'','','y');	

		$this->data['professional_registration'] = $this->reviewer_modal->get_professional_registration_application('','','','y');
		$this->data['professional_registration_count'] = $this->reviewer_modal->get_professional_registration_application(1,'','','y');	
		
		$this->data['cep'] 		 		= $this->reviewer_modal->get_cep_acc_application('','','','y');
		$this->data['cep_count'] 		= $this->reviewer_modal->get_cep_acc_application(1,'','','y');
		
		$this->data['course'] 			= $this->reviewer_modal->get_course_acc_application('','','','y');
		$this->data['course_count'] 	= $this->reviewer_modal->get_course_acc_application(1,'','','y');

		$this->data['training'] 		= $this->reviewer_modal->get_training_acc_application('','','','y');
		$this->data['training_count'] 	= $this->reviewer_modal->get_training_acc_application(1,'','','y');

		$this->data['receipient_information'] = $this->reviewer_modal->get_receipient_information('','','','y');
		$this->data['total_receipient_information'] = $this->reviewer_modal->get_receipient_information(1,'','','y');

		$this->data['reqforgoodstand'] = $this->reviewer_modal->get_reqforgoodstand('','0',0,'y');
		$this->data['total_reqforgoodstand'] = $this->reviewer_modal->get_reqforgoodstand(1,'0',0,'y');

		//new application under subscription = NO
		// //new application under subscription end

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/online_applications/archive',$this->data);
		$this->load->view('admin/common/footer');
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

		$this->data['foreign_application'] = $this->reviewer_modal->foreign_applcaition_details('','1');	
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		// $this->load->view('admin/online_applications/professionallisting',$this->data);
		$this->load->view('reviewer/online_applications/professionallisting',$this->data);
		$this->load->view('admin/common/footer');
	}


	public function add($id = false)

	{	
		if($id=="")
		{
			$this->data = array(

				'title' => 'Add Professional',

				'page_title' => 'Add Professional',

				'table_name' => 'Add Professional'

			);	
		}else{
			$this->data = array(

				'title' => 'Govt	 : Edit Professional',

				'page_title' => 'Edit Professional Data',

				'table_name' => 'Edit Professional'

			);
		}
		

		if($this->input->post()){

			if($this->input->post('listing_id')) 

			{

				$insert['user_ID'] = $this->input->post('listing_id');

			}else{

				$insert['added_on'] = date('Y-m-d H:i:s');

			}



			$insert['name']  			= $this->input->post('name');

			$insert['role']  			= $this->input->post('role');

			$insert['profession']  		= $this->input->post('profession');

			// $insert['country']  		= $this->input->post('country');

			$insert['status']  			= $this->input->post('status');



			$insert['gender']  			= $this->input->post('gender');

			$insert['email']  			= $this->input->post('email');

			$insert['dob']  			= $this->input->post('dob');

			$insert['address']  		= $this->input->post('address');

			$insert['license_no']  		= $this->input->post('license_no');

			$insert['license_validity_date'] = $this->input->post('license_validity_date');



			// print_r($data);die;

			
				/****************** photo upload ********************************/
				if(isset($_FILES)) {
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
				$insert['image'] = $photo;
			}

		}

	}
		
			if($this->input->post('listing_id'))

			{	




			
				$updated = $this->admin->update('tbl_users',$insert,'user_ID',$this->input->post('listing_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_users',$insert);

			}

			redirect('admin/listing', 'refresh');

		}

		$this->data['country_list'] = $this->admin->get_result_object('tbl_countries','status','1');

		$this->db->order_by('name','ASC');
		$this->data['profession_list'] = $this->admin->get_result_object('tbl_profession','status','1');

		$this->data['listing'] = $this->admin->get_row_object('tbl_users','user_ID',$id);

		$this->data['professional_status'] = $this->Master_m->get_professional_status();

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/add',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function listing()
	{		

		

		$profession_where  = array('status'=>1);
		$this->db->order_by('name','ASC');
		$data['profession'] = $this->Master_m->get_result_array('tbl_profession','','',$profession_where);


		


		if($this->input->post('submit'))
		{
			$user_name = $this->input->post('user_name');
			$profession = $this->input->post('profession');
			$status = $this->input->post('status');
			$gender = $this->input->post('gender');

			$where = array(

				'name' => $user_name,
				'profession' => $profession,
				'status' => $status,
				'gender' => $gender
			);


		$data['listing'] = $this->Professional_model->get_users($where);
		}else{
			$where = array(
			
		);

		$data['listing'] = $this->Professional_model->get_users($where);	
		}

		/******************* Certificate Status **************************/

		$data['professional_status'] = $this->Master_m->get_professional_status();

		//print_r($data['certificate_status']); exit();
		
		$data['where'] = $where;
		$count = $this->Professional_model->professional_users_count($where);
		$this->data = array(

				'title' => 'Professionals Listing',

				'page_title' => 'Professionals Listing ('.$count.')',

				'table_name' => 'Professionals'

			);
		//echo "<pre>"; print_r($data['where']); exit;
		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/listing',$data);

		$this->load->view('admin/common/footer');

	}



	public function view($id=false)

	{		

		$this->data = array(

				'title' => 'Professionals View',

				'page_title' => 'Professionals View',

				'table_name' => 'Professionals'

			);

		$this->data['view'] = $this->Master_m->get_user_details($id);

		$this->data['professional_status'] = $this->Master_m->get_professional_status();

		//echo "<pre>"; print_r($this->data['view']); exit;

		$where = array('t1.user_ID'=>$id);
		$join = '';
		$group_by  = '';
		$this->data['payment_details'] = $this->admin->get_payment_details($where,$join,$group_by);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/view',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function delete($id=false)

	{		

		$result = $this->admin->delete('tbl_users','user_ID',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/listing');

	}



	//Add CEP, Edit CEP , List CEP , Delete CEP



	public function cep_add($id = false)

	{	

		$this->data = array(

				'title' => 'Add CEP',

				'page_title' => 'Add CEP',

				'table_name' => 'Add CEP'

			);

		if($this->input->post()){

			if($_FILES["image"]["name"] != ""){
				$config['upload_path']      = './assets/images/dp/';
				$config['allowed_types']    = 'gif|jpg|png|jpeg';
				$ext 						= explode('.',$_FILES["image"]["name"]);        
				$image 						= 'dp_'.time().'.'.end($ext);
				$config['file_name'] 		= $image;
				$this->load->library('upload',$config);
				$this->upload->do_upload('image');
				$photo = $this->upload->data();
				$insert['image'] = $image;
			}
			

			if($this->input->post('listing_id')) 

			{

				$insert['cep_ID'] = $this->input->post('listing_id');

				$insert['updated_at'] = date('Y-m-d H:i:s');

			}else{

				$insert['added_on'] = date('Y-m-d H:i:s');

			}



			$insert['name']  			= $this->input->post('name');

			$insert['profession']  		= $this->input->post('profession');

			$insert['status']  			= $this->input->post('status');

			// $insert['country']  		= $this->input->post('country');

			// $insert['gender']  			= $this->input->post('gender');

			$insert['email']  			= $this->input->post('email');

			$insert['dob']  			= $this->input->post('dob');

			$insert['address']  		= $this->input->post('address');

			$insert['contact_person']  	= $this->input->post('contact_person');

			$insert['contact_no']  		= $this->input->post('contact_no');

			$insert['issued_date']  	= $this->input->post('issued_date');

			$insert['accreditation']  	= $this->input->post('accreditation');

			$insert['validity_date'] 	= $this->input->post('validity_date');



			// print_r($data);die;

			if($this->input->post('listing_id'))

			{	

				$updated = $this->admin->update('tbl_cep',$insert,'cep_ID',$this->input->post('listing_id')); 
				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_cep',$insert);

			}

			redirect('admin/cep_listing', 'refresh');

		}

		$this->data['country_list'] = $this->admin->get_result_object('tbl_countries','status','1');

		$this->data['profession_list'] = $this->admin->get_result_object('tbl_profession','status','1');

		$this->data['listing'] = $this->admin->get_row_object('tbl_cep','cep_ID',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/cep/add',$this->data);

		$this->load->view('admin/common/footer');

	}

	public function processingfee(){
		$count = $this->admin->count_rows('tbl_certificate_price','','');
		$this->data = array(
				'title' => 'Processing fee',
				'page_title' => 'Processing fee',
				'table_name' => 'Processing fee'
			);
		$this->db->order_by('charges_for ASC','display_position ASC');
		$data['listing'] = $this->admin->get_result_array('tbl_certificate_price','','');
		$settingarr 	 = $this->common_model->get_setting('1');
		if($settingarr){
			$data['tax']	 = $settingarr->tax;
		}else{
			$data['tax'] = '';
		}
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/processingfee',$data);
		$this->load->view('admin/common/footer');
	}
	public function addprocessfee($id = false){	
		$this->data = array(
				'title' => 'add processing fee',
				'page_title' => 'Add Processing Fee',
				'table_name' => 'add processing fee'
			);

		if($this->input->post()){
    		// print_r($this->input->post()); exit;
			$insert['charges_for']  	= $this->input->post('charges_for');
			$insert['duration']  		= $this->input->post('duration');
			$insert['duration_title']  	= $this->input->post('duration_title');
			$insert['charge']  			= $this->input->post('charge');
			//$insert['tax']  			= $this->input->post('tax');
			//$insert['tax_amount']  	= $this->input->post('tax_amount');
			$insert['display_position'] = $this->input->post('display_position');
			if($this->input->post('pri_id')){	
				$updated = $this->admin->update('tbl_certificate_price',$insert,'pri_id',$this->input->post('pri_id')); 
				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');
			}else{
				$inserted	=	$this->admin->save('tbl_certificate_price',$insert);
				echo $this->db->last_query();die;
			}
			redirect('admin/processingfee', 'refresh');
		}
		$this->data['listing'] = $this->admin->get_row_object('tbl_certificate_price','pri_id',$id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/addprocessfee',$this->data);
		$this->load->view('admin/common/footer');
	}

	public function cep_listing()
	{		
		$count = $this->admin->count_rows('tbl_cep','status','1');
		$this->data = array(
				'title' => 'CEP Listing',
				'page_title' => 'CEP Listing ('.$count.')',
				'table_name' => 'CEP'
			);
		$data['listing'] = $this->admin->get_result_array('tbl_cep','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cep/listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function cep_accreditation()
	{		
		$count = $this->admin->get_cep_accreditation_list(1,'1');
		$this->data = array(
				'title' => 'CEP Accreditation',
				'page_title' => 'Accredited CE Providers ('.$count.')',
				'table_name' => 'Accreditation'
			);

		$data['listing'] = $this->admin->get_cep_accreditation_list(0,'1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cep/acc_listing',$data);
		$this->load->view('admin/common/footer');
	}
	function cepcertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->admin->cepcertificate($docid);
		//print_r($data['result']); 
		// echo json_encode($data['result']);
		$this->load->view('admin/common/cepcertificate_preview',$data);
	}

	public function university_listing()
	{		
		$data['listing'] = $this->admin->university_list('1');
		$this->data = array(

				'title' 		=> 'Accredited Schools',
				'page_title' 	=> 'Accredited Schools ('.count($data['listing']).')',
				'table_name' 	=> 'Accredited Schools'

			);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/university/listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function unversitydetails($id){
		$this->data = array(
			'title' => 'University Details',
			'page_title' => 'University Details',
			'table_name' => 'University Details'
		); 
		
		$this->data['universitydetails'] = $this->admin->universitydetails($id);
		$this->data['universityreviewdatails'] = $this->admin->universityreviewdatails($id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/university/details',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function universitydetailsforpopup(){ 
		$schid = $_POST['schid'];
		$universitydetails = $this->admin->universitydetails($schid);
		$logo = '<div class="border border-primary"><img
				src="'.base_url('assets/images/university/default-logo.png').'"
				width="150"></div>';
		if($universitydetails->college_logo !="" && file_exists('./assets/images/university/'.$universitydetails->college_logo)){	
		$logo ='<div class="border border-primary"><img
				src="'.base_url('assets/images/university/').$universitydetails->college_logo.'"
				width="150"></div>';
		}
		echo '<div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                '.$logo.'   
                            </div>                           
                        </div>
                    </div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">School Name :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->university_name.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">College of :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->collegeofnmae.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Address :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->address.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Email :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->email.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Contact No. :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->contact_no.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Name of Representative :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->name_of_representative.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Position :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->position.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Business License No. :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->business_license_number.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Validity Date :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->validity_date.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Issued by :</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->issued_by.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Accreditation No.:</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->accreditation_no.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Validity Date:</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->accreditation_validity_date.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Validity Date:</label>
						</div>
						<div class="col-sm-8">
							'.$universitydetails->accreditation_validity_date.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Issued by</label>
                            </div>
                            <div class="col-sm-8">
                                '.$universitydetails->accreditation_issued_by.'
                            </div>                           
                        </div>
                    </div>
				';
		
		
	}

	public function cepdetailsforpopup(){ 
		$schid = $_POST['schid'];
		//$universitydetails = $this->admin->universitydetails($schid);
		$cep_details= $this->reviewer_modal->get_cep_details($schid);
		$logo = '<div class="border border-primary"><img
				src="'.base_url('assets/images/university/default-logo.png').'"
				width="150"></div>';
		if($cep_details->company_logo !="" && file_exists('./assets/images/ce_provider/'.$cep_details->company_logo)){	
		$logo ='<div class="border border-primary"><img
				src="'.base_url('assets/images/ce_provider/').$cep_details->company_logo.'"
				width="150"></div>';
		}
		if($cep_details->document_for=='n'){$doc_for='<h3>New</h3>';}else{$doc_for='<h3>Re-New</h3>';}
		echo '<div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                '.$logo.'   
                            </div>                           
                        </div>
                    </div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Business Name :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->business_name.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Business Number :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->business_no.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Address :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->address.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Country :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->co_name.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Contact Person :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->contact_person.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Designation :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->designation.'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">E-mail :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->email.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Tell. No. :</label>
						</div>
						<div class="col-sm-8">
							'.$cep_details->phone.'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">'.$doc_for.'</label>
						</div>
						<div class="col-sm-8">
							
						</div>                           
					</div>
					</div>
					
				';
		
		
	}
	public function prodetailsforpopup()
	{
		$schid = $_POST['schid'];
		//$universitydetails = $this->admin->universitydetails($schid);
		//$cep_details= $this->reviewer_modal->get_cep_details($schid);
		$application = $this->reviewer_modal->get_foreign_applcaition(array('u.user_ID'=>$schid));
		//print_r($application[0]);exit;
		$logo = '<div class="border border-primary"><img
				src="'.base_url('assets/images/university/default-logo.png').'"
				width="100%"></div>';
		if($application[0]->image !="" && file_exists('./assets/uploads/profile/'.$application[0]->image)){	
		$logo ='<div class="border border-primary"><img
				src="'.base_url('assets/uploads/profile/').$application[0]->image.'"
				width="100%"></div>';
		}
		$college_of=$application[0]->profession_name;
		if(isset($application[0]->college_of)){
			$college_of=$application[0]->college_of;
		}
		if(!empty($application[0]->exam_code)){
			$exam_code='<div class="form-group">
							<div class="row">
			   					<div class="col-sm-4">
									<label for="field-1" class="control-label">Exam Code :</label>
								</div>
								<div class="col-sm-8">
									<strong>'.$application[0]->exam_code.'</strong>
								</div>                           
							</div>
						</div>';
		}else{$exam_code='';}
		//if($cep_details->document_for=='n'){$doc_for='<h3>New</h3>';}else{$doc_for='<h3>Re-New</h3>';}
		echo 	'<div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                '.$logo.'   
                            </div>
							<div class="col-md-10">
                                <h4>'.ucwords(!empty($application)?$application[0]->fname.' '.$application[0]->lname.' '.$application[0]->name:"--").
                                '</h4>
                                <p><b>Profession:</b>
                                    '.(!empty($application)?$application[0]->profession_name:"").
                                    '<br><b>License No:</b>
                                    '.(!empty($application[0]->licenseno)?$application[0]->licenseno:$application[0]->license_no).'<br>
                                    <b>Validity:</b>
                                    '.(($application[0]->expiry_at != '0000-00-00')?date('M d,Y',strtotime($application[0]->expiry_at)):date('M d,Y',strtotime($application[0]->license_validity_date))).'
                                </p>
                            </div>                           
                        </div>
                </div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">University :</label>
						</div>
						<div class="col-sm-8">
							'.(($application[0]->university > 0)?$application[0]->university_name:$application[0]->other_university).'
						</div>                           
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Collage of :</label>
						</div>
						<div class="col-sm-8">
							'.(($application[0]->college > 0)?$college_of:$application[0]->other_college).'
						</div>                           
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Address :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application[0]->u_address)?$application[0]->u_address:"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Email :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application[0]->email)?$application[0]->email:"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Contact No. :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application[0]->u_contact)?$application[0]->u_contact:"N/A").'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Date of Birth :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application[0]->dob)?date('M d,Y',strtotime($application[0]->dob)):"N/A").'
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Gender :</label>
						</div>
						<div class="col-sm-8">
							'.ucwords(!empty($application[0]->gender)?$application[0]->gender:"N/A").'
						</div>                           
					</div>
					</div>	
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Country :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application[0]->countries_name)?$application[0]->countries_name:"N/A").'
						</div>                           
					</div>
					</div>'.$exam_code					
				;
	}
	function profcertificateforreviewer()
	{
		$docid = $_POST['docid'];
		//$universitydetails = $this->admin->universitydetails($schid);
		//$cep_details= $this->reviewer_modal->get_cep_details($schid);
		$data['result'] = $this->reviewer_modal->get_foreign_applcaition_cert(array('u.user_ID'=>$docid));
		
		$this->load->view('admin/common/profcertificateforreviewer_blue',$data);
		//$this->load->view('admin/common/schoolcertificate_preview',$data);
	}
	function registeredprofcertificate()
	{
		$docid = $_POST['docid'];
		//$universitydetails = $this->admin->universitydetails($schid);
		//$cep_details= $this->reviewer_modal->get_cep_details($schid);
		$data['result'] = $this->reviewer_modal->get_foreign_applcaition_cert(array('u.user_ID'=>$docid));
		
		$this->load->view('admin/common/registeredprofcertificate_blue',$data);
		//$this->load->view('admin/common/schoolcertificate_preview',$data);
	}

	function schoolcertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->admin->schoolcertificate($docid);
		$this->load->view('admin/common/schoolcertificate_preview',$data);
	}

	

	function coursecertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->reviewer_modal->coursecertificate($docid);
		$this->load->view('admin/common/coursecertificate_preview',$data);
	}
	function trainingcertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$data['result'] = $this->admin->trainingcertificate($docid);
		$this->load->view('admin/common/trainingcertificate_preview',$data);
	}
	
	function profcertificate()
	{
		//print_r($_POST);
		$docid = $this->input->post('docid');
		$type = $this->input->post('type');
		if($type == 'Graduate'){
			$data['result'] = $this->reviewer_modal->graduatecertificate($docid);
		}else{
			$data['result'] = $this->reviewer_modal->profcertificate($docid);
		}
		// echo json_encode($data);
		$this->load->view('admin/common/profcertificate_preview',$data);
		
	}
	public function prof_reg_certificate()
	{
		//print_r($_POST);
		$details = array();
		$docid = $this->input->post('docid');
		$type = $this->input->post('type');
		if($type == 'Graduate'){
			$data['result'] = $this->reviewer_modal->graduatecertificate($docid);
			$details[]=array(
				'name'   => $data['result']->student_name.' '.$data['result']->middle_name.' '.$data['result']->surname,
				'profession_name' => 'Graduate',
				'validity' => (!empty($data['result']->validity))?date('F d,Y',strtotime($data['result']->validity)):'N/A',
				'registration_no' => (!empty($data['result']->registration_no))?$data['result']->registration_no:'',
				'examcode' => (!empty($data['result']->examcode))?$data['result']->examcode:'',
				'added_on' => (!empty($data['result']->added_at))?date('F d,Y',strtotime($data['result']->added_at)):'N/A',
				'type' => 'g',
			);
		}else{
			$data['result'] = $this->reviewer_modal->profcertificate($docid);
			//print_r($data['result']);exit;
			$details[]=array(
				'name'   => $data['result']->fname.' '.$data['result']->lname.' '.$data['result']->name,
				'profession_name' => (isset($data['result']->profession_name))?$data['result']->profession_name:'',
				'validity' => ($data['result']->expiry_at != '0000-00-00')?date('M d,Y',strtotime($data['result']->expiry_at)):date('M d,Y',strtotime($data['result']->license_validity_date)),
				'registration_no' => (!empty($data['result']->registration_no))?$data['result']->registration_no:'',
				'examcode' => '',
				'added_on' => ($data['result']->added_on != '0000-00-00 00:00:00')?date('M d,Y',strtotime($data['result']->added_on)):'N/A',
				'type' => '',
			);
		}
		//echo print_r($details);exit;
		$data['result'] = $details;
		//echo print_r($details);exit;
		$this->load->view('admin/common/prof_elig_cert_foradmin_blue.php',$data);
	}
	public function graduatedetailsforpopup(){
		$docid = $_POST['docid'];
		$graduatedetails = $this->reviewer_modal->graduates_details($docid);
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
                                <label for="field-1" class="control-label">Name of School</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->name_of_school.'</div>                           
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
                                <label for="field-1" class="control-label">Date Graduated</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->date_of_graduated.'</div>                           
                        </div>
                    </div>
					
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Date issued</label>
                            </div>
                            <div class="col-sm-8">'.$graduatedetails->updated_at.'</div>                           
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

	public function graduates_listing()
	{		
		
		$this->data = array(
			'title' => 'Graduates Listing & Exam Code',
			'page_title' => 'Graduates Listing & Exam Code',
			'table_name' => 'Graduates'
		);
		
		$data['listing'] = $this->reviewer_modal->graduates_listing('1');
		$data['getuniversityArr'] = $this->common_model->getuniversityArr();
		$data['getschoolArr'] = $this->common_model->getschoolArr();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/graduates/listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function cep_view($id=false)

	{		

		$this->data = array(

				'title' => 'CEP View',

				'page_title' => 'CEP View',

				'table_name' => 'CEP'

			);

		$data['view'] = $this->admin->get_row_object('tbl_cep','cep_ID',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/cep/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function cep_delete($id=false)

	{		

		$result = $this->admin->delete('tbl_cep','cep_ID',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/cep_listing');

	}

 

	public function cep_course_listing()
	{		
		$count = $this->admin->count_rows('tbl_course','','');
		$this->data = array(
				'title' => 'CEP Course Listing',
				'page_title' => 'CEP Course Listing ('.$count.')',
				'table_name' => 'CEP Course Listing'
			);

		$data['listing'] = $this->admin->get_result_array('tbl_course','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cep/course_listing',$data);
		$this->load->view('admin/common/footer');
	}


	public function logout()

	{	

		// print_r($this->session->userdata());die;

		$this->session->unset_userdata('user_ID');

		$this->session->unset_userdata('ip_address');

		$this->session->sess_destroy();

		redirect('admin/login/index');

	}
	public function download(){
		$this->data = array(
			'title' => 'Download Listing',
			'page_title' => 'Download Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->get_download_list();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/download',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function downloadedit($id = false){
		$this->data = array(
			'title' => 'Download Edit',
			'page_title' => 'Download ',
			'table_name' => ''
		);
		if($this->input->post()) {
			// banner upload		
				//print_r($_FILES["banner"]); exit;
			$dowloadfile = '';
			if(isset($_FILES["dowloadfile"]) && !empty($_FILES["dowloadfile"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/images/download/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["dowloadfile"]["name"]);        
				$dowloadfile 				= 'download_'.time().'.'.end($ext);
				$config['file_name'] 		= $dowloadfile;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('dowloadfile'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$dowloadfile = $dowloadfile;
			}else{
				$dowloadfile = $this->input->post('old_dowloadfile');
			}
			
			//echo $cv;
			// end image upload
			if($this->input->post('dwnid')) {
				$data['dwnid'] = $this->input->post('dwnid');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['file_name']  		= $this->input->post('file_name');
			$data['dowloadfile']		= $dowloadfile;
			$data['status']				= $this->input->post('status');
			//print_r($data); exit;
			if($this->input->post('dwnid')) {
				$updated = $this->cms_model->update_download($data, $this->input->post('dwnid')); 
				// if($updated) { 
					$this->session->set_flashdata('item', array('message' => 'Record updated successfully','class' => 'alert-success'));
				// } else {
					// $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				// }
			} else {
				$inserted	=	$this->cms_model->insert_download($data);
			}
			redirect('admin/download', 'refresh');
		}
		if($id) {
			$this->data['cms'] = $this->cms_model->get_one_download($id);
			
            if(!$this->data['cms']) {
                redirect('admin/download', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		$this->data['listing'] = $this->admin->get_result_array('cms','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/downloadedit',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function banner(){
		$this->data = array(
			'title' => 'Banner',
			'page_title' => 'Banner Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->get_banner_list();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/banner',$this->data);
		$this->load->view('admin/common/footer');
	}
	
	public function banneredit($id = false){
		$this->data = array(
			'title' => 'Banner Edit',
			'page_title' => 'Banner ',
			'table_name' => ''
		);
		if($this->input->post()) {
			// banner upload		
				//print_r($_FILES["banner"]); exit;
			$banner = '';
			if(isset($_FILES["banner"]) && !empty($_FILES["banner"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/images/banner/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["banner"]["name"]);        
				$banner 					= 'banner_'.time().'.'.end($ext);
				$config['file_name'] 		= $banner;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('banner'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$banner = $banner;
			}else{
				$banner = $this->input->post('old_banner');
			}
			
			//echo $cv;
			// end image upload
			if($this->input->post('bnr_id')) {
				$data['bnr_id'] = $this->input->post('bnr_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['title']  			= $this->input->post('title');
			//$data['url']  			= $this->input->post('url');
			$data['sub_title']  		= $this->input->post('sub_title');
			$data['display_position']  	= $this->input->post('display_position');
			//$data['bannertext']		= $this->input->post('bannertext');
			$data['banner']				= $banner;
			$data['bnr_status']			= $this->input->post('bnr_status');
			
			if($this->input->post('bnr_id')) {
				$updated = $this->cms_model->update_banner($data, $this->input->post('bnr_id')); 
				 if($updated) { 
					$this->session->set_flashdata('item', array('message' => 'Record updated successfully','class' => 'alert-success'));
				 } else {
					 $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				 }
			} else {
				$inserted	=	$this->cms_model->insert_banner($data);
			}
			
            redirect('admin/banner', 'refresh');
		}
		if($id) {
			$this->data['cms'] = $this->cms_model->get_one_banner($id);
			
            if(!$this->data['cms']) {
                redirect('admin/banner', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		$this->data['listing'] = $this->admin->get_result_array('cms','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/banneredit',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function cms(){
		$this->data = array(
			'title' => 'CMS',
			'page_title' => 'CMS Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->get_list();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cms',$this->data);
		$this->load->view('admin/common/footer');
	}
	
	public function cmsedit($id = false){
		$this->data = array(
			'title' => 'CMS Edit',
			'page_title' => 'CMS ',
			'table_name' => ''
		);
		if($this->input->post()) {
			// banner upload		
				//print_r($_FILES["banner"]); exit;
			$banner = '';
			if(isset($_FILES["banner"]) && !empty($_FILES["banner"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/images/banner/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["banner"]["name"]);        
				$banner 					= 'banner_'.time().'.'.end($ext);
				$config['file_name'] 		= $banner;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('banner'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$banner = $banner;
			}else{
				$banner = $this->input->post('old_banner');
			}
			
			//echo $cv;
			// end image upload
			if($this->input->post('cms_id')) {
				$data['cms_id'] = $this->input->post('cms_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$termdes = $this->input->post('cms_description');
			$termdes = str_replace("<p>",'',$termdes);
			$termdes = str_replace("</p>",'',$termdes);
			$termarr = explode("\n", $termdes);
			$termdes = '';
			foreach($termarr as $arr){
				$termdes.= '<p>'.$arr.'</p>';
			}
			
			$data['cms_title']  			= $this->input->post('cms_title');
			$data['cms_url']  				= $this->input->post('cms_url');
			$data['cms_description']    	= $termdes;
			//$data['cms_meta_title']		= $this->input->post('cms_meta_title');
			//$data['cms_meta_description']	= $this->input->post('cms_meta_description');
			//$data['cms_meta_keyword']		= $this->input->post('cms_meta_keyword');
			//$data['bannertext']			= $this->input->post('bannertext');
			$data['banner']					= $banner;
			$data['cms_status']				= $this->input->post('cms_status');
			
			if($this->input->post('cms_id')) {
				$updated = $this->cms_model->update($data, $this->input->post('cms_id')); 
				// if($updated) { 
					$this->session->set_flashdata('item', '<div class="alert alert-success"> Record updated successfully</div>');
				// } else {
					// $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				// }
			} else {
				$inserted	=	$this->cms_model->insert($data);
				$this->session->set_flashdata('item', '<div class="alert alert-success"> Record added successfully</div>');
			}
			
            redirect('admin/cms', 'refresh');
		}
		if($id) {
			$this->data['cms'] = $this->cms_model->get_one($id);
			
            if(!$this->data['cms']) {
                redirect('admin/cms', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		$this->data['listing'] = $this->admin->get_result_array('cms','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cmsedit',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function cmsdelete($id = false){
		if($id==false){
			return redirect('admin/cms');
		}else{
			$deleted = $this->cms_model->cmsdelete($id);
			if($deleted){
				$this->session->set_flashdata('item', '<div class="alert alert-success"> Record Deleted successfully</div>');
				return redirect('admin/cms');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger"> Something went wrong!.</div>');
				return redirect('admin/cms');
			}
		}
	}
	public function faq(){
		$this->data = array(
			'title' => 'FAQ',
			'page_title' => 'FAQ',
			'table_name' => ''
		);
		$this->data['faqs'] = $this->faqs_model->get_list();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/faq',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function faqedit($id = false) { 
		$this->data = array(
			'title' => 'Add/Edit FAQ',
			'page_title' => 'Add/Edit FAQ',
			'table_name' => ''
		);
		$faq = false;
		if($this->input->post()) {
			
			if($this->input->post('faq_id')) {
				$data['faq_id'] = $this->input->post('faq_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['faq_title']  		= $this->input->post('faq_title');
			$data['faq_category']  		= $this->input->post('faq_category');
			$data['faq_description']    = $this->input->post('faq_description');
			$data['faq_position']		= $this->input->post('faq_position');
			$data['faq_status']			= $this->input->post('faq_status');
			
			if($this->input->post('faq_id')) {
				$updated = $this->faqs_model->update($data, $this->input->post('faq_id')); 
				// if($updated) { 
					$this->session->set_flashdata('item', '<div class="btn btn-success">Record updated successfully</div>');
				// } else {
					// $this->session->set_flashdata('item', '<div class="btn btn-danger">please try again!</div>'));
				// }
			} else {
				$inserted	=	$this->faqs_model->insert($data);
			}
			
			redirect('admin/faq', 'refresh');
		}
		
		if($id) {
			$this->data['faq'] = $this->faqs_model->get_one($id);
			
            if(!$this->data['faq']) {
                redirect('admin/faq', 'refresh');
			}
		} else {
			//$this->data['faq'] = ;
		}
		$this->data['faqs'] = $this->faqs_model->get_list();
		$this->data['newscategoryarr'] = $this->cms_model->get_categorylist();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/faqedit',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function faq_delete($id=false)
	{		
		$result = $this->admin->delete('faqs','faq_id',$id);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/faq');
	}
	public function newsnmedia(){
		$this->data = array(
			'title' => 'New & Media',
			'page_title' => 'New & Media Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->news_get_list();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/newsnmedia',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function deletenewsnmedia() 
	{
		//print_r($_POST);
		$news_id = $this->input->post('news_id');
		$result = $this->cms_model->delete_news($news_id);
		echo  $result; exit;
	}
	public function newsmediaedit($id = false){
		$this->data = array(
			'title' => 'News & Media Edit',
			'page_title' => 'News & Media ',
			'table_name' => ''
		);
		if($this->input->post()) {
			// banner upload		
				//print_r($_FILES["banner"]); exit;
			$banner = '';
			if(isset($_FILES["banner"]) && !empty($_FILES["banner"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/images/newsmedia/';
				//echo $config['upload_path'] 		= base_url().'assets/images/newsmedia/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["banner"]["name"]);        
				$banner 					= 'newmedia_'.time().'.'.end($ext);
				$config['file_name'] 		= $banner;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('banner'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					print_r($error); exit;
				}  
				$banner = $banner;
			}else{
				$banner = $this->input->post('old_banner');
			}
			
			//echo $cv;
			// end image upload
			if($this->input->post('news_id')) {
				$data['news_id'] = $this->input->post('news_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			/* $data['news_title']  			= $this->input->post('news_title');
			$data['news_url']  				= $this->input->post('news_url');
			$data['news_description']    	= $this->input->post('news_description');
			$data['news_meta_title']		= $this->input->post('news_meta_title');
			$data['news_meta_description']	= $this->input->post('news_meta_description');
			$data['news_meta_keyword']		= $this->input->post('news_meta_keyword');
			//$data['bannertext']				= $this->input->post('bannertext');
			$data['banner']					= $banner;
			$data['new_date']				= $this->input->post('new_date');
			$data['new_addedby']			= $this->input->post('new_addedby'); */
			$data['news_status']			= $this->input->post('news_status');
			
			if($this->input->post('news_id')) {
				$updated = $this->cms_model->news_update($data, $this->input->post('news_id')); 
				// if($updated) { 
					$this->session->set_flashdata('item', array('message' => 'Record updated successfully','class' => 'alert-success'));
				// } else {
					// $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				// }
			} else {
				$inserted	=	$this->cms_model->news_insert($data);
			}
			
            redirect('admin/newsnmedia', 'refresh');
		}
		if($id) {
			$this->data['cms'] = $this->cms_model->news_get_one($id);
			
            if(!$this->data['cms']) {
                redirect('admin/newsnmedia', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		//$this->data['listing'] = $this->admin->get_result_array('cms','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/newnmediaedit',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function check_session(){
		$user_ID = $this->session->userdata('login')['user_ID'];
		if(!$user_ID){
			redirect('login');
		}
	}



	//Add Profession, Edit Profession , List Profession , Delete Profession 

	

	public function add_profession($id = false)

	{	
		if($id){
			$this->data = array( 'title' => 'Edit Profession', 'page_title' => 'Edit Profession', 'table_name' => 'Edit Profession' );
		}else{
			$this->data = array( 'title' => 'Add Profession', 'page_title' => 'Add Profession', 'table_name' => 'Add Profession' );
		}

		if($this->input->post()){

			if($this->input->post('profession_id')) 

			{

				$insert['id'] = $this->input->post('profession_id');

				$insert['updated_at'] = $this->input->post('updated_at');

			}else{

				$insert['added_on'] = date('Y-m-d H:i:s');

			}



			$insert['name']  			= $this->input->post('name');

			$insert['required_units']  	= $this->input->post('required_units');
			$insert['general_units']  	= $this->input->post('general_units');
			$insert['specific_units']  	= $this->input->post('specific_units');

			$insert['start_date']  		= $this->input->post('start_date');

			$insert['end_date']  		= $this->input->post('end_date');

			$insert['status']  			= $this->input->post('status');



			// print_r($data);die;

			if($this->input->post('profession_id'))

			{	

				$updated = $this->admin->update('tbl_profession',$insert,'id',$this->input->post('profession_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_profession',$insert);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Record added successfully.</div>');

			}

			redirect('admin/profession_listing', 'refresh');

		}

		$this->data['profession'] = $this->admin->get_row_object('tbl_profession','id',$id);
		$this->data['professional_status'] = $this->Master_m->get_professional_status();

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/profession/add',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function profession_listing()
	{		
		$this->data = array(
			'title' => 'Profession Listing',
			'page_title' => 'Profession Listing',
			'table_name' => 'Profession'
		);
		$data['listing'] = $this->admin->get_result_array('tbl_profession','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/profession/listing',$data);
		$this->load->view('admin/common/footer');
	}



	public function profession_view($id=false)

	{		

		$this->data = array(

				'title' => 'Profession View',

				'page_title' => 'Profession View',

				'table_name' => 'Profession'

			);

		$data['view'] = $this->admin->get_row_object('tbl_profession','id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/profession/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function profession_delete($id=false)

	{		

		$result = $this->admin->delete('tbl_profession','id',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/profession_listing');

	}





	//Add Country, Edit Country , List Country , Delete Country 

	

	public function add_country($id = false)

	{	

		$this->data = array(

				'title' => 'Add Country',

				'page_title' => 'Add Country',

				'table_name' => 'Add Country'

			);

		if($this->input->post()){

			

			$insert['countries_name']     = $this->input->post('name');

			$insert['countries_iso_code'] = $this->input->post('iso_code');

			$insert['countries_isd_code'] = $this->input->post('isd_code');

			$insert['status']  			  = $this->input->post('status');



			// print_r($data);die;

			if($this->input->post('countries_id'))

			{	

				$updated = $this->admin->update('tbl_countries',$insert,'id',$this->input->post('countries_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_countries',$insert);

			}

			redirect('admin/profession_listing', 'refresh');

		}

		$this->data['countries'] = $this->admin->get_row_object('tbl_countries','countries_id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/country/add',$this->data);

		$this->load->view('admin/common/footer');

	}
	


	public function country_listing()

	{		

		$this->data = array(

				'title' => 'Country Listing',

				'page_title' => 'Country Listing',

				'table_name' => 'Country'

			);

		$data['countries'] = $this->admin->get_result_array('tbl_countries','','');

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/country/listing',$data);

		$this->load->view('admin/common/footer');

	}



	public function country_view($id=false)

	{		

		$this->data = array(

				'title' => 'Country View',

				'page_title' => 'Country View',

				'table_name' => 'Country'

			);

		$data['view'] = $this->admin->get_row_object('tbl_countries','countries_id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/country/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function country_delete($id=false)

	{		

		$result = $this->admin->delete('tbl_countries','countries_id',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/country_listing');

	}


	public function contact_us_listing()

	{		

		$this->data = array(

				'title' => 'Notification',

				'page_title' => 'Notification',

				'table_name' => 'Notification'

			);
		// $this->db->order_by('id','DESC');
		// $data['contact_us'] = $this->admin->get_result_array('tbl_contact_us','','');
		$data['contact_listing'] = $this->admin->get_contact_us_list();

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/contact_us/listing',$data);

		$this->load->view('admin/common/footer');

	}

	public function certificate_listing()
	{		
		$count = $this->admin->count_rows('tbl_existing_certificate','','');
		$this->data = array(
				'title' => 'Certificates reported by CPD Provider',
				'page_title' => 'Certificates reported by CPD Provider('.$count.')',
				'table_name' => ''
			);

		$data['listing'] = $this->admin->get_certificate_reported_by_cep();
		$data['totalnewlisting'] = $this->admin->count_certificate_reported_by_cep('new');
		$data['totalusedlisting'] = $this->admin->count_certificate_reported_by_cep('n');
		$data['totallisting'] = $this->admin->count_certificate_reported_by_cep('all');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/certificate/ceonpoint_certificate/certificate_listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function certificate_view($id=false)
	{		
		$this->data = array(
			'title' => 'View Certificate',
			'page_title' => 'View Certificate',
			'table_name' => 'View Certificate'
		);

		$data['certificate_view'] = $this->admin->get_certificate_reported_by_cep($id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/certificate/ceonpoint_certificate/certificate_view',$data);
		$this->load->view('admin/common/footer');
	}

	
	public function sent_certificate_listing()
	{		
		$count = $this->admin->count_rows('tbl_user_certificate','','');
		$this->data = array(
				'title' => 'Certificates reported by Professional',
				'page_title' => 'Certificates reported by Professional ('.$count.')'
			);

		$data['listing'] = $this->admin->get_certificate_reported_by_prof();
		$data['totalnewlisting'] = $this->admin->count_certificate_reported_by_prof('new');
		$data['totalusedlisting'] = $this->admin->count_certificate_reported_by_prof('n');
		$data['totallisting'] = $this->admin->count_certificate_reported_by_prof('all');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/certificate/user_certificate/certificate_listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function sent_certificate_view($id=false)
	{		
		$this->data = array(
			'title' => 'View Certificate',
			'page_title' => 'View Certificate',
			'table_name' => 'View Certificate'
		);

		$data['certificate_view'] = $this->admin->get_certificate_reported_by_prof($id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/certificate/user_certificate/certificate_view',$data);
		$this->load->view('admin/common/footer');
	}


	//Add Reviewer, Edit Reviewer , List Reviewer , Delete Reviewer  

	public function add_reviewer($id = false)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->data = array(
				'title' => 'Add Reviewer',
				'page_title' => 'Add Reviewer',
				'table_name' => 'Add Reviewer'
			);
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
		if($this->input->post('reviewer_id')=='') 
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.username]');
		}
		if ($this->form_validation->run() == FALSE)
        {
			if($id){
				$this->data['reviewer'] = $this->admin->get_row_object('tbl_admin','user_ID',$id);
			}
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/reviewers/add',$this->data);
			$this->load->view('admin/common/footer');
        }else{

		if($this->input->post()){
			$photo = '';
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/uploads/reviewer/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				// $config['allowed_types'] 	= '*';      
				$ext 						= explode('.',$_FILES["photo"]["name"]);        
				$photo 						= 'photo'.time().'.'.end($ext);
				$config['file_name'] 		= $photo;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$photo = $photo;
			}else{
				$photo = $this->input->post('old_photo');
			}
			if($this->input->post('reviewer_id')) 
			{
				$insert['user_ID'] 		= $this->input->post('reviewer_id');
				// $insert['updated_at'] 	= date('Y-m-d');

			}else{

				// $insert['created_on'] 	= date('Y-m-d H:i:s');
				$insert['password']  	= password_hash($this->input->post('password'),PASSWORD_DEFAULT);

			}

			$insert['first_name']  	= $this->input->post('first_name');
			$insert['last_name']  	= $this->input->post('last_name');
			$insert['email']  		= $this->input->post('email');
			$insert['user_type']  	= $this->input->post('user_type');
			$insert['username']  	= $this->input->post('username');
			$insert['photo'] 		= $photo;
			$insert['created_on'] 	= $this->input->post('created_on');
			$insert['validity_date']= $this->input->post('validity_date');
			$insert['status']  		= $this->input->post('status');

			// print_r($data);die;
			$updated = '';
			$inserted = '';
			if($this->input->post('reviewer_id'))
			{	
				$updated = $this->admin->update('tbl_admin',$insert,'user_ID',$this->input->post('reviewer_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

			}else{

				$inserted	=	$this->admin->save('tbl_admin',$insert);

			}

			if($inserted != ''){
				$as = '';
				if($this->input->post('user_type')=='sub-admin'){
					$as = 'REVIEWER FOR DOCUMENTS';
				}
				if($this->input->post('user_type')=='ct'){
					$as = 'REVIEWER FOR CE COURSES';
				}
				$settingarr = $this->common_model->get_setting('1');
				$mailContent = '<p>Welcome to <b>'.$settingarr->rb_name.'</b> as '.$as.'.</p>
								<p> To access your reviewer account, here are your credentials:</p>
								<p> Username : <b>'.$this->input->post('email').'</b></p> 
								<p> Password: <b>'.$this->input->post('password').'</b> </p>
								<p>Please <a href = "'.base_url('login').'"> click here </a> to log in.</p>';
				$this->admin_mail($insert['email'],$insert['first_name'].' '.$insert['last_name'],'Your username & password',$mailContent);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Reviewer added successfully.</div>');
			}elseif($updated != ''){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Reviewer updated successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}

			if($this->input->post('user_type')=='ct'){
				redirect('admin/ct_reviewers_listing', 'refresh');
			}else{
				redirect('admin/reviewers_listing', 'refresh');
			}

		}

		}
	}


	public function reviewers_listing()
	{		
		$count = $this->admin->count_rows('tbl_admin','user_type','sub-admin');
		$this->data = array(
				'title' => 'Reviewers for Documents Listing',
				'page_title' => 'Reviewers for Documents Listing ('.$count.')',
				'table_name' => 'Reviewers for Documents Listing'
			);
		$this->db->order_by('created_on','DESC');
		$data['listing'] = $this->admin->get_result_array('tbl_admin','user_type','sub-admin');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/reviewers/listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function ct_reviewers_listing()
	{		
		$count = $this->admin->count_rows('tbl_admin','user_type','ct');
		$this->data = array(
				'title' => 'Reviewers for CE Course Listing',
				'page_title' => 'Reviewers for CE Course Listing ('.$count.')',
				'table_name' => 'Reviewers for CE Course Listing'
			);

		$this->db->order_by('created_on','DESC');
		$data['listing'] = $this->admin->get_result_array('tbl_admin','user_type','ct');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/reviewers/ct_listing',$data);
		$this->load->view('admin/common/footer');
	}


	public function reviewers_delete($id,$type)
	{		
		$this->db->where('user_type',$type);
		$result = $this->admin->delete('tbl_admin','user_ID',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/reviewers_listing');
	}

	public function send_email($to,$subject,$message,$from=FALSE,$fromName=FALSE,$debugger=FALSE){
		$from = "rboard@gmail.com";
		$fromName = "RBoard";
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		 
		if(mail($to, $subject, $message, $headers)){ 
		    return true;
		} else{ 
		    return false;
		}
	}


	//Add Lesson, Edit Lesson , List Lesson , Delete Lesson  


	public function lesson(){
		$count = $this->admin->count_rows('tbl_guidline','','');
		$this->data = array(
				'title' => 'Exam Guideline',
				'page_title' => 'Exam Guideline ('.$count.')',
				'table_name' => 'Exam Guideline'
			);
		$data['lesson_listing'] = $this->admin->get_result_object('tbl_guidline','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidline/listing',$data);
		$this->load->view('admin/common/footer');	
	}

	public function guidlineheading(){
		$count = $this->admin->count_rows('tbl_guidline_head','','');
		$this->data = array(
				'title' => 'Exam Guideline',
				'page_title' => 'Exam Guideline Heading ('.$count.')',
				'table_name' => 'Exam Guideline Heading'
			);
		$data['lesson_listing'] = $this->admin->get_result_object('tbl_guidline_head','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidlinehead/listing',$data);
		$this->load->view('admin/common/footer');	
	}

	public function add_lesson($id = false){
		$this->data = array(
				'title' => 'Add Guideline',
				'page_title' => 'Add Guideline',
				'table_name' => 'Add Guideline'
			);

		if($this->input->post()){
			
			$count = count($this->input->post('lesson_title'));

			for($i=0;$i<$count;$i++){
			if(isset($_FILES["lesson_video"]['name'][$i]) && !empty($_FILES["lesson_video"]['name'][$i])){
			
			$config['upload_path'] = './assets/upload/video/';
			$config['allowed_types'] = 'mp4|3gp';       
			$ext = explode('.',$_FILES["lesson_video"]["name"][$i]);        
			$imageName = 'VID_'.time().'.'.end($ext);
			$config['file_name'] = $imageName;
			
			$this->load->library('upload', $config);

			foreach($_FILES['lesson_video'] as $attr => $values) {
				$_FILES[$fld][$attr] = $values[$i];
			}

			if (!$this->upload->do_upload($fld)){
			   $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
					redirect('admin/lesson');	 		         
			}  
			$data['lesson_video'] = $imageName;
			}
			$insert['guidline_for']  			= $this->input->post('guidline_for');
			$insert['lesson_title']  			= $this->input->post('lesson_title')[$i];
			$insert['lesson_content']  			= $this->input->post('lesson_content')[$i];
			$insert['youtube_video']  			= $this->input->post('youtube_video')[$i];
			$insert['added_by']  				= 'admin';
			$insert['added_on'] 				= date('Y-m-d H:i:s');
			$insert['status']  					= 1;
			// print_r($insert);die;
			
				$inserted	=	$this->admin->save('tbl_guidline',$insert);
			}
			
			if($inserted){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Lesson added successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('admin/lesson', 'refresh');
		}

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidline/add',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function add_guidline_head($id = false){
		$this->data = array(
				'title' => 'Add  Guideline Heading',
				'page_title' => 'Add Guideline Heading',
				'table_name' => 'Add Guideline Heading'
			);

		if($this->input->post()){
			$this->form_validation->set_rules('content','Head Content','required');
			$this->form_validation->set_error_delimiters('<div class="text-danger px-4">','</div>');
			if($this->form_validation->run()){
			//print_r($this->input->post());exit;
			$insert = array();
			$insert['content']  			= $this->input->post('content');
			//$insert['lesson_content']  			= $this->input->post('lesson_content')[$i];
			//$insert['youtube_video']  			= $this->input->post('youtube_video')[$i];
			$insert['added_by']  				= 'admin';
			$insert['added_on'] 				= date('Y-m-d H:i:s');
			$insert['status']  					= 1;
			//print_r($insert);die;
			
			$inserted	=	$this->admin->save('tbl_guidline_head',$insert);
			
			
			if($inserted){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Guideline Heading added successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('admin/guidlineheading', 'refresh');
		}
		}

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidlinehead/add',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function edit_guidline_head($id = false){
		$this->data = array(
				'title' => 'Edit Guideline Heading',
				'page_title' => 'Edit Guideline Heading',
				'table_name' => 'Edit Guideline Heading'
			);

		if($this->input->post()){
			//print_r($this->input->post());exit;
			$insert = array();
			$insert['content']  			= $this->input->post('content');
			$insert['updated_at'] 				= date('Y-m-d H:i:s'); 
			$insert['status']  					= $this->input->post('status');	
			//$insert['lesson_content']  			= $this->input->post('lesson_content')[$i];
			//$insert['youtube_video']  			= $this->input->post('youtube_video')[$i];
			//$insert['added_by']  				= 'admin';
			//$insert['added_on'] 				= date('Y-m-d H:i:s');
			//$insert['status']  					= 1;
			//print_r($insert);die;
			
			//$inserted	=	$this->admin->save('tbl_guidline_head',$insert);
			$updated = $this->admin->update('tbl_guidline_head',$insert,'id',$this->input->post('head_id'));
			
			if($updated){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Guideline Heading update successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('admin/guidlineheading', 'refresh');
		}
		$this->data['heading'] = $this->admin->get_row_object('tbl_guidline_head','id',$id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidlinehead/edit',$this->data);
		$this->load->view('admin/common/footer');
	}


	public function lesson_view($id=false)
	{		
		$this->data = array(
			'title' => 'View Guideline',
			'page_title' => 'View Guideline',
			'table_name' => 'View Guideline'
		);

		$data['view'] = $this->admin->get_row_object('tbl_guidline','id',$id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidline/view',$data);
		$this->load->view('admin/common/footer');
	}
	public function heading_view($id=false)
	{		
		$this->data = array(
			'title' => 'View Guideline Heading',
			'page_title' => 'View Guideline Heading',
			'table_name' => 'View Guideline Heading'
		);

		$data['view'] = $this->admin->get_row_object('tbl_guidline_head','id',$id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/guidlinehead/view',$data);
		$this->load->view('admin/common/footer');
	}

	public function lesson_delete($id=false){
		$result = $this->admin->delete('tbl_guidline','id',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/lesson');
	}
	public function head_delete($id=false){
		$result = $this->admin->delete('tbl_guidline_head','id',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/guidlineheading');
	}

	public function lesson_edit($id=false){

		if($this->input->post()){
			if(isset($_FILES["lesson_video"]['name']) && !empty($_FILES["lesson_video"]['name'])){
				$config['upload_path'] = './assets/upload/video/';
				$config['allowed_types'] = 'mp4|3gp';       
				$ext = explode('.',$_FILES["lesson_video"]["name"]);        
				$imageName = 'VID_'.time().'.'.end($ext);
				$config['file_name'] = $imageName;
				
				$this->load->library('upload', $config);
				foreach($_FILES['lesson_video'] as $attr => $values) {
					$_FILES[$fld][$attr] = $values[$i];
				}

				if (!$this->upload->do_upload($fld)){
				    $this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">'.$this->upload->display_errors().'</div>');
					redirect('admin/lesson_edit/'.$id);		         
				}  
				$data['lesson_video'] = $imageName;
			}

			$insert['lesson_title']  			= $this->input->post('lesson_title');
			$insert['lesson_content']  			= $this->input->post('lesson_content');
			$insert['youtube_video']  			= $this->input->post('youtube_video');
			$insert['updated_at'] 				= date('Y-m-d'); 
			$insert['status']  					= $this->input->post('status');	
			
			$updated = $this->admin->update('tbl_guidline',$insert,'id',$this->input->post('lesson_id'));
			if($updated){
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Lesson updated successfully.</div>');
				redirect('admin/lesson_edit/'.$id);
			} else {
				$this->session->set_flashdata('response', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/lesson_edit/'.$id);
			}
		}else{
			$this->data = array(
				'title' => 'Edit Guideline',
				'page_title' => 'Edit Guideline',
				'table_name' => 'Edit Guideline'
			);
			$data['lesson'] = $this->admin->get_row_object('tbl_guidline','id',$id);
			
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/guidline/edit',$data);
			$this->load->view('admin/common/footer');
		}
	}

	
	//Add Exam Question, Edit Exam Question, List Exam Question, Delete Exam Question ,Admin Publish Exam Question 

	public function exam_question_listing($id=false){
		
		$this->data = array(
				'title' => 'Exam Question Listing',
				'page_title' => 'Exam Question Listing',
				'table_name' => 'Exam Question Listing'
			);
		
		$data['exam_dates'] = $this->examiner->get_all_exam_dates(date('Y'));
		$data['question_listing'] = $this->examiner->get_all_questions_for_admin('',''); // here 2 means Published
		$data['uniqueset'] = $this->examiner->get_uniqueset();
		$data['ques_category'] = $this->examiner->get_result_object('tbl_examination_categories');

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam/listing',$data);
		$this->load->view('admin/common/footer');	
	}
	public function add_edit_ques_cat_value(){
		$count = count($this->input->post('cat_id'));
		$this->session->set_userdata('temp_set_no',$this->input->post('set_no'));
		$data = array();
		for($i=0;$i<$count;$i++){
			$data['set_no'] = $this->input->post('set_no');
			$esc_id = $this->input->post('esc_id')[$i];
			$data['cat_id'] = $this->input->post('cat_id')[$i];
			$data['total_question'] = $this->input->post('total_question')[$i];
			
			if(!$esc_id){
				$data['added_on'] = date('Y-m-d');
				$inserted	=	$this->admin->save('tbl_exam_ques_by_cat_set',$data);
			}else{
				$updated = $this->admin->update('tbl_exam_ques_by_cat_set',$data,'esc_id',$esc_id);
			}
		}
		return redirect(base_url('admin/exam_question_listing'));
		
	}
	public function get_total_ques_by_category(){
		$set_no = $this->input->post('set_no');
		$result['t_question'] = $this->admin->get_result_object('tbl_exam_ques_by_cat_set', 'set_no', $set_no);
		echo json_encode($result); exit;
	}
	public function add_question(){
		$this->data = array(
				'title' => 'Add Question',
				'page_title' => 'Add Question',
				'table_name' => 'Add Question'
			);

		if($this->input->post()){
			
			$count = count($this->input->post('question_title'));
			
			for($i=0;$i<$count;$i++){
			if($this->input->post('set_no') > 0){
				$set_no  			= $this->input->post('set_no');
			}else{
				$set_no  			= $this->input->post('new_set_no');
			}
			$insert['set_no']				= $set_no;
			$insert['question_title']  		= $this->input->post('question_title')[$i];
			$insert['answere1']  			= $this->input->post('answere1')[$i];
			$insert['answere2']  			= $this->input->post('answere2')[$i];
			$insert['answere3']  			= $this->input->post('answere3')[$i];
			$insert['answere4']  			= $this->input->post('answere4')[$i];
			$insert['correct_answere']  	= $this->input->post('correct_answere')[$i];
			$insert['added_by']  			= $this->session->userdata('login')['user_ID'];
			$insert['added_on'] 			= date('Y-m-d H:i:s');
			$insert['status']  				= 1;
			
				$inserted	=	$this->admin->save('tbl_exam_question',$insert);
			}
			
			if($inserted){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Exam Question added successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('admin/exam_question_listing', 'refresh');
		}
		$data['uniqueset'] = $this->admin->get_uniqueset();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam/add',$data);
		$this->load->view('admin/common/footer');
	}


	public function question_view($id=false)
	{		
		$this->data = array(
			'title' => 'View Question',
			'page_title' => 'View Question',
			'table_name' => 'View Question'
		);

		$data['view'] = $this->examiner->get_question($id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam/view',$data);
		$this->load->view('admin/common/footer');
	}

	public function question_delete($id=false){
		$result = $this->admin->delete('tbl_exam_question','id',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/exam_question_listing');
	}

		public function question_edit($id=false){

		if($this->input->post()){
			$insert['question_title']  			= $this->input->post('question_title');
			$insert['answere1']  			= $this->input->post('answere1');
			$insert['answere2']  			= $this->input->post('answere2');
			$insert['answere3']  			= $this->input->post('answere3');
			$insert['answere4']  			= $this->input->post('answere4');
			$insert['correct_answere']  	= $this->input->post('correct_answere');
			$insert['updated_at'] 			= date('Y-m-d'); 
			$insert['status']  				= $this->input->post('status');	
			
			$updated = $this->admin->update('tbl_exam_question',$insert,'id',$this->input->post('question_id'));
			// echo $this->db->last_query();die;
			if($updated){
				$this->session->set_flashdata('item', '<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Question updated successfully.</div>');
				redirect('admin/exam_question_listing');
			} else {
				$this->session->set_flashdata('item', '<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/question_edit/'.$id);
			}
		}else{
			$this->data = array(
				'title' => 'Edit Question',
				'page_title' => 'Edit Question',
				'table_name' => 'Edit Question'
			);
			
			$data['question'] =  $this->examiner->get_question($id);
			$data['exam_dates'] = $this->examiner->get_all_exam_dates(date('Y'));
			$data['uniqueset'] = $this->admin->get_uniqueset();
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/exam/edit',$data);
			$this->load->view('admin/common/footer');
		}
	}

	public function admin_publish_question(){
		$id = $this->input->post('id');
		$staus = $this->input->post('status');
		$set_no = $this->input->post('set_no');

		if($staus == 2){
			$check_limit = $this->admin->checkExamQuestionLimit($set_no);
			if($check_limit < 101){
				$update = ['status'=>'2'];
				$updated = $this->admin->update('tbl_exam_question',$update,'id',$id);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Question published successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">You have achieved the maximum limit of adding questions. (Limit is 100 questions per Examination)</div>');
			}
		}
		if($staus == 1)
		{
			$update = ['status'=>'1'];
			$updated = $this->admin->update('tbl_exam_question',$update,'id',$id);
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Question Unpublished successfully.</div>');
		}
		redirect('admin/exam_question_listing', 'refresh');
	}
	public function admin_publish_question_bycategory(){
		$id = $this->input->post('id');
		$staus = $this->input->post('status');
		$ques_cat_id = $this->input->post('ques_cat_id');
		$set_no = $this->input->post('set_no');
		
		if($staus == 1){
			$ques_limit = $this->admin->check_ques_limit_by_catid_and_setno($ques_cat_id, $set_no);
			$get_ques = $this->admin->check_get_question($ques_cat_id, $set_no);
			//echo json_encode($get_ques); exit;
			if($get_ques < $ques_limit->total_question){
				$update = ['set_no'=>$set_no, 'status'=>'2',];
				$updated = $this->admin->update('tbl_exam_question',$update,'id',$id);
				//$this->session->set_flashdata('item', '<div class="alert alert-success">Question published successfully.</div>');
				$result['message'] = 'success';
			}else{
				//$this->session->set_flashdata('item', '<div class="alert alert-danger">You have achieved the maximum limit of adding questions in this category.</div>');
				$result['message'] = 'error';
			}
		}else{
			$result['message'] = 'exist';
		}
		/*if($staus == 1)
		{
			$update = ['status'=>'1'];
			$updated = $this->admin->update('tbl_exam_question',$update,'id',$id);
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Question Unpublished successfully.</div>');
		}*/
		//redirect('admin/exam_question_listing', 'refresh');
		echo json_encode($result); exit;
	}

	//Add Examiner, Edit Examiner , List Examiner , Delete Examiner  

	public function add_examiner($id = false)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->data = array(
				'title' => 'Add Examiner',
				'page_title' => 'Add Examiner',
				'table_name' => 'Add Examiner'
			);
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
		if($this->input->post('examiner_id')=='') 
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.username]');
		}
		if ($this->form_validation->run() == FALSE)
        {
			if($id){
				$this->data['examiner'] = $this->admin->get_row_object('tbl_admin','user_ID',$id);
			}
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/examiner/add',$this->data);
			$this->load->view('admin/common/footer');
        }else{

		if($this->input->post()){
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/uploads/examiner/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				// $config['allowed_types'] 	= '*';      
				$ext 						= explode('.',$_FILES["photo"]["name"]);        
				$photo 						= 'photo'.time().'.'.end($ext);
				$config['file_name'] 		= $photo;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$photo = $photo;
			}else{
				$photo = $this->input->post('old_photo');
			}
			if($this->input->post('examiner_id')) 
			{
				$insert['user_ID'] 		= $this->input->post('examiner_id');
				// $insert['updated_at'] 	= date('Y-m-d');
			}else{
				// $insert['created_on'] 	= date('Y-m-d H:i:s');
				$insert['user_type']  	= $this->input->post('user_type');
				$insert['password']  	= password_hash($this->input->post('password'),PASSWORD_DEFAULT);
			}
			
				$insert['first_name']  		= $this->input->post('first_name');
				$insert['last_name']  		= $this->input->post('last_name');
				$insert['email']  			= $this->input->post('email');
				$insert['username']  		= $this->input->post('username');
				$insert['photo'] 			= $photo;
				$insert['created_on'] 		= $this->input->post('created_on');
				$insert['validity_date']  	= $this->input->post('validity_date');
				$insert['status']  			= $this->input->post('status');

			// print_r($data);die;
			$updated = '';
			$inserted = '';
			if($this->input->post('examiner_id'))
			{	
				$updated = $this->admin->update('tbl_admin',$insert,'user_ID',$this->input->post('examiner_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

			}else{

				$inserted	=	$this->admin->save('tbl_admin',$insert);

			}

			if($inserted != ''){
				$settingarr = $this->common_model->get_setting('1');
				$mailContent = '<p>Welcome to <b>'.$settingarr->rb_name.'</b> as EXAMINER.</p>
								<p> To access your reviewer account, here are your credentials:</p>
								<p> Username : <b>'.$this->input->post('email').'</b></p> 
								<p> Password: <b>'.$this->input->post('password').'</b> </p>
								<p>Please <a href = "'.base_url('login').'"> click here </a> to log in.</p>';
				$this->admin_mail($insert['email'],$insert['first_name'].' '.$insert['last_name'],'Your username & password',$mailContent);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Examiner added successfully.</div>');
			}elseif($updated != ''){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Examiner updated successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}

			redirect('admin/examiner_listing', 'refresh');

		}

		}
	}


	public function examiner_listing()
	{		
		$count = $this->admin->count_rows('tbl_admin','user_type','e');
		$this->data = array(
				'title' => 'Examiner Listing',
				'page_title' => 'Examiner Listing ('.$count.')',
				'table_name' => 'Examiner Listing'
			);

		$data['listing'] = $this->admin->get_result_array('tbl_admin','user_type','e');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examiner/listing',$data);
		$this->load->view('admin/common/footer');
	}


	public function examiner_delete($id=false)
	{		
		$this->db->where('user_type','e');
		$result = $this->admin->delete('tbl_admin','user_ID',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/examiner_listing');
	}



	public function admin_mail($recevier_email, $recevier_name, $subject, $message, $attachment = false){
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>'.$message.'<br><br>Should you have questions just message us and we would be happy to assist you.<br>';
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
		
		$settingarr = $this->common_model->get_setting('1');
			//send Mail 
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($recevier_email);
			$this->email->subject($subject);
			$emailbody = array();
			$emailbody['name'] 			= $recevier_name;
			$emailbody['thanksname'] 	= $settingarr->signature_name;
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= $settingarr->position;
			$emailbody['body_msg'] 	= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);//$this->email->message('Testing the email class.');
			$this->email->message($emailmessage);
			if(isset($attachment) && file_exists('assets/uploads/pdf/'.$attachment.'.pdf')){
				$this->email->attach(base_url('assets/uploads/pdf/'.$attachment.'.pdf'));
			}
			$this->email->send();
			//end send Mail 
	}

	public function add_media($id = false)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->data = array(
				'title' => 'Add Media',
				'page_title' => 'Add Media',
				'table_name' => 'Add Media'
			);
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
		if($this->input->post('media_id')=='') 
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.username]');
		}
		if ($this->form_validation->run() == FALSE)
        {
			if($id){
				$this->data['media'] = $this->admin->get_row_object('tbl_admin','user_ID',$id);
			}
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/media/add',$this->data);
			$this->load->view('admin/common/footer');
        }else{

		if($this->input->post()){
			$photo = '';
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/uploads/media/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';   
				$ext 						= explode('.',$_FILES["photo"]["name"]);        
				$photo 						= 'photo'.time().'.'.end($ext);
				$config['file_name'] 		= $photo;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo'))
				{
				$error = array('error' => $this->upload->display_errors());      
				}  
				$photo = $photo;
			}else{
				$photo = $this->input->post('old_photo');
			}
			if($this->input->post('media_id')) 
			{
				$insert['user_ID'] 		= $this->input->post('media_id');
				// $insert['updated_at'] 	= date('Y-m-d');

			}else{

				$insert['created_on'] 	= date('Y-m-d H:i:s');
				$insert['user_type']  	= $this->input->post('user_type');
				$insert['password']  	= password_hash($this->input->post('password'),PASSWORD_DEFAULT);

			}

			$insert['first_name']  		= $this->input->post('first_name');
			$insert['last_name']  		= $this->input->post('last_name');
			$insert['email']  			= $this->input->post('email');
			$insert['photo']  			= $photo;
			$insert['username']  		= $this->input->post('username');
			$insert['created_on'] 		= $this->input->post('created_on');
			$insert['validity_date']  	= $this->input->post('validity_date');
			$insert['status']  			= $this->input->post('status');

			// print_r($data);die;
			$updated = '';
			$inserted = '';
			if($this->input->post('media_id'))
			{	
				$updated = $this->admin->update('tbl_admin',$insert,'user_ID',$this->input->post('media_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

			}else{

				$inserted	=	$this->admin->save('tbl_admin',$insert);

			}

			if($inserted != ''){
				$settingarr = $this->common_model->get_setting('1');
				$mailContent = '<p>Welcome to <b>'.$settingarr->rb_name.'</b> as Media.</p>
								<p> To access your Media account, here are your credentials:</p>
								<p> Username : <b>'.$this->input->post('email').'</b></p> 
								<p> Password: <b>'.$this->input->post('password').'</b> </p>
								<p>Please <a href = "'.base_url('login').'"> click here </a> to log in.</p>';
				$this->admin_mail($insert['email'],$insert['first_name'].' '.$insert['last_name'],'Your username & password',$mailContent);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Media added successfully.</div>');
			}elseif($updated != ''){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Media updated successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}

			redirect('admin/media_listing', 'refresh');

		}

		}
	}

	public function media_listing()
	{		
		$count = $this->admin->count_rows('tbl_admin','user_type','m');
		$this->data = array(
				'title' => 'Media Personnel',
				'page_title' => 'Media Personnel ('.$count.')',
				'table_name' => 'Media Personnel'
			);

		$data['listing'] = $this->admin->get_result_array('tbl_admin','user_type','m');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/media/listing',$data);
		$this->load->view('admin/common/footer');
	}
	public function media_delete($id=false)
	{		
		$this->db->where('user_type','m');
		$result = $this->admin->delete('tbl_admin','user_ID',$id);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/media_listing');
	}
	public function add_cashier($id = false)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->data = array(
				'title' => 'Add Cashier',
				'page_title' => 'Add Cashier',
				'table_name' => 'Add Cashier'
			);
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('email', 'email', 'required|trim');
			$this->form_validation->set_rules('status', 'status', 'required|trim');
		if($this->input->post('cashier_id')=='') 
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.username]');
		}
		if ($this->form_validation->run() == FALSE)
        {
			if($id){
				$this->data['cashier'] = $this->admin->get_row_object('tbl_admin','user_ID',$id);
			}
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/cashier/add',$this->data);
			$this->load->view('admin/common/footer');
        }else{

		if($this->input->post()){
			$photo = '';
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/uploads/cashier/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';   
				$ext 						= explode('.',$_FILES["photo"]["name"]);        
				$photo 						= 'photo'.time().'.'.end($ext);
				$config['file_name'] 		= $photo;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo'))
				{
				$error = array('error' => $this->upload->display_errors());      
				}  
				$photo = $photo;
			}else{
				$photo = $this->input->post('old_photo');
			}
			if($this->input->post('cashier_id')) 
			{
				$insert['user_ID'] 		= $this->input->post('cashier_id');
				// $insert['updated_at'] 	= date('Y-m-d');

			}else{

				//$insert['created_on'] 	= date('Y-m-d H:i:s');
				$insert['user_type']  	= $this->input->post('user_type');
				$insert['password']  	= password_hash($this->input->post('password'),PASSWORD_DEFAULT);

			}

			$insert['first_name']  		= $this->input->post('first_name');
			$insert['last_name']  		= $this->input->post('last_name');
			$insert['email']  			= $this->input->post('email');
			$insert['photo']  			= $photo;
			$insert['created_on']  		= $this->input->post('created_on');
			$insert['validity_date']  	= $this->input->post('validity_date');
			$insert['username']  		= $this->input->post('username');
			$insert['status']  			= ($this->input->post('status') !="")?$this->input->post('status'):1;

			// print_r($data);die;
			$updated = '';
			$inserted = '';
			if($this->input->post('cashier_id'))
			{	
				$updated = $this->admin->update('tbl_admin',$insert,'user_ID',$this->input->post('cashier_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

			}else{

				$inserted	=	$this->admin->save('tbl_admin',$insert);

			}

			if($inserted != ''){
				$settingarr = $this->common_model->get_setting('1');
				$mailContent = '<p>Welcome to <b>'.$settingarr->rb_name.'</b> as Cashier.</p>
								<p>Your appointment starts on '.$this->input->post('created_on').' and will end on '.$this->input->post('validity_date').'.</p>
								<p>To access your cashier account these are your credentials:</p>
								<p>Username: <b>'.$this->input->post('email').'</b></p> 
								<p>Password: <b>'.$this->input->post('password').'</b> </p>
								<p>Please <a href = "'.base_url('login').'"> click here </a> to access your acount.</p>';
				$this->admin_mail($insert['email'],$insert['first_name'].' '.$insert['last_name'],'Your username & password',$mailContent);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Cashier added successfully.</div>');
			}elseif($updated != ''){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Cashier updated successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}

			redirect('admin/cashier_listing', 'refresh');

		}

		}
	}

	public function cashier_listing()
	{		
		$count = $this->admin->count_rows('tbl_admin','user_type','c');
		$this->data = array(
				'title' => 'Cashier Listing',
				'page_title' => 'Cashier Listing ('.$count.')',
				'table_name' => 'Cashier Listing'
			);

		$data['listing'] = $this->admin->get_result_array('tbl_admin','user_type','c');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cashier/listing',$data);
		$this->load->view('admin/common/footer');
	}
	public function cashier_delete($id=false)
	{		
		$this->db->where('user_type','c');
		$result = $this->admin->delete('tbl_admin','user_ID',$id);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/cashier_listing');
	}
	//Add Proctor, Edit Proctor , List Proctor , Delete Proctor  

	public function add_proctor($id = false)
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->data = array(
				'title' => 'Add Proctor',
				'page_title' => 'Add Proctor',
				'table_name' => 'Add Proctor'
			);
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		if($this->input->post('proctor_id')=='') 
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.username]');
		}
		if ($this->form_validation->run() == FALSE)
        {
			if($id){
				$this->data['proctor'] = $this->admin->get_row_object('tbl_admin','user_ID',$id);
			}
			
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/proctor/add',$this->data);
			$this->load->view('admin/common/footer');
        }else{

		if($this->input->post()){
			$photo = '';
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/uploads/proctor/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				// $config['allowed_types'] 	= '*';      
				$ext 						= explode('.',$_FILES["photo"]["name"]);        
				$photo 						= 'photo'.time().'.'.end($ext);
				$config['file_name'] 		= $photo;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$photo = $photo;
			}else{
				$photo = $this->input->post('old_photo');
			}
			if($this->input->post('proctor_id')) 
			{
				$insert['user_ID'] 		= $this->input->post('proctor_id');
				// $insert['updated_at'] 	= date('Y-m-d');
				if($this->input->post('password') !=""){
					$insert['password']  	= password_hash($this->input->post('password'),PASSWORD_DEFAULT);	
				}
			}else{
				// $insert['created_on'] 	= date('Y-m-d H:i:s');
				$insert['user_type']  	= $this->input->post('user_type');
				$insert['password']  	= password_hash($this->input->post('password'),PASSWORD_DEFAULT);
			}

			$insert['first_name']  		= $this->input->post('first_name');
			$insert['last_name']  		= $this->input->post('last_name');
			$insert['email']  			= $this->input->post('email');
			$insert['username']  		= $this->input->post('username');
			$insert['photo'] 			= $photo;
			$insert['login_ip'] 		= trim($this->input->post('login_ip'));
			$insert['created_on'] 		= $this->input->post('created_on');
			$insert['validity_date']  	= $this->input->post('validity_date');
			$insert['status']  			= $this->input->post('status');
			// print_r($data);die;
			$updated = '';
			$inserted = '';
			if($this->input->post('proctor_id'))
			{	
				
				$updated = $this->admin->update('tbl_admin',$insert,'user_ID',$this->input->post('proctor_id')); 
				$proctor_id = 	$this->input->post('proctor_id');
				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

			}else{

				$inserted	=	$this->admin->save('tbl_admin',$insert);
				$proctor_id = 	$inserted;
			} 
			if($proctor_id > 0){
				$this->admin->delete('tbl_proctor_exam_schedule','proctor_id',$proctor_id);
				$exam_schedual_id 	=  $this->input->post('exam_schedual_id');
				if($exam_schedual_id){
				foreach ($exam_schedual_id as $key => $value1) {
					if($value1 != ""){
						$data2['exam_schedule_id']    	= $value1;
						$data2['proctor_id']  	= $proctor_id;
						$data2['added_at']  	= date('Y-m-d H:i:s');
						$this->admin->save('tbl_proctor_exam_schedule',$data2); 
					}
				} }
			}
			if($inserted != ''){
				$as = '';
				if($this->input->post('user_type')=='p'){
					$as = 'PROCTOR FOR GRADUATES';	
				}
				if($this->input->post('user_type')=='PP'){
					$as = 'PROCTOR FOR FOREIGN PROFESSIONAL';
				}
				$settingarr = $this->common_model->get_setting('1');
				$mailContent = '<p>Welcome to <b>'.$settingarr->rb_name.'</b> as '.$as.'.</p>
								<p> To access your proctor account, here are your credentials:</p>
								<p> Username : <b>'.$this->input->post('email').'</b></p> 
								<p> Password: <b>'.$this->input->post('password').'</b> </p>
								<p>Please <a href = "'.base_url('login').'"> click here </a> to log in.</p>';
				$this->admin_mail($insert['email'],$insert['first_name'].' '.$insert['last_name'],'Your username & password',$mailContent);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Proctor added successfully.</div>');
			}elseif($updated != ''){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Proctor updated successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}

			redirect('admin/proctor_listing', 'refresh');

		}

		}
	}
	public function get_exam_schedule_for_proctor(){ 
		$proctor = $_POST['proctor'];
		$proctor_id = $_POST['proctor_id'];
		$assingedexaschudule = array();
		if($proctor_id > 0){
			$assingedexaschudule = $this->admin->assingedexaschudule($proctor_id);
		}
		$schedullist = $this->admin->get_examination_schedule_for_proctor($proctor,date('Y-m-d'));
			$assigned = array();
			if(count($assingedexaschudule) > 0){			
				foreach($assingedexaschudule as $aasch){
					array_push($assigned,$aasch->exam_schedule_id);
				}
			}
				//print_r($assigned);
		if(count($schedullist) > 0 ){
			echo '<table class="table table-striped table-hover"><tr><th></th><th>Name</th><th>Date</th><th>Start Time</th><th>End Time</th><th>Max. Application</th><th>Venue</th></tr>';
			foreach($schedullist as $sch){
				
				//echo '<pre>'; print_r($assingedexaschudule);
				$checked = in_array($sch->es_id,$assigned)?'checked':'';	
				echo '<tr><td><input type="checkbox" name="exam_schedual_id[]" value="'.$sch->es_id.'" '.$checked.'></td><td>'.$sch->name_of_exam.'</td><td>'.$sch->date.'</td><td>'.$sch->start_time.'</td><td>'.$sch->end_time.'</td><td>'.$sch->maximum_applicant.'</td><td>'.$sch->venue.'</td></tr>';
			}
			echo '</table>';
		}else{
			echo '<p style="color:red;">No exam schedule.</p>';
		}
	}
	public function proctor_listing()
	{		
		$this->db->where('user_type','p');
		$this->db->or_where('user_type','pp');
		$count = $this->admin->count_rows('tbl_admin','','');
		$this->data = array(
				'title' => 'Proctor Listing',
				'page_title' => 'Proctor Listing ('.$count.')',
				'table_name' => 'Proctor Listing'
			);
			
		$this->db->where('user_type','p');
		$this->db->or_where('user_type','pp');
		$data['listing'] = $this->admin->get_result_array('tbl_admin','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/proctor/listing',$data);
		$this->load->view('admin/common/footer');
	}


	public function proctor_delete($id=false)
	{		
		$this->db->where('user_type','p');
		$result = $this->admin->delete('tbl_admin','user_ID',$id);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/proctor_listing');
	}



	public function examinees_listing()
	{		
		$count = $this->admin->get_examinee();
		$pro_examinee = $this->admin->get_pro_examinees();
		$totalexaminee = count($count) + count($pro_examinee);
		$this->data = array(
				'title' => 'Examinees and Exam Pass',
				'page_title' => 'Examinees and Exam Pass ('.$totalexaminee.')',
				'table_name' => 'Examinees and Exam Pass'
			);
		$data['listing'] = $this->admin->get_examinee();
		$data['totalgradexaminee'] = $this->admin->get_total_grad_examinee();
		$data['prolist'] = $this->admin->get_pro_examinees();
		$data['totalproexaminee'] = $this->admin->get_total_pro_examinees();
		$data['examsch'] = $this->admin->get_examschedule();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examinees/listing',$data);
		$this->load->view('admin/common/footer');
	}

	public function foreign_examnees_listing()
	{	
		$count = $this->admin->get_prof_application_list(1,'1');
		$this->data = array(
				'title' => 'Foreign Professionals & Exam Code 	',
				'page_title' => 'Foreign Professionals & Exam Code ('.$count.')',
				'table_name' => 'Foreign Professionals & Exam Code'
			);

		$data['listing'] = $this->admin->get_prof_application_list(0,'1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examinees/foreign_examnees',$data);
		$this->load->view('admin/common/footer');
	}

	
	public function foreign_examnees_result()
	{	
		$this->data = array(
				'title' => 'Examination Result for Foreign Professionals',
				'page_title' => 'Examination Result for Foreign Professionals',
				'table_name' => 'Examination Result for Foreign Professionals'
			);

		// $data['total_exam'] = $this->proctor->get_upcomming_exam('pp',2,'');
		// $data['listing'] = $this->proctor->get_forigen_examiness_list();
		$data['result'] = $this->admin->get_forigen_examiness_result();
		$data['examsch'] = $this->admin->get_examschedule();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam_result/foreign_examnees_result',$data);
		$this->load->view('admin/common/footer');
	}
	
	public function graduate_examiness_result()
	{	
		$this->data = array(
				'title' => 'Examination Result for Local Graduates',
				'page_title' => 'Examination Result for Local Graduates',
				'table_name' => 'Examination Result for Local Graduates'
			);

		// $data['total_exam'] = $this->proctor->get_upcomming_exam('p',2,'');
		// $data['listing'] = $this->proctor->get_graduate_examiness_list();
		$data['result'] = $this->admin->get_graduate_examiness_result();
		$data['examsch'] = $this->admin->get_examschedule();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam_result/graduate_examnees_result',$data);
		$this->load->view('admin/common/footer');
	}

	public function send_exam_result(){
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$examdate = $this->input->post('examdate');
		$regcode = $this->input->post('regcode');
		$validity = $this->input->post('validity');
		$er_id = $this->input->post('er_id');
		$exam_result = $this->input->post('exam_result');
		$details = $this->admin->get_row_object('tbl_exam_result','id',$er_id);

		//print_r($this->input->post());exit;
		if($details){
			$totalques = $details->total_marks/100;
			$submitques = $details->obtained_marks/100;
			if($details->status == 'Fail'){
				$passcontent = '';
			}else{
			$passcontent = '<p>You can now apply for Professional Registration using the registration code.
							<br>Registration Code : '.$regcode.' Validity : '.$validity.
							'<p>Please <a href="https://ceonpointllc.com/rboard/professional/applicant/registration_form">Click Here</a> to apply for registration';
			}
			$mailContent = '<p>Here is your exam result </p>
							<p>Licensure Exam Title : '.$name.'<br>Date of Exam : '.$examdate.'<br>Total Questions : '.$totalques.
							'<br>Correct Answers Submitted : '.$submitques.
							'<br>Percentage : '.$details->percentage.'(%)
							<br>Remarks : <strong>'.$details->status.'</strong>'.$passcontent 
							;
			//echo $mailContent;exit;
			$this->admin_mail($email,$details->user_name,'Exam Result!',$mailContent);
			// $this->admin_mail('nutan2247@gmail.com',$details->user_name,'Exam Result!',$mailContent);

			$update['result_sent'] = $details->result_sent + 1;
			$update['updated_at'] = date('Y-m-d H:i:s');
			$this->admin->update('tbl_exam_result',$update,'id',$er_id);
			$this->session->set_flashdata('item', '<div class="alert alert-success">Result sent successfully.</div>');
		}  
		
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function incomereport(){	
		$this->data = array(
				'title' => 'income report',
				'page_title' => 'income report',
				'table_name' => 'income report'
			);
		$titlebreadcrum = "";	
		if(isset($_GET['country']) && $_GET['country'] ==""){	
			$titlebreadcrum .= "All";	
		}
		if(isset($_GET['country']) && $_GET['country'] !=""){
			$countries = $this->admin->get_result_array('tbl_countries','countries_id',$_GET['country']);
			//print_r($countries);
			$titlebreadcrum .= $countries[0]['countries_name'];	
		}
		if(isset($_GET['user_role']) && $_GET['user_role'] !=""){
			//$newname = str_replace('-',' ',$_GET['user_role']);
			if($_GET['user_role'] == 'U'){
				$newname = "School";
			}
			if($_GET['user_role'] == 'G'){
				$newname = "Graduates";
			}
			if($_GET['user_role'] == 'P'){
				$newname = "Local Professionals";
			}
			if($_GET['user_role'] == 'F'){
				$newname = "Foreign Professionals";
			}
			if($_GET['user_role'] == 'CEP'){
				$newname = "CEP";
			}
			$titlebreadcrum .= '/'.ucwords($newname);	
		}
		if(isset($_GET['modules']) && $_GET['modules'] !=""){
			//$titlebreadcrum .= '/'.$_GET['modules'];	
		}
		if(isset($_GET['mouth']) && $_GET['mouth'] !=""){
			$monthname = '';
			if($_GET['mouth'] == '01'){
				$monthname = 'Jan';
			}
			if($_GET['mouth'] == '02'){
				$monthname = 'Feb';
			}
			if($_GET['mouth'] == '03'){
				$monthname = 'Mar';
			}
			if($_GET['mouth'] == '04'){
				$monthname = 'Apr';
			}
			if($_GET['mouth'] == '05'){
				$monthname = 'May';
			}
			if($_GET['mouth'] == '06'){
				$monthname = 'Jun';
			}
			if($_GET['mouth'] == '07'){
				$monthname = 'Jul';
			}
			if($_GET['mouth'] == '08'){
				$monthname = 'Aug';
			}
			if($_GET['mouth'] == '09'){
				$monthname = 'Sep';
			}
			if($_GET['mouth'] == '10'){
				$monthname = 'Oct';
			}
			if($_GET['mouth'] == '11'){
				$monthname = 'Nov';
			}if($_GET['mouth'] == '12'){
				$monthname = 'Dec';
			}
			$titlebreadcrum .= '/'.$monthname;	
		}
		if(isset($_GET['day']) && $_GET['day'] !=""){
			$titlebreadcrum .= ' '.$_GET['day'];		
		}
		
		if(isset($_GET['year']) && $_GET['year'] !=""){
			$titlebreadcrum .= ','.$_GET['year'];	
		}
		
		$data['title'] 		= 'Income Report'; 
		$data['titlebreadcrum'] 	= $titlebreadcrum; 
		$data['incomereport'] 		= $this->common_model->all_income_report_listing();
		$data['todayincome'] 		= $this->common_model->sumincomereport('','today');
		$data['monthlyincome'] 		= $this->common_model->sumincomereport('','monthly');
		$data['anualincome'] 		= $this->common_model->sumincomereport('','anual');
		$data['lifetimeincome'] 	= $this->common_model->sumincomereport('','');
		
		$data['professionreg'] = $this->common_model->sumincomereport('PR','','N');
		$data['professional_renew'] = $this->common_model->sumincomereport('PR','','R');
		$data['professionalgraduate_renew'] = $this->common_model->sumincomereport('PRG','','R');

		$data['school'] 	= $this->common_model->sumincomereport('U','','N');
		$data['school_renew'] 	= $this->common_model->sumincomereport('U','','R');
		$data['graducates'] 	= $this->common_model->sumincomereport('G','','S'); // submission of graduates
		$data['graducates_booking'] 	= $this->common_model->sumincomereport('G','','E'); // exam booking of graduates
		$data['foreignprofessonals'] 	= $this->common_model->sumincomereport('P','','N');
		$data['foreignprofessonals_forexam'] 	= $this->common_model->sumincomereport('PP','','N');
		$data['foreignprofessonals_onlineexam_booking'] 	= $this->common_model->sumincomereport('PP','','E');
		$data['cep'] 		= $this->common_model->sumincomereport('CEP','','N');
		$data['cep_renew'] 	= $this->common_model->sumincomereport('CEP','','R');
		$data['course'] 	= $this->common_model->sumincomereport('C','','N');
		$data['training'] 	= $this->common_model->sumincomereport('T','','N');

		$data['verification_registration'] = $this->common_model->sumincomereport('VR','','N');
		$data['good_standing'] = $this->common_model->sumincomereport('GS','','N');

		$data['income_subsetion_url']	 = 'admin/report/';
		
		$data['countries'] 	= $this->admin->get_result_array('tbl_countries','','');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('finance/allincomereport',$data);
		$this->load->view('admin/common/footer');
	}
	public function report(){
		
		$this->data = array(
			'title' => 'income report',
			'page_title' => 'income report',
			'table_name' => 'income report'
		);
		$reportfor = $this->uri->segment(3);
		$payment_for = "";
		$payment_type = "";
		$income_sources = "";
		if($reportfor == 'professional_registration'){
			$payment_for = 'PR';
			$payment_type = "N";
			$income_sources = "professional_registration";
		}
		if($reportfor == 'professional_license_renewal'){
			//$payment_for = 'PR';
			$payment_for = array('PR','PRG');
			$payment_type = "R";
			$income_sources = "professional_license_renewal";
		}
		if($reportfor == 'school_accreditaion'){
			$payment_for = 'U';
			//$payment_type = "N";
			$income_sources = "school_accreditaion";
		}
		
		if($reportfor == 'submission_of_graduates'){
			$payment_for = 'G';
			$payment_type = "S";
			$income_sources = "submission_of_graduates";
		}
		if($reportfor == 'booking_for_exam_graduates'){
			$payment_for = 'G';
			$payment_type = "E"; 
			$income_sources = "booking_for_exam_graduates";
		}
		if($reportfor == 'foreign_professional_registration'){
			$payment_for = 'P';
			$payment_type = "N";
			$income_sources = "foreign_professional_registration";
		}
		if($reportfor == 'foreign_professional_examination'){
			$payment_for = 'PP';
			$payment_type = "N";
			$income_sources = "foreign_professional_examination";
		}
		if($reportfor == 'booking_for_exam_foreign_professionals'){
			$payment_for = 'PP';
			$payment_type = "E";
			$income_sources = "booking_for_exam_foreign_professionals";
		}
		if($reportfor == 'cep_accreditation'){
			$payment_for = 'CEP';
			//$payment_type = "N";
			$income_sources = "cep_accreditation";
		}
		
		if($reportfor == 'online_course_accreditation'){
			$payment_for = 'C';
			$payment_type = "N";
			$income_sources = 'online_course_accreditation';
		}
		if($reportfor == 'training_course_accreditation'){
			$payment_for = 'T';
			$payment_type = "N";
			$income_sources = 'training_course_accreditation';
		}
		if($reportfor == 'verification_of_registration'){
			$payment_for = 'VR';
			$payment_type = "N";
			$income_sources = 'verification_of_registration';
		}
		if($reportfor == 'certificate_of_good_standing'){
			$payment_for = 'GS';
			$payment_type = "N";
			$income_sources = 'certificate_of_good_standing';
		}
		//echo $payment_for;
		$data['incomereport'] 		= $this->common_model->all_income_report_listing($income_sources);
		$data['todayincome'] 		= $this->common_model->sumincomereport($payment_for,'today');
		$data['monthlyincome'] 		= $this->common_model->sumincomereport($payment_for,'monthly',$payment_type);
		$data['anualincome'] 		= $this->common_model->sumincomereport($payment_for,'anual',$payment_type);
		$data['lifetimeincome'] 	= $this->common_model->sumincomereport($payment_for,'',$payment_type); 
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar',$this->data);
		$this->load->view('finance/report',$data);
		$this->load->view('admin/common/footer',$this->data);	
	}

	public function subrole(){
		$user_role = $_POST['user_role'];
		$modules = (isset($_POST['modules']))?$_POST['modules']:'';
		if($user_role == 'U'){
			$universityarry = $this->admin->get_result_array('tbl_university','status','1');
			foreach($universityarry as $sch){
				$selectd = (isset($modules) && $modules == $sch['uniid'])?'selected':'';
				echo '<option value="'.$sch['uniid'].'" '.$selectd.'>'.$sch['university_name'].'</option>';	
			}
		}
		if($user_role == 'G'){
			$universityarry = $this->admin->get_result_array('graduates','','');
			foreach($universityarry as $sch){
				$selectd = (isset($modules) && $modules == $sch['grad_id'])?'selected':'';
				echo '<option value="'.$sch['grad_id'].'" '.$selectd.'>'.$sch['student_name'].'</option>';	
			}
		}
		if($user_role == 'P'){
			$universityarry = $this->admin->get_result_array(' tbl_users','role','L');
			foreach($universityarry as $sch){
				$selectd = (isset($modules) && $modules == $sch['user_ID'])?'selected':'';
				echo '<option value="'.$sch['user_ID'].'" '.$selectd.'>'.$sch['name'].'</option>';	
			}
		}
		if($user_role == 'F'){
			$universityarry = $this->admin->get_result_array(' tbl_users','role','F');
			foreach($universityarry as $sch){
				$selectd = (isset($modules) && $modules == $sch['user_ID'])?'selected':'';
				echo '<option value="'.$sch['user_ID'].'" '.$selectd.'>'.$sch['name'].'</option>';	
			}
		}
		if($user_role == 'CEP'){
			$universityarry = $this->admin->get_result_array('tbl_ce_provider','status','1');
			foreach($universityarry as $sch){
				$selectd = (isset($modules) && $modules == $sch['provider_id'])?'selected':'';
				echo '<option value="'.$sch['provider_id'].'" '.$selectd.'>'.$sch['business_name'].'</option>';	
			}
		}
		
	}
	public function university_incomereport(){	
		$this->data = array(
				'title' => 'university income report',
				'page_title' => 'university income report',
				'table_name' => 'university income report'
			);
		$data['incomereport'] = $this->admin->income_report_listing('U');
		$data['todayincome'] = $this->common_model->sumincomereport('U','today');
		$data['monthlyincome'] = $this->common_model->sumincomereport('U','monthly');
		$data['anualincome'] = $this->common_model->sumincomereport('U','anual');
		$data['lifetimeincome'] = $this->common_model->sumincomereport('U','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/incomereport',$data);
		$this->load->view('admin/common/footer');
	}
	public function professional_incomereport(){	
		$this->data = array(
				'title' => 'professional income report',
				'page_title' => 'professional income report',
				'table_name' => 'professional income report'
			);
		$data['incomereport'] = $this->admin->profession_income_report_listing('P');
		$data['todayincome'] = $this->common_model->sumincomereport('P','today');
		$data['monthlyincome'] = $this->common_model->sumincomereport('P','monthly');
		$data['anualincome'] = $this->common_model->sumincomereport('P','anual');
		$data['lifetimeincome'] = $this->common_model->sumincomereport('P','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/professional_incomereport',$data);
		$this->load->view('admin/common/footer');
	}
	public function foreign_incomereport(){	 
		$this->data = array(
				'title' => 'foreign professional income report',
				'page_title' => 'foreign professional income report',
				'table_name' => 'foreign professional income report'
			);
		$data['incomereport'] = $this->admin->profession_income_report_listing('F');
		$data['todayincome'] = $this->common_model->sumincomereport('F','today');
		$data['monthlyincome'] = $this->common_model->sumincomereport('F','monthly');
		$data['anualincome'] = $this->common_model->sumincomereport('F','anual');
		$data['lifetimeincome'] = $this->common_model->sumincomereport('F','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/professional_incomereport',$data);
		$this->load->view('admin/common/footer');
	}
	public function course_incomereport(){	
		$this->data = array(
				'title' => 'course income report',
				'page_title' => 'course income report',
				'table_name' => 'course income report'
			);
		$data['incomereport'] = $this->admin->course_income_report_listing('C');
		$data['todayincome'] = $this->common_model->sumincomereport('C','today');
		$data['monthlyincome'] = $this->common_model->sumincomereport('C','monthly');
		$data['anualincome'] = $this->common_model->sumincomereport('C','anual');
		$data['lifetimeincome'] = $this->common_model->sumincomereport('C','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/course_incomereport',$data);
		$this->load->view('admin/common/footer');
	}
	public function graduate_incomereport(){	
		$this->data = array(
				'title' => 'graduate income report',
				'page_title' => 'graduate income report',
				'table_name' => 'graduate income report'
			);
		$data['incomereport'] = $this->admin->graduate_income_report_listing('G');
		$data['todayincome'] = $this->common_model->sumincomereport('G','today');
		$data['monthlyincome'] = $this->common_model->sumincomereport('G','monthly');
		$data['anualincome'] = $this->common_model->sumincomereport('G','anual');
		$data['lifetimeincome'] = $this->common_model->sumincomereport('G','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/graduate_incomereport',$data);
		$this->load->view('admin/common/footer');
	}
	public function training_incomereport(){	
		$this->data = array(
				'title' => 'training income report',
				'page_title' => 'training income report',
				'table_name' => 'training income report'
			);
		$data['incomereport'] = $this->admin->training_income_report_listing('T');
		$data['todayincome'] = $this->common_model->sumincomereport('T','today');
		$data['monthlyincome'] = $this->common_model->sumincomereport('T','monthly');
		$data['anualincome'] = $this->common_model->sumincomereport('T','anual');
		$data['lifetimeincome'] = $this->common_model->sumincomereport('T','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/training_incomereport',$data);
		$this->load->view('admin/common/footer');
	}

	public function cep_details($id=null)
	{
		if($this->session->userdata('login')['user_ID'] < 1 && $this->session->userdata('login')['role'] != 'sub-admin'){
			redirect('login', true);
		}



		if($this->input->post('Submit')=='Submit'){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			
			if($this->form_validation->run() == TRUE){
				$univsitdata = array();
				$univsitdata['comments'] 		= $this->input->post('comment');
				$univsitdata['status'] 			= $this->input->post('status');
				$univsitdata['user_id'] 			= $id;
				$univsitdata['reviewed_by'] 	= $this->session->userdata('login')['user_ID'];
				$univsitdata['added_on'] 	= date('Y-m-d H:i:s');
				//echo '<pre>'; print_r($univsitdata); exit;
				$insrtcommert = $this->admin->save('tbl_cep_comments',$univsitdata);

				//echo $insrtcommert; exit;

				if($insrtcommert){
					$datastatus = array();
					
					///start mail function
					$cep_details = $this->admin->get_cep_details($id);
						if($this->input->post('status') == 1){
							$curstatus = 'Approved';
							$datastatus['status'] = $this->input->post('status');
					$datastatus['password'] = '123456';//$this->randomPassword();
					$this->admin->update('tbl_ce_provider',$datastatus,'provider_id',$id);
					
					$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$cep_details->email.'<br>Password: '.$cep_details->password.'</p>';

						}
						if($this->input->post('status') == 2){
							$curstatus = 'Rejected';

							$datastatus['status'] = $this->input->post('status');
					
					$this->admin->update('tbl_ce_provider',$datastatus,'provider_id',$id);
							$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"></p>';


						}
						
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your application has been reviewed .<br><strong>Status: </strong>'.$curstatus.'</p><br>'.$logindetails;
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
						$emailbody['name'] 			= '';//$unvdetls->name_of_representative;
						/*$emailbody['thanksname'] 	= $unvdetls->chairman;
						$emailbody['thanks2'] 		= $unvdetls->qualification;
						$emailbody['thanks3'] 		= $unvdetls->chairposition;*/
						$emailbody['thanksname'] 	= 'RBoard Reviewer';
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= '';
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);		
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();
						
					///end mail function 
					
					redirect('reviewer/reviewer/onlineApplication_listing', true);
				}
			}else{
				//$id = $this->input->post('uniid');
				validation_errors();
			}
		}

		$this->data = array(
			'title' => 'Online Applications',
			'page_title' => 'Online Applications',
			'table_name' => 'Online Applications'
		);

		/******************************** CEP PROVIDER DOCUMENT NEW **********************************/
		$cep_where = array(

			't1.provider_id' => $id,
			't3.document_for' => 'n' 
		);			

		$this->data['cep_details'] = $this->admin->get_cep_details($id,$cep_where);


		/******************************** CEP PROVIDER DOCUMENT RENEWAL **********************************/
		$cep_renewal_where = array(

			't1.provider_id' => $id,
			't3.document_for' => 'r' 
		);			

		$this->data['cep_renewal_details'] = $this->admin->get_cep_details($id,$cep_renewal_where);



		//echo "<pre>"; print_r($this->data['cep_details']); exit;

		//$this->data['ce_provider_all_row_count'] = $this->admin->get_ce_provider_payment_detail_row_count($ce_where);

		//echo "<pre>"; print_r($this->data); exit;

		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/online_applications/cep_details',$this->data);
		$this->load->view('admin/common/footer');
	}

	public function professional_candidates(){
		$this->data = array(
				'title' => 'Candidates for Professional Registration',
				'page_title' => 'Candidates for Professional Registration',
				'table_name' => 'Candidates for Professional Registration'
			);
		$this->data['candidates_for_pr_added_by_admin'] = $this->admin->candidates_for_professional_registration_by_admin();
		$this->data['candidates_for_pr_by_itself'] 		= $this->admin->candidates_for_professional_registration_by_itself();
		$this->data['candidates_for_pr_from_gradutes']  = $this->admin->candidates_for_professional_registration_from_gradutes();

		// echo '<pre>'; print_r($this->data);die;
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/professional_candidates',$this->data);
		$this->load->view('admin/common/footer');
	}

	public function registered_professional(){

		$count = $this->admin->get_registered_professional(1);
		// $count = 0;
		$this->data = array(
				'title' => 'Registered Professional',
				'page_title' => 'Registered Professional ('.$count.')',
				'table_name' => 'Registered Professional'
			);
		$this->data['listing'] = $this->admin->get_registered_professional();
		$this->data['profession'] = $this->admin->get_profession();
		// $this->data['listing'] = array();
		// print_r($this->data);die;
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/registered_professional',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function profession_profile_details($id){
		//echo $id; exit;
		$this->db->where('user_id',$id);
		$info = $this->db->get('tbl_professional_license')->row();
		$profdata = array(
					'id' 			=> $info->pl_id,   
					'user_ID' 		=> $id,   
					'email' 		=> $info->username,
					'name' 			=> $info->name,
					'registration_no'=> $info->registration_no,
					'candidate_type' => $info->candidate_type,
					'admin_login' 	=> TRUE
			);
			//print_r($_SESSION); exit;
			//echo $loginuser->username;
			$this->session->set_userdata($profdata);
			//redirect('professional/applicant/dashboard');
			redirect('professional/applicant/certificate_listing');
		
	}


	//Add Examination Schedule, Edit Examination Schedule, List Examination Schedule, Delete Examination Schedule  

	public function examination_schedule_listing($id=false){
		$count = $this->admin->count_rows('tbl_examination_schedule','','');
		$this->data = array(
				'title' => 'Examination Schedule Listing',
				'page_title' => 'Examination Schedule Listing ('.$count.')',
				'table_name' => 'Examination Schedule Listing'
			);
		$data['listing'] = $this->admin->get_result_object('tbl_examination_schedule','','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examination_schedule/listing',$data);
		$this->load->view('admin/common/footer');	
	}

	public function add_examination_schedule($id=false){
		$this->data = array(
				'title' => 'Add Examination Schedule',
				'page_title' => 'Add Examination Schedule',
				'table_name' => 'Add Examination Schedule'
			);

		if($this->input->post()){
			
		if($this->input->post('es_id')){
			$insert['updated_at'] 		= date('Y-m-d');
		}else{
			$insert['added_on'] 		= date('Y-m-d');
		}


			$insert['name_of_exam']  	= $this->input->post('exam_name');
			$insert['reg_start_date']  	= $this->input->post('reg_start_date');
			$insert['reg_end_date']  	= $this->input->post('reg_end_date');
			$insert['exam_for']  		= $this->input->post('exam_for');
			$insert['date']  			= $this->input->post('exam_date');
			$insert['exam_mode']  		= $this->input->post('exam_mode');
			$insert['start_time']  		= $this->input->post('exam_start_time');
			$insert['end_time']  		= $this->input->post('exam_end_time');
			$insert['maximum_applicant']= $this->input->post('maximum_applicant');
			$insert['venue']			= $this->input->post('venue');
			$insert['status']  			= $this->input->post('status');
			
			if($this->input->post('es_id')){
				$inserted = $this->admin->update('tbl_examination_schedule',$insert,'es_id',$this->input->post('es_id'));
			}else{
				$insert['remaining_slot']= $this->input->post('maximum_applicant');
				$inserted =	$this->admin->save('tbl_examination_schedule',$insert);
			}

			if($inserted){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Examination schedule added successfully.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('admin/examination_schedule_listing', 'refresh');
		}
		if($id){
			$data['schedule'] = $this->admin->get_row_object('tbl_examination_schedule','es_id',$id); 
			// echo $this->db->last_query();die;
		}else{
			$data = array();
		}

		$data['uniqueset'] = $this->admin->get_uniqueset();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examination_schedule/add',$data);
		$this->load->view('admin/common/footer');
	}


	public function examination_schedule_delete($id=false){
		$result = $this->admin->delete('tbl_examination_schedule','es_id',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/examination_schedule_listing');
	}

	//Add Publish Examination Question Set, Edit Examination Question , List Examination Question, Delete Examination Question   

	public function publish_exam_question_listing($id=false){
		$count = $this->admin->get_publish_examination_question(1);
		$this->data = array(
				'title' => 'Licensure Exam Set Questions (Paper Based Examination)',
				'page_title' => 'Licensure Exam Set Questions (Paper Based Examination) ('.$count.')',
				'table_name' => 'Licensure Exam Set Questions (Paper Based Examination)'
			);
		
		$data['listing'] = $this->admin->get_publish_examination_question();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam/publish_question_list',$data);
		$this->load->view('admin/common/footer');	
	}

	public function question_paper_preview($id){
		$data['settingarr'] 	 = $this->common_model->get_setting('1');
		$data['schedule'] = $this->admin->get_row_object('tbl_examination_schedule','es_id',$id); 
		$data['published_set'] = $this->admin->get_row_object('tbl_publish_question_set','es_id',$id); 
		$data['all_questions'] = $this->admin->get_all_published_questions($id);
		$data['instruction'] = $this->admin->get_instruction();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/exam/question_paper_preview',$data);
	}
	public function answer_key($id){
		$data['settingarr'] 	 = $this->common_model->get_setting('1');
		$data['schedule'] = $this->admin->get_row_object('tbl_examination_schedule','es_id',$id); 
		$data['published_set'] = $this->admin->get_row_object('tbl_publish_question_set','es_id',$id); 
		$data['all_questions'] = $this->admin->get_all_published_questions($id); 
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/exam/answer_key',$data);
	}

	public function unpublish_exam_question($id=false){
		$data['status'] = '0';
		$updated = $this->admin->update('tbl_publish_question_set',$data,'pqs_id',$id);
		if($updated){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Question Unpublished Successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('admin/publish_exam_question_listing', 'refresh');
	}

	public function publish_exam_question($id=false){
		$this->data = array(
				'title' => 'Licensure Exam Set Questions (Based on Exam Dates)',
				'page_title' => 'Licensure Exam Set Questions (Based on Exam Dates)',
				'table_name' => 'Licensure Exam Set Questions (Based on Exam Dates)'
			);
		
		if($this->input->post()){
			// echo'<pre>';print_r($this->input->post());die();
		if($this->input->post('pqs_id')){
			$insert['updated_at'] 		= date('Y-m-d');
		}else{
			$insert['added_on'] 		= date('Y-m-d');
		}
			$insert['set_no']  			= $this->input->post('es_id');
			$insert['es_id']  			= $this->input->post('es_id');
			$insert['total_question']  	= $this->input->post('total_question');
			$insert['question_numbers'] = $this->input->post('question_numbers');
			$insert['status']  			= '1';
			
			if($this->input->post('pqs_id')){
				$inserted = $this->admin->update('tbl_publish_question_set',$insert,'pqs_id',$this->input->post('pqs_id'));
			}else{
				$inserted =	$this->admin->save('tbl_publish_question_set',$insert);
			}
			if($inserted){
				$mailContent = '<p>Please check you RBoard account new exam has been scheduled.</p><p>Here is the exam link for students:'.base_url('examination/examination').'</p>';
				$this->admin_mail('proctorfp@yopmail.com','proctorfp','Exam Scheduled!',$mailContent);

				$updatenotification 				= array();
				$updatenotification['proctor_id'] 	= 46;
				$updatenotification['subject'] 		= 'Exam Scheduled!';
				$updatenotification['message'] 		= $mailContent;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->admin->insertproctornotifications($updatenotification);
				$this->session->set_flashdata('item', '<div class="alert alert-success">Question Published Successfully and an email sent to proctorfp@yopmail.com.</div>');
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
			}
			redirect('admin/publish_exam_question_listing', 'refresh');
		}
		if($id){
			$data['schedule'] = $this->admin->get_row_object('tbl_examination_schedule','es_id',$id); 
			$data['published_set'] = $this->admin->get_row_object('tbl_publish_question_set','es_id',$id); 
			$data['all_questions'] = $this->admin->get_all_published_questions($id); 
		
		}else{
			$data = array();
		}
		// print_r($data['exam']);die;
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/exam/publish_exam_question',$data);
		$this->load->view('admin/common/footer');
	}

	function get_question_details($set_no){
		$this->db->where('status','2');
		$question = $this->admin->get_result_object('tbl_exam_question','set_no',$set_no);
		echo json_encode($question);
	}


	function course_document_listing()
	{		
		$count = $this->admin->get_course_document(1,'1');
		$this->data = array(
				'title' => 'CEP Course Acc. Listing',
				'page_title' => 'Accredited Online Courses ('.$count.')',
				'table_name' => 'CEP Course Acc.  Listing'
			);

		$data['listing'] = $this->admin->get_course_document(0,'1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/course_document_listing',$data);
		$this->load->view('admin/common/footer');
	}

	function training_document_listing(){			
		$count = $this->admin->get_training_document(1,'1');
		$this->data = array(
			'title' 	 => 'CEP Training Acc. Listing',
			'page_title' => 'Accredited Training Courses ('.$count.')',
			'table_name' => 'CEP Training Acc.  Listing'
		);
		$data['listing'] = $this->admin->get_training_document(0,'1');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/training_document_listing',$data);
		$this->load->view('admin/common/footer');
	}


	function course_document_details($id)
	{		
		$this->data = array(
				'title' => 'CEP Course Document Details',
				'page_title' => 'CEP Course Document Details',
				'table_name' => 'CEP Course Document  Details'
			);

		$this->data['coursereviewdatails'] = $this->reviewer_modal->coursereviewdatails($id);
		$this->data['course_details'] = $this->reviewer_modal->get_online_course_applcaition(array('c.cor_doc_id'=>$id));
		$this->load->view('admin/common/header',$this->data); 
		$this->load->view('admin/common/sidebar');
		// $this->load->view('admin/cep/course_details',$this->data);
		$this->load->view('reviewer/online_applications/review_course',$this->data);
		$this->load->view('admin/common/footer');
	}

	function training_document_details($id)
	{		
		$this->data = array(
				'title' => 'CEP Training Document Details',
				'page_title' => 'CEP Training Document Details',
				'table_name' => 'CEP Training Document  Details'
			);

		$this->data['trainingreviewdatails'] = $this->reviewer_modal->trainingreviewdatails($id);
		$this->data['training_details'] = $this->reviewer_modal->get_trainingdetails(array('t.train_doc_id'=>$id));
		$this->load->view('admin/common/header',$this->data); 
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/cep/training_details',$this->data);
		$this->load->view('admin/common/footer');
	}


	//Add local Professional, Edit local Professional, List local Professional, Delete local Professional  

	public function local_professional_listing($id=false){
		$count = $this->admin->count_rows('tbl_users','role','L');
		$this->data = array(
				'title' => 'Presently Registered Professional (Local and Foreign)',
				'page_title' => 'Presently Registered Professional (Local and Foreign) ('.$count.')',
				'table_name' => 'Presently Registered Professional (Local and Foreign)'
			);
		$this->db->order_by('user_ID','DESC');
		$data['listing'] = $this->admin->get_presently_added_professionals();
		$data['totalpro'] = $this->admin->get_number_of_professionals();
		$data['totallocalpro'] = $this->admin->get_number_of_professionals('l');
		$data['totalprowithexam'] = $this->admin->get_number_of_professionals('p');
		$data['totalprowithoutexam'] = $this->admin->get_number_of_professionals('f');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/local_professional/listing',$data);
		$this->load->view('admin/common/footer');	
	}

	public function add_local_professional($id=false){
	
		if($id){
			$this->data = array(
				'title' => 'Edit Professional',
				'page_title' => 'Edit Professional',
				'table_name' => 'Edit Professional'
			);
			$data['listing'] = $this->admin->get_row_object('tbl_users','user_ID',$id); 
			// echo $this->db->last_query();die;
		}else{
			$this->data = array(
				'title' => 'Add Professional',
				'page_title' => 'Add Professional',
				'table_name' => 'Add Professional'
			);
			$data = array();
			// $this->form_validation->set_rules('license_no', 'License Number', 'required|is_unique[tbl_users.license_no]', array( 'required' => 'You have not provided %s.', 'is_unique' => 'This %s already exists.' ));
		}
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('license_issued_date', 'License Issued Date', 'required');
		$this->form_validation->set_rules('license_validity_date', 'License Validity Date', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			// echo 'if'; die;
			$data['country_list'] = $this->applicant->get_countries();
			$data['profession_list'] = $this->applicant->get_profession();
			$data['university'] = $this->applicant->get_university();
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/local_professional/add',$data);
			$this->load->view('admin/common/footer');
		}
		else
		{
		
			if($this->input->post('listing_id')){
				$insert['updated_at'] 		= date('Y-m-d');
			}else{
				$insert['added_on'] 		= date('Y-m-d');
			}
			
			$this->load->library('upload');
			if(isset($_FILES["image"]) && !empty($_FILES["image"]['name'])){
				$config['upload_path'] = './assets/uploads/profile/';	
				$config['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["image"]["name"]);        
				$imageName = 'dp_'.time().'.'.end($ext);
				$config['file_name'] = $imageName;
				$this->upload->initialize($config);
	
				if ( ! $this->upload->do_upload('image')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
					$insert['image'] = $imageName; 
			}

			$insert['fname']  		= $this->input->post('fname');
			$insert['lname']  		= $this->input->post('lname');
			$insert['name']  		= $this->input->post('name');
			$insert['role']  		= 'L'; // admin adding professional so it will count as L to so in listing sepratly. 
			if($this->input->post('role') == 'L')
			{
				$addedbyaadmin = 'l';
			}elseif($this->input->post('role') == 'P'){
				$addedbyaadmin = 'p';
			}else{
				$addedbyaadmin = 'f';
			}

			$insert['added_by_admin']  = $addedbyaadmin;
			$insert['country']  	= $this->input->post('country');
			$insert['address']		= $this->input->post('address');
			$insert['dob']  		= $this->input->post('dob');
			$insert['gender']  		= $this->input->post('gender');
			$insert['profession']  	= $this->input->post('profession');
			$insert['university']  	= $this->input->post('university');
			$insert['other_university']  = $this->input->post('other_university');
			$insert['college']  	= $this->input->post('college_of');
			$insert['other_college']  	= $this->input->post('other_college');
			$insert['date_of_grauate']  	= $this->input->post('date_of_grauate');
			$insert['email']  		= $this->input->post('email');
			$insert['license_no']	= $this->input->post('license_no');
			$insert['license_issued_date']	= $this->input->post('license_issued_date');
			$insert['license_validity_date']= $this->input->post('license_validity_date');
			$insert['reg_board']	= $this->input->post('reg_board');
			$insert['status']  		= $this->input->post('status');
			
			if($this->input->post('listing_id')){
				$inserted = $this->admin->update('tbl_users',$insert,'user_ID',$this->input->post('listing_id'));
			}else{
				$inserted =	$this->admin->save('tbl_users',$insert);

				$bytes 		= random_bytes(3); 
				$regcode 	= bin2hex($bytes);
				$registration_no = 'REG-'.$inserted.$regcode.'-'.date('Y');
				//generate qrcode
				$qr_image = 'qrcode_'.$registration_no.'.png';
				$qr_url = base_url('assets/uploads/pdf/'.$registration_no.'.pdf');
				$params['data'] = $qr_url;
				$params['level'] = 'H';
				$params['size'] = 5;
				$params['savename'] = './assets/qrcode/'.$qr_image;
				$this->ciqrcode->generate($params);
				
				$update['qrcode'] = $qr_image;
				$update['registration_no'] = $registration_no;
				$update['account_type']			= 'P';
				$update['reviewer_id']			= $this->session->userdata('login')['user_ID'];
				$update['review_accept_date']	= date('Y-m-d H:i:s');
				$update['reviewer_status']		= '1';
				$res = $this->admin->update('tbl_users',$update,'user_ID',$inserted);
			}
			if(isset($res) && $res !=''){ 
				$details = $this->admin->get_row_object('tbl_users','user_ID',$inserted);
				if($details->status == '1'){
					
					// Genrate PDF start
					$html = ob_get_clean();
					$this->getProfessionalEligibilityPdf($inserted);
					// Get output html
					$html = $this->output->get_output();
					// print_r($html);die;
					$this->load->library('Pdf');
					$this->dompdf->load_html($html);
					$this->dompdf->set_paper('letter','portrait');
					$this->dompdf->render();
					
					file_put_contents('assets/uploads/pdf/'.$registration_no.'.pdf', $this->dompdf->output($html));
					// Genrate PDF End
					$mailContent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">You are now eligible to apply for Professional Registration.</p>
					<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please use this Registration Code '.$details->registration_no.'.<br>
					Please click the link below to apply for professional registration: <br>
					<a href="'.base_url('professional/applicant/registration_form').'">'.base_url("professional/applicant/registration_form").'</a>.</p>';
					$res_name = $details->fname.' '.$details->lname.' '.$details->name;
					$this->admin_mail($details->email,$res_name,'Eligibility Confirmation',$mailContent,$registration_no);
				}
			}

			if($inserted){
				$this->session->set_flashdata('item', '<div class="alert alert-success">Local Professional added/ updated successfully.</div>');
				redirect(base_url('admin/local_professional_listing'));
			}else{
				$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
				redirect(base_url('admin/local_professional_listing'));
			}
		}
	}

	public function getProfessionalEligibilityPdf($user_id)
	{
		$data['result'] = $this->reviewer_modal->getprofessionaldetails($user_id);
		$this->load->view('reviewer/common/professional_eligibility_pdf',$data);
	}

	public function local_professional_delete($id=false){
		$this->db->where('role','L');
		$result = $this->admin->delete('tbl_users','user_ID',$id);
		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		// echo 'nutan'; die;
		
		redirect('admin/local_professional_listing');
		// redirect('admin/index');
	}

	public function index(){
		echo 'nutan kumary';
	}

	public function view_prof_profile()
	{
		$uid = $this->input->post('uid');
		// $data['details'] = $this->applicant->fetch_user_details($uid);
		$data['details'] = $this->admin->get_professioanl_details($uid);
		// echo json_encode($data);
		$this->load->view('admin/common/view_prof_profile',$data);
	}

	public function get_receipt(){
		$id = $this->input->post('id');
		$data['details'] = $this->admin->get_one_receipt_details($id);
		$this->load->view('admin/receipt_view',$data);
	}
	
	public function send_receipt_mail(){
		$email 		= $this->input->post('to');
		$name 		= $this->input->post('name');
		$subject 	= $this->input->post('subject');
		$content 	= $this->input->post('content');
		
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Certificate for Professional accreditation is here.<br><br>
			'.$content.'
			<br><br>Should you have questions just message us and we would Be happy to assist you.<br></p>';
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
		if($email != ''){
			//send certificate 
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
			$this->email->to($email);
			$this->email->subject($subject);
			$emailbody = array();
			$emailbody['name'] 			= $name;
			$emailbody['thanksname'] 	= 'RBoard Team';
			$emailbody['thanks2'] 		= '';
			$emailbody['thanks3'] 		= '';
			$emailbody['body_msg'] 	= $bodycontentforCode;
			$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
			$this->email->message($emailmessage);
			$this->email->send();
			//end send certificate 
			echo 'Mail sent successfully';
		}else{
			echo 'Please enter a valid email.';
		}
	}


	//Add terms, Edit terms, List terms, Delete terms 
 	function terms()
	{
		$this->data = array('page_title'=>'Terms & Conditions','title'=>'Terms & Conditions');
		$data['school'] 		= $this->admin->get_terms('school');
		$data['professionals'] 		= $this->admin->get_terms('professional');
		$data['authorCeonpoint'] 	= $this->admin->get_terms('authorCeonpoint');
		$data['authorBusiness'] 	= $this->admin->get_terms('authorBusiness');
		$data['authorInstitution'] 	= $this->admin->get_terms('authorInstitution');
		$data['cepBusiness'] 		= $this->admin->get_terms('cepBusiness');
		$data['cepInstitutions']	= $this->admin->get_terms('cepInstitution');
		$data['institutions'] 		= $this->admin->get_terms('institution');
		$data['advertiser'] 		= $this->admin->get_terms('advertiser');
		$data['cep'] 				= $this->admin->get_terms('cep');
		$data['tutorials'] 			= $this->admin->get_terms();
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/terms/listing',$data);
		$this->load->view('admin/common/footer');	
	}

	public function editTerms()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('discription', 'Description', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE){
			$data['school'] 		= $this->admin->get_terms('school');
			$data['professionals'] 		= $this->admin->get_terms('professional');
			$data['authorCeonpoint'] 	= $this->admin->get_terms('authorCeonpoint');
			$data['authorBusiness'] 	= $this->admin->get_terms('authorBusiness');
			$data['authorInstitution'] 	= $this->admin->get_terms('authorInstitution');
			$data['cepBusiness'] 		= $this->admin->get_terms('cepBusiness');
			$data['cepInstitutions']	= $this->admin->get_terms('cepInstitution');
			$data['institutions'] 		= $this->admin->get_terms('institution');
			$data['advertiser'] 		= $this->admin->get_terms('advertiser');
			$data['tutorials'] 			= $this->admin->get_terms();
			
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/terms/listing',$data);
			$this->load->view('admin/common/footer');
		}else{
			// print_r($this->input->post());die;
			$id = $this->input->post('id');
			$termdes = $this->input->post('discription');
			$termdes = str_replace("<p>",'',$termdes);
			$termdes = str_replace("</p>",'',$termdes);
			$termarr = explode("\n", $termdes);
			$termdes = '';
			foreach($termarr as $arr){
				$termdes.= '<p>'.$arr.'</p>';
			}
			$update = array(
				'title'			=>  $this->input->post('title'),
				'discription'	=>  $termdes,
				'type'			=>  $this->input->post('type'),
				'status'		=>  $this->input->post('status'),
				'updated_at'	=>  date('Y-m-d')
			);
			if($id){
				$this->admin->update('tbl_terms_conditions',$update,'id',$id);
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Terms Updated successfully.</div>');
				redirect('admin/terms');
			}else{
				$this->admin->savetermscondition($update);
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">Terms added successfully.</div>');
				redirect('admin/terms');
			}
		}
		
	}
	
	public function tutorials()
	{
		$this->data = array('page_title'=>'Tutorials','title'=>'Tutorials');
		$data['schools'] 			= $this->admin->get_tutorial('school');
		$data['professionals'] 		= $this->admin->get_tutorial('professional');
		$data['ceproviders'] 		= $this->admin->get_tutorial('ceproviders');
		$data['authorCeonpoints'] 	= $this->admin->get_tutorial('authorCeonpoint');
		$data['authorBussinesss'] 	= $this->admin->get_tutorial('authorBussiness');
		$data['authorInstitutions'] = $this->admin->get_tutorial('authorInstitution');
		$data['cepinstitutions']	= $this->admin->get_tutorial('cepInstitution');
		$data['institutions'] 		= $this->admin->get_tutorial('institution');
		$data['advertiser'] 		= $this->admin->get_tutorial('advertiser');
		$data['tutorials'] 			= $this->admin->get_tutorial();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/tutorials/listing',$data);
		$this->load->view('admin/common/footer');	
	}

	public function getTutorialVideo()
	{
		$id = $_POST['id'];
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_tutorial')->row_array();
		echo (json_encode($result));
	}
	public function addTutorialVideo()
	{
		$uid = $this->session->userdata('login')['user_ID'];
		// $urole = $this->session->userdata('logged_in')['role'];
		$this->load->library('upload');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('discription', 'Description', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE){
			$data['schools'] 			= $this->admin->get_tutorial('school');
			$data['professionals'] 		= $this->admin->get_tutorial('professional');
			$data['ceproviders'] 		= $this->admin->get_tutorial('ceproviders');
			$data['authorCeonpoints'] 	= $this->admin->get_tutorial('authorCeonpoint');
			$data['authorBusinesss'] 	= $this->admin->get_tutorial('authorBusiness');
			$data['authorInstitutions'] = $this->admin->get_tutorial('authorInstitution');
			$data['cepbussinesss'] 		= $this->admin->get_tutorial('cepBusiness');
			$data['cepinstitutions']	= $this->admin->get_tutorial('cepInstitution');
			$data['institutions'] 		= $this->admin->get_tutorial('institution');
			$data['advertiser'] 		= $this->admin->get_tutorial('advertiser');
			$data['tutorials'] 			= $this->admin->get_tutorial();
			$this->data = array('page_title'=>'Tutorials','title'=>'Tutorials');
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/tutorials/listing',$data);
			$this->load->view('admin/common/footer');	
		}else{
			$add = array(
				'subject'		=>  ucwords($this->input->post('subject')),
				'title'			=>  ucwords($this->input->post('title')),
				'discription'	=>  $this->input->post('discription'),
				'type'			=>  $this->input->post('type'),
				'url'			=>  $this->input->post('url'),
				'added_by'		=>  $uid,
				// 'added_by_role'	=>  $urole,
				'status'		=>  '1',
				'show_on_faq'	=>  '1',
				'added_on'		=>  date('Y-m-d')
			);

			if(isset($_FILES["uploadvideo"]) && !empty($_FILES["uploadvideo"]['name']))
			{
	            $config2['upload_path'] = './assets/upload/tutorial/';
	            $config2['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
	            $config2['max_size'] = '200000000';
	            $config2['max_width']  = '15000';
	            $config2['max_height']  = '8000';        
	            $ext = explode('.',$_FILES["uploadvideo"]["name"]);        
	            $imageName = 'Tut_'.time().'.'.end($ext);
	            $config2['file_name'] = $imageName;
		        $this->upload->initialize($config2);
		        if ( ! $this->upload->do_upload('uploadvideo'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$add['uploadvideo'] = $imageName;
	        }

			$result = $this->admin->save('tbl_tutorial',$add);
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Video Added successfully.</div>');
				redirect('admin/addTutorialVideo');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/addTutorialVideo');
			}
		}
		
	}
	public function editTutorialVideo()
	{
		$uid = $this->session->userdata('login')['user_ID'];
		// $urole = $this->session->userdata('logged_in')['role'];
		$this->load->library('upload');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		$this->form_validation->set_rules('discription', 'Description', 'trim|required');  
			 
		if($this->form_validation->run() == FALSE){
			$data['schools'] 		= $this->admin->get_tutorial('school');
			$data['professionals'] 		= $this->admin->get_tutorial('professional');
			$data['authorCeonpoints'] 	= $this->admin->get_tutorial('authorCeonpoint');
			$data['authorBusinesss'] 	= $this->admin->get_tutorial('authorBusiness');
			$data['authorInstitutions'] = $this->admin->get_tutorial('authorInstitution');
			$data['cepbussinesss'] 		= $this->admin->get_tutorial('cepBusiness');
			$data['cepinstitutions']	= $this->admin->get_tutorial('cepInstitution');
			$data['institutions'] 		= $this->admin->get_tutorial('institution');
			$data['advertiser'] 		= $this->admin->get_tutorial('advertiser');
			$data['tutorials'] 			= $this->admin->get_tutorial();;
			$this->data = array('page_title'=>'Tutorials','title'=>'Tutorials');
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/common/sidebar');
			$this->load->view('admin/tutorials/listing',$data);
			$this->load->view('admin/common/footer');	
		}else{
			$id = $this->input->post('id');
			$update = array(
				'subject'		=>  ucwords($this->input->post('subject')),
				'title'			=>  ucwords($this->input->post('title')),
				'discription'	=>  $this->input->post('discription'),
				'type'			=>  $this->input->post('type'),
				'url'			=>  $this->input->post('url'),
				'status'		=>  $this->input->post('status'),
				// 'show_on_faq'	=>  $this->input->post('show_on_faq')
			);

			if(isset($_FILES["uploadvideo"]) && !empty($_FILES["uploadvideo"]['name']))
			{
	            $config2['upload_path'] = './assets/upload/tutorial/';
	            $config2['allowed_types'] = 'avi|mp4|3gp|mpeg|mpg|mov|mp3|flv|wmv';
	            $config2['max_size'] = '200000000';
	            $config2['max_width']  = '15000';
	            $config2['max_height']  = '8000';        
	            $ext = explode('.',$_FILES["uploadvideo"]["name"]);        
	            $imageName = 'Tut_'.time().'.'.end($ext);
	            $config2['file_name'] = $imageName;
		        $this->upload->initialize($config2);
		        if ( ! $this->upload->do_upload('uploadvideo'))
		        {
		        	$error = array('error' => $this->upload->display_errors());                       
		        }  
	            	$update['uploadvideo'] = $imageName;
	        }

			$result = $this->admin->update('tbl_tutorial',$update,'id',$id);
			// echo $this->db->last_query();die;
			if($result){
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Video Updated successfully.</div>');
				redirect('admin/tutorials');
			}else{
				$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
				redirect('admin/tutorials');
			}
		}
		
	}

	public function tutorialdelete($id){
		$result = $this->admin->delete('tbl_tutorial','id',$id);
		if($result){
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-success alert-dismissable">Tutorial Deleted successfully.</div>');
			redirect('admin/tutorials');
		}else{
			$this->session->set_flashdata('response','<div style="margin-left:-1px;" class="alert alert-danger alert-dismissable">There is some error please try again.</div>');
			redirect('admin/tutorials');
		}
	}
	public function graduatedetails($id=null){
		
		$this->data = array(
			'title' => 'Graduate Details',
			'page_title' => 'Graduate Details',
			'table_name' => 'Graduate Details'
		);
		$this->data['graduatedetails'] = $this->reviewer_modal->graduates_details($id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('reviewer/online_applications/graduatedetails',$this->data);
		$this->load->view('admin/common/footer');
	}
	
	public function profexamdetails($appid=null,$doc_id=null){
		$this->data = array(
			'title' => 'Professional Details',
			'page_title' => 'Professional Details',
			'table_name' => 'Professional Details'
		);
		$this->data['professreviewdatails'] = $this->reviewer_modal->professionlareviewdatails($appid,$doc_id);
		$this->data['application'] = $this->reviewer_modal->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_modal->get_row_object('tbl_professional_documents','pd_id',$doc_id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('reviewer/online_applications/profexam_verify',$this->data);
		$this->load->view('admin/common/footer');
	}

	public function professionaldetails($appid=null,$doc_id=null){
		$this->data = array(
			'title' => 'Professional Details',
			'page_title' => 'Professional Details',
			'table_name' => 'Professional Details'
		);
		$this->data['professreviewdatails'] = $this->reviewer_modal->professionlareviewdatails($appid,$doc_id);
		$this->data['application'] = $this->reviewer_modal->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_modal->get_row_object('tbl_professional_documents','pd_id',$doc_id);
		$this->data['profession'] = $this->applicant->get_profession();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('reviewer/online_applications/verify',$this->data);
		$this->load->view('admin/common/footer');
	}

	public function acc_details($id){
		$this->data = array(
			'title' => 'CEP Accreditation Details',
			'page_title' => 'CEP Accreditation Details',
			'table_name' => 'CEP Accreditation Details'
		); 
		
		$this->data['cep_details'] = $this->reviewer_modal->get_cep_details($id);
		$this->data['cepreviewdatails'] = $this->reviewer_modal->cepreviewdatails($this->session->userdata('login')['user_ID'],$id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('reviewer/online_applications/cep_details',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function profexam_verify_document($appid=null,$doc_id=null)
	{
		$this->data = array(
			'title' => 'Foreign Professional Review For Professional Registration'
		);
		
		
		$this->data['professreviewdatails'] = $this->reviewer_modal->professionlareviewdatails($appid);
		$this->data['application'] = $this->reviewer_modal->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_modal->get_row_object('tbl_professional_documents','pd_id',$doc_id);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('reviewer/online_applications/profexam_verify',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function verify_document($appid=null)
	{
		$this->data = array(
			'title' => 'Foreign Professional Review For Licensure Examination'
		);
		
		
		$this->data['professreviewdatails'] = $this->reviewer_modal->professionlareviewdatails($appid);
		$this->data['application'] = $this->reviewer_modal->get_foreign_applcaition(array('u.user_ID'=>$appid));
		$this->data['documents'] = $this->reviewer_modal->get_row_object('tbl_professional_documents','user_id',$appid);
		$this->data['profession'] = $this->applicant->get_profession();
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('reviewer/online_applications/verify',$this->data);
		$this->load->view('admin/common/footer');
	}

	// public function verify_certificate($appid=null,$doc_id)
	// {
	// 	$this->data = array(
	// 		'title' => 'Professional License Renewal'
	// 	);
		
	// 	$this->data['professreviewdatails'] = $this->reviewer_modal->professionlareviewdatails($this->session->userdata('login')['user_ID'],$doc_id);
	// 	$this->data['application'] 	= $this->reviewer_modal->get_foreign_applcaition(array('u.user_ID'=>$appid));
	// 	$this->data['documents'] 	= $this->reviewer_modal->get_row_object('tbl_professional_documents','pd_id',$doc_id);
	// 	$this->data['certificate'] 	= $this->reviewer_modal->get_submitted_certificate($appid);
	// 	$this->data['profession']   = $this->applicant->get_profession();
	// 	$this->load->view('admin/common/header',$this->data);
	// 	$this->load->view('admin/common/sidebar');
	// 	$this->load->view('reviewer/online_applications/verify_certificate',$this->data);
	// 	$this->load->view('admin/common/footer');
	// }
	public function resultdataonpopup()
	{

		$schid = $_POST['schid'];
		$schtype = $_POST['schtype'];
		if($schtype == 'pp'){
			$data = $this->admin->get_examresultdataforpopup($schid);
			$photo = ($data->photo != "" && file_exists('./assets/uploads/profile/'.$data->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$data->photo).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">';
		}else{
			$data = $this->admin->get_graexamresultdataforpopup($schid);
			$photo = ($data->photo != "" && file_exists('./assets/images/graduates/'.$data->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/'.$data->photo).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">';
		}
		//print_r($data);exit;
		$totalques = $data->total_marks/100;
		$c_ans = $data->obtained_marks/100;
		
		//$quesdetail = '<p># &nbsp;QUESTION &nbsp;SUBMITTED ANSWER &nbsp;REMARKS &nbsp;ANSWER &nbsp;RATIONALE</p>';
		$answer = json_decode($data->answers);
		$sn=1;
		foreach($answer as $ans){
			$e_ques = $this->db->where('id',$ans->qid)->get('tbl_exam_question')->row();
			//print_r($e_ques);
			if($e_ques->correct_answere == $ans->ans){
				$remarks='<span class="text-success">CORRECT</span>';
			}else{
				$remarks='<span class="text-danger">WRONG</span>';
			}
			if($sn==1){
				$quesdetail='<tr><td>'.$sn.'</td><td>'.$e_ques->question_title.'</td><td>'.$ans->ans.'</td><td>'.$remarks.'</td><td>'.$e_ques->correct_answere.'</td><td>'.$e_ques->rationale.'</td></tr>';
			}else{
				$quesdetail.='<tr><td>'.$sn.'</td><td>'.$e_ques->question_title.'</td><td>'.$ans->ans.'</td><td>'.$remarks.'</td><td>'.$e_ques->correct_answere.'</td><td>'.$e_ques->rationale.'</td></tr>';
			}
			$sn++;
		}
		//print_r($data);
		echo '<div class="text-center">
				<div class="result-heading">'.$data->exam_name.
					'<br> Date : '.date('M d,Y',strtotime($data->exam_date)).
					'<br>'.date('H:i A',strtotime($data->exam_start_time)).' To '.date('H:i A',strtotime($data->exam_end_time)).
					'<br>'.$data->exam_venue.
				'</div>
			 </div>
			<div class="p-3">
			<div class="row">
			<div class="col-md-8 view-result-dtl">
			   Examinees Name: '.$data->fullname.'
			   <br>Total Question: '.$totalques.'
			   <br>Correct Answers: '.$c_ans.'
			   <br>Percentage: '.$data->percentage.'
			   <br>Remarks: '.$data->status.'
		   </div>
		   <div class="col-md-4">'
			   .$photo.
		   '</div>
		</div>
			</div>
			<div class="view-result-table p-3">
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>QUESTION</th>
							<th>SUBMITTED ANSWER</th>
							<th>REMARKS</th>
							<th>ANSWER</th>
							<th>RATIONALE</th>
						</tr>
					</thead>
					<tbody>'
						.$quesdetail.
					'<tr>
						<td colspan="2"><strong>Total Score</strong></td>
						<td colspan="4"><strong>'.$data->obtained_marks.'</strong></td>
					</tr>
					</tbody>
				</table>
			</div>';
	}
	public function prof_detail_for_newstatus($appid=null){
		$this->data = array(
			'title' => 'Professional Details'
		);
		if($this->input->post('prof_id') > 0){
			$this->form_validation->set_rules('comment', 'comment', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			$this->form_validation->set_rules('prof_id', 'professional id missing', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$user_ID = $this->input->post('prof_id');
				$updatedata = array();
				$updatedata['status'] = $this->input->post('status');
				$updatedata['updated_at'] = date('Y-m-d');
				$update = $this->admin->update_status($user_ID, $updatedata);

				if($update){
					$insertcomment = array();
					$insertcomment['user_id'] = $user_ID;
					$insertcomment['pd_id'] = $this->input->post('doc_id');
					$insertcomment['added_by'] = 1;
					$insertcomment['comments'] = $this->input->post('comment');
					$insertcomment['prof_status'] = $this->input->post('status');
					$insertcomment['status'] = 'Active';
					$insert = $this->admin->insert_admin_comment($insertcomment);

					if($insert){
						$profes_details = $this->admin->prof_detail_for_newstatus($user_ID);
						$settingarr = $this->common_model->get_setting('1');
						$status = $profes_details[0]->status;
						if($status == 1){
							$textstatus = 'You are accept as valid';
						}if($status == 3){
							$textstatus = 'You are Suspended';
						}if($status == 4){
							$textstatus = 'You are Revoked';
						}
						$comment = $this->input->post('comment');
						$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$textstatus.'</p>
									<br>Comment: '.$comment;
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
						$this->email->to($profes_details[0]->email);
						$this->email->subject('Status');
						$emailbody 					= array();
						$emailbody['name'] 			= $profes_details[0]->fname.' '.$profes_details[0]->lname.' '.$profes_details[0]->name; 
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 		= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
						$this->email->message($emailmessage);
						$this->email->send();

						redirect(base_url('admin/registered_professional'));
					}
					
				}
			}else{
				$appid = $this->input->post('prof_id');
				validation_errors();
			}
		}
		
		$this->data['application'] 	= $this->admin->prof_detail_for_newstatus($appid);
		//print_r($this->data['application']);exit;
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/prof_detail_for_newstatus',$this->data);
		$this->load->view('admin/common/footer');
	}
	function licensure_examination(){
		$for = (isset($_GET['for']) != '')?$_GET['for']:'';
		$this->data = array(
			'title' => ($for=='fp')?'Foreign Professionals':'Local Graduates',
			'page_title' => ($for=='fp')?'Foreign Professionals':'Local Graduates',
			'table_name' => ($for=='fp')?'Foreign Professionals':'Local Graduates'
		); 
		 
		if($for == ''){
			//redirect(base_url('admin/dashboard'));
		}
		if($for == 'fp'){
			$exam_for = 'fp';
			$title = 'Foreign Professionals';
			$data['listing'] = $this->admin->get_forigen_examiness_list();
		}if($for == 'g'){
			$exam_for = 'g';
			$title = 'Local Graduates';
			$data['listing'] = $this->admin->get_graduate_examiness_list();
			//echo $this->db->last_query();exit;
		}
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/licensure_examination',$data);
		$this->load->view('admin/common/footer');
	}
	
	function rboard_tracker(){
		$this->data = array(
			'title' => 'RBoard Subscription Tracker',
			'page_title' => 'RBoard Subscription Tracker',
			'table_name' => 'RBoard Subscription Tracker'
		); 
		
		$data['subscrition_list'] = $this->admin->get_admin_all_subscription_details();
		// echo $this->db->last_query(); die;
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/rboard_tracker',$data);
		$this->load->view('admin/common/footer');
	}
	public function view_requestforverification($ri_id){
		$this->data = array(
			'title' => 'Request for Verification of Registration',
			'page_title' => 'Request for Verification of Registration',
			'table_name' => 'Request for Verification of Registration'
		);
		$this->data['requestverificationdocument'] = $this->reviewer_modal->requestverificationdocument($ri_id);
		$this->load->view('admin/common/header',$this->data); 
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/request_verification/request_verification_doc_view',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function requestverificationlisting(){
		$this->data = array(
			'title' => 'Request for Verification of Registration',
			'page_title' => 'Request for Verification of Registration',
			'table_name' => 'Request for Verification of Registration'
		);
		$this->data['receipient_information'] = $this->reviewer_modal->get_receipient_information('','1','','y');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/requestverificationlisting',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function view_requestforgoodstand($gs_id){
		$this->data = array(
			'title' => 'Request for Certificate of Good Standing',
			'page_title' => 'Request for Certificate of Good Standing',
			'table_name' => 'Request for Certificate of Good Standing'
		);
		$this->data['reqgoodstanddoc'] = $this->reviewer_modal->requestgoodstanddocument($gs_id);
		$this->load->view('admin/common/header',$this->data); 
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/good_stand/good_stand_doc_view',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function requestgoodstandinglisting(){
		$this->data = array(
			'title' => 'Request for Certificate of Good Standing',
			'page_title' => 'Request for Certificate of Good Standing',
			'table_name' => 'Request for Certificate of Good Standing'
		);
		$this->data['reqforgoodstand'] = $this->reviewer_modal->get_reqforgoodstand('','1','','y');
		//$this->data['receipient_information'] = $this->reviewer_modal->get_receipient_information('','1','','y');
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/goodstandinglisting',$this->data);
		$this->load->view('admin/common/footer');
	}
	public function examination_category_listing($id=false){
		$count = $this->admin->count_rows('tbl_examination_categories','','');
		$this->data = array(
				'title' => 'Examination Question Categories',
				'page_title' => 'Examination Question Categories ('.$count.')',
				'table_name' => 'Examination Question Categories'
			);
		$data['listing'] = $this->admin->get_result_object('tbl_examination_categories','','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examination_category/listing',$data);
		$this->load->view('admin/common/footer');	
	}
	public function add_edit_examination_category(){
		if($this->input->post()){
			$excat_id = $this->input->post('excat_id');
			$data = array();
			$data['category_name'] = $this->input->post('category_name');
			$data['passing_score'] = $this->input->post('passing_score');
			$data['status'] = $this->input->post('status');
			if(!$excat_id){
				$data['added_at'] = date('Y-m-d');
				$insert_id = $this->admin->save('tbl_examination_categories', $data);
				if($insert_id){
					$this->session->set_flashdata('msg','Question Category added successfully');
				}else{
					$this->session->set_flashdata('err','Something went wrong');
				}
			}else{
				$data['updated_at'] = date('Y-m-d');
				$updated = $this->admin->update('tbl_examination_categories', $data, 'excat_id', $excat_id);
				if($updated){
					$this->session->set_flashdata('msg','Question Category updated successfully');
				}else{
					$this->session->set_flashdata('err','Something went wrong');
				}
			}
		}else{
			$this->session->set_flashdata('err','Something went wrong');
		}
		return redirect(base_url('admin/examination_category_listing'));
	}
	public function get_one_examination_category(){
		$id = $this->input->post('id');
		$result['category'] = $this->admin->get_row_object('tbl_examination_categories', 'excat_id', $id);
		echo json_encode($result); exit;
	}
	public function examination_category_delete($id){
		$deleted = $this->admin->delete('tbl_examination_categories', 'excat_id', $id);
		if($deleted){
			$this->session->set_flashdata('msg','Record deleted successfully');
		}else{
			$this->session->set_flashdata('err','Something went wrong');
		}
		return redirect(base_url('admin/examination_category_listing'));
	}
	public function examination_instruction_listing($id=false){
		$count = $this->admin->count_rows('tbl_examination_instruction','','');
		$this->data = array(
				'title' => 'Examination Instruction',
				'page_title' => 'Examination Instruction ('.$count.')',
				'table_name' => 'Examination Instruction'
			);
		$data['listing'] = $this->admin->get_result_object('tbl_examination_instruction','','');
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/examination_instruction/listing',$data);
		$this->load->view('admin/common/footer');	
	}
	public function add_edit_examination_instruction(){
		if($this->input->post()){
			$ins_id = $this->input->post('ins_id');
			$data = array();
			$data['instruction'] = $this->input->post('instruction');
			$data['exam_format'] = $this->input->post('exam_format');
			$data['status'] = $this->input->post('status');
			if(!$ins_id){
				$data['added_at'] = date('Y-m-d');
				$insert_id = $this->admin->save('tbl_examination_instruction', $data);
				if($insert_id){
					$this->session->set_flashdata('msg','Examination Instruction added successfully');
				}else{
					$this->session->set_flashdata('err','Something went wrong');
				}
			}else{
				$data['updated_at'] = date('Y-m-d');
				$updated = $this->admin->update('tbl_examination_instruction', $data, 'ins_id', $ins_id);
				if($updated){
					$this->session->set_flashdata('msg','Examination Instruction updated successfully');
				}else{
					$this->session->set_flashdata('err','Something went wrong');
				}
			}
		}else{
			$this->session->set_flashdata('err','Something went wrong');
		}
		return redirect(base_url('admin/examination_instruction_listing'));
	}
	public function get_one_examination_instruction(){
		$id = $this->input->post('id');
		$result['instruction'] = $this->admin->get_row_object('tbl_examination_instruction', 'ins_id', $id);
		echo json_encode($result); exit;
	}
	public function examination_instruction_delete($id){
		$deleted = $this->admin->delete('tbl_examination_instruction', 'ins_id', $id);
		if($deleted){
			$this->session->set_flashdata('msg','Record deleted successfully');
		}else{
			$this->session->set_flashdata('err','Something went wrong');
		}
		return redirect(base_url('admin/examination_instruction_listing'));
	}
}

?>