@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h1>Edit Section</h1>
        {!! Form::open(['route' => ['update.section','id'=>$section->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Section Name')}}
            {{Form::text('name', $section->name, ['class' => 'form-control', 'placeholder' => 'Section Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $section->description, ['class' => 'form-control', 'placeholder' => 'description'])}}
        </div>
        <div class="form-group">
            {{Form::label('image', 'Image')}}<br/>
            {{Form::file('image')}}
        </div>
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
