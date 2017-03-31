@extends('layouts.app')

@section('title', '503 Page Not Found')

@section('content-header')
	Will Be Back<small>Comming Soon...</small>
@endsection

@section('content')

    <div class="error-page">
        <h2 class="headline text-blue"> 503</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-blue"></i> We are coming back soon.</h3>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->

@endsection
