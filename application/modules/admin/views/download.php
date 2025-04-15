<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
           <h4>Download Listing</h4>
			<div class="card-body">
					<a href="<?php echo base_url('admin/downloadedit');?>">Add New</a>
					<div class="table-responsive">

                    <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>File Name</th>
								<th>File</th>
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
								if(isset($cms->dowloadfile) && $cms->dowloadfile !=""){
									if(file_exists('./assets/images/download/'.$cms->dowloadfile)){
										$banner = '<img src="'.base_url().'assets/images/download/'.$cms->dowloadfile.'">';
									}
								}									
                            ?>
                            <tr>
                                <td><?php echo $cms->file_name; ?></td>
									<td><?php echo $banner; ?></td>
									<td><?php echo ($cms->status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('admin/downloadedit/'. $cms->dwnid, 'Edit'); ?>
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