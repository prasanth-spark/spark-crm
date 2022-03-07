@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Leave Permission Form</title>
@endsection

@section('mobile-menu-modifier')
    mobile-menu--dashboard
@endsection

@section('content-modifier')
    content--dashboard
@endsection

@section('subcontent')
            <!-- Attendance card -->
            <div class="intro-y  mt-5">
                    <div class="show box bg-theme-25 text-white flex items-center mb-4">
                        <span>
                            <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Leave Detail</button>
                        </span>
                    </div>
            </div>
            <div class="mt-4 mb-4 grid grid-cols-12  intro-y">
                <div class="col-span-12  relative text-center sm:text-left">
                    <div class="text-white text-sm 2xl:text-base font-medium -mb-1">Hi {{$user['name']}} ,
                        <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>   
                    </div>
                    <form action="{{route('leave-status')}}" method="post">
                      @csrf
                       <input type="hidden" name="id" id="user_id" value="{{$user['id']}}">
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 leading-2 mt-4 font-normal">
                                    <p>Why are you availing leave .. <p>
                         <textarea id="reason" title="" class="form-control text-theme-34  mt-4 font-normal" name ="reason" required></textarea>                       
                        </div> 
                        <div class="text-base 2xl:text-lg text-theme-34 mt-4">Make sure of your leave permission be valid</div> 

                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center  leading-2 mt-4 font-normal">
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2"  id="leave_type"name="leave_type">Leave Type
                                    <option> --</option>
                                    <option value=1 name="leave_type"> Permission </option>
                                    <option value="2" name="leave_type">Sick Leave</option>
                                    <option value="3" name="leave_type">Personal Leave </option>
                            </select>
                        </div>     
                        <div id="leave_dates">        
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 dark: mt-4  font-normal">
                            <p> Selected date From and To you need a leave</p>
                        </div>
                        <div>   
                            <label  class="form-label text-theme-34 mt-2"  >From</label>
                            <input type="text" name="start_date" id="start_date" class="form-control" value ="{{$userLd['start_date']}}" data-single-mode="true">
                            <label  class="form-label text-theme-34 mt-2">To</label>
                              <input name="end_date" id="end_date" type="text" class="form-control"  value="{{$userLd['end_date']}}" data-single-mode="true">
                        </div>  
                        </div>
                        <div class="text-theme-34 mt-5"  name="permission_hours" id="permission_hours">
                           <input  id="hours" type="text" class="form-control"  value="{{$userLd['permission_type_id']}}" data-single-mode="true"> 
                        </div>

                        <button type="submit" id="submit" class="btn btn-warning w-32 mt-4">
                            <i data-feather="download" class="w-4 h-4 mr-2"></i> Submit
                        </button>   
                    </form>
                </div>
@endsection
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#leave_type").change(function(){
    var status = $(this).val();
        if(status == 1){
            $("#permission_hours").show();
            $("#leave_dates").hide();
        }
        else {
            $("#leave_dates").show();
            $("#permission_hours").hide();
        }

});
});
</script>