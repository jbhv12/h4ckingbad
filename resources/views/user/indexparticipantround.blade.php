@extends('layouts.app')

@section('title', 'All the Rounds for A Team')

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
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Participant Rounds</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-info">
                <h4>Please Read all Info Carefully for the Round!</h4>

                <p>Here your past,current and furthure allowed all rounds are listed.</p>
              </div>

              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                @forelse($user->rounds as $round)
                  <div class="panel box {{ $round->pivot->hasstarted == 1 ? 'box-success' : 'box-info' }}">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#{{$round->id}}">
                          Round : {{ $round->name }}
                        </a>
                      </h4>
                    </div>
                    <div id="{{$round->id}}" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-5 col-sm-offset-1">
                            <p>Category of Problems in this Round : </p>
                            <ul>
                              @foreach($round->categories as $category)
                                <li><b>{{ $category->name }}</b> , <b>{{ $category->pivot->total_problems }}</b> problems with <b>{{ $category->points }}</b> points for each</li>
                              @endforeach
                            </ul>
                            <p>
                              <b>Timing : </b>{{ $round->getHours() }} HH : {{ $round->getMinutes() }} MM : {{ $round->getSeconds() }} SS
                              <br>
                              @if($round->pivot->hasstarted == 0 || $round->pivot->hasstarted == '0' || $round->pivot->hasstarted == false)
                                <br>
                                <form action="{{ route('user.startparticipantround',[ "user" => $user->id, "round" => $round->id]) }}" method="POST" style="display: inline;">
                                  {{ csrf_field() }}
                                  <button type="submit" name="submitButton" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" title="Read all instruction/rules carefully before starting.">Start Hacking</button>
                                </form>
                                <br>
                              @else
                                <b>Strted At : </b> {{ Carbon::parse($round->pivot->starttime)->toDayDateTimeString() }}
                                <br>
                                <b>Completed : </b> {{ Carbon::parse($round->pivot->endtime)->toDayDateTimeString() }}
                                <br>
                              @endif
                            </p>
                          </div>
                          <div class="col-sm-5">
                            
                          </div>
                          <div class="col-sm-1">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          No Rounds Allocated for you!
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
