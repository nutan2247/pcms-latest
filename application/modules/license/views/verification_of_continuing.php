
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Professional License Card Renewal</h2>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
</div>
<!-- <?php // echo '<pre>'; echo isset($_SESSION['all_certicates_id'])?$_SESSION['all_certicates_id']:'-nk-'; echo '</pre>'; ?> -->
<div class="container">

    <div class="row pro-steps">
        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>1</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Personal & Professional Verification</label>
            </a>        
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepActive">
                <span>
                    <strong>2</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Required CE Units Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="javasacript:void(0);" class="stepProcess">
                <span>3</span>
                <label>CE Certificates Verification</label>
            </a>
        </div>

        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Payment</label>
            </a>
        </div>

        <div class="col-2">
            <?php if(!empty($user_view) && isset($view)) { ?>
            <a href="<?php echo base_url('license/landing/digital_professional?view=1&user_id='.$user_id.'&user_view='.base64_encode($user_id)) ?>" class="stepActive">
                <span><strong>5</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                 <label>Renewed Professional License</label>
            </a>
        <?php }else if(!empty($user_view) && !isset($view)){ ?>
            <a href="<?php echo base_url('license/landing/digital_professional?user_id='.$user_id.'&user_view='.base64_encode($user_id)) ?>" class="stepActive">
                <span><strong>5</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                 <label>Renewed Professional License</label>
            </a>
        <?php }else{ ?>
            <a href="#">
                <span>5</span>
                <label>Renewed Professional License</label>
            </a>
        <?php } ?>
        </div>
    </div>

    <div class="col-md-10 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">CE Certificates Verification</h4>
            <div class="table-div bg-primary p-4 rounded my-1">
                <h4 class="text-light mb-3 text-uppercase">Reported CERTIFICATES</h4>
                <div class="bg-white p-3">
                    <div class="tab-content pt-2">
                        <div id="home" class="tab-pane fade in active show">
                            <!-- <h3>ALL</h3> -->
                            <div class="table-responsive">
                           <table class="table">
                                <tr>
                                   <th>No.</th>
                                    <th>Course/Traning Name</th>
                                    <th>Units</th>
                                    <th>Issued By</th>
                                    <th>Issued From</th>
                                    <th>Category</th>
                                    <th>Certificate No</th>
                                     <th>Web Link</th>
                                    <th>Staus</th>
                                </tr>
                                <?php  $all_certificate='';
                                if(!empty($get_all_certificate)) {
	      		                    $s_no = 1;
                                       $arr = array_column($get_all_certificate,'id');
                                       $all_certificate = implode(',',$arr);
	      	                    foreach ($get_all_certificate as $key => $value) {?>
                                <tr>
                                    <td><?php echo $s_no; ?></td>
                                    <td><?php echo $value['course_name']; ?></td>
                                    <td><?php echo $value['units']; ?></td>
                                    <td><?php echo $value['issue_by']; ?></td>
                                    <td><?php echo $value['issue_from']; ?></td>
                                    <td><?php echo $value['category']; ?></td>
                                    <td><?php echo $value['certificate_id']; ?></td>
                                    <td width="150"><a  href="<?php echo $value['web_link']; ?>" title="<?php echo $value['web_link']; ?>"><?=substr($value['web_link'], 8, 25);?>...</a></td>
                                    <?php if($value['certificate_identify'] == 1 ){ 
                                                $certificate_status = '<i style="color:green">Verified</i>';
                                            }else if($value['certificate_identify'] == 2 ){
                                                $certificate_status = '<i style="color:red">Unverified</i>'; 
                                            }else{
                                                $certificate_status = '<i style="color:red">Pending</i>'; 
                                            } ?>
                                    <td><?php echo $certificate_status; ?>
                                    </td>
                               </tr>
                                <?php $s_no++; } } ?>
                            </table>
                           </div>
                        </div>

                        
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-12 text-center mt-4">

                <a href="javascript:void(0);" class="btn btn-success m-2" id="verifyCertificate" data-id="<?php echo $user_id; ?>" name="<?php echo $this->uri->segment(4); ?>" value="<?php echo $all_certificate; ?>"> VERIFY CERTIFICATES NOW </a>

                <!-- <?php if(isset($get_total_not_verified_certified) && $get_total_not_verified_certified > 0) {?>
                    <a href="javascript:void(0)" id="pay_for_verifyCertificate" class="btn btn-info">Pay NOW </a> 
                <?php } ?> -->

            </div>

        </div>
       
    </div>

</div>






<!-----------------------   POPUP  VERIFIED CERTIFICATE    ---------------------->

<div class="modal fade" id="thanku_pop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="thanku_pop" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="thanku_pop">Congratulations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="body">
                    <div class="bs-example">
                        <p class="">Your digital certificates are verified 100%</p>
                        <p class=""><i style="color:green" class="icon-ok-sign"></i> DIGITAL VERIFIED
                            <?php echo $get_total_verified_certified; ?> CERTIFICATES</p>
                        <p class="">Please proceed to payment to get your renewed professional license.</p>
                        <p class="mt-4">
                            <!-- <a href="#" class="btn btn-success text-uppercase" data-toggle="modal" data-target="#confirmData">Confirm</a> -->                        
                            <a href="<?php echo base_url('license/landing/payment') ?>" class="btn btn-success text-uppercase">PROCEED FOR PAYMENT</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!---------------------   POPUP Verification Summary ----------->
