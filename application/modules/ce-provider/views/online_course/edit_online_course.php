<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('dashboard_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                
                <div class="col-lg-9 col-md-8">
                  <div class="card">
                    <div class="card-header">
				              <h4 class="text-uppercase text-center">Edit Online Course</h4>
                    </div>
                    <div class="card-body">
                    <?php echo $this->session->flashdata('response'); ?>
                    <form action="<?=current_url();?>" id="editcourse" name="editcourseacc" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course Title</label>
                           <input type="text" name="course_title" class="form-control" value="<?php echo $course->course_title; ?>" required>
                           <input type="hidden" name="cor_doc_id" value="<?php echo $course->cor_doc_id; ?>">
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">course Image</label>
                           <input type="file" name="course_image" class="form-control" accept="image/*">
                           <input type="hidden" name="old_course_image" value="<?php echo $course->course_image; ?>">
                           <img src="<?php echo base_url('assets/images/ce_provider/').$course->course_image; ?>" alt="" width="250">
                       </div>
                        <div class="form-group row px-3">
                           <label class="col-md-10">Upload course PDF</label>
                           <input type="file" name="course_pdf" class="form-control" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                           <input type="hidden" name="old_course_pdf" value="<?php echo $course->course_pdf; ?>">
                           <a href="<?php echo base_url('assets/images/ce_provider/'.$course->course_pdf); ?>" target="_blank">View PDF</a>
                           <input type="hidden" name="provider_id" class="form-control" value="<?php echo $this->session->userdata('login')['user_ID']; ?>">
                       </div>

                       <!-- <div class="form-group row px-3">
                           <label class="col-md-10">course Units</label>
                           <input type="number" name="course_units" class="form-control" min="1" required>
                       </div> -->
                     
                       <div class="form-group row px-3">
                           <label class="col-md-10">Profession <sup>(Who read this course)</sup></label>
                           <select name="profession[]" class="form-control" multiple>
                                <option value="">Please select profession</option>
                                <?php foreach($profession_list as $key => $profession){ 
                                      $profession_id = explode(',',$course->profession); ?>
                                <option value="<?php echo $profession->id; ?>" <?php if($profession->id == $profession_id[$key]){ echo 'selected'; } ?>><?php echo $profession->name; ?></option>
                                <?php } ?>
                           </select>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course Short Description</label>
                           <textarea name="description" class = "form-control"  required><?php echo $course->description; ?></textarea>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Course Price</label>
                           <input type="number" name="course_price" class="form-control" step=".01" required value="<?php echo $course->course_price; ?>">
                       </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                            <input type="submit" class="btn btn-success text-uppercase" name="update" value="Update">
                            <a href="<?php echo base_url('ce-provider/ce_provider/onlinecourse'); ?>" class="btn btn-primary text-uppercase">Back</a>
                            </div>
                        </div>
                    </form>
                    <div>
                  </div>

                </div>
            </div>
        </div>
    </section>

