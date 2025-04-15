<?php //echo $this->session->userdata('grad_id');exit;?>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">
        <?php echo $page_title; ?>
    </h2>
</div>

<section class="licensure_examination_schedule">
    <div class="container">
        <div class="lic_exam_sche_inner border border-primary mb-5">
            
            <div class="row">
            <?php if(is_array($schedule)?count($schedule):0){
                foreach($schedule as $value){ ?>
                <div class="col-md-6">
                    <!-- <?php //if($value->remaining_slot > 0){ ?> -->
                    <div class="p-3">
                        <h5 class="bg-primary text-uppercase p-3 text-center text-white"><?php echo date('F d,Y',strtotime($value->date)); ?><br> <?php echo date('H:i A',strtotime($value->start_time)); ?> to <?php echo date('H:i A',strtotime($value->end_time)); ?>
                            <br> Venue : <?=$value->venue?><br>Maximum Examinees : <?=$value->maximum_applicant ?> 
                            <br> Registration Date : <?=date('M d, Y',strtotime($value->reg_start_date)); ?> - <?=date('M d, Y',strtotime($value->reg_end_date)); ?> 
                        </h5>
                        <?php if($value->reg_end_date >= date('Y-m-d') && $value->remaining_slot > 0){ ?>
                        <p class="text-center text-danger h4 my-3"> <strong class="h3"><?php echo $value->remaining_slot; ?> </strong> <br> Remaining Slots </p>
                        <div class="text-center mb-3">
                            <a href="<?php echo $redirect.'?es_id='.$value->es_id; ?>" class="bg-success text-uppercase py-2  px-3 text-white rounded d-inline-block ">Book now</a>
                            </div>
                        <?php }else{
                            echo '
                            <div class="text-center mb-3"><a href="#" class="bg-danger text-uppercase py-2  px-3 text-white rounded d-inline-block ">Booking Closed</a></div>';
                        } ?>
                         
                        <!--<h5 class="text-center">Maximum applicant : <?php echo $value->maximum_applicant; ?></h5>-->
                    </div>
                </div>
            <?php } 
         } ?>
         
            </div>

        </div>
    </div>
</section>




<div class="modal fade" id="bookedSlot" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookedSlotLabel">Licensure Examination Schedule</h5>
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
                <button type="button" class="btn btn-danger" onclick="goToPayment('<?php echo $this->session->userdata('grad_id');?>');">Confirm and Pay Now</button>
            </div>

        </div>
    </div>
</div>
