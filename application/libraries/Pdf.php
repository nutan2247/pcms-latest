<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    protected $dompdf;

    public function __construct() {
        // Load the autoloader
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

        // Configure DOMPDF options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Enable remote assets like images, fonts, etc.

        // Initialize DOMPDF with the options
        $this->dompdf = new Dompdf($options);

        // Make the DOMPDF instance accessible in CodeIgniter
        $CI =& get_instance();
        $CI->dompdf = $this->dompdf;
    }

    /**
     * Load HTML content into DOMPDF
     */
    public function load_html($html) {
        $this->dompdf->loadHtml($html);
    }

    /**
     * Set paper size and orientation
     */
    public function set_paper($size, $orientation) {
        $this->dompdf->setPaper($size, $orientation);
    }

    /**
     * Render the PDF
     */
    public function render() {
        $this->dompdf->render();
    }

    /**
     * Stream the generated PDF to the browser
     */
    public function stream($filename = "document.pdf", $options = []) {
        $this->dompdf->stream($filename, $options);
    }

    /**
     * Save the generated PDF to a file
     */
    public function save_to_file($path) {
        file_put_contents($path, $this->dompdf->output());
    }
}
