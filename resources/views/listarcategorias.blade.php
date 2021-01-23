@extends('layouts.app')

@section('content')
<div class="contenedor d-flex flex-column justify-content-center align-items-center container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 ">
    <div class="row">
    @if(session('message'))
        <div class="alert alert-success col-4 " >
            {{ session('message') }}
        </div>
    @endif
    </div>

    <div class="d-flex flex-column align-items-center col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-5">
        <div class="my-4 ">
            <h4>Listado de Categorias</h4>
        </div>
        <div class="list-group ">
            @foreach($categories->all() as $category)
                <a href="/apps/categories/{{ $category->id }}" class="list-group-item list-group-item-action">{{ $category->name }} - ({{ $category->apps_count }})</a>
            @endforeach
        </div>
    </div>
</div>
@endsection