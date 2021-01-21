@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-center col-12">


        <div class="card m-3  col-6 p-3">
            <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
                <img class="imagenGrande m-3" src="{{ $app->image_path }}" alt="{{ $app->image_path }}"/>
                <h4 class="pt-3 pt-2">
                    {{ $app->name }}
                </h4>
                <p>
                    Price: ${{ $app->price }}
                </p>

                @guest
                    <div class="row">
                        <a href="{{ route('login') }}" class="d-flex flex-wrap justify-content-center col-12 my-2">
                        <button type="button" class="btn btn-primary col-12">
                           Comprar!
                        </button>
                        </a> 
                        <a href="{{ route('login') }}" class="d-flex flex-wrap justify-content-center col-12 my-2">
                        <button type="button" class="btn btn-primary  col-12">
                           Agregar a la lista de deseos
                        </button>
                        </a> 
                    </div>
                    {{-- <div class="d-flex flex-wrap justify-content-center col-12">
                        <button type="button" onClick="postData({{ $app->id }})" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                            Comprar!
                        </button>
                        <button type="button" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                            Agregar a la lista de deseos
                        </button>
                    </div>        --}}
                @else
                    @if ( Auth::user()->type ==0)
                        <div class="d-flex flex-wrap justify-content-center col-12">
                        @if($app->developer != Auth::user()->id )
                            <button type="button" onClick="postData({{ $app->id}})" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                                Comprar!
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                                Agregar a la lista de deseos
                            </button>
                        @endif
                        </div>   
                    @endif    
                    @if ( Auth::user()->type ==1)
                        <div class="d-flex flex-wrap justify-content-center col-12">
                            <button type="button" onClick="postData({{ $app->id}})" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                                Comprar!
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm m-1 col-lg-8 col-md-12">
                                Agregar a la lista de deseos
                            </button>
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

async function postData($id){
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
                    
                    console.log("ESTOY EN EL TRY2");
                    console.log(res,json);
                    window.location.href = "{{ route('apps.index') }}";
                }catch(err){
                    console.log("estoy en el catch2", err.response);
                }finally{
                }
      }else{
        window.location.href = "{{ route('login') }}";
      }  
};
</script>
