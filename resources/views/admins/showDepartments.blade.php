@extends('layouts.app')
@section('custom-css')
    <style>
        .col-lg-3 img {
            height: 150px;
            opacity: 0.8;
            float: left;
            width: 100%;
        }

        .col-lg-3 img:hover {
            opacity: 1;
        }

        .fa {
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="content animate-panel">
        @include('includes.message')
        @if(count($departments)>0)
            <div class="row">
                @foreach($departments as $department)
                    <div class="col-lg-3">
                        <div class="hpanel">
                            <div class="panel-body text-center h-200">
                                @if(((array_key_exists('section',$permission))?(($permission['section']['r']==1)?1:0):0))
                                    <a href="{{($trash==1)?route('show.trash.department.sections',['id'=>$department->id]):route('show.sections',['id'=>$department->id])}}">
                                        <img style="{{($department->status==0)?'opacity:0.4;':''}}"
                                             src="{{url('/uploads/departments/'.$department->image)}}">
                                        <h3 class="font-extra-bold no-margins text-success">
                                            {{$department->name}}
                                        </h3></a>
                                @else
                                    <img style="{{($department->status==0)?'opacity:0.4;':''}}"
                                         src="{{url('/uploads/departments/'.$department->image)}}">
                                    <h3 class="font-extra-bold no-margins text-success">
                                        {{$department->name}}
                                    </h3>
                                @endif
                                <small>{{substr($department->description,0,30)}}...<a data-toggle="modal"
                                                                                      data-target="#myModal{{$department->id}}">view
                                        detail</a></small>
                                <div class="modal fade" id="myModal{{$department->id}}" tabindex="-1" role="dialog"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="color-line"></div>
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{$department->name}}</h4>
                                                @if($trash==1)
                                                    @if((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0)
                                                        @if($department->deleted_by)
                                                            <b>Deleted By : </b><a
                                                                href="{{route('show.admin.details',['id'=>$department->deleted_by])}}">{{$department->deleted_admin->name}}</a>
                                                        @endif
                                                    @endif
                                                    <br><b>Deleted At : </b> {{$department->updated_at}}
                                                @endif
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$department->description}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                @if($permission['department']['u']==1)
                                    <a href="{{route('edit.department',['id'=>$department->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&emsp;
                                @endif
                                @if($department->status==0 && array_key_exists('trash',$permission))
                                    @if($permission['trash']['c']==1 && $permission['department']['c']==1)
                                        <a href="{{route('restore.department',['id'=>$department->id])}}"><i
                                            class="fa fa-undo">&nbsp;Restore</i></a>&emsp;
                                    @endif
                                    @if($permission['trash']['d']==1 && $permission['department']['d']==1)
                                        <a href="{{route('permanent.delete.department',['id'=>$department->id])}}"><i
                                            class="fa fa-trash">&nbsp;Permanent Delete</i></a>
                                    @endif
                                @else
                                    @if($permission['department']['d']==1)
                                        <a href="{{route('delete.department',['id'=>$department->id])}}"><i
                                            class="fa fa-trash">&nbsp;Delete</i></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No any Departments are here</p>
        @endif
        @if(Auth::guard('admin')->user()->type!=0)
            @if($permission['department']['c']==1)
                @if($trash==0)
                    <a href="{{route('add.department')}}" role="button" class="btn btn-success">Add Department</a>
                @endif
            @endif
        @endif
    </div>
@endsection
