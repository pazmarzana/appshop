@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-between col-12">

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
                </div>
            </div>
            @endforeach

    </div>
</div>
@endsection