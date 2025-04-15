<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>emailer_receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>

<body>
    <div class="container"  style="width: 1100px; margin: 0 auto;">
        <div class="header" style="padding: 10px 0; border-bottom: 1px solid #ddd; text-align: center;">
            <img src="https://ceonpointllc.com/rboard/assets/images/logo.png" alt="" style="width: 200px;">
        </div>
    </div>

    <div class="container" style="width: 1100px; margin: 0 auto;">
        <h3 style="padding: 22px 0 12px 0;">Dear <?php echo ucfirst($name); ?>,</h3>
            <?php echo $body_msg; ?>    
        <p  style="clear: both;">Thank you for using RBord! We would be glad if you can refer a friend to our website if you are
            Satisfied with our service. If not , please contact us at <a href="#">rbord@ceonpoint.com</a> and tell us
            how we can
            improve.

        </p>
        <p style="font-size: 14px;">Sincerely,<br><br><?php echo ucfirst($thanksname); ?><?php echo ($thanks2 !="")?','.ucfirst($thanks2):'';?><br><?php echo ucfirst($thanks3); ?></p>
    </div>
</body>

</html>