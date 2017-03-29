@extends('layouts.app')

@section('title', 'All the Problems')

@section('content-header')
	All the Problems <small>- Admins Only</small>
@endsection
 
@section('content')
	@php
	  use Carbon\Carbon;  
	@endphp
	
	<div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        Be Carefull, perform any action only if you know its effects.
      </div>
    </div>

    <div class="row pad margin no-print">
      	<div class="col-sm-4">
        </div>
        <div class="col-sm-4">
        	
        </div>
      	<div class="col-sm-4">
          <a href="{{ route('problem.create') }}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add New Problem</a>
        </div>
        <!-- /.col -->	
      </div>

    <!-- Main content -->
    <section class="invoice">
      
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-puzzle-piece"></i> Current Problems
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
              <th>Id</th>
              <th>Title</th>
              <th>Category</th>
              <th>Points</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            	@forelse ($problems as $problem)
                  <tr>
                    <td>{{ $problem->id }}{{-- $loop->index + 1 --}}</td>
                    <td>{{ $problem->title }}</td>
                    <td>{{ $problem->category->name }}</td>
                    <td>{{ $problem->category->points }}</td>
                    <td><a href="{{ route('problem.show', $problem->id) }}" class="btn btn-info btn-sm">View More</a></td>
                    <td><a href="{{ route('problem.edit', $problem->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                      <form action="#" method="POST" style="display: inline;">
                        {{-- csrf_field() --}}
                        {{-- method_field('DELETE') --}}
                        <button type="submit" name="deleteButton" class="btn btn-danger btn-sm" disabled  data-toggle="tooltip" data-placement="top" title="Disabled till Techfest">Delete</button>
                      </form>
                    </td>
                  </tr> 
                 @empty
                 	<tr>
                 		<td colspan="5"><span class="lead text-info">No Problems found!</span></td>
                 	</tr> 
                @endforelse
            </tbody>
          </table>
          {{ $problems->links() }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection
