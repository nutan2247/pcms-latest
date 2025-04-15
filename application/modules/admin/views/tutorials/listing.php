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
                    <a class="nav-link active" id="pills-pending-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-pending" aria-selected="false">All</a>
                  </li>

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#school" role="tab" aria-controls="pills-pending" aria-selected="false">School</a>
                  </li>

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#professional" role="tab" aria-controls="pills-all" aria-selected="true">PROFESIONAL</a>
                  </li>

                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#ceprovider" role="tab" aria-controls="pills-pending" aria-selected="false">CE-Provider</a>
                  </li>


                </ul>


        <div class="tab-content mt-1" id="myTabContent" style="background:#f5f0ea; padding: 20px;">
                   
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="card-body">
                <h4 class="tab-title">ALL </h4>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if(count($tutorials)>0){ ?>
                      <div class="training-semi-slider-6 pagi-above">
                          <?php foreach ($tutorials as $key => $value) { ?> 
                            <?php if(!empty($value['uploadvideo'])){ ?>
                            <div class="item">
                              <div class="training-semi">
                                <div class="new-training-box">

                                  <?php echo $value['type'];?>
                                  <div class="training-box-image">
                                    <video width="320" height="240" controls>
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo']; ?>" type="video/mp4">
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo'];?>" type="video/ogg">
                                      Your browser does not support the video tag.
                                    </video>
                                  </div>
                                  <?php echo $value['title'];?>
                                </div>
                              </div>
                            </div>
                          <?php } ?> 
                          <?php } ?> 
                      </div>
                    <?php } else { ?>
                    <div class="pagi-above">Record not found.</div>
                    <?php } ?>
                    </div> 
                </div> 
              </div> 
          </div>       

          <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">
                <h4 class="tab-title">Schools <a href="javascript:void(0)" onclick="popAddTutorial('school');" class="btn btn-info float-right">UPLOAD FILE</a></h4>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if(count($schools)>0){ ?>
                      <div class="training-semi-slider-6 pagi-above">
                          <?php foreach ($schools as $key => $value) { ?> 
                            <?php if(!empty($value['uploadvideo'])){ ?>
                            <div class="item">
                              <div class="training-semi">
                                <div class="new-training-box">

                                  <?php echo $value['type'];?>
                                  <div class="training-box-image">
                                    <video width="320" height="240" controls>
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo']; ?>" type="video/mp4">
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo'];?>" type="video/ogg">
                                      Your browser does not support the video tag.
                                    </video>
                                  </div>
                                  <?php echo $value['title'];?>
                                </div>
                              </div>
                            </div>
                          <?php } ?> 
                          <?php } ?> 
                      </div>
                    <?php } else { ?>
                    <div class="pagi-above">Record not found.</div>
                    <?php } ?>
                    </div> 
                </div> 
            </div> 
          </div>

          <div class="tab-pane fade" id="professional" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">
                <h4 class="tab-title">Professional <a href="javascript:void(0)" onclick="popAddTutorial('professional');" class="btn btn-info float-right">UPLOAD FILE</a></h4>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if(count($professionals)>0){ ?>
                      <div class="training-semi-slider-6 pagi-above">
                          <?php foreach ($professionals as $key => $value) { ?> 
                            <?php if(!empty($value['uploadvideo'])){ ?>
                            <div class="item">
                              <div class="training-semi">
                                <div class="new-training-box">

                                  <?php echo $value['type'];?>
                                  <div class="training-box-image">
                                    <video width="320" height="240" controls>
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo']; ?>" type="video/mp4">
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo'];?>" type="video/ogg">
                                      Your browser does not support the video tag.
                                    </video>
                                  </div>
                                  <?php echo $value['title'];?>
                                </div>
                              </div>
                            </div>
                          <?php } ?> 
                          <?php } ?> 
                      </div>
                    <?php } else { ?>
                    <div class="pagi-above">Record not found.</div>
                    <?php } ?>
                    </div> 
                </div> 
            </div> 
          </div>

          <div class="tab-pane fade" id="ceprovider" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="card-body">
                <h4 class="tab-title">CE Provider <a href="javascript:void(0)" onclick="popAddTutorial('ceprovider');" class="btn btn-info float-right">UPLOAD FILE</a></h4>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if(count($ceproviders)>0){ ?>
                      <div class="training-semi-slider-6 pagi-above">
                          <?php foreach ($ceproviders as $key => $value) { ?> 
                            <?php if(!empty($value['uploadvideo'])){ ?>
                            <div class="item">
                              <div class="training-semi">
                                <div class="new-training-box">

                                  <?php echo $value['type'];?>
                                  <div class="training-box-image">
                                    <video width="320" height="240" controls>
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo']; ?>" type="video/mp4">
                                      <source src="<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo'];?>" type="video/ogg">
                                      Your browser does not support the video tag.
                                    </video>
                                  </div>
                                  <?php echo $value['title'];?>
                                </div>
                              </div>
                            </div>
                          <?php } ?> 
                          <?php } ?> 
                      </div>
                    <?php } else { ?>
                    <div class="pagi-above">Record not found.</div>
                    <?php } ?>
                    </div> 
                </div> 
            </div> 
          </div>

        </div>
        
        <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl.no.</th>
                                <!-- <th>Subject</th>  -->
                                <th>Title</th> 
                                <th>Discription</th> 
                                <th>Video</th> 
                                <th>Url</th> 
                                <th>Type</th> 
                                <th>Status</th> 
                                <!-- <th>Show on Support page</th>  -->
                                <th>Added on</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1;
             foreach ($tutorials as $key => $value) {  
                    if($value['status']==1){
                      $stts = "Active";
                      $col  = "green";
                    }else{
                      $stts = "Inactive";
                      $col  = "red";
                    } 
                    if($value['show_on_faq']==1){
                      $show   = "Yes";
                      $color  = "green";
                    }else{
                      $show = "No";
                      $color  = "red";
                    } 

                    if(strpos($value['url'], 'youtube') > 0){
                      $explodeurl = explode('=',$value['url']);
                      $urlstring = $explodeurl[1];
                      
                      $url = substr($urlstring,0,11);
                      // print_r( $url );
                      $urlt = '<i class="fas fa-play"></i>';
                      $btnclass = 'class="btn btn-danger"';
                    }else{
                      $url = 'Not a Youtube Url';
                      $urlt = 'Not a Youtube Url';
                      $btnclass = '';
                    }
                    if(!empty($value['uploadvideo'])){
                      $video = base_url('assets/').'uploads/tutorials/'.$value['uploadvideo'];
                      $vid = '<i class="fas fa-play"></i>'; 
                    }else{
                      $video = '--';
                      $vid = '--';
                    }

            ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <!-- <td><?php if($value['subject']!=''){ echo $value['subject']; }else{ echo'--'; } ?></td> -->
                                <td><?php echo $value['title'];?></td>
                                <td><?php echo substr($value['discription'],0,200);?>...</td> 
                                <td><a href="javascript:void(0)" class="btn btn-danger" onclick="play('<?php echo $video; ?>')"><?php echo $vid; ?></a></td> 
                                <td><a href="javascript:void(0)" <?php echo $btnclass;?> onclick="playvideo('<?php echo $url;?>')"><?php echo $urlt;?></a></td> 
                                <td><?php echo $value['type'];?></td> 
                                <td style="color: <?php echo $col;?>"><?php echo $stts;?></td>  
                                <!-- <td style="color: <?php echo $color;?>"><?php echo $show;?></td>    -->
                                <td><?php echo $value['added_on'];?></td> 
                                <td colspan="3">
                                  <!--   <a class="btn btn-primary viewt" href="javascript:void(0)" onclick="play('<?php echo base_url('assets/').'uploads/tutorials/'.$value['uploadvideo'];?>')">
                                    <i class="fas fa-play"></i></a> -->
                                  <a href="javascript:void(0)" class="btn btn-primary mb-2" onclick="editTutorial('<?=$value['id']?>')" title="Edit"><i class="fas fa-edit"></i></a>
                                  <a href="<?php echo base_url().'admin/tutorialdelete/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure, Do you want to DELETE this!')" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php $count++; } ?>
                        </tbody>
                    </table>
                </div>

          </div>
        </div>
        </div>
    </main>

   

  <div class="modal fade" id="addTutorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Upload Tutorial Videos for <span id="upload" style="text-transform: capitalize;"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

              <form action="<?php echo base_url().'admin/addTutorialVideo';?>" method="post" enctype="multipart/form-data" name="tutorial">
                <?php echo validation_errors(); ?>  
                <div class="modal-body"> 
                    <!-- <p>
                        <label>Subject <span class="required text-danger"> * </span> </label>
                        <input name="subject" value="" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('subject'); ?></span>
                    </p>  -->
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="" size="20" type="text" class="form-control" required>
                        <input name="type" value="" id="type" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    </p>
                   <!--  <p>
                        <label>Thumbnail Photo</label>
                        <input name="thumbphoto" value="" size="20" type="file" class="form-control">
                        <span class="error"><?php echo  form_error('thumbphoto'); ?></span>
                    </p> -->
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" class="form-control" placeholder="Write Some Lines about this Video..." required></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>
                            
                    </p>
                    <p class="temppreview">
                        <label>Upload Video</label>
                        <input name="uploadvideo" type="file" class="form-control">
                        <span class="error"><?php echo  form_error('uploadvideo'); ?></span>
                    </p>
                    <p class="temppreview">
                        <label>Youtube Video Url</label>
                        <input name="url" type="url" class="form-control" id="">
                        <span class="error"><?php echo  form_error('url'); ?></span>
                    </p>    
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Upload" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editTutorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Tutorial Videos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

              <form action="<?php echo base_url().'admin/editTutorialVideo';?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <?php echo validation_errors(); ?>  
                <div class="modal-body"> 
                    <p>
                        <label>Type</label>
                        <input name="type" value="" id="etype" type="text" class="form-control" readonly>
                    </p>
                    <!-- <p>
                        <label>Subject <span class="required text-danger"> * </span> </label>
                        <input name="subject" value="" id="esubject" size="20" type="text" class="form-control" required>
                        <span class="error"><?php echo  form_error('subject'); ?></span>
                    </p>  -->
                    <p>
                        <label>Title <span class="required text-danger"> * </span> </label>
                        <input name="title" value="" id="etitle" type="text" class="form-control" required>
                        <input name="id" value="" id="id" type="hidden" >
                        <span class="error"><?php echo  form_error('title'); ?></span>
                    </p>
                    <p>
                        <label>Description <span class="required text-danger"> * </span> </label>
                        <textarea name="discription" id="ediscription" class="form-control" placeholder="Write Some Lines about this Video..." required></textarea> 
                        <span class="error"><?php echo  form_error('discription'); ?></span>
                    </p> 
                    <p>
                        <label>Status</label>
                        <select name="status" class="form-control" id="estatus">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p>
                    <!-- <p>
                        <label>Show on support page</label>
                        <select name="show_on_faq" class="form-control" id="eshow_on_faq">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                        <span class="error"><?php echo  form_error('status'); ?></span>
                    </p> -->
                    <p class="temppreview">
                        <label>Upload New Video</label>
                        <input name="uploadvideo" type="file" class="form-control" >
                       <!--  <video width="320" height="240" controls>
                            <source id="euploadvideo"  src="" type="video/mp4">
                            <source  id="euploadvideo" src="" type="video/ogg">
                            Your browser does not support the video tag.
                        </video> -->
                        <span class="error"><?php echo  form_error('uploadvideo'); ?></span>
                    </p> 
                    <p class="temppreview">
                        <label>Youtube Video Url</label>
                        <input name="url" type="url" class="form-control" id="eurl">
                        <span class="error"><?php echo  form_error('url'); ?></span>
                    </p>   
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Upload" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 
   <div class="modal fade" id="platTutorialvideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Play Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center"> 
              
            <embed width="320" height="240" id="playvideo" src="" ></embed> 
               <video width="320" height="240" controls>
                  <source  id="playvideo" src="" type="video/mp4">
                  <source  id="playvideo" src="" type="video/ogg">
                  Your browser does not support the video tag.
                </video>     
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="playceonpointvideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Ceonpoint Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" id="urlcevideo">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="playurlvideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" id='videotutorial'>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

