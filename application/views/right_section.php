<div class="col-md-3 services">

	<div class="blog-categories">

		<a class="btn btn-primary" href="<?php echo base_url('school');?>" style="margin-bottom: 5px;">Accredited Schools</a>

		<a class="btn btn-success" href="<?php echo base_url('ceprovider');?>" style="margin-bottom: 5px;">

			Accredited CE Providers</a>

		<a class="btn btn-warning" href="<?php echo base_url('courses');?>" style="margin-bottom: 5px;">Accredited Online Courses</a>

		<a class="btn btn-info" href="<?php echo base_url('training');?>" style="margin-bottom: 5px;">Accredited Training Courses</a>

		 <a class="btn btn-primary" href="<?php echo base_url('professionals');?>" style="margin-bottom: 5px;">Registered Professionals</a>

	</div>

			<?php

				$catid = array();

				
if(is_array($newslistingrightside)?count($newslistingrightside):0){
				foreach($newslistingrightside as $newsrside){

					if(!in_array($newsrside->newscat_id,$catid)){

						echo '<span class="plasment-btn" href="#">'.$newsrside->news_category_name.'</span>';

						array_push($catid,$newsrside->newscat_id);

						echo '<div class="section-data">';

						foreach($newslistingrightside as $news){

							if($newsrside->newscat_id == $news->newscat_id){

								$banner = '';

								if(file_exists('./assets/images/newsmedia/'.$news->banner)){

									$banner = '<img class="img_div" src="'.base_url().'assets/images/newsmedia/'.$news->banner.'">';

								}

								echo ' <a href="'.base_url('news/'.$news->news_url).'">

										<div class="row">

											<div class="col-3">

												<div class="figure">

												'.$banner.'

												</div>

											</div>

											<div class="col-9">

												<h6>'.ucfirst($news->news_title).'</h6>

												<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date_format(date_create($news->new_date),'F d, Y').'</p>

												<p>'.substr(strip_tags($news->news_description),0,50).'...</p>

											</div>

										</div>

									</a>';

							}	

						}

						echo '</div>';

					}

				}
			}

				//print_r($catid);

			?>

            

        </div>