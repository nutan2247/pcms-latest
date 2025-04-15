		<footer class="py-4 bg-light mt-auto">

			<div class="container-fluid">

			    <div class="d-flex align-items-center justify-content-between small">

			        <div class="text-muted">Copyright &copy; CEonpoint GOVT. 2020</div>

			        <div>

			            <a href="#">Privacy Policy</a>

			            &middot;

			            <a href="#">Terms &amp; Conditions</a>

			        </div>

			    </div>

			</div>

		</footer>

	</div>
	
	
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


<div class="modal fade viewdetails-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- body -->
	   
		<div id="displaydetials" style="padding:20px;"></div>
      <!-- end body -->
    </div>
  </div>
</div> 

		<script>

			$(document).ready( function () {

			    //$('#dataTable').DataTable({'iDisplayLength': 100});
			    $('#dataTable').DataTable();

			} );

		function viewreceipt(id){
		$.ajax({
	        url:'<?php echo base_url("admin/get_receipt");?>', 
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

		<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="<?php echo base_url('assets/js/scripts.js');?>"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

       

	</body>

</html>