@extends('layouts.app')
@section('custom-css')
    <style>
        .col-md-4 img {
            height: 250px;
            float: left;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @include('includes.message')
        <p>
            <br>
            <h4><b>{{$history->employee->name}}</b></h4><br>
            <h5><b>Company :</b></h5>{{$history->company->name}}<br>
            <h5><b>Position :</b></h5>{{$history->position}}<br>
            <h5><b>Department :</b></h5>{{$history->department->name}}<br>
            <h5><b>Section :</b></h5>{{$history->section->name}}<br>
            @php
                $shift_from=explode(':',$history->shift_from);
                $shift_to=explode(':',$history->shift_to);
            @endphp
            <h5><b>Shift :</b></h5>{{$shift_from[0]}}:{{$shift_from[1]}}-{{$shift_to[0]}}:{{$shift_to[1]}}<br>
            <h5><b>Joined Date :</b></h5>{{$history->joined_date}}<br>
            <h5><b>Resigned_date :</b></h5>{{$history->resigned_date}}<br>
            @if((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0)
                <h5><b>Supervisor Name :</b></h5>
                <a href="{{route('show.admin.details',['id'=>$history->supervisor->id])}}">{{$history->supervisor->name}}</a><br>
            @endif
            <h5><b>Review :</b></h5>{{$history->review}}<br>
            @if($history->status==0)
                @if($history->deleted_by && ((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0))
                    <h5><b>Deleted By: </b></h5><a href="{{route('show.admin.details',['id'=>$history->deleted_by])}}">{{$history->deleted_admin->name}}</a><br>
                @endif
                <h5><b>Deleted At:</b></h5>{{$history->updated_at}}<br>
            @endif
            @if($history->company_id==Auth::guard('admin')->user()->company_id)
                <b>Update :</b><br>
                @if(!Auth::guard('admin')->user()->type==0)
                    @if($permission['employee_experience']['u'])
                        <a href="{{route('edit.experience',[$history->id])}}"><i class="fa fa-edit" title="Edit">&nbsp; Edit</i></a>
                    @endif
                @endif
                @if($history->status==0 && ((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0) && $permission['employee_experience']['c'])
                    <a href="{{route('restore.experience',['id'=>$history->id])}}"><i class="fa fa-undo">&nbsp;Restore</i> </a>
                @endif
                @if($permission['employee_experience']['d']==1)
                    <i class="fa fa-trash" style="cursor:pointer;" role="button" title="Delete" data-toggle="modal"
                       data-target="#exampleModalCenter{{$history->id}}">&nbsp;{{($history->status==0 && ((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0))?'Permanent':''}}&nbsp;Delete</i>
                @endif
            @endif
        </p>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter{{$history->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you want to delete {{$history->id}}??
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($history->status==0 && ((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0))
                            <a href="{{route('permanent.delete.experience',['id'=>$history->id])}}">
                                <button type="button" style="padding: 5px;" class="bth btn-danger">Permanent Delete</button>
                            </a>
                        @else
                            <a href="{{route('delete.experience',['id'=>$history->id])}}">
                                <button type="button" style="padding: 5px;" class="bth btn-danger">Delete</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
