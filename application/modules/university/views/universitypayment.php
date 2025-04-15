<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">SCHOOL ACCREDITATION</h2>
</div>
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
                <span><strong>1</strong>
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
                <!--<label>Digital Accreditation</label>-->
				<label>Digital Certificate of Accreditation</label>
            </a>        
        </div>
    </div>
    <?php //print_r($this->session->all_userdata()) ?>
    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">PAYMENT</h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('',array('id'=>'universitypaymetForm')); ?>
			<div class="form-group row">
				<div class="col-sm-8 mx-auto">
				<p class="text-center"><b class="mb-2">Accreditation Period : </b> 
					<select name="duration" id="duration" class="form-control">
						<option value="">Please Select</option>
						<?php 
							foreach($chargesarr as $charg){
								echo '<option value="'.$charg->pri_id.'">'.$charg->duration_title.' ($'.$charg->charge.')</option>';
							}
						?>
						
					</select>
					<?php echo form_error('duration', '<div class="error">', '</div>'); ?>
					
				   </p>
				</div>
            </div>   
			<div class="form-group row">
				<div class="col-sm-8 mx-auto text-center" id="pricesection"></div>
                    <input type="hidden" name="amount" id="amount" value="">
                    <input type="hidden" name="tax" id="tax" value="">
                    <input type="hidden" name="taxamt" id="taxamt" value="">
                    <input type="hidden" name="total" id="total" value="">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('uniid_stepone');?>">
                    <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('university_name');?>">
            </div>	
			<div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" value="paynow" class="btn btn-success text-uppercase" name="submit" value="submit">Pay Now</button>
                    <button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
                </div>
            </div>
					
        </div>
    </div>
</div>

    <!-- /* Once payment Done than we will unset the session */ -->
    <?php // unset($_SESSION['updateunidoc']); ?>
    
<script>
    $(document).ready(function(){
        $('#staticBackdrop').modal('show');
    });

    $(document).on("change","#duration",function(){

    var chargeid = $(this).val();
    //alert(chargeid); return false;
        $.ajax({
            url:base_url+'university/university/getrenewprice', 
            type:'post',
            dataType: 'json',
            data:{chargeid},
            data:{'chargeid':chargeid,'charges_for':'school_accreditaion'},
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
        var tax = $('#tax').val();
        var uname = $('#uname').val();
        var uid = $('#uid').val();
        var url = "<?php echo base_url('stripe/index')?>";
        // id = 1 or 2 (School Accreditaion)
        window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=School Accreditaion';
    }
</script>