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
				              <h4 class="text-uppercase text-center">Edit Training Course</h4>
                    </div>
                    <div class="card-body">
                    <?php echo $this->session->flashdata('response'); ?>
                    <form action="<?=current_url();?>" id="edittraining" name="edittrainingacc" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Title</label>
                           <input type="text" name="training_title" class="form-control" value="<?php echo $training->training_title; ?>" required>
                           <input type="hidden" name="train_doc_id" value="<?php echo $training->train_doc_id; ?>">
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Image</label>
                           <input type="file" name="training_image" class="form-control" accept="image/*">
                           <input type="hidden" name="old_training_image" value="<?php echo $training->training_image; ?>">
                           <img src="<?php echo base_url('assets/images/ce_provider/').$training->training_image; ?>" alt="" width="250">
                       </div>
                        <div class="form-group row px-3">
                           <label class="col-md-10">Upload Training PDF</label>
                           <input type="file" name="training_pdf" class="form-control" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                           <input type="hidden" name="old_training_pdf" value="<?php echo $training->training_pdf; ?>">
                           <a href="<?php echo base_url('assets/images/ce_provider/'.$training->training_pdf); ?>" target="_blank">View PDF</a>
                           <input type="hidden" name="provider_id" class="form-control" value="<?php echo $this->session->userdata('login')['user_ID']; ?>">
                       </div>

                       <!-- <div class="form-group row px-3">
                           <label class="col-md-10">Training Units</label>
                           <input type="number" name="training_units" class="form-control" min="1" required>
                       </div> -->
                     
                       <div class="form-group row px-3">
                           <label class="col-md-10">Profession <sup>(Who read this course)</sup></label>
                           <select name="profession[]" class="form-control" multiple>
                                <option value="">Please select profession</option>
                                <?php foreach($profession_list as  $key =>  $profession){ 
                                    $profession_id = explode(',',$training->profession); ?>
                                <option value="<?php echo $profession->id; ?>" <?php if($profession->id == $profession_id[$key]){ echo 'selected'; } ?>><?php echo $profession->name; ?></option>
                                <?php } ?>
                           </select>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Short Description</label>
                           <textarea name="description" class = "form-control"  required><?php echo $training->description; ?></textarea>
                       </div>
                       <div class="form-group row px-3">
                           <label class="col-md-10">Training Price</label>
                           <input type="number" name="training_price" class="form-control" step=".01" required value="<?php echo $training->training_price; ?>">
                       </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                            <input type="submit" class="btn btn-success text-uppercase" name="update" value="Update">
                            <a href="<?php echo base_url('ce-provider/ce_provider/trainingcourse'); ?>" class="btn btn-primary text-uppercase">Back</a>
                            </div>
                        </div>
                    </form>
                    <div>
                  </div>

                </div>
            </div>
        </div>
    </section>

