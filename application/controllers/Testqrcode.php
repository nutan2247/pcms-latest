<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Testqrcode extends MX_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->library('ciqrcode');
		
	}
	public function index(){
		$filename = 'REG-212bb585-2021';
		$qr_image = time().'.png';
		$url = base_url('assets/uploads/pdf/'.$filename.'.pdf');
		$params['data'] = $url;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = './assets/testcard/'.$qr_image;
		$this->ciqrcode->generate($params);
		echo 'QR code generated<br>';
		echo 'to view qrcode in assets/qrcode directory';
	}
	public function card(){
		
		$html = $this->load->view('test_qrcode_card/profregisteration_card_pdf_preview','',TRUE);
		//echo $html;
		//exit;	
		// Get output html
		$this->load->library('Pdf');
		$this->dompdf = new DOMPDF();
		$this->dompdf->load_html($html);
		
		$this->dompdf->set_paper('A4','portrait');
		$this->dompdf->render();
		//file_put_contents('assets/testcard/'.time().'card.pdf', $this->dompdf->output($html));
		$this->dompdf->stream("card.pdf",array('Attachment'=>0));die;
	}
}
?>