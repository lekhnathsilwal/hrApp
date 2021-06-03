@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h1>Add Department</h1>
        {!! Form::open(['route' => 'department.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Department Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Department Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'description'])}}
        </div>
        <div class="form-group">
            {{Form::label('image', 'Image')}}<br/>
            {{Form::file('image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
