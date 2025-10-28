<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $usuarioModel  = new UsuarioModel();
        $productoModel = new ProductoModel();
        $ventaModel    = new VentaModel();

        $data = [
            'title'          => 'Dashboard',
            'usuariosCount'  => $usuarioModel->countAllResults(),
            'productosCount' => $productoModel->countAllResults(),
            'ventasCount'    => $ventaModel->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
}

