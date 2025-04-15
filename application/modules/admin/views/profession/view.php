
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

        <div class="clearfix">
            <h4 class="float-left mt-4 mb-3"><?php echo $page_title; ?></h4>
            <a class="btn btn-primary float-right  mt-4 mb-3" href="<?php echo base_url('admin/profession_listing');?>"> Back</a>
        </div>

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                             <div class="box">

                                <div class="box-body">

                                    <table class="table table-striped table-hover">

                                        <tbody>

                                            <tr>

                                                <th>Profession</th>

                                                <td><?php echo $view->name; ?></td>

                                            </tr>

                                            <tr>

                                                <th>Required Units</th>

                                                <td><?php echo $view->required_units; ?></td>

                                            </tr>
                                            <tr>

                                                <th>General Units</th>

                                                <td><?php echo $view->general_units; ?></td>

                                            </tr>
                                            <tr>

                                                <th>Specific Units</th>

                                                <td><?php echo $view->specific_units; ?></td>

                                            </tr>

                                            <tr>

                                                <th>Start Date</th>

                                                <td><?php echo $view->start_date; ?></td>

                                            </tr>

                                            <tr>

                                                <th>End Date</th>

                                                <td><?php echo $view->end_date; ?></td>

                                            </tr>

                                             

                                            <tr>

                                                <th>Status</th>

                                                <?php if($view->status==1){

                                                    $status = 'Active';

                                                }else{

                                                    $status = 'Inactive';

                                                } ?>

                                                <td><?php echo $status; ?></td>

                                                

                                            </tr> 

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                         </div>

          

                    </div>

                </div>

            </div> 

        </div>

    </main>

                