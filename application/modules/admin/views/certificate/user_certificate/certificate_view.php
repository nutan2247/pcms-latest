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
                <a href="javascript:void(0);" class="btn btn-primary" title="Print" onclick="printElem('cert-details');">Print</a>
                <a href="javascript:history.back();" class="btn btn-primary" role="button">Back</a>
            </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-body" id="cert-details">
                                    <style>
                                        table, td, th {  
                                        border: 1px solid #ddd;
                                        text-align: left;
                                        }

                                        table {
                                        border-collapse: collapse;
                                        width: 100%;
                                        }

                                        th, td {
                                        padding: 10px;
                                        }
                                    </style>
                                    <table class="table table-borderless" >
                                    
                                        <tbody>
                                            <tr>
                                                <th>Report Number:</th>
                                                <td><?php echo $certificate_view->id.date('Y'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Reported by:</th>
                                                <td><?php echo $certificate_view->fname.' '.$certificate_view->lname.' '.$certificate_view->name ; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Recipient Email:</th>
                                                <td><?php echo $certificate_view->user_email; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date and Time Reported:</th>
                                                <td><?php echo $certificate_view->added_on; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Certificate Number:</th>
                                                <td><?php echo $certificate_view->certificate_id; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Course Name:</th>
                                                <td><?php echo $certificate_view->course_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Units:</th>
                                                <td><?php echo $certificate_view->units; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Start Date:</th>
                                                <td><?php echo $certificate_view->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>End Date:</th>
                                                <td><?php echo $certificate_view->end_date; ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <th>Certificate Photo:</th>
                                                <td><img src="<?php echo ($certificate_view->certificate != '')?base_url('assets/uploads/pdf/'.$certificate_view->certificate.'.pdf'):''; ?>" alt="cert-photo" width="70px" height="60px"></td>
                                            </tr> -->
                                            <tr>
                                                <th>Category:</th>
                                                <td><?php echo ($certificate_view->category !='')?$certificate_view->category:'n/a'; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date Issued:</th>
                                                <td><?php echo $certificate_view->issue_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Issued From:</th>
                                                <td><?php echo $certificate_view->issue_from; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Issued By:</th>
                                                <td><?php echo $certificate_view->issue_by; ?></td>
                                            </tr>
                                            <tr>
                                                <th>CEP Name:</th>
                                                <td><?php echo $certificate_view->cep_name; ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <a href="javascript:history.back();" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <iframe src="<?=base_url('assets/uploads/pdf/'.$certificate_view->certificate.'.pdf'); ?>" id="crtpath" height="650" width="100%"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script type="text/javascript">
    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>