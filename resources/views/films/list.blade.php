@extends('layouts.master')

@section('title', 'Lista de Películas')

@section('content')
    <h1>{{$title}}</h1>

    @if(empty($films))
        <p class="text-danger">No se ha encontrado ninguna película</p>
    @else
        <div align="center">
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Año</th>
                <th>Género</th>
                <th>País</th>
                <th>Duración</th>
                <th>Imagen</th>
            </tr>

            @foreach($films as $film)
                <tr>
                    <td>{{$film['name']}}</td>
                    <td>{{$film['year']}}</td>
                    <td>{{$film['genre']}}</td>
                    <td>{{$film['country']}}</td>
                    <td>{{$film['duration']}} min</td>
                    <td><img src="{{$film['img_url']}}" style="width: 100px; height: 120px;" /></td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
@endsection
