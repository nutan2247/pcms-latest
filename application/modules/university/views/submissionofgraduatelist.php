<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

//print_r($grduatelistingarr); exit;

?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title; ?></h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
          <a href="#" class="stepActive">
                <span><strong>1</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>School Information</label>
            </a>         
        </div>
        <div class="col-2" >
            <a href="#" class="stepProcess">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>List of Graduates</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Review of Graduates</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Exam Code</label>
            </a>        
        </div>
    </div>

    <div class="col-md-12">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
            <?php echo $this->session->flashdata('error'); ?>
			<?php
				$message = $this->session->flashdata('item');
				if(isset($message)) {
				?>
				<div class="row"><div class="box-body col-md-12">
					<div class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></div>
				</div>
				</div>
				<?php } ?>
				
            <?php 
				if($grduatelistingarr){
			echo form_open_multipart('university/university/graducatelicencepayment',array('id'=>'submissiongraduatelistForm')); ?>
            <div class="form-group table-responsive row">
               <table class="table table-bordered">
						<tbody><tr>
							<th>Sl No.</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last name</th>
							<th>Photo</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Email</th>
							<th>Course</th>
							<th>Date Graduated</th>
							<th>Attachments</th>
							<!--<th>Action</th>-->
						</tr>
						<?php 
							$count = 1;
							foreach($grduatelistingarr as $gradlist){
								$photo = (file_exists('./assets/images/graduates/'.$gradlist->photo))?base_url('assets/images/graduates/'.$gradlist->photo):base_url('assets/images/user_icon.png');
								$deploma = ($gradlist->diploma !="")?'<a class="viewdocument" data-id="'.$gradlist->diploma.'" href="javascript:void(0);">Diploma</a>':'';
								$otr = ($gradlist->official_transcription !='')?' / <a class="viewdocument" data-id="'.$gradlist->official_transcription.'" href="javascript:void(0);">OTR</a>':'';
								echo '<tr>
									<td>'.$count++.'.</td>
									<td>'.$gradlist->student_name.'</td>
									<td>'.$gradlist->middle_name.'</td>
									<td>'.$gradlist->surname.'</td>
									<td><img src="'.$photo.'" width="100" height="80"/></td>
									<td>'.$gradlist->dob.'</td>
									<td>'.$gradlist->gender.'</td>
									<td>'.$gradlist->email.'</td>
									<td>'.$gradlist->collegeofname.'</td>
									<td>'.$gradlist->date_of_graduated.'</td>
									<td>'.$deploma.$otr.'</td>
									<input type="hidden" name="grad_id[]" id="grad_id'.$gradlist->grad_id.'" value="'.$gradlist->grad_id.'">
								</tr>';
							}
						?>	
						
						</tbody>
						</table>
            </div>
			
            
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submitBtn">Submit</button>
                </div>
            </div>
            <?php 
			echo form_close(); 
				}else{
					echo '<p style="text-align:center;">There are no graducates for submition.</p>';
				}
			?>
			
        </div>
    </div>
</div>
<div class="modal fade certificate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- body -->
	   
		<div id="crtdetials"></div>
      <!-- end body -->
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
<script>
$(".viewdocument").click(function() {
	var docid = $(this).data("id");
	if(docid != ""){
		var url = '<?php echo base_url("assets/images/graduates/"); ?>'+docid;
		//alert(url);
        var result = '<iframe src="'+url+'" width="300" height="450" style="border:0px solid black;"></iframe>';
		$('#crtdetials').html(result); 
		$('.certificate-modal').modal('show'); 
	}
  
});  
</script>