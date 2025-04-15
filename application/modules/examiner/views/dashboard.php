<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid mt-4 mb-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 ">
                        <span class="d-inline-block border-bottom pb-2 px-3">EXAMINER'S TRACKER</span>
                        </h4>
                        <p class="text-center"><?php echo date('F d, Y');?></p>                        
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                                <!-- <img src="<?php echo base_url('assets/images/reviewer_dp.jpg'); ?>" style="width: 150px; height: 150px;" > -->
                                <img src="<?php echo base_url('assets/uploads/examiner/').$details->photo; ?>" style="width: 150px; height: 150px;" >
                            </div>
                            <div class="col-md-6 mx-auto">
                                <?php // print_r($details);
                                $created_on = $details->created_on; ?>
                                <ul style="list-style-type:none;">
                                    <li><?php echo ucwords($details->first_name.' '.$details->last_name); ?></li>
                                    <li>Examiner</li>
                                    <li>Appointment date: <?php echo date('F d,Y',strtotime($details->created_on));?></li>
                                    <li>Validity: <?php echo date('F d,Y',strtotime(date("Y-m-d", strtotime($created_on)) . " + 365 day"));?></li>
                                </ul>
                            </div>
                            
                            <div class="col-md-3 mx-auto text-center">
                                <div class="a-box">
                                    <button type="button" class="btn btn-info px-5"><?php echo count($question_listing); ?></button>
                                    <p class="mt-2 upper-case">Total Examination Question Created</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        
        <div class="container-fluid">
            <h4 class="mt-4 mb-3">Question for Licensure Examination
            <a href="<?php echo base_url('examiner/add_question'); ?>" class="btn btn-info float-right">Add Question</a> </h4>
            <div class="row">
                
                <?php /*$uri = isset($_GET['set_no'])?$_GET['set_no']:''; */?>
                <?php $excat_id = isset($_GET['excat_id'])?$_GET['excat_id']:''; ?>
                <!--<div class="col-sm-8">
                    <div class="pb-3">
                        <a class="btn btn-info <?php/* if($uri == ''){ echo 'active bg-success'; }else{ echo 'bg-primary';} ?> text-center text-light" href="<?php echo base_url('examiner/dashboard');?>">All </a>
                        <?php foreach ($uniqueset as $key => $value) {  ?>
                            <a class="btn btn-info <?php if($uri == $value->set_no){ echo 'active bg-success'; }else{ echo 'bg-primary';} ?> text-center text-light" href="<?php echo base_url('examiner/dashboard/').'?set_no='.$value->set_no;?>">Exam on <?php echo $value->date; ?></a>
                        <?php } */?>
                    </div>
                </div>-->
                <div class="col-sm-4">
                    <form action="<?php echo base_url('examiner/dashboard');?>" method="GET">
                    <select name="excat_id" id="excat_id" class="form-control float-right" onchange="this.form.submit()">
                        <option value="">Select Question Category</option>
                        <?php if(count($ques_category > 0)){
                            foreach($ques_category as $list){ ?>
                                <option value="<?=$list->excat_id ?>" <?=($excat_id==$list->excat_id)?'selected':''?>><?=$list->category_name ?></option>
                        <?php } } ?>
                    </select>
                    </form>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        
                        <div class="card-body">
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
                                        <th>Date Created</th>
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

                                        if($value->status=='1'){
                                            $status = '<span class="text-info">Submitted</span>'; 
                                            $btndelete = 'display:none';
                                            $btnedit = 'display:none';
                                        }elseif($value->status=='2'){
                                            $status = '<span class="text-success">Publish</span>'; 
                                            $btndelete = 'display:none';
                                            $btnedit = 'display:none';
                                        }else{
                                            $status = '<span class="text-danger">Pending</span>'; 
                                            $btndelete = '';
                                            $btnedit = '';
                                        }
                                        ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <!--<td><?php/* echo $value->examdate; */?></td>-->
                                        <td><?php echo $value->category_name; ?></td>
                                        <td><?php echo $value->question_title; ?></td>
                                        <td><?php echo $value->answere1; ?></td>
                                        <td><?php echo $value->answere2; ?></td>
                                        <td><?php echo $value->answere3; ?></td>
                                        <td><?php echo $value->answere4; ?></td>
                                        <td><?php echo $value->correct_answere; ?></td>
                                        <td><?php echo $value->rationale; ?></td>
                                        <td><?php echo $value->added_by_name; ?></td>
                                        <td><?php echo date('F m,Y',strtotime($value->added_on)); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('examiner/question_view/'.$value->id); ?>" class="btn btn-info" title="View">
                                            <i class="fas fa-eye"></i> </a>
                                            <a href="<?php echo base_url('examiner/question_edit/'.$value->id); ?>" class="btn btn-info" title="Edit" style="<?php echo $btnedit; ?>">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" style="<?php echo $btndelete;?>" onclick="delete_lesson('<?php echo $value->id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                    <?php $i++; } } ?>
                                </tbody>

                            </table>
                        </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </main>