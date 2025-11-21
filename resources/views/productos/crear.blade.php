@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Crear nuevo producto</h2>

    <form action="{{ route('productos.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre del producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar producto</button>
    </form>
@endsection
