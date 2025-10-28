<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $usuarioModel = new UsuarioModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $usuarioModel->where('email', $email)->first();

        // ✅ Compara directamente contraseñas sin hash
        if ($usuario && $password === $usuario['password']) {
            // Login correcto
            session()->set([
                'id'        => $usuario['id'],
                'nombre'    => $usuario['nombre'],
                'rol'       => $usuario['rol'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            // Credenciales incorrectas
            return redirect()->back()->with('error', 'Email o contraseña incorrectos');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
