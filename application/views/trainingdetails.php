<!-- <?php $cor_doc_id =  $details['cor_doc_id'];
	if($details['course_image']) {	
		?>
			<section class="cmshero-panel blog-heropanel <?php echo $details['cor_doc_id']; ?>" style="background-image: url(<?php echo base_url('assets/images/ce_provider/'.$details['course_image']); ?>);display: block;">
				<?php //echo $details['bannertext'];?>
			</section>
		<?php 
			} else { 
		?>
			<section class="cmshero-panel blog-heropanel blog-banner <?php echo $details['cor_doc_id']; ?>">
				<div class="container"> <div class="cmshero-infobox"><h1 class="bannr-title bannr-title hero-samlltitle-black"><?php echo ucwords($details['course_title']);?></h1></div></div>
				
			</section>
		<?php
			}
			echo '<section class="dorne-listing-destinations-area section-padding-100-50">
			<div class="container">
				<div class="dorne-list-area-box">
				<h2>'.ucwords($details['course_title']).'</h2>
				<p>Unit(s): '.$details['course_units'].'</p>
				</div>
			</div>
			</section>';
		?> -->
		
		<div class="rbd-courses">
			<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
				<h2 class="text-center text-uppercase text-white">Accredited Coutinuing Education (CE) Training</h2>
			</div>
			<div class="container">
				<div class="row mt-md-5 mt-3">
					<div class="col-md-8">
						<?php if($details['training_image']){
								$banner = '';
								if(file_exists('./assets/images/ce_provider/'.$details['training_image'])){
									$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$details['training_image'].'" style="height:179px;">';
								}
							}else{ echo 'Image Not Found!'; }
								?>
						<div class="news-img"><?= $banner; ?></div>
						<div class="row">
							<div class="dorne-list-area-box">
								<h2><?= ucwords($details['training_title']); ?> </h2>
								<p><?= ucwords($details['description']); ?> </p>
								<p>Who can take this training : <?= $details['profession_name']; ?></p>
								<p>Accreditation No. : <?= $details['accreditation_no']; ?></p>
								<p>Validity Date : <?= date('F d,Y',strtotime($details['expiry_at'])); ?></p>
							</div>
						</div>
						<div class="row">
							<div class="dorne-list-area-box">
								<p>CE Provider : <?= $details['business_name']; ?></p>
								<p>Accreditation No. : <?= $provider['accreditation_no']; ?> </p>
								<p>Validity Date :<?= $provider['expiry_at']; ?> </p>
							</div>
						</div>
						<div class="f-flex pb-4">
							<a href="<?=isset($details['training_website_url'])?$details['training_website_url']:''; ?>" class="btn btn-warning">View Details</a>
							<a  href="<?=base_url('training'); ?>" class="btn btn-primary">Back</a>
						</div>
					</div>
					<?php $this->view('right_section'); ?>
				</div>
			</div>
		</div>