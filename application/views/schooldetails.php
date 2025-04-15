<?php $uniid =  $details['uniid'];
	
	if($details['college_logo']) {	
	$banner = 'default-logo.png';
	if(file_exists('./assets/images/university/'.$details['college_logo'])){
		$banner = $details['college_logo'];
	}
?>
<div class="rbd-courses">
	<div id="banner-grid" class="py-5 px-2 bg-red">
		<h2 class="text-center text-uppercase text-white">Accredited School Details </h2>
	</div>
<div class="container">
	<div class="row mt-md-5 mt-3 schooldtl">
		<div class="col-md-8">
		<!-- <section class="cmshero-panel blog-heropanel <?php echo $details['uniid']; ?>"
			style="background-image: url(<?php echo base_url('assets/images/university/'.$banner); ?>);display: block;">
			<?php //echo $details['bannertext'];?>
		</section> -->
		<section class="schooldtl-img <?php echo $details['uniid']; ?>">
			<img src="<?php echo base_url('assets/images/university/'.$banner); ?>" alt="">
			<?php //echo $details['bannertext'];?>
		</section>
				<?php 
					} else { 
				?>
			<section class="cmshero-panel blog-heropanel blog-banner <?php echo $details['uniid']; ?>">
				<div class="container">
					<div class="cmshero-infobox">
						<h1 class="bannr-title bannr-title hero-samlltitle-black">
							<?php echo ucwords($details['university_name']);?>
						</h1>
					</div>
				</div>

			</section>

			<?php
	}
	$status = ($details['status'])?'Valid':'';
	echo '
	<section class="dorne-listing-destinations-area section-padding-100-50">
	
		<div class="dorne-list-area-box">
		<h3 class="mb-4 univ-heading">'.ucwords($details['university_name']).'</h3>
		<p class="scuniversity"><b>Accreditation Number:</b><span> '.stripslashes($details['accreditation_no']).'</span></p>
		<p class="scuniversity"><b>Validity:</b> <span>'.date("M d, Y",strtotime($details['validity_date'])).'</span></p>
		<p class="scuniversity"><b>Status:</b>  <span>'.$status.'</span></p>
		<p class="scuniversity"><b>Accreditation Certificate:</b> <span><a class="viewcertificate viewcertificate-btn" href="javascript:void(0);"  data-name="'.$details['accreditation_number'].'">Click Here</a></span> </p> <br><br>
		
		<div class="scuniversity-content">
			<p class="scuniversity"><b>School Name:</b> <span>'.stripslashes(ucwords($details['university_name'])).'</span> </p>
			<p class="scuniversity"><b>College of:</b> <span>'.stripslashes(ucwords($details['name'])).'</span> </p>
			<p class="scuniversity"><b>Address:</b> <span>'.stripslashes($details['address']).'</span> </p>
			<p class="scuniversity"><b>Country:</b> <span> '.stripslashes($details['countries_name']).'</span></p>
			<p class="scuniversity"><b>Email:</b> <span>'.stripslashes($details['email']).'</span> </p>
			<p class="scuniversity"><b>Contact No.:</b>  <span>'.stripslashes($details['contact_no']).'</span></p>
			<p class="scuniversity"><b>Name of Representative:</b> <span> '.stripslashes($details['name_of_representative']).'</span></p>
			<p class="scuniversity"><b>Position:</b> <span> '.stripslashes($details['position']).'</span></p>
			<p class="scuniversity"><b>Business License No.:</b> <span> '.stripslashes($details['business_license_number']).'</span></p>
			<p class="scuniversity"><b>Validity:</b> <span>'.date("M d, Y",strtotime($details['validity_date'])).'</span> </p>
			<p class="scuniversity"><b>Issued By:</b> <span>'.$details['issued_by'].'</span> </p>
			<p class="scuniversity"><b>Accreditation No.:</b> <span>'.$details['accreditation_number'].'</span> </p>
			<p class="scuniversity"><b>Accreditation validity date:</b> <span> '.$details['accreditation_validity_date'].'</span></p>
			<p class="scuniversity"><b>Accreditation issued by:</b> <span> '.$details['accreditation_issued_by'].'</span></p>
		</div>
		</div>
	
	
	</section>
	';
	
	
?>		<div class="f-flex pb-4">
			<a  href="<?=base_url('school'); ?>" class="btn btn-primary">Back</a>
		</div>
		</div>
		<?php $this->view('right_section'); ?>
	</div>
</div>
</div>
<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- body -->

			<div id="crtdetials"></div>
			<!-- end body -->
		</div>
	</div>
</div>
<script>
	$(".viewcertificate").click(function () {
		var accr = $(this).data("name");
		if (accr != '') {
			var url = '<?php echo base_url("assets/uploads/pdf/"); ?>' + accr + '.pdf';
			// alert(url);
			var result = '<iframe src="' + url + '" width="100%" height="750" style="border:1px solid black;"></iframe>';
			$('#crtdetials').html(result);
			$('.certificate-modal').modal('show');
		}

	});
</script>