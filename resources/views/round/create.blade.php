@extends('layouts.app')

@section('title', 'New Round')

@section('content-header')
  New Round <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Round</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('round.store') }}" role="form" method="post" class="form-horizontal">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-sm-2">Round Name</label>
              <div class="col-sm-10">
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
            <div class="form-group{{ $errors->has('hours') ? ' has-error' : '' }}">
              <label for="hours" class="col-sm-2">Hours</small></label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="hours" name="hours" placeholder="Ex. 01" value="{{ old('hours') }}" required>
              </div>
              <div class="col-sm-8">
                @if ($errors->has('hours'))
                  <span class="help-block">
                      <strong>
                          <ul>
                              @foreach ($errors->get('hours') as $errorMsg)
                                  <li>{{ $errorMsg }}</li>    
                              @endforeach
                          </ul>
                      </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('minutes') ? ' has-error' : '' }}">
              <label for="minutes" class="col-sm-2">Minutes</small></label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="minutes" name="minutes" placeholder="Ex. 30" value="{{ old('minutes') }}" required>
              </div>
              <div class="col-sm-8">
                @if ($errors->has('minutes'))
                  <span class="help-block">
                      <strong>
                          <ul>
                              @foreach ($errors->get('minutes') as $errorMsg)
                                  <li>{{ $errorMsg }}</li>    
                              @endforeach
                          </ul>
                      </strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('seconds') ? ' has-error' : '' }}">
              <label for="seconds" class="col-sm-2">Seconds</small></label>
              <div class="col-sm-2">
                <input type="number" class="form-control" id="seconds" name="seconds" placeholder="Ex. 00" value="{{ old('seconds') }}" required>
              </div>
              <div class="col-sm-8">
                @if ($errors->has('seconds'))
                  <span class="help-block">
                      <strong>
                          <ul>
                              @foreach ($errors->get('seconds') as $errorMsg)
                                  <li>{{ $errorMsg }}</li>    
                              @endforeach
                          </ul>
                      </strong>
                  </span>
                @endif
              </div>
            </div>
        
            <div class="box-footer">
              <button type="submit" class="btn btn-success btn-block">Submit</button>
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
