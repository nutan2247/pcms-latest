<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('professional_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <?php if(count($get_terms) > 0){ ?>
                <div class="col-lg-9 col-md-8" style="height:750px; overflow:scroll;">
				    <h3><?php echo $get_terms->title;?></h3>
				    <?php echo $get_terms->discription;?>
				
				</div>
                <?php } else {
                    echo '<div class="col-lg-9 col-md-8" style="height:750px; overflow:scroll;"><p>No Data!</p></div>';
                } ?>
            </div>
        </div>
    </section>