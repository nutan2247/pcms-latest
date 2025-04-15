<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
            <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $table_name; ?>
                </span>
            </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-body">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Id</th>
                                                <td><?php echo $certificate_view->id; ?></td>
                                            </tr>
                                            <tr>
                                                <th>User Name</th>
                                                <td><?php echo $certificate_view->user_id; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Certificate Id</th>
                                                <td><?php echo $certificate_view->certificate_id; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Course Name</th>
                                                <td><?php echo $certificate_view->course_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Units</th>
                                                <td><?php echo $certificate_view->units; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Start Date</th>
                                                <td><?php echo $certificate_view->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>End Date</th>
                                                <td><?php echo $certificate_view->end_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Certificate</th>
                                                <td><?php echo $certificate_view->certificate; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td><?php echo $certificate_view->category; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Issue Date</th>
                                                <td><?php echo $certificate_view->issue_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Issue From</th>
                                                <td><?php echo $certificate_view->issue_from; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Issue By</th>
                                                <td><?php echo $certificate_view->issue_by; ?></td>
                                            </tr>
                                            <tr>
                                                <th>CEP Name</th>
                                                <td><?php echo $certificate_view->cep_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Added On</th>
                                                <td><?php echo $certificate_view->added_on; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>