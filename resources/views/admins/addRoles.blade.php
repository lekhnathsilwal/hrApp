@extends('layouts.app')
@section('custom-css')
    <style>
        .subc {
            float: left;
            margin-right: 70px;
        }
        #sb{
            margin-left: 50px;
            margin-top: 20px;
        }
        .ch{
            height: 18px;
            width:18px;
        }
        .checkbox ul li{
             margin-left: -20px;
             list-style: none;
        }
    </style>
    @endsection
@section('content')
    <div class="content"><br>
        @include('includes.message')
        <h1>Add Role</h1>
        {!! Form::open(['route' => 'role.store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Role')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Role Name'])}}
        </div>
        <h5>Assign permissions for the role</h5>
        <div class="form-group checkbox row">
            <ul>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="ch" id="checkAll">&nbsp;<label for="checkAll" style="top:5px;left:-20px;position: relative;">Select All</label><br><br>
                </div>
                @if(!$admin->type==0)
                    @foreach($admin->admin_role->role->role_crudables as $role_crudable)
                        <div class="subc">
                            <li><b>{{$role_crudable->crudable->name}}</b></li>
                            @if($role_crudable->permission->r)
                                <br><input type="checkbox" class="ch" id="permission[{{$role_crudable->crudable->id}}][r]" name="permission[{{$role_crudable->crudable->id}}][r]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$role_crudable->crudable->id}}][r]">Read</lable><br><br>
                            @endif
                            @if($role_crudable->permission->c)
                                <input type="checkbox" class="ch" id="permission[{{$role_crudable->crudable->id}}][c]" name="permission[{{$role_crudable->crudable->id}}][c]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$role_crudable->crudable->id}}][c]">{{($role_crudable->crudable->name=='trash')?'Restore':'Create'}}</lable><br><br>
                            @endif
                            @if($role_crudable->permission->u)
                                <input type="checkbox" class="ch" id="permission[{{$role_crudable->crudable->id}}][u]" name="permission[{{$role_crudable->crudable->id}}][u]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$role_crudable->crudable->id}}][u]">Update</lable><br><br>
                            @endif
                            @if($role_crudable->permission->d)
                                <input type="checkbox" class="ch" id="permission[{{$role_crudable->crudable->id}}][d]" name="permission[{{$role_crudable->crudable->id}}][d]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$role_crudable->crudable->id}}][d]">Delete</lable>
                            @endif
                        </div>
                    @endforeach
                @else
                    @foreach($crudables as $crudable)
                        @if($crudable->name!='company' && $crudable->name!='super_admin')
                            <div class="subc">
                                <li><b>{{$crudable->name}}</b></li>
                                    <br><input type="checkbox" class="ch" id="permission[{{$crudable->id}}][r]" name="permission[{{$crudable->id}}][r]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$crudable->id}}][r]">Read</lable><br><br>
                                    <input type="checkbox" class="ch" id="permission[{{$crudable->id}}][c]" name="permission[{{$crudable->id}}][c]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$crudable->id}}][c]">{{($crudable->name=='trash')?'Restore':'Create'}}</lable><br><br>
                                    <input type="checkbox" class="ch" id="permission[{{$crudable->id}}][u]" name="permission[{{$crudable->id}}][u]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$crudable->id}}][u]">Update</lable><br><br>
                                    @if($crudable->name!='employee')
                                        <input type="checkbox" class="ch" id="permission[{{$crudable->id}}][d]" name="permission[{{$crudable->id}}][d]">&nbsp;<lable style="top:5px;position: relative;" for="permission[{{$crudable->id}}][d]">Delete</lable>
                                    @endif
                            </div>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="row">
            {{Form::submit('Submit', ['class' => 'btn btn-primary','id'=>'sb'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('custom-js')
    <script type="text/javascript">
        $(function () {
            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked',this.checked);
            });
        });
    </script>
@endsection
