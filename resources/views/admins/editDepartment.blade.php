@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h1>Edit Department</h1>
        {!! Form::open(['route' => ['update.department','id'=>$department->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Department Name')}}
            {{Form::text('name', $department->name, ['class' => 'form-control', 'placeholder' => 'Department Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $department->description, ['class' => 'form-control', 'placeholder' => 'description'])}}
        </div>
        <div class="form-group">
            {{Form::label('image', 'Image')}}<br/>
            {{Form::file('image')}}
        </div>
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
