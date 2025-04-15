<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** Finance Login controller **/

class Finance extends MX_Controller {

	var $data = array();

	public function __construct(){
		parent:: __construct();
		$this->load->model('admin/admin_model');
		// $this->check_session();
	}

	public function index(){
		if(!$this->session->userdata('login')['finance_logged_in']){
			redirect('login', 'refresh');
		}
		redirect('finance/incomereport', true);
	}

	public function dashboard(){
		if(!$this->session->userdata('login')['finance_logged_in']){
			redirect('login', 'refresh');
		}
		redirect('finance/incomereport', true);
	}

	public function incomereport(){
		if(!$this->session->userdata('login')['finance_logged_in']){
			redirect('login', 'refresh');
		}
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
			$countries = $this->admin_model->get_result_array('tbl_countries','countries_id',$_GET['country']);
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
		$data['income_subsetion_url']	 = 'finance/report/professional_registration/';
		
		$data['countries'] 	= $this->admin_model->get_result_array('tbl_countries','','');
		$this->load->view('finance/common/header',$this->data);
		$this->load->view('finance/common/sidebar',$this->data);
		$this->load->view('finance/allincomereport',$data);
		$this->load->view('admin/common/footer',$this->data);
	}
	public function report(){
		if(!$this->session->userdata('login')['finance_logged_in']){
			redirect('login', 'refresh');
		}
		$this->data = array(
			'title' => 'Govt : Income Report'
		);
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
		//echo $payment_for;
		$data['incomereport'] 		= $this->common_model->all_income_report_listing($income_sources);
		$data['todayincome'] 		= $this->common_model->sumincomereport($payment_for,'today');
		$data['monthlyincome'] 		= $this->common_model->sumincomereport($payment_for,'monthly',$payment_type);
		$data['anualincome'] 		= $this->common_model->sumincomereport($payment_for,'anual',$payment_type);
		$data['lifetimeincome'] 	= $this->common_model->sumincomereport($payment_for,'',$payment_type); 
		$this->load->view('finance/common/header',$this->data);
		$this->load->view('finance/common/sidebar',$this->data);
		$this->load->view('finance/report',$data);
		$this->load->view('admin/common/footer',$this->data);	
	}		
}

?>