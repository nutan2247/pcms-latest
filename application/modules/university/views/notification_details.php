<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); //print_r($notification_details); exit; ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
				<h3>Notification Details</h3>
				
				<p style="text-align:right;">
					<button type="button" class="btn btn-primary replybtn" id="replybtn">Compose</button> <a href="javascript:history.back()"><button type="button" class="btn btn-info" >Back</button></a>
				</p>
				
				  <p><b>From:</b> <?php echo $notification_details->from.'('.$notification_details->from_email.')';?></p>
				  <p><b>Subject:</b> <?php echo $notification_details->subject;?></p>
				  <p><b>Received Date:</b> <?php echo $notification_details->sent_at;?></p>
				  <p><b>Message:</b><br> <?php echo stripslashes($notification_details->message);?></p>
				  
				
				
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