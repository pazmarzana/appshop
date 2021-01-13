@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                       <br> 
                    <a href="http://appshop.com.devel/apps">apps generico</a> <br> 
                    <a href="http://appshop.com.devel/me/apps">apps</a> <br> 
                    <a href="http://appshop.com.devel/me/apps/create">apps - create</a> <br> 
                    <a href="http://appshop.com.devel/me/apps/update">apps - update</a> <br> 
                    <a href="http://appshop.com.devel/me/apps/delete">apps - delete</a> <br> 
                    <a href="http://appshop.com.devel/me/apps/show/{app}">apps - show</a> <br> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
