<?php //print_r($profes_details); ?>
<?php  $this->load->view('professional/include/registration_banner'); ?>


<div class="container mb-5">
    <div class="row pro-steps">
        <div class="col-4">
            <a href="javascript:void(0);" class="stepActive">
                <span>
                    <strong>1</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Professional Information</label>
            </a>
        </div>
        <div class="col-4">
            <a href="javascript:void(0);" class="stepActive">
                <span>
                    <strong>2</strong>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Payment</label>
            </a>
        </div>
        <div class="col-4">
            <a href="javascript:void(0);" class="stepProcess">
                <span>
                    <strong>3</strong>
                </span>
                <label>Registration Certificate and <br>Professional Identification Card</label>
            </a>
        </div>
    </div>
</div>

<div class="bg-light py-4">
    <div class="col-md-8 mx-auto">
        <div class="text-center">
            <h4 class="mb-4 text-uppercase text-center">
                <?php $title; ?>
            </h4>
            <!-- <h5 class="text-center"> Registration Number: <b><?php echo $profes_details->registration_no; ?></b> </h5> -->

            <button onclick="printData('view_license_content')" type="button" class="btn btn-info ml-1 mb-3"
                title="Print"><i class="fa fa-print"></i></button>
            <button onclick="emailpopup('view_license_content')" type="button" class="btn btn-info ml-1 mb-3"
                title="Email"><i class="fa fa-envelope"></i></button>

            <h4 class="text-center text-header">Professional Identification Card</h4>
            <div class="row" id="view_license_content">
                <link
                    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
                    rel="stylesheet">
                <link
                    href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese"
                    rel="stylesheet">
                <?php $licensebg = base_url('assets/images/bg-image.png'); 
            $licenselogo = base_url('assets/images/print-logo.png'); 
            $licenselogo2 = base_url('assets/images/red-bird.png'); 
            $licensebarcode = base_url('assets/images/barcode.png');  
            $photo = base_url('assets/uploads/profile/'.$profes_details->image);?>
                <table
                    style="width: 900px; margin: 0 auto; background-image: url(<?php echo $licensebg;?>); margin-top: 50px; ">
                    <thead>
                        <tr style="background-color: #2f5597; ">

                            <th style="position: relative; "><img src="<?php echo $licenselogo;?>" alt=""
                                    style="position: absolute;top: 13px;width: 110px;left: 66px;right: 0;"></th>
                            <th style="text-align: center; color: #fff; padding: 12px; width: 100%;">
                                <h2 style="padding-right: 140px;">CEONPOINT</h2>
                                <p
                                    style="margin: 0;text-transform: uppercase;letter-spacing: 0.2px; padding-right: 100px;">
                                    "
                                    Home
                                    of Continuing Education for all Professionals "</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid #ddd;">
                        <tr>
                            <td style=" width: 28%; padding: 30px 0 0 30px; "><img src="<?php echo $photo;//echo $licenselogo2;?>"
                                    alt="<?php echo ucwords($profes_details->name); ?>" style="width: 100%;">
                                <p style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 20px; ">
                                <?php echo isset($profes_details->license_no)?$profes_details->license_no:$profes_details->registration_no;?>,
                                    <?php echo (($profes_details->lic_issue_date != '0000-00-00 00:00:00')?date('M d,Y',strtotime($profes_details->lic_issue_date)):date('M d,Y',strtotime($profes_details->issued_date))); ?>
                                </p>
                            </td>
                            <td style="padding-left: 40px; padding-top: 50px;">
                                <h3 style="color: #2f5597; text-transform: uppercase; font-weight: bold;">Professional
                                    Identification card</h3>
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">Name
                                            </td>
                                            <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                <?php echo ucwords($profes_details->fname.' '.$profes_details->lname.' '.$profes_details->name);?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">License
                                                No.</td>
                                            <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                <?php echo isset($profes_details->license_no)?$profes_details->license_no:$profes_details->registration_no;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">
                                                Registration
                                                Date</td>
                                            <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                <?php echo (($profes_details->lic_issue_date != '0000-00-00 00:00:00')?date('M d,Y',strtotime($profes_details->lic_issue_date)):date('M d,Y',strtotime($profes_details->issued_date))); ?>
                                            </td>
                                        </tr>
                                        <?php if($profes_details->validity_date != '0000-00-00'){
                                                $validity_date = date('M d,Y',strtotime($profes_details->validity_date));
                                            }else{
                                                $validity_date = '--';
                                            } ?>
                                        <tr>
                                            <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">Valid
                                                Untill
                                            </td>
                                            <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                <?php echo $validity_date; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <img src="<?php echo $licensebarcode;?>" alt=""
                                    style="width: 343px; margin-bottom: 20px;">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <hr>
            <h4 class="text-center text-header">Certificate</h4>
            <button onclick="printData('view_certificate_content')" type="button" class="btn btn-info ml-1 mb-3"
                title="Print"><i class="fa fa-print"></i></button>
            <button onclick="emailpopup('view_certificate_content')" type="button" class="btn btn-info ml-1 mb-3"
                title="Email"><i class="fa fa-envelope"></i></button>
    <div class="row" id="view_certificate_content">
                <link
                    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
                    rel="stylesheet">
                <link
                    href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese"
                    rel="stylesheet">
                <?php $bg = base_url('assets/images/darkblue-bg.jpg'); 
            $logo1 = base_url('assets/images/bird.png'); 
            $logo2 = base_url('assets/images/red-bird.png'); 
            $certificate_text = base_url('assets/images/blue-text.png'); 
            $sinature1 = base_url('assets/images/sinature.png'); 
            $sinature2 = base_url('assets/images/sinature.png'); 
            $sinature3 = base_url('assets/images/sinature.png'); 
            $barcode = base_url('assets/images/scan.png'); 
                ?>
                <table
                    style="  width: 881px; padding:74px 15px 40px 15px; display:block;margin: 0 auto; background-image: url('<?php echo $bg; ?>'); background-repeat: no-repeat; background-size: cover;">
                    <tr>
                        <th>
                            <table
                                style="width: 621px;margin: 24px 119px 13px;text-align: center;font-family: 'Montserrat', sans-serif;">
                                <tr>
                                    <th><span class="images"
                                            style=" display: inline-block; vertical-align: middle; float: left; "><img
                                                src="<?php echo $logo1; ?>" alt="" style="width: 75px;"></span></th>
                                    <th><span class="hesder-content"
                                            style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; ">Continuing
                                            Education on point<br>
                                            Delaware, United State of America</span></th>
                                    <th><span class="images"
                                            style=" display: inline-block; vertical-align: middle; float: right;"><img
                                                src="<?php echo $logo2; ?>" alt="" style="width: 75px;"></span></th>
                                </tr>
                            </table>
                        </th>

                    </tr>
                    <tr>
                        <td>
                            <table style="width: 461px;margin: 0 auto;margin-top: 6px;">

                                <tr>
                                    <td><img src="<?php echo $certificate_text; ?>" alt=""
                                            style="width: 92%;margin: 12px 0;"></td>

                                </tr>

                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h1
                                style="color: #dd8827;text-transform: uppercase;font-family: 'Montserrat', sans-serif;font-weight: 600;text-align: center;margin: 11px 0;">
                                of Registration
                            </h1>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>
                            <h1
                                style="font-family: 'Tangerine', cursive; font-size: 48px;font-weight: 700; margin: 0; ">
                                <?php echo ucwords($profes_details->fname.' '.$profes_details->lname.' '.$profes_details->name);?>
                            </h1>
                            <span
                                style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>
                            <p
                                style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                                is now Register for<br>
                                Professional Registration
                                <?php //echo ucwords($profes_details->profession_name);?>
                            </p>
                            <p
                                style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                                He is granted the authority to practice his/her <br>
                                Profession in accordance with the law of
                                Our land.
                            </p>

                            <p
                                style="font-size: 19px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                                License Number : <strong>
                                <?php echo isset($profes_details->license_no)?$profes_details->license_no:$profes_details->registration_no;?>
                                </strong><br>
                                Validity : <strong>
                                    <?php echo $validity_date; ?>
                                </strong>
                            </p>
                            <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">Granted
                                This</p>
                            <p
                                style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                                <?php echo (($profes_details->lic_issue_date != '0000-00-00 00:00:00')?date('M d,Y',strtotime($profes_details->lic_issue_date)):date('M d,Y',strtotime($profes_details->issued_date))); ?>
                            </p>
                            <p
                                style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                                Manila, Philippines</p>
                            <p
                                style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                            </p>
    </div>
            </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 540px;margin: 0 auto;margin-top: 57px;margin-bottom: 131px;">
                        <tr>
                            <td
                                style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                                <img src="<?php echo $sinature1; ?>" alt="" style=" width: 57px;">
                                <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                                </p>
                                <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                            </td>
                            <td
                                style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                                <img src="<?php echo $sinature2; ?>" alt="" style=" width: 57px;">
                                <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                                </p>
                                <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                            </td>
                            <td
                                style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                                <img src="<?php echo $sinature3; ?>" alt="" style=" width: 57px;">
                                <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                                </p>
                                <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                            </td>

                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="
                width: 90%; margin: 0 auto; padding-top: 30px; padding-bottom: 38px; ">
                        <tr>
                            <td style="text-align: left;width: 60%;">
                                <!-- <img src="images/footer-logo.png" alt="" style=" padding-top: 19px; "> -->
                                <p style=" padding-top: 55px;"></p>
                                <p
                                    style=" color: #fff; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                    Validate this certificate at:</p>
                                <a href="#"
                                    style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; ">
                                    <?php echo base_url('license/search'); ?>
                                </a>
                            </td>
                            <td style="text-align: right; width: 40%;">
                                <img src="<?php echo $barcode; ?>" alt="" style=" width: 70px">
                                <p
                                    style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                    License Number</p>
                                <p
                                    style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
                                    <?php echo isset($profes_details->license_no)?$profes_details->license_no:$profes_details->registration_no;?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>
            
        </div>

    </div>
