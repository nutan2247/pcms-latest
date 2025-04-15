<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
           <h4>Banner Listing (<?php echo count($cmss);?>)</h4>
			<div class="card-body">
					<div style="text-align:right; margin-bottom:10px;"><a href="<?php echo base_url('admin/banneredit');?>"><button type="button" class="btn btn-primary btn-flat">Add Banner</button></a></div>
					<div class="table-responsive">

                    <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <!--<th>Banner Text</th>-->
                                <th>Display Position</th>
								<th>Banner</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>

                        <!--   <tfoot>

                            </tfoot> -->
                        <tbody>
                            <?php if(count($cmss)>0){
                                $count = 1; 
								foreach($cmss as $cms){
								$banner = "";
								if(isset($cms->banner) && $cms->banner !=""){
									if(file_exists('./assets/images/banner/'.$cms->banner)){
										$banner = '<img src="'.base_url().'assets/images/banner/'.$cms->banner.'" height="150">';
									}
								}									
                            ?>
                            <tr>
                                <td><?php echo $count++; ?>.</td>
                                <td><?php echo $cms->title; ?></td>
                                <td><?php echo $cms->sub_title; ?></td>
                                <!--<td><?php echo strip_tags($cms->bannertext); ?></td>-->
                                <td><?php echo $cms->display_position; ?></td>
									<td><?php echo $banner; ?></td>
									<td><?php echo ($cms->bnr_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('admin/banneredit/'. $cms->bnr_id, 'Edit'); ?>
									</td>
                            </tr> 
                            <?php }
								

							}else{ echo'<tr>No Data Founds!</tr>'; }?>
                        </tbody>
                    </table>
                </div>
				</div>
        </div>
    </main>