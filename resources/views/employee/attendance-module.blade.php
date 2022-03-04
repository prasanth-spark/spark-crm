@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Employee-Attendance</title>
@endsection

@section('mobile-menu-modifier')
    mobile-menu--dashboard
@endsection

@section('content-modifier')
    content--dashboard
@endsection

@section('subcontent')

<div class="intro-y grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 ">
            <span class="show box bg-theme-25 text-white flex items-center">
                <button class="btn border-transparent bg-theme-25 dark:bg-dark-2">
                <a href="{{route('attendance-show',[$user->id])}}"> View Attendance Report</a></button>
            </span>
            <div class="text-white text-sm 2xl:text-base font-medium mt-4">
                    Hi {{$user['name']}} ,
                    <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>
            </div>
        </div>    <!-- Attendance card -->
    <div class="intro-y col-span-12 lg:col-span-6 text-white text-sm p-4">
        <!-- <div class="intro-y  p-4"> -->
            <label for="regular-form" class="form-label">Today's Attendance</label>
            <input id="regular-form-1" type="text" class="datepicker form-control  text-theme-35" data-single-mode="true">
            <form action="{{route('attendance-status')}}" method="post">    
             @csrf   
            <input type="checkbox" id="present" class=" w-24 mt-4" value="1" >Active</input>
            <input type="checkbox" id="absent" class=" w-24 mt-4" value="0">Inactive</input>
            <input type="text"  id="attendance" class=" form-control text-theme-25 mt-2 mb-4" data-single-mode="true">
            <input type="hidden" id="value" name="value" value="">
            @isset($attendance)
            <input type="hidden" id="user" name="attendance_status" value="{{$attendance->attendance_status}}">
            <input type="hidden"  name="attendance_registered_user" value="{{$attendance->status}}">
            <input type="hidden"  name="registered_user_id" value="{{$attendance->user_id}}">
             @endisset

        <!-- </div> -->
    </div>
    <div class="intro-y col-span-12 lg:col-span-6  p-4">
        <div class="intro-y" id="date"> 
        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8" name="select" id="select">Leave Request
            <option> ...</option>
            <option value="1">Permission</option>
            <option value="2">Leave </option>
        </select>
        <input type= hidden name="inactive_value" id ="inactive_value">
        <div id ="permission" name="permission" >
            <label  class="form-label text-black text-theme-34 mt-4" name="permission">1</label>
            <input type ="radio" name="permission" value ="1">
            <label  class="form-label text-black text-theme-34 mt-4" name="permission">2</label>
            <input type ="radio" name="permission" value="2">
            <label  class="form-label  text-black text-theme-34 mt-4" name="permission">3</label>
            <input type ="radio" name="permission" value="3">
            <label  class="form-label text-black text-theme-34 mt-4" name="permission">4</label>
            <input type ="radio" name="permission" value="4">
            <label  class="form-label text-black text-theme-34 mt-4" name="permission">Half a day</label>
            <input type ="radio" name="permission" value="5">    </input>
        </div>
        <div id="permission_hours" name=permissson_hours>
            <label  class="form-label text-theme-34 mt-2">Permission-Hours</label> 
            <input type="time" name="permission_hours_from" id="permission_hours_from">
            <input type="time" name="permission_hours_to" id="permission_hours_to">
        </div>
            <div id ="leave" name = "leave">
        <label  class="form-label text-theme-34 mt-2">From</label>
            <input type="date" name="start_date" id="start_date" class=" form-control" data-single-mode="true" >@error('start_date')<span style="color:red">{{$message}}</span>@enderror
        <label  class="form-label text-theme-34 mt-2">To</label>
            <input type="date" name="end_date" id="end_date" class=" form-control" data-single-mode="true">@error('end_date')<span style="color:red">{{$message}}</span>@enderror    
            </div>
        </div>
        
    </div>   
    </div>                               
        <button class="btn btn-success mt-4" id="save_button" type="submit" >
             Submit
        </button> 
        <button class="btn btn-warning mt-4" id="update_button" type="submit"> 
             Update  
        </button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#absent").click(function(){
        $("#attendance").hide();
    	var status = $("#absent").val();
        $('#value').val(status);
    });
    $("#date").hide();
     $("#present").click(function(){
        $("#absent").prop("disabled",true);
         if($("#present").is(':checked')){
            $("#absent").removeAttr('checked');
             $("#date").hide();
         }else{
            $("#absent").prop("disabled",false);
             $("#date").show();
         }
        $("#attendance").hide();
        $("#date").hide();
    	var status = $("#present").val();
        $('#value').val(status);
    });
    $("#absent").click(function(){
        $("#date").show();
        if($("#absent").is(':checked')){
            $("#present").removeAttr('checked');
            $("#present").prop("disabled",true);
        }
        else {
            $("#present").prop("disabled",false);
            $("#date").hide();
        }
    });
    $("#attendance").show(); 
    var user = $("#user").attr("value");    
    if(user== null){
        $("#attendance").hide();
        $("#present").show();
        $("#absent").show();
        $("#update_button").hide();
    }
    else if(user == 0){
        $( "#present" ).show();
        $("#absent").prop("disabled",true);
        $('#attendance').val("You are registered as Absent");
        $("#update_button").show();
        $("#save_button").hide();
    }
    else if(user == 1){
        $("#present").prop("disabled",true);
        $( "#absent" ).show();
        $('#attendance').val("You are registered as Present");
        $("#update_button").show();
        $("#save_button").hide();
    }
    else if(user == 2){
        $("#absent").prop("disabled",true);
        $("#present").show();
        $("#attendance").val("Your Leave Permission taken to your team lead");
        $("#update_button").show();
         $("#save_button").hide();
    }
    else if(user == 3){
        $( "#present" ).prop("disabled",false);
        $("#absent").show();
        $("#attendance").val("Your Leave Permission Accepted");
        $("#update_button").show();
        $("#save_button").hide();
    }
    else{
        $( "#present" ).prop("disabled",false);
        $("#absent").show();
        $("#attendance").val("Your Leave Permission Rejected and marked as Absent");
        $("#update_button").show();
        $("#save_button").hide();
    }
    $("#select").change(function(){
    var status = $(this).val();
     $('#inactive_value').val(status);
        if(status == 2){
            $("#permission").hide();
            $("#permission_hours").hide();
            $("#leave").show();
        }else{
            $("#leave").hide();
            $("#permission_hours").show();
            $("#permission").show();
        }
});
});
</script>

@endsection