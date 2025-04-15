<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
        <div class="col-2" >            
            <a href="#" class="stepActive">
                <span><strong>5</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>Licensure Examination Pass</label>
            </a>        
        </div>
    </div>

        <div class="col-md-8 mx-auto">
        <div class="my-5">
			
            <?php
				if(isset($informat) && $informat != ""){
					echo $informat;
				}else{
				//print_r($gradArr); exit; 
				if($gradArr->reviewer_status == 1){
					//$dateexplode = explode(' ', $gradArr->updated_at);
					//$date = $dateexplode[0];
					$newdate = strtotime ( '30 day' , strtotime ( $gradArr->updated_at ) ) ;
					$ndate = date ( 'Y-m-j' , $newdate );
					 
					$date1 = new DateTime($ndate);
					$date2 = new DateTime(date('Y-m-d'));
					$interval = $date1->diff($date2);
					echo '<div class="verification-div-content"><div class="card">
                      <br><p style="text-align:center;">Licensure Examination Pass : <b>'.$gradArr->examcode.'</b>
                      <div class="card-body text-center"></div>
                    </div>
					'; 
				}
				
				}
			?>
			
        </div>
    </div>
    </div>
  </div>

