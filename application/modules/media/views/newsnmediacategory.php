<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
			<h3 class="mt-4">News & Media Category Listing</h3>
            
            <div class="card">
                <div class="card-body">
					<!-- <a href="<?php echo base_url('media/newsmediacatedit');?>">Add New Category</a> -->
					<?php if(count($cmss)>0){
						echo '<div class="table-responsive">
                    <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Category Name</th>
                                <th>Display Position</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>';
                                $count = 1; 
						        foreach($cmss as $cms){
																	
                            ?>
							<tbody>
                            
                            <tr>
                                <td><?php echo $count++; ?>.</td>
                                <td><?php echo $cms->news_category_name; ?></td>
                                <td><?php echo $cms->display_position; ?></td>
									<td><?php echo ($cms->news_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('media/newsmediacatedit/'. $cms->newscat_id, 'Edit'); ?>
									</td>
                            </tr> 
                            <?php }
								echo ' </tbody>
											</table>
										</div>';

							}else{ echo'<p>No Data Founds!</p>'; }?>
                       
				</div>
            </div>
        </div>
    </main>