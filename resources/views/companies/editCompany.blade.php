@extends('layouts.app')
@section('content')
    <div class="register-container">
        @include('includes.message')
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>Edit company</h3>
                    <small>Update company</small>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="{{route('update.company',['id'=>$company->id])}}" method="post" enctype="multipart/form-data" id="loginForm">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="name">Company Name</label>
                                    <input type="text" value="{{$company->name}}" required="required" id="name" class="form-control" name="name">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="image">Logo</label>
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
{{--                <strong>HOMER</strong> - AngularJS Responsive WebApp <br/> 2015 Copyright Company Name--}}
            </div>
        </div>
    </div>
@endsection
