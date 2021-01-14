@extends('layouts.app')

@section('content')
<div class="container justify-content-center ">
    <div class="row">
    @if(session('message'))
        <div class="alert alert-success col-4 " >
            {{ session('message') }}
        </div>
    @endif
    </div>
    {{-- <div class="row justify-content-start">
        <a href="{{ route('apps.create') }}" class="btn btn-outline-primary rounded btn-md col-2 m-4">Ingresar nueva aplicacion</a>
    </div> --}}
    <div class="d-flex flex-column align-items-center col-12">
        <div class="col-6 my-4">
            <h4>Listado de Categorias</h4>
        </div>
        <div class="list-group  col-6">
            @foreach($categories->all() as $category)
                <a href="/apps/categories/{{ $category->id }}" class="list-group-item list-group-item-action">{{ $category->id }} - {{ $category->name }}</a>
            @endforeach

        </div>

    </div>
</div>
@endsection