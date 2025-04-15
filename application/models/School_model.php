<?php

class School_model extends CI_Model {
	protected $schoolTbl;
	protected $schooldocTbl;
	protected $countriesTbl;
	protected $professionTbl;
		function __construct() {

			$this->schoolTbl = 'tbl_university';

			$this->schooldocTbl = 'tbl_university_documents';

			$this->countriesTbl = 'tbl_countries';

			$this->professionTbl = 'tbl_profession';

		}

		function schoollisting($limit = false){

			$name = (isset($_GET['name']))?$_GET['name']:'';

			$accreditation_no = (isset($_GET['accreditation_no']))?$_GET['accreditation_no']:'';

			$profession_id = (isset($_GET['profession_id']))?$_GET['profession_id']:'';

			$countries_id = (isset($_GET['countries_id']))?$_GET['countries_id']:'';

			$this->db->select('sd.uniid,sd.accreditation_number,s.university_name,s.address,s.email,s.college_logo');

			$this->db->from($this->schooldocTbl.' sd');

			$this->db->join($this->schoolTbl.' s', 'sd.uniid=s.uniid');

			$this->db->where(array('sd.reviewer_status'=>'1','sd.reviewer_id >'=>0,'sd.expiry_at >='=>date('Y-m-d')));

			if($name !=""){

				$this->db->like('s.university_name', trim($name));

			}

			if($accreditation_no !=""){

				$this->db->where('sd.accreditation_number', trim($accreditation_no));

			}

			if($profession_id !=""){

				$this->db->where('s.college_of', $profession_id);

			}

			if($countries_id !=""){

				$this->db->where('s.countries_id', $countries_id);

			}

			$this->db->group_by("sd.uniid");
			
			$this->db->order_by("sd.uniid", "desc");

			//echo $this->db->last_query(); die;

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

		function deatils($uniid){

			$this->db->select('s.*,sd.accreditation_number,c.countries_name,p.name');

			$this->db->from($this->schoolTbl.' s');

			$this->db->join($this->schooldocTbl.' sd', 's.uniid=sd.uniid');

			$this->db->join($this->countriesTbl.' c', 's.countries_id=c.countries_id','left');

			$this->db->join($this->professionTbl.' p', 's.college_of=p.id','left');

			$this->db->where(array('s.status'=>'1','s.uniid'=>$uniid,'sd.reviewer_status'=>'1','sd.accreditation_number !='=>''));

			$query = $this->db->get();

			$result = $query->row_array();

			//echo $this->db->last_query(); die;

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return false;

		}

}

?>