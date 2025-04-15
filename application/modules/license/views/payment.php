<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Professional License Card Renewal</h2>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
</div>

<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>1</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Personal & Professional Verification</label>
            </a>
        </div>
         
        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>2</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Required CE Units Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>3</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>CE Certificates Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="#" class="stepProcess">
                <span>4</span>
                <label>Payment</label>
            </a>
        </div>

        <div class="col-2">
            <a href="#">
                <span>5</span>
                <!--<label>Digital Professional License</label>-->
                <label>Renewed Professional License</label>
            </a>
        </div>

    </div>
<?php //print_r($this->session->all_userdata()); echo $this->session->userdata('professioanl_renew')['candidate_type']; ?>
    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <div id="payment-details">
                <h4 class="mb-4 text-uppercase text-center">Payment</h4>

                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open(base_url('license/landing/paypal_payment')); ?>

				<div class="col-sm-8 mx-auto">
				<p><b><span class="mb-3 d-block text-center">License Renewal Period : </span></b> 

					<select name="duration" id="duration" class="form-control">
						<option value="">Please Select</option>
						<?php 
							foreach($chargesarr as $charg){
								echo '<option value="'.$charg->pri_id.'">'.$charg->duration_title.'</option>';
							}
						?>
						
					</select>
					<?php echo form_error('duration', '<div class="error">', '</div>'); ?>
					
				   </p>
				</div>
				<div class="form-group row">
				<div class="col-sm-8 mx-auto text-center" id="pricesection"></div>
				<!-- <input type="hidden" name="user_id" id="user_id"  value="<?php echo $this->session->userdata('user_ID');?>"> -->
				<input type="hidden" name="user_id" id="user_id"  value="<?php echo base64_decode($this->uri->segment(4));?>">
				<input type="hidden" name="amount" id="amount"  value="">
				<input type="hidden" name="tax" id="tax"  value="">
				<input type="hidden" name="taxamt" id="taxamt"  value="">
				<input type="hidden" name="total" id="total"  value="">
                <input type="hidden" name="uname" id="uname"  value="<?=$_SESSION['professioanl_renew']['name'];?>">
                <?php if($this->session->userdata('professioanl_renew')['candidate_type']=='p'){ $payment_for = 'PR'; }else{ $payment_for = 'PRG'; } ?>
                <input type="hidden" name="payment_for" value="<?php echo $payment_for; ?>">
            </div>	
			<div class="form-group row">
                <div class="col-sm-8 mx-auto text-center">
                    <button type="submit" value="paynow" class="btn btn-success text-uppercase" name="submit" value="submit">Pay Now</button>
                    <button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
                </div>
            </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
    
</div>



<!-------------------- POP MODAL ------------------------------------------------->

    <div class="modal fade" id="thanku_pop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="thanku_pop" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="thanku_pop">Thanku you!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    <div id="body" class="col-md-8 mx-auto">
                        <div class="bs-example">
                            <p class="mb-4 mt-4 text-uppercase">Payment was successful</p>
                            <p class="mt-4">Please allow <?php echo $amount_to_pay->count_down; ?> days to verify your Unverified certificates</p>
                            <p class="mb-4 mt-4">Upon successful verification your digital Professional License will be ready.</p>
                            <p class="mt-4">
                                <a class="btn btn-success text-uppercase" href="<?php echo base_url('license/landing/digital_professional'); ?>">Check Status</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

    $(document).on("change","#duration",function(){
        var chargeid = $(this).val();
        //alert(chargeid); return false;
        $.ajax({
            url:base_url+'license/landing/getprice', 
            type:'post',
            dataType: 'json',
            data:{chargeid},
            data:{'chargeid':chargeid,'charges_for':'renewal_of_professional_registration'},
            beforeSend:function(){
                $(".loding-main").show();

            },
            success:function(data){
                //alert(JSON.parse(data));
                //alert(JSON.stringify(data));
                $(".loding-main").hide();
                var html = '<p><b>Processing Fee : </b> <span id="dispprice">'+data['charge']+'</span> USD</p><p><b>Tax ('+data['tax']+') %: </b> <span id="disptax">'+data['tax_amount']+'</span> USD</p><p><b>Total : </b> <span id="disptotal">'+data['total']+'</span> USD</p>';
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
        var tax = $('#taxamt').val();
        var uname = $('#uname').val();
        var uid = $('#user_id').val();
        var duration = $('#duration').val();
        var url = "<?php echo base_url('stripe/index')?>";
        // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
        window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&for='+duration+'&&type=professional license card renewal';
        // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
    }
</script>

<style type="text/css">
    .error {
        color: #ce2b2b;
    }
</style>