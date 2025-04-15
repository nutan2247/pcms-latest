
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
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
                <a href="<?php echo base_url('admin/training_document_listing/');?>" class="btn btn-info float-right">Back</a>
            </h4>
            <div class="card mb-4"></div>
            <?php //echo'<pre>'; print_r($coursereviewdatails); ?>
            <div class="row border-bottom border-primary">
                <div class="col-md-12 mx-auto v-div">
                    <div class="row mt-3 pb-3">
                        <div class="col-md-12">
                            <div class="row">
                               <!-- <div class="col-md-2">
                                    <?php
                                        if(!empty($training_details->training_image))
                                        {
                                    ?>
                                    <div class="border border-primary"><img
                                            src="<?php echo base_url('assets/images/ce_provider/').$training_details->training_image; ?>"
                                            width="100%"></div>
                                        <?php } ?>
                                </div> -->
                                <div class="col-md-8">
                                    <h4><?php echo (!empty($training_details)?$training_details->business_name:""); ?>
                                    </h4>

                                    <p><b>Email:</b>

                                        <?php echo (!empty($training_details)?$training_details->email:""); ?><br>

                                    </p>
									<p><b>Training Title:</b>

                                        <?php echo (!empty($training_details)?$training_details->training_title:""); ?><br>

                                    </p>
									<p><b>Training Unit(s):</b>

                                        <?php echo (!empty($training_details)?$training_details->training_units:""); ?><br>

                                    </p>
									<p><b>Training Price:</b>

                                        <?php echo (!empty($training_details)?$training_details->training_price:""); ?><br>

                                    </p>
									<p><b>Applied on:</b>

                                        <?php echo (!empty($training_details)?$training_details->licence_applied:""); ?><br>

                                    </p>
									<p><b>Pdf:</b>

                                        <?php echo (!empty($training_details)?'<a href="'.base_url('assets/images/training_pdf/'.$training_details->training_pdf).'" target="_blank">Click to view</a>':"N/A"); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="card">
            <div class="card-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" method="post" action="<?php echo current_url();?>">
                <?php //print_r($training_details);?>
                  

                    <?php if(!empty($training_details->reviewer_id) && $training_details->reviewer_id == $this->session->userdata('login')['user_ID']){ 
                        if(count($trainingreviewdatails) == 0){ ?>
                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Comment:</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea name="comment" class="form-control" placeholder="Please add your all comments here..."><?php echo set_value('comment');?></textarea>
								<?php echo form_error('comment', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                           <div class="col-sm-4">
                                <label for="field-1" class="control-label">Status:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="radio" name="status" value="1" required> Approve |
                                <input type="radio" name="status" value="2" required> Reject |
								<input type="radio" name="status" value="3" required> Hold
								<br><?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div> 
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <div class="col-sm-offset-6 col-sm-5">
                            <input type="hidden" name="train_doc_id" id="train_doc_id" value="<?php echo isset($training_details->train_doc_id)?$training_details->train_doc_id:'';?>">
                            <input type="hidden" name="cep_email" value="<?php echo isset($training_details->email)?$training_details->email:'';?>">
                            <input type="hidden" name="cep_name" value="<?php echo isset($training_details->business_name)?$training_details->business_name:'';?>">
                            <input type="hidden" name="provider_id" value="<?php echo isset($training_details->provider_id)?$training_details->provider_id:'';?>">
                            <input type="submit" class="btn btn-success" value="Submit">                            
                        </div>
                    </div>
                <?php }else{ echo 'Already submitted!'; } } ?>
                </form>             
            </div>              
        </div>
                        </div>
                    </div>
                </div>
                        <?php //echo'<pre>';print_r($training_details); ?>

        

            </div>
          
            <div>
            </div>
        </div>
</div>
</div>
</div>

</main>



<script>
    $(document).ready(function(){
        var id = "<?php echo $training_details->train_doc_id;?>";

        if(id > 0){
            var path = 'https://www.ceonpoint.com/pages/course_details/'+id;
            $('#my-iframe').attr('src',path);
        }
    });

    function viewDoc(url){
        $('#viewImageDoc').attr('src',url);
        $('#viewDocModal').modal('show');
    }
        
    function close(){
        $('#viewImageDoc').attr('src','');
    }
    
  </script>
    