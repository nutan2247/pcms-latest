<div id="layoutSidenav_content">

    <main>

        <div class="container-fluid">

            <h1 class="mt-4"><?php echo $page_title; ?></h1>

            

            <div class="card mb-4">

                <div class="card-header">

                    <i class="fas fa-table mr-1"></i>

                    <?php echo $table_name; ?>
                    <a class="btn btn-primary float-right" href="<?php echo site_url('examiner/dashboard'); ?>">Back</a>

                </div>

                <div class="card-body">

                    <div class="row">

                        <table class="table table-striped table-hover">

                            <tbody>

                                <tr>

                                    <th>Date of Exam</th>

                                    <td><?php echo $view->examdate; ?></td>

                                </tr>

                                <tr>

                                    <th>Question Title</th>

                                    <td><?php echo $view->question_title; ?></td>

                                </tr>
                                <tr>

                                    <th>Question Category</th>

                                    <td><?php echo ($view->category_name != '')?$view->category_name:'--'; ?></td>

                                </tr>

                                <tr>

                                    <th>Answer 1</th>
                                    <td><?php echo $view->answere1; ?></td>

                                </tr>

                                <tr>

                                    <th>Answer 2</th>
                                    <td><?php echo $view->answere2; ?></td>

                                </tr>

                                <tr>

                                    <th>Answer 3</th>
                                    <td><?php echo $view->answere3; ?></td>

                                </tr>

                                <tr>

                                    <th>Answer 4</th>
                                    <td><?php echo $view->answere4; ?></td>

                                </tr>

                                <tr>

                                    <th>Correct Answer</th>

                                    <td><select class="form-control" name="correct_answere" disabled>
                                        <option >Please select one answere</option>
                                        <option value="1" <?php if($view->correct_answere==1){ echo 'selected'; } ?> > Answer 1</option>
                                        <option value="2" <?php if($view->correct_answere==2){ echo 'selected'; } ?>> Answer 2</option>
                                        <option value="3" <?php if($view->correct_answere==3){ echo 'selected'; } ?>> Answer 3</option>
                                        <option value="4" <?php if($view->correct_answere==4){ echo 'selected'; } ?>> Answer 4</option>
                                    </select></td>


                                </tr>

                                <tr>
                                    <th>Rationale</th>
                                    <td><?php echo $view->rationale; ?></td>
                                </tr>

                                <tr>

                                    <th>Added by</th>

                                    <td><?php echo $view->added_by_name; ?></td>

                                </tr>

                                 

                                <tr>

                                    <th>Status</th>

                                    <?php if($view->status==1){

                                        $status = '<span class="text-info">Submitted</span>';

                                    }elseif($view->status==2){

                                        $status = '<span class="text-success">Publish</span>';

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

                