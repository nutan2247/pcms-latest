<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <h4 class="mt-4 mb-3"><?php echo $page_title; ?></h4>

        <div class="card mb-4">

            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-bell mr-1"></i>
                    <?php echo $table_name; ?>
                </span>
            </div>

            	<div class="card-body">
                <?php echo $this->session->flashdata('item');?>

				
				<?php
					$count = 1; 
					if(count($get_notifications) > 0){
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
							echo '<td>'.substr($gadarr->message,0,300).'<span id="dots'.$count.'">...</span><span class="more" id="more'.$count.'">'.substr($gadarr->message,300).'</span><a class="redmorelink" href="javascript:void(0);" onclick="myFunction('.$count.')" id="myBtn'.$count.'">Read more</a></td>';
							echo '<td>'.$gadarr->from.'</td>';
							echo '<td>'.$gadarr->from_email.'</td>';
							echo '<td>'.$gadarr->sent_at.'</td>';
							echo '<td><a href="#">Delete</a></td>';	
							echo '</tr>';
						}
						echo '</table>';
					}else{
						echo '<p style="text-align:center;">No data available</p>';
					}
				?>
				
				</div>
            </div>
        </div>
</main>
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