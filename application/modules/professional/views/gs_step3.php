<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Request for Certificate of Good Standing</h2>
</div>

<!-- steps start -->
<div class="container">
    <div class="row pro-steps text-center">
        <div class="col-3">
            <a href="#" class="stepActive">
                <span>
                    <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Personal & Professional Information Verification</label>
            </a>
        </div>
            
        <div class="col-3">
        <a href="#" class="stepActive">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Receipient Information</label>
            </a>
        </div>
            
        <div class="col-3">
            <a href="#" class="stepProcess">
                <span>3</span>
                <label>Payment</label>
            </a>
        </div>
                
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Status</label>
            </a>
        </div>

        <!-- <div class="col-2">
            <a href="#">
                <span>5</span>
                <label>Renewed Professional License</label>
            </a>
        </div> -->

    </div>
</div>
    
<!-- steps end -->


<div class="bg-light py-4">
    <div class="col-md-8 mx-auto">
        <div id="payment-details">
            <h4 class="mb-4 text-uppercase text-center">
                <?php echo $title; ?>
            </h4>
            <?php echo $this->session->flashdata('item'); ?>
            <?php echo form_open(base_url('professional/applicant/gsPayment')); ?>
            <?php echo (validation_errors()!='')?'<div class="alert alert-danger">'.validation_errors().'</div>':''; ?>
            <div class="col-md-12 text-center">
                <div class="form-group row">
                    <div class="col-md-12 " id="pricesection"></div>
                    <input type="hidden" name="amount" id="amount" value="">
                    <input type="hidden" name="tax" id="tax" value="">
                    <input type="hidden" name="taxamt" id="taxamt" value="">
                    <input type="hidden" name="total" id="total" value="">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('user_ID');?>">
                    <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('name');?>">
                </div>
                <div class="row" id="makepayment">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success">Make Payment</button>
                                <button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-danger" id="message"></p>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>



<script>
    $(document).ready(function() {

        var chargeid = 24;
        //alert(chargeid); return false;
        $.ajax({
            url: base_url + 'professional/applicant/getprice',
            type: 'post',
            dataType: 'json',
            //data:{chargeid},
            data: {
                chargeid: chargeid,
                charges_for: 'professional_good_standing'
            },
            beforeSend: function() {
                $(".loding-main").show();
            },
            success: function(data) {
                if(data['err'] == ''){
                    console.log(data);
                    // alert(data);
                    $(".loding-main").hide();
                    var html = '<p><b>Amount : </b> <span id="dispprice">' + data['charge'] + '</span> USD</p><p><b>Tax (' + data['tax'] + '): </b> <span id="disptax">' + data['tax_amount'] + '</span> USD</p><p><b>Total : </b> <span id="disptotal">' + data['total'] + '</span> USD</p>';
                    //$('#dispprice').html(data['charge']);
                    $('#pricesection').html(html);
                    //$('#item_name_2').val($('#duration').val());
                    $('#amount').val(data['charge']);
                    $('#tax').val(data['tax']);
                    $('#taxamt').val(data['tax_amount']);
                    $('#total').val(data['total']);
                    $('.payBtna').prop('disabled', false);
                }else{
                    $(".loding-main").hide();
                    $('#makepayment').addClass('d-none');
                    $('#message').html('Payment Related Data Not Found!');
                }
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
        window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=Request for certificate of good standing';
        // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
    }
</script>