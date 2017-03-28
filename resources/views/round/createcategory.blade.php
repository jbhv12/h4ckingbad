@extends('layouts.app')

@section('title', 'Add Category to Round')

@section('stylesheets')
  @parent
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('adminlte/plugins/select2/select2.min.css') }}">
@endsection

@section('content-header')
  Categories in a Round <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Category for <b class="text-uppercase">{{ $round->name }}</b> Round</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('round.storecategory', $round->id) }}" role="form" method="post" class="form-horizontal">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
              <label for="category" class="col-sm-4">Select Category</label>
              <div class="col-sm-8">
                <select class="form-control select2" id="category" name="category" style="width:100%" required>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }} , {{ $category->points }}
                    </option>
                  @endforeach
                </select>
                @if ($errors->has('category'))
                  <span class="help-block">
                      <strong>
                          <ul>
                              @foreach ($errors->get('category') as $errorMsg)
                                  <li>{{ $errorMsg }}</li>    
                              @endforeach
                          </ul>
                      </strong>
                  </span>
                @endif  
              </div>
            </div>
              <div class="form-group{{ $errors->has('total_problems') ? ' has-error' : '' }}">
                <label for="total_problems" class="col-sm-4">Total Problems</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="total_problems" name="total_problems" placeholder="Ex. 03" value="{{ old('total_problems') }}" required>
                </div>
                <div class="col-sm-8">
                  @if ($errors->has('total_problems'))
                    <span class="help-block">
                        <strong>
                            <ul>
                                @foreach ($errors->get('total_problems') as $errorMsg)
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