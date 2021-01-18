@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if(session('message'))
        <div class="alert alert-success col-4 " >
            {{ session('message') }}
        </div>
    @endif
    </div>
    @guest
    @else
    @if ( Auth::user()->type ==0)
        <div class="row justify-content-start">
            <a href="{{ route('apps.create') }}" class="btn btn-outline-primary rounded btn-md col-2 m-4">Ingresar nueva aplicacion</a>
        </div>
    @endif  
    @endguest 
    <div class="d-flex flex-wrap justify-content-center col-12">
        @foreach($apps->all() as $app)
        <div class="card m-3 ">
            <div class="card-body p-3">
                <img src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
                <h4 class="pt-3 pt-2">
                    {{ $app->name }}
                </h4>
                <p>
                    Price: ${{ $app->price }}
                </p>

                @guest
                    <div class="d-flex flex-wrap justify-content-end col-12">
                        <a href="{{ route('detalle',['app' => $app->id]) }}" class="btn btn-default btn-sm m-1 small"><i>Ver detalle</i></a>
                    </div>    
                @else
                    @if ( Auth::user()->type ==0)
                        <div class="d-flex flex-wrap justify-content-end col-12">
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
                            <a href="{{ route('detalle',['app' => $app->id]) }}" class="btn btn-default btn-sm m-1 small"><i>Ver detalle</i></a>
                        </div>    
                    @endif
                @endguest


            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection