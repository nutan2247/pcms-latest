<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_modal extends CI_Model {

	

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

		$result = $this->db->get($tbl_name)->result();

   		// echo $this->db->last_query();

		return $result;

	}
	
	public function get_payment_details($where=null,$join=null,$group_by=null)
	{
		$this->db->select("t1.image as user_image,t1.user_ID,t1.name as user_name,t2.added_on,t2.units,t2.certificate_id,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t4.user_id=t2.user_id','inner');
		
		
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as '.$key,$key.'.certificate_id=t2.certificate_id','inner');
			}
		}
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}

		if($group_by!="")
		{
			$this->db->group_by('t1.user_id');	
		}

		
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}
	public function get_payment_detail_row_count($where=null,$join=null)
	{
		$this->db->select("t1.user_ID,t1.name as user_name,t2.category,t3.name as profession_name,t1.license_no,t1.license_validity_date,t2.issue_date,t4.status,t4.amount,t4.tax");
		$this->db->from('tbl_users as t1');
		$this->db->join('tbl_payment as t4','t4.user_id=t1.user_Id','inner');
		$this->db->join('tbl_user_certificate as t2','t4.user_id=t2.user_id','inner');
		
		
		if($join!="")
		{
			foreach ($join as $key => $value) {
				$this->db->join($value.' as '.$key,$key.'.certificate_id=t2.certificate_id','inner');
			}
		}
		$this->db->join('tbl_profession as t3','t3.id=t1.profession','left');
		if($where!=null){
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		
		}


		$this->db->group_by('t1.user_id');
		$q = $this->db->get();
		//echo $this->db->last_query();
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->num_rows();
		}
		return false;
	}

}
?>