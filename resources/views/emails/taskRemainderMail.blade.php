@component('mail::message')

<p>Hi {{$users}}

<p>Please Update the task</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
