<?php //print_r($result[0]); exit;?>
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
    <table style="  width: 95%; padding:60px 15px 0 15px; margin: 0 auto 38px; background-image: url('<?php echo $bg; ?>'); background-repeat: no-repeat; background-size: cover;">
        <tr>
            <th>
                <table style=" width: 590px; margin: 90px auto 0; text-align: center;font-family: 'Montserrat', sans-serif; ">
                    <tr>
                        <th><span class="images"
                                style=" display: inline-block; vertical-align: middle; float: left; "><img
                                    src="<?php echo $logo1; ?>" alt="" style="width: 75px;"></span></th>
                        <th><span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; ">Continuing Education on point<br>
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
                <table style="width: 461px;margin: 18px auto;">

                    <tr>
                        <td><img src="<?php echo $certificate_text; ?>" alt="" style=" width: 100%; "></td>

                    </tr>

                </table>
            </td>

        </tr>
        <tr>
            <td>
                <h1
                    style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;">
                    of Eligibility
                </h1>
            </td>
        </tr>
		<tr style="text-align: center;">
            <td>
                <p style="font-size: 17px;color: #0d0d0d;margin-top: 20px;font-weight: 500;font-family: 'Montserrat', sans-serif;max-width: 50%;margin: 10px auto;">
                    Is hereby granted to
                </p>
                <h1 style="font-size: 30px; font-weight: 700; margin: 0; "><?php echo $result[0]->fname.' '.$result[0]->lname.' '.$result[0]->name;?></h1>
                <span style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>

                <!--<p style="font-size: 20px;margin: 13px 0;font-family: 'Montserrat', sans-serif;font-weight: 400;">
                is now a registered <br> <?php echo $result[0]->profession_name;?>
                </p>-->
                <p style="font-size: 20px;margin: 13px 0;font-family: 'Montserrat', sans-serif;font-weight: 400;">
                is now eligible for <br>Professional Registration
                </p>
                <!--<p style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                    He is granted the authority to practice his/her <br>
                    Profession in accordance with the law of
                    Our land.
                </p>-->
                <?php if($result[0]->expiry_at !='0000-00-00'){
                    $validity=date("M d,Y",strtotime($result[0]->expiry_at));
                    }else{
                    $validity=date("M d,Y",strtotime($result[0]->license_validity_date)); }?>
                <p style="font-size: 19px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                    Registration Code : <strong>
                    <?php echo $result[0]->registration_no;?>
                    </strong><br>
                                Validity : <strong>
                                    <?php echo $validity; ?>
                                </strong>
                            </p>
                            <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">Granted
                                This</p>
                                <p
                                style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                                <?php echo date('M d,Y',strtotime($result[0]->added_on)); ?>
                            </p>
                            <p
                                style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                                Manila, Philippines</p>
                <p style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                </p>
            </td>
        </tr>
        
        <tr>
            <td>
                <table style="width: 540px; margin: 0 auto; margin-bottom: 110px;">
                    <tr>
                        <td
                            style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo $sinature1; ?>" alt="" style=" width: 57px;">
                            <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan</p>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                        </td>
                        <td
                            style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo $sinature2; ?>" alt="" style=" width: 57px;">
                            <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan</p>
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
                            <img src="images/footer-logo.png" alt="" style=" padding-top: 19px; ">
                            <p style=" padding-top: 55px;" ></p>
                            <p
                                style=" color: #fff; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; 0 0 20px 0;">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <img src="<?php echo $barcode; ?>" alt="" style=" width: 70px">
                            <p
                                style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Registration Code</p>
                            <p
                                style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0 0 20px 0;">
                                <?php echo $result[0]->registration_no; ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

