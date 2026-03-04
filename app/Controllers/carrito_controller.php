<?php
namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\producto_Model;
Use App\Models\usuario_Model;
Use App\Models\productos_detalle_Model;
Use App\Models\talles_Model;
Use App\Models\colores_Model;
Use App\Models\carrito_Model;
Use App\Models\carrito_item_Model;

class carrito_controller extends Controller{
    protected $ventas;
    protected $detalleVentas;
    protected $usuarios;
    protected $productos;
    protected $productoDetalle;

    public function __construct(){
    helper(['form', 'url']);
    
    $this->usuarios = new usuario_Model();
    $this->productos = new producto_Model();
    }

    public function productos($id){

        $productoModel = new producto_Model(); 
        $data['data'] = $productoModel->find($id);
        
        $dato['titulo']='producto'; 
        echo view('front/header_view', $dato);
        echo view('front/nav_view');
        echo view('front/producto', $data);
        echo view('front/footer'); 
    }

public function agregar_al_carrito()
{
    $usuarioID = session()->get('id_usuario');

    $idProducto = $this->request->getPost('id_producto');
    $cantidad   = (int) $this->request->getPost('cantidad');
    $talle      = $this->request->getPost('talle');
    $color      = $this->request->getPost('color');

    $productoDetalleModel = new productos_detalle_Model();
    $carritoModel = new carrito_Model();
    $carritoItemsModel = new carrito_item_Model();

    $productoDetalle = $productoDetalleModel
        ->buscarDetalleProducto($idProducto, $talle, $color);

    if (!$productoDetalle) {
        return $this->response->setJSON([
            'status' => 'error',
            'msg' => 'Detalle no encontrado'
        ]);
    }

    $idDetalle = $productoDetalle['id_producto'];

    // 1buscar carrito del usuario
    $carrito = $carritoModel
        ->where('usuario_id', $usuarioID)
        ->first();

    // si no tiene carrito lo creamos
    if (!$carrito) {
        $carritoID = $carritoModel->insert([
            'usuario_id' => $usuarioID,
        ]);

    } else {
        $carritoID = $carrito['id_carrito'];
    }

    // buscar si el producto ya está en el carrito
    $item = $carritoItemsModel
        ->where('carrito_id', $carritoID)
        ->where('producto_detalle_id', $idDetalle)
        ->first();

    if ($item) {

        $nuevaCantidad = $item['cantidad'] + $cantidad;

        if ($productoDetalle['stock'] < $nuevaCantidad) {
            $this->response->setJSON(['status' => 'error']);
            return "Solo quedan {$productoDetalle['stock']} unidades disponibles.";
        }

        // actualizar cantidad
        $carritoItemsModel->update(
            $item['id_carrito_item'],
            ['cantidad' => $nuevaCantidad]
        );

    } else {

        if ($productoDetalle['stock'] < $cantidad) {
            $this->response->setJSON(['status' => 'error']);
            return $productoDetalle['stock'] == 0
                ? "No quedan unidades disponibles"
                : "Solo quedan {$productoDetalle['stock']} unidades disponibles.";
        }

        // insertar nuevo item
        $carritoItemsModel->insert([
            'carrito_id' => $carritoID,
            'producto_detalle_id' => $idDetalle,
            'cantidad' => $cantidad
        ]);
    }
    
    $carritoActualizado = $carritoItemsModel->verCarrito($carritoID);

    return view('cliente/carrito', ['carrito' => $carritoActualizado]);
}



public function eliminarProductoDelCarrito()
    {
    $usuarioID = session()->get('id_usuario');

    $idDetalle = $this->request->getPost('id_producto');

    $carritoModel = new carrito_Model();
    $carritoItemsModel = new carrito_item_Model();

    // buscar carrito del usuario
    $carrito = $carritoModel
        ->where('usuario_id', $usuarioID)
        ->first();

    $carritoID = $carrito['id_carrito'];

    // eliminar item del carrito
    $carritoItemsModel
        ->where('carrito_id', $carritoID)
        ->where('producto_detalle_id', $idDetalle)
        ->delete();

    // volver a cargar el carrito actualizado
    $carritoActualizado = $carritoItemsModel->verCarrito($carritoID);

    return view('cliente/carrito', [
        'carrito' => $carritoActualizado
    ]);
    }

public function incrementarCantProducto()
{
    $usuarioID = session()->get('id_usuario');

    $idDetalle = $this->request->getPost('id_producto');
    $cantidad  = (int) $this->request->getPost('cantidad');
    $operacion = $this->request->getPost('operacion');

    $productoDetalleModel = new productos_detalle_Model();
    $carritoModel = new carrito_Model();
    $carritoItemsModel = new carrito_item_Model();
    // buscar carrito del usuario
    $carrito = $carritoModel
        ->where('usuario_id', $usuarioID)
        ->first();

    $carritoID = $carrito['id_carrito'];

    // buscar detalle del producto
    $producto = $productoDetalleModel
        ->where('id_producto', $idDetalle)
        ->first();

    // buscar item del carrito
    $item = $carritoItemsModel
        ->where('carrito_id', $carritoID)
        ->where('producto_detalle_id', $idDetalle)
        ->first();

    $nuevaCantidad = $item['cantidad'];

    if ($operacion == "incrementar") {

        if ($producto['stock'] >= ($item['cantidad'] + 1)) {
            $nuevaCantidad = $item['cantidad'] + 1;
        } else {
            $this->response->setJSON(['status' => 'error']);
            return "Solo quedan {$producto['stock']} unidades disponibles.";
        }

    } else {

        if ($item['cantidad'] > 1) {
            $nuevaCantidad = $item['cantidad'] - 1;
        }
    }

    // actualizar cantidad
    $carritoItemsModel->update(
        $item['id_carrito_item'],
        ['cantidad' => $nuevaCantidad]
    );

    // volver a cargar el carrito actualizado
    $carritoActualizado = $carritoItemsModel->verCarrito($carritoID);

    return view('cliente/carrito', [
        'carrito' => $carritoActualizado
    ]);
}
}   