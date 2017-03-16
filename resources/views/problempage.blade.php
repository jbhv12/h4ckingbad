<html>
<body>
  <ul>
      <li> {{$problems -> abstract}} </li>
      <li> {{unserialize($problems -> hintArray)[0]}} </li>
  </ul>

  {!! Form::open(array('route' => 'eval', 'class' => 'form')) !!}

  <div class="form-group">
      {!! Form::label('nakh aaiya') !!}
      {!! Form::text('flag', null,
          array('required',
                'class'=>'form-control',
                'placeholder'=>'Your name')) !!}
      {!! Form::hidden('pid', $problems->id) !!}
  </div>
  <div class="form-group">
      {!! Form::submit('submit',
        array('class'=>'btn btn-primary')) !!}
  </div>

  {!! Form::close() !!}


</body>
</html>
prob logic here.update userStats according to solved/hint taken. also check time.-->
