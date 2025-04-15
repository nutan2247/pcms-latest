<div id="layoutSidenav_content">
    <main>
        
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 "><span
                                class="d-inline-block border-bottom pb-2 px-3">Media'S TRACKER</span>
                        </h4>
                        <p class="text-center"><?php echo date('F d, Y');?></p>                        
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                            <img src="<?php echo base_url('assets/uploads/media/').$details->photo; ?>" style="width: 150px; height: 150px;" >
                            </div>
                            <div class="col-md-9 mx-auto">
                                <?php $created_on = $details->created_on; ?>
                                <ul style="list-style-type:none;">
                                    <li><?php echo ucwords($details->first_name.' '.$details->last_name); ?></li>
                                    <li>Appointment date: <?php echo date('F d,Y',strtotime($details->created_on));?></li>
                                    <li>Validity: <?php echo date('F d,Y',strtotime($details->validity_date));?></li>
                                </ul>

                                <!-- <div class="row mt-4">
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-warning px-5"><?php // echo $total_review_application; ?></button>
                                            <p class="mt-2">For Review Application</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php // echo $total_reviewed_application; ?></button>
                                            <p class="mt-2">Reviewed Application</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-success px-5"><?php // echo $total_approved_application;?></button>
                                            <p class="mt-2">Approved Application</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-danger px-5"><?php // echo $total_dispproved_application;?></button>
                                            <p class="mt-2">Dispproved Application</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
