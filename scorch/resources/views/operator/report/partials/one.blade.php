<li>{{$ou['name']}}</li>
<ul>
    @foreach ($ou->child as $child)
    <li>{{$child['name']}}</li>
    
    @endforeach
</ul>