@extends('layouts.app')

@section('content')
<div class="contenedor container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 justify-content-center">
    <div class="d-flex flex-wrap justify-content-center col-12">
        <div class="card m-3 col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
                <img class="imagenGrande m-3" src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
                <h5 class="pt-3 pt-2">
                    {{ $app->name }}
                </h5>
                <p>
                    Precio: ${{ $app->price }}
                </p>
                @guest
                @else
                    @if ( Auth::user()->type ==0)
                        <div class="d-flex flex-wrap justify-content-center col-xs-10 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        @if($app->developer != Auth::user()->id )
                            <button type="button" onClick="mostrarAlerta('Debe ingresar como usuario Cliente para poder comprar una aplicacion')" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                                Comprar!
                            </button>
                            <button type="button" onClick="mostrarAlerta('Debe ingresar como usuario Cliente para poder agregar una aplicacion a la lista de deseos')" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                                Agregar a la lista de deseos
                            </button>
                        @endif
                        </div>   
                    @endif    
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection