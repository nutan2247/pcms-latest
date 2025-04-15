<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('dashboard_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <?php if($get_tutorial){ ?>
                <div class="col-lg-9 col-md-8">
				<h3><?php echo $get_tutorial->title;?></h3>
				<p><?php echo $get_tutorial->discription;?></p>
				<?php
				if(strpos($get_tutorial->url, 'youtube') > 0){
                      $explodeurl = explode('=',$get_tutorial->url);
                      $urlstring = $explodeurl[1];
                      $url = substr($urlstring,0,11);
                     // $urlt = '<i class="fas fa-play"></i>';
                      //$btnclass = 'class="btn btn-danger"';
					echo '<p><iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$url.'" frameborder="0" allowfullscreen ></iframe></p>';  
                }
				if($get_tutorial->uploadvideo != ""){
                      
                     // $urlt = '<i class="fas fa-play"></i>';
                      //$btnclass = 'class="btn btn-danger"';
					echo '<p><iframe width="100%" height="315" src="'.$get_tutorial->uploadvideo.'" frameborder="0" allowfullscreen ></iframe></p>';  
                }
				?>
				
				</div>
                <?php }else{
                    echo '<div class="col-lg-9 col-md-8"><p class="text-danger">No Data!</p></div>';
                 } ?>
            </div>
        </div>
    </section>