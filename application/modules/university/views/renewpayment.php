<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION </h2>
</div>
<section class="dashboard-contentpanel py-lg-5 py-3 ">
        <div class="container">
            <div class="row">
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div class="col-lg-12 col-md-18">
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepActive">
                <span><strong>1</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>School Information</label>
            </a>
         
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span><strong>2</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>Business & Accreditation Documents</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#" class="stepProcess">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Verification of Documents</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Digital Accreditation</label>
            </a>        
        </div>
    </div>
    <?php //print_r($this->session->all_userdata()) ?>
    <div class="col-md-12 mx-auto">
        <div class="my-5">
            <?php echo $this->session->flashdata('error'); ?>
            <?php // echo form_open_multipart('',array('id'=>'universitypaymetForm')); ?>
           
			<form action="" method="post" target="_top" id="paymentform"> 
			<div class="form-group row">
                <div class="col-sm-7 ">
                   <p><b>Renew for : </b> 
				   
					<select name="renew_duration" id="renew_duration" class="form-control">
						<option value="">Please Select</option>
						<?php 
							foreach($chargesarr as $charg){
								echo '<option value="'.$charg->pri_id.'">'.$charg->duration_title.'</option>';
							}
						?>
						
					</select>
					<?php echo form_error('renew_duration', '<div class="error">', '</div>'); ?>
				   </p>
                </div>
            </div>
			<div class="form-group row">
				<div class="col-sm-7 " id="pricesection">
				   
				   <?php // echo form_error('amount', '<div class="error">', '</div>'); ?>
				</div>
				<input type="hidden" name="amount" id="amount"  value="">
				<input type="hidden" name="tax" id="tax"  value="">
				<input type="hidden" name="taxamt" id="taxamt"  value="">
				<input type="hidden" name="total" id="total"  value="">
                <input type="hidden" name="uid" id="uid"  value="<?=$this->session->userdata('uniid')?>">
                <input type="hidden" name="uname" id="uname"  value="<?=$this->session->userdata('university_name')?>">
            </div>	
			<div class="form-group row">
                <div class="col-sm-7">
                    <button type="submit" value="paynow" class="btn btn-success text-uppercase" name="submit" value="submit">Pay Now</button>
                    <button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
                </div>
            </div>
			<?php echo form_close(); ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>
<script>
$(document).on("change","#renew_duration",function(){

    var chargeid = $(this).val();
	//alert(chargeid); return false;
    $.ajax({
        url:base_url+'university/university/getrenewprice',
        type:'post',
		dataType: 'json',
        data:{'chargeid':chargeid,'charges_for':'renewal_of_school_accreditaion'},
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
    var uid = $('#uid').val();
    var payment_for = $('#renew_duration').val();
    var url = "<?php echo base_url('stripe/index')?>";
    // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
    window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&for='+payment_for+'&&type=School Accreditaion Renewal';
    // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
}
</script>