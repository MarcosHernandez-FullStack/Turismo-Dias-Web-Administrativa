<?php

use App\Http\Controllers\Web\ConfiguracionController;
use App\Http\Livewire\Ambiente\AmbienteComponent;
use App\Http\Livewire\Ciudad\CiudadComponent;
use App\Http\Livewire\Faq\FaqComponent;
use App\Http\Livewire\Feriado\FeriadoComponent;
use App\Http\Livewire\InicioSesion\InicioSesionComponent;
use App\Http\Livewire\Institucional\InstitucionalComponent;
use App\Http\Livewire\LibroReclamacion\LibroReclamacionComponent;
use App\Http\Livewire\Ruta\RutaComponent;
use App\Http\Livewire\Servicios\ServicioComponent;
use App\Http\Livewire\TerminoCondicion\TerminoCondicionComponent;
use Illuminate\Support\Facades\Route;

// use App\Http\Livewire\Valor\ValorComponent;
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

/* Route::get('/', function () {
return view('welcome');
}); */

//Route::get('/', BienvenidoComponent::class)->name('bienvenido');
Route::get('/inicio-sesion', InicioSesionComponent::class)->name('inicio-sesion');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('configuracion');
    })->name('bienvenido');
    Route::get('/configuracion', [ConfiguracionController::class, 'render'])->name('configuracion');

    Route::get('/servicios', ServicioComponent::class)->name('servicios');

    Route::get('/ambientes', AmbienteComponent::class)->name('ambientes');

    Route::get('/libro-reclamaciones', LibroReclamacionComponent::class)->name('libro-reclamaciones');

    Route::get('/faqs', FaqComponent::class)->name('faqs');

    Route::get('/institucional', InstitucionalComponent::class)->name('institucional');

    Route::get('/rutas', RutaComponent::class)->name('rutas');

    Route::get('/ciudades', CiudadComponent::class)->name('ciudades');

    Route::get('/terminos-condiciones', TerminoCondicionComponent::class)->name('terminos-condiciones');

    Route::get('/eventos', FeriadoComponent::class)->name('eventos');

});
