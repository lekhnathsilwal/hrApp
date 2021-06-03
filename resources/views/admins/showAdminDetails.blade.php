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
                    Admin Profile
                </h2>
                <small></small>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content">
        @include('includes.message')
        @if($admin)
            <div class="row">
                <div class="col-lg-4">
                    <div class="hpanel hgreen">
                        <div class="panel-body">
                            <img alt="logo" style="{{($admin->status==0)?'opacity:0.4;':''}}height: 100px;width: 100px;" class="img-circle m-b" src="{{($admin->profile_picture=="nopp.jpg")?url('/img/avatar/'.$admin->profile_picture):url('/uploads/admin/profile_picture/'.$admin->profile_picture)}}">
                            <h3><a href="">{{$admin->name}}</a></h3>
                            <div class="text-muted font-bold m-b-xs">{{$admin->email}}</div>
                            <div class="text-muted font-bold m-b-xs">{{$admin->contact}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hpanel hgreen">
                        <div class="panel-body">
                            <div class="pull-right text-right">
                                <div class="btn-group">
                                    <i class="fa fa-facebook btn btn-default btn-xs"></i>
                                    <i class="fa fa-twitter btn btn-default btn-xs"></i>
                                    <i class="fa fa-linkedin btn btn-default btn-xs"></i>
                                </div>
                            </div>
                            <dl>
                                <dt>Gender: </dt>
                                <dd>{{$admin->gender}}</dd>
                                @if(!$admin->type==0)
                                    <dt>Company: </dt>
                                    <dd>{{$admin->company->name}}</dd>
                                    <dt>Position: </dt>
                                    <dd>{{$admin->position}}</dd>
                                    <dt>Role: </dt>
                                    <dd>{{$admin->admin_role->role->name}}</dd>
                                @endif
                                @if($admin->status==0)
                                    @if($admin->deleted_by)
                                        @if($permission['admin']['r']==1)
                                            <dt>Deleted By: </dt>
                                            <dd><a href="{{route('show.admin.details',['id'=>$admin->deleted_by])}}">{{$admin->deleted_admin->name}}</a></dd>
                                        @endif
                                    @endif
                                    <dt>Deleted At: </dt>
                                    <dd>{{$admin->updated_at}}</dd>
                                @endif
                            </dl>
                        </div>
                        <div class="panel-footer contact-footer">
                            <div class="row">
                                @if(Auth::guard('admin')->user()->type==0 && $admin->type!=0)
                                @else
                                    @if($permission['admin']['u']==1)
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><strong><a title="Edit" href="{{($admin->type==0)?route('edit.super.admin',['id'=>$admin->id]):route('edit.admin',['id'=>$admin->id])}}"><i class="fa fa-edit"></i></strong><span>Edit </span></a> </div>
                                        </div>
                                    @endif
                                @endif
                                @if($admin->status==0)
                                    @if(array_key_exists('trash',$permission))
                                        @if($permission['trash']['c']==1 && $permission['admin']['c']==1)
                                            <div class="col-md-4 border-right">
                                                <div class="contact-stat"><a title="Restore" href="{{route('restore.admin',['id'=>$admin->id])}}">
                                                        <strong><i class="fa fa-undo"></i></strong><span>Restore</span></a>
                                                </div>
                                            </div>
                                        @endif
                                        @if($permission['trash']['d']==1 && $permission['admin']['d']==1 && Auth::guard('admin')->user()->id!=$admin->id)
                                            <div class="col-md-4 border-right">
                                                <div class="contact-stat"><a title="Permanent Delete" href="{{route('permanent.delete.admin',['id'=>$admin->id])}}">
                                                        <strong><i class="fa fa-trash"></i></strong><span>Permanent Delete </span></a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if($permission['admin']['d']==1 && Auth::guard('admin')->user()->id!=$admin->id)
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><a title="Delete" href="{{route('delete.admin',['id'=>$admin->id])}}">
                                                    <strong><i class="fa fa-trash"></i> </strong><span>Delete </span></a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>No admins are here</p>
        @endif
    </div>
@endsection
