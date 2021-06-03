@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h3>Register Super Admin </h3>
        {!! Form::open(['route' => 'super.admin.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Full Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'abc@example.com'])}}
        </div>
{{--        <div class="form-group">--}}
{{--            {{Form::label('password', 'Password')}}--}}
{{--            {{Form::password('password', ['class' => 'form-control', 'placeholder' => '********'])}}--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            {{Form::label('password_confirmation', 'Confirm Password')}}--}}
{{--            {{Form::password('password_confirmation', ['class'=>'form-control'])}}--}}
{{--        </div>--}}
        <div class="form-group">
            {{Form::label('contact', 'Contact')}}
            {{Form::number('contact', '', ['class' => 'form-control', 'placeholder' => 'Contact'])}}
        </div>
        <div class="form-group">
            <label>Gender</label><br>
            <label for="male">Male</label>
            <input type="radio" value="male" name="gender" id="male">
            <label for="female">Female</label>
            <input type="radio" value="female" name="gender" id="female">
        </div>
        <div class="form-group">
            {{Form::label('profile_picture', 'Profile Photo')}}<br/>
            {{Form::file('profile_picture')}}
        </div>
        {{Form::submit('Register', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
