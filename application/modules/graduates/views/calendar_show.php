<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="<?php echo base_url('assets/calender')?>/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url('assets/calender')?>/fullcalendar/lib/jquery.min.js"></script>
<script src="<?php echo base_url('assets/calender')?>/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url('assets/calender')?>/fullcalendar/fullcalendar.min.js"></script>

<script>

$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header:{
            left: 'title',
            right:'prev, today next'
        },
        eventColor: '#378006',
        
        // eventLimit: true,
        events: "<?php echo base_url('graduates/calender/fetch_event'); ?>",
        displayEventTime: false,
        selectConstraint:{
          start: '00:00', 
          end: '24:00', 
        },   
        // eventRender: function (event, element, view) {
        //     if (event.allDay === 'true') {
        //         event.allDay = true;
        //     } else {
        //         event.allDay = false;
        //     }
        // },
        selectable: true,
        selectHelper: true,

        select: (start, end, allDay) => {
            var startDate = moment(start),
            endDate = moment(end),
            date = startDate.clone(),
            isWeekend = false;
            if (moment().format('YYYY-MM-DD') === start.format('YYYY-MM-DD') || start.isAfter(moment())) {
                
                while (date.isBefore(endDate)) {
                // if (date.isoWeekday() == 6 || date.isoWeekday() == 7) {
                if (date.isoWeekday() == 7) {
                    isWeekend = true;
                }    
                date.add(1, 'day');
            }

            if (isWeekend) {
                alert('Can\'t select weekend date!');
                return false;
            }

            var slot = prompt('Please enter any one slot number *only number*. (slot 1 = 7:00-8:30, slot 2 = 9:00-10:30, slot 3 = 10:30-12:30, slot 4 = 12:30-2:30,)');
            if(slot <= 4 && slot > 0){
            this.startDate  = startDate.format("YYYY-MM-DD");
            this.endDate    = endDate.format("YYYY-MM-DD");   
            var date        = $.fullCalendar.formatDate(startDate, "YYYY-MM-DD");
            var title       = 'Booked';
            var application_id = '<?php echo $grad_id; ?>';
                $.ajax({
                    url: '<?php echo base_url('graduates/calender/add_event');?>',
                    data: { date : date, slot : slot, title : title, application_id : application_id },
                    type: "POST",
                    success: function (result) { 
                        alert(result);
                        if(result > 0){
                            displayMessage("Added Successfully, Please click submit.");
                        }else{
                            displayError("Slot booked already.!");
                        }
                    }
                });
            }else{
                displayError("Please Enter slot number from 1,2,3,4.");
            }
                
            }else{
                alert('Can\'t select previous date!');
                return false;
            }

            

                calendar.fullCalendar('renderEvent',
                        {   
                            title:title,
                            date: date,
                            allDay: allDay
                        },
                true
                        );
            calendar.fullCalendar('unselect');
        },
                
        editable: true,
        // eventDrop: function (event, delta) {
        //             var date = $.fullCalendar.formatDate(event.date, "YYYY-MM-DD");
        //             $.ajax({
        //                 url: '<?php echo base_url('graduates/calender/edit_event');?>',
        //                 data: "&id=" + event.id +'&date='+ date,
        //                 type: "POST",
        //                 success: function (response) {
        //                     displayMessage("Updated Successfully");
        //                 }
        //             });
        //         },
        // eventClick: function (event) {
        //     var deleteMsg = confirm("Do you really want to delete?");
        //     if (deleteMsg) {
        //         $.ajax({
        //             type: "POST",
        //             url: "<?php echo base_url('graduates/calender/delete_event');?>",
        //             data: "&id=" + event.id,
        //             success: function (response) {
        //                 if(parseInt(response) > 0) {
        //                     $('#calendar').fullCalendar('removeEvents', event.id);
        //                     displayMessage("Deleted Successfully");
        //                 }
        //             }
        //         });
        //     }
        // }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 3000);
}
function displayError(message) {
        $(".response").html("<div class='danger'>"+message+"</div>");
    setInterval(function() { $(".danger").fadeOut(); }, 3000);
}
</script>

<style>
body {
    margin-top: 50px;
    text-align: center;
    font-size: 12px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    width: 700px;
    margin: 0 auto;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
.danger {
    background: #dc3545;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
    color: #fff;
}
</style>
</head>
<body>
    <!-- <h2>PHP Calendar Event Management FullCalendar JavaScript Library</h2> -->

    <div class="response"></div>
    <div id='calendar'></div>
</body>


</html>