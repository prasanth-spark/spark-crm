@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Attendance-Report</title>
@endsection

@section('mobile-menu-modifier')
    mobile-menu--dashboard
@endsection

@section('content-modifier')
    content--dashboard
@endsection

@section('subcontent')
<style>
    .full-calender{
        background: #fff;
    }
</style>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

        <div class="col-span-12 ">
            <span class="show box bg-theme-25 text-white flex items-center">
                <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Hi {{$user['name']}} ,</button>
            </span>
            <div class="intro-y col-span-12 lg:col-span-6 text-white text-sm p-4">
                <label  class="form-label">Today's Attendance</label>
                @isset($attendance)
                <input type="hidden" id="user" name="attendance_status" value="{{$attendance->attendance}}">
                @endisset($attendance)
                <input type="text" name="attendance_status" id="attendance_status" class="form-control text-theme-35" data-single-mode="true">
            </div>

        </div>   
   
        <div class="full-calender text-base font-medium mt-4">
            <div id='calendar-container'>
                <div id='calendar'></div>
            </div>
        </div> 
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
   
    var user = <?php echo json_encode($leaveDetails); ?>;

var events =[];
   $.each(user , function(index, item) { 
   
    events.push({
        "title" :  item.description,
        "start" : item.start_date,
        "end" : item.end_date,
        
        });
});
    console.log(events)
   
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        height: '500px',
        events:events
            });
    calendar.render();
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var user = $("#user").attr("value"); 
    if(user == 1){
        $('#attendance_status').val("You are Active now");
    }
    else if(user == 0){
        $('#attendance_status').val("You are Inactive today");
    }
    else {
        $("#attendance_status").val("Your Attendance status not updated");
    }
});
</script>
@endsection