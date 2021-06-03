@extends('layouts.app')
@section('custom-css')
    <style>
        .col-md-4 img{
            height: 250px; float:left; width: 100%;
        }
    </style>
@endsection
@section('content')
    @include('includes.message')
    @if(count($employee_histories)>0)
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        </div>
                        Employee Trash Histories
                    </div>
                    <div class="panel-body">
                        <table id="example2" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
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
                                @foreach($employee_histories as $history)
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
                                            @if($permission['trash']['u']==1 && $permission['employee_experience']['u']==1)
                                                <a href="{{route('edit.experience',[$history->id])}}"><i class="fa fa-edit" title="Edit">&nbsp; Edit</i></a>
                                            @endif
                                            @if($permission['trash']['c']==1 && $permission['employee_experience']['c']==1)
                                                <a href="{{route('restore.experience',['id'=>$history->id])}}"><i class="fa fa-undo">&nbsp;Restore</i> </a>
                                            @endif
                                            @if($permission['trash']['d']==1 && $permission['employee_experience']['d']==1)
                                                <i class="fa fa-trash" style="cursor:pointer;" role="button"  title="Delete" data-toggle="modal" data-target="#exampleModalCenter{{$history->id}}">&nbsp;Permanent Delete</i>
                                            @endif
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content">
            <p>No any deleted histories</p>
        </div>
    @endif
@endsection
@section('custom-js')
    <script>
        $(function () {
            // Initialize Example 2
            $('#example2').dataTable();
        });
    </script>
@endsection
