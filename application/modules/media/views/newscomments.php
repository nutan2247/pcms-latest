<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
			<h3 class="mt-4"><?php echo $page_title;?></h3>
           <div class="card-body">
					<div class="table-responsive">
                   
                            <?php if(count($cmss)>0){
								echo ' <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl.</th>
									<th>Name</th>
									<th>Email</th>
									<th>Comments</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
                            </tr>
                        </thead>
							<tbody>';
                                $count = 1; 
								foreach($cmss as $cms){
																	
                            ?>
                            <tr>
									<td><?php echo $count; ?>.</td>
									<td><?php echo $cms->name; ?></td>
									<td><?php echo $cms->email; ?></td>
									<td><?php echo stripslashes($cms->message); ?></td>
									<td><?php echo $cms->added_at; ?></td>
									<td><?php echo ($cms->status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?> </td>
									<td>
										<?php echo anchor('media/deletecomment/'. $cms->newscomt_id.'/'.$cms->news_id, 'Delete','onclick="return confirm(\'Are you sure you want to delete this comments ?\');"'); ?>
									</td>
                            </tr> 
                            <?php echo '</tbody>
                    </table>';
					}
								

							}else{ echo'<p>No Comments Founds!</p>'; }?>
                        
                </div>
				</div>
        </div>
    </main>