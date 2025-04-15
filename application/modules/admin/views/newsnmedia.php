<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid">
			<h3 class="mt-4">News & Media Listing (<?php echo count($cmss);?>)</h3>
           
			<div class="card-body">
					<!--<a href="<?php echo base_url('admin/newsnmediaedit');?>">Add New</a>-->
					<div class="table-responsive">
                    <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Title</th>
								<th>Url</th>
								<th>Description</th>
								<th>Photo</th>
								<th>Category</th>
								<th>Location</th>
								<th>Date Published</th>
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
									if(file_exists('./assets/images/newsmedia/'.$cms->banner)){
										$banner = '<img src="'.base_url().'assets/images/newsmedia/'.$cms->banner.'"  width="50" height="50">';
									}
								}									
                            ?>
                            <tr>
                                <td><?php echo $count++; ?>.</td>
                                <td><?php echo $cms->news_title; ?></td>
									<td><?php echo $cms->news_url; ?></td>
									<td><?php echo substr(strip_tags($cms->news_description), 0, 170); ?> ...</td>
									<td><?php echo $banner; ?></td>
									<td><?php echo $cms->news_category_name; ?></td>
									<td><?php echo ($cms->location=='m') ? '<span class="label label-success">Main</span>' : '<span class="label label-default">Right Side</span>'; ?></td>
									<td><?php echo $cms->new_date; ?></td>
									<td><?php echo ($cms->news_status) ? '<span class="label label-success">Published</span>' : '<span class="label label-default">Unpublised</span>'; ?></td>
									<td>
										<?php echo anchor('admin/newsmediaedit/'. $cms->news_id, '<i class="far fa-edit"></i>',array('title'=>'change status','alt'=>'change status')); ?> 
										<?php echo ($cms->news_status) ?anchor('news/'. $cms->news_url, '<i class="far fa-eye"></i>',array('target'=>'_blank','title'=>'view','alt'=>'view')):'--'; ?> 
										<a href="javascript:void(0);" onclick="detelenews(<?php echo $cms->news_id;?>);" alt="delete" title="delete"><i class="far fa-trash-alt"></i></a>
									</td>
                            </tr> 
                            <?php }
								

							}else{ echo'<tr><td colspan="8">No Data Founds!</td></tr>'; }?>
                        </tbody>
                    </table>
                </div>
				</div>
        </div>
    </main>
	<script>
		function detelenews(news_id){
		//alert(news_id); 
		//return false;
		var conf = confirm("Do you want to delete this ?");
		if (conf == true) {
			//var reviewer_id = <?php echo $this->session->userdata('login')['user_ID'];?>;
		   // alert(news_id+' * '+reviewer_id)
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('admin/deletenewsnmedia');?>",
				data: { news_id : news_id},
				success: function(data) {
					//alert(data);
					if(data>0){
						location.reload();
					}   
				}
			});
		}
	 }
	</script>