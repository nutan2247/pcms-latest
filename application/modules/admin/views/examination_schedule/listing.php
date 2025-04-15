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
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?> 
            <a href="<?php echo base_url('admin/add_examination_schedule'); ?>" class="btn btn-info float-right">Add Examination Schedule</a> 
        </h4>
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name of Exam</th>
                                        <th>Exam for</th>
                                        <th>Exam Mode</th>
                                        <th>Registration <br> Start Date</th>
                                        <th>Registration <br> End Date</th>
                                        <th>Exam Date</th>
                                        <th>Exam Start Time</th>
                                        <th>Exam End Time</th>
                                        <th>Maximum Applicant</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php if(!empty($listing)) {
                                    $i = 1;
                                    foreach ($listing as $key => $value) {
                                    if($value->exam_for=='pp'){ $exam_for = '<span class="text-info">Foreign Professionals</span>';  }else{ $exam_for = '<span class="text-primary">Local Graduates</span>'; } 
                                    if($value->status=='1'){ $status = '<span class="text-success">Publish</span>';  }else{ $status = '<span class="text-danger">Pending</span>'; }
                                    
                                    if($value->date != '0000-00-00'){
                                        $date = date('F d,Y', strtotime($value->date));
                                    }else{
                                        $date = '--';
                                    }
                                    
                                    if($value->reg_start_date != '0000-00-00'){
                                        $reg_start_date = date('F d,Y', strtotime($value->reg_start_date));
                                    }else{
                                        $reg_start_date = '--';
                                    }
                                    
                                    if($value->reg_end_date != '0000-00-00'){
                                        $reg_end_date = date('F d,Y', strtotime($value->reg_end_date));
                                    }else{
                                        $reg_end_date = '--';
                                    }
                                    $exam_mode = '--';
                                    if($value->exam_mode == 'cb'){
                                        $exam_mode = 'Computer-based';
                                    }
                                    if($value->exam_mode == 'pb'){
                                        $exam_mode = 'Paper-based';
                                    }
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->name_of_exam; ?></td>
                                        <td><?php echo $exam_for; ?></td>
                                        <td><?php echo $exam_mode; ?></td>
                                        <td><?php echo $reg_start_date; ?></td>
                                        <td><?php echo $reg_end_date; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo date('h:i A', strtotime($value->start_time)); ?></td>
                                        <td><?php echo date('h:i A', strtotime($value->end_time)); ?></td>
                                        <td><?php echo $value->maximum_applicant  ; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-info sch-view" title="View"><i class="fas fa-eye"></i> </a>
                                            <a href="<?php echo base_url('admin/add_examination_schedule/'.$value->es_id); ?>" class="btn btn-info" title="Edit">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" onclick="delete_lesson('<?php echo $value->es_id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                    <?php $i++; } } ?>
                                </tbody>

                            </table>
                        </div>
               

        </div>

    </main>

<script>
    function delete_lesson(id){
        var x = confirm('Do you want to delete this ?');
        if(x == true){
            window.location.href = '<?php echo base_url('admin/examination_schedule_delete/'); ?>'+id;
        }
    }

    $('.sch-view').click(function(){
        alert('under developmant. need to help.');
    });
</script>