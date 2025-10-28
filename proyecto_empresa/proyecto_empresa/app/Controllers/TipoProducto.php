<?php

namespace App\Controllers;

use App\Models\TipoProductoModel;
use CodeIgniter\Controller;

class TipoProducto extends Controller
{
    protected $tipoModel;

    public function __construct()
    {
        $this->tipoModel = new TipoProductoModel();
    }

    // Mostrar todos los tipos
    public function index()
    {
        $data['tipos'] = $this->tipoModel->findAll();
        return view('tipos/index', $data);
    }

    // Mostrar formulario para crear nuevo tipo
    public function create()
    {
        return view('tipos/create');
    }

    // Guardar tipo nuevo
    public function store()
    {
        $data = [
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        $this->tipoModel->save($data);

        return redirect()->to('/tipoproducto')->with('message', 'Tipo de producto guardado correctamente.');
    }
}
