<h3>Hello {{$user->name}}</h3>

<p>Your Leave have been <i>accepted</i> by your team lead</p>

 @if($leaveType==3)
    <p>Be safe and take care you and your family too</p>
@elseif($leaveType==4)
    <p>Hearty wishes and be safe and enjoy</p>
@else
    <p>Hearty Condolence to you and your family</p>
@endif