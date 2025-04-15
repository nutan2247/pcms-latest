<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <?php $this->view('dashboard_top'); ?>

    <section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <?php $this->view('ce-provider/dashboard_left'); ?>
                </div>
                <div class="col-lg-9 col-md-8">

				<h4 class="mb-4 text-uppercase text-center">Purchase List</h4>
				<?php
						echo '<table class="table table-bordered">
						<tr>
						<th>Sl No.</th>
						<th>Transaction Id</th>
						<th>Amount</th>
						<th>Payer</th>
						<th>Payment For</th>
						<th>Payment Status</th>
						<th>Date Paid</th>
						<th>Action</th>
						</tr>';
            
						$count = 1;
            $sectionname = ''; 
						if(count($paymentarr) > 0){
						foreach($paymentarr as $payments){
              
							if($payments->payment_for=='C'){
                $payment_for = 'Online Course Accreditation';
                $section = $this->provider->get_section_name($payments->doc_refrence_id, 'C');
                if(!empty($section)){
                  $sectionname = $section->sectionname;
                }
                //print_r($sectionname);exit;
              }elseif($payments->payment_for=='T'){
                $payment_for = 'Training Course Accreditation';
                $section = $this->provider->get_section_name($payments->doc_refrence_id, 'T');
                if(!empty($section)){
                  $sectionname = $section->sectionname;
                }
              }elseif($payments->payment_for=='CEP' && $payments->payment_type == 'N'){
                $payment_for = 'CEP Accreditation';                
              }elseif($payments->payment_for=='CEP' && $payments->payment_type == 'R'){
                $payment_for = 'CEP Renewal Accreditation';                
              }else{
                $payment_for = '--';
              }

              // $payment_type = ($payments->payment_type == 'N')?'New':'Renew';

							echo '<tr>';
							echo '<td>'.$count++.'.</td>';
							echo '<td>'.$payments->txn_id.'</td>';
							echo '<td>'.$payments->payment_gross.'</td>';
							echo '<td>'.$payments->payer_email.'</td>';
							echo '<td>'.$payment_for.' : '.$sectionname.'</td>';
							echo '<td>'.$payments->payment_status.'</td>';
							echo '<td>'.$payments->payment_date.'</td>';
							echo '<td><a href="javascript:void(0)" onclick="viewReceipt('.$payments->payment_id.')">Receipt</a></td>'	;
							echo '</tr>';
						}
					}else{
						echo '<tr style="text-align:center;color:red;"><th colspan="8">No payment History</th></tr>';
					}
					echo '</table>';
				?>
				<table>
					<tr>
					</tr>
				</table>
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
        <button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>
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

<!-- Send Receipt By Email Modal -->
<div id="emailpopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send Mail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" id="emailAdderss" name="email" class="form-control" value="">
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="emailData()" >Send</button>
      </div>
    </div>

  </div>
</div>

	<script>
	function viewReceipt(id){
		$.ajax({
	        //url:'https://ceonpointllc.com/rboard/admin/get_receipt', 
          url: '<?php echo base_url('ce-provider/ce_provider/get_receipt')?>',
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

    function emailpopup(){
        $('#emailpopup').modal('show');
        $('#viewReceiptModal').modal('hide');
    }

    function emailData(){
        var email = $('#emailAdderss').val();
        var name = $('#emailAdderss').val();
        var content = document.getElementById('viewReceiptContent').innerHTML;
        var to = email;
        var subject = "RBoard Receipt";
         $.ajax({
            type: "POST",
            url: '<?php echo base_url("admin/send_receipt_mail"); ?>',
            data: { 
                to:to,
                name:name,
                subject:subject,
                content:content
            },
            success: function(result) {
                alert(result);
            }
        });
    }	
	</script>