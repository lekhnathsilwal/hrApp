@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="login-container">
            @include('includes.message')
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center m-b-md">
                        <h3>CHANGE PASSWORD</h3>
                        <small>Please fill the form to change your password</small>
                    </div>
                    <div class="hpanel">
                        <div class="panel-body">
                            <form action="{{route('update.password')}}" method="post" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label" for="old_password">Current Password</label>
                                    <input type="password" placeholder="********" title="Old password" required="" name="old_password" id="old_password" class="form-control">
                                    <span class="help-block small">Your current password</span>
                                    <label class="control-label" for="password">New Password</label>
                                    <input type="password" placeholder="********" title="New password" required="" name="password" id="password" class="form-control">
                                    <span class="help-block small">Your New Strong Password</span>
                                    <label class="control-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" placeholder="********" title="Confirm Password" required="" name="password_confirmation" id="password_confirmation" class="form-control">
                                    <span class="help-block small">Confirm your password</span>
                                </div>

                                <button class="btn btn-success btn-block">Change password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
