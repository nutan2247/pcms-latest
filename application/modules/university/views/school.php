<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>
    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
				<div class="col-lg-12 col-md-12">
					 
						<form action="<?php echo base_url('university/university/school');?>" method="get" />
							<div class="row">
							<div class="col-lg-2 col-md-2">
								All (<?php echo count($schoollistingarr);?>)
							</div>
							<div class="col-lg-8 col-md-8">
								<input type="text" class="form-control" placeholder="Search School" name="search_key" value="<?php echo (isset($_GET['search_key']))?$_GET['search_key']:'';?>" />
							</div>
							<div class="col-lg-2 col-md-2">
								<button type="submit" class="btn btn-success text-uppercase">Search</button>
							</div>
							</div>
						</form>
					
				</div>
				<div class="col-lg-12 col-md-12" ><a style="float:right;" href="<?php echo base_url('university/university/schoolform');?>">Add New School</a></div> <br>
				<?php
					$message = $this->session->flashdata('item');
					if(isset($message)) {
					?>
					<div class="row"><div class="box-body col-md-12">
						<div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
					</div>
					</div>
					<?php } ?>
				<?php
					$count = 1; 
					if(count($schoollistingarr) > 0){
						echo '<div style="overflow-x:auto;"><table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>School Name</th>
							<th>Logo</th>
							<th>Website</th>
							<th>Address</th>
							<th>Contact Number</th>							
							<th>Email</th>
							<th>Contact Person</th>
							<th>Position</th>
							<th>Accreditation Number</th>
							<th>Date Issued</th>
							<th>Validity Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>';
						foreach($schoollistingarr as $gadarr){
							$logo = ($gadarr->logo != "")?'<img src="'.base_url('assets/images/school/'.$gadarr->logo).'" width="100" height="100">':'No logo';
							$status= 'Inactive';
							if($gadarr->active == 1){
								$status = 'Active';
							}
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$gadarr->school_name.'</td>';
							echo '<td>'.$logo.'</td>';
							echo '<td>'.$gadarr->website.'</td>';
							echo '<td>'.$gadarr->address.'</td>';
							echo '<td>'.$gadarr->contact_number.'</td>';
							echo '<td>'.$gadarr->email.'</td>';
							echo '<td>'.$gadarr->contact_person.'</td>';
							echo '<td>'.$gadarr->position.'</td>';
							echo '<td>'.$gadarr->accreditation_number.'</td>';
							echo '<td>'.$gadarr->date_issued.'</td>';
							echo '<td>'.$gadarr->validity_date.'</td>';
							echo '<td>'.$status.'</td>';
							echo '<td><a href="#">View</a>&nbsp;|&nbsp;<a href="'.base_url('university/university/schoolform/'.$gadarr->sch_id).'">Edit</a></td>';							
							echo '</tr>';
						}
						echo '</table></div>';
					}else{
						echo '<p style="text-align:center;font-weight:bold;">No School found.</p>';
					}
				?>
				
				</div>
            </div>
        </div>
    </section>