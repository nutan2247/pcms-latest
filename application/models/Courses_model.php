<?php

class Courses_model extends CI_Model {
	private $coursedocumentsTbl;
	private $ceproviderTbl;
	private $professionTbl;
		function __construct() {

			$this->coursedocumentsTbl 	= 'tbl_course_documents';			

			$this->ceproviderTbl 		= 'tbl_ce_provider';	

			$this->professionTbl 		= 'tbl_profession';			

		}

		function courselisting($limit = false){

			$course_title = (isset($_GET['course_title']))?$_GET['course_title']:'';

			$profession = (isset($_GET['profession']))?$_GET['profession']:'';

			$category = (isset($_GET['category']))?$_GET['category']:'';

			$this->db->select('cd.cor_doc_id,cd.course_title,cd.course_image,cd.course_units,cd.course_units,cd.course_price,p.business_name,p.business_no,p.email,p.phone,p.address');

			$this->db->from($this->coursedocumentsTbl.' cd');

			$this->db->join($this->ceproviderTbl.' p', 'cd.provider_id=p.provider_id');

			$this->db->where(array('cd.reviewer_status'=>'1','cd.reviewer_id >'=>0,'cd.expiry_at >='=>date('Y-m-d')));

			if($course_title !=""){

				$this->db->like('cd.course_title', trim($course_title));

			}

			if($profession !=""){

				$this->db->where('cd.profession', trim($profession));

			}if($category !=""){

				$this->db->where('cd.category', trim($category));

			}

			$this->db->group_by("cd.cor_doc_id");

			$this->db->order_by("cd.cor_doc_id ", "desc");

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



		function deatils($cor_doc_id){

			$this->db->select('cd.*, p.provider_id, p.business_name, pro.name profession_name, cat.name category_name');

			$this->db->from($this->coursedocumentsTbl.' cd');

			$this->db->join($this->ceproviderTbl.' p', 'cd.provider_id=p.provider_id');

			$this->db->join($this->professionTbl.' pro', 'cd.profession = pro.id','left');

			$this->db->join($this->professionTbl.' cat', 'cd.category = cat.id','left');

			$this->db->where(array('cd.reviewer_status'=>'1','cd.reviewer_id >'=>0,'cd.expiry_at >='=>date('Y-m-d'),'cd.cor_doc_id'=>$cor_doc_id));

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