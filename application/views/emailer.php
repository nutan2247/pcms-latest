<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Emailer</title>
</head>

<body style="background: #1e52bd;">

    <table width="95%" style="font-family: Arial, Helvetica, sans-serif; padding:0 20px; background:#fff;margin: 0 auto; margin-top: 65px; border-radius: 10px;">
        <tr>
            <td>
                <table style="width: 100%;padding: 5px 10px; border-bottom: 1px solid #ececec;background: #00a2e8;margin-top: 20px;border-radius: 5px;">
                    <tr>
                        <td>
                            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="RBoard" style="width: 115px;">
                        </td>
                        <td>
                            <span style="font-weight: 400; font-size:12px; float: right; color: #fff;"></span>
                        </td>

                    </tr>
                </table>

                <table style="width: 100%; padding: 40px 0 20px 0;">
                    <tr>
                        <td>
                            <p style="font-size: 14px;"><strong style="margin-right: 5px;"> Dear <?php echo ucfirst($name); ?>,</strong></p>
							<?php echo $body_msg; ?>
							<p style="font-size: 14px;">Sincerely,<br><br><?php echo ucfirst($thanksname); ?><?php echo ($thanks2 !="")?','.ucfirst($thanks2):'';?><br><?php echo ucfirst($thanks3); ?></p>
                        </td>
                    </tr>
                </table>


                <table style="width: 100%; padding: 20px 0; text-align: center;    border-bottom: 1px solid #ececec;">
                    <tr>
                        <td>
                            <a href="#" style="margin-right: 10px;"><img src="https://mailbakery-store.wp-staging.net/free-templates/mailbakery-omicron-free-html-email-template/regular/images/ico4_facebook.png" alt=""></a>
                            <a href="#" style="margin-right: 10px;"><img src="https://mailbakery-store.wp-staging.net/free-templates/mailbakery-omicron-free-html-email-template/regular/images/ico4_twitter.png" alt=""></a>
                            
                            <a href="#" style="margin-right: 10px;"><img src="https://mailbakery-store.wp-staging.net/free-templates/mailbakery-omicron-free-html-email-template/regular/images/ico4_youtube.png" alt=""></a>
                            
                           
                            <a href="#" style="margin-right: 10px;"><img src="https://mailbakery-store.wp-staging.net/free-templates/mailbakery-omicron-free-html-email-template/regular/images/ico4_linkedin.png" alt=""></a>
                            
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; padding:10px 0;">
                        <tr>
                            <td>
                              <p style="font-size:12px; font-weight:400; color:#000; text-align: center;">&copy;<?php echo date('Y');?> RBoard.</p>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>

</body>

</html>