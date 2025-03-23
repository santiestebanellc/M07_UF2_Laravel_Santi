@extends('layouts.master')

@section('title', 'Lista de Actores')

@section('content')
    <h1>{{$title}}</h1>

    @if(empty($actors))
        <p class="text-danger">No se ha encontrado ningun actor</p>
    @else
        <div align="center">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha de nacimiento</th>
                <th>País</th>
                <th>Imagen</th>
            </tr>

            @foreach($actors as $actor)
                <tr>
                    <td>{{$actor['name']}}</td>
                    <td>{{$actor['surname']}}</td>
                    <td>{{$actor['birthdate']}}</td>
                    <td>{{$actor['country']}}</td>
                    <td><img src="{{$actor['img_url']}}" style="width: 100px; height: 120px;" /></td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
@endsection
