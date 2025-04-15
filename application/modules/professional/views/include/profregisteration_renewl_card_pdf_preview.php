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
                $licensebarcode = base_url('assets/images/barcode.png');
                $image = base_url('assets/uploads/profile/'.$profes_details->image);
            ?>
                <table
                    style="width: 100%; margin: 0 auto; background-image: url('<?php //echo showimage($licensebg); ?>'); margin-top: 50px; background-repeat: no-repeat;">
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
                    <tbody>
                        <tr>
                            <td style=" width: 40%; padding: 10px 0 0 30px; ">
                            <img width="100px" height="100px" src="<?php echo showimage($image); ?>"
                                    alt="<?php echo ucwords($profes_details->name); ?>">
                                <p style="margin-top: 30px; font-weight: bold; text-align: center; font-size: 20px;">
                                    <?php echo $profes_details->license_no; ?><br>
                                    <?php echo date('M d,Y',strtotime($profes_details->issued_date)); ?>
                                </p>
                            </td>
                            <td style="padding-left: 50px; padding-top: 20px;">
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
                                                <?php echo $profes_details->license_no; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 4px 0;border: none;width: 35%; font-size: 20px;">
                                                Issued
                                                Date</td>
                                            <td style="padding: 0;border: none; font-size: 20px; font-weight: bold;">
                                                <?php echo date('M d,Y',strtotime($profes_details->issued_date)); ?>
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
                                   
                            </td>
                        </tr>
                        <tr>
                        <td></td>
                        <td style="padding-left:45px;">
                        <img src="<?php echo showimage($licensebarcode); ?>" alt=""
                                        style="width: 343px; margin-bottom: 20px;">
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