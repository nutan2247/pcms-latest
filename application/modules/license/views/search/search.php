<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">Verify Certificates, Accreditation and Application</h2>
</div>

            <?php echo form_open_multipart('license/Search'); ?>
<div class="container mb-5">
    <div class="bg-light p-5 rounded text-center">
    <!--<h3 class="mb-3">Search License</h3>-->
<div class="form-inline d-flex justify-content-center mb-2">
  
  <div class="form-group mx-sm-5">    
    <input type="text" class="form-control" name="referenceNo" placeholder="Enter certificate, accreditation or application number here" style="width:500px;">
    
  </div>  
  <input type="submit" value="Submit" class="btn btn-success" name="submit">
</div>
	<?php echo form_error('referenceNo', '<div class="error">', '</div>'); ?>
    <?php echo $this->session->flashdata('search_error'); ?>
    </div>
</div>


<?php echo form_close(); ?>