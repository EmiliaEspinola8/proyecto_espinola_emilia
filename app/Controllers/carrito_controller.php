<?php
namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\producto_Model;
Use App\Models\usuario_Model;
Use App\Models\productos_detalle_Model;
Use App\Models\talles_Model;
Use App\Models\colores_Model;

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

    $productoDetalle = $productoDetalleModel
        ->buscarDetalleProducto($idProducto, $talle, $color);

    if (!$productoDetalle) {
        return $this->response->setJSON(['status' => 'error', 'msg' => 'Detalle no encontrado']);
    }

    if ($usuarioID) {
        $carrito = $this->usuarios->obtenerCarrito($usuarioID);
    } else {
        $carrito = [];
    }

    $idDetalle = $productoDetalle['id_producto'];

    if (isset($carrito[$idDetalle])) {

        $nuevaCantidad = $carrito[$idDetalle]['cantidad'] + $cantidad;

        if ($productoDetalle['stock'] < $nuevaCantidad) {
            $this->response->setJSON(['status' => 'error']);
            return "Solo quedan {$productoDetalle['stock']} unidades disponibles.";
        }

        $carrito[$idDetalle]['cantidad'] = $nuevaCantidad;

    } else {

        if ($productoDetalle['stock'] < $cantidad) {
            $this->response->setJSON(['status' => 'error']);
            return $productoDetalle['stock'] == 0
                ? "No quedan unidades disponibles"
                : "Solo quedan {$productoDetalle['stock']} unidades disponibles.";
        }

        $carrito[$idDetalle] = [
            'producto_id' => $idProducto,
            'cantidad'    => $cantidad
        ];
    }

    $this->usuarios->actualizarCarrito($usuarioID, $carrito);

    $carritoActualizado = verCarrito($carrito);
        
    return view('cliente/carrito', ['carrito' => $carritoActualizado]);
}

public function eliminarProductoDelCarrito()
    {
        $usuarioID = session()->get('id_usuario');

        $productoID = $this->request->getPost('id_producto');

        $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        
        if (isset($carrito[$productoID])) {
            unset($carrito[$productoID]);
        }
        $this->usuarios->actualizarCarrito($usuarioID, $carrito);

        $carritoActualizado = verCarrito($carrito);
        
        return view('cliente/carrito', ['carrito' => $carritoActualizado]);
    }

    public function incrementarCantProducto(){

        $usuarioID = session()->get('id_usuario');

        $idProducto = $this->request->getPost('id_producto');
        $cantidad =  $this->request->getPost('cantidad');
        $operacion =  $this->request->getPost('operacion');

        $productoDetalle = new productos_detalle_Model();
        $productos = new producto_Model();

        if ($usuarioID) {
            $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        }

        $producto =  $productoDetalle->where('id_producto', $idProducto)->first();
        
        if($operacion == "incrementar"){
                if($producto['stock'] >= ($cantidad + 1)){
                        $carrito[$idProducto]['cantidad'] += 1; 
                }else{
                    $this->response->setJSON(['status' => 'error']);
                    return "Solo quedan " . $producto['stock'] . " unidades disponibles.";
                }
        }else{
            if($cantidad > 1){
                    $carrito[$idProducto]['cantidad'] -= 1; 
            }
        }

        $this->usuarios->actualizarCarrito($usuarioID, $carrito);

        $carritoActualizado = verCarrito($carrito);
        
        return view('cliente/carrito', ['carrito' => $carritoActualizado]);
    }
}   