<?php echo $this->load->view('ce-provider/common/online_course_banner'); ?>
                
    <div class="container mb-5">
        <div class="row pro-steps">
                <div class="col-2">
                    <a href="javascript:void(0);" class="stepActive">
                        <span>
                            <strong>1</strong>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                        <label>CEP & Accreditaion Verification</label>
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
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>4</strong>
                        </span>
                        <label>Verification of Documents</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <label>Certificate of Accreditation</label>
                    </a>
                </div>
            </div>
    </div>

    <div class="bg-light py-4">
        
		<div class="col-md-8 mx-auto">
        <div class="my-5">
			
           
			<?php
				//print_r($coudtls); exit; 
				if($course_details->reviewer_status < 1){
					$dateexplode = explode(' ', $course_details->applied_date);
					$date = $dateexplode[0];
					$newdate = strtotime ( '30 day' , strtotime ( $date ) ) ;
					$ndate = date ( 'Y-m-j' , $newdate );
					 
					$date1 = new DateTime($ndate);
					$date2 = new DateTime(date('Y-m-d'));
					$interval = $date1->diff($date2);
					echo '<div class="verification-div-content"><div class="card">
                      <div class="card-header">Your document submitted will be reviewed <br> by our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="color:#f12302; font-size: 120px;">'.$interval->days.'</span><br> Remaining Days <br> (PROCESSING PERIOD COUNTDOWN)</div>
                      <div class="card-footer">You will receive an email if your application for <br> course was approve or disapprove.</div>
                    </div><p style="text-align:center;font-weight:bold;">YOUR VERIFICATION OF DOCUMENTS IS <span class="btn btn-info">PENDING</span></p></div>'; ?> 
                    <a href="javascript:void(0);" class="btn btn-primary" title="Print" onclick="printElem('cou-app-form');">Print Application Form</a>
				<?php 	 
					//echo '--'.$unvdetls->added_date;
					//echo $unvdetls->added_date;
					//echo 'Count Down';
				}
				if($course_details->reviewer_status == 1){
                    $url = base_url('ce-provider/ce_provider/digitalaccreditation/'.base64_encode($course_details->cor_doc_id));
					echo '<p style="text-align:center;font-weight:bold;">COURSE VERIFICATION OF DOCUMENTS IS <span class="btn btn-success">APPROVED</span><br><a href="'.$url.'" class="btn btn-danger">VIEW CERTIFICATE</a></p>';
				}
				if($course_details->reviewer_status == 2){
					echo '<p style="text-align:center;font-weight:bold;">COURSE VERIFICATION OF DOCUMENTS IS <span class="btn btn-danger">REJECTED</span></p>';
				}
			?>
			
        </div>
    </div>
    </div><br>

<div id="cou-app-form" style="display:none">
<style>
    table, td, th {  
      border: 1px solid #ddd;
      text-align: left;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 10px;
    }
<?php $profession = '';
    if($coudtls->courseprofession != ''){
        $professionarr = explode(',', $coudtls->courseprofession);
        foreach($professionarr as $value){
            $pro_name = $this->db->get_where('tbl_profession',array('id'=>$value))->row()->name;
            $profession .= $pro_name.', ';
        }
    }
?>
</style>
    <?php 
        $logo = ($webinfo->logo !="")?$webinfo->logo:'logo.png';
    ?>
    <div class="container"  style="width: 1100px; margin: 0 auto;">
        <div class="header" style="padding: 10px 0; border-bottom: 1px solid #ddd; text-align: left;">
            <img src="<?php echo base_url('assets/images/'.$logo); ?>" alt="" style="width: 200px;">
        </div>
        <div class="header" style="padding: 10px 0; border-bottom: 1px solid #ddd; text-align: center;">
            <p><?=$settings->rb_name?></p>
            <p><?=$webinfo->address?></p>
            <p><?=$webinfo->phone_number?></p>
        </div>
    </div>
    <h3 class="border-title text-left">Online Course Application Form</h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Business name:</th>
                <td><?=$coudtls->business_name?></td>
                <th>Company Logo</th>
                <td><img src="<?=base_url('assets/images/ce_provider/'.$coudtls->company_logo)?>" alt="logo" width="60px;" height="60px;"></td>
            </tr>
            <tr>
                <th>Refrence Number</th>
                <td colspan="3"><?=$coudtls->refrence_code?></td>
            </tr>
            <tr>
                <th>Course name</th>
                <td colspan="3"><?=$coudtls->course_title?></td>
            </tr>
            <tr>
                <th>Profession</th>
                <td colspan="3"><?=$profession?></td>
            </tr>
            <!--<tr>
                <th>Contact Person</th>
                <td colspan="3"><?=$unvdetls->contact_person?></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td colspan="3"><?=$unvdetls->designation?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td colspan="3"><?=$unvdetls->email?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td colspan="3"><?=$unvdetls->phone?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td colspan="3"><?=$unvdetls->countries_name?></td>
            </tr>-->
            <tr>
                <th>Upload Document 1</th>
                <td colspan="3"><?=($coudtls->course_image != '')?'Course Image':'--'; ?></td>
            </tr>
            <tr>
                <th>Upload Document 2</th>
                <td colspan="3"><?=($coudtls->course_pdf != '')?'Course Pdf':'--'; ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td colspan="3"><?=$coudtls->payment_status; ?></td>
            </tr>
            <tr>
                <th>Payment Date</th>
                <td colspan="3"><?=date('M d,Y',strtotime($coudtls->payment_date)); ?></td>
            </tr>
            <tr>
                <th>Amount</th>
                <td colspan="3">$<?=$coudtls->payment_gross; ?></td>
            </tr>
            <tr>
                <th>Transaction Id</th>
                <td colspan="3"><?=$coudtls->txn_id; ?></td>
            </tr>
            <tr>
                <th colspan="4" >Please attach your original document with this application form.</th>
            </tr>
        </tbody>
    </table>
</div>
    <script>

        function goToReviewDocuments(){
            // alert('comming soon!');
            // window.location.href="<?php echo base_url();?>professional/applicant/review_doc";
        }
    </script>
<script type="text/javascript">
    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>