<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <div class="clearfix">
            <h4 class="mt-4 mb-3 float-left"><?php echo $page_title; ?></h4>
            <a class="btn btn-primary mx-md-2 mt-4 mb-3  float-right" href="<?php echo site_url('admin/add_local_professional'); ?>"> Add Professional</a>
            <a class="btn btn-primary mt-4 mb-3 float-right" href="<?php echo site_url('admin/dashboard'); ?>"> Back</a>
        </div>
        

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="row">
                        <a href="<?php echo current_url().'?id='?>" class="btn btn-<?php if(!isset($_REQUEST['id']) || isset($_REQUEST['id']) && $_REQUEST['id'] == ''){ echo 'primary'; }elseif(isset($_REQUEST['id']) &&  $_REQUEST['id'] == ''){ echo 'primary'; }else{ echo 'warning'; } ?>">All(<?=$totalpro;?>)</a>
                        <a href="<?php echo current_url().'?id=l'?>" class="btn btn-<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] =='l'){ echo 'primary'; }else{ echo 'warning'; } ?> mx-md-2">Local Professional(<?=$totallocalpro;?>) </a>
                        <a href="<?php echo current_url().'?id=p'?>" class="btn btn-<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] =='p'){ echo 'primary'; }else{ echo 'warning'; } ?>">Foreign Professional (with Exam)(<?=$totalprowithexam;?>)</a>
                        <a href="<?php echo current_url().'?id=f'?>" class="btn btn-<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] =='f'){ echo 'primary'; }else{ echo 'warning'; } ?> mx-md-2">Foreign Professional (without Exam)(<?=$totalprowithoutexam;?>)</a>
                </div>   
            </div>
            <!-- <div class="card-header">
                    <?php echo form_open(base_url('admin/local_professional_listing')); ?>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <input type="text" name="user_name" class="form-control" value="<?php echo (isset($where['name']))?$where['name']:"" ?>" placeholder="Name">
                        </div>

                        <div class="col-sm-2">
                            <select class="form-control" id="profession" name="profession"> 
                                <option value="">--Select Profession--</option>
                                <?php  if(!empty($profession)) {
                                        foreach ($profession as $key => $value) { ?>
                                <option <?php echo (isset($where['profession']) && $where['profession']==$value['id'])?"selected":"" ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php } } ?>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select name="status" id="status" class="form-control">
                                <option  value="">Select Status</option>
                                <?php if(!empty($professional_status)) {
                                        foreach ($professional_status as $key => $value) { ?>
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
                            <input type="submit" name="submit" value="search" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div> -->
            

            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Image</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last name</th>
                                <th>Gender</th>

                                <th>Profession</th>
                                <th>Category</th>
                                <th>Registration Code</th>

                                <th>Date of Birth</th>

                                <th>Email</th>

                                <th>License</th>

                                <th>Date Issued</th>
                                <th>Validity Date</th>

                                <th>License Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <!--   <tfoot>

                            </tfoot> -->



                        <tbody>

                            <?php if($listing){

                                $count = 1; 

                                foreach($listing as $key => $list){
                                    if($list->status==1){ $status="<span class='text-success'>Valid</span>"; }
                                    elseif($list->status==2){ $status="<span class='text-warning'>Expired</span>"; }
                                    elseif($list->status==3){ $status="<span class='text-danger'>Suspended</span>"; }
                                    elseif($list->status==4){ $status="<span class='text-primary'>Revoke</span>"; }
                                    else{ $status="<span class='text-info'>Pending</span>"; }
                                    $profession = $this->admin->get_row_array('tbl_profession','id',$list->profession)['name'];
                                    $dob = date('F d,Y',strtotime($list->dob)); 
                                    $category = '--';
                                    if($list->added_by_admin == 'l'){
                                        $category = 'Local Professional';
                                    }else if($list->added_by_admin == 'p'){
                                        $category = 'Local Professional (with Exam)';
                                    }else if($list->added_by_admin == 'f'){
                                        $category = 'Local Professional (without Exam)';
                                    }

                            ?>
                            <tr>

                                <td><?=$count;?></td>
                                <td class="dp-image"><img src="<?php echo base_url('assets/uploads/profile/'.$list->image)?>"></td>
                                <td><?=$list->fname;?></td>
                                <td><?=$list->lname;?></td>
                                <td><?=$list->name;?></td>
                                <td><?=$list->gender;?></td>

                                <td><?=$profession;?></td>
                                <td><?=$category;?></td>
                                <td><?=$list->registration_no;?></td>

                                <td><?=$dob;?></td> 

                                <td><?=$list->email;?></td>

                                <td><?=$list->license_no;?></td>

                                <td><?=date('F d,Y',strtotime($list->license_issued_date));?></td>
                                <td><?=date('F d,Y',strtotime($list->license_validity_date));?></td>

                                <td><?=$status;?></td>

                                <td>
                                    <div class="view-icon">
                                    <a href="<?php echo site_url('admin/add_local_professional/').$list->user_ID;?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <!-- <a href="<?php echo site_url('admin/view/').$list->user_ID;?>" title="View">
                                        <i class="fas fa-eye"></i> </a> -->
                                    <a href="javascript:void(0);" class="local-prof-view" data-id="<?php echo $list->user_ID;?>" title="View">
                                        <i class="fas fa-eye"></i> </a>
                                    <a href="<?php echo site_url('admin/local_professional_delete/').$list->user_ID;?>"
                                        title="Delete" onclick="return confirm('Are you sure you want to delete this?')"> <i
                                            class="fas fa-trash"></i> </a>
                                    </div>
                                   
                                </td>

                            </tr>

                            <?php $count++; } }?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>

<!-- Modal -->
<div class="modal fade view-profile-modal" id="localprofprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="local-prof-content">Please wait...</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$('.local-prof-view').on('click',function(){
    var uid = $(this).attr('data-id');
// alert(uid)
    $.ajax({                                      
      url: '<?php echo base_url('admin/admin/view_prof_profile'); ?>',         
      data: { uid : uid },  
      type: 'POST',                   
      success: function(result)  
      {        
        // alert(result);
        // console.log(result);
        $('#local-prof-content').html(result);
        $('#localprofprofile').modal('show');
      } 
    });
});


</script>