<?php

class Cms_model extends CI_Model {
	private $cmsTbl;
	private $contactTbl;
	private $requestquoteTbl;
	private $newsmediaTbl;
	private $newscommentsTbl;
	private $downloadTbl;
	private $newscategoriesTbl;
		function __construct() {

			$this->cmsTbl = 'cms';

			$this->contactTbl = 'tbl_contact';

			$this->requestquoteTbl = 'requestquote';

			$this->newsmediaTbl = 'tbl_newsmedia';

			$this->newscommentsTbl = 'tbl_newscomments';

			$this->downloadTbl = 'tbl_download';

			$this->newscategoriesTbl = 'tbl_newscategories';

		}

		function downloadlisting(){

			$this->db->select('*');

			$this->db->from($this->downloadTbl);

			$this->db->where(array('status'=>'1'));

			$this->db->order_by("added_at ", "desc");

			$query = $this->db->get();

			//$result = $query->row_array();

			//echo $this->db->last_query();

			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return $result;

		}

		function newscommentslisting($news_id){

			$this->db->select('*');

			$this->db->from($this->newscommentsTbl);

			$this->db->where(array('status'=>'1'));

			$this->db->where(array('news_id'=>$news_id));

			$this->db->order_by("added_at ", "desc");

			$this->db->limit(15);

			$query = $this->db->get();

			//$result = $query->row_array();

			//echo $this->db->last_query();

			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return $result;

		}

		function newslisting($limit = false,$news_id=null,$category=null){
			$this->db->select('*');
			$this->db->from($this->newsmediaTbl);
			$this->db->where(array('news_status'=>'1','location'=>'m'));
			if($news_id > 0){
				$this->db->where(array('news_id!='=>$news_id));
			}
			if($category > 0){
				$this->db->where(array('newscat_id'=>$category));
			}
			$this->db->order_by("new_date ", "desc");
			if($limit > 0){
			$this->db->limit($limit);
			}
			$query = $this->db->get();
			//$result = $query->row_array();
			//echo $this->db->last_query();
			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}
		return false;
		}

		function newslistingrightside($limit = false,$news_id=null){

			$this->db->select('n.*,nc.news_category_name');

			$this->db->from($this->newsmediaTbl.' n');

			$this->db->join($this->newscategoriesTbl.' nc','n.newscat_id=nc.newscat_id');

			$this->db->where(array('n.news_status'=>'1','n.location'=>'r'));

			if($news_id > 0){

				$this->db->where(array('n.news_id!='=>$news_id));

			}

			$this->db->order_by("nc.display_position ", "asc");

			if($limit > 0){

			$this->db->limit($limit);

			}

			$query = $this->db->get();

			if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return false;

		}

		function newsdeatils($newsurl){

			$this->db->select('*');

			$this->db->from($this->newsmediaTbl);

			$this->db->where(array('news_status'=>'1','news_url'=>$newsurl));

			$query = $this->db->get();

			$result = $query->row_array();

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

			return false;

		}

		function cmsdeatils($cmsurl){

			$this->db->select('*');

			$this->db->from($this->cmsTbl);

			$this->db->where(array('cms_status'=>'1','cms_url'=>$cmsurl));

			$query = $this->db->get();

			$result = $query->row_array();

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

		function insertcomment($data){		

			$this->db->set($data);

			$this->db->insert($this->newscommentsTbl);

			return true;

			

		}

		function insertrequestquote($data){		

			$this->db->set($data);

			$this->db->insert($this->requestquoteTbl);

			return true;

			

		}

		function updaterequestquote($data,$email){	

			$this->db->where('email', $email);

			$this->db->update($this->requestquoteTbl, $data);

			return true;

			

		}

		

}

?>