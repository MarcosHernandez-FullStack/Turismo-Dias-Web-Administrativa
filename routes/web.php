<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BienvenidoComponent;
use App\Http\Controllers\Web\ConfiguracionController;
use App\Http\Controllers\Adds\ImagenTemporalController;
use App\Http\Livewire\Ambiente\AmbienteComponent;
use App\Http\Livewire\Faq\FaqComponent;
use App\Http\Livewire\Institucional\InstitucionalComponent;
use App\Http\Livewire\Ruta\RutaComponent;
use App\Http\Livewire\TerminoCondicion\TerminoCondicionComponent;
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

Route::get('/', BienvenidoComponent::class)->name('bienvenido');
Route::get('/configuracion', [ConfiguracionController::class, 'render'])->name('configuracion');

Route::get('/ambientes', AmbienteComponent::class)->name('ambientes');

Route::get('/faqs', FaqComponent::class)->name('faqs');

Route::get('/institucional', InstitucionalComponent::class)->name('institucional');

Route::get('/rutas', RutaComponent::class)->name('rutas');

Route::get('/terminos-condiciones', TerminoCondicionComponent::class)->name('terminos-condiciones');

// Route::get('/valores', ValorComponent::class)->name('valores'); //en detalle insinstitucional


