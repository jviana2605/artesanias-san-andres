<?php

namespace App\Http\Controllers;

use App\Models\Artesano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArtesanoController extends Controller
{

    // formulario de registro
    public function registro()
    {
        return view('artesanos.registro');
    }

    // guardar registro
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:artesanos,email',
            'telefono' => 'nullable',
            'password' => 'required|min:6',
        ]);

        Artesano::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puede iniciar sesión.');
    }

    // formulario login
    public function login()
    {
        return view('artesanos.login');
    }

    // procesar login
    public function autenticar(Request $request)
    {
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
