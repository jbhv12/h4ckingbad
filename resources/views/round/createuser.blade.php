@extends('layouts.app')

@section('title', 'Add User to Round')

@section('stylesheets')
  @parent
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('adminlte/plugins/select2/select2.min.css') }}">
@endsection

@section('content-header')
  Users in a Round <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New User for <b class="text-uppercase">{{ $round->name }}</b> Round</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('round.storeuser', $round->id) }}" role="form" method="post" class="form-horizontal">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
              <label for="category" class="col-sm-4">Select User</label>
              <div class="col-sm-8">
                <select class="form-control select2" id="user" name="user" style="width:100%" required>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }} , {{ $user->email }}
                    </option>
                  @endforeach
                </select>
                @if ($errors->has('user'))
                  <span class="help-block">
                      <strong>
                          <ul>
                              @foreach ($errors->get('user') as $errorMsg)
                                  <li>{{ $errorMsg }}</li>    
                              @endforeach
                          </ul>
                      </strong>
                  </span>
                @endif  
              </div>
            </div>
              
            <div class="row">
              <div class="col-sm-4">
                <button type="submit" class="btn btn-success btn-block">Search &amp; Add <i class="fa fa-plus"> </i></button>
              </div>
              <div class="col-sm-8">
                
              </div>
            </div>
          </div>
          <!-- /.box-body -->

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