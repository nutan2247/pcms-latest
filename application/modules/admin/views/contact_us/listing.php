<div id="layoutSidenav_content">
<?php
	$inbox_all_count = $read_all_count=0;
	$inquiry_count = $read_inquiry_count=0;
	$testimonial_count = $read_testimonial_count=0;
	$complaint_count = $read_complaint_count=0;
	$refund_count = $read_refund_count=0;
	$suggestion_count = $read_suggestion_count=0;
	$verification_count = $read_verification_count=0;
	foreach($contact_listing as $key => $cntlist){
        if($cntlist['status'] == '0'){
		    $inbox_all_count++;
        }	
		if($cntlist['subject'] == 'Inquiry' && $cntlist['status']=='0'){
			$inquiry_count++;
		}
		if($cntlist['subject'] == 'Testimonial' && $cntlist['status']=='0'){
			$testimonial_count++; 
		}
		if($cntlist['subject'] == 'Complaint' && $cntlist['status']=='0'){
			$complaint_count++;	
		}
		if($cntlist['subject'] == 'Refund' && $cntlist['status']=='0'){
			$refund_count++;
		}
		if($cntlist['subject'] == 'Suggestion' && $cntlist['status']=='0'){
			$suggestion_count++;
		}
		if($cntlist['subject'] == 'Verification' && $cntlist['status']=='0'){
			$verification_count++;
		}
        if($cntlist['status'] == '1'){
		    $read_all_count++;
        }	
		if($cntlist['subject'] == 'Inquiry' && $cntlist['status']=='1'){
			$read_inquiry_count++;
		}
		if($cntlist['subject'] == 'Testimonial' && $cntlist['status']=='1'){
			$read_testimonial_count++; 
		}
		if($cntlist['subject'] == 'Complaint' && $cntlist['status']=='1'){
			$read_complaint_count++;	
		}
		if($cntlist['subject'] == 'Refund' && $cntlist['status']=='1'){
			$read_refund_count++;
		}
		if($cntlist['subject'] == 'Suggestion' && $cntlist['status']=='1'){
			$read_suggestion_count++;
		}
		if($cntlist['subject'] == 'Verification' && $cntlist['status']=='1'){
			$read_verification_count++;
		}	
	}
