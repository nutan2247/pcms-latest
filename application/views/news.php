<div class="rbrd-news-blog">
<div class="container">
		<div class="row">
		<div class="col-md-12">
            <h4 class="d-inline-block my-3">LATEST NEWS</h4>
        </div>
		<div class="col-md-9">
            <div class="row">
                <?php if($newslisting){
				$count =1 ;
				$allcount = count($newslisting);
				foreach($newslisting as $news){ 
						$banner = '';
						if(file_exists('./assets/images/newsmedia/'.$news->banner)){
							$banner = '<img src="'.base_url().'assets/images/newsmedia/'.$news->banner.'">';
						}
						if($count == 1){?>
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
				} //foreach end
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
				}else{ ?>
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
        </div>		
		<?php $this->view('right_section'); ?>		
		<?php 

//print_r($newslisting); exit;

/* foreach($newslisting as $news){
		$banner = '';
	if(file_exists('./assets/images/newsmedia/'.$news->banner)){
		$banner = '<img src="'.base_url().'assets/images/newsmedia/'.$news->banner.'" style="height:179px;">';
	}
	echo '
			<div class="col-4">
				<div class="newdate-main-box">
					<h1><a href="'.base_url('news/'.$news->news_url).'">'.$news->news_title.'</a></h1>
					<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date_format(date_create($news->new_date),'F d, Y').'</p>
					<a class="newdate-img" href="'.base_url('news/'.$news->news_url).'"><div class="news-img">'.$banner.'</div></a>
					<p>'.substr(strip_tags($news->news_description),0,110).'...</p>
				</div>
		
			</div>';
	
} */ ?>
</div>
		</div>
</div>