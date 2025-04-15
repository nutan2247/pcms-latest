<?php defined('BASEPATH') OR exit('No direct script access allowed');

class University_model extends CI_Model {
	private $universityTbl;
	private $graduatesTbl;
	private $professionTbl;
	private $schoolTbl;
	private $tutorialTbl;
	private $notificationTbl;
	private $certificatepriceTbl;
	private $termsconditionsTbl;
	private $universitydocumentsTbl;
	private $paymenttransactionlTbl;
	private $universitynotificationsTbl;
	private $graduatesreviewercommentTbl;
	function __construct(){
		$this->universityTbl 	= 'tbl_university';
		$this->graduatesTbl 	= 'graduates';
		$this->professionTbl 	= 'tbl_profession';
		$this->schoolTbl 		= 'tbl_schools';
		$this->tutorialTbl 		= 'tbl_tutorial';
		$this->notificationTbl 	= 'tbl_university_notifications';
		$this->certificatepriceTbl 			= 'tbl_certificate_price';
		$this->termsconditionsTbl  			= 'tbl_terms_conditions';
		$this->universitydocumentsTbl 		= 'tbl_university_documents';
		$this->paymenttransactionlTbl 		= 'tbl_payment_transaction';
		$this->universitynotificationsTbl 	= 'tbl_university_notifications';
		$this->graduatesreviewercommentTbl	= 'tbl_graduates_reviewer_comment';
	}
	
