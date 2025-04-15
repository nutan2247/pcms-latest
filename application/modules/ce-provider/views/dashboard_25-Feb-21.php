<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <section class="dashboard-heropanel jumbotron py-lg-5 mt-5 py-3 border-bottom border-primary mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-2">
                        <img class="img-fluid img-rounded d-block mx-auto" width="200px" height="200px" src="<?php echo base_url('assets/images/ce_provider/').$user_details->company_logo; ?>" alt="">
                        <h5 class="mt-3"><?php echo $user_details->business_name; ?></h5>
                         <p><strong>Accrediation no: </strong>1234567890</p>
                         <p><strong>Validate Date: </strong><?php echo date('F d Y',strtotime(date('Y-m-d')))?></p>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo $count_course; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Online Courses</h6>
                            <a href="<?php echo base_url('ce-provider/CE_provider/course_application'); ?>" class="btn btn-info bg-success w-100" id="online-course-app">Submit Online Courses</a>
                        </div>
                        
                        <div class="col-lg-4">
                        <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo $count_training; ?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Training Courses</h6>
                            <a href="<?php echo base_url('ce-provider/CE_provider/training_application'); ?>" class="btn btn-info bg-success w-100" id="training-course-appp">Submit Training Courses</a>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center d-inline-block w-100 h-50 text-white bg-secondary p-2 rounded">
                                <h4 class="pt-2">251</h4>
                                <span>Days Remaining</span>
                            </div>
                            <h6 class="py-3 text-center">Accrediation Status:Valid</h6>
                            <button type="button" class="btn btn-info bg-secondary w-100">Renew Accrediation</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8"></div>
            </div>
        </div>
    </section>