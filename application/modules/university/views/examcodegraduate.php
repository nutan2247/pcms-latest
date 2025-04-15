<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>

<section class="dashboard-contentpanel py-lg-5 py-3 ">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4">
				<?php $this->view('dashboard_left'); ?>
			</div>
			<div class="col-lg-9 col-md-8">
			<h3>Graduates and Exam Codes</h3>
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
						</div>                        
						<div class="rounded my-1 px-0 col-md-3">
							<button type="submit" class="letest-course-btn btn btn-light px-4"><i class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
							<a href="<?php echo base_url('university/university/examcodegraduate');?>"><button type="button" class="letest-course-btn btn btn-light px-4">Reset</button></a>
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
						<th>Exam Code</th>
						<th>Name of Examinee</th>
						<!--<th>Gender</th>-->
						<th>Date Issued</th>
						<th>Validity</th>
						<th>Action</th>
						<!--<th>Dateof Birth</th>
						<th>Profession</th>-->
					</tr>';
					foreach($grduatelistingarr as $gadarr){
						echo '<tr>';
						echo '<td>'.$count++.'.</td>';
						echo '<td><img src="'.base_url('assets/images/graduates/').$gadarr->photo.'" alt="'.$gadarr->student_name.' '.$gadarr->middle_name.' '.$gadarr->surname.'" width="60"></td>';
						echo '<td>'.$gadarr->examcode.'</td>';							
						echo '<td>'.$gadarr->student_name.' '.$gadarr->middle_name.' '.$gadarr->surname.'</td>';
						//echo '<td>'.$gadarr->gender.'</td>';
						echo '<td>'.date("M d, Y",strtotime($gadarr->date_issued)).'</td>';
						echo '<td>'.date('M d, Y', strtotime('+ 3 year', strtotime($gadarr->date_issued))).'</td>';
						//echo '<td>'.$gadarr->dob.'</td>';
						//echo '<td>'.$gadarr->collegeofname.'</td>';							
						//echo '<td><a href="'.base_url('university/university/graducateform/'.$gadarr->grad_id).'">Edit</a></td>';	
						echo '<td><a href="javascript:void(0);" data-id="'.$gadarr->grad_id.'" class="viewgraduatedetails"><i class="fa fa-eye"></i></a></td>';	
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