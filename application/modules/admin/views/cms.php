<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="clearfix">
                <h4 class="float-left mb-4 mt-4">CMS Listing</h4>
                <a class="btn btn-primary float-right mb-4 mt-4" href="<?php echo base_url('admin/cmsedit');?>">Add New</a>
            </div>
        <div class="card">
                <!-- <div class="card-header">
                    <a href="<?= base_url('admin/cmsedit'); ?> ">Add New</a>
                </div>	 -->
            <div class="card-body">
                <?php echo $this->session->flashdata('item');?>
                
					<div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>URL</th>
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
                                <td><?php echo $cms->cms_title; ?></td>
                                <td><?php echo $cms->cms_url; ?></td>
									<td><?php echo $banner; ?></td>
									<td><?php echo ($cms->cms_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('admin/cmsedit/'. $cms->cms_id, 'Edit'); ?>
                                        / <a href="<?=base_url('admin/cmsdelete/'.$cms->cms_id); ?>">Delete</a>
									</td>
                            </tr> 
                            <?php }
								

							}else{ echo'<tr>No Data Founds!</tr>'; }?>
                        </tbody>
                    </table>
                </div> <!--end table-->
                </div> <!--end card body-->
            </div><!--end card-->
        </div>
    </main>