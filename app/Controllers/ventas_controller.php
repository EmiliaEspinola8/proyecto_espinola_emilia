<?php
namespace App\Controllers;
use App\Models\usuario_Model;
use App\Models\ventas_cabecera_Model;
use App\Models\ventas_detalle_Model;
use App\Models\producto_Model;
Use App\Models\productos_detalle_Model;

use CodeIgniter\Controller;

class ventas_controller extends Controller{
    protected $ventas;
    protected $detalleVentas;
    protected $usuarios;
    protected $productos;
    protected $produtosDetalle;

    public function __construct(){
        helper(['form', 'url']);
        $this->ventas = new ventas_cabecera_Model();
        $this->detalleVentas = new ventas_detalle_Model();
        $this->usuarios = new usuario_Model();
        $this->productos = new producto_Model();
        $this->productosDetalle = new productos_detalle_Model();
    }

    public function registrarVenta()
    {
        $session = session();
        $usuarioID = session()->get('id_usuario');
        $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        $total = 0;
        foreach ($carrito as $producto) {
            $total += (float) $producto['precio'] * $producto['cantidad'];
        }
        $data = [
            'usuario_id' => $usuarioID,
            'total_venta' => $total,
        ];
        $this->ventas->insert($data);

        $ventaID = $this->ventas->getInsertID();

        foreach ($carrito as $producto) {
            $data = [
                'venta_id' => $ventaID,
                'producto_id' => $producto['producto_id'],
                'precio' => (float) $producto['precio'],
                'cantidad' => $producto['cantidad'],
                'subtotal' => (float) ($producto['precio'] * $producto['cantidad']),
            ];

            $productoObtenido = $this->productos->find($producto['producto_id']);
            $stock = ($productoObtenido['stock'] - $producto['cantidad']);
            $this->productos->update($producto['producto_id'], ['stock' => $stock]);
            
            if($producto['id_detalle_producto'] != $producto['producto_id']){
                    $productoDetalle = $this->productosDetalle->find($producto['id_detalle_producto']);
                    $stockDetalle = ($productoDetalle['stock'] - $producto['cantidad']);
                    $this->productosDetalle->update($producto['id_detalle_producto'], ['stock' => $stockDetalle]);
            }

            $this->detalleVentas->insert($data);
        }
        $carrito = $this->usuarios->actualizarCarrito($usuarioID, []);
        return view('cliente/carrito', ['carrito' => $carrito]);
    }

    public function listarVentas(){
        $ventas = $this->ventas->listarVentas();
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla-ventas', ['ventas' => $ventas]);
        echo view('administrador/footer');
    }

    public function detalleVenta($id){
        $ventasDetalle = $this->detalleVentas->listarVentasDetalle($id);
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla-ventas-detalle', ['ventasDetalle' => $ventasDetalle]);
        echo view('administrador/footer');
    }

    public function filtrarVentas(){
        $fechaDesde = $this->request->getPost('fecha-desde');
        $fechaHasta = $this->request->getPost('fecha-hasta');

        $fechaDesde1 = !empty($fechaDesde) ? $fechaDesde : null;
        $fechaHasta1 = !empty($fechaHasta) ? $fechaHasta : null;
        $buscar = $this->request->getPost('buscar') ?? '';

        $ventas = $this->ventas->filtrarVentas($fechaDesde1, $fechaHasta1, $buscar);
        

        return view('administrador/tabla-ventas', ['ventas' => $ventas]);
    }
}
