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
                <button class="btn border-transparent bg-theme-25 light:bg-light-2"> View Attendance Report</button>
            </span>
            <div class="text-white text-sm 2xl:text-base font-medium mt-4">
                    Hi {{$user['name']}} ,
                    <span class="text-theme-34 text-white font-normal">Welcome!</span>
                    <button class="btn btn-sm btn-secondary w-24 mr-1 mb-2" style="margin-left:75%;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="calendar" data-lucide="calendar" class="lucide lucide-calendar block mx-auto"><rect x="3" y="4" width="18" height="15" rx="2" ry="2"></rect><line x1="16" y1="2" x2="15" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <a href="{{route('attendance-show',[$user->id])}}"> Monthly Report</a>
                    </button>
            </div>
        </div> 
             <!-- Attendance card -->
    <div class="intro-y col-span-12 lg:col-span-6 text-white text-sm">
      <label for="regular-form" class="form-label">Today's Attendance</label>
        <input id="regular-form" type="text" class="datepicker form-control col-span-2 text-theme-35" data-single-mode="true">
    <form action="{{route('attendance-status')}}" method="post">    
       @csrf
       <div class="mt-5">
            <div class="flex flex-col sm:flex-row mr-2 mt- 5">
               <div class="form-check mr-5 mb-5">
                  <input id="active" class="form-check-input" type="checkbox"  value="1">
                  <label class="form-check-label text-white" for="active">Active</label>
                </div>
                <div class="form-check mr-5 mb-5">
                    <input id="inactive" class="form-check-input" type="checkbox" value="0">
                    <label class="form-check-label text-white" for="inactive">Inactive</label>
                </div>
            </div>
            <div class="cols-12 gap-4 mt-6">
                    <input type="text" id="attendancestatus" class="form-control text-theme-25 mt-2 mb-4"  style="width:480px;"data-single-mode="true"> 
                    <input type="hidden" id="value" name="value" value="">
            </div> 
        </div>
    
    </div>
    <div class="intro-y col-span-12 lg:col-span-6  p-4">
    <div id="inactive_side">    
        <div class="intro-y mt-3">
        <div  id="inactive_type" name="inactive_type">
            <div class="flex flex-col sm:flex-row mt-2">
               <div class="form-check mr-5">
                   <input id="permission" class="form-check-input" type="radio" name="inactive_type" value="1">
                   <label class="form-check-label text-white" for="permission">Permission</label>
                </div>
                <div class="form-check mr-4 mt-2 sm:mt-0">
                   <input id="leave" class="form-check-input" type="radio" name="inactive_type" value="2">
                   <label class="form-check-label text-white" for="leave">Leave</label>
                </div>
            </div>
        </div>
        </div>
        <div class="cols-12 gap-4 mt-6" id="permission_hours">
            <label class="text-white">Permission Hours From :</label>
            <input type="time" class="col-span-3" name="permission_hours_from" min="09:00" max="19:00">@error('permission_hours_from')<span style="color:red">{{$message}}</span>@enderror
            <label class="text-white">To :</label>
            <input type="time" class="col-span-3" name="permission_hours_to" min="09:00" max="19:00">@error('permission_hours_to')<span style="color:red">{{$message}}</span>@enderror
        </div>
        <div class="cols-12 gap-4 mt-6" id="leave_days">
            <label class="text-white">Leave Days From :</label>
            <input type="date" class="col-span-4" name="leave_days_from">@error('start_date')<span style="color:red">{{$message}}</span>@enderror
            <label class="text-white">To :</label>
            <input type="date" class="col-span-4" name="leave_days_to">@error('end_date')<span style="color:red">{{$message}}</span>@enderror
        </div>
        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-white mt-4 font-normal" id="leave_reason">
            <p>Why and When.. <p> 
            <textarea id="reason" title="reason for leave" class=" text-black mt-4 font-normal" name ="reason"  style="height:82px; width:400px"></textarea>                       
        </div> 
        <div class="flex flex-col sm:flex-row items-center">
            <select class="form-select form-select-lg sm:mt-2 sm:mr-2" id="leave_type" name="leave_type" aria-label=".form-select-lg">
                <option name="leave_type"value=null > </option> 
                <option name="leave_type" value="3">Medical Causes</option>
                <option name="leave_type" value="4">Celebration Leave</option>
                <option name="leave_type"value="5">Death Causes</option>
            </select>
        </div>
    </div>   
    </div>

            <button class="btn btn-success mt-4" id="save_button" type="submit">Submit</button>   
            <button class="btn btn-warning mt-4" id="update_button" type="submit">Update </button>
            
    </form> 
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){
    $("#attendancestatus").hide();
    // $("#inactive_side").hide();
       $("#active").click(function(){
         $("#inactive").prop("disabled",true);
         if($("#active").is(':checked')){
            $("#inactive").removeAttr('checked');
             $("#inactive_side").hide();
         }else{
            $("#inactive").prop("disabled",false);
             $("#inactive_side").show();
         }
        var activeValue = $("#active").val();
        $("#value").val(activeValue);
       });
       $("#inactive").click(function(){
           $("#active").prop("disabled",true);
           $("#inactive_side").show();
           if($("#inactive").is(':checked')){
            $("#active").removeAttr('checked');
             $("#inactive_side").show();
         }else{
            $("#active").prop("disabled",false);
             $("#inactive_side").hide();
         }
           var inactiveValue = $("#inactive").val();
           $("#value").val(inactiveValue);
       });
       $("#permission").click(function(){
           $("#permission_hours").show();
           $("#leave_days").hide();
           $("#leave_type").hide();
       });
       $("#leave").click(function(){
           $("#permission_hours").hide();
           $("#leave_days").show();
           $("#leave_type").show();
       });
       

   });
</script>

@endsection