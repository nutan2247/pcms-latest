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

                                <a class="btn btn-primary" href="<?php echo site_url('admin/cep_add'); ?>"> Register CEP</a>

                            </div>

                            <div class="card-body">

                                <?php echo $this->session->flashdata('item');?>

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>S.No.</th>

                                                <th>Image</th>

                                                <th>Name</th>

                                                <th>Profession</th>

                                                <!-- <th>Gender</th>

                                                <th>Age</th>

                                                <th>Date of Birth</th> -->

                                                <th>Address</th>

                                                <th>Email</th>

                                                <th>Contact Person</th>

                                                <th>Contact Number</th>

                                                <th>Accreditation</th>

                                                <th>Date Issued</th>

                                                <th>Validity Date</th>

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

                                            $profession = $this->admin->get_row_array('tbl_profession','id',$list['profession'])['name'];

                                               $date1 = date('Y');

                                                $date2 = date('Y',strtotime($list['dob']));

                                                $age = ($date1 - $date2); 

                                                if($list['status']==1){

                                                    $status = 'Active';

                                                }else{

                                                    $status = 'Inactive';

                                                } 

                                                if($list['image']==""){
                                                    $image = 'No-image';
                                                }else{
                                                    $url = base_url('assets/images/dp/').$list['image'];
                                                    $image = '<img src="'.$url.'">';
                                                }


                                             ?>



                                            <tr>

                                                <th><?=$count;?></th>

                                                <th class="dp-image"><?=$image;?></th>

                                                <th><?=$list['name'];?></th>

                                                <th><?=$profession;?></th>

                                                <!-- <th><?=$list['gender'];?></th>

                                                <th><?=$age;?></th>

                                                <th><?=$list['dob'];?></th> -->

                                                <th><?=$list['address'];?></th>

                                                <th><?=$list['email'];?></th>

                                                <th><?=$list['contact_person'];?></th>

                                                <th><?=$list['contact_no'];?></th>

                                                <th><?=$list['accreditation'];?></th>
                                                
                                                <th><?=$list['issued_date'];?></th>

                                                <th><?=$list['validity_date'];?></th>

                                                <th><?=$status;?></th>

                                                <th>

                                                    <a href="<?php echo site_url('admin/cep_add/').$list['cep_ID'];?>" title="Edit"><i class="fas fa-edit"></i></a> 

                                                    <a href="<?php echo site_url('admin/cep_view/').$list['cep_ID'];?>" title="View"> <i class="fas fa-eye"></i> </a> 

                                                    <a href="<?php echo site_url('admin/cep_delete/').$list['cep_ID'];?>" title="Delete" onclick="return confirm('Are you sure you want to delete this?')"> <i class="fas fa-trash"></i> </a></th>


                                            </tr>

                                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div> 

                    </div>

                </main>

                