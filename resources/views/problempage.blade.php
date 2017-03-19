<html>
<body>
  <ul>
      <li> {{$problems -> abstract}} </li>
	@foreach (unserialize($problems->hintArray) as $hint)
		hint cost:	<li> {{$hint[0]}} </li>
		<a href="../"> f </a>
	@endforeach
  </ul>


	<form method="POST" action="/problems/{{$problems->id}}">
		{{ csrf_field() }}
		<input type="text" name=flag></input>
		<button type="submit">send<button>
	</form>


</body>
</html>
