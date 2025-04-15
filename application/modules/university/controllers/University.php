<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class University extends MX_Controller {
	
	var $data = array();
	var $subs_status;
	public function __construct(){
		parent::__construct();
		//$this->load->model('Landing_model','landing');
		$this->load->model('university_model');	
		$this->load->library('upload');
		$this->load->library('Variablebilling'); 
		/* rboard check */ 
		$subscription = $this->common_model->get_admin_subscription_details();
		if(isset($subscription->rb_sub_key) && $subscription->rb_sub_key == ""){
		/* go to contcat for admin with form details */
			$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
			redirect(base_url('contactus'), 'refresh');		
		}

		if(isset($subscription->no_of_application) && $subscription->no_of_application == 0 && $subscription->subscription_id == 6){
			$this->subs_status = 'y';
		}else{
			if($subscription->total_application <= $this->common_model->get_online_application_count()){	
				$this->subs_status = 'n';
			}else{
				$this->subs_status = 'y';
			}
		}
		//end rboard check 
	}
	public function index(){
		// echo $this->subs_status; exit;
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if($this->session->userdata('university_logged_in')){
			redirect(base_url('university/university/dashboard'), 'refresh');
		}
		$data['collegeofArr'] = $this->university_model->get_collegeof();
		$data['countrylistarr'] = $this->common_model->countrylistarr();
			//echo '<pre>'; print_r($_POST); exit;
		if($this->input->post('university_name') !='' && $this->input->post('college_of') !='' && $this->input->post('email') !='' && $this->input->post('contact_no') !='' && $this->input->post('business_license_number') !=''){
			
			// image upload				
			$college_logo = '';
			if(isset($_FILES["college_logo"]) && !empty($_FILES["college_logo"]['name'])){	  	  //$this->load->library('upload', $config);	
				$this->load->library('upload');			
				$config['upload_path'] 		= './assets/images/university/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["college_logo"]["name"]);        
				$college_logo 					= 'uni_'.time().'.'.end($ext);
				$config['file_name'] 		= $college_logo;
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('college_logo'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$college_logo = $college_logo;
			}else{
				//$photo = $this->input->post('old_photo');
			}
			
		// end image upload
			$insertunidetails = array();
			
			$insertunidetails['university_name']  	= $this->input->post('university_name');
			$insertunidetails['college_of']  		= $this->input->post('college_of');
			$insertunidetails['address']    		= $this->input->post('address');
			$insertunidetails['countries_id']    	= $this->input->post('countries_id');
			$insertunidetails['email']				= $this->input->post('email');
			$insertunidetails['contact_no']			= $this->input->post('contact_no');
			$insertunidetails['name_of_representative']	= $this->input->post('name_of_representative');
			$insertunidetails['position']			= $this->input->post('position');
			$insertunidetails['business_license_number'] = $this->input->post('business_license_number');
			$insertunidetails['validity_date']		= $this->input->post('validity_date');
			$insertunidetails['issued_by']			= $this->input->post('issued_by');
			$insertunidetails['accreditation_no']	= $this->input->post('accreditation_no');
			$insertunidetails['accreditation_validity_date'] = $this->input->post('accreditation_validity_date');
			$insertunidetails['accreditation_issued_by'] = $this->input->post('accreditation_issued_by');
			$insertunidetails['university_password'] 	= date('YmdHism');
			$insertunidetails['college_logo']			= $college_logo;				
			$insertunidetails['added_date']				= date('Y-m-d H:i:s');
			$insertunidetails['status']					= '1';
			//echo '<pre>'; print_r($data); exit;
			
			$signupuser = $this->university_model->insertuniversity($insertunidetails);
			//$data['universitydetailsarr'] = $this->university_model->universitydetails($signupuser);
			
			if($signupuser > 0){	
				
				$universitydata = array(						
					'uniid_stepone'  		=> $signupuser,
					'university_name'  		=> $this->input->post('university_name'),
					'university_email'  	=> $this->input->post('email'),
					'university_stepone' 	=> TRUE
				);
				$this->session->set_userdata($universitydata);
				echo base_url('university/university/accreditationdocs'); exit;
			} 
		}
		
		$this->data['subscription'] = $this->common_model->get_admin_subscription_details();
		$this->load->view('include/header',$this->data);
		$this->load->view('college_form',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function submissionofgraduates(){
		
		$this->data = array(
			'title'=> 'submission of graduate for licensure examination',
			'page_title'=> 'submission of graduate for licensure examination'
		);
		/* if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		} */
		
		$this->data['unvdetls'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		//print_r($unvdetls); exit;
		$this->load->view('include/header',$this->data);
		$this->load->view('submission_of_graduate',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function submissionofgraduateslist(){
		
		$this->data = array(
			'title'=> 'List of Graduates',
			'page_title'=> 'submission of graduate for licensure examination'
		);
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		
		
		$this->data['grduatelistingarr'] = $this->university_model->get_graduatesforlicence($this->session->userdata('uniid'));
		//print_r($unvdetls); exit;
		$this->load->view('include/header',$this->data);
		$this->load->view('submissionofgraduatelist',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function graducatelicencepayment(){
		
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array(
			'title'=> 'List of Graduates Payment',
			'page_title'=> 'submission of graduate for licensure examination payment'
		);
		//echo '<pre>'; print_r($_POST); exit;
		if($_POST['submit'] == 'submit'){
			if(!is_array($_POST['grad_id'])){
				$this->session->set_flashdata('item', array('message' => 'Please select graduate','class' => 'alert-warning'));
				redirect(base_url('university/university/submissionofgraduateslist'), 'refresh');
			}
			else if(is_array($_POST['grad_id']) && count($_POST['grad_id']) < 1){
				$this->session->set_flashdata('item', array('message' => 'Please select graduate','class' => 'alert-warning'));
				redirect(base_url('university/university/submissionofgraduateslist'), 'refresh');
			}else{
				$chargesarr = $this->university_model->getunicertificatecharge(4,'submission_of_graduates_for_licensure_examination');
				//echo $chargesarr->charge; exit;
					
					//$data['settingarr'] = $this->common_model->get_setting('1');
					//$charge = $data['chargesarr']->charge; 
				$settingarr = $this->common_model->get_setting('1');
				$temporderid= date('YmdHism');
				$this->session->set_userdata(array('temporderid' => $temporderid));
				$total_processinamt = 0;
				for($g=0; $g<count($_POST['grad_id']);$g++){
					//echo $_POST['grad_id'][$g];					
					$updatedata = array();
					$updatedata['temp_order_id'] = $temporderid;					
					$this->university_model->tempgraducatepaymentid($updatedata,$_POST['grad_id'][$g]);
					$total_processinamt += $chargesarr->charge;
				}
				//tempgraducatepaymentid();
				//echo '<pre>'; print_r($_POST); exit;
			}
		}
		//echo $total_processinamt;
		$tax = $settingarr->tax; 
		$tax_amount = $total_processinamt*$tax/100; 
		
		/* $this->data['processingfee'] = $total_processinamt;
		$this->data['processingfeewithtax'] = $total_processinamt+$tax_amount;
		$this->data['tax'] = $tax;
		$this->data['tax_amount'] = $tax_amount;
		$this->data['temporderid'] = $temporderid; */
		$data['paymentdetails'] = array(
			'processingfee'=> $total_processinamt,
			'processingfeewithtax'=> $total_processinamt+$tax_amount,
			'tax'=> $tax,
			'tax_amount'=> $tax_amount,
			'temporderid'=> $temporderid,
			'grad_id' => $_POST['grad_id'][0],
		);
		$data['chargesarr'] = $this->common_model->certificatechargesarr('submission_of_graduates_for_licensure_examination');
		//print_r($unvdetls); exit;
		$this->load->view('include/header',$this->data);
		$this->load->view('graducatelicencepayment',$data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function graducatepayment(){
		
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array(
			'title'=> 'List of Graduates',
			'page_title'=> 'submission of graduate for licensure examination list'
		);
		if($_POST['submit'] == 'paynow'){
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $this->session->userdata('uniid');
				$paymentdata['doc_refrence_id'] = $_POST['temporderid'];
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $_POST['amount'];
				$paymentdata['payment_tax'] 	= $_POST['taxamt'];
				$paymentdata['payment_gross'] 	= $_POST['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'G';
				$paymentdata['payment_type'] 	= 'S';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
			echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';
				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalform"> 
					
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="item_name_1" value="submission of graduates for licensure examination">
				<input type="hidden" name="item_number_1" value="'.$_POST['temporderid'].'">
				<input type="hidden" name="amount_1" id="amount_1"  value="'.$_POST['total'].'">
				<input type="hidden" name="quantity_1" value="1"> 
				<input type="hidden" name="custom" value="">
				<!--<input type="hidden" name="notify_url" value="https://www.yoursite.com/my_ipn.php">-->
				<input type="hidden" name="return" value="'.base_url('university/university/paymentgraducatelicencesucess').'">
				<input type="hidden" name="cbt" value="Return to The Store">
				<input type="hidden" name="cancel_return" value="'.base_url('university/university/graducatelicencecancel').'">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" value="2" name="rm"> 	
				<input type="hidden" name="currency_code" value="USD">
				<!--<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">-->
				
				'.form_close();	
				//echo '<script> $("#paypalform").submit(); </script>';
				echo '<script> document.getElementById("paypalform").submit(); </script>';
		}
	}	
	public function messagereply(){
		//print_r($_POST); exit;
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$_POST['message'].'</p>';
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
				//send refrence code 
				$settingarr = $this->common_model->get_setting('1');
				$subject = 'Reply From RBoard - '.$_POST['pursosefor'];
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($this->session->userdata('email'));
				$this->email->subject($subject);
				$emailbody1 = array();
				$emailbody1['name'] = $this->session->userdata('university_name');
				$emailbody1['thanksname'] 	= $settingarr->signature_name;
				$emailbody1['thanks2'] 		= '';
				$emailbody1['thanks3'] 		= $settingarr->position;
				$emailbody1['body_msg'] = $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				//$sent = $this->email->send();
				// if($sent){
				// 	echo 'Message sent successfully.';		
				// }else{
				// 	echo 'Message not sent please try again.';
				// }
				echo true;
				//end send refrence code 
			exit;
	}
	public function graducatelicencecancel(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		//echo '<pre>'; print_r($_POST);
		redirect(base_url('university/university/submissionofgraduates'), 'refresh');
	}
	public function paymentgraducatelicencesucess(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		/* if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		} */
		//echo '<pre>'; print_r($_POST); exit;
		if($_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
			$paypalInfo 						= $this->input->post();
			$paymentupdate 						= array();
			$paymentupdate['txn_id'] 			= $paypalInfo["txn_id"];
			$paymentupdate['currency_code'] 	= $paypalInfo["mc_currency"];
			$paymentupdate['payer_email'] 		= $paypalInfo["payer_email"];
			$paymentupdate['payment_status'] 	= $paypalInfo["payment_status"];		
			$updatepayment = $this->common_model->update_payment_multipule($paymentupdate,$paypalInfo['item_number1']);
			$getuserid = $this->common_model->getuserids_temppaymentid($paypalInfo['item_number1']);
			
			
			$unvdetls = $this->university_model->universitydetails($getuserid->user_id);
			if($unvdetls->uniid > 0){
				$universitydata = array(
						'uniid'  			=> $unvdetls->uniid,
						'university_name'  	=> $unvdetls->university_name,
						'college_of' 		=> $unvdetls->college_of,
						'email'				=> $unvdetls->email,
						'contact_no'		=> $unvdetls->contact_no,
						'university_logged_in' 	=> TRUE
				);
				$this->session->set_userdata($universitydata);
			}  
			// get graduates details
			$graducatelisting = $this->university_model->get_graduates_temporderid($paypalInfo['item_number1']);
			$graducatelistingmail = '<table style="border-style:solid; border-width:1px; border-color:#000000;">
				<tr>
				<td style="border: 1px solid #000000;">Name</td>
				<td style="border: 1px solid #000000;">Email</td>
				<td style="border: 1px solid #000000;">Gender</td>
				<td style="border: 1px solid #000000;">Date of Graduation</td>
				<!--<td style="border: 1px solid #000000;">Refrence Code</td>-->
				</tr>';
				$bytes 		= random_bytes(4); 
				$refcode 	= bin2hex($bytes);
				$graducateRefCode = 'GRA-'.$refcode.'-'.date('Y');
				$graducate_id = '';
				
			foreach($graducatelisting as $grdlist){
				// update application count
				$logs = array(
					// 'application_id'	=>	$getuserid->doc_refrence_id,
					'application_id'	=>	$grdlist->grad_id,
					'res_id'			=>	'5',
					'subscription'		=>	$this->subs_status,
					'added_at'			=>	date('Y-m-d H:i:s')
				);
				$this->common_model->insert_onlineapplication_log($logs);
				
				$graducate_id = $grdlist->grad_id;
				$updatedocdate = array();
				$updatedocdate['refrence_code'] = $graducateRefCode;
				$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
				$this->university_model->updategraducates($updatedocdate, $grdlist->grad_id);
				
				$graducatelistingmail .= '<tr>
				<td style="border: 1px solid #000000;">'.$grdlist->student_name.' '.$grdlist->middle_name.' '.$grdlist->surname.'</td>
				<td style="border: 1px solid #000000;">'.$grdlist->email.'</td>
				<td style="border: 1px solid #000000;">'.$grdlist->gender.'</td>
				<td style="border: 1px solid #000000;">'.$grdlist->date_of_graduated.'</td>
				<!--<td style="border: 1px solid #000000;">'.$graducateRefCode.'</td>-->
				</tr>';
			}
			$graducatelistingmail .= '</table>';
			// end get graduates details
			//exit;
			if($updatepayment){
				
				//echo '<p>Payment success</p>';
				//$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.</p><p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your payment has been received successfully.<br><strong>Order No.: </strong>'.$getuserid->payment_id.'</p><br>'.$graducatelistingmail;
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for review of graduates for licensure examination has been approved.</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;"><b>Refrence Code:</b> '.$graducateRefCode.'</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Please check the following graduates and their examination codes:</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;font-weight:bold;">'.$graducatelistingmail.'</p>
				<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Should you have questions just message us and we would be happy to assist you.</p>';
				
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
					//send refrence code 
					$settingarr = $this->common_model->get_setting('1');
					$subject = 'Submission of Graduate for Licensure';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($unvdetls->email);
					//$this->email->cc('abhijeetkuma@gmail.com');
					$this->email->subject($subject);
					$emailbody1 = array();
					$emailbody1['name'] = $unvdetls->name_of_representative;
					
					$emailbody1['thanksname'] 	= $settingarr->signature_name;
					$emailbody1['thanks2'] 		= '';
					$emailbody1['thanks3'] 		= $settingarr->position;
					$emailbody1['body_msg'] = $bodycontentforCode;
					$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					// $this->email->send();
					$updatenotification 				= array();
					$updatenotification['uniid'] 		= $unvdetls->uniid;
					$updatenotification['subject'] 		= $subject;
					$updatenotification['message'] 		= $bodycontentforCode;
					$updatenotification['from'] 		= SENDER_NAME;
					$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
					$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
					$this->university_model->insertnotifications($updatenotification);
					//end send refrence code 
				
				
				redirect(base_url('university/university/graducatelicencestatus/'.base64_encode($graducateRefCode)), 'refresh');
			}
		}
	}
	public function graducatelicencestatus($refrence_code){
		
		$refrence_code = base64_decode($refrence_code);
		//if(!is_numeric($refrence_code)){
		if($refrence_code == ""){
			$data['informat'] =  '<p>No data found.</p>';
		}
		$data['gradArr'] = $this->university_model->graducationrefrence($refrence_code);
		//echo '<pre>'; print_r($data['gradArr']); exit;
		$this->data = array(
			'title'=> 'graduate for licensure examination',
			'page_title'=> 'graduate for licensure examination' 
		);
		/* if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		} */
		
		
		//print_r($unvdetls); exit;
		$this->load->view('include/header',$this->data);
		$this->load->view('graducatelicencestatus',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function graduateexamcode($graducate_id){
		
		$graducate_id = base64_decode($graducate_id);
		if(!is_numeric($graducate_id)){
			$data['informat'] =  '<p>No data found.</p>';
		}
		$data['gradArr'] = $this->university_model->graducationdetails($graducate_id);
		$this->data = array(
			'title'=> 'graduate exam code',
			'page_title'=> 'graduate exam code'
		);
		/* if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		} */
		
		
		//print_r($unvdetls); exit;
		$this->load->view('include/header',$this->data);
		$this->load->view('graduateexamcode',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function universitystep(){
		$output = array('error' => false);	
		$msg = 0;	
		//echo '<pre>'; print_r($_POST); exit;
		//if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('university_name', 'school name', 'trim|required');
			$this->form_validation->set_rules('college_of', 'college of', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');
			$this->form_validation->set_rules('countries_id', 'country', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tbl_university.email]');
			$this->form_validation->set_rules('contact_no', 'contact no.', 'trim|required|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('name_of_representative', 'name of representative', 'trim|required');
			$this->form_validation->set_rules('position', 'position', 'trim|required');
			$this->form_validation->set_rules('business_license_number', 'business license number', 'trim|required');
			$this->form_validation->set_rules('validity_date', 'validity date', 'trim|required');
			$this->form_validation->set_rules('issued_by', 'issued by', 'trim|required');
			$this->form_validation->set_rules('accreditation_no', 'accreditation no.', 'trim|required');
			$this->form_validation->set_rules('accreditation_validity_date', 'validity date', 'trim|required');
			$this->form_validation->set_rules('accreditation_issued_by', 'issued by', 'trim|required');
			if(isset($_FILES['college_logo']['name']) && $_FILES['college_logo']['name'] == ""){
				$this->form_validation->set_rules('college_logo', 'college logo', 'required');
			}
			if($this->form_validation->run() == TRUE){
				
				$msg = '1';
				echo json_encode(['error'=>'','msg'=>'1']); exit;
			}else{
				//validation_errors();
				$errors = array(
					'university_name' => form_error('university_name', '<p class="mt-3 text-danger">', '</p>'),
					'college_of' => form_error('college_of', '<p class="mt-3 text-danger">', '</p>'),
					'address' => form_error('address', '<p class="mt-3 text-danger">', '</p>'),
					'countries_id' => form_error('countries_id', '<p class="mt-3 text-danger">', '</p>'),
					'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
					'contact_no' => form_error('contact_no', '<p class="mt-3 text-danger">', '</p>'),
					'name_of_representative' => form_error('name_of_representative', '<p class="mt-3 text-danger">', '</p>'),
					'position' => form_error('position', '<p class="mt-3 text-danger">', '</p>'),
					'business_license_number' => form_error('business_license_number', '<p class="mt-3 text-danger">', '</p>'),
					'validity_date' => form_error('validity_date', '<p class="mt-3 text-danger">', '</p>'),
					'issued_by' => form_error('issued_by', '<p class="mt-3 text-danger">', '</p>'),
					'accreditation_no' => form_error('accreditation_no', '<p class="mt-3 text-danger">', '</p>'),
					'accreditation_validity_date' => form_error('accreditation_validity_date', '<p class="mt-3 text-danger">', '</p>'),
					'accreditation_issued_by' => form_error('accreditation_issued_by', '<p class="mt-3 text-danger">', '</p>'),
					'college_logo' => form_error('college_logo', '<p class="mt-3 text-danger">', '</p>')
				);
				//$errors = validation_errors();
				echo json_encode(['error'=>$errors,'msg'=>'0']); exit;
			}
		//}
		
	}
	public function accreditationdocs(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		}
		//echo $this->session->userdata('uniid_stepone'); exit;
		if($this->input->post('submit')=='submit'){
			// business_license upload	
				$this->load->library('upload');			
				$business_license 	= '';
				$accreditation 		= '';
				if(isset($_FILES["business_license"]) && !empty($_FILES["business_license"]['name'])){	  	  //$this->load->library('upload', $config);	
					
					$config['upload_path'] 		= './assets/images/university/';
					//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
					$config['allowed_types'] 	= '*';
					//$config['max_size'] 		= '200000';
					//$config['max_width']  	= '1500';
					//$config['max_height']  	= '800';        
					$ext 						= explode('.',$_FILES["business_license"]["name"]);        
					$business_license 			= 'unibuslic_'.time().'.'.end($ext);
					$config['file_name'] 		= $business_license;
					$this->upload->initialize($config);
					
					if ( ! $this->upload->do_upload('business_license'))
					{
					$error = array('error' => $this->upload->display_errors());                       
						//print_r($error); exit;
					}  
					$business_license = $business_license;
				}
				if(isset($_FILES["accreditation"]) && !empty($_FILES["accreditation"]['name'])){	  	 	
					
					$config['upload_path'] 		= './assets/images/university/';
					//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
					$config['allowed_types'] 	= '*';
					//$config['max_size'] 		= '200000';
					//$config['max_width']  	= '1500';
					//$config['max_height']  	= '800';        
					$ext 						= explode('.',$_FILES["accreditation"]["name"]);        
					$accreditation 				= 'uniaccred_'.time().'.'.end($ext);
					$config['file_name'] 		= $accreditation;
					$this->upload->initialize($config);
					
					if ( ! $this->upload->do_upload('accreditation'))
					{
					$error = array('error' => $this->upload->display_errors());                       
						//print_r($error); exit;
					}  
					$accreditation = $accreditation;
				}			
			// end business_license upload
			$insertunidoc = array();
			$insertunidoc['business_license'] 	= $business_license;
			$insertunidoc['accreditation'] 		= $accreditation;
			$updateunidoc = $this->university_model->updateuniversity($insertunidoc, $this->session->userdata('uniid_stepone'));
			$insertunidoclist 						= array();
			$insertunidoclist['uniid'] 				= $this->session->userdata('uniid_stepone');
			$insertunidoclist['business_license'] 	= $business_license;
			$insertunidoclist['accreditation'] 		= $accreditation;
			$insertunidoclist['document_for'] 		= 'n';
			$insertunidoclist['updated_at'] 		= date('Y-m-d H:i:s');
			//print_r($insertunidoclist); exit;
			$updateunidoc = $this->university_model->uploadeuniversityrenewdoc($insertunidoclist);
				if($updateunidoc){
					$universityrenewdoc = array('updateunidoc'=> $updateunidoc);
					$this->session->set_userdata($universityrenewdoc);
				}
			//if($updateunidoc){
				redirect(base_url('university/university/university_payment'), 'refresh');
			//}
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('accreditationdocs',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function university_payment(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		}
		
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid_stepone'));
		if($data['universitydetailsarr']->business_license == "" || $data['universitydetailsarr']->accreditation == ""){
			redirect(base_url('university/university/accreditationdocs'), 'refresh');	
		}
		$data['chargesarr'] = $this->common_model->certificatechargesarr('school_accreditaion');
		$data['settingarr'] = $this->common_model->get_setting('1');
		if(isset($_POST['submit']) && $_POST['submit'] == "paynow"){
			$this->form_validation->set_rules('duration', 'accreditation period', 'trim|required');
			//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			
			if($this->form_validation->run() == TRUE){
				$certdeta = $this->common_model->get_certificatechargedetails($_POST['duration']);
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				$this->university_model->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updateunidoc'));
				
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $this->session->userdata('uniid_stepone');
				$paymentdata['doc_refrence_id'] = $this->session->userdata('updateunidoc');
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $_POST['amount'];
				$paymentdata['payment_tax'] 	= $_POST['taxamt'];
				$paymentdata['payment_gross'] 	= $_POST['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'U';
				$paymentdata['payment_type'] 	= 'N';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);

				unset($_SESSION['updateunidoc']);
				
				echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';
				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalform"> 
					
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="item_name_1" value="School accreditation">
				<input type="hidden" name="item_number_1" value="'.$lastpaymentid.'">
				<input type="hidden" name="amount_1" id="amount_1"  value="'.$_POST['total'].'">
				<input type="hidden" name="quantity_1" value="1"> 
				<input type="hidden" name="custom" value="'.$this->session->userdata('updateunidoc').'">
				<!--<input type="hidden" name="notify_url" value="https://www.yoursite.com/my_ipn.php">-->
				<input type="hidden" name="return" value="'.base_url('university/university/paymentsucess').'">
				<input type="hidden" name="cbt" value="Return to The Store">
				<input type="hidden" name="cancel_return" value="'.base_url('university/university/paymentcancel').'">
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
		$this->load->view('include/header',$this->data);
		$this->load->view('universitypayment',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function paymentsucess(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		/* if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		} */
		//echo '<pre>'; print_r($_POST); exit;
		if($_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
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
				'res_id'			=>	'3',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);
							
			$unvdetls = $this->university_model->universitydetails($getuserid->user_id);
			if($unvdetls->uniid > 0){
				$universitydata = array(						
					'uniid_stepone'  		=> $unvdetls->uniid,
					'university_name'  		=> $unvdetls->university_name,
					'university_email'  	=> $unvdetls->email,
					'university_stepone' 	=> TRUE
				);
				$this->session->set_userdata($universitydata);
			} 
			//$universityrenewdoc = array('updateunidoc'=> $_POST['custom']);
			$universityrenewdoc = array('updateunidoc'=> $getuserid->doc_refrence_id);
			$this->session->set_userdata($universityrenewdoc);
			/* $paymentdata 					= array();
			$paymentdata['user_id'] 		= $_POST['item_name1'];
			$paymentdata['doc_refrence_id'] = $_POST['custom'];
			$paymentdata['txn_id'] 			= $_POST['txn_id'];
			$paymentdata['payment_gross'] 	= $_POST['payment_gross'];
			$paymentdata['payer_email'] 	= $_POST['payer_email'];
			$paymentdata['payment_status'] 	= $_POST['payment_status'];
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'U';
			$paymentdata['payment_type'] 	= 'N';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$inserted = $this->university_model->insert_payment($paymentdata); */
			//if($inserted >0){
			if($updatepayment){
				$bytes 		= random_bytes(3); 
				$refcode 	= bin2hex($bytes);
				$universityRefCode = 'UNI-'.$unvdetls->uniid.$refcode.'-'.date('Y');
				$refcodearr = array();
				$refcodearr['refrence_code'] = $universityRefCode;
				
				$updatedocdate = array();
				$updatedocdate['refrence_code'] = $universityRefCode;
				$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
				$this->university_model->updatedocumentrenewdate($updatedocdate, $getuserid->doc_refrence_id);
				$updaterefencecode = $this->university_model->updateuniversity($refcodearr,$this->session->userdata('uniid_stepone'));
				//echo '<p>Payment success</p>';
				$logindetails = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Login id: '.$unvdetls->email.'<br>Password: '.$unvdetls->university_password.'</p>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.<br><strong>Refrence Code : </strong>'.$universityRefCode.'</p>';
				
				$bodycontent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your payment has been received successfully.<br><strong>Order No.: </strong>'.$getuserid->payment_id.'</p><br>';
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
				if($updaterefencecode){
					//send refrence code 
					$settingarr = $this->common_model->get_setting('1');
					$subject = 'School accreditation account created';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($unvdetls->email);
					$this->email->subject($subject);
					$emailbody1 = array();
					$emailbody1['name'] = $unvdetls->name_of_representative;
					$emailbody1['thanksname'] 	= $settingarr->signature_name;
					$emailbody1['thanks2'] 		= '';
					$emailbody1['thanks3'] 		= $settingarr->position;
					$emailbody1['body_msg'] 	= $bodycontentforCode;
					$emailmessage1 = $this->load->view('emailer', $emailbody1,  TRUE);			
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage1);
					//// $this->email->send();
					
					//payment receipt mail
					$data['details']	= $this->common_model->get_one_receipt_details($paypalInfo['item_number1']);
					$bodycontentforCodeemail = $this->load->view('receipt_view_email', $data, TRUE);
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($unvdetls->email);
					$this->email->subject('School Accreditation Fee');
					$emailbody = array();
					$emailbody['name'] 			= $unvdetls->name_of_representative;
					$emailbody['thanksname'] 	= $settingarr->signature_name;
					$emailbody['thanks2'] 		= '';
					$emailbody['thanks3'] 		= $settingarr->position;
					$emailbody['body_msg'] 		= $bodycontentforCodeemail;
					$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					// $this->email->send();
					//end payment receipt mail	
					
					$updatenotification 				= array();
					$updatenotification['uniid'] 		= $unvdetls->uniid;
					$updatenotification['subject'] 		= $subject;
					$updatenotification['message'] 		= $bodycontentforCode;
					$updatenotification['from'] 		= SENDER_NAME;
					$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
					$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
					$this->university_model->insertnotifications($updatenotification);
					//end send refrence code 
					
					
				}
				/* $this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($unvdetls->email);
				$this->email->subject('University payment');
				$emailbody = array();
				$emailbody['name'] = $unvdetls->name_of_representative;
				$emailbody['thanksname'] = $unvdetls->chairman;
				$emailbody['thanks2'] = $unvdetls->qualification;
				$emailbody['thanks3'] = $unvdetls->chairposition;
				$emailbody['body_msg'] = $bodycontent;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);				
				$this->email->message($emailmessage);
				// $this->email->send(); */
				/* if($this->email->send()){
					return true; 
				}else{
					return false; 
				} */
				redirect(base_url('university/university/universitypaymentsucess'), 'refresh');
			}
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('universitypayment',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function universitypaymentsucess(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		//print_r($_SESSION);
		 if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		}
		redirect(base_url('university/university/verificationdocuments/'.base64_encode($this->session->userdata('updateunidoc'))));
		
		/* $uniregsession = array('uniid_stepone' => '', 'university_name' => '', 'university_email' => '', 'university_stepone' => '');
		$this->session->unset_userdata($uniregsession); */
		
		/* $uniid = base64_decode($id); 
		if($uniid < 1){
			redirect(base_url('university/university/index'), 'refresh');
		} */
		$this->load->view('include/header',$this->data);
		$this->load->view('universitypaymentsucess',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function verificationdocuments($id=null){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		/* if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		} */
		$unidoc_id = base64_decode($id);
		//echo $unidoc_id;exit; 
		if($unidoc_id < 1){
			redirect(base_url('university/university/index'), 'refresh');
		}
		
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['unvdetls'] = $this->university_model->universitydocdetails($unidoc_id,$this->session->userdata('uniid'),'n'); 
		$data['paydetls'] = $this->university_model->universitypaymentdetails($unidoc_id,$this->session->userdata('uniid'));
		$this->session->unset_userdata('uniid_stepone');
		$this->session->unset_userdata('university_name');
		$this->session->unset_userdata('university_email');
		$this->session->unset_userdata('university_stepone');
		$this->session->unset_userdata('updateunidoc');
		$this->load->view('include/header',$this->data);
		$this->load->view('verificationdocuments',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function rejectnotification($id=null){
		$this->data = array('title'=> 'Welcome in Regulatory Board',
							'rejectnotification' => 'NOTIFICATION'
						);
		/* if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		} */
		$unidoc_id = base64_decode($id); 
		if($unidoc_id < 1){
			redirect(base_url('university/university/index'), 'refresh');
		}
		
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		//$data['unvdetls'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['unvdetls'] = $this->university_model->universitydocdetails($unidoc_id,$this->session->userdata('uniid'),'n'); 
		$this->session->unset_userdata('uniid_stepone');
		$this->session->unset_userdata('university_name');
		$this->session->unset_userdata('university_email');
		$this->session->unset_userdata('university_stepone');
		$this->session->unset_userdata('updateunidoc');
		$this->load->view('include/header',$this->data);
		$this->load->view('rejectnotification',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function acceptnotification($id=null){
		$this->data = array('title'=> 'Welcome in Regulatory Board',
							'acceptnotification' => 'CONGRATULATION'
						);
		/* if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		} */
		$uniid = base64_decode($id); 
		if($uniid < 1){
			redirect(base_url('university/university/index'), 'refresh');
		}
		//echo $uniid;exit;
		$data['universitydetailsarr'] = $this->university_model->universitydetails($uniid);
		//$data['unvdetls'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['unvdetls'] = $this->university_model->universitydocdetails('',$uniid,'n'); 
		$this->session->unset_userdata('uniid_stepone');
		$this->session->unset_userdata('university_name');
		$this->session->unset_userdata('university_email');
		$this->session->unset_userdata('university_stepone');
		$this->session->unset_userdata('updateunidoc');
		$this->load->view('include/header',$this->data);
		$this->load->view('acceptnotification',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function get_email_notification(){
		//$post = $_POST['uniid'];
		$uniid = $_POST['uniid'];
		$notification = $this->university_model->get_email_notification($uniid);
		echo '<h1><strong>'.$notification->subject.'<strong></h1>'.$notification->message;
	}
	public function paymentcancel(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_stepone')){
			redirect(base_url('university/university/index'), 'refresh');
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('universitypayment',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function digitalaccreditation($uni_id=null){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$data['universitydetailsarr'] = $this->university_model->universitydetails(base64_decode($uni_id));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails(base64_decode($uni_id));
		$this->load->view('include/header',$this->data);
		$this->load->view('digitalaccreditation',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function digitalrenewaccreditation(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		//print_r($_SESSION); 
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		
		$this->load->view('include/header',$this->data);
		$this->load->view('digitalrenewaccreditation',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function renewuniversity(){
		$this->data = array('title'=> 'Renew university on Regulatory board');
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$this->load->view('include/header',$this->data);
		$this->load->view('renewuniversity',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function renewuniversitytwo(){
		$this->data = array('title'=> 'accreditation documents on Regulatory board');
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		
		if($this->input->post('submit')=='submit'){
			//echo '<pre>'; print_r($_FILES);
			/* if(empty($_FILES["business_license"]['name'])){
				$this->form_validation->set_rules('business_license', 'business license', 'trim|required');
			}
			if(empty($_FILES["accreditation"]['name'])){
				$this->form_validation->set_rules('accreditation', 'accreditation', 'trim|required');
			} */
			//echo '<pre>'; print_r($_FILES); 
			//print_r(validation_errors());
			//echo $this->form_validation->run();
			//exit;
			//if($this->form_validation->run() == TRUE){
				
				// business_license upload	
				$this->load->library('upload');			
				$business_license 	= '';
				$accreditation 		= '';
				if(isset($_FILES["business_license"]) && !empty($_FILES["business_license"]['name'])){	  	  //$this->load->library('upload', $config);	
					
					$config['upload_path'] 		= './assets/images/university/';
					//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
					$config['allowed_types'] 	= '*';
					//$config['max_size'] 		= '200000';
					//$config['max_width']  	= '1500';
					//$config['max_height']  	= '800';        
					$ext 						= explode('.',$_FILES["business_license"]["name"]);        
					$business_license 			= 'reunibuslic_'.time().'.'.end($ext);
					$config['file_name'] 		= $business_license;
					$this->upload->initialize($config);
					
					if ( ! $this->upload->do_upload('business_license'))
					{
					$error = array('error' => $this->upload->display_errors());                       
						//print_r($error); exit;
					}  
					$business_license = $business_license;
				}
				if(isset($_FILES["accreditation"]) && !empty($_FILES["accreditation"]['name'])){	  	 	
					
					$config['upload_path'] 		= './assets/images/university/';
					//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
					$config['allowed_types'] 	= '*';
					//$config['max_size'] 		= '200000';
					//$config['max_width']  	= '1500';
					//$config['max_height']  	= '800';        
					$ext 						= explode('.',$_FILES["accreditation"]["name"]);        
					$accreditation 				= 'reuniaccred_'.time().'.'.end($ext);
					$config['file_name'] 		= $accreditation;
					$this->upload->initialize($config);
					
					if ( ! $this->upload->do_upload('accreditation'))
					{
					$error = array('error' => $this->upload->display_errors());                       
						//print_r($error); exit;
					}  
					$accreditation = $accreditation;
				}			
				// end business_license upload
				$insertunidoc = array();
				$insertunidoc['uniid'] 				= $this->session->userdata('uniid');
				$insertunidoc['business_license'] 	= $business_license;
				$insertunidoc['accreditation'] 		= $accreditation;
				$insertunidoc['document_for'] 		= 'r';
				$insertunidoc['updated_at'] 		= date('Y-m-d H:i:s');
				//print_r($insertunidoc); exit;
				$updateunidoc = $this->university_model->uploadeuniversityrenewdoc($insertunidoc);
				if($updateunidoc){
					$universityrenewdoc = array('updateunidoc'=> $updateunidoc);
					$this->session->set_userdata($universityrenewdoc);
					redirect(base_url('university/university/renewpayment'), 'refresh');
				}
			/* }else{
				validation_errors();
			} */
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$this->load->view('include/header',$this->data);
		$this->load->view('renewuniversitytwo',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function renewpayment(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		//echo '<pre>'; print_r($_SESSION);
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid_stepone'));
		//$data['chargesarr'] = $this->university_model->certificateCharges('university');
		$data['chargesarr'] = $this->common_model->certificatechargesarr('renewal_of_school_accreditaion');
		$data['settingarr'] = $this->common_model->get_setting('1');
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		
		//print_r($data['universitydetailsarr']); exit;
		if($this->session->userdata('updateunidoc') == ""){
			redirect(base_url('university/university/renewuniversitytwo'), 'refresh');	
		}	
		
		if(isset($_POST['submit']) && $_POST['submit'] == "paynow"){
			$this->form_validation->set_rules('renew_duration', 'renew for', 'trim|required');
			//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if($this->form_validation->run() == TRUE){
				//print_r($_POST);exit;
				$certdeta = $this->common_model->get_certificatechargedetails($_POST['renew_duration']);
				//print_r($certdeta);
				//echo $certdeta->duration;
				$expiry_at = date('Y-m-d', strtotime('+'.$certdeta->duration.' years'));
				$updatedocdate = array();
				$updatedocdate['expiry_at'] = $expiry_at;
				$updatedocdate['renew_for'] = $certdeta->duration;
				$this->university_model->updatedocumentrenewdate($updatedocdate, $this->session->userdata('updateunidoc'));
				
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $this->session->userdata('uniid');
				$paymentdata['doc_refrence_id'] = $this->session->userdata('updateunidoc');
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $_POST['amount'];
				$paymentdata['payment_tax'] 	= $_POST['taxamt'];
				$paymentdata['payment_gross'] 	= $_POST['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'U';
				$paymentdata['payment_type'] 	= 'R';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
		
				echo '<p style="text-align:center;top:30px;">Please wait payment in process</p>';
				echo '<form action="'.PAYAPAL_URL.'" method="post" target="_top" id="paypalform"> 
					
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="'.PAYAPAL_ID.'">
				<input type="hidden" name="item_name_1" value="School accreditation renewal">
				<input type="hidden" name="item_number_1" value="'.$lastpaymentid.'">
				<input type="hidden" name="amount_1" id="amount_1"  value="'.$_POST['total'].'">
				<input type="hidden" name="quantity_1" value="1"> 
				<input type="hidden" name="custom" value="'.$this->session->userdata('updateunidoc').'">
				<!--<input type="hidden" name="notify_url" value="https://www.yoursite.com/my_ipn.php">-->
				<input type="hidden" name="return" value="'.base_url('university/university/renewpaymentsucess').'">
				<input type="hidden" name="cbt" value="Return to The Store">
				<input type="hidden" name="cancel_return" value="'.base_url('university/university/renewpaymentcancel').'">
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
		$this->load->view('include/header',$this->data);
		$this->load->view('renewpayment',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function getrenewprice(){
		$chargeid 		= $_POST['chargeid'];
		$charges_for 	= $_POST['charges_for'];
		$data['chargesarr'] = $this->university_model->getunicertificatecharge($chargeid,$charges_for);
		$data['settingarr'] = $this->common_model->get_setting('1');
		$charge = $data['chargesarr']->charge; 
		$tax = $data['settingarr']->tax; 
		$tax_amount = $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}
	public function getrenewpriceforgraducatessubmition(){
		$chargeid 		= $_POST['chargeid'];
		$charges_for 	= $_POST['charges_for'];
		$temporderid 	= isset($_POST['temporderid'])?$_POST['temporderid']:'';
		$grasubarr = $this->university_model->get_graduates_temporderid($temporderid);
		$number_of_submition_graduates = ($temporderid > 0)?count($grasubarr):0;
		$data['chargesarr'] = $this->university_model->getunicertificatecharge($chargeid,$charges_for);
		$data['settingarr'] = $this->common_model->get_setting('1');
		$charge = $data['chargesarr']->charge * $number_of_submition_graduates; 
		//$tax = $data['settingarr']->tax * $number_of_submition_graduates; 
		$tax = $data['settingarr']->tax;
		$tax_amount = $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}
	public function renewpaymentsucess(){ 
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		
				/*print_r($_SESSION);
		echo 'sd'.$this->session->userdata('updateunidoc'); 
		exit;  */
		/* if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}  */
		
		if($_POST['txn_id'] != "" && $_POST['receiver_id'] != ""){
			$paypalInfo 						= $this->input->post();
			$paymentupdate 						= array();
			$paymentupdate['txn_id'] 			= $paypalInfo["txn_id"];
			$paymentupdate['currency_code'] 	= $paypalInfo["mc_currency"];
			$paymentupdate['payer_email'] 		= $paypalInfo["payer_email"];
			$paymentupdate['payment_status'] 	= $paypalInfo["payment_status"];		
			$updatepayment = $this->common_model->update_payment($paymentupdate,$paypalInfo['item_number1']);			
			$getuserid = $this->common_model->getuserids($paypalInfo['item_number1']);
			$unvdetls = $this->university_model->universitydetails($getuserid->user_id);
			if($unvdetls->uniid > 0){
				$universitydata = array(
						'uniid'  			=> $unvdetls->uniid,
						'university_name'  	=> $unvdetls->university_name,
						'college_of' 		=> $unvdetls->college_of,
						'email'				=> $unvdetls->email,
						'contact_no'		=> $unvdetls->contact_no,
						'university_logged_in' 	=> TRUE
				);
				$this->session->set_userdata($universitydata);
			}  
			$universityrenewdoc = array('updateunidoc'=> $getuserid->doc_refrence_id);
			$this->session->set_userdata($universityrenewdoc);

			//*** count appylcaition start***//
			$logs = array(
				'application_id'	=>	$getuserid->doc_refrence_id,
				'res_id'			=>	'4',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);
			//*** count appylcaition end***//

			/* $paymentdata 					= array();
			$paymentdata['user_id'] 		= $this->session->userdata('uniid');
			$paymentdata['doc_refrence_id'] = $_POST['custom'];
			$paymentdata['txn_id'] 			= $_POST['txn_id'];
			$paymentdata['payment_gross'] 	= $_POST['payment_gross'];
			$paymentdata['payer_email'] 	= $_POST['payer_email'];
			$paymentdata['payment_status'] 	= $_POST['payment_status'];
			$paymentdata['currency_code'] 	= 'USD';
			$paymentdata['payment_for'] 	= 'U';
			$paymentdata['payment_type'] 	= 'R';
			$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
			$inserted = $this->university_model->insert_payment($paymentdata); */
			//if($inserted >0){
			if($updatepayment){
				/* $bytes 		= random_bytes(3); 
				$refcode 	= bin2hex($bytes);
				$universityRefCode = 'UNI-'.$unvdetls->uniid.$refcode.'-'.date('Y');
				$refcodearr = array();
				$refcodearr['refrence_code'] = $universityRefCode;
				$updaterefencecode = $this->university_model->updateuniversity($refcodearr,$this->session->userdata
				('uniid_stepone')); */
				//echo '<p>Payment success</p>';
				$bytes 		= random_bytes(3); 
				$refcode 	= bin2hex($bytes);
				$universityRefCode = 'UNI-'.$unvdetls->uniid.$refcode.'-'.date('Y');
				$refcodearr = array();
				$refcodearr['refrence_code'] = $universityRefCode;
				
				$updatedocdate = array();
				$updatedocdate['refrence_code'] = $universityRefCode;
				$updatedocdate['updated_at'] = date('Y-m-d H:i:s');
				$this->university_model->updatedocumentrenewdate($updatedocdate, $getuserid->doc_refrence_id);
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your application for accreditation was approved.<br><br>In this regard, your account has been created in our website and you will recieve a temporary username and password for you to log in and access your account.<br><br>Likewise, you can now submit the list of your graduates who will be eligible to take the Licensure Examination.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
				
				$bodycontent = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Your payment has been received successfully.<br><strong>Refrence Code: </strong>'.$universityRefCode.'<br><strong>Order No.: </strong>'.$getuserid->payment_id.'</p><br>';
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
				//if($updaterefencecode){
					//send refrence code 
					$settingarr = $this->common_model->get_setting('1');
					$subject = 'Renewal of school accreditaion';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($unvdetls->email);
					$this->email->subject($subject);
					$emailbody1 = array();
					$emailbody1['name'] = $unvdetls->name_of_representative;
					/* $emailbody1['thanksname'] = ($unvdetls->chairman !="")?$unvdetls->chairman:'RBoard Team';
					$emailbody1['thanks2'] = ($unvdetls->qualification !="")?$unvdetls->qualification:'';
					$emailbody1['thanks3'] = ($unvdetls->chairposition !="")?$unvdetls->chairposition:''; */
					$emailbody1['thanksname'] 	= $settingarr->signature_name;
					$emailbody1['thanks2'] 		= '';
					$emailbody1['thanks3'] 		= $settingarr->position;
					$emailbody1['body_msg'] = $bodycontentforCode;
					$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					// $this->email->send();
					
					//payment receipt mail
					$data['details']	= $this->common_model->get_one_receipt_details($paypalInfo['item_number1']);
					$bodycontentforCodeemail = $this->load->view('receipt_view_email', $data, TRUE);
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($unvdetls->email);
					$this->email->subject('Renewal of School Accreditation Fee');
					$emailbody = array();
					$emailbody['name'] 			= $unvdetls->name_of_representative;
					$emailbody['thanksname'] 	= $settingarr->signature_name;
					$emailbody['thanks2'] 		= '';
					$emailbody['thanks3'] 		= $settingarr->position;
					$emailbody['body_msg'] 		= $bodycontentforCodeemail;
					$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					// $this->email->send();
					//end payment receipt mail
					
					
					$updatenotification 				= array();
					$updatenotification['uniid'] 		= $unvdetls->uniid;
					$updatenotification['subject'] 		= $subject;
					$updatenotification['message'] 		= $bodycontentforCode;
					$updatenotification['from'] 		= SENDER_NAME;
					$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
					$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
					$this->university_model->insertnotifications($updatenotification);
					//end send refrence code 
				//}
				/* $this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($unvdetls->email);
				$this->email->subject('University payment');
				$emailbody = array();
				$emailbody['name'] = $unvdetls->name_of_representative;
				$emailbody['thanksname'] = $unvdetls->chairman;
				$emailbody['thanks2'] = $unvdetls->qualification;
				$emailbody['thanks3'] = $unvdetls->chairposition;
				$emailbody['body_msg'] = $bodycontent;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);				
				$this->email->message($emailmessage);
				// $this->email->send(); */
				/* if($this->email->send()){
					return true; 
				}else{
					return false; 
				} */
				redirect(base_url('university/university/universityrenewpaymentsucess'), 'refresh');
			}
		}else{
			redirect(base_url('university/university/renewpayment'), 'refresh');
		}
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$this->load->view('include/header',$this->data);
		$this->load->view('renewpayment',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function universityrenewpaymentsucess(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		//$this->session->userdata('updateunidoc');
		redirect(base_url('university/university/renewverificationdocuments/'.base64_encode($this->session->userdata('updateunidoc'))));
		$this->load->view('include/header',$this->data);
		$this->load->view('universityrenewpaymentsucess',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function renewverificationdocuments($id=null){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$unidoc_id = base64_decode($id); 
		if($unidoc_id < 1){
			redirect(base_url('university/university/index'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($unidoc_id);
		$data['unvdetls'] = $this->university_model->universitydocdetails($unidoc_id,$this->session->userdata('uniid'),'r');
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));		
		$this->load->view('include/header',$this->data);
		$this->load->view('renewverificationdocuments',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function renewpaymentcancel(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['chargesarr'] = $this->university_model->certificateCharges('university');
		$this->load->view('include/header',$this->data);
		$this->load->view('renewpayment',$data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function login(){
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('university_password', 'Password', 'required');
		if($this->form_validation->run() == TRUE){
			$email  				= $this->input->post('email');
			$university_password  	= $this->input->post('university_password');
			$signupuser = $this->university_model->universitylogin($email,$university_password);
			//echo $signupuser->uniid; exit;
			//print_r($signupuser); exit;
			if($signupuser->uniid > 0){
				$universitydata = array(
						'uniid'  			=> $signupuser->uniid,
						'university_name'  	=> $signupuser->university_name,
						'college_of' 		=> $signupuser->college_of,
						'email'				=> $signupuser->email,
						'contact_no'		=> $signupuser->contact_no,
						'university_logged_in' 	=> TRUE
				);
				//print_r($_SESSION); exit;
				//echo $loginuser->username;
				$this->session->set_userdata($universitydata);
				redirect(base_url('university/university/dashboard'), 'refresh');				
			}	
		}else{
			validation_errors();
		}
		//$this->load->view('include/header',$this->data);
		$this->load->view('login',$this->data);
		//$this->load->view('include/footer',$this->data);
	}

	public function dashboard(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['grduatelistingarr'] = $this->university_model->get_graduates($this->session->userdata('uniid'));
		$data['grduatationdatearr'] = $this->university_model->get_graducation_date($this->session->userdata('uniid')); 
		$data['grduatelistingsubmitedarr'] = $this->university_model->get_graduates_submited($this->session->userdata('uniid'));
		$data['grduatelistingsubmitedcountarr'] = $this->university_model->get_graduates_submited_count($this->session->userdata('uniid')); 
		$data['grduatationsubmiteddatearr'] = $this->university_model->get_graducation_submited_date($this->session->userdata('uniid')); 
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board','page_title'=> 'Graduates Listing For Submission');
		$this->load->view('include/header',$this->data);
		// $this->load->view('dashboard',$data);
		$this->load->view('graduate',$data);
		$this->load->view('include/footer',$this->data);
	}

	public function renewalhistory(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['renewdocarr'] = $this->university_model->get_renewdocs($this->session->userdata('uniid'));
		
		
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('renewalhistory',$data);
		$this->load->view('include/footer',$this->data);
	}
	function viewcertificate(){
		$docid = $this->input->post('docid');
		$data['result'] = $this->university_model->get_certificate($this->session->userdata('uniid'),$docid);
		$this->load->view('schoolcertificate_preview',$data);
	}
	public function purchaselist(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['paymentarr'] = $this->university_model->get_paymenthistory($this->session->userdata('uniid'));
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('purchaselist',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function getreceipt(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$id = $this->input->post('id');
		$data['details'] = $this->university_model->get_one_receipt_details($id);
		$this->load->view('receipt_view',$data);
	}
	public function setting(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		if($this->input->post('submit')){
			$this->form_validation->set_rules('chairman', 'chairman', 'required');
			$this->form_validation->set_rules('qualification', 'qualification', 'required');
			$this->form_validation->set_rules('chairposition', 'position', 'required');
			if ($this->form_validation->run() == TRUE) {
				$update = array();
				$update['chairman'] 		= $this->input->post('chairman');
				$update['qualification'] 	= $this->input->post('qualification');
				$update['chairposition'] 	= $this->input->post('chairposition');
				$this->university_model->updateuniversity($update,$this->session->userdata('uniid'));
				$this->session->set_flashdata('item', array('message' => 'Successfully updated.','class' => 'alert-success'));
				
				redirect(base_url('university/university/setting'), 'refresh');
			}else{
				validation_errors();
			}
		}
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('setting',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function changepassword(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		if($this->input->post('submit')){
			$this->form_validation->set_rules('old_password', 'Current Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required');
			$this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required');
			if ($this->form_validation->run() == TRUE) {
				$fetchPassword = $this->university_model->fetchPassword($this->session->userdata('uniid')); 
				//$fetchPassword->university_password;
				//print_r($fetchPassword); exit;
				if($fetchPassword->university_password != $this->input->post('old_password')){
					$this->session->set_flashdata('item', array('message' => 'Old password not matched.','class' => 'alert-danger'));
				}
				elseif($this->input->post('new_pass') != $this->input->post('conf_pass')){
					$this->session->set_flashdata('item', array('message' => 'Confirm password not matched.','class' => 'alert-danger'));
				}else{
					$updatepass = array();
					$updatepass['university_password'] = $this->input->post('conf_pass');
					$this->university_model->updatePassword($updatepass,$this->session->userdata('uniid'));
					$this->session->set_flashdata('item', array('message' => 'New password successfully updated.','class' => 'alert-success'));
				}
				redirect(base_url('university/university/changepassword'), 'refresh');
			}else{
				validation_errors();
			}
		}
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('changepassword',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function graduate(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['grduatelistingarr'] = $this->university_model->get_graduates($this->session->userdata('uniid')); 
		$data['grduatationdatearr'] = $this->university_model->get_graducation_date($this->session->userdata('uniid')); 
		$data['grduatelistingsubmitedarr'] = $this->university_model->get_graduates_submited($this->session->userdata('uniid')); 
		$data['grduatelistingsubmitedcountarr'] = $this->university_model->get_graduates_submited_count($this->session->userdata('uniid')); 
		$data['grduatationsubmiteddatearr'] = $this->university_model->get_graducation_submited_date($this->session->userdata('uniid')); 
		
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board','page_title'=> 'Graduates Listing for Submission');
		$this->load->view('include/header',$this->data);
		$this->load->view('graduate',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function delete_graducate($id){
		$deleted = $this->university_model->delete_graducate($id,$this->session->userdata('uniid'));
		if($deleted){
			$this->session->set_flashdata('item', array('message' => 'Successfully deleted.','class' => 'alert-success'));
		}else{
			$this->session->set_flashdata('item', array('message' => 'Not deleted please try again.','class' => 'alert-danger'));
		}
		redirect(base_url('university/university/graduate'), 'refresh');
	}
	public function notification_read_status(){
		$uninot_id = $_POST['uninot_id'];
		//$this->university_model->update_notifications($this->session->userdata('uniid'),array('read_status'=>'1','uninot_id'=>$uninot_id));
		$this->university_model->update_notifications($uninot_id,array('read_status'=>'1'));
		echo 'alert'; exit;
	}
	public function notification(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		
		$data['get_notifications'] = $this->university_model->get_notifications($this->session->userdata('uniid'),'0'); 
		$data['get_notifications_read'] = $this->university_model->get_notifications($this->session->userdata('uniid'),'1'); 
		
		//$this->university_model->update_notifications($this->session->userdata('uniid'),array('read_status'=>'1'));
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('notification',$data);
		$this->load->view('include/footer',$this->data);
	}public function notification_details($id){
		
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$this->university_model->update_notifications($id,array('read_status'=>'1'));
		$data['notification_details'] = $this->university_model->get_notification_details($this->session->userdata('uniid'),$id);
		
		//$this->university_model->update_notifications($this->session->userdata('uniid'),array('read_status'=>'1'));
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('notification_details',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function terms(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['get_terms'] = $this->university_model->get_terms();
		
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('terms',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function tutorial(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['get_tutorial'] = $this->university_model->get_tutorial();
		
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('tutorial',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function examcodegraduate(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['grduatelistingarr'] = $this->university_model->get_graduatesexamcode($this->session->userdata('uniid'));
		$data['grduatationdatearr'] = $this->university_model->get_graducation_exam_date($this->session->userdata('uniid'));
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('examcodegraduate',$data);
		$this->load->view('include/footer',$this->data);
	}
	
	public function graducateform($id = false){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		if($id){
			$data['editdata'] = $this->university_model->editgraducationdetails($id);
		}
		if($this->input->post('submittype')=='submit' || $this->input->post('submittype')=='next'){
			//echo $this->input->post('submit');
			//print_r($_POST); exit;
			$this->form_validation->set_rules('student_name', 'first name', 'trim|required');
			$this->form_validation->set_rules('name_of_school', 'name of School', 'trim|required');
			$this->form_validation->set_rules('dob', 'date of birth', 'trim|required');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required');
			if($this->input->post('grad_id')){
				$this->form_validation->set_rules('email', 'email', 'trim|required');
			}else{
				$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[graduates.email]');
				if($_FILES["photo"]['name'] ==""){
					$this->form_validation->set_rules('photo', 'photo', 'trim|required');
				}
			}
			//$this->form_validation->set_rules('year_of_graduated', 'year of graduated', 'trim|required');
			$this->form_validation->set_rules('date_of_graduated', 'date of graduated', 'trim|required');
			$this->form_validation->set_rules('college_of', 'college of', 'trim|required');
			//$this->form_validation->set_rules('validity', 'validity', 'trim|required');
			//$this->form_validation->set_rules('examcode', 'exam code', 'trim|required');
			//$this->form_validation->set_rules('photo', 'photo', 'trim|required');
			if($this->form_validation->run() == TRUE){
				// image photo				
			$diploma = '';
			$official_transcription = '';
			$photo = '';
			
			if(isset($_FILES["diploma"]) && !empty($_FILES["diploma"]['name'])){	  	  //$this->load->library('upload', $config);	
				$this->load->library('upload');			
				$config['upload_path'] 		= './assets/images/graduates/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["diploma"]["name"]);        
				$diploma 						= 'diploma_'.time().'.'.end($ext);
				$config['file_name'] 		= $diploma;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('diploma')){
					$error = array('error' => $this->upload->display_errors());
					//print_r($error); exit;
				}  
				$diploma = $diploma;
				if($this->input->post('old_photo')){
					$file = "./assets/images/graduates/".$this->input->post('old_diploma');
					unlink($file);
				}
			}else{
				$diploma = $this->input->post('old_diploma');
			}
			if(isset($_FILES["official_transcription"]) && !empty($_FILES["official_transcription"]['name'])){	  	  //$this->load->library('upload', $config);	
				$this->load->library('upload');			
				$config['upload_path'] 		= './assets/images/graduates/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["official_transcription"]["name"]);        
				$official_transcription 		= 'official_transcription_'.time().'.'.end($ext);
				$config['file_name'] 		= $official_transcription;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('official_transcription')){
					$error = array('error' => $this->upload->display_errors());
					//print_r($error); exit;
				}  
				$official_transcription = $official_transcription;
				if($this->input->post('old_official_transcription')){
					$file = "./assets/images/graduates/".$this->input->post('old_official_transcription');
					unlink($file);
				}
			}else{
				$photo = $this->input->post('old_official_transcription');
			}
			if(isset($_FILES["photo"]) && !empty($_FILES["photo"]['name'])){	  	  //$this->load->library('upload', $config);	
				$this->load->library('upload');			
				$config['upload_path'] 		= './assets/images/graduates/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["photo"]["name"]);        
				$photo 						= 'graducate_'.time().'.'.end($ext);
				$config['file_name'] 		= $photo;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo')){
					$error = array('error' => $this->upload->display_errors());
					//print_r($error); exit;
				}  
				$photo = $photo;
				if($this->input->post('old_photo')){
					$file = "./assets/images/graduates/".$this->input->post('old_photo');
					unlink($file);
				}
			}else{
				$photo = $this->input->post('old_photo');
			}
			
		// end photo upload
			$graducationdata 					= array();
			$graducationdata['student_name']  	= $this->input->post('student_name');
			$graducationdata['middle_name']  	= $this->input->post('middle_name');
			$graducationdata['surname']  		= $this->input->post('surname');
			$graducationdata['name_of_school']	= $this->input->post('name_of_school');
			$graducationdata['dob']    			= $this->input->post('dob');
			$graducationdata['gender']			= $this->input->post('gender');
			$graducationdata['email']			= $this->input->post('email');
			$graducationdata['year_of_graduated'] = $this->input->post('year_of_graduated');
			$graducationdata['date_of_graduated'] = $this->input->post('date_of_graduated');
			$graducationdata['college_of'] 		= $this->input->post('college_of');			
			$graducationdata['uniid']			= $this->session->userdata('uniid');	
			$graducationdata['official_transcription']			= $official_transcription;
			$graducationdata['diploma']			= $diploma;
			$graducationdata['photo']			= $photo;
				//$data['status']		= '1';
				//echo '<pre>'; print_r($data); exit;
				if($this->input->post('grad_id')){
					$graducationdata['modified_at'] = date('Y-m-d H:i:s');
					$grduactid = $this->university_model->updategraducates($graducationdata,$this->input->post('grad_id'));
					$this->session->set_flashdata('item', array('message' => 'Updated successfully','class' => 'alert-success'));
				}else{
					$graducationdata['added_at']		= date('Y-m-d H:i:s');
					$grduactid = $this->university_model->insertgraducates($graducationdata);
					$this->session->set_flashdata('item', array('message' => 'Added successfully','class' => 'alert-success'));
				}
				
				if($grduactid){
					if($this->input->post('submittype') == 'next'){
						redirect(base_url('university/university/graducateform'), 'refresh');
					}else{
						redirect(base_url('university/university/graduate'), 'refresh');
					}
				}
			}else{
				validation_errors();
			}
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		
		$data['collegeofArr'] = $this->university_model->get_collegeof();
		$data['schoollistarr'] = $this->university_model->get_schoollist($this->session->userdata('uniid'));
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('graducateform',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function editprofile(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['editdata'] = $this->university_model->edituniversitydetails($this->session->userdata('uniid'));
		
		if($this->input->post('submit')=='submit'){
			//echo $this->input->post('submit');
			//print_r($_POST); exit;
			//$this->form_validation->set_rules('university_name', 'university name', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');
			$this->form_validation->set_rules('contact_no', 'contact no', 'trim|required');
			$this->form_validation->set_rules('name_of_representative', 'name of representative', 'trim|required');
			$this->form_validation->set_rules('position', 'position', 'trim|required');
			//$this->form_validation->set_rules('business_license_number', 'business license number', 'trim|required');
			
			//$this->form_validation->set_rules('photo', 'photo', 'trim|required');
			if($this->form_validation->run() == TRUE){
				// image upload				
					$college_logo = '';
					if(isset($_FILES["college_logo"]) && !empty($_FILES["college_logo"]['name'])){				
						$config['upload_path'] 		= './assets/images/graduates/';
						//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
						$config['allowed_types'] 	= '*';
						//$config['max_size'] 		= '200000';
						//$config['max_width']  	= '1500';
						//$config['max_height']  	= '800';        
						$ext 						= explode('.',$_FILES["college_logo"]["name"]);        
						$college_logo 				= 'uni_'.time().'.'.end($ext);
						$config['file_name'] 		= $college_logo;
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('photo'))
						{
						$error = array('error' => $this->upload->display_errors());                       
							//print_r($error); exit;
						}  
						$college_logo = $college_logo;
					}else{
						$college_logo = $this->input->post('old_college_logo');
					}
					
				// end image upload
				$univerdata 						= array();
				//$univerdata['university_name']  	= $this->input->post('university_name');
				$univerdata['address']  			= $this->input->post('address');
				$univerdata['contact_no']  			= $this->input->post('contact_no');
				$univerdata['name_of_representative']  = $this->input->post('name_of_representative');
				$univerdata['position']  				= $this->input->post('position');
				//$univerdata['business_license_number']  = $this->input->post('business_license_number');
				$univerdata['college_logo']				= $college_logo;
				//$data['status']		= '1';
				//echo '<pre>'; print_r($data); exit;
				$grduactid = $this->university_model->updateuniversity($univerdata,$this->session->userdata('uniid'));
				if($grduactid){
					$this->session->set_flashdata('item', array('message' => 'Updated successfully','class' => 'alert-success'));
					redirect(base_url('university/university/editprofile'), 'refresh');
				}
			}else{
				validation_errors();
			}
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));	
		$data['universitydocument'] = $this->university_model->universitydocumentdetails($this->session->userdata('uniid'));
		$data['collegeofArr'] = $this->university_model->get_collegeof();
		$data['schoollistarr'] = $this->university_model->get_schoollist($this->session->userdata('uniid'));
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('editprofile',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function school(){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		$data['schoollistingarr'] = $this->university_model->get_schoolisting($this->session->userdata('uniid'));
		//$data['universitydetailsarr'] = $this->university_model->universitydetails(1);
		//print_r($data['universitydetailsarr']);
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('school',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function schoolform($id = false){
		if(!$this->session->userdata('university_logged_in')){
			redirect(base_url('login'), 'refresh');
		}
		if($id){
			$data['editdata'] = $this->university_model->schooldetails($id);
		}
		if($this->input->post('submit')=='submit'){
			//echo $this->input->post('submit');
			//print_r($_POST); exit;
			$this->form_validation->set_rules('school_name', 'school name', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');
			$this->form_validation->set_rules('contact_number', 'contact number', 'trim|required');
			if($this->input->post('sch_id')){
				$this->form_validation->set_rules('email', 'email', 'trim|required');
			}else{
				$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tbl_schools.email]');
				if($_FILES["logo"]['name'] ==""){
					$this->form_validation->set_rules('logo', 'logo', 'trim|required');
				}
			}
			$this->form_validation->set_rules('website', 'website', 'trim|required');
			$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');
			$this->form_validation->set_rules('position', 'position', 'trim|required');
			$this->form_validation->set_rules('accreditation_number', 'accreditation number', 'trim|required');
			$this->form_validation->set_rules('date_issued', 'date issued', 'trim|required');
			$this->form_validation->set_rules('validity_date', 'validity date', 'trim|required');
			if($this->form_validation->run() == TRUE){
			// image upload				
			$logo = '';
			if(isset($_FILES["logo"]) && !empty($_FILES["logo"]['name'])){	  	  //$this->load->library('upload', $config);	
				$this->load->library('upload');			
				$config['upload_path'] 		= './assets/images/school/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["logo"]["name"]);        
				$logo 						= 'school_'.time().'.'.end($ext);
				$config['file_name'] 		= $logo;
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('logo'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$logo = $logo;
				if($this->input->post('old_logo')){
					$file = "./assets/images/school/".$this->input->post('old_logo');
					unlink($file);
				}
			}else{
				$logo = $this->input->post('old_logo');
			}
			
		// end image upload
				$schooldata 			= array();
				$schooldata['uniid']			= $this->session->userdata('uniid');
				$schooldata['school_name']  	= $this->input->post('school_name');
				$schooldata['address']  		= $this->input->post('address');
				$schooldata['contact_number'] = $this->input->post('contact_number');
				$schooldata['email']			= $this->input->post('email');				
				$schooldata['contact_person']	= $this->input->post('contact_person');				
				$schooldata['position']		= $this->input->post('position');				
				$schooldata['accreditation_number'] = $this->input->post('accreditation_number');	
				$schooldata['date_issued']	= $this->input->post('date_issued');			
				$schooldata['website']		= $this->input->post('website');			
				$schooldata['validity_date']	= $this->input->post('validity_date');
				$schooldata['logo']			= $logo;				
				$schooldata['status']			= '1';
				//echo '<pre>'; print_r($schooldata); exit;
				if($this->input->post('sch_id')) {
					$schooldata['modified_at'] = date('Y-m-d H:i:s');
					$grduactid = $this->university_model->updateschool($schooldata,$this->input->post('sch_id'));
					$this->session->set_flashdata('item', array('message' => 'Updated successfully','class' => 'alert-success'));
				}else{
					$schooldata['added_at']		= date('Y-m-d H:i:s');
					$grduactid = $this->university_model->insertschool($schooldata);
					$this->session->set_flashdata('item', array('message' => 'Add successfully','class' => 'alert-success'));
				}
				if($grduactid){
					redirect(base_url('university/university/school'), 'refresh');
				}
			}else{
				validation_errors();
			}
		}
		$data['universitydetailsarr'] = $this->university_model->universitydetails($this->session->userdata('uniid'));
		$this->data = array('title'=> 'Welcome in Regulatory Board');
		$this->load->view('include/header',$this->data);
		$this->load->view('schoolform',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function logout() {
		/* $sess_array = array(
					'userid' => $this->input->post('userid'),
					'fullname' => $this->input->post('fullname'),
					'email' => $this->input->post('email'),
		); */
		
		$this->session->unset_userdata('uniid', $this->session->userdata('uniid'));
		$this->session->unset_userdata('university_name', $this->session->userdata('university_name'));
		$this->session->unset_userdata('college_of', $this->session->userdata('college_of'));
		$this->session->unset_userdata('email', $this->session->userdata('email'));
		$this->session->unset_userdata('contact_no', $this->session->userdata('contact_no'));
		$this->session->unset_userdata('university_logged_in', $this->session->userdata('university_logged_in'));
		//exit;
		//redirect(base_url(), 'refresh');
		//redirect(base_url('login'), 'refresh');
		redirect(base_url('login'), 'refresh');
	}
	
	public function graduatedetailsforpopup(){
		
		$docid = $_POST['docid'];
		$graduatedetails = $this->university_model->graducationdetails($docid);
		
		$examcode = ($graduatedetails->examcode !="")?$graduatedetails->examcode:'N/A';
		$photo = (file_exists('./assets/images/graduates/'.$graduatedetails->photo))?base_url('assets/images/graduates/'.$graduatedetails->photo):base_url('assets/images/user_icon.png');
		$diploma = (file_exists('./assets/images/graduates/'.$graduatedetails->diploma))?base_url('assets/images/graduates/'.$graduatedetails->diploma):'';
		$otr = (file_exists('./assets/images/graduates/'.$graduatedetails->official_transcription))?base_url('assets/images/graduates/'.$graduatedetails->official_transcription):'';
		echo '<div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <img align="center" width="200" height="200" src="'.$photo.'">    
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
                                <label for="field-1" class="control-label">School:</label>
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
                                <label for="field-1" class="control-label">Exam Code</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-8">'.$examcode.'</div>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Diploma</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-8"><a href="'.$diploma.'" target="t_blank">View</a></div>
                            </div>                           
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">OTR</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-8"><a href="'.$otr.'" target="t_blank">View</a></div>
                            </div>                           
                        </div>
                    </div>';
	}
}

?>