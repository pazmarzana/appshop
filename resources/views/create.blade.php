@extends('layouts.app')

@section('content')
<div class="container col-md-4">

    <form method="POST" action="{{url('/me/apps')}}" class="form-group" enctype="multipart/form-data" >
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
        <div class="form-group m-4">
            <label for="name">Nombre de la aplicación</label>
            <input type="text" name="name" minlength="2" maxlength="30" class="form-control" value="{{old('name')}}" required>
        </div>
        <div class="form-group m-4">
            <label for="price">Precio de Venta</label>
            <input type="number" step="0.01" min=0 max=200000000 name="price" class="form-control" value="{{old('price')}}" required>
        </div>
        <div class="m-4">
            <label for="image_path">Imagen</label>
            <input type="url" name="image_path" class="form-control" value="{{old('image_path')}}" required>
        </div>
        <div class="form-group m-4">
            <label for="category">Categoria</label>
            <select type="text" name="category" class="form-control" >
            @foreach($categories->all() as $category)
                <option {{ old('category') == $category->id  ? "selected" : '' }} value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary  m-4">Guardar</button>
    </form>

</div>
@endsection