<?php 
//print_r($universitydetailsarr);
$logo = ($universitydetailsarr->college_logo !="" && file_exists('./assets/images/university/'.$universitydetailsarr->college_logo))?'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/'.$universitydetailsarr->college_logo).'" width="200px" height="200px">':'<img class="img-fluid img-rounded d-block mx-auto" src="'.base_url('assets/images/university/default-logo.png').'" width="120px" height="120px">';
$unreadnotifications = $this->university_model->get_unread_notifications($this->session->userdata('uniid')); 
$graducatesubmited = $this->university_model->school_graduatessubmited($this->session->userdata('uniid')); 
//echo $this->db->last_query(); exit;
$univCertificate = $this->university_model->get_certificate($this->session->userdata('uniid')); 
//print_r($univCertificate); 
//print_r($universitydocument);
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
<section class="dashboard-heropanel jumbotron py-lg-4 py-3 border-bottom border-primary mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white p-2 universityinfobox">
                        <?php echo $logo; ?>
                        <h5 class="mt-3"><?php echo $universitydetailsarr->university_name;?></h5>
						<p><?php echo $universitydetailsarr->address;?></p>
						<?php
							//echo '<pre>'; print_r($universitydetailsarr);
						?>
                         <p><strong>Accreditation no: </strong><?php echo (isset($universitydocument->accreditation_number) && $universitydocument->accreditation_number != "")?$universitydocument->accreditation_number:'N/A';?></p>
						 <?php
							if(isset($universitydocument->expiry_at) && $universitydocument->expiry_at > date('Y-m-d') ){
						 ?>
                         <p><strong>Validity Date: </strong><?php echo date("M d, Y",strtotime($universitydocument->expiry_at));?></p>
							<?php } ?>
						<p>
							
							<div class="notificationbell">
								<a class="noticationcount" href="<?php echo base_url('university/university/notification');?>"><i class="fa fa-bell"></i>
								<span><?php echo is_array($unreadnotifications) ? count($unreadnotifications) :0;?></span>
								</a>
								<?php if(isset($univCertificate->reviewer_status) && $univCertificate->reviewer_status == 1 && isset($universitydocument->accreditation_number) &&  $universitydocument->accreditation_number !=""){ ?>
								<a href="javascript:void(0);" onclick="viewunicertifcate()"><i class="fa fa-certificate"></i></a>
								<?php } ?>
							</div>
						
							
						</p>	
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="text-center d-inline-block w-100 h-50 text-white bg-success p-2 rounded">
                               <h4 class="pt-4"><?php echo is_array($graducatesubmited) ? count($graducatesubmited):0;?></h4>
                            </div>
                            <h6 class="py-3 text-center">Total Graduates Submitted</h6>
							<div class="row">
								<div class="col-lg-6">
									<a href="<?php echo base_url('university/university/submissionofgraduates');?>"><button type="button" class="btn btn-info bg-success w-100">Submit Graduates</button></a>
								</div>	
								<div class="col-lg-6">
									<a href="<?php echo base_url('university/university/graducateform');?>"><button type="button" class="btn btn-info bg-success w-100">Add Graduates</button></a>
								</div>	
							</div>	
                        </div>
                        <div class="col-lg-5">
                            <div class="text-center d-inline-block w-100 h-50 text-white bg-secondary p-2 rounded">
                                <h4 class="pt-2"><?php 
								if(isset($universitydocument->expiry_at)){
									$validity_date = $universitydocument->expiry_at;
									$date1 = new DateTime($validity_date);
									$date2 = new DateTime(date('Y-m-d'));
									$interval = $date1->diff($date2);
									//print_r($interval);
									echo $interval->days;
									?></h4>
									<span>Days Remaining</span>
								<?php } ?>
                            </div>
                            <h6 class="py-3 text-center">Accreditation Status:
							<?php 
								if(isset($universitydocument->reviewer_status) && $universitydocument->reviewer_status==1){
									echo 'Valid';
								}elseif(isset($universitydocument->reviewer_status) && $universitydocument->reviewer_status==2){
									echo 'Rejected';
								}else{
									echo 'Pending';
								}
							?></h6>
							<div class="row">
								<div class="col-lg-6">
									<?php 
									if(isset($universitydocument->expiry_at)){
									if($interval->days > 1){ 
									
										$cliack = ($universitydocument->accreditation_number !="")?'onclick="viewunicertifcate()"':'';
									?>
									<?php //echo base_url('university/university/digitalrenewaccreditation');?>
									<a href="javascript:void(0);"><button type="button" <?php echo $cliack;?> class="btn btn-info bg-secondary w-100">Accreditation Certificate</button></a>
									<?php } } ?>
								</div>
								<div class="col-lg-6">
									<?php //if($interval->days < 90){ ?>
									<a href="<?php echo base_url('university/university/renewuniversity');?>"><button type="button" class="btn btn-info bg-secondary w-100">Renew Application</button></a>
									<?php //} ?>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
	
	<div class="modal fade" id="viewunicrtifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Certificate
        <!--<button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>-->
        <!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Body part -->
		<div id="crtdetials"></div>
        <!-- end Body part -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<script>
	function viewunicertifcates(){
		$('#viewunicrtifModal').modal('show');
	}
	function viewunicertifcate(){
	
		var accr = '<?php echo $universitydocument->accreditation_number;?>';
	if(accr !=''){
		var url = '<?php echo base_url("assets/uploads/pdf/"); ?>'+accr+'.pdf';
		// alert(url);
		var result = '<iframe src="'+url+'" width="100%" height="750" style="border:1px solid black;"></iframe>';
		$('#crtdetials').html(result); 
		$('#viewunicrtifModal').modal('show'); 
	}
	}
</script>	