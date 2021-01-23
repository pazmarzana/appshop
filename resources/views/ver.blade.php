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
                    <div class="d-flex flex-wrap justify-content-center col-xs-10 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <button type="button" onClick="mostrarAlerta('Primero debe loguearse para poder comprar una aplicacion')" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                            Comprar!
                        </button>
                        <button type="button" onClick="mostrarAlerta('Primero debe loguearse para poder agregar una aplicacion a la lista de deseos')" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                            Agregar a la lista de deseos
                        </button>
                    </div>   
                @else
                    @if ( Auth::user()->type ==0)
                        <div class="d-flex flex-wrap justify-content-center col-xs-10 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        @if($app->developer != Auth::user()->id )
                            <button type="button" onClick="mostrarAlerta('Debe ingresar como usuario Cliente para poder comprar una aplicacion')" class="btn btn-primary  btn-sm m-1 col-12">
                                Comprar!
                            </button>
                            <button type="button" onClick="mostrarAlerta('Debe ingresar como usuario Cliente para poder agregar una aplicacion a la lista de deseos')" class="btn btn-primary  btn-sm m-1 col-12">
                                Agregar a la lista de deseos
                            </button>
                        @endif
                        </div>   
                    @endif    
                    @if ( Auth::user()->type ==1)
                        <div class="d-flex flex-wrap justify-content-center col-xs-10 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                            @if ( $yacomprada > 0)
                                <button type="button" onClick="deleteDataPurchase({{ $yacomprada }})" class="btn btn-primary  btn-sm m-1 col-12">
                                    Anular compra
                                </button>
                            @else
                                <button type="button" onClick="postDataPurchase({{ $app->id}})" class="btn btn-primary  btn-sm m-1 col-12">
                                    Comprar!
                                </button>
                            @endif
                            @if ( $yadeseada > 0)
                                <button type="button" onClick="deleteDataWish({{ $yadeseada}})" class="btn btn-primary  btn-sm m-1 col-12">
                                    Quitar de la lista de deseos
                                </button>
                            @else
                                <button type="button" onClick="postDataWish({{ $app->id}})" class="btn btn-primary  btn-sm m-1 col-12">
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

function mostrarAlerta($texto) {
  alert($texto);
};

async function postDataPurchase($id){
    const logueado = @json(Auth::check());
    if ( logueado ) {
            const url = "http://127.0.0.1:8000/api/buy";
            const data = {
                app_id: $id
            };
            const options = {
                withCredentials: true, 
                headers: {
                        'Access-Control-Allow-Origin': 'http://127.0.0.1:8000/',
                        'Content-Type': 'application/json',
                    }
                };
                try{
                    let res= await axios.post(url, data, options),
                    json= await res.data;
                    mostrarAlerta(`${json.Result}`);
                    window.location.href = "{{ route('apps.index') }}";
                }catch(err){
                    let message = err.response.statusText || "Ocurrio un error";
                    mostrarAlerta(`Error ${err.response.status}: ${message}`);
                }finally{
                }
      }else{
        window.location.href = "{{ route('login') }}";
      }  
};

async function deleteDataPurchase($id){
    const logueado = @json(Auth::check());
    if ( logueado ) {
            const url = `http://127.0.0.1:8000/api/buy/${$id}`;
            const data = {
            };
            const options = {
                withCredentials: true, 
                headers: {
                        'Access-Control-Allow-Origin': 'http://127.0.0.1:8000/',
                        'Content-Type': 'application/json',
                    }
                };
                try{
                    let res= await axios.delete(url, data, options),
                    json= await res.data;
                    mostrarAlerta(`${json.Result}`);
                    window.location.href = "{{ route('apps.index') }}";
                }catch(err){
                    let message = err.response.statusText || "Ocurrio un error";
                    mostrarAlerta(`Error ${err.response.status}: ${message}`);
                }finally{
                }
      }else{
        window.location.href = "{{ route('login') }}";
      }  
};

async function postDataWish($id){
    const logueado = @json(Auth::check());
    if ( logueado ) {
            const url = "http://127.0.0.1:8000/api/wish";
            const data = {
                app_id: $id
            };
            const options = {
                withCredentials: true, 
                headers: {
                        'Access-Control-Allow-Origin': 'http://127.0.0.1:8000/',
                        'Content-Type': 'application/json',
                    }
                };
                try{
                    let res= await axios.post(url, data, options),
                    json= await res.data;
                    mostrarAlerta(`${json.Result}`);
                    window.location.href = "{{ route('listadeseos') }}";
                }catch(err){
                    let message = err.response.statusText || "Ocurrio un error";
                    mostrarAlerta(`Error ${err.response.status}: ${message}`);
                }finally{
                }
      }else{
        window.location.href = "{{ route('login') }}";
      }  
};

async function deleteDataWish($id){
    const logueado = @json(Auth::check());
    if ( logueado ) {
            const url = `http://127.0.0.1:8000/api/wish/${$id}`;
            const data = {
            };
            const options = {
                withCredentials: true, 
                headers: {
                        'Access-Control-Allow-Origin': 'http://127.0.0.1:8000/',
                        'Content-Type': 'application/json',
                    }
                };
                try{
                    let res= await axios.delete(url, data, options),
                    json= await res.data;
                    mostrarAlerta(`${json.Result}`);
                    window.location.href = "{{ route('listadeseos') }}";
                }catch(err){
                    let message = err.response.statusText || "Ocurrio un error";
                    mostrarAlerta(`Error ${err.response.status}: ${message}`);
                }finally{
                }
      }else{
        window.location.href = "{{ route('login') }}";
      }  
};
</script>
