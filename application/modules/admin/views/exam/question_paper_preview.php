<?php //print_r($settingarr);exit;?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">

                <div class="row mt-5">

                    <div class="card">

                        <div class="card-header">
                            <div class="clearfix">
                                <a class="btn btn-primary float-left" href="javascript:void(0)" onclick="return printData();">Print</a>
                                <a class="btn btn-primary float-right" href="<?php echo base_url('admin/publish_exam_question/'.$this->uri->segment(3)); ?>" >Back</a>
                            </div>
                            <div class="text-center">
                                <img src="" class="rounded" alt="logo">
                                <h2><?=$settingarr->rb_name?></h2>
                            </div>
                        </div>

                        <div class="card-body" id="printable-screen">                         

                            <table class="table table-bordered" style="width:700px ">

                                <tbody>
                                    <tr style="text-align: left;">

                                        <th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Name of Exam : </th>

                                        <td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo $schedule->name_of_exam; ?></td>

                                    </tr>

                                    <tr style="text-align: left;">

                                        <th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Exam Date : </th>

                                        <td  style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?php echo date('F d,Y',strtotime($schedule->date)); ?></td>

                                    </tr>


                                    <tr style="text-align: left;">

                                        <th style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;">Total Number of Questions in this Exam  :</th>

                                        <td style="border: 1px solid #f1f1f1; width:50%; text-align: left; padding: 8px 10px;"><?=count($all_questions)?></td>

                                    </tr>

                                </tbody>

                            </table>
                            <div style="text-align left; padding: 8px 10px;">
                                <p><strong>Passing Score: 123 out of 200 (86%)</strong></p>
                                <p><strong>NAME:_____________________________________________________________________</strong></p>
                                <p><strong>Gender:________________________________Birthday:__________________________</strong></p>
                                <h5>INSTRUCTIONS FOR THE EXAMINATION:</h5>
                                <?php if(!empty($instruction)){ $sn=1;
                                    foreach($instruction as $list){
                                        echo '<p><strong>'.$sn++.'. '.$list->instruction.'</strong></p>';
                                    }
                                } ?>
                            </div>
                            <table>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th>S. no.</th>
                                                    <th>Question</th>
                                                    <!--<th>Rationale</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php //print_r($all_questions);exit;
                                                    if(isset($all_questions) && count($all_questions)>0){
                                                        $count=1;
                                                    $all_qno = array_column($all_questions,'id');
                                                    $encodedquestionno = implode(',',$all_qno);
                                                    
                                                    foreach($all_questions as $value){ ?>
                                                        <tr>
                                                            <td><?=$count; ?></td>
                                                            <td><?=$value->question_title; ?><br>
                                                                <span>a.<?=' '.$value->answere1?> b.<?=' '.$value->answere2?> c.<?=' '.$value->answere3?> d.<?=' '.$value->answere4?></span></td>
                                                            <!--<td><?=isset($value->rationale)?$value->rationale:'--';?></td>-->
                                                        </tr>
                                                    <?php $count++; } 
                                                    }else{ echo '<tr><td colspan="3">No question found!</td></tr>'; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </table>

                        </div>

                </div>
    
            </div>
        </main>
    </div>

        <?php  function showimage($image){
        $imageData = base64_encode(file_get_contents($image));
        $src = 'data:image/jpeg;base64,'.$imageData;
        return $src;
        } ?>

<script>
    function printData(){
        var printContents = document.getElementById('printable-screen').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

