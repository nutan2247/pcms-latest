<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4 pb-2">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 "><span
                                class="d-inline-block border-bottom pb-2 px-3">Proctor'S TRACKER</span>
                        </h4>
                        <p class="text-center"><?php echo date('F d, Y');?></p>                        
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                            <img src="<?php echo base_url('assets/uploads/proctor/').$details->photo; ?>" style="width: 150px; height: 150px;" >
                            </div>
                            <div class="col-md-6 mx-auto">
                                <?php // print_r($details);
                                if($details->user_type == 'pp'){
									$ptype = 'Proctor for Foriegn professional'; 
									$heading = 'Foriegn Professional Examiness Listing'; 
								}else{ 
                                    $ptype = 'Proctor for Graduates'; 
									$heading = 'Graduates Examiness Listing'; 
								}
                                $created_on = $details->created_on; ?>
                                <ul style="list-style-type:none;">
                                    <li><?php echo ucwords($details->first_name.' '.$details->last_name); ?></li>
                                    <li>Proctor (<?=$ptype?>)</li>
                                    <li>Appointment date: <?php echo date('F d,Y',strtotime($details->created_on));?></li>
                                    <li>Validity: <?php echo date('F d,Y',strtotime(date("Y-m-d", strtotime($created_on)) . " + 365 day"));?></li>
                                </ul>
                            </div>
                                
                            <div class="col-md-3 mx-auto text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-info px-5">0</button>
                                    <p class="mt-2 upper-case">Total Number Of<br> Exam Proctored</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?= $heading; ?></h4>
        
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">            
                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                <a class="nav-link <?php if(isset($_REQUEST['es_id']) && $_REQUEST['es_id']==$total_exam[0]->es_id){ echo 'active';}?>"  href="<?=current_url().'?es_id='.$total_exam[0]->es_id;?>"><?= date('F d,Y',strtotime($total_exam[0]->date)); ?><br><?= date('h:i A', strtotime($total_exam[0]->start_time)).'-'.date('h:i A', strtotime($total_exam[0]->end_time)); ?><br><?= $total_exam[0]->venue;?></a>
                </li>

                <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                <a class="nav-link <?php if(isset($_REQUEST['es_id']) && $_REQUEST['es_id']==$total_exam[1]->es_id){ echo 'active';} ?>"href="<?=current_url().'?es_id='.$total_exam[1]->es_id;?>" ><?= date('F d,Y',strtotime($total_exam[1]->name_of_exam)); ?><br><?= date('h:i A', strtotime($total_exam[1]->start_time)).'-'.date('h:i A', strtotime($total_exam[1]->end_time)); ?><br><?= $total_exam[1]->venue;?></a>
                </li>
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
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-pending" role="tabpanel" aria-labelledby="pills-all-tab">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered reviewerDT" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Date of Birth</th>
                                            <th>Email</th>
                                            <th>Exam Code</th>
                                            <th>Date Issued</th>
                                            <th>Validity</th>
                                            <th>Attendance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if(!empty($listing)){
                                        $count = 1; 
                                        foreach($listing as $key => $list){ 
                                            $photo = '--';
                                    if($list->attendance == '1'){ $attendance = '<span class="text-success">Present</span>'; }elseif($list->attendance == '2'){ $attendance = '<span class="text-danger">Absent</span>'; }else{ $attendance = '<span class="text-warning">Pending</span>'; } 
                                    $date_time = date('F d,Y', strtotime($list->exam_date)).' & '.date('H:i A', strtotime($list->start_time)); ?>

                                        <tr>
                                            <td><?=$count;?></td>
                                            <td><?=$photo;?></td>
                                            <td><?=$list->name;?></td>
                                            <td><?=$list->dob;?></td>
                                            <td><?=$list->email;?></td>
                                            <td><?=$list->exam_code;?></td>
                                            <td><?=$list->issued_date;?></td>
                                            <td>--</td>
                                            <td><?=$attendance;?></td>

                                            <td>
                                                <a class="btn btn-info" href="javascript:void(0)" onclick="changeStatus('<?php echo $list->user_ID; ?>')" title="Change Status"> Change Status </a>

                                                <!-- <a href="<?php echo site_url('examiner/reviewers_view/').$list->user_ID;?>" title="View"><i class="fas fa-eye"></i> </a>-->
                                            </td>

                                        </tr>

                                        <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>
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
        Present<input type="radio" name="attendance" value="1" required id="present">
        Absent<input type="radio" name="attendance" value="0" required id="absent">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<script>
    function changeStatus(uid){
        $('#user_id').val(uid);
        $('#changeModal').modal('show');
    }
</script>