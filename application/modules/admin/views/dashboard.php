<?php   $subscription = $this->common_model->get_admin_subscription_details();
        $current_application = $this->common_model->get_online_application_count();

        if(isset($subscription->no_of_application) && $subscription->no_of_application == 0 && $subscription->subscription_id == 6){
            $no_of_applcation = 'Unlimited'; 
            $used_onlineapplication  = $current_application;
            $remaining_onlineapplication = 'Unlimited'; 
            $total_onlineapplication = $no_of_applcation; 
        }else{
            $no_of_applcation = $subscription->total_application;    
            $total_onlineapplication = $no_of_applcation;
            $used_onlineapplication  = $current_application;
            $remaining_onlineapplication = $total_onlineapplication - $used_onlineapplication;
        }

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
        <h5 class="btn-danger text-light p-2 mt-4 online-appication-btn">ADMIN TRACKER</h5>
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h6 class="text-center my-2 ">INCOME REPORT SUMMARY</h6>
                        <!--<p class="text-center">JANUARY 1, 2021 - December 31, 2021</p>-->
                        <p class="text-center">
                            <?php echo date('F d, Y');?>
                        </p>
                        <div class="row mt-4 border-bottom">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$
                                        <?php echo ($todayincome->totalincome >0)?$todayincome->totalincome:0; ?>
                                    </h4>
                                    <p>Today's Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$
                                        <?php echo ($monthlyincome->totalincome >0)?$monthlyincome->totalincome:0; ?>
                                    </h4>
                                    <p>Month Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$
                                        <?php echo ($anualincome->totalincome >0)?$anualincome->totalincome:0; ?>
                                    </h4>
                                    <p>Year Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$
                                        <?php echo ($lifetimeincome->totalincome >0)?$lifetimeincome->totalincome:0; ?>
                                    </h4>
                                    <p>Lifetime Income</p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="row">
                                    <div class="col md-3 text-center">
                                        <div class="a-box">
                                            <span class="dot">0</span>
                                            <p class="mt-2">No. of Examinees</p>
                                        </div>
                                        <span>Date: <?php echo date('F d Y'); ?></span>
                                    </div>
                                    <div class="col md-3 text-center">
                                        <div class="a-box">
                                            <span class="dot">0</span>
                                            <p class="mt-2">No. of Passers</p>
                                        </div>
                                    </div>
                                    <div class="col md-3 text-center">
                                        <div class="a-box">
                                            <span class="dot">0</span>
                                            <p class="mt-2">No. of Examinees</p>
                                        </div>
                                        <span>Date: <?php echo date('F d Y'); ?></span>
                                    </div>
                                    <div class="col md-3 text-center">
                                        <div class="a-box">
                                            <span class="dot">0</span>
                                            <p class="mt-2">No. of Passers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->


                        <!-- <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="d-flex justify-content-between mt-4">
                                    <div class="text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_school;?></button>
                                            <p class="mt-2">TOTAL SCHOOLS</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_graduates;?></button>
                                            <p class="mt-2">TOTAL GRADUATES <br>SUBMITTED</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_ceps;?></button>
                                            <p class="mt-2">TOTAL CEPs</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_course;?></button>
                                            <p class="mt-2">TOTAL ONLINE <br>COURSES</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_training;?></button>
                                            <p class="mt-2">TOTAL TRAINING <br>COURSES</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_digital_certificates;?></button>
                                            <p class="mt-2">TOTAL DIGITAL <br>CERTIFICATES</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
            <h5 class="btn-success text-light p-2 mt-4 online-appication-btn">SUBSCRIPTION TRACKER <a href="<?php echo base_url('admin/rboard_tracker'); ?>" class="btn btn-primary float-right">View</a></h5>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row banner-count-desc d-flex">
                        <div class="col-sm-3 text-center">
                            <div class="icon-container"><?php echo $total_onlineapplication; ?></div>
                            <h5>Subscription Package</h5>
                        </div>
                        <div class="col-sm-3 text-center">
                            <div class="icon-container"><?php echo $used_onlineapplication; ?></div>
                            <h5>Used Online Application</h5>
                        </div>
                        <div class="col-sm-3 text-center">
                            <div class="icon-container"><?php echo $remaining_onlineapplication; ?></div>
                            <h5>Remaining Online Application</h5>
                        </div>
                        <div class="col-sm-3 text-center">
                            <div class="icon-container" style="width: 100%;background:#43c300;margin: 10px 0;">
                                <?php if($remaining_onlineapplication > 1){ 
                                    echo 'On Completion'; 
                                } else { 
                                    echo 'Completed'; } ?>
                                </div>
                                <h5>Status</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="btn-success text-light p-2 mt-4 online-appication-btn">REGISTERED PROFESSIONAL STATUS</h5>
                
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex justify-content-between mt-4">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-primary px-5">
                                        <?php echo $total_professionals;?>
                                    </button>
                                    <p class="mt-2">TOTAL PROFESSIONALS</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-warning px-5">
                                        <?php echo $total_valid_license;?>
                                    </button>
                                    <p class="mt-2">VALID LICENSE</p>
                                </div>
                            </div>
                            <!--<div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_pending_license;?>
                                    </button>
                                    <p class="mt-2">PENDING LICENSE</p>
                                </div>
                            </div>-->
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_expired_license;?>
                                    </button>
                                    <p class="mt-2">EXPIRED LICENSE</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-success px-5">
                                        <?php echo $total_suspended_license;?>
                                    </button>
                                    <p class="mt-2">SUSPENDED LICENSE</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-info px-5"><?php echo $total_revoked_license;?></button>
                                    <p class="mt-2">REVOKED LICENSE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex justify-content-between mt-4">
                            
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-success px-5">
                                    <?php echo $total_local_professionals;?>
                                    </button>
                                    <p class="mt-2">LOCAL PROFESSIONAL</p>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-success px-5">
                                    <?php echo $total_foreign_professionals;?>
                                    </button>
                                    <p class="mt-2">FOREIGN PROFESSIONALS</p>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-success px-5">
                                    <?php echo $total_foreign_professionals_withexam;?>
                                    </button>
                                    <p class="mt-2">FOREIGN PROFESSIONALS <br> (WITH EXAM)</p>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-success px-5">
                                    <?php echo $total_foreign_professionals_withoutexam;?>
                                    </button>
                                    <p class="mt-2">FOREIGN PROFESSIONALS <br> (WITHOUT EXAM)</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <h5 class="btn-warning text-light p-2 mt-4 online-appication-btn">ONLINE APPLICATIONS (
                <?php
				 //$total_local_professional+$total_foreign_professional+$total_school_accreditation+$total_cep_accreditation+$total_renewal_school_accreditation+$total_renewal_cep_accreditation+$total_online_course_accreditation+$total_training_course_accreditation; 
				 
				$newonlineapplication = $total_school_accreditation + $total_school_accreditation_renewal+$total_new_foreign_professional+$total_new_foreign_professional_renewal+$total_new_cep+$total_new_renew_cep+$total_new_course+$total_new_training+$total_graduates + $total_new_foreign_professional_review_for_examination + $total_new_foreign_professional_review_for_registration;
				
				$reviewedonlineapplication = $total_school_accreditation_approved+$total_school_accreditation_rejected + $total_school_accreditation_renewal_approved + $total_school_accreditation_renewal_rejected + $total_approved_foreign_professional + $total_reject_foreign_professional+$total_approved_foreign_professional_renewal+$total_reject_foreign_professional_renewal+$total_approved_cep + $total_reject_cep+$total_approved_renew_cep + $total_reject_renew_cep+$total_approved_course+$total_reject_course+$total_approved_training+$total_reject_training+$total_graduates_approved+$total_graduates_rejected + $total_approved_foreign_professional_review_for_examination + $total_reject_foreign_professional_review_for_examination  + $total_approved_foreign_professional_review_for_registration + $total_reject_foreign_professional_review_for_registration;
				
				$total_application = $newonlineapplication+$reviewedonlineapplication+$total_professional_registration+$total_booking_for_licensure_exam_graduates+$total_booking_for_licensure_exam_foreign_professional;
				
                
				
				
				
				echo '<span data-toggle="tooltip" data-placement="bottom" title="New Online Applications">'.$newonlineapplication.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.$reviewedonlineapplication.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.$total_application.'</span>'; ?>)
                <a href="<?php echo site_url('admin/onlineApplication_listing'); ?>"><button class="btn btn-primary float-right">View</button></a>
            </h5>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.$total_professional_registration.'</span>';?>
                                </button>
                                <p class="mt-2">PROFESSIONAL <br>REGISTRATION</p>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5"><?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_foreign_professional_renewal.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_foreign_professional_renewal+$total_reject_foreign_professional_renewal).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_foreign_professional_renewal+$total_approved_foreign_professional_renewal+$total_reject_foreign_professional_renewal).'</span>';?></button>
                                <p class="mt-2">LICENSE RENEWAL</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_school_accreditation.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_school_accreditation_approved+$total_school_accreditation_rejected).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_school_accreditation+$total_school_accreditation_approved+$total_school_accreditation_rejected).'</span>';?>
                                </button>
                                <p class="mt-2">SCHOOL ACCREDITATION</p>
                            </div>
                        </div>
						 <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                   <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_school_accreditation_renewal.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_school_accreditation_renewal_approved+$total_school_accreditation_renewal_rejected).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_school_accreditation_renewal+$total_school_accreditation_renewal_approved+$total_school_accreditation_renewal_rejected).'</span>';?>
                                </button>
                                <p class="mt-2">RENEWAL OF <br>SCHOOL ACCREDITATION </p>
                            </div>
                        </div>
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                   <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_graduates.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_graduates_approved+$total_graduates_rejected).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_graduates+$total_graduates_approved+$total_graduates_rejected).'</span>';?>
                                </button>
                                <p class="mt-2">SUBMISSION OF <br> GRADUATES </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                   <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Booking">'.$total_booking_for_licensure_exam_graduates.'</span>';?>
                                </button>
                                <p class="mt-2">BOOKING FOR LICENSURE<br>EXAM (GRADUATES)</p>
                            </div>
                        </div>
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                  <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Booking">'.$total_booking_for_licensure_exam_foreign_professional.'</span>';?>
                                </button>
                                <p class="mt-2">BOOKING FOR LICENSURE<br>EXAM (FOREIGN PRO.)</p>
                            </div>
                        </div>
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                   <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_foreign_professional_review_for_examination.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_foreign_professional_review_for_examination + $total_reject_foreign_professional_review_for_examination).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_foreign_professional_review_for_examination + $total_approved_foreign_professional_review_for_examination + $total_reject_foreign_professional_review_for_examination).'</span>';?>
                                </button>
                                <p class="mt-2">FOREIGN PROFESSIONAL<br>REVIEW FOR EXAMINATION</p>
                            </div>
                        </div>
						<div class="text-center">
                            <div class="a-box">
                            <button type="button" class="btn btn-success px-5">
                                   <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_foreign_professional_review_for_registration.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_foreign_professional_review_for_registration + $total_reject_foreign_professional_review_for_registration).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_foreign_professional_review_for_registration + $total_approved_foreign_professional_review_for_registration + $total_reject_foreign_professional_review_for_registration).'</span>';?>
                                </button>
                                <p class="mt-2">FOREIGN PROFESSIONAL<br>REVIEW FOR REGISTRATION</p>
                            </div>
                        </div>
						 <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_cep.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_cep+$total_reject_cep).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_cep+$total_approved_cep+$total_reject_cep).'</span>';?>
                                </button>
                                <p class="mt-2">CEP PROVIDER ACCREDITATION</p>
                            </div>
                        </div>
                        
                        <!--<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo $total_training_course_accreditation;?>
                                </button>
                                <p class="mt-2">GRADUATES</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo $total_training_course_accreditation;?>
                                </button>
                                <p class="mt-2">TRAINING COURSE <br>ACCREDITATION</p>
                            </div>
                        </div>-->

                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
                    <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_renew_cep.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_renew_cep+$total_reject_renew_cep).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_renew_cep+$total_approved_renew_cep+$total_reject_renew_cep).'</span>';?>
                                </button>
                                <p class="mt-2">RENEWAL OF CEP<br>ACCREDITATION</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php //echo $total_online_course_accreditation;?>
									<?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_course.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_course+$total_reject_course).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_course+$total_approved_course+$total_reject_course).'</span>';?>
                                </button>
                                <p class="mt-2">ONLINE COURSE <br>ACCREDITATION</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-success px-5">
                                    <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="New Applications">'.$total_new_training.'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="Reviewed Applications">'.($total_approved_training+$total_reject_training).'</span>'; ?> / <?php echo '<span data-toggle="tooltip" data-placement="bottom" title="All Applications">'.($total_new_training+$total_approved_training+$total_reject_training).'</span>';?>
                                </button>
                                <p class="mt-2">TRAINING COURSE <br>ACCREDITATION</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <!-- ----------- NEXT ROW ------------------ -->

            <h5 class="bg-secondary text-light p-2 mt-2 online-appication-btn text-uppercase">Online licensure examination (Local Graduates)
                <a href="<?php echo site_url('admin/licensure_examination/?for=g'); ?>"><button class="btn btn-primary float-right">View</button></a>
            </h5>
            <div class="row round-btn">
				<?php 
					
					foreach($get_examschedule_graducate as $scdule){
						$no_graducate = 0;
						$no_graducate_pass = 0;
						foreach($get_bookedexam as $booked){
							if($scdule->es_id == $booked->examination_id){
								$no_graducate++;
							}
						}
						foreach($get_passedexam as $pass){
							if($scdule->es_id == $pass->examination_id){								
									$no_graducate_pass++;
							}
						}	
						$present = $this->common_model->is_gexam_present($scdule->es_id);						
						$countexaminer = $no_graducate;
						$countpass = $no_graducate_pass;
						$passPersent = ($countpass >0 && $countexaminer > 0)?($countpass/$countexaminer)*100:0;
						$remining_slot = $scdule->maximum_applicant- $countexaminer;
                        $reg_start_date = 'N/A';
                        $reg_end_date = 'N/A';
                        if($scdule->reg_start_date!='0000-00-00'){
                            $reg_start_date = date('M d,Y',strtotime($scdule->reg_start_date));
                        }
                        if($scdule->reg_end_date!='0000-00-00'){
                            $reg_end_date = date('M d,Y',strtotime($scdule->reg_end_date));
                        }
                        $regstatus = 'CLOSE';
                        $examstatus = 'PENDING';
                        if(date('Y-m-d')>=date('Y-m-d',strtotime($scdule->reg_start_date)) && date('Y-m-d')<=date('Y-m-d',strtotime($scdule->reg_end_date))){
                            $regstatus = 'OPEN' ;
                        }
                        if(date('Y-m-d')>date('Y-m-d', strtotime($scdule->date))){
                            $examstatus = 'FINISHED';
                        }
						echo '<div class="col-md-6">
								<div class="exam-info-section">
								<h3 class="text-center my-3">Date : '.date('M d, Y',strtotime($scdule->date)).'</h3><p class="text-center">'.$scdule->start_time.' - '.$scdule->end_time.'</p><p class="text-center">'.$scdule->venue.'</p><p class="text-center">Registration Starts: '.$reg_start_date.'</p><p class="text-center">Registration Closes: '.$reg_end_date.'</p><p class="text-center">REGISTRATION STATUS: '.$regstatus.'</p><p class="text-center">EXAMINATION STATUS: '.$examstatus.'</p>
								</div>
								<div class="d-flex mt-4">
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$remining_slot.'</button>
											<p class="mt-2">Remining slots</p>
										</div>
									</div>
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$countexaminer.'</button>
											<p class="mt-2">No. of Examinees</p>
										</div>
									</div>
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$present->total_present.'</button>
											<p class="mt-2">Present</p>
										</div>
									</div>
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$countpass.'</button>
											<p class="mt-2">No. of Passers</p>
										</div>
									</div>
									
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.number_format($passPersent).' %</button>
											<p class="mt-2">Percentage</p>
										</div>
									</div>
								</div>
							</div>';
					}
				?>
                
            </div>
            <!-- ----------- NEXT ROW ------------------ -->
			
			<!-- ----------- NEXT ROW ------------------ -->

            <h5 class="bg-secondary text-light p-2 mt-2 online-appication-btn text-uppercase">Online licensure examination (Foreign Professionals)
                <a href="<?php echo site_url('admin/licensure_examination/?for=fp'); ?>"><button class="btn btn-primary float-right">View</button></a>
            </h5>
            <div class="row round-btn">
				<?php
						
					foreach($get_examschedule_professional as $scdule){
						$no_professional = 0;
						$no_professional_pass = 0;
						foreach($get_bookedexam_forign_pro as $booked){
							if($scdule->es_id == $booked->examination_id){
								$no_professional++;
							}
						}
						foreach($get_passedexam as $pass){
							if($scdule->es_id == $pass->examination_id){
								$no_professional_pass++;
							}
						}
						$present = $this->common_model->is_pexam_present($scdule->es_id);
						$countexaminer = $no_professional;
						$countpass = $no_professional_pass;
						$passPersent = ($countpass >0 && $countexaminer > 0)?($countpass/$countexaminer)*100:0;
						$remining_slot = $scdule->maximum_applicant- $countexaminer;
                        $reg_start_date = 'N/A';
                        $reg_end_date = 'N/A';
                        if($scdule->reg_start_date!='0000-00-00'){
                            $reg_start_date = date('M d,Y',strtotime($scdule->reg_start_date));
                        }
                        if($scdule->reg_end_date!='0000-00-00'){
                            $reg_end_date = date('M d,Y',strtotime($scdule->reg_end_date));
                        }
                        $regstatus = 'CLOSE';
                        $examstatus = 'PENDING';
                        if(date('Y-m-d')>=date('Y-m-d',strtotime($scdule->reg_start_date)) && date('Y-m-d')<=date('Y-m-d',strtotime($scdule->reg_end_date))){
                            $regstatus = 'OPEN' ;
                        }
                        if(date('Y-m-d')>date('Y-m-d', strtotime($scdule->date))){
                            $examstatus = 'FINISHED';
                        }
						echo '<div class="col-md-6">
								<div class="exam-info-section">
								<h3 class="text-center my-3">Date : '.date('M d, Y',strtotime($scdule->date)).'</h3><p class="text-center">'.$scdule->start_time.' - '.$scdule->end_time.'</p><p class="text-center">'.$scdule->venue.'</p><p class="text-center">Registration Starts: '.$reg_start_date.'</p><p class="text-center">Registration Closes: '.$reg_end_date.'</p><p class="text-center">REGISTRATION STATUS: '.$regstatus.'</p><p class="text-center">EXAMINATION STATUS: '.$examstatus.'</p>
								</div>
								<div class="d-flex mt-4">
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$remining_slot.'</button>
											<p class="mt-2">Remining slots</p>
										</div>
									</div>
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$countexaminer.'</button>
											<p class="mt-2">No. of Examinees</p>
										</div>
									</div>
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$present->total_present.'</button>
											<p class="mt-2">Present</p>
										</div>
									</div>
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.$countpass.'</button>
											<p class="mt-2">No. of Passers</p>
										</div>
									</div>
									
									<div class="text-center w-50">
										<div class="a-box">
											<button type="button" class="btn btn-primary px-5">'.number_format($passPersent).' %</button>
											<p class="mt-2">Percentage</p>
										</div>
									</div>
								</div>
							</div>';
					}
				?>
                
            </div>
            <!-- ----------- NEXT ROW ------------------ -->
            <!-- <h5 class="bg-primary text-light p-2 mt-2 online-appication-btn">ONLINE NOTIFICATION (0) 
                <button class="btn btn-primary float-right">View</button>
            </h5>
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">TESTIMONIALS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">SUGGESTIONS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">COMPLAINTS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">REFUND</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">VERIFICATION</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->

            <!-- ----------- NEXT ROW ------------------ -->
            <h5 class="bg-primary text-light p-2 mt-2 online-appication-btn">ACCREDITATION</h5>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <P>ACCREDITED SCHOOL()</P>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_valid_accreditated_school?></button>
                                <p class="mt-2">VALID</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_expired_accreditated_school?></button>
                                <p class="mt-2">EXPIRED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_suspended_accreditated_school?></button>
                                <p class="mt-2">SUSPENDED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_revoked_accreditated_school?></button>
                                <p class="mt-2">REVOKED</p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <P>ACCREDITED CEP()</P>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_valid_accreditated_cep?></button>
                                <p class="mt-2">VALID</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_expired_accreditated_cep?></button>
                                <p class="mt-2">EXPIRED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_suspended_accreditated_cep?></button>
                                <p class="mt-2">SUSPENDED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_revoked_accreditated_cep?></button>
                                <p class="mt-2">REVOKED</p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <P>ACCREDITED ONLINE COURSES()</P>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_valid_accreditated_onlinecourse?></button>
                                <p class="mt-2">VALID</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_expired_accreditated_onlinecourse?></button>
                                <p class="mt-2">EXPIRED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_suspended_accreditated_onlinecourse?></button>
                                <p class="mt-2">SUSPENDED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_revoked_accreditated_onlinecourse?></button>
                                <p class="mt-2">REVOKED</p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <P>ACCREDITED TRNG COURSES()</P>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_valid_accreditated_onlinetraning?></button>
                                <p class="mt-2">VALID</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_expired_accreditated_onlinetraning?></button>
                                <p class="mt-2">EXPIRED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_suspended_accreditated_onlinetraning?></button>
                                <p class="mt-2">SUSPENDED</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_revoked_accreditated_onlinetraning?></button>
                                <p class="mt-2">REVOKED</p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

            <!-- ----------- NEXT ROW ------------------ -->
            <h5 class="bg-primary text-light p-2 mt-2 online-appication-btn">CERTIFICATES</h5>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_cert_reported_by_professional?></button>
                                <p class="mt-2">REPORTED BY PROFESSIONALS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?=$total_cert_reported_by_cep?></button>
                                <p class="mt-2">REPORTED BY CEP</p>
                            </div>
                        </div>
                        
                    </div> 
                </div>
            </div>
            <!-- ----------- NEXT ROW ------------------ -->
            <h5 class="bg-info text-light p-2 mt-2 online-appication-btn">Notifications (<?php echo $total_Testimonial+$total_Suggestion+$total_Complaint+$total_Refund+$total_Verification+$total_Inquiry+$total_school_notification+$total_professional_notification+$total_cep_notification;?>)
                <a href="<?php echo base_url('admin/contacts');?>"><button class="btn btn-primary float-right">View</button></a>
            </h5>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_Testimonial;?></button>
                                <p class="mt-2">TESTIMONIALS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_Suggestion;?></button>
                                <p class="mt-2">SUGGESTIONS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_Complaint;?></button>
                                <p class="mt-2">COMPLAINTS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_Refund;?></button>
                                <p class="mt-2">REFUND</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_Verification;?></button>
                                <p class="mt-2">VERIFICATION</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_Inquiry;?></button>
                                <p class="mt-2">INQUIRIES</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="d-flex justify-content-between mt-4">
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_professional_notification;?></button>
                                <p class="mt-2">PROFESSIONALS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_school_notification;?></button>
                                <p class="mt-2">SCHOOLS</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5"><?php echo $total_cep_notification;?></button>
                                <p class="mt-2">CEPs</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">GRADUATES</p>
                            </div>
                        </div>
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">FOREIGN PROFESSIONALS</p>
                            </div>
                        </div>
						<div class="text-center">
                            <div class="a-box">
                                <button type="button" class="btn btn-warning px-5">0</button>
                                <p class="mt-2">PRESENTLY REG. PROFESSIONALS</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ----------- NEXT ROW ------------------ -->

            <h5 class="bg-success text-light p-2 mt-2 online-appication-btn mb-4">ADMIN MANPOWER (
                <?php echo $total_reviewer_course+$total_reviewer_schoolcep+$total_proctor+$total_foreign_proctor+$total_reviewer_examiners+$total_media+$total_cashier;?>)
                <a href="<?php echo site_url('admin/reviewers_listing'); ?>"><button class="btn btn-primary float-right">View</button></a>
            </h5>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_reviewer_course;?>
                                    </button>
                                    <p class="mt-2"><a href="<?php echo base_url('admin/ct_reviewers_listing');?>">REVIEWER FOR <br>CE COURSES</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_reviewer_schoolcep;?>
                                    </button>
                                    <p class="mt-2"><a href="<?php echo base_url('admin/reviewers_listing');?>">REVIEWER FOR <br>DOCUMENTS</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_proctor+$total_foreign_proctor;?>
                                    </button>
                                    <p class="mt-2"><a href="<?php echo base_url('admin/proctor_listing');?>">PROCTOR</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_reviewer_examiners;?>
                                    </button>
                                    <p class="mt-2"><a href="<?php echo base_url('admin/examiner_listing');?>">LICENSURE EXAMINERS</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_media;?>
                                    </button>
                                    <p class="mt-2"><a href="<?php echo base_url('admin/media_listing');?>">MEDIA</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-danger px-5">
                                        <?php echo $total_cashier;?>
                                    </button>
                                    <p class="mt-2"><a href="<?php echo base_url('admin/cashier_listing');?>">CASHIER</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>
	<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>