<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>

        <!-- <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active"><?php echo $page_title; ?></li>

            </ol> -->



        <div class="card mb-4">

            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $table_name; ?>
                </span>
            </div>

            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Examinee Name</th>
                                <th>Examinee email</th>
                                <th>Type</th>
                                <th>Exam Code</th>
                                <th>Exam Date</th>
                                <th>Exam Slot</th>
                                <th>Refrence Code</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if(!empty($listing)){
                                $count = 1; 
                                foreach($listing as $key => $list){ 
                if($list->role == 'P'){ $type = 'With Exam'; }else{ $type = 'Without Exam'; }
                if($list->reviewer_status == '1'){ $status = '<span class="text-success">Approved</span>'; }elseif($list->reviewer_status =='2'){ $status = '<span class="text-danger">Reject</span>'; }else{ $status = '<span class="text-info">Pending</span>'; }                   ?>
                            <tr>

                                <td><?=$count;?></td>

                                <td><?=$list->name;?></td>
                                <td><?=$list->email;?></td>
                                <td><?=$type;?></td>
                                <td><?=$list->exam_code;?></td>
                                <td><?=$list->exam_date;?></td>
                                <td><?=$list->exam_slot;?></td>
                                <td><?=$list->refrence_code;?></td>
                                <!-- <td><?=$status;?></td> -->

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

</main>

<!-- Modal -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('examiner/changeExaminessStatus'); ?>
      <div class="modal-body">
        <input type="hidden" name="user_id" value="" id="user_id">
        Present<input type="radio" name="attendance" value="1" required id="present">
        Absent<input type="radio" name="attendance" value="0" required id="absent">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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