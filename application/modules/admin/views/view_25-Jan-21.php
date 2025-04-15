<div id="layoutSidenav_content">







    <main>

        <div class="container-fluid">



            <h4 class="mt-4 mb-3">View Online Application</h4>



            <div class="card mb-4"></div>



            <div class="row border-bottom border-primary">



                <div class="col-md-12 mx-auto v-div">



                    <div class="row mt-3 pb-3">



                        <div class="col-md-9">



                            <div class="row">



                                <div class="col-md-2">

                                    <?php
                                        if(!empty($view->image))
                                        {
                                    ?>

                                    <div class="border border-primary"><img

                                            src="<?php echo base_url('assets/images/profile/').$view->image; ?>"

                                            width="100%"></div>

                                        <?php } ?>

                                </div>



                                <div class="col-md-8">



                                    <h4><?php echo (!empty($view)?$view->name:""); ?>

                                    </h4>



                                    <p><b>Profession:</b>

                                        <?php echo (!empty($view)?$view->pro_name:""); ?><br><b>License

                                            No:</b>

                                        <?php echo (!empty($view)?$view->license_no:""); ?><br><b>Validity:</b>



                                        <?php echo (!empty($view)?date('M,d,Y',strtotime($view->license_validity_date)):""); ?>

                                    </p>



                                </div>



                            </div>



                        </div>



                        <div class="col-md-3 float-right">



                            <div class="text-center">



                                <div class="bg-success p-1">



                                    <h4 class="text-light mb-0"><?php echo count_down($view->license_validity_date); ?></h4>



                                    <p class="text-light mb-0">Days Remarking</p>



                                </div>



                                <p class="font-weight-bold text-center my-2 ">VALIDITY COUNTER</p>


                                <?php
                                    if(!empty($professional_status))
                                    {
                                        foreach ($professional_status as $key => $value) {
                                            # code...
                                        // btn-warning
                                            if($value['professional_status_id']==$view->status){
                                                $status_class = 'btn-warning';
                                            }else{
                                                $status_class = '';
                                            }
                                ?>
                                <button type="button" class="btn <?php echo $status_class; ?>"><?php echo $value['name']; ?></button>
                            <?php } } ?>


                            </div>



                        </div>



                    </div>



                </div>



            </div>



            <div class="row mt-3">



                <div class="col-md-4">



                    <div class="text-center">



                        <a target="_blank"

                            href="<?php echo site_url('license/landing/professional_license?user_view=').base64_encode($view->user_ID);?>"><button

                                type="button" class="btn btn-primary">Renewal History</button></a>



                    </div>



                </div>



                <!-- <div class="col-md-4">



                    <div class="text-center">



                        <button type="button" class="btn btn-secondary">Details</button>



                    </div>



                </div> -->



                <div class="col-md-4">



                    <!-- <div class="text-center">



                        <button type="button" class="btn btn-secondary">Pre-Registration Data</button>



                    </div> -->



                </div>



            </div>



            <div>



                <div class="card-body mt-2">



                    <div class="table-responsive">



                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">



                            <div class="row">



                                <div class="col-sm-12">



                                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">





                                        <div class="row">



                                            <div class="col-sm-12">



                                                <table class="table table-bordered dataTable no-footer" id="dataTable"

                                                    width="100%" cellspacing="0" role="grid"

                                                    aria-describedby="dataTable_info" style="width: 100%;">



                                                    <thead>

                                                        <tr>

                                                            <th>S.no</th>

                                                            <th>Date Applied</th>

                                                            <th>Date Approved</th>

                                                            <th>Required Units</th>

                                                            <th>Submitted Certifictes.</th>

                                                            <th>Amount</th>

                                                            <th>Receipt</th>

                                                            <th>Action</th>

                                                        </tr>

                                                    </thead>



                                                    <!--   <tfoot> </tfoot> -->

                                                    <tbody>

                                                        <?php

                                                    if(!empty($payment_details))

                                                    {

                                                        $i = 1;

                                                        foreach ($payment_details as $key => $value) {

                                                          

                                                ?>



                                                        <tr>

                                                            <td><?php echo $i; ?></td>

                                                            <td><?php echo date('m/d/Y',strtotime($value['added_on'])); ?>

                                                            </td>

                                                            <td><?php echo date('M,d,Y',strtotime($value['issue_date'])); ?>

                                                            </td>

                                                            <td><?php echo $value['units']; ?></td>

                                                            <td><?php echo $value['certificate_id']; ?></td>

                                                            <td><?php echo $value['amount']; ?></td>

                                                            <td><?php echo $value['license_no']; ?></td>







                                                            <td><a target="_blank" href="<?php echo site_url('license/landing/professional_license?user_view=').base64_encode($view->user_ID);?>" title="View">

                                                                    <i class="fas fa-eye"></i> </a></td>

                                                        </tr>



                                                        <?php $i++; } } ?>

                                                    </tbody>



                                                </table>



                                            </div>



                                        </div>





                                    </div>



                                </div>



                            </div>







                        </div>



                    </div>



                </div>







            </div>







        </div>



</div>



</div>



</div>







</main>