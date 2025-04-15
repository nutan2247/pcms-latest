<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** Media Login controller **/

class Media extends MX_Controller {

	var $data = array();

	public function __construct(){
		parent:: __construct();
		$this->load->model('admin/cms_model');
		$this->load->model('Admin_model','admin');
		$this->load->model('admin/faqs_model');
		// $this->check_session();
	}

	public function index(){
		//echo'Dashboard';
		if(!$this->session->userdata('login')['media_logged_in']){
			redirect('login', 'refresh');
		}
		 redirect('media/newsnmedia', 'refresh');
	}
	public function dashboard(){
		//echo'Dashboard';
		if(!$this->session->userdata('login')['media_logged_in']){
			redirect('login', 'refresh');
		}
		$this->data = array(
			'title' => 'Dashboard',
			'page_title' => 'Dashboard',
			'table_name' => ''
		);
		$uid = $this->session->userdata('login')['user_ID'];
		$this->data['details'] = $this->admin->get_row_object('tbl_admin','user_ID',$uid);
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/dashboard',$this->data);
		$this->load->view('media/common/footer');
		// redirect('media/newsnmedia', 'refresh');
	}
	
	public function newscategories(){
		if(!$this->session->userdata('login')['media_logged_in']){
			redirect('login', 'refresh');
		}
		$this->data = array(
			'title' => 'New & Media Category',
			'page_title' => 'New & Media Category Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->get_categorylist();
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/newsnmediacategory',$this->data);
		$this->load->view('media/common/footer');
	}

	public function newsnmedia(){
		if(!$this->session->userdata('login')['media_logged_in']){
			redirect('login', 'refresh');
		}
		$this->data = array(
			'title' => 'New & Media',
			'page_title' => 'New & Media Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->news_get_list();
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/newsnmedia',$this->data);
		$this->load->view('media/common/footer');
	}

	public function newscomments($id = false){
		$this->data = array(
			'title' => 'new & media comments listing',
			'page_title' => 'New & Media Comments Listing',
			'table_name' => ''
		);
		$this->data['cmss'] = $this->cms_model->get_newscommets_list($id);
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/newscomments',$this->data);
		$this->load->view('media/common/footer');
	}

	public function deletecomment(){
		$newscomt_id = $this->uri->segment(3);
		$news_id = $this->uri->segment(4);
		//echo $newscomt_id.'--- '.$news_id; exit;
		$delete = $this->cms_model->deletecomments($newscomt_id,$news_id);
		redirect('media/newscomments/'.$news_id, 'refresh');
	}
	public function newsnmediaedit($id = false){
		if(!$this->session->userdata('login')['media_logged_in']){
			redirect('login', 'refresh');
		}
		$this->data = array(
			'title' => 'News & Media Edit',
			'page_title' => 'News & Media ',
			'table_name' => ''
		);
		if($this->input->post()) {
			// banner upload		
				//print_r($_FILES["banner"]); exit;
			$banner = '';
			if(isset($_FILES["banner"]) && !empty($_FILES["banner"]['name'])){	
				$this->load->library('upload');
				$config['upload_path'] 		= './assets/images/newsmedia/';
				//echo $config['upload_path'] 		= base_url().'assets/images/newsmedia/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["banner"]["name"]);        
				$banner 					= 'newmedia_'.time().'.'.end($ext);
				$config['file_name'] 		= $banner;
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('banner'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					print_r($error); exit;
				}  
				$banner = $banner;
			}else{
				$banner = $this->input->post('old_banner');
			}
			
			//echo $cv;
			// end image upload
			if($this->input->post('news_id')) {
				$data['news_id'] = $this->input->post('news_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['newscat_id']  			= $this->input->post('newscat_id');
			$data['location']  				= $this->input->post('location');
			$data['news_title']  			= $this->input->post('news_title');
			$data['news_url']  				= $this->seo_friendly_url($this->input->post('news_title'));
			
			$textarea = $this->input->post('news_description');
			$newsarr = explode("\n", $textarea);
			$newtext = '';
			foreach($newsarr as $str){
				$newtext .= "<p>".$str."</p>";
			}
			//$data['news_description']    	= $this->input->post('news_description');
			$data['news_description']    	= $newtext;
			
			$data['news_meta_title']		= $this->input->post('news_title');
			$data['news_meta_description']	= $this->input->post('news_title');
			$data['news_meta_keyword']		= $this->input->post('news_title');
			//$data['bannertext']				= $this->input->post('bannertext');
			$data['banner']					= $banner;
			$data['new_date']				= $this->input->post('new_date');
			$data['new_addedby']			= $this->input->post('new_addedby');
			$data['news_status']			= $this->input->post('news_status');
			
			if($this->input->post('news_id')) {
				$updated = $this->cms_model->news_update($data, $this->input->post('news_id')); 
				// if($updated) { 
					$this->session->set_flashdata('item', array('message' => 'Record updated successfully','class' => 'alert-success'));
				// } else {
					// $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				// }
			} else {
				$inserted	=	$this->cms_model->news_insert($data);
			}
			
            redirect('media/newsnmedia', 'refresh');
		}
		if($id) {
			$this->data['cms'] = $this->cms_model->news_get_one($id);
			
			
            if(!$this->data['cms']) {
                redirect('media/newsnmedia', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		//$this->data['listing'] = $this->admin->get_result_array('cms','','');
		$this->data['newscategoryarr'] = $this->common_model->newscategoryarr();
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/newnmediaedit',$this->data);
		$this->load->view('media/common/footer');
	}
	public function newsmediacatedit($id = false){
		if(!$this->session->userdata('login')['media_logged_in']){
			redirect('login', 'refresh');
		}
		$this->data = array(
			'title' => 'News & Media Category Edit',
			'page_title' => 'News & Media Category',
			'table_name' => ''
		);
		if($this->input->post()) {
			if($this->input->post('newscat_id')) {
				$data['newscat_id'] = $this->input->post('newscat_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['news_category_name']  	= $this->input->post('news_category_name');
			$data['display_position']		= $this->input->post('display_position');
			$data['news_status']			= $this->input->post('news_status');
			
			if($this->input->post('newscat_id')) {
				$updated = $this->cms_model->update_category($data, $this->input->post('newscat_id')); 
				// if($updated) { 
					$this->session->set_flashdata('item', array('message' => 'Record updated successfully','class' => 'alert-success'));
				// } else {
					// $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				// }
			} else {
				$inserted	=	$this->cms_model->insert_category($data);
			}
			
            redirect('media/newscategories', 'refresh');
		}
		if($id) {
			$this->data['cms'] = $this->cms_model->get_one_category($id);
			
            if(!$this->data['cms']) {
                redirect('media/newscategories', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		//$this->data['listing'] = $this->admin->get_result_array('cms','','');
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/newsmediacatedit',$this->data);
		$this->load->view('media/common/footer');
	}

	function seo_friendly_url($string){
		$string = str_replace(array('[\', \']'), '', $string);
		$string = preg_replace('/\[.*\]/U', '', $string);
		$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
		return strtolower(trim($string, '-'));
	}

	public function faq(){
		$this->data = array(
			'title' => 'FAQ',
			'page_title' => 'FAQ',
			'table_name' => ''
		);
		$this->data['faqs'] = $this->faqs_model->get_list();
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/faq',$this->data);
		$this->load->view('media/common/footer');
	}
	public function faqedit($id = false) { 
		$this->data = array(
			'title' => 'Add/Edit FAQ',
			'page_title' => 'Add/Edit FAQ',
			'table_name' => ''
		);
		$faq = false;
		if($this->input->post()) {
			
			if($this->input->post('faq_id')) {
				$data['faq_id'] = $this->input->post('faq_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$textarea = $this->input->post('faq_description');
			$newsarr = explode("\n", $textarea);
			$newtext = '';
			foreach($newsarr as $str){
				$newtext .= "<p>".$str."</p>";
			}
			$data['faq_title']  		= $this->input->post('faq_title');
			$data['faq_page']  			= $this->input->post('faq_page');
			//$data['faq_category']  		= $this->input->post('faq_category');
			$data['faq_description']    = $newtext;
			$data['faq_position']		= $this->input->post('faq_position');
			$data['faq_status']			= $this->input->post('faq_status');
			
			if($this->input->post('faq_id')) {
				$updated = $this->faqs_model->update($data, $this->input->post('faq_id')); 
				if($updated) { 
					$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully</div>');
				} else {
					$this->session->set_flashdata('item', '<div class="alert alert-danger">please try again!</div>');
				}
			} else {
				$inserted	=	$this->faqs_model->insert($data);
			}
			
			redirect('media/faq', 'refresh');
		}
		
		if($id) {
			$this->data['faq'] = $this->faqs_model->get_one($id);
			
            if(!$this->data['faq']) {
                redirect('media/faq', 'refresh');
			}
		} else {
			//$this->data['faq'] = ;
		}
		$this->data['faqs'] = $this->faqs_model->get_list();
		$this->data['newscategoryarr'] = $this->cms_model->get_categorylist();
		$this->load->view('media/common/header',$this->data);
		$this->load->view('media/common/sidebar');
		$this->load->view('media/faqedit',$this->data);
		$this->load->view('media/common/footer');
	}
	public function faq_delete($id=false)
	{		
		$result = $this->admin->delete('faqs','faq_id',$id);

		if($result){
			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');
		}else{
			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');
		}
		redirect('media/faq');
	}
}

?>