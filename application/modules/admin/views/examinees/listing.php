<?php $commonarr = array(); 
    if(!empty($listing)){
        foreach($listing as $list){
            if($list['attendance']=='1'){ $status = '<span class="text-success">Present</span>'; }elseif($list['attendance']=='2'){ $status = '<span class="text-danger">Absent</span>'; }else{ $status = '<span class="text-warning">Pending</span>'; }
            $commonarr[] = array(
                'fname' => $list['student_name'],
                'lname' => $list['middle_name'],
                'name' => $list['surname'],
                'email' => $list['email'],
                'examcode' => $list['examcode'],
                'ref_code'=> $list['refrence_code'],
                'photo'=> $list['photo'],
                'type'=> 'g',
                'attendence' => $status,
            );
        }
    }
    if(!empty($prolist)){
        
        foreach($prolist as $list){
            if($list['attendance']=='1'){ $status = '<span class="text-success">Present</span>'; }elseif($list['attendance']=='2'){ $status = '<span class="text-danger">Absent</span>'; }else{ $status = '<span class="text-warning">Pending</span>'; }
            $commonarr[] = array(
                'fname' => $list['fname'],
                'lname' => $list['lname'],
                'name' => $list['name'],
                'email' => $list['email'],
                'examcode' => $list['exam_code'],
                'ref_code'=> $list['refrence_code'],
                'photo'=> $list['image'],
                'type'=> 'p',
                'attendence' => $status,
            );
        }
    }
?>
<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>

        <!-- <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active"><?php echo $page_title; ?></li>

            </ol> -->



        <div class="card mb-4">

            <div class="card-header">
                <div class="form-group row">
                    <div class="col-md-12">
                        <a href="<?php echo current_url(); ?>" class="btn btn-<?php if(isset($_GET['id']) && $_GET['id']=='p' || isset($_GET['id']) && $_GET['id']=='pp'){ echo'primary'; }else{ echo 'warning'; } ?>">All (<?=$totalgradexaminee + $totalproexaminee ?>)</a>
                        <a href="<?php echo current_url().'?id=p'; ?>" class="btn btn-<?php if(isset($_GET['id']) && $_GET['id']=='p'){ echo'warning'; }else{ echo 'primary'; } ?>">Local Graduates (<?=$totalgradexaminee ?>)</a>
                        <a href="<?php echo current_url().'?id=pp'; ?>" class="btn btn-<?php if(isset($_GET['id']) && $_GET['id']=='pp'){ echo'warning'; }else{ echo 'primary'; } ?>">Foreign Professionals (<?=$totalproexaminee ?>)</a>
                    </div>
                </div>
                <form action="<?=current_url();?>" method="get">
                <div class="form-group row">
                    <div class="col-md-6">
                        <select class="form-control" name="es_id" id="es_id" onchange="this.form.submit();">
                            <option value="">Select Exam date</option>
                            <?php if(!empty($examsch)){
                                foreach($examsch as $sch){ ?>
                                    <option value="<?=$sch->es_id?>" <?php echo (isset($_GET['es_id']) && $_GET['es_id'] == $sch->es_id)?'selected':''; ?>><?=$sch->name_of_exam.' ('.date('d, M-Y',strtotime($sch->date)).')'; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                </form>
            </div>

            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Surname</th>
                                <th>Examinee's email</th>
                                <th>Exam Code</th>
                                <th>Refrence Code</th>
                                <th>Attendance</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>
                            <?php if($commonarr){ //echo '<pre>';print_r($prolist);exit;
                                $count = 1; 
                                foreach($commonarr as $list){ 
                                    if($list['type']=='g'){
                                        $path = base_url('assets/images/graduates/').$list['photo'];
                                    }else{
                                        $path = base_url('assets/uploads/profile/').$list['photo'];
                                    }
                                   ?>
                            <tr>

                                <td><?=$count;?></td>
                                <td><img src="<?=$path;?>" alt="<?=$list['name'];?>" width="60"></td>
                                <td><?= $list['fname'];?></td>
                                <td><?= $list['lname'];?></td>
                                <td><?= $list['name'];?></td>
                                <td><?= $list['email'];?></td>
                                <td><?= $list['examcode'];?></td>
                                <td><?= $list['ref_code'];?></td>
                                <td><?= $list['attendence'];?></td>
                                <td><a href="#" data-id="<?= $list['examcode'];?>"  class="viewExamCode">Exam Pass</a></td>

                            </tr>

                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>

<div class="modal fade examCodeModal certificat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="popuptitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <!-- body -->
        <div class="modal-body text-center">
            <iframe src="" id="examcod" frameborder="0" width="720" height="850"></iframe>
        </div>
    <!-- end body -->
    </div>
  </div>
</div>  


<script>
    $( ".viewExamCode" ).click(function() {
        var examcode = $(this).attr("data-id");
        if(examcode){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ examcode +".pdf";
            $('#examcod').attr('src',path); 
            $('.examCodeModal').modal('show'); 
        }else{
            alert('No registration number found!');
        }
    });
</script>