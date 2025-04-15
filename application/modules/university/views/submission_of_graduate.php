<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">    
    .error{
        color:#ce2b2b;
    }
</style>
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white"><?php echo $page_title; ?></h2>
</div>
<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
           <a href="#" class="stepProcess">
                <span>1</span>
                <label>School Information</label>
            </a>         
        </div>
        <div class="col-2">
            <a href="#">
                <span>
                    <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>List of Graduates</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#">
				<span>3</span>
				<label>Payment</label>
			</a>
        </div>
        <div class="col-2">
            <a href="#">
                <span>4</span>
                <label>Review of Graduates</label>
            </a>
        </div>
        <div class="col-2">            
            <a href="#">
                <span>5</span>
                <label>Exam Code</label>
            </a>        
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center">School Information</h4>
		    <?php if($unvdetls->uniid ){ ?>
           <div class="univ-dtl">
                <?php echo $this->session->flashdata('error'); ?>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label border">Name : </label>
                    <div class="col-sm-10 col-form-label border border-left-0">
                        <?php echo $unvdetls->university_name; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label border">College of : </label>
                    <div class="col-sm-10 col-form-label border border-left-0">
                        <?php echo $unvdetls->collegeofname; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label border">Email : </label>
                    <div class="col-sm-10 col-form-label border border-left-0">
                        <?php echo $unvdetls->email; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label border">Address : </label>
                    <div class="col-sm-10 col-form-label border border-left-0">
                        <?php echo $unvdetls->address; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label border">Contact No. : </label>
                    <div class="col-sm-10 col-form-label border border-left-0">
                        <?php echo $unvdetls->contact_no; ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-12 text-center mt-3">
                    <a href="<?php echo base_url('university/submissionofgraduateslist');?>"><button type="button" class="btn btn-success text-uppercase" name="submit" value="submit" id="submitBtn">Next</button></a>
                </div>
            </div>
			<?php }else{
				echo '<p style="text-align:center;">Please login for submission of graduate for licensure examination <a href="'.base_url('login').'">Click to Login</a>';
			} ?>
          
        </div>
    </div>


</div>


<script>
function goToBookExam(){
	window.location.href = "<?php echo base_url('graduates/graduates/book_exam'); ?>";
}
function closeMMpopup(){
	$('#graduteDataNotMatch').modal('hide'); 

}
function hide_popup(){
	$('#staticBackdrop').modal('hide'); 

}
</script>