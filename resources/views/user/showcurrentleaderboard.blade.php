@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content-header')
	Leaderboard <small>- Live Updates! </small> for {{ session()->get('round')->name }}
@endsection
 
@section('content')
	@php
	  use Carbon\Carbon;  
	@endphp
	

     <!-- Main content -->
    <section class="invoice">
      
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-trophy"></i> Leaderboard - <b>{{ $leaderboard->count() }} Teams! </b>
            <small class="pull-right">Date: {{ Carbon::today()->toFormattedDateString() }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-hover table-striped">
            <thead>
            <tr>
              <th>Rank</th>
              <th>Team</th>
              <th>Points</th>
              <th>Time-Index</th>
              <th>Start Time</th>
            </tr>
            </thead>
            <tbody>
            	@forelse ($leaderboard as $user)
                  <tr>
                    <td>{{ (($leaderboard->currentPage()-1) * $leaderboard->perPage()) + $loop->index + 1 }}</td>
                    <td>{{ $user->UserInRound->User->name }}</td>
                    <td>{{ $user->points }}</td>
                    <td>{{ $user->getHours() }} HH : {{ $user->getMinutes() }} MM : {{ $user->getSeconds() }} SS</td>
                    <td>{{ Carbon::parse($user->UserInRound->starttime)->diffForHumans(Carbon::now()) }}</td>
                  </tr> 
                 @empty
                 	<tr>
                 		<td colspan="5"><span class="lead text-info">No record found!</span></td>
                 	</tr> 
                @endforelse
            </tbody>
          </table>
          {{ $leaderboard->links() }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection
