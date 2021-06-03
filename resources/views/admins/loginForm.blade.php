<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HrApp</title>
    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{asset('vendor/metisMenu/dist/metisMenu.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/animate.css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/dist/css/bootstrap.css')}}"/>
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}"/>
    <link rel="stylesheet" href="{{asset('fonts/pe-icon-7-stroke/css/helper.css')}}"/>
    <link rel="stylesheet" href="{{asset('styles/style.css')}}">
    <link rel="icon" href="{{url('/img/logo/hr.png')}}" type="image" sizes="16x16">

</head>
<body class="blank">
<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>Welcome To HrApp</h3>
                <small>Find the employee's character</small>
            </div>
            @if(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="hpanel">
                <div class="panel-body">
                    <form action="{{route('admin.login')}}" id="loginForm" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" placeholder="example@gmail.com" title="Please enter you email" required="required" value="" name="email" id="email" class="form-control">
                            <span class="help-block small">Your Email to app</span>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Please enter your password" placeholder="******" required="required" name="password" id="password" class="form-control">
                            <span class="help-block small">Your strong password</span>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="remember" class="i-checks" checked>
                            Remember login
                            <p class="help-block small">(if this is a private computer)</p>
                        </div>
                        <button class="btn btn-success btn-block">Login</button>
                    </form>
                    <br><a href="{{route('forget.password')}}">Forget Your Password?</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <strong>Shiran Tech </strong>This is a product of Shiran Tech<br/> 2015 Copyright F1Soft
        </div>
    </div>
</div>


<!-- Vendor scripts -->
<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/metisMenu/dist/metisMenu.min.js')}}"></script>
<script src="{{asset('vendor/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('vendor/sparkline/index.js')}}"></script>
<!-- App scripts -->
<script src="{{asset('scripts/homer.js')}}"></script>

</body>
</html>
