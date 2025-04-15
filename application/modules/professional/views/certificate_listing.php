<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//print_r($submitted);exit;
 //print_r($unreadnotifications);exit;?>
	<?php $this->view('professional_top'); ?>
    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
                <?php echo $this->session->flashdata('response'); ?>
                    <h4 class="mb-3 mt-4 text-uppercase text-center"><?php echo $page_title; ?></h4>
                   <div class="text-right mb-4">
				   <?php  if(!$this->session->userdata('admin_login')){  echo '<button type="button" href="" class="btn btn-danger upload-certificate">Upload Certificate</button>';
					}  ?>
                   </div>
                        <div class="card">
                          <?php echo $this->session->flashdata('item'); ?>
                              <div class="card-header"> 
                                  For Submission 
                              </div>
                              <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="ocdata">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Certificate No.</th>
                                                <th>Course_name</th>
                                                <th>Units</th>
                                                <th>Category</th>
                                                <th>Issued by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                            <?php $count = 1; 
                                                $sumUnits = 0;
                                                foreach($pending as $value){
                                                    $sumUnits += $value->units; ?>
                                                <tr>
                                                    <td><?=$count;?></td>
                                                    <td><?=isset($value->certificate_id)?$value->certificate_id:'N/A';?></td>
                                                    <td><?=$value->course_name;?></td>
                                                    <td><?=$value->units;?></td>
                                                    <td><?=$value->category;?></td>
                                                    <td><?=$value->issue_by;?></td>
                                                    <td><a href="javascript:void(0)" onclick="view_certifcate('<?=$value->certificate;?>')" >View</a>
                                                        <a href="javascript:void(0)" class="prof_change_category" data-id="<?=$value->id?>"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $count++; } ?>
                                                <tr>
                                                    <th colspan="3"> Total Units</th>
                                                    <th> <?=$sumUnits;?></th>
                                                    <th colspan="3"></th>
                                                </tr>
                                            </tbody>	
                                  </table>
                                </div>
                              </div>
                          </div>
                          <div class="card mt-5">
                              <div class="card-header"> 
                                Submitted Certificate
                              </div>
                              <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="ocdata">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Certificate No.</th>
                                                <th>Course_name</th>
                                                <th>Units</th>
                                                <th>Category</th>
                                                <th>Issued by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                        <?php $count = 1; 
                                            $sumUnits1 = 0;
                                            foreach($submitted as $value){
                                                $sumUnits1 += $value->units; ?>
                                            <tr>
                                                <td><?=$count;?></td>
                                                <td><?=isset($value->certificate_id)?$value->certificate_id:'N/A';?></td>
                                                <td><?=$value->course_name;?></td>
                                                <td><?=$value->units;?></td>
                                                <td><?=$value->category;?></td>
                                                <td><?=$value->issue_by;?></td>
                                                <td><a href="javascript:void(0)" onclick="view_certifcate('<?=$value->certificate;?>')" >View</a></td>
                                            </tr>
                                        <?php $count++; } ?>
                                            <tr>
                                                <th colspan="3"> Total Units</th>
                                                <th> <?=$sumUnits1;?></th>
                                                <th colspan="3"></th>
                                            </tr>
                                        </tbody>	
                                  </table>
                                </div>
                              </div>
                          </div>

                    <!-- <div class="row">
                        <div class="table-responsive">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Certificate No.</th>
                                    <th>Course_name</th>
                                    <th>Units</th>
                                    <th>Category</th>
                                    <th>Issued by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; 
                                  $sumUnits = 0;
                                foreach($ecertificate as $value){
                                    $sumUnits += $value->units; ?>
                                <tr>
                                    <td><?=$count;?></td>
                                    <td><?=isset($value->certificate_id)?$value->certificate_id:'N/A';?></td>
                                    <td><?=$value->course_name;?></td>
                                    <td><?=$value->units;?></td>
                                    <td><?=$value->category;?></td>
                                    <td><?=$value->issue_by;?></td>
                                    <td><a href="javascript:void(0)" onclick="view_certifcate('<?=$value->certificate;?>')" >View</a></td>
                                </tr>
                            <?php $count++; } ?>
                                <tr>
                                    <th colspan="3"> Total Units</th>
                                    <th> <?=$sumUnits;?></th>
                                    <th colspan="3"></th>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div> -->
                </div>
                
            </div>
        </div>
    </section>

    <!-- The Modal -->
    <div class="modal" id="certificateModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">View Certificate </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              <iframe src="" id="certificatecontent" height="650" width="100%"></iframe>
           <!-- <img src="" id="certificatecontent"> -->
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    
    <!-- Modal change category -->
    <div class="modal fade" id="changecategoryDialog" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    
                    <form action="<?php echo base_url('professional/applicant/change_category') ;?>" method="post" onsubmit="return validate_category();" enctype="multipart/form-data" name="changecategory" id="changecategory">
                    <input type="hidden" name="id" value="" id="category_id">
                    <p>
                        <label>Category<span class="required text-danger"> * </span> </label>
                        <select name="category" id="category" class="form-control">
                            <option value="" selected="">Please Select</option>
                            <option value="general">General</option>
                            <option value="specific">Specific</option>
                        </select>
                        <span class="text-danger" id="categoryerr"></span> 
                    </p>
                    
                    <p>
                        <input type="submit" name="savecat" value="SAVE" class="btn btn-primary">
                    </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function view_certifcate(certificate){
            var url ="<?php echo base_url('assets/uploads/pdf/');?>"+certificate+".pdf";
            $('#certificatecontent').attr('src',url);
            $('#certificateModal').modal('show');
        }
        $('.upload-certificate').on('click', function(){
        $('#uploadCertificateModal').modal('show');
    });

    //change category
    $(".prof_change_category").click(function(){
        var id = $(this).data("id");
        $('#category_id').val(id);
        $("#changecategoryDialog").modal('show');
    });
    function validate_category(){
        $('#categoryerr').html('');
        var category = document.forms["changecategory"]["category"];
        if(category.value == ""){
            $('#categoryerr').html('Category required.');
            return false;
        }
        return true;
    }
    </script>