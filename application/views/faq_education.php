
<div class="rbrd-news-blog">
	<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
        <h2 class="text-center text-uppercase text-white">Continuing Education : guidelines and faq<small>s</small></h2>
    </div>

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
				<?php

					if($newslisting){
						$count =1 ;
						$allcount = count($newslisting);
						//$allcount = 2;
					foreach($newslisting as $news){ 
							$banner = '';
							if(file_exists('./assets/images/newsmedia/'.$news->banner)){
								$banner = '<img src="'.base_url().'assets/images/newsmedia/'.$news->banner.'">';
							}
							if($count == 1) { ?>
								<div class="col-md-8">
									<a href="<?=base_url('news/'.$news->news_url) ?>">
										<div class="plasment">
											<?=$banner?>
											<div class="plasment-content text-white">
												<p><?=$news->news_title ?></p>
											</div>
										</div>
									</a>
								</div>
							<?php }if($count == 2){ ?>
								<div class="col-md-4">
								<a href="<?=base_url('news/'.$news->news_url) ?>">
									<div class="team-pic mb-4">
										<?=$banner?>
										<p class="team-name text-white text-uppercase"><?=$news->news_title ?></p>
									</div>
								</a>
							<?php } if($count == 3) {  ?>
								<a href="<?=base_url('news/'.$news->news_url) ?>">
									<div class="team-pic mb-4">
										<?=$banner?>
										<p class="team-name text-white text-uppercase"><?=$news->news_title ?></p>
									</div>
								</a>
							</div>
							
							<?php } if($count > 3) { ?>
								<div class="col-4">
									<div class="newdate-main-box latestnews">
										<h1><a href="<?=base_url('news/'.$news->news_url) ?>"><?=$news->news_title ?></a></h1>
										<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span><?=date_format(date_create($news->new_date),'F d, Y')?></p>
										<a class="newdate-img" href="<?=base_url('news/'.$news->news_url) ?>"><div class="news-img"><?=$banner?></div></a>
										<p><?=substr(strip_tags($news->news_description),0,110)?></p>
									</div>
								</div>
					<?php } 
					$count++; 
					}//foreach end 
					if($allcount ==1) { ?>
						<div class="col-md-4">
							<a href="">
								<div class="team-pic mb-4">
									<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
									<p class="team-name text-white text-uppercase">'News Title</p>
								</div>
							</a>
						<!--<div>
						<div class="col-md-4">-->
							<a href="">
								<div class="team-pic mb-4">
									<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
									<p class="team-name text-white text-uppercase">'News Title</p>
								</div>
							</a>
						</div>
					
						<!--<div class="col-4">
							<div class="newdate-main-box latestnews">
								<h1><a href="">News Title</a></h1>
								<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
								<a class="newdate-img" href=""><div class="news-img"><img src="<?=base_url('assets/images/dummy/470x250.png')?>"></div></a>
								<p>News_description...</p>
							</div>
						</div>-->
					
					<?php }
					if($allcount == 2){ ?>
						<a href="">
								<div class="team-pic mb-4">
									<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
									<p class="team-name text-white text-uppercase">'News Title</p>
								</div>
							</a>
						</div>
					
						<!--<div class="col-4">
							<div class="newdate-main-box latestnews">
								<h1><a href="">News Title</a></h1>
								<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
								<a class="newdate-img" href=""><div class="news-img"><img src="<?=base_url('assets/images/dummy/470x250.png')?>"></div></a>
								<p>News_description...</p>
							</div>
						</div>-->
					<?php }
					if($allcount == 3){ ?>
						<!--<div class="col-4">
							<div class="newdate-main-box latestnews">
								<h1><a href="">News Title</a></h1>
								<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
								<a class="newdate-img" href=""><div class="news-img"><img src="<?=base_url('assets/images/dummy/470x250.png')?>"></div></a>
								<p>News_description...</p>
							</div>
						</div>-->	
					<?php }	
					}//if end
					else{ ?>
					<div class="col-md-8">
					<a href="">
						<div class="plasment">
							<img src="<?=base_url('assets/images/dummy/600x423.png')?>">
							<div class="plasment-content text-white">
								<p>Paragraph</p>
							</div>
						</div>
					</a>
					</div>
					<div class="col-md-4">
					<a href="">
						<div class="team-pic mb-4">
							<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
							<p class="team-name text-white text-uppercase">'News Title</p>
						</div>
					</a>
					<!--<div>
					<div class="col-md-4">-->
					<a href="">
						<div class="team-pic mb-4">
							<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
							<p class="team-name text-white text-uppercase">'News Title</p>
						</div>
					</a>
					</div>
					
					<!--<div class="col-4">
					<div class="newdate-main-box latestnews">
						<h1><a href="">News Title</a></h1>
						<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
						<a class="newdate-img" href=""><div class="news-img"><img src="<?=base_url('assets/images/dummy/470x250.png')?>"></div></a>
						<p>News_description...</p>
					</div>
					</div>-->
					<?php } ?>
				</div>
				<p style="font-size:25px;">Frequently Asked Questions </p>
				<div class="row mb-5">
					<div class="accordion" id="accordionExample">
						<?php if($faqlisting != '' ){ ?> 
						<div class="card">
							<?php	foreach($faqlisting as $key => $faq){ ?>
							<div class="card-header" id="<?php echo $key; ?>headingOne">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $key; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $key; ?>">
								<?php echo $faq->faq_title; ?>
								</button>
							</h2>
							</div>
							<div id="collapseOne<?php echo $key; ?>" class="collapse <?php if($key=='0'){ echo 'show'; }?>" aria-labelledby="<?php echo $key; ?>headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<?php echo $faq->faq_description; ?>
								</div>
							</div>
							<?php } ?>
						</div>
						<?php }else{ echo 'No data found!'; } ?>
						
					</div>
				</div>

			</div>		
			<?php $this->view('right_section'); ?>		
		</div>
	</div>
</div>
