@extends('layouts.app')

@section('title', 'New Category')

@section('content-header')
  Categories <small>- Admins Only</small>
@endsection

@section('content')
  
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Category with ID : {{ $category->id }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('category.update', $category->id) }}" role="form" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="box-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">Category Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Group Name" value="{{ old('name', isset($category->name) ? $category->name : null) }}" required>
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
            <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
              <label for="points">Points <small>for Problems in this category </small></label>
              <input type="number" class="form-control" id="points" name="points" placeholder="Points Ex.100" value="{{ old('points', isset($category->points) ? $category->points : null) }}" required  disabled  data-toggle="tooltip" data-placement="top" title="Disabled till Techfest">
                  @if ($errors->has('points'))
                    <span class="help-block">
                        <strong>
                            <ul>
                                @foreach ($errors->get('points') as $errorMsg)
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
