@extends('layouts.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Catálogos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
        <clientes-component></clientes-component>
    </div>
@endsection