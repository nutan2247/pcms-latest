<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Test extends MX_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */

	var $data = array();

 

	public function __construct(){



		parent:: __construct();

		// $this->check_session();

		$this->load->model('Admin_model','admin');

		

	}

	public function index(){
		echo'nutan';die;
	}



	public function dashboard()

	{		

		$data['title'] = 'Govt : Admin Dashboard';

		$data['count_cep'] = $this->admin->count_rows('tbl_cep','status','1');

		$data['count_professional'] = $this->admin->count_rows('tbl_users','','');

		$data['count_profession'] = $this->admin->count_rows('tbl_profession','status','1');

		$data['count_country'] = $this->admin->count_rows('tbl_countries','status','1');

		

		$this->load->view('admin/common/header',$data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/dashboard',$data);

		$this->load->view('admin/common/footer');

	}



	public function add($id = false)

	{	

		$this->data = array(

				'title' => 'Govt : Add Professional',

				'page_title' => 'Add Professional',

				'table_name' => 'Add Professional'

			);

		if($this->input->post()){

			if($this->input->post('listing_id')) 

			{

				$insert['user_ID'] = $this->input->post('listing_id');

			}else{

				$insert['added_on'] = date('Y-m-d H:i:s');

			}



			$insert['name']  			= $this->input->post('name');

			$insert['role']  			= $this->input->post('role');

			$insert['profession']  		= $this->input->post('profession');

			$insert['country']  		= $this->input->post('country');

			$insert['status']  			= $this->input->post('status');



			$insert['gender']  			= $this->input->post('gender');

			$insert['email']  			= $this->input->post('email');

			$insert['dob']  			= $this->input->post('dob');

			$insert['address']  		= $this->input->post('address');

			$insert['license_no']  		= $this->input->post('license_no');

			$insert['license_validity_date'] = $this->input->post('license_validity_date');



			// print_r($data);die;

			if($this->input->post('listing_id'))

			{	

				$updated = $this->admin->update('tbl_users',$insert,'user_ID',$this->input->post('listing_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_users',$insert);

			}

			redirect('admin/listing', 'refresh');

		}

		$this->data['country_list'] = $this->admin->get_result_object('tbl_countries','status','1');

		$this->data['profession_list'] = $this->admin->get_result_object('tbl_profession','status','1');

		$this->data['listing'] = $this->admin->get_row_object('tbl_users','user_ID',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/add',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function listing()

	{		

		$this->data = array(

				'title' => 'Govt : Professionals Listing',

				'page_title' => 'Professionals Listing',

				'table_name' => 'Professionals'

			);

		$data['listing'] = $this->admin->get_result_array('tbl_users','role','2');

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/listing',$data);

		$this->load->view('admin/common/footer');

	}



	public function view($id=false)

	{		

		$this->data = array(

				'title' => 'Govt : Professionals View',

				'page_title' => 'Professionals View',

				'table_name' => 'Professionals'

			);

		$data['view'] = $this->admin->get_row_object('tbl_users','user_ID',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function delete($id=false)

	{		

		$result = $this->admin->delete('tbl_users','user_ID',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/listing');

	}



	//Add CEP, Edit CEP , List CEP , Delete CEP



	public function cep_add($id = false)

	{	

		$this->data = array(

				'title' => 'Govt : Add CEP',

				'page_title' => 'Add CEP',

				'table_name' => 'Add CEP'

			);

		if($this->input->post()){

			if($this->input->post('listing_id')) 

			{

				$insert['cep_ID'] = $this->input->post('listing_id');

				$insert['updated_at'] = date('Y-m-d H:i:s');

			}else{

				$insert['added_on'] = date('Y-m-d H:i:s');

			}



			$insert['name']  			= $this->input->post('name');

			$insert['profession']  		= $this->input->post('profession');

			$insert['country']  		= $this->input->post('country');

			$insert['status']  			= $this->input->post('status');



			$insert['gender']  			= $this->input->post('gender');

			$insert['email']  			= $this->input->post('email');

			$insert['dob']  			= $this->input->post('dob');

			$insert['address']  		= $this->input->post('address');

			$insert['contact_person']  	= $this->input->post('contact_person');

			$insert['contact_no']  		= $this->input->post('contact_no');

			$insert['accreditation']  	= $this->input->post('accreditation');

			$insert['validity_date'] 	= $this->input->post('validity_date');



			// print_r($data);die;

			if($this->input->post('listing_id'))

			{	

				$updated = $this->admin->update('tbl_cep',$insert,'cep_ID',$this->input->post('listing_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_cep',$insert);

			}

			redirect('admin/cep_listing', 'refresh');

		}

		$this->data['country_list'] = $this->admin->get_result_object('tbl_countries','status','1');

		$this->data['profession_list'] = $this->admin->get_result_object('tbl_profession','status','1');

		$this->data['listing'] = $this->admin->get_row_object('tbl_cep','cep_ID',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/cep/add',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function cep_listing()

	{		

		$this->data = array(

				'title' => 'Govt : CEP Listing',

				'page_title' => 'CEP Listing',

				'table_name' => 'CEP'

			);

		$data['listing'] = $this->admin->get_result_array('tbl_cep','','');

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/cep/listing',$data);

		$this->load->view('admin/common/footer');

	}



	public function cep_view($id=false)

	{		

		$this->data = array(

				'title' => 'Govt : CEP View',

				'page_title' => 'CEP View',

				'table_name' => 'CEP'

			);

		$data['view'] = $this->admin->get_row_object('tbl_cep','cep_ID',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/cep/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function cep_delete($id=false)

	{		

		$result = $this->admin->delete('tbl_cep','cep_ID',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/cep_listing');

	}

 



	public function logout()

	{	

		// print_r($this->session->userdata());die;

		$this->session->unset_userdata('user_ID');

		$this->session->unset_userdata('ip_address');

		$this->session->sess_destroy();

		redirect('login/index');

	}



	public function check_session(){

		$user_ID = $this->session->userdata('user_ID');

		

		if(!$user_ID){

			redirect('login');

		}

	}



	//Add Profession, Edit Profession , List Profession , Delete Profession 

	

	public function add_profession($id = false)

	{	

		$this->data = array(

				'title' => 'Govt : Add Profession',

				'page_title' => 'Add Profession',

				'table_name' => 'Add Profession'

			);

		if($this->input->post()){

			if($this->input->post('profession_id')) 

			{

				$insert['id'] = $this->input->post('profession_id');

				$insert['updated_at'] = $this->input->post('updated_at');

			}else{

				$insert['added_on'] = date('Y-m-d H:i:s');

			}



			$insert['name']  			= $this->input->post('name');

			$insert['required_units']  	= $this->input->post('required_units');

			$insert['start_date']  		= $this->input->post('start_date');

			$insert['end_date']  		= $this->input->post('end_date');

			$insert['status']  			= $this->input->post('status');



			// print_r($data);die;

			if($this->input->post('profession_id'))

			{	

				$updated = $this->admin->update('tbl_profession',$insert,'id',$this->input->post('profession_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_profession',$insert);

			}

			redirect('admin/profession_listing', 'refresh');

		}

		$this->data['profession'] = $this->admin->get_row_object('tbl_profession','id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/profession/add',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function profession_listing()

	{		

		$this->data = array(

				'title' => 'Govt : Profession Listing',

				'page_title' => 'Profession Listing',

				'table_name' => 'Profession'

			);

		$data['listing'] = $this->admin->get_result_array('tbl_profession','','');

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/profession/listing',$data);

		$this->load->view('admin/common/footer');

	}



	public function profession_view($id=false)

	{		

		$this->data = array(

				'title' => 'Govt : Profession View',

				'page_title' => 'Profession View',

				'table_name' => 'Profession'

			);

		$data['view'] = $this->admin->get_row_object('tbl_profession','id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/profession/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function profession_delete($id=false)

	{		

		$result = $this->admin->delete('tbl_profession','id',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/profession_listing');

	}





	//Add Country, Edit Country , List Country , Delete Country 

	

	public function add_country($id = false)

	{	

		$this->data = array(

				'title' => 'Govt : Add Country',

				'page_title' => 'Add Country',

				'table_name' => 'Add Country'

			);

		if($this->input->post()){

			

			$insert['countries_name']     = $this->input->post('name');

			$insert['countries_iso_code'] = $this->input->post('iso_code');

			$insert['countries_isd_code'] = $this->input->post('isd_code');

			$insert['status']  			  = $this->input->post('status');



			// print_r($data);die;

			if($this->input->post('countries_id'))

			{	

				$updated = $this->admin->update('tbl_countries',$insert,'id',$this->input->post('countries_id')); 

				$this->session->set_flashdata('item', '<div class="alert alert-success">Record updated successfully.</div>');

					

			}else{

				$inserted	=	$this->admin->save('tbl_countries',$insert);

			}

			redirect('admin/profession_listing', 'refresh');

		}

		$this->data['countries'] = $this->admin->get_row_object('tbl_countries','countries_id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/country/add',$this->data);

		$this->load->view('admin/common/footer');

	}



	public function country_listing()

	{		

		$this->data = array(

				'title' => 'Govt : Country Listing',

				'page_title' => 'Country Listing',

				'table_name' => 'Country'

			);

		$data['countries'] = $this->admin->get_result_array('tbl_countries','','');

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/country/listing',$data);

		$this->load->view('admin/common/footer');

	}



	public function country_view($id=false)

	{		

		$this->data = array(

				'title' => 'Govt : Country View',

				'page_title' => 'Country View',

				'table_name' => 'Country'

			);

		$data['view'] = $this->admin->get_row_object('tbl_countries','countries_id',$id);

		$this->load->view('admin/common/header',$this->data);

		$this->load->view('admin/common/sidebar');

		$this->load->view('admin/country/view',$data);

		$this->load->view('admin/common/footer');

	}



	public function country_delete($id=false)

	{		

		$result = $this->admin->delete('tbl_countries','countries_id',$id);

		if($result){

			$this->session->set_flashdata('item', '<div class="alert alert-success">Record deleted successfully.</div>');

		}else{

			$this->session->set_flashdata('item', '<div class="alert alert-danger">Something went wrong, please try again! </div>');

		}

		redirect('admin/country_listing');

	}
	public function designer_test()
	{
		$this->load->view('include/header',$this->data);
		$this->load->view('designer/design.php',$this->data);
		$this->load->view('include/footer',$this->data);
	}





}



?>