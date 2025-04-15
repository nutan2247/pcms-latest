<div class="rbd-courses">
    <div id="banner-grid" class="py-5 px-2 bg-red">
        <h2 class="text-center text-uppercase text-white">Registered Professionals</h2>
    </div>
    <div class="container">
      
        <div class="row mt-md-5 mt-3">
       
            <div class="col-md-8">

                <div class="row">
                <div class="col-md-12">
                <?php echo form_open('',array('id'=>'professionalForm','method'=>'get')); ?>
                    <div class="form-row row">
                        <div class="my-1 col-md-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo (isset($_GET['name']))?$_GET['name']:'';?>">
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
						<div class="my-1 col-md-3">
                            <select name="countries_id" id="countries_id" class="form-control">
							<option value="" <?php echo (isset($_GET['countries_id']) && $_GET['countries_id']=="")?'selected':""; ?>>Country</option>
							<?php
								foreach($countrylistarr as $cnt){
									$selectedcnt = (isset($_GET['countries_id']) && $_GET['countries_id']==$cnt->countries_id)?'selected':'';
									echo '<option value="'.$cnt->countries_id.'" '.$selectedcnt.'>'.$cnt->countries_name.'</option>';
								}
							?>
							</select>
                        </div>                        
                        <div class="rounded my-1 px-0 col-md-3">
                            <button type="submit" class="letest-course-btn btn btn-light px-4"><i
									class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
                        </div>
                    </div>
                </form>
            </div>
                    <?php 

						//echo '<pre>'; print_r($listing); exit;
						if(is_array($listing)?count($listing):0){
						foreach($listing as $cep){
							$banner = '';
							if(file_exists('./assets/uploads/profile/'.$cep->image)){
								$banner = '<img src="'.base_url().'assets/uploads/profile/'.$cep->image.'" style="height:179px;">';
							}
							echo '<div class="col-4">
								<div class="common-main-box">
									<a href="'.base_url('professional/'.$cep->user_id).'">
									<div class="imag-panel">'.$banner.'<div class="img-disp-hover">'.ucwords($cep->fname.' '.$cep->lname.' '.$cep->name).'</div>
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