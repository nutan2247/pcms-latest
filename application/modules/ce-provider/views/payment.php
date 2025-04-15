
        <div class="col-md-10 mx-auto">
            <div class="my-0">
               <h4 class="mb-4 mt-4 text-uppercase text-center">Payment</h4>
            </div>
            
            <div class="col-md-6 mx-auto">
                <?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error'); } ?>
                <?php echo form_open_multipart(current_url(),array('id'=>'universitypaymetForm')); ?>
                <div class="form-group row">

                  <div class="col-sm-12">
                    <p><b class="mb-3 d-block">Purchase for : </b> 
                      <select name="duration" id="duration" class="form-control">
                        <option value="">Please Select</option>
                        <?php foreach($chargesarr as $charg){
                                echo '<option value="'.$charg->pri_id.'">'.$charg->duration_title.'</option>';
                          } ?>
                      </select>
                      <?php echo form_error('duration', '<div class="error">', '</div>'); ?>
                    </p>
                  </div>
                      
                  <div class="col-sm-12 text-center" id="pricesection"></div>
                
                </div>
<?php //print_r($this->session->all_userdata()) ?>
                <div class="form-group row">
                  <div class="col-sm-12 text-center" id="pricesection"></div>
                  <input type="hidden" name="amount" id="amount"  value="">
                  <input type="hidden" name="tax" id="tax"  value="">
                  <input type="hidden" name="taxamt" id="taxamt"  value="">
                  <input type="hidden" name="total" id="total"  value="">
                  <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('logincepacc')['provider_id'];?>">
                  <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('logincepacc')['business_name'];?>">
                  
                </div>
            
                <div class="form-group row" id="paynow">
                  <div class="col-sm-12 text-center">
                    <button type="submit" value="paynow" class="" name="submit" value="submit"><img src="<?=base_url('assets/images/paypallogo.png') ?>" style="height:40px; width:100px;"></button>
                    <button type="button" name="submit" onclick="payByStrip();" class="payBtna" disabled><img src="<?=base_url('assets/images/OIP.jpg') ?>" style="height:40px; width:100px;"></button>
                  </div>
                </div>
                <p id="message" class="text-danger"></p>
            </div>
      </div>

    <!-- /* Once payment Done than we will unset the session */ -->
    <?php //unset($_SESSION['updatecepdoc']); ?>

<script type="text/javascript">
  $(document).on("change","#duration",function(){
    var chargeid = $(this).val();
    $.ajax({
        url:base_url+'ce-provider/ce_provider/getrenewprice',
        type:'post',
        dataType: 'json',
        data:{'chargeid':chargeid,'charges_for':'cep_accreditation'},
        beforeSend:function(){  $(".loding-main").show(); },
        success:function(data){
          if(data['err'] == ''){
            $(".loding-main").hide();
            var html = '<p><b>Amount : </b> <span id="dispprice">'+data['charge']+'</span> USD</p><p><b>Tax ('+data['tax']+'%): </b> <span id="disptax">'+data['tax_amount']+'</span> USD</p><p><b>Total : </b> <span id="disptotal">'+data['total']+'</span> USD</p>';
            $('#pricesection').html(html);
            $('#amount').val(data['charge']);
            $('#tax').val(data['tax']);
            $('#taxamt').val(data['tax_amount']);
            $('#total').val(data['total']);
            $(".pay_btn").css("display","block");
            $('.payBtna').prop('disabled', false);
          }else{
            $(".loding-main").hide();
            $('#paynow').addClass('d-none');
            $('#message').html('Payment Related Data Not Found');
          }
        }
    });
  });

  function payByStrip() {
    var total = $('#total').val();
    var tax = $('#tax').val();
    var uname = $('#uname').val();
    var uid = $('#uid').val();
    var payment_for = $('#duration').val();
    var url = "<?php echo base_url('stripe/index')?>";
    // id = (CEP Accreditaion)
    window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&for='+payment_for+'&&type=CEP Accreditation';
  }

  </script>
