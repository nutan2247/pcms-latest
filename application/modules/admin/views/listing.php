<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
        <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>

        <!-- <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active"><?php echo $page_title; ?></li>

            </ol> -->

            <form action="<?php echo base_url('admin/listing') ?>" method="POST">
            <div class="form-group row">
            

                <div class="col-sm-2">
                    <input type="text" name="user_name" class="form-control" value="<?php echo (isset($where['name']))?$where['name']:"" ?>" placeholder="Name">
                </div>

                <div class="col-sm-2">
                    <select class="form-control" id="profession" name="profession"> 
                        <option value="">--Select Profession--</option>
                        <?php
                            if(!empty($profession))
                            {
                                foreach ($profession as $key => $value) {
                                    # code...
                                
                        ?>
                         <option <?php echo (isset($where['profession']) && $where['profession']==$value['id'])?"selected":"" ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                     <?php } } ?>
                     </select>
                </div>

                <div class="col-sm-2">
                    <select name="status" id="status" class="form-control">
                        <option  value="">Select Status</option>
                        <?php
                        if(!empty($professional_status))
                        {
                            foreach ($professional_status as $key => $value) {
                               
                            
                        
                        ?>
                        <option <?php echo (isset($where['status']) && $where['status']==$value['professional_status_id'])?"selected":"" ?> value="<?php echo $value['professional_status_id']?>"><?php echo $value['name']?></option>
                    <?php } } ?>
                    </select>
                </div>

                <div class="col-sm-2">
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Please select one</option>
                        <option <?php echo (isset($where['male']) && $where['gender']=='male')?"selected":"" ?> value="male">Male</option>
                        <option <?php echo (isset($where['gender']) && $where['gender']=='female')?"selected":"" ?> value="female">Female</option>
                    </select>
                </div>


                <div class="col-sm-2">

                    <a class="btn" href="<?php echo base_url('admin/listing'); ?>">Reset</a>

                    <input type="submit" name="submit" value="search" class="btn btn-primary">
                </div>

                
            </div>
            <?php echo form_close(); ?>

        <div class="card mb-4">

            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $table_name; ?>
                </span>
                <a class="btn btn-primary" href="<?php echo site_url('admin/add'); ?>"> Register Professional</a>

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

                                <th>Date of Birth</th> 

                                <th>Address</th>-->

                                <th>Email</th>

                                <th>License</th>

                                <th>Date Renewed</th>

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

                                    /*if($list['status']==1){

                                        $status = 'Active';

                                    }else{

                                        $status = 'Inactive';

                                    }*/ 

                                 ?>



                            <tr>

                                <td><?=$count;?></td>
                                <td class="dp-image"><img src="<?php echo base_url('assets/images/profile/'.$list['image'])?>"></td>
                                <td><?=$list['name'];?></td>

                                <td><?=$profession;?></td>

                                <!-- <td><?=$list['gender'];?></td>

                                <td><?=$age;?></td>

                                <td><?=$list['dob'];?></td> 

                                <td><?=$list['address'];?></td>-->

                                <td><?=$list['email'];?></td>

                                <td><?=$list['license_no'];?></td>

                                <td><?=$list['license_validity_date'];?></td>

                                <td><?=ucfirst($list['professional_status']);?></td>

                                <td>

                                    <a href="<?php echo site_url('admin/add/').$list['user_ID'];?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>

                                    <a href="<?php echo site_url('admin/view/').$list['user_ID'];?>" title="View">
                                        <i class="fas fa-eye"></i> </a>

                                    <a href="<?php echo site_url('admin/delete/').$list['user_ID'];?>"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete tdis?')"> <i
                                            class="fas fa-trash"></i> </a></td>

                            </tr>

                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>