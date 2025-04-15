<style>
    #myTabContent {
        border: 1px solid #efefef;
        margin-top: -1px;
    }

    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #007bff;
        border-color: #007bff !important;
    }

    #o-all .nav-link.active {
        color: #fff !important;
        background-color: #000;
        border-color: #000 !important;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
                 <?php echo $this->session->flashdata('response'); ?>
            <div>

                 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link active" id="pills-pending-tab" data-toggle="pill" href="#school" role="tab" aria-controls="pills-pending" aria-selected="false">School</a>
                  </li>

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#professional" role="tab" aria-controls="pills-all" aria-selected="true">PROFESIONAL</a>
                  </li>

                  <!-- <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#authorCeonpoint" role="tab" aria-controls="pills-pending" aria-selected="false">AUTHOR-CEONPOINT</a>
                  </li> -->

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#ceprovider" role="tab" aria-controls="pills-all" aria-selected="false">CE-Provider</a>
                  </li>
                </ul>


        <div class="tab-content mt-1" id="myTabContent" style="background:#f5f0ea; padding: 20px;">
                   
            <div class="tab-pane fade show active" id="school" role="tabpanel" aria-labelledby="pills-all-tab">
              <div class="card">
                <div class="card-header">
                  <h4 class="tab-title">SCHOOL</h4>
                </div>
                <div class="card-body">
                      <form action="<?php echo base_url('admin/editTerms'); ?>" method="post" enctype="multipart/form-data" name="professionalform1" id="professionalform1"> 
                      <div class="row">
                        <div class="col-md-12">
                        
                            <p>
                                <label>Type</label>
                                <input name="type" value="<?php echo ($school['type'] !='')?$school['type']:'school'; ?>" id="etype" type="text" class="form-control" readonly>
                                <span class="error"><?php echo  form_error('type'); ?></span>
                            </p>
                            <p>
                                <label>Title <span class="required text-danger"> * </span> </label>
                                <input name="title" value="<?php echo ($school['title'] !='')?$school['title']:set_value('title'); ?>" id="etitle" type="text" class="form-control" required>
                                <input name="id" value="<?php echo ($school['id'] !='')?$school['id']:''; ?>" id="id" type="hidden" >
                                <span class="error"><?php echo  form_error('title'); ?></span>
                            </p>
                            <p>
                                <label>Description <span class="required text-danger"> * </span> </label>
                                <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" rows="25" placeholder="Write Some Lines..." required><?php echo ($school['discription'] != '')?$school['discription']:set_value('discription'); ?></textarea> 
                                <span class="error"><?php echo  form_error('discription'); ?></span>    
                            </p> 
                            <p>
                                <label>Status</label>
                                <select name="status" class="form-control" id="estatus">
                                  <option value="1" <?php if($school['status'] !=''){if($school['status']==1){ echo 'selected'; }}elseif(set_value('status')==1){echo 'selected';} ?> >Active</option>
                                  <option value="0" <?php if($school['status'] !=''){if($school['status']==0){ echo 'selected'; }}elseif(set_value('status')==0){echo 'selected';} ?> >Inactive</option>
                                </select>
                                <span class="error"><?php echo  form_error('status'); ?></span>
                            </p>  
                            <p>  
                              <input class="btn btn-primary" value="<?=(isset($school))?'Update':'Save';?>" name="pro-submit" type="submit">
                            </p> 
                        
                        </div>
                      </div>
                      </form> 
                      
                  </div>
                </div> 
            </div>       
            <div class="tab-pane fade" id="professional" role="tabpanel" aria-labelledby="pills-all-tab">
              <div class="card">
                <div class="card-header">
                  <h4 class="tab-title">PROFESIONAL</h4>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('admin/editTerms'); ?>" method="post" enctype="multipart/form-data" name="professionalform1" id="professionalform1"> 
                      
                      <div class="row">
                      <div class="col-md-12">
                            <p>
                                <label>Type</label>
                                <input name="type" value="<?php echo ($professionals['type'] !='')?$professionals['type']:'professional'; ?>" id="etype" type="text" class="form-control" readonly>
                                <span class="error"><?php echo  form_error('type'); ?></span>
                            </p>
                            <p>
                                <label>Title <span class="required text-danger"> * </span> </label>
                                <input name="title" value="<?php echo ($professionals['title'] !='')?$professionals['title']:set_value('title'); ?>" id="etitle" type="text" class="form-control" required>
                                <input name="id" value="<?php echo ($professionals['id'] !='')?$professionals['id']:''; ?>" id="id" type="hidden" >
                                <span class="error"><?php echo  form_error('title'); ?></span>
                            </p>
                            <p>
                                <label>Description <span class="required text-danger"> * </span> </label>
                                <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" rows="25" placeholder="Write Some Lines about this Video..." required><?php echo ($professionals['discription'] != '')?$professionals['discription']:set_value('discription'); ?></textarea> 
                                <span class="error"><?php echo  form_error('discription'); ?></span>    
                            </p> 
                            <p>
                                <label>Status</label>
                                <select name="status" class="form-control" id="estatus">
                                  <option value="1" <?php if($professionals['status'] !=''){if($professionals['status']==1){ echo 'selected'; }}elseif(set_value('status')==1){echo 'selected';} ?> >Active</option>
                                  <option value="0" <?php if($professionals['status'] !=''){if($professionals['status']==0){ echo 'selected'; }}elseif(set_value('status')==0){echo 'selected';} ?> >Inactive</option>
                                </select>
                                <span class="error"><?php echo  form_error('status'); ?></span>
                            </p> 
                            <p>  
                              <input class="btn btn-primary" value="<?=(isset($professionals))?'Update':'Save';?>" name="pro-submit" type="submit">
                            </p> 
                      </div>
                    </div>
                   
                  </form>

              </div> 
            </div>
          </div>

                <!-- <div class="tab-pane fade" id="authorCeonpoint" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="card-body">
                      <form action="<?php echo base_url('admin/editTerms'); ?>" method="post" enctype="multipart/form-data" name="professionalform1" id="professionalform1"> 
                          <h4 class="tab-title">Author</h4>
                          <div class="row">
                          <div class="col-md-12">
                            <?php if(count($authorCeonpoint)>0){  ?>
                                <p>
                                    <label>Type</label>
                                    <input name="type" value="<?php echo $authorCeonpoint['type']; ?>" id="etype" type="text" class="form-control" readonly>
                                    <span class="error"><?php echo  form_error('type'); ?></span>
                                </p>
                                <p>
                                    <label>Title <span class="required text-danger"> * </span> </label>
                                    <input name="title" value="<?php echo $authorCeonpoint['title']; ?>" id="etitle" type="text" class="form-control" required>
                                    <input name="id" value="<?php echo $authorCeonpoint['id']; ?>" id="id" type="hidden" >
                                    <span class="error"><?php echo  form_error('title'); ?></span>
                                </p>
                                <p>
                                    <label>Description <span class="required text-danger"> * </span> </label>
                                    <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" rows="25" placeholder="Write Some Lines about this Video..." required><?php echo $authorCeonpoint['discription']; ?></textarea> 
                                    <span class="error"><?php echo  form_error('discription'); ?></span>    
                                </p> 
                                <p>
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="estatus">
                                      <option value="1" <?php if($authorCeonpoint['status'] == 1){ echo 'selected'; } ?> >Active</option>
                                      <option value="0" <?php if($authorCeonpoint['status'] == 0){ echo 'selected'; } ?> >Inactive</option>
                                    </select>
                                    <span class="error"><?php echo  form_error('status'); ?></span>
                                </p>  
                                
                            <?php } else { ?>
                            <div class="pagi-above">Record not found.</div>
                            <?php } ?>
                          </div>
                        </div>
                        <p><?php if(count($authorCeonpoint)>0){  ?> 
                          <input class="btn btn-primary" value="Update" name="pro-submit" type="submit">
                          <?php } ?>
                        </p>
                      </form>

                    </div> 
                </div> -->

                <div class="tab-pane fade" id="ceprovider" role="tabpanel" aria-labelledby="pills-all-tab">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="tab-title">CE-Provider</h4>
                    </div>
                    <div class="card-body">
                      <form action="<?php echo base_url('admin/editTerms'); ?>" method="post" enctype="multipart/form-data" name="professionalform1" id="professionalform1"> 
                          <div class="row">
                          <div class="col-md-12">
                                <p>
                                    <label>Type</label>
                                    <input name="type" value="<?php echo ($cep['type'] !='')?$cep['type']:'cep'; ?>" id="etype" type="text" class="form-control" readonly>
                                    <span class="error"><?php echo  form_error('type'); ?></span>
                                </p>
                                <p>
                                    <label>Title <span class="required text-danger"> * </span> </label>
                                    <input name="title" value="<?php echo ($cep['title'] !='')?$cep['title']:set_value('title'); ?>" id="etitle" type="text" class="form-control" required>
                                    <input name="id" value="<?php echo ($cep['id'] !='')?$cep['id']:''; ?>" id="id" type="hidden" >
                                    <span class="error"><?php echo  form_error('title'); ?></span>
                                </p>
                                <p>
                                    <label>Description <span class="required text-danger"> * </span> </label>
                                    <textarea name="discription" id="" class="form-control text_editor" style="width:100%;" rows="25" placeholder="Write Some Lines about this Video..." required><?php echo ($cep['discription'] != '')?$cep['discription']:set_value('discription'); ?></textarea> 
                                    <span class="error"><?php echo  form_error('discription'); ?></span>    
                                </p> 
                                <p>
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="estatus">
                                      <option value="1" <?php if($cep['status'] !=''){if($cep['status']==1){ echo 'selected'; }}elseif(set_value('status')==1){echo 'selected';} ?> >Active</option>
                                      <option value="0" <?php if($cep['status'] !=''){if($cep['status']==0){ echo 'selected'; }}elseif(set_value('status')==0){echo 'selected';} ?> >Inactive</option>
                                    </select>
                                    <span class="error"><?php echo  form_error('status'); ?></span>
                                </p>
                                <p>  
                                  <input class="btn btn-primary" value="<?=(isset($cep))?'Update':'Save';?>" name="pro-submit" type="submit">
                                </p>  
                          </div>
                        </div>
                        
                      </form>

                    </div> 
                </div>
                </div>
              </div>
            
            </div>

        </div>

    </main>

