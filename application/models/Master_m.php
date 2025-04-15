<?php defined('BASEPATH') or exit ("No ditect script access allowed");
class Master_m extends CI_Model
{
	private $userTbl;
	private $professionalTbl;
	private $tbl_countries;
	private $tbl_user_certificate;
	private $tbl_existing_certificate;
	
	function __construct()
	{
		$this->userTbl 			= 'tbl_users';
		$this->professionalTbl 		= 'tbl_profession';
		$this->tbl_countries 		= 'tbl_countries';

		$this->tbl_user_certificate = 'tbl_user_certificate';
		$this->tbl_existing_certificate = 'tbl_existing_certificate';
	}
	public function get_user_details($user_id)
	{
		$this->db->select("t1.*,t2.name as pro_name,t2.id as item_number,t3.countries_name as co_name");
		$this->db->from($this->userTbl.' as t1');
		$this->db->join($this->professionalTbl.' as t2','t1.profession=t2.id','left');
		$this->db->join($this->tbl_countries.' as t3','t1.country=t3.countries_id','left');
		$this->db->where('t1.user_ID',$user_id);
		$q = $this->db->get();
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();

		}
		return false;
	}
	public function get_setting($type_id=null)
	{
		$q = $this->db->select("*")->get_where("tbl_setting",array("is_active"=>1,'type_id'=>$type_id));
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->row();
		}
		return false;
	}
	public function get_result_array($tbl_name,$db_field = false,$field = false,$where =  false){
	
		

		if($where!="")
		{
			foreach ($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}else{
			
			if(!empty($field)){
				$this->db->where($db_field,$field);
			}	
		}
		$result = $this->db->get($tbl_name)->result_array();
		//echo $this->db->last_query(); exit();
   		return $result;
	}
	public function get_professional_status()
	{
		$q = $this->db->select("*")->get_where('tbl_professional_status',array('is_active'=>'1'));
		//echo $this->db->last_query(); exit;
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}
	public function get_countries()
	{
		$q = $this->db->select("*")->get_where("tbl_countries",array("status"=>1));
		
		if(($q !== false) ? $q->num_rows() : 0)
		{
			return $q->result_array();
		}
		return false;
	}
	
}

 ?>
