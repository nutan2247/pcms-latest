		<div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid">

                    <div class="clearfix">
                        <h4 class="float-left mb-4 mt-4"><?php echo $page_title; ?></h4>
                        <!--<a class="btn btn-primary float-right mb-4 mt-4" href="<?php echo site_url('admin/addprocessfee'); ?>"> Add Processing Fee</a>-->
                    </div>

                        <div class="card mb-4">

                            <div class="card-body">

                                <?php echo $this->session->flashdata('item');?>

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Section Name</th>
                                                <th>Duration</th>
                                                <th>Year</th>
                                                <th>Fee</th>
                                                <th>Tax</th>
                                                <th>Tax Amount</th>
                                                <th>Total</th>
                                                <th>Display</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($listing && $tax){
                                            $count = 1; 
                                            foreach($listing as $key => $list){  
												$taxamt = $list['charge']*$tax/100;
												$total_amt = $list['charge']+$taxamt;
											?>
                                            <tr>
                                                <td><?=$count;?></th>
                                                <td><?=ucwords(str_replace('_',' ',$list['charges_for']));?></td>
                                                <td><?=$list['duration'];?></td>
                                                <td><?=$list['duration_title'];?></td>
                                                <td><?=$list['charge'];?></td>
                                                <td><?=$tax;?> %</td>      
                                                <td><?=$taxamt;?></td>
                                                <td><?= number_format($total_amt,2);?></td>
                                                <td><?=$list['display_position'];?></td>
                                                <td>
                                                    <a href="<?php echo site_url('admin/addprocessfee/').$list['pri_id'];?>" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <!--<a href="<?php echo site_url('admin/delete/addprocessfee').$list['pri_id'];?>" title="Delete" onclick="return confirm('Are you sure you want to delete this?')"> <i class="fas fa-trash"></i> </a>--></td>
                                            </tr>

                                            <?php $count++; } }else{ echo'<tr>No Data Found!</tr>'; }?>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
                </main>