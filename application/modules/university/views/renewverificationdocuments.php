<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION </h2>
</div>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
<style type="text/css">
    .error{ color:#ce2b2b; }
	.statusbtn{color: #fff;
    background-color: #ed7d31;
    padding: 8px;
    display: block;
    text-align: center;
    width: 30%;
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
</style>
<div class="col-lg-12 col-md-12">
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
        <div class="col-2" >            
            <a href="#">
                <span>5</span>
                <label>Digital Accreditation</label>
            </a>        
        </div>
    </div>

   <div class="col-md-8 mx-auto">
        <div class="my-5">
			
            <!--<h4 class="mb-4 mt-4 text-uppercase text-center">UNIVERSITY VARIFICATION OF DOCUMENTS</h4>
            <p style="text-align:center;">Your payment has been received successfully.</p>
            <p style="text-align:center;">Reference code is sent to your register email id.</p>-->
			<?php
				//print_r($unvdetls); exit; 
				if($unvdetls->reviewer_status < 1){
					$dateexplode = explode(' ', $unvdetls->updated_at);
					$date = $dateexplode[0];
					$newdate = strtotime ( '30 day' , strtotime ( $date ) ) ;
					$ndate = date ( 'Y-m-j' , $newdate );
					 
					$date1 = new DateTime($ndate);
					$date2 = new DateTime(date('Y-m-d'));
					$interval = $date1->diff($date2);
					echo '<div class="verification-div-content"><div class="card">
                      <div class="card-header headersection">Your submitted documents will be reviewed <br> By our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="font-size: 120px;color:#f12302;">'.$interval->days.'</span><br>  Ramaining Days (Processing Period countdown)</div>
                      <div class="card-footer headersection">You will receive an email if your application for <br> university was approve or disapprove.</div>
                    </div>
					<p>Please check you email for the receipt and application number so that you can check the status of your application.</p>
					<span class="statusbtn">ON REVIEW</span></div>'; 
					 
					//echo '--'.$unvdetls->added_date;
					//echo $unvdetls->added_date;
					//echo 'Count Down';
				}
				if($unvdetls->reviewer_status == 2){
					echo '<span class="rejectedbtn">REJECTED</span>';
				}
				if($unvdetls->reviewer_status == 1){
					redirect(base_url('university/university/digitalrenewaccreditation'), 'refresh');
				}
			?>
			
        </div>
    </div>


</div>
</div>
</div>
</div>
</section>