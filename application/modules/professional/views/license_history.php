<?php defined("BASEPATH") or exit("No direct script access allowed");
//print_r($paymentarr);exit;
?>

<?php $this->view("professional_top"); ?>



<section class="dashboard-contentpanel py-lg-5 py-3 ">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-4">
                <?php $this->view("dashboard_left"); ?>
            </div>

            <div class="col-lg-9 col-md-8">
                <h4 class="mb-4 mt-4 text-uppercase text-center">Professional Identification Card (PIC) Renewal History</h4>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl No.</th>
                                <th>Application for</th>
                                <th>Date applied</th>
                                <th>Reference #</th>
                                <th>License No</th>
                                <th>Amount</th>
                                <th>Date Issued #</th>
                                <th>Validity Date</th>
                                <!-- <th>Duration</th> -->
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                    <?php
                        if (count($paymentarr) > 0) {
                             //echo '<pre>'; print_r($paymentarr);
                            $count = 1;
                            foreach ($paymentarr as $payments) {
                                $payment_type =  $payments->payment_type == "N" ? "Professional License" : "Renew Professional License";
                                $issued_date = date( "M d, Y", strtotime($payments->issued_date) );
                                $validity_date = date( "M d, Y", strtotime($payments->validity_date) );
                                echo "<tr>";
                                echo "<td>" . $count++ . ".</td>";
                                echo "<td>" . $payment_type . "</td>";
                                echo "<td>" . date( "Y-m-d", strtotime($payments->payment_date)). "</td>";
                                echo "<td>" . $payments->txn_id . "</td>";
                                echo "<td>" . $payments->license_no. "</td>";
                                echo "<td>" . $payments->payment_gross . "</td>";
                                echo "<td>" . $issued_date . "</td>";
                                echo "<td>" . $validity_date . "</td>";
                                // echo "<td>" . $duration . "</td>";
                                // echo "<td>" . $status . "</td>";
                                echo '<td>
                                    <button type="button" title="License Card" class="btn btn-info license_card mb-2" data-id="'.$payments->refrence_code.'"><i class="fa fa-credit-card" aria-hidden="true"></i></button>
                                </td>';
    // <button type="button" title="Certificate of Eligibility" data-id="'.$payments->refrence_code.'" class="btn btn-info license_cert"><i class="fa fa-certificate" aria-hidden="true"></i></button>
								
                                echo "</tr>";
                            }
                        } else {
                            echo '<tr style="text-align:center;color:red;"><th colspan="11" >No Accreditation History</th></tr>';
                        }

                        echo "</table>";
                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<script>
    $('.license_card').on('click', function(){
        var licenseno = $(this).attr("data-id");
        
        $('#carddetials').attr('src',''); 
        if(licenseno){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ licenseno +"card.pdf";
            // alert(path);
            $('#carddetials').attr('src',path); 
            $('#certificate-modal').modal('show'); // this modal is setteled in professional_top.php
        }else{
            alert('No license number found !');
        }
    });

    $('.license_cert').on('click', function(){
        var licenseno = $(this).attr("data-id");
        
        $('#carddetials').attr('src',''); 
        if(licenseno){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ licenseno +"cert.pdf";
            // alert(path);
            $('#carddetials').attr('src',path); 
            $('#certificate-modal').modal('show'); // this modal is setteled in professional_top.php
        }else{
            alert('No license number found !');
        }
    });
</script>