function playvideo(url){
$('#videotutorial').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+url+'" frameborder="0" allowfullscreen ></iframe>');
$('#playurlvideo').modal('show');
}

function play(url){
  $('#urlcevideo').html('<iframe width="100%" height="315" src="'+url+'" frameborder="0" allowfullscreen ></iframe>');
  $('#playurlvideo').modal('hide');
  $('#playceonpointvideo').modal('show'); 	
}

 function popAddTutorial(upload) {
  // alert(upload);
  $('#addTutorial').modal('show');
  $('#upload').html(upload);
  $('#type').val(upload);

}

function editTutorial(id) {
  // $('#editTutorial').modal('show');
  // $('#id').val(id);
  $.ajax({
          type: "POST",
          url: '<?php echo base_url("admin/getTutorialVideo");?>',
          data: { id : id},
          success: function(result){
            obj = jQuery.parseJSON(result);
            // alert(obj.title);
            var link = '<?php echo base_url('assets/uploads/tutorials')?>';
              // $('#certinutan').html(result);
              $('#editTutorial').modal('show');
              $('#esubject').val(obj.subject);
              $('#etitle').val(obj.title);
              $('#id').val(obj.id);
              $('#ediscription').val(obj.discription);
              $('#euploadvideo').attr('src',link+obj.uploadvideo);
              $('#etype').val(obj.type);
              $('#estatus').val(obj.status);
              $('#eshow_on_faq').val(obj.show_on_faq);
              $('#eurl').val(obj.url);
          }
      });
}
</script>
