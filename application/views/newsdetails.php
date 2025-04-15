<div class="container" style="padding-top:2px;">
		<div class="row">
		<div class="col-md-9">
<?php $newsid =  $newsdetails['news_id'];
	
	if($newsdetails['banner']) {	
?>
	<section class="cmshero-panel blog-heropanel <?php echo $newsdetails['news_url']; ?>" style="background-image: url(<?php echo base_url('assets/images/newsmedia/'.$newsdetails['banner']); ?>);display: block;">
        <?php //echo $newsdetails['bannertext'];?>
    </section>
<?php 
	} else { 
?>
	<section class="cmshero-panel blog-heropanel blog-banner <?php echo $newsdetails['news_url']; ?>">
		<div class="container"> <div class="cmshero-infobox"><h1 class="bannr-title bannr-title hero-samlltitle-black"><?php echo ucfirst($newsdetails['news_title']);?></h1></div></div>
		
    </section>
<?php
	}
	echo '<section class="dorne-listing-destinations-area section-padding-100-50">
	<div class="main-news-box">
		<div class="dorne-list-area-box">
		<h3>'.ucwords($newsdetails['news_title']).'</h3>
		<div style="text-align:center;width:100%;">
		<!-- AddToAny BEGIN -->
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style my-3">
		<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_email"></a>
		</div>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
		<!-- AddToAny END -->
		</div>
		<p class="newdate"><span class="w-auto"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date_format(date_create($newsdetails['new_date']),'F d, Y').'</p><p>'.$newsdetails['news_description'].'</p>
		</div>
	</div>
	</section>';
	?>
	<div class="comments">
		<h4 class="d-inline-block my-3">Comment</h4>
	</div>
	<?php
	$message = $this->session->flashdata('item');
	if(isset($message)) {
	?>
	<div class="box-body col-md-12">
		<div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
	</div>
	<?php } ?>
  <form action="<?php echo base_url('submitcomment');?>" method="post">
  <!-- Name input -->
  <div class="form-outline mb-4">
	<label class="form-label" for="name">Name *</label>
    <input type="hidden" id="news_id" name="news_id" value="<?php echo $newsdetails['news_id']; ?>" class="form-control" required />
    <input type="hidden" id="return_url" name="return_url" value="<?php echo $newsdetails['news_url']; ?>" class="form-control" required />
    <input type="text" id="name" name="name" class="form-control" required />
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="email">Email Address *</label>
    <input type="email" id="email" name="email" class="form-control" required />
  </div>

  <!-- Message input -->
  <div class="form-outline mb-4">
	<label class="form-label" for="message">Message *</label>
    <textarea class="form-control" id="message" name="message" rows="4" required ></textarea>
  </div>
 <!-- Submit button -->
  <button type="submit" class="btn btn-primary mb-4">Submit</button>
</form>
	<?php
	if(count($newscommentslisting) > 0){
		foreach($newscommentslisting as $newcnt){
			echo '<div class="col-12"><div style="border-bottom: 1px solid #9d9a9a;
    padding: 5px;">'.stripslashes($newcnt->message).'<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date_format(date_create($newcnt->added_at),'F d, Y').'</p></div></div>';
		}
	}
	echo '<div class="update-news" style="margin-bottom: 20px;">
	<div class="row">';
	foreach($newslisting as $news){
		$banner = '';
	if(file_exists('./assets/images/newsmedia/'.$news->banner)){
		$banner = '<img src="'.base_url().'assets/images/newsmedia/'.$news->banner.'" style="height:179px;">';
	}
	echo '
			<div class="col-4">
				<div class="newdate-main-box">
					<h1><a href="'.base_url('news/'.$news->news_url).'">'.ucfirst($news->news_title).'</a></h1>
					<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date_format(date_create($news->new_date),'F d, Y').'</p>
					<a class="newdate-img" href="'.base_url('news/'.$news->news_url).'"><div class="news-img">'.$banner.'</div></a>
					<p style="min-height: 70px;">'.substr(strip_tags($news->news_description),0,50).'...</p>
				</div>
		
			</div>';
	
}
echo '</div></div>';
?>
</div>
		
		<?php $this->view('right_section'); ?>
    </div>
</div>