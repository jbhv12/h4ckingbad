@extends('layouts.app')

@section('title', 'Edit Team Profile')

@section('content-header')
@endsection

@section('content')

    <div class="register-box" style="margin-top: 0px;">
      <div class="register-logo">
        <a href="{{ url('/') }}"><b>H</b>4<b>cking Bad</b></a>
        <br>
        <a href="#">Team : {{ $userprofile->teamname }}
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Edit Team Profile</p>

        <form action="{{ route('team.update', $userprofile->id) }}" role="form" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group has-feedback{{ $errors->has('teamname') ? ' has-error' : '' }}">
            <input type="text" class="form-control" id="teamname" name="teamname" placeholder="Team Name" value="{{ old('teamname', isset($userprofile->teamname) ? $userprofile->teamname : null) }}" required>
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
            <input type="text" class="form-control" id="firstmembername" name="firstmembername" placeholder="First Person Name" value="{{ old('firstmembername', isset($userprofile->firstmembername) ? $userprofile->firstmembername : null) }}" required>
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
            <input type="text" class="form-control" id="secondmembername" name="secondmembername" placeholder="(Optional) Second Person Name" value="{{ old('secondmembername', isset($userprofile->secondmembername) ? $userprofile->secondmembername : null) }}">
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
            <input type="email" class="form-control" id="firstmemberemail" name="firstmemberemail" placeholder="First Person Email" value="{{ old('firstmemberemail', isset($userprofile->firstmemberemail) ? $userprofile->firstmemberemail : null) }}" required disabled>
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
            <input type="email" class="form-control" id="secondmemberemail" name="secondmemberemail" placeholder="(Optional) Second Person Email" value="{{ old('secondmemberemail', isset($userprofile->secondmemberemail) ? $userprofile->secondmemberemail : null) }}">
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
            <input type="mobile" class="form-control" id="firstmembermobile" name="firstmembermobile" placeholder="First Person Mobile" value="{{ old('firstmembermobile', isset($userprofile->firstmembermobile) ? $userprofile->firstmembermobile : null) }}" required>
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
            <input type="mobile" class="form-control" id="secondmembermobile" name="secondmembermobile" placeholder="(Optional) Second Person Mobile" value="{{ old('secondmembermobile', isset($userprofile->secondmembermobile) ? $userprofile->secondmembermobile : null) }}">
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
          
          <div class="row">
            <div class="col-xs-1">
            </div>
            <!-- /.col -->
            <div class="col-xs-10">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Update Profile</button>
            </div>
            <div class="col-xs-1">
              
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@endsection
