<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

//echo '<pre>'; print_r($gradArr); exit;
?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
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
	.statusbtn2{color: #fff;
    background-color: #ed7d31;
    padding: 8px;
    display: block;
    text-align: center;
    width: 50%;
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
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title; ?></h2>
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
                <span><strong>2</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>List of Graduates</label>
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
                <label>Review of Graduates</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Licensure Examination Pass</label>
            </a>        
        </div>
    </div>
    </div>

        <div class="col-md-8 mx-auto">
        <div class="my-5">
			
            <?php
				if(isset($informat) && $informat != ""){
					echo $informat;
				}else{
				//print_r($gradArr); exit; 
				$graducateslisting = '';
				if(is_array($gradArr)){
					$graducateslisting .= '<table class="table table-bordered">
					<tr>
						<th>Sl.</th>
						<th>Name</th>
						<th>Refrence Code</th>
						<th>Exam Code</th>
						<th>Reviewer Status</th>
						<th>Ramaining Days</th>
					</tr>';
					$count = 1;
					$remainingdays ='';
					foreach($gradArr as $grd){
						if($grd->reviewer_status < 1){
							$status = 'ON REVIEW';
							$newdate = strtotime ( '30 day' , strtotime ( $grd->updated_at ) ) ;
							$ndate = date ( 'Y-m-j' , $newdate );
							$date1 = new DateTime($ndate);
							$date2 = new DateTime(date('Y-m-d'));
							$interval = $date1->diff($date2);
							$remainingdays = $interval->days;
						}if($grd->reviewer_status > 0){
							$remainingdays = 0;
						}
						if($grd->reviewer_status == 1){
							$status = 'APPROVED';
						}
						if($grd->reviewer_status == 2){
							$status = 'REJECTED';
						}
						$examcode = ($grd->examcode !="")?$grd->examcode:'--';
						$graducateslisting .= '<tr>
								<td>'.$count++.'.</td>
								<td>'.$grd->student_name.' '.$grd->middle_name.' '.$grd->surname.'</td>
								<td>'.$grd->refrence_code.'</td>
								<td>'.$examcode.'</td>
								<td>'.$status.'</td>
								<td>'.$remainingdays.'</td>
							</tr>';
					}
					$graducateslisting .= '</table>';
					//echo $graducateslisting;
				}
				
					//$dateexplode = explode(' ', $gradArr->updated_at);
					//$date = $dateexplode[0];
					
					echo '<div class="verification-div-content">
					<div class="card">
                      <div class="card-header headersection">Your submitted documents will be reviewed <br> by our agents within 30 days.</div>
                      <!--<div class="card-body text-center"><span style="font-size: 120px;color:#f12302;"></span><br> Ramaining Days (PROCESSING PERIOD COUNTDOWN)<br>'.$graducateslisting.'</div>-->
					  <p>'.$graducateslisting.'</p>
                      <div class="card-footer headersection">You will receive an email if your application for
					  licensure examination of graduates has been approved.</div>
                    </div>
					<p>Please check your email for the receipt and application number so that you can check the status of your application.</p>
					<!--<span class="statusbtn">ON REVIEW</span>--></div>'; 
					 
					//echo '--'.$gradArr->added_date;
					//echo $gradArr->added_date;
					//echo 'Count Down';
				 
				}
			?>
    </div>
    </div>
