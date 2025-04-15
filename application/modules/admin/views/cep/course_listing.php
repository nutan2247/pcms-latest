		<div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid">

                        <h3 class="mt-4"><?php echo $page_title; ?></h3>

                        <!-- <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>

                        </ol> -->

                        

                        <div class="card mb-4">

                            <div class="card-header">

                                <i class="fas fa-table mr-1"></i>

                                <?php echo $table_name; ?>

                                <!-- <a class="btn btn-primary" href="<?php echo site_url('admin/cep_add'); ?>"> Register CEP</a> -->

                            </div>

                            <div class="card-body">

                                <?php echo $this->session->flashdata('item');?>

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>S.No.</th>

                                                <!-- <th>Image</th> -->

                                                <th>User Email</th>

                                                <th>Course Title</th>

                                                <th>Unit</th>

                                                <th>Price</th>

                                                <th>Tax</th>

                                                <th>Total</th>

                                                <th>Course Acceditation Number</th>

                                                <th>Country</th>

                                                <!-- <th>Validity Date</th> -->

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
                                            $country_name = $this->admin->get_row_array('tbl_countries','countries_id',$list['country_id'])['countries_name'];


                                                if($list['paid_status']==1){
                                                    $status = 'Free';
                                                }elseif($list['paid_status']==2){
                                                    $status = 'Featured';
                                                }else{
                                                    $status = 'Inactive';
                                                } 






                                                // if($list['course_photo']==""){
                                                //     $image = 'No-image';
                                                // }else{
                                                //     $url = base_url('assets/images/dp/').$list['course_photo'];
                                                //     $image = '<img src="'.$url.'">';
                                                // }


                                             ?>



                                            <tr>

                                                <th><?=$count;?></th>

                                                <!-- <th class="dp-image"><?=$image;?></th> -->

                                                <th><?=$list['user_email'];?></th>

                                                <th><?=$list['course_title'];?></th>

                                                <th><?=$list['units'];?></th>

                                                <th><?=$list['price'];?></th>

                                                <th><?=$list['tax'];?></th>

                                                <th><?=$list['total'];?></th>

                                                <th><?=$list['course_acceditation_number'];?></th>
                                                
                                                <!-- <th><?=$list['issued_date'];?></th> -->

                                                <th><?=$country_name;?></th>

                                                <th><?=$status;?></th>

                                                <th>

                                                    <a href="#" title="Edit"><i class="fas fa-edit"></i></a> 

                                                    <a href="#" title="View"> <i class="fas fa-eye"></i> </a> 

                                                    <a href="#" title="Delete" onclick="return confirm('Are you sure you want to delete this?')"> <i class="fas fa-trash"></i> </a></th>


                                            </tr>

                                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div> 

                    </div>

                </main>

                