<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\VentaModel;
use CodeIgniter\Controller;

class ClienteController extends Controller
{
    protected $clienteModel;
    protected $ventaModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
        $this->ventaModel   = new VentaModel();
    }

    public function index()
    {
        $data['clientes'] = $this->clienteModel->findAll();
        return view('clientes/index', $data);
    }

    public function store()
    {
        $this->clienteModel->save([
            'nombre'    => $this->request->getPost('nombre'),
            'email'     => $this->request->getPost('email'),
            'telefono'  => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
        ]);

        return redirect()->to('/clientes');
    }

    public function update($id)
    {
        $this->clienteModel->update($id, [
            'nombre'    => $this->request->getPost('nombre'),
            'email'     => $this->request->getPost('email'),
            'telefono'  => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
        ]);

        return redirect()->to('/clientes');
    }

    public function delete($id)
    {
        $this->clienteModel->delete($id);
        return redirect()->to('/clientes');
    }

    // ✅ Ver compras de un cliente
    public function compras($id)
    {
        $cliente = $this->clienteModel->find($id);

        if (!$cliente) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Cliente con ID $id no encontrado");
        }

        // Traer ventas simples
        // $ventas = $this->ventaModel->where('cliente_id', $id)->findAll();

        // O si quieres con JOIN a productos
        $ventas = $this->ventaModel->getVentasConProductos($id);

        $data = [
            'cliente' => $cliente,
            'ventas'  => $ventas
        ];

        return view('clientes/compras', $data);
    }
}
