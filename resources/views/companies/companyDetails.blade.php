@extends('layouts.app')
@section('content')
    <div class="content">
        @include('includes.message')
        <div class="hpanel">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" href="#tab-1" aria-expanded="false">Admin</a></li>
                <li><a data-toggle="tab" href="#tab-2" aria-expanded="true">Employee</a></li>
                <li><a data-toggle="tab" href="#tab-3" aria-expanded="true">Roles</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <small class="text-muted">Trash<b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated flipInX m-t-xs">
                        <li><a data-toggle="tab" href="#tab-4">Admin</a></li>
                        <li><a data-toggle="tab" href="#tab-5">Employee</a></li>
                        <li><a data-toggle="tab" href="#tab-6">Employee Histories</a></li>
                        <li><a data-toggle="tab" href="#tab-7">Roles</a></li>
                    </ul>
                </li>
            </ul>
            <div class="tab-content">
{{-- ----------------------------------------Active------------------------------------------------ --}}
{{-- ----------------------------------------Admins------------------------------------------------ --}}
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <h3>Admins of {{$company->name}}</h3>
                        @if(count($company->admins->where('status',1))>0)
                            <div class="row">
                                @foreach($company->admins as $admin)
                                    @if($admin->status==1)
                                        <div class="col-lg-3">
                                            <div class="hpanel hgreen contact-panel">
                                                <div class="panel-body">
                                                    @if($admin->type==1)
                                                        <span class="label label-warning pull-right">Super Admin</span>
                                                    @endif
                                                    <img alt="logo" class="img-circle m-b"
                                                         src="{{($admin->profile_picture=="nopp.jpg")?url('/img/avatar/'.$admin->profile_picture):url('/uploads/admin/profile_picture/'.$admin->profile_picture)}}">
                                                    <h3>
                                                        <a href="{{route('show.admin.details',['id'=>$admin->id])}}"> {{$admin->name}} </a>
                                                    </h3>
                                                    <div class="text-muted font-bold m-b-xs">{{$admin->position}}
                                                        at {{$admin->company->name}}</div>
                                                    <p>
                                                        {{$admin->email}}<br>
                                                        {{$admin->contact}}
                                                    </p>
                                                </div>
                                                <div class="panel-footer contact-footer">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <div class="contact-stat"><a title="Delete"
                                                                                         href="{{route('delete.admin',['id'=>$admin->id])}}">
                                                                    <strong><i class="fa fa-trash"></i> </strong><span>Delete </span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="contact-stat"><a title="Details"
                                                                                         href="{{route('show.admin.details',['id'=>$admin->id])}}"><strong><i
                                                                            class="fa fa-info-circle"></i>
                                                                    </strong><span>View detail </span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>No active admins in {{$company->name}}</p>
                        @endif
                        <a href="{{route('company.admin.register',['id'=>$company->id])}}" role="button" class="btn btn-success"><i class="fa fa-plus"> Add
                                Admin</i></a>
                    </div>
                </div>
{{-- ------------------------------------End of Admins--------------------------------------- --}}

{{-- ------------------------------------Employees------------------------------------------- --}}
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <h3>Employees of {{$company->name}}</h3>
                        @if(count($company->employee_histories)>0)
                            @if(count($company->employee_histories->where('status',1)->where('resigned_date',null))>0)
                                <div class="row">
                                    @foreach($company->employee_histories->where('status',1)->where('resigned_date',null)->unique('employee_id') as $employee_history)
                                        @if($employee_history->employee->status==1)
                                            @php $employee=$employee_history->employee; @endphp
                                            <div class="col-lg-3">
                                                <div class="hpanel hgreen contact-panel">
                                                    <div class="panel-body">
                                                        <img alt="logo" class="img-circle m-b"
                                                             src="{{url('/uploads/employee/profile_picture/'.$employee->profile_picture)}}">
                                                        <h3>
                                                            <a href="{{route('show.employee.details',['id'=>$employee->id])}}"> {{$employee->name}} </a>
                                                        </h3>
                                                        <div
                                                            class="text-muted font-bold m-b-xs">{{$employee->email}}</div>
                                                        <p>
                                                            {{$employee->contact}}
                                                        </p>
                                                    </div>
                                                    <div class="panel-footer contact-footer">
                                                        <div class="row">
                                                            <div class="col-md-4 border-right">
                                                                <div class="contact-stat"><a title="Delete"
                                                                                             href="{{route('delete.employee',['id'=>$employee->id])}}">
                                                                        <strong><i class="fa fa-trash"></i>
                                                                        </strong><span>Delete </span></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="contact-stat"><a title="Details"
                                                                                             href="{{route('show.employee.details',['id'=>$employee->id])}}"><strong><i
                                                                                class="fa fa-info-circle"></i>
                                                                        </strong><span>View detail </span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p>There is no any active employee</p>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <p>No any active employee history associated with this company</p>
                            @endif
                        @else
                            <p>No employees are here</p>
                        @endif
                    </div>
                </div>
{{-- -----------------------------End of Employees---------------------------------------- --}}

