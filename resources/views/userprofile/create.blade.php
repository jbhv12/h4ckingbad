@extends('layouts.app')

@section('title', 'New Participant')

@section('header')
@endsection
@section('sidebar')
@endsection

@section('content-header')
@endsection

@section('content')

    <div class="register-box" style="margin-top: 0px;">
      <div class="register-logo">
        <a href="{{ url('/') }}"><b>H</b>4<b>cking Bad</b></a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register new team</p>

        <form action="{{ route('team.store') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="form-group has-feedback{{ $errors->has('teamname') ? ' has-error' : '' }}">
            <input type="text" class="form-control" id="teamname" name="teamname" placeholder="Team Name" value="{{ old('teamname') }}" required>
            <span class="glyphicon glyphicon-king form-control-feedback"></span>
              @if ($errors->has('teamname'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('teamname') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('firstmembername') ? ' has-error' : '' }}">
            <input type="text" class="form-control" id="firstmembername" name="firstmembername" placeholder="First Person Name" value="{{ old('firstmembername') }}" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
              @if ($errors->has('firstmembername'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('firstmembername') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('secondmembername') ? ' has-error' : '' }}">
            <input type="text" class="form-control" id="secondmembername" name="secondmembername" placeholder="Second Person Name" value="{{ old('secondmembername') }}" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
              @if ($errors->has('secondmembername'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('secondmembername') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('firstmemberemail') ? ' has-error' : '' }}">
            <input type="email" class="form-control" id="firstmemberemail" name="firstmemberemail" placeholder="First Person Email" value="{{ old('firstmemberemail') }}" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('firstmemberemail'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('firstmemberemail') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('secondmemberemail') ? ' has-error' : '' }}">
            <input type="email" class="form-control" id="secondmemberemail" name="secondmemberemail" placeholder="Second Person Email" value="{{ old('secondmemberemail') }}" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('secondmemberemail'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('secondmemberemail') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('firstmembermobile') ? ' has-error' : '' }}">
            <input type="mobile" class="form-control" id="firstmembermobile" name="firstmembermobile" placeholder="First Person Mobile" value="{{ old('firstmembermobile') }}" required>
            <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
              @if ($errors->has('firstmembermobile'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('firstmembermobile') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('secondmembermobile') ? ' has-error' : '' }}">
            <input type="mobile" class="form-control" id="secondmembermobile" name="secondmembermobile" placeholder="Second Person Mobile" value="{{ old('secondmembermobile') }}" required>
            <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
              @if ($errors->has('secondmembermobile'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('secondmembermobile') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('password') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Retype password" value="{{ old('password_confirmation') }}" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('password_confirmation') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
          </div>
          <div class="row">
            <div class="col-xs-7 col-xs-offset-1">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" id="terms" name="terms" required checked> We agree to the <a href="#">terms</a>
                </label>
              </div>
              @if ($errors->has('terms'))
                <span class="help-block">
                    <strong>
                        <ul>
                            @foreach ($errors->get('terms') as $errorMsg)
                                <li>{{ $errorMsg }}</li>    
                            @endforeach
                        </ul>
                    </strong>
                </span>
              @endif
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <div class="social-auth-links text-center">
          <p>
            - OR -<br>
            <a href="{{ url('login') }}" class="text-center">Already registered?</a>
          </p>

        </div>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@endsection
