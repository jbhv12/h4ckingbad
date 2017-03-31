@extends('layouts.app')

@section('title', 'Problem Abstraction for Participant\'s current Round')

@section('content-header')
	<b>Hi,</b> {{ $user->name }}
@endsection
 
@section('content')
	@php
	  use Carbon\Carbon;  
	@endphp
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-puzzle-piece"></i>

              <h3 class="box-title">Problems for : <b>{{ session()->get('round')->name }}</b> Round</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                
                  <div class="panel box {{ $problem->pivot->points >= $problem->Category->points/2 ? 'box-success' : 'box-info' }}">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#{{$problem->id}}">
                          Problem : <b>{{ $problem->title }}</b> , {{ $problem->pivot->points }} / {{ $problem->Category->points }} Points
                        </a>
                      </h4>
                    </div>
                    <div id="{{$problem->id}}" class="panel-collapse collapse in">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-10 col-sm-offset-1">
                            <h3>Description</h3>
                            <p>
                              {{ $problem->abstraction }}
                            </p>
                            <hr>
                            <h4>Links</h4>
                            @if($problem->problempageurl != null)
                              <a href="{!! $problem->problempageurl !!}" target="_blank">Click here to goto the problem page</a>
                            @endif
                            @if($problem->problemfilespath != null)
                              <a href="{!! $problem->problemfilespath !!}" target="_blank">Click here to download files</a>
                            @endif
                            <hr>
                            <h4>Hints</h4>
                            @if($problem->pivot->hastakenminorhint == 1 || $problem->pivot->hastakenminorhint == true)
                              <div class="callout">
                                <p> Hint : {{ $problem->minorhint }}</p>
                              </div>
                              @if($problem->pivot->hastakenmajorhint == 1 || $problem->pivot->hastakenmajorhint == true)
                                <div class="callout">
                                  <p> Another Hint : {{ $problem->majorhint }}</p>
                                </div>
                              @else
                                <a href="{{ route('user.takemajorhint', ["user" => $user->id, "problem" => $problem->id]) }}" data-toggle="tooltip" data-placement="top" title="This may lead to negative score.">Take anothar Hint!</a>
                              @endif
                            @else
                              <a href="{{ route('user.takeminorhint', ["user" => $user->id, "problem" => $problem->id]) }}" data-toggle="tooltip" data-placement="top" title="Points will cut to half.">Take a Hint!</a>
                            @endif
                            <p class="text-center">
                              @if($problem->pivot->points < $problem->Category->points/2)
                                <br>
                                <form action="{{ route('user.solveparticipantproblem',[ "user" => $user->id, "problem" => $problem->id]) }}" method="POST" style="display: inline;">
                                  {{ csrf_field() }}
                                  <div class="input-group">
                                    <input type="text" class="form-control" id="flag" name="flag" placeholder="Give Flag" value="{{ old('flag') }}" required>
                                    <div class="input-group-btn">
                                      <button type="submit" name="submitButton" class="btn btn-primary"><i class="fa fa-flag"> </i> Submit Flag</button>
                                    </div>
                                    @if ($errors->has('flag'))
                                      <span class="help-block">
                                          <strong>
                                              <ul>
                                                  @foreach ($errors->get('flag') as $errorMsg)
                                                      <li>{{ $errorMsg }}</li>    
                                                  @endforeach
                                              </ul>
                                          </strong>
                                      </span>
                                    @endif
                                    <!-- /btn-group -->
                                  </div>
                                </form>
                                <br>
                              @else
                                <span class="text-success lead"><b>Problem solved successfully.</b></span>
                              @endif
                            </p>
                          </div>
                          <div class="col-sm-1">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
              </div>
              <div class="callout callout-info">
                <p>Make sure you knows rules before taking any hint!</p>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
  </div>    

@endsection
