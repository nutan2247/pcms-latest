		<div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid">

                    <div class="clearfix">
                        <h4 class="float-left mt-4 mb-3"><?php echo $page_title; ?></h4>
                        <a class="btn btn-primary float-right  mt-4 mb-3" href="<?php echo base_url('admin/dashboard');?>"> Back</a>
                    </div>

                        <div class="card">
                            <div class="card-header">
                                <a href="<?= base_url('admin/add_profession'); ?> ">Add New</a>
                            </div>

                            <div class="card-body">

                                <?php echo $this->session->flashdata('item');?>

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>S.No.</th>
                                                <th>Profession</th>
                                                <th>Required Units</th>
                                                <th>General Units</th>
                                                <th>Specific Units</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                      <!--   <tfoot>

                                        </tfoot> -->

                                            

                                        <tbody>

                                            <?php if($listing){

                                            $count = 1; 

                                            foreach($listing as $key => $list){ 

                                                if($list['status']==1){

                                                    $status = '<span class="btn btn-success">Active</span>';

                                                }else{

                                                    $status = '<span class="btn btn-danger">Inactive</span>';

                                                } 

                                             ?>



                                            <tr>

                                                <td><?=$count;?></td>

                                                <td><?=$list['name'];?></td>

                                                <td><?=$list['required_units'];?></td>
                                                <td><?=$list['general_units'];?></td>
                                                <td><?=$list['specific_units'];?></td>

                                                <td><?=$list['start_date'];?></td>

                                                <td><?=$list['end_date'];?></td>

                                                <td><?=$status;?></td>

                                                <td>

                                                    <a href="<?php echo site_url('admin/add_profession/').$list['id'];?>" title="Edit"><i class="fas fa-edit"></i></a> 

                                                    <a href="<?php echo site_url('admin/profession_view/').$list['id'];?>" title="View"> <i class="fas fa-eye"></i> </a> 

                                                    <a href="<?php echo site_url('admin/profession_delete/').$list['id'];?>" title="Delete"> <i class="fas fa-trash"></i> </a></td>

                                            </tr>

                                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div> 

                    </div>

                </main>

                