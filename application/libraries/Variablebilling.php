<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "/third_party/vendor/autoload.php";
use \Mpdf\Mpdf;
class Variablebilling {

    private $_CI;

    function __construct() {
        //	$this->_ci =& get_instance();
        $this->_CI = & get_instance();
        $this->_CI->load->library('pdf');
        //require_once APPPATH . "/third_party/vendor/autoload.php";
		
		
    }

    /*   public function __get($var)
      {
      return get_instance()->$var;
      } */
   public function generate_pdf($content, $name = 'download.pdf', $output_type = NULL, $footer = NULL, $margin_bottom = NULL, $header = NULL, $margin_top = NULL, $orientation = 'P') {
   
         $sitename = "Billing";
        if (!$output_type) {
            $output_type = 'D';
        }
        if (!$margin_bottom) {
            $margin_bottom = 10;
        }
        if (!$margin_top) {
            $margin_top = 10;
        }

		

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetTitle($sitename);
        $mpdf->SetAuthor($sitename);
        $mpdf->SetCreator($sitename);
        $mpdf->SetDisplayMode('fullpage');
       
            $mpdf->SetHTMLFooter('{PAGENO}');


         //$mpdf->SetProtection(array('print'));

         $mpdf->WriteHTML($content);
        if ($header != '') {
            $mpdf->SetHTMLHeader('<p class="text-center">' . $header . '</p>', '', TRUE);
        }
        if ($footer != '') {
            $mpdf->SetHTMLFooter('<p class="text-center">' . $footer . '</p>', '', TRUE);
        }
        //$pdf->SetHeader($this->Settings->site_name.'||{PAGENO}', '', TRUE); // For simple text header
        //$pdf->SetFooter($this->Settings->site_name.'||{PAGENO}', '', TRUE); // For simple text footer
        if ($output_type == 'F') {
           // $file_content = $pdf->Output('', 'assets');
           // write_file('assets/Invoice_pdf/'.$name, $file_content);
          //  return 'assets/uploads/' . $name;
          //chmod(base_url().'uploads',0755);
         
           $mpdf->Output('assets/Invoice_pdf/'.$name, $output_type);
        } else {
            $mpdf->Output($name, $output_type);
        }

        
   

       /* $mpdf->useSubstitutions = true; // optional - just as an example
        $mpdf->SetHeader('sss' . "\n\n" . 'Page {PAGENO}');  // optional - just as an example
        $mpdf->CSSselectMedia='mpdf'; // assuming you used this in the document header
        $mpdf->setBasePath("localhost/billing_live");
        $mpdf->WriteHTML($content);

        $mpdf->Output();*/
            
}
 
 
    
     
}
