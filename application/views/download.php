<div class="container">

	<h2 class="heading-title border-none mt-md-5 mt-3">Download</h2>

    <section class="pt-lg-3 pb-lg-4 py-4 faqlisting">

		<?php

				if(count($downloadlisting) > 0){
					$sl = 1;
				echo '<table class="table table-bordered">

							<tr>

								<th>Sl.no.</th>
								
								<th>File Name</th>

								<th>Document</th>

							</tr>';

					foreach($downloadlisting as $dwn){ ?>
							<tr>

								<td><?=$sl?></td>
								<td><?=$dwn->file_name?></td>
								<td>
								<a href="<?=base_url('download/files/'.$dwn->dowloadfile) ?>" rel="nofollow">Click to Download</a> |
								<a href="javascript:void(0);" class="viewFile" data-id="<?=$dwn->dowloadfile ?>">View</a>
								</td>

							</tr>
					<?php	$sl++;
					}

					echo '</table>';

				}else{

					echo '<p style="text-align:center;">No documents availabe for download.</p>';

				}

		?>

	</section>

</div>

<!-- Modal -->
<div class="modal fade" id="viewFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Download</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	$('.viewFile').on('click',function(){
		var file = $(this).attr('data-id');
		var path = "<?php echo base_url('assets/images/download/'); ?>"+file;
		$('#imagepreview').attr('src', path);
		$('#viewFileModal').modal('show');
	});
</script>


    



