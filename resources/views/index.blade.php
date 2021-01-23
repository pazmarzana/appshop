@extends('layouts.app')

@section('content')
<div class="contenedor container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 justify-content-center">
    <div class="row justify-content-center">
    @if(session('message'))
        <div class="alert alert-success col-xs-6 col-sm-5 col-md-4 col-lg-3 col-xl-3 text-center" >
            {{ session('message') }}
        </div>
    @endif
    </div>

    @guest
    @else
        @if ( Auth::user()->type ==0)
            <div class="row justify-content-center">
                <a href="{{ route('apps.create') }}" class="btn btn-outline-primary rounded btn-md col-xs-6 col-sm-5 col-md-4 col-lg-3 col-xl-3 m-4">Ingresar nueva aplicacion</a>
            </div>
            @if ( ($apps->count()) == 0)
                <div class="my-5 row justify-content-center col-12">
                    <h6>Por el momento no tienes aplicaciones desarrolladas</h6>
                </div>
            @endif  
        @else  
            {{-- <div class="my-4 row justify-content-center">
                <h4>Aplicaciones Adquiridas</h4>
            </div> --}}
            @if ( ($apps->count()) == 0)
                <div class="my-5 row justify-content-center col-12">
                    <h6>Por el momento no ha comprado ninguna aplicacion</h6>
                </div>
            @endif  
        @endif  
    @endguest 
    <div class="my-4 d-flex flex-wrap justify-content-center col-12">
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
                @guest
                @else
                    @if ( Auth::user()->type ==0)
                        <div class="d-flex flex-nowrap justify-content-end col-12 px-0">
                        <a href="{{ route('apps.show',['app' => $app]) }}" class="btn btn-default btn-sm m-1 text-white"><i class="far fa-eye text-secondary"></i></a>
                        <a href="{{ route('apps.edit',['app' => $app]) }}" class="btn btn-default btn-sm m-1"><i class="fas fa-pencil-alt text-secondary"></i></a>
                        <form method="POST" action="{{ route('apps.destroy',['app' => $app]) }}"  class="d-inline-block">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-default  btn-sm m-1 ">
                                <i class="far fa-trash-alt text-secondary"></i>
                            </button>
                        </form>
                        </div>    
                    @endif    
                    @if ( Auth::user()->type ==1)
                        <div class="d-flex flex-wrap justify-content-end col-12">
                            <a href="{{ route('detalle',['app' => $app->id]) }}" class="btn btn-default btn-sm m-1 small detalle"><i>Ver detalle</i></a>
                        </div>    
                    @endif
                @endguest
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