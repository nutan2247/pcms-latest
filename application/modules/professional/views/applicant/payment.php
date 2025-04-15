<?php  $this->load->view('professional/include/professional_banner'); ?>

<div class="container mb-5">
    <div class="row pro-steps">
        <div class="col-2">
            <a href="javascript:void(0);" class="stepActive">
                <span>
                    <strong>1</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Foreign Professional Profile</label>
            </a>
        </div>
        <div class="col-2">
            <a href="javascript:void(0);" class="stepActive">
                <span>
                    <strong>2</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Upload Documents</label>
            </a>
        </div>
        <div class="col-2">
            <a href="javascript:void(0);" class="stepProcess">
                <span>
                    <strong>3</strong>
                </span>
                <label>Payment</label>
            </a>
        </div>
        <div class="col-2">
            <a href="javascript:void(0);">
                <span>
                    <strong>4</strong>
                </span>
                <label>Review of Documents</label>
            </a>
        </div>
        <div class="col-2">
            <a href="javascript:void(0);">
                <span>
                    <strong>5</strong>
                </span>
                <!--<label>Professional Certificate of Recognition</label>-->
                <label>Certificate of Eligibility & Registration Code</label>
            </a>
        </div>
    </div>
</div>

<div class="bg-light py-4">
    <div class="col-md-8 mx-auto">
        <div id="payment-details">
            <h4 class="mb-4 text-uppercase text-center">
                <?php echo $title; ?>
            </h4>
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open(base_url('professional/applicant/paypal_payment')); ?>
            <div class="col-md-12 text-center">
                <div class="form-group row">
                    <div class="col-md-12 " id="pricesection"></div>
                    <input type="hidden" name="amount" id="amount" value="">
                    <input type="hidden" name="tax" id="tax" value="">
                    <input type="hidden" name="taxamt" id="taxamt" value="">
                    <input type="hidden" name="total" id="total" value="">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('prof_id');?>">
                    <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('prof_name');?>">
                </div>
                <div class="row" id="makepayment">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success payBtna" disabled>Make Payment</button>
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
    <!-- /* Once payment Done than we will unset the session */ -->
    <?php //unset($_SESSION['profdoc']); ?>
<script>
    $(document).ready(function() {

        var chargeid = 5;
        //alert(chargeid); return false;
        $.ajax({
            url: base_url + 'professional/applicant/getprice',
            type: 'post',
            dataType: 'json',
            //data:{chargeid},
            data: {
                chargeid: chargeid,
                charges_for: 'foreign_professional_review_of_documents_for_professional_registration'
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
        window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=Foreign Professional Review for online Professional Registration';
        // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
    }
</script>