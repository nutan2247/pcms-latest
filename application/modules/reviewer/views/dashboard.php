<!-- count all application and check is current package valid or not -->
<?php 
    $subscription = $this->common_model->get_admin_subscription_details();
    $no_of_applcation = $subscription->total_application; 
$current_application = '';
    if(isset($subscription->subscription_id) && $subscription->subscription_id == 6 && $subscription->total_application == 0){
        $current_application = 'u'; // unlimited
    }else{
        if($current_application){
            $current_application = $current_application;
        }else{
            $current_application = 0;
        }  
    } 
?>
    <div id="layoutSidenav_content">
    <main>

        <!-- <pre><?php echo $fp_count; ?><br><?php echo $total_fprofesional_count; ?> -->
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 "><span
                                class="d-inline-block border-bottom pb-2 px-3">REVIEWER'S TRACKER</span>
                        </h4>
                        <p class="text-center"><?php echo date('F d, Y');?></p>                        
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                            <img src="<?php echo base_url('assets/uploads/reviewer/').$details->photo; ?>" style="width: 150px; height: 150px;" >
                            </div>
                            <div class="col-md-9 mx-auto">
                                <?php  //print_r($details);
                                if($details->user_type == 'sub-admin'){
									$rtype = 'Reviewer of Documents'; 
								}else{ 
									$rtype = 'Reviewer of Courses'; 
								}
                                $created_on = $details->created_on; ?>
                                <ul style="list-style-type:none;">
                                    <li><?php echo ucwords($details->first_name.' '.$details->last_name); ?></li>
                                    <li><?=$rtype?></li>
                                    <li>Appointment date: <?php echo date('F d,Y',strtotime($details->created_on));?></li>
                                    <li>Validity: <?php echo date('F d,Y',strtotime($details->validity_date));?></li>
                                </ul>
								<?php 
									if($this->session->userdata('login')['user_type'] == 'ct'){
										$total_review_application = $total_course_for_review_count+$total_training_for_review_count;
										$total_reviewed_application = $total_course_reviewed_count+$total_training_reviewed_count;
										$total_approved_application = $total_training_approved_count+$total_course_approved_count;
										$total_dispproved_application = $total_training_dispproved_count+$total_course_dispproved_count;
									}else{
										$total_review_application = $total_school_for_review_count+$total_fprofesional_for_review_count+$total_cep_for_review_count+$total_graduates_for_review_count+$professional_review_count+$fpexamreg_for_review_count; 

										$total_reviewed_application = $total_school_reviewed_count+$total_graduates_reviewed_count + $total_cep_reviewed_count+$total_fprofesional_reviewed_count + $professional_reviewed_count + $fpexamreg_for_reviewed_count; 
										
                                        // echo 'sc '.$total_school_approved_count.' + fp'.$total_fprofesional_approved_count.' + cep'.$total_cep_approved_count.' + '.$total_graduates_approved_count.' + prenew'.$professional_approved_count.' + ereg'.$fpexamreg_for_approved_count;

										$total_approved_application = $total_school_approved_count+$total_fprofesional_approved_count+$total_cep_approved_count+$total_graduates_approved_count+$professional_approved_count+$fpexamreg_for_approved_count; 
										
										$total_dispproved_application = $total_school_dispproved_count+$total_fprofesional_dispproved_count+$total_cep_dispproved_count+$total_graduates_dispproved_count+$professional_dispproved_count+$fpexamreg_for_dispproved_count;
										
									}
								?>
                                <div class="row mt-4">
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-warning px-5"><?php echo $total_review_application; ?></button>
                                            <p class="mt-2">For Review Application</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5"><?php echo $total_reviewed_application; ?></button>
                                            <p class="mt-2">Reviewed Application</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-success px-5"><?php echo $total_approved_application;?></button>
                                            <p class="mt-2">Approved Application</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-danger px-5"><?php echo $total_dispproved_application;?></button>
                                            <p class="mt-2">Dispproved Application</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php if($no_of_applcation <= $current_application && $current_application != 'u'){ ?>
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="mx-auto col-md-12 text-center">
                        <!-- You have 10 new applicants are waiting for you. Please re-subscribe package to move this aplication.  -->
                        Subscription expired, please contact to Administrator.
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        
        <?php 
        $user_type = $this->session->userdata('login')['user_type']; 
         //print_r($cep[0]);
            $allcommonArr = array();
            if(!empty($school) && $user_type=='sub-admin'){ 
            foreach($school as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->unidoc_id.'" id="revewier_accept'.$value->unidoc_id.'" onClick="acceptuniversityApplication(\''.$value->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id;$documentfor = ($value->document_for=='n')?'School Accreditaion':'Renewal of School Accreditaion';                       
                $allcommonArr[] = array(
                    'user_id'   =>  $value->uniid,
                    'email'     =>  $value->email,
                    'added_on'  =>  $value->added_date,
                    'name'      =>  $value->university_name,
                    'title'      =>  '--',
                    'accreditation_for'  =>  $documentfor,
                    'type'      =>  'New',
                    'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } }

            if(!empty($graduates) && $user_type=='sub-admin'){ 
            foreach($graduates as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->grad_id.'" id="revewier_accept'.$value->grad_id.'" onClick="acceptgraduatesApplication(\''.$value->grad_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/graduatedetails/').$value->grad_id;                      
                $allcommonArr[] = array(
                    'user_id'  =>  $value->grad_id,
                    'email'    =>  $value->email,
                    'added_on'  => date('M-d-y'),
                    'name'  =>  $value->student_name.' '.$value->middle_name.' '.$value->surname,
                    'title'      =>  '--',
                    'accreditation_for'  =>  'Submission of Graduates for Licensure Examination',
                    'type'  =>  'New',
                    'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                    'amount' => 'N/A',
                    'txn_id' => 'N/A',
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details' => $viewDetailsLink,
                );
            } }

            if(!empty($cep) && $user_type=='sub-admin'){
            foreach($cep as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/cep_details/').$value->doc_id; 
                if($value->document_for=='n'){
                    $type = 'New';
                    $accreditation_for = 'CE Provider Accreditation';
                }else{
                    $type = 'Renewal';
                    $accreditation_for = 'CE Provider Accreditation (Renewal)';
                }                    
                $allcommonArr[] = array(
                    'user_id'   =>  $value->provider_id,
                    'email'     =>  $value->email,
                    'added_on'  => date('M-d-y H:i:s',strtotime($value->updated_at)),
                    'name'      =>  $value->business_name,
                    'title'      =>  '--',
                    'accreditation_for'  =>  $accreditation_for,
                    'type'      =>  $type,
                    'refrence_code' => $value->reference_no,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } }

            
            if(!empty($fp) && $user_type=='sub-admin'){
            foreach($fp as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                
                $type = 'Foreign Professional Review of Documents for Professional Registration';
                $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id;                   
                $allcommonArr[] = array(
                    'user_id'   =>  $value->user_ID,
                    'email'     =>  $value->email,
                    'added_on'  =>  (isset($value->added_on))?$value->added_on:'',
                    'name'      =>  $value->fullname,
                    'title'      =>  '--',
                    'accreditation_for'  =>  $type,
                    'type'      =>  'new',
                    'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
                } 
            }

             
            if(!empty($fpexamreg) && $user_type=='sub-admin'){
             
                foreach($fpexamreg as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                

                    $type = 'Foreign Professional Review of Documents for Licensure Examination';
                    $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;  
                                    
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->user_ID,
                        'email'     =>  $value->email,
                        'added_on'  =>  (isset($value->added_on))?$value->added_on:'',
                        'name'      =>  $value->fullname,
                        'title'      =>  '--',
                        'accreditation_for'  =>  'Foreign Professional Review of Documents for Licensure Examination',
                        'type'      =>  'new',
                        'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                        'amount'    => $value->amount,
                        'txn_id'    => $value->txn_id,
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
                } 
            }

            // if(!empty($fpexam) && $user_type=='sub-admin'){
            // foreach($fpexam as $value){
            //     if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
            //     $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
            //     $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;                      
            //     $allcommonArr[] = array(
            //         'user_id'   =>  $value->user_ID,
            //         'email'     =>  $value->email,
            //         'added_on'  => date('M-d-y'),
            //         'name'      =>  $value->fullname,
            //          'title'      =>  '--',
            //         'accreditation_for'  =>  'Foreign Professional Exam',
            //         'type'      =>  'new',
            //         'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
            //         'amount'    => $value->amount,
            //         'txn_id'    => $value->txn_id,
            //         'reviewer_status' => $status,
            //         'reviewer_action' => $reviewerName,
            //         'details'   => $viewDetailsLink,
            //     );
            // } }

            
            if(!empty($professional_renewal) && $user_type=='sub-admin'){
                foreach($professional_renewal as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';             

                        $type = 'Professional License Renewal';
                        $viewDetailsLink =  base_url('reviewer/reviewer/verify_certificate/').$value->user_ID.'/'.$value->doc_id;  
                  
                    $allcommonArr[] = array( 
                        'user_id'   =>  $value->user_ID,
                        'email'     =>  $value->email,
                        'added_on'  =>  (isset($value->added_on))?$value->added_on:'',
                        'name'      =>  $value->name,
                        'title'      =>  '--',
                        'accreditation_for'  =>  $type,
                        'type'      =>  'renew',
                        'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                        'amount'    => $value->amount,
                        'txn_id'    => $value->txn_id,
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
                } }

            //echo '<pre>';print_r($receipient_information);exit;
            if(!empty($receipient_information) && $user_type=='sub-admin'){
                foreach($receipient_information as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->ri_id.'" id="revewier_accept'.$value->ri_id.'" onClick="acceptrequestverification(\''.$value->ri_id.'\')" class="btn btn-primary px-5">Accept</button>';
                    $viewDetailsLink =  base_url('reviewer/reviewer/view_requestforverification/').$value->ri_id;
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->user_id,
                        'email'     =>  $value->email,
                        'added_on'  => (isset($value->added_on))?$value->added_on:'',
                        'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'title'      =>  '--',
                        'accreditation_for'  =>  'Request for Verification of Registration',
                        'type'  =>  '',
                        'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                        'amount'    => '',
                        'txn_id'    => '',
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
                }
            }

            //echo '<pre>';print_r($reqforgoodstand);exit;
            if(!empty($reqforgoodstand) && $user_type=='sub-admin'){
                foreach($reqforgoodstand as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->gs_id.'" id="revewier_accept'.$value->gs_id.'" onClick="acceptrequestgoodstand(\''.$value->gs_id.'\')" class="btn btn-primary px-5">Accept</button>';
                    $viewDetailsLink =  base_url('reviewer/reviewer/view_requestforgoodstand/').$value->gs_id;
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->user_id,
                        'email'     =>  $value->email,
                        'added_on'  => (isset($value->added_on))?$value->added_on:'',
                        'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'title'      =>  '--',
                        'accreditation_for'  =>  'Request for Certificate of Good Standing',
                        'type'  =>  '',
                        'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                        'amount'    => '',
                        'txn_id'    => '',
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
                }
            }

            if(!empty($course) && $user_type=='ct'){
                //echo'<pre>';    print_r($course[0]);
            foreach($course as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptCourseAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->doc_id.'/1';                      
                $allcommonArr[] = array(
                    'user_id'   =>  $value->provider_id,
                    'email'     =>  $value->email,
                    'added_on'  => date('M-d-y'),
                    'name'      =>  $value->business_name,
                    'title'      =>  $value->title,
                    'accreditation_for'  =>  'Online Course Accreditation',
                    'type'  =>  'New',
                    'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } }

            if(!empty($training) && $user_type=='ct'){
            foreach($training as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_trainingdoc/').$value->provider_id.'/'.$value->doc_id.'/1';                      
                $allcommonArr[] = array(
                    'user_id'   =>  $value->provider_id,
                    'email'     =>  $value->email,
                    'added_on'  => date('M-d-y'),
                    'name'      =>  $value->business_name,
                    'title'      =>  $value->title,
                    'accreditation_for'  =>  'Training Course Accreditation',
                    'type'  =>  'New',
                    'refrence_code' => (isset($value->refrence_code))?$value->refrence_code:'',
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } }
            
        ?>

        <div class="container-fluid">
            <h4 class="mt-4 mb-3">Online Applications</h4>
            <?php if($user_type == 'sub-admin'){
                        $allCount = $school_count + $graduates_count + $fp_count + $fpexamreg_count + $professional_renewal_count + $cep_count + $total_receipient_information + $total_reqforgoodstand;   
                    }else{
                        $allCount = $course_count + $training_count;   
                    } ?>


            <div class="row">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All (<?php echo ($allCount >0)?$allCount:0;?>)</a>
                  </li>
                  
                  <?php if($user_type == 'sub-admin'){ 
				 // if($school_count >0) { ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#schoolaccreditation" role="tab" aria-controls="pills-pending" aria-selected="false">School Accreditation (<?php echo ($school_count >0)?$school_count:0;?>)</a>
                  </li>
				  <?php //} ?>
                 <!-- <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-pending" aria-selected="false">Renewal of School Accreditation (<?php //echo $school_renewal_count; ?>)</a>
                  </li>-->
				  <?php //if($cep_count>0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#cep" role="tab" aria-controls="pills-rejected" aria-selected="false">CEP Accreditation (<?=($cep_count>0)?$cep_count:0;?>)</a>
                  </li>
				  <?php //} ?>
                  <!--<li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#cep_renewal" role="tab" aria-controls="pills-rejected" aria-selected="false">Renewal of CEP Accreditation (<?=$cep_renewal_count;?>)</a>
                  </li> -->
                  <?php //if($fpexam_count >0){ ?>
                  <!-- <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#onlineexam" role="tab" aria-controls="pills-rejected" aria-selected="false" title="Booking for Online Licensure Examination & Submission of Graduates for Licensure Examination" >Booking for Licensure Examination (<?php echo ($fpexam_count > 0)?$fpexam_count:0; ?>)</a>
                  </li> -->
				  <?php // } ?>
				  <?php // if($graduates_count >0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#graduates" role="tab" aria-controls="pills-rejected" aria-selected="false">Submission of Graduates for Licensure Examination (<?php echo ($graduates_count>0)?$graduates_count:0;?>)</a>
                  </li>
				  <?php //} ?>
				  
                  <?php //if($professional_renewal_count >0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#professional_renewal" role="tab" aria-controls="pills-rejected" aria-selected="false">Professional Identification Card (PIC) Renewal (<?php echo ($professional_renewal_count>0)?$professional_renewal_count:0;?>)</a>
                  </li>
				  <?php //} ?>

				  <?php //if($fp_count >0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fprofessional" role="tab" aria-controls="pills-rejected" aria-selected="false" title="Foreign Professional Review of Documents for Professional Registration">Foreign Professional Review of Documents for Professional Registration (<?php echo ($fp_count >0)?$fp_count:0; ?>)</a>
                  </li>
				  <?php //} ?>
				  <?php //if($fpexamreg_count >0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fpexamreg" role="tab" aria-controls="pills-rejected" aria-selected="false">Foreign Professional Review of Documents for Licensure Examination (<?php echo ($fpexamreg_count >0)?$fpexamreg_count:0; ?>)</a>
                  </li>
				  <?php //} ?>
				  <?php //if($graduates_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#request" role="tab" aria-controls="pills-rejected" aria-selected="false">Request for verification of Registration (<?php echo $total_receipient_information;?>)</a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#goodstanding" role="tab" aria-controls="pills-rejected" aria-selected="false">Request for Certificate of Good Standing (<?php echo $total_reqforgoodstand;?>)</a>
                    </li>
                <?php //} ?>
                <?php }else{ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#course_acc" role="tab" aria-controls="pills-approved" aria-selected="false">Online Course Accreditation (<?php echo ($course_count>0)?$course_count:0; ?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#training_acc" role="tab" aria-controls="pills-approved" aria-selected="false">Training Course Accreditation (<?php echo ($training_count > 0)?$training_count:0; ?>)</a>
                    </li>
                <?php }?>
                </ul>

            <div class="tab-content" id="pills-tabContent">
                  
              <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                <?php if($user_type=='ct'){ ?>
                                    <th>Course / Training Name</th>
                                <?php } ?>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
									<th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php if($allcommonArr) {
                                    $i = 1;
                                    foreach($allcommonArr as $key => $value){  ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                    <?php if($user_type=='ct'){ ?>
                                        <td><?php echo $value['title']; ?></td>
                                    <?php } ?>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['accreditation_for']; ?></td>
                                        <td><?php echo $value['refrence_code']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s',strtotime($value['added_on'])); ?></td>
                                        <td><?php echo $value['reviewer_status']; ?></td>
                                        <td><?php echo $value['reviewer_action']; ?></td>
										<td><a href="<?php echo $value['details']; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>

                        </table>
                    </div>
                  </div> 
              </div>

                    
              <div class="tab-pane fade" id="schoolaccreditation" role="tabpanel" aria-labelledby="pills-approved-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered reviewerDT" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Applicant Name</th>
                                        <th>Application for</th>
                                        <th>Refrence Number</th>
                                        <th>Email</th>
                                        <th>Date & Time for Application</th>
                                        <th>Status</th>
                                        <th>Reviewer</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  if($school) {
                                        $i = 1;
                                        foreach($school as $value){ 
                                        if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                        $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->unidoc_id.'" id="revewier_accept'.$value->unidoc_id.'" onClick="acceptuniversityApplication(\''.$value->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>'; 
                                        $viewDetailsLink =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id;    
                                        $documentfor = ($value->document_for=='n')?'School Accreditaion':'Renewal of School Accreditaion';
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value->university_name; ?></td>
                                            <td><?php echo $documentfor; ?></td>
                                            <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                            <td><?php echo $value->email; ?></td>
                                            <td><?php echo date('M-d-Y H:i:s'); ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $reviewerName; ?></td>
                                            <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                        </tr>
                                        <?php $i++; } } ?>
                                </tbody>
                            </table>
                        </div>
                  </div> 
              </div>
              
              <div class="tab-pane fade" id="graduates" role="tabpanel" aria-labelledby="pills-pending-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                           <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
									<th>Action</th>

                                </tr>
                            </thead>
							<tbody>
                                <?php  if($graduates) {
                                    $i = 1;
                                    foreach($graduates as $value){ 
									if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
									$reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->grad_id.'" id="revewier_accept'.$value->grad_id.'" onClick="acceptgraduatesApplication(\''.$value->grad_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
									$viewDetailsLink =  base_url('reviewer/reviewer/graduatedetails/').$value->grad_id; 
									?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->student_name.' '.$value->middle_name.' '.$value->surname; ?></td>
                                        <td><?php echo 'Submission of Graduates for Licensure Examination'; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s'); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div> 

              </div>
              <div class="tab-pane fade" id="professional_renewal" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($professional_renewal) {
                                    // echo'<pre>'; print_r($professional_renewal[0]);die;
                                    $i = 1;
                                    foreach($professional_renewal as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    
                                    $type = 'Professional License Renewal';
                                    $viewDetailsLink =  base_url('reviewer/reviewer/verify_certificate/').$value->user_ID.'/'.$value->doc_id;  
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s',strtotime((isset($value->added_on))?$value->added_on:'')); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              
              <div class="tab-pane fade" id="fprofessional" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($fp) {
                                    $i = 1;
                                    foreach($fp as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    
                                    $type = 'Foreign Professional Review of Documents for Professional Registration';
                                    $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id;    
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s',strtotime((isset($value->added_on))?$value->added_on:'')); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="fpexamreg" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($fpexamreg) {
                                    $i = 1;
                                    foreach($fpexamreg as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    
                                    
                                    $type = 'Foreign Professional Review of Documents for Licensure Examination';
                                    $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;  
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s',strtotime((isset($value->added_on))?$value->added_on:'')); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

              <!-- <div class="tab-pane fade" id="onlineexam" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php if($fpexam) {
                                    $i = 1;
                                    foreach($fpexam as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo 'Foreign Professional Application'; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s'); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div> -->
              <div class="tab-pane fade" id="cep" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($cep) {
                                    $i = 1;
                                    foreach($cep as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/cep_details/').$value->doc_id; 
                                    if($value->document_for=='n'){
                                        $type = 'New';
                                        $accreditation_for = 'CE Provider Accreditation';
                                    }else{
                                        $type = 'Renewal';
                                        $accreditation_for = 'CE Provider Accreditation (Renewal)';
                                    }  
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo $accreditation_for; ?></td>
                                        <td><?php echo $value->reference_no; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-y H:i:s',strtotime($value->updated_at)); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

             <!--  <div class="tab-pane fade" id="cep_renewal" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($cep_renewal) {
                                    $i = 1;
                                    foreach($cep_renewal as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/cep_details/').$value->doc_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo 'CE Provider Renewal'; ?></td>
                                        <td><?php echo $value->reference_no; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div> -->

              <div class="tab-pane fade" id="course_acc" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Course Name</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($course) {
                                    $i = 1;
                                    foreach($course as $value){ 
                                    if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptCourseAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->doc_id;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->title; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo 'Online Course Accreditation'; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s'); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

            <div class="tab-pane fade" id="training_acc" role="tabpanel" aria-labelledby="pills-rejected-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Training Name</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($training) {
                                    $i = 1;
                                    foreach($training as $value){ 
                                    if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_trainingdoc/').$value->provider_id.'/'.$value->doc_id;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->title; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo 'Training Course Accreditation'; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s'); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="pills-rejected-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($receipient_information) {
                                    $i = 1;
                                    foreach($receipient_information as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->ri_id.'" id="revewier_accept'.$value->ri_id.'" onClick="acceptrequestverification(\''.$value->ri_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/view_requestforverification/').$value->ri_id;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fname.' '.$value->lname.' '.$value->name; ?></td>
                                        <td><?php echo 'Request for Verification of Registration'; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s',strtotime((isset($value->added_on))?$value->added_on:'')); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="goodstanding" role="tabpanel" aria-labelledby="pills-rejected-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Application for</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Date & Time for Application</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($reqforgoodstand) {
                                    $i = 1;
                                    foreach($reqforgoodstand as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->gs_id.'" id="revewier_accept'.$value->gs_id.'" onClick="acceptrequestgoodstand(\''.$value->gs_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                                    $viewDetailsLink =  base_url('reviewer/reviewer/view_requestforgoodstand/').$value->gs_id;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fname.' '.$value->lname.' '.$value->name; ?></td>
                                        <td><?php echo 'Request for Certificate of Good Standing'; ?></td>
                                        <td><?php echo (isset($value->refrence_code))?$value->refrence_code:''; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo date('M-d-Y H:i:s',strtotime((isset($value->added_on))?$value->added_on:'')); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>

            </div>
        </div>
    </main>


<script>    
    $(document).ready(function() {
        $('.reviewerDT').DataTable();
    } );
        
        var no_of_applcation = '<?php echo $no_of_applcation ?>';
        var current_application = '<?php echo $current_application ?>';
    
    function acceptuniversityApplication(appid){
		if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            if(confirm("Do you accept to review this application ?")){
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/universityassignedreviewer",
                    data: { appid : appid,reviewer_id:reviewer_id },
                    success: function(data) {
                        //alert(data);
                        if(data>0){
                            // alert('Reviewer assigned for the school.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                            
                        }   
                    }
                });
            }
            else{
                return false;
            }
		}
    }


    function acceptgraduatesApplication(appid){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            if(confirm("Do you accept to review this application ?")){
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/graduateassignedreviewer",
                    data: { appid : appid,reviewer_id:reviewer_id },
                    success: function(data) {
                        //alert(data);
                        if(data>0){
                            // alert('Reviewer assigned for the graduates.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            
            }else{
                return false;
            }	
		}	
    }

    function acceptcep(doc_id){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            if(confirm("Do you accept to review this application ?")){
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/cepassignedreviewer",
                    data: { doc_id : doc_id,reviewer_id:reviewer_id },
                    success: function(data) {
                        if(data>0){
                            // alert('Reviewer assigned for CEP.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            }else{
                return false;
            }
		}
     }

    function acceptprofessionalApplication(doc_id){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            if(confirm("Do you accept to review this application ?")){
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/professionalassignedreviewer",
                    data: { appid : doc_id,reviewer_id:reviewer_id },
                    success: function(data) {
                        //alert(data);
                        if(data>0){
                            // alert('Reviewer assigned for professional.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            }else{
                return false;
            }
		}
    }

    function acceptCourseAccr(appid){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{ 
            var conf = confirm("Do you accept to review this couse application ?");
            if (conf == true) {
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/courseassignedreviewer",
                    data: { appid : appid,reviewer_id:reviewer_id },
                    success: function(data) {
                        //alert(data);
                        if(data > 0){
                            // alert('Reviewer assigned for Course.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            }
        }
    }


    function acceptTrainingAccr(appid){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            var conf = confirm("Do you accept to review this training ?");
            if (conf == true) {
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/trainingassignedreviewer",
                    data: { appid : appid,reviewer_id:reviewer_id },
                    success: function(data) {
                        if(data > 0){
                            // alert('Reviewer assigned on training.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            }
        }
    }
    function acceptrequestverification(appid){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            var conf = confirm("Do you accept to review this Request for Verification of Registration?");
            if (conf == true) {
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/requestverificationassignedreviewer",
                    data: { appid : appid,reviewer_id:reviewer_id },
                    success: function(data) {
                        if(data > 0){
                            // alert('Reviewer assigned on training.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            }
        }
    }

    function acceptrequestgoodstand(appid){
        if(parseInt(no_of_applcation) <= parseInt(current_application) && current_application != 'u'){
            if(confirm("Subscription expired, please contact to Administrator.")){
                window.location.href="<?php echo base_url('contactus')?>";
            }else{
                return false;
            }
            
        }else{
            var conf = confirm("Do you accept to review this Request for Certificate of Good Standing?");
            if (conf == true) {
                var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>reviewer/reviewer/req_good_stand_assigned_reviewer",
                    data: { appid : appid,reviewer_id:reviewer_id },
                    success: function(data) {
                        if(data > 0){
                            // alert('Reviewer assigned on training.');
                            // location.reload();
                            window.location.href= "<?php echo base_url('')?>"+"reviewer/reviewer/forReview_listing";
                        }   
                    }
                });
            }
        }
    }
</script>