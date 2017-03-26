@extends('layouts.app')

@section('title', 'Add Member to AccessGroup')

@section('content-header')
  Access Groups <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">New Member for <b class="text-uppercase">{{ $accessgroup->name }}</b> Group</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('accessgroup.storeuser', $accessgroup->id) }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">Enter User's Email Id</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Member Email Id" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>
                            <ul>
                                @foreach ($errors->get('email') as $errorMsg)
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
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-search"> </i> Search &amp; Add</button>
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
