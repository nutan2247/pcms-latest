<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>    

    <?php
        $exam_star_time = $this->session->userdata('start_time');
        $exam_end_time = $this->session->userdata('end_time');
        //$exam_star_time = '04:00';
        //$exam_end_time = '02:40';
        $enddatetime = date('Y-m-d H:i:s',strtotime($exam_end_time)); //for script use
        $start = strtotime(date('Y-m-d H:i:s',strtotime($exam_star_time)));
        $end = strtotime(date('Y-m-d H:i:s',strtotime($exam_end_time)));
        $now = strtotime(date('Y-m-d H:i:s'));
        
        $remaining_minutes = $end - $now;
        
        //$sec = $end - $start;
        //$remaining_minutes = strtotime($exam_end_time) - time();
        

        //echo date('Y-m-d H:i:s');exit;
        //echo $enddatetime;exit;
        //echo date('Y-m-d H:i:s',strtotime($exam_end_time)).' ';
        //echo $exam_end_time; exit;
        /*echo $start.' '.$end;exit;
        $end = strtotime('12-09-2019 13:16:00');
  
        $hours = intval(($end - $start)/3600);
        echo $hours.' hours';exit; //in hours
        $duration = '30' . ' minute';
        $exam_end_time = strtotime($exam_star_time . '+' . $duration);
        echo $exam_end_time;exit;
        $exam_end_time = date('Y-m-d H:i:s', $exam_end_time);
        $exam_end_time = strtotime($exam_end_time);
        $current_time = date('Y-m-d H:i:s');
        $current_time = strtotime($current_time);
        //$remaining_minutes = strtotime($exam_end_time) - time();

        $remaining_minutes = $exam_end_time - $current_time;
        echo $exam_end_time.' '.$current_time; 
        echo '<br>'.$remaining_minutes;exit;*/
        //$remaining_minutes = 100;
        //print_r($this->session->all_userdata()); exit;
        //$remaining_minutes = $sec;
        ?>
    <main class="mt-5">

    <div class="container-fluid">

    <!-- <h2 class="mt-4"><?php echo $page_title; ?></h2> -->

    <div class="card mb-4">

       
        <div class="card-body">

        <div class="row">

            <div class="col-md-8">

                <div class="card" id="questionpaper" style="display:none">

                    <div class="card-header"> 
                        <?php echo $page_title; ?>
                    </div>
                    <div class="card-body"> 

                <form action="<?=base_url('examination/examination/save_exam_result') ?>" method="post" id="QuestionPaper">
                <input type="hidden" name="set_no" value="<?php echo $all_question[0]['set_no']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('examniee_id'); ?>">
                <!-- <input type="hidden" name="exam_code" value="<?php echo $this->session->userdata('examniee_code'); ?>"> -->
                <input type="hidden" name="user_name" value="<?php echo $this->session->userdata('examniee_name'); ?>">
                <input type="hidden" name="user_type" value="<?php echo $this->session->userdata('examniee_type'); ?>">
                    
                    <!--class="mt-0"-->
                    <?php $totalquestion = 0; 
                    foreach ($all_question as $key => $value) { ?>
                    <div class="form-group" id="quesid<?=$key+1?>" style="<?=($key >=1)?'display:none':'';?>">
                    <!--<h6>Passing Marks : <?=$value['passing_score']; ?>% Category Name: <?=$value['category_name']; ?></h6>-->
                    <h4><?php echo $key+1;?>. <?php echo $value['question_title'];?> <span class="required"> * </span></h4>
                        <div class="answer-option">
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" type="radio" value="1" onclick="showbutton(<?=$key+1?>);" >
                                <span class="mode-span"><?php echo $value['answere1'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" type="radio" value="2" onclick="showbutton(<?=$key+1?>);" >
                                <span class="mode-span"><?php echo $value['answere2'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id'];?>" type="radio" value="3" onclick="showbutton(<?=$key+1?>);" >
                                <span class="mode-span"><?php echo $value['answere3'];?></span> </label>
                            <label class="radio-inline">
                                <input name="ans-<?php echo $value['id']?>" type="radio" value="4" onclick="showbutton(<?=$key+1?>);" >
                                <span class="mode-span"><?php echo $value['answere4'];?></span> </label>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success" onclick="NextFunction('<?=$key+1?>','<?=$key+2?>');" id="btnid<?=$key+1?>" style="<?=($key >=1)?'display:none':'';?>" disabled>Next</button>
                    </div>
                    <?php  $totalquestion++; } ?> 

                   
                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-10">

                            <div class="btn-group">

                                <button type="submit" class="btn btn-primary btn-flat" style="display:none" id="submitbtn" disabled>Submit</button>
                                <?php //echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat','id'=>'submit','style'=>'display:none', 'content' => 'Submit','disabled'=>'disabled')); ?>

                              <!--   <?php// echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => 'Reset')); ?> -->

                               <!--  <?php //echo anchor('admin/lesson', 'Cancel', array('class' => 'btn btn-secondary btn-flat')); ?> -->

                            </div>

                        </div>

                    </div>

                    </form>

                    </div>

                </div>

            </div>
            <div class="col-md-4">
                <div class="card" >
                    
                <div class="card-header"> 
                    Remaining Time
					<p id="startexamtimmer" style="font-size: 40px;font-weight: bold;text-transform:uppercase;"></p>
                </div>
                <div class="card-body" id="timersection" style="display:none;"> 
                    <div align="center">
                        <div id="exam_timer" data-timer="<?php echo $remaining_minutes; ?>" style="max-width:400px; width: 100%; height: 200px;"></div>
                    </div>
                </div>      
                <div class="card-body">
                    <div class="form-group">
						<?php //echo print_r($this->session); ?>
                        
                        <input type="hidden" name="exam_date" id="exam_date" value="<?php echo $this->session->userdata('exam_date'); ?>">
                        <input type="hidden" name="start_time" id="start_time" value="<?php echo $this->session->userdata('start_time'); ?>">
                        <input type="hidden" name="end_time" id="end_time" value="<?php echo $this->session->userdata('end_time'); ?>">
                        <span>Examinee Name : <b><?php echo $this->session->userdata('examniee_name'); ?></b></span><br>
                        <span>Examinee Email :<b><?php echo $this->session->userdata('examniee_email'); ?></b></span><br>
                        <span>Examinee Exam Code :<b><?php echo $this->session->userdata('examniee_code'); ?></b></span>

                    </div>
                </div> 
                </div>
            </div>
        </div>

        </div>

    </div> 

</div>
</main>

<script src="<?php echo base_url('assets/js/TimeCircles.js');?>"></script>
<script>
    var remainingsec = '<?=$remaining_minutes?>';
    $(document).ready(function() {
        
        //var exam_date = $('#exam_date').val();
        var exam_date = new Date().toISOString().slice(0, 10);
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();
        let today = new Date().toISOString().slice(0, 10);
        var currentdate = new Date();
        var currenttime = currentdate.getHours() + ":" + currentdate.getMinutes();
        // console.log(today)
        // console.log(currenttime);
		//alert(exam_date+'--'+today+'--'+start_time+'--'+end_time+'--'+currenttime);
        if(exam_date==today){
            // alert('same date');
           
            if(start_time <= currenttime){
                $('#questionpaper').show();
                $('#timersection').show();
            }else{
                alert('Please wait for a while exam will start on time.');

                var targetdate = new Date(exam_date+" "+start_time+":00").getTime();
                var x = setInterval(function() {
				//$('#timersection').show();
                // var now = new Date().getTime();
                var nowdate = formatDate(currentdate);
                var nowtime = getTime();
                var now = new Date(nowdate+" "+nowtime).getTime(); 
                
                var distance = targetdate - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                //    alert(minutes + "m " + seconds + "s ");
                $("#startexamtimmer").html(minutes + "m " + seconds + "s ");
                   
                // console.log(minutes + "m " + seconds + "s ");
                // If the count down is over, write some text 
                    if (distance < 0) {
						 
                        clearInterval(x);
                        // $("#startexamtimmer").html("Please refresh the page");
                        location.reload();
                    }
                }, 1000);
            }
        }else{
            alert('You do not have exam today!');
        }
        
    });
    

    $("#exam_timer").TimeCircles({ 
        //direction:"Clockwise",
        time:{
            Days:{
                show: false
            },
            Hours:{
                show: false
            }
        }
    });

    /*setInterval(function(){
        //alert('hi');
        var remaining_second = $("#exam_timer").TimeCircles().getTime();
        
        if(remaining_second < 1)
        {
            alert('Exam time over');
            location.reload();
        }
    }, 1000);*/
    
    /*setInterval(function(){
        var enddatetime = '<?=$enddatetime;?>';
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var hr = d.getHours();
        var min = d.getMinutes();
        var sec = d.getSeconds();
        var cdate = d.getFullYear() + '-' +(month<10 ? '0' : '') + month + '-' +(day<10 ? '0' : '') + day;
        var ctime = (hr<10 ? '0' : '') + hr + ':' +(min<10 ? '0' : '') + min + ':' +(sec<10 ? '0' : '') + sec;
        var cdatetime = cdate + ' ' + ctime;
        if(enddatetime == cdatetime){
            alert('ok sir exam khatam');
        }
        //alert(enddatetime+' '+cdatetime);
    }, 1000);*/
    setInterval(function(){
        //alert(remainingsec);
        remainingsec--;
        if(remainingsec == 0){
            alert('Time out! Click ok to submit your exam.');
            $("#QuestionPaper").submit();
        }
    }, 1000);   
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }
    
    function getTime(){
        var now = new Date(Date.now());
        return now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
    }

function NextFunction(key,nkey){
    var tques = <?php echo $totalquestion; ?>;
    $("#quesid"+key).hide();
    $("#btnid"+key).hide();
    $("#quesid"+nkey).show();
    if(nkey<tques){
        $("#btnid"+nkey).show();
    }else{
        $("#submitbtn").show();
    }
}
function showbutton(key){
    var tques = <?php echo $totalquestion; ?>;
    if(key<tques){
        $("#btnid"+key).removeAttr('disabled');
    }else{
        $("#submitbtn").removeAttr('disabled');
    }
}
</script>
