<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/construcciones', [App\Http\Controllers\ConstruccionesController::class, 'inicio'])->name('construcciones');
Route::get('/aldeas', [App\Http\Controllers\AldeaController::class, 'inicio'])->name('aldeas');
Route::get('/vacas', [App\Http\Controllers\VacasController::class, 'inicio'])->name('vacas');
Route::get('/vacas/cargarVacas', [App\Http\Controllers\VacasController::class, 'cargaVacas'])->name('cargaVacas');
Route::get('/adminUsuarios', [App\Http\Controllers\UserController::class, 'index'])->name('adminUsuarios');