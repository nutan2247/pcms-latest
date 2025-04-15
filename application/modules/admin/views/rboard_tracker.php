<!-- Tracker data start -->
<?php   $subscription = $this->common_model->get_admin_subscription_details();
        $current_application = $this->common_model->get_online_application_count();

        if(isset($subscription->no_of_application) && $subscription->no_of_application == 0 && $subscription->subscription_id == 6){
            $no_of_applcation = 'Unlimited'; 
            $used_onlineapplication  = $current_application;
            $remaining_onlineapplication = 'Unlimited'; 
            $total_onlineapplication = $no_of_applcation; 
        }else{
            $no_of_applcation = $subscription->total_application;    
            $total_onlineapplication = $no_of_applcation;
            $used_onlineapplication  = $current_application;
            $remaining_onlineapplication = $total_onlineapplication - $used_onlineapplication;
        }

?>
<!-- Tracker data end -->

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    
<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">

    <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h2>

    <div class="card mb-4">

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row banner-count-desc d-flex">
                                <div class="col-sm-3 text-center border">
                                    <div class="icon-container"><?php echo $total_onlineapplication; ?></div>
                                    <h5>Subscription Package</h5>
                                </div>
                                <div class="col-sm-3 text-center border">
                                    <div class="icon-container"><?php echo $used_onlineapplication; ?></div>
                                    <h5>Used Online Application</h5>
                                </div>
                                <div class="col-sm-3 text-center border">
                                    <div class="icon-container"><?php echo $remaining_onlineapplication; ?></div>
                                    <h5>Remaining Online Application</h5>
                                </div>
                                <div class="col-sm-3 text-center border">
                                    <div class="icon-container" style="width: 100%;background:#43c300;margin: 10px 0;">
                                    <?php if($remaining_onlineapplication > 1){ 
                                            echo 'On Completion'; 
                                        } else { 
                                            echo 'Completed'; } ?>
                                    </div>
                                    <h5>Status</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box mt-5">
                    <div class="card-header">
                        Subscrition Log         
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subscription Package</th>
                                    <th scope="col">No of Application</th>
                                    <th scope="col">Purchase Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($subscrition_list) && $subscrition_list !=''){
                                    $count = 1;
                                    $sumAllapplication = 0;
                                    foreach($subscrition_list as $value){ 
                                        $sumAllapplication += $value->no_of_application; ?>
                                <tr>
                                    <th scope="row"><?=$count;?></th>
                                    <td><?=$value->subscription_name;?></td>
                                    <td><?=$value->no_of_application;?></td>
                                    <td><?=date('M d, Y',strtotime($value->added_on));?></td>
                                </tr>
                                <?php  $count++; } } ?>
                                </tbody>
                                </tfoot>
                                        <tr>
                                            <td></td>
                                            <th>Total</th>
                                            <th> <?=$sumAllapplication; ?> </th>
                                            <td></td>
                                        </tr>
                                </tfoot>
                            
                            </table>
                        </div>         
                    </div>
                </div>

            </div>

        </div>



        </div>

    </div> 

</div>

</main>

                





