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
</style>
<div class="col-md-8 mx-auto">
        <div class="my-5">
            
            <!--<h4 class="mb-4 mt-4 text-uppercase text-center">UNIVERSITY VARIFICATION OF DOCUMENTS</h4>
            <p style="text-align:center;">Your payment has been received successfully.</p>
            <p style="text-align:center;">Reference code is sent to your register email id.</p>-->
            <?php
                //print_r($unvdetls); exit; 
                if($unvdetls->reviewer_status < 1){



                    //$dateexplode = explode(' ', $unvdetls->updated_at);
                    //$date = $dateexplode[0];
                    $newdate = strtotime ( '30 day' , strtotime ( $unvdetls->cep_update_date ) ) ;

                    $ndate = date ( 'Y-m-j' , $newdate );

                   // echo $ndate; exit;
                     
                    $date1 = new DateTime($ndate);
                    $date2 = new DateTime(date('Y-m-d'));
                    $interval = $date1->diff($date2);
                    echo '<div class="verification-div-content"><div class="card">
                      <div class="card-header headersection">Your submitted documents will be reviewed <br> by our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="font-size: 120px;color:#f12302;">'.$interval->days.'</span><br> Remaining Days <br> (PROCESSING PERIOD COUNTDOWN)</div>
                      <div class="card-footer headersection">You will receive an email if your application for <br> CEP Accreditation was approve or disapprove.</div>
                    </div>
                    <p>Please check your email for the receipt and application number so that you can check the status of your application.</p>
                    <span class="statusbtn">ON REVIEW</span></div>'; 
                     
                    //echo '--'.$unvdetls->added_date;
                    //echo $unvdetls->added_date;
                    //echo 'Count Down';
                }
                if($unvdetls->reviewer_status == 2){
                    echo '<span class="rejectedbtn">REJECTED</span>';
                }
            ?>
            
        </div>
    </div>