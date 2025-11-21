@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card border-0 shadow-sm p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-1">Iniciar sesión</h2>
                    <p class="text-muted mb-0">Accede a tu cuenta para gestionar tus productos</p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('autenticar') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control form-control-lg"
                            placeholder="tu-correo@correo.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••"
                            required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                        Entrar
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">¿Aún no tienes cuenta?</small><br>
                    <a href="{{ route('registro') }}" class="fw-semibold">Crear una cuenta</a>
                </div>
            </div>

        </div>
    </div>
@endsection
