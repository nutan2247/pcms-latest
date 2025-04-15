<?php //echo '<pre>'; print_r($todayincome); ?>
<style>
.greenclass {
    background-color: green;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    text-align: center;
    vertical-align: middle;
    display: inherit;
    color: #fff;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin: 12px auto;
}
.a-box-btn {
  	  padding-top: 30px;
}
.greenclass-main-box a {
    color: #000;
}
.filter {
    margin-right: 40px;
}

</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 "><span
                                class="d-inline-block border-bottom pb-2 px-3 filter-title"><?php echo $title;?></span>
                        </h4>
                        <p class="text-center"><?php echo date('F d, Y');?></p>
                        <div class="row mt-4 ">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($todayincome->totalincome > 0)?$todayincome->totalincome:0; ?></h4></p>
                                    <p>Today's Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($monthlyincome->totalincome >0)?$monthlyincome->totalincome:0; ?></h4></p>
                                    <p>Monthly Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($anualincome->totalincome > 0)?$anualincome->totalincome:0; ?></h4>
                                    <p>Annual Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($lifetimeincome->totalincome > 0)?$lifetimeincome->totalincome:0; ?></h4></p>
                                    <p>Lifetime Income</p>
                                </div>
                            </div>
							<!--<div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><?php echo $todayincome->totalincome; ?></p>
                                    <p>Net Today's Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><?php echo $monthlyincome->totalincome; ?></p>
                                    <p>Net Monthly Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><?php echo $anualincome->totalincome; ?>
                                    <p>Net Annual Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><?php echo $lifetimeincome->totalincome; ?></p>
                                    <p>Net Lifetime Income</p>
                                </div>
                            </div>-->
                        </div>
						
                        <!--<div class="row">
                            <div class="col-md-9 mx-auto">
                                <div class="row mt-4">
                                    <div class="col-md-4 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5">12,345</button>
                                            <p class="mt-2">TOTAL PROFESSIONALS</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-warning px-5">10,923</button>
                                            <p class="mt-2">VALID LICENSE</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-danger px-5">2,452</button>
                                            <p class="mt-2">EXPIRED LICENSE</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
						
                    </div>
					
                </div>
            </div>
			
			<div class="main_contry">
				<div class="main_contry_heading text-center my-5">
					<h1 class="h2 mb-4"> <u>Detailed Income Report</u> </h1>
					<p class="h6"><?php echo date('F d, Y');?></p>
				</div>
				<div class="country_main" style="padding:50px; background-color:#ccd7e2;margin: 15px; border-radius: 10px;">
				<form action="" method="get"> 
				<div class="row">
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label>Country</label>
							<select name="country" id="country" class="form-control">
								<option value="">All</option>
								<?php echo'<pre>'; print_r($countries);
									 foreach($countries as $key => $list){
										$countsel = (isset($_GET['country']) && $_GET['country'] == $list['countries_id'])?'selected':'';
										echo '<option value="'.$list['countries_id'].'" '.$countsel.'>'.$list['countries_name'].'</option>'; 
									 }
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label>Income Sources</label>
							<select name="income_sources" id="income_sources" class="form-control">
								<option value="professional_registration" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'professional_registration')?'selected':'';?>>Professional Registration</option>
								<option value="professional_license_renewal" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'professional_license_renewal')?'selected':'';?>>Professional License Renewal</option>
								<option value="school_accreditaion" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'school_accreditaion')?'selected':'';?>>School Accreditaion</option> 
								
								<option value="submission_of_graduates" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'submission_of_graduates')?'selected':'';?>>Submission of Graduates</option>
								<option value="booking_for_exam_graduates" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'booking_for_exam_graduates')?'selected':'';?>>Booking for Exam - Graduates</option>
								<option value="foreign_professional_registration" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'foreign_professional_registration')?'selected':'';?>>Foreign Professional - Registration</option>
								<option value="foreign_professional_examination" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'foreign_professional_examination')?'selected':'';?>>Foreign Professional - Examination</option>
								<option value="booking_for_exam_foreign_professionals" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'booking_for_exam_foreign_professionals')?'selected':'';?>>Booking for Exam - Foreign Professionals</option>
								<option value="cep_accreditation" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'cep_accreditation')?'selected':'';?>>CEP Accreditation</option>
								<option value="online_course_accreditation" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'online_course_accreditation')?'selected':'';?>>Online Course Accreditation</option>
								<option value="training_course_accreditation" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'training_course_accreditation')?'selected':'';?>>Training Course Accreditation</option>
								<option value="request_for_verification_of_registration" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'request_for_verification_of_registration')?'selected':'';?>>Request for Verification of Registration</option>
								<option value="request_for_certificate_of_good_standing" <?php echo (isset($_GET['income_sources']) && $_GET['income_sources'] == 'request_for_certificate_of_good_standing')?'selected':'';?>>Request for Certificate of Good Standing</option>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label>User Role</label>
							<select name="user_role" id="user_role" class="form-control">
								<option value="">--All--</option>
								<option value="U" <?php echo (isset($_GET['user_role']) && $_GET['user_role'] == 'U')?'selected':'';?>>School</option>
								<option value="G" <?php echo (isset($_GET['user_role']) && $_GET['user_role'] == 'G')?'selected':'';?>>Graduates</option>
								<option value="P" <?php echo (isset($_GET['user_role']) && $_GET['user_role'] == 'P')?'selected':'';?>>Local Professionals</option>
								<option value="F" <?php echo (isset($_GET['user_role']) && $_GET['user_role'] == 'F')?'selected':'';?>>Foreign Professionals</option>
								<option value="CEP" <?php echo (isset($_GET['user_role']) && $_GET['user_role'] == 'CEP')?'selected':'';?>>CEP</option>
							</select>
						</div>
					</div>
					
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Select User</label>
							<select name="modules" id="modules" class="form-control">
								<option value="">Select Role First</option>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Day</label>
							<select name="day" id="day" class="form-control">
								<option value="">--Select--</option>
								<?php
									for($d=1; $d <= 31; $d++){
										$daysel = (isset($_GET['day']) && $_GET['day'] == $d)?'selected':'';
										echo '<option value="'.$d.'" '.$daysel.'>'.$d.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Month</label>
							<select name="mouth" id="mouth" class="form-control">
								<option value="">--Select--</option>
								<option value="01" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '01')?'selected':'';?>>Jan</option>
								<option value="02" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '02')?'selected':'';?>>Feb</option>
								<option value="03" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '03')?'selected':'';?>>Mar</option>
								<option value="04" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '04')?'selected':'';?>>Apr</option>
								<option value="05" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '015')?'selected':'';?>>May</option>
								<option value="06" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '06')?'selected':'';?>>Jun</option>
								<option value="07" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '07')?'selected':'';?>>Jul</option>
								<option value="08" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '08')?'selected':'';?>>Aug</option>
								<option value="09" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '09')?'selected':'';?>>Sep</option>
								<option value="10" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '10')?'selected':'';?>>Oct</option>
								<option value="11" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '11')?'selected':'';?>>Nov</option>
								<option value="12" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '12')?'selected':'';?>>Dec</option>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Year</label>
							<select name="year" id="year" class="form-control">
								<?php
									for($y=2021; $y<=date('Y');$y++){
										$yearsel = (isset($_GET['year']) && $_GET['year'] == $y)?'selected':'';
										echo '<option value="'.$y.'" '.$yearsel.'>'.$y.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3"> 
						<div  class="a-box-btn">
							
							<button type="submit" class="btn btn-primary filter">Filter</button>
							<button type="button" id="reset" class="btn btn-primary">Reset</button>
						</div>                                   
						
					</div>
					</div>
				</div>
				</form>
			</div>
			<div class="all-icome-dtl pl-3 mt-3">
				<p class="filterbreadcrum"><?php echo $titlebreadcrum; ?><!--International / All / 2020--></p>
			</div>
			<div class="greenclass-main-box">
			<div class="row">
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($lifetimeincome->totalincome >0)?$lifetimeincome->totalincome:0; ?></div>
					<a href="#">All</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($professionreg->totalincome >0)?$professionreg->totalincome:0; ?></div>
					<a href="<?php echo base_url($income_subsetion_url.'professional_registration'); ?>">Professional Registration</a>
				</div> 
				<div class="col-md-3 text-center">   
				<?php  $professional_renew = ($professional_renew->totalincome)?$professional_renew->totalincome:0; 
					   $professionalgraduate_renew = ($professionalgraduate_renew->totalincome)?$professionalgraduate_renew->totalincome:0; 
					?>                                
					<div class="greenclass"><?php echo number_format($professional_renew + $professionalgraduate_renew, 2);  ?></div>
					<a href="<?php echo base_url($income_subsetion_url.'professional_license_renewal'); ?>">Professional License Renewal</a>
				</div>
				<div class="col-md-3 text-center"> 
				<?php   $school = ($school->totalincome >0)?$school->totalincome:0;
						$school_renew = ($school_renew->totalincome >0)?$school_renew->totalincome:0;
				?>                                   
					<div class="greenclass"><?php echo number_format($school + $school_renew, 2); ?></div>
					<a href="<?php echo base_url($income_subsetion_url.'school_accreditaion'); ?>">School Accreditation</a>
				</div>

				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($graducates->totalincome > 0)?$graducates->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'submission_of_graduates'); ?>">Submission of Graduates</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($graducates_booking->totalincome > 0)?$graducates_booking->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'booking_for_exam_graduates'); ?>">Booking for exam - Graduates</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($foreignprofessonals->totalincome > 0)?$foreignprofessonals->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'foreign_professional_registration'); ?>">Foreign Professional - Registration</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($foreignprofessonals_forexam->totalincome > 0)?$foreignprofessonals_forexam->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'foreign_professional_examination'); ?>">Foreign Professional - Examination</a>
				</div>

				
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($foreignprofessonals_onlineexam_booking->totalincome > 0)?$foreignprofessonals_onlineexam_booking->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'booking_for_exam_foreign_professionals'); ?>">Booking for exam - Foreign Professional</a>
				</div>
				<div class="col-md-3 text-center">  
				<?php   $cep = ($cep->totalincome >0)?$cep->totalincome:0;
						$cep_renew = ($cep_renew->totalincome >0)?$cep_renew->totalincome:0;
				?>                                     
					<div class="greenclass"><?php echo number_format($cep + $cep_renew,2); ?></div>
					<a href="<?php echo base_url($income_subsetion_url.'cep_accreditation'); ?>">CEP Accreditation</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($course->totalincome > 0)?$course->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'online_course_accreditation'); ?>">Online course Accreditation</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($training->totalincome > 0)?$training->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'training_course_accreditation'); ?>">Training course Accreditation</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($verification_registration->totalincome > 0)?$verification_registration->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'verification_of_registration'); ?>">Request for Verification of Registration</a>
				</div>
				<div class="col-md-3 text-center">                                    
					<div class="greenclass"><?php echo ($good_standing->totalincome > 0)?$good_standing->totalincome:0; ?></div>
				<a href="<?php echo base_url($income_subsetion_url.'certificate_of_good_standing'); ?>">Request for Certificate of Good Standing</a>
				</div>

			</div>
			</div>
			
			<div class="card-body">
					<div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        

                        <!--   <tfoot>

                            </tfoot> -->
                        
                            <?php 
							echo '<thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Processing Fee</th>
                                <th>Tax</th>
                                <th>Amount($)</th>
                                <th>Transtion Id</th>
                                <th>Payment For</th>
                                <th>Date Paid</th>
                                <th>Reciept Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						<tbody>';
								//echo '<pre>';print_r($incomereport);exit;
							if($incomereport){
								
                                $count = 1; 
								$totalprocessingfee = 0;
								$totaltax = 0;
								$totalgross = 0;
								
                                foreach($incomereport as $inclist){
									$totalprocessingfee += $inclist->payment_amout;
									$totaltax += $inclist->payment_tax;
									$totalgross += $inclist->payment_gross;
									$sectionname = '';
									$type="";
									$date = explode('-',$inclist->payment_date);
								if($inclist->payment_for == 'P'){
									$type ='Foreign Professional Review of Documents for Professional Registration';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'P');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'PP'){
									$type ='Foreign Professional Review of Documents For Licensure Examination';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'PP');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'U'){
									$type ='School';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'U');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'C'){
									$type ='Online Course ';
									$sectionarr = $this->common_model->getsectionname($inclist->doc_refrence_id,'CEPC');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'G' && $inclist->payment_type == 'S'){
									$type ='Graduate';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'U'); //university name will goes to front end because univerty pay for submission of graduates.
									// echo $this->db->last_query();die;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'G' && $inclist->payment_type == 'E'){
									$type ='Graduate';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'G');
									// echo $this->db->last_query();die;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'T'){
									$type ='Training Course';
									$sectionarr = $this->common_model->getsectionname($inclist->doc_refrence_id,'CEPT');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'PR'){
									// $type ='Professional Registration ';
									if($inclist->payment_type == 'R'){ $type = 'Professional License Renewal'; }else{ $type = 'Professional Registration'; }
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'PR');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'CEP'){
									$type ='CE Provider ';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'CEP');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'VR'){
									$type ='Request for Verification of Registration';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'VR');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'GS'){
									$type ='Request for Certificate of Good Standing';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'GS');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}	
								
								if($inclist->payment_for == 'U' && $inclist->payment_type == 'N'){
									$payment_type = 'School Accreditation Fee';
								}
								else if($inclist->payment_for == 'U' && $inclist->payment_type == 'R'){
									$payment_type = 'Renewal of School Accreditation Fee';
								}
								else if($inclist->payment_for == 'PR' && $inclist->payment_type == 'N'){
									$payment_type = 'Professional Registration Fee';
								}
								else if($inclist->payment_for == 'PR' && $inclist->payment_type == 'R'){
									$payment_type = 'Professional License Renewal Fee';
								}
								else if($inclist->payment_for == 'CEP' && $inclist->payment_type == 'N'){
									$payment_type = 'CEP Accreditation Fee';
								}
								else if($inclist->payment_for == 'CEP' && $inclist->payment_type == 'R'){
									$payment_type = 'Renewal of CEP Accreditation Fee';
								}
								else if($inclist->payment_for == 'T'){
									$payment_type = 'Training Course Accreditation Fee';
								}
								else if($inclist->payment_for == 'C'){
									$payment_type = 'Online Course Accreditation Fee';
								}
								else if($inclist->payment_for == 'G'){
									$payment_type = 'Submission of Graduates for licensure Examination Fee';
								}
								else if($inclist->payment_for == 'PP'){
									$payment_type = 'Foreign Professional Review of Documents For Licensure Examination Fee';
								}
								else if($inclist->payment_for == 'VR'){
									$payment_type = 'Request for Verification of Registration Fee';
								}
								else if($inclist->payment_for == 'GS'){
									$payment_type = 'Request for Certificate of Good Standing Fee';
								}
								else{
									$payment_type =($inclist->payment_type == 'R')?'Renew':'New';
								}
                            ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td><?=$type;?></td>
                                <td><?=$sectionname;?></td>
                                <td><?=$inclist->payment_amout;?></td>
                                <td><?=$inclist->payment_tax;?></td>
                                <td><?=$inclist->payment_gross;?></td>
                                <td><?=$inclist->txn_id;?></td>
                                <td><?=$payment_type;?> </td>
                                <td><?=date("M d, Y",strtotime($inclist->payment_date));?></td>
                                <td>#<?=$inclist->payment_id.'-'.$date[0];?></td>
                                <td><a href="javascript:void(0);" onclick="viewreceipt('<?php echo $inclist->payment_id; ?>')">View</a></td>
                            </tr> 
							
                            <?php $count++; }
							
							echo '</tbody> <tfoot>
							<tr>
								<td colspan="3" align="right"><b>Total</b></td>
								<td><b>Processing Fee: '.$totalprocessingfee.'</b></td>
								<td><b>Tax(12%): '.$totaltax.'</b></td>
								<td colspan="6" class="text-center"><b>Amount: '.$totalgross.'</b></td>
							</tr>
							</tfoot>';
							} ?>
                        
                    </table>
                </div>
				</div>
        </div>
    </main>

    

	<script>
	onload();
	function onload(){
		var user_role = $("select#user_role option").filter(":selected").val();
		var modules = "<?php echo (isset($_GET['modules']))?$_GET['modules']:'';?>";
		//alert(user_role);
		if(user_role !=""){
			$.ajax({
			url:'<?php echo base_url("admin/subrole");?>', 
			type:'post',
			//dataType: 'json',
		   // data:{chargeid},
			data:{'user_role':user_role,'modules':modules},
			beforeSend:function(){
				//$(".loding-main").show();

			},
			success:function(data){
				//alert(JSON.parse(data));
				//alert(JSON.stringify(data));
				//$(".loding-main").hide();
				//var html = '';
				//$('#dispprice').html(data['charge']);
				$('#modules').html(data);
				
			}
		});	
		}
	}	
	$( "#user_role" ).change(function() {
		var user_role = $(this).val();
	  $.ajax({
        url:'<?php echo base_url("admin/subrole");?>', 
        type:'post',
		//dataType: 'json',
       // data:{chargeid},
		data:{'user_role':user_role},
        beforeSend:function(){
            //$(".loding-main").show();

        },
        success:function(data){
			//alert(JSON.parse(data));
			//alert(JSON.stringify(data));
			//$(".loding-main").hide();
			//var html = '';
			//$('#dispprice').html(data['charge']);
			$('#modules').html(data);
			
        }

    });
	  
	});
	$( "#income_sources" ).change(function() {
		var user_role = $("#income_sources option:selected").html();
		$('.filter-title').html(user_role);
	});
	
	$('#reset').click(function(){
		location.href = '<?php echo base_url("finance/incomereport");?>';
	});
    
	</script>