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
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?> </h4>
            <div class="pb-3">
                <?php $uri = $this->uri->segment(3); ?>
                <a class="btn btn-info <?php if($uri == ''){ echo 'active'; } ?> text-center text-dark" href="<?php echo base_url('examiner/exam_question_listing');?>">All </a>
                <?php foreach ($uniqueset as $key => $value) {  ?>
                    <a class="btn btn-info <?php if($uri == $value->set_no){ echo 'active'; } ?> text-center text-dark" href="<?php echo base_url('examiner/exam_question_listing/').$value->set_no;?>">Set <?php echo $value->set_no; ?> Questionnaire</a>
                <?php }?>
            <a href="<?php echo base_url('examiner/add_question'); ?>" class="btn btn-info float-right">Add Question</a> 
            </div>
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Set Number</th>
                                        <th>Question Title</th>
                                        <th>Answer1</th>
                                        <th>Answer2</th>
                                        <th>Answer3</th>
                                        <th>Answer4</th>
                                        <th>Correct Answer</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php if(!empty($question_listing)) {
                                    $i = 1;
                                    $user_ID = $this->session->userdata('login')['user_ID'];
                                    foreach ($question_listing as $key => $value) {
                                    if($value->status==1){
                                        $status = '<span class="text-success">Submit to Admin</span>'; 
                                    }else{
                                        $status = '<span class="text-danger">Pending</span>'; 
                                    }
                                    if($value->added_by == $user_ID){
                                        $delete = '';
                                    }else{
                                        $delete = 'display:none';
                                    }?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->set_no; ?></td>
                                        <td><?php echo $value->question_title; ?></td>
                                        <td><?php echo $value->answere1; ?></td>
                                        <td><?php echo $value->answere2; ?></td>
                                        <td><?php echo $value->answere3; ?></td>
                                        <td><?php echo $value->answere4; ?></td>
                                        <td><?php echo $value->correct_answere; ?></td>
                                        <td><?php echo $value->added_by_name; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('examiner/question_view/'.$value->id); ?>" class="btn btn-info" title="View">
                                            <i class="fas fa-eye"></i> </a>
                                            <a href="<?php echo base_url('examiner/question_edit/'.$value->id); ?>" class="btn btn-info" title="Edit">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" style="<?php echo $delete;?>" onclick="delete_lesson('<?php echo $value->id; ?>');" class="btn btn-danger" title="Delete">
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
                window.location.href = '<?php echo base_url('examiner/question_delete/'); ?>'+id;
            }
        }
    </script>