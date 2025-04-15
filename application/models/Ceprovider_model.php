<?php

class Ceprovider_model extends CI_Model {
	
	protected $ceproviderTbl;
protected $cepdocumentTbl;			
protected $countryTbl;
		function __construct() {

			$this->ceproviderTbl = 'tbl_ce_provider';

			$this->cepdocumentTbl = 'tbl_cep_documents';			

			$this->countryTbl = 'tbl_countries';			

		}

		function ceplisting($limit = false){

			$name = (isset($_GET['name']))?$_GET['name']:'';

			$accreditation_no = (isset($_GET['accreditation_no']))?$_GET['accreditation_no']:'';

			$profession_id = (isset($_GET['profession_id']))?$_GET['profession_id']:'';

			$countries_id = (isset($_GET['countries_id']))?$_GET['countries_id']:'';

			

			$this->db->select('cd.provider_id,cd.accreditation_no,c.business_name,c.business_no,c.contact_person,c.designation,c.email,c.phone,c.address,c.company_logo');

			$this->db->from($this->cepdocumentTbl.' cd');

			$this->db->join($this->ceproviderTbl.' c', 'cd.provider_id=c.provider_id');

			$this->db->where(array('cd.reviewer_status'=>'1','cd.reviewer_id >'=>0,'cd.expiry_at >='=>date('Y-m-d')));

			if($name !=""){

				$this->db->like('c.business_name', trim($name));

			}

			if($accreditation_no !=""){

				$this->db->where('cd.accreditation_no', trim($accreditation_no));

			}

			if($profession_id !=""){

				$this->db->where('c.profession', $profession_id);

			}

			if($countries_id !=""){

				$this->db->where('c.countries_id', $countries_id);

			}

			$this->db->group_by("cd.provider_id");

			$this->db->order_by("cd.provider_id", "desc");

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



		function cepdeatils($provider_id){

			$this->db->select('cep.*,c.countries_name, doc.expiry_at, doc.accreditation_no, doc.review_accept_date');

			$this->db->from($this->ceproviderTbl.' cep');

			$this->db->join($this->countryTbl.' c','cep.countries_id = c.countries_id','left');
			$this->db->join($this->cepdocumentTbl.' doc','cep.provider_id = doc.provider_id','left');

			$this->db->where(array('cep.status'=>'1','cep.provider_id'=>$provider_id));

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