?>
<main>
    <div class="container-fluid">
        <h4 class="mt-4 mb-3"><?php echo $page_title; ?>
            <button type="button" class="btn btn-success float-right composebtn" id="composebtn">Compose</button>
        </h4>
        <div class="row">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-inbox" role="tab" aria-controls="pills-all" aria-selected="true">INBOX(<?=$inbox_all_count?>) </a>
                </li>
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessage" role="tab" aria-controls="pills-all" aria-selected="true">READ MESSAGES(<?=$read_all_count?>) </a>
                </li>
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessages" role="tab" aria-controls="pills-all" aria-selected="true">SENT MESSAGES() </a>
                </li>
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-presetmessages" role="tab" aria-controls="pills-all" aria-selected="true">PRESET MESSAGES() </a>
                </li>
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-notifications" role="tab" aria-controls="pills-all" aria-selected="true">NOTIFICATIONS() </a>
                </li>
                
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-inbox" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <!--<span>
                            <i class="fas fa-table mr-1"></i>
                                <?php echo $table_name; ?>
                        </span>-->
						
                        <div class="row">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">ALL (<?php echo $inbox_all_count;?>)</a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-enquiry" role="tab" aria-controls="pills-all" aria-selected="true">INQUIRY(<?php echo $inquiry_count;?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-testimonial" role="tab" aria-controls="pills-all" aria-selected="true">TESTIMONIAL(<?php echo $testimonial_count;?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-complaint" role="tab" aria-controls="pills-all" aria-selected="true">COMPLAINT(<?php echo $complaint_count;?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-refund" role="tab" aria-controls="pills-all" aria-selected="true">REFUND(<?php echo $refund_count;?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-suggestion" role="tab" aria-controls="pills-all" aria-selected="true">SUGGESTION(<?php echo $suggestion_count;?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-verification" role="tab" aria-controls="pills-all" aria-selected="true">VERIFICATION(<?php echo $verification_count;?>) </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //print_r($contact_listing);exit;
                                    if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
                                        if($list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                        <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                        <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                            <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                        </td>
                                    </tr>
                                    <?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-all-->
                    <div class="tab-pane fade" id="pills-enquiry" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Inquiry' && $list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-enquiry-->
                    <div class="tab-pane fade" id="pills-testimonial" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Testimonial' && $list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-testimonial-->
                    <div class="tab-pane fade" id="pills-complaint" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Complaint' && $list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                        
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td>
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-complaint-->
                    <div class="tab-pane fade" id="pills-refund" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Refund' && $list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                         
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>  
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-refund-->
                    <div class="tab-pane fade" id="pills-suggestion" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Suggestion' && $list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>  
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-suggestion-->
                    <div class="tab-pane fade" id="pills-verification" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Verification' && $list['status'] == '0'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                        
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-verification-->
                    </div><!--tab-content for INBOX-->
                </div>
            </div> <!--end inbox -->
            <div class="tab-pane fade" id="pills-readmessage" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <!--<span>
                            <i class="fas fa-table mr-1"></i>
                                <?php echo $table_name; ?>
                        </span>-->
                        <div class="row">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-readmessageall" role="tab" aria-controls="pills-all" aria-selected="true">ALL(<?=$read_all_count?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessageenquiry" role="tab" aria-controls="pills-all" aria-selected="true">INQUIRY(<?=$read_inquiry_count?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessagetestimonial" role="tab" aria-controls="pills-all" aria-selected="true">TESTIMONIAL(<?=$read_testimonial_count?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessagecomplaint" role="tab" aria-controls="pills-all" aria-selected="true">COMPLAINT(<?=$read_complaint_count?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessagerefund" role="tab" aria-controls="pills-all" aria-selected="true">REFUND(<?=$read_refund_count?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessagesuggestion" role="tab" aria-controls="pills-all" aria-selected="true">SUGGESTION(<?=$read_suggestion_count?>) </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-readmessageverification" role="tab" aria-controls="pills-all" aria-selected="true">VERIFICATION(<?=$read_verification_count?>) </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-readmessageall" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //print_r($contact_listing);exit;
                                    if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
                                        if($list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                        <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                        <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                            <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                        </td>
                                    </tr>
                                    <?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>   
                                
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-all-->
                    <div class="tab-pane fade" id="pills-readmessageenquiry" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Inquiry' && $list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                        
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-enquiry-->
                    <div class="tab-pane fade" id="pills-readmessagetestimonial" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Testimonial' && $list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                        
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>       
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-testimonial-->
                    <div class="tab-pane fade" id="pills-readmessagecomplaint" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Complaint' && $list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td>
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>     
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-complaint-->
                    <div class="tab-pane fade" id="pills-readmessagerefund" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Refund' && $list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                      
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>      
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-refund-->
                    <div class="tab-pane fade" id="pills-readmessagesuggestion" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Suggestion' && $list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                       
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>       
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-suggestion-->
                    <div class="tab-pane fade" id="pills-readmessageverification" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tel. Number</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Message</th>
                                        <th>Ip Address</th>
                                        <th>Inquiry At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
											if($list['subject'] == 'Verification' && $list['status'] == '1'){
                                    ?>
                                    <tr>
                                        <td><?=$count;?>.</td>
										 <td><?=$list['subject'];?></td>
                                        <td><?=$list['name'];?></td>
                                        <td><?=$list['email'];?></td>
                                        <td><?=$list['telnumber'];?></td>
                                        <td><?=$list['address'];?></td>
                                        <td><?=isset($list['country_name'])?$list['country_name']:$list['country'];?></td>                                        
                                        <td><?=$list['message'];?></td>
                                        <td><?=$list['ipAddress'];?></td>
                                       <td><?=date('M d,Y',strtotime($list['query_at']))?></td>
                                       <td><a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" data-name="<?=$list['name'] ?>" data-subject="<?=$list['subject'] ?>" data-email="<?=$list['email'] ?>" class="replybtn">Reply/</a>
                                       <a href="javascript:void(0);" data-id="<?=$list['cont_id'] ?>" class="viewdetails">View</a>
                                       </td> 
                                    </tr>
										<?php $count++; } } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                </tbody>        
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-verification-->
                    </div><!--tab-content for read messages-->
                </div>
            </div> <!--end read messages -->
            <div class="tab-pane fade" id="pills-sentmessages" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <!--<span>
                            <i class="fas fa-table mr-1"></i>
                                <?php echo $table_name; ?>
                        </span>-->
                        <div class="row">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessageall" role="tab" aria-controls="pills-all" aria-selected="true">ALL </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessageenquiry" role="tab" aria-controls="pills-all" aria-selected="true">INQUIRY() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessagetestimonial" role="tab" aria-controls="pills-all" aria-selected="true">TESTIMONIAL() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessagecomplaint" role="tab" aria-controls="pills-all" aria-selected="true">COMPLAINT() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessagerefund" role="tab" aria-controls="pills-all" aria-selected="true">REFUND() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessagesuggestion" role="tab" aria-controls="pills-all" aria-selected="true">SUGGESTION() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-sentmessageverification" role="tab" aria-controls="pills-all" aria-selected="true">VERIFICATION() </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-sentmessageall" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody><!--
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
                                    ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td class="dp-image"><img src="<?php echo base_url('assets/images/document/'.$list['document'])?>"></td>
                                        <td><?=$list['reg_board'];?></td>
                                        <td><?=$list['user_name'];?></td>
                                        <td><?=$list['user_email'];?></td>
                                        <td><?=$list['subject'];?></td>
                                        <td><?=$list['phone'];?></td>
                                        <td><?=($list['status']==1)?"Active":"Inactive"; ?></td>
                                       <td><?=date('M d,Y',strtotime($list['added_on']))?></td> 
                                    </tr>
                                    <?php $count++; } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                --></tbody>
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-all-->
                    <div class="tab-pane fade" id="pills-sentmessageenquiry" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-enquiry-->
                    <div class="tab-pane fade" id="pills-sentmessagetestimonial" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-testimonial-->
                    <div class="tab-pane fade" id="pills-sentmessagecomplaint" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-complaint-->
                    <div class="tab-pane fade" id="pills-sentmessagerefund" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-refund-->
                    <div class="tab-pane fade" id="pills-sentmessagesuggestion" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-suggestion-->
                    <div class="tab-pane fade" id="pills-sentmessageverification" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Name of sender</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-verification-->
                    </div><!--tab-content for sent messages-->
                </div>
            </div> <!--end sent messages -->
            <div class="tab-pane fade" id="pills-presetmessages" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <!--<span>
                            <i class="fas fa-table mr-1"></i>
                                <?php echo $table_name; ?>
                        </span>-->
                        <div class="row">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-school" role="tab" aria-controls="pills-all" aria-selected="true">SCHOOL() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-graduates" role="tab" aria-controls="pills-all" aria-selected="true">GRADUATES() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-ceproviders" role="tab" aria-controls="pills-all" aria-selected="true">CE PROVIDERS() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-presentlyregpro" role="tab" aria-controls="pills-all" aria-selected="true">PRESENTLY REGISTERED PROFESSIONALS() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-regispro" role="tab" aria-controls="pills-all" aria-selected="true">REGISTERED PROFESSIONALAS() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-forproregis" role="tab" aria-controls="pills-all" aria-selected="true">FOREIGN PROFESSIONALS FOR REGISTRATION() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-forproexam" role="tab" aria-controls="pills-all" aria-selected="true">FOREIGN PROFESSIONALS FOR EXAM() </a>
                                </li>
                                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-prbpersonnel" role="tab" aria-controls="pills-all" aria-selected="true">PRB PERSONNEL() </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-school" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody><!--
                                    <?php if($contact_listing){
                                        $count = 1; 
                                        foreach($contact_listing as $key => $list){
                                    ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td class="dp-image"><img src="<?php echo base_url('assets/images/document/'.$list['document'])?>"></td>
                                        <td><?=$list['reg_board'];?></td>
                                        <td><?=$list['user_name'];?></td>
                                        <td><?=$list['user_email'];?></td>
                                        <td><?=$list['subject'];?></td>
                                        <td><?=$list['phone'];?></td>
                                        <td><?=($list['status']==1)?"Active":"Inactive"; ?></td>
                                       <td><?=date('M d,Y',strtotime($list['added_on']))?></td> 
                                    </tr>
                                    <?php $count++; } }else{ echo'<tr><td colspan="8">No Data Found!<td></tr>'; }?>
                                -->
                                    <tr>
                                        <td>1</td>
                                        <td>Application for Accreditation</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Notice of accreditation and school Account</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Notice of disapproval of Accreditation</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Notice of Renewal of Accreditation</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Notice of Disapproval of Renewal of Accreditation</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Submission of Graduates for Licensure Examination</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Notice of Approval and Exam Code to graduates</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    </div><!--end school-all-->
                    <div class="tab-pane fade" id="pills-graduates" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td>1</td>
                                        <td>Booking for Licensure Examination with exam code & pass</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Notice of Examination Result(pass) with registration code</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Notice of Examination Result(fail) with link to rebook examin</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Notice of Professional Registration with the license number</td>
                                        <td><a href="#">View/</a><a href="#">Edit</a></td>
                                    </tr>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-graduates-->
                    <div class="tab-pane fade" id="pills-ceproviders" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Application for Accreditation</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Notice of Approval of accreditation with accreditation No. & account</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Notice of Disapproval of accreditation & Link to re-apply</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Notice of Approval of Renewal of Accreditation</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Notice of Disapproval of Renewal of Accreditation</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Notice of Approval of Accreditation of Online Course</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Notice of Disapproval of Accreditation of Online Course</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Notice of Approval of Accreditation of Traning Course</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Notice of Disapproval of Accreditation of Traning Course</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-ceproviders-->
                    <div class="tab-pane fade" id="pills-presentlyregpro" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Notice of eligibility to apply for Professional Registration</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Notice of Professional Registration</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Notice of Approval of Renewal of License</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-presentlyregpro-->
                    <div class="tab-pane fade" id="pills-regispro" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-regispro-->
                    <div class="tab-pane fade" id="pills-forproregis" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Application for Foreign Professional Review of Document for Registration</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Notice of Approval for Registration with Reg.Code</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Application for Renewal of Profesional License</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Notice of Approval of Renewal of License</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-forproregis-->
                    <div class="tab-pane fade" id="pills-forproexam" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Application for Foreign Professional Review of Document for Examination</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Notice of Approval for Examination with Exam Code</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Booking for Licensure examination with Exam pass</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Notice of Examination result(pass) with registration code</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Notice of Examination result(fail) with link to rebook examin</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Notice of Professional Registration with the license number</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-forproexam-->
                    <div class="tab-pane fade" id="pills-prbpersonnel" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                        <?php //echo $this->session->flashdata('item');?>
                        <div class="table-responsive">
                            <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Notice of Appointment</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Notice of Termination of appointment</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Notice of extension of appointment</td>
                                    <td><a href="#">View/</a><a href="#">Edit</a></td>
                                </tr>
                                </tbody>    
                            </table>
                        </div>
                    </div> 
                    </div><!--end pills-prbpersonnel-->
                    </div><!--tab-content for preset messages-->
                </div>
            </div> <!--end preset messages -->
            <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span>
                            <i class="fas fa-table mr-1"></i>
                                <?php echo $table_name; ?>
                        </span>
                    </div>
                </div>
            </div><!--end notifications-->
        </div> <!-- end main tabs group-->

    </div>

</main>
<!--Reply -->
<div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Compose
        <!--<button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>-->
        <!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Body part -->
		<p id="dispmsges" style="color: white; font-size: 25px; text-align: center;background-color: green;"></p>
		<form action="" method="post" id="replyform" name="replyform" />
        <div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Subject*</label>
				<input type="text" name="csubject" id="csubject" class="form-control" placeholder="Please write your subject..." required>
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Recipient: Please select:*</label>
				<select name="recipient" id="recipient" class="form-control" required="">
					<option value="">Please Select</option>
					<option value="L">Professionals</option>
					<option value="F">Foreign Professionals for Registration</option>
					<option value="P">Foreign Professionals for Examination</option>
					<option value="GRA">Graduates</option>
                    <option value="SCH">Schools</option>
                    <option value="CEP">CE Providers</option>
                    <option value="others">Others (individual email)</option>
				</select>
			</div>
		</div>
        <div class="col-md-12" style="display:none" id="othermaildiv">
			<div class="input-wrapper">
				<label class="input-label">Email*</label>
				<input type="email" name="otheremail" id="otheremail" value="" class="form-control" placeholder="Please write your email address..." required="">
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Message*</label>
				<textarea name="message" id="message" class="form-control" placeholder="Please write your message..." required=""></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label"><br></label>
				<br><button type="button" class="btn btn-primary" id="sendmsgbtn">Send Message</button>
			</div>
		</div>
		</form>
        <!-- end Body part -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> 
      </div>-->
    </div>
  </div>
</div>
<!--Reply end -->
<!--Reply -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reply Message
        <!--<button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>-->
        <!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Body part -->
		<p id="dispreplymsges" style="color: white; font-size: 25px; text-align: center;background-color: green;"></p>
		<form action="" method="post" id="replyform" name="replyform" />
        <div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Name</label>
                <input type="hidden" name="cont_id" id="cont_id" value="">
				<input type="text" name="name" id="name" class="form-control" value="" readonly>
			</div>
		</div>
        <div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Subject</label>
				<input type="text" name="subject" id="subject" class="form-control" value="" readonly>
			</div>
		</div>
        <div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Email</label>
				<input type="text" name="replyemail" id="replyemail" class="form-control" value="" readonly>
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Message*</label>
				<textarea name="replymessage" id="replymessage" class="form-control" placeholder="Please write your message..." required=""></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label"><br></label>
				<br><button type="button" class="btn btn-primary" id="sendreplybtn">Send Message</button>
			</div>
		</div>
		</form>
        <!-- end Body part -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> 
      </div>-->
    </div>
  </div>
</div>
<!--Reply end -->
<!--View Modal -->
<div class="modal fade viewmessage-modal" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View Message
        <!--<button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>-->
        <!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="displaymessage">
        <!-- Body part -->
		
        <!-- end Body part -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!--view end -->
<div id="myModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="displaymessage__" style="padding:20px;">
             
        </div>
      <!-- end body -->
      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
        $('.adminDT').DataTable();
    } );

$(".composebtn").click(function(){
  $('#composeModal').modal('show');
});

$(".replybtn").click(function(){
    var schid = $(this).data("id");
    var name = $(this).data("name");
    var subject = $(this).data("subject");
    var email = $(this).data("email");
    //alert(email);
    $('#cont_id').val(schid);
    $('#name').val(name);
    $('#subject').val(subject);
    $('#replyemail').val(email);
  $('#replyModal').modal('show');
});

$("#sendreplybtn").click(function(){
    var cont_id = $('#cont_id').val();
    var name = $('#name').val();
    var subject = $('#subject').val();
    var email= $('#replyemail').val();
    var message = $('#replymessage').val();
	if(message == ''){
		alert('Please write your message');
		$('#replymessage').focus();
		return false;
	}
    $.ajax({
        type: "POST",
        url: '<?php echo base_url("admin/contacts/messagereply"); ?>',
        data: { 
            cont_id:cont_id,
            name:name,
            subject:subject,
            email:email,
            message:message
        },
        success: function(result) {
            $('#dispreplymsges').html(result);
            //$('#pursosefor').val('');
            //$('#email').val('');
			$('#replymessage').val('');
			
        }
    });
});

$("#recipient").click(function(){
    var recipient = $('#recipient').val();
    if(recipient == 'others'){
        $("#othermaildiv").show(); 
    }else{
        $("#othermaildiv").hide();
    }
});
$("#sendmsgbtn").click(function(){
	var csubject = $('#csubject').val();
    var recipient = $('#recipient').val();
    var otheremail = $('#otheremail').val();
    var message = $('#message').val();
	if(csubject == ''){
		alert('Please write your subject');
		$('#csubject').focus();
		return false;
	}
    if(recipient == ''){
		alert('Please Select');
		$('#recipient').focus();
		return false;
	}
    if(recipient == 'others' && otheremail == ''){
		alert('Please Write your email address');
		$('#otheremail').focus();
		return false;
	}
    if(otheremail != '' && otheremail.indexOf("@") < 0){
		alert('Please Write your Valid email address');
		$('#otheremail').focus();
		return false;
	}
	if(message == ''){
		alert('Please write your message');
		$('#message').focus();
		return false;
	}
    $('#dispmsges').html('Please Wait...');
    $.ajax({
        type: "POST",
        url: '<?php echo base_url("admin/contacts/message_to_all"); ?>',
        data: { 
            csubject:csubject,
            recipient:recipient,
            otheremail:otheremail,
            message:message
        },
        success: function(result) {
            $('#dispmsges').html(result);
            $('#csubject').val('');
            $('#recipient').val('');
            $('#otheremail').val('');
			$('#message').val('');
			
        }
    });
});
$( ".viewdetails" ).click(function() {
		$('#displaymessage').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/contacts/messageview",
				data: { schid : schid},
				success: function(data) {
					//alert(data);
                    //refresh;
                    
					$('#displaymessage').html(data); 
				}
			});
			$('.viewmessage-modal').modal('show'); 
		}
        //window.location.reload();
	  
	});
    $('.viewmessage-modal').on('hidden', function () {
        document.location.reload();
    })
</script>