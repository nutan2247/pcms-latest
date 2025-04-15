

<div class="rbd-courses">
    <div id="banner-grid" class="py-5 px-2 bg-red mb-5">
        <h2 class="text-center text-uppercase text-white">Accredited Coutinuing Education (CE) Course</h2>
    </div>
    <div class="container">
        <div class="row mt-md-5 mt-3">
            <div class="col-md-8">
				<?php if($details['course_image']){
						$banner = '';
						if(file_exists('./assets/images/ce_provider/'.$details['course_image'])){
							$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$details['course_image'].'" style="height:179px;">';
						}
					}else{ echo 'Image Not Found!'; }
						?>
				<div class="news-img"><?= $banner; ?></div>
				<div class="dorne-list-area-box">
						<h2><?= ucwords($details['course_title']); ?> </h2>
						<p><?=ucwords($details['description']);?></p>
						<p><span>Who can take this course :</span> <?= $details['profession_name']; ?></p>
						<p><span>CE Units :</span> <?= $details['course_units']; ?></p>
						<p><span>Accreditation No. :</span> <?= $details['accreditation_no']; ?></p>
						<p><span>Validity Date :</span> <?= date('F d,Y',strtotime($details['expiry_at'])); ?></p>
					</div>
					<div class="dorne-list-area-box">
						<p><span>CE Provider :</span> <?= $details['business_name']; ?></p>
						<p><span>Accreditation No. :</span> <?=$provider['accreditation_no'];?></p>
						
						<p><span>Validity Date : </span><?=$provider['expiry_at'];?> </p>
					</div>
				<div class="f-flex pb-4">
					<a href="<?=isset($details['training_website_url'])?$details['training_website_url']:''; ?>" class="btn btn-warning">View Details</a>
					<a  href="<?=base_url('courses'); ?>" class="btn btn-primary">Back</a>
				</div>
            </div>
            <?php $this->view('right_section'); ?>
        </div>
    </div>
</div>