<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rboarddemo extends MX_Controller {
	

	public function __construct(){
		parent::__construct();
		// $this->load->model('Landing_model','landing');
	}

	public function demo1(){
		$this->data = array('title'=> 'Regulatry Board Rboard demo 1');
		$this->load->view('include/header',$this->data);
		$this->load->view('license/rboarddemo1',$this->data);
		$this->load->view('include/footer',$this->data);
	}	

	public function demo2(){
		$this->data = array('title'=> 'Regulatry Board RBoard demo 2');
		$this->load->view('include/header',$this->data);
		$this->load->view('license/rboarddemo2',$this->data);
		$this->load->view('include/footer',$this->data);
	}

}
?>