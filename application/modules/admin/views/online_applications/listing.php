<style>
    #myTabContent {
        border: 1px solid #efefef;
        margin-top: -1px;
    }

    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #007bff;
        border-color: #007bff !important;
    }

    #o-all .nav-link.active {
        color: #fff !important;
        background-color: #000;
        border-color: #000 !important;
    }
    .r-board-modal-listing .modal-header {
        background-color: #007bff;
    }
    .r-board-modal-listing  .close {
        opacity: 1;
        font-weight: 100;
    }
</style>

<?php 
     //print_r($training[0]);exit;
            $allcommonArr = array();
            if(!empty($school)){ 
            foreach($school as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->unidoc_id.'" id="revewier_accept'.$value->unidoc_id.'" onClick="acceptuniversityApplication(\''.$value->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>';
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
                $viewDetailsLink =  base_url('admin/unversitydetails/').$value->unidoc_id;$documentfor = ($value->document_for=='n')?'School Accreditation':'Renewal of School Accreditation';                       
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
                );
            } }

          
            if(!empty($graduates)){ 
            foreach($graduates as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->grad_id.'" id="revewier_accept'.$value->grad_id.'" onClick="acceptgraduatesApplication(\''.$value->grad_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                    
                $viewDetailsLink =  base_url('admin/graduatedetails/').$value->grad_id;                      
                $allcommonArr[] = array(
                    'user_id'  =>  $value->grad_id,
                    'email'    =>  $value->email,
                    'name'  =>  $value->student_name.' '.$value->middle_name.' '.$value->surname,
                    // 'accreditation_for'  =>  'Booking For Online Licensure Examination (Local Graduates)',
                    'accreditation_for'  =>  'Submission of Graduates for Licensure Examination',
                    'type'  =>  'New',
                    'refrence_code' => $value->refrence_code,
                    'amount' => 'N/A',
                    'txn_id' => 'N/A',
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details' => $viewDetailsLink,
                );
            } }

            if(!empty($fprofessional_exam)){
                foreach($fprofessional_exam as $value){
                    // if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                   
                    $viewDetailsLink =  base_url('admin/profexamdetails/').$value->user_ID;                      
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->user_ID,
                        'email'     =>  $value->email,
                        'name'      =>  $value->fullname,
                        'accreditation_for'  =>  'Booking for Online Licensure Examination (Foreign Professional)',
                        'type'      =>  'new',
                        'refrence_code' => $value->refrence_code,
                        'amount'    => $value->amount,
                        'txn_id'    => $value->txn_id,
                        'reviewer_status' => '--',
                        'reviewer_action' => '--',
                        'details'   => $viewDetailsLink,
                    );
                } }

            if(!empty($graduates_exam)){
                foreach($graduates_exam as $value){
                    // if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                   
                    $viewDetailsLink =  base_url('admin/profexamdetails/').$value->grad_id;                      
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->grad_id,
                        'email'     =>  $value->email,
                        'name'      =>  $value->fullname,
                        'accreditation_for'  =>  'Booking for Online Licensure Examination (Graduates)',
                        'type'      =>  'new',
                        'refrence_code' => $value->refrence_code,
                        'amount'    => $value->amount,
                        'txn_id'    => $value->txn_id,
                        'reviewer_status' => '--',
                        'reviewer_action' => '--',
                        'details'   => $viewDetailsLink,
                    );
                } }

            if(!empty($cep)){
            foreach($cep as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'--';                   
                $viewDetailsLink =  base_url('admin/acc_details/').$value->doc_id;   
                if($value->document_for=='n'){
                    $type = 'New';
                    $accreditation_for = 'CEP Accreditation';
                }else{
                    $type = 'Renewal';
                    $accreditation_for = 'Renewal of CEP Accreditation';
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
                );
            } }

        if(!empty($fp)){
            foreach($fp as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';   
                $type = 'Foreign Professional Review of Documents for Professional Registration';
                $viewDetailsLink =  base_url('admin/professionaldetails/').$value->user_ID.'/'.$value->doc_id;  
                                
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
                );
            } }
       
        if(!empty($fpexamreg)){
            foreach($fpexamreg as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';   
                $type = 'Foreign Professional Review of Documents for Licensure Examination';
                $viewDetailsLink =  base_url('admin/profexamdetails/').$value->user_ID.'/'.$value->doc_id;  
                                  
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
                );
            } }

            //if(!empty($professional_registration) && $user_type == "sub-admin"){
            if(!empty($professional_registration)){
                foreach($professional_registration as $value){
                    // if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';             

                        $type = 'Professional Registration';
                        $viewDetailsLink =  base_url('admin/verify_certificate/').$value->user_ID;  
                  
                    $allcommonArr[] = array( 
                        'user_id'   =>  $value->user_ID,
                        'email'     =>  $value->email,
                        'added_on'  =>  $value->added_on,
                        'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_for'  =>  $type,
                        'type'      =>  'new',
                        'refrence_code' => $value->refrence_code,
                        'amount'    => $value->amount,
                        'txn_id'    => $value->txn_id,
                        'reviewer_status' => '--',
                        'reviewer_action' => '--',
                        'details'   => $viewDetailsLink,
                    );
                } 
            }
           
            //if(!empty($professional_renewal) && $user_type == "sub-admin"){
            if(!empty($professional_renewal)){
                foreach($professional_renewal as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';             

                        $type = 'Renewal of Professional Registration';
                        $viewDetailsLink =  base_url('admin/verify_certificate/').$value->user_ID.'/'.$value->doc_id;  
                  
                    $allcommonArr[] = array( 
                        'user_id'   =>  $value->user_ID,
                        'email'     =>  $value->email,
                        'added_on'  =>  $value->added_on,
                        'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_for'  =>  $type,
                        'type'      =>  'renew',
                        'refrence_code' => $value->refrence_code,
                        'amount'    => $value->amount,
                        'txn_id'    => $value->txn_id,
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
                } 
            }

            if(!empty($course)){
            foreach($course as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptCourseAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';   
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                  
                $viewDetailsLink =  base_url('admin/course_document_details/').$value->doc_id;                      
                $allcommonArr[] = array(
                    'user_id'   =>  $value->provider_id,
                    'email'     =>  $value->email,
                    'name'      =>  $value->business_name,
                    'accreditation_for'  =>  'Online Course Accreditation',
                    'type'  =>  'New',
                    'apptitle'  =>  $value->title,
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } }

            if(!empty($training)){
            foreach($training as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'--';                   
                $viewDetailsLink =  base_url('admin/training_document_details/').$value->doc_id;                      
                $allcommonArr[] = array(
                    'user_id'   =>  $value->provider_id,
                    'email'     =>  $value->email,
                    'name'      =>  $value->business_name,
                    'accreditation_for'  =>  'Training Course Accreditation',
                    'type'  =>  'New',
                    'apptitle'  =>  $value->title,
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                );
            } }
            if(!empty($receipient_information)){ //print_r($receipient_information);exit;
                foreach($receipient_information as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                   
                    $viewDetailsLink =  base_url('admin/view_requestforverification/').$value->ri_id;                      
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->user_id,
                        'email'     =>  $value->email,
                        'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_for'  =>  'Request for Verification of Registration',
                        'type'  =>  '',
                        'apptitle'  =>  '',
                        'refrence_code' => $value->refrence_code,
                        'amount'    => '',
                        'txn_id'    => '',
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
            } }

            if(!empty($reqforgoodstand)){ //print_r($receipient_information);exit;
                foreach($reqforgoodstand as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                   
                    $viewDetailsLink =  base_url('admin/view_requestforgoodstand/').$value->gs_id;                      
                    $allcommonArr[] = array(
                        'user_id'   =>  $value->user_id,
                        'email'     =>  $value->email,
                        'name'      =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_for'  =>  'Request for Certificate of Good Standing',
                        'type'  =>  '',
                        'apptitle'  =>  '',
                        'refrence_code' => $value->refrence_code,
                        'amount'    => '',
                        'txn_id'    => '',
                        'reviewer_status' => $status,
                        'reviewer_action' => $reviewerName,
                        'details'   => $viewDetailsLink,
                    );
            } }

        ?>
<?php 
    $subscription = $this->common_model->get_admin_subscription_details();
    // echo'<pre>';print_r($subscription);
    $no_of_applcation = $subscription->total_application; 
    $current_application = $this->common_model->get_online_application_count();

    if($subscription->subscription_id == 6 && $subscription->total_application == 0){
        $current_application = 'u'; // unlimited
    }else{
        if($current_application){
            $current_application = $current_application;
        }else{
            $current_application = 0;
        }  
    }
    $total_new_application =0;
    // $total_new_application = $new_school_application_count + $new_graduates_application_count + $new_cep_application_count + $new_fprofesional_application_count + $new_fpexamreg_application_count + $new_professional_renewal_application_count + $new_course_application_count + $new_training_application_count;
?>

<div id="layoutSidenav_content">
    <main>
    <?php if($no_of_applcation <= $current_application && $current_application != 'u'){ ?>
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="mx-auto col-md-12 text-center">
                        Subscription expired.
                    </div>
                    <div class="mx-auto col-md-12 text-center">
                        <?=$total_new_application;?> new applicants are waiting for you. Please re-subscribe package to move this application into online application. 
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
            <div>

                <?php $allCount = $school_count + $graduates_count + $fprofessional_exam_count + $fp_count + $fpexamreg_count + $professional_renewal_count + $professional_registration_count + $cep_count + $course_count + $training_count + $total_receipient_information + $total_reqforgoodstand; ?>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All (<?=$allCount;?>)</a>
                  </li>
                  
                   <!--  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-approved" aria-selected="false">Professional Registration () </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-approved" aria-selected="false">Renewal of Professional Registration ()</a>
                    </li> -->
                <?php //if($school_count > 0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#schoolaccreditation" role="tab" aria-controls="pills-pending" aria-selected="false">School Accreditation (<?php echo $school_count;?>)</a>
                  </li>
                <?php //} ?>

                <?php //if($graduates_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#graduates" role="tab" aria-controls="pills-rejected" aria-selected="false">Submission of Graduates for Licensure Examination (<?php echo $graduates_count;?>)</a>
                    </li>
                <?php //} ?>

                <?php //if($graduates_exam_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#gexam" role="tab" aria-controls="pills-rejected" aria-selected="false">Booking for Online Licensure Examination (Graduates) (<?php echo $graduates_exam_count; ?>)</a>
                    </li>
                <?php //} ?>
                <?php //if($fprofessional_exam_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fprofessionalexam" role="tab" aria-controls="pills-rejected" aria-selected="false">Booking for Online Licensure Examination (Foreign Professional) (<?php echo $fprofessional_exam_count; ?>)</a>
                    </li>
                <?php //} ?>

                <?php //if($professional_registration_count >0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#professional_registration" role="tab" aria-controls="pills-rejected" aria-selected="false">Professional Registration (<?php echo ($professional_registration_count>0)?$professional_registration_count:0;?>)</a>
                  </li>
				  <?php //} ?>

                <?php //if($professional_renewal_count >0){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#professional_renewal" role="tab" aria-controls="pills-rejected" aria-selected="false">Renewal of Professional Registration (<?php echo ($professional_renewal_count>0)?$professional_renewal_count:0;?>)</a>
                  </li>
				  <?php //} ?>

                <?php //if($cep_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#cep" role="tab" aria-controls="pills-rejected" aria-selected="false">CEP Accreditation (<?=$cep_count;?>)</a>
                    </li>
                <?php //} ?>
                
                <?php //if($course_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#course_acc" role="tab" aria-controls="pills-approved" aria-selected="false">Online Course Accreditation(<?php echo $course_count; ?>) </a>
                    </li>
                <?php //} ?>
                
                <?php //if($training_count > 0){ ?>
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#training_acc" role="tab" aria-controls="pills-approved" aria-selected="false">Training Course Accreditation (<?php echo $training_count; ?>)</a>
                </li>
                <?php //} ?>

                <?php //if($fp_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fprofessional" role="tab" aria-controls="pills-rejected" aria-selected="false">Foreign Professional Review of Documents for Professioanl Registration (<?php echo $fp_count; ?>)</a>
                    </li>
                <?php //} ?>

                    
                <?php //if($fpexamreg_count > 0){ ?>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fpexamreg" role="tab" aria-controls="pills-rejected" aria-selected="false">Foreign Professional Review of Documents for Licensure Examination (<?php echo $fpexamreg_count; ?>)</a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#request" role="tab" aria-controls="pills-rejected" aria-selected="false">Request for Verification of Registration (<?php echo $total_receipient_information; ?>)</a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#goodstanding" role="tab" aria-controls="pills-rejected" aria-selected="false">Request for Certificate of Good Standing (<?php echo $total_reqforgoodstand; ?>)</a>
                    </li>
                <?php //} ?>
            </ul>
                    
            <div class="tab-content mt-1" id="myTabContent" style="background:#f5f0ea; padding: 20px;">

              <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                  
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
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
                                        <td><a href="<?php echo $value['details']; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                        <th>Online Application</th>
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
                                        // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->unidoc_id.'" id="revewier_accept'.$value->unidoc_id.'" onClick="acceptuniversityApplication(\''.$value->unidoc_id.'\')" class="btn btn-primary px-5">Accept</button>'; 
                                        $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';
                                        $viewDetailsLink =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id;    
                                        $documentfor = ($value->document_for=='n')?'School Accreditation':'Renewal of School Accreditation';
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value->university_name; ?></td>
                                            <td><?php echo $documentfor; ?></td>
                                            <td><?php echo $value->refrence_code; ?></td>
                                            <td><?php echo $value->email; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $reviewerName; ?></td>
                                            <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->grad_id.'" id="revewier_accept'.$value->grad_id.'" onClick="acceptgraduatesApplication(\''.$value->grad_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                   
                                    $viewDetailsLink =  base_url('admin/graduatedetails/').$value->grad_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->student_name.' '.$value->middle_name.' '.$value->surname; ?></td>
                                        <td><?php echo 'Submission of Graduates for Licensure Examination'; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
              </div>

             
              <div class="tab-pane fade" id="gexam" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($graduates_exam) {
                                    $i = 1;
                                    foreach($graduates_exam as $value){ 
                                    // if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                   
                                    $viewDetailsLink =  base_url('admin/graduatedetails/').$value->grad_id;  
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td>Booking for Online Licensure Examination (Graduates)</td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
             
              <div class="tab-pane fade" id="fprofessionalexam" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($fprofessional_exam) {
                                    $i = 1;
                                    foreach($fprofessional_exam as $value){ 
                                    // if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                
                                    $viewDetailsLink =  base_url('admin/profexamdetails/').$value->user_ID;  
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td>Booking for Online Licensure Examination (Foreign Professional)</td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                
                                    
                                    $type = 'Foreign Professional Review of Documents for Professioanl Registration';
                                    $viewDetailsLink =  base_url('admin/professionaldetails/').$value->user_ID.'/'.$value->doc_id;     
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                
                                    $type = 'Foreign Professional Review of Documents for Licensure Examination';
                                    $viewDetailsLink =  base_url('admin/profexamdetails/').$value->user_ID.'/'.$value->doc_id;  
                                     
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="professional_registration" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($professional_registration) {
                                    $i = 1;
                                    foreach($professional_registration as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                
                                   
                                    $type = 'Professional Registration';
                                    $viewDetailsLink =  base_url('admin/verify_certificate/').$value->user_ID.'/'.$value->doc_id;   
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fname.' '.$value->lname.' '.$value->name; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($professional_renewal) {
                                    $i = 1;
                                    foreach($professional_renewal as $value){ 
                                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->user_ID.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                
                                   
                                    $type = 'Renewal of Professional Registration';
                                    $viewDetailsLink =  base_url('admin/verify_certificate/').$value->user_ID.'/'.$value->doc_id;   
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fname.' '.$value->lname.' '.$value->name; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';   
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                    
                                    $viewDetailsLink =  base_url('admin/acc_details/').$value->doc_id; 
                                    if($value->document_for=='n'){
                                        $type = 'New';
                                        $accreditation_for = 'CEP Accreditation';
                                    }else{
                                        $type = 'Renewal';
                                        $accreditation_for = 'Renewal of CEP Accreditation';
                                    }  
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo $accreditation_for; ?></td>
                                        <td><?php echo $value->reference_no; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="cep_renewal" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                       
                                    $viewDetailsLink =  base_url('admin/acc_details/').$value->doc_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo 'CE Provider Renewal'; ?></td>
                                        <td><?php echo $value->reference_no; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                       
                                    $viewDetailsLink = base_url('admin/view_requestforverification/').$value->ri_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fname.' '.$value->lname.' '.$value->name; ?></td>
                                        <td><?php echo 'Request for Verification of Registration'; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
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
                                    // $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptcep(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                       
                                    $viewDetailsLink = base_url('admin/view_requestforgoodstand/').$value->gs_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->fname.' '.$value->lname.' '.$value->name; ?></td>
                                        <td><?php echo 'Request for Certificate of Good Standing'; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="course_acc" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Course Title</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
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
                                    // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptCourseAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';  
                                    $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'--';                     
                                    $viewDetailsLink =  base_url('admin/course_document_details/').$value->doc_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->title; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo 'Online Course Accreditation'; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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
                                    <th>Training Title</th>
                                    <th>Applicant Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
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
                                    // $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="acceptcep'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';
                                    $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'--';                       
                                    $viewDetailsLink =  base_url('admin/training_document_details/').$value->doc_id; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->title; ?></td>
                                        <td><?php echo $value->business_name; ?></td>
                                        <td><?php echo 'Training Course Accreditation'; ?></td>
                                        <td><?php echo $value->refrence_code; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><a href="<?php echo $viewDetailsLink; ?>" ><i class="fas fa-eye"></i></a></td>

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

            </div>
        </div>
    </main>
     <!-- Rboard modal -->

<script>
     $(document).ready(function() {
        $('.reviewerDT').DataTable();
    } );

</script>