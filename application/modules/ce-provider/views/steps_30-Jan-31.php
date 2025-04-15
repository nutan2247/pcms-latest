
    <div id="banner-grid" class="py-5 px-2 bg-red mb-5">
        <h2 class="text-center text-uppercase text-white mb-0">CE Provider Accereditation</h2>
    </div>

    <div class="container">
        <div class="row pro-steps">
            <div class="col-2">
                <?php
                if(isset($busniess_document_active) && $busniess_document_active!="")
                {
                    $class_step_1 = $busniess_document_active;
                }else if(isset($business_stepProcess) && $business_stepProcess!=""){
                    $class_step_1 = $business_stepProcess;
                }else{
                    $class_step_1 = "";
                }
                     
                
                ?>
                               <a href="<?php echo base_url('ce-provider/CE_provider')?>" class="<?php echo $class_step_1; ?>">
                    <span>
                        <strong>1</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Business & Accreditation Verification</label>
                </a>
                     
            </div>
            <div class="col-2">
                <?php
                if(isset($accre_document_active) && $accre_document_active!="")
                {
                    $class_step_2 = $accre_document_active;
                }else if(isset($accre_stepProcess) && $accre_stepProcess!=""){
                    $class_step_2 = $accre_stepProcess;
                }else{
                    $class_step_2 = "";
                }
                     
                
                ?>
                            <a href="<?php echo base_url('ce-provider/CE_provider/accre_document')?>" class="<?php echo $class_step_2; ?>">
                    <span>
                        <strong>2</strong><i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Accreditation Documents</label>
                </a>
                    </div>
            <div class="col-2">
                <?php
                if(isset($payment_document_active) && $payment_document_active!="")
                {
                    $class_step_3 = $payment_document_active;
                }else if(isset($payment_stepProcess) && $payment_stepProcess!=""){
                    $class_step_3 = $stepProcess;
                }else{
                    $class_step_3 = "";
                }
                     
                
                ?>


                            <a href="<?php echo base_url('ce-provider/CE_provider/payment')?>" class="<?php echo $class_step_3; ?>">
                    <span><strong>3</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                    <label>Payment</label>
                </a>
                        </div>
            <div class="col-2">
                <?php
                if(isset($verification_document_active) && $verification_document_active!="")
                {
                    $class_step_4 = $verification_document_active;
                }else if(isset($verification_stepProcess) && $verification_stepProcess!=""){
                    $class_step_4 = $verification_stepProcess;
                }else{
                    $class_step_4 = "";
                }
                     
                
                ?>
                            <a href="<?php echo base_url('ce-provider/CE_provider/verification_document')?>" class="<?php echo $class_step_4; ?>">
                    
                    <span><strong>4</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                    <label>Varification of Documents</label>
                </a>
                    </div>
            <div class="col-2">
                <?php
                if(isset($digital_document_active) && $digital_document_active!="")
                {
                    $class_step_5 = $digital_document_active;
                }else if(isset($digital_stepProcess) && $digital_stepProcess!=""){
                    $class_step_5 = $digital_stepProcess;
                }else{
                    $class_step_5 = "";
                }
                     
                
                ?>
                            <a href="<?php echo base_url('ce-provider/CE_provider/digital_accr')?>" class="<?php echo $class_step_5; ?>">
                    <span><strong>5</strong><i class="fa fa-check" aria-hidden="true"></i></span>
                    <label>Digital Accreditation</label>
                </a>
                    </div>
        </div>