	function updateuniversity($data, $id){		
		$this->db->where('uniid', $id);
		$this->db->update($this->universityTbl, $data);
		// echo $this->db->last_query(); die;	
		return true;
	}
	function tempgraducatepaymentid($data, $id){		
		$this->db->where('grad_id', $id);
		$this->db->update($this->graduatesTbl, $data);
		// echo $this->db->last_query(); die;	
		return true;
	}
	function insertuniversity($memberdata){
		//print_r($memberdata); exit;
		$this->db->insert($this->universityTbl, $memberdata);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
		
	}
	function insertnotifications($memberdata){
		//print_r($memberdata); exit;
		$this->db->insert($this->notificationTbl, $memberdata);
		// echo $this->db->last_query(); die;
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
		
	}
	function insertgraducates($memberdata){
		//print_r($memberdata); exit;
		$this->db->insert($this->graduatesTbl, $memberdata);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
		
	}	
	function insertschool($memberdata){
		//print_r($memberdata); exit;
		$this->db->insert($this->schoolTbl, $memberdata);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
		
	}
	function updateschool($data, $id = false){		
		if($id){
			$this->db->where('sch_id', $id);
		}		
		//$this->db->set($data);
		$this->db->update($this->schoolTbl, $data);
		// echo $this->db->last_query(); die;
		return true;
	}
	function updategraducates($data, $id = false){		
		if($id){
			$this->db->where('grad_id', $id);
		}		
		//$this->db->set($data);
		$this->db->update($this->graduatesTbl, $data);
		// echo $this->db->last_query(); die;
		return true;
	}
	function universitylogin($username,$password){
			//echo $userarr['email'];
			//print_r($userarr); exit;
			$this->db->from($this->universityTbl);
			//$this->db->where(array('student_email'=>$student_email,'student_password'=>$student_password));
			$this->db->where('university_password', $password);
			$this->db->group_start(); // Open bracket
			$this->db->where('email', $username);
			//$this->db->or_where('contact_no', $student_email);
			$this->db->group_end(); // Close bracket
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function universitydetails($uniid){
			//echo $userarr['email'];
			//print_r($userarr); exit;
			$this->db->select('u.*,p.name collegeofname,count(g.grad_id) total_graducates');
			$this->db->from($this->universityTbl.' u');
			$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');
			$this->db->join($this->graduatesTbl.' g', 'u.uniid=g.uniid','left');
			//$this->db->where(array('student_email'=>$student_email,'student_password'=>$student_password));
			$this->db->where('u.uniid', $uniid);
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function universitypaymentdetails($unidocid, $uniid){
		$this->db->from($this->paymenttransactionlTbl);
		$this->db->where('user_id', $uniid);
		$this->db->where('doc_refrence_id', $unidocid);
		$this->db->where('payment_for', 'U');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row();
				return $result;		
			}
			return false;	
	}
	public function get_terms(){
			$this->db->from($this->termsconditionsTbl);
			$this->db->where('type', 'school');
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;	
			
		}
	public function get_tutorial(){
			$this->db->from($this->tutorialTbl);
			$this->db->where('type', 'school');
			// $this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->result_object();
					return $result;		
				}
				return false;	
			
		}
	public function universitydocumentdetails($uniid){
			//echo $userarr['email'];
			//print_r($userarr); exit;
			$this->db->select('ud.*,u.university_name,u.address');
			$this->db->from($this->universitydocumentsTbl.' ud');
			$this->db->join($this->universityTbl.' u', 'u.uniid=ud.uniid','left');
			$this->db->where('ud.uniid', $uniid);
			$this->db->where('ud.reviewer_status', '1');
			$this->db->order_by('ud.unidoc_id', 'desc');
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}	
	public function universitydocdetails($unidoc_id,$uniid,$document_for){
			//echo $userarr['email'];
			//print_r($userarr); exit;
			$this->db->select('ud.*, u.uniid,p.name collegeofname');
			$this->db->from($this->universitydocumentsTbl.' ud');
			$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
			$this->db->join($this->professionTbl.' p', 'u.college_of=p.id','left');			
			//$this->db->where(array('student_email'=>$student_email,'student_password'=>$student_password));
			$this->db->where('ud.unidoc_id', $unidoc_id); 
			$this->db->where('ud.document_for',$document_for);
			if($uniid !=""){
			$this->db->where('ud.uniid',$uniid);
			}
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
		public function get_email_notification($uniid){
			$this->db->select('un.*');
			$this->db->from($this->universitynotificationsTbl.' un');
			$this->db->where('un.uniid', $uniid);
			$this->db->order_by('un.uninot_id', 'desc');
			$this->db->limit(1);
			$q = $this->db->get();
			$result = $q->row();
			return $result;
		}
	public function schooldetails($sch_id){
			
			$this->db->from($this->schoolTbl);	
			$this->db->where('sch_id', $sch_id);
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function editgraducationdetails($grad_id){
			
			$this->db->from($this->graduatesTbl);	
			$this->db->where('grad_id', $grad_id);
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function graducationdetails($grad_id){
			
			$this->db->from($this->graduatesTbl);	
			$this->db->where('grad_id', $grad_id);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;	
			
		}
	public function graducationrefrence($refrence_code){
			
			$this->db->from($this->graduatesTbl);	
			$this->db->where('refrence_code', $refrence_code);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			//$result = $query->row_object();
			//echo $this->db->last_query(); exit;
			return $result;
			
		}
	
	public function edituniversitydetails($uniid){			
			$this->db->from($this->universityTbl);	
			$this->db->where('uniid', $uniid);
			$this->db->limit(1);
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
				$result = $query->row_object();
					return $result;		
				}
				return false;			
	}
	public function updatePassword($data, $id){		
		$this->db->where('uniid', $id);
		$this->db->update($this->universityTbl, $data);
		//echo $this->db->last_query(); die;	
		return true;			
	}
	public function insert_payment($data){
		$this->db->insert($this->paymenttransactionlTbl, $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function uploadeuniversityrenewdoc($data){
		$this->db->insert($this->universitydocumentsTbl, $data);
		//echo $this->db->last_query(); die;
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function updatedocumentrenewdate($data, $id){		
		$this->db->where('unidoc_id', $id);
		$this->db->update($this->universitydocumentsTbl, $data);
		//echo $this->db->last_query(); die;	
		return true;
	}
	public function fetchPassword($uniid){	
		$this->db->select('university_password');
		$this->db->from($this->universityTbl);	
		$this->db->where('uniid', $uniid);
		$this->db->limit(1);
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->row_object();
				return $result;		
			}
			return false;			
	}
	public function get_paymenthistory($uniid){
		//$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->paymenttransactionlTbl.' p');
		//$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		$this->db->where('p.user_id', $uniid);
		//$this->db->where('p.payment_for', 'U');
		//$this->db->or_where('p.payment_for', 'G');
		//$this->db->where("FIND_IN_SET('p.payment_for','U,G')",null,false);
		$this->db->where_in('p.payment_for',array('U','G'));
		$this->db->order_by('p.payment_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_one_receipt_details($id){
		$this->db->select("pt.*");
		$this->db->from($this->paymenttransactionlTbl. ' pt');
		// $this->db->join($this->cepTbl .' as t2','t2.provider_id=t1.provider_id','inner');
		$this->db->where('pt.payment_id',$id);
				
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;

	}
	public function get_renewdocs($uniid){
		$this->db->select('ud.*,pt.payment_id,pt.doc_refrence_id,pt.txn_id,pt.payment_amout,pt.payment_tax,pt.payment_gross,payment_status,pt.payment_type,pt.payment_date');
		$this->db->from($this->universitydocumentsTbl.' ud');
		$this->db->join($this->paymenttransactionlTbl.' pt', 'ud.unidoc_id=pt.doc_refrence_id');
		$this->db->where('ud.uniid', $uniid);
		// $this->db->where('ud.document_for', 'r');
		$this->db->where('pt.payment_for', 'U');
		$this->db->where_in('pt.payment_type',array('N','R'));
		$this->db->order_by('ud.unidoc_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_certificate($uniid,$unidoc_id=null){
		$this->db->select('ud.*,u.university_name,u.address,pt.payment_id,pt.doc_refrence_id,pt.txn_id,pt.payment_amout,pt.payment_tax,pt.payment_gross,payment_status,pt.payment_type,pt.payment_date');
		$this->db->from($this->universitydocumentsTbl.' ud');
		$this->db->join($this->universityTbl.' u', 'ud.uniid=u.uniid');
		$this->db->join($this->paymenttransactionlTbl.' pt', 'ud.unidoc_id=pt.doc_refrence_id');
		$this->db->where('ud.uniid', $uniid);
		if($unidoc_id > 0){
		$this->db->where('ud.unidoc_id', $unidoc_id);	
		}
		$this->db->where('ud.accreditation_number!=', '');
		$this->db->where('pt.payment_for', 'U');
		$this->db->order_by('ud.unidoc_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); 
		//exit;
		return $result;		
	}
	public function certificateCharges($chargefor){
		//$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->certificatepriceTbl);
		$this->db->where('charges_for', $chargefor);
		$this->db->order_by('duration', 'asc');		
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function getunicertificatecharge($chargeid,$charges_for){
		//$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->certificatepriceTbl);
		$this->db->where('pri_id', $chargeid);
		$this->db->where('charges_for', $charges_for);
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;		
	}
	public function get_graduatesforlicence($uniid){
		$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		$this->db->where('g.refrence_code', '');
		$this->db->where('g.uniid', $uniid);
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_graducation_date($uniid){
		$this->db->select('date_of_graduated');
		$this->db->from($this->graduatesTbl);
		$this->db->where('uniid', $uniid);
		$this->db->where('refrence_code', '');
		$this->db->where('examcode', '');			
		$this->db->group_by('date_of_graduated');
		$this->db->order_by('date_of_graduated','desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;
		
	}
	public function get_graduates($uniid){
		$name 			= (isset($_GET['name']))?$_GET['name']:'';
		$graduate_date 	= (isset($_GET['graduate_date']))?$_GET['graduate_date']:'';
		$allrecord 		= (isset($_GET['all']))?$_GET['all']:'';
		$for 			= (isset($_GET['for']))?$_GET['for']:'';
		
		$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');	
		if($for == 'g'){
			if($name !=""){
				$this->db->like('g.student_name', trim($name),'before');
				$this->db->or_like('g.middle_name', trim($name),'before');
				$this->db->or_like('g.surname', trim($name),'before');
			}
			if($graduate_date !=""){
				$this->db->where('g.date_of_graduated', trim($graduate_date));
			}	
		}
		$this->db->where('g.uniid', $uniid);
		$this->db->where('g.refrence_code', '');
		$this->db->where('g.examcode', '');
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_graducation_submited_date($uniid){
		$this->db->select('date_of_graduated');
		$this->db->from($this->graduatesTbl);
		$this->db->where('uniid', $uniid);
		$this->db->where('refrence_code !=', '');	
		$this->db->where('reviewer_status >', '0');		
		$this->db->group_by('date_of_graduated');
		$this->db->order_by('date_of_graduated','desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		//$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;
		
	} 
	public function get_graduates_submited_count($uniid){
		$this->db->select('g.*,p.name collegeofname,gc.reviewed_at');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->graduatesreviewercommentTbl.' gc', 'g.grad_id=gc.grad_id','left');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');	
		$this->db->where('g.uniid', $uniid);
		$this->db->where('g.refrence_code !=', '');
		//$this->db->where('g.examcode', '');
		
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}public function get_graduates_submited($uniid){
		$name 			= (isset($_GET['name']))?$_GET['name']:'';
		$graduate_date 	= (isset($_GET['graduate_date']))?$_GET['graduate_date']:'';
		$allrecord 		= (isset($_GET['all']))?$_GET['all']:'';
		$for 			= (isset($_GET['for']))?$_GET['for']:'';
		$tab 			= (isset($_GET['tab']))?$_GET['tab']:'';
		
		$this->db->select('g.*,p.name collegeofname,gc.reviewed_at');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->graduatesreviewercommentTbl.' gc', 'g.grad_id=gc.grad_id','left');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');	
		if($for == 'gs'){	
			if($name !=""){
				$this->db->like('g.student_name', trim($name),'before');
				$this->db->or_like('g.middle_name', trim($name),'before');
				$this->db->or_like('g.surname', trim($name),'before');
			}
			if($graduate_date !=""){
				$this->db->where('g.date_of_graduated', trim($graduate_date));
			}
		}
		if($tab == 'approved'){
			$this->db->where('g.reviewer_status', '1');
		}
		else if($tab == 'rejected'){
			$this->db->where('g.reviewer_status', '2');
		}else{
			$this->db->where('g.reviewer_status >', '0');
		}
		$this->db->where('g.uniid', $uniid);
		$this->db->where('g.refrence_code !=', '');
		//$this->db->where('g.examcode', '');
		
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}public function get_graduates_temporderid($temp_order_id){
		$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		$this->db->where('g.temp_order_id', $temp_order_id);
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_notifications($uniid,$read_status){
		$this->db->from($this->universitynotificationsTbl);
		$this->db->where('uniid', $uniid);
		//if($read_status == 1){
			$this->db->where('read_status', $read_status);
		//}
		$this->db->order_by('uninot_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_notification_details($uniid,$uninot_id){
		$this->db->from($this->universitynotificationsTbl);
		$this->db->where('uniid', $uniid);
		if($uninot_id > 0){
			$this->db->where('uninot_id', $uninot_id);
		}
		$query = $this->db->get();
		$result = $query->row_object();
		//echo $this->db->last_query(); exit;
		return $result;		
	}
	public function get_unread_notifications($uniid){
		$this->db->from($this->universitynotificationsTbl);
		$this->db->where('uniid', $uniid);
		$this->db->where('read_status <', '1');
		$this->db->order_by('uninot_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function update_notifications($uninot_id,$data){
		$this->db->where('uninot_id', $uninot_id);
		$result = $this->db->update($this->universitynotificationsTbl, $data);
   		//echo $this->db->last_query();
		return $result;
	}
	public function get_graducation_exam_date($uniid){
			$this->db->select('date_of_graduated');
			$this->db->from($this->graduatesTbl);
			$this->db->where('uniid', $uniid);
			$this->db->where('reviewer_status', '1');
			$this->db->where('reviewer_id >', '0');
			$this->db->where('examcode !=', '');			
			$this->db->group_by('date_of_graduated');
			$this->db->order_by('date_of_graduated','desc');
			$query = $this->db->get();
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			//$result = $query->row_object();
			//echo $this->db->last_query(); exit;
			return $result;
			
		}
	public function get_graduatesexamcode($uniid){ 
		$name = (isset($_GET['name']))?$_GET['name']:'';
		$graduate_date = (isset($_GET['graduate_date']))?$_GET['graduate_date']:'';
		$allrecord = (isset($_GET['all']))?$_GET['all']:'';
		
		//fetch recent date
		$recent_date = '';
		$this->db->select('date_issued');
			$this->db->from($this->graduatesTbl);
			$this->db->where('uniid', $uniid);
			$this->db->where('reviewer_status', '1');
			$this->db->where('reviewer_id >', '0');
			$this->db->where('examcode !=', '');			
			$this->db->order_by('date_issued','desc');
			$this->db->limit('1');
			$query = $this->db->get();
			$result = $query->row_object();
			//echo $this->db->last_query(); exit;
			if(isset($result->date_issued)){
				$recent_date = $result->date_issued;
			}
		//end fetch recent date
		
		
		$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		$this->db->where('g.uniid', $uniid);
		$this->db->where('g.reviewer_status', '1');
		$this->db->where('g.reviewer_id >', '0');
		$this->db->where('g.examcode !=', '');
		if($name !=""){
			$this->db->like('g.student_name', trim($name),'before');
			$this->db->or_like('g.middle_name', trim($name),'before');
			$this->db->or_like('g.surname', trim($name),'before');
		}
		if($graduate_date !=""){
			$this->db->where('g.date_of_graduated', trim($graduate_date));
		}
		if($allrecord == "" && $graduate_date =="" && $name ==""){
			$this->db->where('g.date_issued', trim($recent_date));
		}
		
		$this->db->order_by('g.date_issued', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}
		return false;

	}
	public function school_graduatessubmited($uniid){ 
		
		$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->graduatesTbl.' g');
		$this->db->join($this->professionTbl.' p', 'g.college_of=p.id','left');		
		$this->db->where('g.uniid', $uniid);
		//$this->db->where_in('g.reviewer_status',array('1','2'));
		//$this->db->where('g.reviewer_id >', '0');
		$this->db->where('g.temp_order_id !=', '');
		$this->db->order_by('g.grad_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_schoolisting($uniid){
		$search_key = (isset($_GET['search_key']))?$_GET['search_key']:'';
		//$this->db->select('g.*,p.name collegeofname');
		$this->db->from($this->schoolTbl.' s');	
		$this->db->where('s.uniid', $uniid);
		if($search_key != ""){
			$this->db->where("s.school_name LIKE '%$search_key%'");
		}
		$this->db->order_by('s.sch_id', 'desc');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_collegeof(){
		$this->db->from($this->professionTbl);	
		$this->db->where('status', '1');
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	public function get_schoollist($uniid){		
		$this->db->from($this->schoolTbl);			
		$this->db->where('status', '1');
		$this->db->where('uniid', $uniid);
		$this->db->order_by('school_name', 'ASC');
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
			return $result;		
		}	
	}
	////////////////////////////////////////////////////////////////
		
	public function check_user_exsits($email){
		$this->db->where('email',$email);
		$result = $this->db->get($this->userTbl)->num_rows();
   		// echo $this->db->last_query();
		return $result;
	}
	
	public function fetch_user_details($user_id){
		$this->db->where('user_ID',$user_id);
		$result = $this->db->get($this->userTbl)->row_object();
   		//echo $this->db->last_query(); exit;
		return $result;
	}

	public function insert($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		 //echo $this->db->last_query(); exit;
   		return  $insert_id;
	}

	public function update($tbl_name,$data,$db_id,$id){
		$this->db->where($db_id, $id);
		$result = $this->db->update($tbl_name, $data);
   		// echo $this->db->last_query();
		return $result;
	}

	public function save($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		// echo $this->db->last_query();
   		return  $insert_id;
	}
	
	public function delete($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->delete($tbl_name);
   		// echo $this->db->last_query();
		return $result;
	}
	public function delete_graducate($id,$uni_id){
		$this->db->where('grad_id',$id);
		$this->db->where('uniid',$uni_id);
		$result = $this->db->delete($this->graduatesTbl);
   		// echo $this->db->last_query();
		$return = $this->db->affected_rows();
		return $return;
	}

	public function count_rows($tbl_name,$where=null){
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}
		$query  = $this->db->get($tbl_name);
		$result = $query->num_rows();
  		// echo $this->db->last_query();
		return $result;
	}

	public function get_result_array($tbl_name,$db_field = false,$field = false,$where =  false){
	
		

		if($where!="")
		{
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}else{
			
			if(!empty($field)){
				$this->db->where($db_field,$field);
			}	
		}
		$result = $this->db->get($tbl_name)->result_array();
   		return $result;
	}
		
	public function get_row_array($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->get($tbl_name)->row_array();
   		// echo $this->db->last_query();
		return $result;
	}	

	public function get_row_object($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->get($tbl_name)->row();
  		 //echo $this->db->last_query(); exit;
		return $result;
	}

	public function get_result_object($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$query = $this->db->get($tbl_name);

		// Safely check if the query ran successfully
		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}
	public function get_result_arrays($tbl_name,$db_field = false,$field = false,$where=false,$group_by=false,$join=false){
	
		$custom_fields = "t1.*";

		if($join!="")
		{
			$custom_fields .= ",t2.name as profession_name,t3.countries_name as country_name";
		}

		$this->db->select($custom_fields);
		$this->db->from($tbl_name. " as t1");

		if($join!="")
		{
			$this->db->join('tbl_profession as t2','t1.profession=t2.id','left');
			$this->db->join('tbl_countries as t3','t1.country=t3.countries_id','left');
		}
		

		if(!empty($where)){
		
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		
		$result = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($result->num_rows() > 0)
		{
			return $result->row();
		}
		return false;
		//$result = $this->db->get($tbl_name)->row();
   		//echo $this->db->last_query(); exit;
		
	}
	public function get_result_group_by($tbl_name,$field,$group_by=false,$where=false)
	{
		$this->db->select_sum($field,'certificate_unit_count');
		$this->db->from($tbl_name);
		if(!empty($group_by))
		{
			$this->db->group_by($group_by);
		}
		if(!empty($where)){
		
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}

		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;
	}
	public function get_certificate_count($tbl_name,$where=null,$join=null)
	{
		$this->db->select("*");
		$this->db->from($tbl_name.' as t1');
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as t2','t1.certificate_id=t2.certificate_id','left');
			}
		}
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();

		}
		
		return false;
			
	}
	public function get_verified_unverified_certificate($tbl_name,$where=null,$join=null)
	{
		$this->db->select("t1.*,t2.certificate_identify as verified_certificate");
		$this->db->from($tbl_name.' as t1');
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as t2','t1.certificate_id=t2.certificate_id','left');
			}
		}
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where('t1.'.$key,$value);
			}
		
		}

		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();

		}
		
		return false;
			
	}
} ?>