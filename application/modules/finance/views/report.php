<?php //echo '<pre>'; print_r($todayincome); ?>
<style>
.greenclass {
    background-color: green;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    text-align: center;
    vertical-align: middle;
    display: inherit;
    color: #fff;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin: 12px auto;
}
.a-box-btn {
  	  padding-top: 30px;
}
.greenclass-main-box a {
    color: #000;
}
.filter {
    margin-right: 40px;
}

</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 "><span
                                class="d-inline-block border-bottom pb-2 px-3 filter-title">Admin Income Report</span>
                        </h4>
                        <p class="text-center"><?php echo date('F d, Y');?></p>
                        <div class="row mt-4 ">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($todayincome->totalincome > 0)?$todayincome->totalincome:0; ?></h4></p>
                                    <p>Today's Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($monthlyincome->totalincome >0)?$monthlyincome->totalincome:0; ?></h4></p>
                                    <p>Monthly Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($anualincome->totalincome > 0)?$anualincome->totalincome:0; ?></h4>
                                    <p>Annual Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$</h4>
									<p><h4><?php echo ($lifetimeincome->totalincome > 0)?$lifetimeincome->totalincome:0; ?></h4></p>
                                    <p>Lifetime Income</p>
                                </div>
                            </div>
							
                        </div>
						
                    </div>
					
                </div>
            </div>
			
			<!--<div class="main_contry">
				<div class="main_contry_heading text-center my-5">
					<h1 class="h2 mb-4"> <u>Detailed Income Report</u> </h1>
					<p class="h6"><?php echo date('F d, Y');?></p>
				</div>
				<div class="country_main" style="padding:50px; background-color:#ccd7e2;margin: 15px; border-radius: 10px;">
				<form action="" method="get"> 
				<div class="row">
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label>Country</label>
							<select name="country" id="country" class="form-control">
								<option value="">All</option>
								<?php
									 foreach($countries as $key => $list){
										$countsel = (isset($_GET['country']) && $_GET['country'] == $list['countries_id'])?'selected':'';
										echo '<option value="'.$list['countries_id'].'" '.$countsel.'>'.$list['countries_name'].'</option>'; 
									 }
								?>
							</select>
						</div>
					</div>
					
					
					
					
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Day</label>
							<select name="day" id="day" class="form-control">
								<option value="">--Select--</option>
								<?php
									for($d=1; $d <= 31; $d++){
										$daysel = (isset($_GET['day']) && $_GET['day'] == $d)?'selected':'';
										echo '<option value="'.$d.'" '.$daysel.'>'.$d.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Month</label>
							<select name="mouth" id="mouth" class="form-control">
								<option value="">--Select--</option>
								<option value="01" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '01')?'selected':'';?>>Jan</option>
								<option value="02" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '02')?'selected':'';?>>Feb</option>
								<option value="03" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '03')?'selected':'';?>>Mar</option>
								<option value="04" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '04')?'selected':'';?>>Apr</option>
								<option value="05" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '015')?'selected':'';?>>May</option>
								<option value="06" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '06')?'selected':'';?>>Jun</option>
								<option value="07" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '07')?'selected':'';?>>Jul</option>
								<option value="08" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '08')?'selected':'';?>>Aug</option>
								<option value="09" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '09')?'selected':'';?>>Sep</option>
								<option value="10" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '10')?'selected':'';?>>Oct</option>
								<option value="11" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '11')?'selected':'';?>>Nov</option>
								<option value="12" <?php echo (isset($_GET['mouth']) && $_GET['mouth'] == '12')?'selected':'';?>>Dec</option>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">                                    
						<div class="a-box">
							<label for="">Year</label>
							<select name="year" id="year" class="form-control">
								<?php
									for($y=2020; $y<=date('Y');$y++){
										$yearsel = (isset($_GET['year']) && $_GET['year'] == $y)?'selected':'';
										echo '<option value="'.$y.'" '.$yearsel.'>'.$y.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3 mb-3"> 
						<div  class="a-box-btn">
							
							<button type="submit" class="btn btn-primary filter">Filter</button>
							<button type="button" id="reset" class="btn btn-primary">Reset</button>
						</div>                                   
						
					</div>
					</div>
				</div>
				</form>
			</div>-->
			
			<?php
				$titlefor = $this->uri->segment(3);
				$reprottitle = '';
				if($titlefor == 'professional_registration'){
					$reprottitle = 'Professional Registration';
				}
				if($titlefor == 'professional_license_renewal'){
					$reprottitle = 'Professional License Renewal';
				}
				if($titlefor == 'school_accreditaion'){
					$reprottitle = 'School Accreditaion';
				}
				if($titlefor == 'submission_of_graduates'){
					$reprottitle = 'Submission of Graduates';
				}
				if($titlefor == 'booking_for_exam_graduates'){
					$reprottitle = 'Booking for Exam Graduates';
				}
				if($titlefor == 'foreign_professional_registration'){
					$reprottitle = 'Foreign Professional Registration';
				}
				if($titlefor == 'foreign_professional_examination'){
					$reprottitle = 'Foreign Professional Examination';
				}
				if($titlefor == 'booking_for_exam_foreign_professionals'){
					$reprottitle = 'Booking for Exam Foreign Professionals';
				}
				if($titlefor == 'cep_accreditation'){
					$reprottitle = 'Cep Accreditation';
				}
				if($titlefor == 'online_course_accreditation'){
					$reprottitle = 'Online Course Accreditation';
				}
				if($titlefor == 'training_course_accreditation'){
					$reprottitle = 'Training Course Accreditation';
				}
				if($titlefor == 'verification_of_registration'){
					$reprottitle = 'Request for Verification of Registration';
				}
				if($titlefor == 'certificate_of_good_standing'){
					$reprottitle = 'Request for Certificate of Good Standing';
				}
			?>
		<div class="card mb-4">
			<div class="card-body">
				
					
					<h3><?=$reprottitle?></h3>
				
				<div class="table-responsive">
					
                    <table class="table table-bordered adminDT"  width="100%" cellspacing="0">
                             
							<thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Processing Fee</th>
                                <th>Tax</th>
                                <th>Amount($)</th>
                                <th>Transtion Id</th>
                                <th>Payment For</th>
                                <th>Date Paid</th>
                                <th>Reciept Number</th>
                                <th>Action</th>
                            </tr>
                        	</thead>
						<tbody>
						<?php //echo '<pre>';print_r($incomereport);exit;
							if($incomereport){
								
                                $count = 1; 
								$totalprocessingfee = 0;
								$totaltax = 0;
								$totalgross = 0;
								$sectionname = "";
                                foreach($incomereport as $inclist){
									$totalprocessingfee += $inclist->payment_amout;
									$totaltax += $inclist->payment_tax;
									$totalgross += $inclist->payment_gross;
									
									$date = explode('-',$inclist->payment_date);
								if($inclist->payment_for == 'P'){
									$type ='Foreign Professional Review of Documents for Professional Registration';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'P'); 
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
									$payment_type = $type;
								}
								if($inclist->payment_for == 'PP'){
									$type ='Foreign Foreign Professional Review of Documents for Licensure Examination';
									$payment_type = $type;
								}
								if($inclist->payment_for == 'U'){
									$type =($inclist->payment_type == 'N')?'School Accreditation Fee':'Renewal of School Accreditation Fee';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'U');
									$payment_type = $type;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'C'){
									$type ='Online Course ';
									$sectionarr = $this->common_model->getsectionname($inclist->doc_refrence_id,'CEPC');
									$payment_type = $type;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'PP'){
									$type ='Foreign Professional';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'PP');
									//print_r($sectionarr);exit;
									$payment_type = $type;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'G'){
									if($inclist->payment_type == 'S'){
										$type =	'Submission of Graduates for Licensure Examination';
										$sectionarr = $this->common_model->getsectionname($inclist->user_id,'U'); //university name will goes to front end because univerty pay for submission of graduates.
									}
									if($inclist->payment_type == 'E'){
										$type =	'Booking for Online Licensure Examination';
										$sectionarr = $this->common_model->getsectionname($inclist->user_id,'G');
									}
									// $type =($inclist->payment_type == 'S')?'Submission of Graduates for Licensure Examination':'Booking for Online Licensure Examination';
									$payment_type = $type;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'T'){
									$type ='Training Course ';
									$sectionarr = $this->common_model->getsectionname($inclist->doc_refrence_id,'CEPT');
									$payment_type = $type;
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'PR'){
									$type =($inclist->payment_type == 'N')?'Professional Registration':'Professional License Renewal';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'PR');
									// $payment_type = $type; 
									$payment_type =($inclist->payment_type == 'N')?'Professional Registration':'Professional License Renewal Fee';
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'CEP'){
									$type =($inclist->payment_type == 'N')?'CEP Accreditation':'Renewal of CEP Accreditation';
									$payment_type = $type;
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'CEP');
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
								}
								if($inclist->payment_for == 'VR'){
									$type ='Request for Verification of Registration';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'VR'); 
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
									$payment_type = $type.' Fee';
								}
								if($inclist->payment_for == 'GS'){
									$type ='Request for Certificate of Good Standing';
									$sectionarr = $this->common_model->getsectionname($inclist->user_id,'GS'); 
									$sectionname = (isset($sectionarr->section_name))?$sectionarr->section_name:'';
									$payment_type = $type.' Fee';
								}	
                            ?>
							
                            <tr>
                                <td><?=$count;?></td>
                                <td><?=$type;?></td>
                                <td><?=$sectionname;?></td>
                                <td><?=$inclist->payment_amout;?></td>
                                <td><?=$inclist->payment_tax;?></td>
                                <td><?=$inclist->payment_gross;?></td>
                                <td><?=$inclist->txn_id;?></td>
                                <td><?=$payment_type;?> </td>
                                <td><?=date("M d, Y",strtotime($inclist->payment_date));?></td>
                                <td>#<?=$inclist->payment_id.'-'.$date[0];?></td>
                                <td><a href="javascript:void(0);" onclick="viewreceipt('<?php echo $inclist->payment_id; ?>')">View</a></td>
                            </tr> 
							
                            <?php $count++; } ?> 
							<!--<tr>
								<td colspan="3" class="text-right"><b>Total</b></td>
								<td><b><?='Processing Fee: '.number_format($totalprocessingfee,2)?></b></td>
								<td><b><?= 'Tax(12%): '.number_format($totaltax,2) ?></b></td>
								<td colspan="6" class="text-center"><b><?='Amount: '.number_format($totalgross,2)?></b></td>
							</tr>-->
						
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" class="text-right"><b>Total</b></td>
								<td><b><?='Processing Fee: '.number_format($totalprocessingfee,2)?></b></td>
								<td><b><?= 'Tax(12%): '.number_format($totaltax,2) ?></b></td>
								<td colspan="6" class="text-center"><b><?='Amount: '.number_format($totalgross,2)?></b></td>
							</tr>
						</tfoot>
						<?php } ?>
                    </table>
                </div> <!--close table div-->
			</div><!-- close card -->
			</div>
		</div><?php //container fluid?>
        
    </main>

    

	<script>
	onload();
	function onload(){
		var user_role = $("select#user_role option").filter(":selected").val();
		var modules = "<?php echo (isset($_GET['modules']))?$_GET['modules']:'';?>";
		//alert(user_role);
		if(user_role !=""){
			$.ajax({
			url:'<?php echo base_url("admin/subrole");?>', 
			type:'post',
			//dataType: 'json',
		   // data:{chargeid},
			data:{'user_role':user_role,'modules':modules},
			beforeSend:function(){
				//$(".loding-main").show();

			},
			success:function(data){
				//alert(JSON.parse(data));
				//alert(JSON.stringify(data));
				//$(".loding-main").hide();
				//var html = '';
				//$('#dispprice').html(data['charge']);
				$('#modules').html(data);
				
			}
		});	
		}
	}	
	$( "#user_role" ).change(function() {
		var user_role = $(this).val();
	  $.ajax({
        url:'<?php echo base_url("admin/subrole");?>', 
        type:'post',
		//dataType: 'json',
       // data:{chargeid},
		data:{'user_role':user_role},
        beforeSend:function(){
            //$(".loding-main").show();

        },
        success:function(data){
			//alert(JSON.parse(data));
			//alert(JSON.stringify(data));
			//$(".loding-main").hide();
			//var html = '';
			//$('#dispprice').html(data['charge']);
			$('#modules').html(data);
			
        }

    });
	  
	});
	$( "#income_sources" ).change(function() {
		var user_role = $("#income_sources option:selected").html();
		$('.filter-title').html(user_role);
	});
	
	$('#reset').click(function(){
		location.href = '<?php echo base_url("finance/incomereport");?>';
	});
    
	$(document).ready( function () {
	//$('#dataTable').DataTable({'iDisplayLength': 100});
	$('.adminDT').DataTable();

	} );
	</script>