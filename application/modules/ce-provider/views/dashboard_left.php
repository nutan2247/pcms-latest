<?php $uri = $this->uri->segment(3); ?>
<div class="w-100">
	<a href="<?php echo base_url('ce-provider/ce_provider/dashboard');?>" class="btn-primary w-100 d-block border-0 p-2 text-center">Dashboard</a>
	<ul class="list-group mt-3">
		<li class="list-group-item <?php if($uri=='renewalhistory'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/renewalhistory');?>">CEP Accreditation History</a></li>
		<li class="list-group-item <?php if($uri=='onlinecourse'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/onlinecourse');?>">Application for Online Course Accreditation </a></li>
		<li class="list-group-item <?php if($uri=='trainingcourse'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/trainingcourse');?>">Application for Training Course Accreditation</a></li>
		<li class="list-group-item <?php if($uri=='accreditedoc'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/accreditedoc');?>">Accredited Online Course</a></li>
		<li class="list-group-item <?php if($uri=='accreditedtc'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/accreditedtc');?>">Accredited Training Course</a></li>
		<li class="list-group-item <?php if($uri=='purchaselist'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/purchaselist');?>">Purchase List</a></li>
		<li class="list-group-item <?php if($uri=='notification'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/notification');?>">Notification</a></li>
		<li class="list-group-item <?php if($uri=='tutorial'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/tutorial');?>">Tutorials</a></li>
		<li class="list-group-item <?php if($uri=='terms'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/terms');?>">Terms</a></li>
		<li class="list-group-item <?php if($uri=='editprofile'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/editprofile');?>">Edit Profile</a></li>
		<li class="list-group-item <?php if($uri=='changepassword'){ echo 'active';} ?>"><a class="text-dark" href="<?php echo base_url('ce-provider/ce_provider/changepassword');?>">Change Password</a></li>
		<!--<li class="list-group-item"><a class="text-dark" href="#">Setting</a></li> -->
		<li class="list-group-item <?php if($uri=='logout'){ echo 'active';} ?>"><a class="text-dark" href="<?echo base_url('login/logout');?>">Logout</a></li>
	  </ul>

</div>


<!-- The Modal -->
<div class="modal" id="cepViewPdf">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <iframe src="" id="pdfsrc" frameborder="0" width="600" height="850"></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="viewCourseCertificate">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ACCIREDITATION CERTIFICATE</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <iframe src="" id="certificatesrc" frameborder="0" width="600" height="850"></iframe>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
$('.viewPdf').on('click',function(){
    var id = $(this).attr('data-id');
    var path = '<?php echo base_url('assets/images/ce_provider/'); ?>'+id;  
    $('#pdfsrc').attr('src',path);
    $('#cepViewPdf').modal('show');
});

$('.viewAccCertificate').on('click',function(){
    var id = $(this).attr('data-id');
    var path = '<?php echo base_url('assets/uploads/pdf/'); ?>'+id;  
    $('#pdfsrc').attr('src',path);
    $('#viewCourseCertificate').modal('show');
});
</script>
