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
            <a href="javascript:void(0);" class="btn btn-info float-right AddExamQuesCat">Add Examination Category</a>
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
                                        <th>Category</th>
                                        <th>Passing Score</th>
                                        <th>Date Added</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Delete</th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                       
                            <?php if(!empty($listing)) {
                                    $i = 1; $totalpercentage = 0; $passingscore = 0;
                                    foreach ($listing as $key => $value) {
                                    if($value->status=='1'){ $status = '<span class="text-success">Active</span>';  }else{ $status = '<span class="text-danger">Inactive</span>'; }
                                    if($value->added_at != '0000-00-00'){
                                        $date = date('M d,Y', strtotime($value->added_at));
                                    }else{
                                        $date = '--';
                                    }
                                    if($value->status == '1'){
                                        $totalpercentage += $value->passing_score;
                                    }
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->category_name; ?></td>
                                        <td><?php echo $value->passing_score.'%'; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <!-- <a href="<?php echo base_url('admin/question_view/'.$value->excat_id); ?>" class="btn btn-info" title="View"><i class="fas fa-eye"></i> </a> -->
                                            <a href="javascript:void(0);" data-id="<?php echo $value->excat_id;?>" class="btn btn-info EditCategory" title="Edit">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="javascript:void(0)" onclick="delete_category('<?php echo $value->excat_id; ?>');" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                    <?php $i++; } } $passingscore = $totalpercentage/($i-1)?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total Percentage:</td>
                                        <td><?=$totalpercentage.'%';?></td>
                                        <td>Passing Percentage:</td>
                                        <td><?=$passingscore.'%';?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
               

        </div>

    </main>
<div class="modal fade certificate-modal addcategory-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="popuptitle">Examination Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
        </div>
      <!-- body -->
       <div class="modal-body">
           <form action="<?=base_url('admin/add_edit_examination_category') ?>" method="post" onsubmit="return categoryvalidate();" name="CategoryForm" id="CategoryForm" class="form-horizontal form-groups-bordered">
           <input type="hidden" name="excat_id" id="excat_id" value="">
            <div class="form-group row">
                <label for="category_name" class="col-sm-3 mb-3 mb-sm-0">Category Name:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="category_name" placeholder="Add Text Here" name="category_name" value="">
                    <span id="categoryerr" class="text-danger"></span>
                </div>
            </div> 
            <div class="form-group row">
                <label for="passing_score" class="col-sm-3 mb-3 mb-sm-0">Passing Score:<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select name="passing_score" id="passing_score" class="form-control">
                        <option value="">Select Percentage</option>
                        <?php for($i=75; $i<=100; $i++){
                            echo '<option value="'.$i.'">'.$i.'%</option>';
                        } ?>
                    </select>
                    <span id="scoreerr" class="text-danger"></span>
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
    function delete_category(id){
        var x = confirm('Do you want to delete this ?');
        if(x == true){
            window.location.href = '<?php echo base_url('admin/examination_category_delete/'); ?>'+id;
        }
    }
    $( ".AddExamQuesCat" ).click(function() { 
        $('#CategoryForm')[0].reset();
	    $('.addcategory-modal').modal('show'); 
	});
$( ".EditCategory" ).click(function() {
    var id = $(this).data("id");
    if(id > 0){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/get_one_examination_category');?>",
        data: { id : id},
        dataType: 'json',
        cache: 'false',
        success: function(result){
          console.log(result);
          $('#excat_id').val(result.category.excat_id);
          $('#category_name').val(result.category.category_name);
          $('#passing_score').val(result.category.passing_score);
          var status = result.category.status;
          if(status == 1){
              $('#status2').removeAttr('checked');
              $('#status1').attr('checked',true);
          }else{
              $('#status1').removeAttr('checked');
              $('#status2').attr('checked',true);
          }
        }
      });
      $('.addcategory-modal').modal('show');
    }
    //alert(id);
});
function categoryvalidate(){
    var name = document.forms["CategoryForm"]["category_name"];
    var score = document.forms["CategoryForm"]["passing_score"];
    var status = document.forms["CategoryForm"]["status"];
    if(name.value == ""){
      $('#categoryerr').html('Category Name is required');
      name.focus();
      return false;
    }else{$('#categoryerr').html('');}
    if(score.value == ""){
      $('#scoreerr').html('Passing Score is required');
      score.focus();
      return false;
    }else{$('#scoreerr').html('');}
    if(status.value == ""){
      $('#statuserr').html('Status is required');
      return false;
    }else{$('#statuserr').html('');}
    
    return true;
}
</script>