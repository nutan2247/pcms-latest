<?php //print_r($listing);exit;
    $valid=$expired=$suspended=$revoked=$localpro=$fpro=$fproexam=0;
    if($listing){
        foreach($listing as $list){
            if($list->status == '1'){$valid++;}
            if($list->status == '2'){$expired++;}
            if($list->status == '3'){$suspended++;}
            if($list->status == '4'){$revoked++;}
            if($list->role == 'L'){$localpro++;}
            if($list->role == 'F'){$fpro++;}
            if($list->role == 'P'){$fproexam++;}
        }
    }
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?>
            
                <a class="btn btn-primary float-right" href="<?php echo site_url('admin/dashboard'); ?>"> Back</a>
            </h4>
            <div class="row">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-valid" role="tab" aria-controls="pills-all" aria-selected="true">Valid License(<?=$valid?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-expired" role="tab" aria-controls="pills-all" aria-selected="true">Expired License(<?=$expired?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-suspended" role="tab" aria-controls="pills-all" aria-selected="true">Suspended License(<?=$suspended?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-revoked" role="tab" aria-controls="pills-all" aria-selected="true">Revoked License(<?=$revoked?>) </a>
                    </li>
                    
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-localpro" role="tab" aria-controls="pills-all" aria-selected="true">Local Professionals(<?=$localpro?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-fpro" role="tab" aria-controls="pills-all" aria-selected="true">Foreign Professionals(without exam)(<?=$fpro?>) </a>
                    </li>
                    <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                        <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-froexam" role="tab" aria-controls="pills-all" aria-selected="true">Foreign Professionals(with exan)(<?=$fproexam?>) </a>
                    </li>
                </ul>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">


                <form name="searchform" method="get">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="text" name="name" class="form-control" value="<?php echo (isset($_GET['name']))?$_GET['name']:"" ?>" placeholder="Name">
                    </div>

                    <!--<div class="col-sm-2">
                        <select class="form-control" id="profession" name="profession"> 
                            <option value="">--Select Profession--</option>
                                <?php if(!empty($profession)){
                                foreach ($profession as $key => $value) {
                                    # code...
                                ?>
                            <option <?php echo (isset($_GET['profession']) && $_GET['profession']==$value->id)?"selected":"" ?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                <?php } } ?>
                        </select>
                    </div>-->
                    <div class="col-md-2">
                        <select name="month" id="month" class="form-control">
                            <option value="">Month</option>
                            <option value="1" <?php echo (isset($_GET['month']) && $_GET['month']== 1)?'selected':'';?>>January</option>
                            <option value="2" <?php echo (isset($_GET['month']) && $_GET['month']== 2)?'selected':'';?>>February</option>
                            <option value="3" <?php echo (isset($_GET['month']) && $_GET['month']== 3)?'selected':'';?>>March</option>
                            <option value="4" <?php echo (isset($_GET['month']) && $_GET['month']== 4)?'selected':'';?>>April</option>
                            <option value="5" <?php echo (isset($_GET['month']) && $_GET['month']== 5)?'selected':'';?>>May</option>
                            <option value="6" <?php echo (isset($_GET['month']) && $_GET['month']== 6)?'selected':'';?>>June</option>
                            <option value="7" <?php echo (isset($_GET['month']) && $_GET['month']== 7)?'selected':'';?>>July</option>
                            <option value="8" <?php echo (isset($_GET['month']) && $_GET['month']== 8)?'selected':'';?>>August</option>
                            <option value="9" <?php echo (isset($_GET['month']) && $_GET['month']== 9)?'selected':'';?>>September</option>
                            <option value="10" <?php echo (isset($_GET['month']) && $_GET['month']== 10)?'selected':'';?>>October</option>
                            <option value="11" <?php echo (isset($_GET['month']) && $_GET['month']== 11)?'selected':'';?>>November</option>
                            <option value="12" <?php echo (isset($_GET['month']) && $_GET['month']== 12)?'selected':'';?>>December</option>
                        </select>
                    </div>
                    <!--<div class="col-sm-2">
                        <select name="status" id="status" class="form-control">
                            <option  value="">Select Status</option>
                                <?php if(!empty($professional_status)){
                                    foreach ($professional_status as $key => $value) {
                                ?>
                                <option <?php echo (isset($where['status']) && $where['status']==$value['professional_status_id'])?"selected":"" ?> value="<?php echo $value['professional_status_id']?>"><?php echo $value['name']?></option>
                                <?php } } ?>
                        </select>
                    </div>-->
                    <div class="col-md-2">  
                        <input type="number" name="year" id="year" value="<?php echo (isset($_GET['year']))?$_GET['year']:'';?>" class="form-control" placeholder="Year" />
                    </div>
                    <!--<div class="col-sm-2">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Please select one</option>
                            <option <?php echo (isset($where['male']) && $where['gender']=='male')?"selected":"" ?> value="male">Male</option>
                            <option <?php echo (isset($where['gender']) && $where['gender']=='female')?"selected":"" ?> value="female">Female</option>
                        </select>
                    </div>-->
                    
                    <div class="col-md-2">
                        <input type="submit" name="submit" value="search" class="btn btn-primary">
                        
                    </div>
                    <div class="col-md-2">
                        <a href="<?=base_url('admin/registered_professional'); ?>" class="btn btn-warning" role="button">Reset</a>
                    </div>
                </div>
                </form>

            </div> <!-- end card for form-->
    <?php //echo '<pre>'; print_r($listing[1]);exit; 
        if(!empty($listing)){
            foreach($listing as $key => $list){
                if(!empty($list->certificate_no)){ $certificate = $list->certificate_no; }else{ $certificate ='--'; }
                if(!empty($list->license_no)){ $license = $list->license_no; }else{ $license =$list->licenseno; }
                $status='N/A';
                if($list->status=='0'){ $status = '<span class="text-danger">Pending</span>'; }
                else if($list->status=='1'){ $status = '<span class="text-success">Valid</span>'; } 
                else if($list->status=='2'){ $status = '<span class="text-danger">Expired</span>'; }
                else if($list->status=='3'){ $status = '<span class="text-secondary">Suspended</span>'; }
                else if($list->status=='4'){ $status = '<span class="text-primary">Revoked</span>'; }
                $expiry_at='N/A';
                if(isset($list->lic_expiry_date) && $list->lic_expiry_date != '0000-00-00'){
                    $expiry_at=date('M d,Y',strtotime($list->lic_expiry_date));}else{
                        $expiry_at=date('M d,Y',strtotime($list->expiry_at));  
                    }
                $issue_at='N/A';
                if(isset($list->lic_issue_date) && $list->lic_issue_date != '0000-00-00'){
                    $issue_at=date('M d,Y',strtotime($list->lic_issue_date));}else{
                        $issue_at=date('M d,Y',strtotime($list->payment_date));
                    }  
                $photo=($list->image !="" && file_exists('./assets/uploads/profile/'.$list->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$list->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/').'" width="200px" height="200px">';
                $allcommonArr[] = array(
                    'status'    => $list->status,
                    'role'      => $list->role,
                    'photo'     => $photo,
                    'fname'     => $list->fname,
                    'lname'     => $list->lname,
                    'surname'   => $list->surname,
                    'email'     => $list->username,
                    'licenseno' => $license,
                    'dateissue' => $issue_at,
                    'validity'  => $expiry_at,
                    'printstatus'    => $status,
                    'action'    => '<a href="'.base_url("admin/prof_detail_for_newstatus/").$list->user_id.'" target=""><i class="fas fa-eye"></i></a>
                                    <a class="viewlicense" title="License Card" href="javascript:void(0);" data-id="'.$list->refrence_code.'"><i class="fas fa-id-card"></i></a> 
                                    <a class="viewcertificate" title="Certificate of License" href="javascript:void(0);" data-id="'.$list->refrence_code.'"><i class="fas fa-certificate"></i></a> 
                                    <a href="'.base_url('admin/profession_profile_details/'.$list->user_id).'" alt="view profile" title="view profile" target="_blank"><i class="fas fa-user"></i></a>'
                );
            }
        }
    ?><!--<a href="javascript:void(0);" data-id="'.$list->user_id.'" class="viewdetails"><i class="fas fa-eye"></i></a>-->
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">
                <?php echo $this->session->flashdata('item');?>
                <div class="table-responsive">
                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    <?php 
                    if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } }?>

                        </tbody>

                    </table>

                </div>

            </div><!--end card body -->
        </div><!--end All tab -->
        <div class="tab-pane fade" id="pills-valid" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                               if($value['status']=='1'){
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end valid-->
        <div class="tab-pane fade" id="pills-expired" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                if($value['status']=='2'){  
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end expired-->
        <div class="tab-pane fade" id="pills-suspended" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                if($value['status']=='3'){
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end suspended-->
        <div class="tab-pane fade" id="pills-revoked" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                if($value['status']=='4'){
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end revoked-->
        <div class="tab-pane fade" id="pills-localpro" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                if($value['role']=='L'){
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end localpro-->
        <div class="tab-pane fade" id="pills-fpro" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                if($value['role']=='F'){
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end fpro-->
        <div class="tab-pane fade" id="pills-froexam" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered adminDT" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Date Issued</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($listing[0]);exit;
                        if(!empty($allcommonArr)){
                            $count = 1; 
                            foreach($allcommonArr as $key => $value){
                                if($value['role']=='P'){
                        ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$value['photo'];?></td>
                                <td><?=$value['fname'];?></td>
                                <td><?=$value['lname'];?></td>
                                <td><?=$value['surname'];?></td>
                                <td><?=$value['email'];?></td>
                                <td><?=$value['licenseno'];?></td>
                                <td><?=$value['dateissue'];?></td>
                                <td><?=$value['validity'];?></td>
                                <td><?=$value['printstatus'];?></td>
                                <td><?=$value['action'];?></td>

                            </tr>
                            <?php $count++; } } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end fproexam-->
            </div>
        </div>
    </main>
    



<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
    <div class="modal-body text-center">
      <!-- body -->
      <iframe src="" id="crtdetials" frameborder="0" style="width:100%;height:100%;min-height:630px"></iframe>
      <!-- end body -->
    </div>

    </div>
  </div>
</div> 

<div class="modal fade card-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-body">
      <!-- body -->
      <iframe src="" id="carddetials" frameborder="0" style="width:100%;height:100%;min-height:630px"></iframe>
      <!-- end body -->
    </div>
    </div>
  </div>
</div> 
<script>
    $(document).ready(function() {
        $('.adminDT').DataTable();
    });

    $( ".viewdetails" ).click(function() {
		$('#displaydetials').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/prodetailsforpopup",
				data: { schid : schid},
				success: function(data) {
					//alert(data);
					$('#displaydetials').html(data); 
				}
			});
			$('.viewdetails-modal').modal('show'); 
		}
	});
	  
    // $( ".viewcertificate" ).click(function() {
    // var docid = $(this).attr("data-id");
    // if(docid > 0){
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url();?>admin/registeredprofcertificate",
    //         data: { docid : docid},
    //         success: function(data) {
    //             //alert(data);
    //             $('#crtdetials').html(data); 
    //         }
    //     });
    //     $('.certificate-modal').modal('show'); 
    // }
    // });

    $(".viewcertificate").click(function() {
    var licenseno = $(this).attr("data-id");
        if(licenseno){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ licenseno +"cert.pdf";
            $('#crtdetials').attr('src',path); 
            $('.certificate-modal').modal('show'); 
        }else{
            alert('No license number found!');
        }
    });

    $(".viewlicense").click(function() {
    var licenseno = $(this).attr("data-id");
        if(licenseno){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ licenseno +"card.pdf";
            $('#carddetials').attr('src',path); 
            $('.card-modal').modal('show'); 
        }else{
            alert('No license number found!');
        }
    });
</script>