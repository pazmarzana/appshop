@extends('layouts.app')

@section('content')
<div class="contenedor container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 justify-content-center align-items-center ">
    <div class="row justify-content-center">
    @if(session('message'))
        <div class="alert alert-success col-4 " >
            {{ session('message') }}
        </div>
    @endif
    </div>
    {{-- <div class="d-flex flex-column align-items-center col-xs-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">
        <div class="my-4">
            <h4>Lista de deseos</h4>
        </div>
    </div> --}}

    <div class="my-4 d-flex flex-wrap justify-content-center col-12">
        @if ( ($apps->count()) == 0)
            <div class="my-5 row justify-content-center col-12">
                <h6>Por el momento la lista de deseos esta vacia</h6>
            </div>
        @endif  
        @foreach($apps->all() as $app)
        <div class="card sombra m-3 col-xs-12 col-sm-5 col-md-4 col-lg-3 col-xl-2">
            <div class="card-body p-3">
                <a href="{{ route('detalle',['app' => $app->id]) }}" class="btn btn-default btn-sm m-1 small detalle">
                    <img class="imagenChica" src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
                </a>
                <h5 class="pt-3 tituloImagen">
                    {{ $app->name }}
                </h5>
                <p class="precio">
                    Precio: ${{ $app->price }}
                </p>
                @if ( Auth::user()->type ==1)
                    <div class="d-flex flex-wrap justify-content-end col-12">
                        <a href="{{ route('detalle',['app' => $app->id]) }}" class="btn btn-default btn-sm m-1 small detalle"><i>Ver detalle</i></a>
                    </div>    
                @endif
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
        <div class="d-flex pagination pagination-sm">
        {{ $apps->links() }}
        </div>
    </div>

</div>
@endsection