@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-center col-12">


        <div class="card m-3  col-4">
            <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center col-12">
                <img src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
                <h4 class="pt-3 pt-2">
                    {{ $app->name }}
                </h4>
                <p>
                    Price: ${{ $app->price }}
                </p>
                <div class="d-flex flex-wrap justify-content-center col-12">
                @if($app->developer != Auth::user()->id )
                    <button type="button" class="btn btn-primary  btn-sm m-1 col-8">
                        Comprar!
                    </button>
                    <button type="button" class="btn btn-primary  btn-sm m-1 col-8">
                        Agregar a la lista de deseos
                    </button>
                @endif
                </div>   
            </div>
        </div>


    </div>
</div>
@endsection