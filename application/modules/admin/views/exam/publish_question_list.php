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
                <!-- <a href="<?php echo base_url('admin/publish_exam_question'); ?>" class="btn btn-info float-right">Publish Question set</a> -->
            </h4>
            
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Exam Title</th>
                                        <th>Exam Start Time <br>& End Time</th>
                                        <!-- <th>Question Set Number</th> -->
                                        <th>Total Question</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <pre><?php print_r($listing); ?> -->
                            <?php if(!empty($listing)) {
                                    $i = 1;
                                    foreach ($listing as $key => $value) {
                                    $published_question =  $this->admin->checkExamQuestionLimit($value->esid);
                                    if($value->pstatus!='' && $value->pstatus=='1'){ $pstyle = 'none'; $estyle = ''; $status = '<span class="text-success">Published</span>';  }else{ $pstyle = ''; $estyle = 'none'; $status = '<span class="text-danger">Unpublished</span>'; }
                                    if($value->set_no==''){  $set_no = '--';  }else{ $set_no = $value->set_no; }
                                    if($published_question==''){  $total_question = '--';  }else{ $total_question = $published_question; }
                                    $date_time = date('H:i A', strtotime($value->start_time)).' - '.date('H:i A', strtotime($value->end_time));
                                    // $exam_title = $value->exam_title.' ('.$value->exam_for.')';
                                    $exam_title = date('F d,Y',strtotime($value->date)).' Set Exam Questions';

                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $exam_title; ?></td>
                                        <td><?php echo $date_time; ?></td>
                                        <!-- <td><?php echo $set_no; ?></td> -->
                                        <td><?php echo $total_question; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/publish_exam_question/'.$value->esid); ?>" class="btn btn-info" title="View Questions">
                                            View </a>
                                            <!-- <a style="display:<?=$estyle;?>" href="#" class="btn btn-success" title="Question Paper Published">
                                            Published </a> -->
                                            <!-- <a style="display:<?=$estyle;?>" href="<?php echo base_url('admin/publish_exam_question/'.$value->esid.'/'.$value->pqs_id); ?>" class="btn btn-info" title="Edit"> 
                                            <i class="fas fa-edit"></i> </a>-->
                                           <!--  <a href="javascript:void(0)" onclick="delete_lesson('<?php echo $value->es_id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a> -->
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
                window.location.href = '<?php echo base_url('admin/publish_question_delete/'); ?>'+id;
            }
        }
    </script>