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

            <div class="clearfix">
                <h4 class="float-left mt-4 mb-4"><?php echo $page_title; ?> </h4>
                <a href="<?php echo base_url('admin/add_lesson'); ?>" class="btn btn-info float-right mb-4 mt-4">Add Guidlines</a>
            </div>
            
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Guidline For</th>
                                        <th>Lesson Title</th>
                                        <th>Video</th>
                                        <th>Youtube Link</th>
                                        <th>Content</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php if(!empty($lesson_listing)) {
                                    $i = 1;
                                    foreach ($lesson_listing as $key => $value) {
                                    if($value->status==1){
                                        $status = '<span class="text-success">Active</span>'; 
                                    }else{
                                        $status = '<span class="text-danger">Inactive</span>'; 
                                    }
                                    if($value->lesson_video ==''){ 
                                        $video = '--'; 
                                    }else{ 
                                        $video = $value->lesson_video;  
                                    }
                                    if($value->youtube_video ==''){ 
                                        $youtube = '--'; 
                                    }else{ 
                                        $youtube = $value->youtube_video;  
                                    }
                                    if($value->guidline_for =='fp'){ 
                                        $guidline_for = 'Foreign Pofessionals'; 
                                    }else{ 
                                        $guidline_for = 'Local Graduates';  
                                    } ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $guidline_for; ?></td>
                                        <td><?php echo $value->lesson_title; ?></td>
                                        <td><?php echo $video; ?></td>
                                        <td><?php echo $youtube; ?></td>
                                        <td><?php echo readMoreHelper($value->lesson_content,100,$value->id); ?></td>
                                        <td><?php echo $value->added_by; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/lesson_view/'.$value->id); ?>" class="btn btn-info" title="View">
                                            <i class="fas fa-eye"></i> </a>
                                            <a href="<?php echo base_url('admin/lesson_edit/'.$value->id); ?>" class="btn btn-info" title="Edit">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" onclick="delete_lesson('<?php echo $value->id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                    <?php $i++; } } ?>
                                </tbody>

                            </table>
                        </div>
               

        </div>

    </main>

    
        <?php 
        function readMoreHelper($story_desc, $chars, $id) {
            $base = base_url('admin/lesson_view/').$id;
            $story_desc = substr($story_desc,0,$chars);  
            $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
            $story_desc = $story_desc." <a href='".$base."'>Read More...</a>";  
            return $story_desc;  
        } 
        ?> 


    <script>
        function delete_lesson(id){
            var x = confirm('Do you want to delete this ?');
            if(x == true){
                window.location.href = '<?php echo base_url('admin/lesson_delete/'); ?>'+id;
            }
        }
    </script>