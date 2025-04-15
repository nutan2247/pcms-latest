<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('dashboard_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
				<h4 class="mb-4 text-uppercase text-center">Notification</h4>
				<?php
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
						$count = 1; 
						if(count($get_notifications) > 0){
						foreach($get_notifications as $gadarr){
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$gadarr->subject.'</td>';
							echo '<td>'.substr($gadarr->message,0,300).'<span id="dots'.$count.'">...</span><span class="more" id="more'.$count.'">'.substr($gadarr->message,300).'</span><a class="redmorelink" href="javascript:void(0);" onclick="myFunction('.$count.')" id="myBtn'.$count.'">Read more</a></td>';
							echo '<td>'.$gadarr->from.'</td>';
							echo '<td>'.$gadarr->from_email.'</td>';
							echo '<td>'.$gadarr->sent_at.'</td>';
							echo '<td><a href="#">Delete</a></td>';	
							echo '</tr>';
						}
					}else{
						echo '<tr style="text-align:center;"><th colspan="6">No data available<th></tr>';
					}
					echo '</table>';
				?>
				
				</div>
            </div>
        </div>
    </section>
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
	}
	</script>