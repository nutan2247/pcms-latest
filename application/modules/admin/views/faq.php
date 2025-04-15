<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <h4>FAQ Listing (<?php echo count($faqs);?>)</h4>
			<div class="card">
			<div class="card-header">
				<div class="tabsfor-navigation">
					<nav class="nav nav-pills nav-justified">
					<a class="nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == ''){ echo 'active'; } ?>" aria-current="page" href="<?php echo current_url().'?catid=';?>">ALL</a>
					<a class="nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == '9'){ echo 'active'; } ?>" href="<?php echo current_url().'?catid=9';?>">LICENSURE</a>
					<a class="nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == '8'){ echo 'active'; } ?>" href="<?php echo current_url().'?catid=8';?>">EXAMINATION</a>
					<a class="nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == '7'){ echo 'active'; } ?>" href="<?php echo current_url().'?catid=7';?>">CONTINUING EDUCATION</a>
					</nav>
				<div>
			</div>
			<div class="card-body">
				<?php echo $this->session->flashdata('item'); ?>
					<!-- <a class="btn btn-primary float-right" style="margin-bottom:10px;" href="<?php echo base_url('admin/faqedit');?>">Add FAQ</a><br> -->
					<div class="table-responsive">

                    <table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>SN</th>
									<th>Category</th>
									<th>Title</th>
									<th>Description</th>
									<th>Postion</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
						<?php 
							$i=1;
							foreach ($faqs as $faq):
						?>
								<tr>
									<td><?php echo $i; ?>.</td>
									<td><?php echo $faq->category_name; ?></td>
									<td><?php echo $faq->faq_title; ?></td>
									<td><?php echo $faq->faq_description; ?></td>
									<td><?php echo $faq->faq_position; ?></td>
									<td><?php echo ($faq->faq_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('admin/faqedit/'. $faq->faq_id, '<i class="fas fa-edit"></i>'); ?> 
										<a href="<?php echo site_url('admin/faq_delete/').$faq->faq_id;?>"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this?')"> <i
                                            class="fas fa-trash"></i> </a>
									</td>
								</tr>
						<?php 
							++$i;
							endforeach;
						?>
							</tbody>
						</table>
                </div>
				</div>
        </div>
        </div>
    </main>