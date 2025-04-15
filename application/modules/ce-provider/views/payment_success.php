<div class="col-md-10 mx-auto">

  <div class="bg-light py-12">
                <div class="col-md-12">
          <?php
           // print_r($cep_details); exit;
            if(!empty($cep_details)){
              $date = $cep_details->cep_update_date;
              $newdate = strtotime ( '30 day' , strtotime ( $date ) ) ;
              $ndate = date ( 'Y-m-j' , $newdate );
               
              $date1 = new DateTime($ndate);
              $date2 = new DateTime(date('Y-m-d'));
              $interval = $date1->diff($date2);
              echo '<div class="verification-div-content"><div class="card">
                <div class="card-header">Your document submitted will be reviewed <br> By our agents within 30 days.</div>
                <div class="card-body text-center"><span style="color:#f12302; font-size: 120px;">'.$interval->days.'</span><br> Days</div>
                <div class="card-footer">You will receive an email if your application for <br> CEP Accreditation was approve or disapprove.</div>
              </div>'; 
               
            }
            if($cep_details->cep_status == 0){
              echo '<p style="text-align:center;font-weight:bold;">YOUR VARIFICATION OF DOCUMENTS IS <span style="color:red;">PENDING</span></p></div>';
            }
            if($cep_details->cep_status == 2){
              echo '<p style="text-align:center;font-weight:bold;">YOUR VARIFICATION OF DOCUMENTS IS <span style="color:red;">REJECTED</span></p></div>';
            }
            if($cep_details->cep_status == 1){
              echo '<p style="text-align:center;font-weight:bold;">YOUR VARIFICATION OF DOCUMENTS IS <span style="color:green;">APPROVED</span></p></div>';
            }
          ?>
                
                </div>
            </div>

</div>
    
    