<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
        <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>
        <div class="card mb-4">
            <div class="card-header">
                <a href="<?php echo base_url('admin/certificate_listing')?>" class="btn btn-<?php if(!isset($_REQUEST['cer'])){ echo 'primary'; }else{ echo 'warning'; } ?>">All (<?=$totallisting; ?>)</a>
                <a href="<?php echo base_url('admin/certificate_listing').'?cer=1'?>" class="btn btn-<?php if(isset($_REQUEST['cer']) && $_REQUEST['cer'] ==1){ echo 'primary'; }else{ echo 'warning'; } ?>">New (Unused) (<?=$totalnewlisting; ?>)</a>
                <a href="<?php echo base_url('admin/certificate_listing').'?cer=2'?>" class="btn btn-<?php if(isset($_REQUEST['cer']) && $_REQUEST['cer'] ==2){ echo 'primary'; }else{ echo 'warning'; } ?>">Credited (Used) (<?=$totalusedlisting; ?>)</a>
              
                <form action="<?=current_url(); ?>" style="display:inline-flex;">
                    <div class="form-group pt-3">
                        <!-- <label for="email">Email:</label> -->
                        <input type="date" class="form-control" id="date"  name="date" value="<?= isset($_REQUEST['date']) && $_REQUEST['date']!=''?$_REQUEST['date']:''; ?>">
                    </div>
                    <div class="form-group pt-3">
                        <!-- <label for="email">Email:</label> -->
                        <input type="month" class="form-control" id="month"  name="month" value="<?= isset($_REQUEST['month']) && ($_REQUEST['month']!='')?$_REQUEST['month']:''; ?>">
                    </div>
                    <div class="form-group pt-3">
                        <!-- <label for="pwd">Password:</label> -->
                        <select class="form-control" id="cpd" name="cpd">
                            <option value="">Please choose any CPD</option>
                            <select>
                    </div>
                    <div class="form-group pt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
            </div>

            <div class="card-body">
                <?php echo $this->session->flashdata('item');?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Report Number</th>
                                <th>Reported by</th>
                                <th>Date & Time Reported</th>
                                <th>Certificate No.</th>
                                <th>Course Title</th>
                                <th>Units</th>
                                <th>Date Issued</th>
                                <th>Issuing CPD Provider</th> 
                                <th>Issued to</th> 
                                <th>Email</th>
                                <th>Issued From</th> 
                                <th>Category</th> 
                                <th>Issuing Platform</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($listing){ //echo '<pre>'; print_r($listing);exit;
                                $count = 1; 
                                foreach($listing as $key => $list){
                                    if($list['status']==1){ $status = 'Active'; }else{ $status = 'Inactive'; } ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td><?=$list['id'].date('Y',strtotime($list['added_on']));?></td>
                                <td><?=($list['cep_name']!='')?$list['cep_name']:'--';?></td>
                                <td><?=($list['added_on']!='0000-00-00 00:00:00')?date('M d, Y H:i:s',strtotime($list['added_on'])):'--'; ?></td>
                                <td><?=$list['certificate_id'];?></td>
                                <td><?=$list['course_name'];?></td>
                                <td><?=$list['units'];?></td>
                                <td><?=$list['added_on'];?></td>
                                <td><?=($list['cep_name']!='')?$list['cep_name']:'--';?></td>
                                <td><?=($list['fname']!='')?$list['fname'].' '.$list['lname'].' '.$list['name']:"--"; ?></td>
                                <td><?=$list['user_email']; ?></td>
                                <td><?=$list['issue_from'];?></td>
                                <td><?=($list['category'])?$list['category']:'n/a';?></td>
                                <td><?=$list['issue_by'];?></td> 
                                <td><?=($list['submitted']=='y')?'Credited':'New';?></td>

                                <td>
                                    <a href="<?php echo site_url('admin/certificate_view/').$list['id'];?>" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="javascript:void(0);" class="view_certificate" id="<?=$list['certificate'];?>"  title="View"><i class="fas fa-file"></i></a>
                                </td>
                            </tr>
                            <?php $count++; } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<div id="viewcertificate" class="modal fade modal-fullscreen in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Certificate</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <iframe src="" id="crtpath" height="650" width="100%"></iframe>
                <!-- <img src="" id="crtpath" height="650" width="550" /> -->
            </div>
        </div>
    </div>
</div>
<script>
    $('.view_certificate').on('click',function(){
        var certificate = $(this).attr('id');
        var path = "<?php echo base_url();?>assets/uploads/pdf/"+certificate+".pdf";
        // alert(path);
        $('#crtpath').attr('src',path);
        $('#viewcertificate').modal('show');
    });
</script>