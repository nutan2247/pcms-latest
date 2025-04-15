<?php



class Training_model extends CI_Model {
	private $trainingdocumentsTbl;
	private $ceproviderTbl;
	private $professionTbl;
		function __construct() {

			$this->trainingdocumentsTbl = 'tbl_training_documents';			

			$this->ceproviderTbl 		= 'tbl_ce_provider';

			$this->professionTbl 		= 'tbl_profession';				

		}

		function traininglisting($limit = false){

			$training_title = (isset($_GET['training_title']))?$_GET['training_title']:'';

			$profession = (isset($_GET['profession']))?$_GET['profession']:'';

			$category = (isset($_GET['category']))?$_GET['category']:'';

			$this->db->select('cd.train_doc_id,cd.training_title,cd.training_image,cd.training_units,cd.training_units,cd.training_price,p.business_name,p.business_no,p.email,p.phone,p.address');

			$this->db->from($this->trainingdocumentsTbl.' cd');

			$this->db->join($this->ceproviderTbl.' p', 'cd.provider_id=p.provider_id');

			$this->db->where(array('cd.reviewer_status'=>'1','cd.reviewer_id >'=>0,'cd.expiry_at >='=>date('Y-m-d')));

			if($training_title !=""){

				$this->db->like('cd.training_title', trim($training_title)); 

			}

			if($profession !=""){

				$this->db->where('cd.profession', trim($profession));

			}if($category !=""){

				$this->db->where('cd.category', trim($category));

			}

			$this->db->group_by("cd.train_doc_id");

			$this->db->order_by("cd.train_doc_id ", "desc");

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

		function deatils($train_doc_id){

			$this->db->select('td.*, p.business_name, pro.name profession_name, cat.name category_name');

			$this->db->from($this->trainingdocumentsTbl.' td');

			$this->db->join($this->ceproviderTbl.' p', 'td.provider_id=p.provider_id');

			$this->db->join($this->professionTbl.' pro', 'td.profession = pro.id','left');

			$this->db->join($this->professionTbl.' cat', 'td.category = cat.id','left');

			$this->db->where(array('td.reviewer_status'=>'1','td.reviewer_id >'=>0,'td.expiry_at >='=>date('Y-m-d'),'td.train_doc_id'=>$train_doc_id));

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