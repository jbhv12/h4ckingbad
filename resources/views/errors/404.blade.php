@extends('layouts.app')

@section('title', '404 Page Not Found')

@section('content-header')
	Page Not Found<small>404 Error</small>
@endsection

@section('content')

    <div class="error-page">
        <h2 class="headline text-blue"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-blue"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="#">return to dashboard</a>
          </p>

        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->

@endsection
