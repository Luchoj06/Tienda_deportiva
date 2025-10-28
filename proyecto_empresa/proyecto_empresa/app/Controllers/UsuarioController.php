<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $data['usuarios'] = $this->usuarioModel->findAll();
        return view('usuarios/index', $data);
    }

    public function create()
    {
        return view('usuarios/create');
    }

    public function store()
    {
        $this->usuarioModel->save([
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // 🔐 encriptada
            'rol'      => $this->request->getPost('rol'),
        ]);
 
        return redirect()->to('/usuarios');
    }

    public function edit($id)
    {
        $data['usuario'] = $this->usuarioModel->find($id);
        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email'  => $this->request->getPost('email'),
            'rol'    => $this->request->getPost('rol'),
        ];

        // Si se envió una nueva contrasena se encripta
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->usuarioModel->update($id, $data);

        return redirect()->to('/usuarios');
    }

    public function delete($id)
    {
        $this->usuarioModel->delete($id);
        return redirect()->to('/usuarios');
    }
}
