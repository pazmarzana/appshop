<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AppController::class, 'list']);
Route::get('/apps', [AppController::class, 'list'])->name('list'); //se muestran todas las app
Route::get('/ver/{app}', [AppController::class, 'ver'])->name('detalle'); //se ve el detalle de una app
Route::get('/apps/categories', [AppController::class, 'listarcategorias'])->name('listarcategorias');
Route::get('/apps/categories/{id}', [AppController::class, 'listarxcategoriaTodas'])->name('listarxcategoriaTodas');
Route::get('/masvotadas', [AppController::class, 'listarmasvotadas'])->name('listarmasvotadas');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/me/apps', 'App\Http\Controllers\AppController'); //se muestran las apps segun dev/cliente, index, show, etc
    Route::get('/me/listadeseos', [AppController::class, 'listarlistadeseos'])->name('listadeseos');
});

Auth::routes();

Route::get('/home', [AppController::class, 'list'])->name('home');
