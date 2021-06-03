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
        @if(count($companies)>0)
            <div class="row">
                @foreach($companies as $company)
                    <div class="col-lg-3">
                        <div class="hpanel">
                            <div class="panel-body text-center h-200">
                                    <a href="{{route('show.company.details',['id'=>$company->id])}}"><img src="{{url('/uploads/companies/'.$company->image)}}">
                                    <h3 class="font-extra-bold no-margins text-success">
                                        {{$company->name}}
                                    </h3></a>
                            </div>
                            <div class="panel-footer">
                                <a href="{{route('edit.company',['id'=>$company->id])}}"><i class="fa fa-edit">&nbsp;Edit</i></a>&emsp;
                                <a href="{{route('delete.company',['id'=>$company->id])}}"><i class="fa fa-trash">&nbsp;Delete</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No any Companies are here</p>
        @endif
            <a href="{{route('create.company')}}" role="button" class="btn btn-success">Add Company</a>
    </div>
@endsection
