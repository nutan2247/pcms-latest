<div id="layoutSidenav_content">
    <main>
        
        <div class="container-fluid">
            <h4 class="mt-4 mb-3">Online licensure examination (<?php echo $title; ?>)</h4>
        
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist"> 
				<?php
					/* if(count($total_exam) > 0){
						
						foreach($total_exam as $examschlist){
							$es_id = (isset($_REQUEST['es_id']) && $_REQUEST['es_id'] !="")?$_REQUEST['es_id']:'';
							$activetab = '';
							if($es_id == $examschlist->es_id){
								$activetab = 'active';
							}
							echo '<li class="border border-secondary rounded mx-1 mb-2 nav-item">
									<a class="nav-link '.$activetab.'"  href="'.current_url().'?es_id='.$examschlist->es_id.'">'.date('F d,Y',strtotime($examschlist->date)).'<br>'.date('h:i A', strtotime($examschlist->start_time)).'-'.date('h:i A', strtotime($examschlist->end_time)).'<br>'.$examschlist->venue.'</a>
									</li>';
						}
					}else{
						echo '<p>No any exam schedule assinged in your account.</p>';
					} */
				?>
               
            </ul>

            <div class="row">
			
                <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-all" aria-selected="true">Pending (<?=count($listing);?>)</a>
                  </li>
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-present" role="tab" aria-controls="pills-all" aria-selected="true">Present (0)</a>
                  </li>
                </ul>     -->
				
				<!--<div class="row" >
				<div class="mt-12 mb-12">
				<form name="searchForm" method="get" style="padding-left: 29px;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input  name="name" id="name" value="<?php echo (isset($_GET['name']))?$_GET['name']:'';?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">  
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo (isset($_GET['email']))?$_GET['email']:'';?>"/>
                                    </div>
                                    <div class="col-md-2">  
                                        <input type="text" name="exam_code" id="exam_code" class="form-control" placeholder="Exam Code" value="<?php echo (isset($_GET['exam_code']))?$_GET['exam_code']:'';?>"/>
                                    </div>
									<div class="col-md-2">  
                                        <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth" value="<?php echo (isset($_GET['dob']))?$_GET['dob']:'';?>"/>
                                    </div>
                                    <div class="col-md-3">  
                                        <button type="submit" value="search" class="btn btn-primary">Search</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
                                </div>
							</form>
						</div>	
						</div>	-->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-pending" role="tabpanel" aria-labelledby="pills-all-tab">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered reviewerDT" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Exam Date </th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Date of Birth</th>
                                            <th>Email</th>
                                            <th>Exam Code</th>
                                            <th>Date Issued</th>
                                            <th>Validity</th>
                                            <th>Attendance</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php //print_r($listing[0]);exit;
                                    if(!empty($listing)){
                                        $count = 1; 
                                        foreach($listing as $key => $list){
                                            if(isset($list->photo)){
                                                $photo = ($list->photo != "" && file_exists('./assets/images/graduates/'.$list->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/'.$list->photo).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">';
                                            }else{
                                                $photo = ($list->image != "" && file_exists('./assets/uploads/profile/'.$list->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$list->image).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">';
                                            }
                                            if($list->attendance == '1'){ $attendance = '<span class="text-success">Present</span>'; }elseif($list->attendance == '2'){ $attendance = '<span class="text-danger">Absent</span>'; }else{ $attendance = '<span class="text-warning">Pending</span>'; } 
                                                $date_time = date('F d,Y', strtotime($list->exam_date)).' & '.date('H:i A', strtotime($list->start_time));
                                            $validity = 'N/A';
                                            if(isset($list->expiry_at) && $list->expiry_at != '0000-00-00'){
                                                $validity=date("M d,Y",strtotime($list->expiry_at));
                                            }
                                            if(isset($list->validity) && $list->validity != ''){
                                                $validity=date("M d,Y",strtotime($list->validity));
                                            }if(isset($list->validity) && $list->validity == ''){
                                                $validity=date("M d,Y",strtotime($list->issued_date . ' + 1 Year'));
                                            }
                                    ?>
                                        <tr>
                                            <td><?=$count;?></td>
											<td><?=date("M d,Y",strtotime($list->exam_date));?></td>
                                            <td class="dp-image"><?=$photo;?></td>
                                            <td><?=$list->name;?></td>
                                            <td><?=$list->dob;?></td>
                                            <td><?=$list->email;?></td>
                                            <td><?=$list->exam_code;?></td>
                                            <td><?=date("M d,Y",strtotime($list->issued_date));?></td>
                                            <td><?=$validity?></td>
                                            <td><?=$attendance;?></td>

                                           <!-- <td>
												<?php if($list->attendance < 1){ ?>
                                                <a class="btn btn-info" href="javascript:void(0)" onclick="changeStatus('<?php echo $list->user_ID; ?>','<?php echo $type;?>')" title="Change Status"> Change Status </a>-->

                                                <!-- <a href="<?php echo site_url('examiner/reviewers_view/').$list->user_ID;?>" title="View"><i class="fas fa-eye"></i> </a>-->
												<?php } ?>
                                             <!--   <a href="javascript:void(0);" title="View" class="viewcard" data-id="<?//=$list->user_ID;?>" data-type="<?//=$type?>"><i class="fas fa-certificate" style="font-size:24px;color:green"></i> </a>
                                            </td>-->

                                        </tr>

                                        <?php $count++; } }else{ echo'<tr><td colspan="10">No Data Found!</td></tr>'; }?>
                                    </tbody>

                                </table>
                            </div>
                        </div> 

                    </div>
                </div>
                    
            </div>
        </div>
    </main>

    
<!-- Modal -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mark Attendance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('proctor/profMarkAttendance'); ?>
      <div class="modal-body">
        <input type="hidden" name="user_id" value="" id="user_id">
        <input type="hidden" name="type" value="" id="type">
        Present<input type="radio" name="attendance" value="1" required id="present">
        Absent<input type="radio" name="attendance" value="2" required id="absent">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="modal fade card-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
       
        <div id="card"></div>
      <!-- end body -->
    </div>
  </div>
</div>

<script>
    function changeStatus(uid,type){
        $('#user_id').val(uid);
        $('#type').val(type);
        $('#changeModal').modal('show');
    }
    $( ".viewcard" ).click(function() {
		$('#card').html('Loading...'); 
		var schid = $(this).data("id");
        var type = $(this).data("type");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>proctor/get_exam_pass",
				data: { schid : schid, type : type},
				success: function(data) {
					//alert(data);
					$('#card').html(data); 
				}
			});
			$('.card-modal').modal('show'); 
		}
	  
	});
</script>