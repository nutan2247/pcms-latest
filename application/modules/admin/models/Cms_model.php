<?php

class Cms_model extends CI_Model {

	public $table_name = 'cms';

	public $newnmediaTbl = 'tbl_newsmedia';

	public $newscommentsTbl = 'tbl_newscomments';

	public $newscategoriesTbl = 'tbl_newscategories';

	public $downloadTbl = 'tbl_download';

	public $bannerTbl = 'tbl_banner';

	

	function get_banner_list(){

		$this->db->select('*');

		$this->db->from($this->bannerTbl);

		$query = $this->db->get();

		

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return $result;

	}function get_download_list(){

		$this->db->select('*');

		$this->db->from($this->downloadTbl);

		$query = $this->db->get();

		

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return $result;

	}

	function get_list(){

		$this->db->select('*');

		$this->db->from($this->table_name);

		$query = $this->db->get();

		

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return $result;

	}

	function get_categorylist(){

		$this->db->select('*');

		$this->db->from($this->newscategoriesTbl);

		$query = $this->db->get();		

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return $result;

	}

	function get_one_banner($id = false){

		

		$this->db->select('*');

		$this->db->from($this->bannerTbl);

		

		if($id){

			$this->db->where('bnr_id', $id);

		}

		

		$query = $this->db->get();

		$result = $query->row_object();

		return $result;

	}function get_one_download($id = false){

		

		$this->db->select('*');

		$this->db->from($this->downloadTbl);

		

		if($id){

			$this->db->where('dwnid', $id);

		}

		

		$query = $this->db->get();

		$result = $query->row_object();

		return $result;

	}

	function get_one_category($id = false){

		

		$this->db->select('*');

		$this->db->from($this->newscategoriesTbl);

		

		if($id){

			$this->db->where('newscat_id', $id);

		}

		

		$query = $this->db->get();

		$result = $query->row_object();

		return $result;

	}

	

	function insert_banner($data){

		

		$this->db->set($data);

		$this->db->insert($this->bannerTbl);

		//echo $this->db->last_query(); die;

		return true;

		

	}

	function insert_download($data){

		

		$this->db->set($data);

		$this->db->insert($this->downloadTbl);

		//echo $this->db->last_query(); die;

		return true;

		

	}

	function insert_category($data){

		

		$this->db->set($data);

		$this->db->insert($this->newscategoriesTbl);

		

	}

	

	function update_banner($data, $id = false){

		

		if($id){

			$this->db->where('bnr_id', $id);

		}

		

		//$this->db->set($data);

		$this->db->update($this->bannerTbl, $data);

		// echo $this->db->last_query(); die;

		

	}function update_download($data, $id = false){

		

		if($id){

			$this->db->where('dwnid', $id);

		}

		

		//$this->db->set($data);

		$this->db->update($this->downloadTbl, $data);

		// echo $this->db->last_query(); die;

		

	}

	function update_category($data, $id = false){

		

		if($id){

			$this->db->where('newscat_id', $id);

		}

		

		//$this->db->set($data);

		$this->db->update($this->newscategoriesTbl, $data);

		// echo $this->db->last_query(); die;

		

	}

	

	function get_one($id = false){

		

		$this->db->select('*');

		$this->db->from($this->table_name);

		

		if($id){

			$this->db->where('cms_id', $id);

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

			$this->db->where('cms_id', $id);

		}

		

		//$this->db->set($data);

		$this->db->update($this->table_name, $data);

		// echo $this->db->last_query(); die;

		

	}
	function cmsdelete($id){
		return $this->db->where('cms_id', $id)->delete($this->table_name);
	}
	function news_get_list(){

		$this->db->select('n.*,ncat.news_category_name,count(nc.newscomt_id) total_comments');

		$this->db->from($this->newnmediaTbl. ' n');

		$this->db->join($this->newscategoriesTbl.' ncat','n.newscat_id=ncat.newscat_id','left');

		$this->db->join($this->newscommentsTbl.' nc','n.news_id=nc.news_id','left');

		$this->db->order_by('n.news_id', 'DESC');

		$this->db->group_by('n.news_id');

		$query = $this->db->get();		

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return $result;

	}

	public function delete_news($news_id){

		$this->db->where('news_id',$news_id);

		$result = $this->db->delete($this->newnmediaTbl);

		$deltedid = $this->db->affected_rows();

   		// echo $this->db->last_query();

		return $deltedid;

	}

	function get_newscommets_list($id){

		$this->db->from($this->newscommentsTbl);

		if($id){

			$this->db->where('news_id', $id);

		}

		$this->db->order_by('newscomt_id', 'DESC');

		$query = $this->db->get();		

		if(($query !== false) ? $query->num_rows() : 0){
			$result = $query->result();
			return $result;		
		}

		return $result;

	}

	function deletecomments($newscomt_id,$news_id){

		$this->db->delete($this->newscommentsTbl, array('newscomt_id' => $newscomt_id,'news_id' => $news_id));

		//echo $this->db->last_query(); die;

		if ($this->db->affected_rows() == 0)

		{

		    return FALSE;

		}else{

			return TRUE;

		}

	}

	function news_get_one($id = false){

		

		$this->db->select('*');

		$this->db->from($this->newnmediaTbl);

		

		if($id){

			$this->db->where('news_id', $id);

		}

		

		$query = $this->db->get();

		$result = $query->row_object();

		return $result;

	}

	

	function news_insert($data){

		

		$this->db->set($data);

		$this->db->insert($this->newnmediaTbl);

		

	}

	

	function news_update($data, $id = false){

		

		if($id){

			$this->db->where('news_id', $id);

		}

		

		//$this->db->set($data);

		$this->db->update($this->newnmediaTbl, $data);

		// echo $this->db->last_query(); die;

		

	}

}

?>