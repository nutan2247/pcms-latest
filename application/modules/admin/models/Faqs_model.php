<?php

class Faqs_model extends CI_Model {

	public $table_name = 'faqs';
	public $categories = 'tbl_newscategories';

	

	function get_list(){
		$category = isset($_GET['catid'])?$_GET['catid']:'';
		$this->db->select('f.*,c.news_category_name category_name');
		$this->db->from($this->table_name.' f');
		$this->db->join($this->categories.' c','f.faq_category = c.newscat_id','left');
		if(!empty($category)){
			$this->db->where("f.faq_page", $category);
		}

		$this->db->order_by("f.faq_position", "asc");
		$query = $this->db->get();
		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
	}

	

	function get_one($id = false){

		

		$this->db->select('*');

		$this->db->from($this->table_name);

		

		if($id){

			$this->db->where('faq_id', $id);

		}

		

		$query = $this->db->get();

		$result = $query->row_object();

		return $result;

	}

	

	function insert($data){

		

		$this->db->set($data);

		$this->db->insert($this->table_name);

		

	}

	

	function update($data, $id = false){
		if($id){
			$this->db->where('faq_id', $id);
		}
		//$this->db->set($data);
		return  $this->db->update($this->table_name, $data);
		// echo $this->db->last_query(); die;
	}	

}

?>