@extends('layouts.app')

@section('content')
<div class="contenedor container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 justify-content-center">

    {{-- <div class="d-flex flex-wrap justify-content-center col-12 my-4 ">
        <h4>{{$app->name}}</h4>
    </div> --}}
    <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
        <img class="imagenGrande m-3" src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
        <h5 class="pt-3">
            {{ $app->name }}
        </h5>     
        <form method="POST" action="{{route('guardarrate',['id' => $app->id])}}" class="form-group d-flex flex-column align-items-center justify-content-center" enctype="multipart/form-data" >
            @csrf
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="rating col-6">
                <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                <label for="star5" class="star">☆</label>
                <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                <label for="star4"  class="star">☆</label>
                <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                <label for="star3"  class="star">☆</label>
                <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                <label for="star2"  class="star">☆</label>
                <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                <label for="star1"  class="star">☆</label>
            </div>
            
            <button type="submit" class="btn btn-primary  my-4">Enviar</button>
        </form>
    </div>      

</div>
@endsection