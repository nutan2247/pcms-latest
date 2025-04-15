<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $page_title; ?></h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $table_name; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Country Name</th>
                                                <td><?php echo $view->countries_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>ISO Code</th>
                                                <td><?php echo $view->countries_iso_code; ?></td>
                                            </tr>
                                            <tr>
                                                <th>ISD Code</th>
                                                <td><?php echo $view->countries_isd_code; ?></td>
                                            </tr>
                                             
                                            <tr>
                                                <th>Status</th>
                                                <?php if($view->status==1){
                                                    $status = 'Active';
                                                }else{
                                                    $status = 'Inactive';
                                                } ?>
                                                <td><?php echo $status; ?></td>
                                                
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
                