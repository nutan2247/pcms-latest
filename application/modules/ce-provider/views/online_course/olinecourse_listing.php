
  <?php $this->view('dashboard_top'); ?>
    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
                	<h4 class="mb-4 mt-4 text-uppercase text-center">Application for Online Course Accreditation
	                	<button class="btn btn-danger float-right" data-target="#uploadCourseModal" data-toggle="modal" >Upload Course </button>
	                </h4>
                    <?php echo $this->session->flashdata('item'); ?>
                    <div class="card">
                        <div class="card-header"> 
                            For Submission 
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="ocdata">
                                        <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Course Image</th>
                                            <th>Title</th>
                                            <!-- <th>Unit</th> -->
                                            <th>Profession</th>
                                            <!-- <th>Category</th> -->
                                            <th>Price</th>
                                            <!-- <th>Expiry At</th> -->
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php if(count($pendingcourses) > 0){ 
                                                $count = 1;		
                                                foreach($pendingcourses as $cor){  
                                                    if($cor->reviewer_status == 1){ 
                                                    $status = 'Approved';
                                                  }elseif($cor->reviewer_status == 2){ 
                                                    $status = 'Rejected';
                                                  }else{
                                                    $status = 'Pending';
                                                  } ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><img src="<?php echo base_url('assets/images/ce_provider/'.$cor->course_image); ?>" alt="<?php echo $cor->course_title; ?>-image" width="70"></td>
                                                    <td><?php echo $cor->course_title; ?></td>
                                                    <!-- <td><?php echo $cor->course_units; ?> </td> -->
                                                    <td><?php echo $cor->profession_name; ?> </td>
                                                    <!-- <td><?php echo $cor->category; ?> </td> -->
                                                    <td><?php echo $cor->course_price; ?></td>
                                                    <!-- <td><?php echo $status; ?></td> -->
                                                    <td><a href="javascript:void(0)" id="<?php echo $cor->cor_doc_id; ?>" data-id="<?php echo $cor->course_price; ?>"  data-name="<?php echo $cor->course_title; ?>"  data-prof="<?php echo $cor->profession_name; ?>" data-pdf="<?php echo base_url('assets/images/ce_provider/'.$cor->course_pdf); ?>"  data-image="<?php echo base_url('assets/images/ce_provider/'.$cor->course_image); ?>" data-desc="<?php echo $cor->description; ?>"  class="btn btn-info viewCourse" title="View course pdf">View</a>
                                                    <a href="<?php echo base_url('ce-provider/ce_provider/edit_course/').base64_encode($cor->cor_doc_id); ?>" class="btn btn-info" title="Edit Course pdf">Edit</a>
                                                    <a href="javascript:void(0);" onclick="deletecourse('<?php echo $cor->cor_doc_id; ?>');" class="btn btn-danger" title="Delete">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php	} 	}else{ echo '<tr><td colspan="7">No data found!</td></tr>'; } ?>
                                        </tbody>	
                                    </table>
                                </div>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header"> 
                            Submitted Courses
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="ocdata">
                                        <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Course Image</th>
                                            <th>Title</th>
                                            <!-- <th>Unit</th> -->
                                            <th>Profession</th>
                                            <!-- <th>Category</th> -->
                                            <th>Price</th>
                                            <!-- <th>Expiry At</th> -->
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php if(count($submittedcourses) > 0){ 
                                                $count = 1;		
                                                foreach($submittedcourses as $cor){ 
                                                if($cor->reviewer_status == 1){ 
                                                    $status = 'Approved';
                                                  }elseif($cor->reviewer_status == 2){ 
                                                    $status = 'Rejected';
                                                  }else{
                                                    $status = 'Pending';
                                                  }
                                                $cfc =  $this->provider->getCourseLogs($cor->cor_doc_id,$cor->provider_id); ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><img src="<?php echo base_url('assets/images/ce_provider/'.$cor->course_image); ?>" alt="<?php echo $cor->course_title; ?>-image" width="70"></td>
                                                    <td><?php echo $cor->course_title; ?></td>
                                                    <!-- <td><?php echo $cor->course_units; ?> </td> -->
                                                    <td><?php echo $cor->profession_name; ?> </td>
                                                    <!-- <td><?php echo $cor->category; ?> </td> -->
                                                    <td><?php echo $cor->course_price; ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" id="<?php echo $cor->cor_doc_id; ?>" data-id="<?php echo $cor->course_price; ?>"  data-name="<?php echo $cor->course_title; ?>"  data-prof="<?php echo $cor->profession_name; ?>" data-pdf="<?php echo base_url('assets/images/ce_provider/'.$cor->course_pdf); ?>"  data-image="<?php echo base_url('assets/images/ce_provider/'.$cor->course_image); ?>" data-desc="<?php echo $cor->description; ?>"  class="btn btn-info viewCourse" title="View course pdf">View</a>
                                                        <!-- if course is already reviewed than cep can't resubmit pdf... -->
                                                        <?php if($cfc > 0 && $cor->reviewer_status == '0'): ?>
                                                            <a href="javascript:void(0)" id="<?php echo $cor->cor_doc_id; ?>" data-id="<?php echo $cor->provider_id; ?>" data-name="<?php echo $cor->course_title; ?>" data-value="<?php echo $cfc[0]->reviewer_email; ?>" class="btn btn-info reSubmit" title="Re-submit course">Re-submit</a>
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
    </section>

    <div class="modal fade r-board-modal show" id="cepviewCourse" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    VIEW UPLOADED COURSE 
                </div>
                <div class="modal-body">
                    <form>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Course Title : </label>
                        <label class="col-md-8" id="pcourse_title">ABC</label>
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Course Image : </label>
                        <label class="col-md-8"><img src="" alt="" id="pcourse_image"  width="250"></label>
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Upload Course PDF : </label>
                        <label class="col-md-8"><a href="" id="pcourse_pdf" target="_blank">View PDF</a></label>
                    </div>
                    <!-- <div class="form-group row px-3">
                        <label class="col-md-3">Course Units : </label>
                        <label class="col-md-8" id="pcourse_unit">12</label>
                    </div> -->
                    <div class="form-group row px-3">
                        <label class="col-md-3">Course Description : </label>
                        <label class="col-md-8" id="pcourse_discription">  </label>
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Profession <sup>(Who can take this course?) : </sup></label>
                        <label class="col-md-8" id="pcourse_profesion">accountant</label>    
                    </div>
                    <div class="form-group row px-3">
                        <label class="col-md-3">Course price : </label>
                        <label class="col-md-8" id="pcourse_price">$10</label>
                    </div>
                    <div class="form-group row mb-0 text-center">
                        <button class="btn btn-primary text-uppercase" onclick="close_ce_popup('cepviewCourse')"> Close </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   

    <div class="modal fade r-board-modal show" id="resubmitCourse" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    
                <div class="modal-header r-board-modal-heading d-flex  align-items-center justify-content-center">
                    Re-upload Course 
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('ce-provider/ce_provider/resubmitCourse'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row px-3">
                        <label class="col-md-3">Course Title : </label>
                        <label class="col-md-8" id="recourse_title"></label>
                        <input type="hidden" name="cid" id="re_cid">
                        <input type="hidden" name="course_name" id="re_course_name">
                        <input type="hidden" name="provider_id" id="re_provider_id">
                        <input type="hidden" name="reviewer_email" id="re_reviewer_email">
                    </div>
                    <div class="form-group row px-3">
                        <label>Re-upload Course PDF (only pdf formate allowed) : </label>
                        <input type="file" name="upload_course" class="form-control" accept="application/pdf, application/vnd.ms-excel" required>
                    </div>

                    <div class="offset-4">
                        <input type="submit" class="btn btn-success text-uppercase" value="Re-submit" name="submit">
                        <a class="btn btn-primary text-uppercase" onclick="close_ce_popup('resubmitCourse')"> Close </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   


<script>
$('.viewCourse').on('click',function(){
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
    $('#cepviewCourse').modal('show');
});


$('.reSubmit').on('click',function(){
    var cid = $(this).attr('id');
    var provider_id = $(this).attr('data-id');
    var title = $(this).attr('data-name');
    var reviewer_email = $(this).attr('data-value');
    // console.log(title);
    $('#recourse_title').html(title);
    $('#re_provider_id').val(provider_id);
    $('#re_cid').val(cid);
    $('#re_course_name').val(title);
    $('#re_reviewer_email').val(reviewer_email);
    $('#resubmitCourse').modal('show');
});

//for viewPdf, Please check in sidebar

function deletecourse(course_id){
   var x = confirm('do you really want to delete this file!');
    if(x == true){
        window.location.href = "<?php echo base_url('ce-provider/ce_provider/delete_course/');?>"+course_id;
    }
}
</script>