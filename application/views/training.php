<div class="rbd-courses">

    <div id="banner-grid" class="py-5 px-2 bg-red mb-5">

        <h2 class="text-center text-uppercase text-white">Accredited Training Courses</h2>

    </div>

    <div class="container">

        <div class="row mt-md-5 mt-3">

            <div class="col-md-8">

							<h2>Latest Accredited Training Courses:</h2>



                <div class="row">

                <div class="col-md-12">

                



				<?php echo form_open('',array('id'=>'courseForm','method'=>'get')); ?>

				<div class="row pt-1">

                    <!--<div class="form-group col-md-3">

                        <select name="category" class="form-control">

                            <option value="">Category</option>

                            <?php foreach($category as $inti){

                                if($inti['insititution_id']=='')

                                { continue; } ?>

                               <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_GET['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>

                            <?php } ?>

                        </select>

                    </div>-->



                    <div class="form-group col-md-4">

                        <select name="profession" class="form-control">

                            <option value="" >Profession</option>

                            <?php foreach($profession as $cp){ ?>

                                <option value="<?php echo $cp->id; ?>" <?php if(isset($_GET['profession']) && $_GET['profession']==$cp->id){echo'selected';} ?> ><?php echo $cp->name; ?></option>

                            <?php } ?>

                        </select>

                    </div>

                    

					<div class="form-group col-md-4">

							<input type="text" name="training_title" class="form-control" value="<?php echo (isset($_GET['training_title']) && $_GET['training_title'])?$_GET['training_title']:''; ?>" placeholder="Enter Training Title" >

					</div>



					<div class="form-group col-md-4">

						<input type="submit" class="btn btn-primary" name="submit" id="sbbtn" value="Search">

					</div>

				</div>

				</form>

            </div>

                    <?php 

		

							//echo '<pre>'; print_r($traininglisting); exit;

							if(count($traininglisting)>0){

							foreach($traininglisting as $cour){

									$banner = '';

								if(file_exists('./assets/images/ce_provider/'.$cour->training_image)){

									$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$cour->training_image.'">';

								}

								

								echo '<div class="col-4">

											<div class="common-main-box">

												<a href="'.base_url('training/'.$cour->train_doc_id).'">

												<div class="imag-panel">'.$banner.'<div class="img-disp-hover">'.ucwords($cour->training_title).'</div>

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