</div>
</div>


<!-- Send Certificate By Email Modal -->
<div id="emailpopup" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Mail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="emailAdderss" name="email" class="form-control"
                        value="<?php echo $profes_details->email; ?>">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="emailData()">Send</button>
            </div>
        </div>

    </div>
</div>


<!-- View Professional's Certificate Modal -->
<div id="viewModalCenter" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Certificate</h4>
                <button onclick="printData('view_certificate_content')" type="button" class="btn btn-info ml-1"
                    title="Print"><i class="fa fa-print"></i></button>
                <button onclick="emailpopup('view_certificate_content')" type="button" class="btn btn-info ml-1"
                    title="Email"><i class="fa fa-envelope"></i></button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <p id="view_certificate_content"></p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- certificate_html.php -->
<script>
    function printData(printid) {
        var printContents = document.getElementById(printid).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function emailpopup() {
        $('#emailpopup').modal('show');
        $('#viewModalCenter').modal('hide');
    }

    function emailData() {
        var email = $('#emailAdderss').val();
        var name = '<?php echo $profes_details->name; ?>';
       // var content = document.getElementById(mailcontent).innerHTML;
       var content = 'Certificate';
        var to = email;
        var subject = "Professional's Certificate";
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("professional/applicant/send_certificate_mail"); ?>',
            data: {
                to: to,
                name: name,
                subject: subject,
                content: content
            },
            success: function (result) {
                alert(result);
                $('#emailpopup').modal('hide');
            }
        });
    }

    // function viewCertificate(uid){
    //     $.ajax({
    //       type: "POST", 
    //       url: "<?php echo base_url('professional/applicant/get_certificate'); ?>", 
    //       data: { uid : uid },
    //       beforeSend: function () {
    //         $('#view_certificate_content').html("Please wait...");
    //         $('#viewModalCenter').modal('show');
    //       },
    //       success: function(result){
    //         // alert(result);
    //         $('#view_certificate_content').html(result);
    //         $('#viewModalCenter').modal('show');
    //       }
    //     });
    // }
</script>