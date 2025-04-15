<?php //echo '<pre>'; print_r($todayincome); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-4">
            <div class="dashboard-counter">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-center my-2 "><span
                                class="d-inline-block border-bottom pb-2 px-3">FOREIGN PROFESSIONALS FOR REGISTRATION</span>
                        </h4>
                        <!--<p class="text-center">JANUARY 1, 2021 - December 31, 2021</p>
                        <p class="text-center">January 21, 2021</p>-->
                        <div class="row mt-4 border-bottom">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$<?php echo ($todayincome->totalincome >0)?$todayincome->totalincome:0; ?></h4>
                                    <p>Today's Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$<?php echo ($monthlyincome->totalincome >0)?$monthlyincome->totalincome:0; ?></h4>
                                    <p>Monthly Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$<?php echo $anualincome->totalincome; ?></h4>
                                    <p>Annual Income</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4>$<?php echo $lifetimeincome->totalincome; ?></h4>
                                    <p>Lifetime Income</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-9 mx-auto">
                                <div class="row mt-4">
                                    <div class="col-md-4 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-primary px-5">12,345</button>
                                            <p class="mt-2">TOTAL PROFESSIONALS</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-warning px-5">10,923</button>
                                            <p class="mt-2">VALID LICENSE</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="a-box">
                                            <button type="button" class="btn btn-danger px-5">2,452</button>
                                            <p class="mt-2">EXPIRED LICENSE</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
						
                    </div>
					
                </div>
            </div>
			<div class="card-body">
					<div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
								<th>Processing Fee</th>
                                <th>Tax</th>
                                <th>Amount($)</th>
                                <th>Transtion Id</th>
                                <th>Payment For</th>
                                <th>Payment At</th>
								<th>Reciept Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <!--   <tfoot>

                            </tfoot> -->
                        <tbody>
                            <?php if($incomereport){
                                $count = 1; 
								$totalprocessingfee = 0;
								$totaltax = 0;
								$totalgross = 0;
                                foreach($incomereport as $inclist){
									$totalprocessingfee += $inclist->payment_amout;
									$totaltax += $inclist->payment_tax;
									$totalgross += $inclist->payment_gross;
								//$payment_type =($inclist->payment_type == 'R')?'Renew':'New';
								if($inclist->payment_for == 'P' && $inclist->payment_type == 'N'){
									//$payment_type = 'Professional Registration Fee';
                                    
								}
								else{
									//$payment_type = 'Renewal of Professional Registration Fee';
								}
                                $payment_type = 'Foreign professional for Registration';
								$date = explode('-',$inclist->payment_date);
                            ?>
                            <tr>
                                <td><?=$count;?></td>
                                <td><?=$inclist->fname.' '.$inclist->lname.' '.$inclist->name;?></td>
								<td><?=$inclist->payment_amout;?></td>
                                <td><?=$inclist->payment_tax;?></td>
                                <td><?=$inclist->payment_gross;?></td>
                                <td><?=$inclist->txn_id;?></td>
                                <td><?=$payment_type;?> </td>
                                <td><?=$inclist->payment_date;?></td>
								<td>#<?=$inclist->payment_id.'-'.$date[0];?></td>
                                <td><a href="javascript:void(0);" onclick="viewreceipt('<?php echo $inclist->payment_id; ?>')">View</a></td>
                            </tr> 
                            <?php $count++; } 
							echo '<tr>
								<td colspan="3" align="right"><b>Total</b></td>
								<td><b>Processing Fee: '.$totalprocessingfee.'</b></td>
								<td><b>Tax(12%): '.$totaltax.'</b></td>
								<td colspan="4" align="left"><b>Amount: '.$totalgross.'</b></td>
							</tr>';
							}else{ echo'<tr>No Data Found!</tr>'; }?>
                        </tbody>
                    </table>
                </div>
				</div>
        </div>
    </main>