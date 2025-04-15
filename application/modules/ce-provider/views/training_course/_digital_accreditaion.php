
<style type="text/css">
  
  .radio-class{
    width: 18px;
    height: 18px;
  }

#my-div {
    width: 1100px;
    height: 500px;
    overflow: hidden;
    position: relative;
}

#my-iframe {
    position: absolute;
    top: -300px;
    left: -1px;
    width: 1000px;
    height: 1000px;
}
</style>


    <?php echo $this->load->view('ce-provider/common/training_course_banner'); ?>

  <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP Information</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>2</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Online Course File</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>3</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Payment</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>4</strong>
							<i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Review of Online Course</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>5</strong>
							<i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>Digital Accreditaion</label>
                    </a>
                </div>
        </div>
    </div>


    <div class="gotolink">
				<a href="javascript:void(0);" id="printbtn">Download</a>
			</div>
			<table style="  width: 820px;    margin: 0 auto; background-image: url(<?php echo base_url('assets/images/banner.png');?>); background-repeat: no-repeat; background-size: cover; padding-top: 90px;">
        <tr>
            <th>
                <table style=" width: 590px;    margin: 90px auto 0; text-align: center;font-family: 'Montserrat', sans-serif; ">
                    <tr>
                        <th><span class="images" style=" display: inline-block; vertical-align: middle; float: left; "><img
                                    src="<?php echo base_url('assets/images/bird.png');?>" alt="" style="width: 75px;"></span></th>
                        <th><span class="hesder-content" style=" display: inline-block; color: #0d0d0d; font-weight: 600;  font-size: 19px; ">Republic of the Philippines<br>
                            Professional Regulatory Board</span></th>
                        <th><span class="images" style=" display: inline-block; vertical-align: middle; float: right;"><img
                                    src="<?php echo base_url('assets/images/red-bird.png');?>" alt="" style="width: 75px;"></span></th>
                    </tr>
                </table>
            </th>

        </tr>
        <tr>
            <td>
                <table style="width: 461px;margin: 0 auto;margin-top: 20px;">

                    <tr>
                        <td><img src="<?php echo base_url('assets/images/certificate-head.png');?>" alt="" style=" width: 100%; "></td>

                    </tr>

                </table>
            </td>

        </tr>
        <tr>
            <td>
                <h1 style="margin: 22px 0; color: #dd8827; text-transform: uppercase; font-family: 'Montserrat', sans-serif; font-weight: 600; text-align: center;">
                    of accreditation
                </h1>
            </td>
        </tr>
        <tr style="text-align: center;">
            <td>
                <h1 style="font-size: 30px; font-weight: 700; margin: 0; "><?php echo $training_details->training_title; ?>
                </h1>
                <span style="border-top: 1px dotted #d2d2d2;width: 70%;height: 1px;display: block;margin: 0 auto;margin-top: 18px;"></span>

                <p style="font-size: 17px;color: #0d0d0d;margin-top: 20px;font-weight: 500;font-family: 'Montserrat', sans-serif;max-width: 50%;margin: 18px auto;">
                    Is hereby granted accreditation as continuing Education Provider (CEP) And can create, Submit & Publish CE Courses to be used Professionals.
                </p>
                <p style="font-size: 20px;margin: 29px 0;font-family: 'Montserrat', sans-serif;font-weight: 400;">
                    Granted this <br> <?php echo date('F j, Y',strtotime($training_details->review_date));?>
                </p>
                <p style="margin-top: 5px;font-size: 21px;font-family: 'Montserrat', sans-serif;font-weight: 600;">
                    ACCREDITATION NO. : <?php echo $training_details->refrence_code;?> <br> VALIDITY : <?php echo date('F j, Y',strtotime($training_details->expiry_at));?> </p>
                <p style=" color: #2e85c1;  font-size: 16px;  margin-top: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600;">
                    <!-- January 22,2021-->
                </p>
                <p style=" color: #2e85c1; font-size: 16px;font-family: 'Montserrat', sans-serif; font-weight: 600; margin-top: -12px;">
                    <!-- Manila, Philippines -->
                </p>
                <p style=" margin-top: 25px; font-size: 21px; font-weight: 600; font-family: 'Montserrat', sans-serif;">
                </p>
               
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 540px; margin: 0 auto; margin-top: 25px; margin-bottom: 90px;">
                    <tr>
                        <td style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo base_url('assets/images/sinature.png');?>" alt="" style=" width: 57px;">
                            <p style="margin: 0; margin-top: 5px; color: #7c7c7c; font-size: 13px;">Angelina Jordan</p>
                            <p style=" margin: 0; margin-top: 5px;color: #7c7c7c;font-size: 13px;">President</p>

                        </td>
                        <td style="background-color: #ededec;padding: 12px 12px;margin-right: 10px;width: 103px;text-align: center; border-right: 10px solid #fff;">
                            <img src="<?php echo base_url('assets/images/sinature.png');?>" alt="" style=" width: 57px;">
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
                            <p style=" padding-top: 55px;"></p>
                            <p style=" color: #fff; font-size: 18px; margin: 9px 0; font-family: 'Montserrat', sans-serif; ">
                                validate this certificate at:</p>
                            <a href="#" style="color: #f2cd1e; font-size: 17px; font-family: 'Montserrat', sans-serif; "><?php echo base_url();?></a>
                        </td>
                        <td style="text-align: right; width: 40%; padding-bottom: 25px;">
                            <img src="<?php echo base_url('assets/images/scan.png');?>" alt="" style=" width: 70px">
                            <p style="color: #fff; font-size: 17px; margin: 15px 0; font-family: 'Montserrat', sans-serif;">
                                Accreditation Number</p>
                            <p style="color: #f2cd1f;font-size: 19px; font-weight: 600; font-family: 'Montserrat', sans-serif; text-transform: uppercase; letter-spacing: 1.1px; margin: 0;">
                                <?php echo $training_details->refrence_code;?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
			<?php
				//print_r($training_details); 
				//// start course certificate section
					//echo '<p>Course Name :'.$training_details->course_title.'</p>';
				//	echo '<p>Unit: '.$training_details->course_units.'</p>';
					//echo '<p>Acceditation no.'.$training_details->course_acceditation_number.'</p>';
				//	echo '<p>Validity:'.$training_details->expiry_at.'</p>';
				//// end start course certificate section
			?>			
      <style>
 .gotolink {
	 text-align:right;
}
 .gotolink a {
    padding: 10px 14px;
    background-color: #2f5597;
    color: #fff;
    display: inline-block;
    border-radius: 3px;
}
@media print {
  #banner-grid {
    display: none !important;
  }
  .gotolink {
    display: none !important;
  }
  .pro-steps {
    display: none !important;
  }
  .top-header {
    display: none !important;
  }
  .header {
    display: none !important;
  }
  .footer-logostrip {
    display: none !important;
  }
  footer {
    display: none !important;
  }
}
</style>
    <script>
        function goToReviewDocuments(){
            // alert('comming soon!');
            // window.location.href="<?php echo base_url();?>professional/applicant/review_doc";
        }
		
    </script>
	<script>
$("#printbtn").click(function () {
   // $("#printarea").show();
    window.print();
	/* var pdf = new jsPDF('p', 'pt', 'letter');
	pdf.canvas.height = 72 * 11;
	pdf.canvas.width = 72 * 8.5;
	pdf.fromHTML(document.body);
	pdf.save('test.pdf'); */
});
</script>