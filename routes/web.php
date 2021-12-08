<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lenguajesController;
use App\Http\Controllers\estandaresController;
use App\Http\Controllers\apartadosController;
use App\Http\Controllers\reglasController;
use App\Http\Controllers\valoresController;
use App\Http\Controllers\archivosController;


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

Route::get('home', function () {
    return view('welcome');
});


Route::resource('lenguajes', lenguajesController::class);
Route::resource('estandares', estandaresController::class);
Route::resource('apartados', apartadosController::class);
Route::resource('reglas', reglasController::class);
Route::resource('valores', valoresController::class);
Route::resource('automata', automataController::class);
Route::resource('archivos', archivosController::class);

Route::get('lenguaje_estandar/{id_lenguaje}',[lenguajesController::class,'lenguaje_estandar']);
Route::get('estandar_apartado/{id_estandar}',[estandaresController::class,'estandar_apartado']);
Route::get('apartado_reglas/{id_apartado}',[apartadosController::class,'apartado_reglas']);
Route::get('regla_valor/{id_regla}',[reglasController::class,'regla_valor']);
Route::get('especifico/{id_regla}',[reglasController::class,'especifico']);

Route::get('buscar_estandar/{id_lenguaje}',[apartadosController::class,'buscar_estandar']);
Route::get('buscar_apartado/{id_estandar}',[reglasController::class,'buscar_apartado']);
Route::get('buscar_reglav/{id_apartado}',[valoresController::class,'buscar_reglav']);


Route::get('lenguaje_compatible/{id}',[archivosController::class,'lenguaje_compatible']);
Route::get('select_estandar/{id_len}/{id_arc}',[archivosController::class,'select_estandar']);
Route::get('evaluar/{id_est}/{id_arc}',[archivosController::class,'evaluar']);
Route::get('leer_archivo/{ruta}',[archivosController::class,'leer_archivo']);
Route::get('pruebas/{id}',[lenguajesController::class,'pruebas']);

Route::get('errores_est/{errores}/{id_lenguaje}',[estandaresController::class,'errores_est']);
Route::get('errores_ap/{errores}/{id_estandar}',[apartadosController::class,'errores_ap']);
Route::get('errores_reg/{errores}/{id_apartado}',[reglasController::class,'errores_reg']);
Route::get('errores_val/{errores}/{id_regla}',[valoresController::class,'errores_val']);
Route::get('errores_arc/{errores}',[archivosController::class,'errores_arc']);

