
<?php //print_r($ceppaydetls);exit;?>
    <div class="col-md-8 mx-auto">
        <div class="my-5">
            
            <?php if(!empty($unvdetls)) {
            if($unvdetls->reviewer_status < 1){
                   $newdate = strtotime ( '30 day' , strtotime ( $unvdetls->cep_update_date ) ) ;
                   $ndate = date ( 'Y-m-j' , $newdate );
  
                    $date1 = new DateTime($ndate);
                    $date2 = new DateTime(date('Y-m-d'));
                    $interval = $date1->diff($date2);
                    echo '<div class="verification-div-content"><div class="card">
                      <div class="card-header headersection">Your submitted documents will be reviewed <br> by our agents within 30 days.</div>
                      <div class="card-body text-center"><span style="font-size: 120px;color:#f12302;">'.$interval->days.'</span><br> Remaining Days <br> (PROCESSING PERIOD COUNTDOWN) </div>
                      <div class="card-footer headersection">You will receive an email if your application for <br> CEP Accreditation was approve or disapprove.</div>
                    </div>
                    <p>Please check your email for the receipt and application number so that you can check the status of your application.</p>
                    <span class="statusbtn">ON REVIEW</span></div>'; ?>

                      <div class="text-center">
                          <a href="javascript:void(0);" class="btn btn-primary" title="Print" onclick="printElem('cep-app-form');">Print Application Form</a>
                      </div>
                <?php }
                if($unvdetls->reviewer_status == 1){ ?>
                    <p class="text-center"><span class="btn btn-primary">APPROVED</span></p>
                    <h4 class="text-center">APPLICATION STATUS</h4>
                    <p class="text-center"><a href="<?=base_url('ce-provider/ce_provider/digital_accr/'.base64_encode($unvdetls->id))?>" class="statusbtn">VIEW CERTIFICATE OF ACCREDITATION</a></p>
               <?php  }
                if($unvdetls->reviewer_status == 2){
                    echo '<span class="rejectedbtn">REJECTED</span>';
                }
            }else{ echo '<span class="statusbtn">Please Wait...</span>';} ?>
            
        </div>
    </div>
<?php //print_r($ceppaydetls); ?>
<div id="cep-app-form" style="display:none;">
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
    <h3 class="border-title text-left">Continuing Professional Development (CPD) Provider Accreditation</h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Business name:</th>
                <td><?=$unvdetls->business_name?></td>
                <th>Company Logo</th>
                <td><img src="<?=base_url('assets/images/ce_provider/'.$unvdetls->company_logo)?>" alt="logo" width="60px;" height="60px;"></td>
            </tr>
            <tr>
                <th>Refrence Number</th>
                <td colspan="3"><?=$unvdetls->reference_no?></td>
            </tr>
            <tr>
                <th>Business Number</th>
                <td colspan="3"><?=$unvdetls->business_no?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3"><?=$unvdetls->address?></td>
            </tr>
            <tr>
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
            </tr>
            <tr>
                <th>Upload Document 1</th>
                <td colspan="3"><?=($unvdetls->license_image != '')?'Business License':'--'; ?></td>
            </tr>
            <tr>
                <th>Upload Document 2</th>
                <td colspan="3"><?=($unvdetls->accreditation_image != '')?'Accreditation Document':'--'; ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td colspan="3"><?=$ceppaydetls->payment_status; ?></td>
            </tr>
            <tr>
                <th>Date Paid</th>
                <td colspan="3"><?=date('M d, Y',strtotime($ceppaydetls->payment_date)); ?></td>
            </tr>
            <tr>
                <th>Amount</th>
                <td colspan="3"><?='$'.$ceppaydetls->payment_gross; ?></td>
            </tr>
            <tr>
                <th colspan="4" >Please attach your original document with this application form.</th>
            </tr>
        </tbody>
    </table>
</div>

<style type="text/css">
    .error{ color:#ce2b2b; }
    .statusbtn{color: #fff;
    background-color: #ed7d31;
    padding: 8px;
    display: block;
    text-align: center;
    width: 22%;
    margin: 9px auto;
    border-radius: 5px;
    font-size: 24px;
    font-weight: 500;}
    .rejectedbtn{color: #fff;
    background-color: #f12302;
    padding: 8px;
    display: block;
    text-align: center;
    width: 22%;
    margin: 9px auto;
    border-radius: 5px;
    font-size: 24px;
    font-weight: 500;
    }
    .headersection {text-align: center;background-color: #00b0f0;font-size: 18px;font-weight: 500;}
</style>
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