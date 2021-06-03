@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h3>Update Super Admin </h3>
        {!! Form::open(['route' => ['update.super.admin','id'=>$admin->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $admin->name, ['class' => 'form-control', 'placeholder' => 'Full Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', $admin->email, ['class' => 'form-control', 'placeholder' => 'abc@example.com'])}}
        </div>
        <div class="form-group">
            {{Form::label('contact', 'Contact')}}
            {{Form::number('contact', $admin->contact, ['class' => 'form-control', 'placeholder' => 'Contact'])}}
        </div>
        <div class="form-group">
            <label>Gender</label><br>
            <label for="male">Male</label>
            <input type="radio" {{($admin->gender=='male')?'checked':''}} value="male" name="gender" id="male">
            <label for="female">Female</label>
            <input type="radio" {{($admin->gender=='female')?'checked':''}} value="female" name="gender" id="female">
        </div>
        <div class="form-group">
            {{Form::label('profile_picture', 'Profile Photo')}}<br/>
            {{Form::file('profile_picture')}}
        </div>
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
