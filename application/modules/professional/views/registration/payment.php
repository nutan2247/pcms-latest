     
<?php  $this->load->view('professional/include/registration_banner'); ?>
    
     <div class="container mb-5">
        <div class="row pro-steps">
            <div class="col-4">
                <a href="javascript:void(0);" class="stepActive">
                    <span>
                        <strong>1</strong>
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Professional Information</label>
                </a>
            </div>
            <div class="col-4">
                <a href="javascript:void(0);" class="stepProcess">
                    <span>
                        <strong>2</strong>
                    </span>
                    <label>Payment</label>
                </a>
            </div>
            <div class="col-4">
                <a href="javascript:void(0);">
                    <span>
                        <strong>3</strong>
                    </span>
                    <label>Registration Certificate and <br>Professional Identification Card</label>
                </a>
            </div>
        </div>
    </div>
<?php //print_r($this->session->all_userdata()) ?>
    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <div id="payment-details">
                <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>
              
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open(base_url('professional/applicant/registration_paypal_payment')); ?>
                <div class="col-md-12 text-center">
					<!--<div class="form-group row">
						<select name="process_fee" id="process_fee" class="form-control">
							<option value="">Select Payment for</option>
                        
							<?php /*
								foreach($chargesarr as $charg){
									echo '<option value="'.$charg->pri_id.'">'.$charg->duration_title.'</option>';
								}
							*/?>
							
						</select>
					</div>-->
					<div class="form-group row">
						<div class="col-sm-12" id="pricesection">
						   
						   <?php // echo form_error('amount', '<div class="error">', '</div>'); ?>
						</div>
                        <input type="hidden" name="process_fee" id="process_fee" value="7">
						<input type="hidden" name="amount" id="amount"  value="">
						<input type="hidden" name="tax" id="tax"  value="">
						<input type="hidden" name="taxamt" id="taxamt"  value="">
						<input type="hidden" name="total" id="total"  value="">
						<input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('prof_id');?>">
                        <?php if($this->session->userdata('prof_type')=='p'){ $payment_for = 'PR'; }else{ $payment_for = 'PRG'; } ?>
                        <input type="hidden" name="payment_for" id="payment_for" value="<?php echo $payment_for; ?>">
                        <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('prof_name');?>">
					</div>	
					<?php echo form_error('process_fee', '<div class="error">', '</div>'); ?>
                    <!--<table class="table table-bordered">
                        <thead>
                            <tr>
                                <td scope="col">Application & Processing fee</td>
                                <td scope="col" class="text-right">
                                	$<input type="text" name="process_fee" id="process_fee" value="100" readonly>
                                	<input type="hidden" name="uid" value="<?php echo $this->session->userdata('prof_id');?>">
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">Tax</td>
                                <td class="text-right">
                                	$<input type="text" name="tax" id="tax" value="20" readonly></td>
                            </tr>
                            <tr>
                                <td scope="row"><strong>Total</strong></td>
                                <td class="text-right"><strong>$<input type="text" name="total" id="total" value="120" readonly></strong></td>
                            </tr>

                        </tbody>
                    </table>-->
                    <div class="form-group row">
                    <div class="text-center w-100">
                        <button type="submit" value="paynow" class="" name="submit" value="submit"><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:80px; width:200px;"></button>
                        <button type="button" name="submit" onclick="payByStrip();" class="payBtna" disabled><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:80px; width:200px;"></button>
                        
                    </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
<script>
//$(document).on("change","#process_fee",function(){
$(document).ready(function() {
    //var chargeid = $(this).val();
    var chargeid = 7;
	//alert(chargeid); return false;
    $.ajax({
        url:base_url+'professional/applicant/getprice',
        type:'post',
		dataType: 'json',
        //data:{chargeid},
        data:{chargeid : chargeid, charges_for : 'professional_registration'},
        beforeSend:function(){
            $(".loding-main").show();

        },
        success:function(data){
			//alert(JSON.parse(data));
			//alert(JSON.stringify(data));
			$(".loding-main").hide();
			var html = '<p><b>Amount : </b> <span id="dispprice">'+data['charge']+'</span> USD</p><p><b>Tax ('+data['tax']+'%): </b> <span id="disptax">'+data['tax_amount']+'</span> USD</p><p><b>Total : </b> <span id="disptotal">'+data['total']+'</span> USD</p>';
			//$('#dispprice').html(data['charge']);
			$('#pricesection').html(html);
			//$('#item_name_2').val($('#duration').val());
			$('#amount').val(data['charge']);
			$('#tax').val(data['tax']);
			$('#taxamt').val(data['tax_amount']);
			$('#total').val(data['total']);
            $('.payBtna').prop('disabled', false);
        }

    });

});
function payByStrip() {
    var total = $('#total').val();
    var tax = $('#tax').val();
    var uname = $('#uname').val();
    var uid = $('#uid').val();
    var payment_for = $('#process_fee').val();
    var url = "<?php echo base_url('stripe/index')?>";
    // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
    window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&for='+payment_for+'&&type=professional registration';
    // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
}
</script>