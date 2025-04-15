
<div id="banner-grid" class="py-5 px-2 bg-red mb-5">
    <h2 class="text-center text-uppercase text-white">
        <?php echo $page_title; ?>
    </h2>
</div>

<div class="container">
    <div class="row pro-steps">
        <div class="col-2">
            <a href="#" class="stepActive">
                <span>
          <strong>1</strong>
          <i class="fa fa-check" aria-hidden="true"></i>
        </span>
                <label>Graduate Profile & Code</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span>
          <strong>2</strong>
          <i class="fa fa-check" aria-hidden="true"></i>
        </span>
                <label>Exam Booking</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span><strong>3</strong>
          <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Payment</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span><strong>4</strong>
          <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Examination Guidelines and Information</label>
            </a>
        </div>
        <div class="col-2">
            <a href="#" class="stepActive">
                <span><strong>5</strong>
          <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <label>Exam Pass</label>
            </a>
        </div>
    </div>
</div>

    <div class="col-md-8 mx-auto">
        <div class="my-5">
            <h4 class="mb-4 mt-4 text-uppercase text-center"><?php echo $title; ?></h4>
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <p>User name: <b><?php echo $result->user_name; ?></b> </p>
                                <p>Your Result: <b><?php echo $result->status; ?></b> </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>