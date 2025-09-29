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

    $session = session();
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

    public function agregar_al_carrito(){

        $session = session();
        $usuarioID = session()->get('id_usuario');

        $idProducto = $this->request->getPost('id_producto');
        $cantidad =  $this->request->getPost('cantidad');
        $talle =   $this->request->getPost('talle');
        $color =  $this->request->getPost('color');

        $productoDetalle = new productos_detalle_Model();
        $productos = new producto_Model(); 
        $tallesModel = new talles_Model();
        $coloresModel = new colores_Model();

        $productoDetalleAgregado = $productoDetalle->buscarDetalleProducto($idProducto, $talle, $color);
        $idTalle = $tallesModel->where('id_talle', $talle)->first();
        $idColor = $coloresModel->where('id_colores', $color)->first();

        $idProductoAgregado = $productos->where('id_producto', $idProducto)->first();
        if( $productoDetalleAgregado){
            $idProductoDetalle = $productoDetalleAgregado; 
        }else{
            $idProductoDetalle = $idProductoAgregado;
        }
        
        if ($usuarioID) {
            $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        }

        $productoDetalleModel = new productos_detalle_Model();
                $productoDetalleColor = $productoDetalleModel->coloresPorProducto($idProducto);
                $productoDetalleTalle = $productoDetalleModel->tallesPorProducto($idProducto);


        if (isset($carrito[$idProductoDetalle['id_producto']])){
            if($idProductoDetalle['stock'] >= ($carrito[$idProductoDetalle['id_producto']]['cantidad'] + $cantidad)){
                $carrito[$idProductoDetalle['id_producto']]['cantidad'] += $cantidad;
            }else{
                $this->response->setJSON(['status' => 'error']);
                return  "Solo quedan " . $idProductoDetalle['stock'] . " unidades disponibles.";
            }
        }else{
            if ($idProductoDetalle['stock'] >= $cantidad) {
                $carrito[$idProductoDetalle['id_producto']] = 
                ['id_detalle_producto' => $idProductoDetalle['id_producto'], 
                'cantidad' => $cantidad, 
                'nombre' => $idProductoAgregado['nombre_producto'],
                'talle' => $idTalle['talle'] ?? null,
                'color' => $idColor['nombre'] ?? null,
                'imagen' => $idProductoAgregado['imagen'],
                'precio' => $idProductoAgregado['precio'],
                'producto_id' => $idProducto];
            } else {
                    $this->response->setJSON(['status' => 'error']);
                    return  "Solo quedan " . $idProductoDetalle['stock'] . " unidades disponibles.";
            }
        }
        
        $this->usuarios->actualizarCarrito($usuarioID, $carrito);

        $carritoActualizado = $this->usuarios->obtenerCarrito($usuarioID);
        
        return view('cliente/carrito', ['carrito' => $carritoActualizado]);
    }

public function eliminarProductoDelCarrito()
    {
        $session = session();
        $usuarioID = session()->get('id_usuario');

        $productoID = $this->request->getPost('id_producto');

        $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        
        if (isset($carrito[$productoID])) {
            unset($carrito[$productoID]);
        }
        $this->usuarios->actualizarCarrito($usuarioID, $carrito);

        $carritoActualizado = $this->usuarios->obtenerCarrito($usuarioID);
        
        return view('cliente/carrito', ['carrito' => $carritoActualizado]);
    }

    public function incrementarCantProducto(){

        $session = session();
        $usuarioID = session()->get('id_usuario');

        $idProducto = $this->request->getPost('id_producto');
        $cantidad =  $this->request->getPost('cantidad');
        $operacion =  $this->request->getPost('operacion');

        $productoDetalle = new productos_detalle_Model();
        $productos = new producto_Model();

        if ($usuarioID) {
            $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        }

        if($idProducto != $carrito[$idProducto]['producto_id']){
                $producto =   $productoDetalle->where('id_producto', $idProducto)->first();
        }else{
                $producto =   $productos->where('id_producto', $idProducto)->first();
        }
        
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

        $carritoActualizado = $this->usuarios->obtenerCarrito($usuarioID);
        
        return view('cliente/carrito', ['carrito' => $carritoActualizado]);
    }

        public function validarStock(){

        $session = session();
        $usuarioID = session()->get('id_usuario');

        $idProducto = $this->request->getPost('id_producto');
        $cantidad =  $this->request->getPost('cantidad');
        $productoDetalle = new productos_detalle_Model();
        $productos = new producto_Model();

        if ($usuarioID) {
            $carrito = $this->usuarios->obtenerCarrito($usuarioID);
        }

        if($idProducto != $carrito[$idProducto]['producto_id']){
                $producto =   $productoDetalle->where('id_producto', $idProducto)->first();
        }else{
                $producto =   $productos->where('id_producto', $idProducto)->first();
        }

        if($producto['stock'] >= ($cantidad)){
                $carrito[$idProducto]['cantidad'] = $cantidad ; 
        }else{
            $this->response->setJSON(['status' => 'error']);
            return "Solo quedan " . $producto['stock'] . " unidades disponibles.";
        }

        $this->usuarios->actualizarCarrito($usuarioID, $carrito);

        $carritoActualizado = $this->usuarios->obtenerCarrito($usuarioID);
        
        return view('cliente/carrito', ['carrito' => $carritoActualizado]);
    } 

    public function añadirCarrito()
    {
        $productoModel = new producto_Model();
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $idProducto = $request->getPost('id_prod');
        $producto = $productoModel->find($idProducto);
        $data = [
                'id'      => $idProducto,
                'qty'     => 1,
                'price'   => $request->getPost('precio_vta'),
                'name'    => $request->getPost('nombre_prod'),
            ];
        if ($producto['stock'] > 0) {
                $cart->insert($data);
                return redirect()->to('carrito');
        }else{
            return redirect()->to('producto/unico/' . $idProducto);
        }
    }
    
    function actualiza_carrito()
    {
        $cart = \Config\Services::cart();
        // Recibe los datos del carrito, calcula y actualiza
        $cart_info =  $_POST['cart'];
        
        foreach( $cart_info as $id => $carrito)
        {   
            $prod = new producto_Model();
            $idprod = $prod->getProducto($carrito['id_prod']);
            $stock = $idprod['stock'];
            $rowid = $carrito['rowid'];
            $price = $carrito['price'];
            $amount = $price * $carrito['qty'];
            $qty = $carrito['qty'];

            if($qty <= $stock){ 
            $cart->update(array(
                'rowid'   => $rowid,
                'price'   => $price,
                'amount' =>  $amount,
                'qty'     => $qty
                ));         
            }else{
                session()->setFlashdata('msgEr','La Cantidad Solicitada de algunos productos no estan disponibles!');
            }
        }

        session()->setFlashdata('msg','Carrito Actualizado!');
        // Redirige a la misma página que se encuentra
        return redirect()->to(base_url('carrito'));
    }

    public function remove($rowid)
    {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        
        if($rowid  === "all"){
          $cart->destroy();
        }else{
          $cart->remove($rowid);
        }

        return redirect()->to('/carrito');
    }

    public function limpiarCarrito()
    {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $cart->destroy();
        return redirect()->to('/carrito');
    }

    public function muestra(){
        helper(['form', 'url', 'cart']);
        $cart = \Config\Services::cart();
        $carrito['carrito']=$cart->contents();
        
        echo view('front/header_view');
        echo view('front/nav_view');
        echo view('back/carrito', $carrito);
        echo view('front/footer');
    }
}   