<?php 
$cmsid =  $cmsdetails['cms_id'];
	
	if($cmsdetails['banner']) {	
?>
<section class="cmshero-panel blog-heropanel <?php echo $cmsdetails['cms_url']; ?>"
	style="background-image: url(<?php echo base_url('assets/images/banner/'.$cmsdetails['banner']); ?>);display: block;">
	<div class="container">
		<div class="d-flex align-items-center about-bnr-content">
			<!-- <?php echo $cmsdetails['bannertext'];?> -->
		</div>
	</div>
</section>
<?php 
	} else { 
?>
<section class="cmshero-panel blog-heropanel blog-banner <?php echo $cmsdetails['cms_url']; ?>">
	<div class="container">
		<div class="cmshero-infobox">
			<h2 class="bannr-title bannr-title hero-samlltitle-black">
				<?php echo $cmsdetails['cms_title'];?>
			</h2>
		</div>
	</div>

</section>
<?php
		$message = $this->session->flashdata('item');
		if(isset($message)) {
			echo '<div class="box-body col-md-12"><div class="alert '.$message['class'].'">'.$message['message'].'</div></div>'; 
		}
		?>
<?php } ?> 
		<div class="container">
			<h2 class="heading-titles border-none mt-lg-5 mt-2 bg-secondary p-2 text-white"><?php echo $cmsdetails['cms_title']; ?></h2>
		</div>
<?php
	echo $this->session->flashdata('response');
	echo '<section class="aboutus-panel py-lg-5  py-4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="about-content">'.stripslashes($cmsdetails['cms_description']).'</div>
					</div>
				</div>
			</div>
		 </section>';
?>



