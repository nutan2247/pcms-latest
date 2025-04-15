<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('dashboard_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <?php if($get_terms){ ?>
                <div class="col-lg-9 col-md-8">
                
				    <div class="terms-scrl">

                        <h3><?php echo $get_terms->title;?></h3>
				        <?php echo $get_terms->discription;?>

                    </div>
				
				</div>
                <?php }else{
                    echo '<div class="col-lg-9 col-md-8">
                            <div class="terms-scrl">
                                <p class="text-danger">No Data!</p>
                            </div>
                          </div>';
                } ?>
            </div>
        </div>
    </section>