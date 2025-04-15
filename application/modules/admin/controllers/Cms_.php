<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
        }
		

        /* Title Page :: Common */
        $this->page_title->push('Cms');
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Cms', 'admin/cms');
		$this->load->model('admin/cms_model');
    }


	public function index() {
        
		/* Breadcrumbs */
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['cmss'] = $this->cms_model->get_list();
		
		/* Load Template */
		$this->template->admin_render('admin/cms/index', $this->data);
		
	}

	/**
	 * 
	 * Add/Edit a Contest
	 * @access  public
	 * @param  	int
	 * @return  void
	 */
	public function edit($id = false) { 
		/* Breadcrumbs */
		$this->data['breadcrumb']	= $this->breadcrumbs->show();
		
        $cms = false;
		if($this->input->post()) {
			// banner upload		
				//print_r($_FILES["banner"]); exit;
			$banner = '';
			if(isset($_FILES["banner"]) && !empty($_FILES["banner"]['name'])){				
				$config['upload_path'] 		= './assets/images/banner/';
				//$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['allowed_types'] 	= '*';
				//$config['max_size'] 		= '200000';
				//$config['max_width']  	= '1500';
				//$config['max_height']  	= '800';        
				$ext 						= explode('.',$_FILES["banner"]["name"]);        
				$banner 					= 'banner_'.time().'.'.end($ext);
				$config['file_name'] 		= $banner;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('banner'))
				{
				$error = array('error' => $this->upload->display_errors());                       
					//print_r($error); exit;
				}  
				$banner = $banner;
			}else{
				$banner = $this->input->post('old_banner');
			}
			
			//echo $cv;
			// end image upload
			if($this->input->post('cms_id')) {
				$data['cms_id'] = $this->input->post('cms_id');
				$data['modified_at'] = date('Y-m-d H:i:s');
			} else {
				$data['added_at'] = date('Y-m-d H:i:s');
			}
			$data['cms_title']  			= $this->input->post('cms_title');
			$data['cms_url']  				= $this->input->post('cms_url');
			$data['cms_description']    	= $this->input->post('cms_description');
			$data['cms_meta_title']			= $this->input->post('cms_meta_title');
			$data['cms_meta_description']	= $this->input->post('cms_meta_description');
			$data['cms_meta_keyword']		= $this->input->post('cms_meta_keyword');
			$data['bannertext']				= $this->input->post('bannertext');
			$data['banner']					= $banner;
			$data['cms_status']				= $this->input->post('cms_status');
			
			if($this->input->post('cms_id')) {
				$updated = $this->cms_model->update($data, $this->input->post('cms_id')); 
				// if($updated) { 
					$this->session->set_flashdata('item', array('message' => 'Record updated successfully','class' => 'alert-success'));
				// } else {
					// $this->session->set_flashdata('item', array('message' => 'please try again!','class' => 'alert-warning'));
				// }
			} else {
				$inserted	=	$this->cms_model->insert($data);
			}
			
            redirect('admin/cms', 'refresh');
		}
		
		if($id) {
			$this->data['cms'] = $this->cms_model->get_one($id);
			
            if(!$this->data['cms']) {
                redirect('admin/cms', 'refresh');
			}
		} else {
			//$this->data['cms'] = "";
		}
		
		$this->template->admin_render('admin/cms/edit', $this->data);
	}
	
}
