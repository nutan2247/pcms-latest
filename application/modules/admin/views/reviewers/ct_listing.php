<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>

        <!-- <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active"><?php echo $page_title; ?></li>

            </ol> -->



        <div class="card mb-4">

            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $table_name; ?>
                </span>
                <a class="btn btn-primary" href="<?php echo site_url('admin/add_reviewer'); ?>"> Add Reviewer</a>

            </div>

            <div class="card-body">

                <?php echo $this->session->flashdata('item');?>

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Appointment Date</th>
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
                                    if($list['photo']!=''){
                                        $path = base_url('assets/uploads/reviewer/').$list['photo'];
                                        $image = '<img src="'.$path.'" width="50" >';
                                    }else{
                                        $image = '--';
                                    } ?>



                            <tr>

                                <td><?=$count;?></td>
                                <td><?=$image;?></td>
                                <td><?=$list['first_name'].' '.$list['last_name'];?></td>
                                <td><?=$list['username'];?></td>
                                <td><?=date('F d,Y',strtotime($list['created_on']));?></td>
                                <td><?=date('F d,Y',strtotime($list['validity_date']));?></td>
                                <td><?=$list['status'];?></td>

                                <td>

                                    <a href="<?php echo site_url('admin/add_reviewer/').$list['user_ID'];?>"
                                        title="Edit"><i class="fas fa-edit"></i></a>

                                   <!--  <a href="<?php echo site_url('admin/reviewers_view/').$list['user_ID'];?>" title="View">
                                        <i class="fas fa-eye"></i> </a> -->

                                    <a href="javascript:void(0)" onclick="deletereviewer('<?php echo $list['user_ID'];?>','<?php echo $list['user_type'];?>');" title="Delete"> <i class="fas fa-trash"></i> </a></td>

                            </tr>

                            <?php $count++; } 
							}else{ echo'<tr><td colspan="5">No Data Found!</td></tr>'; }?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>

<script>
    function deletereviewer(id,type){
        var x = confirm('Are you sure?');

        if(x==true){
        var url = "<?php echo site_url('admin/reviewers_delete/') ?>";
        window.location.href = url+id+'/'+type;
        }
    }
</script>