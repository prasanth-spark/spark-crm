@component('mail::message')
# Dear {{$details['name']}},Welcome!

Please clik the below link to forgot your password.

@component('mail::button', ['url' => $details['url']])
Reset Password
@endcomponent
<!-- <a href="{{$details['url']}}" class="btb btn-primary">Reset Password</a> -->

Thanks,<br>
@endcomponent
