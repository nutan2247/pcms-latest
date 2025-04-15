
    <div id="banner-grid" class="py-5 px-2 bg-red mb-5">
        <h2 class="text-center text-uppercase text-white mb-0">Continuing Professional Development (CPD) Provider Accreditation</h2>
    </div>

    <div class="container">
        <div class="row pro-steps">
            <div class="col-2">
                <?php
                if(isset($busniess_document_active) && $busniess_document_active!="")
                {
                    $class_step_1 = $busniess_document_active;
                    $href_1 = base_url('ce-provider/ce_provider');
                }else if(isset($business_stepProcess) && $business_stepProcess!=""){
                    $class_step_1 = $business_stepProcess;
                    $href_1 = base_url('ce-provider/ce_provider');
                }else{
                    $class_step_1 = "";
                    $href_1 = "javascript:void()";
                }
                     
                
                ?>
                <a href="<?php echo $href_1; ?>" class="<?php echo $class_step_1; ?>">
                    <span>
                        <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Business Information</label>
                </a>
            </div>
                     
            <div class="col-2">
                <?php
                if(isset($accre_document_active) && $accre_document_active!="")
                {
                    $class_step_2 = $accre_document_active;
                    $href_2 = base_url('ce-provider/ce_provider/accre_document');
                }else if(isset($accre_stepProcess) && $accre_stepProcess!=""){
                    $class_step_2 = $accre_stepProcess;
                    $href_2 = base_url('ce-provider/ce_provider/accre_document');
                }else{
                    $class_step_2 = "";
                    $href_2 = "javascript:void()";
                }
                     
                
                ?>
                            <a href="<?php echo $href_2; ?>" class="<?php echo $class_step_2; ?>">
                    <span>
                        <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Required Documents</label>
                </a>
            </div>

            <div class="col-2">
                <?php
                if(isset($payment_document_active) && $payment_document_active!="")
                {
                    $class_step_3 = $payment_document_active;
                    $href_3 = base_url('ce-provider/ce_provider/payment');
                }else if(isset($payment_stepProcess) && $payment_stepProcess!=""){
                    $class_step_3 = $payment_stepProcess;
                     $href_3 = base_url('ce-provider/ce_provider/payment');
                }else{
                    $class_step_3 = "";
                    $href_3 = "javascript:void()";
                }
                     
                
                ?>


                <a href="<?php echo $href_3; ?>" class="<?php echo $class_step_3; ?>">
                    <span><strong>3</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                    <label>Payment</label>
                </a>
            </div>

            <div class="col-2">
                <?php
                if(isset($verification_document_active) && $verification_document_active!="")
                {
                    $class_step_4 = $verification_document_active;
                    $href_4 = base_url('ce-provider/ce_provider/verification_document');
                }else if(isset($verification_stepProcess) && $verification_stepProcess!=""){
                    $class_step_4 = $verification_stepProcess;
                    $href_4 = base_url('ce-provider/ce_provider/verification_document');
                }else{
                    $class_step_4 = "";
                    $href_4 = "javascript:void()";
                }
                     
                
                ?>
                <a href="<?php echo $href_4; ?>" class="<?php echo $class_step_4; ?>">
                    <span><strong>4</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                    <label>Verification of Documents</label>
                </a>
            </div>
                    
            <div class="col-2">
                <?php
                if(isset($digital_document_active) && $digital_document_active!="")
                {
                    $class_step_5 = $digital_document_active;
                    $href_5 = base_url('ce-provider/ce_provider/digital_accr');
                }else if(isset($digital_stepProcess) && $digital_stepProcess!=""){
                    $class_step_5 = $digital_stepProcess;
                    $href_5 = base_url('ce-provider/ce_provider/digital_accr');

                }else{
                    $class_step_5 = "";
                    $href_5 = "javascript:void()";
                }
                     
                
                ?>
                <a href="<?php echo $href_5; ?>" class="<?php echo $class_step_5; ?>">
                    <span><strong>5</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                    <label>Digital Certificate of Accreditation</label>
                </a>
            </div>
        </div>
    </div>