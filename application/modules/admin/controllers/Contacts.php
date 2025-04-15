<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Contacts extends MX_Controller {


	var $data = array();

 

	public function __construct(){
		parent:: __construct();
		$this->load->model('Contact_model','contact');
	}
	public function index()
	{		

		
		$this->data = array(

				'title' => 'Govt : Notification',

				'page_title' => 'Notification',

				'table_name' => 'Notification'

			);

		//$where  = array('status'=>1);
		$where  = array('subject'=>'');
		$this->db->order_by('cont_id','DESC');
		$this->data['contact_listing'] = $this->contact->get_result_array('tbl_contact','','',$where);


		

		//echo "<pre>"; print_r($this->data); exit;
		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/contact_us/listing',$this->data);

		$this->load->view('admin/common/footer');

	}
	public function message_to_all(){
		$csubject = $_POST['csubject'];
		$recipient = $_POST['recipient'];
		$otheremail = $_POST['otheremail'];
		$message = $_POST['message'];
		$count = 0;
		$AllCommonArr = array();
		if($recipient == 'L'){	////----------for Local Professional---------
			$recipient_details = $this->contact->professionals('L');
			$AllCommonArr = $recipient_details;
		}
		if($recipient == 'F'){	////----------for Foreign Professional for registration---------
			$recipient_details = $this->contact->professionals('F');
			$AllCommonArr = $recipient_details;
		}
		if($recipient == 'P'){	////----------for Foreign Professional for examination---------
			$recipient_details = $this->contact->professionals('P');
			$AllCommonArr = $recipient_details;
		}
		if($recipient == 'GRA'){	////----------for Graduates---------
			$recipient_details = $this->contact->graduateslist();
			$AllCommonArr = $recipient_details;
		}
		if($recipient == 'SCH'){	////----------for university---------
			$recipient_details = $this->contact->universitylist();
			$AllCommonArr = $recipient_details;
		}
		if($recipient == 'CEP'){	////----------for ce provider---------
			$recipient_details = $this->contact->ceplist();
			$AllCommonArr = $recipient_details;
		}
		if($recipient == 'others'){	////----------for others---------
			$AllCommonArr[] = array(
				'email' => $otheremail,
				'otheremail' => '1',
			);
			$AllCommonArr = json_decode(json_encode($AllCommonArr));
		}
		//print_r($AllCommonArr);exit;
	if(!empty($AllCommonArr)){
		$count = 0;
	foreach($AllCommonArr as $list){
		$fullname = '';
		if(isset($list->role)){
			$fullname = $list->fname.' '.$list->lname.' '.$list->name;
		}
		if(isset($list->grad_id)){
			$fullname = $list->student_name.' '.$list->middle_name.' '.$list->surname;
		}
		if(isset($list->uniid)){
			$fullname = $list->name_of_representative;
		}
		if(isset($list->provider_id)){
			$fullname = $list->business_name;
		}
		if(isset($list->otheremail)){
			$fullname = $list->email;
		}
		$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">'.$message.'</p>';
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
				$subject = 'Reply From RBoard - '.$csubject;
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($list->email);
				$this->email->subject($subject);
				$emailbody1 = array();
				$emailbody1['name'] = $fullname;
				$emailbody1['thanksname'] 	= $settingarr->signature_name;
				$emailbody1['thanks2'] 		= '';
				$emailbody1['thanks3'] 		= $settingarr->position;
				$emailbody1['body_msg'] = $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$sent = $this->email->send();
				if($sent){
					$count++;		
				}
			}
			}
			if($count > 0){
				echo 'Message sent successfully.';
			}else{
				echo 'Message not sent please try again.';
			}
				//end send refrence code 
			exit;
	}
	public function messageview(){
		$cont_id=$_POST['schid'];
		$messagedetails = $this->contact->get_one_message($cont_id);
		//print_r($messagedetails);
		$data['status']='1';
		$this->contact->update_to_read($cont_id, $data);
		echo'<div class="table-responsive">
				<table class="table table-bordered" id="dataTable_4" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Name</th>
							<td>'.$messagedetails->name.'</td>
						</tr>
						<tr>
							<th>Email</th>
							<td>'.$messagedetails->email.'</td>
						</tr>
						<tr>
							<th>Subject</th>
							<td>'.$messagedetails->subject.'</td>
						</tr>
						<tr>
							<th>Message</th>
							<td>'.$messagedetails->message.'</td>
						</tr>
					</thead>
				</table>
			</div>';
			
	}
	public function messagereply(){
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
				$subject = 'Reply From RBoard - '.$_POST['subject'];
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($_POST['email']);
				$this->email->subject($subject);
				$emailbody1 = array();
				$emailbody1['name'] = $_POST['name'];
				$emailbody1['thanksname'] 	= $settingarr->signature_name;
				$emailbody1['thanks2'] 		= '';
				$emailbody1['thanks3'] 		= $settingarr->position;
				$emailbody1['body_msg'] = $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody1,  TRUE);			
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$sent = $this->email->send();
				if($sent){
					echo 'Message sent successfully.';		
				}else{
					echo 'Message not sent please try again.';
				}
				//end send refrence code 
			exit;
	}
}