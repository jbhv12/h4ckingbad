<ul>
@foreach ($all as $a)
<li>{{$a->id}} ---> {{$a->rank}}</li>
@endforeach
</ul>

//add indexing.also write func. that maps id to email id.
