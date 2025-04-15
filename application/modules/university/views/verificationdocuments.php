<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .error{ color:#ce2b2b; }
	.statusbtn{color: #fff;
    background-color: #ed7d31;
    padding: 8px;
    display: block;
    text-align: center;
    width: 22%;
    margin: 9px auto;
    border-radius: 5px;
    font-size: 24px;
    font-weight: 500;}
	.rejectedbtn{color: #fff;
    background-color: #f12302;
    padding: 8px;
    display: block;
    text-align: center;
    width: 22%;
    margin: 9px auto;
    border-radius: 5px;
    font-size: 24px;
    font-weight: 500;
	}
	.headersection {text-align: center;background-color: #00b0f0;font-size: 18px;font-weight: 500;}
	.statusbtn2{ width: 50%;}
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION </h2>
</div>



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
                <span><strong>1</strong>
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
            <a href="#">
                <span>5</span>
                <!--<label>Digital Accreditation</label>-->
				<label>Digital Certificate of Accreditation</label>
            </a>        
        </div>
    </div>
    <?php //print_r($this->session->all_userdata())?>
    <div class="col-md-8 mx-auto">
        <div class="my-5">
			
            <!--<h4 class="mb-4 mt-4 text-uppercase text-center">UNIVERSITY VARIFICATION OF DOCUMENTS</h4>
            <p style="text-align:center;">Your payment has been received successfully.</p>
            <p style="text-align:center;">Reference code is sent to your register email id.</p>-->
			<?php 
				//echo'<pre>';
                //print_r($universitydetailsarr); 
                //print_r($unvdetls);
                //exit; 
				if($unvdetls->reviewer_status < 1){
					//$dateexplode = explode(' ', $unvdetls->updated_at);
					//$date = $dateexplode[0];
					$newdate = strtotime ( '30 day' , strtotime ( $unvdetls->updated_at ) ) ;
					$ndate = date ( 'Y-m-j' , $newdate );
					 
					$date1 = new DateTime($ndate);
					$date2 = new DateTime(date('Y-m-d'));
					$interval = $date1->diff($date2);
					echo '<div class="verification-div-content"><div class="card">
                      <div class="card-header headersection">Your submitted documents will be reviewed <br> by our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="font-size: 120px;color:#f12302;">'.$interval->days.'</span><br> Ramaining Days <br>(PROCESSING PERIOD COUNTDOWN)</div>
                      <div class="card-footer headersection">You will receive an email if your application for <br> university was approve or disapprove.</div>
                    </div>
					<p>Please check your email for the receipt and application number so that you can check the status of your application.</p>
					<span class="statusbtn">ON REVIEW</span></div>'; ?>
                    <a href="javascript:void(0);" class="btn btn-primary" title="Print" onclick="printElem('uni-app-form');">Print Application Form</a>
                <?php	 
					//echo '--'.$unvdetls->added_date;
					//echo $unvdetls->added_date;
					//echo 'Count Down';
				 }
				if($unvdetls->reviewer_status == 2){
					echo '<span class="rejectedbtn">REJECTED</span>';
				}
				if($unvdetls->reviewer_status == 1){
					echo '<a href="'.base_url('university/university/digitalaccreditation/'.base64_encode($unvdetls->uniid)).'"><span class="statusbtn statusbtn2">Click here to view certificate</span></a>';
				}
                
			?>
			
        </div>
    </div>
</div>
<div id="uni-app-form" style="display:none;">
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
    <h3 class="border-title text-left">Univercity Application Form</h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>University name:</th>
                <td><?=$universitydetailsarr->university_name?></td>
                <th>University Logo</th>
                <td><img src="<?=base_url('assets/images/university/'.$universitydetailsarr->college_logo)?>" alt="logo" width="60px;" height="60px;"></td>
            </tr>
            <tr>
                <th>Refrence Number</th>
                <td colspan="3"><?=$universitydetailsarr->refrence_code?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3"><?=$universitydetailsarr->address?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td colspan="3"><?=$universitydetailsarr->email?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td colspan="3"><?=$universitydetailsarr->contact_no?></td>
            </tr>
            <tr>
                <th>Name of Representative</th>
                <td colspan="3"><?=$universitydetailsarr->name_of_representative?></td>
            </tr>
            <tr>
                <th>Business License No</th>
                <td colspan="3"><?=$universitydetailsarr->business_license_number?></td>
            </tr>
            <tr>
                <th>Validity Date</th>
                <td colspan="3"><?=date('d M-Y',strtotime($universitydetailsarr->validity_date))?></td>
            </tr>
            <tr>
                <th>Accreditation No. (from Department of Education)</th>
                <td colspan="3"><?=$universitydetailsarr->accreditation_no?></td>
            </tr>
            <tr>
                <th>Validity Date</th>
                <td colspan="3"><?=date('d M-Y',strtotime($universitydetailsarr->accreditation_validity_date))?></td>
            </tr>
            <tr>
                <th>Upload Document 1</th>
                <td colspan="3"><?=($universitydetailsarr->business_license != '')?'Business License':'--'; ?></td>
            </tr>
            <tr>
                <th>Upload Document 2</th>
                <td colspan="3"><?=($universitydetailsarr->accreditation != '')?'Accreditation Document':'--'; ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td colspan="3"><?=$paydetls->payment_status; ?></td>
            </tr>
            <tr>
                <th>Transaction Id</th>
                <td colspan="3"><?=$paydetls->txn_id; ?></td>
            </tr>
            <tr>
                <th colspan="4" >Please attach your original document with this application form.</th>
            </tr>
        </tbody>
    </table>
</div>

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