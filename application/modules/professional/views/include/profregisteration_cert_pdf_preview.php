<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Profregistration_certificate Portrait</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
</head><body><div class="row" id="view_certificate_content">
            <?php $bg = base_url('assets/images/darkblue-bg.jpg'); 
            $logo1 = base_url('assets/images/bird.png'); 
            $logo2 = base_url('assets/images/red-bird.png'); 
            $certificate_text = base_url('assets/images/blue-text.png'); 
            $sinature1 = base_url('assets/images/sinature.png'); 
            $sinature2 = base_url('assets/images/sinature.png'); 
            $sinature3 = base_url('assets/images/sinature.png');
            if(isset($profes_details->lic_qrcode)){
                $barcode = base_url('assets/qrcode/'.$profes_details->lic_qrcode);
            }else{ 
                //$barcode = base_url('assets/images/scan.png'); 
                $barcode = '';
            }
                ?>
                <table style="width: 100%; padding:70px 15px 0px 0px; margin: 0 auto; background-image: url(<?php echo showimage($bg); ?>); background-repeat: no-repeat; background-size: cover;">
                
                    <tr>
                        <th>
                            <table style="width: 600px; margin: 0px auto; text-align: center;font-family: 'Montserrat', sans-serif;">
                            
                                <tr>
                                    <th><span class="images" style="vertical-align: middle; float: left; "><img
                                                src="<?php echo showimage($logo1); ?>" alt="" style="width: 75px;"></span></th>
                                    <th><span class="hesder-content" style="color: #0d0d0d; font-weight: 600;  font-size: 19px; ">Continuing
                                            Education on point<br>
                                            Delaware, United State of America</span></th>
                                    <th><span class="images" style="vertical-align: middle; float: right;"><img
                                                src="<?php echo showimage($logo2); ?>" alt="" style="width: 75px;"></span></th>
                                </tr>
                                
                            </table>
                        </th>

                    </tr>
                    <tr>
                        <td>
                            <table style="width: 300px;margin: 0 auto;margin-top: 0px;">

                                <tr>
                                    <td><img src="<?php echo showimage($certificate_text); ?>" alt=""
                                            style="width: 100%;margin:0px 0;"></td>

                                </tr>

                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h1
                                style="color: #dd8827;text-transform: uppercase;font-family: 'Montserrat', sans-serif;font-weight: 600;text-align: center;margin: 11px 0;">
                                of registration
                            </h1>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>
                            <h1
                                style="font-family: 'Tangerine', cursive; font-size: 40px;font-weight: 700; margin: 0; ">
                                <?php echo ucwords($profes_details->fname.' '.$profes_details->lname.' '.$profes_details->name); ?>
                            </h1>
                            <span
                                style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;margin: 0 auto;margin-top: 0"></span>
                            <p
                                style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                                is now a registered
                                <?php echo ucwords($profes_details->profession_name); ?>
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
                                    <?php echo $license_no;?>
                                </strong><br>
                                <?php if($profes_details->validity_date != '0000-00-00'){
                                $validity_date = date('M d,Y',strtotime($profes_details->validity_date));
                                }else{
                                    $validity_date = '--';
                                } ?>
                                Validity : <strong>
                                    <?php echo $validity_date; ?>
                                </strong>
                            </p>
                            <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">Granted
                                This</p>
                            <p
                                style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                                <?php echo date('M d,Y',strtotime($profes_details->lic_issue_date)); ?>
                            </p>
                            <p
                                style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                                Manila, Philippines</p>
                            <p
                                style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                            </p>
                        
                        </td>
                    </tr>
            <tr>
                <td>
                    <table style="width: 540px;margin: 0 auto;margin-top: 0px; margin-bottom: 60px;">
                        <tr>
                            <td
                                style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                                <img src="<?php echo showimage($sinature1); ?>" alt="" style=" width: 57px;">
                                <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                                </p>
                                <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                            </td>
                            <td
                                style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                                <img src="<?php echo showimage($sinature2); ?>" alt="" style=" width: 57px;">
                                <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan
                                </p>
                                <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                            </td>
                            <td
                                style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                                <img src="<?php echo showimage($sinature3); ?>" alt="" style=" width: 57px;">
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
                width: 90%; margin: 0 auto; padding-top: 10px; padding-bottom: 28px; ">
                        <tr>
                            <td style="text-align: left;width: 60%;">
                                <!--<img src="images/footer-logo.png" alt="" style=" padding-top: 19px; ">-->
                                <!-- <p style=" padding-top: 55px;"></p> -->
                                <p
                                    style=" color: #fff; font-size: 18px; margin: 0px 0 0 0; font-family: 'Montserrat', sans-serif; padding-top:90px;">
                                    Validate this certificate at:</p>
                                <a href="#"
                                    style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; ">
                                    <?php echo base_url('license/search'); ?>
                                </a>
                            </td>
                            <td style="text-align: right; width: 40%;">
                                <img src="<?php echo showimage($barcode); ?>" alt="" style=" width: 70px">
                                <p
                                    style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                    License Number</p>
                                <p
                                    style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
                                    <?php echo $license_no;?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>