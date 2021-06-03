@extends('layouts.app')
@section('content')
    <div class="content">
        @include('includes.message')
        <div class="row">
            <div class="col-lg-12 text-center welcome-message">
                <h2>
                    Welcome to HrApp
                </h2>
                <p>
                    Find out the blacklisted <strong>Employee</strong>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                            <a class="closebox"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="small">
                                    COMPANIES
                                </div>
                                <div>
                                    <h1 class="font-extra-bold m-t-xl m-b-xs">
                                            {{$company}}
                                    </h1>
                                </div>
                                <div class="m-t-xl">
                                    <small>Companies are associated with us</small>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="small">
                                    Employee Histories
                                </div>
                                <div>
                                    <h1 class="font-extra-bold m-t-xl m-b-xs">
                                        {{$employee_experience}}
                                    </h1>
                                </div>
                                <div class="m-t-xl">
                                    <small>Employee Histories Are Available</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="small">
                                    Employee Histories
                                </div>
                                <div>
                                    <h1 class="font-extra-bold m-t-xl m-b-xs">
                                        {{$employee}}
                                    </h1>
                                </div>
                                <div class="m-t-xl">
                                    <small>Employee records are here</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
