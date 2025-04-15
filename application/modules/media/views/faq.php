<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
			
			<div class="clearfix">
				<h4 class="float-left">FAQ Listing (<?php echo count($faqs);?>)</h4>
				<a class="btn btn-primary float-right" style="margin-bottom:10px;" href="<?php echo base_url('media/faqedit');?>">Add FAQ</a>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="tabsfor-navigation">
						<nav class="nav nav-pills nav-justified">
						<a class="btn btn-primary nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == ''){ echo 'active'; } ?>" aria-current="page" href="<?php echo current_url().'?catid=';?>">ALL</a>
						<a class="btn btn-primary mx-2 nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == '1'){ echo 'active'; } ?>" href="<?php echo current_url().'?catid=1';?>">LICENSURE</a>
						<a class="btn btn-primary nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == '2'){ echo 'active'; } ?>" href="<?php echo current_url().'?catid=2';?>">EXAMINATION</a>
						<a class="btn btn-primary mx-2  nav-link <?php if(isset($_GET['catid']) && $_GET['catid'] == '3'){ echo 'active'; } ?>" href="<?php echo current_url().'?catid=3';?>">CONTINUING EDUCATION</a>
						</nav>
					<div>
				</div>

				<div class="card-body">
					
					<div class="table-responsive">
						<?php echo $this->session->flashdata('item'); ?>
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
							<?php  $i=1;
								foreach ($faqs as $faq):
								if($faq->faq_page == 1):
									$cate = 'Licensure Page'; 
								elseif($faq->faq_page == 2):
									$cate = 'Examination Page'; 
								else: 
									$cate = 'Continuing Edu. Page'; 
								endif; ?>
								<tr>
									<td><?php echo $i; ?>.</td>
									<td><?php echo $cate; ?></td>
									<td><?php echo $faq->faq_title; ?></td>
									<td><?php echo $faq->faq_description; ?></td>
									<td><?php echo $faq->faq_position; ?></td>
									<td><?php echo ($faq->faq_status) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?></td>
									<td>
										<?php echo anchor('media/faqedit/'. $faq->faq_id, '<i class="fas fa-edit"></i>'); ?> 
										<a href="<?php echo site_url('media/faq_delete/').$faq->faq_id;?>"
										title="Delete"
										onclick="return confirm('Are you sure you want to delete this?')"> <i
											class="fas fa-trash"></i> </a>
									</td>
								</tr>
							<?php ++$i;
								endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

        </div>
    </main>