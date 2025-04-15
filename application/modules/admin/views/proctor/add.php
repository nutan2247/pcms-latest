<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

		

<div id="layoutSidenav_content">

    <main>

    <div class="container-fluid">
    <div class="clearfix">
            <h4 class="my-4 float-left"><?php echo $page_title; ?></h4>
            <a href="javascript:history.back(1);" class="my-4 btn btn-primary btn-sm float-right">Back</a>
        </div>
    <div class="card mb-4">

        <div class="card-header">

            <i class="fas fa-table mr-1"></i>

            <?php echo $table_name; ?>

        </div>

        <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-body"> 


                    <?php echo validation_errors(); ?>
                    <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_proctor')); //echo "<pre>"; print_r($proctor); echo "</pre>";  ?>

                    <?php echo form_hidden('proctor_id', isset($proctor->user_ID)?$proctor->user_ID:'');?>

                    <?php echo form_hidden('user_type', 'p');?> <!-- p means proctor -->

                            

                    <div class="form-group">

                        <label for="first_name" class="col-sm-2 control-label">First Name</label>

                        <div class="col-sm-10">

                            <input name="first_name" value="<?php echo isset($proctor->first_name)?$proctor->first_name:''; ?>" id="first_name" class="form-control" type="text" required>

                        </div>

                    </div> 

                    <div class="form-group">

                        <label for="last_name" class="col-sm-2 control-label">Last Name</label>

                        <div class="col-sm-10">

                            <input name="last_name" value="<?php echo isset($proctor->last_name)?$proctor->last_name:''; ?>" id="last_name" class="form-control" type="text" required>

                        </div>

                    </div> 

                    <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">

                            <input name="email" value="<?php echo isset($proctor->email)?$proctor->email:''; ?>" id="email" class="form-control" type="email" required>

                        </div>

                    </div>  

                    <div class="form-group">

                        <label for="photo" class="col-sm-2 control-label">Photo</label>

                        <div class="col-sm-10">

                            <input name="photo" value="<?php echo isset($proctor->photo)?$proctor->photo:''; ?>" id="photo" class="form-control" type="file">
                            <input name="old_photo" value="<?php echo isset($proctor->photo)?$proctor->photo:''; ?>" class="form-control" type="hidden">

                        </div>

                    </div>  

                    
                    <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Date of Appointment</label>

                        <div class="col-sm-10">

                            <input name="created_on" value="<?php echo isset($proctor->created_on)?$proctor->created_on:''; ?>" id="created_on" class="form-control" type="date" required>

                        </div>

                    </div>  

                    
                    <div class="form-group">

                        <label for="email" class="col-sm-2 control-label">Validity Date</label>

                        <div class="col-sm-10">

                            <input name="validity_date" value="<?php echo isset($proctor->validity_date)?$proctor->validity_date:''; ?>" id="validity_date" class="form-control" type="date" required>

                        </div>

                    </div>  

                    <div class="form-group">

                        <label for="user_type" class="col-sm-2 control-label">Proctor Type</label>

                        <div class="col-sm-10">
                            <label class="radio-inline">
                            <input type="radio" name="user_type" class="proctor_type" value="p" required <?php echo (isset($proctor->user_type) && $proctor->user_type=='p')? 'checked="checked"':''; ?>> Proctor for Graduates
                            </label> &nbsp;
                            <label class="radio-inline">
                            <input type="radio" name="user_type" class="proctor_type" value="pp" required <?php echo (isset($proctor->user_type) && $proctor->user_type=='pp')? 'checked="checked"':''; ?>> Proctor for Foreign Professional 

                        </div>

                        </div>
						<div class="form-group">
							<div class="col-sm-10">
							   <div id="examshedulelisting"></div>
							</div>
                        </div>
					<div class="form-group">

                        <label for="login_ip" class="col-sm-2 control-label">Login IP</label>

                        <div class="col-sm-10">

                            <input name="login_ip" value="<?php echo isset($proctor->login_ip)?$proctor->login_ip:''; ?>" id="login_ip" class="form-control" type="text" required>

                        </div>

                    </div> 	

                    <div class="form-group">

                        <label for="username" class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10">
                            <?php $condition = isset($proctor->username)?'readonly':'required'; ?>
                            <input name="username" value="<?php echo isset($proctor->username)?$proctor->username:''; ?>" id="username" class="form-control" type="email" <?php echo $condition; ?>>

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="password" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <?php $random_password = isset($proctor->user_ID)?'':rand(10000,999999); ?>
                            <input name="password" value="<?php echo $random_password; ?>" id="password" class="form-control" type="text">

                        </div>

                    </div>    
             

                    <div class="form-group">

                        <label for="status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10">

                            <label class="radio-inline">

                                <input type="radio" name="status" id="status1" value="enable" <?php echo (isset($proctor->status) && $proctor->status=='enable')? 'checked="checked"':''; ?>> Active

                            </label>

                            <label class="radio-inline">

                                <input type="radio" name="status" id="status0" value="disable" <?php echo (isset($proctor->status) && $proctor->status =='disable')? 'checked="checked"':''; ?>> Inactive

                            </label>

                        </div>

                    </div>

                            

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => 'Submit')); ?>

                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?>

                                <?php echo anchor('admin/proctor_listing', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?>

                            </div>

                        </div>

                    </div>

                    <?php echo form_close();?>

                    </div>

                </div>

            </div>

        </div>



        </div>

    </div> 
</div>
</main>
<script>
	var proctor_type = '<?php echo (isset($proctor->user_type))?$proctor->user_type:'';?>';
	var proctor_id = '<?php echo (isset($proctor->user_ID))?$proctor->user_ID:'';?>';
	fetch_exam_schedule(proctor_type,proctor_id);
	$(".proctor_type").click(function(){
		var proctor = $(this).val();
		fetch_exam_schedule(proctor,proctor_id);
	});
	function fetch_exam_schedule(proctor,proctor_id){
		
	  $.ajax({
        url:'<?php echo base_url("admin/get_exam_schedule_for_proctor");?>', 
        type:'post',
		//dataType: 'json',
       // data:{chargeid},
		data:{'proctor':proctor,'proctor_id':proctor_id},
        beforeSend:function(){
           $('#examshedulelisting').html('Fetching records...');

        },
        success:function(data){
			$('#examshedulelisting').html(data);
			
        }

    });
	}
</script>
                





