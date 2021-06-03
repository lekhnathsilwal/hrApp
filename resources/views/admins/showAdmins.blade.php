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
                    Admins
                </h2>
                <small>Admins in your company</small>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content">
        @include('includes.message')
        @if(count($admins)>0)
            <div class="row">
                @foreach($admins as $admin)
                    <div class="col-lg-3">
                        <div class="hpanel hgreen contact-panel">
                            <div class="panel-body">
                                @if($trash==1)
                                    @if($admin->type==1 && Auth::guard('admin')->user()->type!=0)
                                    @else
                                        @if(((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0) && $permission['admin']['c']==1)
                                            <span class="pull-right">
                                                <a href="{{route('restore.admin',['id'=>$admin->id])}}"><i title="Restore" class="fa fa-undo"></i></a>
                                            </span>
                                        @endif
                                    @endif
                                @endif
                                <img alt="logo" class="img-circle m-b" style="{{($admin->status==0)?'opacity:0.4;':''}}"
                                     src="{{($admin->profile_picture=="nopp.jpg")?url('/img/avatar/'.$admin->profile_picture):url('/uploads/admin/profile_picture/'.$admin->profile_picture)}}">
                                <h3><a href="{{route('show.admin.details',['id'=>$admin->id])}}"> {{$admin->name}} </a>
                                </h3>
                                    @if(!$admin->type==0)
                                        <div class="text-muted font-bold m-b-xs">{{$admin->position}}
                                        at {{$admin->company->name}}</div>
                                    @endif
                                <p>
                                    {{$admin->email}}<br>
                                    {{$admin->contact}}
                                </p>
                            </div>
                            <div class="panel-footer contact-footer">
                                <div class="row">
                                    @if($permission['admin']['u']==1)
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><strong><a title="Edit" href="{{($admin->type==0)?route('edit.super.admin',['id'=>$admin->id]):route('edit.admin',['id'=>$admin->id])}}"><i class="fa fa-edit"></i></strong><span>Edit </span></a> </div>
                                        </div>
                                    @endif
                                    @if(Auth::guard('admin')->user()->type!=0 && $admin->type==1)
                                    @else
                                        @if(Auth::guard('admin')->user()->id!=$admin->id)
                                            @if($trash==1)
                                                @if(((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0) && $permission['admin']['d']==1)
                                                    <div class="col-md-4 border-right">
                                                        <div class="contact-stat"><a title="Permanent Delete" href="{{route('permanent.delete.admin',['id'=>$admin->id])}}">
                                                                <strong><i class="fa fa-trash"></i></strong><span>Permanent Delete </span></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                @if($permission['admin']['d']==1)
                                                    <div class="col-md-4 border-right">
                                                        <div class="contact-stat"><a title="Delete" href="{{route('delete.admin',['id'=>$admin->id])}}">
                                                                <strong><i class="fa fa-trash"></i> </strong><span>Delete </span></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    <div class="col-md-4">
                                        <div class="contact-stat"><a title="Details" href="{{route('show.admin.details',['id'=>$admin->id])}}"><strong><i class="fa fa-info-circle"></i>
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
            <p>No admins are here</p>
        @endif
        @if($trash==0)
            @if(!Auth::guard('admin')->user()->type==0)
                @if($permission['admin']['c']==1)
                    <a href="{{route('admin.register')}}" role="button" class="btn btn-success"><i class="fa fa-plus"> Add
                            Admin</i></a>
                @endif
            @else
                <a href="{{route('super.admin.register')}}" role="button" class="btn btn-success"><i class="fa fa-plus"> Add Super Admin</i> </a>
            @endif
        @endif
    </div>
@endsection
