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

    <div class="d-flex flex-column align-items-center col-xs-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">
        <div class="my-4 ">
            <h4>Listado de Categorias</h4>
        </div>
        <div class="list-group  col-12 mb-5">
            @foreach($categories->all() as $category)
                <a href="/apps/categories/{{ $category->id }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">{{ $category->name }}
                    <span class="badge badge-primary badge-pill">{{ $category->apps_count }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection