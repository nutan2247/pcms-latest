<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4"><?php echo $page_title; ?>
                <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-primary float-right" >Back</a>
            </h3>
                <div class="card mb-4">
                    <div class="card-header">
                        <form name="searchForm" method="get" >
                                <div class="row">
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">  
                                        <input type="number" name="day" id="day" class="form-control" placeholder="Day" value="<?php echo (isset($_GET['day']))?$_GET['day']:'';?>" min="1" max="31"/>
                                    </div>
                                    <div class="col-md-3">  
                                        <input type="number" name="year" id="year" value="<?php echo (isset($_GET['year']))?$_GET['year']:'';?>" class="form-control" placeholder="Year" />
                                    </div>
                                    <div class="col-md-3">  
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
                                                <th>S.no</th>
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Contact No.</th>
                                                <th>Name of Representative</th>
                                                <th>Position</th>
                                                <th>Type</th>
                                                <th>Accreditation Number</th>
                                                <th>Validity Date</th>
                                                <th>Date Issued</th>
                                                <th>Duration</th>
                                                <th>Reviewer</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if($listing){
                                            $count = 1; 
                                            foreach($listing as $key => $list){
                                                if($list->reviewer_status == 2){
                                                    $status= 'Rejected';
                                                }
                                                else if($list->reviewer_status == 1){
                                                    $status= 'Approved';
                                                }else{
                                                    $status= 'Pending';
                                                }
                                                $type = ($list->document_for == 'r')?'Renew':'New';
                                                $reviewerName = ($list->reviewer_id > 0)?$list->rev_firsname:'';
                                                $logo = ($list->company_logo !="" && file_exists('./assets/images/ce_provider/'.$list->company_logo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/'.$list->company_logo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/ce_provider/default-logo.png').'" width="200px" height="200px">';
                                             ?>
                                            <tr>
                                                <td><?=$count;?></td>
                                                <td class="dp-image"><?=$logo;?></td>
                                                <td><?=$list->business_name;?></td>
                                                <td><?=$list->address;?></td>
                                                <td><?=$list->email;?></td>
                                                <td><?=$list->phone;?></td>
                                                <td><?=$list->contact_person;?></td>
                                                <td><?=$list->designation;?></td>
                                                <td><?=$type;?></td>
                                                <td><?=$list->accreditation_no;?></td>
                                                <td><?=$list->expiry_at;?></td>
                                                <td><?=date("Y-m-d", strtotime($list->review_accept_date));?></td>
                                                <td><?=$list->renew_for;?></td>
                                                <td><?=$reviewerName;?></td>
                                                <td><?=$status;?></td>
                                                <!--<td><a href="<?php echo base_url('admin/acc_details/'.$list->doc_id); ?>" target="_blank"><i class="fas fa-eye"></i> </a>-->
                                                <td><a class="viewdetails" href="javascript:void(0);" data-id="<?=$list->doc_id?>" ><i class="fas fa-eye"></i></a>
                                                    <a class="viewcertificate" href="javascript:void(0);" data-id="<?php echo $list->reference_no; ?>"><i class="fas fa-id-card"></i></a></td>

                                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div> 

                    </div>

                </main>

    
<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
        <div class="modal-body text-center">
            <div id="crtdetials"></div>
        </div>
      <!-- end body -->
    </div>
  </div>
</div>  

        
    <script>
        $( ".viewcertificate" ).click(function() {
            var docid = $(this).data("id");
            if(docid != ''){
                path = "<?php echo base_url('assets/uploads/pdf/');?>"+ docid +'.pdf';
                iframe = '<iframe src="'+ path +'" id="crtdetials" frameborder="0" width="720" height="850"></iframe>'; 
                $('#crtdetials').html(iframe); 
                $('.certificate-modal').modal('show'); 
            }
          
        });

    $( ".viewdetails" ).click(function() {
		$('#displaydetials').html('Loading...'); 
		var schid = $(this).data("id");
		if(schid > 0){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/cepdetailsforpopup",
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