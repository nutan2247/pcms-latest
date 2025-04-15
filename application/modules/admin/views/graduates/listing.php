		<div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid">
						<h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
                        <div class="card mb-4">
                            <div class="card-header">
                                <form name="searchForm" method="get" >
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="uniid" id="uniid" class="form-control">
                                            <option value="">University</option>
                                            <?php foreach($getuniversityArr as $uni){
                                                $selected = (isset($_GET['uniid']) && $_GET['uniid']== $uni->uniid)?'selected':'';
                                                echo '<option value="'.$uni->uniid.'" '.$selected.'>'.$uni->university_name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="sch_id" id="sch_id" class="form-control">
                                            <option value="">School</option>
                                            <?php foreach($getschoolArr as $uni){
                                                $sselected = (isset($_GET['sch_id']) && $_GET['sch_id']== $uni->sch_id)?'selected':'';
                                                echo '<option value="'.$uni->sch_id.'" '.$sselected.'>'.$uni->school_name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
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
                                    <div class="col-md-2">  
                                        <input type="number" name="day" id="day" class="form-control" placeholder="Day" value="<?php echo (isset($_GET['day']))?$_GET['day']:'';?>" min="1" max="31"/>
                                    </div>
                                    <div class="col-md-2">  
                                        <input type="number" name="year" id="year" value="<?php echo (isset($_GET['year']))?$_GET['year']:'';?>" class="form-control" placeholder="Year" />
                                    </div>
                                    <div class="col-md-1">  
                                        <button type="submit" value="search" class="btn btn-primary">Search</button>
                                    </div>
                                </div></form>
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
                                                <th>Last Name</th>
                                                <th>Date of Birth</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Name of School</th>
                                                <th>Date Graduated</th>
                                                <th>Exam Code</th>
                                                <th>Date issued</th>
                                                <!--   <th>Date Applied</th>-->
												<th>Validity</th>
                                                <th>Action</th> 
                                            </tr>

                                        </thead>

                                      <!--   <tfoot>

                                        </tfoot> -->
                                        <tbody>
                                            <?php if($listing){
                                            $count = 1; 
                                            foreach($listing as $key => $list){
												if($list->reviewer_status == 2){
                                                    $status= 'Rejected';
                                                }else if($list->reviewer_status == 1){
                                                    $status= 'Approved';
                                                }else{
                                                    $status= 'Pending';
                                                }
                                                $reviewerName = ($list->reviewer_id > 0)?$list->rev_firsname:'';
                                                $photo = ($list->photo !="" && file_exists('./assets/images/graduates/'.$list->photo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/'.$list->photo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/graduates/default-logo.png').'" width="200px" height="200px">';
                                             ?>
											<tr>
                                                <td><?=$count;?></td>
                                                <td class="dp-image"><?=$photo;?></td>
                                                <td><?=$list->student_name;?></td>
                                                <td><?=$list->middle_name;?></td>
                                                <td><?=$list->surname;?></td>
                                                <td><?=$list->dob;?></td>
												<td><?=$list->gender;?></td>
                                                <td><?=$list->email;?></td>
                                                <td><?=$list->name_of_school;?></td>
                                                <td><?=$list->date_of_graduated;?></td>
                                                <td><?=$list->examcode;?></td> 
                                                <td><?=$list->updated_at;?> </td>
                                               <!--<td><?=$list->reviewer_accept_date;?></td> -->
												<td><?=date('d M, Y', strtotime('+ 3 year', strtotime($list->date_issued)));?></td>
                                                <td><a href="javascript:void(0);" data-id="<?=$list->grad_id;?>" class="viewgraduatedetails"><i class="fas fa-eye"></i> </a></td>
												
                                            </tr>
                                            <?php $count++; } }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
					</main>

 <div class="modal fade viewgraduatedetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
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
				url: "<?php echo base_url();?>admin/graduatedetailsforpopup",
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