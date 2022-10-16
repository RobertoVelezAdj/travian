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
Route::put('/aldeas/nueva', [App\Http\Controllers\AldeaController::class, 'generadorAldea'])->name('aldeas.nueva');
Route::put('/aldeas/borrar', [App\Http\Controllers\AldeaController::class, 'borrarAldea'])->name('aldeas.borrar');
Route::put('/aldeas/editar', [App\Http\Controllers\AldeaController::class, 'editarAldea'])->name('aldeas.editar');
Route::get('/aldeas/tareas', [App\Http\Controllers\AldeaController::class, 'verTareas'])->name('aldeas.tareas');
Route::put('/aldeas/tareanueva', [App\Http\Controllers\AldeaController::class, 'nuevaTarea'])->name('tarea.nueva');
Route::put('/aldeas/completarTarea', [App\Http\Controllers\AldeaController::class, 'completarTarea'])->name('tarea.completar');
Route::put('/aldeas/editartarea', [App\Http\Controllers\AldeaController::class, 'editartarea'])->name('tarea.editar');
Route::get('/aldeas/edificios', [App\Http\Controllers\AldeaController::class, 'edificios'])->name('aldea.edificios');
Route::put('/aldeas/edificioseditar', [App\Http\Controllers\AldeaController::class, 'edificioseditar'])->name('aldea.edificioseditar');

Route::get('/vacas', [App\Http\Controllers\VacasController::class, 'inicio'])->name('vacas');
Route::get('/vacas/listas', [App\Http\Controllers\VacasController::class, 'listaVacas'])->name('ListasVacas');
Route::put('/vacas/insertarVacas', [App\Http\Controllers\VacasController::class, 'insertarVacas'])->name('insertarVacas');

Route::put('/vacas/calculovacas', [App\Http\Controllers\VacasController::class, 'calculovacas'])->name('calculovacas');

Route::get('/adminUsuarios', [App\Http\Controllers\UserController::class, 'index'])->name('adminUsuarios');

