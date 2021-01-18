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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AppController::class, 'list']);
Route::get('/apps', [AppController::class, 'list'])->name('list'); //se muestran todas las app
Route::get('/ver/{app}', [AppController::class, 'ver'])->name('detalle'); //se ve el detalle de una app
Route::get('/apps/categories', [AppController::class, 'listarcategorias'])->name('listarcategorias');
Route::get('/apps/categories/{id}', [AppController::class, 'listarxcategoriaTodas'])->name('listarxcategoriaTodas');

// Route::resource('/me/apps', 'App\Http\Controllers\AppController')->middleware('auth');
Route::resource('/me/apps', 'App\Http\Controllers\AppController'); //se muestran las apps segun dev/cliente, index, show, etc
//no se si la voy a usar listo solo las compradas (por categoria)
Route::get('/me/apps/categories/{id}', [AppController::class, 'listarxcategoria'])->name('listarxcategoria');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [AppController::class, 'list'])->name('home');
