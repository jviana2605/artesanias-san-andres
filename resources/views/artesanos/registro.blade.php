@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">

            <div class="card border-0 shadow-sm p-4">

                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-1">Registro de artesano</h2>
                    <p class="text-muted mb-0">Crea tu cuenta para publicar y gestionar tus productos</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('registrar') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" name="nombre" class="form-control form-control-lg"
                            placeholder="Ej: Ana Martínez" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control form-control-lg"
                            placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control form-control-lg"
                            placeholder="Ej: 3001234567" value="{{ old('telefono') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">
                        Registrarse
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">¿Ya tienes cuenta?</small><br>
                    <a href="{{ route('login') }}" class="fw-semibold">
                        Iniciar sesión
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
