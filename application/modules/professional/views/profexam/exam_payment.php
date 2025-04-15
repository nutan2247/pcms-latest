     
    <?php  $this->load->view('professional/include/profexam_banner'); ?>
    
     <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                        <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Foreign Professional Profile <br> & Exam Code</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                        <i class="fa fa-check" aria-hidden="true"></i>
                            <strong>2</strong>
                        </span>
                        <label>Exam Booking</label>
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
                        <label>Examination Guidlines<br>and Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Exam Slip</label>-->
                        <label>Exam Pass</label>
                    </a>
                </div>
        </div>
    </div>
    <?php //print_r($this->session->all_userdata()); ?>
    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <!--<div class="my-5">-->
                <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo form_open(base_url('professional/profexam/exam_paypal_payment')); ?>
                    <div class="col-md-12 text-center">
                        <div class="form-group row">
                            <div class="col-sm-12" id="pricesection"></div>
                            <input type="hidden" name="amount" id="amount"  value="">
                            <input type="hidden" name="tax" id="tax"  value="">
                            <input type="hidden" name="taxamt" id="taxamt"  value="">
                            <input type="hidden" name="total" id="total"  value="">
                            <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('profexam_id');?>">  
                            <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('profexam_name');?>">
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit" value="paynow" class="btn btn-success">Make Payment</button>
                                <button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
                            </div>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
            <!--</div>-->
        </div>
    </div>
<script>
    $(document).ready(function(){
        var chargeid = 9;
        //alert(chargeid); return false;
        $.ajax({
            url:base_url+'professional/profexam/getprice/',
            type:'post',
            dataType: 'json',
            //data:{chargeid},
            data:{chargeid : chargeid, charges_for : 'booking_for_online_licensure_examination'},
            beforeSend:function(){
                $(".loding-main").show();

            },
            success:function(data){
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
        var url = "<?php echo base_url('stripe/index')?>";
        // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
        window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=Booking For Online Licensure Examination (Foreign Professionals)';
        // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
    }
</script>