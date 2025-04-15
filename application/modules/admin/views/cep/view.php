<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid">

            <h1 class="mt-4"><?php echo $page_title; ?></h1>

            

            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table mr-1"></i>

                    <?php echo $table_name; ?>

                    <a class="btn btn-primary" href="<?php echo site_url('admin/listing'); ?>"> Back to CEP Listing</a>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                             <div class="box">

                                <div class="box-body">

                                    <table class="table table-striped table-hover">

                                        <tbody>

                                            <tr>

                                                <th>Name</th>

                                                <td><?php echo $view->name; ?></td>

                                            </tr>

                                            <tr>

                                                <th>Profession</th>

                                                <td><?php echo $view->profession; ?></td>

                                            </tr>

                                            <!-- <tr>

                                                <th>Gender</th>

                                                <td><?php echo $view->gender; ?></td>

                                            </tr>

                                            <tr>

                                                <th>Age</th>

                                                <?php $date1 = date('Y');

                                                $date2 = date('Y',strtotime($view->dob));

                                                $age = ($date1 - $date2); ?>

                                                <td><?php echo $age; ?></td>

                                            </tr>   

                                            <tr>

                                                <th>Date of Birth</th>

                                                <td><?php echo $view->dob; ?></td>

                                            </tr>    --> 

                                            <tr>

                                                <th>Address</th>

                                                <td><?php echo $view->address; ?></td>

                                            </tr>   

                                            <tr>

                                                <th>Email</th>

                                                <td><?php echo $view->email; ?></td>

                                            </tr>    

                                            <tr>

                                                <th>Accreditation</th>

                                                <td><?php echo $view->accreditation; ?></td>

                                            </tr>    

                                            <tr>

                                                <th>Date Issued</th>

                                                <td><?php echo $view->issued_date; ?></td>

                                            </tr>
                                            <tr>

                                                <th>Validity Date</th>

                                                <td><?php echo $view->validity_date; ?></td>

                                            </tr>    

                                            <tr>

                                                <th>Contact Person</th>

                                                <td><?php echo $view->contact_person; ?></td>

                                            </tr>    

                                            <tr>

                                                <th>Contact Number</th>

                                                <td><?php echo $view->contact_no; ?></td>

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

                         <div class="col-md-6">
                            <table class="table table-striped table-hover">
                             <tr>
                                <th>Uploaded Image</th>
                                <td>
                                    <div class="dp-image-fit">
                                        <?php if($view->image != ""){ ?>
                                        <img src="<?php echo base_url('assets/images/dp/').$view->image; ?>">
                                    <?php }else{ echo'No-image!';} ?>
                                    </div>
                                </td>
                            </tr>
                            </table>
                         </div>

                    </div>

                </div>

            </div> 

        </div>

    </main>

                