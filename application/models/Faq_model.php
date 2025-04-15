<?php

class Faq_model extends CI_Model {
		private $faqTbl;
		function __construct() {

			$this->faqTbl = 'faqs';

		}

		function faqlisting($faq_page = null){

			$this->db->select('*');

			$this->db->from($this->faqTbl);
			
			if($faq_page > 0){
				$this->db->where('faq_page',$faq_page);
			}
			$this->db->where(array('faq_status'=>'1'));

			$this->db->order_by('faq_position','ASC');

			$query = $this->db->get();

			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return false;

		}

		function insertcommonquery($data){

		

			$this->db->set($data);

			$this->db->insert($this->contactTbl);

			return true;

			

		}

		

}

?>