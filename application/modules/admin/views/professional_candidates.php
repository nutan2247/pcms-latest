<?php //print_r($listing[0]);exit;?>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
        
        <div class="clearfix">
            <h4 class="mt-4 mb-3 float-left"><?php echo $page_title; ?></h4>
            <a class="btn btn-primary float-right mt-4 mb-3 " href="<?php echo site_url('admin/dashboard'); ?>"> Back</a>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="row">
                        <a href="<?php echo current_url().'?id='; ?>" class="btn btn-<?php if(!isset($_REQUEST['id']) || isset($_REQUEST['id']) && $_REQUEST['id'] == ''){ echo 'primary'; }elseif(isset($_REQUEST['id']) &&  $_REQUEST['id'] == ''){ echo 'primary'; }else{ echo 'warning'; } ?>">All (<span id="allcount">0</span>) </a>
                        <a href="<?php echo current_url().'?id=Local Professional'; ?>" class="btn btn-<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] =='Local Professional'){ echo 'primary'; }else{ echo 'warning'; } ?> mx-md-2">Local Professional (<span id="adcount">0</span>) </a>
                        <a href="<?php echo current_url().'?id=Foreign Professional (With Exam)'; ?>" class="btn btn-<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] =='Foreign Professional (With Exam)'){ echo 'primary'; }else{ echo 'warning'; } ?>">Foreign Professional (with Exam) (<span id="grcount">0</span>) </a>
                        <a href="<?php echo current_url().'?id=Foreign Professional (Without Exam)'; ?>" class="btn btn-<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] =='Foreign Professional (Without Exam)'){ echo 'primary'; }else{ echo 'warning'; } ?> mx-md-2">Foreign Professional (without Exam) (<span id="itcount">0</span>) </a>
                </div>   

            <!-- <form action="<?php echo base_url('admin/listing') ?>" method="POST">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="text" name="user_name" class="form-control" value="<?php echo (isset($where['name']))?$where['name']:"" ?>" placeholder="Name">
                    </div>

                    <div class="col-sm-4">
                        <select class="form-control" id="profession" name="profession"> 
                            <option value="">--Select Profession--</option>
                            <?php if(!empty($profession)){
                                    foreach ($profession as $key => $value) {
                                        # code...
                            ?>
                            <option <?php echo (isset($where['profession']) && $where['profession']==$value['id'])?"selected":"" ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php } } ?>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <select name="status" id="status" class="form-control">
                            <option  value="">Select Status</option>
                            <?php if(!empty($professional_status)){
                                    foreach ($professional_status as $key => $value) {
                            ?>
                            <option <?php echo (isset($where['status']) && $where['status']==$value['professional_status_id'])?"selected":"" ?> value="<?php echo $value['professional_status_id']?>"><?php echo $value['name']?></option>
                            <?php } } ?>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Please select one</option>
                            <option <?php echo (isset($where['male']) && $where['gender']=='male')?"selected":"" ?> value="male">Male</option>
                            <option <?php echo (isset($where['gender']) && $where['gender']=='female')?"selected":"" ?> value="female">Female</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <input type="submit" name="submit" value="search" class="btn btn-primary">
                    </div>
                
                </div>
            </form> -->

            </div>

            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>
                <?php $commonarr = array(); 
					if(isset($candidates_for_pr_added_by_admin) && $candidates_for_pr_added_by_admin != ''){
                        $adminCount = count($candidates_for_pr_added_by_admin);
                        foreach ($candidates_for_pr_added_by_admin as $key => $value) {
                        
                            $issue_at = date('M d,Y',strtotime($value->license_issued_date));
                            $expiry_at = date('M d,Y',strtotime($value->license_validity_date));
                            $dob = date('M d,Y',strtotime($value->dob));

                            if($value->added_by_admin == 'l'){
                                $comming_from = 'Local Professional';                         
                            }elseif($value->added_by_admin == 'p'){
                                $comming_from = 'Foreign Professional (With Exam)';                         
                            }else{
                                $comming_from = 'Foreign Professional (Without Exam)';                         
                            }

                            $commonarr[] = array(
                                'user_id'     => $value->user_ID,
                                // 'doc_id'   => $value->doc_id,
                                'type'        =>  $value->role,
                                'comming_from'=>  $comming_from,
                                'photo'       => $photo = ($value->image != "" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">',
                                'first_name'  => $value->fname,
                                'middle_name' => $value->lname,
                                'last_name'   => $value->name,
                                'fullname'    => $value->fname.' '.$value->lname.' '.$value->name,
                                'email'       => $value->email,
                                'dob'         => $dob,
                                'gender'      => $value->gender,
                                'reg_no'      => $value->registration_no,
                                // 'attendance'  => $value->attendance,
                                'license_no'  => $value->license_no,
                                // 'reviewer_status'   => $value->reviewer_status,
                                'issue_at'    => $issue_at,
                                'validity'    => $expiry_at,
                            );
                        }
                    }
					if(isset($candidates_for_pr_by_itself) && $candidates_for_pr_by_itself != ''){
                        $itselfCount = count($candidates_for_pr_by_itself);
                        foreach ($candidates_for_pr_by_itself as $key => $value) {
                            
                            $issue_at = date('M d,Y',strtotime($value->license_issued_date));
                            $expiry_at = date('M d,Y',strtotime($value->license_validity_date));
                            $dob = date('M d,Y',strtotime($value->dob));
                            
                            if($value->role == 'p'){
                                $comming_from = 'Foreign Professional (With Exam)';                         
                            }else{
                                $comming_from = 'Foreign Professional (Without Exam)';                         
                            }                            
                            $commonarr[] = array(
                                'user_id'     => $value->user_ID,
                                // 'doc_id'   => $value->doc_id,
                                'type'        => $value->role,
                                'comming_from'=> $comming_from,
                                'photo'     => $photo = ($value->image != "" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">',
                                'first_name' => $value->fname,
                                'middle_name'=> $value->lname,
                                'last_name'  => $value->name,
                                'fullname'   => $value->fname.' '.$value->lname.' '.$value->name,
                                'email'      => $value->email,
                                'dob'        => $dob,
                                'gender'     => $value->gender,
                                'reg_no'     => $value->registration_no,
                                // 'attendance'  => $value->attendance,
                                'license_no' => $value->license_no,
                                // 'reviewer_status'   => $value->reviewer_status,
                                'issue_at'   => $issue_at,
                                'validity'   => $expiry_at,
                            );
                        }
                    }

                    
                    if(isset($candidates_for_professional_registration_from_gradutes) && $candidates_for_professional_registration_from_gradutes !=''){
                        $graduateCount = count($candidates_for_professional_registration_from_gradutes);
                        foreach ($candidates_for_professional_registration_from_gradutes as $key => $value) {
                            $commonarr[] = array(
                                'user_id'       => $value->grad_id,
                                // 'doc_id'        => $value->grad_id,
                                'type'          => 'G', // this data is comming from Graduate table
                                'comming_from'  => 'Local Professional',
                                'photo'         => $photo = ($value->photo != "" && file_exists('./assets/images/graduates/'.$value->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/'.$value->photo).'" width="250px" >':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/default-logo.jpg').'" width="200px" height="200px">',
                                'first_name'    => $value->student_name,
                                'middle_name'   => $value->middle_name,
                                'last_name'     => $value->surname,
                                'fullname'      => $value->student_name.' '.$value->middle_name.' '.$value->surname,
                                'email'         => $value->email,
                                'dob'           => $value->dob,
                                'gender'        => $value->gender,
                                'reg_no'        => $value->registration_no,
                                // 'attendance'    => $value->attendance,
                                'license_no'    => 'N/A',
                                // 'review_accept_date'=> $value->reviewer_accept_date,
                                'issue_at'      => 'N/A',
                                'validity'      => 'N/A',
                            );   
                        }
					} ?>
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>last Name</th>
                                <!--<th>Username</th>-->
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Registration Code</th>
                                <th>Validity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    <?php if(!empty($commonarr)){
                        
                            $count = 1; 
                            $allCount = count($commonarr);
                            foreach($commonarr as $key => $list){ 
                                if(isset($_REQUEST['id']) && $_REQUEST['id']!='' && $_REQUEST['id'] == $list['comming_from']){ ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$list['photo'];?></td>
                                <td><?=$list['first_name'];?></td>
                                <td><?=$list['middle_name'];?></td>
                                <td><?=$list['last_name'];?></td>
                                <td><?=$list['dob'];?></td>
                                <td><?=$list['gender'];?></td>
                                <td><?=$list['email'];?></td>
                                <td><?=$list['comming_from'];?></td>
                                <td><?=$list['reg_no'];?></td>
                                <td><?=$list['validity']; ?></td>
                                <td>
                                    <a href="javascript:void(0);" data-id="<?=$list['user_id'] ?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                    <a class="viewcertificate" href="javascript:void(0);" data-id="<?php echo $list['reg_no']; ?>" data-name="<?php echo $list['comming_from']; ?>"><i class="fas fa-id-card"></i></a>
                            </tr>
                            <?php $count++; }
                            
                            if(isset($_REQUEST['id']) && $_REQUEST['id']==''){ ?>

                                <tr>
                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$list['photo'];?></td>
                                <td><?=$list['first_name'];?></td>
                                <td><?=$list['middle_name'];?></td>
                                <td><?=$list['last_name'];?></td>
                                <td><?=$list['dob'];?></td>
                                <td><?=$list['gender'];?></td>
                                <td><?=$list['email'];?></td>
                                <td><?=$list['comming_from'];?></td>
                                <td><?=$list['reg_no'];?></td>
                                <td><?=$list['validity']; ?></td>
                                <td>
                                    <a href="javascript:void(0);" data-id="<?=$list['user_id'] ?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                    <a class="viewcertificate" href="javascript:void(0);" data-id="<?php echo $list['reg_no']; ?>" data-name="<?php echo $list['comming_from']; ?>"><i class="fas fa-id-card"></i></a>
                            </tr>
                            <?php $count++;  } } } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>


<div class="modal fade certificate-modal certificat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <iframe src="" id="crtdetials" frameborder="0" width="720" height="850"></iframe>
        </div>
    <!-- end body -->
    </div>
  </div>
</div>  


<script>
//     $( ".viewcertificate" ).click(function() {
//     var docid = $(this).data("id");
//     var type = $(this).data("name");
//     // alert(docid +'*'+ type);
//     if(docid > 0){
//         $.ajax({
//             type: "POST",
//             url: "<?php echo base_url();?>admin/prof_reg_certificate",
//             data: { docid : docid, type : type},
//             success: function(data) {
//                 // alert(data);
//                 $('#crtdetials').html(data); 
//             }
//         });
//         $('.certificate-modal').modal('show'); 
//     }
  
// });
$( document ).ready(function() {
    var allCount = '<?php echo $allCount; ?>';
    var itCount = '<?php echo $itselfCount; ?>';
    var adCount = '<?php echo $adminCount; ?>';
    var grCount = '<?php echo $graduateCount; ?>';
    $('#allcount').html(allCount);
    $('#itcount').html(itCount);
    $('#adcount').html(adCount);
    $('#grcount').html(grCount);
});
$( ".viewcertificate" ).click(function() {
    var regcode = $(this).attr("data-id");
    var type = $(this).data("name");
    if(regcode){
        var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ regcode +".pdf";
        $('#crtdetials').attr('src',path); 
        $('#popuptitle').html(type); 
        $('.certificate-modal').modal('show'); 
    }else{
        alert('No registration number found!');
    }
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
</script>