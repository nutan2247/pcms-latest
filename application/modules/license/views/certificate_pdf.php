
    <div class="form-group row">
        <div class="col-md-8 mx-auto">
            <div class="my-5">
            
                <div class="col-sm-10">
                    <table class="table">
                        
                       
                        </tr>

                        <tr>
                            <th>Name</th>
                            <th>Profession</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Address</td>
                        </tr>
                        <?php
                            if(!empty($user_details))
                            {
                        ?>
                        <tr>
                            <td><?php echo $user_details->name; ?></td>
                            <td><?php echo $user_details->pro_name; ?></td>
                            <td><?php  echo $user_details->phone; ?></td>
                            <td><?php echo $user_details->dob; ?></td>
                            <td><?php echo $user_details->gender; ?></td>
                            <td><?php echo $user_details->address; ?></td>
                        </tr>
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>