<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	// public $table_name = '';

	public function save($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		// echo $this->db->last_query();
   		return  $insert_id;
	}
		
	public function update($tbl_name,$data,$db_id,$id){
		$this->db->where($db_id, $id);
		$result = $this->db->update($tbl_name, $data);
   		// echo $this->db->last_query();
		return $result;
	}
	
	public function delete($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->delete($tbl_name);
   		// echo $this->db->last_query();
		return $result;
	}

	public function count_rows($tbl_name,$db_field=false,$field=false){
		if($db_field){
		$this->db->where($db_field,$field);
		}
		$query  = $this->db->get($tbl_name);
		$result = $query->num_rows();
   		// echo $this->db->last_query();
		return $result;
	}

	public function get_result_array($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$result = $this->db->get($tbl_name)->result_array();
   		// echo $this->db->last_query();
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
   		// echo $this->db->last_query();
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
}

?>