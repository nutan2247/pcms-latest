
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">      
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Welcome in Examination Panel</h3>
                </div>
                <?php echo $this->session->flashdata('message'); ?>
                <div class="card-body">
                    <form method="post" role="form" id="form_login" action="<?php echo base_url('examination/examination/login');?>">
                        <div class="form-group">
                            <label class="small mb-1" for="exam_type">Exam Type</label>
                            <select class="form-control" name="exam_type" id="exam_type" required>
                                <option value="">Please select your exam type</option>
                                <?php foreach($exam_list as $value){?>
                                <option value="<?php echo $value->es_id; ?>"><?php echo $value->name_of_exam.'('.$value->exam_for.')'; ?> </option>
                                <?php } ?>
                                <!-- <option value="p">Nursing Licensure Examination for Professioanl</option> -->
                                <!-- <option value="g">Nursing Licensure Examination for Gradute</option> -->
                            </select>
                        </div>
                        
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                           <button type="submit" class="btn btn-primary btn-block btn-login" name="proccesed" value="next-step">
                                    <i class="entypo-login"></i>
                                    Proccesed to next step
                                </button>
                        </div>
                    </form>
                </div>                                  
            </div>
        </div>
    </div>
</div>

</body>
</html>
