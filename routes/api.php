<?php

use App\Http\Controllers\Api\FAQController;
use App\Http\Controllers\Api\LibroReclamacionController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\InstitucionalController;
use App\Http\Controllers\Api\BienvenidoController;
use App\Http\Controllers\Api\FooterController;
use App\Http\Controllers\Api\TerminoCondicionController;
use App\Http\Controllers\Api\RutaController;
use App\Http\Controllers\Api\FeriadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'faq'], function ($router) {
    Route::get('/all', [FAQController::class, 'index']);
});

Route::group(['prefix' => 'servicio'], function ($router) {
    Route::get('/all', [ServicioController::class, 'index']);
});

Route::group(['prefix' => 'nosotros'], function ($router) {
    Route::get('/all', [InstitucionalController::class, 'index']);
});

Route::group(['prefix' => 'bienvenido'], function ($router) {
    Route::get('/all', [BienvenidoController::class, 'index']);
});
Route::group(['prefix' => 'libro-reclamacion'], function ($router) {
    Route::post('/add', [LibroReclamacionController::class, 'store']);
    Route::get('/all', [LibroReclamacionController::class, 'index']);
});

Route::group(['prefix' => 'configuracion'], function ($router) {
    Route::get('/all', [FooterController::class, 'index']);
});

Route::group(['prefix' => 'termino-condicion'], function ($router) {
    Route::get('/all', [TerminoCondicionController::class, 'index']);
});

Route::group(['prefix' => 'rutas'], function ($router) {
    Route::get('/principal', [RutaController::class, 'principal']);
    Route::get('/detallesDeUnaCiudad/{ciudad_id}', [RutaController::class, 'detallesDeUnaCiudad']);

});

Route::group(['prefix' => 'feriados'], function ($router) {
    Route::get('/all', [FeriadoController::class, 'index']);
});

