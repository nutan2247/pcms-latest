<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8" style="height: 750px; overflow: scroll;">
				<h3><?php echo $get_terms->title;?></h3>
				<?php echo $get_terms->discription;?>
				
				</div>
            </div>
        </div>
    </section>