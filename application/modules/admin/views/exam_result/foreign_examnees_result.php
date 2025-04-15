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
            <h4 class="mt-4 mb-3"><?= $title; ?></h4>


            <div class="row">
				<?php echo $this->session->flashdata('item'); ?>	
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-pending" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <a href="<?=base_url('admin/foreign_examnees_result').'?id=1'?>" class="btn btn-<?=(isset($_GET['id']) && $_GET['id']==1)?'primary':'warning'; ?>">Latest</a>
                                    <a href="<?=base_url('admin/foreign_examnees_result').'?id=2'?>" class="btn btn-<?=(isset($_GET['id']) && $_GET['id']==2)?'primary':'warning'; ?>">Computer Based</a>
                                    <a href="<?=base_url('admin/foreign_examnees_result').'?id=3'?>" class="btn btn-<?=(isset($_GET['id']) && $_GET['id']==3)?'primary':'warning'; ?>">Paper Based</a>
                                </div>
                            </div>
                            <form action="<?=current_url();?>" method="get">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <select name="es_id" id="es_id" class="form-control" onchange="this.form.submit();">
                                        <option value="">Choose Previous exam date</option>
                                        <?php if(!empty($examsch)){
                                            foreach($examsch as $sch){ ?>
                                                <option value="<?=$sch->es_id?>" <?php echo (isset($_GET['es_id']) && $_GET['es_id']==$sch->es_id)?'selected':''; ?>><?=$sch->name_of_exam.' ('.date('d, M-Y',strtotime($sch->date)).')'; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Photo</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Surname</th>
                                            <th>Email</th>
                                            <th>Exam Code</th>
                                            <th>Exam Date & Time</th>
                                            <th>Venue</th>
                                            <th>Attendance</th>
                                            <th>Total Exam Questions</th>
                                            <th>Obtained Marks</th>
                                            <th>Percentage (%)</th>
                                            <th>Status</th>
                                            <th>Registration Code</th>
                                            <th>Date Issued</th>
                                            <th>Validity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php //$answer=explode(",",$result[0]->answers)
                                    //print_r($result[0]->answers);
                                    //$ans=json_decode($result[0]->answers);
                                    //foreach($ans as $a){
                                    //    echo $a->qid.'=>'.$a->ans.'<br>';
                                    //}
                                    //print_r($result[0]);exit;
                                    if(!empty($result)){
                                        $count = 1; 
                                        foreach($result as $key => $list){ 
                                        if($list->attendance == '1'){ $attendance = '<span class="text-success">Present</span>'; }elseif($list->attendance == '2'){ $attendance = '<span class="text-danger">Absent</span>'; }else{ $attendance = '<span class="text-warning">Pending</span>'; } 
                                        $date_time = date('F d,Y', strtotime($list->exam_date)).' & '.date('H:i A', strtotime($list->exam_start_time)); 
                                        $examdate = date('F d,Y', strtotime($list->exam_date));
                                        $photo = ($list->photo != "" && file_exists('./assets/uploads/profile/'.$list->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$list->photo).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">'; 
                                        $exam_start_time = date("H:i A",strtotime($list->exam_start_time));
                                        $type='';
                                        $registrationcode='N/A';
                                        $dateissue='N/A';
                                        $validity='N/A';
                                        if($list->exam_result == 'Pass'){
                                            $registrationcode=$list->registration_code;
                                            $dateissue=date('M d,Y',strtotime($list->added_on));
                                            $validity=date('M d,Y',strtotime($list->validity));
                                        }
                                        ?>
                                        <tr>
                                            <td><?=$count;?></td>
                                            <td class="dp-image"><?=$photo;?></td>
                                            <td><?=$list->fname;?></td>
                                            <td><?=$list->lname;?></td>
                                            <td><?=$list->name;?></td>
                                            <td><?=$list->email;?></td>
                                            <td><?=$list->exam_code;?></td>
                                            <td><?=$date_time;?></td>
                                            <td><?=$list->exam_venue;?></td>
                                            <td><?=$attendance;?></td>
                                            <td><?=$list->total_marks;?></td>
                                            <td><?=$list->obtained_marks;?></td>
                                            <td><?=$list->percentage;?></td>
                                            <td><?=$list->exam_result;?></td>
                                            <td><?=$registrationcode;?></td>
                                            <td><?=$dateissue;?></td>
                                            <td><?=$validity;?></td>
                                            <td><a href="javascript:void(0);" class="resultsend" data-id="<?= $list->exam_result; ?>" id="<?= $list->er_id; ?>" value="<?= $list->email; ?>" name="<?=$list->exam_name ?>" examdate="<?=$examdate?>" regcode="<?=$list->registration_code ?>" validity="<?=$list->validity ?>" time="<?=$exam_start_time?>" venue="<?=$list->exam_venue ?>" score="<?=$list->obtained_marks?>" per="<?=$list->percentage?>">Send Result</a>
                                                <a href="javascript:void(0);" class="resultview" data-id="<?= $list->id; ?>" data-type="<?= $list->user_type; ?>" >View Result</a>
                                            <?php if($list->exam_result == 'Pass'){?>
                                                <a class="viewcertificate" href="javascript:void(0);" data-id="<?php echo $list->pd_id; ?>" data-name="<?php echo $type; ?>"><i class="fas fa-id-card"></i></a>
                                            <?php } ?></td>
                                        </tr>

                                        <?php $count++; } }?>
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
    <div class="modal fade" id="sendExamResultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Send Result</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php echo form_open('admin/admin/send_exam_result'); ?>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label for="email">Examinee's Email</label>
                    <input type="text" readonly name="email" id="er_email" class=""form-control>
                    <input type="hidden" name="name" id="er_name">
                    <input type="hidden" name="examdate" id="er_examdate">
                    <input type="hidden" name="regcode" id="er_regcode">
                    <input type="hidden" name="validity" id="er_validity">
                    <input type="hidden" name="er_id" id="er_id">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label for="email">Exam Result</label>
                    <input type="text" readonly name="exam_result" id="er_exam_result" class=""form-control>
                </div>
            </div>
            <div class="row">
                <ul class = "list-group">
                    <li class="list-group-item">Title of Licensure Examination : <span id="exam_name"></span></li>
                    <li class="list-group-item">Date : <span id="exam_date"></span></li>
                    <li class="list-group-item">Time : <span id="exam_time"></span></li>
                    <li class="list-group-item">Venue : <span id="exam_venue"></span></li>
                    <li class="list-group-item">Score : <span id="exam_score"></span></li>
                    <li class="list-group-item">Percentage : <span id="exam_percentage"></span></li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
        <?php echo form_close()?>
        </div>
    </div>
    </div>

    <!-- Modal Exam Result View-->
    <div class="modal fade ExamResultModal view-result-modal" id="ExamResultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Result</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body" id="resultContent">
            <!--<div class="row">
                <div class="form-group">
                    <label for="email">Examinee's Email</label>
                    <input type="text" readonly name="email" id="er_email" class=""form-control>
                    <input type="hidden" name="name" id="er_name">
                    <input type="hidden" name="examdate" id="er_examdate">
                    <input type="hidden" name="regcode" id="er_regcode">
                    <input type="hidden" name="validity" id="er_validity">
                    <input type="hidden" name="er_id" id="er_id">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label for="email">Exam Result</label>
                    <input type="text" readonly name="exam_result" id="er_exam_result" class=""form-control>
                </div>
            </div>-->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        </div>
        
        </div>
    </div>
    </div>


<div class="modal fade certificate-modal certificat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
       
        <div id="crtdetials"></div>
      <!-- end body -->
    </div>
  </div>
</div>               

    <script>
        $('.resultsend').on('click',function(){
            var name = $(this).attr('name');
            var examdate = $(this).attr('examdate');
            var regcode = $(this).attr('regcode');
            var validity = $(this).attr('validity');
            var email = $(this).attr('value');
            var er_id = $(this).attr('id');
            var exam_result = $(this).attr('data-id');
            var time = $(this).attr('time');
            var venue = $(this).attr('venue');score
            var score = $(this).attr('score');
            var per = $(this).attr('per');

            $('#er_name').val(name);
            $('#er_examdate').val(examdate);
            $('#er_regcode').val(regcode);
            $('#er_validity').val(validity);
            $('#er_email').val(email);
            $('#er_exam_result').val(exam_result);
            $('#er_id').val(er_id);

            $('#exam_name').html(name);
            $('#exam_date').html(examdate);
            $('#exam_time').html(time);
            $('#exam_venue').html(venue);
            $('#exam_score').html(score);
            $('#exam_percentage').html(name);
            $('#exam_percentage').html(per);
            $('#sendExamResultModal').modal('show');
        });

        //$('.resultview').on('click',function(){
$( ".resultview" ).click(function() { 
    $('#resultContent').html('Loading...'); 
    var schid = $(this).data("id");
    var schtype = $(this).data("type");
    if(schid > 0){
    $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>admin/resultdataonpopup",
        data: { schid : schid,schtype : schtype},
        success: function(data) {
            //alert(schid);
            $('#resultContent').html(data); 
        }
    });
        $('.ExamResultModal').modal('show'); 
    }

});   
$( ".viewcertificate" ).click(function() {
    var docid = $(this).data("id");
    var type = $(this).data("name");
    // alert(docid +'*'+ type);
    if(docid > 0){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/prof_reg_certificate",
            data: { docid : docid, type : type},
            success: function(data) {
                // alert(data);
                $('#crtdetials').html(data); 
            }
        });
        $('.certificate-modal').modal('show'); 
    }
  
});     
    </script>