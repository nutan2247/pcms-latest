<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calender_model extends CI_Model {

	function __construct() {
		$this->calenderTbl  = 'tbl_calender';
	}

	public function insert($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}

	public function update($tbl_name,$data,$db_id,$id){
		$this->db->where($db_id, $id);
		$result = $this->db->update($tbl_name, $data);
		return $result;
	}

	public function save($tbl_name,$data){
		$this->db->insert($tbl_name,$data);
		$insert_id = $this->db->insert_id(); 
   		return  $insert_id;
	}
	
	public function delete($tbl_name,$db_field,$field){
		$this->db->where($db_field,$field);
		$result = $this->db->delete($tbl_name);
		return $result;
	}

	public function count_rows($tbl_name,$where=null){
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$query  = $this->db->get($tbl_name);
		if(($query !== false) ? $query->num_rows() : 0){
			return $query->num_rows();
			}
			return false;
	}

	public function get_result_object($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$query = $this->db->get($tbl_name);

		if ($query && $query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}
	public function get_row_object($tbl_name,$db_field = false,$field = false){
			
		if(!empty($field)){
		$this->db->where($db_field,$field);
		}
		$result = $this->db->get($tbl_name)->row();
		return $result;
	}
	
	public function get_result_arrays($tbl_name,$db_field = false,$field = false,$where=false,$group_by=false){
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$result = $this->db->get($tbl_name)->row();
		return $result;
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

		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;
	}

	public function add_date($post){
		
		$add['slot'] 		= $post['slot'];
		$add['application_id'] = $post['application_id'];
		$add['title']		=	$post['title'];
		$add['date']		=	$post['date'];
		$add['added_on'] 	= 	date('Y-m-d');
		$add['status'] 		= 	1;

		$this->db->insert($this->calenderTbl,$add);
		$insert_id = $this->db->insert_id(); 
		// return $this->db->last_query();
   		return  $insert_id;
	}

	public function edit_date($post){
		// if($post['slot1']!=''){
		// 	$post['slot1'] = $post['application_id'];

		// }elseif($post['slot2']!=''){
		// 	$post['slot2'] = $post['application_id'];

		// }elseif($post['slot3']!=''){
		// 	$post['slot3'] = $post['application_id'];

		// }else{
		// 	$post['slot4'] = $post['application_id'];

		// }
		$update['date']			=	$post['date'];
		$update['updated_at'] 	= 	date('Y-m-d H:i:s');

		$this->db->where('id', $post['id']);
		$result = $this->db->update($this->calenderTbl, $update);
   		return  $post['id'];
	}	

	public function delete_date($id){
		$this->db->where('id',$id);
		$result = $this->db->delete($this->calenderTbl);
		return $result;
	}
} 

?>