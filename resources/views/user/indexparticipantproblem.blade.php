@extends('layouts.app')

@section('title', 'All the Problems for Participant\'s current Round')

@section('content-header')
	<b>Hi,</b> {{ $user->name }}
@endsection
 
@section('content')
	@php
	  use Carbon\Carbon;  
	@endphp
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-puzzle-piece"></i>

              <h3 class="box-title">Problems for <b>{{ session()->get('round')->name }}</b> Round</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-info">
                <h4>You can choose Problems in any order!</h4>
              </div>

              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                @forelse($problems as $problem)
                  <div class="panel box {{ $problem->pivot->points >= ($problem->Category->points/2) ? 'box-success' : 'box-info' }}">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#{{$problem->id}}">
                          Problem : {{ $problem->title }} , {{ $problem->pivot->points }} / {{ $problem->Category->points }} Points
                        </a>
                      </h4>
                    </div>
                    <div id="{{$problem->id}}" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-10 col-sm-offset-1">
                            <p>
                              {{ $problem->abstraction }}
                            </p>
                            <p class="text-center">
                              @if($problem->pivot->points < ($problem->Category->points/2))
                                <br>
                                <form action="{{ route('user.showparticipantproblem',[ "user" => $user->id, "problem" => $problem->id]) }}" method="GET" style="display: inline;">
                                  {{ csrf_field() }}
                                  <button type="submit" name="submitButton" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" title="Read all instruction/rules carefully before starting.">H4ck the Solution</button>
                                </form>
                                <br>
                              @else
                                <span class="text-success">Problem solved successfully.</span>
                              @endif
                            </p>
                          </div>
                          <div class="col-sm-1">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="panel box box-danger">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          No Problems Allocated for you!
                        </a>
                      </h4>
                    </div>
                  </div>  
                @endforelse
                
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
  </div>    

@endsection
