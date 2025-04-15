<script type="text/javascript">    
    var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/revewier/revewer.js'); ?>"></script>
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
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
            <input type="hidden" name="reviewer_id" id="reviewer_id" value="">
            <div>
			<?php 
							if(is_array($listing)?count($listing):0 > 0){
								/*echo '<ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link active text-dark" data-toggle="tab"
                                    href="#all"><small>ALL</small></a>
                            </li>
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link text-dark" data-toggle="tab"
                                    href="#approval"><small>Approved(<?php echo !empty($approved_row_count)?$approved_row_count:"";?>)</small></a>
                            </li>
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link text-dark" data-toggle="tab"
                                    href="#pending"><small>Pending(<?php echo !empty($pending_row_count)?$pending_row_count:"";?>)</small></a>
                            </li>
                            <li class="nav-item border border-secondary rounded mx-1">
                                <a class="nav-link text-dark" data-toggle="tab"
                                    href="#disapproval"><small>Disapproval(0)</small></a>
                            </li>
                        </ul>';*/
		echo		'<div class="card-body">
                            <div class="table-responsive">';?>
								<table class="table table-bordered" id="dataTable_4" width="100%"
                                                cellspacing="0">




                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Photo</th>
                                                        <th>Name</th>
                                                        <th>Date of Birth</th>
                                                        <th>Gender</th>
                                                        <th>Email</th>
                                                        <th>Exam Code</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(!empty($listing))
                                                    {
                                                        $i = 1;
                                                        foreach ($listing as $list) {
                                                            if($list->reviewer_status == 2){
                                                                $status= 'Rejected';
                                                            }else if($list->reviewer_status == 1){
                                                                $status= 'Approved';
                                                            }else{
                                                                $status= 'Pending';
                                                            }
                                                            $reviewerName = ($list->reviewer_id > 0)?$list->rev_firsname:'';
                                                            $photo = ($list->image !="" && file_exists('./assets/uploads/profile/'.$list->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$list->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/').'" width="200px" height="200px">';
                                                          ?>    
                                                

                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td class="dp-image"><?=$photo;?></td>
                                                        <td><?php echo $list->fname.' '.$list->lname.' '.$list->name; ?></td>
                                                        <td><?=$list->dob;?></td>
                                                        <td><?=$list->gender;?></td>
                                                        <td><?=$list->email;?></td>
                                                        <td><?=$list->exam_code;?></td>
                                                        <td><?=$status;?></td>
                                                        <td><a href="javascript:void(0);" data-id="<?=$list->user_ID?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php $i++; } } ?>
                                                </tbody>

                                            </table>
							
							<?php echo '</div></div>'; 
									
								
							}else{
								echo 'No professional license available.';
							}
						?>
					
               
            </div>

        </div>

    </main>
<div class="modal fade viewdetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="displaydetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div>
<script>
function acceptprofessionalApplication(appid){
	//alert(appid); 
	//return false;
	var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
   // alert(appid+' * '+reviewer_id)
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>reviewer/reviewer/professionalassignedreviewer",
		data: { appid : appid,reviewer_id:reviewer_id },
		success: function(data) {
			//alert(data);
			if(data>0){
				alert('Reviewer assigned for professional.');
				location.reload();
			}   
		}
	});
 }
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
    $(document).ready(function() {
        $('#dataTable_4').DataTable();
    } );
 </script>	