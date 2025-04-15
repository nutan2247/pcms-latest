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
            <h4 class="mt-4 mb-3"><?php echo $page_title.' ('.count($question_listing).')'; ?> </h4>
            
            <?php $uri = isset($_GET['set_no'])?$_GET['set_no']:''; ?>
            <?php $excat_id = isset($_GET['excat_id'])?$_GET['excat_id']:'';
                  $excat_idb = isset($_GET['excat_idb'])?$_GET['excat_idb']:''; ?>
            <?php $year = isset($_GET['year'])?$_GET['year']:''; 
                  $set_no = isset($_SESSION['temp_set_no'])? $_SESSION['temp_set_no']:''; 
                  unset($_SESSION['temp_set_no']); ?>

            <?php //echo '<pre>';print_r($exam_dates); exit; ?>
            <div class="row">
                <div class="col-md-3 pb-3">
                    <span>No of Question by Category for Exam: </span>
                </div>
                <div class="col-sm-3 pb-3">
                    <select name="set_no" id="cset_no" class="form-control addquestionbycat">
                        <option value="">Select Exam Date</option>
                        <?php if(!empty($exam_dates)){
                            foreach($exam_dates as $list){ ?>
                                <option value="<?=$list->es_id?>"<?=($set_no == $list->es_id)?'selected':''; ?>><?=$list->name_of_exam.'('.date('m-d-Y',strtotime($list->date)).')' ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <a href="<?=base_url('admin/exam_question_listing') ?>" class="btn btn-primary btn-sm float-right">Reset Filter</a>
                </div>
            </div>
            <form action="<?php echo base_url('admin/exam_question_listing');?>" method="GET" class="form-group">
            
            <div class="row">
            
                <div class="col-md-3 pb-3">
                    <span>Search Selected Question: </span>
                </div>
                
                <div class="col-sm-3 pb-3">
                    <select name="set_no" id="published_set_no" class="form-control" onchange="this.form.submit();">
                        <option value="">Select Exam Date</option>
                        <?php if (!empty($exam_dates)){
                            foreach($exam_dates as $list){ ?>
                                <option value="<?=$list->es_id?>"<?=($uri == $list->es_id)?'selected':''; ?>><?=$list->name_of_exam.'('.date('m-d-Y',strtotime($list->date)).')' ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                    <!--<div class="pb-3">
                        <a class="btn btn-info <?php /*if($uri == ''){ echo 'active bg-success'; }else{ echo 'bg-primary';} ?> text-center text-light" href="<?php echo base_url('admin/exam_question_listing');?>">All <br>Exam Questions</a>
                        <?php foreach ($uniqueset as $key => $value) {  ?>
                            <a class="btn btn-info <?php if($uri == $value->set_no){ echo 'active bg-success'; }else{ echo 'bg-primary';} ?> text-center text-light" href="<?php echo base_url('admin/exam_question_listing/').'?set_no='.$value->set_no;?>"><?php echo date('F d,Y',strtotime($value->date)); ?><br> Exam Questions</a>
                        <?php } */?>
                    </div>-->
                
                <div class="col-sm-4 pb-3">
                    <select name="excat_id" id="excat_id" class="form-control" onchange="this.form.submit();">
                        <option value="">Select Question Category</option>
                        <?php if(count($ques_category > 0)){
                            foreach($ques_category as $list){ ?>
                                <option value="<?=$list->excat_id ?>" <?=($excat_id==$list->excat_id)?'selected':''?>><?=$list->category_name ?></option>
                        <?php } } ?>
                    </select>
                    
                </div>
                
            
                <!-- <a href="<?php echo base_url('admin/add_question'); ?>" class="btn btn-info float-right">Add Question</a>  -->
            </div>
            <input type="hidden" name="status" value="selected">
            </form>
            <form action="<?php echo base_url('admin/exam_question_listing');?>" method="GET" class="form-group">
            <div class="row">
                <div class="col-md-3 pb-3">
                    <span>Search Submitted Question: </span>
                </div>
                <div class="col-sm-3 pb-3">
                    <select name="excat_idb" id="excat_idb" class="form-control" onchange="this.form.submit();">
                        <option value="">Select Question Category</option>
                        <?php if(count($ques_category > 0)){
                            foreach($ques_category as $list){ ?>
                                <option value="<?=$list->excat_id ?>" <?=($excat_idb==$list->excat_id)?'selected':''?>><?=$list->category_name ?></option>
                        <?php } } ?>
                    </select>
                    
                </div>
                <!--<div class="col-sm-2">
                    <a href="<?=base_url('admin/exam_question_listing') ?>" class="btn btn-primary btn-sm float-right">Reset Filter</a>
                </div>-->
            </div>
            <input type="hidden" name="status" value="submitted">
            </form>
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <!--<th>Date of Exam</th>-->
                                        <th>Question Category</th>
                                        <th>Question Title</th>
                                        <th>Ans. 1</th>
                                        <th>Ans. 2</th>
                                        <th>Ans. 3</th>
                                        <th>Ans. 4</th>
                                        <th>Correct Answer</th>
                                        <th>Rationale</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php if(!empty($question_listing)) {
                                //echo '<pre>';print_r($question_listing[0]);exit;
                                    $i = 1;
                                    foreach ($question_listing as $key => $value) {
                                    if($value->status=='1'){
                                        $status = '<span class="text-info">Submitted</span>'; 
                                        $btnpublish = '';
                                        $btnedit = '';
                                    }elseif($value->status=='2'){
                                        $status = '<span class="text-success">Selected</span>'; 
                                        $btnpublish = '';
                                        $btnedit = 'display:none';
                                    }else{
                                        $status = '<span class="text-danger">Pending</span>'; 
                                        $btnpublish = 'display:none';
                                        $btnedit = '';
                                    }
                                    if($value->updated_at != '0000-00-00'){
                                        $submitdate = date('M d,Y',strtotime($value->updated_at));
                                    }else{
                                        $submitdate = '';
                                    }
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <!--<td><?php echo $value->examdate; ?></td>-->
                                        <td><?php echo $value->category_name; ?></td>
                                        <td><?php echo $value->question_title; ?></td>
                                        <td><?php echo $value->answere1; ?></td>
                                        <td><?php echo $value->answere2; ?></td>
                                        <td><?php echo $value->answere3; ?></td>
                                        <td><?php echo $value->answere4; ?></td>
                                        <td><?php echo $value->correct_answere; ?></td>
                                        <td><?php echo readMoreHelper($value->rationale,100,$value->id); ?></td>
                                        <td><?php echo $value->added_by_name; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $submitdate; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/question_view/'.$value->id); ?>" class="btn btn-info mb-1" title="View">
                                            <i class="fas fa-eye"></i> </a>
                                            <a href="<?php echo base_url('admin/question_edit/'.$value->id); ?>" class="btn btn-info mb-1" title="Edit" style="<?php echo $btnedit; ?>">
                                            <i class="fas fa-edit"></i> </a>
                                            <!-- <a href="javascript:void(0)" onclick="delete_lesson('<?php echo $value->id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a> -->
                                            <!--<a href="javascript:void(0)" id="<?='selectbtnid'.$value->id ?>" style="<?php echo $btnpublish; ?>" data-id="<?php echo $value->id; ?>" data-value="<?php echo $value->status; ?>" data-name="<?php echo $value->ques_cat_id; ?>"  class="btn btn-info mb-1 adminChangestaus" title="Publish">-->
                                            <button id="<?='selectbtnid'.$value->id ?>" style="<?php echo $btnpublish; ?>" data-id="<?php echo $value->id; ?>" data-value="<?php echo $value->status; ?>" data-name="<?php echo $value->ques_cat_id; ?>"  class="btn btn-info mb-1 adminChangestaus" title="Select">Select</button>
                                        </td>
                                    </tr>

                                    <?php $i++; } } ?>
                                </tbody>

                            </table>
                        </div>
        </div>

    </main>

    <!-- Modal  Register Sub institutions-->
    <div id="achangestatus" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Publish Exam Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body promatecompany">
                    <form action="<?php echo base_url('admin/admin_publish_question'); ?>" method="post" enctype="multipart/form-data">
                        <p>
                            <input type="hidden" name="id" id="aid" value="">
                            <input type="hidden" name="set_no" id="aset_no" value="">
                            <label>Change Status</label>
                            <select name="status" class="form-control" id="pstatus">
                                <option value="2">Publish</option>
                                <option value="1" selected>Unpublish</option>
                            </select>
                        </p>
                        <p class="submit alignleft">
                            <input class="btn btn-primary" value="Update" type="submit" name="save">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for set number of question by category-->
    <div id="CategoriseQuestion" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Number of question by category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body promatecompany">
                    
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="tot">Total Question:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="totalmarks" id="totalmarks" value="" class="form-control">
                            </div>
                        </div>
                        <form onsubmit="return validateform()" name="QuesCatValueForm" id="QuesCatValueForm" action="<?php echo base_url('admin/add_edit_ques_cat_value'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="set_no" id="set_noforcat" value="">
                            <?php $catn = 0; if(count($ques_category > 0)){
                                foreach($ques_category as $list){ ?>
                                <div class="form-group row">
                                    <input type="hidden" name="esc_id[]" value="" id="<?='esc_id'.$catn?>">
                                    <input type="hidden" name="cat_id[]" value="<?=$list->excat_id?>" id="<?='catid'.$catn?>">
                                    <div class="col-md-4">
                                        <label for="tot"><?=$list->category_name.':' ?></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="total_question[]" id="<?='cat'.$catn++?>" value="0" class="form-control">
                                    </div>
                                </div>
                            <?php }
                            } ?>
                        <div class="col-md-8 offset-md-4">
                            <span class="text-danger" id="formerr"></span>
                        </div>
                        <input type="submit" class="btn btn-primary float-right" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <?php 
        function readMoreHelper($story_desc, $chars, $id) {
            $base = base_url('admin/question_view/').$id;
            $story_desc = substr($story_desc,0,$chars);  
            $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
            $story_desc = $story_desc." <a href='".$base."'>Read More...</a>";  
            return $story_desc;  
        } 
        ?> 
    <script>
        function delete_lesson(id){
            var x = confirm('Do you want to delete this ?');
            if(x == true){
                window.location.href = '<?php echo base_url('admin/question_delete/'); ?>'+id;
            }
        }

        $('.adminChangestaus').on('click',function() {
            var set_no = $('#cset_no').val();
            if(set_no == ''){
                alert('Please Selct No of Question by Category for Exam.');
                $('#cset_no').focus();
                return false;
            }
            var id = $(this).attr("data-id");
            var status = $(this).attr('data-value');
            var ques_cat_id = $(this).attr('data-name');
            if(id > 0){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/admin_publish_question_bycategory'); ?>",
                    data: {id : id, status : status, ques_cat_id : ques_cat_id, set_no : set_no},
                    //processData: false,
                    //contentType: false,
                    dataType: 'json',
                    cache: 'false',
                    success: function(result){
                        console.log(result);
                        if(result.message=='success'){
                            $("#selectbtnid"+id).addClass("btn-warning");
                            $("#selectbtnid"+id).attr("disabled", true);
                            $("#selectbtnid"+id).html("Selected");
                            alert('Question selected successfully');
                        }
                        if(result.message == 'error'){
                            alert('You have achieved the maximum limit of adding questions in this category.');
                        }
                        if(result.message == 'exist'){
                            alert('You have already select this question.');
                        }
                    }
                });
            }
            // alert(status)
            /*$('#achangestatus').modal('show');
            $('#astatus').val(status);
            $('#aid').val(id);
            $('#aset_no').val(set_no);*/
        });

        $('.addquestionbycat').on('change',function() {
            var set_no = $('#cset_no').val();
            var sum = 0;
            if(set_no > 0){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/get_total_ques_by_category');?>",
                    data: {set_no : set_no},
                    dataType: 'json',
                    cache: 'false',
                    success: function(result){
                        for(var i=0; i<result.t_question.length; i++){
                            console.log(result.t_question[i]) ;
                            $("#esc_id"+i).val(result.t_question[i].esc_id);
                            $("#catid"+i).val(result.t_question[i].cat_id);
                            $("#cat"+i).val(result.t_question[i].total_question);

                            sum = parseInt(sum) + parseInt($("#cat"+i).val());
                            $("#totalmarks").val(sum); 
                        }
                    }
                });
            }
            //alert(sum);
            $('#set_noforcat').val(set_no);
            $('#QuesCatValueForm')[0].reset();
            
            $("#formerr").html('');
            $('#CategoriseQuestion').modal('show');
        });
        
    function validateform(){
        var totalmarks = parseInt($("#totalmarks").val());
        var catcount = <?= $catn ?>;
        var sum = 0;
        for(var i=0; i<catcount; i++){
            sum = parseInt(sum) + parseInt($("#cat"+i).val());
        }
        if(totalmarks != sum){
            $("#formerr").html('Number of questions should be equal of total question.');
            return false;
        }else{
            $("#formerr").html('');
            //alert('Ok');
            return true;
        }

    }

    </script>