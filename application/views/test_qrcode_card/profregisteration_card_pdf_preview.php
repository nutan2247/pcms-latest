<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profregistration_card Portrait</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo|Tangerine:400,700&display=swap&subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
</head>

<body>
    <div class="row" id="view_license_content">
                
            <?php
                $licensebg = base_url('assets/images/bg-image.png'); 
                $licenselogo = base_url('assets/images/print-logo.png'); 
                $licenselogo2 = base_url('assets/images/red-bird.png'); 
                //$licensebarcode = base_url('assets/images/barcode.png');
                $licensebarcode = base_url('assets/testcard/1635825192.png');
                //$image = base_url('assets/uploads/profile/'.$profes_details->image);
                $image = base_url('assets/uploads/profile/dp_1635767198.jpg');
            ?>
                <table style="width: 100%; margin-top:40px;">
                     <thead style="background-color: #2f5597;">
                        <tr>

                            <th style="height:50px;"><img src="<?php echo showimage($licenselogo); ?>" alt=""
                                    style="width: 100px;">
                            </th>
                            <th style="text-align: center; color: #fff; padding: 12px; width: 100%; height:50px;">
                                <h2 style="width:100%;  text-align:center; ">CEONPOINT</h2>
                                <p
                                    style="width:100%;  text-align:center;text-transform: uppercase;letter-spacing: 0.2px;">
                                    "Home of Continuing Education for all Professionals "</p>
                            </th>
                        </tr>
                    </thead>
                </table>

                <table style="width: 100%;">
                    <tbody>
                    <tr>
                            <td style="text-align: center;">
                                    <h3 style="color: #2f5597; text-transform: uppercase; font-weight: bold; width:100%;">Professional Identification card</h3>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 100%; margin: 0 auto; background-image: url('<?php //echo showimage($licensebg); ?>'); background-repeat: no-repeat;">
                  
                    <tbody>
                       
                        <tr>
                       
                            <td>
                                <img width="150px" height="" src="<?php echo showimage($image); ?>"
                                    alt="<?php //echo ucwords($profes_details->fullname); ?>">
                       
                            </td>
                            <td style="">
                               
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <td style="padding: 8px 0;border: none; font-size: 17px;">Name
                                            </td>
                                            <td style="padding: 0;border: none; font-size: 17px; font-weight: bold;">
                                                <?php echo 'Set QR Code';//echo ucwords($profes_details->fullname);?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 8px 0;border: none; font-size: 17px;">License
                                                No.</td>
                                            <td style="padding: 0;border: none; font-size: 17px; font-weight: bold;">
                                                <?php echo 'LIC123456';//$profes_details->license_no; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0;border: none; font-size: 17px;">
                                                Issued
                                                Date</td>
                                            <td style="padding: 0;border: none; font-size: 17px; font-weight: bold;">
                                                <?php echo date('M d,Y',strtotime($profes_details->lic_issue_date)); ?>
                                            </td>
                                        </tr>
                                        <?php if($profes_details->validity_date != '0000-00-00'){
                                            $validity_date = date('M d,Y',strtotime($profes_details->validity_date));
                                             }else{
                                             $validity_date = '--';
                                             } ?>
                                        <tr>
                                            <td style="padding: 8px 0; border: none; font-size: 17px;">Valid
                                                Untill
                                            </td>
                                            <td style="padding: 0; border: none; font-size: 17px; font-weight: bold;">
                                                <?php echo $validity_date; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                   
                            </td>
                                    <td style="padding-left:0; text-align:right;">
                                    <img src="<?php echo showimage($licensebarcode); ?>" alt=""
                                                    style="width: 150px;">
                                    </td>
                            
                        </tr>
                      
                       

                    </tbody>
                </table>
        <?php 
            function showimage($image){
            $imageData = base64_encode(file_get_contents($image));
            $src = 'data:image/jpeg;base64,'.$imageData;
            return $src;
        }
        ?>
    </div>

</body>

</html>