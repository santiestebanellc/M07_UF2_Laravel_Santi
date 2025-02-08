<h1>{{$title}}</h1>
@if(is_null($films))
    <FONT COLOR="red">No hay peliculas disponibles.</FONT>
@else 
    {{$films}}
@endif