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

    <div class="d-flex flex-wrap justify-content-center col-12">
        @foreach($apps as $app)
        <div class="card m-3 ">
            <div class="card-body p-3">
                <img src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
                <h4 class="pt-3 pt-2">
                    {{ $app->appName }}
                </h4>
                <p>
                    Price: ${{ $app->price }}
                </p>
                <div class="d-flex flex-wrap justify-content-end col-12">
                    <a href="{{ route('apps.show',['app' => $app->appId]) }}" class="btn btn-default btn-sm m-1 text-white"><i class="far fa-eye text-secondary"></i></a>
                </div>   
  
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection