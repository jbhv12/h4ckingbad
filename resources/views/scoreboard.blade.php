<ul>
@php ($iii = 0)
@foreach ($all as $a)
<li>index={{$iii}} id={{$a->id}} email={{$email[$iii]}}---> {{$a->rank}}</li>
@php ($iii = $iii+1)
@endforeach
</ul>
