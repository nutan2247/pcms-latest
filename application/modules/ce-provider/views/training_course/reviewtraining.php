<?php echo $this->load->view('ce-provider/common/training_course_banner'); ?>
                
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP & Accreditaion Verification</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>2</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Online Training Course File</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>3</strong>
							 <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Payment</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>4</strong>
                        </span>
                        <label>Verification of Documents</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <label>Certificate of Accreditation</label>
                    </a>
                </div>
            </div>
    </div>

    <div class="bg-light py-4">
        
		<div class="col-md-8 mx-auto">
        <div class="my-5">
			
           
			<?php
				//print_r($tradtls); exit; 
				if($training_details->reviewer_status < 1){
					$dateexplode = explode(' ', $training_details->applied_date);
					$date = $dateexplode[0];
					$newdate = strtotime ( '30 day' , strtotime ( $date ) ) ;
					$ndate = date ( 'Y-m-j' , $newdate );
					 
					$date1 = new DateTime($ndate);
					$date2 = new DateTime(date('Y-m-d'));
					$interval = $date1->diff($date2);
					echo '<div class="verification-div-content"><div class="card">
                      <div class="card-header">Your document submitted will be reviewed <br> by our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="color:#f12302; font-size: 120px;">'.$interval->days.'</span><br> Remaining Days <br> (PROCESSING PERIOD COUNTDOWN)</div>
                      <div class="card-footer">You will receive an email if your application for <br> training was approve or disapprove.</div>
                    </div><p style="text-align:center;font-weight:bold;">YOUR VERIFICATION OF DOCUMENTS IS <span class="btn btn-info">PENDING</span></p></div>'; ?> 
                    <a href="javascript:void(0);" class="btn btn-primary" title="Print" onclick="printElem('tra-app-form');">Print Application Form</a>
				<?php
                    //echo '--'.$unvdetls->added_date;
					//echo $unvdetls->added_date;
					//echo 'Count Down';
				}
				if($training_details->reviewer_status == 1){
                    $url = base_url('ce-provider/ce_provider/digitalaccreditaion_training/'.base64_encode($training_details->train_doc_id));
					echo '<p style="text-align:center;font-weight:bold;">TRAINING VERIFICATION OF DOCUMENTS IS <span class="btn btn-success">APPROVED</span><br><a href="'.$url.'" class="btn btn-danger">VIEW CERTIFICATE</a></p>';
				}
				if($training_details->reviewer_status == 2){
					echo '<p style="text-align:center;font-weight:bold;">TRAINING VERIFICATION OF DOCUMENTS IS <span class="btn btn-danger">REJECTED</span></p>';
				}
			?>
			
        </div>
    </div>
    </div><br>
<div id="tra-app-form" style="display:none;">
<style>
    table, td, th {  
      border: 1px solid #ddd;
      text-align: left;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 10px;
    }
</style>
<?php $profession = '';
    if($tradtls->traprofession != ''){
        $professionarr = explode(',', $tradtls->traprofession);
        foreach($professionarr as $value){
            $pro_name = $this->db->get_where('tbl_profession',array('id'=>$value))->row()->name;
            $profession .= $pro_name.', ';
        }
    }
?>

    <h3 class="border-title text-left">Online Training Application Form</h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Business name:</th>
                <td><?=$tradtls->business_name?></td>
                <th>Company Logo</th>
                <td><img src="<?=base_url('assets/images/ce_provider/'.$tradtls->company_logo)?>" alt="logo" width="60px;" height="60px;"></td>
            </tr>
            <tr>
                <th>Refrence Number</th>
                <td colspan="3"><?=$tradtls->refrence_code?></td>
            </tr>
            <tr>
                <th>Training name</th>
                <td colspan="3"><?=$tradtls->training_title?></td>
            </tr>
            <tr>
                <th>Profession</th>
                <td colspan="3"><?=$profession?></td>
            </tr>
            <!--<tr>
                <th>Contact Person</th>
                <td colspan="3"><?=$unvdetls->contact_person?></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td colspan="3"><?=$unvdetls->designation?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td colspan="3"><?=$unvdetls->email?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td colspan="3"><?=$unvdetls->phone?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td colspan="3"><?=$unvdetls->countries_name?></td>
            </tr>-->
            <tr>
                <th>Upload Document 1</th>
                <td colspan="3"><?=($tradtls->training_image != '')?'Training Image':'--'; ?></td>
            </tr>
            <tr>
                <th>Upload Document 2</th>
                <td colspan="3"><?=($tradtls->training_pdf != '')?'Training Pdf':'--'; ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td colspan="3"><?=$tradtls->payment_status; ?></td>
            </tr>
            <tr>
                <th>Transaction Id</th>
                <td colspan="3"><?=$tradtls->txn_id; ?></td>
            </tr>
            <tr>
                <th colspan="4" >Please attach your original document with this application form.</th>
            </tr>
        </tbody>
    </table>
</div>
    <script>

        function goToReviewDocuments(){
            // alert('comming soon!');
            // window.location.href="<?php echo base_url();?>professional/applicant/review_doc";
        }
    </script>
<script type="text/javascript">
    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>