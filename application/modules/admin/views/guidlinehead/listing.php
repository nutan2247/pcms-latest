<style>
    #myTabContent {
        border: 1px solid #efefef;
        margin-top: -1px;
    }

    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #007bff;
        border-color: #007bff !important;
    }

    #o-all .nav-link.active {
        color: #fff !important;
        background-color: #000;
        border-color: #000 !important;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?> <a href="<?php echo base_url('admin/add_guidline_head'); ?>" class="btn btn-info float-right">Add heading</a>
            
            </h4>
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Content</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php //print_r($lesson_listing);exit;
                            if(!empty($lesson_listing)) {
                                    $i = 1;
                                    foreach ($lesson_listing as $key => $value) {
                                    if($value->status==1){
                                        $status = '<span class="text-success">Active</span>'; 
                                    }else{
                                        $status = '<span class="text-danger">Inactive</span>'; 
                                    }
                                     ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->content; ?></td>
                                        <td><?php echo $value->added_by; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/heading_view/'.$value->id); ?>" class="btn btn-info" title="View">
                                            <i class="fas fa-eye"></i> </a>
                                            <a href="<?php echo base_url('admin/edit_guidline_head/'.$value->id); ?>" class="btn btn-info" title="Edit">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" onclick="delete_head('<?php echo $value->id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                    <?php $i++; } } ?>
                                </tbody>

                            </table>
                        </div>
               

        </div>

    </main>

    <script>
        function delete_head(id){
            var x = confirm('Do you want to delete this ?');
            if(x == true){
                window.location.href = '<?php echo base_url('admin/head_delete/'); ?>'+id;
            }
        }
    </script>