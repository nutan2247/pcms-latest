<?php //echo '<pre>';print_r($details);?>

<div class="rbd-courses">
    <div id="banner-grid" class="py-5 px-2 bg-red mb-5">
        <h2 class="text-center text-uppercase text-white">CONTINUING EDUCATION PROVIDER details</h2>
    </div>
    <div class="container">
        <div class="row mt-md-5 mt-3">
            <div class="col-md-8">
				<?php if($details['company_logo']){
						$banner = '';
						if(file_exists('./assets/images/ce_provider/'.$details['company_logo'])){
							$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$details['company_logo'].'" style="height:179px;">';
						}
					}else{ echo 'Image Not Found!'; }
						?>
				<div class="news-img"><?= $banner; ?></div>
				<div class="dorne-list-area-box">
				<!-- <?php echo '<pre>'; print_r($details); ?> -->
						<h2><?= ucwords($details['business_name']); ?> </h2>
						<p><span>Address  :</span> <?= $details['address']; ?></p>
						<p><span>Country  :</span> <?= $details['countries_name']; ?></p>
						<p><span>Contact Person  :</span> <?= $details['contact_person']; ?></p>
						<p><span>Designation  :</span> <?= $details['designation']; ?></p>
						<p><span>E-mail  :</span> <?= $details['email']; ?></p>
						<p><span>Telephone  :</span> <?= $details['phone']; ?></p>
						<p><span>Accreditation_no  :</span> <?= $details['accreditation_no']; ?></p>
						<p><span>Issued Date  :</span> <?= date('M d, Y',strtotime($details['review_accept_date'])); ?></p>
						<p><span>Validity Date  :</span> <?= date('M d, Y',strtotime($details['expiry_at'])); ?></p>
					</div>
				<div class="f-flex pb-4">
					<a  href="<?=base_url('ceprovider'); ?>" class="btn btn-primary">Back</a>
				</div>	
            </div>
            <?php $this->view('right_section'); ?>
        </div>
    </div>
</div>