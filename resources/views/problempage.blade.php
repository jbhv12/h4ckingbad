<html>
<body>
	{{$problems -> name}}
<br>
{{$problems -> abstract}}
  <ul>

	@foreach (unserialize($problems->hintArray) as $hint)
	<li>
		hint cost:	 {{$hint[0]}}
hintlink
			@endforeach
			</li>
  </ul>

<?php use App\Http\Controllers\ProblemController;
echo ProblemController::showHint($problems->id,1); ?>

	<form method="POST" action="/problems/{{$problems->id}}">
		{{ csrf_field() }}
		<input type="text" name=flag></input>
		<button type="submit">send<button>
	</form>


</body>
</html>
