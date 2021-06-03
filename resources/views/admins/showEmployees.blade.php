@extends('layouts.app')
@section('custom-css')
    <style>
        .fa {
            font-size: 15px;
        }
    </style>
@endsection
@section('content_header')
    <div class="normalheader ">
        <div class="hpanel">
            <div class="panel-body">
                <a class="small-header-action" href="">
                    <div class="clip-header">
                        <i class="fa fa-arrow-up"></i>
                    </div>
                </a>
                <h2 class="font-light m-b-xs">
                    {{($trash==1)?'Trashed ':''}}
                    Employees
                </h2>
                <small>All employees are here</small>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content">
        @include('includes.message')
        @if(count($employees)>0)
            <div class="row">
                @foreach($employees as $employee)
                    <div class="col-lg-3">
                        <div class="hpanel hgreen contact-panel">
                            <div class="panel-body">
                                @if($employee->status==0 && (((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0) && $permission['employee']['c']==1))
                                    <span class="pull-right">
                                        <a href="{{route('restore.employee',['id'=>$employee->id])}}"><i title="Restore" class="fa fa-undo"></i></a>
                                    </span>
                                @endif
                                <img style="{{($employee->status==0)?'opacity:0.4':''}}" alt="logo" class="img-circle m-b"
                                     src="{{url('/uploads/employee/profile_picture/'.$employee->profile_picture)}}">
                                <h3><a href="{{route('show.employee.details',['id'=>$employee->id])}}"> {{$employee->name}} </a>
                                </h3>
                                <div class="text-muted font-bold m-b-xs">{{$employee->email}}</div>
                                <p>
                                    {{$employee->contact}}
                                </p>
                            </div>
                            <div class="panel-footer contact-footer">
                                <div class="row">
                                    @if(Auth::guard('admin')->user()->type!=0 && $permission['employee']['u']==1)
                                        @foreach($employee->employee_histories->where('status',1)->where('resigned_date',null)->unique('company_id') as $employee_history)
                                            @if($employee_history->company_id==Auth::guard('admin')->user()->company_id)
                                                <div class="col-md-4 border-right">
                                                    <div class="contact-stat"><strong><a title="Edit" href="{{route('edit.employee',['id'=>$employee->id])}}"><i class="fa fa-edit"></i></strong><span>Edit </span></a> </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if($trash==1 && (((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0) && $permission['employee']['d']==1))
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><a title="Permanent Delete" href="{{route('permanent.delete.employee',['id'=>$employee->id])}}">
                                                    <strong><i class="fa fa-trash"></i></strong><span>Permanent Delete </span></a>
                                            </div>
                                        </div>
                                    @else
                                        @if($permission['employee']['d']==1)
                                            <div class="col-md-4 border-right">
                                                <div class="contact-stat"><a title="Delete" href="{{route('delete.employee',['id'=>$employee->id])}}">
                                                        <strong><i class="fa fa-trash"></i> </strong><span>Delete </span></a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-4">
                                        <div class="contact-stat"><a title="Details" href="{{route('show.employee.details',['id'=>$employee->id])}}"><strong><i class="fa fa-info-circle"></i>
                                                </strong><span>View detail </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No employees are here</p>
        @endif
        @if($trash==0 && Auth::guard('admin')->user()->type!=0 && $permission['employee']['c']==1)
            <a href="{{route('add.employee')}}" role="button" class="btn btn-success"><i class="fa fa-plus"> Add
                Employee</i></a>
        @endif
    </div>
@endsection
