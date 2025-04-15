<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Certificate Portrait</title>
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese"
        rel="stylesheet">
</head>

<body>
    <div class="row" id="view_certificate_content">
        <?php $bg = base_url('assets/images/banner.png'); 
            $logo1 = base_url('assets/images/bird.png'); 
            $logo2 = base_url('assets/images/red-bird.png'); 
            $certificate_text = base_url('assets/images/certificate-head.png'); 
            $sinature1 = base_url('assets/images/sinature.png'); 
            $sinature2 = base_url('assets/images/sinature.png'); 
            $sinature3 = base_url('assets/images/sinature.png'); 
            //$barcode = base_url('assets/images/scan.png');
            $barcode = base_url('assets/qrcode/'.$result->train_qrcode); 
                ?>
        <table
            style="  width: 100%; padding:30px 0px 0 0; margin: 0 auto; background-image: url('<?php echo showimage($bg); ?>'); background-repeat: no-repeat; background-size: cover;">
            <tr>
                <th>
                    <table
                        style=" width: 550px; margin: 20px auto 0px; text-align: center;font-family: 'Montserrat', sans-serif; ">
                        <tr>
                            <th><span class="images" style=" display: inline-block; vertical-align: middle; float: left; ">
                                    <img src="<?php echo showimage($logo1); ?>" alt="" style="width: 75px;"></span></th>
                            <th><span class="hesder-content"
                                    style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; ">
                                    Republic of the Philippines<br>
                                    Professional Regulatory Board</span></th>
                            <th><span class="images"
                                    style=" display: inline-block; vertical-align: middle; float: right;">
                                    <img src="<?php echo showimage($logo2); ?>" alt="" style="width: 75px;"></span></th>
                        </tr>
                    </table>
                </th>

            </tr>
            <tr>
                <td>
                    <table style="width:100%; margin: 0 auto; text-align: center;">

                        <tr>
                            <td><img src="<?php echo showimage($certificate_text); ?>" alt="" style=" width: 350px;">
                            </td>

                        </tr>

                    </table>
                </td>

            </tr>
            <tr>
                <td>
                    <h2
                        style=" color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;">
                        of accreditation
                    </h2>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td>
                    <h1 style="font-size: 25px; font-weight: 700; margin: 0; ">
                        <?php echo ucwords($result->training_title);?>
                    </h1>
                    <span
                        style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>

                    <p
                        style="font-size: 17px;color: #0d0d0d;margin-top: 20px;font-weight: 500;font-family: 'Montserrat', sans-serif;max-width: 50%;margin: 10px auto;">
                        Is hereby granted accreditation as Continuing Education Training for Professionals.
                    </p>
                    <p style="font-size: 20px;margin: 10px 0;font-family: 'Montserrat', sans-serif;font-weight: 400;">
                        Granted this <br>
                        <?php echo date("F d, Y", strtotime($result->review_date));?>
                    </p>
                    <p style="margin-top: 5px;font-size: 17px;font-family: 'Montserrat', sans-serif;font-weight: 600;">
                        ACCREDITATION NO. :
                        <?php echo $result->accreditation_no;?> <br>
                        VALIDTY:
                        <?php echo date("F d, Y", strtotime($result->expiry_at));?>
                    </p>
                    <!-- <p
                        style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                        January 22,2021
                    </p> -->
                    <!-- <p
                        style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                        Manila, Philippines
                    </p> -->
                    <p
                        style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                    </p>
                </td>
            </tr>

            <tr>
                <td>
                    <table style="width: 540px; margin: 0 auto; margin-top: 10px; margin-bottom: 0px;">
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


                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 90%; margin: 0 auto; padding-top: 180px; padding-bottom:10px; ">
                        <tr>
                            <td style="text-align: left;width: 60%; padding-top:50px;">
                                <!-- <img src="images/footer-logo.png" alt="" style=" padding-top: 19px; "> -->
                                <!-- <p style=" padding-top: 55px;"></p> -->
                                <p
                                    style=" color: #fff; font-size: 18px; margin: 0px 0; font-family: 'Montserrat', sans-serif; ">
                                    validate this certificate at:</p>
                               <p> <a href="<?php echo base_url('license/search'); ?>"
                                    style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; "><?php echo base_url('license/search'); ?></a></p>
                            </td>
                            <td style="text-align: right; width: 40%;">
                                <img src="<?php echo showimage($barcode); ?>" alt="" style=" width: 50px">
                                <p
                                    style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                    Accreditation Number</p>
                                <p
                                    style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
                                    <?php echo $result->accreditation_no; ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <?php 
        function showimage($image){
        $imageData = base64_encode(file_get_contents($image));
        $src = 'data:image/jpeg;base64,'.$imageData;
        return $src;
        }
    ?>
    </div>