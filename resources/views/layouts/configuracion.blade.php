@extends('layouts.principal')

@section('content-header')
<div class="row mb-2">
    <div class="col-12">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="card-title">Configuración de Página Web</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('bienvenido')}}">Inicio</a></li>
                            <li class="breadcrumb-item active">Configuración</li>
                        </ol>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="row ">
            <div class="col-12 col-lg-5 mx-auto mb-3">
                @livewire('configuracion.general-component')
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-lg-5 mx-auto mb-3">
                @livewire('configuracion.contacto-component')
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-lg-5 mx-auto mb-3">
                @livewire('configuracion.imagenes-component')
            </div>
        </div>
    </div>
</div>


@endsection