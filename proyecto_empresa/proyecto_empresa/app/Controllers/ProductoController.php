<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\TipoProductoModel;
use CodeIgniter\Controller;

class ProductoController extends Controller
{
    protected $productoModel;
    protected $tipoModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
        $this->tipoModel = new TipoProductoModel();
    }

    // 📦 Listar todos los productos
    public function index()
    {
        // Traer productos junto con su tipo (LEFT JOIN)
        $data['productos'] = $this->productoModel
            ->select('productos.*, tipos_productos.nombre AS tipo_nombre')
            ->join('tipos_productos', 'tipos_productos.id = productos.tipo_producto_id', 'left')
            ->findAll();

        // Traer lista de tipos de productos para los selects
        $data['tipos'] = $this->tipoModel->findAll();

        return view('productos/index', $data);
    }

    // ➕ Crear un nuevo producto
    public function store()
    {
        $data = [
            'nombre'           => $this->request->getPost('nombre'),
            'descripcion'      => $this->request->getPost('descripcion'),
            'precio'           => $this->request->getPost('precio'),
            'stock'            => $this->request->getPost('stock'),
            'tipo_producto_id' => $this->request->getPost('tipo_producto_id') ?: null,
        ];

        $this->productoModel->insert($data);

        return redirect()->to('/productos')
            ->with('message', '✅ Producto guardado correctamente.');
    }

    // ✏️ Actualizar un producto existente
    public function update($id)
    {
        $data = [
            'nombre'           => $this->request->getPost('nombre'),
            'descripcion'      => $this->request->getPost('descripcion'),
            'precio'           => $this->request->getPost('precio'),
            'stock'            => $this->request->getPost('stock'),
            'tipo_producto_id' => $this->request->getPost('tipo_producto_id') ?: null,
        ];

        $this->productoModel->update($id, $data);

        return redirect()->to('/productos')
            ->with('message', '✏️ Producto actualizado correctamente.');
    }

    // 🗑️ Eliminar un producto
    public function delete($id)
    {
        $this->productoModel->delete($id);

        return redirect()->to('/productos')
            ->with('message', '🗑️ Producto eliminado correctamente.');
    }
}
