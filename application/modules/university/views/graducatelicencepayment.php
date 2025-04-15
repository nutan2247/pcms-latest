(<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php //echo $processingfee; 
//echo $page_title;
//print_r($paymentdetails);
?> 
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title; ?></h2>
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
        <div class="col-2" class="stepProcess">
            <a href="#" class="stepActive">
                <span><strong>1</strong>
				<i class="fa fa-check" aria-hidden="true"></i>
				</span>
                <label>List of Graduates</label>
            </a>
        </div>
        <div class="col-2" class="stepProcess">
            <a href="#">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Review of Graduates</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Exam Code</label>
            </a>        
        </div>
    </div>
	<?php print_r($this->session->all_userdata()); ?>
    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
            <?php echo $this->session->flashdata('error'); ?>
            <?php echo form_open_multipart('university/university/graducatepayment',array('id'=>'graduateprofileForm')); ?>
			<div class="form-group row">
				<div class="col-sm-8 mx-auto">
			<p class="text-center"><b class="mb-2"></b> 
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
            <div class="col-sm-7 mx-auto" id="pricesection"></div>
			<div class="form-group row">
			
				<input type="hidden" name="amount" id="amount"  value="">
				<input type="hidden" name="tax" id="tax"  value="">
				<input type="hidden" name="taxamt" id="taxamt"  value="">
				<input type="hidden" name="total" id="total"  value="">
				<input type="hidden" name="uid" id="uid"  value="<?php echo $this->session->userdata('uniid'); ?>">
				<input type="hidden" name="temporderid" id="temporderid"  value="<?php echo $paymentdetails['temporderid']; ?>">
				<input type="hidden" name="uname" id="uname"  value="<?php echo $this->session->userdata('university_name'); ?>">
			</div>
            
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="paynow" id="submitBtn">Pay Now</button>
					<button type="button" name="submit" onclick="payByStrip();" class="btn btn-info payBtna" disabled>Make Payment by Strip</button>
				</div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


</div>


<script>
$("#submitBtn").click(function(){  
		//alert('test');
		//var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajax({
			type:'post',
			url: '<?php echo base_url("graduates/graduates/graduatestep"); ?>',
			data: $('#graduateprofileForm').serialize(),
			dataType: 'json',
			cache: 'false',
		   //data: {cust_email: cust_email, cust_password: cust_password}, 
			beforeSend: function(xhr, settings) {
				$(".loding-main").show();
				
			},
			success: function(result){ 
				//alert('sdf');
				//alert(result.csrfHash);
				//csrf_token = result.csrfHash;
				//alert(JSON.stringify(result));
				//alert(result.msg);	
					$(".loding-main").hide();
					//debugger;
					if(result.error != undefined){
						if(result.error.name != undefined && result.error.name != ""){
							$('#name_error').html(result.error.name);
						}
						if(result.error.email != undefined && result.error.email != ""){
							$('#email_error').html(result.error.email);
						}
						if(result.error.birthday != undefined && result.error.birthday !=""){
							$('#birthday_error').html(result.error.birthday);
						} 
						if(result.error.gender != undefined && result.error.gender !=""){
							$('#gender_error').html(result.error.gender);
						} 
						if(result.error.examination_code != undefined && result.error.examination_code !=""){
							$('#examination_code_error').html(result.error.examination_code);
						}
					}
					//debugger;
					if(result.msg == '1'){	
						
						//alert(JSON.stringify(result));
						//alert(result.graducatdetails.length);
						//debugger;
						//alert(result.graducatdetails[0].student_name);
						//alert(result.graducatdetails->examcode);
						//$('#dphoto').html(result.graducatdetails[0].dphoto);
						//alert(result.graducatdetails.length);
						if(result.graducatdetails.length > 0){
							//alert(result.graducatdetails[0].student_name);
							if(result.graducatdetails[0].photo !=""){
								var studentimg = '<?php echo base_url("assets/images/graduates/");?>'+result.graducatdetails[0].photo;
							}else{
								var studentimg = '';
							}
							var url = '<?php echo base_url('graduates/graduates/book_exam/'); ?>';	
							$("#dphoto").attr("src",studentimg);
							$('#dname').html(result.graducatdetails[0].student_name);
							$('#demail').html(result.graducatdetails[0].email);
							$('#dbirthday').html(result.graducatdetails[0].dob);
							$('#duniversity').html(result.graducatdetails[0].university_name);
							$('#dcollegeof').html(result.graducatdetails[0].collegeofname);
							$('#dgender').html(result.graducatdetails[0].gender);
							$('#dvalidity').html(result.graducatdetails[0].validity);
							$('#dyear_of_graduated').html(result.graducatdetails[0].year_of_graduated);
							$('#dexamination_code').html(result.graducatdetails[0].examcode);
							$("#grad-submit").attr("href",url+result.graducatdetails[0].grad_id);
							$('#staticBackdrop').modal('show'); 
						}else{
							// alert('Data not found.');
							$('#graduteDataNotMatch').modal('show'); 
						}
					}
			} 
		});
});

function goToBookExam(){
	window.location.href = "<?php echo base_url('graduates/graduates/book_exam'); ?>";
}

function closeMMpopup(){
	$('#graduteDataNotMatch').modal('hide'); 

}
function hide_popup(){
	$('#staticBackdrop').modal('hide'); 

}
$(document).on("change","#duration",function(){

    var chargeid = $(this).val();
    var temporderid = $('#temporderid').val();
	//alert(chargeid); return false;
    $.ajax({
        url:base_url+'university/university/getrenewpriceforgraducatessubmition', 
        type:'post',
		dataType: 'json',
		data:{'temporderid':temporderid,'chargeid':chargeid,'charges_for':'submission_of_graduates_for_licensure_examination'},
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
    var url = "<?php echo base_url('stripe/index')?>";
    // id = 5 (foreign_professional_review_of_documents_for_professional_registration)
    window.location.href =url+'?uid='+uid+'&&uname='+uname+'&&price='+total+'&&tax='+tax+'&&type=submission of graduates for licensure examination';
    // window.location.href =url+'?uid=2&uname=nutan&price=20&tax=12&type=5';
}
</script>