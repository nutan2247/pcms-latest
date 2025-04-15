<?php //echo '<pre>';print_r($details);exit;?>
<?php
        $logo = '<div class="border border-primary"><img
				src="'.base_url('assets/images/university/default-logo.png').'"
				width="100%"></div>';
		if($details->image !="" && file_exists('./assets/uploads/profile/'.$details->image)){	
		$logo ='<div class="border border-primary"><img
				src="'.base_url('assets/uploads/profile/').$details->image.'"
				width="100%"></div>';
		}
		//if($cep_details->document_for=='n'){$doc_for='<h3>New</h3>';}else{$doc_for='<h3>Re-New</h3>';}
?>
		    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <?=$logo ;  ?>
                            </div>
							<div class="col-md-10">
                                <h4><?=(!empty($details))?ucwords($details->fullname):"N/A"; ?>
                                </h4>
                                <p><b>Profession:</b>
                                    <?=(!empty($details))?$details->profession_name:"N/A"; ?>
                                    <br><b>License No:</b>
                                    <?=(!empty($details))?$details->license_no:"N/A"; ?>
                                    <br><b>Issued date:</b>
                                    <?=(!empty($details))?date('M d,Y',strtotime($details->license_issued_date)):"N/A"; ?>
                                    <br><b>Validity:</b>
                                    <?=(!empty($details))?date('M d,Y',strtotime($details->license_validity_date)):"N/A"; ?>
									<br><b>License Card Status: </b> <?=($details->license_validity_date > date('Y-m-d'))?'Valid':'Expired'; ?>
                                    <br><b>Issued By:</b>
                                    <?=(!empty($details))?$details->reg_board:"N/A"; ?>
                                </p>
                            </div>                           
                        </div>
                </div>
                <div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">School Name :</label>
						</div>
						<div class="col-sm-8">
							<?=($details->university > 0)?$details->university_name:$details->other_university;?>
						</div>                           
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Course Name :</label>
						</div>
						<div class="col-sm-8">
							<?=($details->college > 0)?$details->college_name:'N/A'; ?>
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Country :</label>
						</div>
						<div class="col-sm-8">
							<?=($details->country > 0)?$details->countries_name:"N/A"; ?>
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Address :</label>
						</div>
						<div class="col-sm-8">
						<?=(!empty($details->address))?$details->address:"N/A";?>
						</div>                           
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Email :</label>
						</div>
						<div class="col-sm-8">
							<?=(!empty($details->email))?$details->email:"N/A"; ?>
						</div>                           
					</div>
					</div>
                    <div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Date of Birth :</label>
						</div>
						<div class="col-sm-8">
							<?=(!empty($details->dob))?date('M d,Y',strtotime($details->dob)):"N/A";?>
						</div>                           
					</div>
					</div>
                    <div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Gender :</label>
						</div>
						<div class="col-sm-8">
							<?=ucwords(!empty($details->gender))?$details->gender:"N/A"; ?>
						</div>                           
					</div>
					</div>
                    <?php exit; ?>
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Contact No. :</label>
						</div>
						<div class="col-sm-8">
							'.(!empty($application[0]->u_contact)?$application[0]->u_contact:"--").'
						</div>                           
					</div>
					</div>	
					
						
						
					<div class="form-group">
					<div class="row">
					   <div class="col-sm-4">
							<label for="field-1" class="control-label">Exam Code :</label>
						</div>
						<div class="col-sm-8">
							<strong>'.(!empty($application[0]->exam_code)?$application[0]->exam_code:"--").'</strong>
						</div>                           
					</div>
					</div>
					
				';