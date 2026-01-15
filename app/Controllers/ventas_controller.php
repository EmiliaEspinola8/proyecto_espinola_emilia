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
    $usuarioID = session()->get('id_usuario');
    $carrito = $this->usuarios->obtenerCarrito($usuarioID);

    $idsDetalle = array_keys($carrito);
    $detalles = $this->productosDetalle->obtenerDetallesCarrito($idsDetalle);

    $total = 0;

    foreach ($detalles as $detalle) {
        $cantidad = $carrito[$detalle['id_producto']]['cantidad'];

        if ($detalle['stock'] < $cantidad) {
            $this->usuarios->actualizarCarrito($usuarioID, []);
            session()->setFlashdata('error', 'No hay stock suficiente para completar la compra.');
            return view('cliente/carrito', ['carrito' => []]);
        }

        $total += $detalle['precio'] * $cantidad;
    }
    
    $this->ventas->insert([
        'usuario_id' => $usuarioID,
        'total_venta' => $total
    ]);

    $ventaID = $this->ventas->getInsertID();

    foreach ($detalles as $detalle) {

        $cantidad = $carrito[$detalle['id_producto']]['cantidad'];
        $subtotal = $detalle['precio'] * $cantidad;

        $this->detalleVentas->insert([
            'venta_id'   => $ventaID,
            'producto_id' => $detalle['producto_id'],
            'producto_detalle_id' => $detalle['id_producto'],
            'color' => $detalle['color'],
            'talle' => $detalle['talle'],
            'precio'     => $detalle['precio'],
            'cantidad'   => $cantidad,
            'subtotal'   => $subtotal
        ]);

        $this->productosDetalle->update(
            $detalle['id_producto'],
            ['stock' => $detalle['stock'] - $cantidad]
        );
        
        $this->productos->update(
            $detalle['producto_id'],
            ['stock' => new \CodeIgniter\Database\RawSql('stock - ' . $cantidad)]
        );
    }

    $this->usuarios->actualizarCarrito($usuarioID, []);

    session()->setFlashdata('sucess', 'Su compra se realizó con éxito.');

    return view('cliente/carrito', ['carrito' => []]);
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
