<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('university_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">
				<h3>Purchase List (<?php echo count($paymentarr);?>)</h3>
				<?php
					$count = 1; 
					$total = 0;
					if(count($paymentarr) > 0){
						echo '<table class="table table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Item Description</th>
							<!--<th>Transaction Id</th>-->
							<th>Amount</th>
							<th>Receipt No.</th>
							<th>Date</th>
							<th>Action</th>
						</tr>';
						foreach($paymentarr as $payments){
							$total += $payments->payment_gross;
							if($payments->payment_for == 'U'){
							$payment_type = ($payments->payment_type == 'N')?'School Accreditation Fee':'Renewal of School Accreditation Fee';
							}
							if($payments->payment_for == 'G'){
								$payment_type = ($payments->payment_type == 'S')?'Submission of Graduates for Licensure Examination':'Booking for Online Licensure Examination';
							}
							$date = explode('-',$payments->payment_date);
							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$payment_type.'</td>';
							//echo '<td>'.$payments->txn_id.'</td>';
							echo '<td>$ '.$payments->payment_gross.'</td>';
							echo '<td>#'.$payments->payment_id.'-'.$date[0].'</td>';
							echo '<td>'.date("M d, Y",strtotime($payments->payment_date)).'</td>';
							echo '<td><a href="javascript:void(0);" onclick="viewreceipt('.$payments->payment_id.')" alt="view receipt"><i class="fa fa-eye"></i></a></td>';
							echo '</tr>';
						}
						echo '<tr><td colspan="2" align="right"><b>Total: </b></td><td colspan="4"><b>$ '.number_format($total,2).'</b></td></tr>';
						echo '</table>';
					}else{
						echo '<p style="text-align:center;color:red;">No payment History</p>';
					}
				?>
				
				</div>
            </div>
        </div>
    </section>
	<!-- View Receipt Modal -->
<div class="modal fade" id="viewReceiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Receipt
        <button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>
        <!--<button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>-->
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="viewReceiptContent"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
	<script>
	function viewreceipt(id){
		$.ajax({
	        url:'<?php echo base_url("university/university/getreceipt");?>', 
	        type:'post',
			data:{id:id},
	        beforeSend:function(){
				$('#viewReceiptContent').html('Loading receipt...');
	        },
	        success:function(data){
				$('#viewReceiptContent').html(data);
				$('#viewReceiptModal').modal('show');
	        }
	    });
	}
	function printData(){
        var printContents = document.getElementById('viewReceiptContent').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
	</script>