@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Dashboard Employee-CRM</title>
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
                <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Attendance Detail</button>
            </span>
            <div class="text-white text-sm 2xl:text-base font-medium mt-4">
                    Hi {{$user['name']}} ,
                    <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>
            </div>
        </div>    <!-- Attendance card -->
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-4">
            <label for="regular-form" class="form-label">Today's Attendance</label>
            <input id="regular-form-1" type="text" class="datepicker form-control  text-theme-35" data-single-mode="true">
            <form action="{{route('attendance-status')}}" method="post">
                
            @csrf   
           
            <button type="button" id="present" class="btn btn-success w-24 mt-4 " name="active" value="1">Active</button>
            <button type="button" id="absent" class="btn btn-danger w-24 mt-4 cursor-not-allowed " name="inactive" value="0">Inactive</button>
            <input type="hidden" id="value" name="value" value="">
        </div>
        </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-4">
        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8" name="select">Leave Request
            <option> ...</option>
            <option value="1">Permission</option>
            <option value="2">Leave </option>
        </select>
            
        <label  class="form-label text-theme-34 mt-2"  >From</label>
            <input name="start_date" id="start_date" class="datepicker form-control" data-single-mode="true" >
        <label  class="form-label text-theme-34 mt-2">To</label>
            <input name="end_date" id="end_date" class="datepicker form-control" data-single-mode="true">    
        </div>
    </div>                                            
        <button class="btn btn-primary  mt-4" type="submit" >
             Saving
        </button>
</div>

<button class="cursor-not-allowed">
  Button
</button>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#absent").click(function(){
    	var status = $("#absent").attr("value");
        $( "#present" ).prop( "disabled", true );
        alert(status);
        $('#value').val(status);
  
    });
     $("#present").click(function(){
    	var status = $("#present").attr("value");
         $( "#absent" ).prop( "disabled", true );
        alert(status);
        $('#value').val(status);
    });
});
</script>

@endsection