@extends('layouts.app')

@section('title', 'Categories in the Round')

@section('content-header')
	Categories In the Round<small>- Admins Only</small>
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
          <a href="{{ route('round.createcategory', $round->id) }}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add New Category</a>
        </div>
        <!-- /.col -->	
      </div>

    <!-- Main content -->
    <section class="invoice">
      
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <span class="text-uppercase text-success"><i class="fa fa-group"></i> Round : {{ $round->name }}</span> 
            <small class="pull-right">Created : {{ Carbon::parse($round->created_at)->diffForHumans(Carbon::now()) }}</small>
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
              <th>Name</th>
              <th>Points</th>
              <th>No. of Problems</th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            	@forelse ($categories as $category)
                  <tr>
                    <td>{{ $category->id }}{{-- $loop->index + 1 --}}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->points }}</td>
                    <td>{{ $category->pivot->total_problems }}</td>
                    <td><a href="#" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Disabled till TechFest" disabled>Edit</a></td>
                    <td>
                      <form action="#" method="POST" style="display: inline;">
                        {{-- csrf_field() --}}
                        {{-- method_field('DELETE') --}}
                        <button type="submit" name="deleteButton" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Think twice before doing" disabled>Remove</button>
                      </form>
                    </td>
                  </tr> 
                 @empty
                 	<tr>
                 		<td colspan="5"><span class="lead text-info">No Category found!</span></td>
                 	</tr> 
                @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection
