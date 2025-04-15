<div id="layoutSidenav_content">

<main>

    <div class="container-fluid">

        <h4 class="mt-4 mb-3"><?php echo $page_title; ?>
        
        <a href="javascript:history.back(1)" class="btn btn-info float-right">Back</a>
        </h4>

        <div class="card mb-4">

            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-key mr-1"></i>
                    <?php echo $table_name; ?>
                </span>
            </div>

            <div class="card-body">
            <?php echo $this->session->flashdata('item');?>

            <?php echo form_open_multipart('',array('id'=>'proctorForm')); ?>
            <div class="form-group row">
                <label for="old_password" class="col-sm-2 col-form-label">Old Password<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="old_password" name="old_password" />
                    <?php echo form_error('old_password', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				<label for="old_password" class="col-sm-2 col-form-label">New Password<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="new_pass" name="new_pass" />
                    <?php echo form_error('new_pass', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			<div class="form-group row">
				<label for="old_password" class="col-sm-2 col-form-label">Confirm Password<span class="error">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="conf_pass" name="conf_pass" />
                    <?php echo form_error('conf_pass', '<div class="error">', '</div>'); ?>
                </div>
            </div>
			
			<div class="form-group row">
				 <label for="logo" class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10 col-md-offset-2">
                    <button type="submit" class="btn btn-success text-uppercase" name="submit" value="submit" id="submit">Update</button>
                </div>
            </div>
            <?php echo form_close(); ?>
    
            </div>
        </div>
    </div>
</main>
<style type="text/css">
    .error{
        color: red;
    }
</style>