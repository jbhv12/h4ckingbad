<ul>
@foreach ($all as $a)
<li>{{$a->id}} ---> {{$a->rank}} ---

use App\Http\Controllers\ProblemController;
echo ProblemController::showHint($problems->id,1);

</li>
@endforeach
</ul>

//add indexing.also write func. that maps id to email id.

<?php
use App\Http\Controllers\ProblemController;

echo "<ul>";
	foreach($all as $a){
		echo "<li> $a->id </li>";
	}
echo </ul>
?>
