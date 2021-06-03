@component('mail::message')
 Did you forget password of HrApp?? if yes click reset otherwise ignore this mail.

@component('mail::button', ['url' => URL::SignedRoute('reset.forget.password',['id'=>$admin->id])])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
