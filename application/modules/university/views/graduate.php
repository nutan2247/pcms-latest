<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
                	<h3><?php echo $page_title;?></h3>
				<div class="row">	
				<div class="col-lg-12 col-md-12" ><a class="btn btn-danger" style="float:right; margin-bottom:5px;" href="<?php echo base_url('university/university/graducateform');?>">Add Graduates</a></div> 
				</div>
				<?php
				$message = $this->session->flashdata('item');
				if(isset($message)) {
				?>
				<div class="row">
				
				<div class="box-body col-md-12">
					<div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
				</div>
				</div>
				<?php } ?>
				<h5>For Submission (<?php echo is_array($grduatelistingarr)?count($grduatelistingarr):0;?>):</h5>
				
				<div class="row mt-1">
				<div class="col-md-12">
					<?php echo form_open('',array('id'=>'examgraduatesForm','method'=>'get')); ?>
					<div class="form-row row">
						<div class="my-1 col-md-1">
						<a href="<?php echo base_url(uri_string()).'?all=y'; ?>"><button type="button" class="letest-course-btn btn btn-light px-4">All</button></a>
						</div>
						<div class="my-1 col-md-3">
							
							<select class="form-control" id="graduate_date" name="graduate_date">
							<option value="">Select Graduation Date</option>
							<?php 
								foreach($grduatationdatearr as $grddate){
									$seltecdate = (isset($_GET['graduate_date']))?'selected':'';
									echo '<option value="'.$grddate->date_of_graduated.'" '.$seltecdate.'>'.date("M d, Y",strtotime($grddate->date_of_graduated)).'</option>';
								}
							?>
							</select>
						</div>
						<div class="my-1 col-md-5">
							<input type="text" class="form-control" id="name" name="name" value="<?php echo (isset($_GET['name']))?$_GET['name']:'';?>" placeholder="Enter Name of Graduate">
							<input type="hidden" name="for" value="g" >
						</div>                        
						<div class="rounded my-1 px-0 col-md-3">
							<button type="submit" class="letest-course-btn btn btn-light px-4"><i class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
							<a href="<?php echo base_url('university/university/graduate');?>"><button type="button" class="letest-course-btn btn btn-light px-4">Reset</button></a>
						</div>
					</div>
					</form>
				</div>
			</div>
				<?php
					$count = 1; 
					if($grduatelistingarr){
						echo '<table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Photo</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>School</th>
							<th>College of</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Date Graduated</th>
							<!--<th>Validity</th>
							<th>Exam Code</th>-->
							<th>Action</th>
						</tr>';
						foreach($grduatelistingarr as $gadarr){
							$photo = (file_exists('./assets/images/graduates/'.$gadarr->photo))?base_url('assets/images/graduates/'.$gadarr->photo):base_url('assets/images/user_icon.png');
							
							
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td><img src="'.$photo.'" width="100" height="80"/></td>';
							echo '<td>'.$gadarr->student_name.'</td>';
							echo '<td>'.$gadarr->middle_name.'</td>';
							echo '<td>'.$gadarr->surname.'</td>';
							echo '<td>'.$gadarr->name_of_school.'</td>';
							echo '<td>'.$gadarr->collegeofname.'</td>';
							echo '<td>'.date("M d, Y",strtotime($gadarr->dob)).'</td>';
							echo '<td>'.$gadarr->gender.'</td>';
							echo '<td>'.date("M d, Y",strtotime($gadarr->date_of_graduated)).'</td>';
							
							//echo '<td>'.$gadarr->validity.'</td>';
							//echo '<td>'.$gadarr->examcode.'</td>';
							echo '<td><a href="'.base_url('university/university/graducateform/'.$gadarr->grad_id).'" alt="edit" title="edit"><i class="fa fa-edit"></i></a> <a href="javascript:void(0);" data-id="'.$gadarr->grad_id.'" class="viewgraduatedetails" alt="view detail" title="view detail"><i class="fa fa-eye"></i> </a> <a href="'.base_url('university/university/delete_graducate/'.$gadarr->grad_id).'" onclick="return confirm(\'Do you want to delete this graduate ?\');" alt="delete" title="delete"><i class="fa fa-trash-o"></i> </a></td>';	
							echo '</tr>';
						}
						echo '</table>';
					}else{
						echo '<p style="text-align:center;">No data available</p>';
					}
				?>
				<h5>Submitted Graduates (<?php echo is_array($grduatelistingsubmitedcountarr) ? count($grduatelistingsubmitedcountarr):0;?>):</h5>
				<div class="row mt-1">
				<div class="col-md-12">
					<?php
						$all = 0;
						$approved = 0;
						$rejected = 0;
						if($grduatelistingsubmitedcountarr){
						foreach($grduatelistingsubmitedcountarr as $gadarr){
							$all += 1;
							if($gadarr->reviewer_status== 1){
								$approved += 1;
							}if($gadarr->reviewer_status== 2){
								$rejected += 1;
							}	
						}}
						$approvedactiveclass = '';
						$rejectedactiveclass = '';
						$allactiveclass = '';
						if(isset($_GET['tab']) && $_GET['tab'] == 'approved'){
							$approvedactiveclass = 'style="background-color:#315594; color: #fff;"';
						}
						else if(isset($_GET['tab']) && $_GET['tab'] == 'rejected'){
							$rejectedactiveclass = 'style="background-color:#315594; color: #fff;"';
						}else{
							$allactiveclass = 'style="background-color:#315594; color: #fff;"';
						}
					?>
					
					<a href="<?php echo base_url(uri_string()).'?tab=all'; ?>"><button type="button" class="letest-course-btn btn btn-light px-4" <?php echo $allactiveclass;?>>All (<?php echo $all;?>)</button></a>
					<a href="<?php echo base_url(uri_string()).'?tab=approved'; ?>"><button type="button" class="letest-course-btn btn btn-light px-4" <?php echo $approvedactiveclass;?>>Approved (<?php echo $approved;?>)</button></a>
					<a href="<?php echo base_url(uri_string()).'?tab=rejected'; ?>"><button type="button" class="letest-course-btn btn btn-light px-4" <?php echo $rejectedactiveclass;?>>Rejected (<?php echo $rejected;?>)</button></a>
				</div>
				<div class="col-md-12">
					<?php echo form_open('',array('id'=>'examgraduatesForm','method'=>'get')); ?>
					<div class="form-row row">
						<div class="my-1 col-md-4">
							
							<select class="form-control" id="graduate_date" name="graduate_date">
							<option value="">Select Graduation Date</option>
							<?php 
								foreach($grduatationsubmiteddatearr as $grddate){
									$seltecdate = (isset($_GET['graduate_date']))?'selected':'';
									echo '<option value="'.$grddate->date_of_graduated.'" '.$seltecdate.'>'.date("M d, Y",strtotime($grddate->date_of_graduated)).'</option>';
								}
							?>
							</select>
						</div>
						<div class="my-1 col-md-5">
							<input type="text" class="form-control" id="name" name="name" value="<?php echo (isset($_GET['name']))?$_GET['name']:'';?>" placeholder="Enter Name of Graduate">
							<input type="hidden" name="for" value="gs" >
						</div>                        
						<div class="rounded my-1 px-0 col-md-3">
							<button type="submit" class="letest-course-btn btn btn-light px-4"><i class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
							<a href="<?php echo base_url('university/university/graduate');?>"><button type="button" class="letest-course-btn btn btn-light px-4">Reset</button></a>
						</div>
					</div>
					</form>
				</div>
			</div>
				<?php
					$count = 1; 
					if($grduatelistingsubmitedarr){
						echo '<table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Photo</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last name</th>
							<th>School</th>
							<th>College of</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Date Graduated</th>
							<th>Date</th>
							<th>Status</th>
							<!--<th>Validity</th>
							<th>Exam Code</th>-->
							<th>Action</th>
						</tr>';
						foreach($grduatelistingsubmitedarr as $gadarr){
							$photo = (file_exists('./assets/images/graduates/'.$gadarr->photo))?base_url('assets/images/graduates/'.$gadarr->photo):base_url('assets/images/user_icon.png');
							if($gadarr->reviewer_status== 1){
								$status = '<span style="color:#155724;">Approved</span>';	
							}else if($gadarr->reviewer_status== 2){
								$status = '<span style="color:#bd2130;">Rejected</span>';	
							}else{
								$status = '<span style="color:#ff9007;">Pending</span>';	
							}
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td><img src="'.$photo.'" width="100" height="80"/></td>';
							echo '<td>'.$gadarr->student_name.'</td>';
							echo '<td>'.$gadarr->middle_name.'</td>';
							echo '<td>'.$gadarr->surname.'</td>';
							echo '<td>'.$gadarr->name_of_school.'</td>';
							echo '<td>'.$gadarr->collegeofname.'</td>';
							echo '<td>'.date("M d, Y",strtotime($gadarr->dob)).'</td>';
							echo '<td>'.$gadarr->gender.'</td>';
							echo '<td>'.date("M d, Y",strtotime($gadarr->date_of_graduated)).'</td>';
							echo '<td>'.date("M d, Y",strtotime($gadarr->reviewed_at)).'</td>';
							echo '<td>'.$status.'</td>';
							//echo '<td>'.$gadarr->validity.'</td>';
							//echo '<td>'.$gadarr->examcode.'</td>';
							echo '<td> <a href="javascript:void(0);" data-id="'.$gadarr->grad_id.'" class="viewgraduatedetails" alt="view detail" title="view detail"><i class="fa fa-eye"></i> </a></td>';	
							echo '</tr>';
						}
						echo '</table>';
					}else{
						echo '<p style="text-align:center;">No data available</p>';
					}
				?>
				</div>
            </div>
        </div>
    </section>
	<div class="modal fade viewgraduatedetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- body -->
	   
		<div id="grddetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div>	
	<script>
		$( ".viewgraduatedetails" ).click(function() {
		$('#grddetials').html('Loading...'); 
		var docid = $(this).data("id");
		if(docid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('university/university/graduatedetailsforpopup');?>",
				data: { docid : docid},
				success: function(data) {
					//alert(data);
					$('#grddetials').html(data); 
				}
			});
			$('.viewgraduatedetails-modal').modal('show'); 
		}
	  
	});
 </script>	