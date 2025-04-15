
<style type="text/css">
  
  .radio-class{
    width: 18px;
    height: 18px;
  }

#my-div {
    width: 1100px;
    height: 500px;
    overflow: hidden;
    position: relative;
}

#my-iframe {
    position: absolute;
    top: -300px;
    left: -1px;
    width: 1000px;
    height: 1000px;
}
</style>


    <?php echo $this->load->view('ce-provider/common/training_course_banner'); ?>

  <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>2</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Online Course File</label>
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
                        <label>Review of Online Course</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Digital Accreditaion</label>-->
                        <label>Digital Certificate of Accreditaion</label>
                    </a>
                </div>
        </div>
    </div>


    <div class=" rounded mb-5">
        <div class="col-md-6 mx-auto text-left">
            <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>  
        </div>
    </div>
                  

           <?php //print_r($details); ?> 

        <div class="col-md-8 mx-auto">
            <div class="bg-light py-12">
                <div class="col-md-12">
                    <?php
                        //print_r($unvdetls); exit;
                        if($training_details->reviewer_status < 1){
                            $date = $training_details->applied_date;
                            $newdate = strtotime ( '30 day' , strtotime ( $date ) ) ;
                            $ndate = date ( 'Y-m-j' , $newdate );
                             
                            $date1 = new DateTime($ndate);
                            $date2 = new DateTime(date('Y-m-d'));
                            $interval = $date1->diff($date2);
                            echo '<div class="verification-div-content"><div class="card">
                              <div class="card-header">Your document submitted will be reviewed <br> By our agents within 30 days.</div>
                              <div class="card-body text-center"><span style="font-size: 120px;">'.$interval->days.'</span><br> Remaining Days <br> (PROCESSING PERIOD COUNTDOWN)</div>
                              <div class="card-footer">You will receive an email if your application for <br> university was approve or disapprove.</div>
                            </div><p style="text-align:center;font-weight:bold;">YOUR VARIFICATION OF DOCUMENTS IS <span style="color:red;">PENDING</span></p></div>'; 
                             
                            //echo '--'.$unvdetls->added_date;
                            //echo $unvdetls->added_date;
                            //echo 'Count Down';
                        }
                        if($training_details->reviewer_status == 2){
                            echo '<p style="text-align:center;font-weight:bold;">YOUR VARIFICATION OF DOCUMENTS IS <span style="color:red;">REJECTED</span></p>';
                        }
                        if($training_details->reviewer_status == 1){
                            echo '<p style="text-align:center;font-weight:bold;">YOUR VARIFICATION OF DOCUMENTS IS <span style="color:green;">APPROVED</span></p>';
                        }
                    ?>
                   <!--<div class="card">
                      <div class="card-header">Your document submitted will be reviewed <br> By our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="font-size: 120px;">30</span><br> days Remaining</div>
                      <div class="card-footer">You will receive an email if your application for <br> Online examination was approve or disapprove.</div>
                    </div>
                        <button type="button" id="review_pending" class="btn btn-danger text-uppercase">Pending</button>
                        
                        <button type="button" id="review_success" style="display: none;" class="btn btn-success text-uppercase">Success</button> -->
                </div>
            </div>

        </div>

 <!-- Rboard modal -->

    <div class="modal fade r-board-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
        <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
         
        </div>
            <div class="table-responsive">
                <div class="text-center">Step 1</div><br>
                <div class="text-center">Business and Accreditation Verification</div><br><br>
                <div class="text-center">Successfully completed</div>
                <div class="text-center pro-steps">
                       
                       <a href="#" class="stepActive">
                    <span>
                        <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    
                </a>

                </div>

                <div class="text-center">Please proceed to step 2.</div>
            </div>
            
            <div class="profassion">
                <div class="table-responsive"></div>
            </div>
            <div class="d-match text-center my-2"><img src="images/Untitled-2.png" alt=""></div>
            <div class="form-group row">
                <div class="col-md-10 text-center">
                    
                    <a class="btn btn-success text-uppercase proceed_to_second_step" href="">Next Step</a>

                    
                </div>
            </div>
        </div>
      
      </div>
    </div>
  </div>





  <script type="text/javascript">
    
    $(document).ready(function(){
        $('.iframe_cclass').on('click',function(){
        var id = $('input[name=choose]:checked', '#course_payment').val();
        // alert(id);
        var path = 'https://www.ceonpoint.com/pages/course_details/'+id;
        $('#my-iframe').attr('src',path);
        });
    });

  </script>
    