@extends('layouts.app')

@section('title', 'Access Groups')

@section('content-header')
	Access Groups <small>- Admins Only</small>
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
        	<a href="{{ route('accessgroup.createuser', $adminGroup->id) }}" class="btn btn-danger btn-block"><i class="fa fa-plus"></i> Add Admin</a>	
        </div>
        <div class="col-sm-4">
        	
        </div>
      	<div class="col-sm-4">
          <a href="{{ route('accessgroup.create') }}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add New Group</a>
        </div>
        <!-- /.col -->	
      </div>

    <!-- Main content -->
    <section class="invoice">
      
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-users"></i> Current Access Groups
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
              <th>Name</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            	@forelse ($accessgroups as $accessgroup)
                  <tr>
                    <td>{{ $accessgroup->id }}{{-- $loop->index + 1 --}}</td>
                    <td>{{ $accessgroup->name }}</td>
                    <td><a href="{{ route('accessgroup.show', $accessgroup->id) }}" class="btn btn-info btn-sm">View Users</a></td>
                    <td><a href="#" class="btn btn-primary btn-sm" disabled  data-toggle="tooltip" data-placement="top" title="Disabled till Techfest">Edit</a></td>
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
                 		<td colspan="5"><span class="lead text-info">No Groups found!</span></td>
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
