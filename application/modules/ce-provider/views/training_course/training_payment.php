
    <?php echo $this->load->view('ce-provider/common/training_course_banner'); ?>
  <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>2</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Online Course File</label>
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
                        <label>Review of Online Course</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <!--<label>Digital Accreditaion</label>-->
                        <label>Digital Certificate of Accreditaion</label>
                    </a>
                </div>
        </div>
    </div>
<?php //print_r($this->session->all_userdata()) ?>

  <!--   <div class=" rounded mb-5">
        <div class="col-md-6 mx-auto text-left">
            <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>  
        </div>
    </div> -->
           
    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <div id="payment-details">
                <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open(base_url('ce-provider/ce_provider/trainng_paypal_payment')); ?>
				
				<div class="col-sm-8 mx-auto">
				<p><b><span class="mb-3 d-block text-center">Accreditation Period : </span></b> 
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
                    <input type="hidden" name="train_doc_id" id="train_doc_id"  value="<?php echo $post['train_doc_id'];?>">
                    <input type="hidden" name="amount" id="amount"  value="">
                    <input type="hidden" name="tax" id="tax"  value="">
                    <input type="hidden" name="taxamt" id="taxamt"  value="">
                    <input type="hidden" name="total" id="total"  value="">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('logincepacc')['user_ID'];?>">
                    <input type="hidden" name="uname" id="uname" value="<?php echo $this->session->userdata('logincepacc')['name'];?>">
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

    <!-- /* Once payment Done than we will unset the session */ -->
    <?php //unset($_SESSION['cor_doc_id']); ?>
    
     <script>

		$(document).on("change","#duration",function(){

            var chargeid = $(this).val();
            //alert(chargeid); return false;
            $.ajax({
                url:base_url+'university/university/getrenewprice', 
                type:'post',
                dataType: 'json',
                data:{chargeid},
                data:{'chargeid':chargeid,'charges_for':'training_course_accreditation'},
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
            var total   = $('#total').val();
            var tax     = $('#tax').val();
            var uname   = $('#uname').val();
            var uid     = $('#uid').val();
            var url     = "<?php echo base_url('stripe/index')?>";
            // id       = (Training Course Accreditation)
            window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=Training Course Accreditation';
        }
    </script>