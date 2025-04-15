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
<?php 
    if($exam->exam_for == 'p'){
        $exam_for="Local Graduates";
    }else{
        $exam_for="Foreign Professional";
    }
?>

<div class="container">
    <div class="text-center">
        <h2 class="font-weight-dark my-4">Welcome to <br><?php echo $exam->name_of_exam; ?> <br>(<?php echo $exam_for;?>)</h2>
        <h5>Date: <?php echo date('M d,Y',strtotime($exam->date));?></h5>
        <h5>Timming: <?php echo date('H:i A',strtotime($exam->start_time));?> to <?php echo date('H:i A',strtotime(($exam->end_time)));?></h5>
        <h5>Venue: <?php echo $exam->venue; ?> </h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-5 mb-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Enroll your self for examination</h3>
                </div>
    
                <?php echo $this->session->flashdata('message'); ?>
                
                <div class="card-body">
                    <form method="post" role="form" id="form_login" action="<?php echo base_url('examination/examination/check_professional');?>">
                        <div class="form-group">
                            <label class="small mb-1" for="fname">First Name</label>
                            <input class="form-control py-4" name="fname" id="fname" type="text" placeholder="Please enter your first name" required />
                            <!-- <input name="exam_for" id="exam_for" value="<?php echo $exam->exam_for;?>" type="hidden" /> -->
                        </div>
						<div class="form-group">
                            <label class="small mb-1" for="lname">Middle Name</label>
                            <input class="form-control py-4" name="lname" id="lname" type="text" placeholder="Please enter your middle name" required />
                            
                        </div>
						<div class="form-group">
                            <label class="small mb-1" for="name">Last Name</label>
                            <input class="form-control py-4" name="name" id="name" type="text" placeholder="Please enter your last name" required />
                            <!-- <input name="exam_for" id="exam_for" value="<?php echo $exam->exam_for;?>" type="hidden" /> -->
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control py-4" name="email" id="email" type="email" placeholder="Please enter your email id" required />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="dob">Date of Birth</label>
                            <input class="form-control py-4" name="dob" id="dob" type="date" required />
                        </div>
                       <!-- <div class="form-group">
                            <label class="small mb-1" for="exam_code">Exam Code</label>
                            <input class="form-control py-4" name="exam_code" id="exam_code" type="text" placeholder="Please enter your exam code" required />
                        </div>-->
                        
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                           <button type="submit" class="btn btn-primary btn-block btn-login">
                                    <i class="entypo-login"></i>
                                    Start Exam
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
