@extends('layouts.app')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 ">

    <div class=" my-5 d-flex flex-column align-items-center col-xs-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">
        <h5 class="pt-3">
            {{ $app->name }}
        </h5>   
        <div class="list-group  col-12 my-5">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Precio</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($precios->all() as $precio)
                <tr>
                    <td>{{ $precio->created_at }}</td>
                    <td class="text-right">$ {{ $precio->price }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection