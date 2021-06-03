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
        .fa{
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="content animate-panel">
        @include('includes.message')
        @if(count($sections)>0)
            <div class="row">
                @foreach($sections as $section)
                    <div class="col-lg-3">
                        <div class="hpanel">
                            <div class="panel-body text-center h-200">
                                @if(((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0) || ((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0))
                                    <a href="{{($trash==1 && ((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0))?route('show.trash.section.histories',['id'=>$section->id]):route('show.sectionEmployees',['id'=>$section->id])}}">
                                        <img style="{{($section->status==0)?'opacity:0.4;':''}}" src="{{url('/uploads/sections/'.$section->image)}}">
                                        <h3 class="font-extra-bold no-margins text-success">
                                            {{$section->name}}
                                        </h3></a>
                                @else
                                    <img style="{{($section->status==0)?'opacity:0.4;':''}}" src="{{url('/uploads/sections/'.$section->image)}}">
                                    <h3 class="font-extra-bold no-margins text-success">
                                        {{$section->name}}
                                    </h3>
                                @endif
                                <small>{{substr($section->description,0,30)}}...<a data-toggle="modal" data-target="#myModal{{$section->id}}">view detail</a></small>
                                <div class="modal fade" id="myModal{{$section->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="color-line"></div>
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{$section->name}}</h4>
                                                @if($trash==1)
                                                    @if($section->deleted_by && ((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0))
                                                        <b>Deleted By : </b><a
                                                            href="{{route('show.admin.details',['id'=>$section->deleted_by])}}">{{$section->deleted_admin->name}}</a>
                                                    @endif
                                                    <br><b>Deleted At : </b> {{$section->updated_at}}
                                                @endif
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$section->description}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                @if($permission['section']['u']==1)
                                    <a href="{{route('edit.section',['id'=>$section->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&emsp;
                                @endif
                                @if($section->status==0 && array_key_exists('trash',$permission))
                                    @if($permission['trash']['c']==1 && $permission['section']['c']==1)
                                        <a href="{{route('restore.section',['id'=>$section->id])}}"><i class="fa fa-undo">&nbsp;Restore</i></a>&emsp;
                                    @endif
                                    @if($permission['trash']['d']==1 && $permission['section']['d']==1)
                                        <a href="{{route('permanent.delete.section',['id'=>$section->id])}}"><i class="fa fa-trash">&nbsp;Permanent Delete</i></a>
                                    @endif
                                @else
                                    @if($permission['section']['d']==1)
                                        <a href="{{route('delete.section',['id'=>$section->id])}}"><i class="fa fa-trash">&nbsp;Delete</i></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No any sections are here</p>
        @endif
        @if($trash==0)
            @if($permission['section']['c']==1 && Auth::guard('admin')->user()->type!=0)
                <a href="{{route('add.section',['id'=>$department->id])}}" role="button" class="btn btn-success">Add Section</a>
            @endif
        @endif
    </div>
@endsection
