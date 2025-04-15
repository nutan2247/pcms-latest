<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//print_r($universitydetailsarr);
?>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
    <div class="container">
        <div class="row">
            <style type="text/css">
                .error {
                    color: #ce2b2b;
                }
            </style>
            <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
            <div class="col-lg-12 col-md-18">
                <div class="container">
                    <div class="row pro-steps">
                        <div class="col-2">
                            <a href="#" class="stepActive">
                                <span><strong>1</strong>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                                <label>School Information</label>
                            </a>

                        </div>
                        <div class="col-2">
                            <a href="#" class="stepActive">
                                <span><strong>2</strong>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                                <label>Business & Accreditation Documents</label>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="#" class="stepActive">
                                <span><strong>3</strong>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                                <label>Payment</label>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="#" class="stepActive">
                                <span><strong>4</strong>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                                <label>Verification of Documents</label>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="#" class="stepActive">
                                <span><strong>5</strong>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                                <label>Verification of Documents</label>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto mb-5">
                        <div class="gotolink">
                            <a href="javascript:void(0);" class="printbtn" alt="print" title="print"><i
                                    class="fa fa-print"></i></a> <a href="javascript:void(0);" class="printbtn" alt="download" title="download"><i class="fa fa-arrow-circle-down"></i></a>
                        </div>
						 <div class="text-center">
							<iframe src="<?php echo base_url('assets/uploads/pdf/').$universitydocument->accreditation_number.'.pdf'?>" width="100%" height="1150" frameborder="0"></iframe>
						</div>
                       
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<style>
    .gotolink {
        text-align: right;
    }
    
    .gotolink a {
        padding: 10px 14px;
        background-color: #2f5597;
        color: #fff;
        display: inline-block;
        border-radius: 3px;
    }
    
    @media print {
        #banner-grid {
            display: none !important;
        }
        .gotolink {
            display: none !important;
        }
        .pro-steps {
            display: none !important;
        }
        .top-header {
            display: none !important;
        }
        .header {
            display: none !important;
        }
        .footer-logostrip {
            display: none !important;
        }
        footer {
            display: none !important;
        }
        .dashboard-heropanel {
            display: none !important;
        }
        .leftmenu {
            display: none !important;
        }
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script>
    $(".printbtn").click(function() {
        // $("#printarea").show();
        window.print();
        /* var pdf = new jsPDF('p', 'pt', 'letter');
        pdf.canvas.height = 72 * 11;
        pdf.canvas.width = 72 * 8.5;
        pdf.fromHTML(document.body);
        pdf.save('test.pdf'); */
    });
</script>