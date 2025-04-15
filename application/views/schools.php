<div class="rbd-courses">
	<div id="banner-grid" class="py-5 px-2 bg-red">
		<h2 class="text-center text-uppercase text-white">Accredited Schools</h2>
	</div>
	<div class="container">
		
		
		<div class="row mt-md-5 mt-3">
            <div class="col-md-8">

			<div class="row">
			<div class="col-md-12">
                <?php echo form_open('',array('id'=>'schoolForm','method'=>'get')); ?>
					<div class="form-row row">
						<div class="my-1 col-md-5">

							<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo (isset($_GET['name']))?$_GET['name']:'';?>">
						</div>
						<div class="my-1 col-md-2">
							<input type="text" class="form-control" name="accreditation_no" id="accreditation_no"
								placeholder="Accreditation no." value="<?php echo (isset($_GET['accreditation_no']))?$_GET['accreditation_no']:'';?>">
						</div>
						<div class="my-1 col-md-3">
                            <select name="profession_id" id="profession_id" class="form-control">
							<option value="" <?php echo (isset($_GET['profession_id']) && $_GET['profession_id']=="")?'selected':""; ?>>Profession</option>
							
							<?php
								foreach($professionarr as $pro){
									$selectedcnt = (isset($_GET['profession_id']) && $_GET['profession_id']==$pro->id)?'selected':'';
									echo '<option value="'.$pro->id.'" '.$selectedcnt.'>'.$pro->name.'</option>';
								}
							?>
							</select>
                        </div>
						<!--<div class="my-1 col-md-2">
                            <select name="countries_id" id="countries_id" class="form-control">
							<option value="" <?php echo (isset($_GET['countries_id']) && $_GET['countries_id']=="")?'selected':""; ?>>Country</option>
							<?php
								foreach($countrylistarr as $cnt){
									$selectedcnt = (isset($_GET['countries_id']) && $_GET['countries_id']==$cnt->countries_id)?'selected':'';
									echo '<option value="'.$cnt->countries_id.'" '.$selectedcnt.'>'.$cnt->countries_name.'</option>';
								}
							?>
							</select>
                        </div> -->
						<div class="rounded my-1 px-0 col-md-2">
							<button type="submit" class="letest-course-btn btn btn-light px-4"><i
									class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
						</div>
					</div>
				</form>
            </div>
			<?php 

					//echo '<pre>'; print_r($schoollisting); exit;
					if(is_array($schoollisting)?count($schoollisting):0){
					foreach($schoollisting as $sch){
							$banner = '<img src="'.base_url().'assets/images/university/default-logo.png" style="height:179px;">';
						if(file_exists('./assets/images/university/'.$sch->college_logo)){
							$banner = '<img src="'.base_url().'assets/images/university/'.$sch->college_logo.'">';
						}
						
						echo '<div class="col-4">
								<div class="common-main-box">
									<a href="'.base_url('school/'.$sch->uniid).'">
									<div class="imag-panel">'.$banner.'<div class="img-disp-hover">'.ucwords($sch->university_name).'</div>
									</div>
									</a>
									
								</div>
							</div>';		
						
			}
			}else{
					echo '<p style="padding: 35px 150px;">Record not found.</p>';
				} ?>
		</div>
            </div>
            <?php $this->view('right_section'); ?>
        </div>
	</div>
</div>