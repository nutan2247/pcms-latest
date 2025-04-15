<?php
if(!function_exists('count_down'))
{
    function count_down($from_date)
    {
        $to_date = date('Y-m-d');
        $date1 = date_create(date('Y-m-d',strtotime($from_date))); //date_create("2021-01-01");
        $date2 = date_create(date('Y-m-d',strtotime($to_date)));//date_create("2021-01-22");

        

        $diff = date_diff($date1,$date2);
        $result = $diff->format("%a days");


        
        if(strtotime($from_date) > strtotime($to_date)){
            return $result;    
        }else{
            return '0 days';
        }

    }
}
?>