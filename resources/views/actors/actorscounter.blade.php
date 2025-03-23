@extends('layouts.master')

@section('title', 'Contador de Actores')

@section('content')
    <h2>{{$title}}</h2>
    @if(is_null($actors))
        <p class="text-danger">No hay actores disponibles.</p>
    @else
        <p>Total de actores: {{$actors}}</p>
    @endif
@endsection
