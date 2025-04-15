<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title;?></h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepActive">
                <span>
                	<strong>1</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Graduate Profile & Code</label>
            </a>         
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span>
                    <strong>2</strong>
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Exam Booking</label>
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
                <label>Examination Guidelines and Information</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Exam Pass</label>
            </a>        
        </div>
    </div>
<?php //print_r($this->session->all_userdata()); ?>
    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open(base_url('graduates/graduates/paypal_payment')); ?>
                <div class="col-md-12 mx-auto">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center" id="pricesection"></div>
                        <input type="hidden" name="amount" id="amount"  value="">
                        <input type="hidden" name="tax" id="tax"  value="">
                        <input type="hidden" name="taxamt" id="taxamt"  value="">
                        <input type="hidden" name="total" id="total"  value="">
                        <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('grad_id');?>">
                        <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('graduate_name');?>">
                    </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="submitPayment()">Make Payment</a> -->
                        <button type="submit" name="submit" value="paynow" class="btn btn-success">Make Payment</button>
                        <button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
                    </div>
                </div>

                </div>
                <?php echo form_close(); ?>
        </div>
    </div>

</div>


<script>
$(document).ready(function(){

    var chargeid = 9;
    //alert(chargeid); return false;
    $.ajax({
        url:base_url+'graduates/graduates/getprice',
        type:'post',
        dataType: 'json',
        //data:{chargeid},
        data:{chargeid : chargeid, charges_for : 'booking_for_online_licensure_examination'},
        beforeSend:function(){
            $(".loding-main").show();

        },
        success:function(data){
            $(".loding-main").hide();
            var html = '<p><b>Amount : </b> <span id="dispprice">'+data['charge']+'</span> USD</p><p><b>Tax ('+data['tax']+'): </b> <span id="disptax">'+data['tax_amount']+'</span> USD</p><p><b>Total : </b> <span id="disptotal">'+data['total']+'</span> USD</p>';
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
    // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
    window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=Booking for Online Licensure Examination (LOCAL GRADUATES)';
    // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
}
</script>