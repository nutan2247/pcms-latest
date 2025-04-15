
        <div class="col-md-10 mx-auto form-heigte">
            <div class="my-0">
               <h4 class="mb-2 mt-4 text-uppercase text-center">Payment</h4>
            </div>
<?php //print_r ($this->session->userdata('logincepacc')) ?>
          <div class="p-4 rounded mb-5">
            <div class="col-md-6 mx-auto">
                <?php echo form_open_multipart('ce-provider/ce_provider/renewal_payment',array('id'=>'renewal_payment')); ?>
                
                <div class="form-group row">
                  <div class="col-sm-12 mx-auto">
                  <p><b class="d-block mb-2">Purchase for : </b> 
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
                      
                  <div class="col-sm-6 text-center mx-auto" id="pricesection">
                  </div>
                </div>
                     
                <div class="form-group row">
                  <div class="col-sm-12 text-center" id="pricesection"></div>
                  <input type="hidden" name="amount" id="amount"  value="">
                  <input type="hidden" name="tax" id="tax"  value="">
                  <input type="hidden" name="taxamt" id="taxamt"  value="">
                  <input type="hidden" name="total" id="total"  value="">
                  <input type="hidden" name="uid" id="uid"  value="<?= $this->session->userdata('logincepacc')['user_ID'] ?>">
                  <input type="hidden" name="uname" id="uname"  value="<?= $this->session->userdata('logincepacc')['name'] ?>">
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

    <script type="text/javascript">

      $(document).on("change","#duration",function(){
        var chargeid = $(this).val();

        $.ajax({
          url:base_url+'ce-provider/ce_provider/getrenewprice',
          type:'post',
          dataType: 'json',
          data:{'chargeid':chargeid,'charges_for':'cep_accreditation'},
          beforeSend:function(){
              $(".loding-main").show();
          },

          success:function(data){
            $(".loding-main").hide();
            var html = '<p><b>Processing Fee : </b> <span id="dispprice">'+data['charge']+'</span> USD</p><p><b>Tax ('+data['tax']+'%): </b> <span id="disptax">'+data['tax_amount']+'</span> USD</p><p><b>Total : </b> <span id="disptotal">'+data['total']+'</span> USD</p>';
            //$('#dispprice').html(data['charge']);
            $('#pricesection').html(html);
            //$('#item_name_2').val($('#duration').val());
            $('#amount').val(data['charge']);
            $('#tax').val(data['tax']);
            $('#taxamt').val(data['tax_amount']);
            $('#total').val(data['total']);
            $(".pay_btn").css("display","block");
            $('.payBtna').prop('disabled', false);
          }

        });
      });
    function payByStrip() {
        var total = $('#total').val();
        var tax = $('#taxamt').val();
        var uname = $('#uname').val();
        var uid = $('#uid').val();
        var payment_for = $('#duration').val();
        var url = "<?php echo base_url('stripe/index')?>";
        // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
        window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&for='+payment_for+'&&type=CEP Accreditation Renewal';
        // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
    }
  </script>
