<?php
namespace App\Controllers;
use App\Models\usuario_Model;
use App\Models\ventas_cabecera_Model;
use App\Models\ventas_detalle_Model;
use App\Models\producto_Model;
Use App\Models\productos_detalle_Model;
Use App\Models\carrito_Model;
Use App\Models\carrito_item_Model;
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

    $carritoModel = new carrito_Model();
    $carritoItemsModel = new carrito_item_Model();
    // buscar carrito del usuario
    $carrito = $carritoModel
        ->where('usuario_id', $usuarioID)
        ->first();

    if (!$carrito) {
        session()->setFlashdata('error', 'No se encuentra el carrito.');
        return redirect()->back();
    }

    $carritoID = $carrito['id_carrito'];

    // obtener items del carrito con datos del producto
    $items = $carritoItemsModel->verCarrito($carritoID);
    
    if (!$items) {
        session()->setFlashdata('error', 'El carrito está vacío.');
        return redirect()->back();
    }

    $total = 0;

    foreach ($items as $item) {

        if ($item['stock'] < $item['cantidad']) {

            session()->setFlashdata(
                'error',
                "No hay stock suficiente para {$item['nombre']}"
            );

            return view('cliente/carrito', ['carrito' => $items]);
        }

        $total += $item['precio'] * $item['cantidad'];
    }

    // registrar venta
    $this->ventas->insert([
        'usuario_id' => $usuarioID,
        'total_venta' => $total
    ]);

    $ventaID = $this->ventas->getInsertID();

    // registrar detalle de venta
    foreach ($items as $item) {

        $subtotal = $item['precio'] * $item['cantidad'];

        $this->detalleVentas->insert([
            'venta_id' => $ventaID,
            'producto_detalle_id' => $item['id_detalle_producto'],
            'precio' => $item['precio'],
            'cantidad' => $item['cantidad'],
            'subtotal' => $subtotal
        ]);

        // actualizar stock de la variante
        $this->productosDetalle->update(
            $item['id_detalle_producto'],
            ['stock' => $item['stock'] - $item['cantidad']]
        );
    }

    // vaciar carrito
    $carritoItemsModel
        ->where('carrito_id', $carritoID)
        ->delete();

    session()->setFlashdata('sucess', 'Su compra se realizó con éxito.');

    $carritoActualizado = $carritoItemsModel->verCarrito($carritoID);

    return view('cliente/carrito', ['carrito' => $carritoActualizado]);
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
