<div id="layoutSidenav_content">
    <main>
        <?php  //print_r($school[0]);exit;
        
        $user_type = $this->session->userdata('login')['user_type'];
            $allcommonArr = array();
            if(!empty($school)&& $user_type=='sub-admin'){ 
            foreach($school as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/unversitydetails/').$value->unidoc_id;$documentfor = ($value->document_for=='n')?'School Accreditaion':'Renewal of School Accreditaion';                       
                $photo = ($value->college_logo !="" && file_exists('./assets/images/university/'.$value->college_logo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/'.$value->college_logo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/').'" width="200px" height="200px">';
                if($value->reviewer_status=='1'){
                    $viewcertificatelink = '<a class="viewcertificate" href="javascript:void(0);" data-id="'.$value->unidoc_id.'" data-name="'.$value->accreditation_number.'"><i class="fas fa-id-card"></i></a>';
                }else{
                    $viewcertificatelink = '';
                }
                $allcommonArr[] = array(
                    'user_id'   =>  $value->uniid,
                    'photo'     =>  $photo,
                    'email'     =>  $value->email,
                    'name'      =>  $value->university_name,
                    'accreditation_number' =>  $value->accreditation_number,
                    'expiry_at'      =>  $value->expiry_at,
                    'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                    'accreditation_for'  =>  $documentfor,
                    'type'      =>  'New',
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'rstatus'           => $value->reviewer_status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'viewcertificatelink'   => $viewcertificatelink,
                );
            } }
            //print_r($graduates[0]);exit;
            if(!empty($graduates)&& $user_type=='sub-admin'){ 
            foreach($graduates as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/graduatedetails/').$value->grad_id; 
                
                if($value->validity!='0000-00-00' && $value->validity!=''){
                    $expiry_at = $value->validity;
                }else{
                    $expiry_at ='N/A';
                }
                $photo = ($value->photo !="" && file_exists('./assets/images/graduates/'.$value->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/'.$value->photo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/default-logo.png').'" width="200px" height="200px">';
                if($value->reviewer_status=='1'){
                    $viewcertificatelink = '<a class="viewcertificategra" href="javascript:void(0);" data-id="'.$value->grad_id.'"><i class="fas fa-id-card"></i></a>';
                }else{
                    $viewcertificatelink = '';
                }
                $allcommonArr[] = array(
                    'user_id'  =>  $value->grad_id,
                    'photo'     =>  $photo,
                    'email'    =>  $value->email,
                    'name'  =>  $value->student_name.' '.$value->middle_name.' '.$value->surname,
					'accreditation_number' =>  $value->examcode,
                    'expiry_at'      => $expiry_at,
                    'review_accept_date'      =>  date("Y-m-d", strtotime($value->reviewer_accept_date)),
                    'accreditation_for'  =>  'Submission of Graduates for Licensure Examination',
                    'type'  =>  'New',
                    'refrence_code' => $value->refrence_code,
                    'amount' => 'N/A',
                    'txn_id' => 'N/A',
                    'reviewer_status' => $status,
                    'rstatus'           => $value->reviewer_status,
                    'reviewer_action' => $reviewerName,
                    'details' => $viewDetailsLink,
					'viewcertificatelink' => '',
                );
            } }
        //print_r($cep);exit;
            if(!empty($cep) && $user_type=='sub-admin'){
            foreach($cep as $value){
                if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'--';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/cep_details/').$value->doc_id;     
                if($value->document_for=='n'){
                    $type = 'New';
                    $accreditation_for = 'CE Provider Accreditation';
                }else{
                    $type = 'Renewal';
                    $accreditation_for = 'CE Provider Accreditation (Renewal)';
                }
                $photo = ($value->logo !="" && file_exists('./assets/images/ce_provider/'.$value->logo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/'.$value->logo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/default-logo.png').'" width="200px" height="200px">';                   
                if($value->rev_status=='1'){
                    $viewcertificatelink = '<a class="viewcertificate" href="javascript:void(0);" data-id="'.$value->id.'" data-name="'.$value->reference_no.'"><i class="fas fa-id-card"></i></a>';
                }else{
                    //'<a href="javascript:void(0);" data-id="'.$value->accreditation_no.'" class="viewcertificatecep"><i class="fas fa-id-card"></i></a>',
                    $viewcertificatelink = '';
                }
                $allcommonArr[] = array(
                    'user_id'   =>  $value->provider_id,
                    'photo'     =>  $photo,
                    'email'     =>  $value->email,
                    'name'      =>  $value->business_name,
					'accreditation_number' =>  $value->accreditation_no,
                    'expiry_at'      =>  $value->expiry_at,
                    'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                    'accreditation_for'  =>  $accreditation_for,
                    'type'      =>  $type,
                    'refrence_code' => $value->reference_no,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'rstatus'           => $value->reviewer_status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'viewcertificatelink' => $viewcertificatelink,
                );

            } }

            //print_r($fp[0]);exit;
            if(!empty($fp)&& $user_type=='sub-admin'){
            foreach($fp as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                  
                if($value->role=='P'){
                    $type = 'Foreign Professional Review of Documents for Licensure Examination';
                    $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;  
                }

                if($value->role=='F'){
                    $type = 'Foreign Professional Review of Documents for Professioanl Registration';
                    $viewDetailsLink =  base_url('reviewer/reviewer/verify_document/').$value->user_ID.'/'.$value->doc_id;  
                } 

                if($value->lic_issue_date!='0000-00-00 00:00:00'){
                    $issue_at = date('M d,Y',strtotime($value->lic_issue_date));
                }else{
                    $issue_at =date('M d,Y',strtotime($value->license_issued_date));
                }

                if($value->expiry_at!='0000-00-00' && $value->expiry_at!=''){
                    $expiry_at = date('M d,Y',strtotime($value->expiry_at));
                }else{
                    $expiry_at =date('M d,Y',strtotime($value->licvaldate));
                }

                $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.png').'" width="200px" height="200px">';
                if($value->reviewer_status=='1'){
                    $viewcertificatelink = '<a class="viewcertificatefp" href="javascript:void(0);" data-id="'.$value->user_ID.'"><i class="fas fa-id-card"></i></a>';
                }else{
                    $viewcertificatelink = '';
                }
                $allcommonArr[] = array(
                    'user_id'   =>  $value->user_ID,
                    'photo'     =>  $photo,
                    'email'     =>  $value->email,
                    'name'      =>  $value->fullname,
					'accreditation_number' => isset($value->registration_no)?$value->registration_no:'',
                    'expiry_at'      =>  $expiry_at,
                    'review_accept_date'      => $issue_at,
                    'accreditation_for'  => $type,
                    'type'      =>  'new',
                    'refrence_code' => isset($value->refrence_code)?$value->refrence_code:'',
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'rstatus'           => $value->reviewer_status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'viewcertificatelink' => $viewcertificatelink,
                    
                );
            } }
            //print_r($fpexamreg[0]);exit;
            if(!empty($fpexamreg)&& $user_type=='sub-admin'){
            foreach($fpexamreg as $value){
                if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
                $viewDetailsLink =  base_url('reviewer/reviewer/profexam_verify_document/').$value->user_ID.'/'.$value->doc_id;                      
                
                if($value->expiry_at!='0000-00-00' && $value->expiry_at!=''){
                    $expiry_at = $value->expiry_at;
                }else{
                    $expiry_at = 'N/A';
                }
                $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.png').'" width="200px" height="200px">';
                if($value->reviewer_status=='1'){
                    $viewcertificatelink = '<a class="viewcertificatefp" href="javascript:void(0);" data-id="'.$value->user_id.'"><i class="fas fa-id-card"></i></a>';
                }else{
                    $viewcertificatelink = '';
                }
                $allcommonArr[] = array(
                    'user_id'   =>  $value->user_ID,
                    'photo'     =>  $photo,
                    'email'     =>  $value->email,
                    'name'      =>  $value->fullname,
					'accreditation_number' =>  isset($value->exam_code)?$value->exam_code:'',
                    'expiry_at'      =>  $expiry_at,
                    'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                    'accreditation_for'  =>  'Foreign Professional Review of Documents for Licensure Examination',
                    'type'      =>  'new',
                    'refrence_code' => $value->refrence_code,
                    'amount'    => $value->amount,
                    'txn_id'    => $value->txn_id,
                    'reviewer_status' => $status,
                    'rstatus'           => $value->reviewer_status,
                    'reviewer_action' => $reviewerName,
                    'details'   => $viewDetailsLink,
                    'viewcertificatelink' => $viewcertificatelink,
                    
                );
            } }
            //print_r($professional_renewal[0]);exit;
            if(!empty($professional_renewal) && $user_type=='sub-admin'){
                foreach($professional_renewal as $value){
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->user_ID.'" id="revewier_accept'.$value->user_ID.'" onClick="acceptprofessionalApplication(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';             

                        $type = 'Professional License Renewal';
                        $viewDetailsLink =  base_url('reviewer/reviewer/verify_certificate/').$value->user_ID.'/'.$value->doc_id;  
                        $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.png').'" width="200px" height="200px">';
                        if($value->reviewer_status=='1'){
                            $viewcertificatelink = '<a class="viewcard" href="javascript:void(0);" data-id="'.$value->refrence_code.'"><i class="fas fa-id-card"></i></a>';
                        }else{
                            $viewcertificatelink = '';
                        }
                    $allcommonArr[] = array( 
                        'user_id'           =>  $value->user_ID,
                        'photo'             =>  $photo,
                        'email'             =>  $value->email,
                        'added_on'          =>  $value->added_on,
                        'name'              =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_number' =>  isset($value->license_no)?$value->license_no:$value->refrence_code,
                        'expiry_at'         =>  $value->expiry_at,
                        'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                        'accreditation_for' =>  $type,
                        'type'              =>  'renew',
                        'refrence_code'     => $value->refrence_code,
                        'amount'            => $value->amount,
                        'txn_id'            => $value->txn_id,
                        'reviewer_status'   => $status,
                        'rstatus'           => $value->reviewer_status,
                        'reviewer_action'   => $reviewerName,
                        'details'           => $viewDetailsLink,
                        'viewcertificatelink' => $viewcertificatelink,
                    );
                } }
            if(!empty($receipient_information) && $user_type=='sub-admin'){
                //echo'<pre>';    print_r($receipient_information); die;
                foreach($receipient_information as $value){
                    $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.png').'" width="200px" height="200px">';
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'--';
                    $viewDetailsLink =  base_url('reviewer/reviewer/view_requestforverification/').$value->ri_id;
                    $allcommonArr[] = array( 
                        'user_id'           =>  $value->user_id,
                        'photo'             =>  $photo,
                        'email'             =>  $value->email,
                        'added_on'          =>  $value->added_on,
                        'name'              =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_number' => '--',
                        'expiry_at'         =>  '',
                        'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_date)),
                        'accreditation_for' =>  'Request for Verification of Registration',
                        'type'              =>  'renew',
                        'refrence_code'     => $value->refrence_code,
                        'amount'            => $value->amount,
                        'txn_id'            => $value->txn_id,
                        'reviewer_status'   => $status,
                        'rstatus'           => $value->reviewer_status,
                        'reviewer_action'   => $reviewerName,
                        'details'           => $viewDetailsLink,
                        'viewcertificatelink' => '',
                    );
                }
            }
            if(!empty($reqforgoodstand) && $user_type=='sub-admin'){
                //echo'<pre>';    print_r($reqforgoodstand); die;
                foreach($reqforgoodstand as $value){
                    $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.png').'" width="200px" height="200px">';
                    if($value->reviewer_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->reviewer_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname.' '.$value->rev_lastname:'--';
                    $viewDetailsLink =  base_url('reviewer/reviewer/view_requestforgoodstand/').$value->gs_id;
                    if($value->reviewer_status=='1'){
                        $viewcertificatelink = '<a class="goodstandingcert" href="javascript:void(0);" data-id="'.$value->refrence_code.'"><i class="fas fa-id-card"></i></a>';
                    }else{
                        $viewcertificatelink = '';
                    }
                    $allcommonArr[] = array( 
                        'user_id'           =>  $value->user_id,
                        'photo'             =>  $photo,
                        'email'             =>  $value->email,
                        'added_on'          =>  $value->added_on,
                        'name'              =>  $value->fname.' '.$value->lname.' '.$value->name,
                        'accreditation_number' => '--',
                        'expiry_at'         =>  '',
                        'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_date)),
                        'accreditation_for' =>  'Request for Certificate of Good Standing',
                        'type'              =>  'renew',
                        'refrence_code'     => $value->refrence_code,
                        'amount'            => $value->amount,
                        'txn_id'            => $value->txn_id,
                        'reviewer_status'   => $status,
                        'rstatus'           => $value->reviewer_status,
                        'reviewer_action'   => $reviewerName,
                        'details'           => $viewDetailsLink,
                        'viewcertificatelink' => $viewcertificatelink,
                    );
                }
            }

            if(!empty($course) && $user_type=='ct'){
                // echo'<pre>';    print_r($course[0]);
                        foreach($course as $value){
                            if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                            $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptCourseAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                     
                            $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->doc_id;                      
                            $photo = ($value->course_image !="" && file_exists('./assets/images/ce_provider/'.$value->course_image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/'.$value->course_image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/default-logo.jpg').'" width="200px" height="200px">';
                            $allcommonArr[] = array(
                                'user_id'   =>  $value->provider_id,
                                'photo'     =>  $photo,
                                'email'     =>  $value->email,
                                'name'      =>  $value->business_name.' ( '.$value->title.' ) ',
                                'accreditation_number' =>  $value->accreditation_no,
                                'expiry_at'      =>  $value->expiry_at,
                                'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                                'accreditation_for'  =>  'Online Course Accreditation',
                                'type'  =>  'New',
                                'refrence_code' => $value->refrence_code,
                                'amount'    => $value->amount,
                                'txn_id'    => $value->txn_id,
                                'reviewer_status' => $status,
                                'rstatus' => $value->rev_status,
                                'reviewer_action' => $reviewerName,
                                'details'   => $viewDetailsLink,
                                'viewcertificatelink' => '',
                            );
                        } }
            
                        if(!empty($training) && $user_type=='ct'){
                        foreach($training as $value){
                            if($value->rev_status=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value->rev_status=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                            $reviewerName = ($value->rev_id > 0)?$value->rev_firsname:'<button type="button" data-id="'.$value->provider_id.'" id="revewier_accept'.$value->provider_id.'" onClick="acceptTrainingAccr(\''.$value->doc_id.'\')" class="btn btn-primary px-5">Accept</button>';                
                            $viewDetailsLink =  base_url('reviewer/reviewer/reviewer_viewcourse/').$value->provider_id.'/'.$value->doc_id;                       
                            $photo=($value->training_image !="" && file_exists('./assets/images/ce_provider/'.$value->training_image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/'.$value->training_image).'" width="250px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/default-logo.jpg').'" width="250px" height="200px">';
                            $allcommonArr[] = array(
                                'user_id'   =>  $value->provider_id,
                                'photo'     =>  $photo,
                                'email'     =>  $value->email,
                                'name'      =>  $value->business_name.' ( '.$value->title.' ) ',
                                'accreditation_number' =>  $value->accreditation_no,
                                'expiry_at'      =>  $value->expiry_at,
                                'review_accept_date'      =>  date("Y-m-d", strtotime($value->review_accept_date)),
                                'accreditation_for'  =>  'Training Course Accreditation',
                                'type'  =>  'New',
                                'refrence_code' => $value->refrence_code,
                                'amount'    => $value->amount,
                                'txn_id'    => $value->txn_id,
                                'reviewer_status' => $status,
                                'rstatus' => $value->rev_status,
                                'reviewer_action' => $reviewerName,
                                'details'   => $viewDetailsLink,
                                'viewcertificatelink' => '',
                            );
                        } }
                        

            if($user_type == 'sub-admin'){
                $allCount = $school_count + $graduates_count + $fp_count + $cep_count+$professional_renewal_count+$fpexamreg_count + $total_receipient_information + $total_reqforgoodstand;   
            }else{
                $allCount = $course_count + $training_count;   
            }

            // $statusArr = array_column($allcommonArr,'rstatus');
            // $approved = array_sum($statusArr);
            // $rejected = array_sum($statusArr);

        ?>

        <div class="container-fluid">
            <h4 class="mt-4 mb-3">Reviewed Application (<?=$allCount;?>)</h4>
            
            <div class="row">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All </a>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-all" aria-selected="true">Approved </a>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-rejected" role="tab" aria-controls="pills-all" aria-selected="true">Rejected </a>
                  </li>
                    
                </ul>  
                   <!--<?php if($user_type == 'sub-admin'){ ?>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#schoolaccreditation" role="tab" aria-controls="pills-pending" aria-selected="false">School Accreditation (<?php echo $school_count;?>)</a>
                  </li>

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#cep" role="tab" aria-controls="pills-rejected" aria-selected="false">CEP Accreditation (<?=$cep_count;?>)</a>
                  </li>
                  
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fpexam" role="tab" aria-controls="pills-rejected" aria-selected="false">Booking for Online Licensure Examination ()</a>
                  </li>

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#graduates" role="tab" aria-controls="pills-rejected" aria-selected="false">Submission of Graduates for Licensure Examination (<?php echo $graduates_count;?>)</a>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#fprofessional" role="tab" aria-controls="pills-rejected" aria-selected="false">Foreign Professional Review of Documents for Professioanl Registration (<?php echo $fp_count; ?>)</a>
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
                </ul> -->
                </div>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                  
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Photo</th>
                                    <th>Application Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
									<th>Accreditation Number/ Exam Code/ Reg. Code/ License Number</th>
									<th>Date Issued</th>
									<th>Validity Date</th>
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
                                        <td class="dp-image"><?php echo $value['photo']; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['accreditation_for']; ?></td>
                                        <td><?php echo $value['refrence_code']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['accreditation_number']; ?></td>
                                        <td><?php echo date('M d, Y',strtotime($value['review_accept_date'])); ?></td>
										<td><?php echo ($value['expiry_at'] != '')?date('M d, Y',strtotime($value['expiry_at'])):'--'; ?></td>
                                        <td><?php echo $value['reviewer_status']; ?></td>
                                        <td><?php echo $value['reviewer_action']; ?></td>
										<td><a href="<?php echo $value['details']; ?>"><i class="fas fa-eye"></i></a>
                                        <?php echo $value['viewcertificatelink']; ?></td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>

                        </table>
                    </div>
                  </div> 
              </div>
            
              
              <div class="tab-pane fade" id="pills-approved" role="tabpanel" aria-labelledby="pills-all-tab">
                  
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Photo</th>
                                    <th>Application Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
									<th>Accreditation Number/ Exam Code/ Reg. Code/ License Number</th>
									<th>Date Issued</th>
									<th>Validity Date</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
									<th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php  if($allcommonArr) { 
                                    $i = 1;
                                    foreach($allcommonArr as $key => $value){ 
                                        if($value['rstatus']=='1'){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class="dp-image"><?php echo $value['photo']; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['accreditation_for']; ?></td>
                                        <td><?php echo $value['refrence_code']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['accreditation_number']; ?></td>
                                        <td><?php echo $value['review_accept_date']; ?></td>
										<td><?php echo $value['expiry_at']; ?></td>
                                        <td><?php echo $value['reviewer_status']; ?></td>
                                        <td><?php echo $value['reviewer_action']; ?></td>
										<td><a href="<?php echo $value['details']; ?>"><i class="fas fa-eye"></i></a>
                                        <?php echo $value['viewcertificatelink']; ?></td>

                                    </tr>
                                    <?php $i++; } } } ?>
                            </tbody>

                        </table>
                    </div>
                  </div> 
              </div>

              <div class="tab-pane fade" id="pills-rejected" role="tabpanel" aria-labelledby="pills-all-tab">
                  
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Photo</th>
                                    <th>Application Name</th>
                                    <th>Online Application</th>
                                    <th>Refrence Number</th>
                                    <th>Email</th>
									<th>Accreditation Number/ Exam Code/ Reg. Code/ License Number</th>
									<th>Date Issued</th>
									<th>Validity Date</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
									<th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php  if($allcommonArr) { 
                                    $i = 1;
                                    foreach($allcommonArr as $key => $value){ 
                                        if($value['rstatus']=='2'){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class="dp-image"><?php echo $value['photo']; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['accreditation_for']; ?></td>
                                        <td><?php echo $value['refrence_code']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['accreditation_number']; ?></td>
                                        <td><?php echo $value['review_accept_date']; ?></td>
										<td><?php echo $value['expiry_at']; ?></td>
                                        <td><?php echo $value['reviewer_status']; ?></td>
                                        <td><?php echo $value['reviewer_action']; ?></td>
										<td><a href="<?php echo $value['details']; ?>"><i class="fas fa-eye"></i></a>
                                        <?php echo $value['viewcertificatelink']; ?></td>

                                    </tr>
                                    <?php $i++; }  } } ?>
                            </tbody>

                        </table>
                    </div>
                  </div> 
              </div>

                    
              <div class="tab-pane fade" id="schoolaccreditation" role="tabpanel" aria-labelledby="pills-approved-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
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
									$reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--'; 
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
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
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
									$reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
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
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
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
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
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
                        <table class="table table-bordered reviewerDT"  width="100%" cellspacing="0">
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
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';                     
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

<!--               <div class="tab-pane fade" id="cep_renewal" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered reviewerDT" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Applicant Name</th>
                                    <th>Accreditation for</th>
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
        </div>
    </main>

<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	    <div class="modal-body text-center">
		    <div id="crtdetials"></div>
        </div>
      <!-- end body -->
    </div>
  </div>
</div>	
<script>    
    $(document).ready(function() {
        $('.reviewerDT').DataTable();
    } );

$(".viewcertificate").click(function() {
	var docid = $(this).data("id");
	var accr = $(this).data("name");
	if(docid > 0){
		var url = '<?php echo base_url("assets/uploads/pdf/"); ?>'+accr+'.pdf';
        // alert(url);
        var result = '<iframe src="'+url+'" width="100%" height="750" style="border:1px solid black;"></iframe>';
		$('#crtdetials').html(result); 
		$('.certificate-modal').modal('show'); 
	}
  
});
$( ".viewcertificatefp" ).click(function() {
    var docid = $(this).data("id");
    if(docid > 0){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/profcertificateforreviewer",
            data: { docid : docid},
            success: function(data) {
                //alert(data);
                $('#crtdetials').html(data); 
            }
        });
        $('.certificate-modal').modal('show'); 
    }
  
});
$( ".viewcertificategra" ).click(function() {
    var docid = $(this).data("id");
    if(docid > 0){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>reviewer/grad_elig_cert_forreviewer",
            data: { docid : docid},
            success: function(data) {
                //alert(data);
                $('#crtdetials').html(data); 
            }
        });
        $('.certificate-modal').modal('show'); 
    }
});


$( ".viewcard" ).click(function() {
    var regcode = $(this).attr("data-id");
    // var type = $(this).data("name");
    if(regcode){
        var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ regcode +"card.pdf";
        // $('#crtdetials').attr('src',path); 
        $('#crtdetials').html('<iframe src="'+ path +'" id="crtdetials" frameborder="0" width="720" height="850"></iframe>'); 

        $('.certificate-modal').modal('show'); 
    }else{
        alert('No registration number found!');
    }
});

$( ".goodstandingcert" ).click(function() {
    var refcode = $(this).attr("data-id");
    // var type = $(this).data("name");
    if(refcode){
        var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ refcode +".pdf";
        // $('#crtdetials').attr('src',path); 
        $('#crtdetials').html('<iframe src="'+ path +'" id="crtdetials" frameborder="0" width="720" height="850"></iframe>'); 

        $('.certificate-modal').modal('show'); 
    }else{
        alert('No registration number found!');
    }
});
</script>