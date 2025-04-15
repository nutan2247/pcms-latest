<?php //print_r($schedule);exit;?>
    <?php  $this->load->view('professional/include/profexam_banner'); ?>
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                        <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Foreign Professional Profile <br> & Exam Code</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>2</strong>
                        </span>
                        <label>Exam Booking</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>3</strong>
                        </span>
                        <label>Payment</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>4</strong>
                        </span>
                        <label>Examination Guidlines<br>and Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Exam Slip</label>-->
                        <label>Exam Pass</label>
                    </a>
                </div>
            </div>
    </div>


    <section class="licensure_examination_schedule">
    <div class="container">
        <div class="lic_exam_sche_inner border border-primary mb-5">
            <h4 class="bg-success text-uppercase p-3 text-center text-white"><?php echo $title; ?></h4>
            <div class="row">
            <!-- <?php print_r($booking_status); ?> -->
            <?php if(isset($booking_status) && $booking_status->payment=='0'){ ?>
                <!-- You have booked your exam you just need to pay the exam fee -->
                <div class="col-md-6">
                    <div class="p-3">
                        <label for="">You have already booked your exam, Please pay the examination fee to proceed.</label>
                        <h5 class="bg-primary text-uppercase p-3 text-center text-white"><?php echo date('F d,Y',strtotime($booking_status->exam_date)); ?><br> <?php echo date('H:i A',strtotime($booking_status->exam_start_time)); ?> to <?php echo date('H:i A',strtotime($booking_status->exam_end_time)); ?>
                        </h5>
                        
                        <div class="text-center mb-3">
                            <button type="button" id="payment-section" class="btn btn-danger" onclick="goToPayment('<?php echo $this->session->userdata('profexam_id');?>');">Pay Now</button>
                        </div>
                   
                    </div>
                </div>

            <?php }elseif(isset($booking_status) && $booking_status->payment=='1'){ ?>
                <!-- You have booked your exam and paid also -->

                <div class="col-md-6">
                    <div class="p-3">
                        <label for="">You have already booked this exam and you have paid the examination fee also.</label>
                        <div class="text-center mb-3">
                            <h5>Exam Details</h5>
                            <p>
                            Date: <?php echo date('F d,Y',strtotime($booking_status->exam_date)); ?><br>
                            Start Time: <?php echo date('H:i A',strtotime($booking_status->exam_start_time)); ?><br>
                            End Time: <?php echo date('H:i A',strtotime($booking_status->exam_end_time)); ?><br>
                            <!-- Venue: <?php echo $booking_status->exam_venue; ?><br> -->
                            </p>
                        </div>
                   
                    </div>
                </div>

            <?php }else{ ?>
            <?php if(count($schedule)>0){
                foreach($schedule as $value){ ?>
                <div class="col-md-6">
                    <div class="p-3">
                    <h5 class="bg-primary text-uppercase p-3 text-center text-white"><?php echo date('F d,Y',strtotime($value->date)); ?><br> <?php echo date('H:i A',strtotime($value->start_time)); ?> to <?php echo date('H:i A',strtotime($value->end_time)); ?>
                        <br>Venue : <?=$value->venue?><br>Maximum Examinees : <?=$value->maximum_applicant ?>
                    </h5>

                    <p class="text-center h4 my-3"> Registration Starts : <?php echo date('M d, Y',strtotime($value->reg_start_date)); ?> </p>
                    <p class="text-center h4 my-3"> Registration Ends : <?php echo date('M d, Y',strtotime($value->reg_end_date)); ?> </p>
                    
                    <?php if($value->reg_start_date > date('Y-m-d')){ ?>
                            <p class="text-center h4 my-3"> Registration Status : PENDING</p>
                        <?php }else
                        if($value->reg_start_date <= date('Y-m-d') && $value->reg_end_date >= date('Y-m-d')){ ?>
                            <p class="text-center h4 my-3"> Registration Status : OPEN </p>
                            <p class="text-center text-danger h4 my-3"> <strong class="h3"><?php echo $value->remaining_slot; ?> </strong> <br> Remaining Slots </p>
                            <div class="text-center mb-3">
                            <a href="#" onclick="book_exam_date('<?php echo $value->es_id;?>')" class="bg-success text-uppercase py-2  px-3 text-white rounded d-inline-block ">Book now</a>
                        <?php }else{ ?>
                            <p class="text-center h4 my-3"> Registration Status : CLOSED</p>
                    <?php } ?>
                </div>
                    <!--<h5 class="text-center">Maximum applicant : <?php //echo $value->maximum_applicant; ?></h5>-->
                    </div>
                </div>
            <?php } }else{ echo 'There is no exam in this year'; } ?>
            <?php } ?>
               <!--  <div class="col-md-6">
                    <div class="p-3">
                    <h5 class="bg-primary text-uppercase p-3 text-center text-white">May 1, 2021 <br> 8:00 am to 4:pm
                    </h5>
                    <p class="text-center text-danger h4 my-3"> <strong class="h3">2,203 </strong> <br> Total Examinees </p>
                   <div class="text-center mb-3">
                   <a href="#" onclick="book_exam_date('2')" class="bg-success text-uppercase py-2  px-3 text-white rounded d-inline-block ">Book now</a>
                   </div>
                    <h5 class="text-center">Maximum applicant : 2500</h5>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="bookedSlot" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Licensure Examination Schedule</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p id="success_exam_content">Your have selected this schedule : </p>
                    <span id="date"></span><br>
                    <span id="s_time"></span> To <span id="endtime"></span></br>
                    <span id="venue"></span>
                    <!-- <a href="" id="pay-btn" class="btn btn-danger">Pay Now</a> -->
                </div>
                <button type="button" class="btn btn-danger" onclick="goToPayment('<?php echo $this->session->userdata('profexam_id');?>');">Confirm and Pay Now</button>
            </div>

        </div>
    </div>
</div>

<!--        
    $(document).ready(function(){
        $("#bookedSlot").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
 -->
<script> 

    function book_exam_date(id){
        var uid = '<?php echo $this->session->userdata('profexam_id');?>';
        // alert(uid);
        $.ajax({
            url     : base_url+'professional/profexam/book_exam_date',
            type    : 'post',
            dataType: 'json',
            data    : {id : id, uid : uid},
          success: function(result){
            // console.log(result);
            if(result.last_id != undefined && result.error == '0' ){
                // $('#success_exam_content').html(result.msg);
                $('#date').html(result.date);
                $('#s_time').html(result.start_time);
                $('#endtime').html(result.end_time);
                $('#venue').html(result.venue);
                $('#payment-section').show();
                $('#bookedSlot').modal({
                    backdrop: 'static',
                    keyboard: false

                });
            }
            if(result.error == '2'){
                alert(result.msg);
                $('#payment-section').show();
            }
            if(result.error == '1'){
                alert(result.msg);
            }
            }
        })
    }

    function goToPayment(profexam_id){
        window.location.href="<?php echo base_url();?>professional/profexam/exam_payment/"+profexam_id;
    }
</script>

