<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <h3 class="mt-4 mb-3"><?php echo $page_title; ?>
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-primary float-right">Back</a>
        </h3>

        



        <div class="card mb-4">

            <div class="card-header">
                <form name="searchForm" method="get" >
                    <div class="row">
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
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>email</th>
                                <th>Exam Code</th>
                                <!-- <th>Refrence Code</th> -->
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if(!empty($listing)){
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
                                $photo = (isset($list->image) && $list->image !="" && file_exists('./assets/uploads/profile/'.$list->image))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/'.$list->image).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/uploads/profile/').'" width="200px" height="200px">';
                              ?>
                            <tr>

                                <td><?=$count;?></td>
                                <td class="dp-image"><?=$photo;?></td>
                                <td><?=$list->fname; ?></td>
                                <td><?=$list->lname; ?></td>
                                <td><?=$list->name;?></td>
                                <td><?=isset($list->dob)?$list->dob:'---- -- --';?></td>
                                <td><?= isset($list->gender)?$list->gender:'--';?></td>

                                <td><?=$list->email;?></td>
                                <td><?=$list->exam_code;?></td>
                                <!-- <td><?=$list->refrence_code;?></td> -->
                                <td><?=$status;?></td>
                                <td><a href="javascript:void(0);" data-id="<?=$list->user_ID?>" class="viewdetails"><i class="fas fa-eye"></i></a>
                                </td>
                                

                            </tr>

                            <?php $count++; } }?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>
<script>
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