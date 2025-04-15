<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid">

            <h3 class="mt-4"><?php echo $page_title; ?></h3>

            

            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table mr-1"></i>

                    <?php echo $table_name; ?>
                    <a class="btn btn-primary float-right" href="<?php echo site_url('admin/lesson'); ?>">Back</a>

                </div>

                <div class="card-body">

                    <div class="row">

                        <table class="table table-striped table-hover">

                            <tbody>

                                <tr>

                                    <th>Lesson Title</th>

                                    <td><?php echo $view->lesson_title; ?></td>

                                </tr>

                                <tr>

                                    <th>Lesson Video</th>
                                    <?php if($view->lesson_video == ''){
                                                $video= '--';
                                            }else{
                                                $video= $view->lesson_video;
                                            } ?>
                                    <td><?php echo $video; ?></td>

                                </tr>
                                <tr>

                                    <th>Youtube Video</th>
                                    <?php if($view->youtube_video == ''){
                                                $youtube = '--';
                                            }else{
                                                $youtube = $view->youtube_video;
                                            } ?>
                                    <td><?php echo $youtube; ?></td>

                                </tr>

                                <tr>

                                    <th>Content</th>

                                    <td><?php echo $view->lesson_content; ?></td>

                                </tr>

                                <tr>

                                    <th>Added by</th>

                                    <td><?php echo $view->added_by; ?></td>

                                </tr>

                                 

                                <tr>

                                    <th>Status</th>

                                    <?php if($view->status==1){

                                        $status = '<span class="text-success">Active</span>';

                                    }else{

                                        $status = '<span class="text-danger">Inactive</span>';

                                    } ?>

                                    <td><?php echo $status; ?></td>

                                    

                                </tr> 

                            </tbody>

                        </table>

                    </div>

                </div>

            </div> 

        </div>

    </main>

                