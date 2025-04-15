<style>
    #myTabContent {
        border: 1px solid #efefef;
        margin-top: -1px;
    }

    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #007bff;
        border-color: #007bff !important;
    }

    #o-all .nav-link.active {
        color: #fff !important;
        background-color: #000;
        border-color: #000 !important;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4 mb-3"><?php echo $page_title; ?> 
            <a href="javascript:void(0);" class="btn btn-info float-right AddExamIns">Add Examination Instruction</a>
            <div class="row">
                <div class="col-sm-12">
                    <?php if($this->session->flashdata('err')){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                          <span><?=$this->session->flashdata('err')?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } 
                        if($this->session->flashdata('msg')){ ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <span><?=$this->session->flashdata('msg')?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      <?php } ?>
                </div>
            </div> 
        </h4>
                <?php echo $this->session->flashdata('item');?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%"
                            cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Instruction</th>
                                        <th>Exam Format</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php if(!empty($listing)) {
                                    $i = 1;
                                    foreach ($listing as $key => $value) {
                                    if($value->status=='1'){ $status = '<span class="text-success">Active</span>';  }else{ $status = '<span class="text-danger">Inactive</span>'; }
                                    if($value->exam_format == 1){$examformat = 'Computer Based';}else{$examformat = 'Paper Based';}
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->instruction; ?></td>
                                        <td><?php echo $examformat; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <!--<a href="<?php echo base_url('admin/question_view/'.$value->ins_id); ?>" class="btn btn-info" title="View"><i class="fas fa-eye"></i>View </a>-->
                                            <a href="javascript:void(0);" data-id="<?php echo $value->ins_id;?>" class="btn btn-info EditInstruction" title="Edit">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" onclick="delete_instruction('<?php echo $value->ins_id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                    <?php $i++; } } ?>
                                </tbody>

                            </table>
                        </div>
               

        </div>

    </main>
<div class="modal fade certificate-modal Instruction-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="popuptitle">Examination Instruction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
        </div>
      <!-- body -->
       <div class="modal-body">
           <form action="<?=base_url('admin/add_edit_examination_instruction') ?>" method="post" onsubmit="return instructionvalidate();" name="InstructionForm" id="InstructionForm" class="form-horizontal form-groups-bordered">
           <input type="hidden" name="ins_id" id="ins_id" value="">
            <div class="form-group row">
                <label for="instruction" class="col-sm-3 mb-3 mb-sm-0">Instruction:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="instruction" placeholder="Add Text Here" name="instruction" value="">
                    <span id="instructionerr" class="text-danger"></span>
                </div>
            </div> 
            <div class="form-group row">
                <label for="exam_format" class="col-sm-3 mb-3 mb-sm-0">Exam Format:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select name="exam_format" id="exam_format" class="form-control">
                        <option value="">Select Format</option>
                        <option value="1">Computer Based</option>
                        <option value="0">Paper Based</option>
                    </select>
                    <span id="exam_formaterr" class="text-danger"></span>
                </div>
            </div>
            <div class="form-group row">
                
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="field-1" class="control-label">Status:</label>
                </div>
                <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="radio" name="status" value="1" id="status1"> Active | 
                    <input type="radio" name="status" value="0" id="status2"> Inactive<br>
                    <span id="statuserr" class="text-danger"></span>
                </div>
                
                
            </div>
            <button type="submit" class="btn btn-primary">Submit</button> 
            <button type="Reset" class="btn btn-secondary">Reset</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </form>                      
       </div>
        
      <!-- end body -->
    </div>
  </div>
</div> 

<script>
    function delete_instruction(id){
        var x = confirm('Do you want to delete this ?');
        if(x == true){
            window.location.href = '<?php echo base_url('admin/examination_instruction_delete/'); ?>'+id;
        }
    }
    $( ".AddExamIns" ).click(function() { 
        $('#InstructionForm')[0].reset();
	    $('.Instruction-modal').modal('show'); 
	    
	});
$( ".EditInstruction" ).click(function() {
    var id = $(this).data("id");
    if(id > 0){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/get_one_examination_instruction');?>",
        data: { id : id},
        dataType: 'json',
        cache: 'false',
        success: function(result){
          console.log(result);
          $('#ins_id').val(result.instruction.ins_id);
          $('#instruction').val(result.instruction.instruction);
          $('#exam_format').val(result.instruction.exam_format);
          var status = result.instruction.status;
          if(status == 1){
              $('#status2').removeAttr('checked');
              $('#status1').attr('checked',true);
          }else{
              $('#status1').removeAttr('checked');
              $('#status2').attr('checked',true);
          }
        }
      });
      $('.Instruction-modal').modal('show');
    }
    //alert(id);
});
function instructionvalidate(){
    var instruction = document.forms["InstructionForm"]["instruction"];
    var exam_format = document.forms["InstructionForm"]["exam_format"];
    var status = document.forms["InstructionForm"]["status"];
    if(instruction.value == ""){
      $('#instructionerr').html('Instruction is required');
      instruction.focus();
      return false;
    }else{$('#categoryerr').html('');}
    if(exam_format.value == ""){
      $('#exam_formaterr').html('Exam Format is required');
      exam_format.focus();
      return false;
    }else{$('#exam_formaterr').html('');}
    if(status.value == ""){
      $('#statuserr').html('Status is required');
      return false;
    }else{$('#statuserr').html('');}
    
    return true;
}
</script>