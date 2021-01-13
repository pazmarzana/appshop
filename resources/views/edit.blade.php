@extends('layouts.app')

@section('content')
<div class="container col-md-4">

    <form method="POST" action="{{route('apps.update',['app' => $app->id]) }}" class="form-group" enctype="multipart/form-data" >
        @method('PATCH')
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
            <input type="text" name="name" class="form-control" value="{{$app->name}}"   disabled>
        </div>
        <div class="form-group m-4">
            <label for="price">Precio de Venta</label>
            <input type="number" name="price" class="form-control" value="{{old('price') ? old('price') : $app->price}}" >
        </div>

        <div class="form-control-file m-4">
            <label for="image_path">Imagen</label>
            <input type="url" name="image_path" class="form-control" value="{{old('image_path') ? old('image_path') : $app->image_path}}" >
        </div>

        <div class="form-group m-4">
            <label for="category">Categoria</label>
            <select type="text" name="category" class="form-control" disabled>
            @foreach($categories->all() as $category)
                <option {{ ( $app->category_id ) == $category->id  ? "selected" : '' }} value="{{ $category->id }}" >{{ $category->id }} - {{ $category->name }}</option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary  m-4">Guardar</button>
    </form>

</div>
@endsection