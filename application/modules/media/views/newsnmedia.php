<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
			<div class="clearfix">
				<h3 class="float-left">News & Media Listing</h3>
				<a class="btn btn-primary float-right" href="<?php echo base_url('media/newsnmediaedit');?>">Add Content</a>
			</div>
			
			<div class="card">
				<div class="card-body">
					<div style="text-align:right; margin-bottom:10px;">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Sl No.</th>
										<th>Title</th>
										<th>Category</th>
										<th>Location</th>
										<th>Url</th>
										<th>Description</th>
										<th>Banner</th>
										<th>Comments</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($cmss)>0){
									$count = 1; 
									$totalprocessingfee = 0;
									$totaltax = 0;
									$totalgross = 0;
									foreach($cmss as $cms){
									$banner = "";
									if(isset($cms->banner) && $cms->banner !=""){
										if(file_exists('./assets/images/newsmedia/'.$cms->banner)){
											$banner = '<img src="'.base_url().'assets/images/newsmedia/'.$cms->banner.'"  width="50" height="50">';
										}
									}	 ?>
									<tr>
										<td><?php echo $count++; ?>.</td>
										<td><?php echo $cms->news_title; ?></td>
										<td><?php echo $cms->news_category_name; ?></td>
										<td><?php echo ($cms->location=='m') ? '<span class="label label-success">Main</span>' : '<span class="label label-default">Right Side</span>'; ?></td>
											<td><?php echo $cms->news_url; ?></td>
											<td><?php echo substr(strip_tags($cms->news_description), 0, 170); ?> ...</td>
											<td><?php echo $banner; ?></td>
											<td><?php echo anchor('media/newscomments/'. $cms->news_id, $cms->total_comments,'target="_blank"'); ?></td>
											<td><?php echo ($cms->news_status) ? '<span class="label label-success">Published</span>' : '<span class="label label-default">Unpublished</span>'; ?></td>
											<td>
												<?php echo anchor('media/newsnmediaedit/'. $cms->news_id, 'Edit'); ?> | 
												<?php echo anchor('news/'. $cms->news_url, 'View','target="_blank"'); ?>
											</td>
									</tr> 
									<?php }
										

									}else{ echo'<tr>No Data Founds!</tr>'; }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </main>