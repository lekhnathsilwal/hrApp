@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h1>Register Employee</h1>
        {!! Form::open(['route' => ['update.employee','id'=>$employee->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $employee->name, ['class' => 'form-control', 'placeholder' => 'Full Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', $employee->email, ['class' => 'form-control', 'placeholder' => 'abc@example.com'])}}
        </div>
        <div class="form-group">
            {{Form::label('address', 'Address')}}
            {{Form::text('address', $employee->address, ['class' => 'form-control', 'placeholder' => 'address'])}}
        </div>
        <div class="form-group">
            {{Form::label('contact', 'Contact')}}
            {{Form::number('contact', $employee->contact, ['class' => 'form-control', 'placeholder' => 'Contact'])}}
        </div>
        <div class="form-group">
            {{Form::label('dob', 'Date of Birth')}}
            {{Form::date('dob', $employee->dob, ['class' => 'form-control', 'placeholder' => 'Date of Birth'])}}
        </div>
        <div class="form-group">
            <label>Gender</label><br>
            <label for="male">Male</label>
            <input type="radio" {{($employee->gender=='male')?'checked':''}} value="male" name="gender" id="male">
            <label for="female">Female</label>
            <input type="radio" {{($employee->gender=='female')?'checked':''}} value="female" name="gender" id="female">
        </div>
        <div class="form-group">
            {{Form::label('profile_picture', 'Profile Photo')}}<br/>
            {{Form::file('profile_picture')}}
        </div>
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
