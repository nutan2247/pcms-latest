
  <?php $this->view('dashboard_top'); ?>
  <section class="dashboard-contentpanel py-lg-5 py-3 ">
          <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <?php $this->view('ce-provider/dashboard_left'); ?>
                    </div>
                      <div class="col-lg-9 col-md-8">
                          <h4 class="mb-4 mt-4 text-uppercase text-center">Application for Training Course Accreditation
                              <button class="btn btn-info float-right" data-target="#uploadTrainingModal" data-toggle="modal" >Upload Training </button>
                          </h4>
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
                                      <th>Sl.</th>
                                      <th>Training Image</th>
                                      <th>Title</th>
                                      <th>Profession</th>
                                      <!-- <th>Unit</th> -->
                                      <th>Price</th>
                                      <!-- <th>Expiry At</th> -->
                                      <!-- <th>Status</th> -->
                                      <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php if(count($pendingtraining) > 0){ 
                                        $count = 1;		
                                        foreach($pendingtraining as $cor){ 
                                        if($cor->reviewer_status == 1){ 
                                          $status = 'Approved';
                                        }elseif($cor->reviewer_status == 2){ 
                                          $status = 'Rejected';
                                        }else{
                                          $status = 'Pending';
                                        } ?>
                                        
                                        <tr>
                                          <td><?php echo $count++; ?></td>
                                          <td><img src="<?php echo base_url('assets/images/ce_provider/'.$cor->training_image); ?>" alt="<?php echo $cor->training_title; ?>-image" width="70"></td>
                                          <td><?php echo $cor->training_title; ?></td>
                                          <td><?php echo $cor->profession_name; ?> </td>
                                          <!-- <td><?php echo $cor->training_units; ?> </td> -->
                                          <td><?php echo $cor->training_price; ?></td>
                                          <!-- <td><?php echo $status; ?></td> -->
                                          <td><a href="javascript:void(0)" id="<?php echo $cor->train_doc_id; ?>" data-id="<?php echo $cor->training_price; ?>"  data-name="<?php echo $cor->training_title; ?>"  data-prof="<?php echo $cor->profession_name; ?>" data-pdf="<?php echo base_url('assets/images/ce_provider/'.$cor->training_pdf); ?>"  data-image="<?php echo base_url('assets/images/ce_provider/'.$cor->training_image); ?>" data-desc="<?php echo $cor->description; ?>"  class="btn btn-info viewTraining" title="View Training pdf">View</a>
                                          <a href="<?php echo base_url('ce-provider/ce_provider/edit_training/').base64_encode($cor->train_doc_id); ?>" class="btn btn-info" title="Edit Training pdf">Edit</a>
                                          <a href="javascript:void(0);" onclick="deletetraining('<?php echo $cor->train_doc_id ?>')" class="btn btn-danger" title="Delete">Delete</a>
                                        </tr>
                                    <?php	} 	}else{ echo '<tr><td colspan="7">No data found!</td></tr>'; } ?>
                                    </tbody>	
                                  </table>
                                </div>
                              </div>
                          </div>
                          <div class="card mt-5">
                              <div class="card-header"> 
                                Submitted Training
                              </div>
                              <div class="card-body">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="ocdata">
                                    <thead>
                                    <tr>
                                      <th>Sl.</th>
                                      <th>Training Image</th>
                                      <th>Title</th>
                                      <th>Profession</th>
                                      <!-- <th>Unit</th> -->
                                      <th>Price</th>
                                      <!-- <th>Expiry At</th> -->
                                      <!-- <th>Status</th> -->
                                      <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php if(count($submittedtraining) > 0){ 
                                        $count = 1;		
                                        foreach($submittedtraining as $cor){ 
                                          if($cor->reviewer_status == 1){ 
                                          $status = 'Approved';
                                        }elseif($cor->reviewer_status == 2){ 
                                          $status = 'Rejected';
                                        }else{
                                          $status = 'Pending';
                                        }
                                        $cfc =  $this->provider->getCourseLogs($cor->train_doc_id,$cor->provider_id); ?>
                                        <tr>
                                          <td><?php echo $count++; ?></td>
                                          <td><img src="<?php echo base_url('assets/images/ce_provider/'.$cor->training_image); ?>" alt="<?php echo $cor->training_title; ?>-image" width="70"></td>
                                          <td><?php echo $cor->training_title; ?></td>
                                          <td><?php echo $cor->profession_name; ?> </td>
                                          <!-- <td><?php echo $cor->training_units; ?> </td> -->
                                          <td><?php echo $cor->training_price; ?></td>
                                          <!-- <td><?php echo $status; ?></td> -->
                                          <td>
                                            <a href="javascript:void(0)" data-id="<?php echo $cor->training_pdf; ?>" class="btn btn-info viewPdf" title="View course pdf">View</a>
                                            <!-- if course is already reviewed than cep can't resubmit pdf... -->
                                            <?php if($cfc > 0 && $cor->reviewer_status == '0'): ?>
                                              <a href="javascript:void(0)" id="<?php echo $cor->train_doc_id; ?>" data-id="<?php echo $cor->provider_id; ?>" data-name="<?php echo $cor->training_title; ?>" data-value="<?php echo $cfc[0]->reviewer_email; ?>" class="btn btn-info reSubmit" title="Re-submit course">Re-submit</a>
                                            <?php endif; ?>
                                          </td>
                                        </tr>
                                    <?php	} 	}else{ echo '<tr><td colspan="7">No data found!</td></tr>'; } ?>
                                    </tbody>	
                                  </table>
                                </div>
                              </div>
                          </div>
                      </div>
                </div>
          </div>
  </section>
    
   
  <div class="modal fade r-board-modal show" id="cepviewTraining" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    VIEW UPLOADED TRAINING 
                </div>
                <form>
                <div class="modal-body">
                    <div class="form-group row px-3">
                        <label class="col-md-3">Training Title : </label>
                        <label class="col-md-8" id="pcourse_title">ABC</label>
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Training Image : </label>
                        <label class="col-md-8"><img src="" alt="" id="pcourse_image"  width="250"></label>
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Upload Training PDF : </label>
                        <label class="col-md-8"><a href="" id="pcourse_pdf" target="_blank">View PDF</a></label>
                    </div>
                    <!-- <div class="form-group row px-3">
                        <label class="col-md-3">Training Units : </label>
                        <label class="col-md-8" id="pcourse_unit">12</label>
                    </div> -->
                    <div class="form-group row px-3">
                        <label class="col-md-3">Training Description : </label>
                        <label class="col-md-8" id="pcourse_discription">  </label>
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Profession <sup>(Who attend this Training) : </sup></label>
                        <label class="col-md-8" id="pcourse_profesion">accountant</label>    
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Training price : </label>
                        <label class="col-md-8" id="pcourse_price">$10</label>
                    </div>
                    <div class="form-group row mb-0 text-center">
                        <button class="btn btn-primary text-uppercase" onclick="close_ce_popup('cepviewTraining')"> Close </button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
   

    <div class="modal fade r-board-modal show" id="resubmitTraining" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    Re-upload Training 
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('ce-provider/ce_provider/resubmitTraining'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row px-3">
                        <label class="col-md-3">Training Title : </label>
                        <label class="col-md-8" id="retraining_title"></label>
                        <input type="hidden" name="cid" id="re_cid">
                        <input type="hidden" name="training_name" id="re_course_name">
                        <input type="hidden" name="provider_id" id="re_provider_id">
                        <input type="hidden" name="reviewer_email" id="re_reviewer_email">
                    </div>
                    <div class="form-group row px-3">
                        <label>Re-upload Training PDF (only pdf formate allowed) : </label>
                        <input type="file" name="upload_training" class="form-control" accept="application/pdf, application/vnd.ms-excel" required>
                    </div>

                    <div class="offset-4">
                        <input type="submit" class="btn btn-success text-uppercase" value="Re-submit" name="submit">
                        <a class="btn btn-primary text-uppercase" onclick="close_ce_popup('resubmitTraining')"> Close </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   


<script>
$('.viewTraining').on('click',function(){
    var price = $(this).attr('data-id');
    var title = $(this).attr('data-name');
    var pdf     = $(this).attr('data-pdf');
    var image = $(this).attr('data-image');
    var prof = $(this).attr('data-prof');
    var desc = $(this).attr('data-desc');
    $('#pcourse_title').html(title);
    $('#pcourse_price').html('$ '+price);
    $('#pcourse_discription').html(desc);
    $('#pcourse_profesion').html(prof);
    $('#pcourse_image').attr('src',image);
    $('#pcourse_pdf').attr('href',pdf);
    $('#cepviewTraining').modal('show');
});

//for viewPdf, Please check in sidebar

$('.reSubmit').on('click',function(){
    var cid = $(this).attr('id');
    var provider_id = $(this).attr('data-id');
    var title = $(this).attr('data-name');
    var reviewer_email = $(this).attr('data-value');
    // console.log(title);
    $('#retraining_title').html(title);
    $('#re_provider_id').val(provider_id);
    $('#re_cid').val(cid);
    $('#re_course_name').val(title);
    $('#re_reviewer_email').val(reviewer_email);
    $('#resubmitTraining').modal('show');
});


function deletetraining(training_id){
  alert(training_id);
   var x = confirm('do you really want to delete this file!');
    if(x == true){
        window.location.href = "<?php echo base_url('ce-provider/ce_provider/delete_training/');?>"+training_id;
    }
}
</script>