<ul>
  @foreach ($categories as $cat)
    <li>
      <a href="/categories/{{$cat->id}}">
      {{$cat -> name}}
    </li>
  @endforeach
</ul>
