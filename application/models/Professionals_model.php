<?php

class Professionals_model extends CI_Model {
		private $professionallicenseTbl;
		private $professionaldocumentsTbl;
		private $useridTbl;
		private $countryTbl;
		private $professionTbl;
		function __construct() {

			$this->professionallicenseTbl 	= 'tbl_professional_license';

			$this->professionaldocumentsTbl = 'tbl_professional_documents';			

			$this->useridTbl = 'tbl_users';			

			$this->countryTbl = 'tbl_countries';		

			$this->professionTbl = 'tbl_profession';			

		}

		function listing($limit = false){

			$name = (isset($_GET['name']))?$_GET['name']:'';

			$profession_id = (isset($_GET['profession_id']))?$_GET['profession_id']:'';

			$countries_id = (isset($_GET['countries_id']))?$_GET['countries_id']:'';

			$this->db->select('pd.user_id,pd.diploma,pd.ot_record,pd.charecter,pd.passport,u.fname,u.lname,u.dob,u.gender,u.profession,u.country,u.image,p.name,p.registration_no,p.candidate_type,p.license_no');

			$this->db->from($this->professionallicenseTbl.' p');

			$this->db->join($this->useridTbl.' u', 'p.user_id=u.user_ID');

			$this->db->join($this->professionaldocumentsTbl.' pd', 'p.user_id=pd.user_id');

			if($name !=""){

				$this->db->like('p.name', $name);

			}

			if($profession_id !=""){

				$this->db->where('u.profession', $profession_id);

			}

			if($countries_id !=""){

				$this->db->where('u.country', $countries_id);

			}

			//$this->db->where(array('pd.reviewer_status'=>'1'));

			$this->db->group_by("pd.user_id");

			$this->db->order_by("pd.pd_id ", "desc");

			if($limit > 0){

			$this->db->limit($limit);

			}

			$query = $this->db->get();

			//$result = $query->row_array();

			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return false;

		}

		function deatils($userid){

			$this->db->select('p.*,u.*,pr.name profession_name, c.countries_name');

			$this->db->from($this->professionallicenseTbl.' p');

			$this->db->join($this->useridTbl.' u', 'p.user_id = u.user_ID');

			$this->db->join($this->professionTbl.' pr', 'p.profession = pr.id','left');

			$this->db->from($this->countryTbl.' c','u.country = c.countries_id','left');

			$this->db->where(array('p.user_id'=>$userid));

			$query = $this->db->get();

			$result = $query->row_array();

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return false;

		}

}

?>