<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>

          <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="border border-secondary rounded mx-1 nav-item">
                <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
              </li>
              <li class="border border-secondary rounded mx-1 nav-item">
                <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-approved" aria-selected="false">Approved (<?php echo $ce_provider_approved_count; ?>)</a>
              </li>
              <li class="border border-secondary rounded mx-1 nav-item">
                <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-pending" aria-selected="false">Pending (<?php echo $ce_provider_pending_count; ?>)</a>
              </li>
              <li class="border border-secondary rounded mx-1 nav-item">
                <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#pills-rejected" role="tab" aria-controls="pills-rejected" aria-selected="false">Rejected (<?php echo $ce_provider_rejected_count; ?>)</a>
              </li>
            </ul> -->

            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                  
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered cepexample" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Name of Representative</th>
                                    <th>Position</th>
                                    <th>Type</th>
                                    <th>Refrence Number</th>
                                    <th>Accreditation Number</th>
                                    <th>Date issue</th>
                                    <th>Validity</th>
                                    <th>Duration</th>
                                    <th>Reviewer</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php  if(!empty($ce_provider_payment_details)) {
                                    $i = 1;
                                    foreach($ce_provider_payment_details as $key => $value){ 
                                        if($value['rev_status']=='1'){ $status = '<span class="text-success"> Approved </span>'; }elseif($value['rev_status']=='2'){ $status = '<span class="text-danger"> Rejected </span>'; }else{ $status = '<span class="text-info"> Pending </span>'; }
                                        if($value['document_for']== 'n'){ $document_for = 'New'; }else{ $document_for = 'Renewal'; }
                                        $reviewerName = ($value['rev_id'] > 0)?$value['rev_firsname']:'<button type="button" data-id="'.$value['doc_id'].'" id="revewier_accept'.$value['doc_id'].'" onClick="acceptcep(\''.$value['doc_id'].'\')" class="btn btn-primary px-5">Accept</button>'; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class="dp-image"><img class="img-fluid img-rounded d-block mx-auto" src="<?php echo base_url('assets/images/ce_provider/').$value['logo'];?>" width="200px" height="200px"></td>
                                        <td><?php echo $value['business_name']; ?></td>
                                        <td><?php echo $value['address']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['phone']; ?></td>
                                        <td><?php echo $value['contact_person']; ?></td>
                                        <td><?php echo $value['designation']; ?></td>
                                        <td><?php echo $document_for; ?></td>
                                        <td><?php echo $value['reference_no']; ?></td>
                                        <td><?php echo $value['accreditation_no']; ?></td>
                                        <td><?php echo date('M d, Y',strtotime($value['review_accept_date'])); ?></td>
                                        <td><?php echo date('M d, Y',strtotime($value['expiry_at'])); ?></td>
                                        <td><?php echo $value['renew_for']; ?> Year/s</td>
                                        <td><?php echo $reviewerName; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <!--<td><a href="<?php echo base_url('reviewer/reviewer/cep_details/').$value['doc_id']; ?>" target=""><i class="fas fa-eye"></i></a>-->
                                        <td><a href="javascript:void(0);" data-id="<?=$value['doc_id']?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                        <?php if($value['accreditation_no']){ ?>
                                        <a href="javascript:void(0);" data-id="<?php echo $value['reference_no']; ?>" class="viewcertificate"><i class="fas fa-id-card"></i></a> <?php } ?>
                                        </td>

                                    </tr>
                                    <?php $i++; } } ?>
                            </tbody>

                        </table>
                    </div>
                  </div> 
              </div>

                    
              <div class="tab-pane fade" id="pills-approved" role="tabpanel" aria-labelledby="pills-approved-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered cepexample" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Application No.</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Receipt</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php  if(!empty($ce_provider_approved)) {
                                    $i = 1;
                                    foreach($ce_provider_approved as $key => $value){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['user_name']; ?></td>
                                        <td><?php echo $value['business_no']; ?></td>
                                        <td><?php echo $value['issue_date']; ?></td>
                                        <td><?php echo $value['amount']; ?></td>
                                        <td><?php echo $value['tax']; ?></td>
                                        <td id="ce_provider_status_<?php echo $value['payment_id']; ?>" class="ce_provider_status"><?php echo ($value['ce_status']==1)?"Approved":"Pending"; ?></td>
                                        <td><a class="btn btn-primary px-5" href="javascript:void(0)" onclick="acceptcep('<?php echo $value['provider_id']; ?>')">Accept</a></td>
                                        <td><a href="<?php echo base_url('reviewer/reviewer/cep_details/').$value['provider_id']; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>

                            </tbody>
                        </table>
                    </div>
                  </div> 
              </div>
              
              <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered cepexample" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Application No.</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Receipt</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php  if(!empty($ce_provider_pending)) {
                                    $i = 1;
                                    foreach($ce_provider_pending as $key => $value){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['user_name']; ?></td>
                                        <td><?php echo $value['business_no']; ?></td>
                                        <td><?php echo $value['issue_date']; ?></td>
                                        <td><?php echo $value['amount']; ?></td>
                                        <td><?php echo $value['tax']; ?></td>
                                        <td id="ce_provider_status_<?php echo $value['payment_id']; ?>" class="ce_provider_status"><?php echo ($value['ce_status']==1)?"Approved":"Pending"; ?></td>
                                        <td><a class="btn btn-primary px-5" href="javascript:void(0)" onclick="acceptcep('<?php echo $value['provider_id']; ?>')">Accept</a></td>
                                        <td><a href="<?php echo base_url('reviewer/reviewer/cep_details/').$value['provider_id']; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>

                            </tbody>
                        </table>
                    </div>
                </div> 

              </div>
              <div class="tab-pane fade" id="pills-rejected" role="tabpanel" aria-labelledby="pills-rejected-tab">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered cepexample" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Application No.</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Receipt</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php  if(!empty($ce_provider_rejected)) {
                                    $i = 1;
                                    foreach($ce_provider_rejected as $key => $value){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['user_name']; ?></td>
                                        <td><?php echo $value['business_no']; ?></td>
                                        <td><?php echo $value['issue_date']; ?></td>
                                        <td><?php echo $value['amount']; ?></td>
                                        <td><?php echo $value['tax']; ?></td>
                                        <td id="ce_provider_status_<?php echo $value['payment_id']; ?>" class="ce_provider_status"><?php echo ($value['ce_status']==1)?"Approved":"Pending"; ?></td>
                                        <td><a class="btn btn-primary px-5" href="javascript:void(0)" onclick="acceptcep('<?php echo $value['provider_id']; ?>')">Accept</a></td>
                                        <td><a href="<?php echo base_url('reviewer/reviewer/cep_details/').$value['provider_id']; ?>" target="_blank"><i class="fas fa-eye"></i></a></td>

                                    </tr>
                                    <?php $i++; } } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </main>

    
<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">
      <!-- body -->
       
        <div class="">
            <iframe src="" id="crtdetials" frameborder="0" width="720" height="920"></iframe>
        </div>
      <!-- end body -->
    </div>
  </div>
</div>  

<div class="modal fade viewdetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="displaydetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div>         

<script type="text/javascript" src="<?php echo base_url('assets/js/revewier/revewer.js'); ?>"></script>
<script>    
    $(document).ready(function() {
        $('.cepexample').DataTable();
    } );
    
    $( ".viewcertificate" ).click(function() {
        var docid = $(this).data("id");
        var path = "<?php echo base_url('assets/uploads/pdf/')?>" + docid +".pdf";
        $('#crtdetials').attr('src',path); 
        $('.certificate-modal').modal('show'); 
    });

    $( ".viewdetails" ).click(function() {
		$('#displaydetials').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/cepdetailsforpopup",
				data: { schid : schid},
				success: function(data) {
					//alert(data);
					$('#displaydetials').html(data); 
				}
			});
			$('.viewdetails-modal').modal('show'); 
		}
	  
	});

    var base_url = "<?php echo base_url(); ?>";

    function acceptcep(doc_id){
        var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
        $.ajax({
            type: "POST",
            url: base_url+"reviewer/reviewer/cepassignedreviewer",
            data: { doc_id : doc_id,reviewer_id:reviewer_id },
            success: function(data) {
                if(data>0){
                    alert('Reviewer assigned for CEP.');
                    location.reload();
                }   
            }
        });
     }

</script>
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
</style>
