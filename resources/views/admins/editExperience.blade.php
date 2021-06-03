@extends('layouts.app')
@section('content')
    <div class="container"><br>
        @include('includes.message')
        <h1>Update Employee</h1>
        {!! Form::open(['route' => ['update.employee.experience','id'=>$experience->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('joined_date', 'joined Date')}}
            {{Form::Date('joined_date', $experience->joined_date, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('position', 'Position')}}
            {{Form::text('position', $experience->position, ['class' => 'form-control', 'placeholder' => 'position'])}}
        </div>
        <div class="form-group">
            {{Form::label('resigned_date', 'Resigned Date (Optional)')}}
            {{Form::date('resigned_date', $experience->resigned_date, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            <label for="department_id">Department</label>
            <select class="form-control" id="department_id" name="department_id" title="Department">
                <option disabled>--Select One--</option>
                @foreach($departments as $department)
                    @if(!empty($department))
                        <option {{($department->id==$experience->department_id)?'selected':''}} value="{{$department->id}}">{{$department->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="department_id">Section</label>
            <select class="form-control" id="section_id" name="section_id" title="Section">
                <option disabled>--Select One--</option>
                <option value="{{$experience->section_id}}">{{$experience->section->name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="supervisor_id">Assign Supervisor</label>
            <select class="form-control" id="supervisor_id" name="supervisor_id" title="Supervisor">
                <option disabled>--Select One--</option>
                @foreach($supervisors as $supervisor)
                    <option value="{{$supervisor->id}}" class="form-control">{{$supervisor->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('review', 'Review')}}
            {{Form::textarea('review', $experience->review, ['class' => 'form-control', 'placeholder' => 'Review'])}}
        </div>
        <div class="form-group">
            {{Form::label('shift_from', 'Shift From')}}
            {{Form::time('shift_from', $experience->shift_from, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('shift_to', 'Shift To')}}
            {{Form::time('shift_to', $experience->shift_to, ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}<br><br><br><br><br>
        {!! Form::close() !!}
    </div>
@endsection
@section('custom-js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>
    <script>
        CKEDITOR.replace('editor')
        $(document).on('change', '#department_id', function (e) {
            e.preventDefault();
            var department_id = $('#department_id').val();
            var url = '{{url('employee/getSection')}}' + '/' + department_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function (res) {
                    $('#section_id').empty();
                    $('#section_id').html(res.options);
                }
            });
        });
    </script>
@endsection
