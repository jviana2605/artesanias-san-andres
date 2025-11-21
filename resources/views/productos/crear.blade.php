@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card border-0 shadow-sm p-4">

                <div class="mb-4">
                    <h2 class="fw-bold mb-1">Crear nuevo producto</h2>
                    <p class="text-muted mb-0">Ingrese los datos del artículo para publicarlo en el catálogo.</p>
                </div>

                <form action="{{ route('productos.guardar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre del producto <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control form-control-lg"
                            placeholder="Ej: Sombrero tejido tradicional" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4"
                            placeholder="Describa materiales, técnicas y detalles importantes">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Precio <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" name="precio" class="form-control form-control-lg"
                                placeholder="Ej: 45000" value="{{ old('precio') }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Imagen del producto</label>
                        <input type="file" name="imagen" accept="image/*" class="form-control">

                        <small class="text-muted">
                            Formatos permitidos: JPG, PNG, WEBP. Tamaño máximo recomendado 2MB.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 py-2">
                        Guardar producto
                    </button>

                </form>

            </div>
        </div>
    </div>
@endsection
