@extends('layouts.master')

@section('title', 'Contador de Películas')

@section('content')
    <h2>{{$title}}</h2>
    @if(is_null($films))
        <p class="text-danger">No hay películas disponibles.</p>
    @else
        <p>Total de películas: {{$films}}</p>
    @endif
@endsection
