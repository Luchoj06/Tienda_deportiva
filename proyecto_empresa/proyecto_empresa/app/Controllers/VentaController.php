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
        $data = [
            'ventas'    => $this->ventaModel->findAll(),
            'usuarios'  => $this->usuarioModel->findAll(),
            'productos' => $this->productoModel->findAll(),
            'clientes'  => $this->clienteModel->findAll()
        ];

        return view('ventas/index', $data);
    }

    // 🔹 Función privada para evitar duplicidad
    private function obtenerDatosVenta()
    {
        $cliente_id  = $this->request->getPost('cliente_id');
        $producto_id = $this->request->getPost('producto_id');
        $cantidad    = (int) $this->request->getPost('cantidad');
        $fecha       = $this->request->getPost('fecha');
        $usuario_id  = session()->get('id');

        $producto = $this->productoModel->find($producto_id);

        if (!$producto) {
            throw new \Exception('Producto no encontrado');
        }

        $precio = $producto['precio'];
        $total  = $precio * $cantidad;

        return compact('cliente_id', 'producto_id', 'cantidad', 'fecha', 'usuario_id', 'total', 'producto');
    }

    public function store()
    {
        try {
            $datos = $this->obtenerDatosVenta();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        // Guardar venta
        $this->ventaModel->save([
            'cliente_id'  => $datos['cliente_id'],
            'usuario_id'  => $datos['usuario_id'],
            'producto_id' => $datos['producto_id'],
            'cantidad'    => $datos['cantidad'],
            'total'       => $datos['total'],
            'fecha'       => $datos['fecha'],
        ]);

        // Actualizar stock
        $nuevoStock = max(0, $datos['producto']['stock'] - $datos['cantidad']);
        $this->productoModel->update($datos['producto_id'], ['stock' => $nuevoStock]);

        return redirect()->to('/ventas')->with('success', 'Venta registrada correctamente');
    }

    public function update($id)
    {
        try {
            $datos = $this->obtenerDatosVenta();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $this->ventaModel->update($id, [
            'cliente_id'  => $datos['cliente_id'],
            'usuario_id'  => $datos['usuario_id'],
            'producto_id' => $datos['producto_id'],
            'cantidad'    => $datos['cantidad'],
            'total'       => $datos['total'],
            'fecha'       => $datos['fecha'],
        ]);

        return redirect()->to('/ventas')->with('success', 'Venta actualizada correctamente');
    }

    public function delete($id)
    {
        $this->ventaModel->delete($id);
        return redirect()->to('/ventas')->with('success', 'Venta eliminada correctamente');
    }
}