<div class="modal fade  green-bg-heading" id="verification_summary_pop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="thanku_pop" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <div class="modal-title text-center w-100">
                    <h4 class="text-uppercase">DIGITAL VERIFICATION OF CERTIFICATE</h4>
                    <!-- <h4 class="text-uppercase" id="pop-header">NEED MANUAL VERIFICATION</h4> -->
                </div>
                    <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <div id="body" class="col-md-12 mx-auto">
                    <div class="bs-example text-left">
                        <h6 class="text-uppercase" id="pop-header">NEED MANUAL VERIFICATION</h6><br>
                        <label for="">SUMMARY</label>
                        <p class=""><i style="color:green" class="icon-ok-sign"></i> VERIFIED CERTIFICATES :<span id="ajaxverified"></span></p>
                        <p class=""><i style="color:red" class="icon-remove-sign"></i> UNVERIFIED CERTIFICATES : <span id="ajaxunverified"></span></p>
                    </div>

                    <div class="table-div bg-primary rounded my-1">
                        <h4 class="text-light mb-0 text-uppercase p-2">Reported CERTIFICATES</h4>
                        <div class="bg-white p-3">
                            <div class="tab-content pt-2">
                                <div id="home" class="tab-pane fade in active show">
                                    <div id="listloop"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <p id="pop-text">Your certificate which are unverified digitallay will be reviewed manually by our reviewer and will take 30 days for verification.</p>
                    <p>Please proceed to payment to get your renewed professional Identification card.</p>
                    <p class="mt-4">
                        <a href="<?php echo base_url('/license/landing/payment/').$this->uri->segment(4); ?>" class="btn btn-success btn-lg text-uppercase float-right">PAYNOW</a>
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</div>




<script type="text/javascript">

    $(document).on("click", "#verified_certificate_now", function () {
        $('#thanku_pop').modal('show');
    });

    $('#verifyCertificate').on("click", function () {
        var value = $(this).attr('value');
        var encoded_uid = $(this).attr('name');
        var uid = $(this).attr('data-id');

        $.ajax({
            url:base_url+'license/landing/submit_certificate',
            type:'post',
            data:{ value:value, uid:uid },
            success:function(result){
                // alert(result);
                var obj = JSON.parse(result);
                var verified = obj.verified.length; 
                var unverified = obj.unverified.length; 
                // console.log(obj.unverified);
                var listloop = [];
                    listloop += '<div class="table-responsive" style="font-size:12px;"><table class="table"> <tr> <th>No.</th> <th>Course/Traning Name</th><th>Staus</th><th>Units</th> <th>Issued By</th> <th>Issued From</th> <th>Category</th> <th>Certificate No</th> <th>Web Link</th></tr>';
                if(obj.unverified.length > 0){
                    var count = 1;
                    // var status = '';
                    for (i = 0; i < obj.unverified.length; i++) {
                        if(obj.unverified[i].certificate_identify == 1 ){ 
                            var status = '<i style="color:green">Verified</i>';
                        }else if(obj.unverified[i].certificate_identify == 2 ){
                            var status = '<i style="color:red">Unverified</i>'; 
                        }else{
                            var status = '<i style="color:red">Pending</i>'; 
                        }
                        listloop += "<tr><td>" + count + "</td><td>" + obj.unverified[i].course_name + "</td><td>" + status + "</td><td>" + obj.unverified[i].units + "</td><td>" + obj.unverified[i].issue_by + "</td><td>" + obj.unverified[i].issue_from + "</td><td>" + obj.unverified[i].category + "</td><td>" + obj.unverified[i].certificate_id + "</td><td>" + obj.unverified[i].web_link + "</td></tr>";
                        count++;
                    }
                }
                if(obj.verified.length > 0){
                    var count1 = 1;
                    // var status1 = '';
                    for (i = 0; i < obj.verified.length; i++) {
                        if(obj.verified[i].certificate_identify == 1 ){ 
                            var status1 = '<i style="color:green">Verified</i>';
                        }else if(obj.verified[i].certificate_identify == 2 ){
                            var status1 = '<i style="color:red">Unverified</i>'; 
                        }else{
                            var status1 = '<i style="color:red">Pending</i>'; 
                        }
                        listloop += "<tr><td>" + count1 + "</td><td>" + obj.verified[i].course_name + "</td><td>" + status1 + "</td><td>" + obj.verified[i].units + "</td><td>" + obj.verified[i].issue_by + "</td><td>" + obj.verified[i].issue_from + "</td><td>" + obj.verified[i].category + "</td><td>" + obj.verified[i].certificate_id + "</td><td>" + obj.verified[i].web_link + "</td></tr>";
                        // console.log(obj.verified[i]);
                        count1++;
                    }
                }
                listloop += '</table></div>'
                $('#ajaxverified').html(verified);
                $('#ajaxunverified').html(unverified);
                $('#listloop').html(listloop);

                if(obj.verified.length > 0 && obj.unverified.length == 0){
                $('#pop-header').html('100% VERIFIED');
                $('#pop-text').html('Your certificate which are 100% VERIFIED DIGITALY.');
                }else{
                $('#pop-header').html('NEED MANUAL VERIFICATION');
                $('#pop-text').html('Your certificate which are unverified digitallay will be reviewed manually by our reviewer and will take 30 days for verification.');
                }
                    
                $('#verification_summary_pop').modal('show');
                // window.location.href= base_url +'license/landing/payment/'+encoded_uid;
                // location.reload();
            }
        });
    });

    $(document).on("click", "#pay_for_verifyCertificate", function () {
        // var path = "<?php echo base_url('license/landing/payment/').$this->uri->segment(4); ?>";
        // window.location.href = path;
        $('#verification_summary_pop').modal('show');
    });
</script>

