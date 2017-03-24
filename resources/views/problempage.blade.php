<html>
<script>
function httpGet(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous 
    xmlHttp.send(null);
}
</script>
<body>
	{{$problems -> name}}
<br>
{{$problems -> abstract}}
  <ul>
	@php ($iii = 0)
	@foreach (unserialize($problems->hintArray) as $hint)
	<li>
		hint cost:	 {{$hint[0]}}
<button onclick='httpGet("/problems/{{$problems->id}}/h{{$iii}}",alert)'>Show Hint{{$iii}}</button>
	@php ($iii = $iii+1)
			@endforeach
			</li>
  </ul>

<?php 
/*use App\Http\Controllers\ProblemController;
echo ProblemController::showHint($problems->id,1); */
?>
	<form method="POST" action="/problems/{{$problems->id}}">
		{{ csrf_field() }}
		<input type="text" name=flag></input>
		<button type="submit">send</button>
	</form>


</body>
</html>
