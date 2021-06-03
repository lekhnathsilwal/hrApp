@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h1>Register Admin </h1>
        {!! Form::open(['route' => ['update.admin','id'=>$admin->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
        @if($admin->type==1 && Auth::guard('admin')->user()->type!=0)
        @else
            <div class="form-group">
                {{Form::label('Roles')}}<br>
                <select name="role" class="form-control">
                    @foreach($roles as $role)
                        @foreach($role as $rl)
                            <option value="{{$rl->id}}" {{($admin->admin_role->role->name==$rl->name)?'selected':''}} class="form-control">{{$rl->name}}</option>
                            {{--                        {{Form::checkbox('roles[]',$rl->id)}}{{Form::label($rl->name)}}--}}
                        @endforeach
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group">
            {{Form::label('position', 'Position')}}
            {{Form::text('position', $admin->position, ['class' => 'form-control', 'placeholder' => 'Position'])}}
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
