<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 
	<?php $this->view('professional_top'); ?>
    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
                    <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $page_title; ?></h4>
                    <?php echo $this->session->flashdata('response'); ?>
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>License No.</th>
                                    <!--<th>Registration Number</th>-->
                                    <th>Date Issued</th>
                                    <!--<th>Expiry date</th>-->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; 
                            //echo '<pre>'; print_r($doc);
                            if(!empty($doc)){
                                // foreach($alllicense as $value){ 
                                
                                if($doc->expiry_at >= date('Y-m-d'))
        						{
                                    $cardstatus =  "<strong class='text-success'>Valid</strong>";
        						} else {
        							$cardstatus =  "<strong class='text-danger'>Expired</strong>";
        						} ?>
                                <tr>
                                    <td>1</td>
                                    <td><?=$doc->license_no;?></td>
                                    <!--<td><?=$doc->registration_no;?></td>-->
                                    <td><?=date('F d, Y', strtotime($doc->lic_issue_date));?></td>
                                    <!--<td><?=date('F d, Y', strtotime($doc->expiry_at));?></td>-->
                                    <td><?=$cardstatus; ?> </td>
                                    <td> <a href="javascript:void(0)" title="License Cert" class="btn btn-info viewcert"  data-id="<?=$doc->refrence_code;?>" ><i class="fa fa-eye"></i></a> </td>
                                </tr>
                            <?php  }else{ echo 'No data found!'; }?>
                            </tbody>
                        </table>
                        </div>
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
            <h4 class="modal-title">View Card </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
           <iframe src="" id="certificatecontent" frameborder="1" width="750" height="850" ></iframe>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

    <script>
        function view_card(photo){
            var url ="<?php echo base_url('assets/uploads/card/');?>"+photo;
            $('#certificatecontent').attr('src',url);
            $('#certificateModal').modal('show');
        }

        $('.viewcert').on('click', function(){
            var licenseno = $(this).attr("data-id");
            if(licenseno){
                var path = "<?php echo base_url('assets/uploads/pdf/');?>"+ licenseno +"cert.pdf";
            // alert(path);
                $('#carddetials').attr('src',path); 
                $('#certificate-modal').modal('show');
            }else{
                alert('No license number found !');
            }
        });
    </script>