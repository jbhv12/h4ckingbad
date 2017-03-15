TODO:do some ui. display more info abt problem

<ul>
  @foreach ($problems as $problem)
    <li>
      <a href="/problems/{{$problem->id}}">
      {{$problem -> name}}
    </li>
  @endforeach
</ul>
