
<section class="dashboard-contentpanel py-lg-5 py-3 ">
<div class="container">
	<div class="row">
		
		<div class="col-md-8">
			<?php $message = $this->session->flashdata('item');
				if(isset($message)) { ?>
				<div class="row">
                    <div class="box-body col-md-12">
                        <h4 class="alert <?php echo $message['class']; ?>"><?php echo $message['message']; ?></h4>
                    </div>
				</div>
				<?php } ?>
            <?php if(!$this->session->userdata('login')['user_ID']){
                    echo "<a href='".base_url('ce-provider/ce_provider/dashboard')."' class='btn btn-primary'>My Account</a>"; 
                }else{
                    echo "<a href='".base_url('login')."' class='btn btn-primary'>Login</a>"; 
                }?>
                
        </div>
    </div>
</div>
</section>