<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
				<h3>Notification</h3>
				
				<p style="text-align:right;">
					<button type="button" class="btn btn-primary replybtn" id="replybtn">Compose</button>
				</p>
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                   
					<a class="nav-link active" id="pills-approved-tab" data-toggle="pill" href="#inbox" role="tab" aria-controls="pills-approved" aria-selected="false">Inbox (<?php echo is_array($get_notifications)?count($get_notifications):0;?>)</a>
                  </li>
				  <li class="border border-secondary rounded mx-1 mb-2 nav-item">
                    <a class="nav-link " id="pills-all-tab" data-toggle="pill" href="#readmessage" role="tab" aria-controls="pills-all" aria-selected="true">Read Message (<?php echo is_array($get_notifications_read)?count($get_notifications_read):0;?>)</a>
                  </li>
				</ul>  
				  <div class="tab-content mt-1" id="myTabContent" style="background:#fff; padding: 20px;">
					<div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="pills-rejected-tab">
					
                  <div class="card-body">
                    <div class="table-responsive">
                        <?php
					$count = 1; 
					if($get_notifications){
						echo '<table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Subject</th>
							<th>Message</th>
							<th>From</th>
							<th>From email</th>
							<th>Sent date</th>
							<th>Action</th>
						</tr>';
						foreach($get_notifications as $gadarr){
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$gadarr->subject.'</td>';
							//echo '<td>'.substr($gadarr->message,0,300).'<span id="dots'.$count.'">...</span><span class="more" id="more'.$count.'">'.substr($gadarr->message,300).'</span><a class="redmorelink" href="javascript:void(0);" onclick="myFunction('.$count.')" id="myBtn'.$count.'">Read more</a></td>';
							echo '<td>'.substr($gadarr->message,0,300).'<span id="dots'.$count.'">...</span><span class="more" id="more'.$count.'">'.substr($gadarr->message,300).'</span><a class="redmorelink" href="'.base_url('university/university/notification_details/'.$gadarr->uninot_id).'">Read more</a></td>';
							echo '<td>'.$gadarr->from.'</td>';
							echo '<td>'.$gadarr->from_email.'</td>';
							echo '<td>'.$gadarr->sent_at.'</td>';
							echo '<td><a href="javascript:void();" class="replybtn">Reply</a></td>';	
							echo '</tr>';
						}
						echo '</table>';
					}else{
						echo '<p style="text-align:center;">No inbox message.</p>';
					}
				?>
                    </div>
                </div>
              </div>
			  <div class="tab-pane fade" id="readmessage" role="tabpanel" aria-labelledby="pills-rejected-tab">
					
                  <div class="card-body">
                    <div class="table-responsive">
                        
                           <?php
					$count = 1; 
					if($get_notifications_read){
						echo '<table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Subject</th>
							<th>Message</th>
							<th>From</th>
							<th>From email</th>
							<th>Sent date</th>
							<th>Action</th>
						</tr>';
						foreach($get_notifications_read as $gadarr){
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$gadarr->subject.'</td>';
							//echo '<td>'.substr($gadarr->message,0,300).'<span id="dots'.$count.'">...</span><span class="more" id="more'.$count.'">'.substr($gadarr->message,300).'</span><a class="redmorelink" href="javascript:void(0);" onclick="myFunction('.$count.')" id="myBtn'.$count.'">Read more</a></td>';
							echo '<td>'.substr($gadarr->message,0,300).'<span id="dots'.$count.'">...</span><span class="more" id="more'.$count.'">'.substr($gadarr->message,300).'</span><a class="redmorelink" href="'.base_url('university/university/notification_details/'.$gadarr->uninot_id).'" id="myBtn'.$count.'">Read more</a></td>';
							echo '<td>'.$gadarr->from.'</td>';
							echo '<td>'.$gadarr->from_email.'</td>';
							echo '<td>'.$gadarr->sent_at.'</td>';
							echo '<td><a href="javascript:void();" class="replybtn">Reply</a></td>';	
							echo '</tr>';
						}
						echo '</table>';
					}else{
						echo '<p style="text-align:center;">No read message.</p>';
					}
				?>
                    </div>
                </div>
              </div>
				  </div>
				  
				
				
				</div>
            </div>
        </div>
    </section>
	<!--Reply -->
	<div class="modal fade" id="contactusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Contact Us
        <!--<button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>-->
        <!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Body part -->
		<p id="dispmsges" style="text-align: center;"></p>
		<form action="" method="post" id="replyform" name="replyform" />
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Recipient: <b>Administrator</b> Please select category of Message:*</label>
				<select name="pursosefor" id="pursosefor" class="form-control" required="">
					<option value="">Please Select</option>
					<option value="Testimonial">Testimonial</option>
					<option value="Enquiry">Enquiry</option>
					<option value="Complaint">Complaint</option>
					<option value="Suggestion">Suggestion</option>
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label">Message*</label>
				<textarea name="message" id="message" class="form-control" placeholder="Please write your message..." required=""></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="input-wrapper">
				<label class="input-label"><br></label>
				<br><button type="button" class="btn btn-primary" id="sendmsgbtn">Send Message</button>
			</div>
		</div>
		</form>
        <!-- end Body part -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> 
      </div>-->
    </div>
  </div>
</div>
	<!--Reply end -->
	
	
	<style>.more {display: none;}.redmorelink{font-size:12px;float:right;}</style>
	<script>
	function myFunction(msgid) {
	  var dots = document.getElementById("dots"+msgid);
	  var moreText = document.getElementById("more"+msgid);
	  var btnText = document.getElementById("myBtn"+msgid);

	  if (dots.style.display === "none") {
		dots.style.display = "inline";
		btnText.innerHTML = "Read more";
		moreText.style.display = "none";
	  } else {
		dots.style.display = "none";
		btnText.innerHTML = "Read less";
		moreText.style.display = "inline";
	  }
	  $.ajax({
            type: "POST",
            url: '<?php echo base_url("university/university/notification_read_status"); ?>',
            data: { 
                uninot_id:msgid,
            },
            success: function(result) {
				//alert('read');
            }
        });
	}
	$(".replybtn").click(function(){
	  $('#contactusModal').modal('show');
	});	
	$("#sendmsgbtn").click(function(){
		var pursosefor = $('#pursosefor').val();
        var message = $('#message').val();
		if(pursosefor == ''){
			alert('Please select');
			$('#pursosefor').focus();
			return false;
		}
		if(message == ''){
			alert('Please write your message');
			$('#message').focus();
			return false;
		}
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("university/university/messagereply"); ?>',
            data: { 
                pursosefor:pursosefor,
                message:message
            },
            success: function(result) {
                $('#dispmsges').html(result);
                $('#pursosefor').val('');
				$('#message').val('');
				
            }
        });
	});	
	
	</script>