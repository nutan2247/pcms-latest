<?php //echo '<pre>';print_r($details);exit;?>
<div class="rbd-courses">
    <div id="banner-grid" class="py-5 px-2 bg-red mb-5">
        <h2 class="text-center text-uppercase text-white">PROFESSIONAL details</h2>
    </div>
    <div class="container">
        <div class="row mt-md-5 mt-3">
            <div class="col-md-8">
				<?php if($details['image']){
						$banner = '';
						if(file_exists('./assets/uploads/profile/'.$details['image'])){
							$banner = '<img src="'.base_url().'assets/uploads/profile/'.$details['image'].'" style="height:179px;">';
						}
					}else{ echo 'Image Not Found!'; }
						?>
				<div class="news-img"><?= $banner; ?></div>
				<div class="dorne-list-area-box">
					<h2><?= ucwords($details['fname'].' '.$details['lname'].' '.$details['name']); ?> </h2>
					<p><span>Profession  :</span> <?= $details['profession_name']; ?></p>
					<p><span>Date Registered  :</span> <?= date('M d, Y',strtotime($details['added_on'])); ?></p>
					<p><span>Citizenship  :</span> <?= $details['countries_name']; ?></p>
				</div>
				<div class="f-flex pb-4">
			<a  href="<?=base_url('professionals'); ?>" class="btn btn-primary">Back</a>
		</div>
            </div>
            <?php $this->view('right_section'); ?>
        </div>
    </div>
</div>