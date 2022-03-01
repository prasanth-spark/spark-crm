<h2>Hello {{$user->name}}</h2>



@php 
if($status ==2){
    $report = "Accepted";
}else{
    $report = "Rejected";
}

@endphp

<p>Your Leave have been {{$report}} by your team lead</p>

  