<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/index'; // Ruta a la que se redirige después del inicio de sesión

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/'); // Ruta a la que se redirige después de cerrar sesión
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Vista personalizada para el formulario de inicio de sesión
    }

    // Puedes agregar otras funciones o personalizaciones según sea necesario
}
