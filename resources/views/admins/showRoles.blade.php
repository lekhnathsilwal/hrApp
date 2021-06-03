@extends('layouts.app')
@section('content')
    <div class="content">
        @include('includes.message')
        @if(count($roles)>0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="hpanel">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                            </div>
                            Roles in your company
                        </div>
                        <div class="panel-body">
                            <table id="example2" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    @if($trash==0)
                                        <th>Admins</th>
                                    @else
                                        <th>Deleted By</th>
                                        <th>Deleted At</th>
                                    @endif
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
                                            @if($trash==0)
                                                <td>
                                                    @if(((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0))
                                                        @foreach($rl->admin_roles as $admin_role)
                                                            <a href="{{route('show.admin.details',['id'=>$admin_role->admin->id])}}">{{$admin_role->admin->name}}
                                                                ,</a>&nbsp;
                                                        @endforeach
                                                    @endif
                                                </td>
                                            @else
                                                <td>
                                                    @if($rl->deleted_by && ((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0))
                                                        <a href="{{route('show.admin.details',['id'=>$rl->deleted_by])}}">{{$rl->deleted_admin->name}}</a>
                                                    @else
                                                        <i class="fa fa-ban">&emsp;N/A</i>
                                                    @endif
                                                </td>
                                                <td>{{$rl->updated_at}}</td>
                                            @endif
                                            <td>
                                                @if($rl->admin->id==Auth::guard('admin')->user()->id)
                                                    @if($permission['role']['u']==1)
                                                        <a href="{{route('edit.role',[$rl->id])}}"><i class="fa fa-edit"
                                                           title="Edit Role">&nbsp;Edit</i></a>&emsp;
                                                    @endif
                                                    @if($trash==1 && ((array_key_exists('trash',$permission))?(($permission['trash']['c']==1)?1:0):0) && $permission['role']['c']==1)
                                                        <a href="{{route('restore.role',['id'=>$rl->id])}}"><i class="fa fa-undo">&nbsp;Restore</i></a>&emsp;
                                                    @endif
                                                    @if($permission['role']['d']==1)
                                                        <i class="fa fa-trash" style="cursor:pointer;" role="button"
                                                           title="Delete Role" data-toggle="modal"
                                                           data-target="#exampleModalCenter{{$rl->id}}">&nbsp;{{($trash==1 && ((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0))?'Permanent ':''}}
                                                            delete</i>
                                                    @endif
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalCenter{{$rl->id}}" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                @if(count($rl->admin_roles)>0)
                                                                    <div class="modal-body">
                                                                        {{count($rl->admin_roles)}} Users are assigned with this
                                                                        role, first change their role to other to delete this role.
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Ok
                                                                        </button>
                                                                    </div>
                                                                @else
                                                                    <div class="modal-body">
                                                                        Do you want to delete??
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        @if($trash==1 && ((array_key_exists('trash',$permission))?(($permission['trash']['d']==1)?1:0):0))
                                                                            <a href="{{route('permanent.delete.role',['id'=>$rl->id])}}">
                                                                                <button type="button" style="padding: 5px;"
                                                                                        class="bth btn-danger">Permanent Delete
                                                                                </button>
                                                                            </a>
                                                                        @else
                                                                            <a href="{{route('delete.role',['id'=>$rl->id])}}">
                                                                                <button type="button" style="padding: 5px;"
                                                                                        class="bth btn-danger">Delete
                                                                                </button>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <i class="fa fa-ban">&emsp;N/A</i>
                                                @endif
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
            <p>There are no any roles in your company add role</p>
        @endif
        @if($trash==0 && $permission['role']['c']==1)
            <a href="{{route('add.role')}}" role="button" class="btn btn-success">Add New Role</a>
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
