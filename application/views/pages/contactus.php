<?php  $cmsid =  $contactusbody->cms_id;
	if($contactusbody->banner) {	 ?>

<section class="cmshero-panel blog-heropanel <?php echo $contactusbody->cms_url; ?>"
    style="background-image: url(<?php echo base_url('assets/images/banner/'.$contactusbody->banner); ?>);display: block;">
    <div class="container">
        <div class="d-flex align-items-center about-bnr-content">
            <?php echo $contactusbody->bannertext;?>
        </div>
    </div>
</section>
<?php } else { ?>

<section class="cmshero-panel blog-heropanel blog-banner <?php echo $contactusbody->cms_url; ?>">
    <div class="container">
        <div class="cmshero-infobox">
            <h2 class="bannr-title bannr-title hero-samlltitle-black">
                <?php echo $contactusbody->cms_title;?>
            </h2>
        </div>
    </div>
</section>

<?php }
?>
<section class="contact-uspanel py-lg-5 py-4">
    <div class="container-fluid">
        <div class="contact-content px-md-5 px-0">
            <div class="row">
                <div class="col-md-7">
                    <form action="<?php echo base_url('pages/save_contact'); ?>" method="post" autocomplete="off">
                        <?php echo $this->session->flashdata('response'); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="heading-title pb-4">Contact Us</h2>
                                <h4 class="heading-title ">Let's get started</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label class="input-label">Name</label>
                                    <input type="hidden" name="cmd_id" id="cmd_id" value="2">
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($_REQUEST['name'])?$_REQUEST['name']:'';?>" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label class="input-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"  value="<?php echo isset($_REQUEST['email'])?$_REQUEST['email']:'';?>" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label class="input-label">Tel. Number</label>
                                    <input type="number" name="telnumber" id="telnumber" class="form-control"
                                        required="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper">
                                    <label class="input-label">Fax Number</label>
                                    <input type="number" name="faxnumber" id="faxnumber" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper select-wrapper">
                                    <label class="input-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-wrapper select-wrapper">
                                    <label class="input-label">Country</label>
                                    <select name="city" id="city" class="form-control" required="">
                                        <option value="" selected="">Please select one</option>
                                        <?php 
                                            if($countrylist != ''){
                                                foreach($countrylist as $value){ 
                                                    echo '<option value="'.$value->countries_id.'" >'.$value->countries_name.'</option>';
                                                } 
                                            }else{ echo '<option value="">No Data Found!</option>'; }?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-wrapper">
                                    <label class="input-label">Subject</label>
                                    <select name="subject" id="subject" class="form-control" required="">
                                        <option value="">Select one</option>
                                        <option value="Inquiry">Inquiry</option>
                                        <option value="Testimonial">Testimonial</option>
                                        <option value="Complaint">Complaint</option>
                                        <option value="Refund">Refund</option>
                                        <option value="Suggestion">Suggestion</option>
                                        <option value="Verification">Verification</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-wrapper">
                                    <label class="input-label">Message</label>
                                    <input type="text" name="message" id="message" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <div class="contact-btnbox d-inline-block text-center">
                                    <input type="submit" class="btn btn-primary px-5 my-md-4 mr-auto">
                                </div>
                                <br>

                            </div>

                        </div>
                    </form>
                </div>

                <div class="col-md-5">
                    <div class="contactsame">
                        <div class="h3">COUNTACT US</div>
                        <ul>
                            <li><i class="fa fa-location-arrow"></i>
                                <span>21 Mohawk Trail, Greenfield,<br>MA 01301, United States</span>
                            <li><i class="fa fa-phone"></i><span>+(954) 988-0710</span></li>
                            <li><i class="fa fa-phone"></i><span>+(242) 565-9121</span></li>
                            <!-- <li><i class="fa fa-envelope"></i><a href="mailto:team@ceonpoint.com">team@ceonpoint.com</a></li> -->
                            <li><i class="fa fa-envelope"></i><a href="#">team@ceonpoint.com</a></li>
                        </ul>
                    </div>
                    <div class="map-box">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d56191.554978357926!2d-77.40277651490248!3d25.03795425631932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s%201Sandiport%20Village%2C%20Nassau%20Bahamas!5e0!3m2!1sen!2sin!4v1630914562135!5m2!1sen!2sin" width="100%" height="530" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>