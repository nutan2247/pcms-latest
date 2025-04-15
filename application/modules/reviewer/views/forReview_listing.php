<div id="layoutSidenav_content">
    <main>
        <?php  //print_r($cep[0]);
         $user_type = $this->session->userdata('login')['user_type']; 
            $allcommonArr = array();
            if(!empty($school) && $user_type=='sub-admin'){ 
            foreach($school as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->unidoc_id.'" id="revewier_accept'.$value->unidoc_id.'" onClick="acceptuniversityApplication(\''.$value->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id;
                $viewDetailsLink2 =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id.'/1';
                $documentfor = ($value->document_for=='n')?'School Accreditaion':'Renewal of School Accreditaion';                       
                $allcommonArr[] = array(
                    'user_id'   =>  $value->uniid,
                    'email'     =>  $value->email,
                    'name'      =>  $value->university_name,
                    'accreditation_for'  =>  $documentfor,
                    'type'      =>  'New',
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'details2'   => $viewDetailsLink2,
                );
            } }

           /*  if(!empty($school_renewal) && $user_type=='sub-admin'){ 
            foreach($school_renewal as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->unidoc_id.'" id="revewier_accept'.$value->unidoc_id.'" onClick="acceptuniversityApplication(\''.$value->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id; $documentfor = ($value->document_for=='n')?'School Accreditaion':'Renewal of School Accreditaion';                     
                $allcommonArr[] = array(
                    'user_id'   =>  $value->uniid,
                    'email'     =>  $value->email,
                    'name'      =>  $value->university_name,
                    'accreditation_for'  =>  $documentfor,
                    'type'      =>  'Renewal',
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } } */
            if(!empty($graduates) && $user_type=='sub-admin'){ 
            foreach($graduates as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->grad_id.'" id="revewier_accept'.$value->grad_id.'" onClick="acceptgraduatesApplication(\''.$value->grad_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/graduatedetails/').$value->grad_id; 
                $viewDetailsLink2 =  base_url('reviewer/reviewer/graduatedetails/').$value->grad_id.'/1';                     
                $allcommonArr[] = array(
                    'user_id'  =>  $value->grad_id,
                    'email'    =>  $value->email,
                    'name'  =>  $value->student_name.' '.$value->middle_name.' '.$value->surname,
                    'accreditation_for'  =>  'Submission of Graduates for Licensure Examination',
                    'type'  =>  'New',
                    'refrence_code' => $value->refrence_code,
                    'amount' => 'N/A',
                    'txn_id' => 'N/A',
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details' => $viewDetailsLink,
                    'details2'   => $viewDetailsLink2,
                );
            } }

            if(!empty($cep) && $user_type=='sub-admin'){
            foreach($cep as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/cep_details/').$value->doc_id; 
                $viewDetailsLink2 =  base_url('reviewer/reviewer/cep_details/').$value->doc_id.'/1';  
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
                    'name'      =>  $value->business_name,
                    'accreditation_for'  =>  $accreditation_for,
                    'type'      =>  $type,
                    'refrence_code' => $value->reference_no,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'details2'   => $viewDetailsLink2,
                );
            } }

            // if(!empty($cep_renewal) && $user_type=='sub-admin'){
            // foreach($cep_renewal as $value){
            //     if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
            //     $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
            //     $viewDetailsLink =  base_url('reviewer/reviewer/cep_details/').$value->doc_id;                      
            //     $allcommonArr[] = array(
            //         'user_id'   =>  $value->provider_id,
            //         'email'     =>  $value->email,
            //         'name'      =>  $value->business_name,
            //         'accreditation_for'  =>  'CE Provider Renewal',
            //         'type'  =>  'Renewal',
            //         'refrence_code' => $value->reference_no,
            //         'amount'    => $value->amount,
            //         'txn_id'    => $value->txn_id,
            //         'reviewer_status' => $status,
            //         'reviewer_action' => $reviewerName,
            //         'details'   => $viewDetailsLink,
            //     );
            // } }

            if(!empty($fp) && $user_type=='sub-admin'){
            foreach($fp as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                 if($value->role=='P'){
                    $type = 'Foreign Professional Review of Documents for Licensure Examination';
                    $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;  
                    $viewDetailsLink2 =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id.'/1';
                }

                if($value->role=='F'){
                    $type = 'Foreign Professional Review of Documents for Professioanl Registration';
                    $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id; 
                    $viewDetailsLink2 =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id.'/1'; 
                }                   
                $allcommonArr[] = array(
                    'user_id'   =>  $value->user_ID,
                    'email'     =>  $value->email,
                    'name'      =>  $value->fullname,
                    'accreditation_for'  =>  $type,
                    'type'      =>  'new',
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'details2'   => $viewDetailsLink2,
                );
            } }

            if(!empty($fpexamreg) && $user_type=='sub-admin'){
            foreach($fpexamreg as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;
                $viewDetailsLink2 =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id.'/1';
                $allcommonArr[] = array(
                    'user_id'   =>  $value->user_ID,
                    'email'     =>  $value->email,
                    'name'      =>  $value->fullname,
                    'accreditation_for'  =>  'Foreign Professional Review of Documents for Licensure Examination',
                    'type'      =>  'new',
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'details2'   => $viewDetailsLink2,
                );
            } }
            if(!empty($professional_renewal) && $user_type=='sub-admin'){
                foreach($professional_renewal as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';             

                        $type = 'Professional License Renewal';
                        $viewDetailsLink =  base_url('reviewer/reviewer/verify_certificate/').$value->user_ID.'/'.$value->doc_id;
                        $viewDetailsLink2 =  base_url('reviewer/reviewer/verify_certificate/').$value->user_ID.'/'.$value->doc_id.'/1';  
                  
                    $allcommonArr[] = array( 
                        'user_id'           =>  $value->user_ID,
                        'email'             =>  $value->email,
                        'added_on'          =>  $value->added_on,
                        'name'              =>  $value->name,
                        'accreditation_number' =>  isset($value->registration_no)?$value->registration_no:$value->refrence_code,
                        'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                        'accreditation_for' =>  $type,
                        'type'              =>  'renew',
                        'refrence_code'     => $value->refrence_code,
                        'amount'            => $value->amount,
                        'txn_id'            => $value->txn_id,
                        'reviewer_status'   => $status,
                        'reviewer_action'   => $reviewerName,
                        'details'           => $viewDetailsLink,
                        'details2'           => $viewDetailsLink2,
                    );
                } }
            if(!empty($course) && $user_type=='ct'){
                        foreach($course as $value){
                            if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                            $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptCourseAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                            $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->doc_id;                       
                            $viewDetailsLink2 =  base_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->doc_id.'/1';                      
                            $allcommonArr[] = array(
                                'user_id'   =>  $value->provider_id,
                                'email'     =>  $value->email,
                                'name'      =>  $value->business_name.' ( '.$value->title.' ) ',
                                'accreditation_for'  =>  'Online Course Accreditation',
                                'type'  =>  'New',
                                'refrence_code' => $value->refrence_code,
                                'amount'    => $value->amount,
                                'txn_id'    => $value->txn_id,
                                'reviewer_status' => $status,
                                'reviewer_action' => $reviewerName,
                                'details'   => $viewDetailsLink,
                                'details2'   => $viewDetailsLink2,
                            );
                        } }
            
                        if(!empty($training) && $user_type=='ct'){
                        foreach($training as $value){
                            if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                            $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                 
                            $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_trainingdoc/').$value->provider_id.'/'.$value->doc_id;                      
                            $viewDetailsLink2 =  base_url('reviewer/reviewer/reviewer_trainingdoc/').$value->provider_id.'/'.$value->doc_id.'/1';                      
                            $allcommonArr[] = array(
                                'user_id'   =>  $value->provider_id,
                                'email'     =>  $value->email,
                                'name'      =>  $value->business_name.' ( '.$value->title.' ) ',
                                'accreditation_for'  =>  'Training Course Accreditation',
                                'type'  =>  'New',
                                'refrence_code' => $value->refrence_code,
                                'amount'    => $value->amount,
                                'txn_id'    => $value->txn_id,
                                'reviewer_status' => $status,
                                'reviewer_action' => $reviewerName,
                                'details'   => $viewDetailsLink,
                                'details2'   => $viewDetailsLink2,
                            );
                        } }
                        if(!empty($receipient_information) && $user_type=='sub-admin'){
                            foreach($receipient_information as $value){
                                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->ri_id.'" id="revewier_accept'.$value->ri_id.'" onClick="acceptrequestverification(\''.$value->ri_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                $viewDetailsLink =  base_url('reviewer/reviewer/verify_requestforverification/').$value->ri_id;
                                $viewDetailsLink2 =  base_url('reviewer/reviewer/view_requestforverification/').$value->ri_id;
                                $allcommonArr[] = array(
                                    'user_id'   =>  $value->user_id,
                                    'email'     =>  $value->email,
                                    'added_on'  => $value->added_on,
                                    'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                                    'title'      =>  '--',
                                    'accreditation_for'  =>  'Request for Verification of Registration',
                                    'type'  =>  '',
                                    'refrence_code' => $value->refrence_code,
                                    'amount'    => '',
                                    'txn_id'    => '',
                                    'reviewer_status' => $status,
                                    'reviewer_action' => $reviewerName,
                                    'details'   => $viewDetailsLink,
                                    'details2'   => $viewDetailsLink2,
                                );
                            }
                        }
                        if(!empty($reqforgoodstand) && $user_type=='sub-admin'){
                            foreach($reqforgoodstand as $value){
                                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'<button type="button" data-id="'.$value->gs_id.'" id="revewier_accept'.$value->gs_id.'" onClick="acceptrequestverification(\''.$value->gs_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                $viewDetailsLink =  base_url('reviewer/reviewer/verify_req_for_good_standing/').$value->gs_id;
                                $viewDetailsLink2 =  base_url('reviewer/reviewer/view_requestforgoodstand/').$value->gs_id;
                                $allcommonArr[] = array(
                                    'user_id'   =>  $value->user_id,
                                    'email'     =>  $value->email,
                                    'added_on'  => $value->added_on,
                                    'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                                    'title'      =>  '--',
                                    'accreditation_for'  =>  'Request for Certificate of Good Standing',
                                    'type'  =>  '',
                                    'refrence_code' => $value->refrence_code,
                                    'amount'    => '',
                                    'txn_id'    => '',
                                    'reviewer_status' => $status,
                                    'reviewer_action' => $reviewerName,
                                    'details'   => $viewDetailsLink,
                                    'details2'   => $viewDetailsLink2,
                                );
                            }
                        }

            if($user_type == 'sub-admin'){
                $allCount = $school_count + $graduates_count + $fp_count + $fpexamreg_count + $cep_count + $total_receipient_information + $total_reqforgoodstand;   
            }else{
                $allCount = $course_count + $training_count;   
            }
        ?>

        <div class="container-fluid">
            <h4 class="mt-4 mb-3">For Review Application (<?php echo $allCount;?>)</h4>
           
            <div class="row">
                <!--<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All (<?=$allCount;?>)</a>
                  </li>
                  <?php if($user_type == 'sub-admin'){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#schoolaccreditation" role="tab" aria-controls="pills-pending" aria-selected="false">School Accreditation (<?php echo $school_count;?>)</a>
                  </li>
                   <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#cep" role="tab" aria-controls="pills-rejected" aria-selected="false">CEP Accreditation (<?=$cep_count;?>)</a>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fpexam" role="tab" aria-controls="pills-rejected" aria-selected="false">Booking for Online Licensure Examination ()</a>
                  
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#graduates" role="tab" aria-controls="pills-rejected" aria-selected="false">Submission of Graduates for Licensure Examination (<?php echo $graduates_count;?>)</a>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fprofessional" role="tab" aria-controls="pills-rejected" aria-selected="false">Foreign Professional Review of Documents for Professioanl Registration (<?php echo $fp_count; ?>)</a>
                  </li>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#pills-rejected" role="tab" aria-controls="pills-rejected" aria-selected="false">Foreign Professional Review of Documents for Licensure Examination (<?php echo $fpexam_count; ?>)</a>
                  </li>
                  <?php }else{ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#course_acc" role="tab" aria-controls="pills-approved" aria-selected="false">Course Accreditation (<?php echo ($course_count>0)?$course_count:0; ?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#training_acc" role="tab" aria-controls="pills-approved" aria-selected="false">Training Accreditation (<?php echo ($training_count > 0)?$training_count:0; ?>)</a>
                    </li>
                <?php }?>
                 
                </ul>-->

                <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                  
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
                                <?php  if($allcommonArr) {
                                    $i = 1;
                                    foreach($allcommonArr as $key => $value){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['accreditation_for']; ?></td>
                                        <td><?php echo $value['refrence_code']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['reviewer_status']; ?></td>
                                        <td><?php echo $value['reviewer_action']; ?></td>
										<td><a href="<?php echo $value['details']; ?>" target=""><i class="fas fa-check"></i></a>
                                            <a href="<?php echo $value['details2']; ?>" target=""><i class="fas fa-eye"></i></a>
                                        </td>

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
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

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
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

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
                                    // $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/'.$value->user_ID.'/'.$value->doc_id;
                                    if($value->role=='P'){
                                            $type = 'Foreign Professional Review of Documents for Licensure Examination';
                                            $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;  
                                        }

                                        if($value->role=='F'){
                                            $type = 'Foreign Professional Review of Documents for Professioanl Registration';
                                            $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id;  
                                        }  
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
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
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
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
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
    <!--           
              <div class="tab-pane fade" id="cep_renewal" role="tabpanel" aria-labelledby="pills-rejected-tab">
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
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
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
                                        <td><a href="<?php echo $viewDetailsLink; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div> -->

            </div>

            </div>
        </div>
    </main>


<script>    
    $(document).ready(function() {
        $('.reviewerDT').DataTable();
    } );

 
</script>