<!-- body -->
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
                    $licensebarcode = base_url('assets/images/barcode.png');  ?>
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
                                <td style=" width: 28%; padding: 30px 0 0 30px; "><img src="<?php echo $licenselogo2;?>"
                                        alt="<?php echo ucwords($details->name); ?>" style="width: 100%;">
                                    <p style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 20px; ">
                                        <?php echo $details->registration_no;?>,
                                        <?php echo date('Y-m-d',strtotime($details->issued_date)); ?>
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
                                                    <?php echo ucwords($details->fname.' '.$details->lname.' '.$details->name);?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">License
                                                    No.</td>
                                                <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                    <?php echo $details->registration_no;?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">
                                                    Registration
                                                    Date</td>
                                                <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                    <?php echo date('Y-m-d',strtotime($details->issued_date)); ?>
                                                </td>
                                            </tr>
                                            <?php if($details->validity_date != '0000-00-00'){
                                    $validity_date = date('Y-m-d',strtotime($details->validity_date));
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
                                    of registration
                                </h1>
                            </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>
                                <h1
                                    style="font-family: 'Tangerine', cursive; font-size: 48px;font-weight: 700; margin: 0; ">
                                    <?php echo ucwords($details->fname.' '.$details->lname.' '.$details->name);?>
                                </h1>
                                <span
                                    style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>
                                <p
                                    style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                                    is now a registered
                                    <?php echo ucwords($details->profession_name);?>.
                                </p>
                                <p
                                    style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                                    He is granted the authority to practice his/her <br>
                                    Profession in accordance with the law of
                                    Our land.
                                </p>

                                <p
                                    style="font-size: 19px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                                    Registration Number : <strong>
                                        <?php echo $details->registration_no;?>
                                    </strong><br>
                                    Validity : <strong>
                                        <?php echo $validity_date; ?>
                                    </strong>
                                </p>
                                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">Granted
                                    This</p>
                                <p
                                    style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                                    <?php echo date('M-d-Y',strtotime($details->issued_date)); ?>
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
                                        <?php echo $details->registration_no;?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table>
            
        <!-- end body -->