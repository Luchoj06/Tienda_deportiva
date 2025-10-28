<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\ClienteModel;
use CodeIgniter\Controller;

class VentaController extends Controller
{
    protected $ventaModel;
    protected $usuarioModel;
    protected $productoModel;
    protected $clienteModel;

    public function __construct()
    {
        $this->ventaModel    = new VentaModel();
        $this->usuarioModel  = new UsuarioModel();
        $this->productoModel = new ProductoModel();
        $this->clienteModel  = new ClienteModel();
    }

    public function index()
    {
        $data['ventas']    = $this->ventaModel->findAll();
        $data['usuarios']  = $this->usuarioModel->findAll();
        $data['productos'] = $this->productoModel->findAll();
        $data['clientes']  = $this->clienteModel->findAll();

        return view('ventas/index', $data);
    }

    public function store()
    {
        $cliente_id  = $this->request->getPost('cliente_id');
        $producto_id = $this->request->getPost('producto_id');
        $cantidad    = (int) $this->request->getPost('cantidad');
        $fecha       = $this->request->getPost('fecha');

        // Usuario logueado (cajero o vendedor)
        $usuario_id = session()->get('id');

        
        $producto = $this->productoModel->find($producto_id);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $precio = $producto['precio'];
        $total  = $precio * $cantidad;

        
        $this->ventaModel->save([
            'cliente_id'  => $cliente_id,
            'usuario_id'  => $usuario_id,
            'producto_id' => $producto_id,
            'cantidad'    => $cantidad,
            'total'       => $total,
            'fecha'       => $fecha,
        ]);

        
        $nuevoStock = max(0, $producto['stock'] - $cantidad);
        $this->productoModel->update($producto_id, ['stock' => $nuevoStock]);

        return redirect()->to('/ventas');
    }

    public function update($id)
    {
        $cliente_id  = $this->request->getPost('cliente_id');
        $producto_id = $this->request->getPost('producto_id');
        $cantidad    = (int) $this->request->getPost('cantidad');
        $fecha       = $this->request->getPost('fecha');

        
        $usuario_id = session()->get('id');

        $producto = $this->productoModel->find($producto_id);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $precio = $producto['precio'];
        $total  = $precio * $cantidad;

       
        $this->ventaModel->update($id, [
            'cliente_id'  => $cliente_id,
            'usuario_id'  => $usuario_id,
            'producto_id' => $producto_id,
            'cantidad'    => $cantidad,
            'total'       => $total,
            'fecha'       => $fecha,
        ]);

        return redirect()->to('/ventas');
    }

    public function delete($id)
    {
        $this->ventaModel->delete($id);
        return redirect()->to('/ventas');
    }
}
