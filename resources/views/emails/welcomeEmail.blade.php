@component('mail::message')
<b>Welcome To HrApp {{$admin->name}}</b><br>
You have registered as admin to HrApp<br>
Your password is: <b><i>{{$password}}</i></b><br>
Please do change your password after you login.

@component('mail::button', ['url' => url('/')])
Proceed to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
