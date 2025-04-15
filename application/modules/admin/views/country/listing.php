		<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?php echo $page_title; ?></h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                        </ol> -->
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                <?php echo $table_name; ?>
                                <a class="btn btn-primary" href="<?php echo site_url('admin/add_country'); ?>"> Add Country</a>
                            </div>
                            <div class="card-body">
                                <?php echo $this->session->flashdata('item');?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Country Name</th>
                                                <th>ISO Code</th>
                                                <th>ISD Code</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                      <!--   <tfoot>
                                        </tfoot> -->
                                            
                                        <tbody>
                                            <?php if($countries){
                                            $count = 1; 
                                            foreach($countries as $key => $list){ 
                                                if($list['status']==1){
                                                    $status = 'Active';
                                                }else{
                                                    $status = 'Inactive';
                                                } 
                                             ?>

                                            <tr>
                                                <th><?=$count;?></th>
                                                <th><?=$list['countries_name'];?></th>
                                                <th><?=$list['countries_iso_code'];?></th>
                                                <th><?=$list['countries_isd_code'];?></th>
                                                <th><?=$status;?></th>
                                                <th>
                                                    <a href="<?php echo site_url('admin/add_country/').$list['countries_id'];?>" title="Edit"><i class="fas fa-edit"></i></a> 
                                                    <a href="<?php echo site_url('admin/country_view/').$list['countries_id'];?>" title="View"> <i class="fas fa-eye"></i> </a> 
                                                    <a href="<?php echo site_url('admin/country_delete/').$list['countries_id'];?>" title="Delete"> <i class="fas fa-trash"></i> </a></th>
                                            </tr>
                                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
                </main>
                