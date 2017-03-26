@extends('layouts.app')

@section('title', 'New AccessGroup')

@section('content-header')
  Access Groups <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Access Group</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('accessgroup.store') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">Group Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Group Name" value="{{ old('name') }}" required>
                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>
                            <ul>
                                @foreach ($errors->get('name') as $errorMsg)
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
                <button type="submit" class="btn btn-success btn-block">Submit</button>
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
