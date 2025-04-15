<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professional_model extends CI_Model {
	
	// public $table_name = '';

	



	public function get_users($data){

		


			$this->db->select("t1.*,t2.name as professional_status");
			$this->db->from('tbl_users as t1');
			$this->db->join('tbl_professional_status as t2','t2.professional_status_id=t1.status','left');
			if(!empty($data))
			{
				if(isset($data['name']) && $data['name']!="")
				{
					$this->db->where('t1.name',$data['name']);
				}	
				if(isset($data['profession']) && $data['profession']!="")
				{
					
					$this->db->where('t1.profession',$data['profession']);
					
				}
				if(isset($data['status']) && $data['status']!="")
				{
					
					$this->db->where('t1.status',$data['status']);
					
				}
				if(isset($data['gender']) && $data['gender']!="")
				{
					
					$this->db->where('t1.gender',$data['gender']);
					
				}
			}
			$q  = $this->db->get();

			//echo $this->db->last_query(); exit;
			if(($q !== false) ? $q->num_rows() : 0)
			{
				return $q->result_array();
			}
			return false;




	}
	public function professional_users_count($data){

		


			$this->db->select("t1.*");
			$this->db->from('tbl_users as t1');
			if(!empty($data))
			{
				if(isset($data['name']) && $data['name']!="")
				{
					$this->db->where('t1.name',$data['name']);
				}	
				if(isset($data['profession']) && $data['profession']!="")
				{
					
					$this->db->where('t1.profession',$data['profession']);
					
				}
				if(isset($data['status']) && $data['status']!="")
				{
					
					$this->db->where('t1.status',$data['status']);
					
				}
				if(isset($data['gender']) && $data['gender']!="")
				{
					
					$this->db->where('t1.gender',$data['gender']);
					
				}
			}
			$q  = $this->db->get();

			//echo $this->db->last_query(); exit;
			if(($q !== false) ? $q->num_rows() : 0)
			{
				return $q->num_rows();
			}
			return false;




	}
}

?>