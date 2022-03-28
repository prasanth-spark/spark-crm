<p>Hello {{$teamLeadName}}</p>

   <p>{{$user->name}} have applied as he have {{$reason}} from {{$leaveDetail->permission_hours_from}} to {{$leaveDetail->permission_hours_to}} today for {{$leaveDetail->permission_type_id}} hours</p>



   @if($leaveDetail->permission_type_id != 1 && $leaveDetail->reponse_status != 1 )
   <a href="http://localhost:8000/employee/permission-response/{{$teamLead->id}}/{{$user->id}}/{{$leaveDetail->permission_type_id}}">select</a>
@else
</p> Note : Response Done </p>

@endif   