@extends('layouts.app')

@section('title', 'Add New Problem')

@section('stylesheets')
  @parent
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('adminlte/plugins/select2/select2.min.css') }}">
@endsection

@section('content-header')
  New Problem <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Problem</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('problem.store') }}" role="form" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          @include('problem.CUPartialForm', ["submitButton" => "Create Problem"])

        </form>
      </div>
      <!-- /.box -->
      
    </div>
    <div class="col-sm-2">
      
    </div>
  </div>
@endsection

@section('scripts')
  @parent
  <!-- Select2 -->
  <script src="{{ url('adminlte/plugins/select2/select2.full.min.js') }}"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>
@stop