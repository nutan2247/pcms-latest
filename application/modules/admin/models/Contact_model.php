<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {
	
	public function get_result_array($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$result = $this->db->get($tbl_name)->result_array();
   		// echo $this->db->last_query();
		return $result;
	}
	public function get_one_message($cont_id=''){
		$this->db->where('cont_id', $cont_id);
		$q = $this->db->get('tbl_contact');
		$result = $q->row();
		return $result;
	}
	public function update_to_read($cont_id, $data){
		$this->db->where('cont_id', $cont_id);
		$this->db->update('tbl_contact', $data);
	}
	public function professionals($role){
		$this->db->where('status',1);
		$this->db->where('reviewer_status','1');
		$this->db->where('role',$role);
		$q = $this->db->get('tbl_users');
		$result = $q->result();
		return $result;
	}
	public function graduateslist(){
		$this->db->where('reviewer_status','1');
		$q = $this->db->get('graduates');
		$result = $q->result();
		return $result;
	}
	public function universitylist(){
		$this->db->where('status','1');
		$q = $this->db->get('tbl_university');
		$result = $q->result();
		return $result;
	}
	public function ceplist(){
		$this->db->where('reviewer_status','1');
		$q = $this->db->get('tbl_ce_provider');
		$result = $q->result();
		return $result;
	}
}

?>