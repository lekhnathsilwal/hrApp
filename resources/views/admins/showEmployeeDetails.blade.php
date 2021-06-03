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
                    Profile
                </h2>
                <small></small>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content">
        @include('includes.message')
        @if($employee)
            <div class="row">
                <div class="col-lg-4">
                    <div class="hpanel hgreen">
                        <div class="panel-body">
                            <img alt="logo"
                                 style="{{($employee->status==0)?'opacity:0.4;':''}}height: 100px;width: 100px;"
                                 class="img-circle m-b"
                                 src="{{url('/uploads/employee/profile_picture/'.$employee->profile_picture)}}">
                            <h3><a href="">{{$employee->name}}</a></h3>
                            <div class="text-muted font-bold m-b-xs">{{$employee->email}}</div>
                            <div class="text-muted font-bold m-b-xs">{{$employee->contact}}</div>
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
                                <dt>Address:</dt>
                                <dd>{{$employee->address}}</dd>
                                <dt>Gender:</dt>
                                <dd>{{$employee->gender}}</dd>
                                <dt>Date of Birth:</dt>
                                <dd>{{$employee->dob}}</dd>
                                @if($employee->status==0)
                                    @if($employee->deleted_by && ((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0))
                                        <dt>Deleted By:</dt>
                                        <dd>
                                            <a href="{{route('show.admin.details',['id'=>$employee->deleted_by])}}">{{$employee->deleted_admin->name}}</a>
                                        </dd>
                                    @endif
                                    <dt>Deleted At:</dt>
                                    <dd>{{$employee->updated_at}}</dd>
                                @endif
                            </dl>
                        </div>
                        <div class="panel-footer contact-footer">
                            <div class="row">
                                @if(!Auth::guard('admin')->user()->type==0)
                                    @if($permission['employee']['u']==1)
                                        @foreach($employee->employee_histories->where('status',1)->where('resigned_date',null)->unique('company_id') as $employee_history)
                                            @if($employee_history->company_id==Auth::guard('admin')->user()->company_id)
                                                <div class="col-md-4 border-right">
                                                    <div class="contact-stat"><strong><a title="Edit"
                                                                                         href="{{route('edit.employee',['id'=>$employee->id])}}"><i
                                                                    class="fa fa-edit"></i></strong><span>Edit </span></a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                @if($employee->status==0 && array_key_exists('trash',$permission))
                                    @if($permission['trash']['c']==1 && $permission['employee']['c']==1)
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><a title="Restore"
                                                                         href="{{route('restore.employee',['id'=>$employee->id])}}">
                                                    <strong><i class="fa fa-undo"></i></strong><span>Restore</span></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($permission['trash']['d']==1 && $permission['employee']['d']==1)
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><a title="Permanent Delete"
                                                                         href="{{route('permanent.delete.employee',['id'=>$employee->id])}}">
                                                    <strong><i
                                                            class="fa fa-trash"></i></strong><span>Permanent Delete </span></a>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @if($permission['employee']['d']==1)
                                        <div class="col-md-4 border-right">
                                            <div class="contact-stat"><a title="Delete"
                                                                         href="{{route('delete.employee',['id'=>$employee->id])}}">
                                                    <strong><i class="fa fa-trash"></i>
                                                    </strong><span>Delete </span></a>
                                            </div>
                                        </div>
                                    @endif
                                    @if(((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['c']==1)?1:0):0) && !Auth::guard('admin')->user()->type==0)
                                        <div class="col-md-4">
                                            <div class="contact-stat"><a title="Details"
                                                                         href="{{route('add.experience',['id'=>$employee->id])}}"><strong><i
                                                            class="fa fa-plus"></i>
                                                    </strong><span>Add new experience</span></a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($employee->employee_histories)>0 && ((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0))
                <div class="col-lg-12">
                    <div class="hpanel">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                            </div>
                            {{$employee->name}}'s history
                        </div>
                        <div class="panel-body">
                            <table id="example2" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">S.N.</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Joined Date</th>
                                    <th scope="col">Resigned_date</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Update</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $count=1; @endphp
                                @foreach($employee->employee_histories as $history)
                                    @if($history->status==1)
                                        <tr>
                                            <th scope="row">{{$count++}}</th>
                                            <td>{{$history->company->name}}</td>
                                            <td>{{$history->position}}</td>
                                            <td>{{$history->department->name}}</td>
                                            <td>{{$history->section->name}}</td>
                                            <td>{{$history->joined_date}}</td>
                                            <td>{{$history->resigned_date}}</td>
                                            <td><a href="{{route('experience.detail',['id'=>$history->id])}}">View
                                                    detail</a></td>
                                            <td>
                                                @if($history->company_id==Auth::guard('admin')->user()->company_id)
                                                    @if(!Auth::guard('admin')->user()->type==0)
                                                        @if($permission['employee_experience']['u'])
                                                            <a href="{{route('edit.experience',[$history->id])}}"><i
                                                                    class="fa fa-edit" title="Edit">&nbsp; Edit</i></a>
                                                        @endif
                                                    @endif
                                                    @if($permission['employee_experience']['d'])
                                                        <i class="fa fa-trash" style="cursor:pointer;" role="button"
                                                           title="Delete" data-toggle="modal"
                                                           data-target="#exampleModalCenter{{$history->id}}">&nbsp;Delete</i>
                                                    @endif
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalCenter{{$history->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Delete</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do you want to delete {{$history->id}}??
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <a href="{{route('delete.experience',['id'=>$history->id])}}">
                                                                        <button type="button" style="padding: 5px;"
                                                                                class="bth btn-danger">Delete
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <i class="fa fa-ban">&emsp;N/A</i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <p>No admins are here</p>
        @endif
    </div>
@endsection
@section('custom-js')
    <script>
        $(function () {
            // Initialize Example 2
            $('#example2').dataTable();
        });
    </script>
@endsection
