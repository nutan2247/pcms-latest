<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid">

            <h1 class="mt-4"><?php echo $page_title; ?></h1>

            

            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table mr-1"></i>

                    <?php echo $table_name; ?>
                    <a class="btn btn-primary" href="<?php echo site_url('admin/profession_listing'); ?>">Back</a>

                </div>

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

                