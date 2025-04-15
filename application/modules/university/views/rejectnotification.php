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

   <div class="col-md-8 mx-auto">
        <div class="my-5">
			
            <!--<h4 class="mb-4 mt-4 text-uppercase text-center">UNIVERSITY VARIFICATION OF DOCUMENTS</h4>
            <p style="text-align:center;">Your payment has been received successfully.</p>
            <p style="text-align:center;">Reference code is sent to your register email id.</p>-->
			<?php
				//print_r($unvdetls); exit; 
				//if($unvdetls->reviewer_status < 1){
				//	//$dateexplode = explode(' ', $unvdetls->updated_at);
				//	//$date = $dateexplode[0];
				//	$newdate = strtotime ( '30 day' , strtotime ( $unvdetls->updated_at ) ) ;
				//	$ndate = date ( 'Y-m-j' , $newdate );
				//	 
				//	$date1 = new DateTime($ndate);
				//	$date2 = new DateTime(date('Y-m-d'));
				//	$interval = $date1->diff($date2);
				//	echo '<div class="verification-div-content"><div class="card">
                //      <div class="card-header headersection">Your submitted documents will be reviewed <br> by our agents within 30 days.</div>
                //      <div class="card-body text-center"><span style="font-size: 120px;color:#f12302;">'.$interval->days.'</span><br> Ramaining Days <br>(PROCESSING PERIOD COUNTDOWN)</div>
                //      <div class="card-footer headersection">You will receive an email if your application for <br> university was approve or disapprove.</div>
                //    </div>
				//	<p>Please check your email for the receipt and application number so that you can check the status of your application.</p>
				//	<span class="statusbtn">ON REVIEW</span></div>'; 
				//	 
				//	//echo '--'.$unvdetls->added_date;
				//	//echo $unvdetls->added_date;
				//	//echo 'Count Down';
				//}
				if($unvdetls->reviewer_status == 2){
					echo '<p class="text-center">Your application for School Accreditation has been <strong>DISAPPROVED.</strong></p>
                    <a class="statusbtn statusbtn2 viewemail" href="javascript:void(0);" data-id="'.$unvdetls->uniid.'">CLICK HERE TO VIEW EMAIL OF DISAPPROVAL</a>';
				}
				if($unvdetls->reviewer_status == 1){
					echo '<a href="'.base_url('university/university/digitalaccreditation/'.base64_encode($unvdetls->uniid)).'"><span class="statusbtn statusbtn2">Click here to view certificate</span></a>';
				}
			?>
			
        </div>
    </div>
<div class="modal fade viewemail-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="displaydetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div>


</div>
<script>
//$(document).ready(function() {
$( ".viewemail" ).click(function() {
    $('#displaydetials').html('Loading......');
    var uniid = $(this).data("id");
    if(uniid > 0){
        $.ajax({
	    	type: "POST",
	    	url: "<?php echo base_url();?>university/university/get_email_notification",
	    	data: { uniid : uniid},
	    	success: function(data) {
	    		//alert(data);
	    		$('#displaydetials').html(data); 
	    	}
	    });
        $('.viewemail-modal').modal('show');
    }
    
});
</script>	