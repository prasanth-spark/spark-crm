@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Response Form</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection




@section('subcontent')
<div class="intro-y grid grid-cols-12 gap-6 mt-5"> 
    <div class="col-span-12 intro-y mt-5 ">
        <div class="show box bg-theme-25 text-white flex items-center mb-4">
            <span>
                <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Leave Detail</button>
            </span>
        </div>
    </div>
    <div class="intro-y col-span-10 lg:col-span-5 text-white text-sm">
        <div class="text-black text-sm 2xl:text-base font-medium -mb-1">Hi {{$teamLead['name']}} ,
            <span class="text-theme-34 dark:text-grey-500 font-normal">Welcome!</span>   
        </div>
        <form action="{{route('leave-status')}}" method="post">
            @csrf
            @foreach($user as $employee) @endforeach
            <p class="text-black mt-4">Leave Response for {{$employee->name}}</p>
            <div class="mt-5">
              <div class="flex flex-col sm:flex-row mr-2 mt- 5">
                <div class="form-check mr-5 mb-5">
                    <input id="accept" class="form-check-input" type="radio" name="leave_response"  value="2">
                    <label class="form-check-label text-black" for="active">Accepted</label>
                </div>
                <div class="form-check mr-5 mb-5">
                    <input id="reject" class="form-check-input" type="radio" name="leave_response" value="3">
                    <label class="form-check-label text-black" for="inactive">Rejected</label>
                </div>
              </div>
              <div class="flex flex-col">
                <select class="form-select form-select-md text-black mb-6" id="reason" name="rejected_reason" aria-label=".form-select-lg" style="width:25em;">
                    <option> </option>
                    <option name="rejected_reason" value="You have taken more leave this month">Taken more leave before in this month</option>
                    <option name="rejected_reason" value="Death time is near for your project">Death time is near for the project</option>
                    <option name="rejected_reason"value="There is no other sources">There is no other man power</option>
                </select>
              </div>
              <div class="cols-12 gap-4 mt-6">
                    @foreach($user as $employee) @endforeach
                <input type="hidden" id="user_id" name="user_id" value="{{$employee->id}}">
                <input type="hidden" id="user_id" name="leave_type" value="{{$lt}}">
                <button class="btn btn-success mt-6" id="save_button" type="submit">Submit</button> 
              </div> 
            </div>                     
        </form>
    </div>
    <div class="intro-y col-span-12 lg:col-span-7 overflow-auto lg:overflow-visible p-4">
        <table id="attendance_table" class="table table-report -mt-2">
          <thead>
            <tr>
             <th class="whitespace-nowrap">Date</th>
             <th class="whitespace-nowrap">Leave Type </th>
             <th class="whitespace-nowrap">Leave Reason</th>
             <th class="whitespace-nowrap">End Date</th>
             <th class="whitespace-nowrap">Leave Count</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user as $employee) 
            <tr>  
             <td>{{date('d-m', strtotime($employee->start_date))}} </td>

            
                <td>
                  @switch($employee->leave_type_id)
                     @case($employee->leave_type_id==1)
                        Permission
                     @break
                     @case($employee->leave_type_id==2)
                        Half Day 
                     @break
                     @case($employee->leave_type_id==3)
                        Medical leave 
                     @break
                     @case($employee->leave_type_id==4)
                        Celebration Leave
                     @break
                     @case($employee->leave_type_id==5)
                        Death Leave
                     @break
                     @default
                        Absent
                    @endswitch
                </td>
                <td>{{$employee->description}}</td>
                            <td>{{date('d-m-Y', strtotime($employee->end_date))}}</td>
                            <td>{{$employee->leave_counts}}</td>
                        </tr>
                    @endforeach
                </tbody> 
            </table>
    </div>
</div>    
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#attendance_table').DataTable({
        scrollY:"400px",
        scrollX:true,
        paging:true,
    });
});
</script>
<script>
    $(document).ready(function(){
        $("#reason").hide();
    $("#reject").click(function(){
        $("#reason").show();
    });
    $("#accept").click(function(){
    $("#reason").hide();
    });
    });
</script>