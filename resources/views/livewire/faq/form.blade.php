@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Preguntas y Respuestas
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="form-group col-md-12">
                <label for="pregunta" class="form-label">
                    Pregunta
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" id="pregunta" wire:model='faq.pregunta'>
                @error('faq.pregunta')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="tipo" class="form-label">
                    Tipos de Faq
                </label>
                <select class="form-control form-control-sm rounded-pill" id="tipo" wire:model='faq.tipo'>
                    <option value="">Seleccionar una opción</option>
                    <option value="1">Principal</option>
                    <option value="2">Secundaria</option>
                </select>
                @error('faq.tipo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="respuesta" class="form-label">
                    Respuesta
                </label>
                <textarea type="text" class="form-control form-control-sm rounded-lg" id="respuesta" wire:model='faq.respuesta'>
                </textarea>
                @error('faq.respuesta')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-sm rounded-pill btn-info"
                wire:click="{{ $form == 'create' ? 'save' : 'update' }}"
                > <i class="fas fa-save"></i> {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection





