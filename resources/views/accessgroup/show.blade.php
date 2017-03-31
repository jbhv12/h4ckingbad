@extends('layouts.app')

@section('title', 'Members of the AccessGroup')

@section('content-header')
	Access Group Members<small>- Admins Only</small>
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
          <a href="{{ route('accessgroup.createuser', $accessgroup->id) }}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add New Member</a>
        </div>
        <!-- /.col -->	
      </div>

    <!-- Main content -->
    <section class="invoice">
      
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <span class="text-uppercase text-success"><i class="fa fa-group"></i> Group : {{ $accessgroup->name }}</span> 
            <small class="pull-right">Created : {{ Carbon::parse($accessgroup->created_at)->diffForHumans(Carbon::now()) }}</small>
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
              <th>Email</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            	@forelse ($users as $user)
                  <tr>
                    <td>{{ $user->id }}{{-- $loop->index + 1 --}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <form action="{{ route('accessgroup.destroyuser',["accessgroup" => $accessgroup->id,"user" => $user->id] ) }}" method="POST" style="display: inline;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" name="deleteButton" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Think twice before doing">Remove</button>
                      </form>
                    </td>
                  </tr> 
                 @empty
                 	<tr>
                 		<td colspan="5"><span class="lead text-info">No Members found!</span></td>
                 	</tr> 
                @endforelse
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection
