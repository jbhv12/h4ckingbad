@extends('layouts.app')

@section('title', 'Login')

@section('header')
    @parent
@endsection
@section('sidebar')
@endsection

@section('content-header')
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
          <a href="{{ url('/') }}"><b>H</b>4<b>cking Bad</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Login to Start H4cking</p>

            <form action="{{ route('login') }}" method="post" role="form">
              {{ csrf_field() }}
              <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" required placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required placeholder="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
              <div class="row">
                <div class="col-xs-7 col-xs-offset-1">
                  <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <div class="social-auth-links text-center">
              <p>
                <a href="{{ route('password.request') }}">Forgot Password?</a><br>
                - OR -<br>
                <a href="{{ route('team.create') }}" class="text-center">New Team? Register Now</a>
              </p>

            </div>
            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
