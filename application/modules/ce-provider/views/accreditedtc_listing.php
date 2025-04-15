
  <?php $this->view('dashboard_top'); ?>
    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
                	<h4 class="mb-4 mt-4 text-uppercase text-center">Accredited Training Courses
	                	<!-- 
                <button class="btn btn-info float-right" data-target="#uploadTrainingModal" data-toggle="modal" >Upload Training </button> -->
	                </h4>
                    <div class="card">
                        <div class="card-header"> 
                            Valid Training Course 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="ocdata">
                                    <thead>
                                    <tr>
                                    <th>Sl.</th>
                                        <th>Title</th>
                                        <th>Unit</th>
                                        <th>Price</th>
                                        <th>Accreditation</th>
                                        <th>Expiry Date</th>
                                        <th>Date Approval</th>
                                        <th>Status</th>
                                        <th>Countdown</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php if(count($approvedcourses) > 0){ 
                                            $count = 1;		
                                            foreach($approvedcourses as $cor){ 
                                                if($cor->accreditation_no!=''){
                                                    $viewcertificate = '<a href="javascript:void(0)" data-id="'.$cor->accreditation_no.'" class="btn btn-info viewAccCertificate" title="View course pdf">View</a>'; 
                                                }else{
                                                    $viewcertificate = 'Not issued!';
                                                }
                                                //$newdate = strtotime ( '30 day' , strtotime ($cor->review_date) ) ;
                                                //$ndate = date ( 'Y-m-j' , $newdate );

                                                $date1 = new DateTime($cor->expiry_at);
                                                $date2 = new DateTime(date('Y-m-d'));
                                                $interval = $date1->diff($date2);
                                                $remaining_days = $interval->days;

                                                if($cor->reviewer_status < 1){
                                                    $status = 'Pending';
                                                }
                                                if($cor->reviewer_status == 1){
                                                    $status = 'Approved';
                                                }
                                                if($cor->reviewer_status == 2){
                                                    $status = 'Rejected';
                                                }
                                                ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $cor->training_title; ?></td>
                                                <td><?php echo $cor->training_units; ?> </td>
                                                <td><?php echo $cor->training_price; ?></td>
                                                <td><?php echo isset($cor->accreditation_no)?$cor->accreditation_no:'--'; ?></td>
                                                <td><?php echo $cor->expiry_at; ?></td>
                                                <td><?php echo $cor->review_accept_date; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td><?php echo $remaining_days; ?></td>
                                                <td><?php echo $viewcertificate; ?></td>
									        </tr>
							            <?php	} 	}else{ echo '<tr><td colspan="11">No data found!</td></tr>'; } ?>
							        </tbody>	
						        </table>
					        </div>
					    </div>
					</div>
                
                    <div class="card">
                        <div class="card-header"> 
                            Expired Training Course 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="ocdata">
                                    <thead>
                                    <tr>
                                    <th>Sl.</th>
                                        <th>Title</th>
                                        <th>Unit</th>
                                        <th>Price</th>
                                        <th>Accreditation</th>
                                        <th>Expiry Date</th>
                                        <th>Date Approval</th>
                                        <th>Status</th>
                                        <th>Countdown</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php if(count($expairedcourses) > 0){ 
                                            $count = 1;		
                                            foreach($expairedcourses as $cor){ 
                                                if($cor->accreditation_no!=''){
                                                    $viewcertificate = '<a href="javascript:void(0)" data-id="'.$cor->accreditation_no.'" class="btn btn-info viewAccCertificate" title="View course pdf">View</a>'; 
                                                }else{
                                                    $viewcertificate = 'Not issued!';
                                                }
                                                //$newdate = strtotime ( '30 day' , strtotime ($cor->review_date) ) ;
                                                //$ndate = date ( 'Y-m-j' , $newdate );

                                                $date1 = new DateTime($cor->expiry_at);
                                                $date2 = new DateTime(date('Y-m-d'));
                                                $interval = $date1->diff($date2);
                                                $remaining_days = $interval->days;

                                                if($cor->reviewer_status < 1){
                                                    $status = 'Pending';
                                                }
                                                if($cor->reviewer_status == 1){
                                                    $status = 'Approved';
                                                }
                                                if($cor->reviewer_status == 2){
                                                    $status = 'Rejected';
                                                }
                                                ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $cor->training_title; ?></td>
                                                <td><?php echo $cor->training_units; ?> </td>
                                                <td><?php echo $cor->training_price; ?></td>
                                                <td><?php echo isset($cor->accreditation_no)?$cor->accreditation_no:'--'; ?></td>
                                                <td><?php echo $cor->expiry_at; ?></td>
                                                <td><?php echo $cor->review_accept_date; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td><?php echo $remaining_days; ?></td>
                                                <td><?php echo $viewcertificate; ?></td>
									        </tr>
							            <?php	} 	}else{ echo '<tr><td colspan="11">No data found!</td></tr>'; } ?>
							        </tbody>	
						        </table>
					        </div>
					    </div>
					</div>

				</div>
            </div>
        </div>
    </section>


<!-- The Modal -->
<div class="modal" id="cepViewPdf">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Tarining</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <iframe src="" id="pdfsrc" frameborder="0" width="600" height="850"></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="viewCourseCertificate">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ACCIREDITATION CERTIFICATE</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <iframe src="" id="certificatesrc" frameborder="0" width="600" height="850"></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
$('.viewPdf').on('click',function(){
    var id = $(this).attr('data-id');
    var path = "<?php echo base_url('assets/images/ce_provider/'); ?>"+id;  
    $('#pdfsrc').attr('src',path);
    $('#cepViewPdf').modal('show');
});

$('.viewAccCertificate').on('click',function(){
    var id = $(this).attr('data-id');
    var path = "<?php echo base_url('assets/uploads/pdf/'); ?>"+id+".pdf";  
    $('#certificatesrc').attr('src',path);
    $('#viewCourseCertificate').modal('show');
});
</script>