{{-- -----------------------------------Roles--------------------------------------------- --}}
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <h3>Roles of {{$company->name}}</h3>
                        @php $roles=[]; @endphp
                        @foreach($company->admins as $admin)
                            @foreach($admin->created_roles as $created_role)
                                @if($created_role->status==1)
                                    @php $roles[][]=$created_role; @endphp
                                @endif
                            @endforeach
                        @endforeach
                        @if(count($roles)>0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="hpanel">
                                        <div class="panel-heading">
                                            <div class="panel-tools">
                                                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                                            </div>
                                            Roles in {{$company->name}}
                                        </div>
                                        <div class="panel-body">
                                            <table id="example2" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Role</th>
                                                    <th>Admins</th>
                                                    <th>Update</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $count=1; @endphp
                                                @foreach($roles as $role)
                                                    @foreach($role as $rl)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td>{{$rl->name}}</td>
                                                            <td>
                                                                @foreach($rl->admin_roles as $admin_role)
                                                                    <a href="{{route('show.admin.details',['id'=>$admin_role->admin->id])}}">{{$admin_role->admin->name}}
                                                                        ,</a>&nbsp;
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-trash" style="cursor:pointer;"
                                                                   role="button"
                                                                   title="Delete Role" data-toggle="modal"
                                                                   data-target="#exampleModalCenter{{$rl->id}}">&nbsp;
                                                                    delete</i>
                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                     id="exampleModalCenter{{$rl->id}}" tabindex="-1"
                                                                     role="dialog"
                                                                     aria-labelledby="exampleModalCenterTitle"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                         role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">
                                                                                    Delete</h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            @if(count($rl->admin_roles)>0)
                                                                                <div class="modal-body">
                                                                                    {{count($rl->admin_roles)}} Users
                                                                                    are assigned with this
                                                                                    role, first change their role to
                                                                                    other to delete this role.
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Ok
                                                                                    </button>
                                                                                </div>
                                                                            @else
                                                                                <div class="modal-body">
                                                                                    Do you want to delete??
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Close
                                                                                    </button>
                                                                                    <a href="{{route('delete.role',['id'=>$rl->id])}}">
                                                                                        <button type="button"
                                                                                                style="padding: 5px;"
                                                                                                class="bth btn-danger">
                                                                                            Delete
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>There are no any active roles in {{$company->name}}</p>
                        @endif
                    </div>
                </div>
{{-- -----------------------------End of Roles--------------------------------------- --}}

{{-- --------------------------------Trashed----------------------------------------- --}}
{{-- -----------------------------Trashed Admins------------------------------------- --}}
                <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <h3>Trashed Admins of {{$company->name}}</h3>
                        @if(count($company->admins->where('status',0))>0)
                            <div class="row">
                                @foreach($company->admins as $admin)
                                    @if($admin->status==0)
                                        <div class="col-lg-3">
                                            <div class="hpanel hgreen contact-panel">
                                                <div class="panel-body">
                                                    <span class="pull-right">
                                                            <a href="{{route('restore.admin',['id'=>$admin->id])}}"><i
                                                                    title="Restore" class="fa fa-undo"></i></a>
                                                    </span>
                                                    <img alt="logo" style="opacity: 0.4" class="img-circle m-b"
                                                         src="{{($admin->profile_picture=="nopp.jpg")?url('/img/avatar/'.$admin->profile_picture):url('/uploads/admin/profile_picture/'.$admin->profile_picture)}}">
                                                    <h3>
                                                        <a href="{{route('show.admin.details',['id'=>$admin->id])}}"> {{$admin->name}} </a>
                                                    </h3>
                                                    <div class="text-muted font-bold m-b-xs">{{$admin->position}}
                                                        at {{$admin->company->name}}</div>
                                                    <p>
                                                        {{$admin->email}}<br>
                                                        {{$admin->contact}}
                                                    </p>
                                                </div>
                                                <div class="panel-footer contact-footer">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <div class="contact-stat"><a title="Delete"
                                                                                         href="{{route('permanent.delete.admin',['id'=>$admin->id])}}">
                                                                    <strong><i class="fa fa-trash"></i> </strong><span>Permanent Delete </span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="contact-stat"><a title="Details"
                                                                                         href="{{route('show.admin.details',['id'=>$admin->id])}}"><strong><i
                                                                            class="fa fa-info-circle"></i>
                                                                    </strong><span>View detail </span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>No any trashed admins in {{$company->name}}</p>
                        @endif
                    </div>
                </div>
{{-- -----------------------------End of Trahsed Admins--------------------------------- --}}

{{-- -----------------------------Trashed Employees------------------------------------- --}}
                <div id="tab-5" class="tab-pane">
                    <div class="panel-body">
                        <h3>Trashed Employees of {{$company->name}}</h3>
                        @if(count($company->employee_histories)>0)
                            <div class="row">
                                @php $cnt=0; @endphp
                                @foreach($company->employee_histories->where('resigned_date',null)->unique('employee_id') as $employee_history)
                                    @if($employee_history->employee->status==0)
                                        @php $cnt++; @endphp
                                        @php $employee=$employee_history->employee; @endphp
                                        <div class="col-lg-3">
                                            <div class="hpanel hgreen contact-panel">
                                                <div class="panel-body">
                                                    <span class="pull-right">
                                                        <a href="{{route('restore.employee',['id'=>$employee->id])}}"><i title="Restore" class="fa fa-undo"></i></a>
                                                    </span>
                                                    <img alt="logo" class="img-circle m-b" style="opacity: 0.4;"
                                                         src="{{url('/uploads/employee/profile_picture/'.$employee->profile_picture)}}">
                                                    <h3>
                                                        <a href="{{route('show.employee.details',['id'=>$employee->id])}}"> {{$employee->name}} </a>
                                                    </h3>
                                                    <div
                                                        class="text-muted font-bold m-b-xs">{{$employee->email}}</div>
                                                    <p>
                                                        {{$employee->contact}}
                                                    </p>
                                                </div>
                                                <div class="panel-footer contact-footer">
                                                    <div class="row">
                                                        <div class="col-md-4 border-right">
                                                            <div class="contact-stat"><a title="Delete"
                                                                                         href="{{route('permanent.delete.employee',['id'=>$employee->id])}}">
                                                                    <strong><i class="fa fa-trash"></i>
                                                                    </strong><span>Delete </span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="contact-stat"><a title="Details"
                                                                                         href="{{route('show.employee.details',['id'=>$employee->id])}}"><strong><i
                                                                            class="fa fa-info-circle"></i>
                                                                    </strong><span>View detail </span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @if($cnt==0)
                                    <p>There is no any trashed employee</p>
                                @endif
                            </div>
                        @else
                            <p>No employees are here</p>
                        @endif
                    </div>
                </div>
{{-- ----------------------------End of Trashed Employees----------------------------- --}}

{{-- ----------------------------Trashed Employee Histories--------------------------- --}}
                <div id="tab-6" class="tab-pane">
                    <div class="panel-body">
                        <h3>Trashed Employees Histories of {{$company->name}}</h3>
                        @if(count($company->employee_histories->where('status',0))>0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="hpanel">
                                        <div class="panel-heading">
                                            <div class="panel-tools">
                                                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <table id="example3" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">S.N.</th>
                                                    <th scope="col">Employee Name</th>
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
                                                @foreach($company->employee_histories as $history)
                                                    @if($history->status==0)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td><a href="{{route('show.employee.details',['id'=>$history->employee->id])}}">{{$history->employee->name}}</a></td>
                                                            <td>{{$history->position}}</td>
                                                            <td>{{$history->department->name}}</td>
                                                            <td>{{$history->section->name}}</td>
                                                            <td>{{$history->joined_date}}</td>
                                                            <td>{{$history->resigned_date}}</td>
                                                            <td><a href="{{route('experience.detail',['id'=>$history->id])}}">View detail</a></td>
                                                            <td>
                                                                <a href="{{route('restore.experience',['id'=>$history->id])}}"><i class="fa fa-undo">&nbsp;Restore</i> </a>
                                                                <i class="fa fa-trash" style="cursor:pointer;" role="button"  title="Delete" data-toggle="modal" data-target="#exampleModalCenter{{$history->id}}">&nbsp;Permanent Delete</i>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModalCenter{{$history->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                <a href="{{route('permanent.delete.experience',['id'=>$history->id])}}"><button type="button" style="padding: 5px;" class="bth btn-danger">Permanent Delete</button></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>No any deleted histories</p>
                        @endif
                    </div>
                </div>
{{-- ----------------------------End of Trashed Employee Histories-------------------- --}}

{{-- ----------------------------Trashed Roles --------------------------------------- --}}
                <div id="tab-7" class="tab-pane">
                    <div class="panel-body">
                        <h3>Trashed Roles of {{$company->name}}</h3>
                        @php $roles=[]; @endphp
                        @foreach($company->admins as $admin)
                            @foreach($admin->created_roles as $created_role)
                                @if($created_role->status==0)
                                    @php $roles[][]=$created_role; @endphp
                                @endif
                            @endforeach
                        @endforeach
                        @if(count($roles)>0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="hpanel">
                                        <div class="panel-heading">
                                            <div class="panel-tools">
                                                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                                            </div>
                                            Roles in {{$company->name}}
                                        </div>
                                        <div class="panel-body">
                                            <table id="example2" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Role</th>
                                                    <th>Deleted By</th>
                                                    <th>Deleted At</th>
                                                    <th>Update</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $count=1; @endphp
                                                @foreach($roles as $role)
                                                    @foreach($role as $rl)
                                                        <tr>
                                                            <th scope="row">{{$count++}}</th>
                                                            <td>{{$rl->name}}</td>
                                                            <td>
                                                                @if($rl->deleted_by)
                                                                    <a href="{{route('show.admin.details',['id'=>$rl->deleted_by])}}">{{$rl->deleted_admin->name}}</a>
                                                                @else
                                                                    <i class="fa fa-ban">&emsp;N/A</i>
                                                                @endif
                                                            </td>
                                                            <td>{{$rl->updated_at}}</td>
                                                            <td>
                                                                <a href="{{route('restore.role',['id'=>$rl->id])}}"><i class="fa fa-undo">&nbsp;Restore</i></a>
                                                                <i class="fa fa-trash" style="cursor:pointer;"
                                                                   role="button"
                                                                   title="Delete Role" data-toggle="modal"
                                                                   data-target="#exampleModalCenter{{$rl->id}}">&nbsp;
                                                                   Permanent delete</i>
                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                     id="exampleModalCenter{{$rl->id}}" tabindex="-1"
                                                                     role="dialog"
                                                                     aria-labelledby="exampleModalCenterTitle"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                         role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">
                                                                                    Delete</h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            @if(count($rl->admin_roles)>0)
                                                                                <div class="modal-body">
                                                                                    {{count($rl->admin_roles)}} Users
                                                                                    are assigned with this
                                                                                    role, first change their role to
                                                                                    other to delete this role.
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Ok
                                                                                    </button>
                                                                                </div>
                                                                            @else
                                                                                <div class="modal-body">
                                                                                    Do you want to delete??
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Close
                                                                                    </button>
                                                                                    <a href="{{route('permanent.delete.role',['id'=>$rl->id])}}">
                                                                                        <button type="button" style="padding: 5px;"
                                                                                                class="bth btn-danger">Permanent Delete
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>There are no any trashed roles in {{$company->name}}</p>
                        @endif
                    </div>
                </div>
{{-- ----------------------------End of Trashed Roles--------------------------------- --}}
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $(function () {
            // Initialize Example 2
            $('#example2').dataTable();
            $('#example3').dataTable();
        });
    </script>
@endsection
