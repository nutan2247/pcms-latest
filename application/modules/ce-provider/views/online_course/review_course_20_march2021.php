<?php //print_r($details); ?>
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

            <div class="my-5">
                <h4 class="mb-4 mt-4 text-uppercase text-center">Company/business information verification </h4>
               
            </div>

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
                    <a href="javascript:void(0);" class="stepProcess">
                        <span>
                            <strong>2</strong>
                        </span>
                        <label>Online Course File</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>3</strong>
                        </span>
                        <label>Payment</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>4</strong>
                        </span>
                        <label>Review of Online Course</label>
                    </a>
                </div>
                <div class="col-2">
                    <a href="javascript:void(0);">
                        <span>
                            <strong>5</strong>
                        </span>
                        <label>Digital Accreditaion</label>
                    </a>
                </div>
        </div>
    </div>


    <div class=" rounded mb-5">
        <div class="col-md-6 mx-auto text-left">
            <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4>  
        </div>
    </div>
                  

           <?php //print_r($details); ?> 
		<?php if(count($details) > 0){ ?>
        <div class="col-md-8 mx-auto">
            <p>Please select any one course.</p>
            <?php echo form_open_multipart('ce-provider/CE_provider/course_payment',array("id"=>"course_payment")); ?>
            <div class="table-responsive">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>S.no.</th>
                            <th>Course Title</th>
                            <th>Units</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Validity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;
                        foreach($details as $key => $value){ ?>
                    <?php if($value->status > 0){ $status = 'Enable'; }else{ $status = 'Disable'; } ?>

                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $value->course_title; ?></td>
                            <td><?php echo $value->units; ?></td>
                            <td><?php echo $value->price; ?></td>
                            <td><?php echo $value->tax; ?></td>
                            <td><?php echo $value->total; ?></td>
                            <td><?php echo date('F d,Y',strtotime($value->course_validity)); ?></td>
                            <td><?php echo $status; ?></td>
                            <td><input type="radio" class="iframe_cclass" id="iframe_course" name="choose" value="<?php echo $value->course_id;?>" required></td>
                            <input type="hidden" name="tbl_course_id" value="<?php echo $value->id;?>">
                        </tr>
                    <?php $count++; } ?>
                    </tbody>
                </table>
            </div>
            
                <div class="form-group row">
                    <div class="col-sm-9">
                        <input type="submit" class="btn btn-success" name="submit"  value="submit">
                    </div>
                </div>
                
                <?php echo form_close(); ?> 

                <div class="row" id="my-div">
                    <iframe id="my-iframe" src="" title="CEP COURSE">
                    </iframe>
                </div>

        </div>
	<?php }else{
			echo '<p style="text-align:center; font-weigth:bold;">No course on Rboard.</p>';
		
	} ?>
 <!-- Rboard modal -->

    <div class="modal fade r-board-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
        <div class="r-board-modal-heading d-flex  align-items-center justify-content-center">
         
        </div>
            <div class="table-responsive">
                <div class="text-center">Step 1</div><br>
                <div class="text-center">Business and Accreditation Verification</div><br><br>
                <div class="text-center">Successfully completed</div>
                <div class="text-center pro-steps">
                       
                       <a href="#" class="stepActive">
                    <span>
                        <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    
                </a>

                </div>

                <div class="text-center">Please proceed to step 2.</div>
            </div>
            
            <div class="profassion">
                <div class="table-responsive"></div>
            </div>
            <div class="d-match text-center my-2"><img src="images/Untitled-2.png" alt=""></div>
            <div class="form-group row">
                <div class="col-md-10 text-center">
                    
                    <a class="btn btn-success text-uppercase proceed_to_second_step" href="">Next Step</a>

                    
                </div>
            </div>
        </div>
      
      </div>
    </div>
  </div>





  <script type="text/javascript">
    
    $(document).ready(function(){
        $('.iframe_cclass').on('click',function(){
        var id = $('input[name=choose]:checked', '#course_payment').val();
        // alert(id);
        var path = 'https://www.ceonpoint.com/pages/course_details/'+id;
        $('#my-iframe').attr('src',path);
        });
    });

  </script>
    