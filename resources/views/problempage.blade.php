<html>
<body>
  <ul>
      <li> {{$problems -> abstract}} </li>
      <li> {{unserialize($problems -> hintArray)[0][0]}} </li>
      <li> {{unserialize($problems -> hintArray)[1][1]}} </li>
  </ul>


	<form method="POST" action="/problems/{{$problems->id}}">
		{{ csrf_field() }}
		<input type="text" name=flag></input>
		<button type="submit">send<button>
	</form>


</body>
</html>
