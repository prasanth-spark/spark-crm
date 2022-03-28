<p>Hello {{$teamLeadName}}</p>

<p>Your team employee {{$user->name}} had apply for leave. 
   so kindly check and permit his/her leave </p>

   <p>{{$user->name}} have applied as he have {{$reason}} from {{$start_date}} to {{$end_date}}</p>

@if($leaveType !=5)
  <a href="http://localhost:8000/employee/leave-response/{{$teamLead->id}}/{{$user->id}}/{{$leaveType}}">select</a>
@endif
