<?php //echo "<pre>"; print_r($cep_details); exit; ?>
    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto">
            <div class="text-center">
                <h4 class="mb-4 text-uppercase text-center">Digital License</h4>
                <h5 class="text-right"> Refrence Code: <b><?php echo $cep_details->reference_no; ?></b> </h5>
                
                <button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>
                <button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>
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
    <table style="  width: 650px; padding:60px 15px 0 15px; display:block;margin: 0 auto; background-image: url('<?php echo $bg; ?>'); background-repeat: no-repeat; background-size: cover;">
        <tr>
            <th>
                <table style=" width: 590px;margin: 0 auto; text-align: center;font-family: 'Montserrat', sans-serif; ">
                    <tr>
                        <th><span class="images"
                                style=" display: inline-block; vertical-align: middle; float: left; "><img
                                    src="'<?php echo $logo1; ?>'" alt="" style="width: 75px;"></span></th>
                        <th><span class="hesder-content"
                                style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; ">Continuing
                                Education on point<br>
                                Delaware, United State of America</span></th>
                        <th><span class="images"
                                style=" display: inline-block; vertical-align: middle; float: right;"><img
                                    src="'<?php echo $logo2; ?>'" alt="" style="width: 75px;"></span></th>
                    </tr>
                </table>
            </th>

        </tr>
        <tr>
            <td>
                <table style="width: 461px;margin: 0 auto;margin-top: 6px;">

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
                    of recognition
                </h1>
            </td>
        </tr>
        <tr style="text-align: center;">
            <td>
                <p
                    style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                    is hereby granted to
                </p>
                <h1 style="font-family: 'Tangerine', cursive; font-size: 48px;font-weight: 700; margin: 0; "><?php echo ucwords($cep_details->business_name);?></h1>
                <span
                    style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>
                <p
                    style=" font-size: 15px;color: #0d0d0d; margin-top: 20px; font-weight: 500; font-family: 'Montserrat', sans-serif;">
                    He is now eligible for Professional Registration
                </p>

                <p
                    style="font-size: 19px;color: #2e85c1; margin-top: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                    with registration no. : 
                    <strong><?php echo $cep_details->reference_no; ?></strong>
                </p>
                <p style=" margin-top: 5px; font-size: 17px; font-family: 'Montserrat', sans-serif;">Issued This</p>
                <p
                    style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                    <?php echo date('F d,Y',strtotime($cep_details->cep_update_date))?></p>
                <p
                    style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                    Manila, Philippines</p>
                <p style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                    </p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 540px; margin: 0 auto; margin-top: 25px; margin-bottom: 90px;">
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
                        <td
                            style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo $sinature3; ?>" alt="" style=" width: 57px;">
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
                            <!-- <img src="images/footer-logo.png" alt="" style=" padding-top: 19px; "> -->
                            <p style=" padding-top: 55px;" ></p>
                            <p
                                style=" color: #fff; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#"
                                style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; ">https://ceonpoint.com/index.php/pages/cfvalidation</a>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <img src="<?php echo $barcode; ?>" alt="" style=" width: 70px">
                            <p
                                style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Certificate Number</p>
                            <p
                                style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
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
          <input type="email" id="emailAdderss" name="email" class="form-control" value="<?php echo $cep_details->email; ?>">
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="emailData()" >Send</button>
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
        <button onclick="printData()" type="button" class="btn btn-info ml-1" title="Print"><i class="fa fa-print"></i></button>
        <button onclick="emailpopup()" type="button" class="btn btn-info ml-1" title="Email"><i class="fa fa-envelope"></i></button>
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
    function printData(){
        var printContents = document.getElementById('view_certificate_content').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
  
    function emailpopup(){
        $('#emailpopup').modal('show');
        $('#viewModalCenter').modal('hide');
    }

    function emailData(){
        var email = $('#emailAdderss').val();
        var name = '<?php echo $cep_details->name; ?>';
        var content = document.getElementById('view_certificate_content').innerHTML;
        var to = email;
        var subject = "Professional's Certificate";
         $.ajax({
            type: "POST",
            url: '<?php echo base_url("professional/applicant/send_certificate_mail"); ?>',
            data: { 
                to:to,
                name:name,
                subject:subject,
                content:content
            },
            success: function(result) {
                alert(result);
            }
        });
    }
    
    </script>