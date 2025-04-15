<script type="text/javascript">   var base_url = "<?php echo base_url(); ?>"; </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/revewier/revewer.js'); ?>"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="clearfix">
                <?php if(isset($reqforgoodstand) && $reqforgoodstand !=''){ $countuing = is_array($reqforgoodstand)? count($reqforgoodstand):0; }else{ $countuing = 0; } ?>
                <h4 class="float-left mt-4 mb-3"><?php echo $page_title.'('.$countuing.')'; ?></h4>
                <a class="btn btn-primary float-right mt-4 mb-3" href="javascript:history.back()"> Back</a>
            </div>
            
            <div class="card">
			    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Photo</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Refrence Number</th>
                                    <th>Application For</th>
                                    <th>Status</th>
                                    <th>Reviewer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                            if(!empty($reqforgoodstand)){ //print_r($receipient_information);exit;
                                $i = 1;
                                foreach ($reqforgoodstand as $key => $value) {
                                    if($value->reviewer_status==1){
                                        $appstatus = '<span class="text-success">Approved</span>';
                                    }elseif($value->reviewer_status==2){
                                        $appstatus = '<span class="text-danger">Rejected</span>';
                                    }else{
                                        $appstatus = '<span class="text-primary">Pending</span>';
                                    }
                                    $type = 'Request for Certificate of Good Standing';
                                    
                                    $reviewerName = ($value->reviewer_id > 0)?$value->rev_firsname:'--';
                                    $photo = ($value->image !="" && file_exists('./assets/uploads/profile/'.$value->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$value->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/').'" width="200px" height="200px">';
                            ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class="dp-image"><?=$photo;?></td>
                                            <td><?php echo $value->name; ?></td>
                                            <td><?php echo $value->fname; ?></td>
                                            <td><?php echo $value->lname; ?></td>
                                            <td><?php echo $value->email; ?></td>
                                            <td><?php echo $value->refrence_code; ?></td>
                                            <td><?php echo $type; ?></td>
                                            <td><?php echo $appstatus; ?></td>
                                            <td><?php echo $reviewerName; ?></td>
                                            <td>
                                                <!-- <a target="_blank" href="<?php echo site_url('license/landing/professional_license?user_view=').base64_encode($value->user_ID);?>" title="View"><i class="fas fa-eye"></i> </a> -->
                                                
                                                <!--<a target="" href="<?php echo $verify_url;?>" title="View Documents">View</a>-->
                                                <a href="javascript:void(0);" data-id="<?=$value->gs_id?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                                <a class="viewcertificate" title="Certificate of Good Standing" href="javascript:void(0);" data-id="<?php echo $value->refrence_code; ?>"><i class="fas fa-id-card"></i></a>

                                            </td>
                                        </tr>

                                        <?php $i++; } 
                                            } ?>
                                    </tbody>

                                </table>
							
							<?php echo '</div></div>';  
						?>
                </div>
            </div>		
               
    </main>
<div class="modal fade canditatesviewdetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">
      <!-- body -->
	   
		<div id="displaydetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div>
<div class="modal fade certificate-modal certificat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content text-center">
      <!-- body -->
      <div class="modal-body">
       <iframe src="" id="crtdetials" frameborder="0" width="720" height="850"></iframe>
        <!-- <div id="crtdetials"></div> -->
      </div>
      <!-- end body -->
    </div>
  </div>
</div>  

<script>

    $( ".viewdetails" ).click(function() {
		$('#displaydetials').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>reviewer/req_goodstand_forpopup",
				data: { schid : schid},
				success: function(data) {
					//alert(data);
					$('#displaydetials').html(data); 
				}
			});
			$('.canditatesviewdetails-modal').modal('show'); 
		}
	  
	});

    $( ".viewcertificate" ).click(function() {
        var refcode = $(this).attr("data-id");
        // alert(regcode);
        if(refcode){
            var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ refcode +".pdf";
            // alert(path);
            $('#crtdetials').attr('src',path); 
            $('.certificate-modal').modal('show'); 
        }else{
            alert('No registration number found!');
        }
    });
 </script>	
